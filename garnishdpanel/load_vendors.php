<?php
include("include/routines.php");
$json = file_get_contents('php://input');
$obj = json_decode($json);
//var_dump($obj = json_decode($json));
$uid				= $_SESSION['panel_user']['id'];
 $utype				= $_SESSION['panel_user']['utype'];
	






if((isset($_POST['update_req'])) == "1" && isset($_POST['update_req']))
{
	$vendor_id				= mysqli_real_escape_string($db_con,$_POST['vendor_id']);

	// quit($vendor_id);

	$data['vendor_name']	= strtolower(mysqli_real_escape_string($db_con,$_POST['cust_name']));
	
	$data['vendor_email']	= mysqli_real_escape_string($db_con,$_POST['vendor_email']);
	$data['vendor_mobile']	= mysqli_real_escape_string($db_con,$_POST['vendor_mobile']);


	$pdata['pan_no']	       = mysqli_real_escape_string($db_con,$_POST['vendor_pan']);
	$pdata['pan_modified']     = $datetime;
	$pdata['pan_modified_by']  = $uid;

	$gdata['gst_no']	       = mysqli_real_escape_string($db_con,$_POST['vendor_gst']);
	$gdata['gst_modified']     = $datetime;
	$gdata['gst_modified_by']  = $uid;


	$cdata['comp_name']	         = mysqli_real_escape_string($db_con,$_POST['comp_name']);
	$cdata['comp_establishment'] = mysqli_real_escape_string($db_con,$_POST['comp_establishment']);
    
	$ldata['lic_number']	     = mysqli_real_escape_string($db_con,$_POST['licence_no']);
	$ldata['lic_exipiry_date']	 = mysqli_real_escape_string($db_con,$_POST['lic_exipiry_date']);

	
	$bdata['bank_name']	        = mysqli_real_escape_string($db_con,$_POST['bank_name']);
	$bdata['bank_branch']	    = mysqli_real_escape_string($db_con,$_POST['branch_name']);
	$bdata['bank_acc_no']	    = mysqli_real_escape_string($db_con,$_POST['acc_number']);
	$bdata['bank_ifsc']	        = mysqli_real_escape_string($db_con,$_POST['ifsc']);

	
	$response_array = array();

	if($data['vendor_name'] !="" && $data['vendor_email']!="" && $data['vendor_mobile']!="")
	{
		$data['vendor_created'] = $datetime;
		$data['vendor_created_by'] = $uid;
		update('tbl_vendor',$data,array('vendor_id'=>$vendor_id));


		$row = checkExist('tbl_customer' ,array('cust_vendorid'=>$vendor_id));
		$userid = $row['cust_id'];
		if($pdata['pan_no']!="")
		{
			update('tbl_customer_pan',$pdata,array('pan_userid'=>$userid));
		}


		if($gdata['gst_no']!="")
		{
			update('tbl_customer_gst',$gdata,array('gst_userid'=>$userid));
		}


		
		if($bdata['bank_name']!="" && $bdata['bank_acc_no'])
		{
			update('tbl_customer_bank_details',$bdata,array('bank_userid'=>$userid));
		}


		if($ldata['lic_number']!="" && $ldata['lic_exipiry_date'])
		{
			update('tbl_customer_licenses',$ldata,array('lic_custid'=>$userid));
		}

		if($cdata['comp_name']!="" && $cdata['comp_establishment']!="")
		{

			update('tbl_customer_company',$cdata,array('comp_user_id'=>$userid));
		}
		

		$response_array = array("Success"=>"Success","resp"=>"Vendor updated Successfully...!");	

	}
	else
	{
		$response_array = array("Success"=>"fail","resp"=>"Empty Data.");	
	}
	echo json_encode($response_array);		
}



if((isset($obj->load_customers_parts)) == "1" && isset($obj->load_customers_parts))
{
	$cust_id 		= mysqli_real_escape_string($db_con,$obj->cust_id);
	$req_type 		= strtolower(mysqli_real_escape_string($db_con,$obj->req_type));
	$response_array = array();
	if($req_type != "")
	{
		if($req_type=='edit' || $req_type=='view')
		{
			if($req_type=='edit')
			{
				$disabled='';
				$data .='<input type="hidden" name="update_req" value="1" />';
				
			}
			else
			{
				$disabled='disabled';
			}
			


			$sql_get_data =" SELECT * FROM tbl_vendor WHERE vendor_id='".$cust_id."' ";
			$res_get_data = mysqli_query($db_con,$sql_get_data) or die(mysqli_error($db_con));
			$row_get_data = mysqli_fetch_array($res_get_data);

			$data .='<input type="hidden" name="vendor_id" value="'.$row_get_data['vendor_id'].'" />';


			$data .= '<div class="control-group">';
			$data .= '<label for="tasktitel" class="control-label">Name </label>';
			$data .= '<div class="controls">';
			$data .= $row_get_data['vendor_name'];
			$data .= '</div>';	
			$data .= '</div>';	
			
			
			$data .= '<div class="control-group">';
			$data .= '<label for="tasktitel" class="control-label">Email </label>';
			$data .= '<div class="controls">';
			$data .= $row_get_data['vendor_email'];
			$data .= '</div>';	
			$data .= '</div>';	
			
			$data .= '<div class="control-group">';
			$data .= '<label for="tasktitel" class="control-label">Mobile </label>';
			$data .= '<div class="controls">';
			$data .= $row_get_data['vendor_mobile'];
			$data .= '</div>';
			$data .= '</div>';	// Csutomer MObile
			
			$sql_get_custid = "SELECT * FROM tbl_customer WHERE cust_vendorid='".$cust_id."' ";
			$res_get_custid = mysqli_query($db_con,$sql_get_custid) or die(mysqli_error($db_con));
			$row_get_custid = mysqli_fetch_array($res_get_custid);
			$cust_id 		= $row_get_custid['cust_id'];


			$sql_get_pan  =" SELECT * FROM tbl_customer_pan WHERE  ";
			$sql_get_pan .="  pan_userid='".$cust_id."'";
			$res_get_pan = mysqli_query($db_con,$sql_get_pan) or die(mysqli_error($db_con));
			$row_get_pan = mysqli_fetch_array($res_get_pan);
			$data .= '<div class="control-group">';
			$data .= '<label for="tasktitel" class="control-label">Pan Number </label>';
			$data .= '<div class="controls">';
			$data .= $row_get_pan['pan_no'];
			$data .= '</div>';
			$data .= '</div>';  // Cust PAN
			
			
			$sql_get_gst  =" SELECT * FROM tbl_customer_gst WHERE  ";
			$sql_get_gst .="  gst_userid='".$cust_id."'";
			$res_get_gst = mysqli_query($db_con,$sql_get_gst) or die(mysqli_error($db_con));
			$row_get_gst = mysqli_fetch_array($res_get_gst);
			$data .= '<div class="control-group">';
			$data .= '<label for="tasktitel" class="control-label">GST Number</label>';
			$data .= '<div class="controls">';
			$data .= $row_get_gst['gst_no'];
			$data .= '</div>';
			$data .= '</div>'; // Cust GST
			
			$sql_get_bank  =" SELECT * FROM tbl_customer_company WHERE  ";
			$sql_get_bank .="  comp_user_id='".$cust_id."' ORDER BY comp_created_by DESC";
			$res_get_bank = mysqli_query($db_con,$sql_get_bank) or die(mysqli_error($db_con));
			$num_get_bank = mysqli_num_rows($res_get_bank);
			
			if($num_get_bank!=0)
			{
			    $data .= '<div class="control-group">';
				$data .= '<label for="tasktitel" class="control-label">Company Details </label>';
				$data .='<div  class="controls">';
				$data .= '<h4 style="text-align:center">Company Detail</h4>';
				$data .='<table class="table table-bordered dataTable" style="text-align:center">
							 <tr>
							   <th style="text-align:center">Sr NO.</th>
							   <th style="text-align:center">Company Name</th>
							   <th style="text-align:center">Establiashment</th>
							   <th style="text-align:center">Billing Addess</th>
							   <th style="text-align:center">Shipping Address</th>
							   <th style="text-align:center">Added Date</th>
							 </tr>';
				$bank_no =1;			 
				while($row_get_comp = mysqli_fetch_array($res_get_bank))
				{
					// print_r($res_get_licence);
					$date  = date(' j F, Y',strtotime($row_get_comp['comp_created_date']));
					$data .='<tr>
							   <td style="text-align:center">'.$bank_no++.'</td>
							   <td style="text-align:center;with:10%">'.$row_get_comp['comp_name'].'</td>
							   <td style="text-align:center">'.$row_get_comp['comp_establishment'].'</td>

							   <td style="text-align:center;with:10%">'.$row_get_comp['comp_bill_address'].'</td>
							   
							   <td style="text-align:center" >'.$row_get_comp['comp_ship_address'].'
							   </td>
							   
							   <td style="text-align:center" >'.$date.'</td>
					        </tr>';
				
				}
				$data .='</table>';
				$data .= '</div>';	
				$data .= '</div>';	
			}///  customer company
			
			$sql_get_licence  =" SELECT * FROM tbl_customer_licenses WHERE  ";
			$sql_get_licence .="  lic_custid='".$cust_id."' ORDER BY lic_created DESC";
			$res_get_licence = mysqli_query($db_con,$sql_get_licence) or die(mysqli_error($db_con));
			$num_get_licence = mysqli_num_rows($res_get_licence);
			
			if($num_get_licence!=0)
			{
				
				$data .= '<div class="control-group">';
				$data .= '<label for="tasktitel" class="control-label">Licence Details </label>';
				$data .='<div  class="controls">';
				$data .= '<h4 style="text-align:center">Licence Detail</h4>';
				$data .='<table class="table table-bordered dataTable" style="text-align:center">
							 <tr>
							   <th style="text-align:center">Sr NO.</th>
							   <th style="text-align:center">Licence No.</th>
							   <th style="text-align:center">Expiry Date</th>
							   <th style="text-align:center">Document</th>
							   <th style="text-align:center">Type</th>
							   
							   <th style="text-align:center">Added Date</th>
							 </tr>';
				$lic_no =1;			 
				while($row_get_licence = mysqli_fetch_array($res_get_licence))
				{
					// print_r($res_get_licence);
					$date  = date(' j F, Y',strtotime($row_get_licence['lic_created']));
					$data .='<tr>
							   <td style="text-align:center">'.$lic_no++.'</td>
							   <td style="text-align:center">'.$row_get_licence['lic_number'].'</td>
							   <td style="text-align:center">'.$row_get_licence['lic_exipiry_date'].'</td>
							   <td style="text-align:center">
							   <a href="../idbpanel/documents/licenses/'.$row_get_licence['lic_document'].'" download>'.$row_get_licence['lic_document'].'</a>
							   </td>';
							   
							    if($row_get_licence['lic_type']!="")
								{
									$data .='<td style="text-align:center">'.$row_get_licence['lic_type'].'</td>';
								}
								else
								{
									$data .='<td style="text-align:center">-</td>';
								}
							    
							   
							   $data .='<td style="text-align:center" >'.$date.'</td>
					        </tr>';
				
				}
				$data .="<script type=\"text/javascript\">	 $( '.datepicker' ).datepicker({
				changeMonth	: true,
				changeYear	: true,
				format: 'dd/mm/yyyy',
				yearRange 	: 'c:c',//replaced 'c+0' with c (for showing years till current year)
				startDate: '+d',
					
			   });</script>";
				$data .='</table>';
				$data .= '</div>';	
				$data .= '</div>';
			}// LIcence Detail End
			
			
			$sql_get_bank  =" SELECT * FROM tbl_customer_bank_details WHERE  ";
			$sql_get_bank .="  bank_userid='".$cust_id."' ORDER BY bank_created DESC";
			$res_get_bank = mysqli_query($db_con,$sql_get_bank) or die(mysqli_error($db_con));
			$num_get_bank = mysqli_num_rows($res_get_bank);
			
			if($num_get_bank!=0)
			{
				
				$data .= '<div class="control-group">';
				$data .= '<label for="tasktitel" class="control-label">Bank Details </label>';
				$data .='<div  class="controls">';
				$data .= '<h4 style="text-align:center">Bank Detail</h4>';
				$data .='<table class="table table-bordered dataTable" style="text-align:center">
							 <tr>
							   <th style="text-align:center">Sr NO.</th>
							   <th style="text-align:center">Bank Name</th>
							   <th style="text-align:center">Branch Name</th>
							   <th style="text-align:center">Account Number</th>
							   <th style="text-align:center">IFSC</th>
							   <th style="text-align:center">Document</th>
							   <th style="text-align:center">Added Date</th>
							 </tr>';
				$bank_no =1;			 
				while($row_get_bank = mysqli_fetch_array($res_get_bank))
				{
					// print_r($res_get_licence);
					$date  = date(' j F, Y',strtotime($row_get_bank['bank_created']));
					$data .='<tr>
							   <td style="text-align:center">'.$bank_no++.'</td>
							   <td style="text-align:center;with:10%">'.$row_get_bank['bank_name'].'
							   </td>
							   <td style="text-align:center;with:10%">'.$row_get_bank['bank_branch'].'</td>
							   <td style="text-align:center">'.$row_get_bank['bank_acc_no'].'
							   </td>
							   <td style="text-align:center" >'.$row_get_bank['bank_ifsc'].'
							   </td>
							   <td style="text-align:center" >
							    <a href="../idbpanel/documents/banks/'.$row_get_bank['bank_image'].'" download>'.$row_get_bank['bank_image'].'</a>
							   	
							   </td>
							   <td style="text-align:center" >'.$date.'</td>
					        </tr>';
				
				}
				$data .='</table>';
				$data .= '</div>';	
				$data .= '</div>';	
			}///  Bank Detail
			
			$data .= '<div class="control-group">';
			$data .= '<label for="tasktitel" class="control-label">Status</label>';
			$data .= '<div class="controls">';
			if($row_get_data['vendor_status']==2)
			{
			    	$data .='Registered';
			}
			elseif($row_get_data['vendor_status']==1)
			{
				$data .='Approved';
		    	//$data .='<input type="button" value="Approved" class="btn-link" id="'.$row_get_data['vendor_id'].'" onclick="changeStatus(this.id,0);addMoreVendor(this.id,\'edit\')">';
			}
			else
			{
				$data .='<input type="button" value="Not Approved" class="btn-link" id="'.$row_get_data['vendor_id'].'" onclick="changeStatus(this.id,1);addMoreVendor(this.id,\'edit\')">';
			}
			
			$data .= '</div>';
			$data .= '</div>'; // Cust Status
			
			if($req_type=='edit')
			{
				$data .= '<div class="control-group">';
				$data .= '<div class="controls">';
				$data .= '<input '.$disabled.' type="submit"  class="btn-success"  value="Update" />';
				$data .= '</div>';	
				$data .= '</div>';	
			}
			quit($data,1);
		}
		elseif($req_type=='add')
		{
			
			$data .= '<input type="hidden" name="insert_vendor" value="1" >';
			
			
			
			$data .= '<div class="control-group">';
			$data .= '<label for="tasktitel" class="control-label">Name 
			<sup class="validfield"><span style="color:#F00;font-size:20px;">*</span></sup></label>';
			$data .= '<div class="controls">';
			$data .= '<input  type="text" placeholder="Enter Full Name" id="vendor_name" name="vendor_name" class="input-large" data-rule-required="true" />';
			$data .= '</div>';	
			$data .= '</div>';
			
			$data .= '<div class="control-group">';
			$data .= '<label for="tasktitel" class="control-label">Email 
			<sup class="validfield"><span style="color:#F00;font-size:20px;">*</span></sup></label>';
			$data .= '<div class="controls">';
			$data .= '<input placeholder="Enter Email"  type="email" id="vendor_email" name="vendor_email" class="input-large" data-rule-required="true" />';
			$data .= '</div>';	
			$data .= '</div>';
			
			$data .= '<div class="control-group">';
			$data .= '<label for="tasktitel" class="control-label">Mobile 
			<sup class="validfield"><span style="color:#F00;font-size:20px;">*</span></sup></label>';
			$data .= '<div class="controls">';
			$data .= '<input  type="text" id="vendor_mobile" name="vendor_mobile" placeholder="Enter Mobile Number" class="input-large" data-rule-required="true" maxlength="10" minlength="10" />';
			$data .= '</div>';	
			$data .= '</div>';
			
			$data .= '<div class="control-group">';
			$data .= '<div class="controls">';
			$data .= '<input type="submit"  class="btn-success"  value="Add Vendor" />';
			$data .= '</div>';	
			$data .= '</div>';	
			
			quit($data,1);	
		 
		}
	}
	else
	{
		$response_array = array("Success"=>"fail","resp"=>"Request Type Not Defined");		
	}
	echo json_encode($response_array);
}


if((isset($obj->load_customers)) == "1" && isset($obj->load_customers))
{
	$response_array = array();	
	$start_offset   = 0;
	
	$page 			= $obj->page;	
	$per_page		= $obj->row_limit_customers;
	$search_text	= $obj->search_text_customers;
	$star_status    = $obj->star_status;	
	
	if($page != "" && $per_page != "")	
	{
		$cur_page 		= $page;
		$page 	   	   	= $page - 1;
		$start_offset += $page * $per_page;
		$start 			= $page * $per_page;
			
		$sql_load_data  = " SELECT  * ";
		$sql_load_data  .= " FROM `tbl_vendor` AS ti WHERE 1=1 ";
		if(strcmp($utype,'1')!==0)
		{
			$sql_load_data  .= " AND vendor_created_by='".$uid."' ";
		}
		if($star_status==1)
		{
			$sql_load_data  .= " AND vendor_star='".$star_status."' ";
		}
		if($search_text != "")
		{
			$sql_load_data .= " and (vendor_name like '%".$search_text."%' or vendor_email like '%".$search_text."%' or vendor_mobile like '%".$search_text."%'";
			$sql_load_data .= " or vendor_type like '%".$search_text."%' or vendor_created like '%".$search_text."%' or vendor_modified like '%".$search_text."%'";
			$sql_load_data .= "	) ";	
		}
		$data_count		= 	dataPagination($sql_load_data,$per_page,$start,$cur_page);		
		$sql_load_data .=" ORDER BY vendor_created DESC LIMIT $start, $per_page ";
		$result_load_data = mysqli_query($db_con,$sql_load_data) or die(mysqli_error($db_con));			
		if(strcmp($data_count,"0") !== 0)
		{		
			$customers_data = "";	
			$customers_data .= '<table id="tbl_user" class="table table-bordered dataTable" style="width:100%;text-align:center">';
    	 	$customers_data .= '<thead>';
    	  	$customers_data .= '<tr>';
         	$customers_data .= '<th style="text-align:center">Sr No.</th>';
			$edit = checkFunctionalityRight("view_vendors.php",1);
			if($edit)
			{
				$customers_data .= '<th style="text-align:center">Star</th>';
			}
			$customers_data .= '<th style="text-align:center">Vendor ID</th>';
			$customers_data .= '<th style="text-align:center">Vendor Info</th>';
			$customers_data .= '<th style="text-align:center">Created Date</th>';		
			$dis = checkFunctionalityRight("view_vendors.php",3);
			if($dis)
			{					
				$customers_data .= '<th style="text-align:center">Status</th>';											
			}
			$edit = checkFunctionalityRight("view_vendors.php",1);
			if($edit)
			{					
				$customers_data .= '<th style="text-align:center">Edit</th>';			
			}	
			$delete = checkFunctionalityRight("view_vendors.php",2);
			
			if($delete)
			{					
				$customers_data .= '<th style="text-align:center"><div style="text-align:center"><input type="button"  value="Delete" onclick="multipleDelete();" class="btn-danger"/></div></th>';
			}
			if($edit)
		    {
			$customers_data .= '<th style="text-align:center">Comments</th>';	
			}
          	$customers_data .= '</tr>';
      		$customers_data .= '</thead>';
      		$customers_data .= '<tbody>';
			while($row_load_data = mysqli_fetch_array($result_load_data))
			{
	    	  	$customers_data .= '<tr>';				
				$customers_data .= '<td style="text-align:center">'.++$start_offset.'</td>';
				$edit = checkFunctionalityRight("view_vendors.php",1);
				if($edit)
				{
					$customers_data .= '<td style="text-align:center"><i id="'.$row_load_data['vendor_id'].'star_status" ';
					if($row_load_data['vendor_star'] == 1)
					{
						$customers_data .= ' onclick="changeStarStatus(this.id,\'0\');" class="icon-star" style="font-size:30px;cursor:pointer;color:#FFD700;padding:5px;margin-top:10px"></i>';
					}
					else
					{
						$customers_data .= ' onclick="changeStarStatus(this.id,\'1\');" class="icon-star-empty" style="font-size:30px;cursor:pointer;padding:5px;margin-top:10px"></i> ';					
					}
					$customers_data .='</td>';
				}				
				$customers_data .= '<td style="text-align:center">'.$row_load_data['vendor_id'].'</td>';
				$customers_data .= '<td><input type="button" value="'.ucwords($row_load_data['vendor_name']).'" class="btn-link" id="'.$row_load_data['vendor_id'].'" onclick="addMoreVendor(this.id,\'view\');">';
				$customers_data .= '<div id="cust_info'.$row_load_data['vendor_id'].'" >';				
				$customers_data .= '<div><b>Email:</b>&nbsp;'.$row_load_data['vendor_email'].'</div>';
				$customers_data .= '<div><b>Mobile Number:</b>&nbsp;'.$row_load_data['vendor_mobile'].'</div>';								
				$customers_data .= '<div><b>Created:</b>&nbsp;';
				if(trim($row_load_data['vendor_created']) == "")
				{
					$customers_data .= '<span style="color:#F00">Not Available</span>';
				}
				else
				{
					$customers_data .= $row_load_data['vendor_created'];			
				}
				$customers_data .= '</div>';
				$customers_data .= '<div><b>Modified:</b>&nbsp;';
				if(trim($row_load_data['vendor_modified']) == "")
				{
					$customers_data .= '<span style="color:#F00">Not Available</span>';
				}
				else
				{
					$customers_data .= $row_load_data['vendor_modified'];					
				}				
				$customers_data .= '</div>';
						
				$customers_data .= '</td>';
				$date = strtotime($row_load_data['vendor_created']);
	           
				$customers_data .= '<td style="text-align:center">'.date(' j F, Y',$date).'</td>';
				
				$dis = checkFunctionalityRight("view_vendors.php",3);
				if($dis)
				{					
					$sql_vload_data  = " SELECT  * ";
					$sql_vload_data  .= " FROM `tbl_customer` AS tc  ";
					$sql_vload_data  .= " INNER JOIN tbl_customer_company as tcc ON tc.cust_id = tcc.comp_user_id "; //  Company
					$sql_vload_data  .= " INNER JOIN tbl_customer_gst as tcg ON tc.cust_id = tcg.gst_userid ";//  GST 
					$sql_vload_data  .= " INNER JOIN tbl_customer_pan as tcp ON tc.cust_id = tcp.pan_userid ";//  PAN 
					$sql_vload_data  .= " INNER JOIN tbl_customer_bank_details as tcb ON tc.cust_id = tcb.bank_userid ";//  BANK 
					$sql_vload_data  .= " INNER JOIN tbl_customer_licenses as tcl ON tc.cust_id = tcl.lic_custid ";//  Lic 
					$sql_vload_data  .= " WHERE tc.cust_vendorid ='".$row_load_data['vendor_id']."' ";
					$res_vload_data   = mysqli_query($db_con,$sql_vload_data) or die($db_con);
					$num_vload_data   = mysqli_num_rows($res_vload_data);
					
					$customers_data .= '<td style="text-align:center">';	
					
					if($num_vload_data==0)
					{
						$customers_data .='Registered';
					}
					else
					{
						if($row_load_data['vendor_status'] == 1)
						{
							$customers_data .= '<input type="button" value="Approved" id="'.$row_load_data['vendor_id'].'" class="btn-success" onclick="changeStatus(this.id,0);">';
							
						}
						else
						{
							$customers_data .= '<input type="button" value="Approve" id="'.$row_load_data['vendor_id'].'" class="btn-danger" onclick="changeStatus(this.id,1);">';
						}
					}
					
					$customers_data .= '</td>';		
				}
				$edit = checkFunctionalityRight("view_vendors.php",1);
				if($edit)
				{				
						$customers_data .= '<td style="text-align:center">';
						//$customers_data .= '<input type="button" value="Edit" id="'.$row_load_data['vendor_id'].'" class="btn-warning" onclick="addMoreVendor(this.id,\'edit\');"></td>';		

						$customers_data .= '<a href="ae_vendor.php?pag=Vendors&id='.$row_load_data['vendor_id'].'" class="btn-warning">Edit</a></td>';		
				}
				$edit = checkFunctionalityRight("view_vendors.php",1);
				if($edit)
				{					
					$customers_data .= '<td><div class="controls" style="text-align:center">';
					$customers_data .= '<input type="checkbox" value="'.$row_load_data['vendor_id'].'" id="customers'.$row_load_data['vendor_id'].'" name="customers'.$row_load_data['vendor_id'].'" class="css-checkbox customers">';
					$customers_data .= '<label for="customers'.$row_load_data['vendor_id'].'" class="css-label"></label>';
					$customers_data .= '</div></td>';										
				}
				
				if($edit)
			    {
				$customers_data .= '<td style="text-align:center">
				<textarea name="comment_'.$row_load_data['vendor_id'].'" id="comment_'.$row_load_data['vendor_id'].'" onchange="comments('.$row_load_data['vendor_id'].');">'.$row_load_data['vendor_comment'].'</textarea><br>
				
					</td>';							
				}
	          	$customers_data .= '</tr>';															
			}	
      		$customers_data .= '</tbody>';
      		$customers_data .= '</table>';	
			$customers_data .= $data_count;
			$response_array = array("Success"=>"Success","resp"=>$customers_data);					
		}
		else
		{
			$response_array = array("Success"=>"fail","resp"=>"No Data Available in Customers");
		}
	}
	else
	{
		$response_array = array("Success"=>"fail","resp"=>"No Row Limit and Page Number Specified");
	}
	echo json_encode($response_array);	
}

if((isset($obj->getStatesCity)) == '1' && (isset($obj->getStatesCity)))
	{
		$state_id	= $obj->state_id;
		$city_select_id	= $obj->city_select_id;
		$data    	= '';
		if($state_id != '')
		{
			$data 	= getStatesCity($state_id, $city_select_id);

			quit(utf8_encode($data), 1);
		}
		else
		{
			quit('Ooppsss, Something went wrong', 0);
		}
	}
	

if((isset($obj->change_status)) == "1" && isset($obj->change_status))
{
	$vendor_id				= $obj->cust_id;
	$curr_status			= $obj->curr_status;
	$response_array 		= array();

	$status_flag = 0;
	$sql_check_parent 		= "Select * from tbl_vendor where `vendor_id` = '".$vendor_id."' ";
	$result_check_parent 	= mysqli_query($db_con,$sql_check_parent) or die(mysqli_error($db_con));
	$row_check_parent 		= mysqli_fetch_array($result_check_parent);
	$data['email']          = $row_check_parent['vendor_email'];
	
	
	
	if($curr_status==1)
	{   ///////////////////////////////////////////////////////////////////////////
		///=========Start Insertion For Panel Login Satish 24082017==============//
		$sql_check_user = " SELECT * FROM tbl_cadmin_users WHERE email like '".$row_check_parent['vendor_email']."'";
		$res_check_user = mysqli_query($db_con,$sql_check_user) or die(mysqli_error($db_con));
		$num_check_user = mysqli_num_rows($res_check_user);
		if($num_check_user==0)
		{
			$data['fullname']         = $row_check_parent['vendor_name'];
			$data['userid']           = $row_check_parent['vendor_email'];
			$data['email_status']     = $row_check_parent['vendor_emailstatus'];
			$data['mobile_num']       = $row_check_parent['vendor_mobile'];
			$data['sms_status']       = $row_check_parent['vendor_mobilestatus'];
			$data['password']         = $row_check_parent['vendor_password'];
			$data['salt_value']       = $row_check_parent['vendor_salt'];
			$data['utype']      	  = 2;
			/*
			$data['state']     	      = $row_check_parent['vendor_name'];
			$data['city']             = $row_check_parent['vendor_email'];
			*/
			$data['tbl_users_owner']  = 1;
			$data['created']          = $datetime;
			$data['created_by']       = $uid;
			$data['status']           = 1;
			$data['vendorId']		  = $vendor_id;
			$admin_id                 = insert('tbl_cadmin_users',$data);
			
			$sql_check_rights = " SELECT * FROM tbl_assign_rights WHERE ar_user_owner_id like '".$admin_id."'";
			$res_check_rights = mysqli_query($db_con,$sql_check_rights) or die(mysqli_error($db_con));
			$num_check_rights = mysqli_num_rows($res_check_rights);
			if($num_check_rights==0)
			{
				$rdata['ar_user_owner_id'] = $admin_id;
				$rdata['ar_current_rights'] = '{1:1,1,1,1}*';
				$rdata['ar_history_rights'] = '{1:1,1,1,1}*';
				$rdata['createddt']         = $datetime;
		    	$rdata['createdby']         = $uid;
				insert('tbl_assign_rights',$rdata);
			}
			///=========Start Insertion For Panel Login Satish 24082017==============//
			
			$cdata['cust_name']         = $row_check_parent['vendor_name'];
			$cdata['cust_email']        = $row_check_parent['vendor_email'];
			$cdata['cust_emailstatus']  = 1;
			$cdata['cust_mobile']       = $row_check_parent['vendor_mobile'];
			$cdata['cust_mobilestatus'] = 1;
			$cdata['cust_password']         = $row_check_parent['vendor_password'];
			$cdata['cust_salt']        = $row_check_parent['vendor_salt'];
			$cdata['cust_status']      	  = $row_check_parent['vendor_status'];
			
			
			$cdata['cust_created']       = $datetime;
			$cdata['cust_created_by']  = $uid;
			
			//insert('tbl_customer',$cdata);
			
		}
		else
		{
		    
		    $sql_get_id =" SELECT id FROM tbl_cadmin_users WHERE email='".$data['email']."'";
		    $res_get_id = mysqli_query($db_con,$sql_get_id) or die(mysqli_error($db_con));
		    $row_get_id = mysqli_fetch_array($res_get_id);
		    
		    $sql_check_rights = " SELECT * FROM tbl_assign_rights WHERE ar_user_owner_id like '".$row_get_id['id']."'";
			$res_check_rights = mysqli_query($db_con,$sql_check_rights) or die(mysqli_error($db_con));
			$num_check_rights = mysqli_num_rows($res_check_rights);
			if($num_check_rights==0)
			{
				$rdata['ar_user_owner_id'] = $row_get_id['id'];
				$rdata['ar_current_rights'] = '{1:1,1,1,1}*{14:1,1,1,1}*{69:1,1,1,1}*';
				$rdata['ar_history_rights'] = '{1:1,1,1,1}*{14:1,1,1,1}*{69:1,1,1,1}*';
				$rdata['createddt']         = $datetime;
		    	$rdata['createdby']         = $uid;
				insert('tbl_assign_rights',$rdata);
			}
			update('tbl_cadmin_users',array('status'=>$curr_status),$data);
		}
		$sql_check_user = " SELECT * FROM tbl_customer WHERE cust_email like '".$row_check_parent['vendor_email']."'";
		$res_check_user = mysqli_query($db_con,$sql_check_user) or die(mysqli_error($db_con));
		$num_check_user = mysqli_num_rows($res_check_user);
		if($num_check_user==0)
		{
		    $cdata['cust_name']         = $row_check_parent['vendor_name'];
			$cdata['cust_email']        = $row_check_parent['vendor_email'];
			$cdata['cust_emailstatus']  = 1;
			$cdata['cust_mobile']       = $row_check_parent['vendor_mobile'];
			$cdata['cust_mobilestatus'] = 1;
			$cdata['cust_password']     = $row_check_parent['vendor_password'];
			$cdata['cust_salt']         = $row_check_parent['vendor_salt'];
			$cdata['cust_status']       = $row_check_parent['vendor_status'];
			$cdata['cust_vendorid']     = $row_check_parent['vendor_id'];
			
			$cdata['cust_created']      = $datetime;
			$cdata['cust_created_by']   = $uid;
			
			//insert('tbl_customer',$cdata);
			$cdata['cust_type']        = 'trader';
		///=========End Insertion For Panel Lgin Satish 24082017==============//
		////////////////////////////////////////////////////////////////////////
		}
		else
		{
			$cdata['cust_name']         = $row_check_parent['vendor_name'];
			$cdata['cust_email']        = $row_check_parent['vendor_email'];
			$cdata['cust_emailstatus']  = 1;
			$cdata['cust_mobile']       = $row_check_parent['vendor_mobile'];
			$cdata['cust_mobilestatus'] = 1;
			$cdata['cust_password']     = $row_check_parent['vendor_password'];
			$cdata['cust_salt']           = $row_check_parent['vendor_salt'];
			$cdata['cust_status']      	  = $row_check_parent['vendor_status'];
			
			$cdata['cust_modified']       = $datetime;
			$cdata['cust_modified_by']  = $uid;
			$cdata['cust_type']        = 'trader';
			
			update('tbl_customer',$cdata,array('cust_email'=>$row_check_parent['vendor_email']));
		}
		
		//////////////////////////////////////////////////////////////////////////
		///=========Start Updation For Buyer Login Satish 24082017==============//
		
		update('tbl_customer',array('cust_status'=>$curr_status),array('cust_vendorid'=>$row_check_parent['vendor_id']));
		
		///=========End Updation For Buyer Lgin Satish 24082017==============//
		////////////////////////////////////////////////////////////////////////
	}
	else
	{
		//update('tbl_customer',array('cust_status'=>$curr_status),array('cust_vendorid'=>$row_check_parent['vendor_id']));
	}
	
	$sql_update_status 		= " UPDATE `tbl_vendor` SET `vendor_status`= '".$curr_status."' ,`vendor_modified` = '".$datetime."' ,`vendor_modified_by` = '".$uid."' WHERE `vendor_id`='".$vendor_id."' ";
	$result_update_status 	= mysqli_query($db_con,$sql_update_status) or die(mysqli_error($db_con));
	if($result_update_status)
	{
		quit('Status Updated Successfully.',1);
	}
	else
	{
		quit('Status Update Failed.');
	}				
}

if((isset($obj->delete_customers)) == "1" && isset($obj->delete_customers))
{
	$response_array     = array();		
	$ar_customers_id 	= $obj->customers;
	$del_flag 		    = 0; 
	foreach($ar_customers_id as $cust_id)	
	{
		$sql_delete_customers		= " DELETE FROM `tbl_vendor` WHERE `vendor_id` = '".$cust_id."' ";
		$result_delete_customers	= mysqli_query($db_con,$sql_delete_customers) or die(mysqli_error($db_con));			
		if($result_delete_customers)
		{
			$del_flag = 1;	
		}			
	}
	
	if($del_flag == 1)
	{
		$response_array = array("Success"=>"Success","resp"=>"Record Deletion Success.");			
	}
	else
	{
		$response_array = array("Success"=>"fail","resp"=>"Record Deletion failed.");
	}		
	echo json_encode($response_array);	
}

if((isset($obj->reset_pass)) == "1" && isset($obj->reset_pass))
{   
    $cust_email 		= $obj->cust_email;
	if($cust_email != "")
	{
		$sql_check_user 		= " SELECT * FROM `tbl_customer` tc WHERE tc.`cust_email` = '".$cust_email."' ";
		$result_check_user		= mysqli_query($db_con,$sql_check_user) or die(mysqli_error($db_con));
		$num_rows_check_user 	= mysqli_num_rows($result_check_user); 
		if($num_rows_check_user == 0)
		{
			$response_array = array("Success"=>"fail","resp"=>"<b>".$cust_email."</b> this is not registered email id .");
		}
		else
		{
			$row_check_user 	= mysqli_fetch_array($result_check_user);
			$cust_mobile_num	= $row_check_user['cust_mobile_num'];
			$cust_email			= $row_check_user['cust_email'];
			$cust_fname			= $row_check_user['cust_fname'];
			$subject			= "Forgot Password mail";
			$cust_id			= $row_check_user['cust_id'];
			$cust_salt_value	= $row_check_user['cust_salt_value'];			
			$cust_created		= $row_check_user['cust_created'];				
			$cust_modified		= $row_check_user['cust_modified'];					
			$token				= md5($cust_id.$cust_salt_value.$cust_email.$cust_created.$cust_modified);
			$forget_password_url= $BaseFolder."/page-reset-password.php?userid=".$cust_id."&token=".$token;	
			
			$message_body	= '';
			$message_body .= '<table class="" data-module="main Content" height="100" width="100%" bgcolor="#e2e2e2" border="0" cellpadding="0" cellspacing="0">';
				$message_body .= '<tr>';
					$message_body .= '<td>';
						$message_body .= '<table data-bgcolor="BG Color" height="100" width="800" align="center" bgcolor="#EDEFF0" border="0" cellpadding="0" cellspacing="0">';
							$message_body .= '<tr>';
								$message_body .= '<td>';
									$message_body .= '<table data-bgcolor="BG Color 01" height="100" width="600" align="center" bgcolor="#ffffff" border="0" cellpadding="0" cellspacing="0">';
										$message_body .= '<tr>';
											$message_body .= '<td>';
												$message_body .= '<table height="100" width="520" align="center" border="0" cellpadding="0" cellspacing="0">';
													$message_body .= '<tr>';
														$message_body .= '<td data-bgcolor="Line Color" height="1" width="520" bgcolor="#cedcce"></td>';
													$message_body .= '</tr>';
													$message_body .= '<tr>';
														$message_body .= '<td height="100" width="520">';
															$message_body .= '<table align="center" width="520" border="0" cellpadding="0" cellspacing="0">';
																$message_body .= '<tr>';
																	$message_body .= '<td data-color="Title" data-size="Title" data-min="10" data-max="30" style="font-weight:bold; letter-spacing: 0.025em; font-size:20px; color:#494949; font-family:\'Open Sans\', sans-serif; mso-line-height-rule: exactly;" align="center">  Password Recovery <br></td>';
																$message_body .= '</tr>';
																$message_body .= '<tr>';
																	$message_body .= '<td data-color="Title" data-size="Title" data-min="10" data-max="30" style="font-size:14px; color:#494949; font-family:\'Open Sans\', sans-serif; align="left"><br>Dear '.ucwords($cust_fname).',<br></td>';
																$message_body .= '</tr>';
																$message_body .= '<tr>';
																	$message_body .= '<td>';
																		$message_body .= '<table data-bgcolor="Color Button 01" class="table-button230-center" style="border-radius: 900px; " height="36" width="230" align="center" bgcolor="#5bbc2e" border="0" cellpadding="0" cellspacing="0">';
																			$message_body .= '<tr>';
																				$message_body .= '<td style="padding: 5px 5px; margin-bottom:20px;font-weight:bold; font-size:15px; color:#ffffff; letter-spacing: 0.005em; font-family:\'Open Sans\', sans-serif; mso-line-height-rule: exactly; text-decoration: none;" valign="middle" align="center"><a data-color="Text Button 01" data-size="Text Button 01" data-min="6" data-max="20" href="'.$forget_password_url.'" style="font-weight:bold; font-size:15px; color:#ffffff; letter-spacing: 0.005em; font-family:\'Open Sans\', sans-serif; mso-line-height-rule: exactly; text-decoration: none;">Reset Password</a></td>';//Here\'s the link to change your password as per your request.</a></td>';
																			$message_body .= '</tr>';
																		$message_body .= '</table>';
																	$message_body .= '</td>';
																$message_body .= '</tr>';
																$message_body .= '<tr>';
																	$message_body .= '<td data-color="Name" data-size="Name" align="left"> <br>We have received your request for a new password.<br>';
																	$message_body .= '</td>';
																$message_body .= '</tr>';
															$message_body .= '</table>';
														$message_body .= '</td>';
													$message_body .= '</tr>';
													$message_body .= '<tr>';
														$message_body .= '<td data-color="Name" data-size="Name" align="left" style="color:#ccc;"><br> You didn\'t request for a new password? Please write to <a href="mailto:support@idb.com">support@idb.com</a> immediately. <br>';
														$message_body .= '</td>';
													$message_body .= '</tr>';			
													$message_body .= '<tr>';
														$message_body .= '<td data-bgcolor="Line Color" height="1" width="520" bgcolor="#cedcce"></td>';
													$message_body .= '</tr>';			
												$message_body .= '</table>';
											$message_body .= '</td>';
										$message_body .= '</tr>';
									$message_body .= '</table>';
								$message_body .= '</td>';
							$message_body .= '</tr>';
						$message_body .= '</table>';
					$message_body .= '</td>';
				$message_body .= '</tr>';
			$message_body .= '</table>';			
					
			$message = mail_template_header()."".$message_body."".mail_template_footer();
			//$message 					= mail_template_header()."".$message_body."".mail_template_footer();
			// sendEmail($cust_email,$subject,$message);
			//$email_message		.= "Please <a href='".$forget_password_url."'>click here</a> to reset password.";
			//if(sendEmail($cust_email,$subject,$message))
			if($cust_email)
			{	
				$res_insert_into_tbl_notification	= '';
				
				
				$response_array = array("Success"=>"Success","resp"=>"<div style='color:green;' align='center'><h4>Please Check your email.</h4></div>");
			}
			else
			{
				$response_array = array("Success"=>"fail","resp"=>"Email not sent please try after sometime");
			}
		}
	}
	else
	{			
		$response_array = array("Success"=>"fail","resp"=>"Email Id Blank");
	}
	$response_array = array("Success"=>"Success","resp"=>"Password Changed Successfully");			
	echo json_encode($response_array);	
}

if((isset($obj->update_comments)) == "1" && isset($obj->update_comments))
{
    $comment  = $obj->comment;
	$cust_id  = $obj->cust_id;
	$response_array = array();
	$sql_update_comment = " UPDATE `tbl_vendor` SET `vendor_comment`='".$comment."' WHERE vendor_id ='".$cust_id."' ";
	$res_update_comment = mysqli_query($db_con,$sql_update_comment) or die(mysqli_error($db_con));
	if($res_update_comment)
	{
		$response_array = array("Success"=>"Success","resp"=>$sql_update_comment);
	}
	else
	{
		$response_array = array("Success"=>"fail","resp"=>"");
	}
	echo json_encode($response_array);
}

if((isset($obj->update_starstatus)) == "1" && isset($obj->update_starstatus))
{
    $status  = $obj->status;
	$cust_id  = $obj->cust_id;
	$response_array = array();
	$sql_update_star = " UPDATE `tbl_vendor` SET `vendor_star`='".$status."' WHERE vendor_id ='".$cust_id."' ";
	$res_update_star = mysqli_query($db_con,$sql_update_star) or die(mysqli_error($db_con));
	if($res_update_star)
	{
		$response_array = array("Success"=>"Success","resp"=>'');
	}
	else
	{
		$response_array = array("Success"=>"fail","resp"=>"");
	}
	echo json_encode($response_array);
}


if(isset($_POST['insert_vendor']) && $_POST['insert_vendor']!='')
{
		$data['vendor_type']  	   =  sqlInjection('trader');
		$data['vendor_email']   	   =  sqlInjection($_POST['vendor_email']);
		$data['vendor_mobile']       =  sqlInjection($_POST['vendor_mobile']);
		$data['vendor_name']    	   =  sqlInjection($_POST['vendor_name']);
		$data['vendor_created']      =  $datetime;
		$data['vendor_created_by']   =  $uid;
		
		
		
		$cust_email_query			  = " SELECT * FROM tbl_vendor WHERE 1=1 ";
		$cust_email_status		      = randomString($cust_email_query, 'vendor_emailstatus',5,'email');
		$data['vendor_emailstatus']   = $cust_email_status;
		$data['vendor_status']   	  = 2;
		
		$salt   					= generateRandomString(5);
		$data['vendor_salt']        	= trim($salt);
		$password                   = generateRandomString(8);
		$data['vendor_password']   	= trim(md5($password.$salt));
		
		$sql_check_user =" SELECT * FROM tbl_vendor WHERE vendor_email='".$data['vendor_email']."' or vendor_mobile='".$data['vendor_mobile']."'";
	
		$res_check_user = mysqli_query($db_con,$sql_check_user) or die(mysqli_error($db_con));
		$num_check_user = mysqli_num_rows($res_check_user);
		if($num_check_user==0)
		{

			$vendor_id = insert('tbl_vendor',$data);
			$sql_check_user =" SELECT * FROM tbl_customer WHERE cust_email='".$data['vendor_email']."' ";
			$res_check_user = mysqli_query($db_con,$sql_check_user) or die(mysqli_error($db_con));
			$num_check_user = mysqli_num_rows($res_check_user);
			if($num_check_user==0)
			{
				$cdata['cust_vendorid'] = $vendor_id;
				$cdata['cust_name']		= strtolower($data['vendor_name']);
				$cdata['cust_email']    = $data['vendor_email'];
				$cdata['cust_mobile']	= $data['vendor_mobile'];
				$cdata['cust_password'] = $data['vendor_password'];
				$cdata['cust_salt']     = $data['vendor_salt'];
				$cdata['cust_emailstatus']   = 1;
				$cdata['cust_type']		= $data['vendor_type'];
				insert('tbl_customer',$cdata);

			}else
			{
				update('tbl_customer',array('cust_vendorid'=>$vendor_id),array('cust_email'=>$data['vendor_email']));
			}


			// =====================================================================================================
			// START : Sending the mail for Email Validation Dn By Prathamesh On 04092017 
			// =====================================================================================================
			$subject		= 'IDB - Email Verification';
			/* create body for Update mail message */			
			$message_body = '<table class="" data-module="main Content" height="347" width="100%" bgcolor="#e2e2e2" border="0" cellpadding="0" cellspacing="0">';
				$message_body .= '<tr>';
					$message_body .= '<td>';
						$message_body .= '<table data-bgcolor="BG Color" height="347" width="800" align="center" bgcolor="#EDEFF0" border="0" cellpadding="0" cellspacing="0">';
							$message_body .= '<tr>';
								$message_body .= '<td>';
									$message_body .= '<table data-bgcolor="BG Color 01" height="347" width="600" align="center" bgcolor="#ffffff" border="0" cellpadding="0" cellspacing="0">';
										$message_body .= '<tr>';
											$message_body .= '<td>';
												$message_body .= '<table height="347" width="520" align="center" border="0" cellpadding="0" cellspacing="0">';
													$message_body .= '<tr>';
														$message_body .= '<td data-bgcolor="Line Color" height="1" width="520" bgcolor="#cedcce"></td>';
													$message_body .= '</tr>';
													$message_body .= '<tr>';
														$message_body .= '<td height="345" width="520">';
															$message_body .= '<table height="300" width="520" align="center" border="0" cellpadding="0" cellspacing="0">';
																$message_body .= '<tr>';
																	$message_body .= '<td data-color="Title" data-size="Title" data-min="10" data-max="30" class="td-pad10" style="font-weight:bold; letter-spacing: 0.025em; font-size:20px; color:#494949; font-family:\'Open Sans\', sans-serif; mso-line-height-rule: exactly;" align="center">  Email Verification. </td>';
																$message_body .= '</tr>';
																$message_body .= '<tr>';
																	$message_body .= '<td data-color="Name" data-size="Name" data-min="8" data-max="30" class="td-pad10" style="font-weight:600; letter-spacing: 0.000em; line-height:20px; font-size:14px; color:#7f7f7f; font-family:\'Open Sans\', sans-serif; mso-line-height-rule: exactly;" align="left"> Dear '.ucwords($data[$type.'name']).', <br>';
																	$message_body .= '</td>';
																$message_body .= '</tr>';
																$message_body .= '<tr>';
																	$message_body .= '<td>';
																		$message_body .= '<table data-bgcolor="Color Button 01" class="table-button230-center" style="border-radius: 900px;" height="36" width="230" align="center" bgcolor="#5bbc2e" border="0" cellpadding="0" cellspacing="0">';
																			$message_body .= '<tr>';
																				$message_body .= '<td style="padding: 5px 5px; font-weight:bold; font-size:15px; color:#ffffff; letter-spacing: 0.005em; font-family:\'Open Sans\', sans-serif; mso-line-height-rule: exactly; text-decoration: none;" valign="middle" align="center"><a align="center" data-color="Text Button 01" data-size="Text Button 01" data-min="6" data-max="20" href="'.$BaseFolder.'/verify/'.$cust_email_status.'" style="font-weight:bold; font-size:15px; color:#ffffff; letter-spacing: 0.005em; font-family:\'Open Sans\', sans-serif; mso-line-height-rule: exactly; text-decoration: none;">Verify your Email</a></td>';
																			$message_body .= '</tr>';
																			
																		$message_body .= '</table>';
																	$message_body .= '</td>';
																$message_body .= '</tr>';
																$message_body .= '<tr>';
																				$message_body .= '<td style="padding: 5px 5px; font-weight:bold; font-size:15px; color:#; letter-spacing: 0.005em; font-family:\'Open Sans\', sans-serif; mso-line-height-rule: exactly; text-decoration: none;" valign="middle" align="center"> Your Password is '.$password.'</td>';
																$message_body .= '</tr>';
															$message_body .= '</table>';
														$message_body .= '</td>';
													$message_body .= '</tr>';
												$message_body .= '</table>';
											$message_body .= '</td>';
										$message_body .= '</tr>';			
										$message_body .= '<tr style="padding-top:10px;">';
											$message_body .= '<td data-color="Name" data-size="Name" data-min="8" data-max="30" class="td-pad10" style="letter-spacing: 0.000em; line-height:20px; font-size:14px; color:#7f7f7f; font-family:\'Open Sans\', sans-serif; mso-line-height-rule: exactly;" align="center"> We look forward to make your online shopping a wonderful experience';
											$message_body .= '<br>Please contact us should you have any questions or need further assistance.';
											$message_body .= '</td>';
										$message_body .= '</tr>';
										$message_body .= '<tr>';
											$message_body .= '<td data-bgcolor="Line Color" height="1" width="520" bgcolor="#cedcce"></td>';
										$message_body .= '</tr>';						
									$message_body .= '</table>';
								$message_body .= '</td>';
							$message_body .= '</tr>';
						$message_body .= '</table>';
					$message_body .= '</td>';
				$message_body .= '</tr>';
			$message_body .= '</table>';
			/* create body for Update mail message */
			/* create a mail template message*/
			$message = mail_template_header()."".$message_body."".mail_template_footer();
			
			//quit(array('Vendor added successfully...!',$vendor_id),1);
			if(sendEmail($data['vendor_email'],$subject,$message))
			{
			  
				$noti['type']			= 'Email_Verification_Mail';
				$noti['message']		= htmlspecialchars($message, ENT_QUOTES);
				$noti['user_email']		= $data['vendor_email'];
				$noti['user_mobile_num']= $data['vendor_mobile'];
				$noti['created_date']	= $datetime;
				
				$noti_data	= insert('tbl_notification',$noti);
			}
			else
			{
				quit('Email not sent please try after sometime');
			}

			quit(array('Vendor added successfully...!',$vendor_id),1);
			// =====================================================================================================
			// END : Sending the mail for Email Validation Dn By Prathamesh On 04092017 
			// =====================================================================================================
		}
		else
		{
			quit('Email or Mobile already Exist...!');
		}
}


?>