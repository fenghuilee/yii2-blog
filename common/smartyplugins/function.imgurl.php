<?php
/**
 * Smarty plugin
 *
 * @package    Smarty
 * @subpackage PluginsFunction
 */

/**
 * Smarty {imgurl} function plugin
 * Type:     function<br>
 * Name:     imgurl<br>
 * Purpose:  get a friendly url path
 *
 * @author FenghuiLee <i@lifenghui.cn>
 *
 * @param array                    $params   parameters
 * @param Smarty_Internal_Template $template template object
 *
 * @return string|null
 */
function smarty_function_imgurl($params, $template)
{
	$url = (!empty($params['url'])) ? $params['url'] : null;
	$cover = (!empty($params['cover'])) ? $params['cover'] : null;
	if ($url&&$cover) {
		$ext = ZUtils::getFileExtension($cover);
		return sprintf('/uploads/images/%s/%s.%s',substr(md5($cover),0,2),urlencode(base64_encode(urlencode($url.$cover))),$ext);
	}
    return null;
}