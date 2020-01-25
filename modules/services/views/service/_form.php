<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\services\models\Service */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="service-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

<!--    --><?php //= $form->field($model, 'user_id')->textInput() ?>
<!--    --><?php //= $form->field($model, 'link_foto_video_file')->textInput(['maxlength' => true]) ?>
<!--    --><?php //= $form->field($model, 'created_at')->textInput() ?>
<!--    --><?php //= $form->field($model, 'updated_at')->textInput() ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'price')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'periodOfExecution')->textInput() ?>


    <div class="row">

        <div class="col-12 col-md-3">
            <?= $nameFile = $form->field($model, 'imageFile')->fileInput() ?>

        </div>
        <div class="col-12">

            <?php if ($model->imageFile): ?>
                <?= Html::img('@web/uploads/' . $model->imageFile, ['width' => '100px']) ?>
            <?php endif; ?>
        </div>
    </div>


    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>
