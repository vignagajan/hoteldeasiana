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
		desig : Designation
		grade : Grade	
		
	
	*/

	$update=false;
	$e_id="";
	$desig="";
	$grade="";
	
	
	// Add record
	if(isset($_POST['add'])){
		
		$desig=$_POST['desig'];
		$grade=$_POST['grade'];
		
		$query="INSERT INTO management_staff (Designation,Grade) VALUES (?,?)";
		
		$stmt=$conn->prepare($query);
		$stmt->bind_param("ss",$desig,$grade);
		$stmt->execute();
		

		header('location: ../management_staff.php');
		$_SESSION['response']="Successfully Inserted to the database!";
		$_SESSION['res_type']="success";
	}
	
	// Delete Record
	if(isset($_GET['delete'])){
		$e_id=$_GET['delete'];

		$query="DELETE FROM management_staff WHERE Emp_id=?";
		$stmt=$conn->prepare($query);
		$stmt->bind_param("i",$e_id);
		$stmt->execute();

		header('location: ../management_staff.php');
		$_SESSION['response']="Successfully Deleted!";
		$_SESSION['res_type']="danger";
	}
	
	// Fetch Existing records to update
	if(isset($_GET['edit'])){
		$e_id=$_GET['edit'];
		
		$query="SELECT * FROM management_staff WHERE Emp_id=?";
		$stmt=$conn->prepare($query);
		$stmt->bind_param("i",$e_id);
		$stmt->execute();
		$result=$stmt->get_result();
		$row=$result->fetch_assoc();

		$e_id=$row['Emp_id'];
		$desig=$row['Designation'];
		$grade=$row['Grade'];

		$update=true;
	}
	
	// Update records
	if(isset($_POST['update'])){
		$e_id=$_POST['e_id'];
		$desig=$_POST['desig'];
		$grade=$_POST['grade'];
		
		$query="UPDATE management_staff SET Designation=? , Grade=?  WHERE Emp_id=?";
		$stmt=$conn->prepare($query);
		$stmt->bind_param("ssi",$desig,$grade,$e_id);
		$stmt->execute();

		$_SESSION['response']="Updated Successfully!";
		$_SESSION['res_type']="primary";
		header('location: ../management_staff.php');
	}

?>