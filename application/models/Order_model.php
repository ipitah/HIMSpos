<?php

class Order_model extends CI_Model {

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
		$this->db->insert_batch('purchase_order', $form_data);
		
		$rowsa=$this->db->affected_rows();
		/*
		if ($this->db->affected_rows() == '1')
		{
			return TRUE;
		}  */
		
		return $rowsa;
	}
	
	
	
	function get_itemspurchased() {
		
         $sql = "SELECT `itemid` , `itemname` , `bp` , `sp` , `pquantity`,coalesce(sum( `pquantity` ),0) as rem
FROM `items` 
LEFT OUTER JOIN `purchase` ON `items`.`itemid` = `purchase`.`pitemid`  
group by `itemid` ";
          $query = $this->db->query($sql);
		  $sesarray=array();
		  
        $result = $query->result_array();
		
		
         return $result;
    }
	
	
	function get_item($id) {
		
         $sql = "SELECT `itemname`
FROM `items`
WHERE  `itemid`='".$id."' ";
          $query = $this->db->query($sql);
		  $sesarray=array();
		  
        $result = $query->result_array();
		
		
         return $result;
    }
	
	
	
	
		public function get_receipts()
     {
        //  return $this->db->get("sale");
		  
		  $sql = "SELECT `purchaseid` , `pitemid` , `pbp` , `discount` , `pquantity` , sum(`total`) as total , `preceipt` , `psupplier` , `psupplierdetails` , `pservedby` , `pdate` , `itemname` , `fullname`
	FROM `purchase_order`
	LEFT OUTER JOIN `items` ON `purchase_order`.`pitemid` = `items`.`itemid`
	LEFT OUTER JOIN `staff` ON `purchase_order`.`pservedby` = `staff`.`username` group by `preceipt` ";
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
	
	
	
	
	function get_supplier($id) {
		
         $sql = "SELECT `cname`
FROM `supplier`
WHERE  `cid`='".$id."' ";
          $query = $this->db->query($sql);
		  $sesarray=array();
		  
        $result = $query->result_array();
		
		
         return $result;
    }
	
	
	
	 function get_suppliers() {
		
         $sql = "SELECT * from supplier order by cname ";
          $query = $this->db->query($sql);
		  $sesarray=array();
		  
        $result = $query->result_array();
		
		
         return $result;
    }
	
	
	
	
}
?>