<?

$szDBHost = "localhost";
$szDBName = "ksoocho";
$szDBUser = "ksoocho";
$szDBPass = "cks13837!";

if(!$db_connect = mysql_connect($szDBHost,$szDBUser,$szDBPass)) exit;

if(!mysql_select_db($szDBName,$db_connect))       exit;
?>