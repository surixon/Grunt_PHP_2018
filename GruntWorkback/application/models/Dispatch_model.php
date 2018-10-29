<?php
class Dispatch_model extends CI_Model 
{

    function __construct()
    {
        parent::__construct(); 
        
    }
    
    public function fetch_driverlist(){
		$qry="select id,status driver_status,profile_pic,name,latitude lat,longitude lng from driver where location_id IN(select location_id from location where company_id=".$_SESSION['company_id'].") and status=1 and verified_status=1";
		$query_driver = $this->db->query($qry,true);
		$driver_data = $query_driver->result_array();
		return $driver_data;
	}
	
	function fetch_driver_details($data){
		$row=array();
		if($data['data_type']=="all"){
			$qry="select id,status driver_status,mobile,profile_pic,name,latitude lat,longitude lng,make,model,color from driver 
				where location_id IN(select location_id from location where company_id=".$_SESSION['company_id'].") and verified_status=1";
			$query_driver = $this->db->query($qry,true);
			$driver_data = $query_driver->result_array();
			foreach($driver_data as $dd)
			{
				$pickup_location=$drop_location=$pickup_cordinates=$drop_cordinates=$customer_name=$customer_tel="";
				$order_qry="select * from request_driver where driver_id='".$dd['id']."' and status=0";
				$fetch_order_qry = $this->db->query($order_qry,true);
				$order_data = $fetch_order_qry->result();
				if($dd['driver_status']=="0"){
					$order_status="offline";
				}
				else if($dd['driver_status']=="1")
				{
					$order_status="avialable";
				}
				else if($dd['driver_status']=="2")
				{
					foreach($order_data as $order)
					{
						if($order->order_type=="1" || $order->order_type=="3")
						{
							$fetch_qry="select * from `order` where id='".$order->order_id."'";
							$fetch_data_qry = $this->db->query($fetch_qry,true);
							$fetch_data = $fetch_data_qry->result();
							foreach($fetch_data as $fd)
							{
								$customer_name=$fd->customer_name;
								$customer_tel=$fd->customer_telephone;
							}
						}else{
							$fetch_qry="select * from customer where id='".$order->customer_id."'";
							$fetch_data_qry = $this->db->query($fetch_qry,true);
							$fetch_data = $fetch_data_qry->result();
							foreach($fetch_data as $fd)
							{
								$customer_name=$fd->name;
								$customer_tel=$fd->mobile;
							}
						}
						$pickup_location=$order->pickup_location;
						$drop_location=$order->drop_location;
						$pickup_cordinates=$order->pickup_cordinates;
						$drop_cordinates=$order->drop_cordinates;
					}
					$order_status="progress";
				}
				else if($dd['driver_status']=="3")
				{
					foreach($order_data as $order)
					{
						if($order->order_type=="1" || $order->order_type=="3")
						{
							$fetch_qry="select * from `order` where id='".$order->order_id."'";
							$fetch_data_qry = $this->db->query($fetch_qry,true);
							$fetch_data = $fetch_data_qry->result();
							foreach($fetch_data as $fd)
							{
								$customer_name=$fd->customer_name;
								$customer_tel=$fd->customer_telephone;
							}
						}else{
							$fetch_qry="select * from customer where id='".$order->customer_id."'";
							$fetch_data_qry = $this->db->query($fetch_qry,true);
							$fetch_data = $fetch_data_qry->result();
							foreach($fetch_data as $fd)
							{
								$customer_name=$fd->name;
								$customer_tel=$fd->mobile;
							}
						}
						$pickup_location=$order->pickup_location;
						$drop_location=$order->drop_location;
						$pickup_cordinates=$order->pickup_cordinates;
						$drop_cordinates=$order->drop_cordinates;
					}
					$order_status="busy";
				}
				$row[]=array('id'=>$dd['id'],'order_status'=>$order_status,'driver_status'=>$dd['driver_status'],'driver_phone'=>$dd['mobile'],'customer_tel'=>$customer_tel,'profile_pic'=>$dd['profile_pic'],'driver_name'=>$dd['name'],'lng'=>$dd['lng'],'lat'=>$dd['lat']
						,'make'=>$dd['make'],'model'=>$dd['model'],'color'=>$dd['color'],'pickup_location'=>$pickup_location,'drop_location'=>$drop_location,'pickup_cordinates'=>$pickup_cordinates,'drop_cordinates'=>$drop_cordinates,
						'customer_name'=>$customer_name);
			}
		}else{
			$where="";
			$cust_name_tel_condition="";
			if(!empty($data['cust_name_tel'])){
				$cust_name_tel_condition=" and c.name LIKE '".$data['cust_name_tel']."%'";
			}
			if($data['driver_status']!="-1")
			{
				$where.=" and status=".$data['driver_status'];
			}
			if(!empty($data['location_name']))
			{
				$where.=" and location_id=".$data['location_name'];
			}
			else{
				$where.=" and location_id IN(select location_id from location where company_id=".$_SESSION['company_id'].")";
			}
			$where.=" and name LIKE '".$data['driver']."%'";
			$qry="select id,status driver_status,mobile,profile_pic,name,latitude lat,longitude lng,make,model,color from driver 
				where  verified_status=1 $where";
			$query_driver = $this->db->query($qry,true);
			$driver_data = $query_driver->result_array();
			foreach($driver_data as $dd)
			{
				$pickup_location=$drop_location=$pickup_cordinates=$drop_cordinates=$customer_tel=$customer_name=$order_status="";
				$fetch_data=array();
				$count=0;
				$order_qry="select * from request_driver where driver_id='".$dd['id']."' and status=0";
				$fetch_order_qry = $this->db->query($order_qry,true);
				$order_data = $fetch_order_qry->result();
				if($dd['driver_status']=="0" && empty($data['cust_name_tel'])){
					$order_status="offline";
					$row[]=array('id'=>$dd['id'],'order_status'=>$order_status,'driver_status'=>$dd['driver_status'],'driver_phone'=>$dd['mobile'],'customer_tel'=>$customer_tel,'profile_pic'=>$dd['profile_pic'],'driver_name'=>$dd['name'],'lng'=>$dd['lng'],'lat'=>$dd['lat']
						,'make'=>$dd['make'],'model'=>$dd['model'],'color'=>$dd['color'],'pickup_location'=>$pickup_location,'drop_location'=>$drop_location,'pickup_cordinates'=>$pickup_cordinates,'drop_cordinates'=>$drop_cordinates,
						'customer_name'=>$customer_name);
				}
				else if($dd['driver_status']=="1" && empty($data['cust_name_tel']))
				{
					$order_status="avialable";
					$row[]=array('id'=>$dd['id'],'order_status'=>$order_status,'driver_status'=>$dd['driver_status'],'driver_phone'=>$dd['mobile'],'customer_tel'=>$customer_tel,'profile_pic'=>$dd['profile_pic'],'driver_name'=>$dd['name'],'lng'=>$dd['lng'],'lat'=>$dd['lat']
						,'make'=>$dd['make'],'model'=>$dd['model'],'color'=>$dd['color'],'pickup_location'=>$pickup_location,'drop_location'=>$drop_location,'pickup_cordinates'=>$pickup_cordinates,'drop_cordinates'=>$drop_cordinates,
						'customer_name'=>$customer_name);
				}
				else if($dd['driver_status']=="2")
				{
					foreach($order_data as $order)
					{
						if($order->order_type=="1" || $order->order_type=="3")
						{
							$fetch_qry="select * from `order` where (customer_name LIKE '".$data['cust_name_tel']."%' or customer_telephone LIKE '".$data['cust_name_tel']."%') and id='".$order->order_id."'";
							$fetch_data_qry = $this->db->query($fetch_qry,true);
							$fetch_data = $fetch_data_qry->result();
							foreach($fetch_data as $fd)
							{
								$count=1;
								$customer_name=$fd->customer_name;
								$customer_tel=$fd->customer_telephone;
							}
						}else{
							$fetch_qry="select * from customer where  (name LIKE '".$data['cust_name_tel']."%' or mobile LIKE '".$data['cust_name_tel']."%') and  id='".$order->customer_id."'";
							$fetch_data_qry = $this->db->query($fetch_qry,true);
							$fetch_data = $fetch_data_qry->result();
							foreach($fetch_data as $fd)
							{
								$count=1;
								$customer_name=$fd->name;
								$customer_tel=$fd->mobile;
							}
						}
						$pickup_location=$order->pickup_location;
						$drop_location=$order->drop_location;
						$pickup_cordinates=$order->pickup_cordinates;
						$drop_cordinates=$order->drop_cordinates;
					}
					$order_status="progress";
					if(!empty($count))
					{
						$row[]=array('id'=>$dd['id'],'order_status'=>$order_status,'driver_status'=>$dd['driver_status'],'driver_phone'=>$dd['mobile'],'customer_tel'=>$customer_tel,'profile_pic'=>$dd['profile_pic'],'driver_name'=>$dd['name'],'lng'=>$dd['lng'],'lat'=>$dd['lat']
							,'make'=>$dd['make'],'model'=>$dd['model'],'color'=>$dd['color'],'pickup_location'=>$pickup_location,'drop_location'=>$drop_location,'pickup_cordinates'=>$pickup_cordinates,'drop_cordinates'=>$drop_cordinates,
							'customer_name'=>$customer_name);
					}
				}
				else if($dd['driver_status']=="3")
				{
					foreach($order_data as $order)
					{
						if($order->order_type=="1" || $order->order_type=="3")
						{
							$fetch_qry="select * from `order` where (customer_name LIKE '".$data['cust_name_tel']."%' or customer_telephone LIKE '".$data['cust_name_tel']."%') and id='".$order->order_id."'";
							$fetch_data_qry = $this->db->query($fetch_qry,true);
							$fetch_data = $fetch_data_qry->result();
							foreach($fetch_data as $fd)
							{
								$count=1;
								$customer_name=$fd->customer_name;
								$customer_tel=$fd->customer_telephone;
							}
						}else{
							$fetch_qry="select * from customer where (name LIKE '".$data['cust_name_tel']."%' or mobile LIKE '".$data['cust_name_tel']."%') and  id='".$order->customer_id."'";
							$fetch_data_qry = $this->db->query($fetch_qry,true);
							$fetch_data = $fetch_data_qry->result();
							foreach($fetch_data as $fd)
							{
								$count=1;
								$customer_name=$fd->name;
								$customer_tel=$fd->mobile;
							}
						}
						$pickup_location=$order->pickup_location;
						$drop_location=$order->drop_location;
						$pickup_cordinates=$order->pickup_cordinates;
						$drop_cordinates=$order->drop_cordinates;
					}
					$order_status="busy";
					if(!empty($count))
					{
						$row[]=array('id'=>$dd['id'],'order_status'=>$order_status,'driver_status'=>$dd['driver_status'],'driver_phone'=>$dd['mobile'],'customer_tel'=>$customer_tel,'profile_pic'=>$dd['profile_pic'],'driver_name'=>$dd['name'],'lng'=>$dd['lng'],'lat'=>$dd['lat']
							,'make'=>$dd['make'],'model'=>$dd['model'],'color'=>$dd['color'],'pickup_location'=>$pickup_location,'drop_location'=>$drop_location,'pickup_cordinates'=>$pickup_cordinates,'drop_cordinates'=>$drop_cordinates,
							'customer_name'=>$customer_name);
					}
				}
				
			}
		}
		return $row;
	}
	
    public function insertDispatch($d1,$company_id)
    {  
			$result=array();
			$data=array();
			$where="";
			if($d1['driver_type']==1)
            {
				$where.= "d.location_id IN(select location_id from location where company_id='".$company_id."') AND "; 
			}
			else
			{
				//$where.= "location_id NOT IN(select location_id from location where company_id='".$company_id."') AND "; 
			}
			if($d1['select_vehicle']==0){
				$where.= "(car_type=1 OR car_type=2) AND ";
			}else{
				$where.= "car_type='".$d1['select_vehicle']."' AND ";
			}
			//Fetch Driver Detail
			$qry="select d.name,d.status,(((acos(sin((".$d1['latitude']."*pi()/180)) * sin((`latitude`*pi()/180))+cos((".$d1['latitude']."*pi()/180)) * cos((`latitude`*pi()/180)) * cos(((".$d1['longitude']."- `longitude`)*pi()/180))))*180/pi())*60*1.1515) 
				  as distance,c.state as company_name,l.location_cab_alias as location_name from driver d,location l,company c where ".$where." l.location_id=d.location_id and c.company_id=l.company_id and  d.verified_status=1 AND d.status=1 ORDER BY distance";
			$query_driver = $this->db->query($qry,true);
			$result['data']=array();
			$driver_data = $query_driver->result_array();
			$total_available_drivers=count($driver_data);
			
			for($i=0;$i<$total_available_drivers;$i++)
			{
				$row = array();
				$row['name']=$driver_data[$i]['name'];
				$row['company_name']=$driver_data[$i]['company_name'];
				$row['location_name']=$driver_data[$i]['location_name'];
				$row_status=$driver_data[$i]['status'];
				if($row_status==0)
				{
					$status="Offline";
				}else if($row_status==1){
					$status="Available";
				}else if($row_status==2){
					$status="In-Progress";
				}else{
					$status="Busy";
				}
				$row['status']=$status;
				$row_distance=$driver_data[$i]['distance'];
				//~ if($row_distance<60)
				//~ {
					$distance=round($row_distance)." min";
				//~ }
				//~ else if($row_distance>=60 && $row_distance<1440 )
				//~ {
					//~ $distance=round(($row_distance/60),2)." hours";
				//~ }else{
					//~ $distance=round(($row_distance/1440))." days";
				//~ }
				//~ if($row_distance<=1)
				//~ {
					//~ $distance="1 min";
				//~ }
				//~ else if($row_distance>1 && $row_distance<=2)
				//~ {
					//~ $distance="3 min";
				//~ }
				//~ else if($row_distance>2 && $row_distance<=3)
				//~ {
					//~ $distance="5 min";
				//~ }
				//~ else if($row_distance>3 && $row_distance<=4)
				//~ {
					//~ $distance="7 min";
				//~ }
				//~ else
				//~ {
					//~ $distance="10 min";
				//~ }
				if($i==0)
				{
					$result['start_time']=$distance;
				}
				if($i==$total_available_drivers-1)
				{
					$result['end_time']=$distance;
				}
				$row['distance']=$distance;
				
				$result['data'][] = $row;
			}
			//If vehicle type is ANY
			$map_distance=explode(" ",$d1['distance']);
			$map_dist=$map_distance[0];
			$totmin=0;
			$durationArr=explode(" ",$d1['duration']);
			if($durationArr[1]=="hours" || $durationArr[1]=="hour"){
				$totmin+=($durationArr[0]*60)+$durationArr[2];
			}
			if($durationArr[1]=="days" || $durationArr[1]=="day"){
				$totmin+=($durationArr[0]*24*60)+($durationArr[2]*60);
			}
			if($durationArr[1]=="min" || $durationArr[1]=="mins"){
				$totmin+=$durationArr[0];
			}
			
			if($d1['select_vehicle']==0){
				$cmp_id="";
				if($d1['driver_type']==1){
					//If driver type is MY DRIVERS
					$cmp_id="AND company_id=".$_SESSION['company_id'];
				}else{
					//If driver type is NETWORKED
					//$cmp_id=" AND company_id!=".$_SESSION['company_id'];
				}
				//Maximum Basefare
				$max_basefare="SELECT max((basefare)+(permile*$map_dist)+(permin*$totmin)) AS max_basefare FROM pricing where car_type=2 ".$cmp_id;
				$query_deluxe_basefare = $this->db->query($max_basefare,true);
				$deluxe_basefare = $query_deluxe_basefare->result();
				//Minimum Basefare
				$qry_regular_basefare="SELECT min((basefare)+(permile*$map_dist)+(permin*$totmin)) AS min_basefare FROM pricing where car_type=1 ".$cmp_id;
				$query_regular_basefare = $this->db->query($qry_regular_basefare,true);
				$regular_basefare = $query_regular_basefare->result();
				
				$result['basefare']=array('bse_fare'=>"$".$regular_basefare[0]->min_basefare." - $".$deluxe_basefare[0]->max_basefare);
				
			}
			else{
				$where_cmp_id="";
				if($d1['driver_type']==1)
				{
					$where_cmp_id="AND company_id=".$_SESSION['company_id'];
				}else{
					$where_cmp_id="AND company_id!=".$_SESSION['company_id'];
				}
				$qry_basefare="SELECT ((basefare)+(permile*$map_dist)+(permin*$totmin)) AS basefare FROM pricing where car_type=".$d1['select_vehicle']." ". $where_cmp_id;
				$query_basefare = $this->db->query($qry_basefare,true);
				$basefare = $query_basefare->result();
				$result['basefare']=array('bse_fare'=>"$".$basefare[0]->basefare);
			}
			//Insert Order Detail
			if($total_available_drivers)
			{
				//Insert Into Order Table
				$pickup_coordinate=$d1['latitude'].",".$d1['longitude'];
				$drop_coordinate=$d1['destination_latitude'].",".$d1['destination_longitude'];
				$string1 = array('company_id'=>$_SESSION['company_id'],'distance'=>$d1['distance'],'duration'=>$d1['duration'],'driver_type'=>$d1['driver_type'],'vehicle_type'=>$d1['select_vehicle']);
				$query = $this->db->insert_string('order',$string1);             
				$this->db->query($query);
				$result['id']=$this->db->insert_id();
				//Update Request Driver
				$string1 = array('order_id'=>$result['id'],'pickup_location'=>$d1['pickup_address'],'drop_location'=>$d1['destination'],'pickup_cordinates'=>$pickup_coordinate,'drop_cordinates'=>$drop_coordinate);
				$query = $this->db->insert_string('request_driver',$string1);             
				$this->db->query($query);
				return $result;
			}
		    return $data;
            
    }
    
    function updateBookDispatch($id,$data,$order_type){
		
		$string1 = array('order_type'=>$order_type,'driver_id'=>$data['driver_id']);
		//~ $query = $this->db->insert_string('request_driver',$string1);             
		//~ $this->db->query($query);
		$this->db->where('order_id', $id);
		$this->db->update('request_driver', $string1);
		
		//~ $qry="select id from request_driver where order_id='".$id."'";
		//~ $query = $this->db->query($qry,true);
		//~ $request_result = $query->result();
		//~ $id=$request_result[0]->id;
		
		//Update Order Table
		$this->db->where('id', $id);
		$this->db->update('order', $data);
		//Update Driver Table
		$driver_status['status']=2;
		$this->db->where('id', $data['driver_id']);
		$this->db->update('driver', $driver_status);
		return 1;
	}
	
	function fetchRandomDriver($company_id,$latitude,$longitude){
		$qry="select *,(((acos(sin((".$latitude."*pi()/180)) 
					* sin((`latitude`*pi()/180))+cos((".$latitude."*pi()/180)) * cos((`latitude`*pi()/180)) 
					* cos(((".$longitude."- `longitude`)*pi()/180))))*180/pi())*60*1.1515) 
					as distance from driver where  verified_status=1 AND status=1  and 
					location_id IN(SELECT location_id from location where company_id!='".$company_id."')
					 HAVING  distance <= 5000  ORDER BY distance ASC LIMIT 1";
		$query = $this->db->query($qry,true);
		$result = $query->result();
		return $result;
	}
	
	function fetchDriverDetails($driver_id){
		$qry="select * from driver where  verified_status=1 AND status=1  and id='".$driver_id."'";
		$query = $this->db->query($qry,true);
		$result = $query->result();
		return $result;
	}
	
	function cancel_order($ride_request_id){
		$qry="update request_driver set status=2 where  id='".$ride_request_id."'";
		$query = $this->db->query($qry,true);
		//$result = $query->result();
		if ($this->db->affected_rows() > 0) {
			return TRUE;
		} else {
			return false;
		}
		//~ return $result;
	}
	
    function get_details($data,$filter_type,$search_cust)
    {
		$driver_where=$location_where=$records_between=$records_between=$pickup_records_between=$driver_where=$name_where="";
		$request_search_cust_phone=" and (c.name LIKE '".$search_cust."%' or c.mobile LIKE '".$search_cust."%')";
		$order_search_cust_phone=" and (o.customer_name LIKE '".$search_cust."%' or o.customer_telephone LIKE '".$search_cust."%')";
		if($filter_type=="filter_driver")
		{
			
			if(!empty($data['from_date']))
			{
				$from_date=date("d/m/Y", strtotime($data['from_date'])).", 00:00:00 AM";
				$to_date=date("d/m/Y", strtotime($data['to_date'])).", 11:59:59 PM";
				$records_between=" and r.datetime between '".$from_date."' AND '".$to_date."'";
				$pickup_records_between=" and o.pickup_time between '".$from_date."' AND '".$to_date."'";
			}
			//$name_where=" and d.name LIKE '".$data['driver']."%'";
			//$where="d.location_id IN(SELECT location_id from location where company_id='".$_SESSION['company_id']."')";
			//~ if($data['driver_status']!="-1"){
				//~ $driver_where=" and d.status=".$data['driver_status'];
			//~ }
			if($data['order_status']==""){
				$app_where=" and rr.ride_request_id IN(select id from request_driver where order_type=0 and location_id IN(select location_id from `location` where company_id=".$_SESSION['company_id']."))";
				$net_where=" and rr.ride_request_id IN(select id from request_driver where order_type=2 and referal_location_id IN(select location_id from `location` where company_id=".$_SESSION['company_id']."))";
				$dash_where="  and o.assign_driver=1 and (o.Order_Done=1 or o.Order_Done=2) and o.company_id='".$_SESSION['company_id']."'";
				$net_dash_where="  and o.assign_driver=2 and (o.Order_Done=1 or o.Order_Done=2) and o.referal_location_id IN (SELECT location_id from location where company_id='".$_SESSION['company_id']."')";
			}else if($data['order_status']=="1"){
				$app_where=" and rr.ride_request_id IN(select id from request_driver where order_type=0 and status=0 and location_id IN(select location_id from `location` where company_id=".$_SESSION['company_id']."))";
				$net_where=" and rr.ride_request_id IN(select id from request_driver where order_type=2 and status=0 and referal_location_id IN(select location_id from `location` where company_id=".$_SESSION['company_id']."))";
				$dash_where="  and o.assign_driver=1 and Order_Done=1 and o.company_id='".$_SESSION['company_id']."'";
				$net_dash_where="  and o.assign_driver=2 and Order_Done=1 and o.referal_location_id IN (SELECT location_id from location where company_id='".$_SESSION['company_id']."')";
			}else if($data['order_status']=="2"){
				$app_where=" and rr.ride_request_id IN(select id from request_driver where order_type=0 and status=1 and location_id IN(select location_id from `location` where company_id=".$_SESSION['company_id']."))";
				$net_where=" and rr.ride_request_id IN(select id from request_driver where order_type=2 and status=1 and referal_location_id IN(select location_id from `location` where company_id=".$_SESSION['company_id']."))";
				$dash_where="  and o.assign_driver=1 and Order_Done=2 and o.company_id='".$_SESSION['company_id']."'";
				$net_dash_where="  and o.assign_driver=2 and Order_Done=2 and o.referal_location_id IN (SELECT location_id from location where company_id='".$_SESSION['company_id']."')";
			}else{
				//~ $app_where=" and rr.ride_request_id IN(select id from request_driver where order_type=0 and status=1 and location_id IN(select location_id from `location` where company_id=".$_SESSION['company_id']."))";
				//~ $net_where=" and rr.ride_request_id IN(select id from request_driver where order_type=2 and status=1 and referal_location_id IN(select location_id from `location` where company_id=".$_SESSION['company_id']."))";
				//~ $dash_where="  and o.assign_driver=1 and Order_Done=2 and o.company_id='".$_SESSION['company_id']."'";
				//~ $net_dash_where="  and o.assign_driver=2 and Order_Done=2 and o.referal_location_id IN (SELECT location_id from location where company_id='".$_SESSION['company_id']."')";
			}
			
			//~ if(!empty($data['location_name'])){
				//~ $location_where.=" and d.location_id=".$data['location_name'];
			//~ }else{
				//~ $location_where.=" and d.location_id IN(select location_id from location where company_id='".$_SESSION['company_id']."')";
			//~ }
			//Order From App
			if(!empty($data['order_type']) && $data['order_type']=="1"){
				$qry_app="select d.id,d.mobile driver_phone,d.status driver_status,d.profile_pic,d.latitude as lat,d.longitude as lng,make,model,color,r.id as ride_request_id,
						0 AS order_type,c.name customer_name,d.name driver_name,r.datetime,r.status order_status,c.mobile,r.pickup_location,r.payment_type,r.drop_location from 
						request_driver r,customer c,ride_request rr,driver d where d.id=rr.driver_id and rr.ride_request_id=r.id and c.id=r.customer_id 
						 $app_where $name_where $driver_where $location_where $records_between $request_search_cust_phone";
				$query_app = $this->db->query($qry_app,true);
				$result_app = $query_app->result_array();
				return $result_app;
			}
			else if(!empty($data['order_type']) && $data['order_type']=="2"){
				//Order From Network App
				$qry_net_app="select  d.id,d.mobile driver_phone,d.status driver_status,d.profile_pic,d.latitude as lat,d.longitude as lng,make,model,color,r.id as ride_request_id,
							2 AS order_type,c.name customer_name,d.name driver_name,r.datetime,r.status order_status,c.mobile,r.pickup_location,r.payment_type,r.drop_location from 
						request_driver r,customer c,ride_request rr,driver d where d.id=rr.driver_id and rr.ride_request_id=r.id and c.id=r.customer_id 
						$net_where $name_where $driver_where $location_where $records_between $request_search_cust_phone";
				$query_net_app = $this->db->query($qry_net_app,true);
				$result_net_app = $query_net_app->result_array();
				return $result_net_app;
			}
			else if(!empty($data['order_type']) && $data['order_type']=="3"){
				//Order From Dashboard
				$qry_dashboard="select  d.id,d.mobile driver_phone,d.status driver_status,d.profile_pic,d.latitude as lat,d.longitude as lng,make,model,color,r.id as ride_request_id,
								1 AS order_type,o.customer_name customer_name,d.name driver_name,o.pickup_time datetime,r.status order_status,o.customer_telephone mobile,r.pickup_location,o.payment_method payment_type,r.drop_location from 
						request_driver r,`order` o,driver d	where r.order_id=o.id and d.id=o.driver_id 
						$dash_where  $name_where $driver_where $pickup_records_between $order_search_cust_phone";
				$query_dashboard = $this->db->query($qry_dashboard,true);
				$result_dashboard = $query_dashboard->result_array();
				return $result_dashboard;
			}
			else if(!empty($data['order_type']) && $data['order_type']=="4"){
				//Order From Network Dashboard Referal
				$result_referal_dashboard=array();
				$qry_referal_dashboard="select  d.id,d.mobile driver_phone,d.status driver_status,d.profile_pic,d.latitude as lat,d.longitude as lng,make,model,color,r.id as ride_request_id,
										3 AS order_type,o.customer_name customer_name,d.name driver_name,o.pickup_time datetime,r.status order_status,o.customer_telephone mobile,r.pickup_location,o.payment_method payment_type,r.drop_location from 
						request_driver r,`order` o,driver d	where r.order_id=o.id and  d.id=o.driver_id 
						$net_dash_where $name_where $driver_where $pickup_records_between $order_search_cust_phone";
				$query_referal_dashboard = $this->db->query($qry_referal_dashboard,true);
				$result_referal_dashboard = $query_referal_dashboard->result_array();
				//echo "Hello<pre>";print_r($result_referal_dashboard);echo"</pre>hello";
				return $result_referal_dashboard;
			}
			else{
				if($data['order_status']==""){
					$app_sts=" and (rr.status=1 or rr.status=4) ";
					$dash_sts=" and  (o.Order_Done=1 or o.Order_Done=2) ";
				}else if($data['order_status']=="1"){
					$app_sts=" and rr.status=1 ";
					$dash_sts=" and  o.Order_Done=1 ";
				}else{
					$app_sts=" and rr.status=4 ";
					$dash_sts=" and  o.Order_Done=2 ";
				}
				//Order From App
				$qry_app="select d.id,d.mobile driver_phone,d.status driver_status,d.profile_pic,d.latitude as lat,d.longitude as lng,make,model,color,r.id as ride_request_id,
						0 AS order_type,c.name customer_name,d.name driver_name,r.datetime,r.status order_status,c.mobile,r.pickup_location,r.payment_type,r.drop_location from 
						request_driver r,customer c,ride_request rr,driver d where d.id=rr.driver_id and rr.ride_request_id=r.id and c.id=r.customer_id 
						and r.order_type=0 $app_sts $name_where $driver_where $location_where $records_between $request_search_cust_phone";
				$query_app = $this->db->query($qry_app,true);
				$result_app = $query_app->result_array();
				//Order From Network App
				$qry_net_app="select  d.id,d.mobile driver_phone,d.status driver_status,d.profile_pic,d.latitude as lat,d.longitude as lng,make,model,color,r.id as ride_request_id,
						2 AS order_type,c.name customer_name,d.name driver_name,r.datetime,r.status order_status,c.mobile,r.pickup_location,r.payment_type,r.drop_location from 
						request_driver r,customer c,ride_request rr,driver d where d.id=rr.driver_id and rr.ride_request_id=r.id and c.id=r.customer_id 
					    and r.order_type=2 $app_sts $name_where $driver_where $location_where $records_between $request_search_cust_phone";
				$query_net_app = $this->db->query($qry_net_app,true);
				$result_net_app = $query_net_app->result_array();
				//Order From Dashboard
				$qry_dashboard="select  d.id,d.mobile driver_phone,d.status driver_status,d.profile_pic,d.latitude as lat,d.longitude as lng,make,model,color,r.id as ride_request_id,
						1 AS order_type,o.customer_name customer_name,d.name driver_name,o.pickup_time datetime,r.status order_status,o.customer_telephone mobile,r.pickup_location,o.payment_method payment_type,r.drop_location from 
						request_driver r,`order` o,driver d	where r.order_id=o.id and d.id=o.driver_id 
						$dash_sts and o.company_id='".$_SESSION['company_id']."'  $location_where $name_where $driver_where $pickup_records_between $order_search_cust_phone";
				$query_dashboard = $this->db->query($qry_dashboard,true);
				$result_dashboard = $query_dashboard->result_array();
				//Order From Network Dashboard Referal
				$qry_referal_dashboard="select  d.id,d.mobile driver_phone,d.status driver_status,d.profile_pic,d.latitude as lat,d.longitude as lng,make,model,color,r.id as ride_request_id,
						3 AS order_type,o.customer_name customer_name,d.name driver_name,o.pickup_time datetime,r.status order_status,o.customer_telephone mobile,r.pickup_location,o.payment_method payment_type,r.drop_location from 
						request_driver r,`order` o,driver d	where r.order_id=o.id and  d.id=o.driver_id 
						$dash_sts and o.referal_location_id IN(select location_id from location where company_id='".$_SESSION['company_id']."')  $location_where $name_where $driver_where $pickup_records_between $order_search_cust_phone";
				$query_referal_dashboard = $this->db->query($qry_referal_dashboard,true);
				$result_referal_dashboard = $query_referal_dashboard->result_array();
				$final_result=array_merge($result_app,$result_net_app,$result_dashboard,$result_referal_dashboard);
				return $final_result;
			}
			
		}
		else{
			//Order From App
			
			$qry_app="select d.id,d.mobile driver_phone,d.status driver_status,d.profile_pic,d.latitude as lat,d.longitude as lng,make,model,color,r.id as ride_request_id,
					0 AS order_type,c.name customer_name,d.name driver_name,r.datetime,r.status order_status,c.mobile,r.pickup_location,r.payment_type,r.drop_location from 
					request_driver r,customer c,ride_request rr,driver d where d.id=rr.driver_id and rr.ride_request_id=r.id and c.id=r.customer_id 
					and r.order_type=0  and  r.location_id IN(select location_id from location where company_id='".$_SESSION['company_id']."') $request_search_cust_phone";
			$query_app = $this->db->query($qry_app,true);
			$result_app = $query_app->result_array();
			//Order From Network App
			$qry_net_app="select  d.id,d.mobile driver_phone,d.status driver_status,d.profile_pic,d.latitude as lat,d.longitude as lng,make,model,color,r.id as ride_request_id,
			2 AS order_type,c.name customer_name,d.name driver_name,r.datetime,r.status order_status,c.mobile,r.pickup_location,r.payment_type,r.drop_location from 
							request_driver r,customer c,ride_request rr,driver d where d.id=rr.driver_id and rr.ride_request_id=r.id and c.id=r.customer_id 
							and r.order_type=2  and r.location_id IN(select location_id from location where company_id='".$_SESSION['company_id']."') $request_search_cust_phone";
			$query_net_app = $this->db->query($qry_net_app,true);
			$result_net_app = $query_net_app->result_array();
			//Order From Dashboard
			$qry_dashboard="select  d.id,d.mobile driver_phone,d.status driver_status,d.profile_pic,d.latitude as lat,d.longitude as lng,make,model,color,r.id as ride_request_id,
			1 AS order_type,o.customer_name customer_name,d.name driver_name,o.pickup_time datetime,r.status order_status,o.customer_telephone mobile,r.pickup_location,o.payment_method payment_type,r.drop_location from 
							request_driver r,`order` o,driver d	where r.order_id=o.id and d.id=o.driver_id 
							and  (o.Order_Done=1 or o.Order_Done=2) and o.company_id='".$_SESSION['company_id']."' $order_search_cust_phone";
			$query_dashboard = $this->db->query($qry_dashboard,true);
			$result_dashboard = $query_dashboard->result_array();
			//Order From Network Dashboard Referal
			$qry_referal_dashboard="select  d.id,d.mobile driver_phone,d.status driver_status,d.profile_pic,d.latitude as lat,d.longitude as lng,make,model,color,r.id as ride_request_id,
						3 AS order_type,o.customer_name customer_name,d.name driver_name,o.pickup_time datetime,r.status order_status,o.customer_telephone mobile,r.pickup_location,o.payment_method payment_type,r.drop_location from 
							request_driver r,`order` o,driver d	where r.order_id=o.id and  d.id=o.driver_id  
							and  (o.Order_Done=1 or o.Order_Done=2) and o.referal_location_id IN(select location_id from location where company_id='".$_SESSION['company_id']."') $order_search_cust_phone";
			
			$query_referal_dashboard = $this->db->query($qry_referal_dashboard,true);
			$result_referal_dashboard = $query_referal_dashboard->result_array();
			$final_result=array_merge($result_app,$result_net_app,$result_dashboard,$result_referal_dashboard);
			return $final_result;
		}
    }
    
    function updatePaymentMethod($ride_request_id,$payment_type,$order_type)
    {
		
		if($order_type=="1" || $order_type=="3")
		{
			$data=array('payment_method'=>$payment_type);
			$query="select order_id from request_driver where id='".$ride_request_id."'";
			$qry = $this->db->query($query,true);
			$result = $qry->row();
			$order_id=$result->order_id;
			$query	=	$this->db->WHERE('id', $order_id);
			$query 	=	$this->db->UPDATE('order', $data);			
		}else{
			$data=array('payment_type'=>$payment_type);
			$query	=	$this->db->WHERE('id', $ride_request_id);
			$query 	=	$this->db->UPDATE('request_driver', $data);
		}
		$result=array('payment_type'=>$payment_type);
		return $result;
	}
	
    function get_order_detail($ride_request_id,$order_type){
		if($order_type=="1" || $order_type=="3")
		{
			$query="select d.name driver_name,order_type,o.pickup_time datetime,d.status driver_status,o.customer_name customer_name,o.customer_telephone mobile,
					o.pickup_address pickup_location,o.payment_method payment_type,o.destination drop_location,r.id as ride_request_id from 
					request_driver r,`order` o,driver d	where r.order_id=o.id and  d.id=o.driver_id  and  r.id='".$ride_request_id."'";
		}
		else{
			$query="select d.name driver_name,order_type,r.datetime,d.status driver_status,c.name customer_name,c.mobile,
					r.pickup_location,r.payment_type,r.drop_location,r.id as ride_request_id from 
					request_driver r,customer c,ride_request rr,driver d where d.id=rr.driver_id and rr.ride_request_id=r.id and c.id=r.customer_id 
					and  r.id='".$ride_request_id."'";
		}
		$query_referal_dashboard = $this->db->query($query,true);
		$result_referal_dashboard = $query_referal_dashboard->result_array();
		return $result_referal_dashboard;
	}
	
    function edit_data($id) 
	{
	
		$this->db->SELECT('*');
		$this->db->FROM('order');
		$this->db->WHERE('id', $id);
		$query=$this->db->get();
		return $query->row_array();
	}


	//Function to update data in the database
	function update_data($id, $data) 
	{
	
		$query	=	$this->db->WHERE('id', $id);
		$query 	=	$this->db->UPDATE('order', $data);
		return $query;
		//return $this->db->update('employees', $data, array('id' => $id)); // optional method to update data in one line as an array; just remove the comment tag in front of 'return'.
	
	}


	//Function to delete data in the database
	function delete_data($id) 
	{
		
		 $this->db->where('id', $id);
		 $this->db->delete('order');
		
		// $this->db->delete('employees', array('id' => $id)); // optional method to delete data in one line as an array; just remove the comment tag in front of 'return'.
	}

	function get_location_name() 
    {
			$qry="select location_id,location_cab_alias from location where company_id=".$_SESSION['company_id']. " order by location_name DESC";
			$query_dashboard = $this->db->query($qry,true);
			$result = $query_dashboard->result_array();
			return $result;
    }
    
    
    function get_driver_status() 
    {
		
			$return[''] = 'Driver Status';
			$this->db->select('id,status');
			$this->db->from('driver');
		    $this->db->where('company_id=2');
			$query = $this->db->get(); 
			foreach($query->result_array() as $row)
			{
				$return[$row['company_id']] = $row['status'];
			}
			return $return;
     }
     
     function get_driver()
     {
	   
		   $where = "company_id='2'";
		   $query = $this->db->where($where);
		   $query = $this->db->get('driver');
		   $result = $query->result_array();
		   return $result;;
       
     }  
}
?>
