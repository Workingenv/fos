<?php
include '../includes/connect.php';
	foreach ($_POST as $key => $value)
	{
		if(preg_match("/description_+[0-9]/",$key)){
			if($value != ''){
			$key = strtok($key, '_');
			$key = strtok('_');
			$value = htmlspecialchars($value);
			$sql = "UPDATE special_items SET description = '$value' WHERE id = $key;";
			$con->query($sql);
			}
		}
	}
header("location: ../admin-page.php");
?>