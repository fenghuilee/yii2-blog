<?php
/**
 * Smarty plugin
 *
 * @package    Smarty
 * @subpackage PluginsFunction
 */

/**
 * Smarty {href} function plugin
 * Type:     function<br>
 * Name:     href<br>
 * Purpose:  get a friendly url path
 *
 * @author FenghuiLee <i@lifenghui.cn>
 *
 * @param array                    $params   parameters
 * @param Smarty_Internal_Template $template template object
 *
 * @return string|null
 */
function smarty_function_href($params, $template)
{
	return yii\helpers\Url::toRoute($params['route']);
}
