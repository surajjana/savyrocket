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
}

$conn = mysql_connect(HOST, USER, PASSWORD);
if(! $conn )
{
  die('Could not connect: ' . mysql_error());
}

mysql_select_db(DB);

$sql = "select * from orders where status=0 and user='".$_SESSION['fb_user']."'";

$retval = mysql_query( $sql, $conn );

if(! $retval )
{
  die('Could not get data: ' . mysql_error());
}

$total_price = 0;

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Flying Book | A New Way Of Reading</title>

    <!-- Bootstrap Core CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css" type="text/css">

    <!-- <link rel="icon" type="image/ico" href="https://surajjana.github.io/careersensy/img/favicon.ico"/> -->


    <!-- Custom Fonts -->
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Merriweather:400,300,300italic,400italic,700,700italic,900,900italic' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">

    <!--<link rel="stylesheet" href="font-awesome/css/font-awesome.min.css" type="text/css">-->

    <!-- Plugin CSS -->
    <link rel="stylesheet" href="css/animate.min.css" type="text/css">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="css/creative.css" type="text/css">
    <
    <link href='http://fonts.googleapis.com/css?family=Lato:300,400,700,900' rel='stylesheet' type='text/css'>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <style type="text/css">
    blockquote {
  padding: 0px 8px;
  margin: 0 0 2px;
  font-size: 14.5px;
  border-left: 2px solid #ccc;
  line-height:0.6em;
}

    </style>

</head>

<body id="page-top">

    <nav id="mainNav" class="navbar navbar-default navbar-fixed-top">
        <div class="container-fluid">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.html" >Flying Book</a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right">
                    <li>
                        <a class="page-scroll" href="#about">About</a>
                    </li>
                    <li>
                        <a class="page-scroll" href="#contact">Contact</a>
                    </li>
                    <li>
                        <a class="page-scroll" href="#">
                            <i class="fa fa-cart-plus fa-2x"></i>
                            <!-- <div style="font-size:10px;position:relative;top:-25px;left:25px;">10</div> -->
                        </a>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container-fluid -->
    </nav>

             


<div class="container">
    <div class="row">
        <div class="col-lg-5 col-md-5 col-sm-3 col-xs-2"></div>
        <div class="col-lg-4 col-md-4 col-sm-9 col-xs-10" style="position:relative; top:140px;">
            <i class="fa fa-cart-plus fa-3x" style="color:rgba(240,95,64,1);">&nbsp; Cart</i>
            <br/>
            <br/>
            <br/>
        </div>
    </div>
</div>

<div class="container">

<?php  

    while($row = mysql_fetch_array($retval, MYSQL_ASSOC)){

        $sql = "select * from books where book_id=".$row['book_id'];

        $retval_b = mysql_query( $sql, $conn );

        if(! $retval_b )
        {
          die('Could not get data: ' . mysql_error());
        }

        $row_b = mysql_fetch_array($retval_b, MYSQL_ASSOC);

        $total_price += (int)$row_b['price'];

        echo '<div class="row">
        <div class="col-lg-3 col-md-3 col-sm-4 col-xs-4"></div>
        <div class="col-lg-2 col-md-2 hidden-sm hidden-xs">
            <img src="'.$row_b['book_img'].'" style="width:65%;position:relative;top:160px;"/>
        </div>
            
        <div class="col-lg-5 col-md-5 hidden-sm hidden-xs"  style="position:relative; top:145px; ">
            <div class="row">
                <h4  style="font-family:'."'Lato'".';" >'.$row_b['name'].'</h4>
            </div>
            <div class="row">
                <h5><blockquote>Author: '.$row_b['author'].' </blockquote></h5>
            </div>
            <div class="row">
                <h5><blockquote>Publication : '.$row_b['publication'].' </blockquote></h5>
             
            </div>
          
            <div class="row">
                <h5><blockquote>Category: '.$row_b['category'].'</blockquote></h5>

            </div>
            <div class="row">
                
                <div class="col-lg-2 col-md-2">
                   <i class="fa fa-inr fa-1x" >'.$row_b['price'].'</i>
                </div>
                
                <div class="col-lg-1 col-md-1"></div>
                
                   
                <div class="col-lg-3 col-md-3">
                  <a href="remove_cart.php?user='.$_SESSION['fb_user'].'&id='.$row_b['book_id'].'" class="button1">Remove</a>
                     <br/>
                </div>
            </div>
        </div>


        <div class="col-sm-12 col-xs-12 hidden-lg hidden-md">
            <center>
                <img src="'.$row_b['book_img'].'" style="width:45%;position:relative;top:160px;"/>
            </center>
            <br/>
        </div>
            
        <div class="col-sm-12 col-xs-12 hidden-lg hidden-md text-center"  style="position:relative; top:145px; ">
            <div class="row">
                <h4  style="font-family:'."'Lato'".';" >'.$row_b['name'].'</h4>
            </div>
            
            <div class="row">
                <h5><blockquote>Author: '.$row_b['author'].' </blockquote></h5>
            </div>
            
            <div class="row">
                <h5><blockquote>Publication : '.$row_b['publication'].' </blockquote></h5>
             
            </div>
          
            <div class="row">
                <h5><blockquote>Category: '.$row_b['category'].'</blockquote></h5>

            </div>
            
            <div class="row">

                <div class="col-sm-12 col-xs-12">
                   <i class="fa fa-inr fa-1x" >'.$row_b['price'].' </i>
                </div>
                
                
                   
                <div class="col-sm-12 col-xs-12">
                  <a href="remove_cart.php?user='.$_SESSION['fb_user'].'&id='.$row_b['book_id'].'" class="button1">Remove</a>
                     <br/>
                </div>
            </div>
        </div>
    </div>
</div>

<br/>';
    }

?>
    

<section>
<br/>
<br/>
<br/>
<hr>

<div class="container">
    <div class="row">
        <div class="col-lg-7 col-md-7 hidden-sm hidden-xs"></div>
        <div class="col-lg-5  col-md-5 col-sm-12 hidden-12 text-center">
            <h4>Total Price:<i class="fa fa-inr fa-1x" ><?php echo $total_price; ?> </i></h4>
       
            <?php $_SESSION[ $_SESSION['fb_user'].'-total-price'] = $total_price; ?>
 
            <a href="buy.php"><button class="btn btn-primary">Buy All</button></a>
        </div>
    </div>
</div>
</section>






   
 

    



    


    <!-- <section id="footer">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <p>Copyright &copy; SRA 2016</p>
                </div>
            </div>
        </div>
    </section> -->

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

    <!-- Plugin JavaScript -->
    <script src="js/jquery.easing.min.js"></script>
    <script src="js/jquery.fittext.js"></script>
    <script src="js/wow.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="js/creative.js"></script>

</body>

</html>