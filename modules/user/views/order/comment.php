<?php
	/** @var Comment $comment */
	/** @var Answer $answer */

	/** @var string $message */

	use app\modules\services\models\Answer;
	use app\modules\services\models\Comment;


?>


<?php

	$viewComment = $this->render('_modal-comment', compact('answer', 'comment'));

?>


<?= $viewComment ?>

