<?php
$shop_ids = '1,2,3,4';
$shop_ids = explode(',',$shop_ids);
print_r($shop_ids);
foreach($shop_ids as $key=>$value){
echo $shop_id = $value;
}


echo "<hr/>";

echo md5("zxl123456");
echo "<br/>";
echo md5("ZXL123456");

date_default_timezone_set("PRC");
echo "<hr/>";
echo filemtime("test.php");
echo "<br>";
echo "Last modified: ".date("Y-m-d  H:i:s",filemtime("test.php"));

echo "<hr/>";
echo md5("123456");

?>