<?php
include("include/routines.php");

checkuser();
chkRights(basename($_SERVER['PHP_SELF']));

// This is for dynamic title, bread crum, etc.
$title = "View Menus";
$path_parts   		= pathinfo(__FILE__);
$filename 	  		= $path_parts['filename'].".php";
$sql_feature 		= "select * from tbl_admin_features where af_page_url = '".$filename."'";
$result_feature 	= mysqli_query($db_con,$sql_feature) or die(mysqli_error($db_con));
$row_feature  		= mysqli_fetch_row($result_feature);
$feature_name 		= $row_feature[1];
$home_name    		= "Home";
$home_url 	  		= "view_menus.php?";
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
	        	<div class="container-fluid" id="div_view_menus">                
					<?php 
	                /* this function used to add navigation menu to the page*/ 
	                breadcrumbs($home_url,$home_name,'View Menus',$filename,$feature_name); 
	                /* this function used to add navigation menu to the page*/ 
	                ?>          
	                <div class="row-fluid">
	                    <div class="span12">
	                        <div class="box box-color box-bordered">
	                            <div class="box-title">
	                                <h3>
	                                    <i class="icon-table"></i>
	                                    <?php echo $feature_name; ?>
	                                </h3>
	                            </div> <!-- header title-->

	                            <div class="box-content nopadding">
		                            <?php
		                                $add = checkFunctionalityRight($filename,0);
		                                if($add)
		                                {
		                                    ?>
		                                    <div>
		                                    	<a href="add_menus.php?" class="btn-info" ><i class="icon-plus"></i>&nbsp;Add Menus</a>
		                                    </div>
		                                    <?php		
		                                }
		                            ?>
		                            <div style="padding:10px 15px 10px 15px !important">
		                                <input type="hidden" name="hid_page" id="hid_page" value="1">
		                                <input type="hidden" name="cat_parent" id="cat_parent" value="parent">
		                                <select name="rowlimit" id="rowlimit" onChange="loadData();"  class = "select2-me">
		                                    <option value="10" selected>10</option>
		                                    <option value="25">25</option>
		                                    <option value="50">50</option>
		                                    <option value="100">100</option>
		                                </select> entries per page
		                                <input type="text" class="input-medium" id = "srch" name="srch" placeholder="Search here..."  style="float:right;margin-right:10px;margin-top:10px;" >
		                            </div>
		                            <div id="req_resp"></div>
		                            <div class="profileGallery">
		                                <div style="width:99%;" align="center">
		                                    <div id="loading"></div>                                            
		                                    <div id="container1" class="data_container">
		                                        <div class="data"></div>
		                                    </div>
		                                </div>
		                            </div>
		                        </div>
	                        </div>
	                    </div>
	                </div>
	            </div>
			</div>
		</div>
	     
	    <?php getloder();?>
	    <script type="text/javascript">
			
			function multipleDelete()
			{			
				loading_show();		
				var batch = [];
				$(".batch:checked").each(function ()
				{
					batch.push(parseInt($(this).val()));
				});
				if (typeof batch.length == 0)
				{
					$("#model_body").html('<span style="style="color:#F00;">'+data.resp+'</span>');	
					$('#error_model').modal('toggle');	
					loading_hide();		
				}
				else
				{
					delete_menus 	= 1;
					var sendInfo 	= {"batch":batch, "delete_menus":delete_menus};
					var del_menus 	= JSON.stringify(sendInfo);								
					$.ajax({
						url: "load_menus.php?",
						type: "POST",
						data: del_menus,
						contentType: "application/json; charset=utf-8",						
						success: function(response) 
						{	
							data = JSON.parse(response);
							if(data.Success == "Success") 
							{						
								loadData();
								loading_hide();
							} 
							else
							{
								$("#model_body").html('<span style="style="color:#F00;">'+data.resp+'</span>');	
								$('#error_model').modal('toggle');													
								loading_hide();						
								$('#srch').val("");							
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
						}
				    });					
				}
			}
			
			function loadData()
			{
				loading_show();
				row_limit   = $.trim($('select[name="rowlimit"]').val());
				search_text = $.trim($('#srch').val());
				page        = $.trim($("#hid_page").val());
				
				load_menus    = "1";			
				if(row_limit == "" && page == "")
				{
					$("#model_body").html('<span style="style="color:#F00;">Can not Get Row Limit and Page number</span>');	
					$('#error_model').modal('toggle');	
					loading_hide();
				}
				else
				{
					var sendInfo 		= {"row_limit":row_limit, "search_text":search_text, "load_menus":load_menus, "page":page};
					var menus_load = JSON.stringify(sendInfo);				
					$.ajax({
						url: "load_menus.php?",
						type: "POST",
						data: menus_load,
						contentType: "application/json; charset=utf-8",						
						success: function(response) 
						{
							data = JSON.parse(response);
							if(data.Success == "Success") 
							{
								$("#container1").html(data.resp);
								loading_hide();
							} 
							else if(data.Success == "fail") 
							{
								$("#container1").html('<span style="style="color:#F00;">'+data.resp+'</span>');														
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
			
			function changeStatus(menu_id,curr_status)
			{
				loading_show();
				if(menu_id == "" && curr_status == "")
				{
					$("#model_body").html('<span style="style="color:#F00;">Menu id or Status to change not available</span>');
					$('#error_model').modal('toggle');		
					loading_hide();		
				}
				else
				{
					change_status 	= 1;
					var sendInfo 	= {"menu_id":menu_id, "curr_status":curr_status, "change_status":change_status};
					var menus_status 	= JSON.stringify(sendInfo);								
					$.ajax({
						url: "load_menus.php?",
						type: "POST",
						data: menus_status,
						contentType: "application/json; charset=utf-8",						
						success: function(response) 
						{			
							data = JSON.parse(response);
							if(data.Success == "Success") 
							{							
								loadData();
								// $("#model_body").html('<span style="style="color:#F00;">'+data.resp+'</span>');													
								// $('#error_model').modal('toggle');	
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
							//alert("complete");
	                	}
				    });						
				}
			}	
			
			function changesortorder(new_order,menu_id)
			{
				loading_show();			
				if(menu_id == "" && new_order == "")
				{
					$("#model_body").html('<span style="style="color:#F00;"> Menu id or Status to change not available</span>');
				}
				else
				{
					menu_id =parseInt(menu_id);
					if(menu_id=="")
					{
						menu_id=1;
					}
					change_sort_order 	= 1;
					var sendInfo 	= {"menu_id":menu_id, "new_order":new_order, "change_sort_order":change_sort_order};
					var menus_order 	= JSON.stringify(sendInfo);								
					$.ajax({
						url: "load_menus.php?",
						type: "POST",
						data: menus_order,
						contentType: "application/json; charset=utf-8",						
						success: function(response) 
						{			
							data = JSON.parse(response);
							if(data.Success == "Success") 
							{							
								loadData();
								loading_hide();
							} 
							else
							{
								loading_hide();													
								$("#model_body").html('<span style="style="color:#F00;">'+data.resp+'</span>');	
								$('#error_model').modal('toggle');																		
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
			
			$( document ).ready(function() {
				$('#srch').keypress(function(e) 
				{
					if(e.which == 13) 
					{	
						$("#hid_page").val("1");					
	       			   	loadData();	
					}
				});
				
				loadData();
				
				$('#container1 .pagination li.active').live('click',function()
				{
					var page = $(this).attr('p');
					$("#hid_page").val(page);
					loadData();						
				});
			});  
		</script>
	</body>
</html>