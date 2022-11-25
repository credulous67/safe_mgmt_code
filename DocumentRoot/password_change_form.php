<?php
// We need to use sessions, so you should always start sessions using the below code.
session_start();
// If the user is not logged in redirect to the login page...
// deliberatly just checking if loggedin exists
if (!isset($_SESSION['loggedin'])) {
	header('Location: index.php');
	exit;
}
if( $_SESSION['last_activity'] < time()-$_SESSION['expire_time'] ) { //have we expired?
    //redirect to logout.php
    header('Location: logout.php'); //change yoursite.com to the name of you site!!
} else{ //if we haven'jt expired:
    $_SESSION['last_activity'] = time(); //this was the moment of last activity.
}
include './config.php';
include './functions.php';
$new_pw = generate_password();

?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Password_change</title>
		<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
		<link href="style.css" rel="stylesheet" type="text/css">
	</head>
	<body onload="document.pwchange.old_pw.focus()";>
<!--        <?php require_once(__DIR__.'/navtop.php'); ?>
        <?php require_once(__DIR__.'/sidebar.php'); ?> -->
		<div class="login">
<!--		<div class="content"> -->
			<h1>Password change</h1>
			<p>Welcome back, <?=$_SESSION['name']?></p>
			<p>Your password expired on, <?=$_SESSION['password_expiry']?></p>
<!--		</div> -->
                <form action="password_change_script.php" method="post" name="pwchange">
                                <label for="old_pw">
                                        <i class="material-icons">lock</i>
                                </label>
                                <input type="password" name="old_pw" placeholder="Old password" id="old_pw" required>
                                <label for="new_pw">
                                        <i class="material-icons">lock_open</i>
                                </label>
				<input type="text" name="new_pw"  id="new_pw" value=<?=$new_pw?> required>
                                <label for="new_pw1">
                                        <i class="material-icons">lock</i>
                                </label>
                                <input type="password" name="new_pw1" placeholder="New password .. again" id="new_pw1" required>
                                <input type="submit">
                </form>
		</div>
	</body>
</html>
