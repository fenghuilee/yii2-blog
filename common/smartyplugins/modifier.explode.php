<?php
/**
 * Smarty plugin
 *
 * @package    Smarty
 * @subpackage PluginsModifier
 */

/**
 * Smarty explode modifier plugin
 * Type:     modifier<br>
 * Name:     explode<br>
 * Purpose:  explode string to array
 *
 * @author FenghuiLee <i@lifenghui.cn>
 *
 * @param string input string
 * @param delimiter boundary string
 *
 * @return array
 */
function smarty_modifier_explode($string, $delimiter=',')
{
	if ($string) {
		return explode($delimiter,$string);
	}
    return array();
}
