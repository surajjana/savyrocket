<?php  
error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE);
require_once("../conf/constants.php");

$conn = mysql_connect(HOST, USER, PASSWORD);
if(! $conn )
{
  die('Could not connect: ' . mysql_error());
}

mysql_select_db(DB);

$sql = "SELECT pwd FROM seller WHERE sname='".$_POST['uname']."'";

$retval = mysql_query( $sql, $conn );

if(! $retval )
{
  die('Could not get data: ' . mysql_error());
}

$row = mysql_fetch_array($retval, MYSQL_ASSOC);

if($row['pwd']){
	if(strcmp($row['pwd'],$_POST['pwd']) == 0)
    {
    	session_start();
    	$_SESSION["fb_seller"] = $_POST['uname'];
    	ob_start(); // ensures anything dumped out will be caught

		// do stuff here
		$url = DOMAIN_SELLER.'dashboard.php'; // this can be set based on whatever

		// clear out the output buffer
		while (ob_get_status()) 
		{
		    ob_end_clean();
		}

		// no redirect
		header( "Location: $url" );
    }else{
    	ob_start(); // ensures anything dumped out will be caught

		// do stuff here
		$url = DOMAIN_SELLER.'invalid_login.php'; // this can be set based on whatever

		// clear out the output buffer
		while (ob_get_status()) 
		{
		    ob_end_clean();
		}

		// no redirect
		header( "Location: $url" );
    }
}else{
	ob_start(); // ensures anything dumped out will be caught

	// do stuff here
	$url = DOMAIN_SELLER.'invalid_login.php'; // this can be set based on whatever

	// clear out the output buffer
	while (ob_get_status()) 
	{
	    ob_end_clean();
	}

	// no redirect
	header( "Location: $url" );
}
mysql_close($conn);

?>