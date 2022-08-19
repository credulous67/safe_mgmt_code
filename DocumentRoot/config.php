$servername="groucho.credulous.home";
$username="sm_user";
$password="sm_user";
$db = "safe_mgmt";

$con = mysqli_connect($servername, $username, $password, $db);

#if ($conn->connect_error) {
#        die("Connection to database failed ".$conn->connect_error);
#}
if ($con === false) {
        die("Connection to database failed " . mysqli_connect_error());
}

