<?php
class Driver_model extends CI_Model 
{

    function __construct()
    {
        parent::__construct(); 
        
    }  
    public function insertDriver($data)
    {  
          $array = array(
              'location_id'=>$data['location_name'],
              'address'=>$data['address'],
              'city'=>$data['city'],
              'state'=>$data['state'],
              'zip'=>$data['zip'],
              'mobile'=>$data['mobile'],
              'driver_license'=>$data['driver_license'],
              'name'=>$data['name'],
              'make'=>$data['make'],
              'model'=>$data['model'],
              'year'=>$data['year'],
              'color'=>$data['color'],
              'lic_plate'=>$data['lic_plate'],
              'driver%'=>$data['driver%'],
              'company%'=>$data['company%'],
              'password'=>$data['password'],  
              'verified_status'=>1, 
              'email'=>$data['email']
            );
            $query = $this->db->insert_string('driver',$array);             
            $this->db->query($query);
            return $this->db->insert_id();
    }
    public function isDuplicate($email)
    {     
        $this->db->get_where('driver', array('email' => $email), 1);
        return $this->db->affected_rows() > 0 ? TRUE : FALSE;         
    }
    
    function get_details()
   {
	   //~ $query = $this->db->get('driver');
	   $query = $this->db->query("select l.location_cab_alias location_name,d.id,d.name,CONCAT_WS(',', d.address, d.city, d.state, d.zip) address,d.mobile,d.driver_license,d.email,d.make,d.model,d.year,d.color,d.lic_plate,d.color,`driver%`,`company%`,d.date_created,(
									CASE 
										WHEN status = '0' THEN 'OFFLINE'
										WHEN status = '1' THEN 'AVAILABLE'
										WHEN status = '2' THEN 'INPROGRESS'
										WHEN status = '3' THEN 'BUSY'
									END) status from driver d,location l where d.location_id=l.location_id and  d.location_id IN(SELECT location_id FROM location where company_id='".$_SESSION['company_id']."')");
	   $result = $query->result_array();
	   return $result;
   }  
   
    function fetchCompanyLocations($company_id)
   {
	   $query = $this->db->query("select * from location where company_id=$company_id");
	   $result = $query->result_array();
	   return $result;
   }  
   
   //~ function checkLocation($location_name){
	   //~ 
	   //~ $this->db->SELECT('location_id as id');
	   //~ $this->db->FROM('location');
	   //~ $array=array('location_cab_alias'=>$location_name,'location_telephone'=>$location_name);
	   //~ $this->db->or_where($array);
	   //~ $query=$this->db->get();
	   //~ $result = $query->result();
	   //~ return $result;
   //~ }
   
   function editDriver($driver_id) 
   {
	
		$this->db->SELECT('*');
		$this->db->FROM('driver');
		$this->db->WHERE('id', $driver_id);
		$query=$this->db->get();

		return $query->row_array(); 
	
   }
   
	//Function to update data in the database
	function updateDriver($data, $id) 
	{
	
		$query	=	$this->db->WHERE('id', $id);
		$query 	=	$this->db->UPDATE('driver', $data);
		return $query;
		//return $this->db->update('employees', $data, array('id' => $id)); // optional method to update data in one line as an array; just remove the comment tag in front of 'return'.
	
	}


	//Function to delete data in the database
	function deleteDriver($id) 
	{
		
		 $this->db->where('id', $id);
		 $this->db->delete('driver');
		 return 1;
		// $this->db->delete('employees', array('id' => $id)); // optional method to delete data in one line as an array; just remove the comment tag in front of 'return'.
	}
  
}
?>
