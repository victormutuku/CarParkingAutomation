<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Login</title>
    <link rel="stylesheet" href="indexstyle.css">
  </head>
  <body>
    <div class="login-box">
      <h1>Login</h1>

      <form action="web_actions.php" method="POST">
        <div class="textbox">
          <i class="fas fa-user"></i>
          <input type="text" placeholder="User Token" required="required" name="token">
        </div>

        <div class="textbox">
          <i class="fas fa-lock"></i>
          <input type="password" placeholder="Password" required="required" name="password">
        </div>

        <div>
          
          <button type="submit" name="login" class="login-button">Login</button>
        </div>
      </form>
      <?php
        if(!isset($_GET['login'])){
          exit();
        }else{
          $loginError = $_GET['login'];

          if($loginError == "credentials"){
            echo "<p class='error'>Invalid Credentials</p>";
            exit();
          }
        }
      ?>
    </div>
  </body>
</html>
  
