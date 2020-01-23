<?php

namespace app\modules\services\controllers;

use app\modules\user\controllers\UserController;


/**
 * Default controller for the `services` module
 */
class DefaultController extends UserController
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }
}
