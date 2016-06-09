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

if(strcmp($_SESSION["fb_user"],"NA") == 0 || strlen($_SESSION["fb_user"]) == 0){
    ob_start(); // ensures anything dumped out will be caught

    // do stuff here
    $url = DOMAIN.'invalid_login.php'; // this can be set based on whatever

    // clear out the output buffer
    while (ob_get_status()) 
    {
        ob_end_clean();
    }

    // no redirect
    header( "Location: $url" );
}else{

	$sql = "insert into bid(b_id,book_id,user,b_amount,b_time) values('',".$_GET['book_id'].",'".$_SESSION['fb_user']."','".$_GET['bid_val']."','".time()."')";

	$retval = mysql_query($sql, $conn);

	ob_start(); // ensures anything dumped out will be caught

	// do stuff here
	$url = DOMAIN.'bid_it.php?id='.$_GET['book_id']; // this can be set based on whatever

	// clear out the output buffer
	while (ob_get_status()) 
	{
	    ob_end_clean();
	}

	// no redirect
	header( "Location: $url" );
}
?>