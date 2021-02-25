-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 25, 2021 at 12:30 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.2.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mydb`
--

-- --------------------------------------------------------

--
-- Table structure for table `contactus`
--

CREATE TABLE `contactus` (
  `Id` int(11) NOT NULL,
  `FirstName` varchar(512) NOT NULL,
  `LastName` varchar(512) NOT NULL,
  `Email` varchar(512) NOT NULL,
  `Phone` int(11) NOT NULL,
  `ImageUrl` varchar(512) NOT NULL,
  `message` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `contactus`
--

INSERT INTO `contactus` (`Id`, `FirstName`, `LastName`, `Email`, `Phone`, `ImageUrl`, `message`) VALUES
(21, 'ahmed', 'adel', 'ahmedserag2000@gmail.com', 1019245307, 'Uploads/detectingChurn.png', 'asd'),
(22, 'ahmed', 'adel', 'ahmedserag2000@hotmail.com', 1019245307, 'Uploads/1.jpeg', 'asdjasndkansdjkn');

-- --------------------------------------------------------

--
-- Table structure for table `invoice`
--

CREATE TABLE `invoice` (
  `Id` int(10) UNSIGNED NOT NULL,
  `productIds` varchar(100) DEFAULT NULL,
  `customerId` int(30) UNSIGNED NOT NULL,
  `reg_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `ProductQuantities` varchar(100) DEFAULT NULL,
  `TotalPrice` double DEFAULT NULL,
  `Address` varchar(400) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `invoice`
--

INSERT INTO `invoice` (`Id`, `productIds`, `customerId`, `reg_date`, `ProductQuantities`, `TotalPrice`, `Address`) VALUES
(1, '2,1,3', 26, '2021-02-20 07:56:49', '', 0, 'lorum ippsum'),
(2, '2,1,3', 26, '2021-02-20 07:56:49', '1,1,3', 0, 'lorum ippsum'),
(3, '2,1,3', 26, '2021-02-20 07:56:49', '1,1,3', 0, 'lorum ippsum'),
(4, '2,2,2', 26, '2021-02-20 07:56:49', '1,1,3', 0, 'lorum ippsum'),
(5, '1', 26, '2021-02-20 07:56:49', '1', 0, 'lorum ippsum'),
(6, '1', 26, '2021-02-20 07:56:49', '1', 0, 'lorum ippsum'),
(21, '24,1,2', 26, '2021-02-20 07:56:49', '1,1,4', 0, 'lorum ippsum'),
(29, '1', 26, '2021-02-20 07:56:49', '1', 0, 'lorum ippsum'),
(46, '4', 26, '2021-02-20 07:56:49', '1', 0, 'lorum ippsum'),
(47, '4', 26, '2021-02-20 07:56:49', '1', 0, 'lorum ippsum'),
(48, '4', 26, '2021-02-20 07:56:49', '1', 0, 'lorum ippsum'),
(90, '1', 26, '2021-02-20 08:37:30', '1', 33.03, '19 mostafa el nahas street'),
(92, '0', 26, '2021-02-20 11:31:15', '1', 0, 'ss'),
(93, '1,2,4,6', 26, '2021-02-20 11:36:42', '1,1,1,2', 165.15, 'el banafseg 7'),
(94, '1,2,4', 26, '2021-02-20 11:42:00', '1,1,1', 99.09, 'all done'),
(95, '1', 44, '2021-02-25 08:15:27', '4', 132.12, 'el banafseg'),
(96, '2,4', 44, '2021-02-25 08:17:16', '1,1', 66.06, 'el banafseg'),
(97, '2,4,6', 27, '2021-02-25 10:56:01', '1,3,3', 231.21, 'address'),
(98, '4', 27, '2021-02-25 10:57:54', '1', 33.03, 'ss'),
(99, '1,4,6', 27, '2021-02-25 10:59:44', '1,1,1', 99.09, 'aa'),
(100, '4', 27, '2021-02-25 11:03:10', '7', 231.21, 'asd');

-- --------------------------------------------------------

--
-- Table structure for table `logs`
--

CREATE TABLE `logs` (
  `Id` int(10) UNSIGNED NOT NULL,
  `content` varchar(200) NOT NULL,
  `receiverId` int(11) UNSIGNED NOT NULL,
  `senderId` int(11) UNSIGNED NOT NULL,
  `reg_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `seen` tinyint(1) NOT NULL,
  `report` tinyint(1) NOT NULL,
  `comment` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `logs`
--

INSERT INTO `logs` (`Id`, `content`, `receiverId`, `senderId`, `reg_date`, `seen`, `report`, `comment`) VALUES
(1, 'i need some sort of product\r\n', 28, 26, '2021-02-23 18:03:19', 0, 1, 0),
(2, 'helooo', 26, 28, '2021-02-23 18:03:19', 0, 1, 0),
(3, 'helooo', 26, 28, '2021-02-23 18:03:19', 0, 1, 0),
(4, 'helooo', 26, 28, '2021-02-23 18:03:19', 0, 1, 0),
(5, 'test', 26, 28, '2021-02-23 18:03:19', 0, 1, 0),
(6, 'ahmed', 26, 28, '2021-02-23 18:03:19', 0, 1, 0),
(7, 'test', 26, 28, '2021-02-23 18:03:19', 0, 1, 0),
(8, 'insert', 28, 26, '2021-02-23 18:03:19', 0, 1, 0),
(10, 'testing ', 28, 26, '2021-02-23 18:03:19', 0, 1, 0),
(11, 'teamm', 28, 26, '2021-02-23 18:03:19', 0, 1, 0),
(12, 'test', 28, 26, '2021-02-23 18:03:19', 0, 1, 0),
(13, 'ss', 28, 26, '2021-02-23 18:03:19', 0, 1, 0),
(14, 'sss', 28, 26, '2021-02-23 18:03:19', 0, 1, 0),
(15, 's', 28, 26, '2021-02-23 18:03:19', 0, 1, 0),
(16, 'more ', 28, 26, '2021-02-23 18:03:19', 0, 1, 0),
(17, '2deeeni kaman', 28, 26, '2021-02-23 18:03:19', 0, 1, 0),
(18, 'kayefni ya 7abeeebee ', 28, 26, '2021-02-23 18:03:19', 0, 1, 0),
(21, 'a5med', 26, 28, '2021-02-23 18:03:19', 0, 1, 0),
(22, 'a7med', 26, 28, '2021-02-23 18:03:19', 0, 1, 0),
(28, 'test', 26, 28, '2021-02-23 18:03:19', 0, 1, 0),
(29, 'finalee', 26, 28, '2021-02-23 18:03:19', 0, 1, 0),
(30, 'sending again', 26, 28, '2021-02-23 18:03:19', 1, 1, 0),
(31, 'sent from user', 28, 26, '2021-02-23 18:03:19', 0, 1, 0),
(32, 'this is a message', 28, 27, '2021-02-23 12:30:08', 0, 0, 0),
(33, 'this admin just replied', 27, 28, '2021-02-23 09:51:01', 0, 0, 0),
(35, 'first message sent ', 28, 29, '2021-02-24 06:43:36', 0, 1, 0),
(36, 'dont worry sir we are on it ', 29, 28, '2021-02-24 06:43:36', 1, 1, 0),
(37, 'noted :)', 28, 29, '2021-02-24 06:43:36', 1, 1, 0),
(38, 'i would like to ask about something', 28, 26, '2021-02-23 18:03:19', 1, 1, 0),
(39, 'check this out', 28, 27, '2021-02-23 12:29:42', 1, 0, 0),
(40, 'what is it sir ?', 26, 28, '2021-02-23 18:03:19', 0, 1, 0),
(41, 'do you guys have this https://www.youtube.com/watch?v=u3F2XRP1UIE', 28, 26, '2021-02-23 18:03:19', 1, 1, 0),
(42, 'yes sir its a song', 26, 28, '2021-02-23 18:03:19', 1, 1, 0),
(43, 'whats its name', 28, 26, '2021-02-23 18:03:19', 1, 1, 0),
(44, 'your the one that sent it !!!', 26, 28, '2021-02-23 18:03:19', 1, 1, 0),
(45, 'so that broke :(', 28, 26, '2021-02-23 18:07:53', 0, 0, 0),
(46, 'nvm it got fixed fuck u', 28, 26, '2021-02-23 18:27:50', 1, 0, 0),
(47, '2nta msh sha5seya mo7tarama', 26, 28, '2021-02-23 18:28:12', 1, 0, 0),
(48, 'hey its me', 29, 31, '2021-02-24 06:43:36', 0, 1, 1),
(49, 'tset', 26, 28, '2021-02-24 06:58:35', 0, 0, 0),
(50, 'ss', 26, 28, '2021-02-24 06:59:04', 0, 0, 0),
(51, 'test', 26, 28, '2021-02-24 07:15:45', 1, 0, 0),
(52, 'test  back', 28, 26, '2021-02-24 07:21:23', 1, 0, 0),
(53, 'test auditor', 26, 31, '2021-02-24 07:21:58', 1, 0, 1),
(55, 'test again', 26, 28, '2021-02-24 07:20:49', 0, 0, 1),
(56, 'bacck again', 26, 28, '2021-02-24 07:21:42', 0, 0, 0),
(57, 'i am confused', 31, 26, '2021-02-24 07:22:12', 0, 0, 0),
(58, 'dont be its cs', 26, 28, '2021-02-25 11:27:47', 1, 0, 0),
(59, '3amleen 2eh ', 27, 31, '2021-02-24 14:47:04', 0, 0, 1),
(60, 'well i know u guys count from 0 ', 28, 26, '2021-02-25 11:28:45', 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `Id` int(10) UNSIGNED NOT NULL,
  `Name` varchar(30) NOT NULL,
  `Details` varchar(30) NOT NULL,
  `rating` float DEFAULT NULL,
  `Price` int(50) DEFAULT NULL,
  `reg_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`Id`, `Name`, `Details`, `rating`, `Price`, `reg_date`) VALUES
(1, 'iphonenotde7k', 'iphone silver smth smth etcc', 3.8125, 30, '2021-02-25 09:45:34'),
(2, 'IPhone 5', 'details of all details', 4.5, 30, '2021-02-19 18:39:14'),
(3, 'apple phone 7', 'details of all details', 0, 30, '2021-02-07 18:33:08'),
(4, 'samsung galaxy phone', 'details of all details', 4, 30, '2021-02-20 10:57:53'),
(5, 'motorola phone', 'details of all details', 3.33333, 30, '2021-02-20 11:24:57'),
(6, 'pixle phone', 'details of all details', 0, 30, '2021-02-07 18:33:08'),
(7, 'wha', '', 3, 20, '2021-02-20 12:00:04'),
(8, 'phone2lphone', 'smth', 0, 23, '2021-02-07 18:33:08'),
(9, 'somephone man', 'smth', 0, 23, '2021-02-07 18:33:08'),
(10, 'phonehehe', 'smth', 0, 23, '2021-02-07 18:33:08'),
(11, 'anotherphone!', 'smth', 0, 23, '2021-02-07 18:33:08'),
(12, 'anotherphone!', 'smth', 0, 23, '2021-02-07 18:33:08'),
(13, 'anotherphone!', 'smth', 0, 23, '2021-02-07 18:33:08'),
(14, 'anotherphone!', 'smth', 0, 23, '2021-02-07 18:33:08'),
(15, 'anotherphone!', 'smth', 0, 23, '2021-02-07 18:33:08'),
(16, 'anotherphone!', 'smth', 0, 23, '2021-02-07 18:33:08'),
(17, 'anotherphone!', 'smth', 0, 23, '2021-02-07 18:33:08'),
(18, 'anotherphone!', 'smth', 0, 23, '2021-02-07 18:33:08'),
(19, 'anotherphone!', 'smth', 0, 23, '2021-02-07 18:33:08'),
(20, 'anotherphone!', 'smth', 0, 23, '2021-02-07 18:33:08'),
(21, 'anotherphone!', 'smth', 0, 23, '2021-02-07 18:33:08'),
(22, 'anotherphone!', 'smth', 0, 23, '2021-02-07 18:33:08'),
(24, 'someproduct', 'best prodcutever', 3, 20, '2021-02-15 22:23:47');

-- --------------------------------------------------------

--
-- Table structure for table `question`
--

CREATE TABLE `question` (
  `question_id` int(11) NOT NULL,
  `survey_id` int(11) NOT NULL,
  `question_text` text DEFAULT NULL,
  `is_required` int(11) DEFAULT NULL,
  `question_order` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `question`
--

INSERT INTO `question` (`question_id`, `survey_id`, `question_text`, `is_required`, `question_order`) VALUES
(5, 22, 'q1', 1, 0),
(6, 22, 'q2', 1, 1),
(7, 22, 'q3', 1, 2),
(8, 22, 'q4', 1, 3),
(9, 23, '3amle 2eh', 1, 0),
(10, 23, '2zayae', 1, 1),
(11, 23, 'w 2eh kaman ', 1, 2),
(12, 23, 'de7k de7k', 1, 3),
(13, 24, '3amel 2eh', 1, 0),
(14, 24, '2tnen yal 7asan yal 7oseen ', 1, 1),
(15, 24, 'talata 2na msh fahem 7aga', 1, 2),
(16, 24, '4 smth whatebes', 1, 3),
(17, 25, 'q1', 1, 0),
(18, 25, 'q2', 1, 1),
(19, 25, 'q3', 1, 2),
(20, 25, 'q4', 1, 3),
(21, 25, 'q5', 1, 4),
(22, 26, '3amel 2eh', 1, 0),
(23, 26, '2zayak', 1, 1),
(24, 26, 'q3', 1, 2),
(25, 26, 'q4', 1, 3),
(26, 26, 'q5', 1, 4);

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `Id` int(10) UNSIGNED NOT NULL,
  `productId` int(10) UNSIGNED DEFAULT NULL,
  `customerId` int(11) UNSIGNED NOT NULL,
  `Rating` float DEFAULT NULL,
  `Details` varchar(200) NOT NULL,
  `reg_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`Id`, `productId`, `customerId`, `Rating`, `Details`, `reg_date`) VALUES
(62, 2, 26, 5, 'test', '2021-02-20 04:51:27'),
(63, 2, 26, 5, '', '2021-02-20 04:51:47'),
(68, 1, 26, 5, '', '2021-02-20 04:51:47'),
(69, 1, 26, 5, '', '2021-02-20 04:51:47'),
(70, 1, 26, 1, '', '2021-02-20 04:51:47'),
(80, 1, 26, 4, 'working', '2021-02-20 05:26:24'),
(81, 1, 26, 4, 'working', '2021-02-20 05:27:44'),
(82, 1, 26, 3, 'this is a reviewww', '2021-02-20 05:46:30'),
(92, 4, 26, 4, '', '2021-02-20 10:57:53'),
(93, 4, 26, 4, '', '2021-02-20 11:00:41'),
(94, 5, 26, 5, '', '2021-02-20 11:10:53'),
(95, 5, 26, 4, 'pretty good product honsetly', '2021-02-20 11:11:13'),
(96, 5, 26, 4, 'pretty good thank u', '2021-02-20 11:11:26'),
(97, 5, 26, 1, 'worst product ever didnt like ', '2021-02-20 11:11:57'),
(98, 5, 26, 5, 'after the update it went rathe', '2021-02-20 11:15:19'),
(99, 5, 26, 3, 'after the update it went well ', '2021-02-20 11:15:38'),
(100, 5, 26, 3, 'brrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrr', '2021-02-20 11:16:24'),
(101, 5, 26, 4, 'letsletsletsletsletsletsletsletsletsletsletsletsletsletsletsletsletsletsletsletsletsletsletsletsletsletsletsletsletsletsletsletsletsletsletsletsletsletsletsletsletsletsletsletsletsletsletsletsletslets', '2021-02-20 11:16:42'),
(102, 5, 26, 3, 'tstss \nid like to ', '2021-02-20 11:18:26'),
(103, 5, 26, 3, 'asdsad a\nasdas', '2021-02-20 11:23:41'),
(104, 5, 26, 2, 'asdsad\nasdasd', '2021-02-20 11:24:27'),
(105, 5, 26, 3, 'asdasd\nasd', '2021-02-20 11:24:57'),
(106, 1, 26, 4, 'testin', '2021-02-20 11:51:38'),
(107, 7, 26, 3, 'saw', '2021-02-20 12:00:04'),
(108, 1, 26, 5, 'testing', '2021-02-20 21:32:22'),
(109, 1, 44, 4, 'kind nice', '2021-02-25 08:12:39'),
(110, 1, 44, 5, '', '2021-02-25 08:12:50'),
(111, 1, 44, 5, '', '2021-02-25 08:12:56'),
(112, 1, 44, 1, '', '2021-02-25 08:13:02'),
(113, 1, 44, 1, '', '2021-02-25 08:13:14'),
(114, 1, 44, 4, '', '2021-02-25 09:43:53'),
(115, 1, 44, 5, '', '2021-02-25 09:44:53'),
(116, 1, 44, 5, '', '2021-02-25 09:45:34');

-- --------------------------------------------------------

--
-- Table structure for table `salaries`
--

CREATE TABLE `salaries` (
  `userId` int(11) UNSIGNED NOT NULL,
  `penalty` tinyint(1) NOT NULL,
  `salary` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `salaries`
--

INSERT INTO `salaries` (`userId`, `penalty`, `salary`) VALUES
(28, 0, 204.16666666667),
(33, 1, 2000);

-- --------------------------------------------------------

--
-- Table structure for table `survey`
--

CREATE TABLE `survey` (
  `survey_id` int(11) NOT NULL,
  `survey_name` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `survey`
--

INSERT INTO `survey` (`survey_id`, `survey_name`) VALUES
(1, 'First Survey23'),
(19, 'name'),
(20, 'test'),
(22, 'name'),
(23, 'newestsurvey'),
(24, 'surveyElde7k'),
(25, 'quality survey'),
(26, 'surveyelde7k2');

-- --------------------------------------------------------

--
-- Table structure for table `survey_answer`
--

CREATE TABLE `survey_answer` (
  `survey_answer_id` int(11) NOT NULL,
  `survey_response_id` int(11) DEFAULT NULL,
  `survey_id` int(11) NOT NULL,
  `question_id` int(11) NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `answer_value` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `survey_answer`
--

INSERT INTO `survey_answer` (`survey_answer_id`, `survey_response_id`, `survey_id`, `question_id`, `user_id`, `answer_value`) VALUES
(13, NULL, 23, 9, 26, 'asn1'),
(14, NULL, 23, 10, 26, 'ans2a'),
(15, NULL, 23, 11, 26, 'ans3'),
(16, NULL, 23, 12, 26, 'ans4'),
(17, NULL, 24, 13, 26, 'ans1'),
(18, NULL, 24, 14, 26, 'ans2'),
(19, NULL, 24, 15, 26, 'ans3'),
(20, NULL, 24, 16, 26, 'ans4'),
(21, NULL, 24, 13, 27, 'hehe'),
(22, NULL, 24, 14, 27, 'heeh2'),
(23, NULL, 24, 15, 27, 'sad'),
(24, NULL, 24, 16, 27, 'asdd'),
(25, NULL, 26, 22, 26, 'kwaies'),
(26, NULL, 26, 23, 26, 'ans3'),
(27, NULL, 26, 24, 26, 'asnasd'),
(28, NULL, 26, 25, 26, 'asdasjdn'),
(29, NULL, 26, 26, 26, 'asjdasjkd');

-- --------------------------------------------------------

--
-- Table structure for table `survey_sent_to`
--

CREATE TABLE `survey_sent_to` (
  `survey_id` int(11) NOT NULL,
  `user_id` int(10) UNSIGNED DEFAULT NULL,
  `has_answered` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `survey_sent_to`
--

INSERT INTO `survey_sent_to` (`survey_id`, `user_id`, `has_answered`) VALUES
(1, 29, 0),
(1, 27, 0),
(1, 29, 0),
(1, 27, 0),
(1, 27, 0),
(1, 29, 0),
(20, 29, 0),
(20, 27, 0),
(20, 26, 0),
(1, 30, 0),
(23, 26, 1),
(23, 29, 0),
(23, 27, 0),
(23, 30, 0),
(24, 26, 1),
(24, 27, 1),
(24, 29, 0),
(24, 30, 0),
(25, 27, 0),
(25, 26, 0),
(1, 26, 0),
(26, 29, 0),
(26, 30, 0),
(26, 27, 0),
(26, 26, 1);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `Id` int(11) UNSIGNED NOT NULL,
  `firstName` varchar(50) DEFAULT NULL,
  `lastName` varchar(50) DEFAULT NULL,
  `Email` varchar(50) DEFAULT NULL,
  `password` varchar(150) DEFAULT NULL,
  `phoneNumber` varchar(50) DEFAULT NULL,
  `gender` varchar(50) DEFAULT NULL,
  `date_of_birth` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `Role` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`Id`, `firstName`, `lastName`, `Email`, `password`, `phoneNumber`, `gender`, `date_of_birth`, `Role`) VALUES
(26, 'ahmed', 'adelss', 'ahmedserag2000@gmail.com', 'Warcraft_2000', '01019245307', 'Male', '2021-02-25 09:56:01', 1),
(27, 'sayed', 'mohamed', 'Ss@gmail.com', 'Hs123456', '0265643w42', 'Male', '2021-02-15 22:00:00', 1),
(28, 'ahmedADMIN', 'adel', 'liveyourmoment@gmail.com', 'Warcraft_2000', '01019245307', 'Male', '2021-02-19 13:11:24', 2),
(29, 'abdo', 'asdd', 'ad@gmail.com', 'Warcraft_2000', '01019245307', 'Male', '2021-02-24 12:47:42', 1),
(30, 'ahmed', 'adel', 'mm@gmail.com', '6f6a3fb3206caaa9409f08b4079b28ac68420155', '01019245307', 'Male', '2000-02-01 22:00:00', 1),
(31, 'ahmedAuditor', 'Audit', 'Auditor@gmail.com', 'Warcraft_2000', '01019245307', 'Male', '2021-02-21 14:57:12', 4),
(32, 'ahmed', 'adel', 'HR@gmail.com', 'Warcraft_2000', '01019245307', 'Male', '2021-02-23 14:55:35', 3),
(33, 'newAdmin', 'test', 'admin@gmail.com', 'Warcraft_2000', '01019245307', 'Male', '2021-02-24 08:30:12', 2),
(34, 'test', 'test', 'nooo@gmail.com', NULL, '01019245307', 'Male', '2021-02-24 18:16:44', 1),
(35, 'user', 'sus', 'sss@gmail.com', NULL, '01019245307', 'Male', '2021-02-24 18:15:22', 1),
(36, 'ahmed', 'adel', 'wag@gmail.com', NULL, '01019245307', 'Male', '2021-02-24 18:18:44', 1),
(37, 'ahemd', 'adel', 'sera@gmail.com', 'Warcraft_2000', '01019245307', 'Male', '2000-02-01 22:00:00', 1),
(38, 'ahmed', 'adel', 'wagi@gmail.com', 'Warcraft_2000', '01019245307', 'Male', '2000-02-01 22:00:00', 1),
(39, 'ahmed', 'yehia', 'ahmed@gmail.com', 'Ss123456', '01203945', 'Male', '2000-02-01 22:00:00', 1),
(40, 'sayed', 'yasser', 'ahmedserag2000@yahoo.com', 'Ss123456', '02934549378', 'Male', '2000-02-21 22:00:00', 1),
(41, 'aa', 'ass', 'ahmed23134@gmail.com', 'Ss123456', '02345675643', 'Male', '2000-02-01 22:00:00', 1),
(42, 'asss', 'assss', 'ahmed324567@gmail.com', 'Ss123456', '0231456543', 'Male', '2000-02-21 22:00:00', 1),
(43, 'first name', 'last name', 'ss@gmail.com', NULL, '01019245307', 'Male', '2021-02-24 20:24:27', 1),
(44, 'user', 'us', 'new@gmail.com', 'Warcraft_2000', '01019245307', 'Male', '2000-02-01 22:00:00', 1),
(45, 'test8', 'tes', 'test8@gmail.com', 'Warcraft_2000', '01019245307', 'Male', '2021-02-25 09:56:28', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `contactus`
--
ALTER TABLE `contactus`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `invoice`
--
ALTER TABLE `invoice`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `customerId` (`customerId`);

--
-- Indexes for table `logs`
--
ALTER TABLE `logs`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `receiverId` (`receiverId`),
  ADD KEY `senderId` (`senderId`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `question`
--
ALTER TABLE `question`
  ADD PRIMARY KEY (`question_id`),
  ADD KEY `survey_id` (`survey_id`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `productId` (`productId`),
  ADD KEY `customerId` (`customerId`);

--
-- Indexes for table `salaries`
--
ALTER TABLE `salaries`
  ADD KEY `userId` (`userId`);

--
-- Indexes for table `survey`
--
ALTER TABLE `survey`
  ADD PRIMARY KEY (`survey_id`);

--
-- Indexes for table `survey_answer`
--
ALTER TABLE `survey_answer`
  ADD PRIMARY KEY (`survey_answer_id`),
  ADD KEY `survey_id` (`survey_id`),
  ADD KEY `question_id` (`question_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `survey_sent_to`
--
ALTER TABLE `survey_sent_to`
  ADD KEY `user_id` (`user_id`),
  ADD KEY `survey_id` (`survey_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`Id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `contactus`
--
ALTER TABLE `contactus`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `invoice`
--
ALTER TABLE `invoice`
  MODIFY `Id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=101;

--
-- AUTO_INCREMENT for table `logs`
--
ALTER TABLE `logs`
  MODIFY `Id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `Id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `question`
--
ALTER TABLE `question`
  MODIFY `question_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `Id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=117;

--
-- AUTO_INCREMENT for table `survey`
--
ALTER TABLE `survey`
  MODIFY `survey_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `survey_answer`
--
ALTER TABLE `survey_answer`
  MODIFY `survey_answer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `Id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `invoice`
--
ALTER TABLE `invoice`
  ADD CONSTRAINT `invoice_ibfk_1` FOREIGN KEY (`customerId`) REFERENCES `user` (`Id`);

--
-- Constraints for table `logs`
--
ALTER TABLE `logs`
  ADD CONSTRAINT `logs_ibfk_1` FOREIGN KEY (`receiverId`) REFERENCES `user` (`Id`),
  ADD CONSTRAINT `logs_ibfk_2` FOREIGN KEY (`senderId`) REFERENCES `user` (`Id`);

--
-- Constraints for table `question`
--
ALTER TABLE `question`
  ADD CONSTRAINT `question_ibfk_1` FOREIGN KEY (`survey_id`) REFERENCES `survey` (`survey_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `reviews_ibfk_1` FOREIGN KEY (`productId`) REFERENCES `products` (`Id`),
  ADD CONSTRAINT `reviews_ibfk_2` FOREIGN KEY (`customerId`) REFERENCES `user` (`Id`);

--
-- Constraints for table `salaries`
--
ALTER TABLE `salaries`
  ADD CONSTRAINT `salaries_ibfk_1` FOREIGN KEY (`userId`) REFERENCES `user` (`Id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `survey_answer`
--
ALTER TABLE `survey_answer`
  ADD CONSTRAINT `survey_answer_ibfk_1` FOREIGN KEY (`survey_id`) REFERENCES `survey` (`survey_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `survey_answer_ibfk_2` FOREIGN KEY (`question_id`) REFERENCES `question` (`question_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `survey_answer_ibfk_3` FOREIGN KEY (`user_id`) REFERENCES `user` (`Id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `survey_sent_to`
--
ALTER TABLE `survey_sent_to`
  ADD CONSTRAINT `survey_sent_to_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`Id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `survey_sent_to_ibfk_2` FOREIGN KEY (`survey_id`) REFERENCES `survey` (`survey_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
