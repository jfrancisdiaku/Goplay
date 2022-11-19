<?php  require_once 'controllers/authController.php'; ?>
<!DOCTYPE html>
<html>
  <head>
    <link rel="stylesheet" href="Styles.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <!--google font-->
    <link href="https://fonts.googleapis.com/css2?family=Alkalami&family=Bebas+Neue&display=swap" rel="stylesheet">

    <!--bootstrap 5-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">

    <!--line awesome-->
    <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
    <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/font-awesome-line-awesome/css/all.min.css">
  </head>
  <body>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous">
    </script>

    <!--Navbar-->
   <nav class="navbar navbar-expand-sm bg-white navbar-white py-3">
      <div class="container">
        <a href="#" class="navbar-brand"><span class="fs-1">GoPlay</span></a>

        <button 
          class="navbar-toggler" 
          type="button"
          data-bs-toggle="collapse" 
          data-bs-target="#navmenu"
        >
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="#navmenu">
          <ul class="navbar-nav ms-auto justify-content-end">
            <li class="nav-item">
              <a href="dash2.php" class="nav-link">Dashboard</a>
            </li>
            <li class="nav-item">
              <a href="messages.php" class="nav-link">messages</a>
            </li>
            <li class="nav-item">
              <a href="search-users.php" class="nav-link">search</a>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false"><?php echo $_SESSION['username']; ?></a>
              <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="account.php">account</a></li>
                <li><a class="dropdown-item" href="login.php">Logout</a></li>
              </ul>
            </li>
          </ul>
        </div>
      </div>
     </nav>

     <div class="container account-page">
      <div class="row">
          <div class="col-md-6 mt-3 offset-3 ">
            <form action="">
              <h3 class="text-center">Account Settings</h3>
              
              <div class="profile-pic-box"><span class="las la-user-circle profile-pic"></span></div>
              <div class="py-2 form-group">
                <label for="name">Update profile picture:</label>
                <input type="file" class="form-control">
              </div>

              <div class="py-2 form-group">
                <label for="name">Name: <?php echo $_SESSION['fname']. "&nbsp;" .$_SESSION['lname'];?></label>
              </div>
              <div class="py-2 form-group">
                <label for="name">username: <?php echo $_SESSION['username']?></label>
                <input type="text" class="form-control" placeholder="change username..">
              </div>
              <div class="py-2 form-group">
                <label for="name">update Description: </label>
                <textarea placeholder="<?php echo $_SESSION['descrip']?>" class="form-control" ></textarea>
              </div>
              <div class="py-2 form-group">
                <label for="name">email: <?php echo $_SESSION['email']?></label>
                <input type="email" class="form-control" placeholder="change email..">
              </div>
              <div class="py-2 form-group">
                <label for="name">Update location:</label>
                <button class="update-location-btn btn btn-warning btn"><span class="las la-location-arrow"></span></button>
              </div>
              <div class="py-2 form-group">
                <label for="name">change password:</label>
                <input type="email" class="form-control" placeholder="new password..">
                <input type="email" class="form-control" placeholder="confirm password..">
              </div>
              <div class="form-group">
                <button class="update-btn btn btn-primary btn-lg">update</button>
              </div>
            </form>
          </div>
        </div>
      </div>
     </div>
    
  </body>
</html>