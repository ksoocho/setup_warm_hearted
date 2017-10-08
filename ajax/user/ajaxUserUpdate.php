<?php
include("../db.php");

//escape variables for security
$user_id         = mysqli_real_escape_string($db, $_POST['user_id']);
$user_name       = mysqli_real_escape_string($db, $_POST['user_name']);
$user_email      = mysqli_real_escape_string($db, $_POST['user_email']);

$sql=" UPDATE cks_user_tbl
       SET user_name = '$user_name',
	       user_email = '$user_email'
       WHERE user_id = $user_id  
	 ";

if (!mysqli_query($db,$sql)) {
  die('Error: ' . mysqli_error($db));
}

if (mysql_affected_rows() > 0){
	echo $user_id;
} else {
	echo 0;
}

mysqli_close($db);
?>