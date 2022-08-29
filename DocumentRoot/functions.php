<?php
function generate_password() {
	$command = "/usr/bin/pwqgen";
	exec($command, $out, $ret);
	if ( $ret == 0 ) {
        	$passphrase = $out[0];
		return $passphrase;
	} else {
		return "Failed to generate password!";
	}
}

function update_key_hash($con,$id)
{
        // These selected items are used to created key item hash which is then updated
        // I have deliberately not used 
        // date_inventoried
        // comments
        // TPE
        $stmt = $con->prepare("SELECT id, imported_id, key_name, safe_id, system_id, region_id, date_added, created_by, date_removed, client_name, client_number, bin_number, device_serial, key_serial, comb_KCV, media_type_id, key_type_id from `keys` WHERE id = ?");
        $stmt->bind_param ('i', $id);
        $stmt->execute();
	$stmt->store_result();
        $stmt->bind_result($key_id, $imported_id, $key_name, $safe_id, $system_id, $region_id, $date_added, $created_by, $date_removed, $client_name, $client_number, $bin_number, $device_serial, $key_serial, $comb_KCV, $media_type_id, $key_type_id);
        $stmt->fetch();
	$key_string=$key_id.$imported_id.$key_name.$safe_id.$system_id.$region_id.$date_added.$created_by.$date_removed.$client_name.$client_number.$bin_number.$device_serial.$key_serial.$comb_KCV.$media_type_id.$key_type_id;
	$r = hash("sha256",$key_string,false);
	$stmt = $con->prepare("UPDATE `keys` SET hash = '$r' WHERE id='$id'");
	$stmt->execute();
	return [$r, $key_string];
}

function clean_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
