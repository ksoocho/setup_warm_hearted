<?php
include("../db.php");

//escape variables for security
$user_code        = mysqli_real_escape_string($db, $_POST['user_code']);
$user_name        = mysqli_real_escape_string($db, $_POST['user_name']);
$user_pwd         = mysqli_real_escape_string($db, $_POST['user_pwd']);
$user_confirm_pwd = mysqli_real_escape_string($db, $_POST['user_confirm_pwd']);

$process_id = 0;
$return_code = "S";
$error_message = ""; 

// Check - Password	
$process_id = 100;
if ( $return_code == 'S') {
    
	if ( $user_pwd  != $user_confirm_pwd) {
	   $return_code = "E";
	   $error_message = "암호가 다릅니다".$process_id;	
	}

    if ( strlen($user_pwd) <= 4) {
	   $return_code = "E";
	   $error_message = "암호는 5자리 이상입니다-".$user_pwd."-".$process_id;	
	}
	
}

// Check - User Code Duplication
$process_id = 200;
if ( $return_code == 'S') {
	$sql1 = "SELECT user_id, 
				   'S' as return_code 
			FROM cks_user_tbl
			WHERE user_code = '$user_code' 
		   ";

	$result1 = mysqli_query($db, $sql1) or die("Error in Selecting " . mysqli_error($db));

	$row1 = mysqli_fetch_assoc($result1);

	if ( $row['return_code'] == 'S')
	{  
		$return_code = "E";
		$error_message = "이미 존재하는 아이디 입니다-".$process_id;	
	} 
}
// Check - User Name Duplication
$process_id = 300;
if ( $return_code == 'S') {
	$sql2 = "SELECT user_id, 
				   'S' as return_code 
		     FROM cks_user_tbl
		     WHERE user_name = '$user_name' 
		    ";

	$result2 = mysqli_query($db, $sql2) or die("Error in Selecting " . mysqli_error($db));

	$row2 = mysqli_fetch_assoc($result2);
	
	if ( $row2['return_code'] == 'S')
	{
       $return_code = "E";
       $error_message = "이미 존재하는 별명입니다-".$process_id;	
	} 
}	

$db->autocommit(FALSE);

$user_id = 0;
$book_id = 0;

//-----------------------------
// User Registration
//  HEX(AES_ENCRYPT('$user_pwd', 'warmheart')), 
//-----------------------------
$process_id = 400;
if ( $return_code == 'S') {
	
	$sql3="INSERT INTO cks_user_tbl
			 (user_code,
			  user_name,
			  user_pwd,
			  user_email)
			 VALUES 
			 ('$user_code', 
			  '$user_name', 
			  HEX(AES_ENCRYPT('$user_pwd', 'warmheart')),
			  'NA')";

	if (!mysqli_query($db,$sql3)) {
	  die('Error: ' . mysqli_error($db));
	}

	if(mysqli_affected_rows($db) > 0){
	   $user_id = mysqli_insert_id($db);
	   $return_code = "S";
	} else {
	   $return_code = "E";
	}   
}

//-----------------------------
// Book Insert
//-----------------------------
$process_id = 500;
if ( $return_code == 'S') {
	
	$book_name = $user_name.'의 글모음';
	$book_descr = $user_name.' 글모음입니다.';

	$sql4="INSERT INTO cks_book_tbl
		 (book_name,
		  book_descr,
		  owner_user_id,
		  book_status)
		 VALUES 
		 ('$book_name', 
		  '$book_descr', 
		  '$user_id', 
		  'NEW')
		  ";

	if (!mysqli_query($db,$sql4)) {
	  die('Error: ' . mysqli_error($db));
	}

	if(mysqli_affected_rows($db) > 0){
  	   $book_id = mysqli_insert_id($db);
	   $return_code = "S";
	}else{
	   $return_code = "E";
	}
}

$process_id = 600;
if ( $return_code == 'S') {

    $sql5="UPDATE cks_user_tbl
           SET default_book_id = $book_id
	       WHERE user_id = $user_id
	      ";

	if (!mysqli_query($db,$sql5)) {
	  die('Error: ' . mysqli_error($db));
	}

	if(mysqli_affected_rows($db) > 0){
	   $return_code = "S";
	}else{
	   $return_code = "E";
	}
}

if ( $return_code == 'S') {
    $error_message = "Book 등록 성공";	
    $db->commit();
} else {
    $error_message = "Book 등록 실패-".$process_id."-".$user_id."-".$book_id;	
	$db->rollback();
}

$db->autocommit(TRUE);

$userArray[] = array(
  'user_id'       => $user_id,
  'book_id'       => $book_id,
  'return_code'   => $return_code,
  'error_message' => $error_message
);

echo json_encode($userArray);

mysqli_close($db);
?>