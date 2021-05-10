<?php
	error_reporting(0);
	session_start();

	if(!isset($_SESSION['username']))  
	{  
		header("location: ../index.php");  
	}  

	$conn = new mysqli('localhost', $_SESSION['username'], $_SESSION['password'], 'hoteldeasiana');

	/* Varible : Attribute
	
		e_id : Emp_id 
		wo_lo : Work_location

	*/

	$update=false;
	$e_id="";
	$wo_lo="";
	
	// Add record
	if(isset($_POST['add'])){
		
		$wo_lo=$_POST['wo_lo'];
		
		$query="INSERT INTO cleaning_staff (Work_location) VALUES (?)";
		
		$stmt=$conn->prepare($query);
		$stmt->bind_param("s",$wo_lo);
		$stmt->execute();		

		header('location: ../cleaning_staff.php');
		$_SESSION['response']="Successfully Inserted to the database!";
		$_SESSION['res_type']="success";
	}
	
	// Delete Record
	if(isset($_GET['delete'])){
		$e_id=$_GET['delete'];

		$query="DELETE FROM cleaning_staff WHERE Emp_id=?";
		$stmt=$conn->prepare($query);
		$stmt->bind_param("i",$e_id);
		$stmt->execute();

		header('location: ../cleaning_staff.php');
		$_SESSION['response']="Successfully Deleted!";
		$_SESSION['res_type']="danger";
	}
	
	// Fetch Existing records to update
	if(isset($_GET['edit'])){
		$e_id=$_GET['edit'];
		
		$query="SELECT * FROM cleaning_staff WHERE Emp_id=?";
		$stmt=$conn->prepare($query);
		$stmt->bind_param("i",$e_id);
		$stmt->execute();
		$result=$stmt->get_result();
		$row=$result->fetch_assoc();

		$e_id=$row['Emp_id'];
		$wo_lo=$row['Work_location'];

		$update=true;
	}
	
	// Update records
	if(isset($_POST['update'])){
		$e_id=$_POST['e_id'];
		$wo_lo=$_POST['wo_lo'];
	
		$query="UPDATE cleaning_staff SET Work_location=? WHERE Emp_id=?";
		$stmt=$conn->prepare($query);
		$stmt->bind_param("si",$wo_lo,$e_id);
		$stmt->execute();
		

		$_SESSION['response']="Updated Successfully!";
		$_SESSION['res_type']="primary";
		header('location: ../cleaning_staff.php');
	}

?>