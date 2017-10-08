<?
include("../db.php");

//escape variables for security
$book_id      = mysqli_real_escape_string($db, $_POST['book_id']);
$word_type    = mysqli_real_escape_string($db, $_POST['word_type']);
$word_id      = mysqli_real_escape_string($db, $_POST['word_id']);

if ( $word_type == 'STD') {
	$sql="SELECT photo_title, 
				 photo_name, 
				 url_link, 
				 photo_content
		  FROM cks_photo_tbl
		  WHERE photo_id = $word_id
		  "	;
}	 

if ( $word_type == 'PER') {
	$sql="SELECT word_title as photo_title, 
				 NULL as photo_name, 
				 NULL as url_link, 
				 word_content as photo_content
		  FROM cks_per_word_tbl
		  WHERE word_id = $word_id
		  "	;
}	 
 
$result = mysqli_query($db, $sql) or die("Error in Selecting " . mysqli_error($db));

while($row =mysqli_fetch_assoc($result))
{
    $photo_title   = $row['photo_title'];
    $photo_name    = $row['photo_name'];
    $url_link      = $row['url_link'];
    $photo_content = $row['photo_content'];
}

$prev_flag = 'N';
$next_flag = 'N';
$word_id_temp = 0;
$word_id_first = 0;
$word_id_last = 0;
$word_id_prev = 0;
$word_id_next = 0;
$rec_count = 0;
			
$sql_page = "SELECT word_id,
				  (SELECT a.article_type 
				   FROM cks_photo_tbl a 
				   WHERE a.photo_id = word_id) AS article_type,	
				  IF(IFNULL(page_title,' ') = ' ', '제목없음', page_title) AS page_title, 
				  page_no
			FROM cks_page_tbl
			WHERE book_id = $book_id
			AND   word_type = '$word_type'
			ORDER BY page_no       asc
					,word_type     asc
					,article_type  asc
					,page_title    asc
                    ,word_id	   asc ";

$result_page = mysqli_query($db, $sql_page) or die("Error in Selecting " . mysqli_error($db));

while($row_page =mysqli_fetch_assoc($result_page))
{

    $rec_count = $rec_count + 1; 
	
    $word_id_temp   = $row_page['word_id'];

	if ( $rec_count == 1 ){
		$word_id_first = $word_id_temp;
	} else {
		$word_id_last = $word_id_temp;
	}
	
    if ( $next_flag == 'Y') {
		$word_id_next = $word_id_temp;
	    $next_flag = 'N';
	} 

	if ( $word_id ==  $word_id_temp )  {
	   $next_flag = 'Y';
	   $prev_flag = 'Y';
    }

    if ( $prev_flag == 'N') {
		$word_id_prev = $word_id_temp;
	} 
   
 }

 if ( $word_id_prev == 0 ) {
	 $word_id_prev = $word_id_first;
 }
 
 if ( $word_id_next == 0 ) {
	 $word_id_next = $word_id_last;
 }
 
			
$pageArray[] = array(
  'photo_title'   => $photo_title,
  'photo_name'    => $photo_name,
  'url_link'      => $url_link,
  'photo_content' => $photo_content,
  'word_id_prev'  => $word_id_prev,
  'word_id_next'  => $word_id_next
);

echo json_encode($pageArray);

mysqli_close($db);
?>
