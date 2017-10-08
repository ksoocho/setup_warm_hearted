<?php
include("../db.php");

// username and password sent from Form
$book_id    = mysqli_real_escape_string($db,$_POST['book_id']); 
$page       = mysqli_real_escape_string($db,$_POST['page']); 

$per_page   = 50;
$start      = ( $page - 1 ) * $per_page;

$sql = "SELECT word_type, 
			   word_id, 
			    (select a.article_type from cks_photo_tbl a where a.photo_id = word_id) as article_type,		
			   IF(IFNULL(page_title,' ') = ' ', '제목없음', page_title) as page_title, 
			   page_no,
               @ROWNUM := @ROWNUM + 1 AS row_no			   
	   FROM cks_page_tbl,
             (SELECT @ROWNUM := 0) R	   
	   WHERE book_id = $book_id
	   ORDER BY page_no
	           ,word_type
			   ,article_type
			   ,page_title
               ,word_id			   
	   LIMIT $start, $per_page ";

$result = mysqli_query($db, $sql) or die("Error in Selecting " . mysqli_error($db));

while($row =mysqli_fetch_assoc($result))
{
	$word_type     = $row['word_type'];
	$word_id       = $row['word_id'];
	$article_type  = $row['article_type'];
	$page_no       = $row['page_no'];
	$row_no        = $row['row_no'];

	switch ($article_type) {
	  case "WORD":
        $page_title  = "[글] ".$row['page_title'];
		break;
	  case "MESSAGE":
        $page_title  = "[메세지] ".$row['page_title'];
		break;
	  case "POEM":
        $page_title  = "[시] ".$row['page_title'];
		break;
	  case "STORY":
        $page_title  = "[이야기] ".$row['page_title'];
		break;
	  case "OLD":
        $page_title  = "[고전] ".$row['page_title'];
		break;
	  case "MOVIE":
        $page_title  = "[영화] ".$row['page_title'];
		break;
	  case "PHOTO":
        $page_title  = "[이미지] ".$row['page_title'];
		break;
	  default:
        $page_title  = $row['page_title'];
	} 	

	if ( $word_type != "STD" ){
		$page_title  = $row['page_title'];
	}
		
	$pageListlArray[] = array(
	  'word_type'     => $word_type,
	  'word_id'       => $word_id,
	  'page_title'    => $page_title,
	  'page_no'       => $page_no,
	  'row_no'        => $row_no 
	);
}

echo json_encode($pageListlArray);

//close the db connection
mysqli_close($db);

?>