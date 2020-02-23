<?php
session_start();
?>
<body>
    <?php include 'menu.html';?>
    <?php include 'sql_connect.php';?>

    <?php
        $stmt= $conn->prepare("select * from user where username=?");
        $stmt->bind_param("s", $username);
        $username= $_POST['username'];
        $stmt->execute();

    ?>
    <p>
        <?php
            $result=$stmt->get_result();
            if ($result->num_rows==0){
                print('No account found please sign up');
             }
             else{
                $row= $result->fetch_assoc();
                if(password_verify($_POST['password'], $row['password'])){
                    $_SESSION['username']=$row['username'];
                    $_SESSION['id']=$row['id'];
                    print('Welcome '.htmlspecialchars($_SESSION['username']));
                }
                else{
                    print('Wrong password');
                }
             }
           
        ?>
     </p>
     </body>

