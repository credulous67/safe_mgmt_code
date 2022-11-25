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
		<!--                <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css"> -->
		<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
                <link href="style.css" rel="stylesheet" type="text/css">
	</head>
	<body onload="document.login.username.focus()";>
		<div class="login">
			<h1>Safe Management Login</h1>
			<form action="login_script.php" method="post" name="login">
				<label for="username">
					<i class="material-icons">account_box</i>
				</label>
				<input type="text" name="username" placeholder="Username" id="username" autocomplete="off" required>
				<label for="password">
					<i class="material-icons">lock</i>
				</label>
				<input type="password" name="password" placeholder="Password" id="password" required>
				<input type="submit">
			</form>
		</div>
	</body>
</html>
