<?php
	include("include/routines.php");
	include("include/city_state_helper.php");


	if(isset($_REQUEST['id']) && $_REQUEST['id']!="")
	{
			$sql_get_data =" SELECT * FROM tbl_vendor WHERE vendor_id='".$_REQUEST['id']."' ";
			$res_get_data = mysqli_query($db_con,$sql_get_data) or die(mysqli_error($db_con));
			$vrow 		  = mysqli_fetch_array($res_get_data);
			$vendor_id    = $vrow['vendor_id'];

			$crow         = checkExist('tbl_customer',array('cust_vendorid'=>$vendor_id));
			$cust_id 	  = $crow['cust_id'];
		
	}

	if(isset($_GET['pag']))
	{
		$title 	= $_GET['pag'];
	}
	else
	{
		$title	= 'Update Vendor';	
	}


	$path_parts   		= pathinfo(__FILE__);
	$filename 	  		= $path_parts['filename'].".php";
	$sql_feature 		= "select * from tbl_admin_features where af_page_url = '".$filename."'";
	$result_feature 	= mysqli_query($db_con,$sql_feature) or die(mysqli_error($db_con));
	$row_feature  		= mysqli_fetch_row($result_feature);
	$feature_name 		= 'Update Vendor'; // $row_feature[1];
	$home_name    		= "Home";
	$home_url 	  		= "view_dashboard.php?pag=Dashboard";
	$utype				= $_SESSION['panel_user']['utype'];
	$tbl_users_owner 	= $_SESSION['panel_user']['tbl_users_owner'];
?>
<!DOCTYPE html>
<html>
	<head>
    <?php
        /* This function used to call all header data like css files and links */
        headerdata($feature_name);
        /* This function used to call all header data like css files and links */
    ?>
    <script type="text/javascript" src="js/add_product.js"></script>
    <link rel="stylesheet" href="css/plugins/datepicker/datepicker.css" />

    
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
            	<div class="container-fluid" id="div_view_spec">
					<?php
                    /* this function used to add navigation menu to the page*/
                    breadcrumbs($home_url,$home_name,'Add Products',$filename,$feature_name);
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
                                    <a  class="btn-info_1" href="view_vendors.php?pag=Vendors" style= "float:right;color:white" onClick="window.close()" >
                                    	<i class="icon-arrow-left"></i>&nbsp; Back
                                   	</a>
                                </div>
                                <div class="box-content nopadding">
                                
                                	<form id="frm_add_prod" class="form-horizontal form-bordered form-validate" enctype="multipart/form-data" >
                                         <input type="hidden"  value="1" name="add_product_req" id="add_product_req"> 
                                    	
                                    	<div class="control-group">
                                        	<label for="tasktitel" class="control-label">Name<sup class="validfield"><span style="color:#F00;font-size:20px;">*</span></sup></label>
                                            <div class="controls">
                                                	<input   type="text" placeholder="Name" id="vendor_name" name="vendor_name" class="input-xlarge" value="<?php echo @$vrow['vendor_name']; ?>" data-rule-required="true" />
                                            </div>
                                        </div><!--Category=====-->

                                        <div class="control-group span6">
                                        	<label for="tasktitel" class="control-label">Email <sup class="validfield"><span style="color:#F00;font-size:20px;">*</span></sup></label>
                                            <div class="controls">
                                                	<input   type="email" placeholder="Email" id="vendor_email" name="vendor_email" class="input-xlarge" value="<?php echo @$vrow['vendor_email']; ?>" data-rule-required="true" />
                                            </div>
                                        </div>	<!-- Product Name -->
                                    
                                       <div class="control-group span6">
                                        	<label for="tasktitel" class="control-label">Mobile<sup class="validfield"><span style="color:#F00;font-size:20px;">*</span></sup></label>
                                            <div class="controls">
                                                	<input   type="text" placeholder="Mobile Number" id="vendor_mobile" name="vendor_mobile" class="input-xlarge" value="<?php echo @$vrow['vendor_mobile']; ?>" data-rule-required="true" minlength="10" maxlength="10" onkeypress="return numsonly(event)" />
                                            </div>
                                        </div><!--Category=====-->
									</form>
                                </div>
                            </div><!--basic information-->


                            <div class="box box-color box-bordered">
                            	<div class="box-title">
                            		<h3>
                                        <i class="icon-table"></i>
                                        Company Information
                                    </h3>
                                    <i class="icon-chevron-down" id="chevron1" onclick="toggleMyDiv(this.id,'add_div');" style="cursor:pointer;float:right;font-size:20px;margin-right: 10px;"></i>
                                </div>
                                <div class="box-content nopadding" id="add_div" style="display: none">
                                	<?php
                            		 $comp_row  = checkExist('tbl_customer_company',array('comp_user_id'=>$cust_id));
                            		 
                            		 	
                            		 
                            		 ?>
                                	<form id="frm_comp_info" class="form-horizontal form-bordered form-validate" enctype="multipart/form-data" >
                                		<?php
                                		echo '<input type="hidden"  value="'.$cust_id.'" name="hid_userid" id="hid_userid">';
                            		 	$required  = '';
                                		?>
                                         <input type="hidden"  value="1" name="hid_frm_comp_info" id="hid_frm_comp_info"> 
                                    	
                                    	<div class="control-group">
                                        	<label for="tasktitel" class="control-label">Company Name<sup class="validfield"><span style="color:#F00;font-size:20px;">*</span></sup></label>
                                            <div class="controls">
                                                	<input   type="text" placeholder="Name" id="txt_comp_name" name="txt_comp_name" class="input-xlarge" value="<?php echo @$comp_row['comp_name']; ?>" data-rule-required="true" />
                                            </div>
                                        </div><!--Category=====-->

                                        <div class="control-group span6">
                                        	<label for="tasktitel" class="control-label">Primary Email <sup class="validfield"><span style="color:#F00;font-size:20px;">*</span></sup></label>
                                            <div class="controls">
                                                	<input   type="email" placeholder="Email" id="txt_pri_email" name="txt_pri_email" class="input-xlarge" value="<?php echo @$comp_row['comp_pri_email']; ?>" data-rule-required="true" />
                                            </div>
                                        </div>	<!--Primary Emaile -->
                                    
                                       <div class="control-group span6">
                                        	<label for="tasktitel" class="control-label">Secondary Email<sup class="validfield"><span style="color:#F00;font-size:20px;">*</span></sup></label>
                                            <div class="controls">
                                                	<input   type="email" placeholder="Secondary Email" id="txt_sec_email" name="txt_sec_email" class="input-xlarge" value="<?php echo @$comp_row['comp_sec_email']; ?>"  />
                                            </div>
                                        </div><!--Secondary Email=====-->

                                        <div class="control-group span6">
                                        	<label for="tasktitel" class="control-label">Primary Phone Number<sup class="validfield"><span style="color:#F00;font-size:20px;">*</span></sup></label>
                                            <div class="controls">
                                                	<input   type="text" placeholder="Primary Mobile" id="txt_pri_phone" name="txt_pri_phone" class="input-xlarge" value="<?php echo @$comp_row['comp_pri_phone']; ?>" data-rule-required="true" onkeypress="return numsonly(event)" />
                                            </div>
                                        </div>	<!--Primary Emaile -->
                                    
                                       <div class="control-group span6">
                                        	<label for="tasktitel" class="control-label">Alernate Mobile<sup class="validfield"><span style="color:#F00;font-size:20px;">*</span></sup></label>
                                            <div class="controls">
                                                	<input   type="text" placeholder="Alernate Mobile" id="txt_alt_phone" name="txt_alt_phone" class="input-xlarge" value="<?php echo @$comp_row['comp_sec_phone']; ?>"  onkeypress="return numsonly(event)" />
                                            </div>
                                        </div><!--Email=====-->

                                        <div class="control-group span6">
                                        	<label for="tasktitel" class="control-label">Website<sup class="validfield"><span style="color:#F00;font-size:20px;">*</span></sup></label>
                                            <div class="controls">
                                                	<input   type="text" placeholder="Website" id="txt_website" name="txt_website" class="input-xlarge" value="<?php echo @$comp_row['comp_website']; ?>"  />
                                            </div>
                                        </div>	<!--Primary Emaile -->
                                    
                                       <div class="control-group span6">
                                        	<label for="tasktitel" class="control-label">Shop & Estab. no.<sup class="validfield"><span style="color:#F00;font-size:20px;">*</span></sup></label>
                                            <div class="controls">
                                                	<input   type="text" placeholder="Shop & Establishment no." id="txt_establishment" name="txt_establishment" class="input-xlarge" value="<?php echo @$comp_row['comp_establishment']; ?>"  />
                                            </div>
                                        </div><!--Secondary Email=====-->


                                         <div class="control-group ">
                                        	<label for="tasktitel" class="control-label">Billing Address<sup class="validfield"><span style="color:#F00;font-size:20px;">*</span></sup></label>
                                            <div class="controls">
                                                	  <textarea class="" id="txt_billing_address" name="txt_billing_address" >
                                          			<?php echo @$comp_row['comp_bill_address']; ?>
                                     			 </textarea>
                                            </div>
                                        </div><!--Secondary Email=====-->

                                         <div class="control-group ">
                                        	<label for="tasktitel" class="control-label">Shipping Address<sup class="validfield"><span style="color:#F00;font-size:20px;">*</span></sup></label>
                                            <div class="controls">
                                                	 <textarea class="" id="txt_shipping_address" name="txt_shipping_address" data-rule-required="true">
                                          			<?php echo @$comp_row['comp_ship_address']; ?>
                                      					</textarea>
                                            </div>
                                        </div><!--Secondary Email=====-->


                                        <div class="control-group span6">
                                        	<label for="tasktitel" class="control-label">Billing State<sup class="validfield"><span style="color:#F00;font-size:20px;">*</span></sup></label>
                                            <div class="controls">
                                            	<br>
												<select class="col-md-6 col-xs-12 select2-me input-xlarge selectpicker" data-live-search="true" name="txt_bill_state" id="txt_bill_state" onChange="getCities(this.value, this.id, 'txt_bill_city');" data-rule-required="true">
                                                <?php

                                                $comp_bill_state =@$comp_row['comp_bill_state'];
                                                $comp_bill_city  =@$comp_row['comp_bill_city'];
                                                $comp_ship_state =@$comp_row['comp_ship_state'];
                                                $comp_ship_city  =@$comp_row['comp_ship_city'];
                                                // =======================================================
                                                // start : query for getting the all active states only
                                                // dn by prathamesh on 04092017
                                                // =======================================================
                                                // send city id from session if state id is already exist in the database
                                                echo getActiveStates($comp_bill_state);
                                                // =======================================================
                                                // end : query for getting the all active state only
                                                // dn by prathamesh on 04092017
                                                // =======================================================
                                                ?>
                                              </select>
                                            </div>
                                        </div>	<!--Primary Emaile -->
                                    
                                       <div class="control-group span6">
                                        	<label for="tasktitel" class="control-label">Shipping State<sup class="validfield"><span style="color:#F00;font-size:20px;">*</span></sup></label>
                                            <div class="controls">

                                        	    <input id="address_check" name="address_check" onclick="same_as_bill();" class="css-checkbox" value="CHK" type="checkbox" /> same as billing<br>

                                            	<select class="col-md-6 col-xs-12 select2-me selectpicker input-xlarge" data-live-search="true" name="txt_shipping_state" id="txt_shipping_state" data-rule-required="true">
                                                <?php
                                                // =======================================================
                                                // start : query for getting the all active cities only
                                                // dn by prathamesh on 04092017
                                                // =======================================================
                                                // send city id from session if city id is already exist in the database
                                                echo getActiveStates($comp_ship_state);
                                                // =======================================================
                                                // end : query for getting the all active cities only
                                                // dn by prathamesh on 04092017
                                                // =======================================================
                                                ?>
                                              </select>
                                            </div>
                                        </div><!--Secondary Email=====-->

                                        <div class="control-group span6">
                                        	<label for="tasktitel" class="control-label">Billing City<sup class="validfield"><span style="color:#F00;font-size:20px;">*</span></sup></label>
                                            <div class="controls">
                                                <select class="col-md-6 col-xs-12 select2-me selectpicker input-xlarge" data-live-search="true" name="txt_bill_city" id="txt_bill_city" data-rule-required="true">
                                                <?php
                                                // =======================================================
                                                // start : query for getting the all active cities only
                                                // dn by prathamesh on 04092017
                                                // =======================================================
                                                // send city id from session if city id is already exist in the database
                                                echo getActiveCities($comp_bill_city);
                                                // =======================================================
                                                // end : query for getting the all active cities only
                                                // dn by prathamesh on 04092017
                                                // =======================================================
                                                ?>
                                              </select>
                                            </div>
                                        </div>	<!--Primary Emaile -->
                                    
                                       <div class="control-group span6">
                                        	<label for="tasktitel" class="control-label">Shipping City<sup class="validfield"><span style="color:#F00;font-size:20px;">*</span></sup></label>
                                            <div class="controls">
                                                <select class="col-md-6 col-xs-12 select2-me input-xlarge selectpicker" data-live-search="true" name="txt_ship_city" id="txt_ship_city" data-rule-required="true">
                                                <?php
                                                // =======================================================
                                                // start : query for getting the all active cities only
                                                // dn by prathamesh on 04092017
                                                // =======================================================
                                                // send city id from session if city id is already exist in the database
                                                echo getActiveCities($comp_ship_city);
                                                // =======================================================
                                                // end : query for getting the all active cities only
                                                // dn by prathamesh on 04092017
                                                // =======================================================
                                                ?>
                                              </select>
                                            </div>
                                        </div><!--Secondary Email=====-->

                                        <div class="control-group span6">
                                        	<label for="tasktitel" class="control-label">Billing Pincode<sup class="validfield"><span style="color:#F00;font-size:20px;">*</span></sup></label>
                                            <div class="controls">
                                                	<input   type="text" placeholder="Billing Pincode" id="txt_bill_pincode" name="txt_bill_pincode" class="input-xlarge" value="<?php echo @$comp_row['comp_bill_pincode']; ?>" minlength="6" maxlength="6" />
                                            </div>
                                        </div>	<!--Primary Emaile -->
                                    
                                       <div class="control-group span6">
                                        	<label for="tasktitel" class="control-label">Shipping Pincode<sup class="validfield"><span style="color:#F00;font-size:20px;">*</span></sup></label>
                                            <div class="controls">
                                                	<input   type="text" placeholder="Shipping Pincode" id="txt_ship_pincode" name="txt_ship_pincode" class="input-xlarge"
                                                	 value="<?php echo @$comp_row['comp_ship_pincode']; ?>"  minlength="6" maxlength="6"/>
                                            </div>
                                        </div><!--Secondary Email=====-->

                                        <div class="control-group " style="clear: both">
                                        	<label for="tasktitel" class="control-label">Time for Pickup<sup class="validfield"><span style="color:#F00;font-size:20px;">*</span></sup></label>
                                            <div class="controls">
                                                	<input   type="text" placeholder="Time for Pickup" id="txt_pickuptime" name="txt_pickuptime" class="input-xlarge" value="<?php echo @$comp_row['comp_pickuptime']; ?>"  />
                                            </div>
                                        </div>	<!--Primary Emaile -->
                                    
                                       <div class="control-group ">
                                        	<label for="tasktitel" class="control-label">Time Descripion<sup class="validfield"><span style="color:#F00;font-size:20px;">*</span></sup></label>
                                            <div class="controls">
                                                	  <textarea class="" id="txt_timedescription" name="txt_timedescription" >
                                          <?php echo @$comp_row['comp_timedesc']; ?>
                                      </textarea>
                                            </div>
                                        </div><!--Secondary Email=====-->

                                         <div class="control-group ">
                                        	<label for="tasktitel" class="control-label">Description<sup class="validfield"><span style="color:#F00;font-size:20px;">*</span></sup></label>
                                            <div class="controls">
                                                	 <textarea class="" id="txt_description" name="txt_description" data-rule-required="true">
                                          <?php echo @$comp_row['comp_descp']; ?>
                                      </textarea>
                                            </div>
                                        </div><!--Secondary Email=====-->

                                        <div class="form-actions" style="clear:both">
                                           <button type="submit" name="reg_submit_add" class="btn-success">Update</button>
                                        </div>


									</form>
                                </div>
                            </div><!--Company information-->

                            <div class="box box-color box-bordered">
                            	<div class="box-title">
                            		<h3>
                                        <i class="icon-table"></i>
                                        License Information
                                    </h3>
                                    <i class="icon-chevron-down" id="chevronn" onclick="toggleMyDiv(this.id,'lic_div');" style="cursor:pointer;float:right;font-size:20px;margin-right: 10px;"></i>
                                </div>
                                <div class="box-content nopadding" id="lic_div" style="display: none">
                                
                                	<form id="frm_lic_info" class="form-horizontal form-bordered form-validate" enctype="multipart/form-data" >
                                         <?php
									  //  Check Record and return single row
										  $licRow = checkExist('tbl_customer_licenses',array('lic_custid'=>$cust_id));
										  if(!$licRow) // for add and update in single form 
										  {
											  $frm_lic_request   = 'add_chemist_lic_req';
											  $required          = 'data-rule-required="true"';
										  }
										  else
										  {
											  $frm_lic_request   = 'update_chemist_lic_req';
											  $required          = '';
										  }
										  ?>
                                		 
                                         <input type="hidden"  value="<?php echo $cust_id; ?>" name="hid_userid" id="hid_userid">
                                    	<?php
										   $lic20BRow = checkExist('tbl_customer_licenses',array('lic_custid'=>$cust_id,"lic_type"=>"20B"));
										 ?>
                                    	<div class="control-group ">
                                        	<label for="tasktitel" class="control-label">20B Drug License Number<sup class="validfield"><span style="color:#F00;font-size:20px;">*</span></sup></label>
                                            <div class="controls">
                                                	<input   type="text" placeholder="20B Drug License Number" id="txt_20b_lic_no" name="txt_20b_lic_no" class="input-xlarge" value="<?php echo @$lic20BRow['lic_number']; ?>"   />
                                            </div>
                                        </div><!--20B Number=====-->

                                        <div class="control-group">
                                        	<label for="tasktitel" class="control-label">20B Drug license Image<sup class="validfield"><span style="color:#F00;font-size:20px;">*</span></sup></label>
                                            <div class="controls">
                                                    <?php
                                                    if(isset($lic20BRow['lic_document']) && $lic20BRow['lic_document']!="")
                                                    {
                                                        $ext  =  explode('.',$lic20BRow['lic_document']);
                                                        if($ext[sizeof($ext)-1]=='pdf')
                                                        {

                                                         echo '<br> <a href="documents/licenses/'.@$lic20BRow['lic_document'].'" >'.$lic20BRow['lic_document'].'</a>';
                                                        }else
                                                        {
                                                            echo '<br> <img width="100" id="lic20BRow" onclick="showImg(this.id)"  height="200" src="documents/licenses/'.@$lic20BRow['lic_document'].'" />';
                                                        }
                                                    }
                                                    ?><br>
                                            	    <input   type="file" id="file_lic_20b_image " name="file_lic_20b_image" class="input-xlarge" accept="image/jpg,image/jpeg,image/png,application/pdf"  />
                                            </div>
                                        </div>	<!--20B Image-->
                                    
                                        <div class="control-group">
                                        	<label for="tasktitel" class="control-label">20B Drug license Expiry Date<sup class="validfield"><span style="color:#F00;font-size:20px;">*</span></sup></label>
                                            <div class="controls">
                                                	<input   type="text" placeholder="20B Drug license Expiry Date" id="lic_20Bexpiry_date" name="lic_20Bexpiry_date" class="input-xlarge datepicker" value="<?php echo @$lic20BRow['lic_exipiry_date']; ?>"  />
                                            </div>
                                        </div><!--20B Date=====-->
                                        <?php
										   $lic21BRow = checkExist('tbl_customer_licenses',array('lic_custid'=>$cust_id,"lic_type"=>"21B"));
										   ?>
                                        <div class="control-group ">
                                        	<label for="tasktitel" class="control-label">21B Drug License Number<sup class="validfield"><span style="color:#F00;font-size:20px;">*</span></sup></label>
                                            <div class="controls">
                                                	<input   type="text" placeholder="21B Drug License Number" id="txt_21b_lic_no" name="txt_21b_lic_no" class="input-xlarge" value="<?php echo @$lic21BRow['lic_number']; ?>"  />
                                            </div>
                                        </div><!--21B Number=====-->

                                        <div class="control-group">
                                        	<label for="tasktitel" class="control-label">21B Drug license Image<sup class="validfield"><span style="color:#F00;font-size:20px;">*</span></sup></label>
                                            <div class="controls">
                                            		<?php
                                                    if(isset($lic21BRow['lic_document']) && $lic21BRow['lic_document']!="")
                                                    {
                                                        $ext  =  explode('.',$lic21BRow['lic_document']);
                                                        if($ext[sizeof($ext)-1]=='pdf')
                                                        {

                                                         echo '<br> <a href="documents/licenses/'.@$lic21BRow['lic_document'].'" >'.$lic21BRow['lic_document'].'</a>';
                                                        }else
                                                        {
                                                            echo '<br> <img width="100" id="lic20bimg" onclick="showImg(this.id)"  height="200" src="documents/licenses/'.@$lic21BRow['lic_document'].'" />';
                                                        }

                                                        echo '<br>';
                                                    }
                                                    ?>
                                                	<input   type="file" id="file_lic_21b_image " name="file_lic_21b_image" class="input-xlarge" accept="image/jpg,image/jpeg,image/png,application/pdf"  />
                                            </div>
                                        </div>	<!--21B Image-->
                                    
                                        <div class="control-group">
                                        	<label for="tasktitel" class="control-label">21B Drug license Expiry Date<sup class="validfield"><span style="color:#F00;font-size:20px;">*</span></sup></label>
                                            <div class="controls">
                                                	<input   type="text" placeholder="21B Drug license Expiry Date" id="lic_21Bexpiry_date" name="lic_21Bexpiry_date" class="input-xlarge datepicker" value="<?php echo @$lic21BRow['lic_exipiry_date']; ?>"  />
                                            </div>
                                        </div><!--21B Date=====-->
                                        <?php
									    $lic20CRow = checkExist('tbl_customer_licenses',array('lic_custid'=>$logged_uid,"lic_type"=>"20C"));
									    $result    = getRecord('tbl_customer_licenses',array('lic_custid'=>$logged_uid,'lic_type'=>'20C'));
									    $lic20Num  = isExist('tbl_customer_licenses',array('lic_custid'=>$logged_uid,'lic_type'=>'20C'));
									   
									    if(!$lic20CRow)
									    {
									    ?>
	                                        <div class="control-group ">
	                                        	<label for="tasktitel" class="control-label">21C Drug License Number<sup class="validfield"><span style="color:#F00;font-size:20px;">*</span></sup></label>
	                                            <div class="controls">
	                                                	<input   type="text" placeholder="21C Drug License Number" id="txt_21c_lic_no" name="txt_21c_lic_no" class="input-xlarge" value="<?php echo @$vrow['pan_no']; ?>" />
	                                            </div>
	                                        </div><!--21C Number=====-->

	                                        <div class="control-group">
	                                        	<label for="tasktitel" class="control-label">21C Drug license Image<sup class="validfield"><span style="color:#F00;font-size:20px;">*</span></sup></label>
	                                            <div class="controls">
	                                                	<input   type="file" id="file_lic_21c_image " name="file_lic_21c_image" class="input-xlarge" accept="image/jpg,image/jpeg,image/png,application/pdf"  />
	                                            </div>
	                                        </div>	<!--21C Image-->
	                                    
	                                        <div class="control-group">
	                                        	<label for="tasktitel" class="control-label">21C Drug license Expiry Date<sup class="validfield"><span style="color:#F00;font-size:20px;">*</span></sup></label>
	                                            <div class="controls">
	                                                	<input   type="text" placeholder="Expiry Date" id="lic_21Cexpiry_date" name="lic_21Cexpiry_date" class="input-xlarge datepicker" value="<?php echo @$vrow['comp_establishment']; ?>"  />
	                                            </div>
	                                        </div><!--21C Date=====-->
                                        <?php
                                        }else
                                        {
                                        	while($row  = mysqli_fetch_array($result))
											{?>
												<input type="hidden" value="<?php echo $row['license_id']; ?>"  name="lic_id[]">
												<div class="control-group ">
	                                        	<label for="tasktitel" class="control-label">21C Drug License Number<sup class="validfield"><span style="color:#F00;font-size:20px;">*</span></sup></label>
	                                            <div class="controls">
	                                                	<input   type="text" placeholder="21C Drug License Number" id="txt_21c_lic_no" name="txt_21c_lic_no" class="input-xlarge" value="<?php echo @$row['lic_number']; ?>" />
	                                            </div>
		                                        </div><!--21C Number=====-->

		                                        <div class="control-group">
		                                        	<label for="tasktitel" class="control-label">21C Drug license Image<sup class="validfield"><span style="color:#F00;font-size:20px;">*</span></sup></label>
		                                            <div class="controls">
		                                            	     <?php 
		                                            		 if($lic20CRow)
															 {
															 ?>
						                                    
						                                       <img style="width:200px;height:100px" src="documents/licenses/<?php echo @$row['lic_document']; ?>" >
						                                      
						                                    <?php 
															 }
															 ?>
		                                                	<input   type="file" id="file_lic_21c_image " name="file_lic_21c_image" class="input-xlarge" accept="image/jpg,image/jpeg,image/png,application/pdf"  />
		                                            </div>
		                                        </div>	<!--21C Image-->
		                                    
		                                        <div class="control-group">
		                                        	<label for="tasktitel" class="control-label">21C Drug license Expiry Date<sup class="validfield"><span style="color:#F00;font-size:20px;">*</span></sup></label>
		                                            <div class="controls">
		                                                	<input   type="text" placeholder="Expiry Date" id="lic_21Cexpiry_date" name="lic_21Cexpiry_date" class="input-xlarge datepicker" value="<?php echo @$row['lic_exipiry_date']; ?>"  />
		                                            </div>
		                                        </div><!--21C Date=====-->

											<?php
										    }
                                        }
                                        ?>
                                        <div class="form-actions" style="clear:both">
                                           <button type="submit" name="reg_submit_add" class="btn-success">Update</button>
                                        </div>
									</form>
                                </div>
                            </div><!--License information-->

                            <div class="box box-color box-bordered">
                            	<div class="box-title">
                            		<h3>
                                        <i class="icon-table"></i>
                                        Pan Information
                                    </h3>
                                    <i class="icon-chevron-down" id="chevron2" onclick="toggleMyDiv(this.id,'pan_div');" style="cursor:pointer;float:right;font-size:20px;margin-right: 10px;"></i>
                                </div>
                                <div class="box-content nopadding" id="pan_div" style="display: none">
                                
                                	<form id="frm_pan_info" class="form-horizontal form-bordered form-validate" enctype="multipart/form-data" >
                                         <?php
                                		 $pan_row  = checkExist('tbl_customer_pan',array('pan_userid'=>$cust_id));
                                		 if($pan_row)
                                		 {
                                		 	echo '<input type="hidden"  value="1" name="update_pan_req" id="update_pan_req">';
                                		 	$required  = '';
                                		 }
                                		 else
                                		 {
                                		 	echo '<input type="hidden"  value="1" name="add_pan_req" id="add_pan_req">';
                                		 	$required  = 'required';
                                		 }
                                		 ?>
                                         <input type="hidden"  value="<?php echo $cust_id; ?>" name="hid_userid" id="hid_userid"> 
                                    	
                                    	<div class="control-group">
                                        	<label for="tasktitel" class="control-label">Pan Number<sup class="validfield"><span style="color:#F00;font-size:20px;">*</span></sup></label>
                                            <div class="controls">
                                                	<input   type="text" placeholder="Pan Number" id="pan_no" name="pan_no" class="input-xlarge" value="<?php echo @$pan_row['pan_no']; ?>" data-rule-required="true" minlength="10" maxlength="10" />
                                            </div>
                                        </div><!--Category=====-->

                                        <div class="control-group ">
                                        	<label for="tasktitel" class="control-label">Image<sup class="validfield"><span style="color:#F00;font-size:20px;">*</span></sup></label>
                                            <div class="controls">
                                                	<input   type="file" id="file_pan_image " name="file_pan_image" class="input-xlarge" accept="image/jpg,image/jpeg,image/png,application/pdf"  <?php echo $required; ?> />
                                                	
                                                    <?php
                                                    if(isset($pan_row['pan_image']) && $pan_row['pan_image']!="")
                                                    {
                                                        $ext  =  explode('.',$pan_row['pan_image']);
                                                        if($ext[sizeof($ext)-1]=='pdf')
                                                        {

                                                         echo '<br> <a href="documents/pan/'.@$pan_row['pan_image'].'" >'.$pan_row['pan_image'].'</a>';
                                                        }else
                                                        {
                                                            echo '<br> <img width="100" id="panimg" onclick="showImg(this.id)"  height="200" src="documents/pan/'.@$pan_row['pan_image'].'" />';
                                                        }
                                                    }
                                                    ?>
                                            </div>
                                        </div>	<!--pan Image -->

                                        <div class="form-actions" style="clear:both">
                                           <button type="submit" name="reg_submit_add" class="btn-success">Update</button>
                                        </div>
									</form>
                                </div>
                            </div><!--pan information-->

                            <div class="box box-color box-bordered">
                            	<div class="box-title">
                            		<h3>
                                        <i class="icon-table"></i>
                                        Tan Information
                                    </h3>
                                    <i class="icon-chevron-down" id="chevron3" onclick="toggleMyDiv(this.id,'tan_div');" style="cursor:pointer;float:right;font-size:20px;margin-right: 10px;"></i>
                                </div>
                                <div class="box-content nopadding" id="tan_div" style="display: none">
                                
                                	<form id="frm_tan_info" class="form-horizontal form-bordered form-validate" enctype="multipart/form-data" >
                                		<?php
                                		 $tan_row  = checkExist('tbl_customer_tan',array('tan_userid'=>$cust_id));
                                		 if($tan_row)
                                		 {
                                		 	echo '<input type="hidden"  value="1" name="update_tan_req" id="update_tan_req">';
                                		 	$required  = '';
                                		 }
                                		 else
                                		 {
                                		 	echo '<input type="hidden"  value="1" name="add_tan_req" id="add_tan_req">';
                                		 	$required  = 'required';
                                		 }
                                		 ?>
                                         <input type="hidden"  value="<?php echo $cust_id; ?>" name="hid_userid" id="hid_userid"> 
                                    	
                                    	<div class="control-group">
                                        	<label for="tasktitel" class="control-label">Tan Number<sup class="validfield"><span style="color:#F00;font-size:20px;">*</span></sup></label>
                                            <div class="controls">
                                                	<input   type="text" placeholder="Tan Number" id="tan_no" name="tan_no" class="input-xlarge" value="<?php echo @$tan_row['tan_no']; ?>" data-rule-required="true" />
                                            </div>
                                        </div><!--Category=====-->

                                        <div class="control-group ">
                                        	<label for="tasktitel" class="control-label">Image<sup class="validfield"><span style="color:#F00;font-size:20px;">*</span></sup></label>
                                            <div class="controls">
                                                	<input   type="file" id="file_tan_image " name="file_tan_image" class="input-xlarge" accept="image/jpg,image/jpeg,image/png,application/pdf"  <?php echo $required; ?> />
                                                	
                                                    <?php
                                                    if(isset($tan_row['tan_image']) && $tan_row['tan_image']!="")
                                                    {
                                                        $ext  =  explode('.',$tan_row['tan_image']);
                                                        if($ext[sizeof($ext)-1]=='pdf')
                                                        {

                                                         echo '<br> <a href="documents/tan/'.@$tan_row['tan_image'].'" >'.$tan_row['pan_image'].'</a>';
                                                        }else
                                                        {
                                                            echo '<br> <img width="100" id="tanimg" onclick="showImg(this.id)"  height="200" src="documents/tan/'.@$tan_row['tan_image'].'" />';
                                                        }
                                                    }
                                                    ?>
                                            </div>
                                        </div>	<!--Tan Image -->

                                        <div class="form-actions" style="clear:both">
                                           <button type="submit" name="reg_submit_add" class="btn-success">Update</button>
                                        </div>
                                    </form>
                                </div>
                            </div><!--tan information-->

                            <div class="box box-color box-bordered">
                            	<div class="box-title">
                            		<h3>
                                        <i class="icon-table"></i>
                                        GST Information
                                    </h3>
                                    <i class="icon-chevron-down" id="chevron4" onclick="toggleMyDiv(this.id,'gst_div');" style="cursor:pointer;float:right;font-size:20px;margin-right: 10px;"></i>
                                </div>
                                <div class="box-content nopadding" id="gst_div" style="display: none">
                                
                                	<form id="frm_gst_info" class="form-horizontal form-bordered form-validate" enctype="multipart/form-data" >
                                		 <?php
                                		 $gst_row  = checkExist('tbl_customer_gst',array('gst_userid'=>$cust_id));
                                		 if($gst_row)
                                		 {
                                		 	echo '<input type="hidden"  value="1" name="update_gst_req" id="update_gst_req">';
                                		 	$required  = '';
                                		 }
                                		 else
                                		 {
                                		 	echo '<input type="hidden"  value="1" name="add_gst_req" id="add_gst_req">';
                                		 	$required  = 'required';
                                		 }
                                		 ?>


                                         <input type="hidden"  value="<?php echo $cust_id; ?>" name="hid_userid" id="hid_userid"> 
                                    	
                                    	<div class="control-group">
                                        	<label for="tasktitel" class="control-label">GST Number<sup class="validfield"><span style="color:#F00;font-size:20px;">*</span></sup></label>
                                            <div class="controls">
                                                	<input   type="text" placeholder="GST Number" id="gst_no" name="gst_no" class="input-xlarge" value="<?php echo @$gst_row['gst_no']; ?>" data-rule-required="true" />
                                            </div>
                                        </div><!--Category=====-->

                                        <div class="control-group">
                                        	<label for="tasktitel" class="control-label">Image<sup class="validfield"><span style="color:#F00;font-size:20px;">*</span></sup></label>
                                            <div class="controls">
                                                	<input   type="file" id="file_gst_image " name="file_gst_image" class="input-xlarge" accept="image/jpg,image/jpeg,image/png,application/pdf"  <?php echo $required; ?>/>
                                                	
                                                    <?php
                                                    if(isset($gst_row['gst_image']) && $gst_row['gst_image']!="")
                                                    {
                                                        $ext  =  explode('.',$gst_row['gst_image']);
                                                        if($ext[sizeof($ext)-1]=='pdf')
                                                        {

                                                         echo '<br> <a href="documents/gst/'.@$gst_row['gst_image'].'" >'.$gst_row['gst_image'].'</a>';
                                                        }else
                                                        {
                                                            echo '<br> <img width="100" id="gstimg" onclick="showImg(this.id)"  height="200" src="documents/gst/'.@$gst_row['gst_image'].'" />';
                                                        }
                                                    }
                                                    ?>
                                            </div>
                                        </div>	<!--Primary Emaile -->
                                    
                                        <div class="control-group">
                                        	<label for="tasktitel" class="control-label">Acknowledgement Quarter 1 Image<sup class="validfield"><span style="color:#F00;font-size:20px;">*</span></sup></label>
                                            <div class="controls">
                                                	<input   type="file" id="file_gst_ack_image " name="file_gst_ack_image" class="input-xlarge" accept="image/jpg,image/jpeg,image/png,application/pdf"  <?php echo $required; ?>/>
                                                	
                                                    <?php
                                                    if(isset($gst_row['gst_ack_image']) && $gst_row['gst_ack_image']!="")
                                                    {
                                                        $ext  =  explode('.',$gst_row['gst_ack_image']);
                                                        if($ext[sizeof($ext)-1]=='pdf')
                                                        {

                                                         echo '<br> <a href="documents/gst/'.@$gst_row['gst_ack_image'].'" >'.$gst_row['gst_ack_image'].'</a>';
                                                        }else
                                                        {
                                                            echo '<br> <img width="100" id="gst_ack_image" onclick="showImg(this.id)"  height="200" src="documents/gst/'.@$gst_row['gst_ack_image'].'" />';
                                                        }
                                                    }
                                                    ?>
                                            </div>
                                        </div>	<!--Primary Emaile -->

                                        <div class="control-group">
                                        	<label for="tasktitel" class="control-label">Acknowledgement Quarter 2 Image<sup class="validfield"><span style="color:#F00;font-size:20px;">*</span></sup></label>
                                            <div class="controls">
                                                	<input   type="file" id="file_gst_ack_image2" name="file_gst_ack_image2" class="input-xlarge" accept="image/jpg,image/jpeg,image/png,application/pdf"  <?php echo $required; ?>/>
                                                	
                                                    <?php
                                                    if(isset($gst_row['gst_ack_image2']) && $gst_row['gst_ack_image2']!="")
                                                    {
                                                        $ext  =  explode('.',$gst_row['gst_ack_image2']);
                                                        if($ext[sizeof($ext)-1]=='pdf')
                                                        {

                                                         echo '<br> <a href="documents/gst/'.@$gst_row['gst_ack_image2'].'" >'.$gst_row['gst_ack_image2'].'</a>';
                                                        }else
                                                        {
                                                            echo '<br> <img width="100" id="gst_ack_image2" onclick="showImg(this.id)"  height="200" src="documents/gst/'.@$gst_row['gst_ack_image2'].'" />';
                                                        }
                                                    }
                                                    ?>
                                            </div>
                                        </div>	<!--Primary Emaile -->

                                        <div class="control-group">
                                        	<label for="tasktitel" class="control-label">Acknowledgement Quarter 3 Image<sup class="validfield"><span style="color:#F00;font-size:20px;">*</span></sup></label>
                                            <div class="controls">
                                                	<input   type="file" id="file_gst_ack_image3 " name="file_gst_ack_image3" class="input-xlarge" accept="image/jpg,image/jpeg,image/png,application/pdf" <?php echo $required; ?> />
                                                    <?php
                                                    if(isset($gst_row['gst_ack_image3']) && $gst_row['gst_ack_image3']!="")
                                                    {
                                                        $ext  =  explode('.',$gst_row['gst_ack_image3']);
                                                        if($ext[sizeof($ext)-1]=='pdf')
                                                        {

                                                         echo '<br> <a href="documents/gst/'.@$gst_row['gst_ack_image3'].'" >'.$gst_row['gst_ack_image3'].'</a>';
                                                        }else
                                                        {
                                                            echo '<br> <img width="100" id="gst_ack_image3" onclick="showImg(this.id)"  height="200" src="documents/gst/'.@$gst_row['gst_ack_image3'].'" />';
                                                        }
                                                    }
                                                    ?>
                                            </div>
                                        </div>	<!--Primary Emaile -->

                                        <div class="control-group">
                                        	<label for="tasktitel" class="control-label">Acknowledgement Quarter 4 Image<sup class="validfield"><span style="color:#F00;font-size:20px;">*</span></sup></label>
                                            <div class="controls">
                                                	<input   type="file" id="file_gst_ack_image4" name="file_gst_ack_image4" class="input-xlarge" accept="image/jpg,image/jpeg,image/png,application/pdf"  <?php echo $required; ?>/>
                                                    <?php
                                                    if(isset($gst_row['gst_ack_image4']) && $gst_row['gst_ack_image4']!="")
                                                    {
                                                        $ext  =  explode('.',$gst_row['gst_ack_image3']);
                                                        if($ext[sizeof($ext)-1]=='pdf')
                                                        {

                                                         echo '<br> <a href="documents/gst/'.@$gst_row['gst_ack_image4'].'" >'.$gst_row['gst_ack_image4'].'</a>';
                                                        }else
                                                        {
                                                            echo '<br> <img width="100" id="gst_ack_image4" onclick="showImg(this.id)"  height="200" src="documents/gst/'.@$gst_row['gst_ack_image4'].'" />';
                                                        }
                                                    }
                                                    ?>
                                            </div>
                                        </div>	<!--Primary Emaile -->

                                        <div class="form-actions" style="clear:both">
                                           <button type="submit" name="reg_submit_add" class="btn-success">Update</button>
                                        </div>

									</form>
                                </div>
                            </div><!--GST information-->

                            <div class="box box-color box-bordered">
                            	<div class="box-title">
                            		<h3>
                                        <i class="icon-table"></i>
                                        Bank Information
                                    </h3>
                                    <i class="icon-chevron-down" id="chevron5" onclick="toggleMyDiv(this.id,'bank_div');" style="cursor:pointer;float:right;font-size:20px;margin-right: 10px;"></i>
                                </div>
                                <div class="box-content nopadding" id="bank_div" style="display: none">
                                
                                	<form id="frm_bank_info" class="form-horizontal form-bordered form-validate" enctype="multipart/form-data" >
                                		 <?php
                                		 $bank_row  = checkExist('tbl_customer_bank_details',array('bank_userid'=>$cust_id));
                                		 if($bank_row)
                                		 {
                                		 	echo '<input type="hidden"  value="1" name="update_bank_req" id="update_bank_req">';
                                            $required = '';
                                		 }
                                		 else
                                		 {
                                		 	echo '<input type="hidden"  value="1" name="add_bank_req" id="add_bank_req">';
                                             $required = ' required ';
                                		 }
                                		 ?>

                                          
                                    	 <input type="hidden"  value="<?php echo $cust_id; ?>" name="hid_userid" id="hid_userid">
                                    	<div class="control-group span6">
                                        	<label for="tasktitel" class="control-label">Company Name<sup class="validfield"><span style="color:#F00;font-size:20px;">*</span></sup></label>
                                            <div class="controls">
                                                	<input   type="text" placeholder="Company Name" id="bank_username" name="bank_username" class="input-xlarge" value="<?php echo @$bank_row['bank_username']; ?>" data-rule-required="true" />
                                            </div>
                                        </div><!--Category=====-->

                                        <div class="control-group span6">
                                        	<label for="tasktitel" class="control-label">Bank Name<sup class="validfield"><span style="color:#F00;font-size:20px;">*</span></sup></label>
                                            <div class="controls">
                                                	<input   type="text" placeholder="Bank Name" id="bank_name" name="bank_name" class="input-xlarge" value="<?php echo @$bank_row['bank_name']; ?>" data-rule-required="true" />
                                            </div>
                                        </div>	<!--Primary Emaile -->
                                    
                                        <div class="control-group span6">
                                        	<label for="tasktitel" class="control-label">IFSC Code<sup class="validfield"><span style="color:#F00;font-size:20px;">*</span></sup></label>
                                            <div class="controls">
                                                	<input   type="text" placeholder="IFSC Code" id="bank_ifsc" name="bank_ifsc" class="input-xlarge" value="<?php echo @$bank_row['bank_ifsc']; ?>" minlength="11" maxlength="11" data-rule-required="true" />
                                            </div>
                                        </div><!--Category=====-->

                                        <div class="control-group span6">
                                        	<label for="tasktitel" class="control-label">Account Number<sup class="validfield"><span style="color:#F00;font-size:20px;">*</span></sup></label>
                                            <div class="controls">
                                                	<input   type="text" placeholder="Account Number" id="bank_acc_no" name="bank_acc_no" class="input-xlarge" value="<?php echo @$bank_row['bank_acc_no']; ?>" data-rule-required="true" />
                                            </div>
                                        </div>	<!--Primary Emaile -->

                                        <div class="control-group" style="clear: both">
                                        	<label for="tasktitel" class="control-label">Bank Address<sup class="validfield"><span style="color:#F00;font-size:20px;">*</span></sup></label>
                                            <div class="controls">
                                                	<textarea    id="bank_branch " name="bank_branch" class="input-xlarge"><?php echo @$bank_row['bank_branch']; ?></textarea>
                                            </div>
                                        </div>	<!--Primary Emaile -->

                                        <div class="control-group">
                                        	<label for="tasktitel" class="control-label">Check Image<sup class="validfield"><span style="color:#F00;font-size:20px;">*</span></sup></label>
                                            <div class="controls">
                                                	<input   type="file" id="file_bank_image " name="file_bank_image" class="input-xlarge" accept="image/jpg,image/jpeg,image/png,application/pdf"   <?php echo $required;  ?>/>

                                                    <?php
                                                    if(isset($bank_row['bank_image']) && $bank_row['bank_image']!="")
                                                    {
                                                        $ext  =  explode('.',$bank_row['bank_image']);
                                                        if($ext[sizeof($ext)-1]=='pdf')
                                                        {

                                                         echo '<br> <a href="documents/banks/'.@$bank_row['bank_image'].'" >'.$bank_row['bank_image'].'</a>';
                                                        }else
                                                        {
                                                            echo '<br> <img width="100" id="bank_image" onclick="showImg(this.id)"  height="200" src="documents/banks/'.@$bank_row['bank_image'].'" />';
                                                        }
                                                    }
                                                    ?>
                                            </div>
                                        </div>	<!--Primary Emaile -->
                                        


                                        <div class="form-actions" style="clear:both">
                                           <button type="submit" name="reg_submit_add" class="btn-success">Update</button>
                                        </div>

									</form>
                                </div>
                            </div><!--BANK information-->

                            <div class="box box-color box-bordered">
                            	<div class="box-title">
                            		<h3>
                                        <i class="icon-table"></i>
                                        Sign Information
                                    </h3>
                                    <i class="icon-chevron-down" id="chevrona" onclick="toggleMyDiv(this.id,'sign_div');" style="cursor:pointer;float:right;font-size:20px;margin-right: 10px;"></i>
                                </div>
                                <div class="box-content nopadding" id="sign_div" style="display: none">
                               		    <?php
                                	

                                	        $sign_row = checkExist('tbl_customer_sign',array('sign_userid'=>$cust_id));
                               			 ?>
                                     <form id="frm_sign_info" class="form-horizontal form-bordered form-validate" enctype="multipart/form-data" >
                                         <input type="hidden"  value="1" name="req_signature_info" id="req_signature_info"> 
                                    	 <input type="hidden"  value="<?php echo $cust_id; ?>" name="cust_id" id="cust_id">
                                    	<div  class="control-group">
                                        	<label for="tasktitel" class="control-label">Image<sup class="validfield"><span style="color:#F00;font-size:20px;">*</span></sup></label>
                                            <div class="controls">
                                                	<input   type="file" id="img_sign_info " name="img_sign_info" class="input-xlarge" accept="image/jpg,image/jpeg,image/png,application/pdf"  />
                                                    <?php
                                                    if(isset($sign_row['sign_doc']) && $sign_row['sign_doc']!="")
                                                    {
                                                        $ext  =  explode('.',$sign_row['sign_doc']);
                                                        if($ext[sizeof($ext)-1]=='pdf')
                                                        {

                                                         echo '<br> <a href="documents/sign/'.@$sign_row['sign_doc'].'" >'.$sign_row['sign_doc'].'</a>';
                                                        }else
                                                        {
                                                            echo '<br> <img width="100" id="sign_doc" onclick="showImg(this.id)"  height="200" src="documents/sign/'.@$sign_row['sign_doc'].'" />';
                                                        }
                                                    }
                                                    ?>
                                            </div>
                                        </div>	<!--Primary Emaile -->
                                    
                                        <div class="form-actions" style="clear:both">
                                           <button type="submit" name="reg_submit_add" class="btn-success">Update</button>
                                        </div>

									</form>
                                </div>
                            </div><!--Sign information-->

                       	</div>


                   	</div>

               	</div>
           	</div>
       	</div>
        
    <!--======================Start : Javascript Dn By satish 12sep2017=========================-->
    <script src="js/plugins/datepicker/bootstrap-datepicker.js"></script>

       <script type="text/javascript" >
	   		
       		$('#frm_lic_info').on('submit', function(e) 
			{
				e.preventDefault();
				if ($('#frm_lic_info').valid())
				{
					var B20_number =  $('#txt_20b_lic_no').val();
					var B20_image  =  $('#file_lic_20b_image').val();
					var B21_number =  $('#txt_21b_lic_no').val();
					var B21_image  =  $('#file_lic_21b_image').val();
					var C21_number =  $('#txt_21c_lic_no').val();
					var C21_image  =  $('#file_lic_21c_image').val();
					alert(B20_number);
					if(B20_number !="" ||  B20_image!="" ||  B21_number!="" ||  B21_image!="")    
					{
						if(B20_number =="" ||  B20_image =="" ||  B21_number =="" ||  B21_image =="")
						{
							alert('20B and 21B is required');
							return false;
						}
					}
					else
					{
						if(C21_number =="" ||  C21_image =="" )
						{
							alert('21C or 20B   is required');
							return false;
						}
					}


					$.ajax({
						url: "load_aevendor.php?",
						type: "POST",
						data: new FormData(this), // Data sent to server, a set of key/value pairs (i.e. form fields and values)
						contentType: false,       // The content type used when sending data to the server.
						cache: false,             // To unable request pages to be cached
						processData:false,        // To send DOMDocument or non processed data file it is set to false
						async:true,					
						success: function(response) 
						{
							//alert(response);
							data = JSON.parse(response);
							//alert();
							if(data.Success == "Success") 
							{
								
								alert(data.resp);
								window.location.assign("ae_vendor.php?pag=Vendors&id=<?php echo $vendor_id; ?>");
							} 
							else 
							{
								//alert("Wrong Entries");
								$("#model_body").html('<span style="style="color:#F00;">'+data.resp+'</span>');
								$('#error_model').modal('toggle');	
											
							}
						},
						error: function (request, status, error) 
						{
							$("#model_body").html('<span style="style="color:#F00;">'+request.responseText+'</span>');
							$('#error_model').modal('toggle');	
												
						},
						complete: function()
						{
						}
					});
				}
			});	// lic information


			$('#frm_comp_info').on('submit', function(e) 
			{
				e.preventDefault();
				if ($('#frm_comp_info').valid())
				{
					$.ajax({
						url: "load_aevendor.php?",
						type: "POST",
						data: new FormData(this), // Data sent to server, a set of key/value pairs (i.e. form fields and values)
						contentType: false,       // The content type used when sending data to the server.
						cache: false,             // To unable request pages to be cached
						processData:false,        // To send DOMDocument or non processed data file it is set to false
						async:true,					
						success: function(response) 
						{
							//alert(response);
							data = JSON.parse(response);
							//alert();
							if(data.Success == "Success") 
							{
								
								alert(data.resp);
								window.location.assign("ae_vendor.php?pag=Vendors&id=<?php echo $vendor_id; ?>");
							} 
							else 
							{
								//alert("Wrong Entries");
								$("#model_body").html('<span style="style="color:#F00;">'+data.resp+'</span>');
								$('#error_model').modal('toggle');	
											
							}
						},
						error: function (request, status, error) 
						{
							$("#model_body").html('<span style="style="color:#F00;">'+request.responseText+'</span>');
							$('#error_model').modal('toggle');	
												
						},
						complete: function()
						{
						}
					});
				}
			});	// lic information

	   		$('#frm_pan_info').on('submit', function(e) 
			{
				e.preventDefault();
				if ($('#frm_pan_info').valid())
				{
					
					$.ajax({
						url: "load_aevendor.php?",
						type: "POST",
						data: new FormData(this), // Data sent to server, a set of key/value pairs (i.e. form fields and values)
						contentType: false,       // The content type used when sending data to the server.
						cache: false,             // To unable request pages to be cached
						processData:false,        // To send DOMDocument or non processed data file it is set to false
						async:true,					
						success: function(response) 
						{
							//alert(response);
							data = JSON.parse(response);
							//alert();
							if(data.Success == "Success") 
							{
								
								alert(data.resp);
								window.location.assign("ae_vendor.php?pag=Vendors&id=<?php echo $vendor_id; ?>");
							} 
							else 
							{
								//alert("Wrong Entries");
								$("#model_body").html('<span style="style="color:#F00;">'+data.resp+'</span>');
								$('#error_model').modal('toggle');	
											
							}
						},
						error: function (request, status, error) 
						{
							$("#model_body").html('<span style="style="color:#F00;">'+request.responseText+'</span>');
							$('#error_model').modal('toggle');	
												
						},
						complete: function()
						{
						}
					});
				}
			});	// pan information

			$('#frm_tan_info').on('submit', function(e) 
			{
				e.preventDefault();
				if ($('#frm_tan_info').valid())
				{
					
					$.ajax({
						url: "load_aevendor.php?",
						type: "POST",
						data: new FormData(this), // Data sent to server, a set of key/value pairs (i.e. form fields and values)
						contentType: false,       // The content type used when sending data to the server.
						cache: false,             // To unable request pages to be cached
						processData:false,        // To send DOMDocument or non processed data file it is set to false
						async:true,					
						success: function(response) 
						{
							//alert(response);
							data = JSON.parse(response);
							//alert();
							if(data.Success == "Success") 
							{
								
								alert(data.resp);
								window.location.assign("ae_vendor.php?pag=Vendors&id=<?php echo $vendor_id; ?>");
							} 
							else 
							{
								//alert("Wrong Entries");
								$("#model_body").html('<span style="style="color:#F00;">'+data.resp+'</span>');
								$('#error_model').modal('toggle');	
											
							}
						},
						error: function (request, status, error) 
						{
							$("#model_body").html('<span style="style="color:#F00;">'+request.responseText+'</span>');
							$('#error_model').modal('toggle');	
												
						},
						complete: function()
						{
						}
					});
				}
			});	// tan information

			$('#frm_gst_info').on('submit', function(e) 
			{
				e.preventDefault();
				if ($('#frm_gst_info').valid())
				{
					
					$.ajax({
						url: "load_aevendor.php?",
						type: "POST",
						data: new FormData(this), // Data sent to server, a set of key/value pairs (i.e. form fields and values)
						contentType: false,       // The content type used when sending data to the server.
						cache: false,             // To unable request pages to be cached
						processData:false,        // To send DOMDocument or non processed data file it is set to false
						async:true,					
						success: function(response) 
						{
							//alert(response);
							data = JSON.parse(response);
							//alert();
							if(data.Success == "Success") 
							{
								
								alert(data.resp);
								window.location.assign("ae_vendor.php?pag=Vendors&id=<?php echo $vendor_id; ?>");
							} 
							else 
							{
								//alert("Wrong Entries");
								$("#model_body").html('<span style="style="color:#F00;">'+data.resp+'</span>');
								$('#error_model').modal('toggle');	
											
							}
						},
						error: function (request, status, error) 
						{
							$("#model_body").html('<span style="style="color:#F00;">'+request.responseText+'</span>');
							$('#error_model').modal('toggle');	
												
						},
						complete: function()
						{
						}
					});
				}
			});	// gst information


			$('#frm_bank_info').on('submit', function(e) 
			{
				e.preventDefault();
				if ($('#frm_bank_info').valid())
				{
					
					$.ajax({
						url: "load_aevendor.php?",
						type: "POST",
						data: new FormData(this), // Data sent to server, a set of key/value pairs (i.e. form fields and values)
						contentType: false,       // The content type used when sending data to the server.
						cache: false,             // To unable request pages to be cached
						processData:false,        // To send DOMDocument or non processed data file it is set to false
						async:true,					
						success: function(response) 
						{
							//alert(response);
							data = JSON.parse(response);
							//alert();
							if(data.Success == "Success") 
							{
								
								alert(data.resp);
								window.location.assign("ae_vendor.php?pag=Vendors&id=<?php echo $vendor_id; ?>");
							} 
							else 
							{
								//alert("Wrong Entries");
								$("#model_body").html('<span style="style="color:#F00;">'+data.resp+'</span>');
								$('#error_model').modal('toggle');	
											
							}
						},
						error: function (request, status, error) 
						{
							$("#model_body").html('<span style="style="color:#F00;">'+request.responseText+'</span>');
							$('#error_model').modal('toggle');	
												
						},
						complete: function()
						{
						}
					});
				}
			});	// bank information
			
			$('#frm_sign_info').on('submit', function(e) 
			{
				e.preventDefault();
				if ($('#frm_sign_info').valid())
				{
					
					$.ajax({
						url: "load_aevendor.php?",
						type: "POST",
						data: new FormData(this), // Data sent to server, a set of key/value pairs (i.e. form fields and values)
						contentType: false,       // The content type used when sending data to the server.
						cache: false,             // To unable request pages to be cached
						processData:false,        // To send DOMDocument or non processed data file it is set to false
						async:true,					
						success: function(response) 
						{
							//alert(response);
							data = JSON.parse(response);
							//alert();
							if(data.Success == "Success") 
							{
								
								alert(data.resp);
								window.location.assign("ae_vendor.php?pag=Vendors&id=<?php echo $vendor_id; ?>");
							} 
							else 
							{
								//alert("Wrong Entries");
								$("#model_body").html('<span style="style="color:#F00;">'+data.resp+'</span>');
								$('#error_model').modal('toggle');	
											
							}
						},
						error: function (request, status, error) 
						{
							$("#model_body").html('<span style="style="color:#F00;">'+request.responseText+'</span>');
							$('#error_model').modal('toggle');	
												
						},
						complete: function()
						{
						}
					});
				}
			});	// signature information	
	   	
		
		   function getCat(cat_id)
		   {
			   
				if(cat_id=="")
				{
					alert('Please select Category...!');
					return false;
				}
				var sendInfo 	= {"cat_id":cat_id,"getCat":1};
				var area_status = JSON.stringify(sendInfo);								
				$.ajax({
					url: "load_products.php?",
					type: "POST",
					data: area_status,
					contentType: "application/json; charset=utf-8",						
					success: function(response) 
					{			
						data = JSON.parse(response);
						if(data.Success == "Success") 
						{							
							$('#txt_cat').html(data.resp);
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
		   
		   
		   function getPacking(cat_id)
		   {
			    if(cat_id=="")
				{
					alert('Please select Category...!');
					return false;
				}
				var sendInfo 	= {"cat_id":cat_id,"getPacking":1};
				var area_status = JSON.stringify(sendInfo);								
				$.ajax({
					url: "load_products.php?",
					type: "POST",
					data: area_status,
					contentType: "application/json; charset=utf-8",						
					success: function(response) 
					{			
						data = JSON.parse(response);
						if(data.Success == "Success") 
						{							
							$('#txt_packing').html(data.resp);
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
		   
		    function getFactor(cat_id)
		    {
			    if(cat_id=="")
				{
					alert('Please select Category...!');
					return false;
				}
				var sendInfo 	= {"cat_id":cat_id,"getFactor":1};
				var area_status = JSON.stringify(sendInfo);								
				$.ajax({
					url: "load_products.php?",
					type: "POST",
					data: area_status,
					contentType: "application/json; charset=utf-8",						
					success: function(response) 
					{			
						data = JSON.parse(response);
						if(data.Success == "Success") 
						{							
							$('#txt_factor').html(data.resp);
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
		   function getApplication(cat_id)
		    {
			    if(cat_id=="")
				{
					alert('Please select Category...!');
					return false;
				}
				var sendInfo 	= {"cat_id":cat_id,"getApplication":1};
				var area_status = JSON.stringify(sendInfo);								
				$.ajax({
					url: "load_products.php?",
					type: "POST",
					data: area_status,
					contentType: "application/json; charset=utf-8",						
					success: function(response) 
					{			
						data = JSON.parse(response);
						if(data.Success == "Success") 
						{							
							$('#txt_attribute').html(data.resp);
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

		   function getCities(state_id, select_id, city_select_id)
	        {
	        	var getStatesCity	= '1';

	        	var sendInfo		= {"state_id":state_id, "city_select_id":city_select_id, "getStatesCity":getStatesCity};
	        	var getStateCities	= JSON.stringify(sendInfo); 

	        	$.ajax({
						url: "load_aevendor.php",
						type: "POST",
						data: getStateCities, // Data sent to server, a set of key/value pairs (i.e. form fields and values)
						contentType: false,       // The content type used when sending data to the server.
						cache: false,             // To unable request pages to be cached
						processData:false,        // To send DOMDocument or non processed data file it is set to false
						async:true,						
						success: function(response) 
						{   
							data = JSON.parse(response);
							if(data.Success == "Success") 
							{  
								$('#'+city_select_id).prop('selectedIndex',0);
								$('#'+city_select_id).html(data.resp);
								$('#'+city_select_id).selectpicker('refresh');
								
							} 
							else 
							{   
								$("#model_body").html('<span style="style="color:#F00;">'+data.resp+'</span>');							
								$('#error_model').modal('toggle');	
							}
						},
						error: function (request, status, error) 
						{
							$("#model_body").html('<span style="style="color:#F00;">'+request.responseText+'</span>');							
							$('#error_model').modal('toggle');	
						},
						complete: function()
						{
							//alert("complete");
							//loading_hide();
						}
					});
	        }

        function same_as_bill()   //done by monika
		{
			if($("#address_check").prop('checked') == true)
			{
				var comp_bill_address	= $('#txt_billing_address').val();
				var comp_ship_address	= $('#txt_shipping_address').val(comp_bill_address);
				$('#txt_shipping_address').prop('readonly', true);
				
				/* state select change*/
				var bill_state = $("#txt_bill_state").val();
				$("#txt_shipping_state").val(bill_state);
				$("#txt_shipping_state").prop("readonly",true); // disable  state select
				$("#txt_shipping_state").selectpicker('refresh'); 				
				/* state select change*/
				/* City select change*/				
				getCities(bill_state,'txt_bill_state','txt_shipping_city');
				stopExecution();
			}
			else if($("#address_check").prop('checked') == false)
			{
				$('#txt_shipping_address').prop("readonly",false);
				$('#txt_shipping_state').prop("readonly",false);
				$('#txt_shipping_city').prop("readonly",false);
				$('#txt_shipping_pincode').prop("readonly",false);
				
				$('#txt_shipping_address').val('');
				$('#txt_shipping_state').prop('selectedIndex',0);
				$('#txt_shipping_state').selectpicker('refresh');
				$('#txt_shipping_city').prop('selectedIndex',0);
				$('#txt_shipping_city').selectpicker('refresh');
				$('#txt_shipping_pincode').val('');
			}						
		}
	   </script>
     <!--======================Start : Javascript Dn By satish 12sep2017=========================-->

     <script type="text/javascript">	

      $( '.datepicker' ).datepicker({
		changeMonth	: true,
		changeYear	: true,
		format: 'dd/mm/yyyy',
		yearRange 	: 'c:c',//replaced 'c+0' with c (for showing years till current year)
		startDate: '+d',
			
	   });

	</script>

    


    </body>
</html>