<?php
/**
 * @var \app\modules\message\models\UserThread[] $threads
 * @var \app\modules\message\models\UserThread $selected_user_thread
 */

use yii\helpers\Url;
use \app\components\Hash;

?>
<div class="container">
	<h3 class=" text-center">Messaging</h3>

	<div class="messaging">
		<div class="inbox_msg">
			<div class="inbox_people">
				<div class="headind_srch">
					<div class="recent_heading">
						<h4>Recent</h4>
					</div>
					<div class="srch_bar">
						<div class="stylish-input-group">
							<input type="text" class="search-bar" placeholder="Search">
							<span class="input-group-addon" style="display: none">
                                <button type="button"> <i class="fa fa-search" aria-hidden="true"></i> </button>
                            </span>
						</div>
					</div>
				</div>
				<div class="inbox_chat">
					<?php foreach ($threads as $thread): ?>
						<?php
							$hash = new Hash();
							$hash->string = $thread->thread->id;
						?>
						<a class="chat_list active_chat" href="<?= Url::to(['/message/', 'id' => $hash->run(Hash::ENCODE)]) ?>">
							<div class="chat_people">
								<div class="chat_img">
									<img src="https://ptetutorials.com/images/user-profile.png" alt="sunil">
								</div>
								<div class="chat_ib" id="thread_<?= $thread->thread->id ?>">
									<h5><?= $thread->thread->message->author->username ?> <span class="chat_date"><?= date("d M", strtotime($thread->thread->created_at)) ?></span></h5>
									<p><span class="text"><?= $thread->thread->message->text ?></span> <span class="badge" style="float: right">0</span></p>
								</div>
							</div>
						</a>
					<?php endforeach; ?>
				</div>
			</div>
			<div class="mesgs">
				<?php if (!empty($selected_user_thread)): ?>
					<?=
						$this->render('thread', [
							'selected_user_thread' => $selected_user_thread
						]);
					?>
				<?php endif; ?>
			</div>
		</div>

	</div>
</div>