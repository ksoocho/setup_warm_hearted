<?php
include("../db.php");

//username and password sent from Form
$user_code = mysqli_real_escape_string($db,$_POST['usercode']); 
$user_pwd  = mysqli_real_escape_string($db,$_POST['password']); 

$sql = "SELECT user_id, 
			   user_name, 
			   default_book_id,
			   'S' as return_code 
	   FROM cks_user_tbl
	   WHERE user_code = '$user_code'
	   AND   AES_DECRYPT(UNHEX(user_pwd), 'warmheart') =  '$user_pwd' ";

$result = mysqli_query($db, $sql) or die("Error in Selecting " . mysqli_error($db));

$row = mysqli_fetch_assoc($result);

if ( $row['return_code'] == 'S')
{	
	$userArray[] = array(
	  'user_id'       => $row['user_id'],
	  'user_name'     => $row['user_name'],
	  'book_id'       => $row['default_book_id'],
	  'return_code'   => $row['return_code']
	);
	
} else {
	
	$userArray[] = array(
	  'user_id'       => 0,
	  'user_name'     => ' ',
	  'book_id'       => 0,
	  'return_code'   => 'E'
	);
	
}

echo json_encode($userArray);

//close the db connection
mysqli_close($db);

?>