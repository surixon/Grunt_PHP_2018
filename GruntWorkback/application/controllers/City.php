
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class City extends CI_Controller 
{
    public function  __construct()
    {
		 
		 parent::__construct();
		 $this->load->model('City_model');
		 $this->load->library('form_validation');
		 $this->load->helper('form');
		 $this->load->helper('url');
		 
    }
    
	public function index()
	{
		if(isset($_SESSION['username']) && !empty($_SESSION['username'])){
			$this->load->view('layout/header');
			$this->load->view('city');
			$this->load->view('layout/footer');
		}else{
			$this->load->view('layout/header_login');
			$this->load->view('login');
			$this->load->view('layout/login_footer');
		}
	}
	
	public function city_register()
    {
		
				$clean = $this->security->xss_clean($this->input->post(NULL, TRUE));
				$this->City_model->insertCity($clean); 
				
				$output['id']=1;
				$output['message']="New Location Added !";
				echo json_encode($output);
		                           
    }
    
    //Edit city
    public function edit_location() 
    {
		  $result=$this->City_model->editLocation($_REQUEST['id']); 
		  if(!empty($result))
		  {
			  $this->load->view('layout/header');
			  $this->load->view('edit_location',$result);
			  $this->load->view('layout/footer');
		  }
		  else
		  {
			  $this->load->view('layout/header');
			  $this->load->view('city');
			  $this->load->view('layout/footer');
		  }
    }  
    
    //UPDATE
	public function updateLocation() 
	{
			$result = $this->security->xss_clean($this->input->post(NULL, TRUE));
			$data=array('city_name'=>$result['city_name'],'location_name'=>$result['location_name'],'pin_code'=>$result['pin_code'],'commission'=>$result['commission']);
			$this->City_model->updateLocation($data,$result['id']); 
			
			$output['id']=1;
			$output['message']="Location updated successfully";
			echo json_encode($output);
	}  
	
	function locationDelete() 
	{
			$this->City_model->deleteLocation($this->input->post('id'));
			$output['id']=1;
			$output['message']="Promotion deleted successfully";
			echo json_encode($output);
	}      
}
?>
