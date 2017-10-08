<?
header('Content-type: application/json');

include "./cks_db.php.inc";

//mysql_query(" set names euckr ");

 $sql=" SELECT sum(case article_type when 'WORD'  then 1 else 0 end ) word_count,  ".
                 "        sum(case article_type when 'POEM'  then 1 else 0 end ) poem_count, ".
                 "        sum(case article_type when 'OLD'  then 1 else 0 end ) old_count, ".
                 "        sum(case article_type when 'MOVIE' then 1 else 0 end ) movie_count, ".
                 "        sum(case article_type when 'PHOTO' then 1 else 0 end ) photo_count, ".
                 "        sum(case article_type when 'MESSAGE' then 1 else 0 end ) message_count, ".
                 "        sum(case article_type when 'VIDEO' then 1 else 0 end ) video_count, ".
                 "        sum(case article_type when 'MUSIC' then 1 else 0 end ) music_count, ".
                 "        sum(case article_type when 'BOOK'  then 1 else 0 end ) book_count   ".
                 " FROM cks_photo_tbl WHERE 1 ";

$rs=mysql_query($sql,$db_connect);

$arr = array();

while($obj = mysql_fetch_object($rs)) {
$arr[] = $obj;
}
echo $_GET['jsoncallback'] . '(' . json_encode($arr) . ');';
?>
