<?php
	
	use yii\helpers\Html;
	use yii\widgets\ActiveForm;
	
	/* @var $this yii\web\View */
/* @var $model app\modules\services\models\Question */
/* @var $form yii\widgets\ActiveForm */
	
	//	$this->registerJsFile('/question/js/jquery.js');
	//	$this->registerJsFile('/question/js/questions.js',
	//        [
	//                'depends' => '/question/js/jquery.js'
	//        ]);
	//	$this->registerCssFile('/question/css/questions.css');
?>

<div class="question-form">

    <?php $form = ActiveForm::begin(); ?>

<!--    --><?php //= $form->field($model, 'created_at')->textInput() ?>

<!--    --><?php //= $form->field($model, 'updated_at')->textInput() ?>

    <?= $form->field($model, 'question')->textInput(['maxlength' => true]) ?>

    <!--    --><?php //= $form->field($model, 'status')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<div id="container">

    <div class="dynamic-form">

        <a href="#" id="add">Добавить</a> | <a href="#" id="remove">Удалить</a> | <a href="#" id="reset">Сбросить</a>

        <form>
            <div class="inputs">
                <div><input type="text" name="dynamic[]" class="field" value="1"></div>
            </div>
            <input name="submit" type="button" class="submit" value="ОК">
        </form>
    </div>


</div>

