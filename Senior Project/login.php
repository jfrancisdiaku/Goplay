<!DOCTYPE html>
<html>
    <head>
        <title>Login</title>
        <link rel="stylesheet" href="Styles.css">
        <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Alkalami&family=Bebas+Neue&display=swap" rel="stylesheet">
    </head>
    <body>
      <?php include_once 'header.php'; ?>      

      <div class="container">
        <div class="row">
          <div class="col-md-4 offset-md-4 form-div">
            <form action="signup.php" method="post">
              <h3 class="text-center">Login</h3>
              
              <div class="form-group">
                <label for="username">Username or email</label>
                <input type="text" name="username" class="form-control-lg">
              </div>

              <div class="form-group">
                <label for="password">Password</label>
                <input type="password" name="passwords" class="form-control-lg">
              </div>

              <div class="form-group">
                <button type="submit" name="login-btn" class="btn btn-primary btn-block btn-lg">Login</button>
              </div>

              <p class="text-center">Don't have an account? <a href="signup.php">Register</a></p>

            </form>
          </div>
        </div>
      </div>
        
    </body>
</html>