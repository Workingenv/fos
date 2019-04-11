<?php
include '../includes/connect.php';
	foreach ($_POST as $key => $value)
	{
		if(preg_match("/name_+[0-9]/",$key)){
			if($value != ''){
			$key = strtok($key, '_');
			$key = strtok('_');
			$value = htmlspecialchars($value);
			$sql = "UPDATE items SET name = '$value' WHERE id = $key;";
			$con->query($sql);
			}
		}
		if(preg_match("/price_+[0-9]/",$key)){
			$key = strtok($key, '_');
			$key = strtok('_');
			$sql = "UPDATE items SET price = $value WHERE id = $key;";
			$con->query($sql);
		}
		if(preg_match("/[0-9]+_hide/",$key)){
			if($_POST[$key] == 1){
			$key = strtok($key, '_');
			$sql = "UPDATE items SET deleted = 0 WHERE id = $key;";
			$con->query($sql);
			} else{
			$key = strtok($key, '_');
			$sql = "UPDATE items SET deleted = 1 WHERE id = $key;";
			$con->query($sql);			
			}
		}
		if(preg_match("/category_+[0-9]/",$key)){
			if($value != ''){
			$key = strtok($key, '_');
			$key = strtok('_');
			$value = htmlspecialchars($value);
			$sql = "UPDATE items SET category = '$value' WHERE id = $key;";
			$con->query($sql);
			}
		}
	}
	
	foreach($_FILES as $key => $value){
		
		//check for error
		if(preg_match("/[0-9]+_imagename/",$key)&&($_FILES[$key]["error"]==false)){
					$newfilename="default.jpg";
					$target_dir = "../images/food/";
					$target_file = $target_dir . basename($_FILES[$key]["name"]);
					$uploadOk = 1;
					$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
					// Check if image file is a actual image or fake image
					if(isset($_POST["submit"])) {
						$check = getimagesize($_FILES[$key]["tmp_name"]);
						if($check !== false) {
							$uploadOk = 1;
						} else {
							$uploadOk = 0;
						}
					}
					// Check file size and extension
					if ((($imageFileType == "jpg")
						|| ($imageFileType == "jpeg")
						||	($imageFileType == "png"))
						&& ($_FILES[$key]["size"] < 102400)) {
							$uploadOk = 1;
						}

					// Check if $uploadOk is set to 0 by an error
					if ($uploadOk == 0) {
						echo "Sorry, your file was not uploaded.";
					// if everything is ok, try to upload file
					} else {
						if (move_uploaded_file($_FILES[$key]["tmp_name"], $target_file)) {
							$filename=$_FILES[$key]["name"];
							$filenamearray=explode(".", $filename,2);
							$newfilename=time() .".".$filenamearray[1];
							rename($target_dir.$filename, $target_dir.$newfilename); 
							$key = strtok($key, '_');
							//delete old image
							//$pathtoimage=$_SERVER['DOCUMENT_ROOT']."/images/food/".$_POST["$key"];
							//unlink($pathtoimage);
							$sql = "UPDATE items SET imagename = '$newfilename' WHERE id = $key;";
							$con->query($sql);
						} else {
							echo "Sorry, there was an error uploading your file.";
						}
					}		

		}
		
			
	}
header("location: ../admin-page.php");
?>