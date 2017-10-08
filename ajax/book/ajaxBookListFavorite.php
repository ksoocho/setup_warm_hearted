<?php
include("../db.php");

//escape variables for security
$user_id   = mysqli_real_escape_string($db, $_POST['user_id']);

// SQL
$sql = "SELECT 'A' as gb,
			cb.book_id, 
		    cb.book_name, 
		    cb.book_descr, 
		    cu.user_name,
		    cb.view_count,
            ( select count(*)
              from cks_page_tbl cp
              where cp.book_id = cb.book_id ) AS page_count				
		 FROM cks_book_tbl cb
			  ,cks_user_tbl cu	
		 WHERE cu.user_id = cb.owner_user_id
		  AND   cb.owner_user_id = $user_id
		UNION
		SELECT  'B' as gb,
			cb.book_id, 
		    cb.book_name, 
		    cb.book_descr, 
		    cu.user_name,
		    cb.view_count,
            ( select count(*)
              from cks_page_tbl cp
              where cp.book_id = cb.book_id ) AS page_count				
		FROM cks_book_tbl cb
			,cks_user_tbl cu	
			,cks_book_favorite_tbl cbf		   
		WHERE cu.user_id = cb.owner_user_id
		AND   cb.book_id = cbf.book_id
		and   cb.owner_user_id <> $user_id
		AND   cbf.user_id = $user_id
		ORDER BY 1 ASC, 6 DESC
	   ";

$result = mysqli_query($db, $sql) or die("Error in Selecting " . mysqli_error($db));

while($row =mysqli_fetch_assoc($result))
{
	$user_name = $row['user_name']."/".$row['page_count']."개";
	
	$bookListlArray[] = array(
	  'book_id'       => $row['book_id'],
	  'book_name'     => $row['book_name'],
	  'book_descr'    => $row['book_descr'],
	  'user_name'     => $user_name,
	  'view_count'    => $row['view_count']
	);
}

echo json_encode($bookListlArray);

//close the db connection
mysqli_close($db);

?>