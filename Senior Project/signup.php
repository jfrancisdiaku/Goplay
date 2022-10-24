<?php  require_once 'controllers/authController.php'; ?>
<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="Styles.css">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Alkalami&family=Bebas+Neue&display=swap" rel="stylesheet">
    </head>
    <body>
      <title>Register</title>
      <?php include_once 'header.php'; ?>      

      <div class="container">
        <div class="row">
          <div class="col-md-4 offset-md-4 form-div">
            <form action="signup.php" method="post">
              <h3 class="text-center">Register</h3>
              
              <?php if(count($errors) > 0): ?>
                <div class="alert alert-danger">
                  <?php foreach($errors as $error): ?>
                    <li><?php echo $error; ?></li>
                  <?php endforeach; ?>
                </div>
              <?php endif; ?>

              <div class="form-group">
                <label for="username">Username</label>
                <input type="text" name="username" value="<?php echo $username; ?>" class="form-control-lg">
              </div>

              <div class="form-group">
                <label for="email">Email</label>
                <input type="email" name="email" value="<?php echo $email; ?>"class="form-control-lg">
              </div>

              <div class="form-group">
                <label for="password">Password</label>
                <input type="text" name="password" class="form-control-lg">
              </div>

              <div class="form-group">
                <label for="passwordConf">Confrim Password</label>
                <input type="password" name="passwordConf" class="form-control-lg">
              </div>

              <div class="form-group">
                <button type="submit" name="signup-btn" class="btn btn-primary btn-block btn-lg">Sign Up</button>
              </div>

              <p class="text-center">Already a member?<a href="login.php">Sign in</a></p>

            </form>
          </div>
        </div>
      </div>
        
    </body>
</html>

