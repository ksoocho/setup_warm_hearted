<?
header('Content-type: application/json');

include "./cks_db.php.inc";

//mysql_query(" set names euckr ");

$like_id = $_GET["like_id"];
$article_type = $_GET["article_type"];
$article_detail_type = $_GET["article_detail_type"];


if ($like_id <> 0) { 
    $sql="select * from cks_photo_tbl where photo_id = $like_id  LIMIT 1 ";
} else {

    if ($article_type <> 'NONE') {

        if ($article_detail_type <> 'NONE' ) {
           $sql="select photo_id, photo_title, photo_name, url_link, photo_content from cks_photo_tbl where article_type = '$article_type' and article_detail_type = '$article_detail_type' order by RAND() LIMIT 1";
        } else {
           $sql="select photo_id, photo_title, photo_name, url_link, photo_content  from cks_photo_tbl where article_type = '$article_type' order by RAND() LIMIT 1";
        }

    } else {
       $sql="select photo_id, photo_title, photo_name, url_link, photo_content from cks_photo_tbl where article_type = 'WORD' order by RAND() LIMIT 1";
    }  

}
            
$rs=mysql_query($sql,$db_connect);

$arr = array();

while($obj = mysql_fetch_object($rs)) {
$arr[] = $obj;
}
echo $_GET['jsoncallback'] . '(' . json_encode($arr) . ');';
?>
