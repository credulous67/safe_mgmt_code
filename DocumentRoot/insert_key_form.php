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
		<nav class="navtop">
			<div>
				<h1>Encryption Services safe management</h1>
				<a href="main_menu.php"><i class="material-icons">signpost</i>Main menu</a>
				<a href="logout.php"><i class="material-icons">exit_to_app</i>Logout</a>
			</div>
		</nav>
		<div class="content">
			<h2>Insert new key</h2>
<!--			<p>Welcome back, <?=$_SESSION['name']?> your password expired on, <?=$_SESSION['password_expiry']?>, please change</p> -->
	                <form class="form-inline" action="insert_key_script.php" method="post">
	                                <label for="key_name">Key name:</label>
	                                <input type="text" name="key_name" placeholder="Enter key name" id="key_name" required>
	                                <label for="TPE">Tamperproof #:</label>
					<input type="text" name="TPE"  id="new_pw" placeholder="Tamproof envelope number" id="TPE" required>
	                                <label for="key_serial">Key serial number:</label>
	                                <input type="text" name="key_serial" placeholder="Key serial or unique number" id="key_serial" required>
                                        <label for="safe_name">Safe name:</label>
					<select name="safe_id">
					<?php
					$sql = mysqli_query($con, "SELECT id, safe_name FROM safes ORDER BY safe_name");
					while ($row = $sql->fetch_assoc()){
						echo "<option value=\"" . $row['id'] . "\">" . $row['safe_name'] . "</option>";
					}
					?>
					</select>
                                        <label for="system_id">System name:</label>
					<select name="system_id">
					<?php
					$sql = mysqli_query($con, "SELECT id, system_name FROM systems ORDER BY system_name");
					while ($row = $sql->fetch_assoc()){
						echo "<option value=\"" . $row['id'] . "\">" . $row['system_name'] . "</option>";
					}
					?>
					</select>
                                        <label for="region_name">Region name:</label>
					<select name="region_id">
					<?php
					$sql = mysqli_query($con, "SELECT id, region_name FROM regions ORDER BY region_name");
					while ($row = $sql->fetch_assoc()){
						echo "<option value=\"" . $row['id'] . "\">" . $row['region_name'] . "</option>";
					}
					?>
					</select>
                                        <label for="media_type">Media type:</label>
					<select name="media_type_id">
					<?php
					$sql = mysqli_query($con, "SELECT id, media_type FROM media_types ORDER BY media_type");
					while ($row = $sql->fetch_assoc()){
						echo "<option value=\"" . $row['id'] . "\">" . $row['media_type'] . "</option>";
					}
					?>
					</select>
                                        <label for="key_type">Key type:</label>
					<select name="key_type_id">
					<?php
					$sql = mysqli_query($con, "SELECT id, key_type FROM key_types ORDER BY key_type");
					while ($row = $sql->fetch_assoc()){
						echo "<option value=\"" . $row['id'] . "\">" . $row['key_type'] . "</option>";
					}
					?>
					</select>

	                                <input type="submit" value="Add key">
	                </form>
		</div>
	</body>
</html>
