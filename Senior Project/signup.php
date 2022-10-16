      <?php
        include_once 'header.php'
      ?>

      <div class="form-container">
        <p class="signup-tag">Sign Up</p>
        <form class="form" action="includes/singup.inc.php" method="post">
          <input type="text" name="name" placeholder="Full name...">
          <input type="text" name="Email" placeholder="Email...">
          <input type="text" name="uid" placeholder="Username...">
          <input type="password" name="pwd" placeholder="Password...">
          <input type="password" name="pwdrepeat" placeholder="Repeat password...">
          <button type="submit" name="submit">Sign Up</button>
        </form>
      </div>
        
    </body>
</html>