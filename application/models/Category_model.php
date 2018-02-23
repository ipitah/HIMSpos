<?php

class Category_model extends CI_Model {

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
		$this->db->insert('category', $form_data);
		
		if ($this->db->affected_rows() == '1')
		{
			return TRUE;
		}
		
		return FALSE;
	}
	
	
	
	
	
	
	public function get_books()
     {
          return $this->db->get("category");
     }
	 
	 
	 
	 public function deleteRecord($table, $where = array()) {
  $this->db->where($where);
  $res = $this->db->delete($table); 
  if($res)
    return TRUE;
  else
    return FALSE;
}
	
	
	
	
	function UpdateCat($username,$form_data)
	{
//$this->db->where('username', $username);
//$this->db->update('staff', $form_data);

$this->db->where('catid',$username);  
$this->db->update('category', $form_data);   

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