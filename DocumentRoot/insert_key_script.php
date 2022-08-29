<?php
// We need to use sessions, so you should always start sessions using the below code.
session_start();
include './config.php';
include './functions.php';
// If the user is not logged in redirect to the login page...
if (!isset($_SESSION['loggedin'])) {
	header('Location: index.html');
	exit;
}
if ($stmt = $con->prepare("INSERT INTO `keys` (key_name, safe_id, system_id, region_id, created_by, TPE, key_serial, media_type_id, key_type_id, hash) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)")) {
	$key_name=$_POST['key_name'];
	$safe_id=$_POST['safe_id'];
	$system_id=$_POST['system_id'];
	$region_id=$_POST['region_id'];
	$user_id=$_SESSION['id'];
	$TPE=$_POST['TPE'];
	$key_serial=$_POST['key_serial'];
	$media_type_id=$_POST['media_type_id'];
	$key_type_id=$_POST['key_type_id'];
	$hash='0';
	$stmt->bind_param ('siiiissiis',$key_name,$safe_id,$system_id,$region_id,$user_id,$TPE,$key_serial,$media_type_id,$key_type_id,$hash);
	$stmt->execute();
	$new_key_id= mysqli_insert_id($con);
	[$hash,$keystring]=update_key_hash($new_key_id);
	
} else {
	// failed to insert
	echo "failed to insert";
}

?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="refresh" content="20;url=http://127.0.0.1:8080/insert_key_form.php">
		<title>Insert new key</title>
		<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
		<link href="style.css" rel="stylesheet" type="text/css">
	</head>
	<body class="loggedin">
        <?php require_once(__DIR__.'/navtop.php'); ?>
        <?php require_once(__DIR__.'/sidebar.php'); ?>
		<div class="content">
			<h2>Insert new key</h2>
			<p>New key successfully added to the database</p>
			<p>ID:<?=$new_key_id?></p>
			<p>HASH:<?=$hash?></p>
			<p>KEYSTRING:<?=$keystring?></p>
		</div>

	</body>
</html>

