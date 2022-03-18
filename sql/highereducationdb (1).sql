-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Mar 18, 2022 at 06:13 AM
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
-- Database: `highereducationdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

DROP TABLE IF EXISTS `admin`;
CREATE TABLE IF NOT EXISTS `admin` (
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`username`, `password`) VALUES
('admin', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `department_alias`
--

DROP TABLE IF EXISTS `department_alias`;
CREATE TABLE IF NOT EXISTS `department_alias` (
  `alias` varchar(3) NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`alias`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `department_alias`
--

INSERT INTO `department_alias` (`alias`, `name`) VALUES
('BCT', 'Department of computer Engineering');

-- --------------------------------------------------------

--
-- Table structure for table `recommendation`
--

DROP TABLE IF EXISTS `recommendation`;
CREATE TABLE IF NOT EXISTS `recommendation` (
  `id` mediumint(9) NOT NULL AUTO_INCREMENT,
  `rollno` varchar(15) DEFAULT NULL,
  `teacher` varchar(30) DEFAULT NULL,
  `recstatus` varchar(10) DEFAULT NULL,
  `recdate` date DEFAULT NULL,
  `uname` varchar(50) DEFAULT NULL,
  `country` varchar(50) DEFAULT NULL,
  `faculty` varchar(50) DEFAULT NULL,
  `uniastatus` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `rollno` (`rollno`),
  KEY `teacher` (`teacher`),
  KEY `uniastatus` (`uniastatus`)
) ENGINE=MyISAM AUTO_INCREMENT=22 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `recommendation`
--

INSERT INTO `recommendation` (`id`, `rollno`, `teacher`, `recstatus`, `recdate`, `uname`, `country`, `faculty`, `uniastatus`) VALUES
(1, 'pul075bct065', 'Aman Shakya', 'pending', '2022-03-17', 'M.I.T.', 'U.S.A.', 'M.E.', 2),
(2, 'pul075bct052', 'Aman Shakya', 'pending', '2022-03-17', 'M.I.T.', 'U.S.A.', 'M.E.', 5),
(3, 'pul075bct066', 'Aman Shakya', 'pending', '2022-03-17', 'Osaka University', 'Japan', 'M. Tech', 3),
(4, 'pul075bct068', 'Aman Shakya', 'pending', '2022-02-17', 'Lovely Professional University', 'India', 'Satellite Communicstion ', 2),
(5, 'pul075bct063', 'Aman Shakya', 'pending', '2022-02-17', 'Amity University', 'India', 'Network Communication ', 1),
(6, 'pul075bct065', 'Aman Shakya', 'pending', '2022-02-17', 'Stanford University', 'U.S.A.', 'Embedded System ', 2),
(7, 'pul075bct096', 'Aman Shakya', 'pending', '2022-03-16', 'Osaka University', 'Japan', 'Neural Network', 2),
(8, 'pul075bct096', 'Aman Shakya', 'pending', '2022-03-16', 'Delhi University', 'India', 'Communication Systems', 2),
(9, 'pul075bct066', 'Aman Shakya', 'pending', '2022-03-16', 'Delhi University', 'India', 'Communication Systems', 2),
(10, 'pul075bct066', 'Aman Shakya', 'pending', '2022-03-16', 'Delhi University', 'India', 'Master\'s in Mining Engineering', 2),
(11, 'pul075bct052', 'Aman Shakya', 'pending', '2022-03-16', 'Delhi University', 'India', 'Master\'s in Mining Engineering', 2),
(12, 'pul075bct052', 'Aman Shakya', 'pending', '2022-03-16', 'Campus de Paris', 'France', 'Master\'s in Transportation Engineering', 2),
(13, 'pul075bct052', 'Aman Shakya', 'pending', '2022-03-16', 'Oxford University', 'England', 'Master\'s in Computer Engineering', 2),
(14, 'pul075bct065', 'Aman Shakya', 'pending', '2022-03-16', 'Oxford University', 'England', 'Master\'s in Computer Engineering', 2),
(15, 'pul075bct066', 'Aman Shakya', 'pending', '2022-03-16', 'Oxford University', 'England', 'Master\'s in Computer Engineering', 2),
(16, 'pul075bct52', 'Aman Shakya', 'pending', '2022-03-16', 'Cambridge University', 'England', 'Master\'s in Environmental Engineering', 1),
(17, 'pul075bct66', 'Aman Shakya', 'pending', '2022-03-16', 'Cambridge University', 'England', 'Master\'s in Environmental Engineering', 1),
(18, 'pul075bct65', 'Aman Shakya', 'pending', '2022-03-16', 'Cambridge University', 'England', 'Master\'s in Aeronautical Engineering', 1),
(19, 'pul075bct66', 'Aman Shakya', 'pending', '2022-03-16', 'Cambridge University', 'England', 'Master\'s in Aeronautical Engineering', 1),
(20, 'pul075bct065', 'Aman Shakya', 'pending', '2022-03-17', 'Osaka University', 'Japan', 'Microprocessor Design', 2),
(21, 'PUL075BCT065', 'Aman Shakya', 'pending', '2022-03-18', 'Harvard University', 'U.S.A.', 'Aeronautical Engineering', 1);

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

DROP TABLE IF EXISTS `student`;
CREATE TABLE IF NOT EXISTS `student` (
  `rollno` varchar(15) NOT NULL,
  `name` varchar(30) DEFAULT NULL,
  `password` varchar(20) DEFAULT NULL,
  `dob` date DEFAULT NULL,
  PRIMARY KEY (`rollno`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`rollno`, `name`, `password`, `dob`) VALUES
('pul075bct001', 'aaditya mani subedi', 'emqgRGLb', '2056-12-23'),
('pul075bct002', 'aagat pokhrel', 'NbG5E1KU', '2056-12-24'),
('pul075bct003', 'aarchan basnet', 'QTzXfkjd', '2056-12-25'),
('pul075bct004', 'aayush lamichhane', '35vhrojF', '2056-12-26'),
('pul075bct005', 'aayush lamichhane', 'z6lU0JWM', '2056-12-27'),
('pul075bct006', 'aayush neupane', 'Pc6DUJyt', '2056-12-28'),
('pul075bct007', 'aayush shah  kanu', 'ASbCwRQT', '2056-12-29'),
('pul075bct008', 'abish bhusal', 'YQOLNsfE', '2056-12-30'),
('pul075bct009', 'adithya pokharel', 'bujTRdrW', '2056-12-31'),
('pul075bct010', 'akash panthi', 'r1Oze3oh', '2057-01-01'),
('pul075bct011', 'amrit aryal', 'Pazv0Mkj', '2057-01-02'),
('pul075bct012', 'anish agarwal', 'Ytk8J0OD', '2057-01-03'),
('pul075bct013', 'ankit paudel', 'raJyZL2D', '2057-01-04'),
('pul075bct014', 'arpan gyawali', 't9nB18z4', '2057-01-05'),
('pul075bct015', 'arpan pokharel', 'vXmFnJpu', '2057-01-06'),
('pul075bct016', 'ashish lamsal', 'faxSKvXI', '2057-01-07'),
('pul075bct018', 'bidhan khatiwada', '0FKHjBrV', '2057-01-08'),
('pul075bct019', 'bigyan koirala', 'DGOil7uy', '2057-01-09'),
('pul075bct020', 'bijaya shrestha', 'oy19SwH2', '2057-01-10'),
('pul075bct021', 'binay basnet', 'jQKhA9Yt', '2057-01-11'),
('pul075bct022', 'bipin khanal', '7fX41kcR', '2057-01-12'),
('pul075bct023', 'bipin puri', 'vj2Y06Lf', '2057-01-13'),
('pul075bct024', 'biraj bikram pathak', 'ytm7OhgS', '2057-01-14'),
('pul075bct025', 'bishad koju', 'fKSwonx7', '2057-01-15'),
('pul075bct026', 'bishal bashyal', 'BrXabPEY', '2057-01-16'),
('pul075bct027', 'bishal chaudhary', 'yenXm7K4', '2057-01-17'),
('pul075bct028', 'bishal katuwal', 'pSuIQVf0', '2057-01-18'),
('pul075bct029', 'bishal lamichhane', 'HfXqcRZA', '2057-01-19'),
('pul075bct030', 'bishant baniya', '8L6uJZcs', '2057-01-20'),
('pul075bct031', 'bishwash gurung', 'HFoISJNT', '2057-01-21'),
('pul075bct032', 'chirag lamsal', 'hN59vm1g', '2057-01-22'),
('pul075bct033', 'dilip kumar jayswal', 'CBhuo6SY', '2057-01-23'),
('pul075bct034', 'dimple saraogi', 'aE8y4H3B', '2057-01-24'),
('pul075bct035', 'erosha paudel', 'lYrzvHBh', '2057-01-25'),
('pul075bct037', 'gaurav jyakhwa', 'B4f7TiEc', '2057-01-26'),
('pul075bct038', 'gobind prasad sah', 'BT4E3mFU', '2057-01-27'),
('pul075bct039', 'gopal baidawar chhetri', 'hYPyuQx9', '2057-01-28'),
('pul075bct040', 'janak sharma', 'cYl15azy', '2057-01-29'),
('pul075bct041', 'jiwan prasad guragain', 'X93BtLZ5', '2057-01-30'),
('pul075bct042', 'kiran bhattarai', 'lotPRQHr', '2057-01-31'),
('pul075bct043', 'kriti nyoupane', 'qrkwBi6t', '2057-02-01'),
('pul075bct044', 'yaman subedi', 'ViZRnHcS', '2057-02-02'),
('pul075bct045', 'kushal shrestha', 'UH9gnRXE', '2057-02-03'),
('pul075bct046', 'laxman kunwar', 'axRLJwcO', '2057-02-04'),
('pul075bct047', 'luna manandhar', 'pvhtnQGj', '2057-02-05'),
('pul075bct048', 'manjeet pandey', '1oHXVtdk', '2057-02-06'),
('pul075bct049', 'mausam basnet', 'DKXqV1HF', '2057-02-07'),
('pul075bct050', 'milan shrestha', '2VotTlEZ', '2057-02-08'),
('pul075bct051', 'mukul atreya', 'nobpGlKu', '2057-02-09'),
('pul075bct052', 'nikesh d.c.', 'we39kIYf', '2057-02-10'),
('pul075bct053', 'nikhil aryal', 'YnIkR1N0', '2057-02-11'),
('pul075bct054', 'niraj shrestha', 'wcMFR3Bp', '2057-02-12'),
('pul075bct055', 'nischal shakya', 'yAnbslLH', '2057-02-13'),
('pul075bct056', 'nisha sharma', '1bszQ7Sp', '2057-02-14'),
('pul075bct057', 'nishan poudel', 'hQrMnZ61', '2057-02-15'),
('pul075bct058', 'nitesh swarnakar', '9d3m6QT4', '2057-02-16'),
('pul075bct059', 'prabhat kiran kabdar', 'KeLR3PUo', '2057-02-17'),
('pul075bct060', 'prabin paudel', 'YnBR0HcD', '2057-02-18'),
('pul075bct061', 'pranjal pokharel', '7MOJIn59', '2057-02-19'),
('pul075bct062', 'priya thakur', 'EFpYXQgI', '2057-02-20'),
('pul075bct063', 'rahul shah', 'HRcsjiwP', '2057-02-21'),
('pul075bct064', 'ranju g.c.', '8u6zwNVK', '2057-02-22'),
('pul075bct065', 'ravi pandey', 'headpass', '2057-02-23'),
('pul075bct066', 'rohan chhetry', 'aAGUCm73', '2057-02-24'),
('pul075bct067', 'rohan karki', 'JaESDt4i', '2057-02-25'),
('pul075bct068', 'roshan subedi', 'pLek6DYA', '2057-02-26'),
('pul075bct069', 'ruja awal', 'jNantmQ5', '2057-02-27'),
('pul075bct070', 'rupak raj pantha', 'TiBlPymI', '2057-02-28'),
('pul075bct071', 'sagar timalsina', '95AkSI7y', '2057-03-01'),
('pul075bct072', 'sampanna dahal', 'CRsDVdek', '2057-03-02'),
('pul075bct074', 'sandeep acharya', '1mKNIyoB', '2057-03-03'),
('pul075bct075', 'sandesh ghimire', 'VHGWKNzL', '2057-03-04'),
('pul075bct076', 'sandesh pokhrel', 'z4oa8OdD', '2057-03-05'),
('pul075bct077', 'sandip puri', 'ehfPzrvw', '2057-03-06'),
('pul075bct078', 'sangam chaulagain', 'GBdX21tz', '2057-03-07'),
('pul075bct079', 'sanjay bhandari', 'SMhD75Pg', '2057-03-08'),
('pul075bct080', 'sanskar amgain', 'Fl8ft1me', '2057-03-09'),
('pul075bct081', 'santosh maka', 'iDJBKfez', '2057-03-10'),
('pul075bct082', 'santosh pangeni', 'PY0xrlO7', '2057-03-11'),
('pul075bct083', 'saujan tiwari', 'TxJCzWe1', '2057-03-12'),
('pul075bct084', 'shreem arjyal', 'Mj5qLDkx', '2057-03-13'),
('pul075bct085', 'sital nagarkoti', 'uodKbnCt', '2057-03-14'),
('pul075bct086', 'smaran dhungana', 'trOUkGp3', '2057-03-15'),
('pul075bct088', 'subodh baral', 'IxSuoFU9', '2057-03-16'),
('pul075bct089', 'sukriti subedi', 'cWTMQ3C9', '2057-03-17'),
('pul075bct090', 'supriya khadka', 'anb1Uu82', '2057-03-18'),
('pul075bct091', 'suraj pokhrel', 'hMw0ypdl', '2057-03-19'),
('pul075bct092', 'suyog dhakal', 'gZmFOUNM', '2057-03-20'),
('pul075bct093', 'tapendra pandey', 'Yx01vPwu', '2057-03-21'),
('pul075bct094', 'tilak chad', 'Q1DBdFJc', '2057-03-22'),
('pul075bct095', 'udeshya dhungana', '4Ew8gOZD', '2057-03-23'),
('pul075bct096', 'yukta bansal', '3b28Iqls', '2057-03-24'),
('pul075bct097', 'bibek bashyal', 'HBkwXRbq', '2057-03-25'),
('pul075bct098', 'achyut burlakoti', 'rwjMKJW2', '2057-03-26'),
('pul075bct099', 'saugat kafle', 'Haiz9X7I', '2057-03-27'),
('pul075bct100', 'sijal baral', 'ST0jXQoP', '2057-03-28');

-- --------------------------------------------------------

--
-- Table structure for table `teacher`
--

DROP TABLE IF EXISTS `teacher`;
CREATE TABLE IF NOT EXISTS `teacher` (
  `uname` varchar(30) NOT NULL,
  `department_alias` varchar(3) DEFAULT NULL,
  `post` tinyint(4) DEFAULT NULL,
  `password` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`uname`),
  KEY `department_alias` (`department_alias`),
  KEY `post` (`post`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `teacher`
--

INSERT INTO `teacher` (`uname`, `department_alias`, `post`, `password`) VALUES
('Aman Shakya', 'BCT', 2, 'pass');

-- --------------------------------------------------------

--
-- Table structure for table `teacherposts`
--

DROP TABLE IF EXISTS `teacherposts`;
CREATE TABLE IF NOT EXISTS `teacherposts` (
  `id` tinyint(4) NOT NULL,
  `status` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `teacherposts`
--

INSERT INTO `teacherposts` (`id`, `status`) VALUES
(1, 'Professor'),
(2, 'Assistant Professor');

-- --------------------------------------------------------

--
-- Table structure for table `universitystatus`
--

DROP TABLE IF EXISTS `universitystatus`;
CREATE TABLE IF NOT EXISTS `universitystatus` (
  `id` tinyint(4) NOT NULL,
  `status` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `universitystatus`
--

INSERT INTO `universitystatus` (`id`, `status`) VALUES
(1, 'Not Applied'),
(2, 'Applied (Pending)'),
(3, 'Approved (No Scholarship)'),
(4, 'Approved (Partial Scholarship)'),
(5, 'Approved (Full Scholarship)'),
(6, 'Enrolled');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
