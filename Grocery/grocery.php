<?php session_start() ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Grocery Bud</title>
    <!-- font-awesome -->
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css"
    />
    <!-- styles -->
    <link rel="stylesheet" href="styles.css" />
  </head>
  <body>
      <section class="section-center">
          <!-- form -->
          <form action="crud.php" class="grocery-form" method="POST">
              <?php if(isset($_SESSION['message']) && $_SESSION['message']!=""){ ?>
                <p class="<?php echo $_SESSION['message_type'];?>"><?php echo $_SESSION['message'];?></p>
                <?php } ?>              
              <h3>grocery bud</h3>
              <div class="form-control">
              <input type="hidden" name="userId" value="<?php echo $_SESSION['id'] ; ?>">
                  <input type="hidden" name="id" value="<?php echo  $_SESSION['good_id']; ?>">
                  <input type="text" name="goods" id="grocery" placeholder="e.g eggs" value='<?php echo $_SESSION['grocery'] ; ?>'>
                  <button type="submit" style="background-color:pink;" class="submit-btn" name="insert" id="submit">insert</button>
                  <button type="submit"  class="submit-btn" name="submit" id="submit">update</button>
                
                </div>
          </form>

          <!-- list -->
          <div class="grocery-container show-container">
                <?php
                    include "/var/www/html/purePHP/Login/db_conn.php";
                    $userName = $_SESSION['user_name'];
                    $sql = "SELECT * FROM users WHERE user_name='$userName'";
                    $result = mysqli_query($conn, $sql);
                    if (mysqli_num_rows($result) === 1) {
                        $row = mysqli_fetch_assoc($result);
                        $id = $row['id'];
                    }
                    
                    $host = "localhost";
                    $user = "root";
                    $password = "880609";
                    $dbname = "purePHP";
                    $dsn = 'mysql:host='. $host . ';dbname='. $dbname;
                    $pdo = new PDO($dsn, $user, $password);
                    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE,PDO::FETCH_OBJ);
                    $stmt = $pdo->query('SELECT * FROM articles');
                    $sql1 = 'SELECT * FROM grocery WHERE user_id=?';
                    $stmt = $pdo->prepare($sql1);
                    $stmt->execute([$id]);
                    $goods = $stmt->fetchAll();
                    foreach($goods as $good){
                ?>
                    <article class="grocery-item">
                        <p class="title"><?php echo $good->good; ?></p>
                        <div class="btn-container">
                            <button type="button" class="edit-btn" id="edit" onclick="window.location.href='crud.php?edit=<?php echo $good->id?>'" >
                               
                                <i class="fas fa-edit"> </i>
                            </button>
                            <button type="button" class="delete-btn" onclick="window.location.href='crud.php?delete=<?php echo $good->id?>'">
                                <i class="fas fa-trash"></i>
                            </button>
                        </div>
                    </article>
                <?php
                    } 
                ?>
            </div>
              <!-- button -->
              <button type="button" class="clear-btn" onclick="window.location.href='crud.php?clear=<?php echo $_SESSION['id']?>'" >clear all</button>
          </div>
      </section>
  </body>
</html>