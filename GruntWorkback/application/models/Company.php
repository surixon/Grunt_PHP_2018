<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Company extends CI_Controller {

	 public function  __construct()
     {
		 
		 parent::__construct();
		 $this->load->model('Company_model');
		 $this->load->library('form_validation');
		 $this->load->helper('form');
		 $this->load->helper('url');
		 
     }
	public function index()
	{
		
		$this->load->view('layout/header');
		$this->load->view('company');
		$this->load->view('layout/footer');
		
	}
	public function company()
    {
              
	   if($this->Company_model->isDuplicate($this->input->post('location_email')))
	   {
		    $output['id']=-1;
		    $output['message']="Email-Id already exist";
		    echo json_encode($output);
	   }
	   else if($this->Company_model->isDuplicateCabAlias($this->input->post('location_cab_alias')))
	   {
		    $output['id']=-2;
		    $output['message']="Cab Alias already exist";
		    echo json_encode($output);
	   }
	   else
	   {
			$clean = $this->security->xss_clean($this->input->post(NULL, TRUE));
			$this->Company_model->insertCompany($clean); 
			$output['id']=1;
		    $output['message']="Location added successfully";
		    echo json_encode($output);
	   }   
      }
      
       public function get_details()
      {
		   $this->load->model('company_model');
		   $this->load->view('layout/header');
		   $this->load->view('company');
		   $this->load->view('layout/footer');
      }
      
      //EDIT
      public function location_edit(){
		  $result=$this->Company_model->editCompany($_REQUEST['location_id']); 
		  if(!empty($result))
		  {
			  $this->load->view('layout/header');
			  $this->load->view('location_edit',$result);
			  $this->load->view('layout/footer');
		  }else{
			  $this->load->view('layout/header');
			  $this->load->view('company');
			  $this->load->view('layout/footer');
		  }
	  }
	  
      //UPDATE
      public function updateCompany(){
		  $result = $this->security->xss_clean($this->input->post(NULL, TRUE));
		  $data=array('location_name'=>$result['location_name'],'location_address'=>$result['address'],'location_city'=>$result['city'],'location_state'=>$result['state'],'location_zip'=>$result['zip'],
				'location_telephone'=>$result['telephone'],'manager_name'=>$result['manager_name'],'location_email'=>$result['email'],'location_cab_alias'=>$result['cab_alias']);
		  $result_data=$this->Company_model->updateCompany($data,$result['location_id']); 
		  echo "<pre>";print_r($result_data);echo"</pre>";
		  die;
		  if(!empty($result_data))
		  {
			  $this->load->view('layout/header');
			  $this->load->view('location_edit',$result_data);
			  $this->load->view('layout/footer');
		  }else{
			  $this->load->view('layout/header');
			  $this->load->view('company');
			  $this->load->view('layout/footer');
		  }
	  }
	  
	  public function edit() 
      {
	
		$company_id=$_GET['company_id'];
				
		$dataArray=array();
				
		$output=$this->Company_model->edit_data($company_id);
			
		$dataArray['company_id']=$company_id;
		$dataArray['location_name']=$output['location_name'];
		$dataArray['address']=$output['address'];
		$dataArray['city']=$output['city'];
		$dataArray['state']=$output['state'];
		$dataArray['zip']=$output['zip'];
		$dataArray['telephone']=$output['telephone'];
		$dataArray['manager_name']=$output['manager_name'];
		

		// $this->load->view('crud/edit_crud_view', $dataArray); // uncomment this code and comment all below if you don't want to display in the layout
		
		$dataArr["page_view"] = '';
		$dataArr["page_view"] =	$this->load->view('edit_company', $dataArray, true);	
		$this->load->view('edit_company',$dataArr);

	}
	
		//UPDATE
	public function update() 
	{
			if($_POST)
			{
				$company_id = $this->input->post('company_id');
				$data = array(
								'location_name' => $this->input->post('location_name'),
								'address' => $this->input->post('address'),
								'city' => $this->input->post('city'),
								'state' => $this->input->post('state'),
								'zip' => $this->input->post('zip'),
								'telephone' => $this->input->post('telephone'),
								'manager_name'=> $this->input->post('manager_name')
								
							);		
				$res=$this->Company_model->update_data($company_id, $data);		
				if ($res) 
				{
                        redirect('Company/company');
						die();
				}
					else 
					{
						echo "Error inserting data. Please contact system administrator";
						die();
					}
			} 	
	}
	
	
	//DELETE
	function delete() 
	{
		
		$company_id = $this->input->get('company_id');
		$this->Company_model->delete_data($company_id);
		
		redirect('Company/company');
		die();
	}            
          
}
