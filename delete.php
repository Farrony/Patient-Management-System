<?php 
 if (isset($_GET['patient_id'])) {

 	include "include/connectdb.php";
 	$delete_id= $_GET['patient_id'];

 	$delete_Query="DELETE FROM patient_details WHERE id=$delete_id";

 	if ($conn->query($delete_Query)==true) {
 		// echo "Data deleted";
 		header("Location:index.php");
 	}else{
 		die($conn->error);
 	}
 }

 ?>