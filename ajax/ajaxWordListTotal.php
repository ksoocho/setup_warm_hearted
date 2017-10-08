<?php
include("./db.php");

if(isSet($_POST['itemType']))
{

	$item_type  = mysqli_real_escape_string($db,$_POST['itemType']); 
	$search_str = mysqli_real_escape_string($db,$_POST['searchStr']); 
	
	$sql = "select count(*) as total_count
		   from cks_photo_tbl 
		   where article_type = '$item_type'
		   and   photo_title like '%$search_str%'
		   ";

	$result = mysqli_query($db, $sql) or die("Error in Selecting " . mysqli_error($db));
	
	$row =mysqli_fetch_assoc($result);
	
	echo $row['total_count'];

	mysqli_close($db);
}
?>