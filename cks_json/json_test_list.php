<?

$szDBHost = "mysql.3owl.com";
$szDBName = "u867955381_cks";
$szDBUser = "u867955381_cks";
$szDBPass = "ksoo7928";

if(!$db_connect = mysql_connect($szDBHost,$szDBUser,$szDBPass)) exit;

if(!mysql_select_db($szDBName,$db_connect))       exit;

//mysql_query(" set names euckr ");

$sql="select photo_id, photo_name, photo_title,photo_content from cks_photo_tbl where article_type = 'WORD' order by photo_id";

$rs=mysql_query($sql,$db_connect);

$arr = array();

while($obj = mysql_fetch_object($rs)) {
$arr[] = $obj;
}
echo '{"members":'.json_encode($arr).'}';

?>
