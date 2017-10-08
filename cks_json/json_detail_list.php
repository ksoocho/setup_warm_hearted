<?
header('Content-type: application/json');

include "./cks_db.php.inc";


$item_type = $_GET["itemType"];

$sql=" select photo_id, article_type, photo_title, upload_date, view_count ".
     " from cks_photo_tbl ". 
     " where article_type = '".$item_type."' ".
     " order by photo_id desc ";

   
$rs=mysql_query($sql,$db_connect);

$arr = array();

while($obj = mysql_fetch_object($rs)) {
$arr[] = $obj;
}
echo $_GET['jsoncallback'] . '(' . json_encode($arr) . ');';
?>
