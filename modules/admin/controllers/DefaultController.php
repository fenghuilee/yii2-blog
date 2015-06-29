<?php

namespace app\modules\admin\controllers;

use Yii;
use yii\web\Controller;
use app\common\controllers\BaseAdminController;
use app\common\models\LoginForm;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;

class DefaultController extends BaseAdminController
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }
	
	public function actionIndex()
	{
		$this->showHtml();
	}
	
	public function actionLogin()
	{
		$app = Yii::$app;
		if (!$app->user->isGuest) {
			return $this->goAdminHome();
		}
		$model = new LoginForm();
		if ($model->load($app->request->post()) && $model->login()) {
			return $this->goAdminHome();
		} else {
			$this->showHtml();
		}
	}
	
    public function actionLogout()
    {
        Yii::$app->user->logout();
        return $this->goHome();
    }
}