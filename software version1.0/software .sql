-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 18, 2019 at 08:33 PM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 7.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `software`
--

-- --------------------------------------------------------

--
-- Table structure for table `backupbroughtproduct`
--

CREATE TABLE `backupbroughtproduct` (
  `id` int(11) NOT NULL,
  `brand` varchar(255) NOT NULL,
  `modelName` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `quantity` int(11) NOT NULL,
  `voucherNo` varchar(255) NOT NULL,
  `date` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `backupdeliveryproduct`
--

CREATE TABLE `backupdeliveryproduct` (
  `id` int(11) NOT NULL,
  `brand` varchar(255) NOT NULL,
  `modelName` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `sellingPrice` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `buyingPrice` int(11) NOT NULL,
  `voucherNo` varchar(255) NOT NULL,
  `date` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `bank`
--

CREATE TABLE `bank` (
  `id` int(11) NOT NULL,
  `bankName` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bank`
--

INSERT INTO `bank` (`id`, `bankName`) VALUES
(9, 'prime'),
(11, 'bankasia');

-- --------------------------------------------------------

--
-- Table structure for table `bankaccount`
--

CREATE TABLE `bankaccount` (
  `id` int(11) NOT NULL,
  `bankName` varchar(255) NOT NULL,
  `acName` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bankaccount`
--

INSERT INTO `bankaccount` (`id`, `bankName`, `acName`) VALUES
(3, 'prime', '123'),
(6, 'prime', '1215478'),
(11, 'bankasia', 'tyure');

-- --------------------------------------------------------

--
-- Table structure for table `bankbalance`
--

CREATE TABLE `bankbalance` (
  `id` int(11) NOT NULL,
  `bankName` varchar(255) NOT NULL,
  `acName` varchar(255) NOT NULL,
  `balance` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bankbalance`
--

INSERT INTO `bankbalance` (`id`, `bankName`, `acName`, `balance`) VALUES
(10, 'prime', '1215478', 50000),
(11, 'prime', '123', 6000),
(12, 'bankasia', 'tyure', 10000);

-- --------------------------------------------------------

--
-- Table structure for table `brand`
--

CREATE TABLE `brand` (
  `id` int(11) NOT NULL,
  `brandName` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `brand`
--

INSERT INTO `brand` (`id`, `brandName`) VALUES
(1, 'Walton'),
(2, 'Samsung'),
(7, 'Xaomi'),
(8, 'Itell');

-- --------------------------------------------------------

--
-- Table structure for table `broughtproduct`
--

CREATE TABLE `broughtproduct` (
  `id` int(11) NOT NULL,
  `brand` varchar(255) NOT NULL,
  `modelName` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `quantity` int(11) NOT NULL,
  `voucherno` varchar(255) NOT NULL,
  `date` varchar(255) NOT NULL,
  `myBill` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `broughtproduct`
--

INSERT INTO `broughtproduct` (`id`, `brand`, `modelName`, `type`, `quantity`, `voucherno`, `date`, `myBill`) VALUES
(5, 'walton', 'primoef3', 'button', 1, 'voucher6', '', 0),
(47, 'walton', 'primoef3', 'button', 15, 'voucher5', '', 0),
(48, 'walton', 'primoef3', 'button', 1, 'voucher7', '', 0),
(49, 'symphony', 'y3', 'touch', 10, 'voucher8', '', 0),
(50, 'symphony', 'z9', 'touch', 5, 'voucher8', '', 0),
(51, 'walton', 'primoef3', 'button', 2, 'voucher9', '0', 0),
(52, 'walton', 'primoef3', 'button', 0, 'voucher10', '', 0),
(53, 'symphony', 'y3', 'touch', 5, 'voucher10', '', 0),
(54, 'symphony', 'z9', 'touch', 3, 'voucher10', '', 0),
(55, 'walton', 'primoef3', 'button', 5, 'voucher11', '', 0),
(58, 'symphony', 'y3', 'touch', 8, 'voucher12', '', 0),
(59, 'walton', 'primoef3', 'button', 1, 'voucher5', '', 0),
(68, 'walton', 'primoef3', 'button', 15, 'voucher17', 'Jun 30, 2019', 0),
(76, 'symphony', 'y3', 'touch', 5, 'voucher14', '', 0),
(77, 'symphony', 'z9', 'touch', 1, 'voucher16', 'Jun 30, 2019', 0),
(95, 'walton', 'uy7', 'touch', 5, 'voucher15', '', 0),
(96, 'walton', 'primoef3', 'button', 1, 'voucher15', 'Jun 29, 2019', 0),
(124, 'walton', 'primoef3', 'button', 5, 'voucher19', 'Jul 17, 2019', 0),
(125, 'symphony', 'y3', 'touch', 100, 'voucher19', 'Jul 11, 2019', 0),
(126, 'symphony', 'z9', 'touch', 100, 'voucher19', 'Jul 11, 2019', 0),
(138, 'walton', 'primoef3', 'button', 1, 'voucher20', 'Jul 17, 2019', 0),
(139, 'walton', 'primoef3', 'button', 4, 'voucher18', 'Jul 1, 2019', 0),
(153, 'walton', 'primoef3', 'button', 8, 'voucher2', 'Aug 3, 2019', 0),
(154, 'walton', 'note5', 'touch', 55, 'voucher3', 'Aug 6, 2019', 0),
(155, 'walton', 'primoef3', 'button', 3, 'voucher4', 'Aug 6, 2019', 0),
(156, 'walton', 'primoef3', 'button', 6, 'voucher5', 'Aug 6, 2019', 0),
(157, 'showcase', 'er456', 'wood', 3, 'voucher6', 'Sep 10, 2019', 0),
(158, 'bed', 'ui89', 'wood', 6, 'voucher7', 'Sep 10, 2019', 0),
(159, 'Walton', '2324', 'button', 34, 'voucher8', 'Sep 18, 2019', 5000);

-- --------------------------------------------------------

--
-- Table structure for table `buyeditingcart`
--

CREATE TABLE `buyeditingcart` (
  `id` int(11) NOT NULL,
  `brand` varchar(255) NOT NULL,
  `modelName` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `quantity` int(11) NOT NULL,
  `voucherNo` varchar(255) NOT NULL,
  `date` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `buyeditingcart`
--

INSERT INTO `buyeditingcart` (`id`, `brand`, `modelName`, `type`, `quantity`, `voucherNo`, `date`) VALUES
(13, 'walton', 'primoef3', 'button', 8, 'voucher2', 'Aug 3, 2019');

-- --------------------------------------------------------

--
-- Table structure for table `buyingcart`
--

CREATE TABLE `buyingcart` (
  `id` int(11) NOT NULL,
  `brand` varchar(255) NOT NULL,
  `modelName` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `quantity` int(11) NOT NULL,
  `voucherNo` varchar(255) NOT NULL,
  `date` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `buyingvoucher`
--

CREATE TABLE `buyingvoucher` (
  `id` int(11) NOT NULL,
  `sellerName` varchar(255) NOT NULL,
  `voucherNo` varchar(255) NOT NULL,
  `voucherDiscount` int(11) NOT NULL,
  `date` varchar(255) NOT NULL,
  `sellersVoucherNo` varchar(255) NOT NULL,
  `myBill` int(11) NOT NULL,
  `payment` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `buyingvoucher`
--

INSERT INTO `buyingvoucher` (`id`, `sellerName`, `voucherNo`, `voucherDiscount`, `date`, `sellersVoucherNo`, `myBill`, `payment`) VALUES
(1, '0', '0', 0, '', '0', 0, 0),
(2, 'mehedi', 'voucher2', 0, 'Aug 3, 2019', '0', 30000, 0),
(3, 'mehedi', 'voucher3', 0, 'Aug 6, 2019', '0', 60000, 50000),
(4, 'mehedi', 'voucher4', 3, 'Aug 6, 2019', '0', 0, 0),
(5, 'mehedi', 'voucher5', 6, 'Aug 6, 2019', '0', 50000, 3000),
(6, 'mehedi', 'voucher6', 0, 'Sep 10, 2019', '0', 0, 0),
(7, 'mehedi', 'voucher7', 0, 'Sep 10, 2019', '0', 0, 0),
(8, 'mehedi', 'voucher8', 0, 'Sep 18, 2019', '0', 5000, 0);

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(11) NOT NULL,
  `brand` varchar(255) NOT NULL,
  `modelName` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `sellingPrice` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `buyingPrice` int(11) NOT NULL,
  `voucherNo` varchar(255) NOT NULL,
  `date` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `cash`
--

CREATE TABLE `cash` (
  `id` int(11) NOT NULL,
  `cash` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cash`
--

INSERT INTO `cash` (`id`, `cash`) VALUES
(1, 80878);

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `due` int(11) NOT NULL,
  `mobile` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`id`, `name`, `address`, `due`, `mobile`) VALUES
(29, 'mehedi', 'sdj d wewue wyew', 0, ''),
(31, 'shakil', 'hje hwegw ew', 0, ''),
(35, 'sweety', 'kdsnfjdfhjdfjdfh', 0, ''),
(36, 'bokor', 'Ashuliya,Savar,Dhaka', 5564, '345678'),
(37, 'sohel', 'Ashuliya,Savar,Dhaka', 5337, '01985452016'),
(38, 'anik', 'Ashuliya,Savar,Dhaka', 0, '987654334'),
(39, 'ninja', 'qwertyui', 5337, '1234567654');

-- --------------------------------------------------------

--
-- Table structure for table `dailycost`
--

CREATE TABLE `dailycost` (
  `reason` varchar(255) NOT NULL,
  `cost` int(11) NOT NULL,
  `date` varchar(255) NOT NULL,
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `dailycost`
--

INSERT INTO `dailycost` (`reason`, `cost`, `date`, `id`) VALUES
('sdfgh', 2345, 'Sep 9, 2019', 3),
('xdfb', 456, 'Sep 9, 2019', 4),
('chapani', 60, 'Sep 10, 2019', 5),
('Tea', 50, 'Sep 18, 2019', 6);

-- --------------------------------------------------------

--
-- Table structure for table `deleveredproduct`
--

CREATE TABLE `deleveredproduct` (
  `id` int(11) NOT NULL,
  `brand` varchar(255) NOT NULL,
  `modelName` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `sellingPrice` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `buyingPrice` int(11) NOT NULL,
  `voucherNo` varchar(255) NOT NULL,
  `date` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `deleveredproduct`
--

INSERT INTO `deleveredproduct` (`id`, `brand`, `modelName`, `type`, `sellingPrice`, `quantity`, `buyingPrice`, `voucherNo`, `date`) VALUES
(42, 'walton', 'primoef3', 'button', 21000, 3, 15600, 'voucher146', 'Jul 11, 2019'),
(52, 'walton', 'primoef3', 'button', 7000, 1, 5200, 'voucher147', 'Jul 13, 2019'),
(126, 'symphony', 'y3', 'touch', 100500, 3, 15000, 'voucher140', 'Jan 30, 2019'),
(259, 'walton', 'primoef3', 'button', 14000, 2, 10400, 'voucher141', 'Jul 1, 2019'),
(260, 'walton', 'primoef3', 'button', 476000, 68, 353600, 'voucher139', 'Feb 30, 2019'),
(261, 'symphony', 'z9', 'touch', 13000, 1, 12000, 'voucher136', 'Jun 30, 2019'),
(284, 'walton', 'primoef3', 'button', 14000, 2, 10400, 'voucher144', 'Jul 9, 2019'),
(288, 'walton', 'primoef3', 'button', 77000, 11, 57200, 'voucher148', 'Aug 4, 2019'),
(293, 'walton', 'primoef3', 'button', 7000, 1, 5200, 'voucher145', 'Jul 9, 2019'),
(297, 'walton', 'primoef3', 'button', 7000, 1, 5200, 'voucher149', 'Aug 4, 2019'),
(300, 'walton', 'primoef3', 'button', 7000, 1, 5200, 'voucher150', 'Aug 4, 2019'),
(302, 'walton', 'primoef3', 'button', 14000, 2, 10400, 'voucher152', 'Aug 4, 2019'),
(303, 'walton', 'primoef3', 'button', 7000, 1, 5200, 'voucher153', 'Aug 4, 2019'),
(304, 'walton', 'primoef3', 'button', 7000, 1, 5200, 'voucher154', 'Aug 4, 2019'),
(305, 'walton', 'primoef3', 'button', 14000, 2, 10400, 'voucher155', 'Aug 5, 2019'),
(306, 'showcase', 'er456', 'wood', 345, 1, 23, 'voucher156', 'Sep 10, 2019'),
(307, 'showcase', 'er456', 'wood', 345, 1, 23, 'voucher157', 'Sep 10, 2019'),
(308, 'bed', 'ui89', 'wood', 17034, 3, 10350, 'voucher158', 'Sep 10, 2019'),
(309, 'bed', 'ui89', 'wood', 5678, 1, 3450, 'voucher159', 'Sep 15, 2019'),
(310, 'bed', 'ui89', 'wood', 5678, 1, 3450, 'voucher160', 'Sep 15, 2019'),
(311, 'bed', 'ui89', 'wood', 5678, 1, 3450, 'voucher161', 'Sep 15, 2019'),
(312, 'showcase', 'er456', 'wood', 345, 1, 23, 'voucher162', 'Sep 18, 2019'),
(313, 'bed', 'ui89', 'wood', 5678, 1, 3450, 'voucher163', 'Sep 18, 2019'),
(314, 'bed', 'ui89', 'wood', 5678, 1, 3450, 'voucher164', 'Sep 18, 2019'),
(315, 'bed', 'ui89', 'wood', 34068, 6, 20700, 'voucher165', 'Sep 18, 2019'),
(316, 'bed', 'ui89', 'wood', 11356, 2, 6900, 'voucher166', 'Sep 18, 2019'),
(317, 'bed', 'ui89', 'wood', 5678, 1, 3450, 'voucher167', 'Sep 18, 2019'),
(318, 'bed', 'ui89', 'wood', 5678, 1, 3450, 'voucher171', 'Sep 18, 2019'),
(319, 'bed', 'ui89', 'wood', 5678, 1, 3450, 'voucher172', 'Sep 18, 2019'),
(320, 'bed', 'ui89', 'wood', 5678, 1, 3450, 'voucher173', 'Sep 18, 2019'),
(321, 'bed', 'ui89', 'wood', 5678, 1, 3450, 'voucher174', 'Sep 18, 2019'),
(323, 'bed', 'ui89', 'wood', 5678, 1, 3450, 'voucher176', 'Sep 18, 2019'),
(324, 'bed', 'ui89', 'wood', 5678, 1, 3450, 'voucher177', 'Sep 18, 2019'),
(325, 'bed', 'ui89', 'wood', 5678, 1, 3450, 'voucher178', 'Sep 18, 2019'),
(326, 'bed', 'ui89', 'wood', 5678, 1, 3450, 'voucher179', 'Sep 18, 2019');

-- --------------------------------------------------------

--
-- Table structure for table `due`
--

CREATE TABLE `due` (
  `id` int(11) NOT NULL,
  `due` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `due`
--

INSERT INTO `due` (`id`, `due`) VALUES
(1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `editingcart`
--

CREATE TABLE `editingcart` (
  `id` int(11) NOT NULL,
  `brand` varchar(255) NOT NULL,
  `modelName` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `sellingPrice` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `buyingPrice` int(11) NOT NULL,
  `voucherNo` varchar(255) NOT NULL,
  `date` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `editmodestatus`
--

CREATE TABLE `editmodestatus` (
  `id` int(11) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `editmodestatus`
--

INSERT INTO `editmodestatus` (`id`, `status`) VALUES
(1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `marketer`
--

CREATE TABLE `marketer` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `contact` varchar(255) NOT NULL,
  `sallary` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `marketer`
--

INSERT INTO `marketer` (`id`, `name`, `contact`, `sallary`) VALUES
(2, 'MERCUSYS_8880', '234', '5665');

-- --------------------------------------------------------

--
-- Table structure for table `maxpro`
--

CREATE TABLE `maxpro` (
  `id` int(11) NOT NULL,
  `brand` varchar(255) NOT NULL,
  `modelName` varchar(255) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `maxpro`
--

INSERT INTO `maxpro` (`id`, `brand`, `modelName`, `quantity`) VALUES
(2254, 'walton', 'primoef3', 96),
(2255, 'symphony', 'y3', 3),
(2256, 'symphony', 'z9', 1),
(2257, 'showcase', 'er456', 3),
(2258, 'bed', 'ui89', 25);

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `model`
--

CREATE TABLE `model` (
  `id` int(11) NOT NULL,
  `modelName` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `brand` varchar(255) NOT NULL,
  `buyingPrice` int(255) NOT NULL,
  `sellingPrice` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `model`
--

INSERT INTO `model` (`id`, `modelName`, `type`, `brand`, `buyingPrice`, `sellingPrice`) VALUES
(1, '2324', 'button', 'Walton', 5200, 7000),
(2, 'uy7', 'touch', 'plastic', 6000, 7000),
(3, 'xh7', 'touch', 'wood', 1200, 12500),
(6, 'note5', 'touch', 'plastic', 5000, 5500),
(7, '345', 'touch', 'xaomi', 3434, 34443),
(8, 'ert66', 'touch', 'Table', 234, 2345),
(9, 'er456', 'wood', 'showcase', 23, 345),
(10, 'fg345', 'plastic', 'Table', 234, 2344),
(11, 'ui89', 'wood', 'bed', 3450, 5678),
(12, 'e45', 'screentouch', 'Xaomi', 2345, 4567);

-- --------------------------------------------------------

--
-- Table structure for table `mpaid`
--

CREATE TABLE `mpaid` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `sallary` int(11) NOT NULL,
  `totalsalary` int(11) NOT NULL,
  `date` varchar(255) NOT NULL,
  `status` int(11) NOT NULL,
  `process` varchar(255) NOT NULL,
  `contact` varchar(255) NOT NULL,
  `month` varchar(255) NOT NULL,
  `year` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mpaid`
--

INSERT INTO `mpaid` (`id`, `name`, `type`, `sallary`, `totalsalary`, `date`, `status`, `process`, `contact`, `month`, `year`) VALUES
(2, 'qwerfgh', 'pass', 2345, 323, 'Sep 15, 2019', 0, 'timely', '123456', 'feb', '2019'),
(3, 'qwerfgh', 'pass', 2, 123, 'Sep 15, 2019', 0, 'advance', '123456', 'mar', '2019'),
(4, 'MERCUSYS_8880', 'pass', 345678, 5865, 'Sep 15, 2019', 0, 'timely', '234', 'jan', '2019');

-- --------------------------------------------------------

--
-- Table structure for table `paid`
--

CREATE TABLE `paid` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `totalsalary` int(11) NOT NULL,
  `sallary` int(11) NOT NULL,
  `date` varchar(255) NOT NULL,
  `status` int(11) NOT NULL,
  `process` varchar(255) NOT NULL,
  `contact` varchar(255) NOT NULL,
  `month` varchar(255) NOT NULL,
  `year` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `paid`
--

INSERT INTO `paid` (`id`, `name`, `type`, `totalsalary`, `sallary`, `date`, `status`, `process`, `contact`, `month`, `year`) VALUES
(1, 'asdfg', 'irregular', 234567, 234567, 'Jan 10, 2019', 0, '', '', '', ''),
(2, 'asdfg', 'regular', 234567, 3434, 'Sep 10, 2019', 0, '', '', '', ''),
(3, 'asdfg', 'regular', 234567, 3456, 'Sep 10, 2019', 0, '', '', '', ''),
(4, 'asdfg', 'regular', 234567, 3456, 'Sep 11, 2019', 0, 'advance', '', '', ''),
(5, 'asdfg', 'regular', 234567, 1, 'Sep 11, 2019', 0, 'timely', '55555', '', ''),
(6, 'asdfg', 'regular', 234567, 11, 'Sep 15, 2019', 0, 'timely', '55555', '', ''),
(7, 'asdfg', 'regular', 234567, 3456, 'Sep 15, 2019', 0, 'timely', '55555', 'jan', '2019'),
(8, 'asdfg', 'regular', 234567, 22422, 'Sep 15, 2019', 0, 'timely', '55555', 'aug', '2019'),
(9, 'asdfg', 'regular', 203, 3, 'Sep 15, 2019', 0, 'timely', '55555', 'oct', '2019'),
(10, 'asdfg', 'regular', 234567, 3, 'Sep 15, 2019', 0, 'timely', '55555', 'dec', '2019'),
(11, 'asdfg', 'regular', 234767, 3, 'Sep 15, 2019', 0, 'timely', '55555', 'nov', '2019'),
(12, 'qwerfgh', 'regular', 323, 3, 'Sep 15, 2019', 0, 'timely', '123456', 'sep', '2019'),
(13, 'asdfg', 'regular', 2545, 5000, 'Sep 18, 2019', 0, 'timely', '1234567', 'sep', '2019');

-- --------------------------------------------------------

--
-- Table structure for table `seller`
--

CREATE TABLE `seller` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `get` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `seller`
--

INSERT INTO `seller` (`id`, `name`, `address`, `get`) VALUES
(1, 'mehedi', 'something', 1),
(2, 'hasan', 'sosmrthong', 0);

-- --------------------------------------------------------

--
-- Table structure for table `sellingvoucher`
--

CREATE TABLE `sellingvoucher` (
  `id` int(11) NOT NULL,
  `customerName` varchar(255) NOT NULL,
  `voucherNo` varchar(255) NOT NULL,
  `voucherDiscount` int(11) NOT NULL,
  `date` varchar(255) NOT NULL,
  `payment` int(11) NOT NULL,
  `mainDate` varchar(255) NOT NULL,
  `cashCounter` int(11) NOT NULL,
  `mobile` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sellingvoucher`
--

INSERT INTO `sellingvoucher` (`id`, `customerName`, `voucherNo`, `voucherDiscount`, `date`, `payment`, `mainDate`, `cashCounter`, `mobile`) VALUES
(129, '0', '0', 0, '', 0, '', 1, ''),
(136, 'mehedi', 'voucher136', 0, 'Jun 30, 2019', 0, '2019-06-30 00:00:00', 1, ''),
(139, 'fdgfg', 'voucher139', 0, 'Jun 30, 2019', 56, '2019-06-30 00:00:00', 1, ''),
(141, 'mehedi', 'voucher141', 0, 'Jul 1, 2019', 26869, '2019-07-01 00:00:00', 1, ''),
(144, 'mehedi', 'voucher144', 0, 'Jul 9, 2019', 0, '2019-07-09 00:00:00', 1, ''),
(145, 'ioiouyi', 'voucher145', 0, 'Jul 9, 2019', 0, '2019-07-09 00:00:00', 1, ''),
(146, 'mehedi', 'voucher146', 0, 'Jul 11, 2019', 20000, '2019-07-11 00:00:00', 1, ''),
(147, 'mehedi', 'voucher147', 5, 'Jul 13, 2019', 7650, '2019-07-13 00:00:00', 1, ''),
(148, 'Select Customer', 'voucher148', 0, 'Aug 4, 2019', 0, '2019-08-04 00:00:00', 1, ''),
(149, 'shakil', 'voucher149', 0, 'Aug 4, 2019', 0, '2019-08-04 00:00:00', 1, ''),
(150, 'sweety', 'voucher150', 0, 'Aug 4, 2019', 0, '2019-08-04 00:00:00', 1, ''),
(152, 'customervoucher152', 'voucher152', 0, 'Aug 4, 2019', 0, '2019-08-04 00:00:00', 1, '34545454545'),
(153, 'customer', 'voucher153', 0, 'Aug 4, 2019', 0, '2019-08-04 00:00:00', 1, '3467876543'),
(154, 'customer154', 'voucher154', 0, 'Aug 4, 2019', 0, '2019-08-04 00:00:00', 1, '345678987'),
(155, 'customer155', 'voucher155', 0, 'Aug 5, 2019', 0, '2019-08-05 00:00:00', 1, '01727534032'),
(156, 'customer156', 'voucher156', 0, 'Sep 10, 2019', 0, '2019-09-10 00:00:00', 1, '2345678'),
(157, 'customer157', 'voucher157', 0, 'Sep 10, 2019', 0, '2019-09-10 00:00:00', 1, '0'),
(158, 'customer158', 'voucher158', 0, 'Sep 10, 2019', 0, '2019-09-10 00:00:00', 1, '0'),
(159, 'customer159', 'voucher159', 0, 'Sep 15, 2019', 5578, '2019-09-15 00:00:00', 1, '0'),
(160, 'customer160', 'voucher160', 0, 'Sep 15, 2019', 5000, '2019-09-15 00:00:00', 1, '0'),
(161, 'customer161', 'voucher161', 0, 'Sep 15, 2019', 5000, '2019-09-15 00:00:00', 1, '0'),
(162, 'customer162', 'voucher162', 0, 'Sep 18, 2019', 300, '2019-09-18 00:00:00', 1, '0'),
(163, 'customer163', 'voucher163', 0, 'Sep 18, 2019', 4000, '2019-09-18 00:00:00', 1, '0'),
(164, 'customer164', 'voucher164', 0, 'Sep 18, 2019', 0, '2019-09-18 00:00:00', 1, '0'),
(165, 'customer165', 'voucher165', 0, 'Sep 18, 2019', 0, '2019-09-18 00:00:00', 1, '0'),
(166, 'customer166', 'voucher166', 0, 'Sep 18, 2019', 0, '2019-09-18 00:00:00', 1, '0'),
(167, 'customer167', 'voucher167', 0, 'Sep 18, 2019', 0, '2019-09-18 00:00:00', 1, '0'),
(168, 'customer168', 'voucher168', 0, 'Sep 18, 2019', 0, '2019-09-18 00:00:00', 1, '0'),
(169, 'customer169', 'voucher168', 0, 'Sep 18, 2019', 0, '2019-09-18 00:00:00', 1, '0'),
(170, 'customer170', 'voucher168', 0, 'Sep 18, 2019', 0, '2019-09-18 00:00:00', 1, '0'),
(171, 'customer171', 'voucher171', 0, 'Sep 18, 2019', 0, '2019-09-18 00:00:00', 1, '0'),
(172, 'customer172', 'voucher172', 0, 'Sep 18, 2019', 0, '2019-09-18 00:00:00', 1, '0'),
(173, 'customer173', 'voucher173', 0, 'Sep 18, 2019', 0, '2019-09-18 00:00:00', 1, '0'),
(174, 'bokor', 'voucher174', 2, 'Sep 18, 2019', 0, '2019-09-18 00:00:00', 1, '0'),
(176, 'customer176', 'voucher176', 0, 'Sep 18, 2019', 0, '2019-09-18 00:00:00', 1, '0'),
(177, 'ninja', 'voucher177', 0, 'Sep 18, 2019', 0, '2019-09-18 00:00:00', 1, '0'),
(178, 'sohel', 'voucher178', 0, 'Sep 18, 2019', 0, '2019-09-18 00:00:00', 1, '0'),
(179, 'customer179', 'voucher179', 0, 'Sep 18, 2019', 0, '2019-09-18 00:00:00', 1, '0');

-- --------------------------------------------------------

--
-- Table structure for table `storage`
--

CREATE TABLE `storage` (
  `id` int(11) NOT NULL,
  `brand` varchar(255) NOT NULL,
  `modelName` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `storage`
--

INSERT INTO `storage` (`id`, `brand`, `modelName`, `type`, `quantity`) VALUES
(1, 'walton', 'primoef3', 'button', 49),
(2, 'symphony', 'w15', 'touch', 19),
(3, 'vivo', 'l78', 'button', 20),
(4, 'nippon', 'n22', 'touch', 40),
(5, 'udemy', 'u99', 'touch', 20),
(6, 'udemy', 'u10', 'button', 20),
(7, 'symphony', 'y3', 'touch', 99),
(8, 'walton', 'uy7', 'touch', 80),
(9, 'symphony', 'z9', 'touch', 104),
(10, 'walton', 'note5', 'touch', 55),
(12, 'bed', 'ui89', 'wood', 40),
(13, 'Walton', '2324', 'button', 34);

-- --------------------------------------------------------

--
-- Table structure for table `topclient`
--

CREATE TABLE `topclient` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `topclient`
--

INSERT INTO `topclient` (`id`, `name`, `quantity`) VALUES
(4758, 'mehedi', 9),
(4759, 'fdgfg', 68),
(4760, 'ioiouyi', 1),
(4761, 'Select Customer', 11),
(4762, 'shakil', 1),
(4763, 'sweety', 1),
(4764, 'customervoucher152', 2),
(4765, 'customer', 1),
(4766, 'customer154', 1),
(4767, 'customer155', 2),
(4768, 'customer156', 1),
(4769, 'customer157', 1),
(4770, 'customer158', 3),
(4771, 'customer159', 1),
(4772, 'customer160', 1),
(4773, 'customer161', 1),
(4774, 'customer162', 1),
(4775, 'customer163', 1),
(4776, 'customer164', 1),
(4777, 'customer165', 6),
(4778, 'customer166', 2),
(4779, 'customer167', 1),
(4780, 'customer168', 0),
(4781, 'customer169', 0),
(4782, 'customer170', 0),
(4783, 'customer171', 1),
(4784, 'customer172', 1),
(4785, 'customer173', 1),
(4786, 'bokor', 1),
(4787, 'customer176', 1),
(4788, 'ninja', 1),
(4789, 'sohel', 1),
(4790, 'customer179', 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Mehedi Hasan', 'mehediaiyub451@gmail.com', NULL, '$2y$10$5sBGArP5Q3TLbVAwrCGjnO2x.jbE56YooIcjnhooyg8iiZV4.uphe', NULL, '2019-09-15 19:50:16', '2019-09-15 19:50:16'),
(2, 'shakil', 'mehediaiyub452@gmail.com', NULL, '$2y$10$Bwyj1np1fEn9bDeq2np9LuyPYcHfJmrHv0/Tn76NVoBmIlTTkK7t6', NULL, '2019-09-15 19:56:09', '2019-09-15 19:56:09'),
(3, 'sohel', 'sohel@gmail.com', NULL, '$2y$10$N/s3qC1Y0YPIWjw1l3AsnOYZxILLQgmW5APT/o.HcQ4JOWDwLCJvK', NULL, '2019-09-18 00:12:11', '2019-09-18 00:12:11');

-- --------------------------------------------------------

--
-- Table structure for table `worker`
--

CREATE TABLE `worker` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `contact` varchar(255) NOT NULL,
  `sallary` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `worker`
--

INSERT INTO `worker` (`id`, `name`, `contact`, `sallary`) VALUES
(1, 'MERCUSYS_8880', '345', 2345),
(3, 'mehedi', '23434', 20000),
(4, 'hasn', '2345', 29000),
(5, 'asdfg', '1234567', 2345),
(6, 'werty', '234567', 1227);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `backupbroughtproduct`
--
ALTER TABLE `backupbroughtproduct`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `backupdeliveryproduct`
--
ALTER TABLE `backupdeliveryproduct`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bank`
--
ALTER TABLE `bank`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bankaccount`
--
ALTER TABLE `bankaccount`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bankbalance`
--
ALTER TABLE `bankbalance`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `brand`
--
ALTER TABLE `brand`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `broughtproduct`
--
ALTER TABLE `broughtproduct`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `buyeditingcart`
--
ALTER TABLE `buyeditingcart`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `buyingcart`
--
ALTER TABLE `buyingcart`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `buyingvoucher`
--
ALTER TABLE `buyingvoucher`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cash`
--
ALTER TABLE `cash`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dailycost`
--
ALTER TABLE `dailycost`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `deleveredproduct`
--
ALTER TABLE `deleveredproduct`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `due`
--
ALTER TABLE `due`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `editingcart`
--
ALTER TABLE `editingcart`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `editmodestatus`
--
ALTER TABLE `editmodestatus`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `marketer`
--
ALTER TABLE `marketer`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `maxpro`
--
ALTER TABLE `maxpro`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `model`
--
ALTER TABLE `model`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mpaid`
--
ALTER TABLE `mpaid`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `paid`
--
ALTER TABLE `paid`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `seller`
--
ALTER TABLE `seller`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sellingvoucher`
--
ALTER TABLE `sellingvoucher`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `storage`
--
ALTER TABLE `storage`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `topclient`
--
ALTER TABLE `topclient`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `worker`
--
ALTER TABLE `worker`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `backupbroughtproduct`
--
ALTER TABLE `backupbroughtproduct`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `backupdeliveryproduct`
--
ALTER TABLE `backupdeliveryproduct`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `bank`
--
ALTER TABLE `bank`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `bankaccount`
--
ALTER TABLE `bankaccount`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `bankbalance`
--
ALTER TABLE `bankbalance`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `brand`
--
ALTER TABLE `brand`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `broughtproduct`
--
ALTER TABLE `broughtproduct`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=160;

--
-- AUTO_INCREMENT for table `buyeditingcart`
--
ALTER TABLE `buyeditingcart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `buyingcart`
--
ALTER TABLE `buyingcart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `buyingvoucher`
--
ALTER TABLE `buyingvoucher`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `cash`
--
ALTER TABLE `cash`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `dailycost`
--
ALTER TABLE `dailycost`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `deleveredproduct`
--
ALTER TABLE `deleveredproduct`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=327;

--
-- AUTO_INCREMENT for table `due`
--
ALTER TABLE `due`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `editingcart`
--
ALTER TABLE `editingcart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `editmodestatus`
--
ALTER TABLE `editmodestatus`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `marketer`
--
ALTER TABLE `marketer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `maxpro`
--
ALTER TABLE `maxpro`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2259;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `model`
--
ALTER TABLE `model`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `mpaid`
--
ALTER TABLE `mpaid`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `paid`
--
ALTER TABLE `paid`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `seller`
--
ALTER TABLE `seller`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `sellingvoucher`
--
ALTER TABLE `sellingvoucher`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=180;

--
-- AUTO_INCREMENT for table `storage`
--
ALTER TABLE `storage`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `topclient`
--
ALTER TABLE `topclient`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4791;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `worker`
--
ALTER TABLE `worker`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
