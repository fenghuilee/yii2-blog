<?php
/**
 * Smarty plugin
 *
 * @package    Smarty
 * @subpackage PluginsModifier
 */

/**
 * Smarty array2string modifier plugin
 * Type:     modifier<br>
 * Name:     array2string<br>
 * Purpose:  string to array
 *
 * @author FenghuiLee <i@lifenghui.cn>
 *
 * @param array input array
 *
 * @return string
 */
function smarty_modifier_array2string($array)
{
	if ($string) {
		return ZUtils::array2string($array);
	}
    return null;
}
