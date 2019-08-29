<?php 
	
	$host="localhost";
	$user="root";
	$pass="";
	$db="patient";

	$conn=new mysqli($host,$user,$pass,$db);

	if ($conn->connect_error) 
	{
		die($conn->connect_error);
	}else{
		// echo "Connected";
	}

 ?>