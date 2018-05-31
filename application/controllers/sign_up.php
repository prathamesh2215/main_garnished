<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sign_up extends CI_Controller {

	public function __construct(){
	    parent::__construct();
	    $this->load->model('signup_model');
	}

	public function index()
	{
		$data['title'] = 'Sign Up';
		$data['page']  = 'sign-up';
		$this->load->view('sign_up',$data);
	}

	public function about_us()
	{
		$this->session->userdata('user_name');
		$data['title'] = 'About';
		$data['page']  = 'about';
		$this->load->view('about-us',$data);
	}

	function getCompanies($srch_param)
	{
		$data['res']     = $this->signup_model->getCompanyData($srch_param);
		$data['success'] = true;
		echo json_encode($data); exit();
	}
}
