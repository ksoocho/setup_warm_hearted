<?
header('Content-type: application/json');

include "./cks_db.php.inc";

//mysql_query(" set names euckr ");

$sql="select photo_id ".
     "from cks_photo_tbl ".
     "where article_type = 'MESSAGE' ".
     "and photo_name IS NOT NULL ".
     "order by RAND() LIMIT 1";

$rs=mysql_query($sql,$db_connect);

$arr = array();

while($obj = mysql_fetch_object($rs)) {
$arr[] = $obj;
}
echo $_GET['jsoncallback'] . '(' . json_encode($arr) . ');';
?>
