<?php
if (!isset($_POST["submit"])) {
	# User got here without submit, redirect back to index / login
	header("Location: ./index.php"); 
	exit();
} else {
	session_start();
	include './config.php';
	// If the user is not logged ($_POST['loggedin']=FALSE (ie TRUE), then drop back to main index, as user shouldn't be here)
	if ($_SESSION['loggedin']) {
		header("Location: ./index.php");
		exit();
	}
	if ( empty($_POST["old_pw"]) || empty($_POST["new_pw"]) || empty($_POST["new_pw1"]) ) {
		# either empty fields from password_change_form
		header("Location: ./password_change_form.php?pwchange=empty");
		exit();
	}
	if ($_POST['new_pw'] != $_POST['new_pw1']) {
		// New passwords don't match
		header("Location: ./password_change_form.php?pwchange=newpwmatch");
		exit();
	} else {
		// New password submitted, check score
		$PWCHECK = "/usr/bin/pwqcheck -2";
		$cmd = "( echo " . escapeshellarg($_POST['new_pw']) . "; echo ".escapeshellarg($_POST['old_pw']) . ") | {$PWCHECK}";
		exec($cmd, $out, $ret);
		if ($ret == 1){
			// New password quality is not good enough
			header("Location: ./password_change_form.php?pwchange=newpwq");
			exit();
		}
	}
	if ($stmt = $con->prepare("SELECT password FROM user_accounts WHERE id  = ?" )) {
		// Bind parameters (s = string, i = int, b = blob, etc), in our case the username is a string so we use "s"
        $stmt->bind_param('i', $_SESSION['id']);
        $stmt->execute();
        // Store the result so we can check if the account exists in the database.
        $stmt->store_result();
        if ($stmt->num_rows == 0) {
			// User not found (something is really screwed, so send back to index.php)
			header("Location: ./index.php?login=userpasscheck");
			exit();
		} elseif ($stmt->num_rows == 1) {
			// Only 1 account exists, now we verify the password.
			$stmt->bind_result($password);
            $stmt->fetch();
			if (!password_verify($_POST['old_pw'], $password)) {
				// Incorrect password
				header("Location: ./password_change_form.php?pwchange=oldpw");
				exit();
			} else {
				// good to change password
				$hash = password_hash($_POST['new_pw'], PASSWORD_DEFAULT);
				if ($stmt = $con->prepare("UPDATE user_accounts SET password=? , password_expiry=ADDDATE(curdate(), INTERVAL 90 DAY) WHERE id=?")) {
					$stmt->bind_param ('si',$hash,$_SESSION['id']);
					$stmt->execute();
                    // password changed
                    header("Location: ./index.php?login=pwupdatesuccess");
				} else {
					// Unable to update password (something is really screwed, so send back to index.php)
					header("Location: ./index.php?login=pwupdatefailed");
					exit();
				}
			}
		} else {
			// Multiple users found (Something really wrong send back to index.php)
			header("Location: ./index.php?login=userpasscheck");
			exit();
		}
	}
}
?>
