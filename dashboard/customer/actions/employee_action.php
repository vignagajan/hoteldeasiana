<?php

	error_reporting(0);
	session_start();

	if(!isset($_SESSION['username']))  
	{  
		header("location: ../index.php");  
	}  

	/* Varible : Attribute
	
		e_id : Employee_id 
		name : Name	
        gender: Gender
        c_no : Contact_number	
		s_gr : Salary_grade
		ws_date : Work_start_date
		
	*/

	$conn = new mysqli('localhost', $_SESSION['username'], $_SESSION['password'], 'hoteldeasiana');

	$update=false;
	$e_id="";
	$name="";
	$gender="";
    $c_no="";
    $s_gr="";
    $ws_date = "";
	
	// Add record
	if(isset($_POST['add'])){
		
		$name=$_POST['name'];
		$gender=$_POST['gender'];
        $c_no=$_POST['c_no'];
        $s_gr=$_POST['s_gr'];
        $ws_date=$_POST['ws_date'];
		
        $insert_ws_date = date("Y-m-d", strtotime($ws_date));

		
		$query="INSERT INTO employee (Name,Gender,Contact_no,Salary_grade,Work_start_date) VALUES (?,?,?,?,?)";
		
		$stmt=$conn->prepare($query);
		$stmt->bind_param("sssss",$name,$gender,$c_no,$s_gr,$insert_ws_date);
		$stmt->execute();

		header('location: ../employee.php');
		$_SESSION['response']="Successfully Inserted to the database!";
		$_SESSION['res_type']="success";
	}
	
	// Delete Record
	if(isset($_GET['delete'])){
		$e_id=$_GET['delete'];

		$query="DELETE FROM employee WHERE Emp_id=?";
		$stmt=$conn->prepare($query);
		$stmt->bind_param("i",$e_id);
		$stmt->execute();

		header('location: ../employee.php');
		$_SESSION['response']="Successfully Deleted!";
		$_SESSION['res_type']="danger";
	}
	
	// Fetch Existing records to update
	if(isset($_GET['edit'])){
		$e_id=$_GET['edit'];
		
		$query="SELECT * FROM employee WHERE Emp_id=?";
		$stmt=$conn->prepare($query);
		$stmt->bind_param("i",$e_id);
		$stmt->execute();
		$result=$stmt->get_result();
		$row=$result->fetch_assoc();

		$e_id=$row['Emp_id'];
		$name=$row['Name'];
		$gender=$row['Gender'];
        $c_no=$row['Contact_no'];
		$s_gr=$row['Salary_grade'];
		$ws_date = $row['Work_start_date'];
		$ws_date= date("Y-m-d", strtotime($ws_date));		

		$update=true;
	}
	
	// Update records
	if(isset($_POST['update'])){
		$e_id=$_POST['e_id'];
		$name=$_POST['name'];
		$gender=$_POST['gender'];
		$c_no=$_POST['c_no'];
		$s_gr=$_POST['s_gr'];
		$ws_date = $_POST['ws_date'];
        		
        $insert_ws_date = date("Y-m-d", strtotime($ws_date));
	
		$query="UPDATE employee SET Name=? , Gender=? , Contact_no=? ,Salary_grade=? , Work_start_date=? WHERE Emp_id=?";
		$stmt=$conn->prepare($query);
		$stmt->bind_param("sssssi",$name,$gender,$c_no,$s_gr,$insert_ws_date,$e_id);
		$stmt->execute();
		

		$_SESSION['response']="Updated Successfully!";
		$_SESSION['res_type']="primary";
		header('location: ../employee.php');
	}

?>