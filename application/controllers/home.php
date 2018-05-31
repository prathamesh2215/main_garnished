<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	public function index()
	{
		$data['title'] = 'Home';
		$data['page']  = 'home';
		$this->load->view('index',$data);
	}

	public function about_us()
	{
		$this->session->userdata('user_name');
		$data['title'] = 'About';
		$data['page']  = 'about';
		$this->load->view('about-us',$data);
	}
}
