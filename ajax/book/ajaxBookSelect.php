<?php
include("../db.php");

//escape variables for security
$book_id   = mysqli_real_escape_string($db, $_POST['book_id']);

// SQL
$sql = "SELECT cb.book_id, 
			   cb.book_name, 
			   cb.book_descr, 
			   cu.user_name,
               cb.view_count,
               IFNULL(cb.photo_id,0) photo_id			   
	   FROM cks_book_tbl cb
           ,cks_user_tbl cu		   
	   WHERE cu.user_id = cb.owner_user_id
	   AND   cb.book_id = $book_id
	   ";

$result = mysqli_query($db, $sql) or die("Error in Selecting " . mysqli_error($db));

while($row =mysqli_fetch_assoc($result))
{
	$bookListlArray[] = array(
	  'book_id'       => $row['book_id'],
	  'book_name'     => $row['book_name'],
	  'book_descr'    => $row['book_descr'],
	  'user_name'     => $row['user_name'],
	  'view_count'    => $row['view_count'],
	  'photo_id'      => $row['photo_id']
	);
}

echo json_encode($bookListlArray);

//close the db connection
mysqli_close($db);

?>