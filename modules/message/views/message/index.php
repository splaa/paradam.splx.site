<?php
/**
 * @var \app\modules\message\models\UserThread[] $threads
 */
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
						<?php $last = $thread->thread->messages; ?>
						<?php $last = array_pop($last); ?>
						<div class="chat_list active_chat">
							<div class="chat_people">
								<div class="chat_img">
									<img src="https://ptetutorials.com/images/user-profile.png" alt="sunil">
								</div>
								<div class="chat_ib">
									<h5><?= $last->author->username ?> <span class="chat_date">Dec 25</span></h5>
									<p><?= $last->text ?></p>
								</div>
							</div>
						</div>
					<?php endforeach; ?>
				</div>
			</div>
			<div class="mesgs">
				<?php foreach ($threads as $thread): ?>
					<div class="msg_history">
						<?php foreach ($thread->thread->messages as $message): ?>
							<?php if ($message->author_id != Yii::$app->user->getId()): ?>
								<div class="incoming_msg">
									<div class="incoming_msg_img">
										<img src="https://ptetutorials.com/images/user-profile.png"  alt="sunil">
									</div>
									<div class="received_msg">
										<div class="received_withd_msg">
											<p>
												<?= $message->text ?>
											</p>
											<span class="time_date"> 11:01 AM    |    June 9</span>
										</div>
									</div>
								</div>
							<?php else: ?>
								<div class="outgoing_msg">
									<div class="sent_msg">
										<p>
											<?= $message->text ?>
										</p>
										<span class="time_date"> 11:01 AM    |    June 9</span>
									</div>
								</div>
							<?php endif; ?>
						<?php endforeach; ?>
					</div>
					<div class="type_msg">
						<div class="input_msg_write">
							<input type="text" class="write_msg" placeholder="Type a message"/>
							<button class="msg_send_btn" type="button"><i class="glyphicon glyphicon-send"aria-hidden="true"></i></button>
						</div>
					</div>
				<?php endforeach; ?>
			</div>
		</div>

	</div>
</div>