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
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>Customer | Dashboard</title>

    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="font-awesome/css/font-awesome.css" rel="stylesheet">

    <!-- Toastr style -->
    <link href="css/plugins/toastr/toastr.min.css" rel="stylesheet">

    <!-- Gritter -->
    <link href="js/plugins/gritter/jquery.gritter.css" rel="stylesheet">

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

        <div id="page-wrapper" class="gray-bg dashbard-1">
        <div class="row border-bottom">
        <nav class="navbar navbar-static-top" role="navigation" style="margin-bottom: 0">
        <div class="navbar-header">
            <a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="#"><i class="fa fa-bars"></i> </a>
            <form role="search" class="navbar-form-custom" action="search_results.html">
                <!--div class="form-group">
                    <input type="text" placeholder="Search for something..." class="form-control" name="top-search" id="top-search">
                </div-->
            </form>
        </div>
            <ul class="nav navbar-top-links navbar-right">
                <!--li>
                    <span class="m-r-sm text-muted welcome-message">Welcome Cherished Customer</span>
                </li-->
                <li class="dropdown">
                    <a class="dropdown-toggle count-info" data-toggle="dropdown" href="#">
                        <i class="fa fa-envelope"></i>  <!--span class="label label-warning">16</span-->
                    </a>
                    <ul class="dropdown-menu dropdown-messages">
                        <li>
                            <div class="dropdown-messages-box">
                                <!--a href="" class="pull-left">
                                    <img alt="image" class="img-circle" src="">
                                </a>
                                <div class="media-body">
                                    <small class="pull-right">46h ago</small>
                                    <strong>Mike Loreipsum</strong> started following <strong>Monica Smith</strong>. <br>
                                    <small class="text-muted">3 days ago at 7:58 pm - 10.06.2014</small>
                                </div-->
                            </div>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <div class="dropdown-messages-box">
                                <!--a href="profile.html" class="pull-left">
                                    <img alt="image" class="img-circle" src="img/a4.jpg">
                                </a>
                                <div class="media-body ">
                                    <small class="pull-right text-navy">5h ago</small>
                                    <strong>Chris Johnatan Overtunk</strong> started following <strong>Monica Smith</strong>. <br>
                                    <small class="text-muted">Yesterday 1:21 pm - 11.06.2014</small>
                                </div-->
                            </div>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <div class="dropdown-messages-box">
                                <!--a href="profile.html" class="pull-left">
                                    <img alt="image" class="img-circle" src="img/profile.jpg">
                                </a>
                                <div class="media-body ">
                                    <small class="pull-right">23h ago</small>
                                    <strong>Monica Smith</strong> love <strong>Kim Smith</strong>. <br>
                                    <small class="text-muted">2 days ago at 2:30 am - 11.06.2014</small>
                                </div-->
                            </div>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <div class="text-center link-block">
                                <!--a href="">
                                    <i class="fa fa-envelope"></i> <strong>Read All Messages</strong>
                                </a-->
                            </div>
                        </li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a class="dropdown-toggle count-info" data-toggle="dropdown" href="#">
                        <i class="fa fa-bell"></i>  <span class="label label-primary"></span>
                    </a>
                    <ul class="dropdown-menu dropdown-alerts">
                        <li>
                            <!--a href="mailbox.html">
                                <div>
                                    <i class="fa fa-envelope fa-fw"></i> You have 16 messages
                                    <span class="pull-right text-muted small">4 minutes ago</span>
                                </div>
                            </a-->
                        </li>
                        <li class="divider"></li>
                        <li>
                            <!--a href="profile.html">
                                <div>
                                    <i class="fa fa-twitter fa-fw"></i> 3 New Followers
                                    <span class="pull-right text-muted small">12 minutes ago</span>
                                </div>
                            </a-->
                        </li>
                        <li class="divider"></li>
                        <!--li>
                            <a href="grid_options.html">
                                <div>
                                    <i class="fa fa-upload fa-fw"></i> Server Rebooted
                                    <span class="pull-right text-muted small">4 minutes ago</span>
                                </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <div class="text-center link-block">
                                <a href="notifications.html">
                                    <strong>See All Alerts</strong>
                                    <i class="fa fa-angle-right"></i>
                                </a>
                            </div>
                        </li-->
                    </ul>
                </li>


                <li>
                    <a href="config/logout.php">
                        <i class="fa fa-sign-out"></i> Log out
                    </a>
                </li>
                <!--li>
                    <a class="right-sidebar-toggle">
                        <i class="fa fa-tasks"></i>
                    </a>
                </li-->
            </ul>

        </nav>
        </div>
                <div class="row  border-bottom white-bg dashboard-header">

                    <div class="col-sm-3">
                        <h2>Welcome <?php echo $Customer_fname?>,</h2>
                       

					</div>
        <div class="row">
            <div class="col-lg-12">
                <div class="wrapper wrapper-content">
                        <div class="row">
							<div class="col-lg-3">
							 <a href="wallet.php">
								<div class="widget style1 navy-bg">
									<div class="row">
										<div class="col-xs-4">
											<!--i class="fa fa-usd fa-5x"></i-->
											<i class="fa-3x">&#8373;</i>
										</div>
										<div class="col-xs-8 text-right">
										
											<span> Credit your </br>eWallet </span>
											<h2 class="font-bold"><i class="fa fa-credit-card"></i></h2>
										
										</div>
									</div>
								</div>
								</a>
							</div>
							  <div class="col-lg-3">
									<a href="debit_request.php">
									<div class="widget style1 yellow-bg">
										<div class="row">
											<div class="col-xs-4">
												<!--i class="fa fa-usd fa-5x"></i-->
												<i class="fa fa-home fa-3x"></i>
											</div>
											<div class="col-xs-8 text-right">
											 
												<span> Make withdrawal from eWallet </span>
												<h2 class="font-bold"><i class="fa fa-money"></i></h2>
											
											</div>
										</div>
									</div>
									</a>
								</div>
								<div class="col-lg-3">
								 <a href="report.php">
								<div class="widget style1 lazur-bg">
									<div class="row">
										<div class="col-xs-4">
											<!--i class="fa fa-usd fa-5x"></i-->
											<i class="fa-3x">&#8373;</i>
										</div>
										<div class="col-xs-8 text-right">
										
											<span> View transaction history</span>
											<h2 class="font-bold"><i class="fa fa-money"></i></h2>
										
										</div>
									</div>
								</div>
								</a>
							</div>
								
						</div>
						
                </div>
				
                
            </div>
			
        </div>
		
				<div class="footer">
                   
                    <div>
                        <strong>Copyright</strong> Edgeitsol Company &copy; 2018
                    </div>
                </div>
        </div>
		
        <div class="small-chat-box fadeInRight animated">

            <div class="heading" draggable="true">
                <small class="chat-date pull-right">
                    <?php  echo date('m/d/Y');?>
                </small>
                Hi <?php  echo $Customer_fname;?>, 
            </div>

            <div class="content">

                <div class="left">
                    <div class="author-name">
                       Assistant  <small class="chat-date">
                       <?php  echo date("h:i:A");?>
                    </small>
                    </div>
                    <div class="chat-message active">
                        How may we help you ?
                    </div>

                </div>
                
            </div>
            <div class="form-chat">
                <div class="input-group input-group-sm"><input type="text" class="form-control"> <span class="input-group-btn"> <button
                        class="btn btn-primary" type="button">Send
                </button> </span></div>
            </div>

        </div>
        <div id="small-chat">

            <span class="badge badge-warning pull-right"></span>
            <a class="open-small-chat">
                <i class="fa fa-comments"></i>

            </a>
        </div>
       
    </div>

    <!-- Mainly scripts -->
    <script src="js/jquery-2.1.1.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/plugins/metisMenu/jquery.metisMenu.js"></script>
    <script src="js/plugins/slimscroll/jquery.slimscroll.min.js"></script>

    <!-- Flot -->
    <script src="js/plugins/flot/jquery.flot.js"></script>
    <script src="js/plugins/flot/jquery.flot.tooltip.min.js"></script>
    <script src="js/plugins/flot/jquery.flot.spline.js"></script>
    <script src="js/plugins/flot/jquery.flot.resize.js"></script>
    <script src="js/plugins/flot/jquery.flot.pie.js"></script>

    <!-- Peity -->
    <script src="js/plugins/peity/jquery.peity.min.js"></script>
    <script src="js/demo/peity-demo.js"></script>

    <!-- Custom and plugin javascript -->
    <script src="js/inspinia.js"></script>
    <script src="js/plugins/pace/pace.min.js"></script>

    <!-- jQuery UI -->
    <script src="js/plugins/jquery-ui/jquery-ui.min.js"></script>

    <!-- GITTER -->
    <script src="js/plugins/gritter/jquery.gritter.min.js"></script>

    <!-- Sparkline -->
    <script src="js/plugins/sparkline/jquery.sparkline.min.js"></script>

    <!-- Sparkline demo data  -->
    <script src="js/demo/sparkline-demo.js"></script>

    <!-- ChartJS-->
    <script src="js/plugins/chartJs/Chart.min.js"></script>

    <!-- Toastr -->
    <script src="js/plugins/toastr/toastr.min.js"></script>


    <script>
        $(document).ready(function() {
            setTimeout(function() {
                toastr.options = {
                    closeButton: true,
                    progressBar: true,
                    showMethod: 'slideDown',
                    timeOut: 5000
                };
                toastr.success('How do you do?', 'Welcome Cherished Customer');
				
            }, 1300);

 });
    </script>
</body>
</html>
