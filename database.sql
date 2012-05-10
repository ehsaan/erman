-- phpMyAdmin SQL Dump
-- version 2.11.11.3
-- http://www.phpmyadmin.net
--
-- Host: dslabcomp
-- Generation Time: May 09, 2012 at 11:55 PM
-- Server version: 5.0.77
-- PHP Version: 5.1.6

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `ehsansr`
--

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE IF NOT EXISTS `comments` (
  `personid` tinyint(3) NOT NULL,
  `rideid` int(10) NOT NULL,
  `ctext` text NOT NULL,
  `insert_date` datetime NOT NULL,
  `active` tinyint(1) NOT NULL,
  `commentid` int(10) NOT NULL auto_increment,
  PRIMARY KEY  (`commentid`),
  KEY `rideid` (`rideid`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

-- --------------------------------------------------------

--
-- Table structure for table `persons`
--

CREATE TABLE IF NOT EXISTS `persons` (
  `personid` tinyint(3) NOT NULL auto_increment,
  `name` varchar(150) character set utf8 collate utf8_unicode_ci NOT NULL,
  `email` varchar(100) default NULL,
  `emailCancel` tinyint(1) NOT NULL default '1',
  `emailOffer` tinyint(1) NOT NULL default '1',
  `lastLogin` datetime NOT NULL,
  PRIMARY KEY  (`personid`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=52 ;

-- --------------------------------------------------------

--
-- Table structure for table `riders`
--

CREATE TABLE IF NOT EXISTS `riders` (
  `personid` tinyint(3) NOT NULL,
  `rideid` int(10) NOT NULL,
  `riderid` int(10) NOT NULL auto_increment,
  `active` tinyint(1) NOT NULL default '1',
  `insert_time` datetime NOT NULL,
  PRIMARY KEY  (`riderid`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1587 ;

-- --------------------------------------------------------

--
-- Table structure for table `rides`
--

CREATE TABLE IF NOT EXISTS `rides` (
  `personid` tinyint(3) NOT NULL,
  `seats` tinyint(1) NOT NULL,
  `start_time` datetime NOT NULL,
  `destination` varchar(50) character set utf8 collate utf8_unicode_ci NOT NULL,
  `rideid` int(10) NOT NULL auto_increment,
  `active` tinyint(1) NOT NULL default '1',
  `source` varchar(200) character set utf8 collate utf8_unicode_ci default NULL,
  `insert_time` datetime NOT NULL,
  PRIMARY KEY  (`rideid`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=266 ;

