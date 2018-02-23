-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: May 09, 2017 at 07:43 PM
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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`catid`, `category`, `addedby`, `dateadded`) VALUES
(1, 'Default', 'ipitah', '2017-04-30 08:42:10'),
(2, 'Book', 'ipitah', '2017-04-30 08:42:30');

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
  `user` varchar(100) NOT NULL,
  `dateadded` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`itemid`),
  KEY `category` (`category`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`itemid`, `itemname`, `itemdesc`, `bp`, `sp`, `category`, `user`, `dateadded`) VALUES
(1, 'Item 1', 'This is the first item', 50.00, 60.00, NULL, '', '2017-04-06 20:32:53'),
(2, 'Item 2', 'Item 2', 100.00, 140.00, NULL, 'ipitah', '2017-04-07 11:22:15'),
(3, 'Panadol', 'Dawa', 5.00, 10.00, NULL, 'ipitah', '2017-04-22 10:03:44'),
(4, 'Ballon - red ', '', 5.00, 10.00, NULL, 'ipitah', '2017-04-23 11:58:35'),
(5, 'Form 2 KLB ENG', 'KLB', 400.00, 600.00, 'Book', 'ipitah', '2017-04-30 08:43:32'),
(6, 'Daily Nation', 'DN', 50.00, 60.00, 'Book', 'ipitah', '2017-05-01 10:46:19');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=15 ;

--
-- Dumping data for table `purchase`
--

INSERT INTO `purchase` (`purchaseid`, `pitemid`, `pbp`, `discount`, `pquantity`, `total`, `preceipt`, `psupplier`, `psupplierdetails`, `pservedby`, `pdate`) VALUES
(2, 2, 140.00, 0.00, 1, 320.00, 'RTF345KU', '2456762', 'Jeff', 'ipitah', '2017-04-12 21:06:44'),
(3, 1, 60.00, 0.00, 3, 1340.00, 'RWWF456', '34567', 'NOP', 'ipitah', '2017-04-12 21:12:58'),
(4, 1, 60.00, 0.00, 3, 1440.00, 'Adf34h', '4355555', 'Pedro', 'ipitah', '2017-04-12 21:23:20'),
(5, 2, 140.00, 0.00, 4, 1440.00, 'Adf34h', '4355555', 'Pedro', 'ipitah', '2017-04-12 21:23:20'),
(6, 2, 140.00, 0.00, 5, 1440.00, 'Adf34h', '4355555', 'Pedro', 'ipitah', '2017-04-12 21:23:20'),
(7, 1, 60.00, 0.00, 3, 1440.00, 'Adf34h', '4355555', 'Pedro', 'ipitah', '2017-04-12 21:26:46'),
(8, 2, 140.00, 0.00, 4, 1440.00, 'Adf34h', '4355555', 'Pedro', 'ipitah', '2017-04-12 21:26:46'),
(9, 2, 140.00, 0.00, 5, 1440.00, 'Adf34h', '4355555', 'Pedro', 'ipitah', '2017-04-12 21:26:46'),
(10, 1, 60.00, 0.00, 3, 1440.00, 'Adf34h', '4355555', 'Pedro', 'ipitah', '2017-04-12 21:27:56'),
(11, 2, 140.00, 0.00, 4, 1440.00, 'Adf34h', '4355555', 'Pedro', 'ipitah', '2017-04-12 21:27:56'),
(12, 2, 140.00, 0.00, 5, 1440.00, 'Adf34h', '4355555', 'Pedro', 'ipitah', '2017-04-12 21:27:56'),
(13, 5, 400.00, 0.00, 30, 12000.00, 'Sf46fyn7', '234fg45', 'Waruingi', 'ipitah', '2017-04-30 08:46:57'),
(14, 6, 50.00, 0.00, 6, 300.00, 'st4534', '3456232', 'fhjk;', 'ipitah', '2017-05-01 10:47:06');

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
  `squantity` int(5) NOT NULL,
  `samountgiven` int(10) DEFAULT NULL,
  `stotal` float(10,2) NOT NULL,
  `discount` float(10,2) DEFAULT NULL,
  `sbalance` float(10,2) NOT NULL,
  `spaymentmethod` enum('BANK','M-PESA','CASH') DEFAULT 'CASH',
  `stranscno` varchar(50) DEFAULT NULL,
  `sreceipt` varchar(100) NOT NULL,
  `scustomer` varchar(100) DEFAULT NULL,
  `scustomerdetails` varchar(300) DEFAULT NULL,
  `sservedby` varchar(50) NOT NULL,
  `sdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`saleid`),
  KEY `pitemid` (`sitemid`),
  KEY `pservedby` (`sservedby`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=126 ;

--
-- Dumping data for table `sale`
--

INSERT INTO `sale` (`saleid`, `sitemid`, `sbp`, `squantity`, `samountgiven`, `stotal`, `discount`, `sbalance`, `spaymentmethod`, `stranscno`, `sreceipt`, `scustomer`, `scustomerdetails`, `sservedby`, `sdate`) VALUES
(33, 3, 10.00, 5, NULL, 310.00, 0.00, 0.00, 'CASH', NULL, 'S838PS20170422', '45647', 'hgddf', 'ipitah', '2017-04-22 10:09:42'),
(34, 2, 140.00, 1, NULL, 310.00, 0.00, 0.00, 'CASH', NULL, 'S838PS20170422', '45647', 'hgddf', 'ipitah', '2017-04-22 10:09:42'),
(35, 1, 60.00, 2, NULL, 310.00, 0.00, 0.00, 'CASH', NULL, 'S838PS20170422', '45647', 'hgddf', 'ipitah', '2017-04-22 10:09:42'),
(36, 3, 10.00, 5, NULL, 310.00, 0.00, 0.00, 'CASH', NULL, 'S755PS20170422', '45647', 'hgddf', 'ipitah', '2017-04-22 10:29:52'),
(37, 2, 140.00, 1, NULL, 310.00, 0.00, 0.00, 'CASH', NULL, 'S755PS20170422', '45647', 'hgddf', 'ipitah', '2017-04-22 10:29:52'),
(38, 1, 60.00, 2, NULL, 310.00, 0.00, 0.00, 'CASH', NULL, 'S755PS20170422', '45647', 'hgddf', 'ipitah', '2017-04-22 10:29:52'),
(39, 3, 10.00, 5, NULL, 310.00, 0.00, 0.00, 'CASH', NULL, 'S349PS20170422', '45647', 'hgddf', 'ipitah', '2017-04-22 10:40:50'),
(40, 2, 140.00, 1, NULL, 310.00, 0.00, 0.00, 'CASH', NULL, 'S349PS20170422', '45647', 'hgddf', 'ipitah', '2017-04-22 10:40:50'),
(41, 1, 60.00, 2, NULL, 310.00, 0.00, 0.00, 'CASH', NULL, 'S349PS20170422', '45647', 'hgddf', 'ipitah', '2017-04-22 10:40:50'),
(42, 3, 10.00, 5, NULL, 310.00, 0.00, 0.00, 'CASH', NULL, 'S475PS20170422', '45647', 'hgddf', 'ipitah', '2017-04-22 10:44:15'),
(43, 2, 140.00, 1, NULL, 310.00, 0.00, 0.00, 'CASH', NULL, 'S475PS20170422', '45647', 'hgddf', 'ipitah', '2017-04-22 10:44:15'),
(44, 1, 60.00, 2, NULL, 310.00, 0.00, 0.00, 'CASH', NULL, 'S475PS20170422', '45647', 'hgddf', 'ipitah', '2017-04-22 10:44:15'),
(45, 3, 10.00, 5, NULL, 310.00, 0.00, 0.00, 'CASH', NULL, 'S281PS20170422', '45647', 'hgddf', 'ipitah', '2017-04-22 10:46:14'),
(46, 2, 140.00, 1, NULL, 310.00, 0.00, 0.00, 'CASH', NULL, 'S281PS20170422', '45647', 'hgddf', 'ipitah', '2017-04-22 10:46:14'),
(47, 1, 60.00, 2, NULL, 310.00, 0.00, 0.00, 'CASH', NULL, 'S281PS20170422', '45647', 'hgddf', 'ipitah', '2017-04-22 10:46:14'),
(48, 3, 10.00, 5, NULL, 310.00, 0.00, 0.00, 'CASH', NULL, 'S457PS20170422', '45647', 'hgddf', 'ipitah', '2017-04-22 10:50:16'),
(49, 2, 140.00, 1, NULL, 310.00, 0.00, 0.00, 'CASH', NULL, 'S457PS20170422', '45647', 'hgddf', 'ipitah', '2017-04-22 10:50:16'),
(50, 1, 60.00, 2, NULL, 310.00, 0.00, 0.00, 'CASH', NULL, 'S457PS20170422', '45647', 'hgddf', 'ipitah', '2017-04-22 10:50:16'),
(54, 3, 10.00, 5, NULL, 310.00, 0.00, 0.00, 'CASH', NULL, 'S669PS20170422', '45647', 'hgddf', 'ipitah', '2017-04-22 11:00:26'),
(55, 2, 140.00, 1, NULL, 310.00, 0.00, 0.00, 'CASH', NULL, 'S669PS20170422', '45647', 'hgddf', 'ipitah', '2017-04-22 11:00:26'),
(56, 1, 60.00, 2, NULL, 310.00, 0.00, 0.00, 'CASH', NULL, 'S669PS20170422', '45647', 'hgddf', 'ipitah', '2017-04-22 11:00:26'),
(60, 3, 10.00, 5, NULL, 310.00, 0.00, 0.00, 'CASH', NULL, 'S488PS20170422', '45647', 'hgddf', 'ipitah', '2017-04-22 11:07:07'),
(61, 2, 140.00, 1, NULL, 310.00, 0.00, 0.00, 'CASH', NULL, 'S488PS20170422', '45647', 'hgddf', 'ipitah', '2017-04-22 11:07:07'),
(62, 1, 60.00, 2, NULL, 310.00, 0.00, 0.00, 'CASH', NULL, 'S488PS20170422', '45647', 'hgddf', 'ipitah', '2017-04-22 11:07:07'),
(63, 3, 10.00, 5, NULL, 310.00, 0.00, 0.00, 'CASH', NULL, 'S660PS20170422', '45647', 'hgddf', 'ipitah', '2017-04-22 11:08:02'),
(64, 2, 140.00, 1, NULL, 310.00, 0.00, 0.00, 'CASH', NULL, 'S660PS20170422', '45647', 'hgddf', 'ipitah', '2017-04-22 11:08:02'),
(65, 1, 60.00, 2, NULL, 310.00, 0.00, 0.00, 'CASH', NULL, 'S660PS20170422', '45647', 'hgddf', 'ipitah', '2017-04-22 11:08:02'),
(66, 3, 10.00, 5, NULL, 310.00, 0.00, 0.00, 'CASH', NULL, 'S277PS20170422', '45647', 'hgddf', 'ipitah', '2017-04-22 11:08:45'),
(67, 2, 140.00, 1, NULL, 310.00, 0.00, 0.00, 'CASH', NULL, 'S277PS20170422', '45647', 'hgddf', 'ipitah', '2017-04-22 11:08:45'),
(68, 1, 60.00, 2, NULL, 310.00, 0.00, 0.00, 'CASH', NULL, 'S277PS20170422', '45647', 'hgddf', 'ipitah', '2017-04-22 11:08:45'),
(69, 3, 10.00, 5, NULL, 310.00, 0.00, 0.00, 'CASH', NULL, 'S865PS20170422', '45647', 'hgddf', 'ipitah', '2017-04-22 11:09:32'),
(70, 2, 140.00, 1, NULL, 310.00, 0.00, 0.00, 'CASH', NULL, 'S865PS20170422', '45647', 'hgddf', 'ipitah', '2017-04-22 11:09:32'),
(71, 1, 60.00, 2, NULL, 310.00, 0.00, 0.00, 'CASH', NULL, 'S865PS20170422', '45647', 'hgddf', 'ipitah', '2017-04-22 11:09:32'),
(75, 3, 10.00, 5, NULL, 310.00, 0.00, 0.00, 'CASH', NULL, 'S532PS20170422', '45647', 'hgddf', 'ipitah', '2017-04-22 11:14:19'),
(76, 2, 140.00, 1, NULL, 310.00, 0.00, 0.00, 'CASH', NULL, 'S532PS20170422', '45647', 'hgddf', 'ipitah', '2017-04-22 11:14:19'),
(77, 1, 60.00, 2, NULL, 310.00, 0.00, 0.00, 'CASH', NULL, 'S532PS20170422', '45647', 'hgddf', 'ipitah', '2017-04-22 11:14:19'),
(78, 3, 10.00, 5, NULL, 310.00, 0.00, 0.00, 'CASH', NULL, 'S284PS20170422', '45647', 'hgddf', 'ipitah', '2017-04-22 11:15:33'),
(79, 2, 140.00, 1, NULL, 310.00, 0.00, 0.00, 'CASH', NULL, 'S284PS20170422', '45647', 'hgddf', 'ipitah', '2017-04-22 11:15:33'),
(80, 1, 60.00, 2, NULL, 310.00, 0.00, 0.00, 'CASH', NULL, 'S284PS20170422', '45647', 'hgddf', 'ipitah', '2017-04-22 11:15:33'),
(81, 3, 10.00, 5, NULL, 310.00, 0.00, 0.00, 'CASH', NULL, 'S524PS20170422', '45647', 'hgddf', 'ipitah', '2017-04-22 11:22:58'),
(82, 2, 140.00, 1, NULL, 310.00, 0.00, 0.00, 'CASH', NULL, 'S524PS20170422', '45647', 'hgddf', 'ipitah', '2017-04-22 11:22:58'),
(83, 1, 60.00, 2, NULL, 310.00, 0.00, 0.00, 'CASH', NULL, 'S524PS20170422', '45647', 'hgddf', 'ipitah', '2017-04-22 11:22:58'),
(84, 3, 10.00, 5, NULL, 310.00, 0.00, 0.00, 'CASH', NULL, 'S627PS20170422', '45647', 'hgddf', 'ipitah', '2017-04-22 11:27:24'),
(85, 2, 140.00, 1, NULL, 310.00, 0.00, 0.00, 'CASH', NULL, 'S627PS20170422', '45647', 'hgddf', 'ipitah', '2017-04-22 11:27:24'),
(86, 1, 60.00, 2, NULL, 310.00, 0.00, 0.00, 'CASH', NULL, 'S627PS20170422', '45647', 'hgddf', 'ipitah', '2017-04-22 11:27:24'),
(87, 3, 10.00, 5, NULL, 310.00, 0.00, 0.00, 'CASH', NULL, 'S325PS20170422', '45647', 'hgddf', 'ipitah', '2017-04-22 11:28:54'),
(88, 2, 140.00, 1, NULL, 310.00, 0.00, 0.00, 'CASH', NULL, 'S325PS20170422', '45647', 'hgddf', 'ipitah', '2017-04-22 11:28:54'),
(89, 1, 60.00, 2, NULL, 310.00, 0.00, 0.00, 'CASH', NULL, 'S325PS20170422', '45647', 'hgddf', 'ipitah', '2017-04-22 11:28:54'),
(90, 3, 10.00, 5, NULL, 310.00, 0.00, 0.00, 'CASH', NULL, 'S372PS20170422', '45647', 'hgddf', 'ipitah', '2017-04-22 11:29:33'),
(91, 2, 140.00, 1, NULL, 310.00, 0.00, 0.00, 'CASH', NULL, 'S372PS20170422', '45647', 'hgddf', 'ipitah', '2017-04-22 11:29:33'),
(92, 1, 60.00, 2, NULL, 310.00, 0.00, 0.00, 'CASH', NULL, 'S372PS20170422', '45647', 'hgddf', 'ipitah', '2017-04-22 11:29:33'),
(93, 3, 10.00, 5, NULL, 310.00, 0.00, 0.00, 'CASH', NULL, 'S697PS20170422', '45647', 'hgddf', 'ipitah', '2017-04-22 11:31:19'),
(94, 2, 140.00, 1, NULL, 310.00, 0.00, 0.00, 'CASH', NULL, 'S697PS20170422', '45647', 'hgddf', 'ipitah', '2017-04-22 11:31:19'),
(95, 1, 60.00, 2, NULL, 310.00, 0.00, 0.00, 'CASH', NULL, 'S697PS20170422', '45647', 'hgddf', 'ipitah', '2017-04-22 11:31:19'),
(96, 3, 10.00, 5, NULL, 310.00, 0.00, 0.00, 'CASH', NULL, 'S466PS20170422', '45647', 'hgddf', 'ipitah', '2017-04-22 11:37:22'),
(97, 2, 140.00, 1, NULL, 310.00, 0.00, 0.00, 'CASH', NULL, 'S466PS20170422', '45647', 'hgddf', 'ipitah', '2017-04-22 11:37:22'),
(98, 1, 60.00, 2, NULL, 310.00, 0.00, 0.00, 'CASH', NULL, 'S466PS20170422', '45647', 'hgddf', 'ipitah', '2017-04-22 11:37:22'),
(99, 3, 10.00, 5, NULL, 310.00, 0.00, 0.00, 'CASH', NULL, 'S484PS20170422', '45647', 'hgddf', 'ipitah', '2017-04-22 11:38:15'),
(100, 2, 140.00, 1, NULL, 310.00, 0.00, 0.00, 'CASH', NULL, 'S484PS20170422', '45647', 'hgddf', 'ipitah', '2017-04-22 11:38:15'),
(101, 1, 60.00, 2, NULL, 310.00, 0.00, 0.00, 'CASH', NULL, 'S484PS20170422', '45647', 'hgddf', 'ipitah', '2017-04-22 11:38:15'),
(102, 3, 10.00, 5, NULL, 310.00, 0.00, 0.00, 'CASH', NULL, 'S834PS20170422', '45647', 'hgddf', 'ipitah', '2017-04-22 11:38:49'),
(103, 2, 140.00, 1, NULL, 310.00, 0.00, 0.00, 'CASH', NULL, 'S834PS20170422', '45647', 'hgddf', 'ipitah', '2017-04-22 11:38:49'),
(104, 1, 60.00, 2, NULL, 310.00, 0.00, 0.00, 'CASH', NULL, 'S834PS20170422', '45647', 'hgddf', 'ipitah', '2017-04-22 11:38:49'),
(105, 3, 10.00, 5, NULL, 310.00, 0.00, 0.00, 'CASH', NULL, 'S924PS20170422', '45647', 'hgddf', 'ipitah', '2017-04-22 11:39:57'),
(106, 2, 140.00, 1, NULL, 310.00, 0.00, 0.00, 'CASH', NULL, 'S924PS20170422', '45647', 'hgddf', 'ipitah', '2017-04-22 11:39:57'),
(107, 1, 60.00, 2, NULL, 310.00, 0.00, 0.00, 'CASH', NULL, 'S924PS20170422', '45647', 'hgddf', 'ipitah', '2017-04-22 11:39:57'),
(108, 3, 10.00, 5, NULL, 310.00, 0.00, 0.00, 'CASH', NULL, 'S893PS20170422', '45647', 'hgddf', 'ipitah', '2017-04-22 11:40:34'),
(109, 2, 140.00, 1, NULL, 310.00, 0.00, 0.00, 'CASH', NULL, 'S893PS20170422', '45647', 'hgddf', 'ipitah', '2017-04-22 11:40:34'),
(110, 1, 60.00, 2, NULL, 310.00, 0.00, 0.00, 'CASH', NULL, 'S893PS20170422', '45647', 'hgddf', 'ipitah', '2017-04-22 11:40:34'),
(111, 3, 10.00, 5, NULL, 310.00, 0.00, 0.00, 'CASH', NULL, 'S370PS20170422', '45647', 'hgddf', 'ipitah', '2017-04-22 11:43:01'),
(112, 2, 140.00, 1, NULL, 310.00, 0.00, 0.00, 'CASH', NULL, 'S370PS20170422', '45647', 'hgddf', 'ipitah', '2017-04-22 11:43:01'),
(113, 1, 60.00, 2, NULL, 310.00, 0.00, 0.00, 'CASH', NULL, 'S370PS20170422', '45647', 'hgddf', 'ipitah', '2017-04-22 11:43:01'),
(119, 1, 60.00, 1, 230, 60.00, 0.00, 20.00, 'CASH', 'NR', 'S729PS20170424', '3462246', 'Baba yao', 'ipitah', '2017-04-24 20:25:29'),
(120, 2, 140.00, 1, 230, 140.00, 0.00, 20.00, 'CASH', 'NR', 'S729PS20170424', '3462246', 'Baba yao', 'ipitah', '2017-04-24 20:25:29'),
(121, 4, 10.00, 1, 230, 10.00, 0.00, 20.00, 'CASH', 'NR', 'S729PS20170424', '3462246', 'Baba yao', 'ipitah', '2017-04-24 20:25:29'),
(122, 5, 600.00, 1, 1000, 600.00, 0.00, 400.00, 'CASH', '', 'S666PS20170430', '256890', 'Catherine', 'ipitah', '2017-04-30 08:53:52'),
(123, 6, 60.00, 1, 500, 60.00, 0.00, 440.00, 'CASH', '', 'S317PS20170501', '3456232', 'fh', 'ipitah', '2017-05-01 10:47:50'),
(124, 6, 60.00, 1, 100, 60.00, 0.00, 40.00, 'CASH', 'ddaxs', 'S384PS20170501', '444444445', 'fcvcsssssa', 'userone', '2017-05-01 15:07:03'),
(125, 6, 60.00, 1, 100, 60.00, 0.00, 40.00, 'CASH', 'ddaxs', 'S187PS20170501', '444444445', 'fcvcsssssa', 'userone', '2017-05-01 15:09:22');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `spoilt_items`
--

INSERT INTO `spoilt_items` (`spoiltno`, `itemno`, `quantity`, `describe`, `recordedby`, `daterecorded`) VALUES
(2, 2, 5, 'Broken down', 'ipitah', '2017-04-21 21:13:39'),
(3, 2, 1, 'Broken down', 'ipitah', '2017-04-21 21:16:18');

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
('Peter Ndirangu', 'ndejanpeter@gmail.com', '0713971439', 'M', 'ipitah', '957b527bcfbad2e80f58d20683931435', 'RECEPTIONIST', '2017-04-04 19:59:04', 'ACTIVE'),
('User One', NULL, '', 'M', 'userone', '24c9e15e52afc47c225b757e7bee1f9d', 'RECEPTIONIST', '2017-04-13 16:52:16', 'ACTIVE');

-- --------------------------------------------------------

--
-- Stand-in structure for view `titemspurchased`
--
CREATE TABLE IF NOT EXISTS `titemspurchased` (
`itemid` int(10)
,`itemname` varchar(300)
,`bp` float(10,2)
,`sp` float(10,2)
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

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `titemspurchased` AS select `items`.`itemid` AS `itemid`,`items`.`itemname` AS `itemname`,`items`.`bp` AS `bp`,`items`.`sp` AS `sp`,`purchase`.`pquantity` AS `pquantity`,coalesce(sum(`purchase`.`pquantity`),0) AS `prem` from (`items` left join `purchase` on((`items`.`itemid` = `purchase`.`pitemid`))) group by `items`.`itemid`;

-- --------------------------------------------------------

--
-- Structure for view `titemssold`
--
DROP TABLE IF EXISTS `titemssold`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `titemssold` AS select `items`.`itemid` AS `itemid`,`items`.`itemname` AS `itemname`,`items`.`bp` AS `bp`,`items`.`sp` AS `sp`,coalesce(sum(`sale`.`squantity`),0) AS `srem` from (`items` left join `sale` on((`items`.`itemid` = `sale`.`sitemid`))) group by `items`.`itemid`;

-- --------------------------------------------------------

--
-- Structure for view `titemsspoilt`
--
DROP TABLE IF EXISTS `titemsspoilt`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `titemsspoilt` AS select `items`.`itemid` AS `itemid`,`items`.`itemname` AS `itemname`,`items`.`bp` AS `bp`,`items`.`sp` AS `sp`,coalesce(sum(`spoilt_items`.`quantity`),0) AS `sprem` from (`items` left join `spoilt_items` on((`items`.`itemid` = `spoilt_items`.`itemno`))) group by `items`.`itemid`;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `category`
--
ALTER TABLE `category`
  ADD CONSTRAINT `category_ibfk_1` FOREIGN KEY (`addedby`) REFERENCES `staff` (`username`) ON UPDATE CASCADE;

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
-- Constraints for table `spoilt_items`
--
ALTER TABLE `spoilt_items`
  ADD CONSTRAINT `spoilt_items_ibfk_1` FOREIGN KEY (`itemno`) REFERENCES `items` (`itemid`) ON UPDATE CASCADE,
  ADD CONSTRAINT `spoilt_items_ibfk_2` FOREIGN KEY (`recordedby`) REFERENCES `staff` (`username`) ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
