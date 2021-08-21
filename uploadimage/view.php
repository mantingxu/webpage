<?php include "db_conn.php"; ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>View Image</title>
    <!-- font-awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css" />
    <!-- styles -->
    <link rel="stylesheet" href="../NavBar/styles.css" />
	<style>
		/* body {
			display: flex;
			justify-content: center;
			align-items: center;
			flex-wrap: wrap;
			min-height: 100vh;
		} */

		a {
			text-decoration: none;
			color: black;
		}
	</style>
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
                    <a href="index.html">home</a>
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
	<main>
	<?php if(isset($_GET['show'])) { ?>
        <div class="alb">
            <img width="300" src="<?=$_GET['show']?>">
        </div>
		<form action="">
			<input type="text" id="myInput" value="http://134.208.3.125/purePHP/uploadimage/<?=$_GET['show']?>">
		</form>
		<div class="tooltip">
			<button class="btn btn-hero" onmouseout="outFunc()" onclick="copy()">  <span class="tooltiptext" id="myTooltip">Copy to clipboard</span>copy link</button>
		</div>
	<?php } ?>
	</main>


    <!-- javascript -->
    <script src="../NavBar/navbar.js"></script>
	<script>
		function copy(){
			let copyText = document.querySelector("#myInput");
			copyText.select();
			copyText.setSelectionRange(0, 99999); /* For mobile devices */
			document.execCommand('Copy');
			// show tip
			var tooltip = document.getElementById("myTooltip");
			tooltip.innerHTML = "Copied the link";

		}
		// onmouseout event
		function outFunc() {
  			var tooltip = document.getElementById("myTooltip");
  			tooltip.innerHTML = "Copy to clipboard";
		}
	</script>
</body>
</html>


