-- phpMyAdmin SQL Dump
-- version 3.2.0.1
-- http://www.phpmyadmin.net
--
-- 主机: localhost
-- 生成日期: 2017 年 02 月 22 日 11:45
-- 服务器版本: 5.1.36
-- PHP 版本: 5.3.0

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

--
-- 数据库: `doctor`
--

-- --------------------------------------------------------

--
-- 表的结构 `disease`
--

CREATE TABLE IF NOT EXISTS `disease` (
  `diseaseName` varchar(20) NOT NULL,
  `diseaseIntro` varchar(200) NOT NULL,
  `diseaseSym` varchar(100) NOT NULL,
  PRIMARY KEY (`diseaseName`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `disease`
--

INSERT INTO `disease` (`diseaseName`, `diseaseIntro`, `diseaseSym`) VALUES
('抑郁症', '抑郁症又称抑郁障碍，以显著而持久的心境低落为主要临床特征，是心境障碍的主要类型。临床可见心境低落与其处境不相称，情绪的消沉可以从闷闷不乐到悲痛欲绝，自卑抑郁，甚至悲观厌世，可有自杀企图或行为；甚至发生木僵；部分病例有明显的焦虑和运动性激越；严重者可出现幻觉、妄想等精神病性症状。', ''),
('强迫症', '属于焦虑障碍的一种类型，是一组以强迫思维和强迫行为为主要临床表现的神经精神疾病，其特点为有意识的强迫和反强迫并存，一些毫无意义、甚至违背自己意愿的想法或冲动反反复复侵入患者的日常生活。', '强迫思维和强迫行为'),
('焦虑症', '又称为焦虑性神经症，是神经症这一大类疾病中最常见的一种，以焦虑情绪体验为主要特征。可分为慢性焦虑（广泛性焦虑）和急性焦虑发作（惊恐障碍）两种形式。主要表现为：无明确客观对象的紧张担心，坐立不安，还有植物神经症状（心悸、手抖、出汗、尿频等）。', '');
