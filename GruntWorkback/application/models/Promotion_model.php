<?php
class Promo_model extends CI_Model 
{

    function __construct()
    {
        parent::__construct(); 
        
    }  
    public function insertPromotion($data)
    {  
          $array = array(
              'promotion_name'=>$data['promotion_name'],
              'promotion_code'=>$data['promotion_code'],
              'discounted%'=>$data['discounted%'],
              'expiration'=>$data['expiration']
            );
            $query = $this->db->insert_string('promotion',$array);             
            $this->db->query($query);
            return $this->db->insert_id();
    }
    
    function get_details()
   {
	   $query = $this->db->get('promotion');
	   $result = $query->result_array();
	   return $result;
   }
}

?>
