<?php
// We need to use sessions, so you should always start sessions using the below code.
session_start();
// If the user is not logged in redirect to the login page...
if (!isset($_SESSION['loggedin'])) {
	header('Location: index.html');
	exit;
}
if ( !isset($_POST['password1']) || $_POST['password1'] != $_POST['password2']) {
	exit('Passwords do not match');
}
$hash = password_hash($_POST['password1'], PASSWORD_DEFAULT)
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Password hash</title>
		<link href="style.css" rel="stylesheet" type="text/css">
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
	</head>
	<body class="loggedin">
		<nav class="navtop">
			<div>
				<h1>Encryption Services safe management</h1>
				<a href="profile.php"><i class="fas fa-user-circle"></i>Profile</a>
				<a href="logout.php"><i class="fas fa-sign-out-alt"></i>Logout</a>
			</div>
		</nav>
		<div class="content">
			<h2>Password hash</h2>
			<p>Password hash for </p>
			<p><?=$_POST['password1']?></p>
			<p><?=$hash?></p>
		</div>
	</body>
</html>
