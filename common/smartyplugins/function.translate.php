<?php
/**
 * Smarty plugin
 *
 * @package    Smarty
 * @subpackage PluginsFunction
 */

/**
 * Smarty {translate} function plugin
 * Type:     function<br>
 * Name:     translate<br>
 * Purpose:  translate target message for yii framework
 *
 * @author FenghuiLee <i@lifenghui.cn>
 *
 * @param array                    $params   parameters
 * @param Smarty_Internal_Template $template template object
 *
 * @return string|null
 */
function smarty_function_translate($params, $template)
{
	$target = (!empty($params['target'])) ? $params['target'] : strtolower(Yii::app()->getController()->getAction()->id);
	$msg = (!empty($params['msg'])) ? $params['msg'] : null;
	$param = (isset($params['param'])) ? $params['param'] : array();
	if ($target && $msg) {
		return Yii::t($target,$msg,$param);
	}
    return null;
}
