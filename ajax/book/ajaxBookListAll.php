<?php
include("../db.php");

// SQL
$sql = "SELECT cb.book_id, 
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
	   ORDER BY  5 DESC, 6 DESC
	   ";

$result = mysqli_query($db, $sql) or die("Error in Selecting " . mysqli_error($db));

while($row =mysqli_fetch_assoc($result))
{

    if ( $row['page_count'] > 0 ) {
		
		$user_name = $row['user_name']."/".$row['page_count']."개";

		$bookListlArray[] = array(
		  'book_id'       => $row['book_id'],
		  'book_name'     => $row['book_name'],
		  'book_descr'    => $row['book_descr'],
		  'user_name'     => $user_name,
		  'view_count'    => $row['view_count']
		);
		
	}
}

echo json_encode($bookListlArray);

//close the db connection
mysqli_close($db);

?>