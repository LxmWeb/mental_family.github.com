-- phpMyAdmin SQL Dump
-- version 3.2.0.1
-- http://www.phpmyadmin.net
--
-- 主机: localhost
-- 生成日期: 2017 年 02 月 27 日 11:56
-- 服务器版本: 5.1.36
-- PHP 版本: 5.3.0

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

--
-- 数据库: `doctor`
--

-- --------------------------------------------------------

--
-- 表的结构 `doctorlist`
--

CREATE TABLE IF NOT EXISTS `doctorlist` (
  `doctorId` int(11) NOT NULL,
  `doctorName` varchar(20) NOT NULL,
  `doctorIntro` varchar(200) NOT NULL,
  PRIMARY KEY (`doctorId`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `doctorlist`
--

INSERT INTO `doctorlist` (`doctorId`, `doctorName`, `doctorIntro`) VALUES
(1, 'name1', '我是1号医生。'),
(2, 'name2', '我是2号医生。'),
(3, 'name3', '我是3号医生。');
