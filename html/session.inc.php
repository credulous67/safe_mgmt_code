<?php
session_start();
// If the user is not logged in redirect to the login page...
if (!isset($_SESSION['loggedin'])) {
	header('Location: index.php');
	exit();
}
if( $_SESSION['last_activity'] < time()-$_SESSION['expire_time'] ) {
    //redirect to logout.php
    header('Location: index.php?login=sessiontimedout');
    exit();
} else{
    $_SESSION['last_activity'] = time(); //this was the moment of last activity.
}
