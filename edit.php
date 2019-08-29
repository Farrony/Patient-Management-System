<?php 
		include "include/connectdb.php";

		$update_id=$_GET['patient_id'];
		
	$fetchQuery="SELECT * FROM patient_details WHERE id=$update_id";

	$result_data=$conn->query($fetchQuery);


	if (isset($_POST['updatedata'])) {

		// $update_id=$_GET['std_id'];

		$name=$_POST['name'];
		$address=$_POST['address'];
		$birthdate=$_POST['birthdate'];
		$gender=$_POST['gender'];

		$updateQuery="UPDATE patient_details SET name='$name',address='$address',birthdate=$birthdate,gender='$gender' WHERE id=$update_id";

		if ($conn->query($updateQuery)==true) {
			// echo "Data Updated";
			header("Location:index.php");
		}else{
			die($conn->error);
		}
	}

 ?> 


<!DOCTYPE html>
<html>
<head>
	<title>Edit Data</title>
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
	<!-- font awesome -->
	<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css" />

	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-6 col-md-offset-2">
				<?php 
		while ($row=$result_data->fetch_assoc()) {
			

	 ?>

	<form action=" <?php $_SERVER['PHP_SELF']; ?>" method="post">
		<label for="">Patient Name : </label>
		<input type="text" name="name" value="<?php echo $row['name'];?>" class="in1"><br><br>
		<label for="">Patient Address: </label>
		<input type="text" name="address" value="<?php echo $row['address'];?>" class="in2"><br><br>
		<label for="">Birth Date : </label>
		<input type="date" name="birthdate" value="<?php echo $row['birthdate'];?>" class="in2"><br><br>
		<label for="">Gender : </label><br>
		<!-- <input type="text" name="gender" value="<?php echo $row['gender'];?>"><br><br> -->
		<input class="in4"  type="radio" name="gender" value="male" checked> Male<br>
  		<input type="radio" name="gender" value="female"> Female<br>
		
		<input id="btns" type="submit" name="updatedata" value="Update Data">
	</form>

	<?php } ?>

			</div>
		</div>
	</div>

	
	<script
  src="https://code.jquery.com/jquery-3.2.1.min.js"
  integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4="
  crossorigin="anonymous"></script>

  <!-- bootstrap cdn -->
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
  <!-- wow js -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/wow/1.1.2/wow.min.js"></script>
  <script src="js/wow.min.js"></script>
              <script>
              new WOW().init();
              </script>

</body>
</html>