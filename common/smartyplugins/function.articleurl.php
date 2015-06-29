<?php
/**
 * Smarty plugin
 *
 * @package    Smarty
 * @subpackage PluginsFunction
 */

/**
 * Smarty {articleurl} function plugin
 * Type:     function<br>
 * Name:     articleurl<br>
 * Purpose:  get a friendly url path
 *
 * @author FenghuiLee <i@lifenghui.cn>
 *
 * @param array                    $params   parameters
 * @param Smarty_Internal_Template $template template object
 *
 * @return string|null
 */
function smarty_function_articleurl($params, $template)
{
	$article = (!empty($params['article'])) ? $params['article'] : null;
	$target = (!empty($params['target'])) ? $params['target'] : 'video';
	if ($article) {
		return sprintf('%s/archive/%s%s',$target,$article->id,Yii::app()->urlManager->urlSuffix);
	}
    return null;
}
