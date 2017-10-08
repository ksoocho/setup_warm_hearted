<?php
include("../db.php");

//escape variables for security
$user_name       = mysqli_real_escape_string($db, $_POST['user_name']);

$sql = "SELECT user_id 
			   'S' as return_code 
	   FROM cks_user_tbl
	   WHERE user_name = '$user_name' ";

$result = mysqli_query($db, $sql) or die("Error in Selecting " . mysqli_error($db));

$row = mysqli_fetch_assoc($result);

if ( $row['return_code'] == 'S')
{
    echo "Already User Name";	
} else {
    echo 'S'	
}

mysqli_close($db);
?>