<?php
session_start();
require_once('config/databaseConfig.php');
include('config/hubtel_sms/Hubtel/Api.php');
include('config/2fa_generator.php');

if(!isset($_SESSION['userid'])&& $_SESSION['first_name'])
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
		$phone = $query_run['telephone'];
		$first_name = $query_run['first_name'];
		$last_name = $query_run['last_name'];
		$acc_no = $query_run['account_no'];
		$account_balance = $query_run['account_balance'];
		$loan_date = $query_run['current_form_date'];
		$bank_account_balance = $query_run['bank_account_balance'];
		$minimum_payment = $query_run['minimum_payment'];
		$payment_date = date("m/d/Y");
		$payment_time = time();
		
	
?>

<?php 

if(isset($_POST["submit"])){
	
	$code =  Password_2FA();
	//echo $code;
	$withdrawal_amount = $_POST['withdrawal_amount'];
	
	if($account_balance<=$minimum_payment){
		
		$message1 = "Withdrawal Transaction Failed! Your account balance is less than your minimum payment. Please credit your account ";
		echo "<div class='col-md-3' style='font-size: 20px; color: white; text-align:center; background: #FF0000;'><p><i class='fa fa-exclamation-triangle' ></i> $message1</p></div>";
	
	}
	
	else{
	$updateCustomerQuery = "UPDATE customer SET withdrawal_request = TRUE, code_2fa ='$code', amount = '$withdrawal_amount' WHERE id = '$id'";
	
	if($conn->query($updateCustomerQuery) === TRUE){
	//	$trigger_query = "CREATE TRIGGER payment_schema BEFORE UPDATE on customer FOR EACH ROW SET payment_amount"
		
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
		
		/*$result = mysqli_query($conn, "SELECT * FROM authorizer");
		$query_run = mysqli_fetch_array($result);
		
		$tel = $query_run['phone'];*/
		//$p = $_POST['payment_amount'];
		$result1 = mysqli_query($conn, "SELECT * FROM bank_details WHERE id = 1");
		$query_run1 = mysqli_fetch_array($result1);
		$bank_name = $query_run1['bank_name'];
		
		
		//$messageResponse = $messagingApi->sendQuickMessage("$bank_name", "$tel","A withdrawal request of GHS $withdrawal_amount has been made on $first_name $last_name's account($acc_no), whose phone number is $phone. Please approve withdrawal");
			$messageResponse = $messagingApi->sendQuickMessage("$bank_name", "$phone","Your 2FA-Code is $code");
		
		
		
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
		//header("Location:debit_request_success.php");
		//echo "success";
		header("Location:debit_test.php");
	}
	
   }


}

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

                    <div class="col-sm-12">
                        <h3>View your account details and make a debit request</h3>
                        
                    </div>
                    
				</div>
				
						
		<div class="row">
			<div class="col-lg-5">	
			<div class="wrapper wrapper-content animated fadeInRight">
				 <div class="widget-head-color-box p-lg text-center">
                            <div class="m-b-md">
                            <h2 class="font-bold no-margins">
                                <?php echo $Customer_fname?>
                            </h2>
                               
                            </div>
                            <img src="data:image/jpeg;base64, <?php echo base64_encode($picture);?>" class="img-circle circle-border m-b-md" alt="profile" style="width: 150px; height: 150px;">
                            <div>
                                <span><strong>Account #: </strong><?php echo $acc_no; ?></span></br>
								<span><strong>Account Balance: </strong>Gh&#8373; <?php echo $account_balance; ?></span></br>
								
							</span>
                            </div>
                 </div>
				
			</div>
			</div>
			<div class="col-lg-7">	
			
					</br>
								<div class="wrapper wrapper-content">
								<div class="ibox-content">
								 
								<form method="POST" class="form-horizontal" >
								<div class="form-group">
								 <div class="form-group"><label class="col-sm-2 control-label" >Acc #</label>
								<!--div class="col-lg-10"><input type="text" disabled="" placeholder="Disabled input here..." class="form-control"></div-->

                                    <div class="col-sm-8"><input type="text" disabled="" class="form-control" placeholder="<?php echo $acc_no;?>" name="date"></div>
                                </div>
								</br></br>
								  <div class="form-group"><label class="col-sm-2 control-label" >Date</label>
								<!--div class="col-lg-10"><input type="text" disabled="" placeholder="Disabled input here..." class="form-control"></div-->

                                    <div class="col-sm-8"><input type="text" disabled="" class="form-control" placeholder="<?php echo $payment_date;?>" name="date"></div>
                                </div>
                                </br></br>
                                <div class="form-group"><label class="col-sm-2 control-label" >Gh&#8373;</label>
                                    <div class="col-sm-8"><input type="number" step ="any" class="form-control" placeholder="Enter debit amount" name="withdrawal_amount" required ="" >
                                    </div>
                                </div>
                               
                                   
								 </div>
								
								
								<div class="hr-line-dashed"></div>
								 <div class="form-group" >
                                    <div class="col-sm-4 col-sm-offset-3">
                                        <!--button class="btn btn-white" type="submit">Cancel</button-->
										<!--a class='btn btn-sm btn-white' href="script/customerValidate.php?id='$row_id'"><i class='fa fa-check text-navy'></i></a-->
										
										<button type="submit"  class="btn btn-primary block full-width m-b"  name="submit">Confirm Transaction</button>
                                       
										  <!--div class="modal inmodal" id="myModal" tabindex="-1" role="dialog" aria-hidden="true">
                                
											<div class="modal-dialog">
											<div class="modal-content animated bounceInRight">
													<div class="modal-header">
														<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
														<i class="fa fa-envelope-o modal-icon"></i>
														<h4 class="modal-title">Enter 2FA-Code</h4>
														<small class="font-bold">Enter 5-digit code which has been sent to you via sms.</small>
													</div>
													<div class="modal-body">
														<!--p><strong>Lorem Ipsum is simply dummy</strong> text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown
															printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting,
															remaining essentially unchanged.</p>
																<div class="form-group"><input type="number" required ="" placeholder="Enter your 2FA here" class="form-control"></div>
													</div>
													<div class="modal-footer">
														<button type="submit" name ="validate" class="btn btn-primary">Validate</button>
														<button type="submit" name ="resend" class="btn btn-success" >Resend 2FA</button>
														<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
													</div>
												</div>
											</div>
										  </div-->
                                    </div>
                                </div>
								
                            </form>
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
                toastr.success('Debit Request Successfully sent. Your request would be processed shortly');
				
            }, 1300);

 });
    </script>
</body>
</html>
