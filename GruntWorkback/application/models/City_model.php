<?php
class City_model extends CI_Model 
{

    function __construct()
    {
        parent::__construct(); 
        
    }  
   public function insertCity($clean)
    {  
            $query = $this->db->insert('location',$clean);             
           
    }
    
    function get_city()
   {
	   $query = $this->db->query("select * from location");
	   $result = $query->result_array();
	   return $result;
   }
   
   //Function to take to edit data screen based on the selected id
	function editLocation($id) 
	{
	
		$this->db->SELECT('*');
		$this->db->FROM('location');
		$this->db->WHERE('id', $id);
		$query =	$this->db->get();

		return $query->row_array(); 
	
	}


	//Function to update data in the database
	function updateLocation($data,$id) 
	{
	
		$query	=	$this->db->WHERE('id', $id);
		$query 	=	$this->db->UPDATE('location', $data);
		return $query;
		//return $this->db->update('employees', $data, array('id' => $id)); // optional method to update data in one line as an array; just remove the comment tag in front of 'return'.
	
	}


	//Function to delete data in the database
	function deleteLocation($id) 
	{
		
		 $this->db->where('id', $id);
		 $this->db->delete('location');
		return 1;
		// $this->db->delete('employees', array('id' => $id)); // optional method to delete data in one line as an array; just remove the comment tag in front of 'return'.
	}
}

?>
