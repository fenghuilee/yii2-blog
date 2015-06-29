<?php

namespace app\common\models;

use Yii;
use yii\db\ActiveRecord;

class Category extends ActiveRecord
{
	const STATUS_DELETED = -1;
	const STATUS_INACTIVE = 0;
    const STATUS_ACTIVE = 1;
	
	public static function tableName()
    {
        return '{{%category}}';
    }

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [

        ];
    }

    /**
     * @return a list of scenarios and the corresponding active attributes.
     */
    public function scenarios()
    {
        return [
			'default' => [],
            'new' => ['pid', 'name', 'intro', 'alias'],
        ];
    }

    /**
     * Relations
     */
    public function getParent()
    {
        return $this->hasOne(Category::className(), ['id' => 'pid'])
			->where(['status' => self::STATUS_ACTIVE]);
    }
	
    public function getArticles()
    {
        return $this->hasMany(Article::className(), ['cid' => 'id'])
			->with('category','user')
			->orderBy('id desc')
			->where(['status' => Article::STATUS_ACTIVE]);
    }
	
    /**
     * getCategory()
     *
     * @return Category|null
     */
    public static function getCategory($alias)
    {
		$category = static::find()->where(['alias' => $alias])->one();
        return $category;
    }

    /**
     * getCategoryList()
     *
     * @return Category|null
     */
    public static function getCategoryList()
    {
		$list = static::find()->asArray()
				->with('parent')
				->where(['status' => self::STATUS_ACTIVE])
				->all();
        return $list;
    }
	
    /**
     * getCategoryArticleList()
     *
     * @return Article|null
     */
    public static function getCategoryArticleList($alias,$page=1,$size=10)
    {
		$list = [];
		$category = static::find()->asArray()
				->where('alias = :alias', [':alias' => $alias])
				->one();
		$list['total'] = Article::find()
				->where('cid = :cid', [':cid' => $category['id']])
				->count();
		$list['articles'] = Article::find()->asArray()
				->where('cid = :cid', [':cid' => $category['id']])
				->limit($size)
				->offset(($page-1)*$size)
				->orderBy('id desc')
				->all();
        return $list;
    }
}
