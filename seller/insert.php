<?php  
error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE);
require_once("../conf/constants.php");

session_start();

if(isset($_FILES['book_img'])){
      $errors= array();
      $file_name = $_FILES['book_img']['name'];
      $file_size =$_FILES['book_img']['size'];
      $file_tmp =$_FILES['book_img']['tmp_name'];
      $file_type=$_FILES['book_img']['type'];
      $file_ext=strtolower(end(explode('.',$_FILES['book_img']['name'])));
      
      $expensions= array("jpeg","jpg","png");
      
      if(in_array($file_ext,$expensions)=== false){
         $errors[]="extension not allowed, please choose a JPEG or PNG file.";
      }
      
      if($file_size > 2097152){
         $errors[]='File size must be excately 2 MB';
      }
      
      if(empty($errors)==true){
         move_uploaded_file($file_tmp,"books/".$file_name);
         /*echo "Success";*/
      }else{
         print_r($errors);
      }
   }

$conn = mysql_connect(HOST, USER, PASSWORD);
if(! $conn )
{
  die('Could not connect: ' . mysql_error());
}

mysql_select_db(DB);

$book_img = './seller/books/'.$_FILES['book_img']['name'];

$sql = "insert into books(book_id,name,author,publication,category,isbn,price,description,seller,book_img,sale_bid,bid_duration,bid_price,time_added,time_modified) values('','".$_POST["name"].
	"','".$_POST["author"]."','".$_POST["pub"]."','".$_POST["cat"]."','".$_POST["isbn"].
	"','".$_POST["price"]."','".$_POST["description"]."','".$_SESSION["fb_seller"]."','".$book_img.
	"',".$_POST["sale_bid"].",'".$_POST["bid_duration"]."','".$_POST["bid_price"]."','".(string)time()."',0)";

$retval = mysql_query( $sql, $conn );

if(! $retval )
{
  die('Could not get data: ' . mysql_error());
}


mysql_close($conn);

echo '<center><h2>Book Sale Added</h2><br /><a href="dashboard.php">Click Here</a></center>';

?>