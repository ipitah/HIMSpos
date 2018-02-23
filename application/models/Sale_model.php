<?php

class Sale_model extends CI_Model {

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
		$this->db->insert_batch('sale', $form_data);
		
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
	
	
	function get_Buyingp($id)
	{
		$sql = "SELECT `itemid`, `itemname`, `itemdesc`, `bp`, `sp`, `category`, `vat`, `user`, `dateadded` FROM `items` WHERE `itemid`='".$id."' ";
           $query = $this->db->query($sql);
		  $sesarray=array();
		  
        $result = $query->result_array();
		
		
         return $result;
	}
	
	
	
	
	function get_remainingitems() {
		
         $sql = "SELECT `titemspurchased`.`itemid`, `titemspurchased`.`itemname`, `titemspurchased`.`bp`, `titemspurchased`.`sp`, `titemspurchased`.`vat`, `prem`, `srem`, `sprem`, (`prem`-`srem`-`sprem`) as rem FROM `titemspurchased`,`titemssold`,`titemsspoilt` WHERE `titemsspoilt`.`itemid`=`titemssold`.`itemid` && `titemsspoilt`.`itemid`=`titemspurchased`.`itemid` && `titemssold`.`itemid`=`titemspurchased`.`itemid` and category='Balloon' ";
           $query = $this->db->query($sql);
		  $sesarray=array();
		  
        $result = $query->result_array();
		
		
         return $result;
    }
	
	
	
	
	function get_usedballoons() {
		
         $sql = "SELECT sum(`srem`)+sum(`sprem`) as brem FROM `titemspurchased`,`titemssold`,`titemsspoilt` WHERE `titemsspoilt`.`itemid`=`titemssold`.`itemid` && `titemsspoilt`.`itemid`=`titemspurchased`.`itemid` && `titemssold`.`itemid`=`titemspurchased`.`itemid` ";
           $query = $this->db->query($sql);
		
		$result = $query->result_array();
         return $result;
    }
	
	
	
	function get_boughtGas() {
		
         $sql = "SELECT `titemspurchased`.`itemname`,sum(`prem`) as prem FROM `titemspurchased`,`titemssold`,`titemsspoilt` WHERE `titemsspoilt`.`itemid`=`titemssold`.`itemid` && `titemsspoilt`.`itemid`=`titemspurchased`.`itemid` && `titemssold`.`itemid`=`titemspurchased`.`itemid`  and category='Cylinder'  group by `titemspurchased`.`itemname` ";
           $query = $this->db->query($sql);
		
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
		  
		  $sql = "SELECT `saleid`, `sitemid`, `sbp`, `squantity`, `samountgiven`, sum(`stotal`) as stotal , `discount`, `sbalance`, `spaymentmethod`, `stranscno`, `sreceipt`, `scustomer`, `scustomerdetails`, `sservedby`, `sdate`, `itemname` , (sum(`stotal`)-`discount`+`sale`.vat)as bal,`sale`.vat,discreason, `fullname`
FROM `sale`
LEFT OUTER JOIN `items` ON `sale`.`sitemid` = `items`.`itemid`
LEFT OUTER JOIN `staff` ON `sale`.`sservedby` = `staff`.`username` where `sale`.status='RECEIPTED' group by `sreceipt` ";
          $query = $this->db->query($sql);
		
         return $query;
		  
     }
	 
	 
	 
	 
	 public function get_invoices()
     {
        //  return $this->db->get("sale");
		  
		  $sql = "SELECT `saleid`, `sitemid`, `sbp`, `squantity`, `samountgiven`, sum(`stotal`) as stotal , `discount`, `sbalance`, `spaymentmethod`, `stranscno`, `sreceipt`, `scustomer`, `scustomerdetails`, `sservedby`, `sdate`, `itemname` , (sum(`stotal`)-`discount`+`sale`.vat)as bal,`sale`.vat,discreason, `fullname`
FROM `sale`
LEFT OUTER JOIN `items` ON `sale`.`sitemid` = `items`.`itemid`
LEFT OUTER JOIN `staff` ON `sale`.`sservedby` = `staff`.`username` where `sale`.status='INVOICED' group by `sreceipt` ";
          $query = $this->db->query($sql);
		
         return $query;
		  
     }
	 
	 
	 
	 
	 public function get_soreceipts()
     {
        //  return $this->db->get("sale");
		  
		  $sql = "SELECT `saleid`, `sitemid`, `sbp`, `squantity`, `samountgiven`, sum(`stotal`) as stotal , `discount`, `sbalance`, `spaymentmethod`, `stranscno`, `sreceipt`, `scustomer`, `scustomerdetails`, `sservedby`, `sdate`, `itemname` ,(sum(`stotal`)-`discount`+sale_order.vat)as bal,sale_order.vat,discreason, `deliveryreceipt`, `fullname`
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
		$startdate=date('Y-m-d', strtotime(date('Y-m-d'). ' - 1 days'));
		$enddate=date('Y-m-d', strtotime(date('Y-m-d'). ' + 1 days'));
		  
		  $sql = "SELECT `saleid`, `itemname`, `sbp`, `squantity`, `samountgiven`, `stotal`, `discount`, `sbalance`, `spaymentmethod`, `stranscno`, `sreceipt`, `scustomer`, `scustomerdetails`, `fullname`, `sdate`, sale.status
		  FROM `sale`,items,staff WHERE items.itemid=sale.sitemid and sale.`sservedby`=staff.username and `sdate` between  '".$startdate."' and '".$enddate."' ";
          $query = $this->db->query($sql);
		
         return $query;
		  
     }
	 
	 
	 
	 
	 
	 public function endofdayComputation()
     {
        //  return $this->db->get("sale");
		$startdate=date('Y-m-d', strtotime(date('Y-m-d'). ' - 1 days'));
		$enddate=date('Y-m-d', strtotime(date('Y-m-d'). ' + 1 days'));
		  
		  $sql = "SELECT sum(`discount`) as discount, sum(`vat`) as vat
		  FROM `sale` WHERE `sdate` between  '".$startdate."' and '".$enddate."' group by `sreceipt` ";
          $query = $this->db->query($sql);
		
       return $query;
		  
     }
	 
	 
	  public function endofdayComputation2()
     {
        //  return $this->db->get("sale");
		$startdate=date('Y-m-d', strtotime(date('Y-m-d'). ' - 1 days'));
		$enddate=date('Y-m-d', strtotime(date('Y-m-d'). ' + 1 days'));
		  
		  $sql = "SELECT discount
		  FROM `purchase` WHERE `pdate` between  '".$startdate."' and '".$enddate."' group by `preceipt` ";
          $query = $this->db->query($sql);
		return $query;
     }
	 
	 
	 
	 
	 public function endofdaystock()
     {
        //  return $this->db->get("sale");
		$startdate=date('Y-m-d', strtotime(date('Y-m-d'). ' - 1 days'));
		$enddate=date('Y-m-d', strtotime(date('Y-m-d'). ' + 1 days'));
		  
		  $sql = "SELECT `purchaseid`, `itemname`, `pbp`, `discount`, `pquantity`, `total`, `preceipt`, `psupplier`, `psupplierdetails`,`fullname`, `pdate` FROM items,staff,`purchase` WHERE `purchase`.pitemid=items.itemid and staff.username=`purchase`.`pservedby` and `pdate` between  '".$startdate."' and '".$enddate."' ";
          $query = $this->db->query($sql);
		
         return $query;
		  
     }
	 
	 
	 
	 
	 
	 
	 public function customdaysales($start,$stop)
     {
        //  return $this->db->get("sale");
		$startdate=$start;
		$enddate=$stop;
		  
		  $sql = "SELECT `saleid`, `itemname`, `sbp`, `squantity`, `samountgiven`, `stotal`, `discount`, `sbalance`, `spaymentmethod`, `stranscno`, `sreceipt`, `scustomer`, `scustomerdetails`, `fullname`,sale.status, `sdate` FROM `sale`,items,staff WHERE items.itemid=sale.sitemid and sale.`sservedby`=staff.username and `sdate` between  '".$startdate."' and '".$enddate."' ";
          $query = $this->db->query($sql);
		
         return $query;
		  
     }
	 
	 
	 
	  public function endofdayCustomComputation($start,$stop)
     {
        //  return $this->db->get("sale");
		$startdate=$start;
		$enddate=$stop;
		  
		  $sql = "SELECT sum(`discount`) as discount, sum(`vat`) as vat
		  FROM `sale` WHERE `sdate` between  '".$startdate."' and '".$enddate."' group by `sreceipt` ";
          $query = $this->db->query($sql);
		
       return $query;
		  
     }
	 
	 
	  public function endofdayCustomComputation2($start,$stop)
     {
        //  return $this->db->get("sale");
		$startdate=$start;
		$enddate=$stop;
		  
		  $sql = "SELECT discount
		  FROM `purchase` WHERE `pdate` between  '".$startdate."' and '".$enddate."' group by `preceipt` ";
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
	 
	 
	 
	 
	 
	 
	 
	 
	 public function get_soldItems($id)
     {
        //  return $this->db->get("sale");
		  
		  $sql = "SELECT `saleid`, `sitemid`, `sbp`, `sbprice`, `squantity`, `samountgiven`, `stotal`, `discount`, `discreason`, sale.`vat`, `sbalance`, `spaymentmethod`, `stranscno`, `sreceipt`, `scustomer`, `scustomerdetails`, `status`, `sservedby`, `sdate`,itemname FROM `sale`,items WHERE items.itemid =sale.`sitemid` and `sreceipt`='".$id."' ";
          $query = $this->db->query($sql);
		
         return $query;
		  
     }
	 
	 
	 
	 
	 
	 function UpdateFinalise($username,$form_data)
	{
//$this->db->where('username', $username);
//$this->db->update('staff', $form_data);

$this->db->where('sreceipt',$username);  
$this->db->update('sale', $form_data);   

if ($this->db->affected_rows() > 0)
{
  return TRUE;
}
else
{
  return FALSE;
}
	}
	 
	 
	 
	 
	 
	
	
	public function getdata()
     {
        //  return $this->db->get("sale");
		$startdate=date('Y-m-d', strtotime(date('Y-m-d'). ' - 1 days'));
		$enddate=date('Y-m-d', strtotime(date('Y-m-d'). ' + 1 days'));
		  
		  $sql = "SELECT `saleid`, `itemname`, `sbp`, `squantity`, `samountgiven`, sum(`stotal`) as stotal, `discount`, `sbalance`, `spaymentmethod`, `stranscno`, `sreceipt`, `scustomer`, `scustomerdetails`, `fullname`, `sdate`, sale.status
		  FROM `sale`,items,staff WHERE items.itemid=sale.sitemid and sale.`sservedby`=staff.username and `sdate` between  '".$startdate."' and '".$enddate."' group by  sale.`sitemid` ";
          $query = $this->db->query($sql);
		
         return $query->result_array();
		  
     }
	
	
	
	
	
	
	
	
	
	public function getstockdata()
     {
        //  return $this->db->get("sale");
		$startdate=date('Y-m-d', strtotime(date('Y-m-d'). ' - 1 days'));
		$enddate=date('Y-m-d', strtotime(date('Y-m-d'). ' + 1 days'));
		  
		  $sql = "SELECT `purchaseid`, `itemname`, `pbp`, `discount`, `pquantity`, sum(`total`) as ptotal, `preceipt`, `psupplier`, `psupplierdetails`,`fullname`, `pdate` FROM items,staff,`purchase` WHERE `purchase`.pitemid=items.itemid and staff.username=`purchase`.`pservedby` and `pdate` between  '".$startdate."' and '".$enddate."'  group by  purchase.`pitemid` ";
          $query = $this->db->query($sql);
		
         return $query->result_array();
		  
     }
	
	
	
	
	
	
	public function getcustomsaledata()
     {
        //  return $this->db->get("sale");
		$startdate=$_SESSION['startd'];
		$enddate=$_SESSION['endd'];
		  
		  $sql = "SELECT `saleid`, `itemname`, `sbp`, `squantity`, `samountgiven`, sum(`stotal`) as stotal, `discount`, `sbalance`, `spaymentmethod`, `stranscno`, `sreceipt`, `scustomer`, `scustomerdetails`, `fullname`, `sdate`, sale.status
		  FROM `sale`,items,staff WHERE items.itemid=sale.sitemid and sale.`sservedby`=staff.username and `sdate` between  '".$startdate."' and '".$enddate."' group by  sale.`sitemid` ";
          $query = $this->db->query($sql);
		
         return $query->result_array();
		  
     }
	
	
	
	
	
	
	
	
	
	public function getcustomstockdata()
     {
        //  return $this->db->get("sale");
		$startdate=$_SESSION['startd'];
		$enddate=$_SESSION['endd'];
		  
		  $sql = "SELECT `purchaseid`, `itemname`, `pbp`, `discount`, `pquantity`, sum(`total`) as ptotal, `preceipt`, `psupplier`, `psupplierdetails`,`fullname`, `pdate` FROM items,staff,`purchase` WHERE `purchase`.pitemid=items.itemid and staff.username=`purchase`.`pservedby` and `pdate` between  '".$startdate."' and '".$enddate."'  group by  purchase.`pitemid` ";
          $query = $this->db->query($sql);
		
         return $query->result_array();
		  
     }
	
	
	
	
	
	
	
	
	
	
	
	
	
	
}
?>