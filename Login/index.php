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
<body>
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
            </ul>

            <!-- social media -->
            <ul class="social-icons">
                <li>
                    <a href="https://www.twitter.com">
                        <i class="fab fa-facebook"></i>
                    </a>
                </li>
                <li>
                    <a href="https://www.twitter.com">
                        <i class="fab fa-twitter"></i>
                    </a>
                </li>
                <li>
                    <a href="https://www.twitter.com">
                        <i class="fab fa-instagram"></i>
                    </a>
                </li>

            </ul>
        </div>
    </nav>
    <!-- login inteface -->
    <div class="body">
        <form action="login.php" method="post">
            <i class="fas fa-shopping-cart"></i>
     	    <h2>LOGIN</h2>
            <a href="register.php" class="ca">Create new account</a>
     	    <?php if (isset($_GET['error'])) { ?>
     		    <p class="error"><?php echo $_GET['error']; ?></p>
     	    <?php } ?>
             <?php if (isset($_GET['success'])) { ?>
     		    <p class="success"><?php echo $_GET['success']; ?></p>
     	    <?php } ?>
            <br><br>
     	    <label>User Name</label>
     	    <input type="text" name="uname" placeholder="User Name"><br>


     	    <label>Password</label>
     	    <input type="password" name="password" placeholder="Password"><br>

     	    <button type="submit">Login</button>
            <a href="forget.php" class="ca">forget password?</a>
            
        </form>
    </div>

    <!-- javascript -->
    <script src="../NavBar/navbar.js"></script>

</body>
</html>
