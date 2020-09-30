<?php
     error_reporting(0);
	 session_start();
	
	 if(!isset($_SESSION['username']))  
	 {  
		  header("location: index.php");  
	 }  
	
	 $conn = new mysqli('localhost', $_SESSION['username'], $_SESSION['password'], 'hoteldeasiana');

	/* Varible : Attribute
	
		g_id : Guest_id 
		fh_nic : Family_head’s_NIC
		fh_name : Family_head’s_name	
		fh_gender: Family_head’s_gender	
		cin_date : Checkin_date	
		cout_date : Checkout_date
	
	*/

	$update=false;
	$g_id="";
	$fh_nic="";
	$fh_name="";
	$fh_gender="";
	$cin_date="";
	$cout_date = "";
	
	// Add record
	if(isset($_POST['add'])){
		
		$fh_nic=$_POST['fh_nic'];
		$fh_name=$_POST['fh_name'];
		$fh_gender=$_POST['fh_gender'];
		$cin_date=$_POST['cin_date'];
		$cout_date=$_POST['cout_date'];
		
		$insert_cin_date = date("Y-m-d", strtotime($cin_date));
		$insert_cout_date = date("Y-m-d", strtotime($cout_date));

		
		$query="INSERT INTO family (Family_head_NIC,Family_head_name,Family_head_gender,Checkin_date,Checkout_date) VALUES (?,?,?,?,?)";
		
		$stmt=$conn->prepare($query);
		$stmt->bind_param("sssss",$fh_nic,$fh_name,$fh_gender,$insert_cin_date,$insert_cout_date);
		$stmt->execute();
		

		header('location: ../family.php');
		$_SESSION['response']="Successfully Inserted to the database!";
		$_SESSION['res_type']="success";
	}
	
	// Delete Record
	if(isset($_GET['delete'])){
		$g_id=$_GET['delete'];

		$query="DELETE FROM family WHERE Guest_id=?";
		$stmt=$conn->prepare($query);
		$stmt->bind_param("i",$g_id);
		$stmt->execute();

		header('location: ../family.php');
		$_SESSION['response']="Successfully Deleted!";
		$_SESSION['res_type']="danger";
	}
	
	// Fetch Existing records to update
	if(isset($_GET['edit'])){
		$g_id=$_GET['edit'];
		
		$query="SELECT * FROM family WHERE Guest_id=?";
		$stmt=$conn->prepare($query);
		$stmt->bind_param("i",$g_id);
		$stmt->execute();
		$result=$stmt->get_result();
		$row=$result->fetch_assoc();

		$g_id=$row['Guest_id'];
		$fh_nic=$row['Family_head_NIC'];
		$fh_name=$row['Family_head_name'];
		$fh_gender=$row['Family_head_gender'];
		$in = $row['Checkin_date'];
		$cin_date= date("Y-m-d", strtotime($in));
		$cout_date = $row['Checkout_date'];
		
		

		$update=true;
	}
	
	// Update records
	if(isset($_POST['update'])){
		$g_id=$_POST['g_id'];
		$fh_nic=$_POST['fh_nic'];
		$fh_name=$_POST['fh_name'];
		$fh_gender=$_POST['fh_gender'];
		$cin_date=$_POST['cin_date'];
		$cout_date=$_POST['cout_date'];
		
		$insert_cin_date = date("Y-m-d", strtotime($cin_date));
		$insert_cout_date = date("Y-m-d", strtotime($cout_date));
	
		$query="UPDATE family SET Family_head_NIC=? , Family_head_name=? , Family_head_gender=? , Checkin_date=? , Checkout_date=? WHERE Guest_id=?";
		$stmt=$conn->prepare($query);
		$stmt->bind_param("sssssi",$fh_nic,$fh_name,$fh_gender,$insert_cin_date,$insert_cout_date,$g_id);
		$stmt->execute();

		$_SESSION['response']="Updated Successfully!";
		$_SESSION['res_type']="primary";
		header('location: ../family.php');
	}

?>