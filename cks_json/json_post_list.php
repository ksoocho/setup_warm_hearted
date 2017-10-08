<?
header('Content-type: application/json');

include "./cks_db.php.inc";

//mysql_query(" set names euckr ");

$sql="select post_title, post_content, post_date 
      from cks_post_tbl 
	  order by post_id desc";

$rs=mysql_query($sql,$db_connect);

$arr = array();

while($obj = mysql_fetch_object($rs)) {
$arr[] = $obj;
}
echo $_GET['jsoncallback'] . '(' . json_encode($arr) . ');';
?>
