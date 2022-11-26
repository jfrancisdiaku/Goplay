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
  $image = '';
  

  if(isset($_FILES['image'])){
    $img_name = $_FILES['image']['name'];
    $img_type = $_FILES['image']['type'];
    $tmp_name = $_FILES['image']['tmp_name'];
    $img_error = $_FILES['image']['error'];
    $size = $_FILES['image']['size'];


    if($img_error == 0){
      if($size > 125000){
        $errors['size'] = "file size too big";
      }else{

      }
    }else{
      $errors['ukn-error'] = "Unkown error occured";
    }
    
    $img_explode = pathinfo($img_name, PATHINFO_EXTENSION);
    $img_ext = strtoLower($img_explode);

    $extensions = ["jpeg", "png", "jpg"];

    
    if(in_array($img_ext, $extensions) === true){
      $new_img_name = uniqid("IMG",true).'.'.$img_ext;
      $image =  $new_img_name;
      move_uploaded_file($tmp_name,"images/".$new_img_name);
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
    $stmt->bind_param('ssssssdssss', $fname, $lname, $username, $image, $email, $descrip, $verified, $token, $password, $longitude, $latitude );
    
    
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


//update btn
if (isset($_POST['update-btn'])){
  $descrip = $_POST['descrip'];
  $email = $_POST['email'];
  $password = $_POST['password'];
  $passwordConf= $_POST['passwordConf'];
  $id = $_SESSION['id'];

  $errors = array();
  $success = '';
  $update = "";


  if (empty($email)){
    $errors['no-email'] = "no email";
  }
 

  $emailQuery = "SELECT * FROM users WHERE email=? ";
  $stmt = $conn->prepare($emailQuery);
  $stmt->bind_param('s', $email);
  $stmt->execute();
  $result = $stmt->get_result();
  $userCount = $result->num_rows;
  $stmt->close();

  if($userCount > 1){
    $errors['email'] = "email already exists";
  }

  $usernameQuery = "SELECT * FROM users WHERE username=?";
  $stmt2 = $conn->prepare($usernameQuery);
  $stmt2->bind_param('s', $username);
  $stmt2->execute();
  $result2 = $stmt2->get_result();
  $userCount2 = $result2->num_rows;
  $stmt2->close();

  if($userCount2 > 1){
    $errors['username'] = "username already exists";
  }


  if($password !== $passwordConf){
    $errors['password'] = "the two passwords do not match";
  }

  if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
    $errors['email'] = "Email address is invalid";
  }

  if(empty($password) && count($errors) == 0){
    $update = "UPDATE users SET email = ?, descrip = ?  WHERE id = ?";
    $stmt3 = $conn->prepare($update);
    $stmt3->bind_param('ssi', $email, $descrip, $id);
    if($stmt3->execute()){
      $success = "update successful"; 
    }
  }
  if(!empty($password) && count($errors) == 0){
    $hashedpwd= password_hash($password, PASSWORD_DEFAULT);
    $update = "UPDATE users SET email = ?, descrip = ?, password = ? WHERE id = ?";
    $stmt3 = $conn->prepare($update);
    $stmt3->bind_param('sssi', $email, $descrip, $hashedpwd, $id);
    if($stmt3->execute()){
      $success = "update successful"; 
    }
  }
  
  

  

}

$locationUpdated = false;

//update location
if(isset($_POST['update-location-btn'])){
  $longitude = $_POST['longitude'];
  $latitude = $_POST['latitude'];
  $id = $_SESSION['id'];


  $updateLoc = "UPDATE users SET longitude = ? , latitude = ? WHERE id = ?";
  $stmt = $conn->prepare($updateLoc);
  $stmt->bind_param('ssi', $longitude, $latitude, $id);

  if($stmt->execute()){
    $locationUpdated = true;
  }


}

$picUpdated = false;

//update picture
if(isset($_POST['update-pic'])){
  $errors = array();
  $image = '';
  if(isset($_FILES['prof-pic'])){
    $img_name = $_FILES['prof-pic']['name'];
    $img_type = $_FILES['prof-pic']['type'];
    $tmp_name = $_FILES['prof-pic']['tmp_name'];
    $img_error = $_FILES['prof-pic']['error'];
    $size = $_FILES['prof-pic']['size'];


    if($img_error == 0){
    }else{
      $errors['ukn-error'] = "Unkown error occured";
    }
    
    $img_explode = pathinfo($img_name, PATHINFO_EXTENSION);
    $img_ext = strtoLower($img_explode);

    $extensions = ["jpeg", "png", "jpg"];

    
    if(in_array($img_ext, $extensions) === true){
      $new_img_name = uniqid("IMG",true).'.'.$img_ext;
      $image =  $new_img_name;
      move_uploaded_file($tmp_name,"images/".$new_img_name);
      }
  }

  $sql = "UPDATE users SET image = ? WHERE id = ?";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param('ss',$image, $_SESSION['id']);
  
  
  if($stmt->execute()){
    $picUpdated = true;
  }


}

