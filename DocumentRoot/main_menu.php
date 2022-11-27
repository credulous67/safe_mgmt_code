<?php
// We need to use sessions, so you should always start sessions using the below code.
session_start();
// If the user is not logged in redirect to the login page...
if ($_SESSION['loggedin'] == FALSE) {
	header('Location: index.php');
	exit;
}
if( $_SESSION['last_activity'] < time()-$_SESSION['expire_time'] ) { //have we expired?
    //redirect to logout.php
    header('Location: logout.php'); //change yoursite.com to the name of you site!!
} else{ //if we haven'jt expired:
    $_SESSION['last_activity'] = time(); //this was the moment of last activity.
}
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Main menu</title>
		<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
		<link href="style.css" rel="stylesheet" type="text/css">
<!--		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css"> -->
	</head>
	<body class="loggedin">
	<?php require_once(__DIR__.'/navtop.html'); ?>
	<?php require_once(__DIR__.'/sidebar.html'); ?>
		<div class="content">
			<p>Welcome back, <?=$_SESSION['name']?>!</p>
		</div>
	</body>
</html>
