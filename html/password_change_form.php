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
include './config.inc.php';
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
		<div class="login">
			<h1>Safe Management System (SMS) v0.1</h1>
			<p>Welcome back, <b><?=$_SESSION['name']?></b> your password expired on <b><?=$_SESSION['password_expiry']?></b></p>
            <p>You are required to change it now.</p>
<!--		</div> -->
                <form action="password_change_script.php" method="post" name="pwchange">
                                <label for="old_pw">
                                        <i class="material-icons">lock</i>
                                </label>
                                <input type="password" name="old_pw" placeholder="Old password" id="old_pw">
                                <label for="new_pw">
                                        <i class="material-icons">lock_open</i>
                                </label>
				<input type="text" name="new_pw"  id="new_pw" value=<?=$new_pw?>>
                                <label for="new_pw1">
                                        <i class="material-icons">lock</i>
                                </label>
                                <input type="password" name="new_pw1" placeholder="New password .. again" id="new_pw1">
                                <input type="submit" name="submit">
                </form>
                <?php
                    if (!isset($_GET["pwchange"])) {
                        exit();
                    } else {
                        $logincheck=$_GET["pwchange"];
                        if ($logincheck == "empty") {
                            echo "<p class='error'>Please fill in all fields</p>";
                            exit();
                        } elseif ($logincheck == "newpwmatch") {
                            echo "<p class='error'>Both new passwords entered do not match</p>";
                            exit();
                        } elseif ($logincheck == "newpwq") {
                            echo "<p class='error'>Password quality of new password is not upto snuff</p>";
                            exit();
                        } elseif ($logincheck == "oldpw"){
                            echo "<p class='error'>Unable to verify old password</p>";
                            exit();
                        }
                    }
                ?>
		</div>
	</body>
</html>
