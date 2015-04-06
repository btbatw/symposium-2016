<?php	

$servername = "btbatworg.ipagemysql.com";
$username = "btbatw";
$password = "btbatw123";
$dbname = "btba";
//$link = mysql_connect('localhost', 'root'); 
$link = mysql_connect($servername, $username, $password); 

if (!$link) { 
	die('Could not connect: ' . mysql_error()); 
} 
//echo 'Connected successfully'; 
mysql_query("set names 'utf8'");
mysql_select_db($dbname);
?>
