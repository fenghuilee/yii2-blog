<?php
/**
 * Smarty plugin
 *
 * @package    Smarty
 * @subpackage PluginsFunction
 */

/**
 * Smarty {t} function plugin
 * Type:     function<br>
 * Name:     t<br>
 * Purpose:  translate target message for yii framework
 *
 * @author FenghuiLee <i@lifenghui.cn>
 *
 * @param array                    $params   parameters
 * @param Smarty_Internal_Template $template template object
 *
 * @return string|null
 */
function smarty_function_t($params, $template)
{
	$target = (!empty($params['target'])) ? $params['target'] : strtolower(Yii::app()->getController()->getAction()->id);
	$text = (!empty($params['text'])) ? $params['text'] : null;
	$param = (isset($params['param'])) ? $params['param'] : array();
	if ($target && $text) {
		return Yii::t($target,$text,$param);
	}
    return null;
}
