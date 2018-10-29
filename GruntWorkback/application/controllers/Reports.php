<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Reports extends CI_Controller 
{
    public function  __construct()
    {
		 
		 parent::__construct();
		 $this->load->model('Report_model');
		 $this->load->library('form_validation');
		 $this->load->helper('form');
		 $this->load->helper('url');
		 
    }
	public function index()
	{
		$this->load->view('layout/header');
		$this->load->view('reports');
		$this->load->view('layout/footer');
	}
	
	public function report()
	{
	    $this->load->model('Report_model');
		$data['reports'] = $this->Report_model->get_corporation_name();
		$data['driver'] = $this->Report_model->get_driver_name();
		$data['name'] = $this->Report_model->get_driver();
		$data['week'] = $this->Report_model->get_week();	
		$this->load->view('layout/header');
        $this->load->view('reports',$data);
        $this->load->view('layout/footer');
		
    }
    
    public function get_details()
    {
		   $this->load->model('Report_model');
		   $this->load->view('layout/header');
		   $this->load->view('reports');
		   $this->load->view('layout/footer');
    }
	
    public function order_details()
    {
		   $this->load->model('Report_model');
		   $this->load->view('layout/header');
		   $this->load->view('reports');
		   $this->load->view('layout/footer');
    }
	
	 public function test()
    {
		   
		   $this->load->view('layout/header');
		   
		   $this->load->view('test');
		  
    }
	
}
