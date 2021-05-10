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
		exp : Experience	
		cont: Contract_period	
		flag : Flag	
		
	
	*/

	$update=false;

	$e_id="";
	$exp="";
	$cont="";
	$flag="";
	
     
	
	// Add record
	if(isset($_POST['add'])){

		$e_id=$_POST['e_id'];
		$exp=$_POST['exp'];
		$cont=$_POST['cont'];
		$flag=$_POST['flag'];
		
			
		$query="INSERT INTO CSW (Emp_id,Experience,Contract_period,Flag) VALUES (?,?,?,?)";
		
		$stmt=$conn->prepare($query);
		$stmt->bind_param("isss",$e_id,$exp,$cont,$flag);
		$stmt->execute();
		

		header('location: ../CSW.php');
		$_SESSION['response']="Successfully Inserted to the database!";
		$_SESSION['res_type']="success";
	}
	
	// Delete Record
	if(isset($_GET['delete'])){
		$e_id=$_GET['delete'];

		$query="DELETE FROM CSW WHERE Emp_id=?";
		$stmt=$conn->prepare($query);
		$stmt->bind_param("i",$e_id);
		$stmt->execute();

		header('location: ../CSW.php');
		$_SESSION['response']="Successfully Deleted!";
		$_SESSION['res_type']="danger";
	}
	
	// Fetch Existing records to update
	if(isset($_GET['edit'])){
		$e_id=$_GET['edit'];
		
		$query="SELECT * FROM CSW WHERE Emp_id=?";
		$stmt=$conn->prepare($query);
		$stmt->bind_param("i",$e_id);
		$stmt->execute();
		$result=$stmt->get_result();
		$row=$result->fetch_assoc();

		$e_id=$row['Emp_id'];
		$exp=$row['Experience'];
		$cont=$row['Contract_period'];
		$flag= $row['Flag'];
    
		$update=true;
	}
	
	// Update records
	if(isset($_POST['update'])){
		$e_id=$_POST['e_id'];
		$exp=$_POST['exp'];
		$cont=$_POST['cont'];
		$flag=$_POST['Flag'];
	
		$query="UPDATE CSW SET  Experience=? , Contract_period=? , Flag=? WHERE Emp_id=?";
		$stmt=$conn->prepare($query);
		$stmt->bind_param("sssi",$exp,$cont,$flag, $e_id);
		$stmt->execute();
		

		$_SESSION['response']="Updated Successfully!";
		$_SESSION['res_type']="primary";
		header('location: ../CSW.php');
	}

?>