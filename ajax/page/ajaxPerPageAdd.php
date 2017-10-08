<?php
include("../db.php");

//escape variables for security
$book_id       = mysqli_real_escape_string($db, $_POST['book_id']);
$word_type     = mysqli_real_escape_string($db, $_POST['word_type']);
$word_title    = mysqli_real_escape_string($db, $_POST['word_title']);
$word_content  = mysqli_real_escape_string($db, $_POST['word_content']);

// Set autocommit to off
mysqli_autocommit($db,FALSE);

$sql="INSERT INTO cks_per_word_tbl
     (book_id,
	  word_type,
	  word_title,
	  word_content,
	  write_date)
     VALUES 
	 ($book_id, 
	  '$word_type', 
	  '$word_title', 
	  '$word_content', 
	  sysdate()
	  )";

if (!mysqli_query($db,$sql)) {
  die('Error: ' . mysqli_error($db));
}

$word_id = mysqli_insert_id($db);

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
		  '$word_title', 
		  99, 
		  ' ')
		  ";

if (!mysqli_query($db, $sql1)) {
  die('Error: ' . mysqli_error($db));
}

if(mysqli_affected_rows($db) > 0){
   mysqli_commit($db);
   echo $word_id;
}else{
   mysqli_rollback($db);	
   echo 0;
}

// Set autocommit to on
mysqli_autocommit($db,TRUE);

mysqli_close($db);
?>