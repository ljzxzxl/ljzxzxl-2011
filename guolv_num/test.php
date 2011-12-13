<?php
$str = "束带1结13218381256发沈2德3孚加拉塞15618381256克的发生地方021-20151399桑德菲杰";

echo shield_num($str);

/**
 * 过滤字符串中的手机及电话号码
 * 
 * @access public
 * @param string $str 需要过滤的字符串
 * 
 * @return string
 */
function shield_num($str)
{
	if(!empty($str)){
		$str=preg_replace("/@[\w-]+(\.[\w-]+)+/","******",$str);
		$str=preg_replace("/^1(3|5)\d{9}/","******",$str);
		$str=preg_replace("/(\d{3}\-|\d{4}\-)?(\d{8}|\d{7})/","******",$str);
		return $str;
	}else{
		return false;
	}
}

?>