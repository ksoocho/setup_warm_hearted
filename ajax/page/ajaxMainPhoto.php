<?php
header('Content-type: application/json');

include("../db.php");


$sql=" SELECT photo_id
             ,photo_title 
       FROM cks_photo_tbl
       WHERE article_type = 'PHOTO' 
       AND article_detail_type= 'MAIN' 
       ORDER BY RAND() LIMIT 1
	   ";

$result = mysqli_query($db, $sql) or die("Error in Selecting " . mysqli_error($db));

$arr = array();

while($obj = mysqli_fetch_assoc($result)) {
$arr[] = $obj;
}
echo $_GET['jsoncallback'] . '(' . json_encode($arr) . ');';

mysqli_close($db);
?>
