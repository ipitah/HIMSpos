<?php

class Purchase_model extends CI_Model {

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
		$this->db->insert_batch('purchase', $form_data);
		
		$rowsa=$this->db->affected_rows();
		/*
		if ($this->db->affected_rows() == '1')
		{
			return TRUE;
		}  */
		
		return $rowsa;
	}
	
	
	
	function get_contents() {
		
         $sql = "select * from items ";
          $query = $this->db->query($sql);
		  $sesarray=array();
		  
        $result = $query->result_array();
		
		
         return $result;
    }
	
	
	
	public function get_stock()
     {
        // return $this->db->get("purchase");
		 
		$sql = "SELECT `purchaseid` , `pitemid` , `pbp` , `discount` , `pquantity` , `total` , `preceipt` , `psupplier` , 		`psupplierdetails` , `pservedby` , `pdate` , `itemname` , `fullname`
	FROM `purchase`
	LEFT OUTER JOIN `items` ON `purchase`.`pitemid` = `items`.`itemid`
	LEFT OUTER JOIN `staff` ON `purchase`.`pservedby` = `staff`.`username` ";
          $query = $this->db->query($sql);
		 // $sesarray=array();
		  
        //$result = $query->result_array();
		
		
         return $query;
		 
		 
		 
     }
	
	
	
	function get_remainingitems() {
		
         $sql = "SELECT `titemspurchased`.`itemid`, `titemspurchased`.`itemname`, `titemspurchased`.`bp`, `titemspurchased`.`sp`, `prem`, `srem`, `sprem`, (`prem`-`srem`-`sprem`) as rem, `prem`, `srem`, `sprem` FROM `titemspurchased`,`titemssold`,`titemsspoilt` WHERE `titemsspoilt`.`itemid`=`titemssold`.`itemid` && `titemsspoilt`.`itemid`=`titemspurchased`.`itemid` && `titemssold`.`itemid`=`titemspurchased`.`itemid`  and category='Balloon'  ";
           $query = $this->db->query($sql);
		
         return $query;
    }
	
	
	
	
	
	function get_usedballoons() {
		
         $sql = "SELECT sum(`srem`)+sum(`sprem`) as brem FROM `titemspurchased`,`titemssold`,`titemsspoilt` WHERE `titemsspoilt`.`itemid`=`titemssold`.`itemid` && `titemsspoilt`.`itemid`=`titemspurchased`.`itemid` && `titemssold`.`itemid`=`titemspurchased`.`itemid`  ";
           $query = $this->db->query($sql);
		
		$result = $query->result_array();
         return $result;
    }
	
	
	
	function get_boughtGas() {
		
         $sql = "SELECT `titemspurchased`.`itemname`,sum(`prem`) as prem FROM `titemspurchased`,`titemssold`,`titemsspoilt` WHERE `titemsspoilt`.`itemid`=`titemssold`.`itemid` && `titemsspoilt`.`itemid`=`titemspurchased`.`itemid` && `titemssold`.`itemid`=`titemspurchased`.`itemid`  and category='Cylinder'  group by `titemspurchased`.`itemname` ";
            $query = $this->db->query($sql);
		
         return $query;
    }
	
	
	
	
	
	
	public function get_receipts()
     {
        //  return $this->db->get("sale");
		  
		  $sql = "SELECT `purchaseid` , `pitemid` , `pbp` , `discount` , `pquantity` , sum(`total`) as total , (sum(`total`)-`discount`)as bal, `preceipt` , `psupplier` , `psupplierdetails` , `pservedby` , `pdate` , `itemname` , `fullname`
	FROM `purchase`
	LEFT OUTER JOIN `items` ON `purchase`.`pitemid` = `items`.`itemid`
	LEFT OUTER JOIN `staff` ON `purchase`.`pservedby` = `staff`.`username` group by `preceipt` ";
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