<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dispatch extends CI_Controller 
{
    public function  __construct()
    {
		 
		 parent::__construct();
		 $this->load->model('Dispatch_model');
		 $this->load->library('form_validation');
		 $this->load->helper('form');
		 $this->load->helper('url');
		 
    }
	
	public function index()
	{
		if(isset($_SESSION['company_id']) && !empty($_SESSION['company_id'])){
			//$result['Dispatch'] = $this->Dispatch_model->get_details();
			$result['driver_result'] = $this->Dispatch_model->fetch_driverlist();
			$result['Drivers'] = $this->Dispatch_model->get_location_name();
			$this->load->view('layout/header_dispatch',$result);
			$this->load->view('dispatch',$result);
			$this->load->view('layout/footer');
		}else{
			$this->load->view('layout/header_login');
			$this->load->view('login');
			$this->load->view('layout/login_footer');
		}
		

	}
	
	public function filter_driver(){
		$clean = $this->security->xss_clean($this->input->post(NULL, TRUE));
		$result = $this->Dispatch_model->fetch_driver_details($clean);
		$data['driver_listing']=array();
		if(!empty($result))
		{
			foreach($result as $r)
			{
				$data['driver_listing'][]=array('id'=>$r['id'],'order_status'=>$r['order_status'],'driver_phone'=>$r['driver_phone'],'mobile'=>$r['customer_tel'],'driver_status'=>$r['driver_status'],'profile_pic'=>$r['profile_pic'],'name'=>$r['driver_name'],'lat'=>$r['lat'],
				'lng'=>$r['lng'],'make'=>$r['make'],'model'=>$r['model'],'color'=>$r['color'],'pickup_location'=>isset($r['pickup_location'])?$r['pickup_location']:'','drop_location'=>isset($r['drop_location'])?$r['drop_location']:'',
				'pickup_cordinates'=>isset($r['pickup_cordinates'])?$r['pickup_cordinates']:'','drop_cordinates'=>isset($r['drop_cordinates'])?$r['drop_cordinates']:'','customer_name'=>isset($r['customer_name'])?$r['customer_name']:'');
			}
		}
		echo json_encode($data);
	}
	
	//Populate Order Data in DataTable
	function order_list(){
		$clean = $this->security->xss_clean($this->input->post(NULL, TRUE));
		$search_cust="";
		if(isset($clean['cust_name']) && !empty($clean['cust_name']))
		{
			$search_cust=$clean['cust_name'];
		}
		//Fetch all bookings
		if($clean['datetime_type']==2)
		{
			$search='filter_driver';
			$data=array('order_status'=>$clean['order_status'],'from_date'=>$clean['from_date'],'to_date'=>$clean['to_date'],'order_type'=>$clean['order_type']);
			$list_data = $this->Dispatch_model->get_details($data,$search,$search_cust);
		}
		else
		{
			$search='table_data';
			$list_data = $this->Dispatch_model->get_details($clean,$search,$search_cust);
		}
		usort($list_data, function($a, $b) {
			return $a['datetime'] > $b['datetime'];
		});
		
		if($clean['length']=='-1')
		{
			$length=count($list_data);
		}
		else{
			$length=$clean['length'];
		}
		$list = array_slice($list_data, $clean['start'], $length);
		$data = array();
		foreach ($list as $customers) {
			$row = array();
			
			if($customers['order_type']==0)
			{
				$order_type="App Booking";
			}else if($customers['order_type']==1){
				$order_type="Dashoboard Booking";
			}else if($customers['order_type']==2){
				$order_type="Network App Booking";
			}else{
				$order_type="Network Dashboard Booking";
			}
			if($customers['driver_status']==0)
			{
				$driver_status="Offline";
			}else if($customers['driver_status']==1){
				$driver_status="Avialable";
			}else if($customers['driver_status']==2){
				$driver_status="In Progress";
			}else{
				$driver_status="Busy";
			}
			
			if($customers['payment_type']==0){
				$payment_type="Cash";
			}else if($customers['payment_type']==1){
				$payment_type="Credit Card";
			}else{
				$payment_type="Coorporation Account";
			}
			$row[] = $driver_status;
			$row[] = $customers['driver_name'];
			$row[] = $order_type;
			$row[] = $customers['datetime'];
			$row[] = $customers['customer_name'];
			$row[] = $customers['mobile'];
			$row[] = $customers['pickup_location'];
			//~ $row[] = "";
			$row[] = $customers['drop_location'];
			//~ $row[] = "";
			$row[] = '<div id="ride_id_'.$customers['ride_request_id'].'">'.$payment_type.'</div>';
			//~ $row[] = "";
			//$row[] = 'i';  
			$order="";
			if($customers['order_status']==0)
			{
				$order.='<button type="button" name="delete" class="btn btn-danger btn-xs cancel_order"  onclick="ConfirmCancelOrder('.$customers['ride_request_id'].')">Cancel Order</button>';
			}
			$row[] = '<button type="button" name="update" class="btn btn-warning btn-xs btn-info"  data-toggle="modal" data-target="#myModal2" onclick="showData('.$customers['ride_request_id'].','.$customers['payment_type'].','.$customers['order_type'].')">Order Detail</button>'.$order;
			$data[] = $row;
		}
		$output = array(
					"data" => $data,
					"recordsTotal"    => count($list_data),  
					"recordsFiltered" => count($list_data),
		);
		//output to json format
		echo json_encode($output);
		return;
		
	}
	
	public function get_order_detail()
	{
		$clean = $this->security->xss_clean($this->input->post(NULL, TRUE));
		$result = $this->Dispatch_model->get_order_detail($clean['ride_request_id'],$clean['order_type']);
		echo json_encode($result);
	}
	
	public function updatePaymentMethod()
	{
		$clean = $this->security->xss_clean($this->input->post(NULL, TRUE));
		$result = $this->Dispatch_model->updatePaymentMethod($clean['ride_request_id'],$clean['payment_type'],$clean['order_type']);
		//$result_arr=array('payment_type'=>$payment_type);
		echo json_encode($result);
	}
	
	public function cancel_order() 
    {
		$clean = $this->security->xss_clean($this->input->post(NULL, TRUE));
		$result = $this->Dispatch_model->cancel_order($clean['ride_request_id']);
		if($result){
			echo "1";
		}else{
			echo "0";
		}
			
    }
    
	public function get_driver_status() 
    {
		    $this->load->helper('url');
			$this->load->model('Dispatch_model');
			$data = $this->Dispatch_model->get_driver_status($_POST['company_id']);
			$html="";
			foreach($data as $company_id=>$driver_status)
			  {
				$html.="<option value='".$company_id."'>".$driver_status."</option>";
			  } 
				echo $html;
		
    }
    
	public function dispatch_order()
    {
		$clean = $this->security->xss_clean($this->input->post(NULL, TRUE));
		if(!empty($clean))
		{
			$data = $this->Dispatch_model->insertDispatch($clean,$_SESSION['company_id']); 
			if(!empty($data))
			{
				$result['basefare']=$data['basefare'];
				$result['Driver']=$data['data'];
				$result['order_id']=$data['id'];
				$_SESSION['order_id']=$data['id'];
				$result['form_details']=$clean;
				if(isset($data['end_time']) && !empty($data['end_time']))
				{
					$start_end_time=$data['start_time']." to ".$data['end_time']; 
				}
				else if(isset($data['start_time']) && !empty($data['start_time'])){
					$start_end_time=$data['start_time']; 
				}
				else{
					$start_end_time="";
				}
				$result['est_to_pickup']=$start_end_time;
			}else{
				$result['no_data']="";
			}
			echo json_encode($result);
		}
		else
		{
			$this->load->view('layout/header_dispatch');
			$this->load->view('dispatch');
			$this->load->view('layout/footer');
		}
    }
    
    public function book_dispatch_order()
    {
		$clean = $this->security->xss_clean($this->input->post(NULL, TRUE));
		$order_id=$_SESSION['order_id'];
        if(isset($clean['driver_id']))
        {
			$updatedata=array('driver_id'=>$clean['driver_id'],'order_creation_date'=>$clean['order_creation_date'],'customer_name'=>$clean['customer_name'],'customer_telephone'=>$clean['customer_telephone'],'assign_driver'=>$clean['assign_driver'],'schedule_type'=>$clean['schedule_type'],'pickup_time'=>$clean['pickup_time'],'flat_rate'=>$clean['flat_rate'],'payment_method'=>$clean['payment_method'],'Order_Done'=>1);
			$data = $this->Dispatch_model->updateBookDispatch($order_id,$updatedata,$order_type=1); 
		}else{
			$getdriver=$this->Dispatch_model->fetchRandomDriver($_SESSION['company_id'],$clean['latitude'],$clean['longitude']); 
			$updatedata=array('driver_id'=>$getdriver[0]->id,'referal_location_id'=>$getdriver[0]->location_id,'order_creation_date'=>$clean['order_creation_date'],'customer_name'=>$clean['customer_name'],'customer_telephone'=>$clean['customer_telephone'],'assign_driver'=>$clean['assign_driver'],'schedule_type'=>$clean['schedule_type'],'pickup_time'=>$clean['pickup_time'],'flat_rate'=>$clean['flat_rate'],'payment_method'=>$clean['payment_method'],'Order_Done'=>1);
			$data = $this->Dispatch_model->updateBookDispatch($order_id,$updatedata,$order_type=3); 
			if($getdriver[0]->device_type=='A')
			{
				
				$this->fcm_driver($getdriver[0]->device_token,'DASHBOARD',$noti_type='customer_request',$ride_request_id=1);
			}
			else
			{
				//~ send_noti($get_token['device_token'],$message);
			}
		}
        echo "hi";
    }
        
    
    //EDIT
	  public function edit() 
      {
	
		$id=$_GET['id'];
				
		$dataArray=array();
				
		$output=$this->Dispatch_model->edit_data($id);
			
		$dataArray['id']=$id;
		$dataArray['order_type']=$output['order_type'];
	    $dataArray['driver_id']=$output['driver_id'];
		$dataArray['driver_status']=$output['driver_status'];
		$dataArray['customer_name']=$output['customer_name'];
		$dataArray['customer_telephone']=$output['customer_telephone'];
		$dataArray['pickup_address']=$output['pickup_address'];
		$dataArray['destination']=$output['destination'];
		$dataArray['payment_method']=$output['payment_method'];
		

		// $this->load->view('crud/edit_crud_view', $dataArray); // uncomment this code and comment all below if you don't want to display in the layout
		
		$dataArr["page_view"] = '';
		$dataArr["page_view"] =	$this->load->view('edit_dispatch', $dataArray, true);	
		$this->load->view('edit_dispatch',$dataArr);

	}
	
		//UPDATE
	public function update() 
	{
			if($_POST)
			{
				$id = $this->input->post('id');
				$data = array(
								'order_type' => $this->input->post('order_type'),
								'driver_id' => $this->input->post('driver_id'),
								'driver_status' => $this->input->post('driver_status'),
								'customer_name' => $this->input->post('customer_name'),
								'customer_telephone' => $this->input->post('customer_telephone'),
								'pickup_address' => $this->input->post('pickup_address'),
								'destination'=> $this->input->post('destination'),
								'payment_method'=> $this->input->post('payment_method')
								
							);		
				$res=$this->Dispatch_model->update_data($id, $data);		
				if ($res) 
				{
                        redirect('Dispatch/dispatch_order');
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
		
		$id = $this->input->get('id');
		$this->Dispatch_model->delete_data($id);
		
		redirect('Dispatch/dispatch_order');
		die();
	}   
	
	public function get_driver()
    {
		 $this->load->model('Dispatch_model');
		 $this->load->view('layout/header_dispatch');
		 $this->load->view('dispatch');
		 $this->load->view('layout/footer');
    }
        
    public function fcm_driver($registrationID,$message_data,$noti_type,$ride_request_id) //Driver Server Key
	{
		// Replace with the real server API key from Google APIs
		$apiKey = "AIzaSyC2OSTPr8_bETAgaW3i7BFWByP93xd882A";
		$url = 'https://fcm.googleapis.com/fcm/send';
		$fields = array(
							'registration_ids'  => array($registrationID),
							'data'              => array( "message" => $message_data,"noti_type" => $noti_type,"ride_request_id" => $ride_request_id)
					   );
		$headers = array( 
							'Authorization: key=' . $apiKey,
							'Content-Type: application/json'
						);
			
		$ch = curl_init();
		curl_setopt( $ch, CURLOPT_URL, $url );
		curl_setopt( $ch, CURLOPT_POST, true );
		curl_setopt( $ch, CURLOPT_HTTPHEADER, $headers);
		curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
		curl_setopt( $ch, CURLOPT_POSTFIELDS, json_encode( $fields ) );
		$result = curl_exec($ch);
		if($result===FALSE)
		{
			die('Curl failed: ' . curl_erroe($ch));
		}
		curl_close($ch);
	/*
		echo $result;
	*/
	}   
}
