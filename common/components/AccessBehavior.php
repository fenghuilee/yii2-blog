<?php

/*
 * In configuration file
 * ...
 * 'as AccessBehavior' => [
 *    'class' => '\app\components\AccessBehavior'
 * ]
 * ...
 * (c) Artem Voitko <r3verser@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace app\common\components;

use yii\base\Behavior;
use yii\console\Controller;
use yii\helpers\Url;

/**
 * Redirects all users to login page if not logged in
 *
 * Class AccessBehavior
 * @package app\components
 * @author  Artem Voitko <r3verser@gmail.com>
 */
class AccessBehavior extends Behavior
{
    /**
     * Subscribe for events
     * @return array
     */
    public function events()
    {
        return [
            Controller::EVENT_BEFORE_ACTION => 'beforeAction'
        ];
    }

    /**
     * On event callback
     */
    public function beforeAction()
    {
        if (
            \Yii::$app->getUser()->isGuest &&
            \Yii::$app->getRequest()->url !== Url::to(\Yii::$app->getUser()->loginUrl)
        ) {
            \Yii::$app->getResponse()->redirect(\Yii::$app->getUser()->loginUrl);
        }
    }
}

