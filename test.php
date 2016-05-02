<?php  

error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE);
require_once("conf/constants.php");

$file = fopen("data/books.json","r");

$filesize = filesize("data/books.json");
$filetext = fread( $file, $filesize );

fclose($file);

$data = json_decode($filetext, true);

$conn = mysql_connect(HOST, USER, PASSWORD);
if(! $conn )
{
  die('Could not connect: ' . mysql_error());
}

mysql_select_db(DB);

for($i=65;$i<66;$i++){
	$book_img = DOMAIN_SELLER.'books/'.$i.'.jpg';

	echo $data["books"][$i]["name"];

	$sql = "insert into books(book_id,name,author,publication,category,isbn,price,description,seller,book_img,sale_bid,bid_duration,bid_price,time_added,time_modified) values('','".str_replace('\'','\\\'',$data["books"][$i]["name"]).
	"','".$data["books"][$i]["author"]."','".$data["books"][$i]["publication"]."','".str_replace('\'','\\\'',$data["books"][$i]["category"])."','".$data["books"][$i]["isbn"].
	"','".$data["books"][$i]["price"]."','".str_replace('\'','\\\'',$data["books"][$i]["description"])."','flyingbook','".$book_img.
	"',0,'','','".(string)time()."',0)";

	$retval = mysql_query( $sql, $conn );

	if(! $retval )
	{
	  die('Could not get data: ' . mysql_error());
	}

	/*echo nl2br("Inserted : ".$data["books"][$i]["name"]."\n");*/
	/*echo nl2br($i."\n");*/
}

echo 'Inserted';

?>