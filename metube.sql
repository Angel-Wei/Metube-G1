-- phpMyAdmin SQL Dump
-- version 3.2.0.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jan 28, 2010 at 11:12 AM
-- Server version: 5.1.36
-- PHP Version: 5.2.9-2

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `metube`
--

-- --------------------------------------------------------

--
-- Table structure for table `account`
--

CREATE TABLE IF NOT EXISTS `account` (
  `username` varchar(50) NOT NULL,
  `password` varchar(128) NOT NULL,
  `email` varchar(60) DEFAULT NULL,
  `sex` varchar(30) NOT NULL,
  PRIMARY KEY (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `account`
--

INSERT INTO `account` (`username`, `password`, `email`, `sex`) VALUES
('metubeg1', '123456', 'anqi@clemson.edu', 'Female');

-- --------------------------------------------------------

--
-- Table structure for table `download`
--

CREATE TABLE IF NOT EXISTS `download` (
  `downloadid` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `mediaid` int(11) NOT NULL,
  `downloadtime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`downloadid`),
  KEY `username` (`username`),
  KEY `mediaid` (`mediaid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `download`
--

INSERT INTO `download` (`downloadid`, `username`, `mediaid`, `downloadtime`) VALUES
(1, 'metube', 5, '2008-09-06 12:48:21'),
(2, 'metube', 4, '2008-09-06 12:49:36'),
(3, 'metube', 4, '2008-09-06 13:18:44');

-- --------------------------------------------------------

--
-- Table structure for table `media`
--

CREATE TABLE IF NOT EXISTS `media` (
  `mediaid` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(64) NOT NULL,
  `filename` varchar(64),
  `title` varchar(64),
  `description` varchar(240),
  `keyword` varchar(64),
  `category` varchar(64),
  `privacy` varchar(64),
  `permission` varchar(64),
  `filepath` varchar(256) NOT NULL,
  `upload_IP` varchar(64),
  `upload_data_time` varchar(64),
  `type` varchar(30) DEFAULT '0',
  `lastaccesstime` varchar(64),
  `viewcount` int(11) DEFAULT '0',
  PRIMARY KEY (`mediaid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1;

--
-- Dumping data for table `media`
--

INSERT INTO `media` (`mediaid`, `username`, `filename`, `filepath`, `type`, `upload_data_time`) VALUES
(NULL, 'metubeg1', 'sample2.wmv', 'uploads/metube/', 'video/x-ms-wmv', '2010-01-28 10:58:45'),
(NULL, 'metubeg1', 'sample3.wmv', 'uploads/metube/', 'video/x-ms-wmv', '2010-01-28 10:58:58'),
(NULL, 'metubeg1', 'sample1.wmv', 'uploads/metube/', 'video/x-ms-wmv', '2010-01-28 10:59:11'),
(NULL, 'metubeg1', 'nintendogs_wallcoo.com_6.jpg', 'uploads/metube/', 'image/jpeg', '2010-01-28 10:59:05');

-- --------------------------------------------------------

--
-- Table structure for table `upload`
--

CREATE TABLE IF NOT EXISTS `upload` (
  `uploadid` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `filename` varchar(64),
  `filepath` varchar(256) NOT NULL,
  `mediaid` int(11) NOT NULL,
  `upload_data_time` varchar(64),
  PRIMARY KEY (`uploadid`),
  KEY `username` (`username`),
  KEY `mediaid` (`mediaid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1;

--
-- Dumping data for table `upload`
--

INSERT INTO `upload` (`uploadid`, `username`, `filename`, `filepath`, `mediaid`, `upload_data_time`) VALUES
(NULL, 'metubeg1', 'sample2.wmv', 'uploads/metube/', 1, '2010-01-28 10:58:45'),
(NULL, 'metubeg1', 'sample3.wmv', 'uploads/metube/', 2, '2010-01-28 10:58:58'),
(NULL, 'metubeg1', 'sample1.wmv', 'uploads/metube/', 3, '2010-01-28 10:59:11'),
(NULL, 'metubeg1', 'nintendogs_wallcoo.com_6.jpg', 'uploads/metube/', 4, '2010-01-28 10:59:05');

-- Table structure for table `media`
--

CREATE TABLE IF NOT EXISTS `contact` (
  `username` varchar(64) NOT NULL,
  `abcd` boolean DEFAULT '0',
  `anqi` boolean DEFAULT '0',
  `clemson` boolean DEFAULT '0',
  `elcos` boolean DEFAULT '0',
  `g2ec` boolean DEFAULT '0',
  `metubeg1` boolean DEFAULT '0',
  `sand` boolean DEFAULT '0',
  `xiaohoz` boolean DEFAULT '0',
  `alice` boolean DEFAULT '0',
  `kiki` boolean DEFAULT '0',
  PRIMARY KEY (`username`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1;

-- Insert row value into column 'username'
insert into contact (username) values ('abcd');
-- Insert new column of user
ALTER TABLE table_name ADD column_name boolean;

-- Table structure for table `comment`
--
CREATE TABLE IF NOT EXISTS `comment` (
  `commentid` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50),
  `mediaid` int(11) NOT NULL,
  `comment` varchar(240),
  `submission_time` varchar(64),
  `score` int(11) NOT NULL,
  PRIMARY KEY (`commentid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1;
