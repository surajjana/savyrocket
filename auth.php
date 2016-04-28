<?php  
	error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE);
	$uname = $_POST['uname'];
	$pwd = $_POST['pwd'];

	if ((strcmp($uname,"savyrocket") == 0) && (strcmp($pwd,"savyrocket1234") == 0) ) {
        ob_start(); // ensures anything dumped out will be caught

        // do stuff here
        $url = 'http://localhost/savyrocket/home.php'; // this can be set based on whatever

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
        $url = 'http://localhost/savyrocket/index.php'; // this can be set based on whatever

        // clear out the output buffer
        while (ob_get_status()) 
        {
            ob_end_clean();
        }

        // no redirect
        header( "Location: $url" );
    }
?>