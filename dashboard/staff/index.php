<?php 

session_start();

    if(!isset($_SESSION['username']))  
    {  
        header('Location: ../index.php');
        die();   
    }  
 
 ?>
<!DOCTYPE html>
<html lang="en">

<?php 
  $page = 'Staff';
  include '../header.php' ;?>

<style>

.margin-bottom{
    margin-bottom: 30px !important;
}

</style>

<body id="body-pd">

<?php include '../nav-bar.php' ;?>

<!-- Page Content -->
<div class="container">

<br />
<div class="row">
    <div class="col-md-2" id="CSW">
        <a href="CSW.php" class="btn btn-primary btn-lg btn-block btn-huge margin-bottom">
        <ion-icon name="hammer" class="nav__icon"></ion-icon> CSW</a>
    </div> 
    <div class="col-md-2" id="kitchen_staff">
        <a href="kitchen_staff.php" class="btn btn-primary btn-lg btn-block btn-huge margin-bottom">
        <ion-icon name="pizza" class="nav__icon"></ion-icon> Kitchen </a>
    </div> 
    <div class="col-md-3" id="management_staff">
        <a href="management_staff.php" class="btn btn-primary btn-lg btn-block btn-huge margin-bottom">
        <ion-icon name="reader" class="nav__icon"></ion-icon> Management </a>
    </div>    
    <div class="col-md-3" id="receptionist">
        <a href="receptionist.php" class="btn btn-primary btn-lg btn-block btn-huge margin-bottom">
        <ion-icon name="receipt" class="nav__icon"></ion-icon> Receptionist </a>
    </div> 
    <div class="col-md-2" id="cleaning_staff">
        <a href="cleaning_staff.php" class="btn btn-primary btn-lg btn-block btn-huge margin-bottom">
        <ion-icon name="fitness" class="nav__icon"></ion-icon> Cleaning </a>
    </div>  
</div>

</div>
<!-- Content ends -->
</body>

</html>