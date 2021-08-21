<?php 

if (isset($_POST['submit']) && isset($_FILES['my_image'])) {
	include "db_conn.php";

	echo "<pre>";
	print_r($_FILES['my_image']);
	echo "</pre>";

	$img_name = $_FILES['my_image']['name'];
	$img_size = $_FILES['my_image']['size'];
	$tmp_name = $_FILES['my_image']['tmp_name'];
	$error = $_FILES['my_image']['error'];

	if ($error === 0) {
		if ($img_size > 125000) {
			$em = "Sorry, your file is too large.";
		    header("Location: index.php?error=$em");
		}
        else {
            // create an unique image file name
            $new_img_name = strtotime("now").".png";
			$img_upload_path = "uploads/".$new_img_name; // may permission denied
         
            
			move_uploaded_file($tmp_name, $img_upload_path);
 
         
			// Insert into Database
			$sql = "INSERT INTO images(image_url) VALUES('$new_img_name')";
			mysqli_query($conn, $sql);
			header("Location: view.php?show=$img_upload_path");
	
		}
	}else {
		$em = "unknown error occurred!";
		header("Location: index.php?error=$em");
	}

}else {
	header("Location: index.php");
}

?>