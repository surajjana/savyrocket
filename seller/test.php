<?php  
error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE);
require_once("../conf/constants.php");


$conn = mysql_connect(HOST, USER, PASSWORD);
if(! $conn )
{
  die('Could not connect: ' . mysql_error());
}

mysql_select_db(DB);

$sql = "select category from books";

$retval = mysql_query( $sql, $conn );

if(! $retval )
{
  die('Could not get data: ' . mysql_error());
}

$res = array();

while ($row = mysql_fetch_array($retval, MYSQL_ASSOC)) {
   $res[] = $row['category'];
}

print_r(array_unique($res));

mysql_close($conn);

?>