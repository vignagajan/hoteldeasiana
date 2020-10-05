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
  $page = 'Customer';
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
      <div class="col-md-3" id="family">
          <a href="family.php" class="btn <?php echo ($table == "Family" ? "btn-secondary" : "btn-primary")?> btn-lg btn-block btn-huge margin-bottom">
          <ion-icon name="people" class="nav__icon"></ion-icon> Family</a>
      </div>
      <div class="col-md-3" id="individual">
          <a href="individual.php" class="btn <?php echo ($table == "Individual" ? "btn-secondary" : "btn-primary")?> btn-lg btn-block btn-huge margin-bottom">
          <ion-icon name="person" class="nav__icon"></ion-icon> Individual</a>
      </div>
      <div class="col-md-3" id="company">
          <a href="company.php" class="btn <?php echo ($table == "Company" ? "btn-secondary" : "btn-primary")?> btn-lg btn-block btn-huge margin-bottom">
          <ion-icon name="briefcase" class="nav__icon"></ion-icon> Company</a>
      </div>
      <div class="col-md-3" id ="employee">
          <a href="employee.php" class="btn <?php echo ($table == "Employee" ? "btn-secondary" : "btn-primary")?> btn-lg btn-block btn-huge margin-bottom">
          <ion-icon name="man" class="nav__icon"></ion-icon> Employee</a>
      </div>    

</div>

</div>
<!-- Content ends -->
</body>

</html>