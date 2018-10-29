<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Price extends CI_Controller 
{
	public function  __construct()
    {
		 
		 parent::__construct();
		 $this->load->model('Price_model');
		 $this->load->library('form_validation');
		 $this->load->helper('form');
		 $this->load->helper('url');
		 
    }
    
	public function index()
	{
		if(isset($_SESSION['company_id']) && !empty($_SESSION['company_id'])){
			$result['suv_pricing']=$this->Price_model->getSUVPricing($_SESSION['company_id']); 
			$result['sedan_pricing']=$this->Price_model->getSedanPricing($_SESSION['company_id']);
			$this->load->view('layout/header');
			$this->load->view('price',$result);
			$this->load->view('layout/footer');
		}else{
			$this->load->view('layout/header_login');
			$this->load->view('login');
			$this->load->view('layout/login_footer');
		}
	}
	
	public function addSedanPricing()
    {
		
        $clean = $this->security->xss_clean($this->input->post());
        array_pop($clean);
        $clean['company_id']=$_SESSION['company_id'];
        $id = $this->Price_model->insertSedanPrice($clean); 
		$output['id']=1;
	    $output['message']="Pricing Added";
	    echo json_encode($output);
    }
    
	public function updateSedanPricing()
    {
        $clean = $this->security->xss_clean($this->input->post(NULL, TRUE));
        array_pop($clean);
		$id = $this->Price_model->updateSedanPrice($clean,$_SESSION['company_id']); 
		$output['id']=1;
	    $output['message']="Pricing Added";
	    echo json_encode($output);
    }
    
	public function addSuvPricing()
    {
		
        $clean = $this->security->xss_clean($this->input->post());
        array_pop($clean);
        $clean['company_id']=$_SESSION['company_id'];
        $id = $this->Price_model->insertSUVPrice($clean); 
		$output['id']=1;
	    $output['message']="Pricing Added";
	    echo json_encode($output);
    }
    
	public function updateSuvPricing()
    {
        $clean = $this->security->xss_clean($this->input->post(NULL, TRUE));
        array_pop($clean);
		$id = $this->Price_model->updateSUVPrice($clean,$_SESSION['company_id']); 
		$output['id']=1;
	    $output['message']="Pricing Updated";
	    echo json_encode($output);
    }
}
?>
