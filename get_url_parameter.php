<?php
$c='';
$m='';
$url='http://localhost/dbs/Code/site_manage/index.php?c=company&m=company_add&areaflag=shanghai';
$ddd=parse_url($url);
//print_r($ddd);
$dd=parse_str($ddd['query']);
echo $c.$m;
exit();
?>