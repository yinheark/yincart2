-- phpMyAdmin SQL Dump
-- version 4.1.6
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 2014-08-25 16:06:38
-- 服务器版本： 5.6.16
-- PHP Version: 5.5.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `yincart`
--

-- --------------------------------------------------------

--
-- 表的结构 `address`
--

CREATE TABLE IF NOT EXISTS `address` (
  `address_id` int(11) NOT NULL AUTO_INCREMENT,
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
  `is_default` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`address_id`),
  KEY `fk_address_customer1_idx` (`customer_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `address_area`
--

CREATE TABLE IF NOT EXISTS `address_area` (
  `address_area_id` int(11) NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) NOT NULL,
  `path` varchar(45) NOT NULL,
  `grade` tinyint(4) NOT NULL,
  `name` varchar(45) NOT NULL,
  `language` varchar(5) NOT NULL,
  PRIMARY KEY (`address_area_id`),
  KEY `fk_address_area_address_area1_idx` (`parent_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- 转存表中的数据 `address_area`
--

INSERT INTO `address_area` (`address_area_id`, `parent_id`, `path`, `grade`, `name`, `language`) VALUES
(0, 0, '0', 0, '0', '0');

-- --------------------------------------------------------

--
-- 表的结构 `category`
--

CREATE TABLE IF NOT EXISTS `category` (
  `category_id` int(11) NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) NOT NULL,
  `name` varchar(45) NOT NULL,
  `url_key` varchar(45) NOT NULL,
  `image` varchar(255) NOT NULL,
  `meta_keywords` varchar(255) NOT NULL,
  `meta_description` varchar(255) NOT NULL,
  `sort` tinyint(4) NOT NULL DEFAULT '0',
  `is_navigation_menu` tinyint(4) NOT NULL DEFAULT '1',
  `is_inherit` tinyint(4) NOT NULL DEFAULT '0',
  `status` tinyint(4) NOT NULL DEFAULT '1',
  PRIMARY KEY (`category_id`),
  KEY `fk_category_category1_idx` (`parent_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=20 ;

--
-- 转存表中的数据 `category`
--

INSERT INTO `category` (`category_id`, `parent_id`, `name`, `url_key`, `image`, `meta_keywords`, `meta_description`, `sort`, `is_navigation_menu`, `is_inherit`, `status`) VALUES
(0, 0, '0', '0', '0', '0', '0', 0, 0, 0, 0),
(1, 0, '所有商品分类', '', '', '', '', 0, 1, 1, 1),
(2, 1, '方便速食/罐头食品', '', '', '', '', 1, 1, 1, 1),
(3, 1, '饼干/糕点/面包', '', '', '', '', 2, 1, 1, 1),
(4, 1, '膨化/坚果/糖果', '', '', '', '', 3, 1, 1, 1),
(5, 1, '饮料/冲饮/牛奶', '', '', '', '', 4, 1, 1, 1),
(6, 1, '小包休闲零食', '', '', '', '', 5, 1, 1, 1),
(7, 1, '进口特色美食', '', '', '', '', 6, 1, 1, 1),
(8, 1, '精选生活用品', '', '', '', '', 7, 1, 1, 1),
(9, 1, '精选文具用品', '', '', '', '', 8, 1, 1, 1),
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
-- 表的结构 `customer`
--

CREATE TABLE IF NOT EXISTS `customer` (
  `customer_id` int(11) NOT NULL AUTO_INCREMENT,
  `customer_group_id` int(11) NOT NULL,
  `name` varchar(45) NOT NULL,
  `email` varchar(45) NOT NULL,
  `password` varchar(45) NOT NULL,
  `register_time` int(11) NOT NULL,
  `last_login_time` int(11) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`customer_id`),
  KEY `fk_customer_customer_group1_idx` (`customer_group_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `customer_group`
--

CREATE TABLE IF NOT EXISTS `customer_group` (
  `customer_group_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  PRIMARY KEY (`customer_group_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `item`
--

CREATE TABLE IF NOT EXISTS `item` (
  `item_id` int(11) NOT NULL AUTO_INCREMENT,
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
  `status` tinyint(4) NOT NULL DEFAULT '1',
  PRIMARY KEY (`item_id`),
  KEY `item_category_idx` (`category_id`),
  KEY `INDEX` (`sku`,`url_key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- 转存表中的数据 `item`
--

INSERT INTO `item` (`item_id`, `category_id`, `sku`, `name`, `description`, `short_description`, `meta_keywords`, `meta_description`, `url_key`, `news_from_date`, `news_to_date`, `original_price`, `price`, `weight`, `shipping_fee`, `is_free_shipping`, `stock_qty`, `notify_stock_qty`, `min_sale_qty`, `max_sale_qty`, `qty_increments`, `clicks`, `wishes`, `sales`, `sort`, `status`) VALUES
(0, 0, '0', '0', '0', '0', '0', '0', '0', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- 表的结构 `item_img`
--

CREATE TABLE IF NOT EXISTS `item_img` (
  `item_img_id` int(11) NOT NULL AUTO_INCREMENT,
  `item_id` int(11) NOT NULL,
  `url` varchar(255) NOT NULL,
  `name` varchar(45) NOT NULL,
  `sort` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`item_img_id`),
  KEY `item_img_item_idx` (`item_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `item_prop`
--

CREATE TABLE IF NOT EXISTS `item_prop` (
  `item_prop_id` int(11) NOT NULL AUTO_INCREMENT,
  `category_id` int(11) NOT NULL,
  `name` varchar(45) NOT NULL,
  `type` tinyint(4) NOT NULL DEFAULT '1',
  `is_key` tinyint(4) NOT NULL DEFAULT '0',
  `is_sale` tinyint(4) NOT NULL DEFAULT '0',
  `is_color` tinyint(4) NOT NULL DEFAULT '0',
  `is_search` tinyint(4) NOT NULL DEFAULT '0',
  `is_must` tinyint(4) NOT NULL DEFAULT '0',
  `sort` tinyint(4) NOT NULL DEFAULT '0',
  `status` tinyint(4) NOT NULL DEFAULT '1',
  PRIMARY KEY (`item_prop_id`),
  KEY `item_prop_category_idx` (`category_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=28 ;

--
-- 转存表中的数据 `item_prop`
--

INSERT INTO `item_prop` (`item_prop_id`, `category_id`, `name`, `type`, `is_key`, `is_sale`, `is_color`, `is_search`, `is_must`, `sort`, `status`) VALUES
(0, 0, '0', 0, 0, 0, 0, 0, 0, 0, 0),
(12, 1, '品牌', 1, 1, 0, 0, 1, 1, 0, 1),
(13, 1, '配料表', 0, 0, 0, 0, 0, 1, 0, 1),
(14, 1, '食品添加剂', 0, 0, 0, 0, 0, 1, 0, 1),
(15, 1, '包装方式', 0, 0, 0, 0, 0, 1, 0, 1),
(16, 1, '重量', 2, 0, 1, 0, 0, 1, 0, 1),
(17, 1, '保质期', 0, 0, 0, 0, 0, 1, 0, 1),
(18, 1, '产地', 0, 0, 0, 0, 0, 1, 0, 1),
(19, 1, '是否含糖', 0, 0, 0, 0, 0, 1, 0, 1),
(20, 1, '储藏方法', 2, 0, 0, 0, 0, 1, 0, 1),
(21, 1, '生产许可证编号', 0, 0, 0, 0, 0, 1, 0, 1),
(22, 1, '厂商', 0, 0, 0, 0, 0, 0, 0, 1),
(24, 1, '口味', 2, 0, 1, 0, 0, 1, 0, 1),
(26, 3, '品牌', 1, 1, 0, 0, 0, 1, 0, 1),
(27, 3, '口味', 2, 0, 1, 0, 0, 1, 0, 1);

-- --------------------------------------------------------

--
-- 表的结构 `item_prop_value`
--

CREATE TABLE IF NOT EXISTS `item_prop_value` (
  `item_prop_value_id` int(11) NOT NULL AUTO_INCREMENT,
  `item_id` int(11) NOT NULL,
  `item_prop_id` int(11) NOT NULL,
  `prop_value_id` int(11) NOT NULL,
  `custom_prop_value` varchar(45) NOT NULL,
  `image_url` varchar(255) NOT NULL,
  PRIMARY KEY (`item_prop_value_id`),
  KEY `ipv_item_idx` (`item_id`),
  KEY `ipv_item_prop_idx` (`item_prop_id`),
  KEY `ipv_prop_value_idx` (`prop_value_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `order`
--

CREATE TABLE IF NOT EXISTS `order` (
  `order_id` int(11) NOT NULL AUTO_INCREMENT,
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
  `status` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`order_id`),
  KEY `fk_order_customer1_idx` (`customer_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `order_item`
--

CREATE TABLE IF NOT EXISTS `order_item` (
  `order_item_id` int(11) NOT NULL AUTO_INCREMENT,
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
  `total_price` float NOT NULL DEFAULT '0',
  PRIMARY KEY (`order_item_id`),
  KEY `order_item_order_idx` (`order_id`),
  KEY `order_item_item_idx` (`item_id`),
  KEY `fk_order_item_sku1_idx` (`sku_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `promotion`
--

CREATE TABLE IF NOT EXISTS `promotion` (
  `promotion_id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`promotion_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `prop_value`
--

CREATE TABLE IF NOT EXISTS `prop_value` (
  `prop_value_id` int(11) NOT NULL AUTO_INCREMENT,
  `item_prop_id` int(11) NOT NULL,
  `name` varchar(45) NOT NULL,
  `sort` tinyint(4) NOT NULL DEFAULT '0',
  `status` tinyint(4) NOT NULL DEFAULT '1',
  PRIMARY KEY (`prop_value_id`),
  KEY `prop_value_item_prop_idx` (`item_prop_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=19 ;

--
-- 转存表中的数据 `prop_value`
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
(18, 27, '巧克力味', 0, 1);

-- --------------------------------------------------------

--
-- 表的结构 `shippint_cart`
--

CREATE TABLE IF NOT EXISTS `shippint_cart` (
  `shippint_cart_id` int(11) NOT NULL AUTO_INCREMENT,
  `customer_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `sku_id` int(11) NOT NULL,
  `qty` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`shippint_cart_id`),
  KEY `fk_shippint_cart_customer1_idx` (`customer_id`),
  KEY `fk_shippint_cart_item1_idx` (`item_id`),
  KEY `fk_shippint_cart_sku1_idx` (`sku_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `sku`
--

CREATE TABLE IF NOT EXISTS `sku` (
  `sku_id` int(11) NOT NULL AUTO_INCREMENT,
  `item_id` int(11) NOT NULL,
  `sku` varchar(45) NOT NULL,
  `properties` varchar(255) NOT NULL,
  `propertyNames` varchar(255) NOT NULL,
  `stock_qty` int(11) NOT NULL DEFAULT '0',
  `price` float NOT NULL DEFAULT '0',
  PRIMARY KEY (`sku_id`),
  KEY `sku_item_idx` (`item_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- 转存表中的数据 `sku`
--

INSERT INTO `sku` (`sku_id`, `item_id`, `sku`, `properties`, `propertyNames`, `stock_qty`, `price`) VALUES
(0, 0, '0', '0', '0', 0, 0);

-- --------------------------------------------------------

--
-- 表的结构 `wish`
--

CREATE TABLE IF NOT EXISTS `wish` (
  `wish_id` int(11) NOT NULL AUTO_INCREMENT,
  `customer_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  PRIMARY KEY (`wish_id`),
  KEY `fk_wish_customer1_idx` (`customer_id`),
  KEY `fk_wish_item1_idx` (`item_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- 限制导出的表
--

--
-- 限制表 `address`
--
ALTER TABLE `address`
  ADD CONSTRAINT `fk_address_customer1` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`customer_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- 限制表 `address_area`
--
ALTER TABLE `address_area`
  ADD CONSTRAINT `fk_address_area_address_area1` FOREIGN KEY (`parent_id`) REFERENCES `address_area` (`address_area_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- 限制表 `category`
--
ALTER TABLE `category`
  ADD CONSTRAINT `fk_category_category1` FOREIGN KEY (`parent_id`) REFERENCES `category` (`category_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- 限制表 `customer`
--
ALTER TABLE `customer`
  ADD CONSTRAINT `fk_customer_customer_group1` FOREIGN KEY (`customer_group_id`) REFERENCES `customer_group` (`customer_group_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- 限制表 `item`
--
ALTER TABLE `item`
  ADD CONSTRAINT `item_category` FOREIGN KEY (`category_id`) REFERENCES `category` (`category_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- 限制表 `item_img`
--
ALTER TABLE `item_img`
  ADD CONSTRAINT `item_img_item` FOREIGN KEY (`item_id`) REFERENCES `item` (`item_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- 限制表 `item_prop`
--
ALTER TABLE `item_prop`
  ADD CONSTRAINT `item_prop_category` FOREIGN KEY (`category_id`) REFERENCES `category` (`category_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- 限制表 `item_prop_value`
--
ALTER TABLE `item_prop_value`
  ADD CONSTRAINT `ipv_item` FOREIGN KEY (`item_id`) REFERENCES `item` (`item_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `ipv_item_prop` FOREIGN KEY (`item_prop_id`) REFERENCES `item_prop` (`item_prop_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `ipv_prop_value` FOREIGN KEY (`prop_value_id`) REFERENCES `prop_value` (`prop_value_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- 限制表 `order`
--
ALTER TABLE `order`
  ADD CONSTRAINT `fk_order_customer1` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`customer_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- 限制表 `order_item`
--
ALTER TABLE `order_item`
  ADD CONSTRAINT `order_item_order` FOREIGN KEY (`order_id`) REFERENCES `order` (`order_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `order_item_item` FOREIGN KEY (`item_id`) REFERENCES `item` (`item_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_order_item_sku1` FOREIGN KEY (`sku_id`) REFERENCES `sku` (`sku_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- 限制表 `prop_value`
--
ALTER TABLE `prop_value`
  ADD CONSTRAINT `prop_value_item_prop` FOREIGN KEY (`item_prop_id`) REFERENCES `item_prop` (`item_prop_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- 限制表 `shippint_cart`
--
ALTER TABLE `shippint_cart`
  ADD CONSTRAINT `fk_shippint_cart_customer1` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`customer_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_shippint_cart_item1` FOREIGN KEY (`item_id`) REFERENCES `item` (`item_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_shippint_cart_sku1` FOREIGN KEY (`sku_id`) REFERENCES `sku` (`sku_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- 限制表 `sku`
--
ALTER TABLE `sku`
  ADD CONSTRAINT `sku_item` FOREIGN KEY (`item_id`) REFERENCES `item` (`item_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- 限制表 `wish`
--
ALTER TABLE `wish`
  ADD CONSTRAINT `fk_wish_customer1` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`customer_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_wish_item1` FOREIGN KEY (`item_id`) REFERENCES `item` (`item_id`) ON DELETE CASCADE ON UPDATE CASCADE;
