<?php
include("../db.php");

//escape variables for security
$book_id      = mysqli_real_escape_string($db, $_POST['book_id']);
$word_type    = mysqli_real_escape_string($db, $_POST['word_type']);
$word_id      = mysqli_real_escape_string($db, $_POST['word_id']);

$page_title = " ";

if ( $word_type == 'STD') {
	
	$sql = "SELECT IFNULL(photo_title,'#') as photo_title, 
				   'S' as return_code 
			FROM cks_photo_tbl
			WHERE photo_id = $word_id 
		   ";

	$result = mysqli_query($db, $sql) or die("Error in Selecting " . mysqli_error($db));

	$row = mysqli_fetch_assoc($result);

	if ( $row['return_code'] == 'S')
	{  
		$page_title = $row['photo_title'] ;	
	} 
}

$sql1 = "INSERT INTO cks_page_tbl
		 (book_id,
		  word_type,
		  word_id,
		  page_title,
		  page_no,
		  post_script)
		 VALUES 
		 ($book_id, 
		  '$word_type', 
		  $word_id, 
		  '$page_title', 
		  999, 
		  ' ')
		  ";

if (!mysqli_query($db,$sql1)) {
  die('Error: ' . mysqli_error($db));
}

if(mysqli_affected_rows($db) > 0){
   $db->commit();
   echo $word_id;
}else{
   echo 0;
}

mysqli_close($db);
?>