<?php
include("include/routines.php");

$json 		= file_get_contents('php://input');
$obj 		= json_decode($json);
$uid		= $_SESSION['panel_user']['id'];
$utype		= $_SESSION['panel_user']['utype'];
/* Mail On Order */


function sendOrderEmailVendor($ord_id,$type)
{
	global $db_con;
	$BaseFolder 		= "http://www.planeteducate.com/";
	global $date;
	global $min_order_value;
	global $shipping_charge;
	/*Select last Order and Details*/	
	$sql_get_vendor_info		= " SELECT distinct org_id,org_name,org_primary_email,org_secondary_email,org_primary_phone,org_secondary_phone,ord_created FROM `tbl_oraganisation_master` tom,`tbl_products_master` tpm,`tbl_cart` tc,`tbl_order` tord ";
	$sql_get_vendor_info		.= " where tom.org_id = tpm.prod_orgid and tpm.prod_id = tc.cart_prodid and tc.cart_orderid = tord.ord_id  ";
	if($type == 1)
	{
		$sql_get_vendor_info		.= " and cart_id = '".$ord_id."' ";
	}
	else if($type == 0)
	{
		$sql_get_vendor_info		.= " and tord.ord_id = '".$ord_id."' ";
	}
	$result_get_vendor_info		= mysqli_query($db_con,$sql_get_vendor_info) or die(mysqli_error($db_con));
	$num_rows_get_vendor_info 	= mysqli_num_rows($result_get_vendor_info);
	if($num_rows_get_vendor_info != 0)
	{			
		while($row_get_vendor_info	= mysqli_fetch_array($result_get_vendor_info))
		{
			$vendor_id				= $row_get_vendor_info['org_id'];
			$vendor_name			= $row_get_vendor_info['org_name'];
			$vendor_primary_email 	= $row_get_vendor_info['org_primary_email'];
			$vendor_secondary_email = $row_get_vendor_info['org_secondary_email'];
			$order_created			= $row_get_vendor_info['order_created'];
			$ord_id_show			= $row_get_vendor_info['ord_id_show'];
						
			$sql_order_details 		= " SELECT * FROM `tbl_order` WHERE `ord_id` =  '".$ord_id."' ";
			$result_order_details 	= mysqli_query($db_con,$sql_order_details) or die(mysqli_error($db_con));
			$row_order_details		= mysqli_fetch_array($result_order_details);
			$order_cust_id			= $row_order_details['ord_custid'];
			$order_add_id			= $row_order_details['ord_addid'];
			$ord_pay_type			= $row_order_details['ord_pay_type'];
				
			$sql_get_cart_details 	= " SELECT * FROM `tbl_products_master` tpm,`tbl_cart` tc,`tbl_order` tord where ";
			$sql_get_cart_details 	.= " tpm.prod_id = tc.cart_prodid and tc.cart_orderid = tord.ord_id and ";
			$sql_get_cart_details 	.= " tord.ord_id  = '".$ord_id."' and tpm.prod_orgid = '".$vendor_id."' "; 
			$result_get_cart_details = mysqli_query($db_con,$sql_get_cart_details) or die(mysqli_error($db_con));
			$order_data				.='<style>th, td { border-bottom: 1px solid #ddd;}</style>';
			$order_data				= '<table style="width:100%;">';
			$order_data				.= '<thead>';
			$order_data				.= '<th align="center" valign="top" style="width="30%">Product</th>';
			$order_data				.= '<th align="center" valign="top" style="width="30%">Name</th>';	
			$order_data				.= '<th align="center" valign="top" style="width="15%">Price</th>';
			$order_data				.= '<th align="center" valign="top" style="width="10%">Quantity</th>';
			$order_data				.= '<th align="center" valign="top" style="width="15%">Total</th>';	
			$order_data				.= '</thead>';
			$order_data				.= '<tbody>';
			$cart_total				= 0;			
			while($row_get_cart_details = mysqli_fetch_array($result_get_cart_details))
			{
				$sql_get_product_details 	= " SELECT `prod_id`, `prod_model_number`, `prod_name`, `prod_orgid`, `prod_brandid`, `prod_catid`,`prod_subcatid`,`prod_status`, ";
				$sql_get_product_details 	.= " (SELECT `prod_img_file_name` FROM `tbl_products_images` WHERE `prod_img_prodid` = tpm.prod_id and prod_img_type = 'main') as prod_img_file_name  FROM `tbl_products_master` tpm WHERE prod_id = '".$row_get_cart_details['cart_prodid']."' ";
				$result_get_product_details = mysqli_query($db_con,$sql_get_product_details) or die(mysqli_error($db_con));
				$row_get_product_details 	= mysqli_fetch_array($result_get_product_details);
				$prod_imagepath				= $BaseFolder."images/planet/org".$row_get_product_details['prod_orgid']."/cat".$row_get_product_details['prod_catid']."/subcat".$row_get_product_details['prod_subcatid']."/prod".$row_get_product_details['prod_id']."/small/".$row_get_product_details['prod_img_file_name'];
				$product_name				= ucwords($row_get_product_details['prod_name']);		
				$order_data				.= '<tr>';
				$order_data				.= '<td align="center" valign="top" width="30%">';
				$order_data				.= '<img src="'.$prod_imagepath.'" alt="'.$product_name.'">';
				$order_data				.= '</td>';		
				$order_data				.= '<td align="center" valign="top" width="30%">';		
				$order_data 			.= '<span>'.$product_name.'</span>';
				$order_data				.= '</td>';
				$order_data				.= '<td align="center" valign="top" width="15%">';
				$order_data				.= $row_get_cart_details['cart_price'];
				$order_data				.= '</td>';		
				$order_data				.= '<td align="center" valign="top" width="10%">';
				$order_data				.= $row_get_cart_details['cart_prodquantity'];
				$order_data				.= '</td>';		
				$order_data				.= '<td align="center" valign="top" width="15%">';
				$order_data				.= $row_get_cart_details['cart_price'];
				$order_data				.= '</td>';				
				$order_data				.= '</tr>';
				$cart_total 			+= (int)$row_get_cart_details['cart_price'];
			}
			$order_data					.= '<tr><td>&nbsp;</td>';	
			$order_data					.= '<td>&nbsp;</td>';	
			$order_data					.= '<td colspan="3">';			
			$order_data					.= '<table>';
			$order_data					.= '<tbody>';
			$order_data					.= '<tr><td><b>Item Subtotal:</b></td>';
			$order_data					.= '<td>:'.$cart_total.'</td></tr>';
			$order_data					.= '<tr><td><b>Shipping & Handling:</b></td>';
			if($cart_total > $min_order_value)
			{
				$order_data				.= '<td><span style="color:f00;">Free Shipping</span></td></tr>';		
				$shipping_charge 		= 0;		
			}
			else
			{
				$order_data				.= $shipping_charge;
				$shipping_charge 		= $shipping_charge;
			}	
			$order_total				= $cart_total+$shipping_charge;
			$order_data					.= '<tr><td><b>Order Total</b></td>';
			$order_data					.= '<td>:'.$order_total.'</td>';
			$order_data					.= '</tr>';	
			$order_data					.= '<tr><td><b>Order Payment Status</b></td>';
			if($ord_pay_type == 'Pay Online')
			{
				$order_data					.= '<td>:Prepaid</td>';								
			}
			else
			{
				$order_data					.= '<td>:'.$ord_pay_type.'</td>';
			}
			$order_data					.= '</tr>';	
			$order_data					.= '</tbody>';
			$order_data					.= '</table>';	
			$order_data					.= '<td></tr>';
			$order_data					.= '</tbody>';
			$order_data					.= '</table>';	
			$sql_get_cust_details  		= " SELECT `cust_id`, `cust_fname`, `cust_lname`, `cust_email`, `cust_mobile_num`,`add_details`,`add_pincode`,";
			$sql_get_cust_details  		.= " (SELECT `state_name` FROM `state` WHERE `state`=tam.`add_state`) as state_name,";
			$sql_get_cust_details  		.= " (SELECT `city_name` FROM `city` WHERE `city_id`=tam.`add_city`) as city_name";
			$sql_get_cust_details  		.= " FROM `tbl_customer` tc,`tbl_address_master` tam WHERE tc.`cust_id` = tam.add_user_id and ";
			$sql_get_cust_details  		.= " tam.add_user_type = 'customer' and tc.`cust_id` = '".$order_cust_id."' and tam.add_id = '".$order_add_id."' ";
			
			$result_get_cust_details	= mysqli_query($db_con,$sql_get_cust_details) or die(mysqli_error($db_con));
			$row_get_cust_details		= mysqli_fetch_array($result_get_cust_details);
			$cust_email					= $row_get_cust_details['cust_email'];
			$cust_fname					= $row_get_cust_details['cust_fname'];
			$cust_lname					= $row_get_cust_details['cust_lname'];
			$cust_details_address		= $row_get_cust_details['add_details'];
			$cust_city					= $row_get_cust_details['city_name'];
			$cust_pincode				= $row_get_cust_details['add_pincode'];
			$cust_state					= $row_get_cust_details['state_name'];
			$cust_mobile_num			= $row_get_cust_details['cust_mobile_num'];					
				
			$subject					= "Order request : ".$ord_id_show;
			$message_body				= "";
			$message_body 				.= '<table class="" data-module="main Content" height="100" width="100%" bgcolor="#e2e2e2" border="0" cellpadding="0" cellspacing="0">';
			$message_body 				.= '<tr>';
			$message_body 				.= '<td><table data-bgcolor="BG Color" height="100" width="800" align="center" bgcolor="#EDEFF0" border="0" cellpadding="0" cellspacing="0">';
			$message_body 				.= '<tr>';
			$message_body 				.= '<td><table data-bgcolor="BG Color 01" height="100" width="600" align="center" bgcolor="#ffffff" border="0" cellpadding="0" cellspacing="0">';
			$message_body 				.= '<tr>';
			$message_body 				.= '<td><table height="100" width="520" align="center" border="0" cellpadding="0" cellspacing="0">';
			$message_body 				.= '<tr>';
			$message_body 				.= '<td data-bgcolor="Line Color" height="1" width="520" bgcolor="#cedcce"></td>';
			$message_body 				.= '</tr>';
			$message_body 				.= '<tr>';
			$message_body 				.= '<td height="100" width="520"><table align="center" border="0" cellpadding="0" cellspacing="0">';
			$message_body 				.= '<tr>';
			$message_body 				.= '<td data-color="Title" data-size="Title" data-min="10" data-max="30" style="font-weight:bold; letter-spacing: 0.025em; font-size:20px; color:#494949; font-family:\'Open Sans\', sans-serif; mso-line-height-rule: exactly;" align="center"> Order Id : '.$ord_id_show.' </td>';
			$message_body 				.= '</tr>';
			$message_body 				.= '<tr>';
			$message_body 				.= '<td data-color="Title" data-size="Title" data-min="10" data-max="30" style="font-size:14px; color:#494949; font-family:\'Open Sans\', sans-serif; align="left">Hello '.ucwords($vendor_name).'<br><br></td>';		
			$message_body 				.= '</tr>';
			$message_body 				.= '<tr>';
			$message_body 				.= '<td data-color="Name" data-size="Name" align="left">This is to inform you that a new order has been placed from your storefront on <a href="'.$BaseFolder.'"><b>Planet Educate</b></a>.<br><br>';
			$message_body 				.= '</td>';
			$message_body 				.= '</tr>';
			$message_body 				.= '<tr>';
			$message_body 				.= '<td data-color="Name" data-size="Name" align="left"> <b>Order Summary:</b><br>Order ID : '.$ord_id_show.'<br>Purchased on  : '.$order_created.'<br><br> ';
			$message_body 				.= '</td>';
			$message_body 				.= '</tr>';			
			$message_body 				.= '<tr>';
			$message_body 				.= '<td data-color="Name" data-size="Name" align="left"> <b>Order will be shipped to:</b><br> '.ucwords($cust_fname." ".$cust_lname).':<br> '.'<b>Contact Details:</b><br>'.$cust_mobile_num.'<br>'.$cust_details_address.',<br>'.$cust_pincode.'<br>'.$cust_city.'<br>'.$cust_state.'<br><br>';
			$message_body 				.= '</td>';
			$message_body 				.= '</tr>';				
			$message_body 				.= '<tr><td data-bgcolor="Line Color" height="1" width="520" bgcolor="#cedcce"></td></tr>';
			$message_body 				.= '<tr>';
			$message_body 				.= '<td data-color="Name" data-size="Name" align="left">'.$order_data;
			$message_body 				.= '<br></td>';
			$message_body 				.= '</tr>';
			$message_body 				.= '<tr><td data-bgcolor="Line Color" height="1" width="520" bgcolor="#cedcce"></td></tr>';
			$message_body 				.= '<tr>';
			$message_body 				.= '<td data-color="Name" data-size="Name" align="left" style="color:#545252;"><br><br>';
			$message_body 				.= '<br>If you have any questions, please get in touch with us at <a href="mailto:support@planeteducate.com">support@planeteducate.com</a>';
			$message_body 				.= '</td>';
			$message_body 				.= '</tr>';
			$message_body 				.= '</table></td>';
			$message_body 				.= '</tr>';
			$message_body 				.= '<tr>';
			$message_body 				.= '<td data-bgcolor="Line Color" height="1" width="520" bgcolor="#cedcce"></td>';
			$message_body 				.= '</tr>';			
			$message_body 				.= '</table></td>';
			$message_body 				.= '</tr>';
			$message_body 				.= '</table></td>';
			$message_body 				.= '</tr>';
			$message_body 				.= '</table></td>';
			$message_body 				.= '</tr>';
			$message_body 				.= '</table>';				
			$message 					= mail_template_header()."".$message_body."".mail_template_footer();
			/*sendEmail($vendor_primary_email,$subject,$message);
			if(trim($vendor_secondary_email) != "")
			{
				sendEmail($vendor_secondary_email,$subject,$message);
			}
			if(trim($vendor_tertiary_email) != "")
			{
				sendEmail($vendor_tertiary_email,$subject,$message);
			}
			sendEmail('cynthia@planeteducate.com',$subject,$message);
			sendEmail('prog3.php@edmission.in',$subject,$message);			
			sendEmail('support@planeteducate.com',$subject,$message);*/
		}
	}
	return true;
	/*Select last Order and Details*/	
}
/* Mail On Order*/
/* Mail On Order */
function sendOrderMail($ord_id,$type)
{
	global $db_con;
	global $date;
	global $min_order_value;
	global $shipping_charge;
	$BaseFolder 			= "http://www.planeteducate.com/";	
	$mydate					= getdate(date("U"));
	$today_date				= "$mydate[weekday], $mydate[month] $mydate[mday], $mydate[year]";
	$date_expected_delivery	= getdate(date("U", strtotime('+7 days')));
	$expected_delivery_date	= "$date_expected_delivery[weekday], $date_expected_delivery[month] $date_expected_delivery[mday], $date_expected_delivery[year]";	
	
	/*Select last Order and Details*/
	$sql_order_details 		= " SELECT `ord_id`,`ord_id_show`,`ord_payment_id`, `ord_custid`, `ord_total`, `ord_discount`, `ord_shipping_charges`, `ord_status`, `ord_pay_type`, `ord_pay_status`, `ord_addid`, `ord_comment`, ";
	$sql_order_details 		.= " (SELECT `orstat_name` FROM `tbl_order_status` WHERE `orstat_id` = ord_pay_status) as orstat_name,ord_created ";	
	$sql_order_details 		.= " FROM `tbl_order` tord WHERE 1=1 ";
	if($type == 1)
	{
		$sql_order_details	.= " and tord.ord_id = (SELECT `cart_orderid` FROM `tbl_cart` WHERE `cart_id` = '".$ord_id."') ";
	}
	else if($type == 0)
	{
		$sql_order_details	.= " and tord.ord_id = '".$ord_id."' ";
	}		
	$result_order_details 	= mysqli_query($db_con,$sql_order_details) or die(mysqli_error($db_con));
	$row_order_details		= mysqli_fetch_array($result_order_details);
	$order_cust_id			= $row_order_details['ord_custid'];
	$order_add_id			= $row_order_details['ord_addid'];
	$order_created			= $row_order_details['ord_created'];
	$ord_id_show			= $row_order_details['ord_id_show'];
	if($type == 1)	
	{
		$sql_get_sub_order_status 		= " SELECT orstat_name FROM `tbl_cart` tc INNER JOIN `tbl_order_status` as tos ON tos.orstat_id = tc.`cart_status` where tc.`cart_id` = '".$ord_id."' "; // this is cart it i.e. sub order id
		$result_get_sub_order_status 	= mysqli_query($db_con,$sql_get_sub_order_status) or die(mysqli_error($db_con));	
		$row_get_sub_order_status		= mysqli_fetch_array($result_get_sub_order_status);
		$order_status					= ucwords($row_get_sub_order_status['orstat_name']);		
	}
	elseif($type == 0)
	{
		$order_status			= ucwords($row_order_details['orstat_name']);		
	}
		
	$sql_get_cart_details 			= " Select * from tbl_cart tc where 1=1 ";
	if($type == 1)	
	{
		$sql_get_cart_details 			.= " and tc.`cart_id` = '".$ord_id."' ";
	}	
	elseif($type == 0)	
	{
		$sql_get_cart_details 			.= " and tc.cart_orderid = '".$ord_id."' ";
	}
	$result_get_cart_details 		= mysqli_query($db_con,$sql_get_cart_details) or die(mysqli_error($db_con));
	$order_data						.='<style>th, td { border-bottom: 1px solid #ddd;}</style>';
	$order_data						= '<table style="width:100%;">';
	$order_data						.= '<thead>';
	$order_data						.= '<th align="center" valign="top" style="width="30%">Product</th>';
	$order_data						.= '<th align="center" valign="top" style="width="30%">Name</th>';	
	$order_data						.= '<th align="center" valign="top" style="width="15%">Price</th>';
	$order_data						.= '<th align="center" valign="top" style="width="10%">Quantity</th>';
	$order_data						.= '<th align="center" valign="top" style="width="15%">Total</th>';	
	$order_data						.= '</thead>';
	$order_data						.= '<tbody>';
	$cart_total						= 0;			
	while($row_get_cart_details = mysqli_fetch_array($result_get_cart_details))
	{
		$sql_get_product_details 	= " SELECT `prod_id`, `prod_model_number`, `prod_name`, `prod_orgid`, `prod_brandid`, `prod_catid`,`prod_subcatid`,`prod_status`, ";
		$sql_get_product_details 	.= " (SELECT `prod_img_file_name` FROM `tbl_products_images` WHERE `prod_img_prodid` = tpm.prod_id and prod_img_type = 'main') as prod_img_file_name  FROM `tbl_products_master` tpm WHERE prod_id = '".$row_get_cart_details['cart_prodid']."' ";
		$result_get_product_details = mysqli_query($db_con,$sql_get_product_details) or die(mysqli_error($db_con));
		$row_get_product_details 	= mysqli_fetch_array($result_get_product_details);
		$prod_imagepath				= $BaseFolder."images/planet/org".$row_get_product_details['prod_orgid']."/cat".$row_get_product_details['prod_catid']."/subcat".$row_get_product_details['prod_subcatid']."/prod".$row_get_product_details['prod_id']."/small/".$row_get_product_details['prod_img_file_name'];
		$product_name				= ucwords($row_get_product_details['prod_name']);		
		$order_data					.= '<tr>';
		$order_data					.= '<td align="center" valign="top" width="30%">';
		$order_data					.= '<img src="'.$prod_imagepath.'" alt="'.$product_name.'">';
		$order_data					.= '</td>';		
		$order_data					.= '<td align="center" valign="top" width="30%">';		
		$order_data 				.= '<span>'.$product_name.'</span>';
		$order_data					.= '</td>';
		$order_data					.= '<td align="center" valign="top" width="15%">';
		$order_data					.= $row_get_cart_details['cart_price'];
		$order_data					.= '</td>';		
		$order_data					.= '<td align="center" valign="top" width="10%">';
		$order_data					.= $row_get_cart_details['cart_prodquantity'];
		$order_data					.= '</td>';		
		$order_data					.= '<td align="center" valign="top" width="15%">';
		$order_data					.= $row_get_cart_details['cart_price'];
		$order_data					.= '</td>';				
		$order_data					.= '</tr>';
		$cart_total 				+= (int)$row_get_cart_details['cart_price'];
	}
	$order_data						.= '<tr><td>&nbsp;</td>';	
	$order_data						.= '<td>&nbsp;</td>';	
	$order_data						.= '<td colspan="3">';			
	$order_data						.= '<table>';
	$order_data						.= '<tbody>';
	$order_data						.= '<tr><td><b>Order Status:</b></td>';
	$order_data						.= '<td>:'.$order_status.'</td></tr>';	
	$order_data						.= '<tr><td><b>Item Subtotal:</b></td>';
	$order_data						.= '<td>:'.$cart_total.'</td></tr>';
	$order_data						.= '<tr><td><b>Shipping & Handling:</b></td>';
	if($cart_total > $min_order_value)
	{
		$order_data					.= '<td><span style="color:f00;">Free Shipping</span></td></tr>';		
		$shipping_charge 			= 0;		
	}
	else
	{
		$order_data					.= $shipping_charge;
		$shipping_charge 			= $shipping_charge;
	}
	$order_total					= $cart_total+$shipping_charge;
	$order_data						.= '<tr><td><b>Order Total</b></td>';
	$order_data						.= '<td>:'.$order_total.'</td>';
	$order_data						.= '</tr>';	
	$order_data						.= '</tbody>';
	$order_data						.= '</table>';	
	$order_data						.= '<td></tr>';
	$order_data						.= '</tbody>';
	$order_data						.= '</table>';	
	$sql_get_cust_details   		= " SELECT `cust_id`, `cust_fname`, `cust_lname`, `cust_email`, `cust_mobile_num`,`add_details`,`add_pincode`,";
	$sql_get_cust_details   		.= " (SELECT `state_name` FROM `state` WHERE `state`=tam.`add_state`) as state_name,";
	$sql_get_cust_details   		.= " (SELECT `city_name` FROM `city` WHERE `city_id`=tam.`add_city`) as city_name";
	$sql_get_cust_details   		.= " FROM `tbl_customer` tc,`tbl_address_master` tam WHERE tc.`cust_id` = tam.add_user_id and ";
	$sql_get_cust_details   		.= " tam.add_user_type = 'customer' and tc.`cust_id` = '".$order_cust_id."' and tam.add_id = '".$order_add_id."' ";
	$result_get_cust_details 		= mysqli_query($db_con,$sql_get_cust_details) or die(mysqli_error($db_con));
	$row_get_cust_details			= mysqli_fetch_array($result_get_cust_details);
	$cust_email						= $row_get_cust_details['cust_email'];
	$cust_fname						= $row_get_cust_details['cust_fname'];
	$cust_lname						= $row_get_cust_details['cust_lname'];
	$cust_details_address			= $row_get_cust_details['add_details'];
	$cust_city						= $row_get_cust_details['city_name'];
	$cust_pincode					= $row_get_cust_details['add_pincode'];
	$cust_state						= $row_get_cust_details['state_name'];
	
	$subject						= "Order :".$ord_id_show;
	$message_body					= "";
	$message_body 					.= '<table class="" data-module="main Content" height="100" width="100%" bgcolor="#e2e2e2" border="0" cellpadding="0" cellspacing="0">';
	$message_body 					.= '<tr>';
	$message_body 					.= '<td><table data-bgcolor="BG Color" height="100" width="800" align="center" bgcolor="#EDEFF0" border="0" cellpadding="0" cellspacing="0">';
	$message_body 					.= '<tr>';
	$message_body 					.= '<td><table data-bgcolor="BG Color 01" height="100" width="600" align="center" bgcolor="#ffffff" border="0" cellpadding="0" cellspacing="0">';
	$message_body 					.= '<tr>';
	$message_body 					.= '<td><table height="100" width="520" align="center" border="0" cellpadding="0" cellspacing="0">';
	$message_body 					.= '<tr>';
	$message_body 					.= '<td data-bgcolor="Line Color" height="1" width="520" bgcolor="#cedcce"></td>';
	$message_body 					.= '</tr>';
	$message_body 					.= '<tr>';
	$message_body 					.= '<td height="100" width="520"><table align="center" border="0" cellpadding="0" cellspacing="0">';
	$message_body 					.= '<tr>';
	$message_body 					.= '<td data-color="Title" data-size="Title" data-min="10" data-max="30" style="font-weight:bold; letter-spacing: 0.025em; font-size:20px; color:#494949; font-family:\'Open Sans\', sans-serif; mso-line-height-rule: exactly;" align="center"> Order Id : '.$ord_id_show.' </td>';
	$message_body 					.= '</tr>';
	$message_body 					.= '<tr>';
	$message_body 					.= '<td data-color="Title" data-size="Title" data-min="10" data-max="30" style="font-size:14px; color:#494949; font-family:\'Open Sans\', sans-serif; align="left">Dear, '.ucwords($cust_fname).'<br><br></td>';		
	$message_body 					.= '</tr>';
	/*	$message_body 					.= '<tr>';
	$message_body 					.= '<td data-color="Name" data-size="Name" align="left"> Thank you for shopping at <a href="'.$BaseFolder.'"><b>Planet Educate</b></a>. Your order has been placed successfully.  <a href="'.$BaseFolder.'"><br>';//<b>Planet Educate</b></a> is preparing your order for shipment.<br><br>';
	$message_body 					.= '</td>';
	$message_body 					.= '</tr>';
	$message_body 					.= '<tr>';
	$message_body 					.= '<td data-color="Name" data-size="Name" align="left"> Your order can be expected to arrive by: <br>'.$expected_delivery_date.'<br><br> ';
	$message_body 					.= '</td>';
	$message_body 					.= '</tr>';
	*/	$message_body 					.= '<tr>';
	$message_body 					.= '<td data-color="Name" data-size="Name" align="left"> <b>Order Summary:</b><br>Your Order ID : '.$ord_id_show.'<br>Purchased on  : '.$order_created.'<br><br> ';
	$message_body 					.= '</td>';
	$message_body 					.= '</tr>';			
	$message_body 					.= '<tr>';
	$message_body 					.= '<td data-color="Name" data-size="Name" align="left"> <b>Shipping Details:</b><br> '.ucwords($cust_fname." ".$cust_lname).':<br> '.$cust_details_address.',<br>'.$cust_pincode.'<br>'.$cust_city.'<br>'.$cust_state.'<br><br> ';
	$message_body 					.= '</td>';
	$message_body 					.= '</tr>';	
	$message_body 					.= '<tr><td data-bgcolor="Line Color" height="1" width="520" bgcolor="#cedcce"></td></tr>';									
	$message_body 					.= '<tr>';
	$message_body 					.= '<td data-color="Name" data-size="Name" align="left">'.$order_data;
	$message_body 					.= '<br></td>';
	$message_body 					.= '</tr>';
	$message_body 					.= '<tr><td data-bgcolor="Line Color" height="1" width="520" bgcolor="#cedcce"></td></tr>';											
	$message_body 					.= '<tr>';
	$message_body 					.= '<td data-color="Name" data-size="Name" align="left" style="color:#545252;">';//<br><br> You will receive a shipment confirmation mail once your order has shipped. ';
	$message_body 					.= '<br>If you have any questions, please get in touch with us at <a href="mailto:support@planeteducate.com">support@planeteducate.com</a>';
	$message_body 					.= '<br>We hope to see you again!!!<br><br>';
	$message_body 					.= '</td>';
	$message_body 					.= '</tr>';
	$message_body 					.= '</table></td>';
	$message_body 					.= '</tr>';
	$message_body 					.= '<tr>';
	$message_body 					.= '<td data-bgcolor="Line Color" height="1" width="520" bgcolor="#cedcce"></td>';
	$message_body 					.= '</tr>';			
	$message_body 					.= '</table></td>';
	$message_body 					.= '</tr>';
	$message_body 					.= '</table></td>';
	$message_body 					.= '</tr>';
	$message_body 					.= '</table></td>';
	$message_body 					.= '</tr>';
	$message_body 					.= '</table>';			
	
	$message 						= mail_template_header()."".$message_body."".mail_template_footer();	
	//$mail_response 					= sendEmail($cust_email,$subject,$message);
	//sendEmail('support@planeteducate.com',$subject,$message);
	return true;
	/*Select last Order and Details*/	
}
/* Mail On Order*/
/* This function will load all the orders of system.*/
if((isset($obj->load_orders)) == "1" && isset($obj->load_orders))
{
	$response_array = array();	
	$start_offset   = 0;
	
	$page 			= $obj->page;	
	$per_page		= $obj->row_limit;
	$search_text	= $obj->search_text;
	
	$daterange 			= $obj->daterange;	
	$start_date			= $obj->start_date;
	$end_date			= $obj->end_date;	
	
	if($page != "" && $per_page != "")	
	{
		$cur_page 						= $page;
		$page 	   	   					= $page - 1;
		$start_offset 					+= $page * $per_page;
		$start 							= $page * $per_page;
			
		$sql_load_data  				 = " SELECT * FROM tbl_cart as tc  ";
		$sql_load_data  				.= " INNER JOIN tbl_customer as tcs ON tc.cart_custid=tcs.cust_id  ";
		$sql_load_data  				.= " WHERE  cart_status=0 ";

		
		
		if($search_text != "")
		{
			
				
		}
		
		//////////// done by satish ////////////////////////////
		$sql_load_data 					.=" GROUP BY tcs.cust_id  ";
		$data_count						= dataPagination($sql_load_data,$per_page,$start,$cur_page);		
		$sql_load_data 					.=" ORDER BY cart_id   DESC LIMIT $start, $per_page  ";
		//echo json_encode(array("Success"=>"Success","resp"=>$sql_load_data));exit();
		$result_load_data = mysqli_query($db_con,$sql_load_data) or die(mysqli_error($db_con));					
		if(strcmp($data_count,"0") !== 0)
		{		
			$cart_data 				= "";	
			$cart_data 				.= '<table id="tbl_user" class="table table-bordered" style="width:100%;text-align:center">';
    	 	$cart_data 				.= '<thead>';
    	  	$cart_data 				.= '<tr>';
         	$cart_data 				.= '<th style="text-align:center">Sr No.</th>';
			$cart_data 				.= '<th style="text-align:center">Cust Id</th>';
			$cart_data 				.= '<th style="text-align:center">Customer Name</th>';
			$cart_data 				.= '<th style="text-align:center">Product</th>';
			//$cart_data 				.= '<th style="text-align:center">Order Status</th>';
          	$cart_data 				.= '</tr>';
      		$cart_data 				.= '</thead>';
      		$cart_data 				.= '<tbody>';
					
			$row_get_status				= array();
			while($row = mysqli_fetch_array($result_load_data))
			{				
				$cart_data 				.= '<tr>';
	         	$cart_data 				.= '<td style="text-align:center">'.++$start_offset.'</td>';
				$cart_data 				.= '<td style="text-align:center">'.$row['cust_id'].'</td>';
				$cart_data 				.= '<td style="text-align:center">'.ucwords($row['cust_name']).'</td>';

				$sql_get_prod 			 = " SELECT * FROM tbl_cart WHERE cart_custid='".$row['cart_custid']."' AND cart_status=0 ";
				$res_get_prod            = mysqli_query($db_con,$sql_get_prod) or die(mysqli_error($db_con));
				$num_get_prod 			 = mysqli_num_rows($res_get_prod);

				$cart_data 				.= '<td style="text-align:center"><a  onclick="getDetail('.$row['cart_custid'].')" href="javascript:void(0)">'.$num_get_prod.' Products</a></td>';
				
				$cart_data 				.= '</tr>';
			}
			
			
      		$cart_data 				.= '</tbody>';
      		$cart_data 				.= '</table>';	
			$cart_data 				.= $data_count;
			$response_array = array("Success"=>"Success","resp"=>$cart_data);					
		}
		else
		{
			$response_array = array("Success"=>"fail","resp"=>"No Data Available in Orders");
		}
	}
	else
	{
		$response_array = array("Success"=>"fail","resp"=>"No Row Limit and Page Number Specified");
	}
	echo json_encode($response_array);	
}

if((isset($obj->getDetail)) == "1" && isset($obj->getDetail))
{
	$cust_id  =	$obj->cust_id;
	
	$sql_get_prod   =" SELECT * FROM tbl_cart as tc ";
	$sql_get_prod  .=" INNER JOIN tbl_batches as tb ON tc.cart_batchid=tb.batch_id ";
	$sql_get_prod  .=" INNER JOIN tbl_products as tp ON tp.id=tb.prod_id ";
	$sql_get_prod  .=" WHERE tc.cart_status= 0 AND cart_custid='".$cust_id."'";
	$res_get_prod   = mysqli_query($db_con,$sql_get_prod) or die(mysqli_error($db_con));

	$prod_data 				.= '<table id="tbl_user" class="table table-bordered" style="width:100%;text-align:center">';
 	$prod_data 				.= '<thead>';
  	$prod_data 				.= '<tr>';
 	$prod_data 				.= '<th style="text-align:center">Sr No.</th>';
	$prod_data 				.= '<th style="text-align:center">Product Name</th>';
	$prod_data 				.= '<th style="text-align:center">Batch No.</th>';
	$prod_data 				.= '<th style="text-align:center">Price</th>';
	$prod_data 				.= '<th style="text-align:center">Added Date</th>';
	$prod_data 				.= '</tr>';
	$prod_data 				.= '</thead>';
	$prod_data 				.= '<tbody>';

	$i 						 = 1;
	while($row = mysqli_fetch_array($res_get_prod))
	{
		$prod_data 				.= '<tr>';
     	$prod_data 				.= '<td style="text-align:center">'.$i++.'</td>';
		$prod_data 				.= '<td style="text-align:center">'.ucwords($row['prod_name']).'</td>';
		$prod_data 				.= '<td style="text-align:center">'.$row['prod_batch_no'].'</td>';
		$prod_data 				.= '<td style="text-align:center">'.$row['prod_price'].'</td>';
		$prod_data 				.= '<td style="text-align:center">'.date('j F, Y',strtotime($row['cart_created'])).'</td>';
		$prod_data 				.= '</tr>';
	}

	$prod_data 				.= '</tbody>';
	$prod_data 				.= '</table>';	
	$prod_data 				.= $data_count;
	$response_array = array("Success"=>"Success","resp"=>$prod_data);	
	echo json_encode($response_array);	
}

?>