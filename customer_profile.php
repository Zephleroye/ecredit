<?php
session_start();
require_once('config/databaseConfig.php');
if(!isset($_SESSION['userid'])&& $_SESSION['first_name'] == NULL)
{
    // not logged in
    header('Location: index.php');
    exit();
}
?>

<?php
		
		$Customer_fname = $_SESSION['first_name'];
		$id = $_SESSION['userid'];
		$result = mysqli_query($conn, "SELECT * FROM customer WHERE id ='$id'");
		$query_run = mysqli_fetch_array($result);
		
		$picture = $query_run['customer_profile_picture'];
		
?>
<?php
	
		//$row_id =$_GET['id'];
		
		$customer_query = mysqli_query($conn, "SELECT * FROM customer WHERE id ='$id'");
		$query_run = mysqli_fetch_array($customer_query);
		
		$fileToUpload1 = $query_run["customer_profile_picture"];
		$previous_password = $query_run['password'];
		
		
	$message1 = "Password Mismatch! Please enter the correct previous password";
	$message2 =	"Passwords Equal! New password cannot be the same as previous password"	

	
	
?>

<?php
if(isset($_POST["submit"])){
	$old_password = $_POST['password_old'];
	$new_password = $_POST['password_new'];

if($old_password!= $previous_password){
	echo "<div class='col-md-3' style='font-size: 20px; color: white; text-align:center; background: #FF0000;'><p><i class='fa fa-exclamation-triangle' ></i> $message1</p></div>";
	
	
	}
else if($old_password== $new_password){
	echo "<div class='col-md-3' style='font-size: 20px; color: white; text-align:center; background: #FF0000;'><p><i class='fa fa-exclamation-triangle' ></i> $message2</p></div>";
	
}


else{
	$update_query = "UPDATE customer SET password = '$new_password' WHERE id ='$id'";
	
		if($conn->query($update_query) === TRUE){
			
		header("Location:reset_password_success.php");
		}
		
}
}

?>


<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Customer | Dashboard</title>

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
                           <img alt="image" class="img-circle" src="data:image/jpeg;base64, <?php echo base64_encode($picture);?>"class="img-circle circle-border m-b-md" alt="profile" style="width: 50px; height: 50px;" />
                             </span>
                            <a data-toggle="dropdown" class="dropdown-toggle" href="">
                            <span class="clear"> <span class="block m-t-xs"> <strong class="font-bold"><?php echo $Customer_fname?></strong>
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
                        <a href="customer.php"><i class="fa fa-home"></i> <span class="nav-label">Home</span></a>
                    </li>
                    <li>
                        <a href="wallet.php"><i class="fa fa-credit-card"></i> <span class="nav-label">Credit eWallet</span></a>
                    </li>
					<li>
                        <a href="debit_request.php"><i class="fa fa-money"></i> <span class="nav-label">Make withdrawal</span></a>
                    </li>
					<li>
                        <a href="report.php"><i class="fa fa-history"></i> <span class="nav-label">History</span></a>
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
                    <h2>Reset Your password</h2>
                   
                </div>
                <!--div class="col-lg-2">

                </div-->
            </div>
       
		
		
		<div class="row">
            <div class="col-lg-10">
                <div class="wrapper wrapper-content">
				<div class="ibox-content">
						 
                            <form method="POST" class="form-horizontal" >
								
								<div class="form-group">
								<label class="col-sm-2 control-label" ></label>
								<div class="col-sm-4 col-sm-offset-1">
								<img src="data:image/jpeg;base64,<?php echo base64_encode($fileToUpload1); ?>" style="width: 150px; height: 150px;">
								</div>
								</div>
								<div class="hr-line-dashed"></div>
								
								
								<div class="form-group"><label class="col-sm-2 control-label" >Old Password</label>
								<!--div class="col-lg-10"><input type="text" disabled="" placeholder="Disabled input here..." class="form-control"></div-->

                                    <div class="col-sm-8"><input type="password"  class="form-control"  name="password_old"></div>
                                </div>
                                <div class="hr-line-dashed"></div>
                                <div class="form-group"><label class="col-sm-2 control-label" >New Password</label>
                                    <div class="col-sm-8"><input type="password"  class="form-control"  name="password_new">
                                    </div>
                                </div>
                                <div class="hr-line-dashed"></div>
                                
								
								  </br> </br>
                                <div class="form-group" >
                                    <div class="col-sm-4 col-sm-offset-4">
                                        <!--button class="btn btn-white" type="submit">Cancel</button-->
										<!--a class='btn btn-sm btn-white' href="script/customerValidate.php?id='$row_id'"><i class='fa fa-check text-navy'></i></a-->
										
										<button type="submit" class="btn btn-primary block full-width m-b" name="submit" >Submit</button>
                                        <!--button class="btn btn-primary" type="submit" name= "submit" >Save Customer Details</button-->
										
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
                toastr.success('Reset your password');

            }, 1300);
            $('.footable').footable();
            $('.footable2').footable();
		
			
        });

    </script>
 
<!-- Toastr -->
    <script src="js/plugins/toastr/toastr.min.js"></script>
</body>

 
</html>
