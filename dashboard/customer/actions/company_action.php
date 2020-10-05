<?php
	
	error_reporting(0);
	session_start();



	/* Varible : Attribute

		g_id : Guest_id 
		name : Name	
		address: Billing_address	
		cin_date : Checkin_date	
		cout_date : Checkout_date

	*/

    $conn = new mysqli('localhost', $_SESSION['username'], $_SESSION['password'], 'hoteldeasiana');

	$update=false;

	$g_id="";
	$name="";
	$address="";
	$cin_date="";
	$cout_date = "";
	
	// Add record
	if(isset($_POST['add'])){
		
		$name=$_POST['name'];
		$address=$_POST['address'];
		$cin_date=$_POST['cin_date'];
		$cout_date=$_POST['cout_date'];
		
		$insert_cin_date = date("Y-m-d", strtotime($cin_date));
		$insert_cout_date = date("Y-m-d", strtotime($cout_date));

		
		$query="INSERT INTO company (Name,Billing_address,Checkin_date,Checkout_date) VALUES (?,?,?,?)";
		
		$stmt=$conn->prepare($query);
		$stmt->bind_param("ssss",$name,$address,$insert_cin_date,$insert_cout_date);
		$stmt->execute();
		

		header('location: ../company.php');
		$_SESSION['response']="Successfully Inserted to the database!";
		$_SESSION['res_type']="success";
	}
	
	// Delete Record
	if(isset($_GET['delete'])){
		$g_id=$_GET['delete'];

		$query="DELETE FROM company WHERE Guest_id=?";
		$stmt=$conn->prepare($query);
		$stmt->bind_param("i",$g_id);
		$stmt->execute();

		header('location: ../company.php');
		$_SESSION['response']="Successfully Deleted!";
		$_SESSION['res_type']="danger";
	}
	
	// Fetch Existing records to update
	if(isset($_GET['edit'])){
		$g_id=$_GET['edit'];
		
		$query="SELECT * FROM company WHERE Guest_id=?";
		$stmt=$conn->prepare($query);
		$stmt->bind_param("i",$g_id);
		$stmt->execute();
		$result=$stmt->get_result();
		$row=$result->fetch_assoc();

		$g_id=$row['Guest_id'];
		$name=$row['Name'];
		$address=$row['Billing_address'];
		$cin_date= $row['Checkin_date'];;
		$cout_date = $row['Checkout_date'];


		$update=true;
	}
	
	// Update records
	if(isset($_POST['update'])){
		$g_id=$_POST['g_id'];
		$name=$_POST['name'];
		$address=$_POST['address'];
		$cin_date=$_POST['cin_date'];
		$cout_date=$_POST['cout_date'];
		
		$insert_cin_date = date("Y-m-d", strtotime($cin_date));
		$insert_cout_date = date("Y-m-d", strtotime($cout_date));
	
		$query="UPDATE company SET Name=? , Billing_address=? , Checkin_date=? , Checkout_date=? WHERE Guest_id=?";
		$stmt=$conn->prepare($query);
		$stmt->bind_param("ssssi",$name,$address,$insert_cin_date,$insert_cout_date,$g_id);
		$stmt->execute();
		

		$_SESSION['response']="Updated Successfully!";
		$_SESSION['res_type']="primary";
		header('location: ../company.php');
	}

?>