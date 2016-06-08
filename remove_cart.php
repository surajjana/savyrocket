<?php  

error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE);
require_once("conf/constants.php");

$conn = mysql_connect(HOST, USER, PASSWORD);
if(! $conn )
{
  die('Could not connect: ' . mysql_error());
}

mysql_select_db(DB);

$sql = "delete from orders where book_id=".$_GET['id']." and user='".$_GET['user']."'";

$retval = mysql_query( $sql, $conn );

if(! $retval )
{
  die('Could not get data: ' . mysql_error());
}

ob_start(); // ensures anything dumped out will be caught

  // do stuff here
$url = DOMAIN.'cart.php'; // this can be set based on whatever

// clear out the output buffer
while (ob_get_status()) 
{
    ob_end_clean();
}

// no redirect
header( "Location: $url" );

?>