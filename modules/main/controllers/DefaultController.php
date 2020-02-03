<?php
	
	namespace app\modules\main\controllers;

	use JamesHeinrich\GetID3\GetID3;
	use yii\web\Controller;

    /**
     * Default controller for the `main` module
     */
    class DefaultController extends Controller
    {
        public function actions()
        {
            return [
                'error' => [
                    'class' => 'yii\web\ErrorAction',
                ],
			];
		}
		
		/**
		 * Renders the index view for the module
		 * @return string
		 */
		public function actionIndex()
		{
//			$file = \Yii::getAlias('@web') . 'uploads/messages/2020-02-03T00:57:18.653Z1_1.wav';
//			$fp = fopen($file, 'rb');
//			fseek($fp, 28);
//			$rawheader = fread($fp, 4);
//
//			$header = unpack('Vbytespersec', $rawheader);
//
//			 echo "<pre>";print_r('Файл '.$file.' продолжительностью '.round((filesize($file)-44)/$header['bytespersec'],2).' сек.');exit;

			return $this->render('index');
		}
		
		public function actionAbout()
		{
			$message = 'About';
			return $this->render('about', compact('message'));
		}
	}
