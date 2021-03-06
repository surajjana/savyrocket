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

$sql = "select category from books where sale_bid=0";

$retval = mysql_query( $sql, $conn );

if(! $retval )
{
  die('Could not get data: ' . mysql_error());
}

$res = array();

while ($row = mysql_fetch_array($retval, MYSQL_ASSOC)) {
   $res[] = $row['category'];
}

$cat = array_unique($res);

$sql_trending = "SELECT * FROM books WHERE sale_bid=0 ORDER BY visits DESC LIMIT 0 , 4";
$retval_trending = mysql_query( $sql_trending, $conn );

if(! $retval_trending )
{
  die('Could not get data: ' . mysql_error());
}

$sql_bid = "SELECT * FROM books WHERE sale_bid=1 ORDER BY visits DESC LIMIT 0 , 4";
$retval_bid = mysql_query( $sql_bid, $conn );

if(! $retval_bid )
{
  die('Could not get data: ' . mysql_error());
}

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
                    <li>
                        <a class="page-scroll" href="#about">About</a>
                    </li>
                    <li>
                        <a href="bid.php">Bidding</a>
                    </li>
                    <li>
                        <a href="vl.php">Virtual Library</a>
                    </li>
                    <li>
                        <a href="seller/index.html">Seller</a>
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

    <header>
        <div class="header-content">
            <div class="header-content-inner">
                <h1>Flying Book
                </h1><br />
                <h3>A New Way Of Reading</h3>
                <hr>
                <div class="row">
                <form action="books.php" method="get">
                    <div class="col-md-3"></div>
                    <div class="col-md-4">
                        <select name="cat" class="form-control">
                            <?php  
                                foreach($cat as $x){
                                    echo '<option value="'.$x.'">'.$x.'</option>';
                                }
                            ?>
                            
                        </select>
                    </div>
                    <!-- <div class="col-md-5">
                        <input type="text" class="form-control" name="uname" id="uname" placeholder="Enter Book Name">
                    </div> -->
                    <div class="col-md-2">
                        <input type="submit" class="form-control" value="Search">
                    </div>
                    <div class="col-md-3"></div>
                </form>
                </div>
                <br />
                <!-- <h3>Coming Soon</h3> -->
                <a href="#about" class="btn btn-default btn-xl page-scroll wow tada">Find Out More</a>
            </div>
        </div>
    </header>

    <section class="bg-primary" id="about">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-lg-offset-2 text-center">
                    <h2 class="section-heading">About Us</h2>
                    <hr class="light">
                    <p>Flying Book is an online retailer in India & growing e-commerce Technology Company. It offers cloud based e-commerce platform service in B2C and B2B verticals and is recognized for its innovative approach towards delivering business values and responsive to changing customer needs.</p>
                    <!-- <a href="#services" class="page-scroll btn btn-default btn-xl wow tada">Key Features!</a> -->
                </div>
            </div>
        </div>
    </section>

    <section id="services">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2 class="section-heading">Trending Books</h2>
                    <hr class="primary">
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <?php  
                    while($row = mysql_fetch_array($retval_trending, MYSQL_ASSOC)){
                        echo '<div class="col-lg-3 col-md-6 text-center touch-anchor">
                    <a href="detail.php?id='.$row['book_id'].'" class="books-div" style="text-decoration:none;">
                    <div class="service-box">
                        <img src="'.$row['book_img'].'" style="width:50%;">
                        <h3>'.$row['name'].'</h3>
                        <p class="text-muted">Author : '.$row['author'].'</p>
                        <p class="text-muted">Price : '.$row['price'].'</p>
                    </div>
                    </a>
                </div>';
                    }
                ?>
                
                
            </div>
        </div>
    </section>

    

    <aside class="bg-dark">
        <div class="container text-center">
            <div class="call-to-action">
                <h2>You have to dream before your dreams can come true. -- A.P.J Abdul Kalam</h2>
                <!--<a href="#" class="btn btn-default btn-xl wow tada">Check Now!</a>-->
            </div>
        </div>
    </aside>

    <section id="services">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2 class="section-heading">Trending Bidding</h2>
                    <hr class="primary">
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <?php  
                    while($row = mysql_fetch_array($retval_bid, MYSQL_ASSOC)){
                        echo '<div class="col-lg-3 col-md-6 text-center touch-anchor">
                    <a href="bid_it.php?id='.$row['book_id'].'" class="books-div" style="text-decoration:none;">
                    <div class="service-box">
                        <img src="'.$row['book_img'].'" style="width:50%;">
                        <h3>'.$row['name'].'</h3>
                        <p class="text-muted">Author : '.$row['author'].'</p>
                        <p class="text-muted">Bid Price : '.$row['bid_price'].'</p>
                    </div>
                    </a>
                </div>';
                    }
                ?>
            </div>
        </div>
    </section>

    

    <aside class="bg-dark">
        <div class="container text-center">
            <div class="call-to-action">
                <h2>Love all, trust a few, do wrong to none. -- William Shakespear</h2>
                <!--<a href="#" class="btn btn-default btn-xl wow tada">Check Now!</a>-->
            </div>
        </div>
    </aside>

    <section id="contact">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-lg-offset-2 text-center">
                    <h2 class="section-heading">Let's Get In Touch!</h2>
                    <hr class="primary">
                    <p>Give us a call or send us an email and we will get back to you as soon as possible!</p>
                </div>
                <div class="col-lg-3 text-center">
                    <i class="fa fa-phone fa-3x wow bounceIn"></i>
                    <p>+91-8553236639</p>
                </div>
                <div class="col-lg-3 text-center">
                    <i class="fa fa-envelope-o fa-3x wow bounceIn" data-wow-delay=".1s"></i>
                    <p><a href="mailto:info@careersensy.com">info@flyingbook.com</a></p>
                </div>
                <div class="col-lg-3 text-center">
                    <i class="fa fa-facebook fa-3x wow bounceIn" data-wow-delay=".1s"></i>
                    <p><a href="http://fb.com/flyingbook">fb.com/flyingbook</a></p>
                </div>
                <div class="col-lg-3 text-center">
                    <i class="fa fa-twitter fa-3x wow bounceIn" data-wow-delay=".1s"></i>
                    <p>@flyingbook</p>
                </div>
            </div>
        </div>
    </section>

    <section id="footer">
        <div class="container">
            <div class="row">
                <div class="col-lg-4">
                    <p>Copyright &copy; SRA 2016</p>
                </div>
                <div class="col-lg-2">
                    <a href="#"><p>Careers</p></a>
                </div>
                <div class="col-lg-3">
                    <a href="#"><p>Terms & Conditions</p></a>
                </div>
                <div class="col-lg-2">
                    <a href="#"><p>Privacy Policy</p></a>
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
