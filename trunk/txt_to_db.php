<?php
set_time_limit(13600);  //设置时间
$conn=mysql_connect('localhost','root','goodlusslulu'); //连接数据库
mysql_select_db('renren',$conn);
mysql_query("SET NAMES utf8");

$fp_in = fopen('D:/xh-2.txt', "r");
while (!feof($fp_in)) {
    $line = fgets($fp_in);
    $u=explode('	', $line);
	//echo trim($u[0]);
	//echo '&nbsp;&nbsp;&nbsp;';
	//echo trim($u[1]);
	//echo '<hr>';
    //mysql_query("INSERT INTO `user` (email,pwd) VALUES('".trim($u[0])."','".trim($u[1])."')",$conn);
}
echo 'OK';
?>