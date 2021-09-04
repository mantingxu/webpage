<?php 
session_start(); 
include "db_conn.php";

if (isset($_POST['uname']) && isset($_POST['password'])) {

	function validate($data){
       $data = trim($data);
	   $data = stripslashes($data); // 去除字串中多餘的反斜線(\)
	   $data = htmlspecialchars($data); // 將 HTML 符號變成不可執行的符號
	   return $data;
	}


	$uname = validate($_POST['uname']);
	$pass = validate($_POST['password']);

	if (empty($uname)) {
		header("Location: index.php?error=User Name is required");
	    exit();
	}
    else if(empty($pass)){
        header("Location: index.php?error=Password is required");
	    exit();
	}

    else{
		// hashing the password
        $pass = md5($pass);

        
		$sql = "SELECT * FROM users WHERE user_name='$uname' AND password='$pass'";

		$result = mysqli_query($conn, $sql);


		if (mysqli_num_rows($result) === 1) {
			$row = mysqli_fetch_assoc($result);
            $_SESSION['user_name'] = $row['user_name'];
            $_SESSION['name'] = $row['name'];
            $_SESSION['id'] = $row['id'];
			$_SESSION['email'] = $row['email'];
			if($row['verify']==1){
				header("Location: ../Grocery/grocery.php");
				exit();
			}
			else{
				header("Location: home.php");
				exit();
			}

		}
        else{
			header("Location: index.php?error=Incorrect User name or password");
	        exit();
		}
	}
}
else{
	header("Location: index.php");
	exit();
}
