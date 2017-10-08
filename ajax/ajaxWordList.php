<?php
include("./db.php");

if(isSet($_POST['itemType'])&&isSet($_POST['searchStr'])&&isSet($_POST['page']))
{
	// username and password sent from Form
	$item_type  = mysqli_real_escape_string($db,$_POST['itemType']); 
	$search_str = mysqli_real_escape_string($db,$_POST['searchStr']); 
	$page       = mysqli_real_escape_string($db,$_POST['page']); 
	
	$per_page   = 10;
	$start      = ( $page - 1 ) * $per_page;
 
	$sql = "select photo_id, 
				  article_type, 
				  photo_title, 
				  upload_date, 
				  view_count 
		   from cks_photo_tbl 
		   where article_type = '$item_type'
		   and   photo_title like '%$search_str%'
		   order by photo_id desc 
		   LIMIT $start, $per_page ";

	$result = mysqli_query($db, $sql) or die("Error in Selecting " . mysqli_error($db));
	
	while($row =mysqli_fetch_assoc($result))
	{
		$wordListlArray[] = array(
		  'photo_id'      => $row['photo_id'],
		  'article_type'  => $row['article_type'],
		  'photo_title'   => $row['photo_title'],
		  'upload_date'   => $row['upload_date'],
		  'view_count'    => $row['view_count']
		);
	}
	
	echo json_encode($wordListlArray);

	//close the db connection
	mysqli_close($db);
}
?>