<?php
   if (!defined('BASEPATH'))
        exit('No direct script access allowed');


	class Login_model extends CI_Model {

	function __construct()
	{
		parent::__construct();
	}
	
	// --------------------------------------------------------------------

      /** 
       * function SaveForm()
       *
       * insert form data
       * @param $form_data - array
       * @return Bool - TRUE or FALSE
       */

	
	//get the username & password from tbl_usrs
     function get_user($usr, $pwd)
     {
          $sql = "select * from staff where username = '" . $usr . "' and password = '" .md5($pwd) . "' ";
          $query = $this->db->query($sql);
          return $query->num_rows();
     }
	
	function get_contents($usr, $pwd) {
		
         $sql = "select * from staff where username = '" . $usr . "' and password = '" .md5($pwd) . "' ";
          $query = $this->db->query($sql);
		  $sesarray=array();
		  
        $result = $query->result_array();
		
		
         return $result;
    }
	
	
	
	
	
}
?>