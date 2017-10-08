<?php
include("../db.php");

//escape variables for security
$book_id         = mysqli_real_escape_string($db, $_POST['book_id']);
$book_name       = mysqli_real_escape_string($db, $_POST['book_name']);
$book_descr      = mysqli_real_escape_string($db, $_POST['book_descr']);

$sql="UPDATE cks_book_tbl
      SET book_name = '$book_name',
   	      book_descr = '$book_descr'
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