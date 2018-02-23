<?php

class Spoilt_model extends CI_Model {

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
		$this->db->insert('spoilt_items', $form_data);
		
		if ($this->db->affected_rows() == '1')
		{
			return TRUE;
		}
		
		return FALSE;
	}
	
	
	
	function get_contents() {
		
         $sql = "select * from items ";
          $query = $this->db->query($sql);
		  $sesarray=array();
		  
        $result = $query->result_array();
		
		
         return $result;
    }
	
	
	  public function get_books()
     {
        //  return $this->db->get("sale");
		  
		  $sql = "SELECT `spoiltno` , `itemno` , `quantity` , `describe` , `recordedby` , `daterecorded` , fullname, itemname
FROM `spoilt_items` , staff, items
WHERE items.itemid = spoilt_items.itemno
AND spoilt_items.recordedby = staff.username ";
          $query = $this->db->query($sql);
		
         return $query;
		  
     }
	 
	
	
	
	
	
	public function deleteRecord($table, $where = array()) {
  $this->db->where($where);
  $res = $this->db->delete($table); 
  if($res)
    return TRUE;
  else
    return FALSE;
}







function getMySpoilt($id) {
		
         $sql = "SELECT * from spoilt_items where spoiltno='".$id."' ";
           $query = $this->db->query($sql);
		  $sesarray=array();
		  
        $result = $query->result_array();
		
		
         return $result;
    }




function UpdateSpoilt($username,$form_data)
	{
//$this->db->where('username', $username);
//$this->db->update('staff', $form_data);

$this->db->where('spoiltno',$username);  
$this->db->update('spoilt_items', $form_data);   

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