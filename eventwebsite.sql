-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 08, 2024 at 07:07 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `eventwebsite`
--

-- --------------------------------------------------------

--
-- Table structure for table `admincred`
--

CREATE TABLE `admincred` (
  `srno` int(11) NOT NULL,
  `adminname` varchar(150) NOT NULL,
  `adminpass` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admincred`
--

INSERT INTO `admincred` (`srno`, `adminname`, `adminpass`) VALUES
(0, 'nikhil', '123');

-- --------------------------------------------------------

--
-- Table structure for table `bookingdetails`
--

CREATE TABLE `bookingdetails` (
  `srno` int(11) NOT NULL,
  `bookingid` int(11) NOT NULL,
  `eventname` varchar(150) NOT NULL,
  `venue` varchar(200) NOT NULL,
  `module` varchar(200) NOT NULL,
  `price` int(11) NOT NULL,
  `totalpay` int(11) NOT NULL,
  `eventno` varchar(110) DEFAULT NULL,
  `username` varchar(100) NOT NULL,
  `pnum` varchar(100) NOT NULL,
  `address` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bookingdetails`
--

INSERT INTO `bookingdetails` (`srno`, `bookingid`, `eventname`, `venue`, `module`, `price`, `totalpay`, `eventno`, `username`, `pnum`, `address`) VALUES
(1, 2, '🅰🅽🅽🅸🆅🅴🆁🆂🅰🆁🆈', '', '', 125000, 125000, NULL, 'nikhil', '123', 'ab'),
(2, 1, '🅰🅽🅽🅸🆅🅴🆁🆂🅰🆁🆈', '', '', 125000, 125000, NULL, 'nikh', '1234', 'abc');

-- --------------------------------------------------------

--
-- Table structure for table `bookingorder`
--

CREATE TABLE `bookingorder` (
  `bookingid` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `eventid` int(11) NOT NULL,
  `checkin` date NOT NULL,
  `checkout` date NOT NULL,
  `arrival` int(11) NOT NULL DEFAULT 0,
  `refund` int(11) DEFAULT NULL,
  `bookingstatus` varchar(100) NOT NULL DEFAULT 'pending',
  `orderid` varchar(100) NOT NULL,
  `transid` varchar(200) DEFAULT NULL,
  `transamt` int(11) NOT NULL,
  `transstatus` varchar(500) NOT NULL DEFAULT 'pending',
  `transrespmsg` varchar(110) DEFAULT NULL,
  `datentime` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bookingorder`
--

INSERT INTO `bookingorder` (`bookingid`, `userid`, `eventid`, `checkin`, `checkout`, `arrival`, `refund`, `bookingstatus`, `orderid`, `transid`, `transamt`, `transstatus`, `transrespmsg`, `datentime`) VALUES
(1, 5, 13, '2023-03-19', '2023-03-20', 0, NULL, 'pending', 'ORD_21055700', NULL, 0, 'pending', NULL, '2023-03-19 00:00:00'),
(2, 6, 7, '2023-03-19', '2023-03-20', 0, NULL, 'booked', 'ORD_24215693', '20220720111212800110168128204225279', 125000, 'TXN_SUCCESS', 'Txn Success', '2024-03-19 16:43:49'),
(8, 5, 13, '2024-04-05', '2024-04-06', 0, NULL, 'cancelled', 'ORD_24215691', '20220720111212800110168128204225279', 125000, 'TXN_SUCCESS', 'Txn Success', '2024-04-05 16:43:55'),
(9, 5, 12, '0000-00-00', '0000-00-00', 0, 0, 'pending', '', NULL, 0, 'pending', NULL, '2024-04-07 19:16:09'),
(10, 5, 12, '0000-00-00', '0000-00-00', 0, 0, 'pending', '', NULL, 0, 'pending', NULL, '2024-04-07 19:16:22');

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

CREATE TABLE `bookings` (
  `srno` int(11) NOT NULL,
  `name` varchar(150) NOT NULL,
  `pnum` varchar(10) NOT NULL,
  `event` varchar(100) NOT NULL,
  `venue` varchar(200) NOT NULL,
  `price` varchar(200) NOT NULL,
  `checkin` date NOT NULL,
  `checkout` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bookings`
--

INSERT INTO `bookings` (`srno`, `name`, `pnum`, `event`, `venue`, `price`, `checkin`, `checkout`) VALUES
(10, 'NIKHIL', '9021388541', 'birthday', 'pune', '1234', '2024-04-07', '2024-04-08');

-- --------------------------------------------------------

--
-- Table structure for table `carousel`
--

CREATE TABLE `carousel` (
  `srno` int(11) NOT NULL,
  `image` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `carousel`
--

INSERT INTO `carousel` (`srno`, `image`) VALUES
(13, 'IMG_41880.jpeg'),
(14, 'IMG_35438.jpeg'),
(15, 'IMG_72390.jpeg'),
(16, 'IMG_47033.jpeg');

-- --------------------------------------------------------

--
-- Table structure for table `contactdetails`
--

CREATE TABLE `contactdetails` (
  `srno` int(11) NOT NULL,
  `address` varchar(100) NOT NULL,
  `gmap` varchar(100) NOT NULL,
  `pn1` bigint(20) NOT NULL,
  `pn2` bigint(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `fb` varchar(100) NOT NULL,
  `insta` varchar(100) NOT NULL,
  `tw` varchar(100) NOT NULL,
  `iframe` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `contactdetails`
--

INSERT INTO `contactdetails` (`srno`, `address`, `gmap`, `pn1`, `pn2`, `email`, `fb`, `insta`, `tw`, `iframe`) VALUES
(1, ' Dighi Pune 411015', 'https://maps.app.goo.gl/Stj58hhd5D9Tun4n9', 919021388541, 919552068394, 'nikhilhadabe31@gmail.com', 'facebook.com', 'https://www.instagram.com/accounts/login/', 'twitter.com', 'https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d242118.06958511178!2d73.862967!3d18.524616!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3bc2bf2e67461101:0x828d43bf9d9ee343!2sPune, Maharashtra!5e0!3m2!1sen!2sin!4v1707457782725!5m2!1sen!2sin');

-- --------------------------------------------------------

--
-- Table structure for table `event`
--

CREATE TABLE `event` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `venue` varchar(100) NOT NULL,
  `module` varchar(200) NOT NULL,
  `guest` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `description` varchar(500) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `removed` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `event`
--

INSERT INTO `event` (`id`, `name`, `venue`, `module`, `guest`, `price`, `description`, `status`, `removed`) VALUES
(1, 'birthday', 'pune', 'night', 150, 15000, 'cwwewewe', 0, 1),
(3, 'birthday', 'pune', 'night', 23, 12345, 'hello', 0, 1),
(4, 'Marriage', 'dighi', 'night', 150, 70000, 'Welcome', 0, 1),
(5, 'AD', 'efe', 'efw', 121, 12, 'qee', 0, 1),
(6, 'cc', 'cce', 'ce', 1, 122, 'def', 0, 1),
(7, '🆆🅴🅳🅳🅸🅽🅶', 'mumbai', 'evening', 1200, 125000, 'Booking a wedding event with us is a seamless and joyful experience. Our dedicated team ensures that every detail is meticulously planned and executed, leaving you free to enjoy your special day to the fullest.\r\n\r\nFrom intimate ceremonies to grand celebrations, we offer a range of venues to suit your needs. Our experienced staff will work closely with you to understand your vision and bring it to life, ensuring that every aspect of your event is perfect.\r\n\r\nOur catering team will create a bespok', 1, 0),
(8, 'cwe', 'fef', 'ee', 344, 124, 'cw', 0, 1),
(9, 'c', 'e', 'e', 1123, 311, 'ded', 0, 1),
(10, 'd', 'dd', 'd', 131, 13, 'dd', 0, 1),
(12, '🅰🅽🅽🅸🆅🅴🆁🆂🅰🆁🆈', 'mumbai', 'night', 50, 15800, 'welcome all of you', 1, 0),
(13, '🅱🅸🆁🆃🅷🅳🅰🆈', 'dighi', 'night', 12, 10000, 'welcome all of you', 1, 0),
(14, 'nfrenfrffff33', '34t34', 'f34', 6, 448, 'fnjr', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `eventfacility`
--

CREATE TABLE `eventfacility` (
  `srno` int(11) NOT NULL,
  `eventid` int(11) NOT NULL,
  `facilityid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `eventfacility`
--

INSERT INTO `eventfacility` (`srno`, `eventid`, `facilityid`) VALUES
(74, 13, 16),
(75, 13, 18),
(76, 13, 18),
(77, 12, 15),
(78, 12, 16),
(79, 12, 18),
(80, 12, 18),
(81, 7, 15),
(82, 7, 16),
(83, 7, 18),
(84, 7, 18);

-- --------------------------------------------------------

--
-- Table structure for table `eventfeature`
--

CREATE TABLE `eventfeature` (
  `srno` int(11) NOT NULL,
  `eventid` int(11) NOT NULL,
  `featureid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `eventfeature`
--

INSERT INTO `eventfeature` (`srno`, `eventid`, `featureid`) VALUES
(56, 13, 3),
(57, 13, 16),
(58, 13, 16),
(59, 12, 3),
(60, 12, 16),
(61, 12, 16),
(62, 7, 3),
(63, 7, 16),
(64, 7, 16);

-- --------------------------------------------------------

--
-- Table structure for table `eventimage`
--

CREATE TABLE `eventimage` (
  `srno` int(11) NOT NULL,
  `eventid` int(11) NOT NULL,
  `image` varchar(150) NOT NULL,
  `thumb` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `eventimage`
--

INSERT INTO `eventimage` (`srno`, `eventid`, `image`, `thumb`) VALUES
(34, 7, 'IMG_54012.jpg', 1),
(37, 12, 'IMG_37802.jpg', 0),
(38, 12, 'IMG_77675.jpg', 1),
(39, 13, 'IMG_69533.jpg', 1),
(40, 13, 'IMG_71702.jpg', 0),
(41, 13, 'IMG_68807.jpg', 0);

-- --------------------------------------------------------

--
-- Table structure for table `facility`
--

CREATE TABLE `facility` (
  `id` int(11) NOT NULL,
  `icon` varchar(150) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `facility`
--

INSERT INTO `facility` (`id`, `icon`, `name`, `description`) VALUES
(15, 'IMG_65538.svg', 'Speaker', 'ALL types Speakers Available'),
(16, 'IMG_58342.svg', 'Decoration', 'Customizable decoration demand on customer'),
(17, 'IMG_22960.svg', 'Parking', 'parking available'),
(18, 'IMG_47458.svg', 'PhotoGrapher', 'PhotoGrapher available'),
(19, 'IMG_42593.svg', 'Customization', '\"Customizing events allows you to personalize every detail, from the venue and decor to the schedule and activities, ensuring that each event is unique and perfectly suited to its audience.\"');

-- --------------------------------------------------------

--
-- Table structure for table `feature`
--

CREATE TABLE `feature` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `feature`
--

INSERT INTO `feature` (`id`, `name`) VALUES
(3, 'abc'),
(16, 'dw');

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `srno` int(11) NOT NULL,
  `sitetitle` varchar(50) NOT NULL,
  `siteabout` varchar(400) NOT NULL,
  `shutdown` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`srno`, `sitetitle`, `siteabout`, `shutdown`) VALUES
(1, 'ETwebsite', 'developed by Nikhil hadabe', 0);

-- --------------------------------------------------------

--
-- Table structure for table `teamdetails`
--

CREATE TABLE `teamdetails` (
  `srno` int(11) NOT NULL,
  `name` varchar(20) NOT NULL,
  `picture` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `teamdetails`
--

INSERT INTO `teamdetails` (`srno`, `name`, `picture`) VALUES
(63, 'arjun', 'IMG_54392.jpg'),
(64, 'Mauli Chauhan', 'IMG_26409.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `usercred`
--

CREATE TABLE `usercred` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `address` varchar(150) NOT NULL,
  `pnum` varchar(20) NOT NULL,
  `pincode` int(11) NOT NULL,
  `dob` date NOT NULL,
  `profile` varchar(100) NOT NULL,
  `password` varchar(200) NOT NULL,
  `isverify` int(11) NOT NULL DEFAULT 0,
  `token` varchar(200) DEFAULT NULL,
  `texpire` date DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `datentime` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `usercred`
--

INSERT INTO `usercred` (`id`, `name`, `email`, `address`, `pnum`, `pincode`, `dob`, `profile`, `password`, `isverify`, `token`, `texpire`, `status`, `datentime`) VALUES
(5, 'NIKHIL', 'nikhilhadabe31@gmail.com', 'SHREE SAI SHRADDHA COLONY SAVANT NAGAR BHOSARI PUNE 39', '9067260250', 411039, '2024-03-16', 'IMG_33412.jpeg', '$2y$10$aYi.Lhi3dVCY/2Ja8GAys.Nsb/ske2LdDQeJQ.PdKOdK/8w/3upQK', 1, NULL, NULL, 1, '2024-03-12 00:19:33'),
(6, 'NIKHIL', 'hadabenikhil@gmail.com', 'SHREE SAI SHRADDHA COLONY SAVANT NAGAR BHOSARI PUNE 39', '9021388541', 411039, '2024-03-23', 'IMG_19154.jpeg', '$2y$10$HDhesW0QbcUUjnnxRp4bOO42AykznjSZZfwxKRxozjoM.EE0qJ5ai', 1, 'cb8c383b9eb4ee814827eb686576007b', NULL, 1, '2024-03-12 10:31:53'),
(10, 'nikhil', 'hadabenikhilsanjay@mitacsc.edu.in', 'Shree Sai shradha colony Savant nagur Bhosari 39', '9067260254', 411039, '2024-04-06', 'IMG_20035.jpeg', '$2y$10$4VnNKAPMw8/w4bTmnQZyiOuwlrLnM4zIBLGXpCtpT2klLHHMVSz3q', 1, '93bab987d6298ae9f2b62243d421efd9', NULL, 1, '2024-04-06 18:53:20'),
(11, 'arun', 'nikhilhadabe29@gmail.com', 'SHREE SAI SHRADDHA COLONY SAVANT NAGAR BHOSARI PUNE 39', '1234569874', 411039, '2024-04-01', 'IMG_56911.jpeg', '$2y$10$5aZVywEE0IUJB9d2iT/1TOE5/KjeUvAHLFlqUdmRWsDztV419Q7ym', 1, '7d503c72ac559273928127746549e0cf', NULL, 1, '2024-04-06 19:19:08');

-- --------------------------------------------------------

--
-- Table structure for table `userquery`
--

CREATE TABLE `userquery` (
  `srno` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(150) NOT NULL,
  `subject` varchar(200) NOT NULL,
  `message` varchar(500) NOT NULL,
  `date` date NOT NULL DEFAULT current_timestamp(),
  `seen` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `userquery`
--

INSERT INTO `userquery` (`srno`, `name`, `email`, `subject`, `message`, `date`, `seen`) VALUES
(31, 'NIKHIL', 'nikhilhadabe31@gmail.com', 'hi hello', 'qddqdq', '2024-02-24', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admincred`
--
ALTER TABLE `admincred`
  ADD PRIMARY KEY (`srno`);

--
-- Indexes for table `bookingdetails`
--
ALTER TABLE `bookingdetails`
  ADD PRIMARY KEY (`srno`),
  ADD KEY `bookingid` (`bookingid`);

--
-- Indexes for table `bookingorder`
--
ALTER TABLE `bookingorder`
  ADD PRIMARY KEY (`bookingid`),
  ADD KEY `userid` (`userid`),
  ADD KEY `eventid` (`eventid`);

--
-- Indexes for table `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`srno`);

--
-- Indexes for table `carousel`
--
ALTER TABLE `carousel`
  ADD PRIMARY KEY (`srno`);

--
-- Indexes for table `contactdetails`
--
ALTER TABLE `contactdetails`
  ADD PRIMARY KEY (`srno`);

--
-- Indexes for table `event`
--
ALTER TABLE `event`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `eventfacility`
--
ALTER TABLE `eventfacility`
  ADD PRIMARY KEY (`srno`),
  ADD KEY `eventid` (`eventid`),
  ADD KEY `facilityid` (`facilityid`);

--
-- Indexes for table `eventfeature`
--
ALTER TABLE `eventfeature`
  ADD PRIMARY KEY (`srno`),
  ADD KEY `featureid` (`featureid`),
  ADD KEY `eventsid` (`eventid`);

--
-- Indexes for table `eventimage`
--
ALTER TABLE `eventimage`
  ADD PRIMARY KEY (`srno`),
  ADD KEY `eventid` (`eventid`);

--
-- Indexes for table `facility`
--
ALTER TABLE `facility`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `feature`
--
ALTER TABLE `feature`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`srno`);

--
-- Indexes for table `teamdetails`
--
ALTER TABLE `teamdetails`
  ADD PRIMARY KEY (`srno`);

--
-- Indexes for table `usercred`
--
ALTER TABLE `usercred`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `userquery`
--
ALTER TABLE `userquery`
  ADD PRIMARY KEY (`srno`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bookingdetails`
--
ALTER TABLE `bookingdetails`
  MODIFY `srno` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `bookingorder`
--
ALTER TABLE `bookingorder`
  MODIFY `bookingid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `bookings`
--
ALTER TABLE `bookings`
  MODIFY `srno` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `carousel`
--
ALTER TABLE `carousel`
  MODIFY `srno` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `contactdetails`
--
ALTER TABLE `contactdetails`
  MODIFY `srno` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `event`
--
ALTER TABLE `event`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `eventfacility`
--
ALTER TABLE `eventfacility`
  MODIFY `srno` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=88;

--
-- AUTO_INCREMENT for table `eventfeature`
--
ALTER TABLE `eventfeature`
  MODIFY `srno` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;

--
-- AUTO_INCREMENT for table `eventimage`
--
ALTER TABLE `eventimage`
  MODIFY `srno` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `facility`
--
ALTER TABLE `facility`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `feature`
--
ALTER TABLE `feature`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `srno` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `teamdetails`
--
ALTER TABLE `teamdetails`
  MODIFY `srno` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;

--
-- AUTO_INCREMENT for table `usercred`
--
ALTER TABLE `usercred`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `userquery`
--
ALTER TABLE `userquery`
  MODIFY `srno` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bookingdetails`
--
ALTER TABLE `bookingdetails`
  ADD CONSTRAINT `bookingdetails_ibfk_1` FOREIGN KEY (`bookingid`) REFERENCES `bookingorder` (`bookingid`);

--
-- Constraints for table `bookingorder`
--
ALTER TABLE `bookingorder`
  ADD CONSTRAINT `bookingorder_ibfk_1` FOREIGN KEY (`userid`) REFERENCES `usercred` (`id`),
  ADD CONSTRAINT `bookingorder_ibfk_2` FOREIGN KEY (`eventid`) REFERENCES `event` (`id`);

--
-- Constraints for table `eventfacility`
--
ALTER TABLE `eventfacility`
  ADD CONSTRAINT `eventid` FOREIGN KEY (`eventid`) REFERENCES `event` (`id`),
  ADD CONSTRAINT `facilityid` FOREIGN KEY (`facilityid`) REFERENCES `facility` (`id`);

--
-- Constraints for table `eventfeature`
--
ALTER TABLE `eventfeature`
  ADD CONSTRAINT `eventsid` FOREIGN KEY (`eventid`) REFERENCES `event` (`id`) ON UPDATE NO ACTION,
  ADD CONSTRAINT `featureid` FOREIGN KEY (`featureid`) REFERENCES `feature` (`id`) ON UPDATE NO ACTION;

--
-- Constraints for table `eventimage`
--
ALTER TABLE `eventimage`
  ADD CONSTRAINT `eventimage_ibfk_1` FOREIGN KEY (`eventid`) REFERENCES `event` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
