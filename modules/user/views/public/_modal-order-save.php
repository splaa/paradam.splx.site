<?php
	/** @var Service $service */
	/** @var Answer $answer */

	/** @var Comment $comment */


	use app\modules\services\models\Answer;
	use app\modules\services\models\Comment;
	use app\modules\services\models\Service;
	use yii\bootstrap\Modal;
	use yii\helpers\Html;
	use yii\widgets\ActiveForm;

	Modal::begin([
		'id' => 'modal-order-save-question-answer-comment',
		'header' => '<h2>Услуги</h2>',
		'toggleButton' => [
			'label' => 'Заказать',
			'tag' => 'button',
			'class' => 'btn btn-success',
		],
		'footer' => 'Что то нужно написать...'


	]);
?>
<h4>Ответы на вопросы:</h4>
<div class="table-responsive-lg">
    <table class="table table-hover table-striped">
        <thead>
        <tr>
            <th>Вопрос</th>
        </tr>
        </thead>

        <tbody>
		<?php $form = ActiveForm::begin(); ?>
		<?php foreach ($service->questions as $index => $question): ?>
        <tr>
            <td>
				<?= $form->field($answers[count($answers) - 1], "[$index]answer")->label($question->question) ?>
				<?= $form->field($answers[count($answers) - 1], "[$index]question_id")->hiddenInput(['value' => $question->id])->label(false) ?>
            </td>

			<?php endforeach;; ?>
        </tr>

        <tr>
            <td><?= $form->field($comment, 'comment')->textarea() ?></td>
        </tr>

        <tr>
            <td><?= Html::submitButton('Отправить', ['class' => 'btn btn-primary']) ?></td>
        </tr>
		<?php ActiveForm::end(); ?>

        </tbody>
    </table>
</div>

<?php Modal::end(); ?>
