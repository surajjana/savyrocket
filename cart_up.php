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

	$sql_user = "select email from user where uname='".$_SESSION['fb_user']."'";

	$retval_user = mysql_query( $sql_user, $conn );

	$row_user = mysql_fetch_array($retval_user, MYSQL_ASSOC);

	$sql_book = "select * from books where book_id=".$_GET['id'];

	$retval_book = mysql_query( $sql_book, $conn );

	$row_book = mysql_fetch_array($retval_book, MYSQL_ASSOC);

	$to = $row_user['email'];
	$subject = '[Orders] Flying Book';

	$message = "<html><body>
	                <p>Hello ".$_SESSION['fb_user']." !!</p>
	                <p>Following products in cart :</p>
	                <p>Name : ".$row_book['name']."</p>
	                <p>Author : ".$row_book['author']."</p>
	                <p>Price : ".$row_book['price']."</p>
	                <br /><br />
	                <p>Thank you,</p>
	                <p>Flying Book Team</p>
	                ";

	$headers  = 'MIME-Version: 1.0' . "\r\n";
	                $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
	                $headers .= 'From: Flying Book <noreply@flyingbook.com>' . "\r\n";

	mail($to,$subject,$message,$headers);

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