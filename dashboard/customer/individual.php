<?php
  include 'actions/individual_action.php';

  if(!isset($_SESSION['username']))  
  {  
      header('Location: index.php');
      die();   
  }  
  
?>
<!DOCTYPE html>
<html lang="en">

<?php 
  $table = 'Individual';
  include 'index.php' ;
?>

<body id="body-pd">

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
		<h3 class="text-center text-info bg">Individual Details</h3>
		<hr style="display: block; height: 1px; border: 0; border-top: 3px solid #5bc0de;
			margin: 1em 0; padding: 0;">

		
		<!-- Form Start -->
        <form action="individual_action.php" method="post" enctype="multipart/form-data">
          <input type="hidden" name="g_id" value="<?= $g_id; ?>">
          <div class="form-group">
            <input type="text" name="nic" value="<?= $nic; ?>" class="form-control" placeholder="Enter Individual's NIC" required>
          </div>
		  <div class="form-group">
            <input type="text" name="name" value="<?= $name; ?>" class="form-control" placeholder="Enter Individual's Name" required>
          </div>
		  <div class="form-group">
			<label>Individual's Gender : &nbsp; &nbsp;</label>
      <div class="form-check">
			  <input class="form-check-input" type="radio" name="fh_gender" value="M" checked="">
			  <label class="form-check-label" for="fh_gender" >Male &emsp;&emsp;</label>
			  <input class="form-check-input" type="radio" name="fh_gender" value="F">
			  <label class="form-check-label" for="fh_gender">Female &emsp;&emsp;</label>
			  <input class="form-check-input" type="radio" name="fh_gender" value="O">
			  <label class="form-check-label" for="fh_gender">Other</label>
			</div>
      </div>
		  <div class="form-group row">
			  <label >&nbsp; &nbsp;&nbsp;Checkin Date : &nbsp; </label>
			  <div class = "col-12">
			  <input class="form-control" type="date" name = "cin_date" value="<? date('Y-m-d'); ?>" required >
			  </div>
		  </div>
		  <div class="form-group row">
			  <label >&nbsp; &nbsp;&nbsp;Checkout Date :</label>
			  <div class = "col-12">
			  <input class="form-control" type="date" name = "cout_date" value="<? date('Y-m-d'); ?>" required >
			  </div>
		  </div>
          
          <div class="form-group">
            <?php if ($update == true) { ?>
            <input type="submit" name="update" class="btn btn-success btn-block" value="Update Individual" >
            <?php } else { ?>
            <input type="submit" name="add" class="btn btn-primary btn-block" value="Add Individual">
            <?php } ?>
          </div>
		  
		 <!-- Form End-->
        </form>
      </div>
	  
	  <!-- Details Panel-->
      <div class="col-md-9 bg-info text-white">
        <?php
          $query = 'SELECT * FROM individual';
          $stmt = $conn->prepare($query);
          $stmt->execute();
          $result = $stmt->get_result();
        ?>
		<br />
        <h3 class="text-center text-white">Individual Records</h3>
		<hr style="display: block; height: 1px; border: 0; border-top: 3px solid #fff;
			margin: 1em 0; padding: 0;">
        <table class="table table-hover bg-dark" id="data-table">
          <thead>
            <tr>
              <th>Guest ID</th>
              <th>NIC</th>
              <th>Name</th>
              <th>Gender</th>
              <th>Check-in </th>
              <th>Check-out </th>
			  <th>Actions </th>
            </tr>
          </thead>
          <tbody>
            <?php while ($row = $result->fetch_assoc()) { ?>
            <tr>
              <td><?= $row['Guest_id']; ?></td>
              <td><?= $row['NIC']; ?></td>
              <td><?= $row['Name']; ?></td>
			  <td><?= $row['Gender']; ?></td>
			  <td><?= $row['Checkin_date']; ?></td>
			  <td><?= $row['Checkout_date']; ?></td>
              <td>
			    <a href="individual.php?edit=<?= $row['Guest_id']; ?>" class="badge badge-success p-2">Update</a>
                <a href="actions/individual_action.php?delete=<?= $row['Guest_id']; ?>" class="badge badge-danger p-2" onclick="return confirm('Do you want delete this record?');">Delete</a>
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