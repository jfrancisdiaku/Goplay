     <?php
        include_once 'header.php'
      ?>

      <div class="form-container">
        <p class="login-tag">Log in</p>
        <form class="form" action="includes/login.inc.php" method="post">
          <input type="text" name="uid" placeholder="Username/Email...">
          <input type="password" name="pwd" placeholder="Password...">
          <button type="submit" name="submit">Log in</button>
        </form>
      </div>

    </body>
</html>