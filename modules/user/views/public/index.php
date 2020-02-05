<?php
	/* @var $model \app\modules\user\models\User */
	/* @var $messageForm \app\modules\message\forms\MessageForm */
	/* @var $services \app\modules\services\models\Service[] */
	/* @var $this yii\web\View */
	/* @var $subscribe_id integer */

	/* @var $count integer */

	use yii\bootstrap\ActiveForm;
	use yii\helpers\Html;
	use yii\helpers\Url;

?>
<div class="container emp-profile">
    <div class="row">
        <div class="col-md-4">
            <div class="profile-img">
				<?= Html::img($model->avatarBig, ['alt' => $model->alt]) ?>
            </div>
        </div>
        <div class="col-md-6">
            <div class="profile-head">
                <h5>
					<?= $model->first_name . ' ' . $model->last_name ?>
                </h5>
                <h6>
					<?= $model->username ?>
                </h6>
                <p class="proile-rating">RANKINGS : <span>8/10</span></p>
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item active">
                        <a class="nav-link" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home"
                           aria-selected="true">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab"
                           aria-controls="profile" aria-selected="false">Timeline</a>
                    </li>
	                <?php if ($services): ?>
	                    <li class="nav-item">
	                        <a class="nav-link" id="service-tab" data-toggle="tab" href="#service" role="tab"
	                           aria-controls="service" aria-selected="false">Service(Услуги)</a>
	                    </li>
	                <?php endif; ?>
                </ul>
            </div>
        </div>
		<?php if (Yii::$app->user->id == $model->id): ?>
            <div class="col-md-2">
				<?= Html::a('Edit Profile', '/user/profile', ['class' => 'profile-edit-btn']) ?>
            </div>
		<?php endif; ?>
    </div>
    <div class="row">
        <div class="col-md-4">
			<?php if (Yii::$app->user->id != $model->id): ?>
                <div style="text-align: center;margin: 20px 0;">
					<?php $form = ActiveForm::begin(['action' => Url::to(['/message/message/create']), 'method' => 'POST']); ?>

					<?= $form->field($messageForm, 'text')->textarea() ?>
					<?= $form->field($messageForm, 'user_id')->input('hidden', ['value' => $model->id])->label(false) ?>

                    <div class="form-group">
						<?= Html::submitButton('Отправить', ['class' => 'btn btn-success']) ?>
                    </div>

					<?php ActiveForm::end(); ?>
                </div>
			<?php endif; ?>

			<?= $this->render('_subscribe_btn', [
				'subscribe_id' => $subscribe_id,
				'user_id' => $model->id,
				'count' => $count
			]) ?>

            <div class="profile-work">
                <p>WORK LINK</p>
                <a href="">Website Link</a><br/>
                <a href="">Bootsnipp Profile</a><br/>
                <a href="">Bootply Profile</a>
                <p>SKILLS</p>
                <a href="">Web Designer</a><br/>
                <a href="">Web Developer</a><br/>
                <a href="">WordPress</a><br/>
                <a href="">WooCommerce</a><br/>
                <a href="">PHP, .Net</a><br/>
            </div>
        </div>
        <div class="col-md-8">
            <div class="tab-content profile-tab" id="myTabContent">
                <div class="tab-pane active" id="home" role="tabpanel" aria-labelledby="home-tab">
                    <div class="row">
                        <div class="col-md-6">
                            <label>Username</label>
                        </div>
                        <div class="col-md-6">
                            <p><?= $model->username ?></p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <label>Name</label>
                        </div>
                        <div class="col-md-6">
                            <p><?= $model->first_name . ' ' . $model->last_name ?></p>
                        </div>
                    </div>
					<?php if ($model->email): ?>
                        <div class="row">
                            <div class="col-md-6">
                                <label>Email</label>
                            </div>
                            <div class="col-md-6">
                                <p><?= $model->email ?></p>
                            </div>
                        </div>
					<?php endif; ?>
                    <div class="row">
                        <div class="col-md-6">
                            <label>Phone</label>
                        </div>
                        <div class="col-md-6">
                            <p><?= $model->telephone ?></p>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                    <div class="row">
                        <div class="col-md-6">
                            <label>Experience</label>
                        </div>
                        <div class="col-md-6">
                            <p>Expert</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <label>Hourly Rate</label>
                        </div>
                        <div class="col-md-6">
                            <p>10$/hr</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <label>Total Projects</label>
                        </div>
                        <div class="col-md-6">
                            <p>230</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <label>English Level</label>
                        </div>
                        <div class="col-md-6">
                            <p>Expert</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <label>Availability</label>
                        </div>
                        <div class="col-md-6">
                            <p>6 months</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <label>Your Bio</label><br/>
                            <p>Your detail description</p>
                        </div>
                    </div>
                </div>
	            <?php if ($services): ?>
	                <div class="tab-pane fade" id="service" role="tabpanel" aria-labelledby="service-tab">
						<?php foreach ($services as $service): ?>
			                <div class="row">
		                        <div class="col-md-3">
		                            <label><?= $service->name ?></label>
		                        </div>
		                        <div class="col-md-3">
		                            <label><?= $service->price ?></label>
		                        </div>
		                        <div class="col-md-6">
		                            <label><?= Html::submitButton('Заказать услугу', ['class' => 'btn btn-success']) ?></label>
		                        </div>
			                </div>
						<?php endforeach; ?>
	                </div>
	            <?php endif; ?>
            </div>
        </div>
    </div>
</div>