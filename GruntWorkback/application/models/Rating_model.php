<?php
class Rating_model extends CI_Model 
{

    function __construct()
    {
        parent::__construct(); 
        
    }  

    
   function get_rating()
   {
	   $query = $this->db->query("select user_id,borrower_rating,lender_rating,feedback from register");
	   $result = $query->result_array();
	   return $result;
   }
   
}

?>
