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
  `accountid` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` varchar(128) NOT NULL,
  `email` varchar(60) DEFAULT NULL,
  `sex` varchar(30) NOT NULL,
  PRIMARY KEY (`accountid`),
  KEY `username` (`username`)
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


--
-- Contact: relationship among accounts, many to many. type {1:family;2:friend;0:not contact (default)}
-- block {0:no block (default); 1: block}
--
CREATE TABLE IF NOT EXISTS `contact` (
  `contactid` int(11) NOT NULL AUTO_INCREMENT,
  `accountid1` int(11) NOT NULL,
  `accountid2` int(11) NOT NULL,
  `type` int(2) NOT NULL DEFAULT 0,
  `block` int(2) NOT NULL DEFAULT 0,
  PRIMARY KEY (`contactid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



CREATE TABLE IF NOT EXISTS `message` (
  `messageid` int(11) NOT NULL AUTO_INCREMENT,
  `from_id` int(11) NOT NULL,
  `to_id` int(11) NOT NULL,
  `subject` varchar(64),
  `content` varchar(240),
  `message_time` varchar(64),
  PRIMARY KEY (`messageid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Table structure for table `playlist`
--

CREATE TABLE IF NOT EXISTS `playlist` (
  `playlistid` int(11) NOT NULL AUTO_INCREMENT,
  `accountid` int(11) NOT NULL,
  `listname` varchar(64) NOT NULL,
  `listdescription` varchar(240),
  PRIMARY KEY (`playlistid`),
  FOREIGN KEY (accountid) REFERENCES account(accountid)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1;

-- Table structure for table `playlistmedia` (child table of playlist)
--

CREATE TABLE IF NOT EXISTS `playlistmedia` (
  `playmediaid` int(11) NOT NULL AUTO_INCREMENT,
  `playlistid` int(11) NOT NULL,
  `mediaid` int(11) NOT NULL,
  PRIMARY KEY (`playmediaid`),
  FOREIGN KEY (playlistid) REFERENCES playlist(playlistid),
  FOREIGN KEY (mediaid) REFERENCES media(mediaid)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1;

--
-- Table structure for table `favoritelist`
--

CREATE TABLE IF NOT EXISTS `favoritelist` (
  `favoritelistid` int(11) NOT NULL AUTO_INCREMENT,
  `accountid` int(11) NOT NULL,
  `listname` varchar(64) NOT NULL,
  `listdescription` varchar(240),
  PRIMARY KEY (`favoritelistid`),
  FOREIGN KEY (accountid) REFERENCES account(accountid)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1;

-- Table structure for table `playlistmedia` (child table of favoritelist)
--

CREATE TABLE IF NOT EXISTS `favoritelistmedia` (
  `favoritemediaid` int(11) NOT NULL AUTO_INCREMENT,
  `favoritelistid` int(11) NOT NULL,
  `mediaid` int(11) NOT NULL,
  PRIMARY KEY (`favoritemediaid`),
  FOREIGN KEY (favoritelistid) REFERENCES favoritelist(favoritelistid),
  FOREIGN KEY (mediaid) REFERENCES media(mediaid)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1;
