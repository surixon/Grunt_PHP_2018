<?php
class Company_model extends CI_Model 
{
    function __construct()
    {
        parent::__construct(); 
        
    }  
    public function insertCompany($data)
    {  
            $query = $this->db->insert_string('location',$data);             
            $this->db->query($query);
            return $this->db->insert_id();
    }
    
    
    
    public function isDuplicate($email)
    {     
        $this->db->get_where('location', array('location_email' => $email), 1);
        return $this->db->affected_rows() > 0 ? TRUE : FALSE;         
    }
    
    public function isDuplicateCabAlias($location_cab_alias)
    {     
        $this->db->get_where('location', array('location_cab_alias' => $location_cab_alias), 1);
        return $this->db->affected_rows() > 0 ? TRUE : FALSE;         
    }
    
    function get_details()
    {
	   $query = $this->db->get('location');
	   $result = $query->result_array();
	   return $result;
    }  
   
   //Function to take to edit data screen based on the selected id
	function editCompany($location_id) 
	{
	
		$this->db->SELECT('*');
		$this->db->FROM('location');
		$this->db->WHERE('location_id', $location_id);
		$query=$this->db->get();

		return $query->row_array(); 
	
	}


	//Function to update data in the database
	function updateCompany($data,$location_id) 
	{
	
		$query	=	$this->db->WHERE('location_id', $location_id);
		$query 	=	$this->db->UPDATE('location', $data);
		return $query;
		//return $this->db->update('employees', $data, array('id' => $id)); // optional method to update data in one line as an array; just remove the comment tag in front of 'return'.
	
	}
	
	public function add_network_jobs_to_other_companies($data,$company_id)
    {  
        $query	=	$this->db->WHERE('company_id', $company_id);
		$query 	=	$this->db->UPDATE('company', $data);
		return $query;
    }


	//Function to delete data in the database
	function delete_location_data($location_id) 
	{
		
		 $this->db->where('location_id', $location_id);
		 $this->db->delete('location');
		 return 1;
		// $this->db->delete('employees', array('id' => $id)); // optional method to delete data in one line as an array; just remove the comment tag in front of 'return'.
	}
	
	//GET Location Name
	function get_location() 
    {
	    $return[''] = 'Select Location Name';
		$this->db->order_by('location_name', 'asc'); 
		$query = $this->db->get('company'); 
		foreach($query->result_array() as $row)
	    {
			$return[$row['company_id']] = $row['location_name'];
	    }
		    $out=array_unique($return);
			return $out;
    }
    
	//GET network_jobs_companies
	function network_jobs_companies($company_id) 
    {
	    $this->db->SELECT('*');
		$this->db->FROM('company');
		$this->db->WHERE('company_id', $company_id);
		$query=$this->db->get();

		return $query->row_array(); 
    }
   
}
?>
