<?
$username="dbUsername"; 
$password="dbPassword"; 
$database="dbDatebase";
$host="dbHost";

mysql_connect($host,$username,$password);
@mysql_select_db($database) or die( "Unable to select database");
?>
