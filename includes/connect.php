<?php
	session_start();

if (isset($_SESSION['role'])==false) {

    $name=null;
	$role=null;
	$_SESSION['name']=$name;
	$_SESSION['role']=$role;
	$_SESSION['user_id']=null;
	$_SESSION['admin_sid']=null;
	$_SESSION['customer_sid']=null;
}
$servername = "localhost";
$server_user = "root";
$server_pass = "";
$dbname = "food";
$name = $_SESSION['name'];
$role = $_SESSION['role'];



$con = new mysqli($servername, $server_user, $server_pass, $dbname);
?>