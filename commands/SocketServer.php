<?php
namespace app\commands;
use app\modules\message\models\Message;
use app\modules\message\models\Thread;
use app\modules\message\models\UserMessage;
use app\modules\message\models\UserThread;
use app\modules\user\models\User;
use Ratchet\ConnectionInterface;
use Ratchet\MessageComponentInterface;
use Yii;

class SocketServer implements MessageComponentInterface
{
	protected $clients;

	public function __construct() {
		$this->clients = new \SplObjectStorage;
	}

	public function onOpen(ConnectionInterface $conn) {
		// Store the new connection to send messages to later
		$this->clients->attach($conn);

		echo "New connection! ({$conn->resourceId})\n";
	}

	public function onMessage(ConnectionInterface $from, $msg) {
		$numRecv = count($this->clients) - 1;
		echo sprintf('Connection %d sending message "%s" to %d other connection%s' . "\n"
			, $from->resourceId, $msg, $numRecv, $numRecv == 1 ? '' : 's');

		$this->saveMessageToDB($msg);

		foreach ($this->clients as $client) {
			//if ($from !== $client) {
				// The sender is not the receiver, send to each client connected
				$client->send($msg);
			//}
		}
	}

	public function onClose(ConnectionInterface $conn) {
		// The connection is closed, remove it, as we can no longer send it messages
		$this->clients->detach($conn);

		echo "Connection {$conn->resourceId} has disconnected\n";
	}

	public function onError(ConnectionInterface $conn, \Exception $e) {
		echo "An error has occurred: {$e->getMessage()}\n";

		$conn->close();
	}

	private function saveMessageToDB(&$data) {
		$parse = json_decode($data, true);

		if ((!empty($parse['message']) || !empty($parse['audio'])) && !empty($parse['user_id']) && !empty($parse['thread_id'])) {
			$recipient = UserThread::find()
						->alias('ut')
						->leftJoin('thread as t', 'ut.thread_id = t.id')
						->where(['ut.thread_id' => $parse['thread_id']])
						->andWhere(['<>', 'ut.user_id', $parse['user_id']])
						->asArray()
						->one();

			if ($recipient) {
				$recipient_id = $recipient['user_id'];

				if (!empty($recipient['creator_id'])) {
					$recipient_id = $recipient['creator_id'];
				}

				$message = new Message();
				$message->author_id = $parse['user_id'];
				$message->thread_id = $parse['thread_id'];
				$message->text = $parse['message'];
				$message->audio = $parse['audio'];
				$message->save();

				$user_message = new UserMessage();
				$user_message->user_id = $parse['user_id'];
				$user_message->message_id = $message->id;
				$user_message->save();

				$thread = Thread::findOne($recipient['thread_id']);
				$factor = 1;

				if ($thread->creator_id != $parse['user_id']) {
					// Minus from balance
					if (!empty($parse['audio'])) {
						$file = Yii::getAlias('@web') . 'uploads/messages/' . $parse['audio'];
						$fp = fopen($file, 'rb');
						fseek($fp, 28);
						$rawheader = fread($fp, 4);
						$header = unpack('Vbytespersec',$rawheader);
						echo 'Файл '.$file.' продолжительностью '.round((filesize($file)-44)/$header['bytespersec'],2).' сек.';

					} else {
						if (mb_strlen($parse['message'], 'UTF-8') > USER::MESSAGE_LENGTH) {
							$factor = count(User::strSplitUnicode($parse['message'], USER::MESSAGE_LENGTH));
						}
					}

					User::transferBits($parse['user_id'], $recipient_id, User::TRANSFER_TYPE_SMS, 0, $factor);
				}

				$parse['time'] = Yii::$app->formatter->asRelativeTime(date('Y-m-d H:i:s'));
				$parse['date'] = Yii::$app->formatter->asDate(date('Y-m-d H:i:s'));
			}

			$data = json_encode($parse);
		}
	}
}