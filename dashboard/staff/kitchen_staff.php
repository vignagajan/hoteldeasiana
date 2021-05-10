<?php
  include 'actions/kitchen_staff_action.php';

  if(!isset($_SESSION['username']))  
  {  
      header('Location: index.php');
      die();   
  }  
  
?>
<!DOCTYPE html>
<html lang="en">

<?php 
  $page = 'Kitchen_staff';
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
		<h3 class="text-center text-info bg">Kitchen staff Details</h3>
		<hr style="display: block; height: 1px; border: 0; border-top: 3px solid #5bc0de;
			margin: 1em 0; padding: 0;">

		
		<!-- Form Start -->
        <form action="actions/kitchen_staff_action.php" method="post" enctype="multipart/form-data">
        <div class="form-group">
          <input type="text" name="e_id" value="<?= $e_id; ?>" class="form-control" placeholder="Enter Employee ID" required>
          </div>
          <div class="form-group">
            <input type="text" name="grade" value="<?= $grade; ?>" class="form-control" placeholder="Enter Kitchen staff's Grade" required>
          </div>
		  <div class="form-group">
            <input type="text" name="exp" value="<?= $exp; ?>" class="form-control" placeholder="Enter Kitchen staff's Experience" required>
          </div>
          
          <div class="form-group">
            <?php if ($update == true) { ?>
            <input type="submit" name="update" class="btn btn-success btn-block" value="Update Kitchen_staff" >
            <?php } else { ?>
            <input type="submit" name="add" class="btn btn-primary btn-block" value="Add Kitchen_staff">
            <?php } ?>
          </div>
		  
		 <!-- Form End-->
        </form>
      </div>
	  
	  <!-- Details Panel-->
      <div class="col-md-9 bg-info text-white">
        <?php
          $query = 'SELECT * FROM kitchen_staff';
          $stmt = $conn->prepare($query);
          $stmt->execute();
          $result = $stmt->get_result();
        ?>
		<br />
        <h3 class="text-center text-white">Kitchen staff Records</h3>
		<hr style="display: block; height: 1px; border: 0; border-top: 3px solid #fff;
			margin: 1em 0; padding: 0;">
        <table class="table table-hover bg-dark" id="data-table">
          <thead>
            <tr>
              <th>Employee ID</th>
              <th>Grade</th>
              <th>Experience</th>
              <th>Actions </th>
            </tr>
          </thead>
          <tbody>
            <?php while ($row = $result->fetch_assoc()) { ?>
            <tr>
              <td><?= $row['Emp_id']; ?></td>
              <td><?= $row['Grade']; ?></td>
              <td><?= $row['Experience']; ?></td>
              <td>
			    <a href="kitchen_staff.php?edit=<?= $row['Emp_id']; ?>" class="badge badge-success p-2">Update</a>
                <a href="actions/kitchen_staff_action.php?delete=<?= $row['Emp_id']; ?>" class="badge badge-danger p-2" onclick="return confirm('Do you want delete this record?');">Delete</a>
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