<?php  
set_time_limit(0);  
function MakePropertyValue($name,$value,$osm){  
$oStruct = $osm->Bridge_GetStruct
("com.sun.star.beans.PropertyValue");  
$oStruct->Name = $name;  
$oStruct->Value = $value;  
return $oStruct;  
}  
function word2pdf($doc_url, $output_url){  
$osm = new COM("com.sun.star.ServiceManager") 
or die ("Please be sure that OpenOffice.org 
is installed.\n");  
$args = array(MakePropertyValue("Hidden",true,$osm));  
$oDesktop = $osm->createInstance("com.sun.star
.frame.Desktop");  
$oWriterDoc = $oDesktop->loadComponentFromURL
($doc_url,"_blank", 0, $args);  
$export_args = array(MakePropertyValue
("FilterName","writer_pdf_Export",$osm));  
$oWriterDoc->storeToURL($output_url,$export_args);  
$oWriterDoc->close(true);  
}  
$output_dir = "D:/AppServ/www/2011/word-pdf";  
$doc_file = "D:/AppServ/www/2011/word-pdf/RTX.doc";  
$pdf_file = "RTX.pdf";  
$output_file = $output_dir . $pdf_file;  
$doc_file = "file:///" . $doc_file;  
$output_file = "file:///" . $output_file;  
word2pdf($doc_file,$output_file);  
?>