<?php
$urlToEncode="http://bbs.lewanchina.com";
generateQRfromGoogle($urlToEncode);
function generateQRfromGoogle($chl,$widhtHeight ='150',$EC_level='L',$margin='0')
{
 $url = urlencode($url); 
 echo '<img src="http://chart.apis.google.com/chart?chs='.$widhtHeight.'x'.$widhtHeight.'&cht=qr&chld='.$EC_level.'|'.$margin.'&chl='.$chl.' " alt="QR code" widhtHeight="'.$size.'" widhtHeight="'.$size.'"/>';
}
?>