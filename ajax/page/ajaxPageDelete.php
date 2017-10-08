<?php
include("../db.php");

//escape variables for security
$book_id      = mysqli_real_escape_string($db, $_POST['book_id']);
$word_type    = mysqli_real_escape_string($db, $_POST['word_type']);
$word_id      = mysqli_real_escape_string($db, $_POST['word_id']);

$sql="DELETE FROM cks_page_tbl
	  WHERE book_id = $book_id
      AND   word_type = '$word_type'
	  AND   word_id = $word_id
	  "	;

if (!mysqli_query($db,$sql)) {
  die('Error: ' . mysqli_error($db));
}

if(mysqli_affected_rows($db) > 0){
	echo $word_id;
}else{
	echo 0;
}

mysqli_close($db);
?>