<?php

class Items_model extends CI_Model {

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

	function SaveForm($form_data)
	{
		$this->db->insert('items', $form_data);
		
		if ($this->db->affected_rows() == '1')
		{
			return TRUE;
		}
		
		return FALSE;
	}
	
	
	function get_contents() {
		
         $sql = "select * from category ";
          $query = $this->db->query($sql);
		  $sesarray=array();
		  
        $result = $query->result_array();
		
		
         return $result;
    }
	
	
	
	function Get_Items()
	{
		 $sql = "select * from items order by dateadded desc ";
          $query = $this->db->query($sql);
		  $sesarray=array();
		  
        $result = $query->result_array();
		
		
         return $result;
	}
	
	
	
	public function get_books()
     {
          return $this->db->get("items");
     }
	 
	 
	 
	 public function deleteRecord($table, $where = array()) {
  $this->db->where($where);
  $res = $this->db->delete($table); 
  if($res)
    return TRUE;
  else
    return FALSE;
}







function getMyItem($id) {
		
         $sql = "SELECT * from items where itemid='".$id."' ";
           $query = $this->db->query($sql);
		  $sesarray=array();
		  
        $result = $query->result_array();
		
		
         return $result;
    }




function UpdateItem($username,$form_data)
	{
//$this->db->where('username', $username);
//$this->db->update('staff', $form_data);

$this->db->where('itemid',$username);  
$this->db->update('items', $form_data);   

if ($this->db->affected_rows() > 0)
{
  return TRUE;
}
else
{
  return FALSE;
}
	}
	
	






	
	
}
?>