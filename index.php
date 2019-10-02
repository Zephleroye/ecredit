<?php
require_once('config/databaseConfig.php');

session_start();

if(isset($_POST["login"])){
	//Establish Connection
	$servername = "localhost";
	$username = "root";
	$pass = "";
	$db = "ecredit";

	$conn = mysqli_connect($servername, $username, $pass, $db);
	
	$email = $_POST['email'];
	$password = $_POST['password'];
	
	//$sql ="SELECT * FROM customer WHERE email ='$email' AND password ='$password'";
	$result = mysqli_query($conn, "SELECT * FROM customer WHERE email ='$email' AND password ='$password'");
	$query_run = mysqli_fetch_array($result);
	//Get Row ID
	//$firstname = $_GET['first_name'];
	$firstname = $query_run['first_name'];
	$id = $query_run['id'];
	$_SESSION['userid'] = $id;
	$_SESSION['first_name'] = $firstname;
	
	if($query_run){
	//	echo $firstname;
	header("Location:customer.php");
	}
	else{
		$message = "Wrong Email or Password!";
		echo "<div class='col-md-3' style='font-size: 20px; color: white; text-align: center; background: #FF0000;'><p><i class='fa fa-exclamation-triangle' ></i> $message</p></div>";
			
	}
	
}



?>

<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>eCredit | Login</title>

    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="font-awesome/css/font-awesome.css" rel="stylesheet">

    <link href="css/animate.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
	<link rel='shortcut icon' href='img/fav_icon.jpg' type='image/x-icon'>

</head>

<body  background ="img/loan.jpg" class="gray-bg">

    <div class=" middle-box text-center loginscreen animated fadeInDown">
        <div>
            <div>

                <h1 class="logo-name">eC</h1>

            </div>
            <h2>Welcome</h2>
        
            <form class="m-t" action="" method="post">
                <div class="form-group has-feedback">
                    <input type="email" class="form-control" placeholder="Email" name="email" required="">
					<span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                </div>
                <div class="form-group has-feedback">
                    <input type="password" class="form-control" placeholder="Password" name="password" required="">
					<span class="glyphicon glyphicon-lock form-control-feedback"></span>
                </div>
                <button type="submit" class="btn btn-primary block full-width m-b" name="login">Login</button>

                <a href="forgot_password.php"><small>Forgot password?</small></a>
               
            </form>
            <p class="m-t"> <small>Edgeitsol Company &copy; 2018</small> </p>
        </div>
    </div>

    <!-- Mainly scripts -->
    <script src="js/jquery-2.1.1.js"></script>
    <script src="js/bootstrap.min.js"></script>

</body>

</html>
