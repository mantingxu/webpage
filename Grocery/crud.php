<?php
session_start();
include "/var/www/html/purePHP/Login/db_conn.php";
$update = true;

$_SESSION['grocery'] = "";
$_SESSION['message'] = "";
$_SESSION['good_id'] = "";

if(isset($_GET['delete'])){
    $id = $_GET['delete'];
    $sql = "DELETE FROM grocery WHERE id='$id'";
    $result = mysqli_query($conn, $sql);

    $_SESSION['message'] = "Grocery has been deleted!";
    $_SESSION['message_type'] = "success";
    header("location: grocery.php");
}


if(isset($_GET['clear'])){
    $userId = $_GET['clear'];
    $sql = "DELETE FROM grocery WHERE user_id='$userId'";
    $result = mysqli_query($conn, $sql);

    $_SESSION['message'] = "All groceries have been deleted!";
    $_SESSION['message_type'] = "success";

    header("location: grocery.php");
}

if(isset($_GET['edit'])){
    $update = true;
    $id = $_GET['edit'];
    $sql = "SELECT * FROM grocery WHERE id='$id'";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) === 1) {
        $row = mysqli_fetch_assoc($result);
        $buy = $row['good'];
        $_SESSION['grocery'] = $row['good'];
        $_SESSION['good_id'] = $row['id'];
    }
    
    header("location: grocery.php?true");
}

if(isset($_POST['submit'])){
    $id = $_POST['id'];
    $goods = $_POST['goods'];
    if($id == ""){
        $_SESSION['message'] = "Please choose a grocery you want to edit!";
        $_SESSION['message_type'] = "error";
        header("location: grocery.php");
        exit(); 
    }
    if($goods == ""){
        $_SESSION['message'] = "Grocery cannot be empty!";
        $_SESSION['message_type'] = "error";
        header("location: grocery.php");
        exit();
    }
    $sql = "UPDATE grocery SET good='$goods' WHERE id='$id'";
    $result = mysqli_query($conn, $sql);
    $_SESSION['good_id'] = "";
    $_SESSION['message'] = "Grocery has been updated!";
    $_SESSION['message_type'] = "success";
    header("location: grocery.php");
}

if(isset($_POST['insert'])){
    $id = $_POST['userId'];
    
    
    $goods = $_POST['goods'];
    if($goods == "") {
        $_SESSION['message'] = "Grocery cannot be empty!";
        $_SESSION['message_type'] = "error";
        header("location: grocery.php");
        exit();
    }
    $sql = "INSERT INTO  grocery(user_id,good) VALUES('$id','$goods') ";
    $result = mysqli_query($conn, $sql);
    $_SESSION['good_id'] = "";
    $_SESSION['message'] = "Grocery has been inserted!";
    $_SESSION['message_type'] = "success";

    header("location: grocery.php");
}

