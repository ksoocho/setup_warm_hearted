<?
header('Content-type: application/json');

include "./cks_db.php.inc";

$sort_type = $_GET["sortType"];
$find_string = $_GET["searchString"];

//mysql_query(" set names euckr ");

if ($sort_type == "TOP") { 

   $sql=" select photo_id, article_type, photo_title, upload_date, like_count ".
        " from cks_photo_tbl ". 
        " order by like_count desc LIMIT 0, 20 ";

} else if ($sort_type == "NEW") {

   $sql=" select photo_id, article_type, photo_title, upload_date, like_count ".
        " from cks_photo_tbl ".
        " order by photo_id desc LIMIT 0, 20 ";

} else if ($sort_type == "FIND") {

   $sql=" select photo_id, article_type, photo_title, upload_date, like_count ".
        " from cks_photo_tbl ".
        " where photo_title like '%".$find_string."%' ".
        " order by photo_id desc LIMIT 0, 100 ";

} else {

   $sql="SELECT photo_id, article_type, photo_title, upload_date, like_count ".
        "FROM cks_photo_tbl ". 
        "ORDER BY like_count desc LIMIT 0, 20 ";
  
}
   
$rs=mysql_query($sql,$db_connect);

$arr = array();

while($obj = mysql_fetch_object($rs)) {
$arr[] = $obj;
}
echo $_GET['jsoncallback'] . '(' . json_encode($arr) . ');';
?>
