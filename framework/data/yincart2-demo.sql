-- phpMyAdmin SQL Dump
-- version 4.2.5
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Sep 15, 2014 at 08:28 AM
-- Server version: 5.6.14
-- PHP Version: 5.5.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `yincart`
--

-- --------------------------------------------------------

--
-- Table structure for table `address`
--

CREATE TABLE IF NOT EXISTS `address` (
`address_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `country` varchar(45) NOT NULL,
  `state` varchar(45) NOT NULL,
  `city` varchar(45) NOT NULL,
  `area` varchar(45) NOT NULL,
  `address` varchar(45) NOT NULL,
  `zip_code` varchar(10) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `mobile` varchar(15) NOT NULL,
  `contact_name` varchar(45) NOT NULL,
  `is_default` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `address_area`
--

CREATE TABLE IF NOT EXISTS `address_area` (
`address_area_id` int(11) NOT NULL,
  `parent_id` int(11) NOT NULL,
  `path` varchar(45) NOT NULL,
  `grade` tinyint(4) NOT NULL,
  `name` varchar(45) NOT NULL,
  `language` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `address_area`
--

INSERT INTO `address_area` (`address_area_id`, `parent_id`, `path`, `grade`, `name`, `language`) VALUES
(0, 0, '0', 0, '0', '0');

-- --------------------------------------------------------

--
-- Table structure for table `auth_assignment`
--

CREATE TABLE IF NOT EXISTS `auth_assignment` (
  `item_name` varchar(64) NOT NULL,
  `user_id` varchar(64) NOT NULL,
  `created_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `auth_item`
--

CREATE TABLE IF NOT EXISTS `auth_item` (
  `name` varchar(64) NOT NULL,
  `type` int(11) NOT NULL,
  `description` text,
  `rule_name` varchar(64) DEFAULT NULL,
  `data` text,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `auth_item_child`
--

CREATE TABLE IF NOT EXISTS `auth_item_child` (
  `parent` varchar(64) NOT NULL,
  `child` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `auth_rule`
--

CREATE TABLE IF NOT EXISTS `auth_rule` (
  `name` varchar(64) NOT NULL,
  `data` text,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE IF NOT EXISTS `category` (
`category_id` int(11) NOT NULL,
  `parent_id` int(11) NOT NULL,
  `name` varchar(45) NOT NULL,
  `url_key` varchar(45) NOT NULL,
  `image` varchar(255) NOT NULL,
  `meta_keywords` varchar(255) NOT NULL,
  `meta_description` varchar(255) NOT NULL,
  `sort` tinyint(4) NOT NULL DEFAULT '0',
  `is_navigation_menu` tinyint(4) NOT NULL DEFAULT '1',
  `is_inherit` tinyint(4) NOT NULL DEFAULT '0',
  `status` tinyint(4) NOT NULL DEFAULT '1'
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=20 ;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`category_id`, `parent_id`, `name`, `url_key`, `image`, `meta_keywords`, `meta_description`, `sort`, `is_navigation_menu`, `is_inherit`, `status`) VALUES
(0, 0, '0', '0', '0', '0', '0', 0, 0, 0, 0),
(1, 0, '所有商品分类', 'all', '/pictures/Desert.jpg', 'all', 'all of all', 0, 0, 0, 1),
(2, 1, '方便速食/罐头食品', '', '', '', '', 1, 1, 1, 1),
(3, 1, '饼干/糕点/面包', '', '', '', '', 2, 1, 1, 1),
(4, 1, '膨化/坚果/糖果', '', '', '', '', 3, 1, 1, 1),
(5, 1, '饮料/冲饮/牛奶', '', '', '', '', 4, 1, 1, 1),
(6, 1, '小包休闲零食', '小包休闲零食', '', '', '', 5, 0, 1, 1),
(7, 1, '进口特色美食', '进口特色美食', '', '', '', 6, 0, 1, 1),
(8, 1, '精选生活用品', '精选生活用品', '', '', '', 7, 0, 1, 1),
(9, 1, '精选文具用品', '精选文具用品', '', '', '', 8, 0, 1, 1),
(10, 2, '方便面/米线', '', '', '', '', 1, 1, 1, 1),
(11, 2, '速食/酱菜', '', '', '', '', 2, 1, 1, 1),
(12, 2, '罐装食品', '', '', '', '', 3, 1, 1, 1),
(13, 10, '桶装面/杯装面', '', '', '', '', 1, 1, 1, 1),
(14, 10, '袋装面/干脆面', '', '', '', '', 2, 1, 1, 1),
(15, 10, '方便粉丝/米线', '', '', '', '', 3, 1, 1, 1),
(17, 11, '方便饭/菜泡饭', '', '', '', '', 1, 1, 1, 1),
(18, 11, ' 火腿肠/速食', '', '', '', '', 2, 1, 1, 1),
(19, 11, '禽蛋/酱菜', '', '', '', '', 3, 1, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE IF NOT EXISTS `customer` (
`customer_id` int(11) NOT NULL,
  `customer_group_id` int(11) NOT NULL,
  `username` varchar(45) NOT NULL,
  `email` varchar(45) NOT NULL,
  `auth_key` varchar(45) NOT NULL,
  `password_hash` varchar(45) NOT NULL,
  `password_reset_token` varchar(45) NOT NULL,
  `register_time` int(11) NOT NULL,
  `last_login_time` int(11) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `customer_group`
--

CREATE TABLE IF NOT EXISTS `customer_group` (
`customer_group_id` int(11) NOT NULL,
  `name` varchar(45) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `item`
--

CREATE TABLE IF NOT EXISTS `item` (
`item_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `sku` varchar(45) NOT NULL,
  `name` varchar(45) NOT NULL,
  `description` text NOT NULL,
  `short_description` text NOT NULL,
  `meta_keywords` varchar(255) NOT NULL,
  `meta_description` varchar(255) NOT NULL,
  `url_key` varchar(45) NOT NULL,
  `news_from_date` int(11) NOT NULL DEFAULT '0',
  `news_to_date` int(11) NOT NULL DEFAULT '0',
  `original_price` float NOT NULL DEFAULT '0',
  `price` float NOT NULL DEFAULT '0',
  `weight` float NOT NULL DEFAULT '0',
  `shipping_fee` float NOT NULL DEFAULT '0',
  `is_free_shipping` tinyint(4) NOT NULL DEFAULT '0',
  `stock_qty` int(11) NOT NULL DEFAULT '0',
  `notify_stock_qty` int(11) NOT NULL DEFAULT '0',
  `min_sale_qty` int(11) NOT NULL DEFAULT '1',
  `max_sale_qty` int(11) NOT NULL DEFAULT '0',
  `qty_increments` int(11) NOT NULL DEFAULT '1',
  `clicks` int(11) NOT NULL DEFAULT '0',
  `wishes` int(11) NOT NULL DEFAULT '0',
  `sales` int(11) NOT NULL DEFAULT '0',
  `sort` smallint(6) NOT NULL DEFAULT '0',
  `status` tinyint(4) NOT NULL DEFAULT '1'
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `item`
--

INSERT INTO `item` (`item_id`, `category_id`, `sku`, `name`, `description`, `short_description`, `meta_keywords`, `meta_description`, `url_key`, `news_from_date`, `news_to_date`, `original_price`, `price`, `weight`, `shipping_fee`, `is_free_shipping`, `stock_qty`, `notify_stock_qty`, `min_sale_qty`, `max_sale_qty`, `qty_increments`, `clicks`, `wishes`, `sales`, `sort`, `status`) VALUES
(0, 0, '0', '0', '0', '0', '0', '0', '0', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(1, 1, '111', 'test', '<p>testtesttest</p>\n', '<p>testtest</p>\n', '', '', '111', 0, 0, 0, 0, 0, 0, 1, 0, 0, 1, 0, 1, 0, 0, 0, 0, 1),
(2, 3, 'test1', 'test1', '<p>test1</p>\n', '<p>test1</p>\n', '', '', 'test1', 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 0, 1, 0, 0, 0, 1, 1),
(3, 3, 'test2', 'test2', '<p>test2</p>\n', '<p>test2</p>\n', '', '', 'test2', 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 0, 1, 0, 0, 0, 2, 1),
(4, 3, 'test3', 'test3', '<p>test3</p>\n', '<p>test3</p>\n', '', '', 'test3', 0, 0, 0, 0, 0, 0, 1, 0, 0, 1, 0, 1, 0, 0, 0, 0, 1),
(5, 3, 'test4', 'test4', '<p>test4</p>\n', '<p>test4</p>\n', '', '', 'test4', 0, 0, 0, 0, 0, 0, 1, 0, 0, 1, 0, 1, 0, 0, 0, 0, 1),
(6, 3, 'test5', 'test5', '<p>test5</p>\n', '<p>test5</p>\n', '', '', 'test5', 0, 0, 0, 0, 0, 0, 1, 0, 0, 1, 0, 1, 0, 0, 0, 0, 1),
(7, 3, 'test6', 'test6', '<p>test6</p>\n', '<p>test6</p>\n', '', '', 'test6', 0, 0, 0, 0, 0, 0, 1, 0, 0, 1, 0, 1, 0, 0, 0, 0, 1),
(8, 3, 'test7', 'test7', '<p>test7</p>\n', '<p>test7</p>\n', '', '', 'test7', 0, 0, 0, 0, 0, 0, 1, 0, 0, 1, 0, 1, 0, 0, 0, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `item_img`
--

CREATE TABLE IF NOT EXISTS `item_img` (
`item_img_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `url` varchar(255) NOT NULL,
  `name` varchar(45) NOT NULL,
  `sort` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=19 ;

--
-- Dumping data for table `item_img`
--

INSERT INTO `item_img` (`item_img_id`, `item_id`, `url`, `name`, `sort`) VALUES
(3, 1, '/pictures/Koala.jpg', '', 0),
(4, 1, '/pictures/Penguins.jpg', '', 1),
(5, 2, '/pictures/Jellyfish.jpg', '', 0),
(6, 2, '/pictures/Desert.jpg', '', 1),
(7, 3, '/pictures/Chrysanthemum.jpg', '', 0),
(8, 4, '/pictures/Desert.jpg', '', 0),
(9, 5, '/pictures/Tulips.jpg', '', 0),
(10, 6, '/pictures/Penguins.jpg', '', 0),
(11, 7, '/pictures/Lighthouse.jpg', '', 0),
(12, 8, '/pictures/Hydrangeas.jpg', '', 0),
(13, 1, '/pictures/Chrysanthemum.jpg', '', 2),
(14, 1, '/pictures/Desert.jpg', '', 3),
(15, 1, '/pictures/Hydrangeas.jpg', '', 4),
(16, 1, '/pictures/Jellyfish.jpg', '', 5),
(17, 1, '/pictures/Lighthouse.jpg', '', 6),
(18, 1, '/pictures/Tulips.jpg', '', 7);

-- --------------------------------------------------------

--
-- Table structure for table `item_prop`
--

CREATE TABLE IF NOT EXISTS `item_prop` (
`item_prop_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `name` varchar(45) NOT NULL,
  `type` tinyint(4) NOT NULL DEFAULT '1',
  `is_key` tinyint(4) NOT NULL DEFAULT '0',
  `is_sale` tinyint(4) NOT NULL DEFAULT '0',
  `is_color` tinyint(4) NOT NULL DEFAULT '0',
  `is_search` tinyint(4) NOT NULL DEFAULT '0',
  `is_must` tinyint(4) NOT NULL DEFAULT '0',
  `sort` tinyint(4) NOT NULL DEFAULT '0',
  `status` tinyint(4) NOT NULL DEFAULT '1'
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=29 ;

--
-- Dumping data for table `item_prop`
--

INSERT INTO `item_prop` (`item_prop_id`, `category_id`, `name`, `type`, `is_key`, `is_sale`, `is_color`, `is_search`, `is_must`, `sort`, `status`) VALUES
(0, 0, '0', 0, 0, 0, 0, 0, 0, 0, 0),
(12, 1, '品牌', 2, 1, 0, 0, 1, 1, 0, 1),
(13, 1, '配料表', 1, 0, 0, 0, 0, 1, 0, 1),
(14, 1, '食品添加剂', 1, 0, 0, 0, 0, 1, 0, 1),
(15, 1, '包装方式', 1, 0, 0, 0, 0, 1, 0, 1),
(16, 1, '重量', 3, 0, 1, 0, 0, 1, 0, 1),
(17, 1, '保质期', 1, 0, 0, 0, 0, 1, 0, 1),
(18, 1, '产地', 1, 0, 0, 0, 0, 1, 0, 1),
(19, 1, '是否含糖', 1, 0, 0, 0, 0, 1, 0, 1),
(20, 1, '储藏方法', 3, 0, 0, 0, 0, 1, 0, 1),
(21, 1, '生产许可证编号', 1, 0, 0, 0, 0, 1, 0, 1),
(22, 1, '厂商', 1, 0, 0, 0, 0, 0, 0, 1),
(24, 1, '口味', 3, 0, 1, 0, 0, 1, 0, 1),
(26, 3, '品牌', 2, 1, 0, 0, 0, 1, 0, 1),
(27, 3, '口味', 3, 0, 1, 0, 0, 1, 0, 1),
(28, 1, '随便', 3, 0, 1, 0, 0, 0, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `item_prop_value`
--

CREATE TABLE IF NOT EXISTS `item_prop_value` (
`item_prop_value_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `item_prop_id` int(11) NOT NULL,
  `prop_value_id` int(11) NOT NULL,
  `custom_prop_value` varchar(45) NOT NULL,
  `image_url` varchar(255) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=33 ;

--
-- Dumping data for table `item_prop_value`
--

INSERT INTO `item_prop_value` (`item_prop_value_id`, `item_id`, `item_prop_id`, `prop_value_id`, `custom_prop_value`, `image_url`) VALUES
(3, 2, 26, 16, '', ''),
(4, 2, 27, 18, '', ''),
(5, 3, 26, 16, '', ''),
(6, 3, 27, 18, '', ''),
(7, 4, 26, 16, '', ''),
(8, 4, 27, 17, '', ''),
(9, 5, 26, 15, '', ''),
(10, 5, 27, 18, '', ''),
(11, 6, 26, 15, '', ''),
(12, 6, 27, 17, '', ''),
(13, 7, 26, 15, '', ''),
(14, 7, 27, 17, '', ''),
(15, 8, 26, 15, '', ''),
(16, 8, 27, 17, '', ''),
(17, 1, 12, 2, '', ''),
(18, 1, 22, 0, 'aaa', ''),
(19, 1, 21, 0, 'bbb', ''),
(20, 1, 20, 5, '', ''),
(21, 1, 19, 0, '1', ''),
(22, 1, 18, 0, '2', ''),
(23, 1, 17, 0, '3', ''),
(24, 1, 15, 0, '4', ''),
(25, 1, 14, 0, '5', ''),
(26, 1, 13, 0, '6', ''),
(27, 1, 16, 7, '', ''),
(28, 1, 16, 8, '', ''),
(29, 1, 24, 10, '', ''),
(30, 1, 24, 11, '', ''),
(31, 1, 28, 19, '', ''),
(32, 1, 28, 20, '', '');

-- --------------------------------------------------------

--
-- Table structure for table `order`
--

CREATE TABLE IF NOT EXISTS `order` (
`order_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `total_price` float NOT NULL DEFAULT '0',
  `promotions` varchar(45) NOT NULL,
  `created_time` int(11) NOT NULL DEFAULT '0',
  `payment_time` int(11) NOT NULL DEFAULT '0',
  `shipping_time` int(11) NOT NULL DEFAULT '0',
  `completed_time` int(11) NOT NULL DEFAULT '0',
  `canceled_time` int(11) NOT NULL DEFAULT '0',
  `payment_type` tinyint(4) NOT NULL DEFAULT '0',
  `payment_transaction_no` varchar(45) NOT NULL,
  `shipping_type` tinyint(4) NOT NULL DEFAULT '0',
  `shipping_address` varchar(255) NOT NULL,
  `is_free_shipping` tinyint(4) NOT NULL DEFAULT '0',
  `shipping_fee` float NOT NULL DEFAULT '0',
  `remark` varchar(255) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `order_item`
--

CREATE TABLE IF NOT EXISTS `order_item` (
`order_item_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `sku_id` int(11) NOT NULL,
  `name` varchar(45) NOT NULL,
  `image_url` varchar(255) NOT NULL,
  `propertyNames` varchar(255) NOT NULL,
  `original_price` float NOT NULL DEFAULT '0',
  `promotions` varchar(45) NOT NULL,
  `price` float NOT NULL DEFAULT '0',
  `qty` int(11) NOT NULL DEFAULT '1',
  `total_price` float NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `promotion`
--

CREATE TABLE IF NOT EXISTS `promotion` (
`promotion_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `prop_value`
--

CREATE TABLE IF NOT EXISTS `prop_value` (
`prop_value_id` int(11) NOT NULL,
  `item_prop_id` int(11) NOT NULL,
  `name` varchar(45) NOT NULL,
  `sort` tinyint(4) NOT NULL DEFAULT '0',
  `status` tinyint(4) NOT NULL DEFAULT '1'
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=21 ;

--
-- Dumping data for table `prop_value`
--

INSERT INTO `prop_value` (`prop_value_id`, `item_prop_id`, `name`, `sort`, `status`) VALUES
(0, 0, '0', 0, 0),
(2, 12, '达利园', 0, 1),
(3, 12, '旺旺', 0, 1),
(4, 20, '常温', 0, 1),
(5, 20, '密封', 0, 1),
(6, 20, '遮光', 0, 1),
(7, 16, '200g', 0, 1),
(8, 16, '500g', 0, 1),
(9, 16, '1000g', 0, 1),
(10, 24, '麻辣味', 0, 1),
(11, 24, '椒盐味', 0, 1),
(12, 24, '五香味', 0, 1),
(13, 24, '孜然味', 0, 1),
(14, 24, '原味', 0, 1),
(15, 26, '好吃点', 0, 1),
(16, 26, '奥利奥', 0, 1),
(17, 27, '奶油味', 0, 1),
(18, 27, '巧克力味', 0, 1),
(19, 28, '随便1', 0, 0),
(20, 28, '随便2', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `shipping_cart`
--

CREATE TABLE IF NOT EXISTS `shipping_cart` (
`shipping_cart_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `sku_id` int(11) NOT NULL,
  `qty` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `sku`
--

CREATE TABLE IF NOT EXISTS `sku` (
`sku_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `sku` varchar(45) NOT NULL,
  `properties` varchar(255) NOT NULL,
  `property_names` varchar(255) NOT NULL,
  `stock_qty` int(11) NOT NULL DEFAULT '0',
  `price` float NOT NULL DEFAULT '0'
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=23 ;

--
-- Dumping data for table `sku`
--

INSERT INTO `sku` (`sku_id`, `item_id`, `sku`, `properties`, `property_names`, `stock_qty`, `price`) VALUES
(0, 0, '0', '0', '0', 0, 0),
(6, 2, '3', '27:18', '巧克力味', 2, 1),
(7, 3, '4', '27:18', '巧克力味', 3, 2),
(8, 4, '1', '27:17', '奶油味', 1, 1),
(9, 5, '1', '27:18', '巧克力味', 2, 2),
(10, 6, '1', '27:17', '奶油味', 1, 1),
(11, 7, '1', '27:17', '奶油味', 1, 1),
(12, 8, '7', '27:17', '奶油味', 7, 7),
(15, 1, '1', '16:7;24:10;28:19', '200g;麻辣味;随便1', 1, 1),
(16, 1, '2', '16:7;24:10;28:20', '200g;麻辣味;随便2', 2, 2),
(17, 1, '3', '16:7;24:11;28:19', '200g;椒盐味;随便1', 3, 3),
(18, 1, '4', '16:7;24:11;28:20', '200g;椒盐味;随便2', 4, 4),
(19, 1, '5', '16:8;24:10;28:19', '500g;麻辣味;随便1', 5, 5),
(20, 1, '6', '16:8;24:10;28:20', '500g;麻辣味;随便2', 6, 6),
(21, 1, '7', '16:8;24:11;28:19', '500g;椒盐味;随便1', 7, 7),
(22, 1, '8', '16:8;24:11;28:20', '500g;椒盐味;随便2', 8, 8);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
`user_id` int(11) NOT NULL,
  `username` varchar(45) NOT NULL,
  `auth_key` varchar(45) NOT NULL,
  `password_hash` varchar(45) NOT NULL,
  `password_reset_token` varchar(45) NOT NULL,
  `email` varchar(45) NOT NULL,
  `role` smallint(6) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `wish`
--

CREATE TABLE IF NOT EXISTS `wish` (
`wish_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `address`
--
ALTER TABLE `address`
 ADD PRIMARY KEY (`address_id`), ADD KEY `fk_address_customer1_idx` (`customer_id`);

--
-- Indexes for table `address_area`
--
ALTER TABLE `address_area`
 ADD PRIMARY KEY (`address_area_id`), ADD KEY `fk_address_area_address_area1_idx` (`parent_id`);

--
-- Indexes for table `auth_assignment`
--
ALTER TABLE `auth_assignment`
 ADD PRIMARY KEY (`item_name`,`user_id`);

--
-- Indexes for table `auth_item`
--
ALTER TABLE `auth_item`
 ADD PRIMARY KEY (`name`), ADD KEY `rule_name` (`rule_name`), ADD KEY `type` (`type`);

--
-- Indexes for table `auth_item_child`
--
ALTER TABLE `auth_item_child`
 ADD PRIMARY KEY (`parent`,`child`), ADD KEY `child` (`child`);

--
-- Indexes for table `auth_rule`
--
ALTER TABLE `auth_rule`
 ADD PRIMARY KEY (`name`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
 ADD PRIMARY KEY (`category_id`), ADD KEY `fk_category_category1_idx` (`parent_id`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
 ADD PRIMARY KEY (`customer_id`), ADD KEY `fk_customer_customer_group1_idx` (`customer_group_id`);

--
-- Indexes for table `customer_group`
--
ALTER TABLE `customer_group`
 ADD PRIMARY KEY (`customer_group_id`);

--
-- Indexes for table `item`
--
ALTER TABLE `item`
 ADD PRIMARY KEY (`item_id`), ADD KEY `item_category_idx` (`category_id`), ADD KEY `INDEX` (`sku`,`url_key`);

--
-- Indexes for table `item_img`
--
ALTER TABLE `item_img`
 ADD PRIMARY KEY (`item_img_id`), ADD KEY `item_img_item_idx` (`item_id`);

--
-- Indexes for table `item_prop`
--
ALTER TABLE `item_prop`
 ADD PRIMARY KEY (`item_prop_id`), ADD KEY `item_prop_category_idx` (`category_id`);

--
-- Indexes for table `item_prop_value`
--
ALTER TABLE `item_prop_value`
 ADD PRIMARY KEY (`item_prop_value_id`), ADD KEY `ipv_item_idx` (`item_id`), ADD KEY `ipv_item_prop_idx` (`item_prop_id`), ADD KEY `ipv_prop_value_idx` (`prop_value_id`);

--
-- Indexes for table `order`
--
ALTER TABLE `order`
 ADD PRIMARY KEY (`order_id`), ADD KEY `fk_order_customer1_idx` (`customer_id`);

--
-- Indexes for table `order_item`
--
ALTER TABLE `order_item`
 ADD PRIMARY KEY (`order_item_id`), ADD KEY `order_item_order_idx` (`order_id`), ADD KEY `order_item_item_idx` (`item_id`), ADD KEY `fk_order_item_sku1_idx` (`sku_id`);

--
-- Indexes for table `promotion`
--
ALTER TABLE `promotion`
 ADD PRIMARY KEY (`promotion_id`);

--
-- Indexes for table `prop_value`
--
ALTER TABLE `prop_value`
 ADD PRIMARY KEY (`prop_value_id`), ADD KEY `prop_value_item_prop_idx` (`item_prop_id`);

--
-- Indexes for table `shipping_cart`
--
ALTER TABLE `shipping_cart`
 ADD PRIMARY KEY (`shipping_cart_id`), ADD KEY `fk_shippint_cart_customer1_idx` (`customer_id`), ADD KEY `fk_shippint_cart_item1_idx` (`item_id`), ADD KEY `fk_shippint_cart_sku1_idx` (`sku_id`);

--
-- Indexes for table `sku`
--
ALTER TABLE `sku`
 ADD PRIMARY KEY (`sku_id`), ADD KEY `sku_item_idx` (`item_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
 ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `wish`
--
ALTER TABLE `wish`
 ADD PRIMARY KEY (`wish_id`), ADD KEY `fk_wish_customer1_idx` (`customer_id`), ADD KEY `fk_wish_item1_idx` (`item_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `address`
--
ALTER TABLE `address`
MODIFY `address_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `address_area`
--
ALTER TABLE `address_area`
MODIFY `address_area_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=20;
--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
MODIFY `customer_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `customer_group`
--
ALTER TABLE `customer_group`
MODIFY `customer_group_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `item`
--
ALTER TABLE `item`
MODIFY `item_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `item_img`
--
ALTER TABLE `item_img`
MODIFY `item_img_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT for table `item_prop`
--
ALTER TABLE `item_prop`
MODIFY `item_prop_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=29;
--
-- AUTO_INCREMENT for table `item_prop_value`
--
ALTER TABLE `item_prop_value`
MODIFY `item_prop_value_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=33;
--
-- AUTO_INCREMENT for table `order`
--
ALTER TABLE `order`
MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `order_item`
--
ALTER TABLE `order_item`
MODIFY `order_item_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `promotion`
--
ALTER TABLE `promotion`
MODIFY `promotion_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `prop_value`
--
ALTER TABLE `prop_value`
MODIFY `prop_value_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT for table `shipping_cart`
--
ALTER TABLE `shipping_cart`
MODIFY `shipping_cart_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `sku`
--
ALTER TABLE `sku`
MODIFY `sku_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=23;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `wish`
--
ALTER TABLE `wish`
MODIFY `wish_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `address`
--
ALTER TABLE `address`
ADD CONSTRAINT `fk_address_customer1` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`customer_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `address_area`
--
ALTER TABLE `address_area`
ADD CONSTRAINT `fk_address_area_address_area1` FOREIGN KEY (`parent_id`) REFERENCES `address_area` (`address_area_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `auth_assignment`
--
ALTER TABLE `auth_assignment`
ADD CONSTRAINT `auth_assignment_ibfk_1` FOREIGN KEY (`item_name`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `auth_item`
--
ALTER TABLE `auth_item`
ADD CONSTRAINT `auth_item_ibfk_1` FOREIGN KEY (`rule_name`) REFERENCES `auth_rule` (`name`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `auth_item_child`
--
ALTER TABLE `auth_item_child`
ADD CONSTRAINT `auth_item_child_ibfk_1` FOREIGN KEY (`parent`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `auth_item_child_ibfk_2` FOREIGN KEY (`child`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `category`
--
ALTER TABLE `category`
ADD CONSTRAINT `fk_category_category1` FOREIGN KEY (`parent_id`) REFERENCES `category` (`category_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `customer`
--
ALTER TABLE `customer`
ADD CONSTRAINT `fk_customer_customer_group1` FOREIGN KEY (`customer_group_id`) REFERENCES `customer_group` (`customer_group_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `item`
--
ALTER TABLE `item`
ADD CONSTRAINT `item_category` FOREIGN KEY (`category_id`) REFERENCES `category` (`category_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `item_img`
--
ALTER TABLE `item_img`
ADD CONSTRAINT `item_img_item` FOREIGN KEY (`item_id`) REFERENCES `item` (`item_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `item_prop`
--
ALTER TABLE `item_prop`
ADD CONSTRAINT `item_prop_category` FOREIGN KEY (`category_id`) REFERENCES `category` (`category_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `item_prop_value`
--
ALTER TABLE `item_prop_value`
ADD CONSTRAINT `ipv_item` FOREIGN KEY (`item_id`) REFERENCES `item` (`item_id`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `ipv_item_prop` FOREIGN KEY (`item_prop_id`) REFERENCES `item_prop` (`item_prop_id`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `ipv_prop_value` FOREIGN KEY (`prop_value_id`) REFERENCES `prop_value` (`prop_value_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `order`
--
ALTER TABLE `order`
ADD CONSTRAINT `fk_order_customer1` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`customer_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `order_item`
--
ALTER TABLE `order_item`
ADD CONSTRAINT `fk_order_item_sku1` FOREIGN KEY (`sku_id`) REFERENCES `sku` (`sku_id`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `order_item_item` FOREIGN KEY (`item_id`) REFERENCES `item` (`item_id`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `order_item_order` FOREIGN KEY (`order_id`) REFERENCES `order` (`order_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `prop_value`
--
ALTER TABLE `prop_value`
ADD CONSTRAINT `prop_value_item_prop` FOREIGN KEY (`item_prop_id`) REFERENCES `item_prop` (`item_prop_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `shipping_cart`
--
ALTER TABLE `shipping_cart`
ADD CONSTRAINT `fk_shippint_cart_customer1` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`customer_id`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `fk_shippint_cart_item1` FOREIGN KEY (`item_id`) REFERENCES `item` (`item_id`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `fk_shippint_cart_sku1` FOREIGN KEY (`sku_id`) REFERENCES `sku` (`sku_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `sku`
--
ALTER TABLE `sku`
ADD CONSTRAINT `sku_item` FOREIGN KEY (`item_id`) REFERENCES `item` (`item_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `wish`
--
ALTER TABLE `wish`
ADD CONSTRAINT `fk_wish_customer1` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`customer_id`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `fk_wish_item1` FOREIGN KEY (`item_id`) REFERENCES `item` (`item_id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
