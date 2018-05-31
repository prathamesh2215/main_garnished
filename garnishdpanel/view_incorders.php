<?php
include("include/routines.php");
checkuser();
chkRights(basename($_SERVER['PHP_SELF']));

// This is for dynamic title, bread crum, etc.
if(isset($_GET['pag']))
{
	$title = $_GET['pag'];
}
$path_parts   		= pathinfo(__FILE__);
$filename 	  		= $path_parts['filename'].".php";
$sql_feature 		= "select * from tbl_admin_features where af_page_url = '".$filename."'";
$result_feature 	= mysqli_query($db_con,$sql_feature) or die(mysqli_error($db_con));
$row_feature  		= mysqli_fetch_row($result_feature);
$feature_name 		= $row_feature[1];
$home_name    		= "Home";
$home_url 	  		= "view_dashboard.php?pag=Dashboard";
$utype				= $_SESSION['panel_user']['utype'];
$tbl_users_owner 	= $_SESSION['panel_user']['tbl_users_owner'];
?>
<!doctype html>
<html>
<head>	
<?php 
	/* This function used to call all header data like css files and links */
	headerdata($feature_name);
	/* This function used to call all header data like css files and links */	
?>
<!-- added by satish for datepicker-->

<link href="./bootstrap/css/bootstrap-datetimepicker.min.css" rel="stylesheet" media="screen">
<!-- datepicker end here-->
</head>
<body  class="<?php echo $theme_name;?>" data-theme="<?php echo $theme_name;?>" >
	<?php 
	/*include Bootstrap model pop up for error display*/
	modelPopUp();
	/*include Bootstrap model pop up for error display*/	
	/* this function used to add navigation menu to the page*/ 
	navigation_menu();
	/* this function used to add navigation menu to the page*/  
	?> <!-- Navigation Bar --> 
    <div class="container-fluid" id="content">
		<div id="main" style="margin-left:0px !important">
        	<div class="container-fluid" id="div_view_order">                
				<?php 
                /* this function used to add navigation menu to the page*/ 
                breadcrumbs($home_url,$home_name,'View Orders',$filename,$feature_name); 
                /* this function used to add navigation menu to the page*/ 
                ?>          
				<div class="row-fluid" id="all_orders" style="display:block;">
					<div class="span12">
						<div class="box box-color box-bordered">
							<div class="box-title">
                            	<h3><i class="icon-table"></i><?php echo $feature_name; ?></h3>
                            </div> <!-- header title-->
                            <div class="box-content nopadding">
                                <div style="padding:10px 15px 10px 15px !important">
                                    <input type="hidden" name="hid_page" id="hid_page" value="1">
                                    <input type="hidden" name="desg_parent" id="desg_parent" value="Parent">
                                    <select name="rowlimit" id="rowlimit" onChange="loadOrderData();"  class = "select2-me">
                                        <option value="10" selected>10</option>
                                        <option value="25">25</option>
                                        <option value="50">50</option>
                                        <option value="100">100</option>
                                    </select> entries per page
                                    <input type="text" class="input-medium" id = "srch" name="srch" placeholder="Search here..."  style="float:right;margin-right:10px;margin-top:10px;" >
                                </div>
                                <div class="profileGallery">
                                    <div style="width:99%;" align="center">
                                        <div id="loading"></div>                                            
                                        <div id="container1" class="data_container">
                                            <div class="data"></div>
                                        </div>
                                    </div>
                                </div>
                            </div><!--End bbox-content-->
                      	</div>
					</div>
				</div> 
                                             
			</div>
		</div>
	</div>

	<!-- Modal for View Detail -->
	<div class="modal fade" id="prod_modal" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="modal-title">
                        <h5>Product Detail</h5>
                    </div>
                </div>
                
                <div class="modal-body" id="prod_body"></div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
       </div>
    <?php getloder();?>		     
    <script type="text/javascript">
		function loadOrderData()
		{  
		    var daterange =$('#daterange1').val();
			var start_date =$('#start_date').val();
			var end_date   =$('#end_date').val();
		    if(daterange=="specific_date")
			{
				if(start_date=="")
				{
					return false;
				}
			}
			if(daterange=="date_range")
			{
				if(start_date=="" || end_date=="")
				{
					return false;
				}
			}
			loading_show();
			row_limit 	= $.trim($('select[name="rowlimit"]').val());
			search_text = $.trim($('#srch').val());
			page 		= $.trim($("#hid_page").val());					
			
			
			
			if(row_limit == "" && page == "")
			{
				$("#model_body").html('<span style="style="color:#F00;">Can not Get Row Limit and Page number</span>');				
			}
			else
			{
				var sendInfo 	= {"daterange":daterange,"start_date":start_date,"end_date":end_date,"row_limit":row_limit, "search_text":search_text, "load_orders":1, "page":page};
				var desg_load 	= JSON.stringify(sendInfo);				
				$.ajax({
					url: "load_incorders.php?",
					type: "POST",
					data: desg_load,
					contentType: "application/json; charset=utf-8",						
					success: function(response) 
					{//alert(response);
						data = JSON.parse(response);
						if(data.Success == "Success") 
						{ //  alert(data.resp);
							loading_hide();
							$("#container1").html(data.resp);
							loading_hide();
						} 
						else
						{							
							$("#container1").html(data.resp);
							loading_hide();							
						}
					},
					error: function (request, status, error) 
					{
						$("#model_body").html('<span style="style="color:#F00;">'+request.responseText+'</span>');							
						$('#error_model').modal('toggle');						
						loading_hide();
					},
					complete: function()
					{
						loading_hide();
						//alert("complete");
					}
				});
			}
		}
		
		function getDetail(cust_id)
		{
			var sendInfo 		= {"cust_id":cust_id, "getDetail":1};
			var ind_insert = JSON.stringify(sendInfo);				
			$.ajax({
				url: "load_incorders.php?",
				type: "POST",
				data: ind_insert,
				contentType: "application/json; charset=utf-8",						
				success: function(response) 
				{
					data = JSON.parse(response);
					if(data.Success == "Success") 
					{
						$('#prod_body').html(data.resp);
						$('#prod_modal').modal('toggle');
						loading_hide();
					} 
					else 
					{
						$("#model_body").html('<span style="style="color:#F00;">'+data.resp+'</span>');
						$('#error_model').modal('toggle');
						loading_hide();					
					}
				},
				error: function (request, status, error) 
				{
					$("#model_body").html('<span style="style="color:#F00;">'+request.responseText+'</span>');
					$('#error_model').modal('toggle');
					loading_hide();
				},
				complete: function()
				{
					loading_hide();	
				}
			});
		}	


		$( document ).ready(function() 
		{
			$('#srch').keypress(function(e) 
			{
				if(e.which == 13) 
				{	
					$("#hid_page").val("1");				
					loadOrderData();
				}
			});
			loadOrderData();
			$('#container1 .pagination li.active').live('click',function()
			{
				var page = $(this).attr('p');
				$("#hid_page").val(page);
				loadOrderData();						
			});
		}); 
		


	</script>
    <script type="text/javascript" src="./jquery/bootstrap-datetimepicker.js" charset="UTF-8"></script>
	<script type="text/javascript" src="./jquery/bootstrap-datetimepicker.fr.js" charset="UTF-8"></script>
    </body>
</html>

	

