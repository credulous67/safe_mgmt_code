<?php
if (!isset($_POST["submit"])) {
	# User got here without submit, redirect back to index / login
	header("Location: ./index.php"); 
	exit();
} else {
	# User submitted from login page
	session_start();
	// Change this to your connection info.
	include "./config.php";
	if ( empty($_POST["username"]) || empty($_POST["password"]) ) {
		# either empty username or password
		header("Location: ./index.php?login=empty");
		exit();
	} else {
		# username & password contain something
		$username=$_POST["username"];
		$password=$_POST["password"];
		// Prepare our SQL, preparing the SQL statement will prevent SQL injection.
		if ($stmt = $con->prepare("SELECT id, password, password_expiry FROM user_accounts WHERE username = ? AND account_disabled = 0")) {
			// Bind parameters (s = string, i = int, b = blob, etc), in our case the username is a string so we use "s"
			$stmt->bind_param('s', $_POST['username']);
			$stmt->execute();
			// Store the result so we can check if the account exists in the database.
			$stmt->store_result();
			if ($stmt->num_rows == 0) {
				// User not found
				header("Location: ./index.php?login=userpasscheck");
				exit();
			} elseif ($stmt->num_rows == 1) {
				$stmt->bind_result($id, $password, $password_expiry);
				$stmt->fetch();
				// Only 1 account exists, now we verify the password.
				$now=date("Y-m-d H:i:s");
				if (!password_verify($_POST['password'], $password)) {
					// Incorrect password
					header("Location: ./index.php?login=userpasscheck");
					exit();
				} elseif ($password_expiry <= $now) {
					// User authenticated, but account expired
					// Create sessions, so we know the user is logged in, they basically act like cookies but remember the data on the server.
					session_regenerate_id();
					$_SESSION['loggedin'] = FALSE;
					$_SESSION['name'] = $_POST['username'];
					$_SESSION['id'] = $id;
					$_SESSION['password_expiry'] = $password_expiry;
					$_SESSION['last_activity'] = time();
					$_SESSION['expire_time'] = $TIMEOUT_SESSION * 60;
					header('Location: password_change_form.php');
					exit();
				} else {
					// Verification success! User has logged-in!
					// Create sessions, so we know the user is logged in, they basically act like cookies but remember the data on the server.
					session_regenerate_id();
					$_SESSION['loggedin'] = TRUE;
					$_SESSION['name'] = $_POST['username'];
					$_SESSION['id'] = $id;
					$_SESSION['password_expiry'] = $password_expiry;
					$_SESSION['last_activity'] = time();
					$_SESSION['expire_time'] = $TIMEOUT_SESSION * 60;
					header('Location: main_menu.php');
					exit();
				}
			} else {
				// Multiple users found
				header("Location: ./index.php?login=userpasscheck");
				exit();
			}
			$stmt->close();
		} else{
			// prepare failure
			header("Location: ./index.php?login=prepare");
			exit();
		}
	}
}
?>
