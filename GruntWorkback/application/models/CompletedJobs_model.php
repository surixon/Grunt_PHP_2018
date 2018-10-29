<?php
class CompletedJobs_model extends CI_Model 
{
    function __construct()
    {
        parent::__construct(); 
        
    }  
   function get_jobs()
   {
	   $query = $this->db->query("select * from jobPost where status = 3");
	   $result = $query->result_array();
	   return $result;
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
}

?>
