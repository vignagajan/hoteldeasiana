<?php
	error_reporting(0);
	session_start();

	if(!isset($_SESSION['username']))  
	{  
		header("location: ../index.php");  
	}  

	$conn = new mysqli('localhost', $_SESSION['username'], $_SESSION['password'], 'hoteldeasiana');
	
	/* Varible : Attribute
	
		g_id : Guest_id 
		nic : NIC
		name : Name	
		gender: Gender	
		cin_date : Checkin_date	
		cout_date : Checkout_date
	
	*/

	$update=false;
	$g_id="";
	$nic="";
	$name="";
	$gender="";
	$cin_date="";
	$cout_date = "";
	
	// Add record
	if(isset($_POST['add'])){
		
		$nic=$_POST['nic'];
		$name=$_POST['name'];
		$gender=$_POST['gender'];
		$cin_date=$_POST['cin_date'];
		$cout_date=$_POST['cout_date'];
		
		$insert_cin_date = date("Y-m-d", strtotime($cin_date));
		$insert_cout_date = date("Y-m-d", strtotime($cout_date));

		
		$query="INSERT INTO individual (NIC,Name,Gender,Checkin_date,Checkout_date) VALUES (?,?,?,?,?)";
		
		$stmt=$conn->prepare($query);
		$stmt->bind_param("sssss",$nic,$name,$gender,$insert_cin_date,$insert_cout_date);
		$stmt->execute();
		

		header('location: ../individual.php');
		$_SESSION['response']="Successfully Inserted to the database!";
		$_SESSION['res_type']="success";
	}
	
	// Delete Record
	if(isset($_GET['delete'])){
		$g_id=$_GET['delete'];

		$query="DELETE FROM individual WHERE Guest_id=?";
		$stmt=$conn->prepare($query);
		$stmt->bind_param("i",$g_id);
		$stmt->execute();

		header('location: ../individual.php');
		$_SESSION['response']="Successfully Deleted!";
		$_SESSION['res_type']="danger";
	}
	
	// Fetch Existing records to update
	if(isset($_GET['edit'])){
		$g_id=$_GET['edit'];
		
		$query="SELECT * FROM individual WHERE Guest_id=?";
		$stmt=$conn->prepare($query);
		$stmt->bind_param("i",$g_id);
		$stmt->execute();
		$result=$stmt->get_result();
		$row=$result->fetch_assoc();

		$g_id=$row['Guest_id'];
		$nic=$row['NIC'];
		$name=$row['Name'];
		$gender=$row['Gender'];
		$in = $row['Checkin_date'];
		$cin_date= date("Y-m-d", strtotime($in));
		$cout_date = $row['Checkout_date'];
		
		

		$update=true;
	}
	
	// Update records
	if(isset($_POST['update'])){
		$g_id=$_POST['g_id'];
		$nic=$_POST['nic'];
		$name=$_POST['name'];
		$gender=$_POST['gender'];
		$cin_date=$_POST['cin_date'];
		$cout_date = $_POST['cout_date'];
		
		$insert_cin_date = date("Y-m-d", strtotime($cin_date));
		$insert_cout_date = date("Y-m-d", strtotime($cout_date));
	
		$query="UPDATE individual SET NIC=? , Name=? , Gender=? , Checkin_date=? , Checkout_date=? WHERE Guest_id=?";
		$stmt=$conn->prepare($query);
		$stmt->bind_param("sssssi",$nic,$name,$gender,$insert_cin_date,$insert_cout_date,$g_id);
		$stmt->execute();
		

		$_SESSION['response']="Updated Successfully!";
		$_SESSION['res_type']="primary";
		header('location: ../individual.php');
	}

?>