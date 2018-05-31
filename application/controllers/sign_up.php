<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sign_up extends CI_Controller {

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
}
