<?php
class Dashboard_model extends CI_Model 
{

    function __construct()
    {
        parent::__construct(); 
        
    }  
   
    
     function get_details()
   {
	   $query = $this->db->get('register');
	   $result = $query->result_array();
	   return $result;
   }  
   
   function get_users()
   {
	  $query = $this->db->query("SELECT COUNT('id') as id FROM register");
	  
	  $result = $query->result_array();
	 
	  return $result;
   }
   
   function get_transaction()
   {
	  $query = $this->db->query("SELECT COUNT('id') as id FROM transaction_logs");
	  
	  $result = $query->result_array();
	 
	  return $result;
   }
   
   function cancel_orders()
   {
	    $query = $this->db->query("SELECT COUNT('id') as id FROM transaction_logs where status='2'");
	  
	    $result = $query->result_array();
	 
	    return( $result );
	    
   }
   
   function get_adminCommission()
   {
	  $query = $this->db->query("SELECT commission  FROM admin");
	  
	  $result = $query->result_array();
	 
	  return $result;
   }
 
}
?>
