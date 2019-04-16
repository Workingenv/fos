<?php
$wallet_id=null;
$balance=0;
$user_id=$_SESSION['user_id'];


$sql = mysqli_query($con, "SELECT * FROM wallet where customer_id = $user_id");

if($sql==true){
while($row1 = mysqli_fetch_array($sql)){
	if(isset($row['id']))
		$wallet_id = $row1['id'];
	
}
}

$sql = mysqli_query($con, "SELECT * FROM wallet_details where wallet_id = $wallet_id");
if($sql==true){
while($row1 = mysqli_fetch_array($sql)){
$balance = $row1['balance'];
}
}
?>