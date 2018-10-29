<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Log_users extends CI_Controller 
{
    public function  __construct()
    {
		 
		 parent::__construct();
		 $this->load->model('Log_users_model');
		 $this->load->library('form_validation');
		 $this->load->helper('form');
		 $this->load->helper('url');
		 
    }
    public function index()
	{   
		if(isset($_SESSION['username']) && !empty($_SESSION['username']))
		{
		
			$this->load->view('layout/header');
			$this->load->view('log_users');
			$this->load->view('layout/footer');
		}
		else
		{
			$this->load->view('layout/header_login');
			$this->load->view('login');
			$this->load->view('layout/login_footer');
		}
		
	}
    
	public function get_logs()
    {
			
       $this->load->model('Log_users_model');
       $this->load->view('layout/header');
	   $this->load->view('log_users');
	   $this->load->view('layout/footer');
   }     
}
?>
