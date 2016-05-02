<?php  
error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE);
require_once("conf/constants.php");

$conn = mysql_connect(HOST, USER, PASSWORD);
if(! $conn )
{
  die('Could not connect: ' . mysql_error());
}

mysql_select_db(DB);

$sql = "insert into user values('".$_POST['uname']."','".$_POST['email']."','".$_POST['phone']."','".$_POST['address']."','".$_POST['pwd']."')";

$retval = mysql_query( $sql, $conn );

if(! $retval )
{
  die('Could not get data: ' . mysql_error());
}


mysql_close($conn);

echo '<center><h2>Registration Complete</h2><br /><a href="home.php">Click Here</a></center>';

?>