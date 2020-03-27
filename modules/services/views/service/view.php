<?php

	use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;

	/* @var $this yii\web\View */
	/* @var $model app\modules\services\models\Service */

	$this->title = $model->name;
	$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Services'), 'url' => ['index']];
	$this->params['breadcrumbs'][] = $this->title;
	\yii\web\YiiAsset::register($this);
?>

<!-- HEADER -->
<header>
	<div class="headerContainer">
        <span onclick="main.back()" class="backButton">
            <img src="<?= Yii::getAlias('@web') ?>/images/paradam/back_arrow.svg" alt="">
        </span>
		<h2><?= Html::encode($this->title) ?></h2>
	</div>
</header>

<!-- HEADER FIN -->

<section>

	<div class="mainContainer">
		<div class="steps_container">
			<div class="steps step_active_three">
				<ul>
					<li><img src="<?= Yii::getAlias('@web') ?>/images/paradam/tick.svg" alt=""></li>
					<li><img src="<?= Yii::getAlias('@web') ?>/images/paradam/tick.svg" alt=""></li>
					<li>3</li>
				</ul>
				<div class="stepsProgress stepsProgress_3"></div>
			</div>
			<p>Step 3</p>
		</div>

		<h2>Service information</h2>

		<div class="textblock">
			<p>Service name</p>
			<span><?= $model->name ?></span>
		</div>
		<div class="textblock textBlock-number">
			<p>Service cost</p>
			<span><?= $model->convertPriceToUSD ?></span>
		</div>
		<div class="textblock">
			<p>Service description</p>
			<span><?= $model->description ?></span>
		</div>
		<div class="textblock textBlock-number">
			<p>Days term</p>
			<span><?= $model->periodOfExecution ?></span>
		</div>

		<h2>Questions for buyer</h2>

		<?php foreach ($model->questions as $key => $questions): ?>
			<div class="textblock">
				<p>Question for buyer <?= $key + 1 ?></p>
				<span><?= $questions->question ?></span>
			</div>
		<?php endforeach; ?>

		<label class="agreePpTu flex">
			<input type="checkbox" name="" id="">
			<span class="checkmark"></span>
			<p>I agree to the <a href="#">Privacy Policy</a> and <a href="#">terms of use</a></p>
		</label>

	</div>
</section>


<section>
	<div class="stepsButtons">
		<div class="stepsButtonsContainer">
			<div class="sb_button sb_back">
				<a href="<?= $back; ?>">
					<span><img src="<?= Yii::getAlias('@web') ?>/images/paradam/btn-back.svg" alt="">Back</span>
				</a>
			</div>
			<div class="sb_button sb_next">
				<a href="<?= Url::to(['/user/public/', 'username' => $model->user->username]) ?>">Create <img src="<?= Yii::getAlias('@web') ?>/images/paradam/btn-next.svg" alt=""></a>
			</div>
		</div>
	</div>
</section>