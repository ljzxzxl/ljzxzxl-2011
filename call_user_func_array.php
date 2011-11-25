<?php
function a($b, $c) 
{
echo $b;
echo $c;
}
call_user_func_array('a', array("111", "222"));
//显示 111 222
?>