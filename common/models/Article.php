<?php

namespace app\common\models;

use Yii;
use yii\db\ActiveRecord;

class Article extends ActiveRecord
{
	const STATUS_DELETED = -1;
	const STATUS_INACTIVE = 0;
    const STATUS_ACTIVE = 1;
	
	public static function tableName()
    {
        return '{{%article}}';
    }

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
			['alias', 'unique'],
        ];
    }

    /**
     * @return a list of scenarios and the corresponding active attributes.
     */
    public function scenarios()
    {
        return [
			'default' => ['cid', 'uid', 'title', 'alias', 'keywords', 'description', 'content', 'cover', 'create_date', 'modified_date', 'status'],
            'new' => ['cid', 'title', 'alias', 'keywords', 'description', 'content', 'cover', 'status'],
        ];
    }
	
    /**
     * Scopes
     */

    /**
     * Relations
     */
    public function getCategory()
    {
        return $this->hasOne(Category::className(), ['id' => 'cid'])
			->where(['status' => Category::STATUS_ACTIVE]);
    }
	
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'uid']);
    }

    /**
     * getArticleList()
     *
     * @return Article|null
     */
    public static function getArticleList()
    {
		$list = static::find()->asArray()
				->with('category','user')
				->where(['>','status',self::STATUS_DELETED])
				->orderBy('id desc')
				->all();
        return $list;
    }
	
    /**
     * getRecentArticleList()
     *
     * @return Article|null
     */
    public static function getRecentArticleList($count)
    {
		$list = static::find()->asArray()
				->with('category','user')
				->where(['status' => self::STATUS_ACTIVE])
				->limit($count)
				->orderBy('id desc')
				->all();
        return $list;
    }

    /**
     * getArticleCount()
     *
     * @return Article|null
     */
    public static function getArticleCount($status = self::STATUS_ACTIVE, $flag = '=')
    {
		$count = static::find()->where([$flag,'status',$status])->count();
        return $count;
    }
	
    /**
     * getArticle()
     *
     * @return Article|null
     */
    public static function getArticle($parameter)
    {
		if (gettype($parameter) === 'integer')
			$where = ['id' => $parameter];
        else
			$where = ['alias' => $parameter];
		$article = static::find()->with('category','user')->where($where)->one();
		return $article;
    }
}
