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

	*/

	$update=false;
	$e_id="";
	
	// Add record
	if(isset($_POST['add'])){
        
        $query="INSERT INTO receptionist (Emp_id) values (?)";
		$stmt=$conn->prepare($query);
		$stmt->bind_param("i",$e_id);
		$stmt->execute();
		

		header('location: ../receptionist.php');
		$_SESSION['response']="Successfully Inserted to the database!";
		$_SESSION['res_type']="success";
	}
	
	// Delete Record
	if(isset($_GET['delete'])){
		$e_id=$_GET['delete'];

		$query="DELETE FROM receptionist WHERE Emp_id=?";
		$stmt=$conn->prepare($query);
		$stmt->bind_param("i",$e_id);
		$stmt->execute();

		header('location: ../receptionist.php');
		$_SESSION['response']="Successfully Deleted!";
		$_SESSION['res_type']="danger";
	}

?>