<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Driver extends CI_Controller 
{
	 public function  __construct()
     {
		 
		 parent::__construct();
		 $this->load->model('Driver_model');
		 $this->load->model('Login_model');
		 $this->load->library('form_validation');
		 $this->load->helper('form');
		 $this->load->helper('url');
		 
     }
	
	public function index()
	{
		if(isset($_SESSION['company_id']) && !empty($_SESSION['company_id'])){
      $company_id = $_SESSION['company_id'];
			$result['Driver'] = $this->Driver_model->get_details($company_id);
			/*$result['vehicle_category'] = $this->Driver_model->vehicle_category();
			$result['location_result']=$this->Driver_model->fetchCompanyLocations($_SESSION['company_id']);*/
			$this->load->view('layout/header');
			$this->load->view('drivers',$result);
			$this->load->view('layout/footer');
		}else{
			$this->load->view('layout/header_login');
			$this->load->view('login');
			$this->load->view('layout/login_footer');
		}
	}
	
	public function driver_add()
    {
        $result['Driver'] = $this->Driver_model->get_details();
        $result['vehicle_category'] = $this->Driver_model->vehicle_category();
        $result['country'] = $this->Login_model->country_name();
        $result['location_result']=$this->Driver_model->fetchCompanyLocations($_SESSION['company_id']);
        $this->load->view('layout/header');
        $this->load->view('add_driver',$result);
        $this->load->view('layout/footer');
    }
	
	public function driver_register()
    {  
    	
       
        	if (isset($_FILES['image_driver']['name']) && $_FILES['image_driver']['name'] != "") 
            {
                  
                $config['upload_path']   = 'profile_pics/';
                $config['allowed_types'] = 'jpg|png|jpeg';
                $config['file_name']     = $_FILES['image_driver']['name']. '.png';
                
                $this->load->library('upload', $config);
                $this->upload->initialize($config);
               if ($this->upload->do_upload('image_driver'))
                {
                 $resdata = $this->upload->data();
                  
                }
            }
            if (isset($_FILES['a_image']['name']) && $_FILES['a_image']['name'] != "") 
            {
                  
                $config['upload_path']   = 'assets/img/identity/';
                $config['allowed_types'] = 'jpg|png|jpeg';
                $config['file_name']     = $_FILES['a_image']['name']. '.png';
                
                $this->load->library('upload', $config);
                $this->upload->initialize($config);
               if ($this->upload->do_upload('a_image'))
                {
                 $resdata1 = $this->upload->data();
                  
                }
            }
            if (isset($_FILES['o_image']['name']) && $_FILES['o_image']['name'] != "") 
            {
                  
                $config['upload_path']   = 'assets/img/identity/';
                $config['allowed_types'] = 'jpg|png|jpeg';
                $config['file_name']     = $_FILES['o_image']['name']. '.png';
                
                $this->load->library('upload', $config);
                $this->upload->initialize($config);
               if ($this->upload->do_upload('o_image'))
                {
                 $resdata3 = $this->upload->data();
                  
                }
            }
            if (isset($_FILES['p_image']['name']) && $_FILES['p_image']['name'] != "") 
            {
                  
                $config['upload_path']   = 'assets/img/identity/';
                $config['allowed_types'] = 'jpg|png|jpeg';
                $config['file_name']     = $_FILES['p_image']['name']. '.png';
                
                $this->load->library('upload', $config);
                $this->upload->initialize($config);
               if ($this->upload->do_upload('p_image'))
                {
                 $resdata2 = $this->upload->data();
                  
                }
            }	
    	   $array = array(
              'location_id'=>$this->input->post('location_name'),
              'address'=>$this->input->post('address'),
              'country'=>$this->input->post('country_id'),
              'city'=>$this->input->post('city_id'),
              'state'=>$this->input->post('state_id'),
              'zip'=>$this->input->post('zip'),
              'mobile'=>$this->input->post('mobile'),
              'driver_license'=>$this->input->post('driver_license'),
              'name'=>$this->input->post('name'),
              'vehicle_type'=>$this->input->post('vehicles_type'),
              'vehicle'=>$this->input->post('vehicle_name'),
              'make'=>$this->input->post('make'),
              'model'=>$this->input->post('model'),
              'year'=>$this->input->post('year'),
              'color'=>$this->input->post('color'),
              'lic_plate'=>$this->input->post('lic_plate'),
              'driver%'=>$this->input->post('driver%'),
              'company%'=>$this->input->post('company%'),
              'password'=>$this->input->post('password'),
              'profile_pic'=>isset($resdata['file_name']) ? $resdata['file_name'] : '',
              'verified_status'=>1, 
              'email'=>$this->input->post('email'),
              'company_id'=>$this->input->post('company_id'),
              'adhaar_image'=>isset($resdata1['file_name']) ? $resdata1['file_name'] : '',
              'pan_image'=>isset($resdata2['file_name']) ? $resdata2['file_name'] : '',
              'other_image'=>isset($resdata3['file_name']) ? $resdata3['file_name'] : '',
              'by_week'=>$this->input->post('week'),
              'by_month'=>$this->input->post('month'),
              'by_trip'=>$this->input->post('trip'),
              'aadhar'=>$this->input->post('aadhar'),
              'pancard'=>$this->input->post('pan'),
              'other'=>$this->input->post('other'),
              'by_biweekly'=>$this->input->post('biweekly')
            );
    			$record = $this->Driver_model->insert_one_row('driver',$array);
    			if($record)
                {
                    $result['Driver'] = $this->Driver_model->get_details();
                    /*$result['vehicle_category'] = $this->Driver_model->vehicle_category();
                    $result['location_result']=$this->Driver_model->fetchCompanyLocations($_SESSION['company_id']);*/
                    $this->load->view('layout/header');
                    $this->load->view('drivers',$result);
                    $this->load->view('layout/footer');
 
                }               	    
        }

      
        public function driver_edit()
        {
			
		   
		      $this->load->view('layout/header');
			    $this->load->view('drivers_edit');
			    $this->load->view('layout/footer');

       
	   }
	  
	  //UPDATE
      public function updateCompany(){
		     $result = $this->security->xss_clean($this->input->post(NULL, TRUE));
		     $data=array('location_name'=>$result['location_name'],'name'=>$result['name'],'address'=>$result['address'],'city'=>$result['city'],'state'=>$result['state'],
					'zip'=>$result['zip'],'mobile'=>$result['mobile'],'driver_license'=>$result['driver_license'],'email'=>$result['email'],
					'make'=>$result['make'],'model'=>$result['model'],'year'=>$result['year'],'color'=>$result['color'],'lic_plate'=>$result['lic_plate']
					,'driver%'=>$result['driver%'],'company%'=>$result['company%'],'password'=>$result['password']);
			  $this->Driver_model->updateDriver($data,$result['driver_id']); 
			  $output['id']=1;
			  $output['message']="Driver Data updated";
			  echo json_encode($output);
		  
	  }
      
   public function get_details()
   {
			
       $this->load->model('Driver_model');
       $this->load->view('layout/header');
	   $this->load->view('drivers');
	   $this->load->view('layout/footer');
   }
   
   //DELETE
	  function driverDelete() 
	  {
			$this->Driver_model->deleteDriver($this->input->post('id'));
			$output['id']=1;
			$output['message']="Driver deleted successfully";
			echo json_encode($output);
	  }

/******** 
@author - simran oberoi 
@used for getting detail of driver 
@date 13 april, 2018
*****/

	public function driver_detail()
	{
		$mobile =$this->input->get('driver_mob');   
        $result =  $this->Driver_model->get_record_by_id('driver',array('mobile'=>$mobile)); 
        print json_encode($result);
     
	}

/******** 
@author - simran oberoi 
@used for getting detail of driver by status
@date 16 april, 2018
*****/

	/*public function driver_status()
	{
		$status = $this->input->get('status_driver');
        $result =  $this->Driver_model->get_record_by_id('driver',array('status'=>$status)); 
       	print  json_encode($result);
	}*/

	public function driver_status()
	{
		$status = $this->input->get('status_driver');
        $result =  $this->Driver_model->get_record_by_id('driver',array('status'=>$status));

        foreach($result as $row)
        {
        	$location = array();
        	$location[] = $row->name;
        	$location[] = (float)$row->latitude;
        	$location[] = (float)$row->longitude;
        	$location[] = $row->mobile;
        	$location[] = $row->profile_pic;
        	$alllocation[] = $location;
        }
        $res = array('allresult'=>$result,'locations'=>$alllocation);        
       	print  json_encode($res);

	}

	/******** 
	@author - simran oberoi 
	@used for getting detail of driver by location
	@date 17 april, 2018
*****/

	public function driver_location()
	{
		$driver_location = $this->input->get('driver_location');
        $result =  $this->Driver_model->get_record_by_id('driver',array('location_id'=>$driver_location));

        foreach($result as $row)
        {
        	$location = array();
        	$location[] = $row->name;
        	$location[] = (float)$row->latitude;
        	$location[] = (float)$row->longitude;
        	$location[] = $row->mobile;
        	$location[] = $row->profile_pic;
        	$alllocation[] = $location;
        }

        $res = array('allresult'=>$result,'locations'=>$alllocation);        
       	print  json_encode($res);
	}

   /******** 
	@author - simran oberoi 
	@used for getting detail of driver by company
	@date 18 april, 2018
*****/
	public function driver_company()
	{
		$driver_company = $this->input->get('driver_company');
        $result =  $this->Driver_model->driver_company($driver_company); 
       	foreach($result as $row)
        {
        	$location = array();
        	$location[] = $row['name'];
        	$location[] = (float)$row['latitude'];
        	$location[] = (float)$row['longitude'];
        	$location[] = $row['mobile'];
        	$location[] = $row['profile_pic'];
        	$alllocation[] = $location;
        }

        $res = array('allresult'=>$result,'locations'=>$alllocation);        
       	print  json_encode($res);
	}


/******** 
	@author - simran oberoi 
	@used for getting detail of driver by name
	@date   19 april, 2018
*****/     
	public function driver_name()
	{
		$driver_name = $this->input->get('driver_name');
        $result =  $this->Driver_model->get_record_by_id('driver',array('id'=>$driver_name)); //print_r($this->db->last_query());exit;
       	print  json_encode($result);
	}

	public function all_driver()
	{
        $company_id = $_SESSION['company_id'];
		$result = $this->Driver_model->all_driver($company_id);
		foreach($result as $row)
        {
        	$location = array();
        	$location[] = $row['name'];
        	$location[] = (float)$row['latitude'];
        	$location[] = (float)$row['longitude'];
        	$location[] = $row['mobile'];
        	$location[] = $row['profile_pic'];
        	$alllocation[] = $location;
        }

        $res = array('allresult'=>$result,'locations'=>$alllocation);        
       	print  json_encode($res);
	} 

	/*public function order_filter()
	{
       $driver_name = $this->input->get('driver_name'); 
       $driver_location = $this->input->get('driver_location'); 
       $status_driver = $this->input->get('status_driver'); 
       $driver_company = $this->input->get('driver_company'); 
       $driver_mob = $this->input->get('driver_mob'); 
       $result =  $this->Driver_model->get_record_by_id('driver',array('name'=>$driver_name,'location_id'=>$driver_location,'status'=>$status_driver,'company_id'=>$driver_company,'mobile'=>$driver_mob));
        foreach($result as $row)
        {
        	$location = array();
        	$location[] = $row['name'];
        	$location[] = (float)$row['latitude'];
        	$location[] = (float)$row['longitude'];
        	$alllocation[] = $location;
        }

        $res = array('allresult'=>$result,'locations'=>$alllocation);    //print_r($this->db->last_query());exit;
       	print  json_encode($result);
	}  */

	public function vehicle_name()
	{
		$vehicle_type = $this->input->get('vehicles_type');
       	$result = $this->Driver_model->vehicle_name($vehicle_type);
       	foreach($result as $key => $value)            
       	{
           $result[$key]['name'] = $value['vehicle_name'] ;
       	}
       		print  json_encode($result);
	}
	
	public function driver_details($driver_id)
	{
			
		$this->load->view('layout/header');
		$this->load->view('driver_detail');
		$this->load->view('layout/footer');				
	}
	
	
	 //UPDATE
    public function update_driver()
    {echo "gjgjh";
		//~ $id = $this->uri->segment(3);
		//~ 
			//~ $data = array(
	                      //~ 'location_id'=>$this->input->post('location_name'),
						  //~ 'address'=>$this->input->post('address'),
						  //~ 'country'=>$this->input->post('country_id'),
						  //~ 'city'=>$this->input->post('city_id'),
						  //~ 'state'=>$this->input->post('state_id'),
						  //~ 'zip'=>$this->input->post('zip'),
						  //~ 'mobile'=>$this->input->post('mobile'),
						  //~ 'driver_license'=>$this->input->post('driver_license'),
						  //~ 'name'=>$this->input->post('name'),
						  //~ 'make'=>$this->input->post('make'),
						  //~ 'model'=>$this->input->post('model'),
						  //~ 'year'=>$this->input->post('year'),
						  //~ 'color'=>$this->input->post('color'),
						  //~ 'lic_plate'=>$this->input->post('lic_plate'),
						  //~ 'driver%'=>$this->input->post('driver%'),
						  //~ 'company%'=>$this->input->post('company%'),
						  //~ 'password'=>$this->input->post('password'),
						  //~ 'email'=>$this->input->post('email')
		 			//~ );
             //~ print_r($data); exit; 
             //~ 
		 	//~ $cat = $this->Driver_model->update_record_by_id('driver',$data,array('id'=>$id));
		 	//~ 
	      //~ 
		 	//~ if(!empty($cat)){
				   //~ 
					//~ redirect('/Driver');
			//~ }
			//~ else
			//~ {
				//~ 
					//~ redirect('/Driver');
//~ 
			//~ }			                           
    } 

	
}
?>
