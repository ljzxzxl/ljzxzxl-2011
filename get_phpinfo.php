<?php

function getOS($strAgent){
$os = false;
if(eregi('win',$strAgent) && strpos($strAgent,'95')){
$os = 'Windows 95';
} else if(eregi('win 9x',$strAgent) && strpos($strAgent,'4.90')){
$os = 'Windows ME';
} else if(eregi('win',$strAgent) && eregi('98',$strAgent)){
$os = 'Windows 98';
} else if(eregi('win',$strAgent) && eregi('nt 6.0',$strAgent)){
$os = 'Windows Vista';
} else if(eregi('win',$strAgent) && eregi('nt 5.2',$strAgent)){
$os = 'Windows 2003 Server';
} else if(eregi('win',$strAgent) && eregi('nt 5.1',$strAgent)){
$os = 'Windows XP';
} else if(eregi('win',$strAgent) && eregi('nt 5',$strAgent)){
$os = 'Windows 2000'; 
} else if(eregi('win',$strAgent) && eregi('nt',$strAgent)){ 
$os = 'Windows NT'; 
} else if(eregi('win',$strAgent) && eregi('32',$strAgent)){
$os = 'Windows 32';
} else if(eregi('linux',$strAgent)){ 
$os = 'Linux';
} else if(eregi('unix',$strAgent)){
$os = 'Unix';
} else if(eregi('sun',$strAgent) && eregi('os',$strAgent)){
$os = 'SunOS';
} else if(eregi('ibm',$strAgent) && eregi('os',$strAgent)){
$os = 'IBM OS/2'; 
} else if(eregi('mac',$strAgent) && eregi('pc',$strAgent)){
$os = 'Macintosh';
} else if(eregi('powerpc',$strAgent)){
$os = 'PowerPC';
} else if(eregi('aix',$strAgent)){
$os = 'AIX'; 
} else if(eregi('HPUX',$strAgent)){
$os = 'HPUX'; 
} else if(eregi('netbsd',$strAgent)){
$os = 'NetBSD'; 
} else if(eregi('bsd',$strAgent)){ 
$os = 'BSD';
} else if(eregi('OSF1',$strAgent)){ 
$os = 'OSF1'; 
} else if(eregi('IRIX',$strAgent)){ 
$os = 'IRIX'; 
} else if(eregi('FreeBSD',$strAgent)){ 
$os = 'FreeBSD'; 
} else if(eregi('teleport',$strAgent)){ 
$os = 'teleport';
} else if(eregi('flashget',$strAgent)){
$os = 'flashget';
} else if(eregi('webzip',$strAgent)){ 
$os = 'webzip'; 
} else if(eregi('offline',$strAgent)){ 
$os = 'offline'; 
} else{
$os = 'Unknown OS';
} 
return $os;
}

$Agent = $_SERVER['HTTP_USER_AGENT'];
echo getOS($Agent);

?>