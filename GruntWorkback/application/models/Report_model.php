<?php
class Report_model extends CI_Model 
{

    function __construct()
    {
        parent::__construct(); 
        
    }  
    
    public function insertReport($d1)
    {  
          $string1 = array
          (
              'driver_name'=>$d1['driver_name'],
              'by_date'=>$d1['by_date'],
              'to_date'=>$d1['to_date'],
              'corporation_name'=>$d1['corporation_name'],
              'payment_status'=>$d1['payment_status']
          );
            $query = $this->db->insert_string('reports',$string1);             
            $this->db->query($query);
            return $this->db->insert_id();
    }
    
    function get_details()
    {
	   $query = $this->db->get('customer');
	   $query = $this->db->get('reports');
	   $result = $query->result_array();
	   return $result;
    }  
   
   //GET CORPORATION NAME
	function get_corporation_name() 
    {
			$return[''] = 'Corporation Name';
    
			$this->db->order_by('corporation_name', 'asc'); 
			$query = $this->db->get('corp_acct'); 
			foreach($query->result_array() as $row)
			{
					$return[$row['id']] = $row['corporation_name'];
			}
					$out=array_unique($return);
					return $out;
    }
    
    function get_driver_name() 
    {
			$return[''] = 'Driver Name';
    
			$this->db->order_by('name', 'asc'); 
			$query = $this->db->get('driver'); 
			foreach($query->result_array() as $row)
			{
					$return[$row['id']] = $row['name'];
			}
					$out=array_unique($return);
					return $out;
    }
    
    function get_datetime()
    {
		$this->db->where('startjob >=', $by_date);
		$this->db->where('endjob <=', $to_date);
		return $this->db->get('order');
    } 

    function order_details()
     {
		 $query = $this->db->get('corp_acct'); 
		 //~ $this->db->where('startjob >=', $by_date);
		//~ $this->db->where('endjob <=', $to_date);
	   $query = $this->db->get('order');
	  
	   $result = $query->result_array();
	   return $result;
    }  
    
    
    function get_driver()
    {
		$this->db->select('name');
        $this->db->from('driver');
        $query = $this->db->get();
        return $query->result();
    }
    
    function get_week()
    {
		$this->db->select('*');
        $this->db->where('start_date >= curdate() - INTERVAL DAYOFWEEK(curdate())+6 DAY
                          AND end_date < curdate() - INTERVAL DAYOFWEEK(curdate())-1 DAY');
        $result = $this->db->get('order');
	}   
   
}
?>
