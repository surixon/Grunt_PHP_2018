<?php
class Corp_model extends CI_Model 
{

    function __construct()
    {
        parent::__construct(); 
        
    }  
    public function insertCorporation($data)
    {  
            $query = $this->db->insert_string('corp_acct',$data);             
            $this->db->query($query);
            return $this->db->insert_id();
    }
    public function isDuplicate($email)
    {     
        $this->db->get_where('corp_acct', array('email' => $email), 1);
        return $this->db->affected_rows() > 0 ? TRUE : FALSE;         
    }
    
    function get_details()
   {
	   $query = $this->db->get('corp_acct');
	   $result = $query->result_array();
	   return $result;
   }
   
   function editCorporation($corp_id){
	    $this->db->SELECT('*');
		$this->db->FROM('corp_acct');
		$this->db->WHERE('id', $corp_id);
		$query =	$this->db->get();

		return $query->row_array(); 
   }
   
   //Function to take to edit data screen based on the selected id
	function edit_data($id) 
	{
	
		$this->db->SELECT('corporation_name, address, city, state, zip,mobile ,account_id ,contact_name ,email');
		$this->db->FROM('corp_acct');
		$this->db->WHERE('id', $id);
		$query =	$this->db->get();

		return $query->row_array(); 
	
	}


	//Function to update data in the database
	function updateCorp($data, $corp_id) 
	{
	
		$query	=	$this->db->WHERE('id', $corp_id);
		$query 	=	$this->db->UPDATE('corp_acct', $data);
		return $query;
		//return $this->db->update('employees', $data, array('id' => $id)); // optional method to update data in one line as an array; just remove the comment tag in front of 'return'.
	
	}


	//Function to delete data in the database
	function deleteCorp($id) 
	{
		
		 $this->db->where('id', $id);
		 $this->db->delete('corp_acct');
		return 1;
		// $this->db->delete('employees', array('id' => $id)); // optional method to delete data in one line as an array; just remove the comment tag in front of 'return'.
	}
}
?>
