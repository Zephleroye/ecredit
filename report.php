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
                                <li><a href="customer_profile.php">Profile</a></li>
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
                    <h2>Reports</h2>
                   
                </div>
                 
            </div>
			 <div class="wrapper wrapper-content animated fadeInRight">
			<div class="row">
			<div class="col-lg-5">
			<a href="script/report/credit_history.php">
				  <div class="widget style1 navy-bg">
                        <div class="row vertical-align">
                            <div class="col-xs-3">
                                <i class="fa fa-money fa-3x"></i>
                            </div>
                            <div class="col-xs-9 text-center">
                                <h2 class="font-bold">Credit History</h2>
                            </div>
                        </div>
                    </div>
			</a>		
			</div> 
			</div>
			<div class="row">
			<div class="col-lg-6">
			<a href="script/report/debit_history.php">
				  <div class="widget style1 red-bg">
                        <div class="row vertical-align">
                            <div class="col-xs-3">
                                <i class="fa fa-money fa-3x"></i>
                            </div>
                            <div class="col-xs-9 text-center">
                                <h2 class="font-bold">Debit History</h2>
                            </div>
                        </div>
                    </div>
			</a>		
			</div> 
			</div>
			
			<!--div class="row">
			<div class="col-lg-7">
			<a href="script/report/accural.php">
				  <div class="widget style1 yellow-bg">
                        <div class="row vertical-align">
                            <div class="col-xs-3">
                                <i class="fa fa-folder-o fa-3x"></i>
                            </div>
                            <div class="col-xs-9 text-center">
                                <h2 class="font-bold">Consolidated Accural</h2>
                            </div>
                        </div>
                   </div>
			</a>		
			</div> 
			</div-->
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
                toastr.success('View eCredit report', 'Welcome Authorizer');

            }, 1300);
          
        });

    </script>
 
<!-- Toastr -->
    <script src="js/plugins/toastr/toastr.min.js"></script>
</body>

 
</html>
