<?php
	//Global Variable
	$URL		= 'http://localhost/pajak';

	//Database Connection Configuration
	$database_server	= 'localhost';
	$username_server	= 'root';
	$password_server	= '';
	$databse_name		= 'pajak';
	$connect			= mysqli_connect($database_server, $username_server, $password_server, $databse_name);


	if(mysqli_connect_errno()){
		echo "<script>alert('ERR CODE : 500\\nMESSAGE  : CANNOT CONNECT TO DATABASE SERVER\\nThis may happen when the server encountered an internal error or misconfiguration and was unable to complete your request'); window.location=''</script>";
	}
    
    //Logout Session
    if(isset($_GET['logout'])){
		$logout = mysqli_real_escape_string($connect, $_GET['logout']);
		if($logout == "true"){
			setcookie('token', '', time()-3600, '/');
			header('Location: '.$URL.'/auth/login');
		}
	}
    
	//CSRF Token Configuration
	if(!isset($_COOKIE['csrf-token'])){
		$token = bin2hex(random_bytes(50));
		setcookie('csrf-token', $token, time()+300, '/');
	}
	if(isset($_COOKIE['csrf-token'])){
		$csrf_token = mysqli_real_escape_string($connect, $_COOKIE['csrf-token']);
		return $csrf_token;
	}
?>