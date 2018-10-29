<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller 
{
	
	public function  __construct()
    {
		 parent::__construct();
		 $this->load->model('Dashboard_model');
		 $this->load->library('form_validation');
		 $this->load->helper('form');
		 $this->load->helper('url'); 
    }

	public function index()
	{   
		if(isset($_SESSION['username']) && !empty($_SESSION['username']))
		{
		
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
	
	public function dash()
	{
	    $this->load->model('Dashboard_model');
		$data['drivers'] = $this->Dashboard_model->get_location_name();
		$data['driver'] = $this->Dashboard_model->get_driver_name();	
		$this->load->view('layout/header');
        $this->load->view('dashboard',$data);
        $this->load->view('layout/footer');
		
    }
    
    public function get_details()
   {
			
       $this->load->model('Dashboard_model');
       $this->load->view('layout/header');
	   $this->load->view('dashboard');
	   $this->load->view('layout/footer');
   }
   
   public function get_users()
   {
			
       $this->load->model('Dashboard_model');
       $this->load->view('layout/header');
	   $this->load->view('dashboard');
	   $this->load->view('layout/footer');
   }
    
    public function get_transaction()
   {
			
       $this->load->model('Dashboard_model');
       $this->load->view('layout/header');
	   $this->load->view('dashboard');
	   $this->load->view('layout/footer');
   } 
   
   public function cancel_orders()
   {
			
       $this->load->model('Dashboard_model');
       $this->load->view('layout/header');
	   $this->load->view('dashboard');
	   $this->load->view('layout/footer');
   }
   public function get_adminCommission()
   {
			
       $this->load->model('Dashboard_model');
       $this->load->view('layout/header');
	   $this->load->view('dashboard');
	   $this->load->view('layout/footer');
   }
    
    public function getDates()
    {
		   $this->load->model('Dashboard_model');
		   $this->load->view('layout/header');
		   $this->load->view('dashboard');
		   $this->load->view('layout/footer');
    }
    
    public function cancel_orders_update()
    {
		$this->load->model('Dashboard_model');
		$data['Orders'] = $this->Dashboard_model->cancel_orders();
		echo $data['Orders'][0]['id'];
    }
    
    public function get_transaction_update()
    {
		$this->load->model('Dashboard_model');
		$data['Orders'] = $this->Dashboard_model->get_transaction();
		echo $data['Orders'][0]['id'];
    }
    
    public function get_users_update()
    {
		$this->load->model('Dashboard_model');
		$data['Orders'] = $this->Dashboard_model->get_users();
		echo $data['Orders'][0]['id'];
		
    }
	
}
