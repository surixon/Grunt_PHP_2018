<?php
class Job_details_model extends CI_Model 
{
    function __construct()
    {
        parent::__construct(); 
        
    }  
   function get_jobs()
   {
	   $query = $this->db->query("select * from jobPost");
	   $result = $query->result_array();
	   return $result;
   }
   
  public function insert_one_row($table, $data)
   {	
       $query = $this->db->insert($table, $data);        
       
       return $this->db->insert_id();
   }
    
	
	function editJob($job_id) 
	{
	
		$this->db->SELECT('*');
		$this->db->FROM('jobPost');
		$this->db->WHERE('job_id', $job_id);
		$query = $this->db->get();

		return $query->row_array(); 
	
	}


	//Function to delete data in the database
	function jobDelete($job_id) 
	{
		
		 $this->db->where('job_id', $job_id);
		 $this->db->delete('jobPost');
		return 1;
		// $this->db->delete('employees', array('id' => $id)); // optional method to delete data in one line as an array; just remove the comment tag in front of 'return'.
	}
	
   public function job_detail($job_id)
   {
	$this->db->select('*');
    $this->db->from('jobPost');
    $this->db->where('job_id=',$job_id);
    $query = $this->db->get();
    $result = $query->result_array();
   
	return $result;
	   
	   
   }
   
   public function update_record_by_id($table, $data, $where)
    {
        $query = $this->db->update($table, $data, $where);
   // print_r($this->db->last_query());
    return 1;    
   } 
	
	
}

?>
