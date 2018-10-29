<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class UserLog extends CI_Controller 
{
    public function  __construct()
    {
		 
		 parent::__construct();
		 $this->load->model('UserLog_model');
		 $this->load->library('form_validation');
		 $this->load->helper('form');
		 $this->load->helper('url');
		 
    }
	public function get_logs()
    {
			
       $this->load->model('UserLog_model');
       $this->load->view('layout/header');
	   $this->load->view('user_logs');
	   $this->load->view('layout/footer');
   } 
}
?>
