<?php
session_start();
include "db_conn.php";
    if (isset($_POST["verification_code"]))
    {
        $email = $_SESSION['email'];
        $verification_code = $_SESSION['code'];
        $boolean =1;
        if($_POST["verification_code"] == $verification_code){
            $sql = "UPDATE users SET verify='".$boolean."' WHERE email = '" . $email . "'" ; 
            $result  = mysqli_query($conn, $sql);
            header("Location: ../Grocery/grocery.html");
            exit();
        }
        else{
            header("Location: email-verification.php?error=Wrong verification code ,please enter again.");
            
            exit();
        }
     
   
        
        
    }
 
?>



<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<title>LOGIN</title>
    <!-- css -->
	<link rel="stylesheet" type="text/css" href="style.css">
    <!-- font-awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css" />
</head>
<body style="background-image:url('https://wimg.ruan8.com/uploadimg/image/20190402/20190402163328_31815.jpg')">
         <!-- nav-bar -->
        <nav>
            <div class="nav-center">
            <!-- nav header -->
            <div class="nav-header">
                <img src="../NavBar/logo.png" class="logo" alt="logo" />
                <button class="nav-toggle">
                    <i class="fas fa-bars"></i>
                </button>
            </div>


            <!-- links -->
            <ul class="links">
                <li>
                    <a href="http://134.208.3.125/">home</a>
                </li>
                <li>
                    <a href="about.html">about</a>
                </li>
                <li>
                    <a href="projects.html">projects</a>
                </li>
                <li>
                    <a href="contact.html">contact</a>
                </li>
                <li>
                    <a href="logout.php">Logout</a>
                </li>
     
            </ul>

            <ul class="social-icons">
                <li>
                    <a href="logout.php">Logout</a>
                </li>
            </ul>
            </div>
        </nav>
        
    <div class="body">
    <form method="POST">
        <?php if (isset($_GET['error'])) { ?>
     		    <p class="error"><?php echo $_GET['error']; ?></p>
         <?php } ?>
        <input type="hidden" name="email" value="<?php echo $_GET['email']; ?>" required>
        <input type="text" name="verification_code" placeholder="Enter verification code" required />
 
        <input type="submit" name="verify_email" value="Verify Email">
    </form>
    </div>
</body>
</html>