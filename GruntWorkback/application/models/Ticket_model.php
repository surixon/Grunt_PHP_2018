<?php
class Ticket_model extends CI_Model 
{
    function __construct()
    {
        parent::__construct(); 
        
    }  
   function get_pending_tickets()
   {
	   $query = $this->db->query("select * from customer_support where status=0");
	   $result = $query->result_array();
	   return $result;
   }
   function get_completed_tickets()
   {
	   $query = $this->db->query("select * from customer_support where status=1");
	   $result = $query->result_array();
	   return $result;
   }
   
    public function user_detail($user_id)
    {
		 $query = $this->db->query("select cs.message,r.* from customer_support cs
		                           ,register r where cs.user_id=r.user_id and r.user_id='".$user_id."'");
	   $result = $query->result_array();
	   return $result;
    }
}   
