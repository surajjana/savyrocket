<?php  

error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE);
require_once("conf/constants.php");
session_start();

/*$conn = mysql_connect(HOST, USER, PASSWORD);
if(! $conn )
{
  die('Could not connect: ' . mysql_error());
}

mysql_select_db(DB);

$sql = "select * from books where sale_bid=1 order by time_added desc limit 0,3";
$retval = mysql_query( $sql, $conn );

if(! $retval )
{
  die('Could not get data: ' . mysql_error());
}*/

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

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

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
                    <!-- <li>
                        <a class="page-scroll" href="#about">About</a>
                    </li> -->
                    <li>
                        <a href="bid.php">Bidding</a>
                    </li>
                    <li>
                        <a href="vl.php">Virtual Library</a>
                    </li>
                    <li>
                        <a class="page-scroll" href="#contact">Contact</a>
                    </li>
                    <?php  
                        if(strcmp($_SESSION["fb_user"],"NA") == 0 || strlen($_SESSION["fb_user"]) == 0){
                            echo '<li>
                        <a class="page-scroll" href="cart.php">
                            <i class="fa fa-cart-plus fa-2x"></i>
                        </a>
                    </li>
                    <li>
                        <a href="login.php">Log In</a>
                    </li>';
                }else{
                    echo '<li>
                        <a class="page-scroll" href="cart.php">
                            <i class="fa fa-cart-plus fa-2x"></i>
                        </a>
                    </li>
                    <li>
                        <a href="profile.php">'.$_SESSION['fb_user'].'</a>
                    </li>
                    <li>
                        <a href="logout.php">Logout</a>
                    </li>';
                }?>
                    
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container-fluid -->
    </nav>

    <section id="services">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2 class="section-heading">Books</h2>
                    <hr class="primary">
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <?php  
                    /*while($row = mysql_fetch_array($retval, MYSQL_ASSOC)){
                        echo '<div class="col-lg-4 col-md-6 text-center touch-anchor" style:"max-height:100px;">
                    <a href="#" class="books-div" style="text-decoration:none;">
                    <div class="service-box">
                        <img src="'.$row['book_img'].'" style="width:50%;">
                        <h3>'.$row['name'].'</h3>
                        <p class="text-muted">Author : '.$row['author'].'</p>
                        <p class="text-muted">Price : '.$row['price'].'</p>
                    </div>
                    </a>
                </div>';
                    }*/
                ?>
                <div class="col-lg-4 col-md-6 text-center touch-anchor">
                    <a href="vl/st/index.html" class="books-div" style="text-decoration:none;">
                    <div class="service-box">
                        <img src="./vl/st/bg1.png" style="width:50%;">
                        <h3>Software Testing</h3>
                        <!-- <p class="text-muted">Author</p>
                        <p class="text-muted">Price</p> -->
                    </div>
                    </a>
                </div>
                <div class="col-lg-4 col-md-6 text-center touch-anchor">
                    <a href="vl/ai/index.html" class="books-div" style="text-decoration:none;">
                    <div class="service-box">
                        <img src="./vl/ai/target/0639d671c236a9d83288f256d7f9c8fc.png" style="width:50%;">
                        <h3>Gender Detection Using Gait</h3>
                        <!-- <p class="text-muted">Author</p>
                        <p class="text-muted">Price</p> -->
                    </div>
                    </a>
                </div>
                <!-- <div class="col-lg-4 col-md-6 text-center touch-anchor">
                    <a href="#" class="books-div" style="text-decoration:none;">
                    <div class="service-box">
                        <img src="./seller/book/25.jpg" style="width:50%;">
                        <h3>Name</h3>
                        <p class="text-muted">Author</p>
                        <p class="text-muted">Price</p>
                    </div>
                    </a>
                </div>
                <div class="col-lg-4 col-md-6 text-center touch-anchor">
                    <a href="#" class="books-div" style="text-decoration:none;">
                    <div class="service-box">
                        <img src="./seller/book/26.jpg" style="width:50%;">
                        <h3>Name</h3>
                        <p class="text-muted">Author</p>
                        <p class="text-muted">Price</p>
                    </div>
                    </a>
                </div>
                <div class="col-lg-4 col-md-6 text-center touch-anchor">
                    <a href="#" class="books-div" style="text-decoration:none;">
                    <div class="service-box">
                        <img src="./seller/book/27.jpg" style="width:50%;">
                        <h3>Name</h3>
                        <p class="text-muted">Author</p>
                        <p class="text-muted">Price</p>
                    </div>
                    </a>
                </div>
                <div class="col-lg-4 col-md-6 text-center touch-anchor">
                    <a href="#" class="books-div" style="text-decoration:none;">
                    <div class="service-box">
                        <img src="./seller/book/28.jpg" style="width:50%;">
                        <h3>Name</h3>
                        <p class="text-muted">Author</p>
                        <p class="text-muted">Price</p>
                    </div>
                    </a>
                </div>
                <div class="col-lg-4 col-md-6 text-center touch-anchor">
                    <a href="#" class="books-div" style="text-decoration:none;">
                    <div class="service-box">
                        <img src="./seller/book/29.jpg" style="width:50%;">
                        <h3>Name</h3>
                        <p class="text-muted">Author</p>
                        <p class="text-muted">Price</p>
                    </div>
                    </a>
                </div> -->
                
                
            </div>
        </div>
    </section>

    

    <section id="footer">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <p>Copyright &copy; SRA 2016</p>
                </div>
            </div>
        </div>
    </section>

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
