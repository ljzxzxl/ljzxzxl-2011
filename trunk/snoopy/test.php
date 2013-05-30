<?php
require_once('Snoopy/Snoopy.class.php');
 
$url = 'http://zhuangxiu.jia.com/';
$snoopy = new Snoopy();

$start = time() + microtime();
$start_t = microtime(true); //加入true,microtime输出为浮点值
$snoopy->fetch($url);
$end_t = microtime(true);
$end = time() + microtime();
$timer = $end - $start;
$totaltime = $end_t - $start_t;
echo "页面加载时间为： ".$totaltime." 秒";
echo "<br/>".round($timer*100/5,2);
print_r($snoopy->response_code);
//echo $snoopy->results;
?>