<?php

namespace app\modules\admin\controllers;

use Yii;
use yii\web\Controller;
use app\common\controllers\BaseAdminController;
use app\common\models\Category;
use app\common\models\Article;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;

class SetupController extends BaseAdminController
{	
	public function actionGeneral()
	{
		$app = Yii::$app;
		$request = $app->request;
		if ($request->getIsDelete()){
			$post = $request->post();
			$article = Article::findOne($post['id']);
			$article->status = 0;
			$result = array();
			if ($article->save())
				$result['code']=0;
			else
				$result['code']=1;
			exit(json_encode($result));
		} else {
			$page = !empty($get['page']) ? (is_numeric($get['page']) ? intval($get['page']) : 1) : 1;
			$size = !empty($get['size']) ? (is_numeric($get['size']) ? intval($get['size']) : 10) : 10;
			$articleList = Article::getArticleList();
			$this->smartyAssign('articleList',$articleList);
			$categoryList = Category::getCategoryList();
			$this->smartyAssign('categoryList',$categoryList);
			$this->showHtml();
		}
	}
	
	public function actionAjax()
	{
		$app = Yii::$app;
		$request = $app->request;
		$result = array();
		if ($request->getIsAjax()){
			$post = $request->post();
			switch ($cmd = $post['cmd']) {
				case 'isAliasExist':
					$article = Article::findOne($post['condition']);
					if ($article)
						$result['code'] = 1;
					else
						$result['code'] = 0;
					break;
				default:
					break;
			}
			exit(json_encode($result));
		} else {
			exit(json_encode('Bad Request!'));
		}
	}
}