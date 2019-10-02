<?php
session_start();
require_once('config/databaseConfig.php');
require_once('config/password_generator.php');
include ('config/hubtel_sms/Hubtel/Api.php');

if(!isset($_SESSION['userid'])&& $_SESSION['username']== NULL)
{
    // not logged in
    header('Location: index.php');
    exit();
}

$admin = $_SESSION['username'];
?>

<?php
$passcode = randomPassword();



if(isset($_POST["submit"])){
	
	$firstname = $_POST['first_name'];
	$lastname = $_POST['last_name'];
	$username = $_POST['username'];
	$password = randomPassword();
	$telephone = $_POST['phone'];
	$email = $_POST['email'];
	$sex = $_POST['sex'];
	
	if($_POST['role']== "super_admin"){
		
		$insert_query = "INSERT INTO admin( first_name,last_name,username,password,email,phone,sex,status)
			VALUES('$firstname','$lastname','$username','$password','$email','$telephone','$sex',1)";

	
			if($conn->query($insert_query)=== TRUE){
							
//Compose and send custom SMS message

	$auth = new BasicAuth("iazzdsrp", "inlbdiyy");
	// instance of ApiHost
	$apiHost = new ApiHost($auth);
	// instance of AccountApi
	$accountApi = new AccountApi($apiHost);
	// Get the account profile
	// Let us try to send some message
	$messagingApi = new MessagingApi($apiHost);
	

	try {
		// Send a quick message
		
		$result = mysqli_query($conn, "SELECT * FROM bank_details WHERE id = 1");
		$query_run = mysqli_fetch_array($result);
		$bank_name = $query_run['bank_name'];
		
		$tel = $_POST['phone'];
		$pass = $password;
		
		$messageResponse = $messagingApi->sendQuickMessage("$bank_name", "$tel","Your password is $pass");
		
		
		if ($messageResponse instanceof MessageResponse) {
			//echo $messageResponse->getStatus();
			$message =  $messageResponse->getStatus();
			
			//echo "<div class='col-md-3 text-right' style='font-size: 20px; color: white; text-align: center; background: #008000;'><p><i class='fa fa-check' style='color:#00800'></i>$message</p></div>";
			
			
		} elseif ($messageResponse instanceof HttpResponse) {
			//echo "\nServer Response Status : " . $messageResponse->getStatus();
			$message2 ="\nServer Response Status : " . $messageResponse->getStatus();
		}
	} catch (Exception $ex) {
		//echo $ex->getTraceAsString();
		$message3 = $ex->getTraceAsString();
	}
			
			header("Location:create_user_success.php");
			
			
			}
			
	}
	elseif($_POST['role']== "bank_inputter"){
		$insert_query = "INSERT INTO inputter( first_name,last_name,username,password,email,phone,sex,status)
			VALUES('$firstname','$lastname','$username','$password','$email','$telephone', '$sex', 1)";
			
			if($conn->query($insert_query)=== TRUE){
								
//Compose and send custom SMS message

	$auth = new BasicAuth("iazzdsrp", "inlbdiyy");
	// instance of ApiHost
	$apiHost = new ApiHost($auth);
	// instance of AccountApi
	$accountApi = new AccountApi($apiHost);
	// Get the account profile
	// Let us try to send some message
	$messagingApi = new MessagingApi($apiHost);
	

	try {
		// Send a quick message
		
	/*	$result = mysqli_query($conn, "SELECT * FROM admin WHERE id ='".$_SESSION['userid']."'");
		$query_run = mysqli_fetch_array($result);
		*/
		$tel = $_POST['phone'];
		$pass = $password;
		
		$messageResponse = $messagingApi->sendQuickMessage("eCredit", "$tel","Your password is $pass");
		
		
		if ($messageResponse instanceof MessageResponse) {
			//echo $messageResponse->getStatus();
			$message =  $messageResponse->getStatus();
			
			//echo "<div class='col-md-3 text-right' style='font-size: 20px; color: white; text-align: center; background: #008000;'><p><i class='fa fa-check' style='color:#00800'></i>$message</p></div>";
			
			
		} elseif ($messageResponse instanceof HttpResponse) {
			//echo "\nServer Response Status : " . $messageResponse->getStatus();
			$message2 ="\nServer Response Status : " . $messageResponse->getStatus();
		}
	} catch (Exception $ex) {
		//echo $ex->getTraceAsString();
		$message3 = $ex->getTraceAsString();
	}
				
				header("Location:create_user_success.php");
				
			}
			
	}
	else{
		$insert_query = "INSERT INTO authorizer( first_name,last_name,username,password,email,phone,sex,status)
			VALUES('$firstname','$lastname','$username','$password','$email','$telephone','$sex',1)";
			
			if($conn->query($insert_query)=== TRUE){
				
								
//Compose and send custom SMS message

	$auth = new BasicAuth("iazzdsrp", "inlbdiyy");
	// instance of ApiHost
	$apiHost = new ApiHost($auth);
	// instance of AccountApi
	$accountApi = new AccountApi($apiHost);
	// Get the account profile
	// Let us try to send some message
	$messagingApi = new MessagingApi($apiHost);
	

	try {
		// Send a quick message
		
	/*	$result = mysqli_query($conn, "SELECT * FROM admin WHERE id ='".$_SESSION['userid']."'");
		$query_run = mysqli_fetch_array($result);
		*/
		$tel = $_POST['phone'];
		$pass = $password;
		
		$messageResponse = $messagingApi->sendQuickMessage("eCredit", "$tel","Your password is $pass");
		
		
		if ($messageResponse instanceof MessageResponse) {
			//echo $messageResponse->getStatus();
			$message =  $messageResponse->getStatus();
			
			//echo "<div class='col-md-3 text-right' style='font-size: 20px; color: white; text-align: center; background: #008000;'><p><i class='fa fa-check' style='color:#00800'></i>$message</p></div>";
			
			
		} elseif ($messageResponse instanceof HttpResponse) {
			//echo "\nServer Response Status : " . $messageResponse->getStatus();
			$message2 ="\nServer Response Status : " . $messageResponse->getStatus();
		}
	} catch (Exception $ex) {
		//echo $ex->getTraceAsString();
		$message3 = $ex->getTraceAsString();
	}
	
				header("Location:create_user_success.php");
			}
			
	}
	
	
}




?>

<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>eCredit | admin</title>

    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="font-awesome/css/font-awesome.css" rel="stylesheet">

		<!-- Toastr style -->
    <link href="css/plugins/toastr/toastr.min.css" rel="stylesheet">
	
    <!-- FooTable -->
    <link href="css/plugins/footable/footable.core.css" rel="stylesheet">

    <link href="css/animate.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
	
<link rel='shortcut icon' href='img/fav_icon.jpg' type='image/x-icon'>

</head>

<body>

    <div id="wrapper">

 <nav class="navbar-default navbar-static-side" role="navigation">
            <div class="sidebar-collapse">
                <ul class="nav metismenu" id="side-menu">
                    <li class="nav-header">
                        <div class="dropdown profile-element"> <span>
                            <img alt="image" class="img-circle" src="img/profile_small.jpg" />
                             </span>
                            <a data-toggle="dropdown" class="dropdown-toggle" href="">
                            <span class="clear"> <span class="block m-t-xs"> <strong class="font-bold"><?php echo $admin?></strong>
                             <!--/span> <span class="text-muted text-xs block">Art Director <b class="caret"></b></span> </span--> </a>
                            <ul class="dropdown-menu animated fadeInRight m-t-xs">
                                <li><a href="#">Profile</a></li>
                                <!--li><a href="contacts.html">Contacts</a></li>
                                <li><a href="mailbox.html">Mailbox</a></li>
                                <li class="divider"></li-->
                                <li><a href="config/logout.php">Logout</a></li>
                            </ul>
                        </div>
                        <div class="logo-element">
                            IN+
                        </div>
                    </li>
                    <!--li class="active">
                        <a href="index.html"><i class="fa fa-th-large"></i> <span class="nav-label">Dashboards</span> <span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li class="active"><a href="index.html">Dashboard v.1</a></li>
                            <li><a href="dashboard_2.html">Dashboard v.2</a></li>
                            <li><a href="dashboard_3.html">Dashboard v.3</a></li>
                            <li><a href="dashboard_4_1.html">Dashboard v.4</a></li>
                            <li><a href="dashboard_5.html">Dashboard v.5 <span class="label label-primary pull-right">NEW</span></a></li>
                        </ul>
                    </li-->
                   
					<li>
                        <a href="bank_input.php"><i class="fa fa-bank"></i> <span class="nav-label">Bank Input</span></a>
                    </li>
					<li>
                        <a href="create_user.php"><i class="fa fa-user"></i> <span class="nav-label">Create User</span></a>
                    </li>
					 <li>
                        <a href="user.php"><i class="fa fa-user"></i> <span class="nav-label">View Users</span></a>
                    </li>
                    <!--li>
                        <a href="#"><i class="fa fa-bar-chart-o"></i> <span class="nav-label">Graphs</span><span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level collapse">
                            <li><a href="graph_flot.html">Flot Charts</a></li>
                            <li><a href="graph_morris.html">Morris.js Charts</a></li>
                            <li><a href="graph_rickshaw.html">Rickshaw Charts</a></li>
                            <li><a href="graph_chartjs.html">Chart.js</a></li>
                            <li><a href="graph_chartist.html">Chartist</a></li>
                            <li><a href="c3.html">c3 charts</a></li>
                            <li><a href="graph_peity.html">Peity Charts</a></li>
                            <li><a href="graph_sparkline.html">Sparkline Charts</a></li>
                        </ul>
                    </li-->
                    
                </ul>

            </div>
        </nav>

        <div id="page-wrapper" class="gray-bg">
        <div class="row border-bottom">
        <nav class="navbar navbar-static-top" role="navigation" style="margin-bottom: 0">
        <div class="navbar-header">
            <a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="#"><i class="fa fa-bars"></i> </a>
            <form role="search" class="navbar-form-custom" action="">
                <!--div class="form-group">
                    <input type="text" placeholder="Search for something..." class="form-control" name="top-search" id="top-search">
                </div-->
            </form>
        </div>
            <ul class="nav navbar-top-links navbar-right">

                <li class="dropdown">
                    <a class="dropdown-toggle count-info" data-toggle="dropdown" href="#">
                        <i class="fa fa-envelope"></i>  <span class="label label-warning"></span>
                    </a>
                    
                </li>
                <li class="dropdown">
                    <a class="dropdown-toggle count-info" data-toggle="dropdown" href="#">
                        <i class="fa fa-bell"></i>  <span class="label label-primary"></span>
                    </a>
                    
                </li>

				
                <li>
                    <a href="config/logout.php">
                        <i class="fa fa-sign-out"></i> Log out
                    </a>
                </li>
            </ul>

        </nav>
        </div>
            <div class="row wrapper border-bottom white-bg page-heading">
                <div class="col-lg-10">
                    <h2>Create User</h2>
                   
                </div>
                <!--div class="col-lg-2">

                </div-->
            </div>
			
			<div class="row">
            <div class="col-lg-10">
                <div class="wrapper wrapper-content">
				<div class="ibox-content">
                            <form method="post" class="form-horizontal" >
								 <div class="form-group"><label class="col-sm-2 control-label" >First Name</label>

                                    <div class="col-sm-8"><input type="text" class="form-control" name="first_name" required=""></div>
                                </div>
								<div class="hr-line-dashed"></div>
								 <div class="form-group"><label class="col-sm-2 control-label" >Last Name</label>

                                    <div class="col-sm-8"><input type="text" class="form-control" name="last_name" required=""></div>
                                </div>
								
                               <div class="hr-line-dashed"></div>
							   <div class="form-group">
								<label class="col-sm-2 control-label">Sex </label>
								<div class="col-sm-8">
									<select class="form-control m-b" name="sex" required="">
										<option style="display:none"></option>
                                        <option value="male">Male</option>
                                        <option value="female">Female</option>
                                    </select>

                                </div>
					 
								</div>
								<div class="hr-line-dashed"></div>
                                <div class="form-group"><label class="col-sm-2 control-label" >Email</label>

                                    <div class="col-sm-8"><input type="text" class="form-control" name="email" required=""></div>
                                </div>
                                <div class="hr-line-dashed"></div>
                                <div class="form-group"><label class="col-sm-2 control-label" >Phone</label>

                                    <div class="col-sm-8"><input type="text" name="phone" class="form-control"  required=""></div>
                                </div>
                            <div class="hr-line-dashed"></div>
                                <div class="form-group"><label class="col-sm-2 control-label" >Username</label>

                                    <div class="col-sm-8"><input type="text" class="form-control" name="username" required=""></div>
                                </div>
                                <div class="hr-line-dashed"></div>
                                <div class="form-group"><label class="col-sm-2 control-label" >Password</label>
                                    <div class="col-sm-8"><input type="text" disabled = "" class="form-control" name="password" placeholder="<?php echo $passcode ?>">
                                    </div>
                                </div>
								 <div class="hr-line-dashed"></div>
								
								 <div class="form-group"><label class="col-sm-2 control-label" >User Role</label>

                                    <div class="col-sm-8"><select class="form-control m-b" name="role" required="">
										<option style="display:none"></option>
                                        <option value="super_admin">Admin</option>
                                        <option value="bank_inputter">Clerk</option>
                                        <option value="bank_authorizer">Authorizer</option>
                                    </select>

                                    </div>
                                </div>
								
								  </br>
                                <div class="form-group" >
                                    <div class="col-sm-4 col-sm-offset-5">
                                        <!--button class="btn btn-white" type="submit">Cancel</button-->
                                        <button class="btn btn-primary" type="submit" name= "submit" >Create User</button>
                                    </div>
                                </div>
                            </form>
                        </div>
				</div>
			</div>
		</div>
			
        
        <div class="footer">
            <!--div class="pull-right">
                10GB of <strong>250GB</strong> Free.
            </div-->
            <div>
                <strong>Copyright</strong> Edgeitsol Company &copy; 2018
            </div>
        </div>

        </div>
        </div>



    <!-- Mainly scripts -->
    <script src="js/jquery-2.1.1.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/plugins/metisMenu/jquery.metisMenu.js"></script>
    <script src="js/plugins/slimscroll/jquery.slimscroll.min.js"></script>

    <!-- FooTable -->
    <script src="js/plugins/footable/footable.all.min.js"></script>

    <!-- Custom and plugin javascript -->
    <script src="js/inspinia.js"></script>
    <script src="js/plugins/pace/pace.min.js"></script>

    <!-- Page-Level Scripts -->
    <script>
        $(document).ready(function() {

			setTimeout(function() {
                toastr.options = {
                    closeButton: true,
                    progressBar: true,
                    showMethod: 'slideDown',
                    timeOut: 5000
                };
                toastr.success('User created successfully');

            }, 1300);
            $('.footable').footable();
            $('.footable2').footable();
		
			
        });

    </script>
 
<!-- Toastr -->
    <script src="js/plugins/toastr/toastr.min.js"></script>
</body>

 
</html>
