-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- 主机: localhost
-- 生成日期: 2013 年 01 月 16 日 11:19
-- 服务器版本: 5.5.24-log
-- PHP 版本: 5.3.13

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- 数据库: `logistics`
--
CREATE DATABASE `logistics` DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;
USE `logistics`;

-- --------------------------------------------------------

--
-- 表的结构 `good`
--

CREATE TABLE IF NOT EXISTS `good` (
  `id` int(10) unsigned zerofill NOT NULL AUTO_INCREMENT,
  `name` varchar(20) COLLATE utf8_unicode_ci DEFAULT '' COMMENT '货物名称',
  `create` int(10) NOT NULL COMMENT '创建时间',
  `type` int(1) unsigned NOT NULL DEFAULT '0' COMMENT '类型',
  `origin` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '货物产地',
  `prinkle` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '计量单位',
  `buyrate` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '进价',
  `sellrate` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '售价',
  `remark` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '备注',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `staff`
--

CREATE TABLE IF NOT EXISTS `staff` (
  `id` int(10) NOT NULL COMMENT '职员ID',
  `name` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `create` int(10) NOT NULL,
  `email` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `position` varchar(128) COLLATE utf8_unicode_ci NOT NULL COMMENT '职位',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- 表的结构 `trade`
--

CREATE TABLE IF NOT EXISTS `trade` (
  `id` int(11) unsigned zerofill NOT NULL AUTO_INCREMENT,
  `create` int(10) NOT NULL,
  `state` int(1) NOT NULL,
  `good_id` int(10) unsigned DEFAULT NULL COMMENT '托运状态',
  `price` int(6) NOT NULL DEFAULT '0' COMMENT '运价',
  `user_id` int(10) unsigned DEFAULT NULL,
  `send_city` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `send_place` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `send_name` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `send_phone` int(12) NOT NULL,
  `send_zipcode` int(8) DEFAULT '0',
  `receive_city` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `receive_place` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `receive_name` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `receive_phone` int(12) NOT NULL,
  `receive_zipcode` int(8) DEFAULT NULL,
  `remark` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '备注',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(10) unsigned zerofill NOT NULL AUTO_INCREMENT COMMENT '用户ID',
  `name` varchar(32) COLLATE utf8_unicode_ci NOT NULL COMMENT '用户名',
  `password` varchar(128) COLLATE utf8_unicode_ci NOT NULL COMMENT '用户密码',
  `create` int(10) NOT NULL COMMENT '创建时间',
  `email` varchar(128) COLLATE utf8_unicode_ci NOT NULL COMMENT '电子邮箱',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
