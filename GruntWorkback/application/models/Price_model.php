<?php
class Price_model extends CI_Model 
{
    function __construct()
    {
        parent::__construct(); 
        
    }  
    public function insertSedanPrice($data)
    {  
		
        $query = $this->db->insert_string('pricing',$data);             
		$this->db->query($query);
		return $this->db->insert_id();
    }
    
    public function updateSedanPrice($data,$company_id)
    {  
		$array = array('company_id' => $company_id, 'car_type' => 1);
        $query	=	$this->db->WHERE($array);
		$query 	=	$this->db->UPDATE('pricing', $data);
		return $query;
    }
    
    function getSedanPricing($company_id)
    {
		$array = array('company_id' => $company_id, 'car_type' => 1);
		$this->db->SELECT('*');
		$this->db->FROM('pricing');
		$this->db->WHERE($array);
		$query=$this->db->get();

		return $query->row_array(); 
    }    
    
    public function insertSUVPrice($data)
    {  
		
        $query = $this->db->insert_string('pricing',$data);             
		$this->db->query($query);
		return $this->db->insert_id();
    }
    
    public function updateSUVPrice($data,$company_id)
    {  
		$array = array('company_id' => $company_id, 'car_type' => 2);
        $query	=	$this->db->WHERE($array);
		$query 	=	$this->db->UPDATE('pricing', $data);
		return $query;
    }
    
    function getSUVPricing($company_id)
    {
		$array = array('company_id' => $company_id, 'car_type' => 2);
		$this->db->SELECT('*');
		$this->db->FROM('pricing');
		$this->db->WHERE($array);
		$query=$this->db->get();

		return $query->row_array(); 
    }    
}
