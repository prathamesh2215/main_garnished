<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Signup_model extends CI_Model {

	function getCompanyData($srch_param)
	{
		$resp_arr  = array();

		$this->db->select('*')->from('bank_details');
		// $this->db->where('status',1);
		$this->db->like('bank_ifsc',$srch_param,'both');
		$result = $this->db->get()->result_array();

		foreach ($result as $row) {
			array_push($resp_arr,$row);
		}
		return $resp_arr;
	}
}
