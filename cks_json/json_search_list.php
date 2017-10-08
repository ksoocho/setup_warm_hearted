<?
header('Content-type: application/json');

$search_text = $_GET["search_text"];

include "./cks_db.php.inc";

//mysql_query(" set names euckr ");

$sql=" select photo_id, photo_title, upload_date, view_count ".
     " from cks_photo_tbl ".
     " where photo_title like '%$search_text%' ".
     " order by photo_id ";

$rs=mysql_query($sql,$db_connect);

$arr = array();

while($obj = mysql_fetch_object($rs)) {
$arr[] = $obj;
}
echo $_GET['jsoncallback'] . '(' . json_encode($arr) . ');';
?>
