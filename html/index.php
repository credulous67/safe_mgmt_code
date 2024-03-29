<?php
session_start();
session_destroy();
function init(){
	document.getElementById("username").focus();
}
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Login</title>
		<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
                <link href="style.css" rel="stylesheet" type="text/css">
	</head>
	<body onload="document.login.username.focus()";>
		<div class="login">
			<h1>Safe Management System (SMS) v0.1</h1>
			<form action="login_script.php" method="post" name="login">
				<label for="username">
					<i class="material-icons">account_box</i>
				</label>
				<input type="text" name="username" placeholder="Username" id="username" autocomplete="off">
				<label for="password">
					<i class="material-icons">lock</i>
				</label>
				<input type="password" name="password" placeholder="Password" id="password">
				<input type="submit" name="submit">
			</form>
			<?php
				if (!isset($_GET["login"])) {
					exit();
				} else {
					$logincheck=$_GET["login"];
					if (isset ($logincheck)) {
                        if ($logincheck == "empty") {
                            echo "<p class='error'>Please fill in both username and password</p>";
                            exit();
                        } elseif ($logincheck == "userpasscheck") {
                            echo "<p class='error'>Username or password incorrect</p>";
                            exit();
                        } elseif ($logincheck == "prepare") {
                            echo "<p class='error'>something went wrong with the SQL prepare</p>";
                            exit();
                        } elseif ($logincheck == "pwupdatefailed"){
                            echo "<p class='error'>Unable to update expired password, try again</p>";
                            exit();
                        } elseif ($logincheck == "pwupdatesuccess"){
                            echo "<p class='success'>Password changed successfully, please login</p>";
                            exit();
                        } elseif ($logincheck == "sessiontimedout") {
                            echo "<p class='success'>Session timed out, please login</p>";
                            exit();
                        } else {
                            exit();
                        }
                    }
                   
				}
			?>
		</div>
	</body>
</html>