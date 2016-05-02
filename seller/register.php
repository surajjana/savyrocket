<?php  
error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE);
require_once("../conf/constants.php");

$conn = mysql_connect(HOST, USER, PASSWORD);
if(! $conn )
{
  die('Could not connect: ' . mysql_error());
}

mysql_select_db(DB);

$sql = "insert into seller values('".$_POST['sname']."','".$_POST['email']."','".$_POST['phone']."','".$_POST['address']."','".$_POST['pwd']."','".$_POST['pan']."')";

$retval = mysql_query( $sql, $conn );

if(! $retval )
{
  die('Could not get data: ' . mysql_error());
}


mysql_close($conn);

$to = $_POST['email'];
$subject = 'Welcome To Flying Book';

$message = "<html><body>
                <p>Welcome ".$_POST['sname']."!!</p>
                <p>We are glad to have you on Flying Book.</p><br /><br />
                <p>Thank you,</p>
                <p>Flying Book Team</p>
                ";

$headers  = 'MIME-Version: 1.0' . "\r\n";
                $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
                $headers .= 'From: Flying Book <noreply@flyingbook.com>' . "\r\n";

mail($to,$subject,$message,$headers);

echo '<center><h2>Registration Complete</h2><br /><a href="index.html">Click Here To Log In</a></center>';

?>