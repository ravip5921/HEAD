-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Mar 18, 2022 at 06:14 AM
-- Server version: 5.7.36
-- PHP Version: 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `highereducationdb2`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

DROP TABLE IF EXISTS `admin`;
CREATE TABLE IF NOT EXISTS `admin` (
  `username` varchar(30) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `application`
--

DROP TABLE IF EXISTS `application`;
CREATE TABLE IF NOT EXISTS `application` (
  `id` mediumint(9) NOT NULL AUTO_INCREMENT,
  `studentid` mediumint(9) DEFAULT NULL,
  `teacherid` mediumint(9) DEFAULT NULL,
  `recstatus` tinyint(4) DEFAULT NULL,
  `recdate` date DEFAULT NULL,
  `universityid` mediumint(9) DEFAULT NULL,
  `facultyid` mediumint(9) DEFAULT NULL,
  `uniastatus` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `studentid` (`studentid`),
  KEY `teacherid` (`teacherid`),
  KEY `universityid` (`universityid`),
  KEY `facultyid` (`facultyid`),
  KEY `uniastatus` (`uniastatus`),
  KEY `recstatus` (`recstatus`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `country`
--

DROP TABLE IF EXISTS `country`;
CREATE TABLE IF NOT EXISTS `country` (
  `id` mediumint(9) NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

DROP TABLE IF EXISTS `department`;
CREATE TABLE IF NOT EXISTS `department` (
  `id` tinyint(3) UNSIGNED NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `faculty`
--

DROP TABLE IF EXISTS `faculty`;
CREATE TABLE IF NOT EXISTS `faculty` (
  `id` mediumint(9) NOT NULL,
  `name` varchar(70) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `faculty_university`
--

DROP TABLE IF EXISTS `faculty_university`;
CREATE TABLE IF NOT EXISTS `faculty_university` (
  `facultyid` mediumint(9) NOT NULL,
  `universityid` mediumint(9) NOT NULL,
  PRIMARY KEY (`facultyid`,`universityid`),
  KEY `universityid` (`universityid`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Stand-in structure for view `recommendation`
-- (See below for the actual view)
--
DROP VIEW IF EXISTS `recommendation`;
CREATE TABLE IF NOT EXISTS `recommendation` (
`rollno` varchar(15)
,`student_name` varchar(30)
,`teacher_name` varchar(30)
,`recstatus` tinyint(4)
,`uniastatus` tinyint(4)
,`faculty` varchar(70)
,`uniname` varchar(70)
,`country` varchar(50)
);

-- --------------------------------------------------------

--
-- Table structure for table `recommendstatus`
--

DROP TABLE IF EXISTS `recommendstatus`;
CREATE TABLE IF NOT EXISTS `recommendstatus` (
  `id` tinyint(4) NOT NULL,
  `status` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

DROP TABLE IF EXISTS `student`;
CREATE TABLE IF NOT EXISTS `student` (
  `id` mediumint(9) NOT NULL AUTO_INCREMENT,
  `rollno` varchar(15) DEFAULT NULL,
  `name` varchar(30) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `dob` date DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `rollno` (`rollno`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `teacher`
--

DROP TABLE IF EXISTS `teacher`;
CREATE TABLE IF NOT EXISTS `teacher` (
  `id` mediumint(9) NOT NULL AUTO_INCREMENT,
  `name` varchar(30) DEFAULT NULL,
  `departmentid` tinyint(4) DEFAULT NULL,
  `post` tinyint(4) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`,`departmentid`),
  KEY `departmentid` (`departmentid`),
  KEY `post` (`post`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `teacherposts`
--

DROP TABLE IF EXISTS `teacherposts`;
CREATE TABLE IF NOT EXISTS `teacherposts` (
  `id` tinyint(4) NOT NULL,
  `post` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `university`
--

DROP TABLE IF EXISTS `university`;
CREATE TABLE IF NOT EXISTS `university` (
  `id` mediumint(9) NOT NULL,
  `uname` varchar(70) DEFAULT NULL,
  `countryid` mediumint(9) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `countryid` (`countryid`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `universitystatus`
--

DROP TABLE IF EXISTS `universitystatus`;
CREATE TABLE IF NOT EXISTS `universitystatus` (
  `id` tinyint(4) NOT NULL,
  `status` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure for view `recommendation`
--
DROP TABLE IF EXISTS `recommendation`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `recommendation`  AS  (select `student`.`rollno` AS `rollno`,`student`.`name` AS `student_name`,`teacher`.`name` AS `teacher_name`,`application`.`recstatus` AS `recstatus`,`application`.`uniastatus` AS `uniastatus`,`faculty`.`name` AS `faculty`,`university`.`uname` AS `uniname`,`country`.`name` AS `country` from (((((((`application` join `student` on((`application`.`studentid` = `student`.`id`))) join `teacher` on((`application`.`teacherid` = `teacher`.`id`))) join `recommendstatus` on((`recommendstatus`.`id` = `application`.`recstatus`))) join `university` on((`application`.`universityid` = `university`.`id`))) join `faculty` on((`application`.`facultyid` = `faculty`.`id`))) join `universitystatus` on((`application`.`uniastatus` = `universitystatus`.`id`))) join `country` on((`university`.`countryid` = `country`.`id`)))) ;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
