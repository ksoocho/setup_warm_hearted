<?php
include("../db.php");

//escape variables for security
$book_id   = mysqli_real_escape_string($db, $_POST['book_id']);
$photo_id  = mysqli_real_escape_string($db, $_POST['photo_id']);

$sql="UPDATE cks_book_tbl
      SET photo_id = $photo_id
	  WHERE book_id = $book_id
	  ";

if (!mysqli_query($db,$sql)) {
  die('Error: ' . mysqli_error($db));
}

if(mysqli_affected_rows($db) > 0)
{
	$db->commit();
	echo $book_id;
} else {
	echo 0;
}

mysqli_close($db);
?>