<?php
  include 'actions/CSW_action.php';

  if(!isset($_SESSION['username']))  
  {  
      header('Location: index.php');
      die();   
  }  

?>
<!DOCTYPE html>
<html lang="en">

<?php 
  $page = 'CSW';
  include 'header.php' ;?>
<body>
  
  <?php include 'nav-bar.php' ;?>

  <div class="container-fluid">
    <div class="row justify-content-center">
      <div class="col-md-10">
		<br />
        <?php if (isset($_SESSION['response'])) { ?>
        <div class="alert alert-<?= $_SESSION['res_type']; ?> alert-dismissible text-center">
          <button type="button" class="close" data-dismiss="alert">&times;</button>
          <b><?= $_SESSION['response']; ?></b>
        </div>
        <?php } unset($_SESSION['response']); ?>
      </div>
  </div>
    <div class="row">
	
	  <!-- Add Details-->
      <div class="col-md-3 bg-light border rounded">
        <br />
		<h3 class="text-center text-info bg">CSW Details</h3>
		<hr style="display: block; height: 1px; border: 0; border-top: 3px solid #5bc0de;
			margin: 1em 0; padding: 0;">

		
		<!-- Form Start -->
        <form action="actions/CSW_action.php" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <input type="text" name="e_id" value="<?= $e_id; ?>" class="form-control" placeholder="Enter Employee ID" required>
      </div>
		  <div class="form-group">
            <input type="text" name="exp" value="<?= $exp; ?>" class="form-control" placeholder="Enter Experience" required>
      </div>
      <div class="form-group">
            <input type="text" name="cont" value="<?= $cont; ?>" class="form-control" placeholder="Enter Contract period" required>
      </div>
<div class="form-group">
      <label>Flag : &nbsp; &nbsp;</label>
			<div class="form-check">
			  <input class="form-check-input" type="radio" name="flag" value="Chef" checked="">
			  <label class="form-check-label" for="flag" >Chef</label>
			</div>
      <div class="form-check">
			  <input class="form-check-input" type="radio" name="flag" value="Support Staff">
			  <label class="form-check-label" for="flag" >Support Staff</label>
			</div>
      <div class="form-check">
			  <input class="form-check-input" type="radio" name="flag" value="Waiter">
			  <label class="form-check-label" for="flag" >Waiter</label>
			</div>
    </div>
          
          <div class="form-group">
            <?php if ($update == true) { ?>
            <input type="submit" name="update" class="btn btn-success btn-block" value="Update CSW" >
            <?php } else { ?>
            <input type="submit" name="add" class="btn btn-primary btn-block" value="Add CSW">
            <?php } ?>
          </div>
		  
		 <!-- Form End-->
        </form>
      </div>
	  
	  <!-- Details Panel-->
      <div class="col-md-9 bg-info text-white">
        <?php
          $query = 'SELECT * FROM CSW';
          $stmt = $conn->prepare($query);
          $stmt->execute();
          $result = $stmt->get_result();
        ?>
		<br />
        <h3 class="text-center text-white">CSW Records</h3>
		<hr style="display: block; height: 1px; border: 0; border-top: 3px solid #fff;
			margin: 1em 0; padding: 0;">
        <table class="table table-hover bg-dark" id="data-table">
          <thead>
            <tr>
              <th>Emp_id</th>
              <th>Experience</th>
              <th>Contract_period</th>
              <th>Flag </th>
              
			  <th>Actions </th>
            </tr>
          </thead>
          <tbody>
            <?php while ($row = $result->fetch_assoc()) { ?>
            <tr>
            <td><?= $row['Emp_id']; ?></td>
            <td><?= $row['Experience']; ?></td>
            <td><?= $row['Contract_period']; ?></td>
            <td><?= $row['Flag']; ?></td>
            
              <td>
			    <a href="CSW.php?edit=<?= $row['Emp_id']; ?>" class="badge badge-success p-2">Update</a>
                <a href="actions/CSW_action.php?delete=<?= $row['Emp_id']; ?>" class="badge badge-danger p-2" onclick="return confirm('Do you want delete this record?');">Delete</a>
              </td>
            </tr>
            <?php } ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
  <script type="text/javascript">
  $(document).ready(function() {
    $('#data-table').DataTable({
      paging: true
    });
  });
  </script>
</body>

</html>