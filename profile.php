<?php 
	session_start();
	if (isset($_SESSION['login_auth']) || isset($_COOKIE['login_auth_cookie']))
	{

 ?>
<!-- dashbord -->
	<?php 

	include "include/connectdb.php";
// data insert code 
	$result=null;

	if (isset($_POST['insertdata'])) {
		$name=$_POST['name'];
		$address=$_POST['address'];
		// $book_category=$_POST['book_category'];
		$birthdate=$_POST['birthdate'];
		$gender=$_POST['gender'];

		// echo $firstname." ".$lastname." ".$age." ".$section_id;

		$insertQuery="INSERT INTO `patient_details`(`id`,`name`,`address`,`birthdate`,`gender`) VALUES ('','$name','$address','$birthdate','$gender')";

		// $conn->query($insertQuery);

		if ($conn->query($insertQuery)==true) {
			$result="Data Inserted Successfully";
		}else {
			die($conn->error);
		}
	} 

	// search
	
	$flag=0;
	if (isset($_POST['search_btn'])) {
		$search_data=$_POST['search_data'];
		$fetchQuery="SELECT * FROM patient_details WHERE name LIKE 
		'%$search_data'";
		$flag=1;

	}
	if ($flag==0) {
	
		$fetchQuery="SELECT * FROM patient_details";
		
	}
// datafetch code

	// $fetchQuery="SELECT * FROM student";

	$result_data=$conn->query($fetchQuery);

 ?>
<!-- dashbord -->



<!DOCTYPE html>
<html>
<head>
	<title>Profile page</title>
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
	<!-- font awesome -->
	<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css" />

	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
	<div class="wrapper2">
		<div class="container-fluid">
			<div class="row">
				<div class="col-md-12">
					<div class="pr">
						<h2>Hello, <?php echo isset($_SESSION['login_auth'])? $_SESSION['login_auth']:$_COOKIE['login_auth_cookie']; ?></h2>
	<p>This is your profile</p>
					</div>
	<h3 style="text-align: center;background: #50A3D7;    text-align: center;
    background: #50A3D7;
    color: white;
    font-weight: bold;
    padding: 10px;
    margin-bottom: 50px;
    margin-top: 40px;">Patient Registration</h3>

	<!-- dashbord -->
	<h2>New Patient Registration</h2>
	<hr>

	<form action="<?php $_SERVER['PHP_SELF']; ?>" method="post">
		<label class="lb1"  for="">Enter Patient Name : </label>
		<input class="in1"  type="text" name="name"><br><br>
		<label class="lb2"  for="">Enter  Patient address: </label>
		<input class="in2"  type="text" name="address"><br><br>
		<label class="lb3"  for="">Birth Date : </label>
		<input class="in3"  type="date" name="birthdate"><br><br>
		<label class="lb4"  for="">Gender</label><br>
		<input class="in4"  type="radio" name="gender" value="male" checked> Male<br>
  		<input type="radio" name="gender" value="female"> Female<br>

		<br><input id="insert" type="submit" name="insertdata" value="Insert Data">
	</form>

	<p class="result"><?php echo $result; ?></p>
	
	<!-- search -->
	<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
		<input class="in" type="text" name="search_data" placeholder="Search...">
		<input id="btns" type="submit" name="search_btn" value="Search">
	</form><br><br>

	<?php 
		if ($result_data->num_rows>0) {
	?>
	<table class="table table-striped" border="1">
		<tr>
			<th style="padding: 10px">Serial No</th>
			<th style="padding: 10px">Patient Name</th>
			<th style="padding: 10px">Patient Address</th>
			<th style="padding: 10px">Birth Date</th>
			<th style="padding: 10px">Gender</th>
			<th style="padding: 10px">Action</th>
		</tr>
	<?php
			$i=1;
			while ( $row= $result_data->fetch_assoc()) {

			?>
			<tr>
				<td style="padding: 10px"><?php echo $i; ?></td>
				<td style="padding: 10px"><?php echo $row['name']; ?></td>
				<td style="padding: 10px"><?php echo $row['address']; ?></td>
				<td style="padding: 10px"><?php echo $row['birthdate']; ?></td>
				<td style="padding: 10px"><?php echo $row['gender']; ?></td>
				<td style="padding: 10px"><a href="edit.php?patient_id=<?php echo $row['id'];?>" class="glyphicon glyphicon-pencil">&nbsp;&nbsp;Edit</a>&nbsp;&nbsp;&nbsp;&nbsp;<a href="delete.php?patient_id=<?php echo $row['id'];?>" class="glyphicon glyphicon-remove">&nbsp;&nbsp;Delete</a></td>
				
			</tr>
				
				<!-- echo $row['firstname']." ".$row['lastname']." ".$row["age"]; -->
			<?php
				$i++;
			}
			?>
				</table>
			<?php
		}

	 ?>
	<!-- dashbord -->

	<br><br>
	<a id="btns" href="logout.php">Logout</a>
	<div style="margin-bottom: 30px;"></div>

				</div>
			</div>
		</div>
	</div>
		<!-- script -->
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
<?php
 }else{
 	header("Location:index.php");
 } 

 ?>
</html>