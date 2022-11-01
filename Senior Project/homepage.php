<?php  require_once 'controllers/authController.php'; ?>
<!DOCTYPE html>
<html>
  <head>
    <title>Homepage</title>
    <link rel="stylesheet" href="Styles.css">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Alkalami&family=Bebas+Neue&display=swap" rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet"
         integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
        <link href='https://api.mapbox.com/mapbox-gl-js/v2.10.0/mapbox-gl.css' rel='stylesheet' />
  </head>
  <body>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"
     integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>



    <!--Navbar-->
     <nav class="navbar navbar-expand-sm bg-white navbar-white py-3">
      <div class="container">
        <a href="#" class="navbar-brand"><span class="fs-1">GoPlay</span></a>

        <button 
          class="navbar-toggler" 
          type="button"
          data-bs-toggle="collapse" 
          data-bs-targer="#navmenu"
        >
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="#navmenu">
          <ul class="navbar-nav ms-auto">
            <li class="nav-item">
              <a href="#aboutsection" class="nav-link">What is GoPlay</a>
            </li>
            <li class="nav-item">
              <a href="login.php" class="nav-link">Login</a>
            </li>
            <li class="nav-item">
              <a href="#register" class="nav-link">Register</a>
            </li>
          </ul>
        </div>
      </div>
     </nav>

    <!--top section-->
     <section class="bg-white text-dark p-5 text-center text-sm-start">
      <div class="container">
        <div class="d-sm-flex align-items-center 
          justify-content-between">
          <div>
            <h1 class="fs-2"><span class="text-primary fs-1">join</span>
            athletes in your area</h1>
            <p class="lead my-4">
              Connect with athletes in the local area who share your similar goals and attributes.
            </p>
            <button class="btn btn-primary btn-lg">
            <a href="signup.php" class="text-white">Join today</a>
            </button>
          </div>
          <img class="img-fluid w-50 d-sm-block" src="imgs/soccer.png">
        </div>
        </div>
      </section>
    
     <!--newsletter-->
    <section class="bg-warning rounded text-dark p-5">
      <div class="container">
        <div class="d-md-flex justify-content-between 
          align-items-center">
          <h3 class="mb-3 mb-md-0">Sign Up For Our Newsletter</h3>

          <div class="input-group news-input">
            
            <input 
              type="text" 
              class="form-control" 
              placeholder="Enter Email" 
            >
            
            <button 
              class="btn btn-dark btn-lg" 
              type="button" 
            >
              Sign Up
            </button>
              
          </div>
        </div>
      </div>
    </section>

    <!--about section-->
    <section id="aboutsection"    class=" bg-white">
      <div class="container">
        <div class="d-sm-flex align-items-center justify-content-between">
          <img class="img-fluid w-50 d-sm-block" src="imgs/biking.png">
          <div>
            <h1 class="fs-2 text-warning ">what is GoPlay?</h1>
            <p class="lead my-4">
              Without an established social circle in a community or affiliation with an official team,
              some people find it challenging to find others with similar goals and interests when it comes to 
              their designated sports. whether you need a running partner, a gym buddy, or teammates to play pick-up basketball,
              GoPlay finds people in your area with similar interests to make finding your squad easier than ever before.
            </p>
          </div>
        </div>
      </div>
    </section>


     <!--map section-->
     <section class="bg-white text-dark p-5 text-center text-sm-start">
      <div class="container">
        <div class="d-sm-flex align-items-center 
          justify-content-between">
          <div class="p-4">
            <h1 class="text-primary">How does it work</h1>
            <p class="lead my-4">
              Apps and website track your wearabouts using technology called Geolocation. 
              Goplay uses geolocation technology to connect you with players in your local area.
            </p>
          </div>
          <div id='map'></div>
        </div>
        </div>
      </section>


    <!--sports section-->
    <section class="p-5">
      <div class="container">
        <h1 class="p-5 text-center text-success">sports selection</h1>
        <div class="row text-center">
          <div class="col-sm">
            <div class="img-container">
              <img src="imgs/basketballicon.png" alt="" class="img-fluid p-2">
            </div>
            <p>Basketball</p>
          </div>
          <div class="col-sm">
            <div class="img-container">
              <img src="imgs/soccericon.png" alt="" class="img-fluid p-2">
            </div>
            <p>soccer</p>
          </div>
          <div class="col-sm">
            <div class="img-container">
              <img src="imgs/tennisicon.png" alt="" class="img-fluid p-2">
            </div>
            <p>tennis</p>
          </div>
          <div class="col-sm">
            <div class="img-container">
              <img src="imgs/bicycle.png" alt="" class="img-fluid p-2">
            </div>
            <p>biking/running</p>
          </div>
          <div class="col-sm">
            <div class="img-container">
              <img src="imgs/volleyballicon.png" alt="" class="img-fluid p-2">
            </div>
            <p>Volleyball</p>
          </div>
          <div class="col-sm aligh">
            <div class="img-container">
              <img src="imgs/boxingicon.png" alt="" class="img-fluid p-2">
            </div>
            <p>combat sports</p>
          </div>
          
        </div>
      </div>
    </section>


    <!--footer-->
    <footer class="p-5 bg-dark text-white text-center position-relative">
      <div class="container">
        <p class="lead">Copyright &copy; GoPlay.com </p>
        <a href="" class="postion-absolute bottom-0 end-0 p-5">
        </a>
      </div>
    </footer>




    <script src='https://api.mapbox.com/mapbox-gl-js/v2.10.0/mapbox-gl.js'></script>

    <script>
      mapboxgl.accessToken = 'pk.eyJ1IjoiamZyYW5jaXNkaWFrdSIsImEiOiJjbDlxNW9ic28wM3B2M25xeHpiYzQweG51In0.OWRMZvI9gNH1iAwz_MWmZw';
      const map = new mapboxgl.Map({
      container: 'map',
      style: 'mapbox://styles/mapbox/streets-v11', 
      center: [79.5, 96], 
      zoom: 5,
      });
    </script>




  </body>
</html>