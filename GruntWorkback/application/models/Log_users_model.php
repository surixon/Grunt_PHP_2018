<?php
class Log_users_model extends CI_Model 
{
    function __construct()
    {
        parent::__construct(); 
        
    }  
   function get_logs()
   {
	   $query = $this->db->query("select * from logs");
	   $result = $query->result_array();
	   return $result;
   }
}

?>
