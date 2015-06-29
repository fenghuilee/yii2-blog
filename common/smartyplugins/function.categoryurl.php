<?php
/**
 * Smarty plugin
 *
 * @package    Smarty
 * @subpackage PluginsFunction
 */

/**
 * Smarty {categoryurl} function plugin
 * Type:     function<br>
 * Name:     categoryurl<br>
 * Purpose:  get a friendly url path
 *
 * @author FenghuiLee <i@lifenghui.cn>
 *
 * @param array                    $params   parameters
 * @param Smarty_Internal_Template $template template object
 *
 * @return string|null
 */
function smarty_function_categoryurl($params, $template)
{
	$category = (!empty($params['category'])) ? $params['category'] : null;
	$target = (!empty($params['target'])) ? $params['target'] : 'video';
	if ($category) {
		return sprintf('%s/category/%s%s',$target,urlencode(base64_encode(urlencode($category))),Yii::app()->urlManager->urlSuffix);
	}
    return null;
}
