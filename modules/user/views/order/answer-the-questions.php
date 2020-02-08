<?php
	/** @var Answer $answer */
	/** @var Service $service */
	/** @var Comment $comment */
?>

<?php use app\modules\services\models\Answer;
	use app\modules\services\models\Comment;
	use app\modules\services\models\Service;
	use yii\helpers\Html;
	use yii\widgets\ActiveForm;

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
                    </tr>
				<?php endforeach;; ?>
                <tr>
                    <td>
						<?= $form->field($comment, 'comment')->textarea()->label('Оставь Свой Коментарий:') ?>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class="form-group">
							<?= Html::submitButton('Отправить', ['class' => 'btn btn-primary']) ?>
                        </div>
                    </td>
                </tr>

				<?php ActiveForm::end(); ?>
                </tbody>
            </table>
        </div>


	<?php else: ?>
        <h3>Пусто</h3>
	<?php endif; ?>


