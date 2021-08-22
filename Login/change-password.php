<?php
include "db_conn.php";
if(isset($_POST['pass1']) && isset($_POST['pass1'])){
    $id = $_POST['id'];
    $pass = $_POST['pass1'];
    $pass1 = $_POST['pass2'];
    // if(!$pass){
    //     header("Location: reset-password.php?error=Please enter the new password.");
    // }
    // if(!$pass1){
    //     header("Location: reset-password.php?error=Please repeat the password again.");
    // }
    if($pass != $pass1){
        header("Location: reset-password.php?error=Password do not match, both password should be same.");
    }
    else{
        $password = md5($pass);
        $sql = "UPDATE users SET password='".$password."' WHERE id=$id";
        if(mysqli_query($conn,$sql)){
            header("Location: index.php?success=change password sucessfully!");
        }
        else{
            header("Location: reset-password.php?error=Sorry! There is a mistake happen, please entry password again!");
        }
        
    }
}

?>