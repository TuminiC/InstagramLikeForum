<body>
<?php
session_start();
?>
    <?php include 'menu.html';?>
  <h1>Login</h1>
  <?php
  if(!isset($_SESSION['username'])){print('
  <form method="post" action="do_login.php">
    Enter username <input type="text" name="username" /><br />
    Enter password <input type="password" name="password" /> <br />
    <input type="submit" />
  </form>');}
  else{
  print('Already Logged In');
  }
  ?>
</body>