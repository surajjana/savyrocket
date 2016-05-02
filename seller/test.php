<?php  
error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE);
require_once("../conf/constants.php");


$conn = mysql_connect(HOST, USER, PASSWORD);
if(! $conn )
{
  die('Could not connect: ' . mysql_error());
}

mysql_select_db(DB);

$sql = "select * from books limit 0,50";

$retval = mysql_query( $sql, $conn );

if(! $retval )
{
  die('Could not get data: ' . mysql_error());
}

while ($row = mysql_fetch_array($retval, MYSQL_ASSOC)) {
	$b_img = explode("http://localhost/flyingbook/", $row['book_img']);
	$b_img = $b_img[1];

	$sql = "update books set book_img='".$b_img."' where book_id=".$row['book_id'];

	$retval_1 = mysql_query( $sql, $conn );
}

/*$arr = explode("http://localhost/flyingbook/", "http://localhost/flyingbook/seller/books/33.jpg");

var_dump($arr);*/

echo "Done";

mysql_close($conn);

?>