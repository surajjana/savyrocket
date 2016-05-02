<?php  

error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE);
require_once("conf/constants.php");
session_start();
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

	$conn = mysql_connect(HOST, USER, PASSWORD);
	if(! $conn )
	{
	  die('Could not connect: ' . mysql_error());
	}

	mysql_select_db(DB);

	$sql = "select seller from books where book_id=".$_GET['id'];

	$retval = mysql_query( $sql, $conn );

	if(! $retval )
	{
	  die('Could not get data: ' . mysql_error());
	}

	$row = mysql_fetch_array($retval, MYSQL_ASSOC);

	$seller = $row['seller'];

	$sql = "insert into orders(o_id,book_id,status,user,seller) values('',".$_GET['id'].",0,'".$_SESSION['fb_user']."','".$seller."')";

	$retval = mysql_query( $sql, $conn );

	if(! $retval )
	{
	  die('Could not get data: ' . mysql_error());
	}

	mysql_close();

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

}



?>