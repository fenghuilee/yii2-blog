<?php

namespace app\common\controllers;

use Yii;
use yii\web\Controller;
use yii\helpers\VarDumper;

class BaseController extends Controller
{
	public function init()
    {
        Yii::$app->smarty->init();
        parent::init();
    }
	
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }
	
	public function beforeAction($action)
	{
		if (!parent::beforeAction($action)) {
			return false;
		}
		if($action->id!='error' && Extension_Loaded('zlib'))
			Ob_Start('ob_gzhandler');
		return true;
	}
	
	public function afterAction($action, $result)
	{
		$result = parent::afterAction($action, $result);
		if($action->id!='error' && Extension_Loaded('zlib'))
			Ob_End_Flush();
		return $result;
	}
	
	public function smartyHtml($tag=null,$suffix='.html')
	{
		$controllerName = $this->id;
		$actionName = $this->action->id;
		if ($tag)
			$html = $controllerName.'.'.$actionName.'.'.$tag.$suffix;
		else
			$html = $controllerName.'.'.$actionName.$suffix;
        return strtolower($html);
    }
	
	public static function smartyAssign($key, $value) {
		Yii::$app->smarty->assign($key, $value);
	}
	
	public static function smartyDisplay($view) {
		Yii::$app->smarty->display($view);
	}
	
	public static function smartyIsCached($view) {
		return Yii::$app->smarty->isCached($view);
	}
	
	public static function dump($var, $depth = 10, $highlight = true) {
		VarDumper::dump($var, $depth, $highlight);
	}
	
	public static function show404() {
		header("HTTP/1.1 404 Not Found");
		header("Status: 404 Not Found");
		static::smartyDisplay('404.html');
	}
}
