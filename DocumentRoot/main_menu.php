<?php
include './session.inc.php';
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Main menu</title>
		<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
		<link href="style.css" rel="stylesheet" type="text/css">
	</head>
	<body class="loggedin">
	<?php require_once(__DIR__.'/navtop.inc.html'); ?>
	<?php require_once(__DIR__.'/sidebar.inc.html'); ?>
		<div class="content">
			<p>Welcome back, <?=$_SESSION['name']?>!</p>
		</div>
	</body>
</html>
