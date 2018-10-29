<?php
class Promo_model extends CI_Model 
{

    function __construct()
    {
        parent::__construct(); 
        
    }  

    
   function get_borrower_rating()
   {
	   $query = $this->db->query("select * from borrower_rating");
	   $result = $query->result_array();
	   return $result;
   }
   
   function get_lender_rating()
   {
	   $query = $this->db->query("select * from lender_rating");
	   $result = $query->result_array();
	   return $result;
   }
}

?>
