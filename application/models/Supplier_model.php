<?php

class Supplier_model extends CI_Model {

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
		$this->db->insert('supplier', $form_data);
		
		if ($this->db->affected_rows() == '1')
		{
			return TRUE;
		}
		
		return FALSE;
	}
	
	
	function get_contents() {
		
         $sql = "select * from supplier ";
          $query = $this->db->query($sql);
		  $sesarray=array();
		  
        $result = $query->result_array();
		
		
         return $result;
    }
	
	
	
	function Get_Items()
	{
		 $sql = "select * from supplier order by cdate desc ";
          $query = $this->db->query($sql);
		  $sesarray=array();
		  
        $result = $query->result_array();
		
		
         return $result;
	}
	
	
	
	public function get_books()
     {
		 $sql = "SELECT `cid`, `cname`, `cdesc`, `caddress`, `cphone`, `cdate`, `fullname` FROM `supplier`,staff WHERE staff.username=supplier.user order by cdate desc ";
        return  $this->db->query($sql);
		  
         // return $this->db->get("customer");
     }
	 
	 
	 
	 public function deleteRecord($table, $where = array()) {
  $this->db->where($where);
  $res = $this->db->delete($table); 
  if($res)
    return TRUE;
  else
    return FALSE;
}




function getMySupplier($id) {
		
         $sql = "SELECT * from supplier where cid='".$id."' ";
           $query = $this->db->query($sql);
		  $sesarray=array();
		  
        $result = $query->result_array();
		
		
         return $result;
    }




function UpdateSupplier($username,$form_data)
	{
//$this->db->where('username', $username);
//$this->db->update('staff', $form_data);

$this->db->where('cid',$username);  
$this->db->update('supplier', $form_data);   

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