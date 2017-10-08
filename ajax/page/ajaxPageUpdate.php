<?php
include("../db.php");

//escape variables for security
$book_id      = mysqli_real_escape_string($db, $_POST['book_id']);
$word_type    = mysqli_real_escape_string($db, $_POST['word_type']);
$word_id      = mysqli_real_escape_string($db, $_POST['word_id']);
$page_title   = mysqli_real_escape_string($db, $_POST['page_title']);
$page_no      = mysqli_real_escape_string($db, $_POST['page_no']);
$post_script  = mysqli_real_escape_string($db, $_POST['post_script']);

// Set autocommit to off
mysqli_autocommit($db,FALSE);

if ($word_type == "STD") {

	$sql="UPDATE cks_page_tbl
		  SET page_no = $page_no,
			  page_title = '$page_title',
			  post_script = '$post_script'
		  WHERE book_id = $book_id
		  AND   word_type = '$word_type'
		  AND   word_id = $word_id
		  "	  ;

	if (!mysqli_query($db,$sql)) {
	  die('Error: ' . mysqli_error($db));
	}
		  
} else {

	$sql1="UPDATE cks_page_tbl
		  SET page_no = $page_no,
			  page_title = '$page_title'
	      WHERE book_id = $book_id
		  AND   word_type = '$word_type'
		  AND   word_id = $word_id
		  "	  ;

	if (!mysqli_query($db,$sql1)) {
	  die('Error: ' . mysqli_error($db));
	}

	$sql2="UPDATE cks_per_word_tbl
		  SET word_title = '$page_title',
			  word_content = '$post_script'
	      WHERE word_id = $word_id
		  "	  ;

	if (!mysqli_query($db,$sql2)) {
	  die('Error: ' . mysqli_error($db));
	}
		  
}

if(mysqli_affected_rows($db) > 0){
	mysqli_commit($db);
	echo $book_id;
}else{
	echo 0;
}

// Set autocommit to on
mysqli_autocommit($db,TRUE);

mysqli_close($db);
?>