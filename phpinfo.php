<?php
print_r($_SERVER);
echo "<hr>";
print_r($SERVER_SOFTWARE);
echo "<hr>";
$con = mysql_connect("localhost", "root", "goodlusslulu");
echo "MySQL server info: " . mysql_get_server_info($con);
echo "<hr>";
phpinfo();
?>