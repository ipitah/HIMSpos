<?php

class Saleorder_model extends CI_Model {

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
		$this->db->insert_batch('sale_order', $form_data);
		
		$rowsa=$this->db->affected_rows();
		/*
		if ($this->db->affected_rows() == '1')
		{
			return TRUE;
		}  */
		
		return $rowsa;
	}
	
	
	
	function SaveOrder($form_data)
	{
		$this->db->insert_batch('sale_order', $form_data);
		
		$rowsa=$this->db->affected_rows();
		/*
		if ($this->db->affected_rows() == '1')
		{
			return TRUE;
		}  */
		
		return $rowsa;
	}
	
	
	
	function get_remainingitems() {
		
         $sql = "SELECT `titemspurchased`.`itemid`, `titemspurchased`.`itemname`, `titemspurchased`.`bp`, `titemspurchased`.`sp`, `titemspurchased`.`vat`, `prem`, `srem`, `sprem`, (`prem`-`srem`-`sprem`) as rem FROM `titemspurchased`,`titemssold`,`titemsspoilt` WHERE `titemsspoilt`.`itemid`=`titemssold`.`itemid` && `titemsspoilt`.`itemid`=`titemspurchased`.`itemid` && `titemssold`.`itemid`=`titemspurchased`.`itemid` ";
           $query = $this->db->query($sql);
		  $sesarray=array();
		  
        $result = $query->result_array();
		
		
         return $result;
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
	
	
	
	function get_itemssold() {
		
         $sql = "SELECT `itemid` , `itemname` , `bp` , `sp` ,coalesce(sum( `squantity` ),0) as rem
FROM `items` 
LEFT OUTER JOIN `sale` ON `items`.`itemid` = `sale`.`sitemid`
group by `itemid` ";
          $query = $this->db->query($sql);
		  $sesarray=array();
		  
        $result = $query->result_array();
		
		
         return $result;
    }
	
	
	
	
	function get_itemsspoilt() {
		
         $sql = "SELECT `itemid` , `itemname` , `bp` , `sp` , coalesce( sum( `quantity` ) , 0 ) as rem
FROM `items`
LEFT OUTER JOIN `spoilt_items` ON `items`.`itemid` = `spoilt_items`.`itemno`
GROUP BY `itemid` ";
          $query = $this->db->query($sql);
		  $sesarray=array();
		  
        $result = $query->result_array();
		
		
         return $result;
    }
	
	
	
	
	
	
	
	
	
	
	
	
	public function get_sales()
     {
        //  return $this->db->get("sale");
		  
		  $sql = "SELECT `saleid`, `sitemid`, `sbp`, `squantity`, `samountgiven`, `stotal`, `discount`, `sbalance`, `spaymentmethod`, `stranscno`, `sreceipt`, `scustomer`, `scustomerdetails`, `sservedby`, `sdate`, `itemname` , `fullname`
FROM `sale`
LEFT OUTER JOIN `items` ON `sale`.`sitemid` = `items`.`itemid`
LEFT OUTER JOIN `staff` ON `sale`.`sservedby` = `staff`.`username` ";
          $query = $this->db->query($sql);
		
         return $query;
		  
     }
	 
	 
	 
	 
	 public function get_receipts()
     {
        //  return $this->db->get("sale");
		  
		  $sql = "SELECT `saleid`, `sitemid`, `sbp`, `squantity`, `samountgiven`, sum(`stotal`) as stotal , `discount`, `sbalance`, `spaymentmethod`, `stranscno`, `sreceipt`, `scustomer`, `scustomerdetails`, `sservedby`, `sdate`, `itemname` , `fullname`
FROM `sale`
LEFT OUTER JOIN `items` ON `sale`.`sitemid` = `items`.`itemid`
LEFT OUTER JOIN `staff` ON `sale`.`sservedby` = `staff`.`username` group by `sreceipt` ";
          $query = $this->db->query($sql);
		
         return $query;
		  
     }
	 
	 
	 
	 
	 
	 
	 public function get_soreceipts()
     {
        //  return $this->db->get("sale");
		  
		  $sql = "SELECT `saleid`, `sitemid`, `sbp`, `squantity`, `samountgiven`, sum(`stotal`) as stotal , `discount`, `sbalance`, `spaymentmethod`, `stranscno`, `sreceipt`, `scustomer`, `scustomerdetails`, `sservedby`, `sdate`, `itemname` , `fullname`
FROM `sale_order`
LEFT OUTER JOIN `items` ON `sale_order`.`sitemid` = `items`.`itemid`
LEFT OUTER JOIN `staff` ON `sale_order`.`sservedby` = `staff`.`username` group by `sreceipt` ";
          $query = $this->db->query($sql);
		
         return $query;
		  
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
	
	
	
	
	function get_customer($id) {
		
         $sql = "SELECT `cname`
FROM `customer`
WHERE  `cid`='".$id."' ";
          $query = $this->db->query($sql);
		  $sesarray=array();
		  
        $result = $query->result_array();
		
		
         return $result;
    }
	
	
	
	
	public function deleteRecord($table, $where = array()) {
  $this->db->where($where);
  $res = $this->db->delete($table); 
  if($res)
    return TRUE;
  else
    return FALSE;
}
	
	
	
	public function endofdaysales()
     {
        //  return $this->db->get("sale");
		$startdate=date('Y-m-d', strtotime(date('Y-m-d'). ' - 0 days'));
		$enddate=date('Y-m-d', strtotime(date('Y-m-d'). ' + 0 days'));
		  
		  $sql = "SELECT `saleid`, `itemname`, `sbp`, `squantity`, `samountgiven`, `stotal`, `discount`, `sbalance`, `spaymentmethod`, `stranscno`, `sreceipt`, `scustomer`, `scustomerdetails`, `fullname`, `sdate` FROM `sale`,items,staff WHERE items.itemid=sale.sitemid and sale.`sservedby`=staff.username and `sdate` between  '".$startdate."' and '".$enddate."' ";
          $query = $this->db->query($sql);
		
         return $query;
		  
     }
	 
	 
	 
	 
	 
	 public function endofdaystock()
     {
        //  return $this->db->get("sale");
		$startdate=date('Y-m-d', strtotime(date('Y-m-d'). ' - 0 days'));
		$enddate=date('Y-m-d', strtotime(date('Y-m-d'). ' + 0 days'));
		  
		  $sql = "SELECT `purchaseid`, `itemname`, `pbp`, `discount`, `pquantity`, `total`, `preceipt`, `psupplier`, `psupplierdetails`,`fullname`, `pdate` FROM items,staff,`purchase` WHERE `purchase`.pitemid=items.itemid and staff.username=`purchase`.`pservedby` and `pdate` between  '".$startdate."' and '".$enddate."' ";
          $query = $this->db->query($sql);
		
         return $query;
		  
     }
	 
	 
	 
	 
	 
	 
	 public function customdaysales($start,$stop)
     {
        //  return $this->db->get("sale");
		$startdate=$start;
		$enddate=$stop;
		  
		  $sql = "SELECT `saleid`, `itemname`, `sbp`, `squantity`, `samountgiven`, `stotal`, `discount`, `sbalance`, `spaymentmethod`, `stranscno`, `sreceipt`, `scustomer`, `scustomerdetails`, `fullname`, `sdate` FROM `sale`,items,staff WHERE items.itemid=sale.sitemid and sale.`sservedby`=staff.username and `sdate` between  '".$startdate."' and '".$enddate."' ";
          $query = $this->db->query($sql);
		
         return $query;
		  
     }
	 
	 
	 
	 
	 
	 public function customdaystock($start,$stop)
     {
        //  return $this->db->get("sale");
		$startdate=$start;
		$enddate=$stop;
		  
		  $sql = "SELECT `purchaseid`, `itemname`, `pbp`, `discount`, `pquantity`, `total`, `preceipt`, `psupplier`, `psupplierdetails`,`fullname`, `pdate` FROM items,staff,`purchase` WHERE `purchase`.pitemid=items.itemid and staff.username=`purchase`.`pservedby` and `pdate` between  '".$startdate."' and '".$enddate."' ";
          $query = $this->db->query($sql);
		
         return $query;
		  
     }
	 
	 
	 
	 
	 
	 
	 function get_customers() {
		
         $sql = "SELECT * from customer order by cname ";
          $query = $this->db->query($sql);
		  $sesarray=array();
		  
        $result = $query->result_array();
		
		
         return $result;
    }
	 
	 
	 
	 
	
	
	
}
?>