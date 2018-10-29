<?php
class Users_model extends CI_Model 
{
    function __construct()
    {
        parent::__construct(); 
        
    }  
   function get_users()
   {
	   $query = $this->db->query("select * from register");
	   $result = $query->result_array();
	   return $result;
   }
   function get_user($user_id)
   {
	   		$this->db->SELECT('*');
		$this->db->FROM('register');
		$this->db->WHERE('user_id', $user_id);
		$query =	$this->db->get();

		return $query->row_array(); 
   }
   
    public function insert_one_row($table, $data)
   {	
       $query = $this->db->insert($table, $data);        
       
       return $this->db->insert_id();
   }
    
    function edit_Users($user_id) 
	{
	
		$this->db->SELECT('*');
		$this->db->FROM('register');
		$this->db->WHERE('user_id', $user_id);
		$query =	$this->db->get();

		return $query->row_array(); 
	
	}



	//Function to delete data in the database
	function userDelete($user_id) 
	{
		
		 $this->db->where('user_id', $user_id);
		 $this->db->delete('register');
		return 1;
		// $this->db->delete('employees', array('id' => $id)); // optional method to delete data in one line as an array; just remove the comment tag in front of 'return'.
	}
	
	
	public function update_record_by_id($table, $data, $where)
    {
        $query = $this->db->update($table, $data, $where);
   // print_r($this->db->last_query());
    return 1;    
   } 
   
    public function user_detail($user_id)
    {
		$this->db->select('*');
		$this->db->from('register');
		$this->db->where('user_id=',$user_id);
		$query = $this->db->get();
		$result = $query->result_array();
		return $result;
    }
   
}

?>
