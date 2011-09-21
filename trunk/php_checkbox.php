<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" " http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title> 获取复选框的值</title>
</head>
<body>
<form name="form1" method="post" action="php_checkbox.php">
<table width="445" cellpadding="0" cellspacing="0">
<tr>
<td width="443" height="41" align="center" valign="top">
您喜欢的图书类型:
<input type="checkbox" name="mrbook[]" value="入门类">
入门类
<input type="checkbox" name="mrbook[]" value="案例类"> 
案例类
<input type="checkbox" name="mrbook[]" value="讲解类">
讲解类
<input type="checkbox" name="mrbook[]" value="典型实例类">
典型实例类
<br>
<input type="submit" name="submit" value="提交"></td>
</tr>
</table>
</form>
<?php
if(($_POST[mrbook]!= null)){ 
echo "您选择的结果是：";
for($i = 0;$i<count($_POST[mrbook]);$i++)
echo $_POST[mrbook][$i]."&nbsp;&nbsp;"; //循环输出用户选择的图书类别
}
?>
</body>
</html>