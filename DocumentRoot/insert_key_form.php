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

?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Insert new key</title>
		<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
		<link href="style.css" rel="stylesheet" type="text/css">
	</head>
	<body class="loggedin">
		<?php require_once(__DIR__.'/navtop.php'); ?>
		<?php require_once(__DIR__.'/sidebar.php'); ?>
		<div class="content">
			<h2>Insert new key</h2>
<!--			<p>Welcome back, <?=$_SESSION['name']?> your password expired on, <?=$_SESSION['password_expiry']?>, please change</p> -->
			<div class="container">
	                <form class="form-inline" action="insert_key_script.php" method="post">
				<div class="row">
					<div class="col-25">
	                                <label for="key_name">Key name:</label>
					</div>
					<div class="col-75">
	                                <input type="text" name="key_name" placeholder="Enter key name" id="key_name" required>
					</div>
				</div>
				<div class="row">
					<div class="col-25">
	                                <label for="TPE">Tamperproof #:</label>
					</div>
					<div class="col-75">
					<input type="text" name="TPE"  id="new_pw" placeholder="Tamproof envelope number" id="TPE" required>
					</div>
				</div>
				<div class="row">
					<div class="col-25">
	                                <label for="key_serial">Key serial number:</label>
					</div>
					<div class="col-75">
	                                <input type="text" name="key_serial" placeholder="Key serial or unique number" id="key_serial" required>
					</div>
				</div>
				<div class="row">
					<div class="col-25">
                                        <label for="safe_name">Safe name:</label>
					</div>
					<div class="col-75">
					<select name="safe_id">
					<?php
					$sql = mysqli_query($con, "SELECT id, safe_name FROM safes ORDER BY safe_name");
					while ($row = $sql->fetch_assoc()){
						echo "<option value=\"" . $row['id'] . "\">" . $row['safe_name'] . "</option>";
					}
					?>
					</select>
					</div>
				</div>
				<div class="row">
					<div class="col-25">
                                        <label for="system_id">System name:</label>
					</div>
					<div class="col-75">
					<select name="system_id">
					<?php
					$sql = mysqli_query($con, "SELECT id, system_name FROM systems ORDER BY system_name");
					while ($row = $sql->fetch_assoc()){
						echo "<option value=\"" . $row['id'] . "\">" . $row['system_name'] . "</option>";
					}
					?>
					</select>
					</div>
				</div>
				<div class="row">
					<div class="col-25">
                                        <label for="region_name">Region name:</label>
					</div>
					<div class="col-75">
					<select name="region_id">
					<?php
					$sql = mysqli_query($con, "SELECT id, region_name FROM regions ORDER BY region_name");
					while ($row = $sql->fetch_assoc()){
						echo "<option value=\"" . $row['id'] . "\">" . $row['region_name'] . "</option>";
					}
					?>
					</select>
					</div>
				</div>
				<div class="row">
					<div class="col-25">
                                        <label for="media_type">Media type:</label>
					</div>
					<div class="col-75">
					<select name="media_type_id">
					<?php
					$sql = mysqli_query($con, "SELECT id, media_type FROM media_types ORDER BY media_type");
					while ($row = $sql->fetch_assoc()){
						echo "<option value=\"" . $row['id'] . "\">" . $row['media_type'] . "</option>";
					}
					?>
					</select>
					</div>
				</div>
				<div class="row">
					<div class="col-25">
                                        <label for="key_type">Key type:</label>
					</div>
					<div class="col-75">
					<select name="key_type_id">
					<?php
					$sql = mysqli_query($con, "SELECT id, key_type FROM key_types ORDER BY key_type");
					while ($row = $sql->fetch_assoc()){
						echo "<option value=\"" . $row['id'] . "\">" . $row['key_type'] . "</option>";
					}
					?>
					</select>
					</div>
				</div>
				<div class="row">
					<div class="col-50">
	                                <input type="submit" value="Add new key">
					</div>
				</div>
	                </form>
			</div>
		</div>
	</body>
</html>
