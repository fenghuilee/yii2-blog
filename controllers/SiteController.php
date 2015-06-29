<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\common\controllers\BaseWebController;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use app\common\models\Category;
use app\common\models\Article;

class SiteController extends BaseWebController
{
    public function actionIndex()
    {
		Yii::$app->smarty->debugging = false;
		Yii::$app->smarty->caching = true;
		Yii::$app->smarty->cache_lifetime = 60*60*24;
		if (!$this->isHtmlCached()) {
			$recentArticleList = Article::getRecentArticleList(5);
			static::smartyAssign('recentArticleList',$recentArticleList);
			$categoryList = Category::getCategoryList();
			static::smartyAssign('categoryList',$categoryList);
		}
		$this->showHtml();
        //return $this->render('index');
    }
	
    public function actionCategory()
    {
		$app = Yii::$app;
		$request = $app->request;
		$get = $request->get();
		
		$getString = $_SERVER['QUERY_STRING'];
		parse_str($getString, $getArray);
		$getUrl = $request->pathInfo;
		static::smartyAssign('getArray',$getArray);
		static::smartyAssign('getUrl',$getUrl);
		$alias = $get['alias'];
		$category = Category::getCategory($alias);
		
		if ($category) {
			$page = !empty($get['page']) ? (is_numeric($get['page']) ? intval($get['page']) : 1) : 1;
			$size = !empty($get['size']) ? (is_numeric($get['size']) ? intval($get['size']) : 10) : 10;
			static::smartyAssign('page',$page);
			static::smartyAssign('size',$size);
			$categoryArticleList = Category::getCategoryArticleList($alias,$page,$size);
			static::smartyAssign('category',$category);
			static::smartyAssign('categoryArticleList',$categoryArticleList);
			$recentArticleList = Article::getRecentArticleList(5);
			static::smartyAssign('recentArticleList',$recentArticleList);
			$categoryList = Category::getCategoryList();
			static::smartyAssign('categoryList',$categoryList);
			$this->showHtml();
		} else {
			$this->show404();
		}
    }

    public function actionArticle()
    {
		$app = Yii::$app;
		$request = $app->request;
		$get = $request->get();
		$alias = $get['alias'];
		$article = Article::getArticle($alias);
		if ($article && $article['status']===1) {
			static::smartyAssign('article',$article);
			$this->showHtml();
		} else {
			$this->show404();
		}
    }
}
