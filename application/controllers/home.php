<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	public function __construct(){
	    parent::__construct();
	    $this->load->model('home_model');
	}
	
	public function index()
	{
		$data['title']  = 'Home';
		$data['page']   = 'home';
		$data['cities'] =  $this->home_model->getCity();
		$this->load->view('index',$data);
	}

	public function about_us()
	{
		$this->session->userdata('user_name');
		$data['title'] = 'About';
		$data['page']  = 'about';
		$this->load->view('about-us',$data);
	}


	public function getAddress()
	{
		$data =  $this->home_model->getadd();
		echo json_encode($data);exit();
	}

	public function getCompany()
	{
		$data =  $this->home_model->getcomp();
		echo json_encode($data);exit();
	}
}
