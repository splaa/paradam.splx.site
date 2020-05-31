<?php
/**
 * @var \app\modules\message\models\UserThread[] $threads
 * @var \app\modules\message\models\UserThread $selected_user_thread
 * @var \app\modules\message\forms\SettingsForm $model
 * @var integer $froze
 */

use app\components\Hash;
use app\components\widgets\icon_menu\IconMenuWidget;
use app\components\widgets\menu\MenuWidget;
use kartik\typeahead\Typeahead;
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\JsExpression;
use yii\widgets\Pjax;

?>
<!-- HEADER -->
<header class="flex-center">
	<?= IconMenuWidget::widget() ?>
	<h2>Сообщения</h2>
	<input type="checkbox" id="nav-toggle" hidden>

	<?= MenuWidget::widget() ?>
</header>
<!-- HEADER FIN -->

<section>
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
							<?php $form = ActiveForm::begin([
								'id' => 'settings-form',
								'action' => Url::to(['settings']),
								'enableAjaxValidation' => true,
								]); ?>

							<?= $form->field($model, 'sms_cost')->textInput(['type' => 'number', 'value' => Yii::$app->user->identity->sms_cost, 'step' => 5]) ?> = <?= Yii::$app->user->identity->convertSmsCostToUSD ?>

							<?php ActiveForm::end(); ?>
						</div>
					</div>
				</div>
				<div class="inbox_chat">
					<?php $template = '<a href="{{link}}" class="search-top clearfix"><img src="{{avatar}}"><span class="search-username">{{value}}</span><span class="search-fullname">{{full_name}}</span><span class="search-fullname">{{text}}</span></a>';?>
					<?=
					Typeahead::widget([
						'name' => 'user-message',
						'id' => 'userMessageTypeahead',
						'options' => ['placeholder' => 'Search thread message ...'],
						'scrollable' => true,
						'dataset' => [
							[
								'display' => 'value',
								'limit' => 50,
								'remote' => [
									'url' => Url::to(['/message/message/search']) . '?q=%QUERY',
									'wildcard' => '%QUERY',
									'rateLimitWait' => 1000
								],
								'templates' => [
									'notFound' => '<div class="text-danger" style="padding:0 8px">Ничего не найдено.</div>',
									'suggestion' => new JsExpression("Handlebars.compile('{$template}')")
								]
							]
						],
						'pluginOptions' => [
							'highlight' => true,
							'minLength' => 1,
							'val' => ''
						],
					]);
					?>
					<?php foreach ($threads as $thread): ?>
						<?php
							$hash = new Hash();
							$hash->string = $thread->thread->id;

							if ($thread->thread->messageWriter) {
								$avatarSmall = $thread->thread->messageWriter->author->avatarSmall;
								$username = $thread->thread->messageWriter->author->username;
								$alt = $thread->thread->messageWriter->author->alt;
							} else {
								$avatarSmall = $thread->thread->creator->avatarSmall;
								$username = $thread->thread->creator->username;
								$alt = $thread->thread->creator->alt;
							}
						?>
						<a class="chat_list active_chat" href="<?= Url::to(['view', 'id' => $hash->run(Hash::ENCODE)]) ?>">
							<div class="chat_people">
								<div class="chat_img">
									<img src="<?= $avatarSmall ?>" alt="<?= $alt ?>">
								</div>
								<div class="chat_ib" id="thread_<?= $thread->thread->id ?>">
									<h5><?= $username ?> <span class="chat_date"><?= date("d M", strtotime($thread->thread->created_at)) ?></span></h5>

									<?php if (!empty($thread->thread->message->author)): ?>
										<p>
											<span class="text">
												<?php if ($thread->thread->message->author->id == Yii::$app->user->id): ?>
													<b>You:</b>
												<?php endif; ?>
												<?php if ($thread->thread->message->audio): ?>
													Voice message
												<?php else: ?>
													<?= mb_substr($thread->thread->message->text, 0, 35) ?>...
												<?php endif; ?>
											</span>
											<span class="badge" style="float: right">0</span>
										</p>
									<?php endif; ?>
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
							'selected_user_thread' => $selected_user_thread,
							'froze' => $froze,
						]);
					?>
				<?php endif; ?>
			</div>
		</div>

	</div>
</div>
</section>
<?php
$js = <<< JS
$('#settings-form').on('beforeSubmit', function () {
    let yiiform = $(this);
    // отправляем данные на сервер
    $.ajax({
            type: yiiform.attr('method'),
            url: yiiform.attr('action'),
            data: yiiform.serializeArray()
        }
    )
    .done(function(data) {
       if(data.success) {
          // данные сохранены
        } else {
          // сервер вернул ошибку и не сохранил наши данные
        }
    })
    .fail(function () {
         // не удалось выполнить запрос к серверу
    })

    return false; // отменяем отправку данных формы
})
JS;

	$this->registerJs($js);
?>