<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home_model extends CI_Model {

	function getCity()
	{
		$resp_arr  = array();

		$this->db->select('city_name,city_id')->from('tbl_address_master as tam ');
		$this->db->join('tbl_city as tc',' tam.add_city=tc.city_id');
		$this->db->where('add_status',1);
		$result = $this->db->get()->result_array();

		foreach ($result as $row) {
			array_push($resp_arr,$row);
		}
		return $resp_arr;
	}

	function getadd()
	{
		$resp_arr  = array();
		$data =  $this->input->post();

		$this->db->select('add_details')->from('tbl_address_master');
		$this->db->where('add_status',1);
		$this->db->where('add_city',$data['city_id']);
		$this->db->like('add_details',$data['search_key'],'both');
		$result = $this->db->get()->result_array();

		foreach ($result as $row) {
			array_push($resp_arr,$row);
		}
		return $resp_arr;
	}

	function getcomp()
	{
		$resp_arr  = array();
		$data =  $this->input->post();

		$this->db->select('comp_name')->from('tbl_companies');
		$this->db->where('comp_status',1);
		$this->db->where('comp_city',$data['city_id']);
		$this->db->like('comp_name',$data['search_key'],'both');
		$result = $this->db->get()->result_array();

		foreach ($result as $row) {
			array_push($resp_arr,$row);
		}
		return $resp_arr;
	}
}
