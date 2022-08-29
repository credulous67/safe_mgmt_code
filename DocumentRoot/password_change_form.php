<?php
// We need to use sessions, so you should always start sessions using the below code.
session_start();
// If the user is not logged in redirect to the login page...
if (!isset($_SESSION['loggedin'])) {
	header('Location: index.html');
	exit;
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
		<link href="style.css" rel="stylesheet" type="text/css">
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
	</head>
	<body class="loggedin">
        <?php require_once(__DIR__.'/navtop.php'); ?>
        <?php require_once(__DIR__.'/sidebar.php'); ?>
		<div class="content">
			<h2>Password change</h2>
			<p>Welcome back, <?=$_SESSION['name']?> your password expired on, <?=$_SESSION['password_expiry']?>, please change</p>
		</div>
		<div class="login">
                <form action="password_change_script.php" method="post">
                                <label for="old_pw">
                                        <i class="fas fa-lock"></i>
                                </label>
                                <input type="password" name="old_pw" placeholder="Old password" id="old_pw" required>
                                <label for="new_pw">
                                        <i class="fas fa-unlock"></i>
                                </label>
				<input type="text" name="new_pw"  id="new_pw" value=<?=$new_pw?> required>
                                <label for="new_pw1">
                                        <i class="fas fa-lock"></i>
                                </label>
                                <input type="password" name="new_pw1" placeholder="New password .. again" id="new_pw1" required>
                                <input type="submit" value="Change password">
                </form>
		</div>
	</body>
</html>
