<?php
include("../db.php");

//escape variables for security
$book_name       = mysqli_real_escape_string($db, $_POST['book_name']);
$book_descr      = mysqli_real_escape_string($db, $_POST['book_descr']);
$owner_user_id   = mysqli_real_escape_string($db, $_POST['user_id']);

$sql="INSERT INTO cks_book_tbl
     (book_name,
	  book_descr,
	  owner_user_id,
	  book_status)
     VALUES 
	 ('$book_name', 
	  '$book_descr', 
	  '$owner_user_id', 
	  'NEW')";

if (!mysqli_query($db,$sql)) {
  die('Error: ' . mysqli_error($db));
}

$book_id = mysqli_insert_id($db);

if(mysqli_affected_rows($db) > 0){
   echo $book_id;
}else{
   echo 0;
}

mysqli_close($db);
?>