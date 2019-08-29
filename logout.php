<?php 
	session_start();

	if (isset($_SESSION['login_auth']) || isset($_COOKIE['login_auth_cookie']))
	{
		session_destroy();
		setcookie('login_auth_cookie','',time()-3600,'/');
	}

		header("Location:index.php");


 ?>