<?php
// We need to use sessions, so you should always start sessions using the below code.
session_start();
include './config.php';
// If the user is not logged in redirect to the login page...
if (!isset($_SESSION['loggedin'])) {
	header('Location: index.html');
	exit;
}
if (!isset($_POST['old_pw'], $_POST['new_pw'], $_POST['new_pw1'])) {
	exit('Please fill in your old and new password fields!');
}
if ($_POST['new_pw'] != $_POST['new_pw1']) {
	exit('New passwords do not match');
}
if ($stmt = $con->prepare("SELECT password FROM user_accounts WHERE id  = ?" )) {
        // Bind parameters (s = string, i = int, b = blob, etc), in our case the username is a string so we use "s"
        $stmt->bind_param('i', $_SESSION['id']);
        $stmt->execute();
        // Store the result so we can check if the account exists in the database.
        $stmt->store_result();
        if ($stmt->num_rows > 0) {
                $stmt->bind_result($password);
                $stmt->fetch();
	}
	if (password_verify($_POST['old_pw'], $password)) {
		$hash = password_hash($_POST['new_pw'], PASSWORD_DEFAULT);
		$stmt = $con->prepare("UPDATE user_accounts SET password=? WHERE id=?");
	        $stmt->bind_param ('si',$hash,$_SESSION['id']);
	        $stmt->execute();
		$stmt = $con->prepare("UPDATE user_accounts SET password_expiry=ADDDATE(curdate(), INTERVAL 90 DAY)");
	        $stmt->execute();
	} else {
		exit ('Old password failed verification!');
	}
}



?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="refresh" content="5;url=http://127.0.0.1:8080/logout.php">
		<title>Password_change</title>
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
			<h2>Password change</h2>
			<p>Password successfully changed</p>
			<p>New password is <?=$_POST['new_pw']?></p>
			<p>New hash is <?=$hash?></p>
			<h2>You will shortly be logged out</h2>
		</div>

	</body>
</html>

