<?php  
error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE);
require_once("../conf/constants.php");

session_start();

$conn = mysql_connect(HOST, USER, PASSWORD);
if(! $conn )
{
  die('Could not connect: ' . mysql_error());
}

mysql_select_db(DB);

$book_img = DOMAIN_SELLER.'books/'.$_FILES['book_img']['name'];

$sql = "delete from books where book_id=".$_GET['id'];

$retval = mysql_query( $sql, $conn );

if(! $retval )
{
  die('Could not get data: ' . mysql_error());
}


mysql_close($conn);

echo '<center><h2>Book Sale Deleted</h2><br /><a href="dashboard.php">Click Here</a></center>';

?>