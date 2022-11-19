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

    <div class="container mx-auto row message-panel" align="center">
      <div class="col-4 active-chats">
        <h3>active chats</h3>
        <div class="rounded d-flex text-center mb-3" style="border-style:solid;" >
          <i class="las la-user-nurse" style="font-size: 50px;"></i>
          <h4>karolina Sydor </h4>
        </div>
      </div>
      <div class="col-6 chat-box p-2">

        <form action="">
          <label for="">to:</label>
          <input type="text" id="toUser" value="">
        </form>
      
        
        <div class="rounded mb-2 d-flex mt-2 p-4 flex-column chat-area" id="chat-area" style="border-style:solid;  width: 350px; ">

        </div>
        <form action="" class="typing-area" >
          <input type="text" rows="10" cols="50" id="message" class="input-field" placeholder="Type a message here..." autocomplete="off">
          <button class="send-btn btn btn-warning" id="send-btn">send</button>
        </form>
      </div>
    </div>

    <script>
    //create event listener
    document.getElementById('send-btn').addEventListener
    ('click', sendMessage);

    document.getElementById('toUser').addEventListener
    ('mouseout', loadChat);
    
    
    function sendMessage(e){
      e.preventDefault();
      inputField = document.getElementById('message');
      var toUser = document.getElementById('toUser').value;
      var message = document.getElementById('message').value;
      var params = "toUser="+toUser+"&message="+message;
      //create XHR Object
      var xhr = new XMLHttpRequest();
      //OPEN - type, url/file, async
      xhr.open('POST', 'sendMessage.php?toUser='+toUser+"&message="+message, true);
      xhr.setRequestHeader('content-type', 'application/x-www-form-urlencoded');

      xhr.onload = function(){
      if(this.status == 200){
        inputField.value = '';
        console.log(this.responseText);
        }
      }
        //sends request
        xhr.send(params);
      }

      function loadChat(e){
      e.preventDefault();
      var toUser = document.getElementById('toUser').value;
      var params = "toUser="+toUser;
      //create XHR Object
      var xhr = new XMLHttpRequest();
      //OPEN - type, url/file, async
      xhr.open('POST', 'loadChat.php?toUser='+toUser, true);
      xhr.setRequestHeader('content-type', 'application/x-www-form-urlencoded');

      xhr.onload = function(){
      if(this.status == 200){
        document.getElementById('chat-area').innerHTML = this.responseText;
        }
      }

        //sends request
        xhr.send(params);
      }

</script>

    
  </body>
</html>