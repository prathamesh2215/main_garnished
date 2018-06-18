<?php
	include("include/routines.php");
	$json = file_get_contents('php://input');
	$obj = json_decode($json);
	
	$uid				= $_SESSION['panel_user']['id'];
	$utype				= $_SESSION['panel_user']['utype'];

	if((isset($obj->load_menus)) == "1" && isset($obj->load_menus))
	{
		$response_array = array();	
		$start_offset   = 0;
		
		$page 			= mysqli_real_escape_string($db_con,$obj->page);	
		$per_page		= mysqli_real_escape_string($db_con,$obj->row_limit);
		$search_text	= mysqli_real_escape_string($db_con,$obj->search_text);	
		$cat_parent		= mysqli_real_escape_string($db_con,$obj->cat_parent);		
		if($page != "" && $per_page != "")	
		{
			$cur_page     = $page;
			$page         = $page - 1;
			$start_offset += $page * $per_page;
			$start        = $page * $per_page;
				
			$sql_load_data  = " SELECT * FROM `tbl_menus` WHERE 1 ";
			
			if($utype == 4)
			{
				$sql_load_data  .= " AND created_by = '".$uid."' ";
			}

			if($search_text != "")
			{
				$sql_load_data .= " AND (menu_name LIKE '".$search_text."' OR menu_slug LIKE '".$search_text."' ";
				$sql_load_data .= " OR menu_description LIKE '".$search_text."') ";	
			}

			// $response_array = array("Success"=>"fail","resp"=>$sql_load_data);
			// echo json_encode($response_array);	
			// exit();

			$data_count		= dataPagination($sql_load_data,$per_page,$start,$cur_page);		
			$sql_load_data .= " ORDER BY sort_order ASC LIMIT $start, $per_page ";
			$result_load_data = mysqli_query($db_con,$sql_load_data) or die(mysqli_error($db_con));			
			if(strcmp($data_count,"0") !== 0)
			{		
				$menu_data = "";			
				
				$menu_data .= '<table id="tbl_menus" class="table table-bordered dataTable" style="width:100%;text-align:center">';
	    	 	$menu_data .= '<thead>';
	    	  	$menu_data .= '<tr>';
	         	$menu_data .= '<th class="center-text">Sr No.</th>';
				$menu_data .= '<th class="center-text">Menu ID</th>';
				$menu_data .= '<th style="width:20%">Menus</th>';
				$menu_data .= '<th style="width:6%;text-align:center">Sort Order</th>';
			    $dis = checkFunctionalityRight("view_menus.php",3);
				if($dis)
				{
					$menu_data .= '<th class="center-text">Status</th>';						
				}
				$edit = checkFunctionalityRight("view_menus.php",1);
				if($edit)
				{
					$menu_data .= '<th class="center-text">Edit</th>';
				}
				$del = checkFunctionalityRight("view_menus.php",2);
				if($del)
				{
					$menu_data .= '<th class="center-text">';
					$menu_data .= '<div class="center-text">';
					$menu_data .= '<input type="button"  value="Delete" onclick="multipleDelete();" class="btn-danger"/></div></th>';
				}
	          	$menu_data .= '</tr>';
	      		$menu_data .= '</thead>';
	      		$menu_data .= '<tbody>';
				while($row_load_data = mysqli_fetch_array($result_load_data))
				{
		    	  	$menu_data .= '<tr>';				
					$menu_data .= '<td class="center-text">'.++$start_offset.'</td>';				
					$menu_data .= '<td class="center-text">'.$row_load_data['id'].'</td>';
					$menu_data .= '<td style="width:20%">'.ucwords($row_load_data['menu_name']).'</td>';
					$menu_data .= '<td class="center-text">';				
						$menu_data .= '<div class="center-text">';
							$menu_data .= '<input type="text" value="'.$row_load_data['sort_order'].'" onchange="changesortorder(this.value,'.$row_load_data['id'].')">';					
						$menu_data .= '</div>';															
					$menu_data .= '</td>';
					
					$dis = checkFunctionalityRight("view_menus.php",3);
					if($dis)			
					{
						$menu_data .= '<td class="center-text">';	
						if($row_load_data['status'] == 1)
						{
							$menu_data .= '<input type="button" value="Active" id="'.$row_load_data['id'].'" class="btn-success" onclick="changeStatus(this.id,0);">';
						}
						else
						{
							$menu_data .= '<input type="button" value="Inactive" id="'.$row_load_data['id'].'" class="btn-danger" onclick="changeStatus(this.id,1);">';
						}
						$menu_data .= '</td>';	
					}
					$edit = checkFunctionalityRight("view_menus.php",1);				
					if($edit)
					{
						$menu_data .= '<td class="center-text">';
							$menu_data .= '<a href="edit_menus.php?menu_id='.$row_load_data['id'].'" class="btn-warning">Edit</a>';
						$menu_data .='</td>';
					}
					$del = checkFunctionalityRight("view_menus.php",2);
					if($del)				
					{    
					  
						$menu_data .= '<td>';
						
						$menu_data .=' <div class="controls" align="center">';					
						$menu_data .= '		<input type="checkbox" value="'.$row_load_data['id'].'" id="batch'.$row_load_data['id'].'" name="batch'.$row_load_data['id'].'" class="css-checkbox batch">';
						$menu_data .= '		<label for="batch'.$row_load_data['id'].'" class="css-label"></label>';
						$menu_data .= '	</div>';
						
						$menu_data .= '	</td>';										
					}
		          	$menu_data .= '</tr>';															
				}	
	      		$menu_data .= '</tbody>';
	      		$menu_data .= '</table>';	
				$menu_data .= $data_count;
				$response_array = array("Success"=>"Success","resp"=>$menu_data);					
			}
			else
			{
				$response_array = array("Success"=>"fail","resp"=>"No Data Available");
			}
		}
		else
		{
			$response_array = array("Success"=>"fail","resp"=>"No Row Limit and Page Number Specified");
		}
		echo json_encode($response_array);	
	}

	if((isset($_POST['hid_add_menus'])) == "1" && isset($_POST['hid_add_menus']))
	{
		$menu_name   = mysqli_real_escape_string($db_con,$_POST['menu_name']);
		$menu_status = mysqli_real_escape_string($db_con,$_POST['menu_status']);

		if($menu_name != "" && $menu_status != "")
		{
			$sql_get_order =" SELECT sort_order FROM tbl_menus ORDER BY sort_order DESC LIMIT 1";
			$res_get_order = mysqli_query($db_con, $sql_get_order) or die(mysqli_error($db_con));
			if(mysqli_num_rows($res_get_order) == 0)
			{
				$sort_order = 1;
			}
			else
			{
				$row_get_order = mysqli_fetch_array($res_get_order);
				$sort_order    = $row_get_order['sort_order'] + 1;
			}
			
			$sql_insert_faq	 = " INSERT INTO `tbl_menus`(`menu_name`, `sort_order`, `status`, `created_date`, `created_by`) VALUES ('".$menu_name."', '".$sort_order."', '".$menu_status."', '".$datetime."', '".$uid."') ";
			$res_insert_faq	 = mysqli_query($db_con, $sql_insert_faq) or die(mysqli_error($db_con));
			if($res_insert_faq)
			{
				$response_array = array("Success"=>"Success","resp"=>"Menu Added Successfully");
			}
			else
			{ 
			     $response_array = array("Success"=>"fail","resp"=>"Menu Not Added");
			}
		}
		else
		{
			$response_array = array("Success"=>"fail","resp"=>"Menu Information Required");
		}
		
		echo json_encode($response_array);		
	}

	if((isset($_POST['hid_edit_menus'])) == "1" && isset($_POST['hid_edit_menus']))
	{
		$hid_menu_id = $_POST['hid_menu_id'];
		$menu_name   = $_POST['menu_name'];
		$menu_status = $_POST['menu_status'];

		if($hid_menu_id != "" && $menu_name != "" && $menu_status != "")
		{
			$sql_update_menu	 = " UPDATE `tbl_menus` 
										SET `menu_name`='".$menu_name."',
									            `status`='".$menu_status."',
									            `modified_date`='".$datetime."',
									            `modified_by`='".$uid."' 
									WHERE `id`='".$hid_menu_id."' ";
			$res_update_menu	 = mysqli_query($db_con, $sql_update_menu) or die(mysqli_error($db_con));
			if($res_update_menu)
			{
				$response_array = array("Success"=>"Success","resp"=>"Menu Updated Successfully");
			}
			else
			{ 
			     $response_array = array("Success"=>"fail","resp"=>"Menu Not Updated");
			}
		}
		else
		{
			$response_array = array("Success"=>"fail","resp"=>"Menu Information is required");
		}
		echo json_encode($response_array);		
	}

	if((isset($obj->change_status)) == "1" && isset($obj->change_status))
	{
		$id               = mysqli_real_escape_string($db_con,$obj->menu_id);
		$curr_status      = mysqli_real_escape_string($db_con,$obj->curr_status);
		$response_array   = array();
		
		$status_flag      = 0;
		$sql_check_cat    = " Select * from tbl_menus where `id` = '".$id."' ";
		$result_check_cat = mysqli_query($db_con,$sql_check_cat) or die(mysqli_error($db_con));
		$num_check_cat    = mysqli_num_rows($result_check_cat);
		
		
		if($num_check_cat !=0)
		{
			$sql_update_status =" UPDATE tbl_menus 
									SET status='".$curr_status."',
										modified_date='".$datetime."',
										modified_by='".$uid."' 
								WHERE id ='".$id."' ";
			$res_update_status =mysqli_query($db_con, $sql_update_status) or die(mysqli_error($db_con));
			if($res_update_status)
			{
				$response_array = array("Success"=>"Success","resp"=>"Status Updated");
			}
			else
			{
				$response_array = array("Success"=>"fail","resp"=>"Menu Not Found.");
			}
		}
		else
		{
			$response_array = array("Success"=>"fail","resp"=>"Menu Not Found.");
		}
		echo json_encode($response_array);	
	}

	if((isset($obj->delete_menus)) == "1" && isset($obj->delete_menus))
	{
		$response_array = array();		
		$ar_id          = $obj->batch;
		$del_flag       = 0; 
		if(!empty($ar_id))
		{
			foreach($ar_id as $id)	
			{
					$sql_delete_menu =" DELETE FROM tbl_menus WHERE id ='".$id."' ";
					mysqli_query($db_con,$sql_delete_menu) or die(mysqli_error($db_con));
			}
			
			$response_array = array("Success"=>"Success","resp"=>"Record Deletion Success.");
		}
		else
		{
			$response_array = array("Success"=>"fail","resp"=>"Record Deletion failed.");
		}		
		echo json_encode($response_array);	
	}

	if((isset($obj->change_sort_order)) == "1" && isset($obj->change_sort_order))
	{
		$id                      = mysqli_real_escape_string($db_con,$obj->menu_id);
		$order                   =  $obj->new_order;
		$response_array          = array();		
		
		$sql_check_self_order    = " SELECT * from tbl_menus WHERE id = '".$id."' ";
		$result_check_self_order = mysqli_query($db_con,$sql_check_self_order) or die(mysqli_error($db_con));	
		$row_check_self_order    = mysqli_fetch_array($result_check_self_order);
		
		$sort_order              = $row_check_self_order['sort_order'];
		
		if($sort_order < $order)
		{
				$sql_check_order  ="SELECT  * FROM tbl_menus WHERE sort_order >".$sort_order."";
				$sql_check_order .=" AND sort_order <= ".$order." ";
				
				$res_check_order  =mysqli_query($db_con,$sql_check_order) or die(mysqli_error($db_con));
				while($row =mysqli_fetch_array($res_check_order))
				{
					$new_order =$row['sort_order']-1;
					$sql_update_order 		= " UPDATE `tbl_menus` SET `sort_order`= '".$new_order."'  WHERE `id` = '".$row['id']."' ";
		            $result_update_order 	= mysqli_query($db_con,$sql_update_order) or die($mysqli_error($db_con));
				}
				
			$sql_update_order 		= " UPDATE `tbl_menus` SET `sort_order`= '".$order."'  WHERE `id` = '".$id."' ";
		    $result_update_order 	= mysqli_query($db_con,$sql_update_order) or die(mysqli_error($db_con));	
			if($result_update_order)
			{  
			  
				$response_array = array("Success"=>"Success","resp"=>"Updation Success.");
			}
			 else 
			{
				$response_array = array("Success"=>"fail","resp"=>"Updation Failed.");
			}
		}
		else
		{
			    $sql_check_order  ="SELECT  * FROM tbl_menus WHERE sort_order >='".$order."'";
				$sql_check_order .=" AND sort_order <= '".$sort_order."' ";
				$res_check_order  =mysqli_query($db_con,$sql_check_order) or die(mysqli_error($db_con));
				while($row =mysqli_fetch_array($res_check_order))
				{
					$new_order =$row['sort_order']+1;
					$sql_update_order 		= " UPDATE `tbl_menus` SET `sort_order`= '".$new_order."'  WHERE `id` = '".$row['id']."' ";
		            $result_update_order 	= mysqli_query($db_con,$sql_update_order) or die($mysqli_error($db_con));
				}
				
			$sql_update_order 		= " UPDATE `tbl_menus` SET `sort_order`= '".$order."'  WHERE `id` = '".$id."' ";
		    $result_update_order 	= mysqli_query($db_con,$sql_update_order) or die($mysqli_error($db_con));
			
			if($result_update_order)
			{  
			  
				$response_array = array("Success"=>"Success","resp"=>"Updation Success.");
			}
			 else 
			{
				$response_array = array("Success"=>"fail","resp"=>"Updation Failed.");
			}
		}
		echo json_encode($response_array);	
	}
?>