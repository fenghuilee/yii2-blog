<?php

namespace app\common\controllers;

use Yii;
use yii\web\Controller;
use app\common\controllers\BaseController;
use app\common\models\User;
use app\common\models\Article;

class BaseAdminController extends BaseController
{
	public function init()
    {
        parent::init();
		Yii::$app->smarty->themePath = '@app/modules/admin/';
		Yii::$app->smarty->themeName = 'views';
		Yii::$app->smarty->init();
    }
	
	public function beforeAction($action)
	{
		//预先传递模块ID、控制器ID和动作ID给Smarty
			$moduleName = $this->module->id;
			$controllerName = $this->id;
			$actionName = $this->action->id;
			$this->smartyAssign("moduleName", strtolower($moduleName));
			$this->smartyAssign("controllerName", strtolower($controllerName));
			$this->smartyAssign("actionName", strtolower($actionName));
		//csrfToken
			$csrfToken = array(
				'name'=>Yii::$app->request->csrfParam,
				'value'=>Yii::$app->request->csrfToken,
			);
			$this->smartyAssign('csrfToken',$csrfToken);
		//User信息
			if (!Yii::$app->user->isGuest) {
				$admin = User::findIdentity(Yii::$app->user->id);
				$this->smartyAssign('admin',$admin);
			}
		//激活的文章数量
			$activeArticleCount = Article::getArticleCount(Article::STATUS_DELETED,'>');
			$this->smartyAssign('activeArticleCount',$activeArticleCount);
        return parent::beforeAction($action);
    }
	
	public function showHtml($tag=null,$suffix='.html')
	{
		$controllerName = $this->id;
		$actionName = $this->action->id;
		if ($tag)
			$html = $controllerName.'.'.$actionName.'.'.$tag.$suffix;
		else
			$html = $controllerName.'.'.$actionName.$suffix;
        static::smartyDisplay(strtolower($html));
    }
	
	public function goAdminHome()
	{
		return Yii::$app->getResponse()->redirect(['admin/index']);
    }
}
