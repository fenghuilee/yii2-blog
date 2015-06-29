<?php

namespace app\common\controllers;

use Yii;
use yii\web\Controller;
use app\common\controllers\BaseController;
use app\common\models\User;

class BaseWebController extends BaseController
{
	public function beforeAction($action)
	{
		//预先传递模块ID、控制器ID和动作ID给Smarty
			$moduleName = $this->module->id;
			$controllerName = $this->id;
			$actionName = $action->id;
			static::smartyAssign("moduleName", strtolower($moduleName));
			static::smartyAssign("controllerName", strtolower($controllerName));
			static::smartyAssign("actionName", strtolower($actionName));
		//csrfToken
			$csrfToken = array(
				'name'=>Yii::$app->request->csrfParam,
				'value'=>Yii::$app->request->csrfToken,
			);
			static::smartyAssign('csrfToken',$csrfToken);
		//User信息
			if (!Yii::$app->user->isGuest) {
				$user = User::findIdentity(Yii::$app->user->id);
				static::smartyAssign('user',$user);
			}
        return parent::beforeAction($action);
    }
	
	public function isHtmlCached($tag=null,$suffix='.html')
	{
        static::smartyIsCached($this->smartyHtml($tag,$suffix));
    }
	
	public function showHtml($tag=null,$suffix='.html')
	{
        static::smartyDisplay($this->smartyHtml($tag,$suffix));
    }
}
