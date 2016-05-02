<?php  
error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE);
require_once("conf/constants.php");

session_start();

$conn = mysql_connect(HOST, USER, PASSWORD);
if(! $conn )
{
  die('Could not connect: ' . mysql_error());
}

mysql_select_db(DB);

$book_img = DOMAIN_SELLER.'books/'.$_FILES['book_img']['name'];

$sql = "insert into reviews(r_id,name,review,rating,time,book_id) values('','".$_POST['name']."','".$_POST['review']."','','".(string)time()."',".$_POST['book_id'].")";

$retval = mysql_query( $sql, $conn );

if(! $retval )
{
  die('Could not get data: ' . mysql_error());
}


mysql_close($conn);

ob_start(); // ensures anything dumped out will be caught

      // do stuff here
$url = DOMAIN.'detail.php?id='.$_POST['book_id']; // this can be set based on whatever

// clear out the output buffer
while (ob_get_status()) 
{
    ob_end_clean();
}

// no redirect
header( "Location: $url" );
?>