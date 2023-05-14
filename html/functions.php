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
?>
