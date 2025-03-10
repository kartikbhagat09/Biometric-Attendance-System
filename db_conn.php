<?php

	$servername = "localhost";
	$server_username = "root";
	$server_password = "php_databas";
	$server_database = "lab_attendance";
	
	$conn = mysqli_connect($servername,$server_username,$server_password,$server_database);
	if($conn){

		// echo "<center><h1 style='color:green'>Connection Successfully Established!</h1></center>";
	}
	else{
		
		echo "<div class='alert alert-warning alert-dismissible fade show' role='alert'>
		<strong>Connection Failed!</strong> Can't Connect to database 	
		<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
	  </div>";
	}

?>