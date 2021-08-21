<?php  

$sname = "localhost";
$uname = "root";
$password = "880609";

$db_name = "purePHP";

$conn = mysqli_connect($sname, $uname, $password, $db_name);

if (!$conn) {
	echo "Connection failed!";
	exit();
}

?>