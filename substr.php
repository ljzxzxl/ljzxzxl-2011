<?php
$old="substr()函数中文版 普通的substr()函数可以取得字符串的指定长度子字符串，但遇到中文时可能会在新字符串末尾产生乱码，下面这个函数将超过$len长度的字符串转换成以“...”结尾，并且去除了乱码。 ";
echo $new = getsubstring($old,10); 

function getsubstring($str,$len) 
{ 
    for($i = 0;$i <$end;$i++) 
    { 
        if ($i >=0 AND $i <$end) 
        { 
            if(ord(substr($str,$i,1)) > 0xa1)  
                $result_str.=substr($str,$i,2); 
            else 
                $result_str.=substr($str,$i,1); 
        } 
        if(ord(substr($str,$i,1)) > 0xa1) 
            $i++; 
    } 
    if(strlen($str)<=$end) 
        return $result_str; 
    else 
        return $result_str."..."; 
}
?>