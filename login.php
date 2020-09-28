<?php

    error_reporting(0);
    
    $username="";
    $password="";

    session_start();

    const DBHOST = 'localhost';
    const DBNAME = 'hoteldeasiana';

    if(isset($_POST['login'])){

        $username = $_POST['user_name'];
        $password = $_POST['user_password'];

        $conn = new mysqli('localhost', $username, $password, 'hoteldeasiana');

        session_regenerate_id();
        $_SESSION['username'] = $username;
        $_SESSION['password'] = $password;
        session_write_close();


        if ($conn->connect_error) {
            $_SESSION['response'] = "Incorrect Username or Password!";
            $_SESSION['res_type']="danger";
        } else{
            header("location:dashboard.php");
        }
    }
?>

<!DOCTYPE html>
<html lang="en">

<?php 
  $page = 'Login Panel';
  include 'header.php';
?>

<link rel="stylesheet" href="assets/styles/login.css">

<body>

    <div class="row justify-content-center">
        
        <div class="col-md-10">
            <br />
            <!-- Messages Begin-->
            <?php if (isset($_SESSION['response'])) { ?>
            <div class="alert alert-<?= $_SESSION['res_type']; ?> alert-dismissible text-center">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <b><?= $_SESSION['response']; ?></b>
            </div>
            <?php } unset($_SESSION['response']); ?>
            <!-- Messages End -->
        </div>
        <!-- Form Begin -->
        <div class="login-form">
            <form action="" method="post">
                <img src="assets/images/logo.png" class="img" alt="">     
                <div class="form-group">
                    <input type="text" name="user_name" class="form-control"  placeholder="Username" required="required">
                </div>
                <div class="form-group">
                    <input type="password" name = "user_password" class="form-control"  placeholder="Password" >
                </div>
                <div class="form-group">
                    <button type="submit" name = "login" class="btn btn-primary btn-block">Log in</button>
                </div>       
            </form>
        </div>	  
        <!-- Form End -->
        
    </div>
</body>

</html>
