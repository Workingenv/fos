<?php
include '../includes/connect.php';

$newfilename="default.jpg";
$target_dir = "../images/food/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
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
    && ($_FILES["fileToUpload"]["size"] < 102400)) {
			$uploadOk = 1;
}

// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
		$filename=$_FILES["fileToUpload"]["name"];
		$filenamearray=explode(".", $filename,2);
		$newfilename=time() .".".$filenamearray[1];
		rename($target_dir.$filename, $target_dir.$newfilename); 
		echo "<script type='text/javascript'>alert('$newfilename');</script>";
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}

$name = $_POST['name'];
$price = $_POST['price'];
$category= $_POST['category'];
$sql = "INSERT INTO items (name, price, category,imagename) VALUES ('$name', $price, '$category','$newfilename')";
$con->query($sql);
header("location: ../admin-page.php");
?>