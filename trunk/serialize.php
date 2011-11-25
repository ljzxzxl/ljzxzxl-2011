<?php
$a=array('data'=>"hi", aaaa);
$b=serialize($a);
echo $b;  //这个就是描述过的数组但在这里是一个字符串而已
?>