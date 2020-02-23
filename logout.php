<?php
session_start();
unset($_SESSION['username']);
unset($_SESSION['id']);
?>
<body>
  <?php include 'menu.html';?>
  <p>
    You are now logged out.
  </p>
</body>