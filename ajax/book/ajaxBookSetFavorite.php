<?php
include("../db.php");

//escape variables for security
$user_id = mysqli_real_escape_string($db, $_POST['user_id']);
$book_id = mysqli_real_escape_string($db, $_POST['book_id']);

//----------------------------------
// Book Favorite Insert
//----------------------------------
$sql="INSERT INTO cks_book_favorite_tbl
	 (user_id,
	  book_id,
	  check_date)
	 VALUES 
	 ($user_id, 
	  $book_id, 
	  sysdate()
	  )";

if (!mysqli_query($db,$sql)) {
  die('Error: ' . mysqli_error($db));
}

if(mysqli_affected_rows($db) > 0){
   $return_code = "S";
} else {
   $return_code = "E";
}   	  

//----------------------------------
// Book Favorite Count Update
//----------------------------------
if ( $return_code == 'S') {	  
	$sql1="UPDATE cks_book_tbl cb
		  SET view_count = ( select count(*)
                             from cks_book_favorite_tbl cbf
                             where cbf.book_id = cb.book_id ) 
		  WHERE cb.book_id = $book_id
		  ";

	if (!mysqli_query($db,$sql1)) {
		  die('Error: ' . mysqli_error($db));
	}

	if(mysqli_affected_rows($db) > 0){
	   $db->commit();	
	   echo $user_id;
	}else{
	   echo 0;
	}
	

} else {
    echo 0;	
}


mysqli_close($db);

?>