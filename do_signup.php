<body>
  <?php include 'menu.html';?>
  <?php include 'sql_connect.php';?>

  <?php

session_start();


    $stmt = $conn->prepare("insert into user (username, password) values (?, ?);");

    //s means string, i means int, d means double
    $stmt->bind_param("ss",
      $username,
      $password
    );

    $username = $_POST['username'];

    // Hash the password so we don't store
    // password in plain text
    $password = password_hash(
      $_POST['password'],PASSWORD_DEFAULT);//hashed password stored in assign

    $success = $stmt->execute();
  ?>
  <p>
    <?php
      if (!$success) {
        print('Signup failed: '. $stmt->error.' Try again');
      }
      else {
        print('Signup successful');
      }
    ?>
  </p>
</body>