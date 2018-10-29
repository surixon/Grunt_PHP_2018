<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Job_details extends CI_Controller 
{
    public function  __construct()
    {
		 
		 parent::__construct();
		 $this->load->model('Job_details_model');
		 $this->load->library('form_validation');
		 $this->load->helper('form');
		 $this->load->helper('url');
		 
    }
     public function index()
	{   
		if(isset($_SESSION['username']) && !empty($_SESSION['username']))
		{
		
			$this->load->view('layout/header');
			$this->load->view('job_details');
			$this->load->view('layout/footer');
		}
		else
		{
			$this->load->view('layout/header_login');
			$this->load->view('login');
			$this->load->view('layout/login_footer');
		}
		
	}
    
	public function get_jobs()
    {
			
       $this->load->model('Job_details_model');
       $this->load->view('layout/header');
	   $this->load->view('job_details');
	   $this->load->view('layout/footer');
   }  
   
   public function job_register()
    {
		
				$data = array(
	                  'employer_name' => $this->input->post('employer_name'),
	                  'job_title' => $this->input->post('job_title'),
	                  'description' => $this->input->post('description'),
	                  'job_type' => $this->input->post('job_type'),
	                  'duration' =>$this->input->post('duration'),
	                  'est_amount' =>$this->input->post('est_amount'),
	                  'datetime' =>$this->input->post('datetime'),
	                  'location' =>$this->input->post('location'),
	                  'success_rate' =>$this->input->post('success_rate'),
	                  'bonus' =>$this->input->post('bonus'),
	                  'rating' =>$this->input->post('rating')
		 			);
             
         
		 	$cat = $this->Job_details_model->insert_one_row('jobPost',$data); 
	      
		 	if($cat){
				    
					redirect('/Job_details');
					echo json_encode($cat);
			}
			else
			{
					
					redirect('/Job_details');
					echo json_encode($cat);


			}
		                           
    } 
    
     //Edit job
    public function edit_job() 
    {     
    	  $job_id = $this->uri->segment(3);
		  $result=$this->Job_details_model->editJob($job_id); 
		  if(!empty($result))
		  {
			  $this->load->view('layout/header');
			  $this->load->view('edit_job_details',$result);
			  $this->load->view('layout/footer');
		  }
		  else
		  {
			  $this->load->view('layout/header');
			  $this->load->view('job_details');
			  $this->load->view('layout/footer');
		  }
    } 
    
    //UPDATE
	
	public function updateJob()
    {
		$job_id = $this->input->post('job_id');
		//print_r($job_id);exit;
			$data = array(
	                  'employer_name' => $this->input->post('employer_name'),
	                  'job_title' => $this->input->post('job_title'),
	                  'description' => $this->input->post('description'),
	                  'job_type' => $this->input->post('job_type'),
	                  'duration' =>$this->input->post('duration'),
	                  'est_amount' =>$this->input->post('est_amount'),
	                  'datetime' =>$this->input->post('datetime'),
	                  'location' =>$this->input->post('location'),
	                  'success_rate' =>$this->input->post('success_rate'),
	                  'bonus' =>$this->input->post('bonus'),
	                  'rating' =>$this->input->post('rating')
		 			);
             
             
		 	$cat = $this->Job_details_model->update_record_by_id('jobPost',$data,array('job_id'=>$job_id)); 
		 	//print_r($this->db->last_query()); exit;
		 	if(!empty($cat)){
				    
					redirect('/Job_details');
			}
			else
			{
					
					redirect('/Job_details');

			}			                           
    }  
	
	public function deleteJob() 
	{
			$this->Job_details_model->jobDelete($this->input->post('job_id'));
			$output['job_id']=1;
			$output['message']="Job deleted successfully";
			echo json_encode($output);
	}
	
	public function job_detail()
	{
			
		$this->load->view('layout/header');
		$this->load->view('job_detail');
		$this->load->view('layout/footer');				
	}
	
	    
}
?>
