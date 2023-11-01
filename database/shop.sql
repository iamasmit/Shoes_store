-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 28, 2023 at 02:57 AM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `shop`
--
CREATE DATABASE IF NOT EXISTS `shop` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `shop`;

CREATE TABLE `contact_requests` (
  `request_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `message` text NOT NULL,
  `request_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`request_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `p_id` int(11) NOT NULL,
  `p_name` varchar(40) NOT NULL,
  `p_price` int(11) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `inventory`
--

CREATE TABLE `inventory` (
  `pid` int(11) NOT NULL,
  `p_name` varchar(50) DEFAULT NULL,
  `p_price` int(11) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `category` varchar(15) NOT NULL,
  `image_url` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `inventory`
--

INSERT INTO `inventory` (`pid`, `p_name`, `p_price`, `quantity`, `category`, `image_url`) VALUES
(1, 'Nike FlyKnit', 80, 5, 'shoes', 'https://images.unsplash.com/photo-1542291026-7eec264c27ff?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1470&q=80'),
(2, 'Nike Air Huarache Women', 120, 10, 'shoes', 'https://static.nike.com/a/images/t_PDP_1728_v1/f_auto,q_auto:eco/0496a2b1-41e6-4bfe-a09f-67c986a79efd/air-huarache-craft-womens-shoes-Cp4dSR.png'),
(3, 'Puma Fuse 2.0', 110, 50, 'shoes', 'https://images.puma.com/image/upload/f_auto,q_auto,b_rgb:fafafa,w_1050,h_1050/global/377069/01/sv01/fnd/PNA/fmt/png/Fuse-2.0-OUT-Men\'s-Training-Shoes'),
(4, 'Vans SK8 Hi-Shoe', 85, 15, 'shoes', 'https://images.vans.com/is/image/Vans/VN000TS9_BKA_HERO?wid=1600&hei=1984&fmt=jpeg&qlt=90&resMode=sharp2&op_usm=0.9,1.7,8,0'),
(5, 'NewBalance 990v6', 220, 10, 'shoes', 'https://nb.scene7.com/is/image/NB/u990te6_nb_05_i?$pdpflexf2$&qlt=80&fmt=webp&wid=440&hei=440'),
(6, 'Adidas Adillete 22', 60, 100, 'slides', 'https://assets.adidas.com/images/h_840,f_auto,q_auto,fl_lossy,c_fill,g_auto/dc2dc30c8da84ea48b87af4200bd1bd1_9366/Adilette_22_Slides_White_HQ4672_02_standard_hover.jpg'),
(7, 'Inkkas Frida Slides', 85, 20, 'slides', 'https://i.ebayimg.com/images/g/lLMAAOSwMYZhzdlS/s-l1600.jpg'),
(8, 'Michael Kors Portia', 95, 15, 'slides', 'https://michaelkors.scene7.com/is/image/MichaelKors/40F3POFA1L-2192_5?wid=1300'),
(9, 'Hugo Boss Slides', 35, 45, 'slides', 'https://images.hugoboss.com/is/image/boss/hbeu50497864_494_250?$large$=&fit=crop,1&align=1,1&lastModified=1693874267000&wid=1600'),
(10, 'Tommy Jeans x Smiley', 38, 200, 'slides', 'https://hk.tommy.com/on/demandware.static/-/Sites-th-master-catalog/default/dw8fc2a5ce/EN02367/C34_01_EN0EN02367BDS_FL-ST-F1.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `orderhistory`
--

CREATE TABLE `orderhistory` (
  `o_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `pid` int(11) NOT NULL,
  `p_quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `full_name` varchar(40) NOT NULL,
  `password` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `designation` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`p_id`),
  ADD UNIQUE KEY `p_name` (`p_name`);

--
-- Indexes for table `inventory`
--
ALTER TABLE `inventory`
  ADD PRIMARY KEY (`pid`);

--
-- Indexes for table `orderhistory`
--
ALTER TABLE `orderhistory`
  ADD PRIMARY KEY (`o_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `p_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=117;

--
-- AUTO_INCREMENT for table `inventory`
--
ALTER TABLE `inventory`
  MODIFY `pid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `orderhistory`
--
ALTER TABLE `orderhistory`
  MODIFY `o_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
