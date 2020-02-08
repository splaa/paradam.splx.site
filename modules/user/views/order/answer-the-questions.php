<?php
	/**
	 * @var $service
	 * @var $answer
	 * @var Comment $comment
	 */


	use app\modules\services\models\Comment;
	use yii\helpers\Html;
	use yii\widgets\ActiveForm;

?>

<?php

	if (!empty($session['order'])): ?>
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
				<?php foreach ($service->questions as $item): ?>

                <tr>
                    <td>
						<?= $form->field($answer, 'answer')->label($item->question) ?>
                    </td>

					<?php endforeach;; ?>
                </tr>
				<?php ActiveForm::end(); ?>
				<?php $form = ActiveForm::begin(); ?>
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


	<?php else: ?>
        <h3>Пусто</h3>
	<?php endif; ?>


