<?php
require_once('config/databaseConfig.php');

session_start();
/*if(!isset($_SESSION['userid']))
{
    // not logged in
    header('Location: index.php');
    exit();
}
*/

if(isset($_POST["login"])){
	//Establish Connection
	$servername = "localhost";
	$uname = "root";
	$pass = "";
	$db = "ecredit";

	$conn = mysqli_connect($servername, $uname, $pass, $db);
	
	$username = $_POST['username'];
	$password = $_POST['password'];
	
	//$sql ="SELECT * FROM customer WHERE username ='$username' AND password ='$password'";
	$result = mysqli_query($conn, "SELECT * FROM admin WHERE username ='$username' AND password ='$password'");
	$query_run = mysqli_fetch_array($result);
	//Get Row ID
	$id = $query_run['id'];
	$username = $query_run['username'];
	$_SESSION['userid'] = $id;
	$_SESSION['username'] = $username;
	
	
	if($query_run){
		//echo "success";
		header("Location:bank_input.php");
	}
	else{
		$message = "Wrong username or Password!";
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
            <h2>Welcome Admin</h2>
        
            <form class="m-t" action="" method="post">
                <div class="form-group has-feedback">
                    <input type="username" class="form-control" placeholder="username" name="username" required="">
					<span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                </div>
                <div class="form-group has-feedback">
                    <input type="password" class="form-control" placeholder="Password" name="password" required="">
					<span class="glyphicon glyphicon-lock form-control-feedback"></span>
                </div>
                <button type="submit" class="btn btn-primary block full-width m-b" name="login">Login</button>

                <!--a href="forgot_password.php"><small>Forgot password?</small></a>
                <p class="text-muted text-center"><small>Do not have an account?</small></p>
                <a class="btn btn-sm btn-white btn-block" href="index.php">Create an account</a-->
            </form>
            <p class="m-t"> <small>Edgeitsol Company &copy; 2018</small> </p>
        </div>
    </div>

    <!-- Mainly scripts -->
    <script src="js/jquery-2.1.1.js"></script>
    <script src="js/bootstrap.min.js"></script>

</body>

</html>
