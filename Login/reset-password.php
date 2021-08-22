<html>
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Reset Password</title>
        <!-- css -->
	    <link rel="stylesheet" type="text/css" href="style.css">
        <!-- font-awesome -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css" />
    </head>
    <body>

        <div class="body">
            <?php
            include "db_conn.php";
            if (isset($_GET["key"]) && isset($_GET["email"]) && isset($_GET["action"]) && ($_GET["action"] == "reset") && !isset($_POST["action"])){
                $key = $_GET["key"];
                $email = $_GET["email"];

                $query = mysqli_query($conn, "SELECT * FROM `users` WHERE `forgetKey`='" . $key . "' and `email`='" . $email . "';");
                $row = mysqli_num_rows($query);
                if ($row == "") {
                    $error .= '<h2>Invalid Link</h2>';
                } else {
                    $row = mysqli_fetch_assoc($query);
                    $id = $row['id'];
                }
            }
            ?> 
            <form method="post" action="change-password.php" name="update">
                <?php if (isset($_GET['error'])) { ?>
                    <p class="error"><?php echo $_GET['error']; ?></p>
                <?php } ?>
                <h2>Reset Password</h2>   
                <input type="hidden" name="action" value="" class="form-control"/>
                <label>Enter New Password:</label>
                <input type="password"  name="pass1" value="" class="form-control"/>
                <label>Re-Enter New Password:</label>
                <input type="password"  name="pass2" value="" class="form-control"/>
                <input type="hidden" name="email" value="<?php echo $email; ?>"/>
                <input type="hidden" name="id" value="<?php echo $id; ?>"/>
                <input type="submit" id="reset" value="Reset Password"  class="btn btn-submit"/>

            </form>
        </div>


    </body>
</html>
<!-- tutorial forget password  -->
<!-- https://rathorji.in/p/php_forgotrest_password_recover_code_using_phpmailer_smtp -->

<?php
                        if(isset($_GET["error"])){

                        }
                    ?>