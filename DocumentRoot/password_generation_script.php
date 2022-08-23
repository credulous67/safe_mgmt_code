<?php
// We need to use sessions, so you should always start sessions using the below code.
session_start();
// If the user is not logged in redirect to the login page...
if (!isset($_SESSION['loggedin'])) {
	header('Location: index.html');
	exit;
}

$command = "/usr/bin/pwqgen";
exec($command, $out, $ret);
if ( $ret == 0 ) { 
	$passphrase = $out[0]; 
}
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Password generation</title>
		<link href="style.css" rel="stylesheet" type="text/css">
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
	</head>
	<body class="loggedin">
		<nav class="navtop">
			<div>
				<h1>Encryption Services safe management</h1>
				<a href="main_menu.php"><i class="fas fa-map-signs"></i>Main menu</a>
				<a href="logout.php"><i class="fas fa-sign-out-alt"></i>Logout</a>
			</div>
		</nav>
		<div class="content">
			<h2>Password generation</h2>
			<p>Welcome back, <?=$_SESSION['name']?>!</p>
			<p>Passphrase is: 
			<mark><em><b><?=$passphrase?></b></em></mark></p>
		</div>
	</body>
</html>
