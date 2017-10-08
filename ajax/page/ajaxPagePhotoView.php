<?

include("../db.php");

$photo_id = mysqli_real_escape_string($db, $_GET['photo_id']);

$sql= "SELECT photo_type, 
              photo_image 
       FROM cks_photo_tbl 
	   WHERE photo_id = $photo_id
	   " ; 

$result = mysqli_query($db, $sql) or die("Error in Selecting " . mysqli_error($db));

$row =mysqli_fetch_assoc($result);

header('Content-Type: ' . $row['photo_type']);

echo $row['photo_image'];

mysqli_close($db);
?> 
