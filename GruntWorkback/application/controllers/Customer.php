<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Customer extends CI_Controller {

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
			if(isset($_SESSION['company_id']) && !empty($_SESSION['company_id'])){
				$result['network_detail']=$this->Company_model->network_jobs_companies($_SESSION['company_id']); 
				$this->load->view('layout/header');
				$this->load->view('customer',$result);
				$this->load->view('layout/footer');
			}else{
				$this->load->view('layout/header_login');
				$this->load->view('login');
				$this->load->view('layout/login_footer');
			}
		//~ 
	 }
	 
	 public function company()
     {
			 $config =  array(
                  'upload_path'     => "./uploads/",
                  'allowed_types'   => "gif|jpg|png|jpeg|pdf",
                  'overwrite'       => TRUE,
                  'max_size'        => "2048000",  // Can be set to particular file size
                  'max_height'      => "768",
                  'max_width'       => "1024"  
                ); 
               $this->load->library('upload', $config);
               $datas = $this->upload->do_upload('manager_name');
               if($datas)
               {
               $data = array('upload_data' => $this->upload->data());
               print_r($data);
			   }else
			   {
				   $error = array('error' => $this->upload->display_errors());
					print_r($error);
				 }
               //~ $data = $this->input->post('manager_name');
               
           //~ $data = $this->input->post('manager_name');
           //~ print_r($data); 
		   //~ if($this->Company_model->isDuplicate($this->input->post('location_email')))
		   //~ {
				//~ $output['id']=-1;
				//~ $output['message']="Email-Id already exist";
				//~ echo json_encode($output);
		   //~ }
		   //~ else if($this->Company_model->isDuplicateCabAlias($this->input->post('location_cab_alias')))
		   //~ {
				//~ $output['id']=-2;
				//~ $output['message']="Cab Alias already exist";
				//~ echo json_encode($output);
		   //~ }
		   //~ else
		   //~ {
				//~ $clean = $this->security->xss_clean($this->input->post(NULL, TRUE));
				//~ $this->Company_model->insertCompany($clean); 
				//~ $output['id']=1;
				//~ $output['message']="Location added successfully";
				//~ echo json_encode($output);
		   //~ }   
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
		   if($this->Company_model->isDuplicate($result['location_email']))
		   {
				$output['id']=-1;
				$output['message']="Email-Id already exist";
				echo json_encode($output);
		   }
		   //~ else if($this->Company_model->isDuplicateCabAlias($result['location_cab_alias']))
		   //~ {
				//~ $output['id']=-2;
				//~ $output['message']="Cab Alias already exist";
				//~ echo json_encode($output);
		   //~ }
		   else
		   {
			  $data=array('location_name'=>$result['location_name'],'location_address'=>$result['location_address'],'location_city'=>$result['location_city'],'location_state'=>$result['location_state'],'location_zip'=>$result['location_zip'],
					'location_telephone'=>$result['location_telephone'],'manager_name'=>$result['manager_name'],'location_email'=>$result['location_email'],'location_cab_alias'=>$result['location_cab_alias']);
			  $this->Company_model->updateCompany($data,$result['location_id']); 
			  $output['id']=1;
			  $output['message']="Location updated";
			  echo json_encode($output);
		  }
	  }
	  
      //UPDATE
      public function add_network_jobs_to_other_companies(){
		   $result = $this->security->xss_clean($this->input->post(NULL, TRUE));
		  $this->Company_model->add_network_jobs_to_other_companies($result,$_SESSION['company_id']); 
		  $output['id']=1;
		  $output['message']="Network Job Added";
		  echo json_encode($output);
		  
	  }
	  
	  //DELETE
	  function locationDelete() 
	  {
			$this->Company_model->delete_location_data($this->input->post('location_id'));
			$output['id']=1;
			$output['message']="Location deleted";
			echo json_encode($output);
	  }            
          
}
