<?php
// We need to use sessions, so you should always start sessions using the below code.
session_start();
// If the user is not logged in redirect to the login page...
if (!isset($_SESSION['loggedin'])) {
	header('Location: index.html');
	exit;
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
		<nav class="navtop">
			<div>
				<h1>Encryption Services safe management</h1>
				<a href="profile.php"><i class="material-icons">account_circle</i>Profile</a>
				<a href="logout.php"><i class="material-icons">exit_to_app</i>Logout</a>
			</div>
		</nav>
<!--		<nav class="sidebar"> -->
		<nav style="height:100%;width:150px;position:absolute;padding-top:40px;background-color:lightblue">
		<div> <h1>test</h1> </div>
		<div> <a href="password_generation_script.php">Password generation</a> </div>
		</nav>
		<div class="content">
			<h2>Main menu</h2>
			<p>Welcome back, <?=$_SESSION['name']?>!</p>
			<a href="password_generation_script.php">Password generation</a>
		</div>
	</body>
</html>
