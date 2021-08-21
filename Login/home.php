<?php 
session_start(); // get the session variable

if (isset($_SESSION['id']) && isset($_SESSION['user_name'])) {

 ?>
<!DOCTYPE html>
<html>
<head>
     <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<title>HOME</title>

     <!-- css -->
     <link rel="stylesheet" href="style.css">
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
  
     <h1 style="color:teal;margin-top:20px;">Hello, <?php echo $_SESSION['name']; ?></h1>
     <h4>You can give me your email and verify it.</h4>
     <h4>If you forget your password, we can through your email to get back your account.</h4>
     <div class="body">
        <form action="verify.php" method="post">
            <i class="far fa-envelope"></i>
     	    <h2>Verify Email</h2>
              <?php if (isset($_GET['error'])) { ?>
     		    <p class="error inner"><?php echo $_GET['error']; ?></p>
     	    <?php } ?>
              <p class="message"></p>
    
              

     	    <label>Email</label>
     	    <input type="email" name="email" id="email" placeholder="Email"><br>
            
        
     	    <button type="submit"  id="verify">Verify</button>
             <a href="../Grocery/grocery.html" class="ca">skip this step</a>
        </form>
    </div>
     

 


     <!-- javascript -->
    <script src="navHome.js"></script>

     <script>
          function validateEmail(email) {
               const re = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
               return re.test(String(email).toLowerCase());
 
          }
          const email = document.getElementById("email");
          email.addEventListener('keyup',function(e){
               let result = validateEmail(e.target.value);
               if(!result){
                    const message = document.querySelector(".message");
                    message.classList.remove("success");
                    message.classList.add("error");
                    message.textContent = "invalid email";
                    const error = document.querySelector(".inner");
                    error.classList.add("disappear");
               }
               else{
                    const message = document.querySelector(".message");
                    message.classList.remove("error");
                    message.classList.add("success");
                    message.textContent = "valid email";
                    const error = document.querySelector(".inner");
                    error.classList.add("disappear");

               }
          });

          


     </script>

</body>

</html>

<?php 
}else{
     header("Location: index.php");
     exit();
}
 ?>