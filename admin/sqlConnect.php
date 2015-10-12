<?
$username="simensamuelsen_"; 
$password="Lc9Q2tCt"; 
$database="simensamuelsen_";
$host="localhost";

mysql_connect($host,$username,$password);
@mysql_select_db($database) or die( "Unable to select database");
?>
