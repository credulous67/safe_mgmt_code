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
		<title>Password</title>
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
			<h2>Password</h2>
			<p>Welcome back, <?=$_SESSION['name']?>!</p>
		</div>
		<div class="login">
                <form action="password_hash.php" method="post">
                                <label for="password">
                                        <i class="fas fa-lock"></i>
                                </label>
                                <input type="password" name="password1" placeholder="Password" id="password1" required>
                                <label for="password">
                                        <i class="fas fa-lock"></i>
                                </label>
                                <input type="password" name="password2" placeholder="Type password again" id="password2" required>
                                <input type="submit" value="Generate hash">
                </form>
		<?div>
	</body>
</html>
