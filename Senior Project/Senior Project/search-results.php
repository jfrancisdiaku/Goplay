<?php 
require 'config/db.php';
require_once 'controllers/authController.php';

$userLat = $_SESSION['latitude'];
$userLong = $_SESSION['longitude'];

if(isset($_POST['q'])){
  $q = $_POST['q'];
  $query = "SELECT * FROM users WHERE descrip LIKE '%$q%' OR fname LIKE '%$q%' OR lname LIKE '%$q%'";
  $stmt = $conn->prepare($query);
  $stmt->execute();
  $result = $stmt->get_result();
  $userCount = $result->num_rows;


  if($userCount === 0){
  echo "<p>no results found<p>";
  }

  while($profile = mysqli_fetch_assoc($result)){
  $id = $profile['id'];
  $fname = $profile['fname'];
  $lname = $profile['lname'];
  $username = $profile['username'];
  $descrip = $profile['descrip'];
  $longitude = $profile['longitude'];
  $latitude = $profile['latitude'];
  
  
  
  echo' <html>';
  echo' <head>
          <link rel="stylesheet" href="Styles.css">
          <link rel="preconnect" href="https://fonts.googleapis.com">
          <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        
          <link href="https://fonts.googleapis.com/css2?family=Alkalami&family=Bebas+Neue&display=swap" rel="stylesheet">
      
          
          <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
      
          
          <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
          <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/font-awesome-line-awesome/css/all.min.css">
        </head>';
    echo'<body>';
    echo'  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous">
            </script>';
    echo'   <div class="row result-profile">';
    echo'     <div class="col-2 p-2 pic-area" align="center">';
    echo'       <img src="images/blankProfile.webp" style="height:100%; width:100%;"alt="">';
    echo'     </div>';
    echo     '<div class="col-3 name-area">';
    echo"       <p class='name'>Name: $fname $lname</p>";
    echo"       <p class='username'>Username: $username </p>";
    echo     '</div>';
    echo'     <div class="col descrip-area">';
    echo"       <p class='bio'>Bio:</p>";
    echo"       <p class='descrip'>$descrip</p>";
    echo'     </div>';
    echo'     <div class="col map-area">';
    echo '       <iframe src="https://maps.google.com/maps?q='.$latitude.','.$longitude.'&h1=es;z=14&output=embed" style="width: 100%; border-radius: 5px; height:100%"></iframe>';
    echo '    </div>';
    echo'  </div>';
    echo' </body>';
    echo' </html>'; 

  }

}


?>




