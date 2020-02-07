<?php

	use yii\helpers\Html;

	$this->title = "Услуги";
	Yii::$app->params['modalTitle'] = 'Услуги'
?>

<?php if (!empty($session['order'])): ?>
    <div class="table-responsive-lg">
        <table class="table table-hover table-striped">
            <thead>
            <tr>
                <th>Фото</th>
                <th>Наименование</th>
                <th>Кол-во</th>
                <th>Цена</th>
                <th><span>Ответить на Вопросы</span>
                <th>
                <th><span>Удалить</span>
                <th>
            </tr>
            </thead>
            <tbody>
			<?php foreach ($session['order'] as $id => $item): ?>
                <tr>
                    <td><?= \yii\helpers\Html::img('@web/images/services/uploads/' . $item['img'], ['width' => '50px']) ?></td>
                    <td><?= $item['name']; ?></td>
                    <td><?= $item['qty']; ?></td>
                    <td><?= $item['price']; ?></td>
                    <th>
						<?= Html::a('<span class="glyphicon glyphicon-question-sign text-info" ></span>', ['#'], ['id' => 'answer-the-questions-' . $id, 'data-id' => $id, 'class' => 'answer-questions-glyph']) ?>
                    <th>
                    <td><span data-id="<?= $id ?> "
                              class="glyphicon glyphicon-remove text-danger del-item"></span></td>
                </tr>
			<?php endforeach;; ?>
            <tr>
                <td colspan="4">Итого:</td>
                <td><?= $session['order.qty']; ?></td>
            </tr>
            <tr>
                <td colspan="4">На сумму:</td>
                <td><?= $session['order.sum']; ?></td>
            </tr>
            </tbody>
        </table>
    </div>
<?php else: ?>
    <h3>Пусто</h3>
<?php endif; ?>


