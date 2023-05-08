<?php
$DATABASE_HOST = 'mariadb';
$DATABASE_USER = '_svc_sm';
$DATABASE_PASS = 'smpass';
$DATABASE_NAME = 'safe_mgmt';
// Try and connect using the info above.
$con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
if ( mysqli_connect_errno() ) {
        // If there is an error with the connection, stop the script and display the error.
        exit('Failed to connect to MySQL: ' . mysqli_connect_error());
}
?>
