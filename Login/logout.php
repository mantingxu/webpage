<?php 
session_start(); // create

session_unset(); // clear session variable

session_destroy(); // delete session file & session id 

header("Location: index.php"); // 