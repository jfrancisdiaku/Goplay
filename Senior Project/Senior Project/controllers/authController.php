<?php


session_start();

require 'config/db.php';


$errors = array();
$username = "";
$email = "";
$fname = "";
$lname = "";


// if user clicks on sign up button
if (isset($_POST['signup-btn'])){
  $fname = $_POST['fname'];
  $lname = $_POST['lname'];
  $username = $_POST['username'];
  $email = $_POST['email'];
  $descrip = $_POST['descrip'];
  $password = $_POST['password'];
  $passwordConf = $_POST['passwordConf'];
  $longitude = $_POST['longitude'];
  $latitude = $_POST['latitude'];
  

  if(isset($_FILES['image'])){
    $img_name = $_FILES['image']['name'];
    $img_type = $_FILES['image']['type'];
    $tmp_name = $_FILES['image']['tmp_name'];
    
    $img_explode = explode('.',$img_name);
    $img_ext = end($img_explode);

    $extensions = ["jpeg", "png", "jpg"];
    if(in_array($img_ext, $extensions) === true){
        $types = ["image/jpeg", "image/jpg", "image/png"];
        if(in_array($img_type, $types) === true){
            $time = time();
            $new_img_name = $time.$img_name;
            move_uploaded_file($tmp_name,"images/".$new_img_name);
        }
      }
  }

  // validation
  if (empty($fname)){
    $errors['fname'] = "First name required";
  }
  if (empty($lname)){
    $errors['lname'] = "Last name required";
  }
  if (empty($descrip)){
    $errors['descrip'] = "description is required";
  }
  if (empty($username)){
    $errors['username'] = "Username required";
  }
  if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
    $errors['email'] = "Email address is invalid";
  }
  if (empty($email)){
    $errors['email'] = "Email required";
  }
  if (empty($password)){
    $errors['password'] = "Password required";
  }

  if($password !== $passwordConf){
    $errors['password'] = "the two passwords do not match";
  }

  if(isset($_FILES['file'])){
    print_r($_FILES['file']);

  }


  $emailQuery = "SELECT * FROM users WHERE email=? LIMIT 1";
  $stmt = $conn->prepare($emailQuery);
  $stmt->bind_param('s', $email);
  $stmt->execute();
  $result = $stmt->get_result();
  $userCount = $result->num_rows;
  $stmt->close();

  if($userCount > 0){
    $errors['email'] = "Email already exists";
  }

  if(count($errors) === 0){
    $password = password_hash($password, PASSWORD_DEFAULT);
    $token = bin2hex(random_bytes(50));
    $verified = false;

    $sql = "INSERT INTO users (fname, lname, username, image,  email, descrip, verified, token, password, longitude, latitude) VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('ssssssdssss', $fname, $lname, $username, $new_img_name, $email, $descrip, $verified, $token, $password, $longitude, $latitude );
    
    
    if($stmt->execute()){
      // login user
      $user_id = $conn->insert_id;
      $_SESSION['fname'] = $fname;
      $_SESSION['lname'] = $lname;
      $_SESSION['id'] = $id;
      $_SESSION['username'] = $username;
      $_SESSION['email'] = $email;
      $_SESSION['descrip'] = $descrip;
      $_SESSION['verified'] = $verified;
      $_SESSION['latitude'] = $latitude;
      $_SESSION['longitude'] = $longitude;
      $_SESSION['image'] = $image;
      // set flash message
      echo 'alert("you are logged in")';
      $_SESSION['message'] = "you are now logged in";
      $_SESSION['alert-class'] = "alert-success";
      header('location:dash2.php');
      exit();
    }
    else{
      $errors['db_error'] = "Database error: failed to register";
    }

  }

}

// if user clicks login button
if (isset($_POST['login-btn'])){
  $username = $_POST['username'];
  $password = $_POST['password'];

  // validation
  if (empty($username)){
    $errors['username'] = "Username required";
  }
  if (empty($password)){
    $errors['password'] = "Password required";
  }

  $usernameQuery = "SELECT * FROM users WHERE username LIKE '$username' OR email LIKE '$email' LIMIT 1";
  $stmt = $conn->prepare($usernameQuery);
  $stmt->execute();
  $result = $stmt->get_result();
  $userCount = $result->num_rows;
  $stmt->close();

  if($userCount == 0){
    $errors['unknown-user'] = "Username or email does not exist";
  }


  if (count($errors) == 0){
    $sql = "SELECT * FROM users WHERE email=? OR username=? LIMIT 1";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('ss', $username, $username);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();


    if (password_verify($password, $user['password'])){
      //login succes
      $user_id = $conn->insert_id;
        $_SESSION['fname'] = $user['fname'];
        $_SESSION['lname'] = $user['lname'];
        $_SESSION['id'] = $user['id'];
        $_SESSION['username'] = $user['username'];
        $_SESSION['email'] = $user['email'];
        $_SESSION['descrip'] = $user['descrip'];
        $_SESSION['verified'] = $user['verified'];
        $_SESSION['longitude'] = $user['longitude'];
        $_SESSION['latitude'] = $user['latitude'];
        $_SESSION['image'] = $user['image'];
        // set flash message
        $_SESSION['message'] = "you are now logged in";
        $_SESSION['alert-class'] = "alert-success";
        header('location:dash2.php');
        exit();

    }else{
      $errors['login_fail'] = "Wrong credentials";
    }

  }

}

//logout
if (isset($_POST['logout-btn'])){
  session_destroy();
  unset($_SESSION['fname']);
  unset($_SESSION['lname']);
  unset($_SESSION['id']);
  unset($_SESSION['username']);
  unset($_SESSION['email']);
  unset($_SESSION['descrip']);
  unset($_SESSION['longitude']);
  unset($_SESSION['latitude']);
  header('location:login.php');
  exit();
}





