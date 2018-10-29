<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ticket extends CI_Controller 
{
    public function  __construct()
    {
		 
		 parent::__construct();
		 $this->load->model('Ticket_model');
		 $this->load->library('form_validation');
		 $this->load->helper('form');
		 $this->load->helper('url');
		 
    }
    public function index()
	{   
		if(isset($_SESSION['username']) && !empty($_SESSION['username']))
		{
		
			$this->load->view('layout/header');
			$this->load->view('tickets');
			$this->load->view('layout/footer');
		}
		else
		{
			$this->load->view('layout/header_login');
			$this->load->view('login');
			$this->load->view('layout/login_footer');
		}
		
	}
	
	
	public function user_detail()
	{
			
		$this->load->view('layout/header');
		$this->load->view('ticket_detail');
		$this->load->view('layout/footer');				
	}
}	
    
