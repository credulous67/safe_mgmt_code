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
if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $key_name=clean_input($_POST['key_name']);
        $safe_id=clean_input($_POST['safe_id']);
        $system_id=clean_input($_POST['system_id']);
        $region_id=clean_input($_POST['region_id']);
        $user_id=clean_input($_SESSION['id']);
        $TPE=clean_input($_POST['TPE']);
        $key_serial=clean_input($_POST['key_serial']);
        $media_type_id=clean_input($_POST['media_type_id']);
        $key_type_id=clean_input($_POST['key_type_id']);
	if ($stmt = $con->prepare("INSERT INTO `keys` (key_name, safe_id, system_id, region_id, created_by, TPE, key_serial, media_type_id, key_type_id) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)")) {
		$stmt->bind_param ('siiiissii',$key_name,$safe_id,$system_id,$region_id,$user_id,$TPE,$key_serial,$media_type_id,$key_type_id);
		$stmt->execute();
		$new_key_id= mysqli_insert_id($con);
		[$sha256_hash,$sha1_hash,$keystring]=update_key_hash($con, $new_key_id);
?>
<!DOCTYPE html>
<html>
        <head>
                <meta charset="utf-8">
		<meta http-equiv="refresh" content="6;url=http://127.0.0.1:8080/insert_key_form.php">
                <title>Insert new key</title>
                <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
                <link href="style.css" rel="stylesheet" type="text/css">
        </head>
        <body class="loggedin">
                <?php require_once(__DIR__.'/navtop.php'); ?>
                <?php require_once(__DIR__.'/sidebar.php'); ?>
                <div class="content">
                        <h2>Insert new key</h2>
                        <div class="container">

                        <h2>Insert new key</h2>
                        <p>New key successfully added to the database</p>
                        <p>ID:<?=$new_key_id?></p>
                        <p>SHA256 HASH:<?=$sha256_hash?></p>
                        <p>SHA1 HASH:<?=$sha1_hash?></p>
                        <p>KEYSTRING:<?=$keystring?></p>
<?php
//	echo "<script> alert('New item added to database')</script>";
//	header('Location: insert_key_form.php');
	exit;
	} else {
		// failed to insert
		echo "failed to insert";

	}
} else {
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
                        <div class="container">


<!--	                <form class="form-inline" action="insert_key_script.php" method="post"> -->
			<form class="form-inline" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
				<div class="row">
					<div class="col-25">
	                                <label for="key_name">Key name:</label>
					</div>
					<div class="col-25">
	                                <input type="text" name="key_name" placeholder="Enter key name" id="key_name" required autofocus title="Key name, required" >
					</div>
<!-- can use this to display validation message
					<div class="col-50"><label>test message</label></div> -->
				</div>
				<div class="row">
					<div class="col-25">
	                                <label for="TPE">Tamperproof #:</label>
					</div>
					<div class="col-25">
					<input type="text" name="TPE"  id="new_pw" placeholder="Tamproof envelope number" id="TPE" required title="Tamperproof envelope number, required">
					</div>
				</div>
				<div class="row">
					<div class="col-25">
	                                <label for="key_serial">Key serial number:</label>
					</div>
					<div class="col-25">
	                                <input type="text" name="key_serial" placeholder="Key serial or unique number" id="key_serial" required title="Serial number unique to key, required">
					</div>
				</div>
				<div class="row">
					<div class="col-25">
                                        <label for="safe_name">Safe name:</label>
					</div>
					<div class="col-25">
					<select name="safe_id" required">
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
					<div class="col-25">
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
					<div class="col-25">
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
					<div class="col-25">
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
					<div class="col-25">
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
					<div class="col-25"></div>
					<div class="col-25">
	                                <input type="submit" value="Add new key">
					</div>
				</div>
	                </form>
<?php } ?>
			</div>
		</div>
	</body>
</html>
