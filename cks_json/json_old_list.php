<?
header('Content-type: application/json');

include "./cks_db.php.inc";

//mysql_query(" set names euckr ");

 $sql=" SELECT sum(case article_detail_type when 'DDG'  then 1 else 0 end ) ddg_count,  ".
                 "        sum(case article_detail_type when 'JANG'  then 1 else 0 end ) jang_count, ".
                 "        sum(case article_detail_type when 'NON'  then 1 else 0 end ) non_count, ".
                 "        sum(case article_detail_type when 'ROOT' then 1 else 0 end ) root_count, ".
                 "        sum(case article_detail_type when 'MSBG' then 1 else 0 end ) msbg_count, ".
                 "        sum(case article_detail_type when 'ETC'  then 1 else 0 end ) etc_count   ".
                 " FROM cks_photo_tbl ".
                 " WHERE article_type =  'OLD' ";

$rs=mysql_query($sql,$db_connect);

$arr = array();

while($obj = mysql_fetch_object($rs)) {
$arr[] = $obj;
}
echo $_GET['jsoncallback'] . '(' . json_encode($arr) . ');';
?>
