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

	$sql = "update orders set status=1 where user='".$_SESSION['fb_user']."' and status=0";

	$retval = mysql_query( $sql, $conn );

	if(! $retval )
	{
	  die('Could not get data: ' . mysql_error());
	}

	
	mysql_close();

	echo '<center><h2>Payment Done</h2><br /><a href="home.php">Click Here</a></center>';

}



?>