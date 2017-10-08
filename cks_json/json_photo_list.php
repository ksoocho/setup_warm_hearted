<?
header('Content-type: application/json');

include "./cks_db.php.inc";

//mysql_query(" set names euckr ");

 $sql=" SELECT sum(case article_detail_type when 'INSPIRATION'  then 1 else 0 end ) inspire_count,  ".
                 "        sum(case article_detail_type when 'FACE'  then 1 else 0 end ) face_count, ".
                 "        sum(case article_detail_type when 'NATURE'  then 1 else 0 end ) nature_count, ".
                 "        sum(case article_detail_type when 'ANIMAL' then 1 else 0 end ) animal_count, ".
                 "        sum(case article_detail_type when 'PLANT' then 1 else 0 end ) plant_count, ".
                 "        sum(case article_detail_type when 'FLOWER' then 1 else 0 end ) flower_count, ".
                 "        sum(case article_detail_type when 'UNIVERSE' then 1 else 0 end ) universe_count, ".
                 "        sum(case article_detail_type when 'HOUSE' then 1 else 0 end ) house_count, ".
                 "        sum(case article_detail_type when 'FUN' then 1 else 0 end ) fun_count, ".
                 "        sum(case article_detail_type when 'INSECT'  then 1 else 0 end ) insect_count   ".
                 " FROM cks_photo_tbl ".
                 " WHERE article_type =  'PHOTO' ";

$rs=mysql_query($sql,$db_connect);

$arr = array();

while($obj = mysql_fetch_object($rs)) {
$arr[] = $obj;
}
echo $_GET['jsoncallback'] . '(' . json_encode($arr) . ');';
?>
