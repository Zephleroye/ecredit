<?php
session_start();
require_once('config/databaseConfig.php');

if(!isset($_SESSION['userid'])&& $_SESSION['username']== NULL)
{
    // not logged in
    header('Location: index.php');
    exit();
}
$id = $_SESSION['userid'];
$admin = $_SESSION['username'];
?>


<?php

if(isset($_POST["submit"])){
	
	$bank_name = $_POST['bank_name'];
	$fileToUpload = addslashes(file_get_contents($_FILES['fileToUpload']['tmp_name']));
	//$select_query = "SELECT* FROM bank_details";
	$select_query = mysqli_query($conn, "SELECT* FROM bank_details");
	$query_run = mysqli_fetch_array($select_query);
	
	if($query_run['record']==NULL){
	$insert_query = "INSERT INTO bank_details( bank_name,logo,record)
	VALUES('$bank_name','$fileToUpload',TRUE)";
	}
	else{
	$update_query = "UPDATE bank_details SET bank_name = '$bank_name', logo = '$fileToUpload' WHERE id=1";
		
	}
			if($conn->query($insert_query)=== TRUE){
				//$message = "Input Succesfully keyed in";
				//echo "<div class='col-md-3 text-right' style='font-size: 20px; color: white; text-align: center; background: #008000;'><p><i class='fa fa-check' style='color:#00800'></i>$message</p></div>";
			
				header("Location:bank_input_success.php");
			}
			elseif($conn->query($update_query)=== TRUE){
				//$message = "Input Succesfully keyed in";
				//echo "<div class='col-md-3 text-right' style='font-size: 20px; color: white; text-align: center; background: #008000;'><p><i class='fa fa-check' style='color:#00800'></i>$message</p></div>";
			
				header("Location:bank_input_success.php");
			}
			else{
				echo "Error".$update_query."<br/>".$conn->error;
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
                            eC
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
                    <h2>Bank input</h2>
                   
                </div>
                <!--div class="col-lg-2">

                </div-->
            </div>
			
			
	 <div class="col-md-8">
			<div class="ibox-content">
            <form class="m-t" action="" method="post">
			<div class="form-group  has-feedback">
				<label class="col-sm-2 control-label" >Upload Company Logo</label>
				 <div class="col-sm-4 col-sm-offset-1"><input type ="file" name ="fileToUpload" id="fileToUpload" required="" ></div>
			</div>
			<div class="hr-line-dashed"></div>
				<div class="form-group has-feedback">
                    <input type="text" class="form-control" placeholder="Bank name" name="bank_name" required="">
                </div>
                <button type="submit" class="btn btn-primary block full-width m-b" name="submit">Submit</button>
				
            </form>
           
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
                toastr.success('Input Successfully Keyed in');

            }, 1300);
            $('.footable').footable();
            $('.footable2').footable();
		
			
        });

    </script>
 
<!-- Toastr -->
    <script src="js/plugins/toastr/toastr.min.js"></script>
</body>

 
</html>
