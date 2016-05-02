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


$sql = "update books set name='".$_POST["name"]."',author='".$_POST["author"]."',publication='".$_POST["pub"]."',category='".$_POST["cat"]."',isbn='".$_POST["isbn"]."',price='".$_POST["price"]."',description='".$_POST["description"]."',sale_bid=".$_POST["sale_bid"].",bid_duration='".$_POST["bid_duration"]."',bid_price='".$_POST["bid_price"]."',time_modified='".(string)time()."' where book_id=".$_POST['book_id'];

$retval = mysql_query( $sql, $conn );

if(! $retval )
{
  die('Could not get data: ' . mysql_error());
}


mysql_close($conn);

echo '<center><h2>Book Sale Modified</h2><br /><a href="dashboard.php">Click Here</a></center>';

?>