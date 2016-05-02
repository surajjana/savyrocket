<?php  

error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE);
require_once("conf/constants.php");

$conn = mysql_connect(HOST, USER, PASSWORD);
if(! $conn )
{
  die('Could not connect: ' . mysql_error());
}

mysql_select_db(DB);

$sql = "select * from books where book_id=".$_GET['id'];

$retval = mysql_query( $sql, $conn );

if(! $retval )
{
  die('Could not get data: ' . mysql_error());
}

$row = mysql_fetch_array($retval, MYSQL_ASSOC);

$sql_reviews = "select * from reviews where book_id=".$_GET['id'];

$retval_reviews = mysql_query( $sql_reviews, $conn );

if(! $retval_reviews )
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
    <link rel="stylesheet" href="css/detailed.css" type="text/css">
    <link href='http://fonts.googleapis.com/css?family=Lato:300,400,700,900' rel='stylesheet' type='text/css'>

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

             

<!-- <div class="navbar-custom">
  <div class="container-fluid" style="width:100%">
        <div class="row" id="fixed-bar">
            <form action="" method="post">
            <div class="col-md-1"></div>
            <div class="col-md-3">
                <select name="client_id" class="form-control">
                    <option value="">All Categories</option>
                    <option value="">Category 1</option>
                    <option value="">Category 2</option>
                    <option value="">Category 3</option>
                    <option value="">Category 4</option>
                    <option value="">Category 5</option>
                </select>
            </div>
            <div class="col-md-5">
                <input type="text" class="form-control" name="uname" id="uname" placeholder="Enter Book Name">
            </div>
            <div class="col-md-2">
                <input type="submit" class="form-control" value="Search">
            </div>
            <div class="col-md-1"></div>
            </form>
        </div>
        <br />
    </div>
</div> -->

<div class="container-fluid">
    <div class="row">
        <div class="col-lg-2 col-md-2 col-sm-3 col-xs-2"></div>
        <div class="col-lg-3 col-md-3 col-sm-9" style="position:relative; top:160px; ">
            <img src="<?php echo $row['book_img']; ?>"  class="img-responsive" style="width:200px;height:266px;"/>
        </div>
        <div class="col-lg-5 col-md-5 hidden-sm hidden-xs"  style="position:relative; top:140px; ">
            <div class="row">
                <h4 style="font-size:1.6em; line-height:1.6; color:#555555; font-family:'Lato';" ><?php echo $row["name"]; ?></h4>
            </div>
            <div class="row">
                <h5><blockquote>Author: <?php echo $row["author"]; ?> </blockquote></h5>
            </div>
            <div class="row">
                <h5><blockquote>Publication : <?php echo $row["publication"]; ?> </blockquote></h5>
             
            </div>
          
            <div class="row">
                <h5><blockquote>Category: <?php echo $row["category"]; ?></blockquote></h5>
            </div>
            <div class="row">
                           <div class="col-lg-2 col-md-2">
                   <i class="fa fa-inr fa-2x" ><?php echo $row["price"]; ?> </i>
                </div>
                <div class="col-lg-1 col-md-1"></div>
                <!-- <div class="col-lg-3 col-md-3">
                  <a href="#" class="button">Buy Now</a>
                </div> -->
                   
                <div class="col-lg-3 col-md-3">
                  <a href="<?php echo 'cart_up.php?id='.$row['book_id']; ?>"><button class="btn btn-primary">Add to cart</button></a>
                </div>

            </div>
        </div>

 		<div class="col-sm-1 col-xs-1 hidden-lg hidden-md"><br/><br/></div>

        <div class="col-sm-10 col-xs-10 hidden-lg hidden-md"  style="position:relative; top:140px; ">
        <br/>
            <div class="row">
                <h4 style="font-size:1.6em; line-height:1.6; color:#555555; font-family:'Lato';" ><?php echo $row["name"]; ?></h4>
            </div>
            <div class="row">
                <h5><blockquote>Author: <?php echo $row["author"]; ?> </blockquote></h5>
            </div>
            <div class="row">
                <h5><blockquote>Publication : <?php echo $row["publication"]; ?> </blockquote></h5>
             
            </div>
          
            <div class="row">
                <h5><blockquote>Category: <?php echo $row["category"]; ?></blockquote></h5>
            </div>
            <div class="row">
	                 <div class="col-sm-12 col-xs-12 hidden-lg hidden-md">
                   <i class="fa fa-inr fa-2x" ><?php echo $row["price"]; ?> </i>
                   <br/>
                   <br/>
                </div>
                
                <!-- <div class="col-sm-12 col-xs-12 hidden-lg hidden-md">
                  <a href="#" class="button">Buy Now</a>
                  <br/>
                  <br/>
                </div> -->
                   
                <div class="col-sm-12 col-xs-12 hidden-lg hidden-md">
                  <a href="<?php echo 'cart_up.php?id='.$row['book_id']; ?>"><button class="btn btn-primary">Add to cart</button></a>
                </div>
	
	            
            </div>
        </div>
    </div>
    <br/>
    <br/>
    <div class="row">
        <div class="col-lg-2 col-md-2 hidden-sm hidden-xs"></div>
        <div class="col-lg-7 col-md-7 col-sm-12 col-xs-12"style="position:relative; top:140px;">
            <h4 style="font-size:1.6em; color:rgba(255,100,64,1)">Description</h4>
            <br/>
            <p style="font-size:1.1em; line-height:1.7;"><?php echo $row["description"]; ?></p>
        </div>
	</div>

    <div class="row">
        <div class="col-lg-2 col-md-2 hidden-sm hidden-xs"></div>
        <div class="col-lg-7 col-md-7 col-sm-12 col-xs-12"style="position:relative; top:140px;">
           <h4 style="font-size:1.6em; color:rgba(255,100,64,1)">Reviews</h4>
           <!-- <h4><a href="review.php"><button class="btn btn-primary">Give Review</button></a></h4> -->
           

           <?php  

                while($row=mysql_fetch_array($retval_reviews, MYSQL_ASSOC)){
                    echo '<div class="row">
                <div class="col-lg-2 col-md-2 col-sm-6 col-xs-6" style="position:relative;top:10px;">
                   <h4 >'.$row['name'].'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.date("d-m-Y", $row['time']).'</h4>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-7 col-md-7 col-sm-12 col-xs-12" style="position:relative;top:22px;">
                    <p>'.$row['review'].'</p>
                   
                    <hr>
                </div>
           </div>';

                }

           ?>
        

        </div>
    </div>

    <br /><br />

<section id="services">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2 class="section-heading">Give Review</h2>
                    <hr class="primary">
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-md-1"></div>
                <div class="col-md-4">
                <form action="review_final.php" method="post">
                <input type="hidden" name="book_id" value="<?php echo $_GET['id']; ?>">
                    <div class="control-group form-group">
                        <div class="controls">
                            <label>Name <span style="color:red;">*</span> :</label>
                            <input type="text" class="form-control" name="name" id="uname" required data-validation-required-message="Please enter your name.">
                            <p class="help-block"></p>
                        </div>
                    </div>
                    <div class="control-group form-group">
                        <div class="controls">
                            <label>Review <span style="color:red;">*</span> :</label>
                            <input type="text" class="form-control" name="review" id="pwd" required data-validation-required-message="Please enter your phone number.">
                        </div>
                    </div>
                    <!-- <p style="color:red;">Invalid credentials</p> -->
                    <button type="submit" class="btn btn-primary">Submit</button>

                </form>
                    <!-- <center><a href="register_user.php" style="color:blue;">Register Here</a> --></center>
                </div>
                <div class="col-md-7"></div>
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