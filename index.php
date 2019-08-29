<?php
	include 'include/connectdb.php';
	$result="";
	$notification="";
	session_start();

	if (isset($_SESSION['login_auth']) || isset($_COOKIE['login_auth_cookie'])) {
		header("Location:profile.php");
	}

	// create user
	if (isset($_POST['sign_up_btn'])) {
		$username=$_POST['username'];
		$password=md5($_POST['password']);

		$insertQuery="INSERT INTO `user`(`username`, `password`) VALUES ('$username','$password')";

		if ($conn->query($insertQuery)==true) {
			$result="User Successfully added";
		}else {
			die($conn->error);
		}
	}

	if (isset($_POST['sign_in_btn'])) {
		$username=$conn->real_escape_string($_POST['username']);
		$password=$conn->real_escape_string(md5($_POST['password']));
		// echo $username." ".$password;

		$sql="SELECT * FROM user WHERE username='$username' AND password='$password'";

		$result=$conn->query($sql);

		if ($result->num_rows==1) 
		{
			$_SESSION['login_auth']=$username;
			setcookie('login_auth_cookie',$username,time()+(60*60*24*7),'/');
			header("Location:profile.php");
		}else{
			$notification="Please check your username or password.";
		}
	}


 ?>


<!DOCTYPE html>
<html>
<head>
	<title>Login Page</title>
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
	<!-- font awesome -->
	<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css" />

	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
<div class="wrapper">
	<div class="container">
		<div class="row">
			<div class="col-md-4 col-md-offset-4">
				<div class="login">
		<div class="notification">
			<?php echo $notification; ?>
		</div>
		<div class="re">
			<p><?php echo $result; ?></p>
		</div>
		<form action="" method="post">
			<div class="form-group">
				<label for="">Enter Email or Username</label><br>
				<input style="width: 200px;height: 40px;border-radius: 5px;border: 1px solid antiquewhite;" type="text" name="username"><br>
			</div>
			<div class="form-group">
				<label for="">Password</label><br>
				<input style="width: 200px;height: 40px;border-radius: 5px;border: 1px solid antiquewhite;"  type="password" name="password"><br>
			</div>
			<br> 	
			<input class="wow bounceOut" id="btns" type="submit" name="sign_in_btn" value="Sign in">
		</form>
	</div>
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
</html>