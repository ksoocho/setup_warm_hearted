<?php
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'ksoocho');
define('DB_PASSWORD', 'cks13837!');
define('DB_DATABASE', 'ksoocho');

$db = mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE);

if (mysqli_connect_errno())
{
 echo "connection was not established" . mysqli_connect_error();
}
?>