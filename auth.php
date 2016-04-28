<?php  
	error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE);
    require_once('conf/constants.php');
    
	$uname = $_POST['uname'];
	$pwd = $_POST['pwd'];

	if ((strcmp($uname,"flyingbook") == 0) && (strcmp($pwd,"flyingbook1234") == 0) ) {
        ob_start(); // ensures anything dumped out will be caught

        // do stuff here
        $url = HOST.'home.php'; // this can be set based on whatever

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
        $url = HOST.'index.php'; // this can be set based on whatever

        // clear out the output buffer
        while (ob_get_status()) 
        {
            ob_end_clean();
        }

        // no redirect
        header( "Location: $url" );
    }
?>