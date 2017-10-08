<?php
include("../db.php");

//escape variables for security
$book_id      = mysqli_real_escape_string($db, $_POST['book_id']);
$word_type    = mysqli_real_escape_string($db, $_POST['word_type']);
$word_id      = mysqli_real_escape_string($db, $_POST['word_id']);


$sql="SELECT page_title
            ,page_no
			,post_script
      FROM cks_page_tbl
	  WHERE book_id = $book_id
      AND   word_type = '$word_type'
	  AND   word_id = $word_id
	  "	;

$result = mysqli_query($db, $sql) or die("Error in Selecting " . mysqli_error($db));

while($row =mysqli_fetch_assoc($result))
{
    $page_title  = $row['page_title'];
    $page_no     = $row['page_no'];
    $post_script = $row['post_script'];

}

if ( $word_type == 'PER') {
	
	$sql1="SELECT word_content
		  FROM cks_per_word_tbl
		  WHERE word_id = $word_id
		  "	;

	$result1 = mysqli_query($db, $sql1) or die("Error in Selecting " . mysqli_error($db));

	while($row1 =mysqli_fetch_assoc($result1))
	{
		$post_script = $row1['word_content'];
	}
		  
}	 


$pageArray[] = array(
  'page_title'    => $page_title,
  'page_no'       => $page_no,
  'post_script'   => $post_script
);


echo json_encode($pageArray);

mysqli_close($db);
?>