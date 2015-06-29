<?php
/**
 * Smarty plugin
 *
 * @package    Smarty
 * @subpackage PluginsModifier
 */

/**
 * Smarty string2array modifier plugin
 * Type:     modifier<br>
 * Name:     string2array<br>
 * Purpose:  string to array
 *
 * @author FenghuiLee <i@lifenghui.cn>
 *
 * @param string input string
 *
 * @return array
 */
function smarty_modifier_string2array($string)
{
	if ($string) {
		return ZUtils::string2Array($string);
	}
    return array();
}
