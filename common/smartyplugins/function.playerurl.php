<?php
/**
 * Smarty plugin
 *
 * @package    Smarty
 * @subpackage PluginsFunction
 */

/**
 * Smarty {playerurl} function plugin
 * Type:     function<br>
 * Name:     playerurl<br>
 * Purpose:  get a friendly url path
 *
 * @author FenghuiLee <i@lifenghui.cn>
 *
 * @param array                    $params   parameters
 * @param Smarty_Internal_Template $template template object
 *
 * @return string|null
 */
function smarty_function_playerurl($params, $template)
{
	$article = (!empty($params['article'])) ? $params['article'] : null;
	$tag = (!empty($params['tag'])) ? $params['tag'] : 'link';
	$index = (!empty($params['index'])) ? intval($params['index']) : 0;
	if ($article) {
		return sprintf('video/player/%s_%s_%s%s',$article->id,$tag,$index,Yii::app()->urlManager->urlSuffix);
	}
    return null;
}
