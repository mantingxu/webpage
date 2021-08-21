<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Image Upload Using PHP</title>
    <!-- jQuery -->
    <script class="jsbin" src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
    <!-- font-awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css" />
    <!-- styles -->
    <link rel="stylesheet" href="../NavBar/styles.css" />
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

	<?php if (isset($_GET['error'])): ?>
        <div class="alert alert-danger" >
            <h4><?php echo $_GET['error']; ?></h4>
        </div>

	<?php endif ?>
    <main>
        <img id="show" width="300" src="show.jpg" alt="your image" />
        <div class="container">
         <form action="upload.php" method="post" enctype="multipart/form-data">
            <input type="button" class="btn btn-hero" value="Choose file" onclick="document.getElementById('file').click();" />
            <input type="file" style="display:none;" id="file" name="my_image" accept=".jpg ,.png ,.jpeg" onchange="readURL(this);"/>
     
            <input type="submit" class="btn btn-hero" name="submit" value="Upload">
         </form>
        </div>
    </main>

    <!-- javascript -->
    <script src="../NavBar/navbar.js"></script>
    <script>
        function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) { // FileReader.onload()  // triggered the function when reading is complete.
                $('#show')
                    .attr('src', e.target.result) // get the content
                    .width(300);
            };

            reader.readAsDataURL(input.files[0]); // implement the function when the file completely load
            // .readAsDataURL(blob) read the contents of the specified type ex. Blob
            // use base64 encode the data
        }
    }





    const alert = document.querySelector(".alert-danger");
    if(alert){
        setTimeout(function () {
            alert.textContent = '';
            alert.classList.remove("alert-danger");
        }, 3000);
    }

    </script>


</body>
</html>