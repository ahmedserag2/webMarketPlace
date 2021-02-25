-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 25, 2021 at 02:42 PM
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
(1, 'ahmed', 'adel', 'ahmedserag2000@gmail.com', 1019245307, 'Uploads/bestchoice.png.jpeg', 'do you guys have all type of products or just tech');

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
(1, '1', 3, '2021-02-25 13:04:59', '3', 330.3, 'first settlment'),
(2, '3', 3, '2021-02-25 13:05:58', '1', 132120, 'adress');

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
(1, 'hello i would like to ask about something', 1, 3, '2021-02-25 13:18:43', 1, 1, 0),
(2, 'in a minute sir', 3, 1, '2021-02-25 13:18:43', 1, 1, 0),
(3, 'please tell us whats up', 3, 4, '2021-02-25 13:18:43', 1, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `Id` int(10) UNSIGNED NOT NULL,
  `Name` varchar(30) NOT NULL,
  `Details` text NOT NULL,
  `rating` float DEFAULT NULL,
  `Price` int(50) DEFAULT NULL,
  `reg_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`Id`, `Name`, `Details`, `rating`, `Price`, `reg_date`) VALUES
(1, 'iphone6', 'size comes in varieties and same for color', 5, 100, '2021-02-25 13:00:24'),
(2, 'iphone 7', 'silver 7 inch iphone original', 0, 10000, '2021-02-25 12:32:58'),
(3, 'motorola phone', 'brand is zte variety of colors uses android', 0, 120000, '2021-02-25 12:34:23'),
(4, 'sony xperia phone', 'holds 64 gb of capacity dual sim you just wont be dissapointed', 0, 20000, '2021-02-25 12:36:06'),
(5, 'pixel 5', 'green pixel phone holding 128 gb and 8 gb of RAM', 0, 30000, '2021-02-25 12:40:06'),
(6, 'Huawei P30 Pro', '256 GB super duper charge original silver color ', 0, 12777, '2021-02-25 12:41:15'),
(7, 'Alienware M15 R2', 'Intel Core i7 i7-9750H 6-Core up to 4.5GHz, RTX 2070 8GB GPU, 8GB RAM, 512GB m2 SSD, RGB LED AlienFX Keyboard, Windows 10, English ', 0, 50000, '2021-02-25 12:42:59'),
(8, 'HP Pavilion 15', 'Computer CPU Manufacturer : intel\r\nExternal Product ID : 2365987412589\r\nProcessor Speed (GHz) : 2.4 GHz\r\nModel Number : Pavilion 15-dk0056wm', 0, 50000, '2021-02-25 12:44:49'),
(9, 'Lenovo ideapad L340', 'Processor Speed (GHz) : 4.1 GHz\r\nModel Number : Ideapad L340\r\nHardware Platform : DOS\r\nProcessor Type : Ci5 9th Generation', 0, 30000, '2021-02-25 12:46:04'),
(10, 'Lenovo Idea Pad', 'Operating System Type : DOS\r\nHard Disk Capacity : 1 TB\r\nScreen Size Range : 15 - 15.9 Inch\r\nProcessor Type : AMD APU A4\r\nUSB : USB 3.0\r\nHard Disk Interface : SATA', 0, 40000, '2021-02-25 12:47:16'),
(11, 'Apple MacBook Pro Late', 'Computer CPU Manufacturer : Apple\r\nExternal Product ID : 0190199267978\r\nHard Disk Interface : ssd\r\nHard Disk Interface : SSD\r\nModel Number : MVVK2\r\nProcessor Speed (GHz) : 2.3 Up To 4.8 GHZ', 0, 500000, '2021-02-25 12:48:05'),
(12, 'Dell laptop Inspiron', '15-3593 intel 10th Gen core i5-1035G1, 8GB Ram, 1TB HDD, Nvidia MX230 2GB Graphics, 15.6 inch FHD, Ubuntu,', 0, 30000, '2021-02-25 12:50:40'),
(13, 'Dell G5 15-5590', 'ntel core i7-9750H, 16GB RAM, 1TB HDD & 256 GB SSD, NVIDIA GTX1660Ti 6GB DDR5 Graphics, 15.6 inch FHD IPS, Backlit KB, Ubuntu, Black', 0, 20299, '2021-02-25 12:52:14'),
(14, 'Asus G531GW-AL203T', 'Experience the best of gaming performance and computing efficiency with the ASUS G531GW ROG-Strix-G Gaming Laptop. The precision-engineered device keeps you ahead at every task and', 0, 20000, '2021-02-25 12:52:55'),
(15, 'Apple MacBook', 'Computer CPU Manufacturer : Apple\r\nExternal Product ID : 0190199267978\r\nHard Disk Interface : ssd\r\nHard Disk Interface : SSD\r\nModel Number : MVVK2\r\nProcessor Speed (GHz) : 2.3 Up To 4.8 GHZ\r\nHardware Platform : MAC OS', 0, 70000, '2021-02-25 12:53:54'),
(16, 'computer interl i9', 'this is a deis', 0, 29999, '2021-02-25 12:54:36'),
(17, 'pixel xl phone', 'iphone hater', 0, 30000, '2021-02-25 12:54:58'),
(18, 'asdjkasd', 'demo', 0, 3999, '2021-02-25 12:55:14'),
(19, 'phoneofphone', 'jaaskjdkjasdDescription', 0, 2999, '2021-02-25 12:55:39');

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
(1, 1, 'how was the products ', 1, 0),
(2, 1, 'are you satisfied with the varieties we have', 1, 1),
(3, 1, 'pleas etell us how we could improve ', 1, 2),
(4, 1, 'etc etc', 1, 3);

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
(1, 1, 3, 5, 'first review this product is awsome', '2021-02-25 13:00:24');

-- --------------------------------------------------------

--
-- Table structure for table `salaries`
--

CREATE TABLE `salaries` (
  `userId` int(11) UNSIGNED NOT NULL,
  `penalty` tinyint(1) NOT NULL,
  `salary` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
(1, 'quality survey');

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
(1, NULL, 1, 1, 3, 'pretty good'),
(2, NULL, 1, 2, 3, 'no add more'),
(3, NULL, 1, 3, 3, 'add more products !'),
(4, NULL, 1, 4, 3, 'etc ?');

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
(1, 3, 1);

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
(1, 'admin', 'admin', 'admin@gmail.com', 'd033e22ae348aeb5660fc2140aec35850c4da997', '01019245307', 'male', '2021-02-25 12:19:49', 2),
(3, 'ahmeda', 'adel', 'ahmedserag2000@gmail.com', '6f6a3fb3206caaa9409f08b4079b28ac68420155', '01019245307', 'Male', '2021-02-25 13:05:30', 1),
(4, 'Auditor', 'Au', 'Auditor@gmail.com', 'd033e22ae348aeb5660fc2140aec35850c4da997', '01019245307', 'Male', '2021-02-25 13:33:31', 4),
(5, 'Hr', 'hr', 'Hr@gmail.com', 'd033e22ae348aeb5660fc2140aec35850c4da997', 'admin', 'Male', '2021-02-25 13:19:45', 3);

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
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `invoice`
--
ALTER TABLE `invoice`
  MODIFY `Id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `logs`
--
ALTER TABLE `logs`
  MODIFY `Id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `Id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `question`
--
ALTER TABLE `question`
  MODIFY `question_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `Id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `survey`
--
ALTER TABLE `survey`
  MODIFY `survey_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `survey_answer`
--
ALTER TABLE `survey_answer`
  MODIFY `survey_answer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `Id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

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
