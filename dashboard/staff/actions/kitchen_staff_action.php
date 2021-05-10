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
		grade : Grade
		exp : Experience	
	
	*/

	$update=false;
	$e_id="";
	$grade="";
	$exp="";
	
	// Add record
	if(isset($_POST['add'])){
		
		$grade=$_POST['grade'];
		$exp=$_POST['exp'];
		
		$query="INSERT INTO Kitchen_staff (Emp_id,Grade,Experience) VALUES (?,?,?)";
		
		$stmt=$conn->prepare($query);
		$stmt->bind_param("iss",$e_id,$grade,$exp);
		$stmt->execute();	

		header('location: ../kitchen_staff.php');
		$_SESSION['response']="Successfully Inserted to the database!";
		$_SESSION['res_type']="success";
	}
	
	// Delete Record
	if(isset($_GET['delete'])){
		$e_id=$_GET['delete'];

		$query="DELETE FROM Kitchen_staff WHERE Emp_id=?";
		$stmt=$conn->prepare($query);
		$stmt->bind_param("i",$e_id);
		$stmt->execute();

		header('location: ../kitchen_staff.php');
		$_SESSION['response']="Successfully Deleted!";
		$_SESSION['res_type']="danger";
	}
	
	// Fetch Existing records to update
	if(isset($_GET['edit'])){
		$e_id=$_GET['edit'];
		
		$query="SELECT * FROM Kitchen_staff WHERE Emp_id=?";
		$stmt=$conn->prepare($query);
		$stmt->bind_param("i",$e_id);
		$stmt->execute();
		$result=$stmt->get_result();
		$row=$result->fetch_assoc();

		$e_id=$row['Emp_id'];
		$grade=$row['Grade'];
		$exp=$row['Experience'];	

		$update=true;
	}
	
	// Update records
	if(isset($_POST['update'])){
		$e_id=$_POST['e_id'];
		$grade=$_POST['grade'];
		$exp=$_POST['exp'];
	
		$query="UPDATE Kitchen_staff SET Grade=? , Experience=? WHERE Emp_id=?";
		$stmt=$conn->prepare($query);
		$stmt->bind_param("ssi",$grade,$exp,$e_id);
		$stmt->execute();
		

		$_SESSION['response']="Updated Successfully!";
		$_SESSION['res_type']="primary";
		header('location: ../kitchen_staff.php');
	}

?>