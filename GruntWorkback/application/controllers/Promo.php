<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rating extends CI_Controller 
{
    public function  __construct()
    {
		 
		 parent::__construct();
		 $this->load->model('Rating_model');
		 $this->load->library('form_validation');
		 $this->load->helper('form');
		 $this->load->helper('url');
		 
    }
    
	public function get_borrower()
    {
			
       $this->load->model('Rating_model');
       $this->load->view('layout/header');
	   $this->load->view('rating');
	   $this->load->view('layout/footer');
   }
	
	     
}
?>
