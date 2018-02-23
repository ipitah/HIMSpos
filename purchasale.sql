-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jun 30, 2017 at 11:18 AM
-- Server version: 5.5.27
-- PHP Version: 5.5.15

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `purchasale`
--

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE IF NOT EXISTS `category` (
  `catid` int(10) NOT NULL AUTO_INCREMENT,
  `category` varchar(50) NOT NULL,
  `addedby` varchar(50) NOT NULL,
  `dateadded` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`catid`),
  KEY `addedby` (`addedby`),
  KEY `category` (`category`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`catid`, `category`, `addedby`, `dateadded`) VALUES
(6, 'Cylinder', 'ipitah', '2017-06-26 18:41:47'),
(7, 'Balloon', 'ipitah', '2017-06-26 18:42:03');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE IF NOT EXISTS `customer` (
  `cid` varchar(20) NOT NULL,
  `cname` varchar(50) NOT NULL,
  `cdesc` varchar(300) DEFAULT NULL,
  `caddress` varchar(200) DEFAULT NULL,
  `cphone` varchar(20) NOT NULL,
  `cdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `user` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`cid`),
  KEY `user` (`user`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`cid`, `cname`, `cdesc`, `caddress`, `cphone`, `cdate`, `user`) VALUES
('28372052', 'Peter Ndegwa', 'From Kericho south', '280 Kiambu', '0713971439', '2017-04-15 03:25:39', 'ipitah');

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE IF NOT EXISTS `items` (
  `itemid` int(10) NOT NULL AUTO_INCREMENT,
  `itemname` varchar(300) NOT NULL,
  `itemdesc` varchar(500) DEFAULT NULL,
  `bp` float(10,2) DEFAULT NULL,
  `sp` float(10,2) DEFAULT NULL,
  `category` varchar(50) DEFAULT NULL,
  `vat` enum('No','Yes') DEFAULT NULL,
  `user` varchar(100) NOT NULL,
  `dateadded` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`itemid`),
  KEY `category` (`category`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`itemid`, `itemname`, `itemdesc`, `bp`, `sp`, `category`, `vat`, `user`, `dateadded`) VALUES
(8, 'Inflated Balloons', 'These are balloons with gas.', 40.00, 60.00, 'Balloon', 'Yes', 'ipitah', '2017-06-26 18:46:00'),
(9, 'Empty Balloons', 'These are balloons without gas.', 10.00, 20.00, 'Balloon', 'Yes', 'ipitah', '2017-06-26 18:46:56'),
(10, 'Small Cylinder', 'This is the small gas cylinder', 3000.00, 5000.00, 'Cylinder', 'Yes', 'ipitah', '2017-06-28 19:52:17'),
(11, 'Big Cylinder', 'This is the big gas cylinder', 5000.00, 9000.00, 'Cylinder', 'Yes', 'ipitah', '2017-06-28 19:53:19');

-- --------------------------------------------------------

--
-- Table structure for table `purchase`
--

CREATE TABLE IF NOT EXISTS `purchase` (
  `purchaseid` int(10) NOT NULL AUTO_INCREMENT,
  `pitemid` int(10) NOT NULL,
  `pbp` float(10,2) NOT NULL,
  `discount` float(10,2) DEFAULT NULL,
  `pquantity` int(5) NOT NULL,
  `total` float(10,2) NOT NULL,
  `preceipt` varchar(100) NOT NULL,
  `psupplier` varchar(100) DEFAULT NULL,
  `psupplierdetails` varchar(300) DEFAULT NULL,
  `pservedby` varchar(50) NOT NULL,
  `pdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`purchaseid`),
  KEY `pitemid` (`pitemid`),
  KEY `pservedby` (`pservedby`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=23 ;

--
-- Dumping data for table `purchase`
--

INSERT INTO `purchase` (`purchaseid`, `pitemid`, `pbp`, `discount`, `pquantity`, `total`, `preceipt`, `psupplier`, `psupplierdetails`, `pservedby`, `pdate`) VALUES
(20, 8, 40.00, 0.00, 150, 6000.00, 'D456yr57', '2456799', 'Mr. George Kiragu', 'ipitah', '2017-06-26 18:55:09'),
(21, 9, 10.00, 0.00, 150, 1500.00, 'D456yr57', '2456799', 'Mr. George Kiragu', 'ipitah', '2017-06-26 18:55:09'),
(22, 10, 3000.00, 0.00, 1, 3000.00, 'W3456ST', '2456799', 'Mr. George Kiragu', 'ipitah', '2017-06-30 06:01:29');

-- --------------------------------------------------------

--
-- Table structure for table `purchase_order`
--

CREATE TABLE IF NOT EXISTS `purchase_order` (
  `purchaseid` int(10) NOT NULL AUTO_INCREMENT,
  `pitemid` int(10) NOT NULL,
  `pbp` float(10,2) NOT NULL,
  `discount` float(10,2) DEFAULT NULL,
  `pquantity` int(5) NOT NULL,
  `total` float(10,2) NOT NULL,
  `preceipt` varchar(100) NOT NULL,
  `psupplier` varchar(100) DEFAULT NULL,
  `psupplierdetails` varchar(300) DEFAULT NULL,
  `pservedby` varchar(50) NOT NULL,
  `pdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`purchaseid`),
  KEY `pitemid` (`pitemid`),
  KEY `pservedby` (`pservedby`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `sale`
--

CREATE TABLE IF NOT EXISTS `sale` (
  `saleid` int(10) NOT NULL AUTO_INCREMENT,
  `sitemid` int(10) NOT NULL,
  `sbp` float(10,2) NOT NULL,
  `sbprice` float(10,2) NOT NULL DEFAULT '0.00',
  `squantity` int(5) NOT NULL,
  `samountgiven` float(10,2) DEFAULT '0.00',
  `stotal` float(10,2) NOT NULL DEFAULT '0.00',
  `discount` float(10,2) DEFAULT '0.00',
  `discreason` varchar(300) DEFAULT 'No discount',
  `vat` float(10,2) DEFAULT '0.00',
  `sbalance` float(10,2) NOT NULL DEFAULT '0.00',
  `spaymentmethod` enum('BANK','M-PESA','CASH') DEFAULT 'CASH',
  `stranscno` varchar(50) DEFAULT NULL,
  `sreceipt` varchar(100) NOT NULL,
  `scustomer` varchar(100) NOT NULL,
  `scustomerdetails` varchar(300) DEFAULT NULL,
  `status` enum('CANCELED','RECEIPTED','INVOICED') NOT NULL DEFAULT 'INVOICED',
  `sservedby` varchar(50) NOT NULL,
  `sdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`saleid`),
  KEY `pitemid` (`sitemid`),
  KEY `pservedby` (`sservedby`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=143 ;

--
-- Dumping data for table `sale`
--

INSERT INTO `sale` (`saleid`, `sitemid`, `sbp`, `sbprice`, `squantity`, `samountgiven`, `stotal`, `discount`, `discreason`, `vat`, `sbalance`, `spaymentmethod`, `stranscno`, `sreceipt`, `scustomer`, `scustomerdetails`, `status`, `sservedby`, `sdate`) VALUES
(139, 8, 60.00, 40.00, 5, 400.00, 300.00, 0.00, '', 48.00, 52.00, 'CASH', '', 'S395PS20170626', '28372052', 'Peter Ndegwa', 'RECEIPTED', 'ipitah', '2017-06-26 19:05:24'),
(140, 9, 20.00, 10.00, 4, 100.00, 80.00, -0.20, 'Remove decimal', 12.80, 7.00, 'CASH', '', 'S878PS20170626', '28372052', 'Peter Ndegwa', 'RECEIPTED', 'ipitah', '2017-06-26 19:07:41'),
(141, 8, 60.00, 40.00, 5, 350.00, 300.00, 0.00, '', 48.00, 2.00, 'CASH', '', 'S943PS20170630', '28372052', 'Peter Ndegwa', 'RECEIPTED', 'ipitah', '2017-06-30 08:02:52'),
(142, 9, 20.00, 10.00, 2, 50.00, 40.00, 0.00, '', 6.40, 3.60, '', '', 'I496PS20170630', '28372052', 'Peter Ndegwa', 'INVOICED', 'ipitah', '2017-06-30 08:12:40');

-- --------------------------------------------------------

--
-- Table structure for table `sale_order`
--

CREATE TABLE IF NOT EXISTS `sale_order` (
  `saleid` int(10) NOT NULL AUTO_INCREMENT,
  `sitemid` int(10) NOT NULL,
  `sbp` float(10,2) NOT NULL,
  `squantity` int(5) NOT NULL,
  `samountgiven` int(10) DEFAULT NULL,
  `stotal` float(10,2) NOT NULL,
  `discount` float(10,2) DEFAULT NULL,
  `discreason` varchar(300) DEFAULT NULL,
  `vat` float(10,2) DEFAULT NULL,
  `sbalance` float(10,2) NOT NULL,
  `spaymentmethod` enum('BANK','M-PESA','CASH') DEFAULT 'CASH',
  `stranscno` varchar(50) DEFAULT NULL,
  `sreceipt` varchar(100) NOT NULL,
  `scustomer` varchar(100) DEFAULT NULL,
  `scustomerdetails` varchar(300) DEFAULT NULL,
  `sservedby` varchar(50) NOT NULL,
  `sdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `color` varchar(300) DEFAULT NULL,
  `arrangement` varchar(300) DEFAULT NULL,
  `deliverydate` varchar(100) DEFAULT NULL,
  `deliverytime` varchar(100) DEFAULT NULL,
  `deliveryreceipt` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`saleid`),
  KEY `pitemid` (`sitemid`),
  KEY `pservedby` (`sservedby`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `spoilt_items`
--

CREATE TABLE IF NOT EXISTS `spoilt_items` (
  `spoiltno` int(10) NOT NULL AUTO_INCREMENT,
  `itemno` int(10) NOT NULL,
  `quantity` int(5) NOT NULL,
  `describe` varchar(500) DEFAULT NULL,
  `recordedby` varchar(50) NOT NULL,
  `daterecorded` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`spoiltno`),
  KEY `itemno` (`itemno`),
  KEY `recordedby` (`recordedby`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

CREATE TABLE IF NOT EXISTS `staff` (
  `fullname` varchar(100) NOT NULL,
  `email` varchar(50) DEFAULT NULL,
  `contact` varchar(20) NOT NULL,
  `gender` enum('F','M') NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `mygroup` enum('RECEPTIONIST','MODERATOR','ADMIN') NOT NULL DEFAULT 'MODERATOR',
  `regdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` enum('SUSPENDED','ACTIVE') NOT NULL DEFAULT 'ACTIVE',
  PRIMARY KEY (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `staff`
--

INSERT INTO `staff` (`fullname`, `email`, `contact`, `gender`, `username`, `password`, `mygroup`, `regdate`, `status`) VALUES
('Peter Ndirangu', 'ndejanpeter@gmail.com', '0713971439', 'M', 'ipitah', '957b527bcfbad2e80f58d20683931435', 'ADMIN', '2017-04-04 19:59:04', 'ACTIVE'),
('User One', NULL, '', 'M', 'userone', '24c9e15e52afc47c225b757e7bee1f9d', 'ADMIN', '2017-04-13 16:52:16', 'ACTIVE');

-- --------------------------------------------------------

--
-- Table structure for table `supplier`
--

CREATE TABLE IF NOT EXISTS `supplier` (
  `cid` varchar(20) NOT NULL,
  `cname` varchar(50) NOT NULL,
  `cdesc` varchar(300) DEFAULT NULL,
  `caddress` varchar(200) DEFAULT NULL,
  `cphone` varchar(20) NOT NULL,
  `cdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `user` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`cid`),
  KEY `user` (`user`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `supplier`
--

INSERT INTO `supplier` (`cid`, `cname`, `cdesc`, `caddress`, `cphone`, `cdate`, `user`) VALUES
('2456799', 'Mr. George Kiragu', 'The first', '280 - Nairobi', '074563456', '2017-06-26 18:29:53', 'ipitah');

-- --------------------------------------------------------

--
-- Stand-in structure for view `titemspurchased`
--
CREATE TABLE IF NOT EXISTS `titemspurchased` (
`itemid` int(10)
,`itemname` varchar(300)
,`bp` float(10,2)
,`sp` float(10,2)
,`vat` enum('No','Yes')
,`category` varchar(50)
,`pquantity` int(5)
,`prem` decimal(32,0)
);
-- --------------------------------------------------------

--
-- Stand-in structure for view `titemssold`
--
CREATE TABLE IF NOT EXISTS `titemssold` (
`itemid` int(10)
,`itemname` varchar(300)
,`bp` float(10,2)
,`sp` float(10,2)
,`srem` decimal(32,0)
);
-- --------------------------------------------------------

--
-- Stand-in structure for view `titemsspoilt`
--
CREATE TABLE IF NOT EXISTS `titemsspoilt` (
`itemid` int(10)
,`itemname` varchar(300)
,`bp` float(10,2)
,`sp` float(10,2)
,`sprem` decimal(32,0)
);
-- --------------------------------------------------------

--
-- Structure for view `titemspurchased`
--
DROP TABLE IF EXISTS `titemspurchased`;

CREATE ALGORITHM=UNDEFINED DEFINER=`neodata`@`localhost` SQL SECURITY DEFINER VIEW `titemspurchased` AS select `items`.`itemid` AS `itemid`,`items`.`itemname` AS `itemname`,`items`.`bp` AS `bp`,`items`.`sp` AS `sp`,`items`.`vat` AS `vat`,`items`.`category` AS `category`,`purchase`.`pquantity` AS `pquantity`,coalesce(sum(`purchase`.`pquantity`),0) AS `prem` from (`items` left join `purchase` on((`items`.`itemid` = `purchase`.`pitemid`))) group by `items`.`itemid`;

-- --------------------------------------------------------

--
-- Structure for view `titemssold`
--
DROP TABLE IF EXISTS `titemssold`;

CREATE ALGORITHM=UNDEFINED DEFINER=`neodata`@`localhost` SQL SECURITY DEFINER VIEW `titemssold` AS select `items`.`itemid` AS `itemid`,`items`.`itemname` AS `itemname`,`items`.`bp` AS `bp`,`items`.`sp` AS `sp`,coalesce(sum(`sale`.`squantity`),0) AS `srem` from (`items` left join `sale` on((`items`.`itemid` = `sale`.`sitemid`))) group by `items`.`itemid`;

-- --------------------------------------------------------

--
-- Structure for view `titemsspoilt`
--
DROP TABLE IF EXISTS `titemsspoilt`;

CREATE ALGORITHM=UNDEFINED DEFINER=`neodata`@`localhost` SQL SECURITY DEFINER VIEW `titemsspoilt` AS select `items`.`itemid` AS `itemid`,`items`.`itemname` AS `itemname`,`items`.`bp` AS `bp`,`items`.`sp` AS `sp`,coalesce(sum(`spoilt_items`.`quantity`),0) AS `sprem` from (`items` left join `spoilt_items` on((`items`.`itemid` = `spoilt_items`.`itemno`))) group by `items`.`itemid`;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `category`
--
ALTER TABLE `category`
  ADD CONSTRAINT `category_ibfk_1` FOREIGN KEY (`addedby`) REFERENCES `staff` (`username`) ON UPDATE CASCADE;

--
-- Constraints for table `customer`
--
ALTER TABLE `customer`
  ADD CONSTRAINT `customer_ibfk_1` FOREIGN KEY (`user`) REFERENCES `staff` (`username`) ON UPDATE CASCADE;

--
-- Constraints for table `items`
--
ALTER TABLE `items`
  ADD CONSTRAINT `items_ibfk_1` FOREIGN KEY (`category`) REFERENCES `category` (`category`) ON UPDATE CASCADE;

--
-- Constraints for table `purchase`
--
ALTER TABLE `purchase`
  ADD CONSTRAINT `purchase_ibfk_1` FOREIGN KEY (`pitemid`) REFERENCES `items` (`itemid`) ON UPDATE CASCADE,
  ADD CONSTRAINT `purchase_ibfk_2` FOREIGN KEY (`pservedby`) REFERENCES `staff` (`username`) ON UPDATE CASCADE;

--
-- Constraints for table `purchase_order`
--
ALTER TABLE `purchase_order`
  ADD CONSTRAINT `purchase_order_ibfk_1` FOREIGN KEY (`pitemid`) REFERENCES `items` (`itemid`) ON UPDATE CASCADE,
  ADD CONSTRAINT `purchase_order_ibfk_2` FOREIGN KEY (`pservedby`) REFERENCES `staff` (`username`) ON UPDATE CASCADE;

--
-- Constraints for table `sale`
--
ALTER TABLE `sale`
  ADD CONSTRAINT `sale_ibfk_1` FOREIGN KEY (`sitemid`) REFERENCES `items` (`itemid`) ON UPDATE CASCADE,
  ADD CONSTRAINT `sale_ibfk_2` FOREIGN KEY (`sservedby`) REFERENCES `staff` (`username`) ON UPDATE CASCADE;

--
-- Constraints for table `sale_order`
--
ALTER TABLE `sale_order`
  ADD CONSTRAINT `sale_order_ibfk_1` FOREIGN KEY (`sitemid`) REFERENCES `items` (`itemid`) ON UPDATE CASCADE,
  ADD CONSTRAINT `sale_order_ibfk_2` FOREIGN KEY (`sservedby`) REFERENCES `staff` (`username`) ON UPDATE CASCADE;

--
-- Constraints for table `spoilt_items`
--
ALTER TABLE `spoilt_items`
  ADD CONSTRAINT `spoilt_items_ibfk_1` FOREIGN KEY (`itemno`) REFERENCES `items` (`itemid`) ON UPDATE CASCADE,
  ADD CONSTRAINT `spoilt_items_ibfk_2` FOREIGN KEY (`recordedby`) REFERENCES `staff` (`username`) ON UPDATE CASCADE;

--
-- Constraints for table `supplier`
--
ALTER TABLE `supplier`
  ADD CONSTRAINT `supplier_ibfk_1` FOREIGN KEY (`user`) REFERENCES `staff` (`username`) ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
