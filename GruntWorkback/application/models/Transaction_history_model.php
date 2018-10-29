<?php
class Transaction_history_model extends CI_Model 
{

    function __construct()
    {
        parent::__construct(); 
        
    }  

    
    function get_logs()
   {
	   $query = $this->db->query("select * from transaction_logs");
	   $result = $query->result_array();
	   return $result;
   }
   
   public function transaction_detail($transaction_id)
   {
	$this->db->select('*');
    $this->db->from('transaction_logs');
    $this->db->where('transaction_id=',$transaction_id);
    $query = $this->db->get();
    $result = $query->result_array();
   
	return $result;
	   
	   
   }
   
}

?>
