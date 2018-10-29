<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	public function  __construct()
    {
		 
		 parent::__construct();
		 $this->load->model('Login_model');
		 $this->load->library('form_validation');
		 $this->load->helper('form');
		 $this->load->helper('url');
		 
    }
    
	public function index()
	{   
		if(isset($_SESSION['username']) && !empty($_SESSION['username'])){
			$this->load->view('layout/header');
			$this->load->view('dashboard');
			$this->load->view('layout/footer');
		}
		else
		{
			$this->load->view('layout/header_login');
			$this->load->view('login');
			$this->load->view('layout/login_footer');
		}
		
	} 
	
	function logout()
	{
		     $this->session->sess_destroy();
             redirect('Login', 'refresh');
	}
	
	function user_login(){
		$clean = $this->security->xss_clean($this->input->post(NULL, TRUE));
		if(!empty($clean))
		{
			$result = $this->Login_model->checkUser($clean);
			if(!empty($result))
			{
				$_SESSION['username']=$result[0]->username;
			}
			echo json_encode($result);
		}
		else
		{
			$this->load->view('layout/header');
			$this->load->view('dashboard');
			$this->load->view('layout/footer');
		}
	}
	
    
	
}
