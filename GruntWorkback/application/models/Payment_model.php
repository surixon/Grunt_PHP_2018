<?php
class Payment_model extends CI_Model 
{

    function __construct()
    {
        parent::__construct(); 
        
    }  

    
   function get_payment()
   {
	   $query = $this->db->query("select * from payment_method");
	   $result = $query->result_array();
	   return $result;
   }
   
}

?>
