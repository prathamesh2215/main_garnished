<?php 
include("include/routines.php");

if(isset($_SESSION['panel_user']))
{
	header("Location: view_dashboard.php?pag=Dashboard");
	exit();
}

// $sql_logged_user      = "select * from tbl_cadmin_users where id = '".$logged_uid."'";
// $result_logged_user   = mysqli_query($db_con,$sql_logged_user) or die(mysqli_error($db_con));
// $num_rows_logged_user = mysqli_fetch_array($result_logged_user);

// if (!(isset($_POST['password'])) && $num_rows_logged_user > 0) 
// {
// 	header("Location: view_dashboard.php?pag=Dashboard");
// 	exit(0);
// }
// elseif(isset($_POST['password']))
// {
// 	$password = $_POST['password'];
// 	$sql_user = "select * from tbl_cadmin_users where id = '".$logged_uid."' and password = '".$password."'";
// 	$result_user = mysqli_query($db_con,$sql_logged_user) or die(mysqli_error($db_con));
// 	$num_rows_user = mysqli_query($db_con,$result_logged_user);	
// 	if ($num_rows_user > 0) 
// 	{
// 		header("Location: index.php");
// 		exit(0);
// 	}
// 	else
// 	{
// 		echo "Error";	
// 	}
// }
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Garnishd :: Admin Panel</title>
<!--<link rel="shortcut icon" href="img/logo.ico">-->
<!-- Bootstrap -->
<link rel="stylesheet" href="css/bootstrap.min.css">
<!-- Bootstrap responsive -->
<link rel="stylesheet" href="css/bootstrap-responsive.min.css">
<!-- Theme CSS -->
<link rel="stylesheet" href="css/style.css">
<!-- Color CSS -->
<link rel="stylesheet" href="css/themes.css">
<!-- jQuery -->
<script src="js/jquery.min.js"></script>
<!-- Nice Scroll -->
<script src="js/plugins/nicescroll/jquery.nicescroll.min.js"></script>
<!-- Validation -->
<script src="js/plugins/validation/jquery.validate.min.js"></script>
<script src="js/plugins/validation/additional-methods.min.js"></script>
<!-- Bootstrap -->
<script src="js/bootstrap.min.js"></script>
<script src="js/eakroko.js"></script>
<!-- custom css by punit 16 may 2018 -->
<style type="text/css">
	.bgimage{
		background: url('images/tic-tac-toe.png') !important;
	}

	.cus_wrapper{
		max-width:460px;
		background-color:#fff;
		box-shadow: 1px 4px 45px 0 rgba(0, 0, 0, 0.1);
		border-radius: .35rem;
	}

	.login-ptb{
		padding:20px;
	}
</style>
<!-- custom css by punit 16 may 2018 -->
</head>    
<body class="login theme-orange bgimage" data-theme="theme-orange">

<div class="wrapper ">
	<div class="login-body login-ptb cus_wrapper">    
            <div align="center" class="login-ptb">
            	<a href="javascript:void(0);"><h1>Garnished</h1><!-- <img src="images/logo.png" height="120" style="height:100px" /> --></a>
            </div>
			<form method='post' class='form-validate' id="frm_login">
				<div class="control-group">
					<div class="pw controls">
						<input type="text" name="userid" id="userid" placeholder="Email" class="input-block-level" data-rule-required="true" data-rule-email="true">
					</div>
				</div>
				<div class="control-group">
					<div class="pw controls">
						<input type="password" name="password" id="password" placeholder="Password" class='input-block-level' data-rule-required="true">
					</div>
				</div>
				<div class="submit">
					<input type="submit" value="Log in" class='btn btn-primary'>
				</div>
			</form>
            <!-- <div class="forget">
				<a href="#"><span>Forgot password?</span></a>
			</div> -->
    </div>
    <p align="center" style="margin-top:10px">© 2018 Garnishd</p>
</div>
	<script type="text/javascript">
		
			$('#frm_login').on('submit', function(e) 
			{
				e.preventDefault();
				if ($('#frm_login').valid())
				{
					var emailid		= $.trim($('input[name="userid"]').val());
					var password 	= $.trim($('input[name="password"]').val());					
					$.post(location.href,{emailid:emailid,password:password,jsubmit:'SiteLogin'},function(data){
						console.log(data);
						if (data.length > 0) 
						{
							alert(data);
						} 
						else 
						{
							// location.replace(location.href);
							window.location.assign("<?php echo $BaseFolder; ?>view_dashboard.php?pag=Dashboard");
						}
						return false;
					});
				}				
			});
					
	</script>
    </body>
</html>