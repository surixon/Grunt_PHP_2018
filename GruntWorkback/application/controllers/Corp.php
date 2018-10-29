<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Corp extends CI_Controller 
{

    public function  __construct()
    {
		 
		 parent::__construct();
		 $this->load->model('Corp_model');
		 $this->load->library('form_validation');
		 $this->load->helper('form');
		 $this->load->helper('url');
		 
    }
    
	public function index()
	{
		if(isset($_SESSION['company_id']) && !empty($_SESSION['company_id'])){
			$this->load->view('layout/header');
			$this->load->view('corp');
			$this->load->view('layout/footer');
		}else{
			$this->load->view('layout/header_login');
			$this->load->view('login');
			$this->load->view('layout/login_footer');
		}
		
	}
	
	public function corp_register()
    {
		   if($this->Corp_model->isDuplicate($this->input->post('email')))
		   {
				$output['id']=-1;
				$output['message']="Email-Id already exist";
				echo json_encode($output);
		   }
		   else
		   {
				$clean = $this->security->xss_clean($this->input->post(NULL, TRUE));
				array_pop($clean);
				$this->Corp_model->insertCorporation($clean); 
				$output['id']=1;
				$output['message']="You have register  Successfully";
				echo json_encode($output);
		   }                        
      }
      
      public function get_details()
      {
		   $this->load->model('Corp_model');
		   $this->load->view('layout/header');
		   $this->load->view('corp');
		   $this->load->view('layout/footer');
      }
      
      //Edit corp
      public function edit_corp() 
      {
		  $result=$this->Corp_model->editCorporation($_REQUEST['corp_id']); 
		  if(!empty($result))
		  {
			  $this->load->view('layout/header');
			  $this->load->view('corporation_edit',$result);
			  $this->load->view('layout/footer');
		  }else{
			  $this->load->view('layout/header');
			  $this->load->view('corp');
			  $this->load->view('layout/footer');
		  }
	  }
	  
      	//EDIT
	  public function edit() 
      {
	
		$id=$_GET['id'];
				
		$dataArray=array();
				
		$output=$this->Corp_model->edit_data($id);
			
		$dataArray['id']=$id;
		$dataArray['corporation_name']=$output['corporation_name'];
		$dataArray['address']=$output['address'];
		$dataArray['city']=$output['city'];
		$dataArray['state']=$output['state'];
		$dataArray['zip']=$output['zip'];
		$dataArray['mobile']=$output['mobile'];
		$dataArray['account_id']=$output['account_id'];
		$dataArray['contact_name']=$output['contact_name'];
		$dataArray['email']=$output['email'];
		$dataArr["page_view"] = '';
		$dataArr["page_view"] =	$this->load->view('edit_corp', $dataArray, true);
					
		$this->load->view('edit_corp',$dataArr);
		
	}
	
		//UPDATE
	public function updateCorps() 
	{
			$result = $this->security->xss_clean($this->input->post(NULL, TRUE));
			$data=array('corporation_name'=>$result['corporation_name'],'address'=>$result['address'],'city'=>$result['city'],'state'=>$result['state'],'zip'=>$result['zip'],
					'mobile'=>$result['mobile'],'contact_name'=>$result['contact_name'],'email'=>$result['email'],'account_id'=>$result['account_id'],'discounted%'=>$result['discounted']);
			$this->Corp_model->updateCorp($data,$result['corp_id']); 
			$output['id']=1;
			$output['message']="Corp updated";
			echo json_encode($output);
	}
	
	
	//DELETE
	function corpDelete() 
	{
		$this->Corp_model->deleteCorp($this->input->post('id'));
		$output['id']=1;
		$output['message']="Corporation deleted successfully";
		echo json_encode($output);
	}
      
      
      
      
      
      
      
      
      
      
      
      
      
      
      
      
      
      
      
      
}
?>
