<?php
	session_start();

	if(!isset($_SESSION['username']))  
	{  
		header('Location: ../index.php');
		die();   
	}
	$user = $_SESSION['username'];
	
?>

<body id="body-pd">
	<?php include 'nav-bar.php' ;?>
	<div class="container-fluid">
		<h1><?php echo "Welcome $user!";?></h1>
	</div>
</body>