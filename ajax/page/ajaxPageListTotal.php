<?php
include("../db.php");

$book_id  = mysqli_real_escape_string($db,$_POST['book_id']); 

$sql = "select count(*) as total_count
	   from cks_page_tbl 
	   where book_id = '$book_id'
	   ";

$result = mysqli_query($db, $sql) or die("Error in Selecting " . mysqli_error($db));

$row =mysqli_fetch_assoc($result);

echo $row['total_count'];

mysqli_close($db);

?>