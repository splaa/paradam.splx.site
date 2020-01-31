<?php
	/* @var $this yii\web\View */
	/* @var $subscribe_id integer */
	/* @var $count integer */

	use yii\helpers\Url;

?>


<?= $this->render('__subscribe_btn_block', [
	'subscribe_id' => $subscribe_id,
	'user_id' => $user_id,
	'count' => $count
]) ?>



<?php
	$action = Url::to(['public/subscribe']);
	$js = <<< JS
		$(document).on('click', '#btn-subscribe', function(){
			$.ajax({
			        url: '{$action}',
			        type: 'POST',
			        data: 'user_id={$user_id}'
			    }
			).done(function(data) {
			    let html = data;
				$('#btn-subscribe-wrapper').html(data);
			})
		});
JS;

	$this->registerJs($js);

?>