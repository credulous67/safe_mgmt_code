<?php
// We need to use sessions, so you should always start sessions using the below code.
session_start();
// If the user is not logged in redirect to the login page...
if (!isset($_SESSION['loggedin'])) {
	header('Location: index.html');
	exit;
}

include 'functions.php';
$password = generate_password();
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Password generation</title>
		<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
		<link href="style.css" rel="stylesheet" type="text/css">
	</head>
	<body class="loggedin">
		<nav class="navtop">
			<div>
				<h1>Encryption Services safe management</h1>
				<a href="profile.php"><i class="material-icons">account_circle</i>Profile</a>
				<a href="logout.php"><i class="fas fa-sign-out-alt"></i>Logout</a>
			</div>
		</nav>
                <nav class="sidebar">
                        <div>
                                <a href="main_menu.php"><h1>Main menu</h1></a>
                                <a href="password_generation_script.php"><i class="material-icons">bolt</i>Password generation</a>
                                <a href="insert_key_form.php"><i class="material-icons">note_add</i>Insert new key</a>
                        </div>
                </nav>
		<div class="content">
			<h2>Password generation</h2>
			<p>Welcome back, <?=$_SESSION['name']?>!</p>
			<p>Passphrase is: 
			<mark><em><b><?=$password?></b></em></mark></p>
		</div>
	</body>
</html>
