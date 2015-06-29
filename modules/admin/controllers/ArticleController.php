<?php

namespace app\modules\admin\controllers;

use Yii;
use yii\web\Controller;
use app\common\controllers\BaseAdminController;
use app\common\models\Category;
use app\common\models\Article;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;

class ArticleController extends BaseAdminController
{	
	public function actionIndex()
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
	
	public function actionNew()
	{
		$app = Yii::$app;
		$request = $app->request;
		if ($request->getIsPost()){
			$post = $request->post();
			$article = new Article(['scenario' => 'new']);
			$article->load($post);
			$date = date('Y-m-d H:i:s', time());
			$article->uid = $app->user->id;
			$article->create_date = $date;
			$article->modified_date = $date;
			$article->save();
			$this->refresh();
		} else {
			$categoryList = Category::getCategoryList();
			$this->smartyAssign('categoryList',$categoryList);
			$this->showHtml();
		}
	}
	
	public function actionMod()
	{
		$app = Yii::$app;
		$request = $app->request;
		$get = $request->get();
		$post = $request->post();
		$id = intval($get['id']);
		$article = Article::getArticle($id);
		if ($request->getIsPost()){
			$article->load($post);
			$date = date('Y-m-d H:i:s', time());
			$article->modified_date = $date;
			$article->save();
			$this->refresh();
		} else {
			if ($article) {
				$this->smartyAssign('article',$article);
				$categoryList = Category::getCategoryList();
				$this->smartyAssign('categoryList',$categoryList);
				$this->showHtml();
			} else {
				$this->show404();
			}
		}
	}
	
	public function actionCategory()
	{
		$app = Yii::$app;
		$request = $app->request;
		if ($request->getIsPost()){
			$post = $request->post();
			$category = new Category(['scenario' => 'new']);
			$category->load($post);
			$category->save();
			$this->refresh();
		} elseif ($request->getIsDelete()){
			$post = $request->post();
			$category = Category::findOne($post['id']);
			$category->status = 0;
			$result = array();
			if ($category->save())
				$result['code']=0;
			else
				$result['code']=1;
			exit(json_encode($result));
		} else {
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