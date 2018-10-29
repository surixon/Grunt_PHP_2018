<?php
class Login_model extends CI_Model 
{

    function __construct()
    {
        parent::__construct(); 
        
    }
    
   public function checkUser($checkUser)
    {  
		$result=array();
		$qry="select * from admin where username='".$checkUser['username']."' AND password='".$checkUser['password']."'";
		$query_driver = $this->db->query($qry,true);
		$result = $query_driver->result();
		return $result;
            
    }
    
}
?>
