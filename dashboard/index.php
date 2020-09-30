<?php
	session_start();

	if(!isset($_SESSION['username']))  
	{  
		header('Location: ../index.php');
		die();   
	}
	$user = $_SESSION['username'];
	echo "Welcome $user!";
?>

<a href="../logout.php">Logout</a>