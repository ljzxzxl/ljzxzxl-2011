<?
/*具体调用的地方，用这样的形式：<img src="/vcode.php" align="absmiddle" />就可以了；验证的时候验证session：$_SESSION['VCODE']的值就可以了*/

session_start();
//生成验证码图片
Header("Content-type: image/PNG");
$im = imagecreate(44,18);
$back = ImageColorAllocate($im, 245,245,245);
imagefill($im,0,0,$back); //背景
srand((double)microtime()*1000000);
//生成4位数字
for($i=0;$i<4;$i++){
$font = ImageColorAllocate($im, rand(100,255),rand(0,100),rand(100,255));
//$authnum=rand(0,9);
//$charset='abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';

$charset="ABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890";
$nc="1";
$len=strlen($charset)-1;
$authnum='';
while($nc-->0) $authnum.=$charset{mt_rand(0,$len)};

$vcodes.=$authnum;
imagestring($im, 5, 2+$i*10, 1, $authnum, $font);
}
for($i=0;$i<100;$i++) //加入干扰象素
{
$randcolor = ImageColorallocate($im,rand(0,255),rand(0,255),rand(0,255));
imagesetpixel($im, rand()%70 , rand()%30 , $randcolor);
}
ImagePNG($im);
ImageDestroy($im);
$_SESSION['VCODE'] = $vcodes;
?>