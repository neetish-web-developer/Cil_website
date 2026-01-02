-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 08, 2024 at 12:04 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cii_centre`
--

-- --------------------------------------------------------

--
-- Table structure for table `about`
--

CREATE TABLE `about` (
  `id` int(11) NOT NULL,
  `image` varchar(60) NOT NULL,
  `name` text NOT NULL,
  `paragraph` text NOT NULL,
  `title` text NOT NULL,
  `p1` text NOT NULL,
  `p2` text NOT NULL,
  `p3` text NOT NULL,
  `p4` text NOT NULL,
  `p5` text NOT NULL,
  `p6` text NOT NULL,
  `p7` text NOT NULL,
  `p8` text NOT NULL,
  `p9` text NOT NULL,
  `p10` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `about`
--

INSERT INTO `about` (`id`, `image`, `name`, `paragraph`, `title`, `p1`, `p2`, `p3`, `p4`, `p5`, `p6`, `p7`, `p8`, `p9`, `p10`) VALUES
(1, '6684164d5a240.png', 'About CII Centre...', 'Indian Institute of Technology (Indian School of Mines) Dhanbad has establish Coal India Innovation Centre [CII] in support of Coal India Limited, within the boundaries of its premises to provide an enabling physical environment for young dynamic innovators to go hands on and give shape and expression to their innovative and creative natures. It will also contribute towards an overall development of the youth into a self-dependent and confident free-thinking innovator which in- turn will help the overall growth of society and the nation...', 'Our AIM...', 'To provide a platform for promoting experimentation, innovation, and creative output of the budding innovators...', 'To set up a structured process to identify, facilitate and develop innovation with the involvement of all stakeholders...', '', 'To provide an innovation ecosystem to support innovators and entrepreneurs in their quest to explore and contribute to the world of cutting-edge technologies and entrepreneurship...', 'To increase the productivity of the Centre/community...', 'To share ideas and identify contemporary and relevant issues of social and academic importance...', 'Identify potential innovators from the community...', 'To share ideas, acquaint the innovators/entrepreneurs about the latest technologies developed in the field of mining...', 'It will create entrepreneurial & innovation awareness in society...', 'To mentor the start-ups and nurture ideas into a successful venture...');

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `username`, `password`) VALUES
(3, 'admin', '$2y$10$/GmBlGJc7YLDV4T4BqyrOOviWBUYSu99ZTtUEWW5Vu4Ym3RLN1f0u');

-- --------------------------------------------------------

--
-- Table structure for table `contact`
--

CREATE TABLE `contact` (
  `id` int(11) NOT NULL,
  `f_name` text NOT NULL,
  `l_name` text NOT NULL,
  `email` text NOT NULL,
  `mobile` text NOT NULL,
  `message` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `contact`
--

INSERT INTO `contact` (`id`, `f_name`, `l_name`, `email`, `mobile`, `message`) VALUES
(4, 'arti', 'kumari', 'arti@cil.com', '7541030410', 'iiiiisa');

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `id` int(11) NOT NULL,
  `title` text NOT NULL,
  `description` varchar(500) NOT NULL,
  `image` varchar(60) NOT NULL,
  `date` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`id`, `title`, `description`, `image`, `date`) VALUES
(25, 'WEBINAR ON PROTEOUS VSM', 'try', '6689296c92a9e.jpg', '2024-07-06');

-- --------------------------------------------------------

--
-- Table structure for table `home_labs_infra`
--

CREATE TABLE `home_labs_infra` (
  `id` int(11) NOT NULL,
  `image` varchar(60) NOT NULL,
  `name` text NOT NULL,
  `description` varchar(200) NOT NULL,
  `point_1` varchar(100) NOT NULL,
  `point_2` varchar(100) NOT NULL,
  `point_3` varchar(100) NOT NULL,
  `point_4` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `home_labs_infra`
--

INSERT INTO `home_labs_infra` (`id`, `image`, `name`, `description`, `point_1`, `point_2`, `point_3`, `point_4`) VALUES
(9, '668423567d50d.png', 'VR LAB', 'A VR lab, or Virtual Reality lab, holds significant importance due to its wide range of applications and benefits across various fields. Here are some reasons why VR labs are crucial and valuable', 'Enhanced Learning and Training.', 'Safe and Controlled Experiments.', 'Visualization and Design.', 'Therapeutic Applications.'),
(10, '668423f856071.jpg', 'ELECTRONICS LAB', 'An electronics lab is vital for engineers, students, and professionals, providing tools and equipment for designing, testing, and troubleshooting electronic circuits. Here are some key points highligh', 'Prototyping and Circuit Design', 'Educational Purposes', 'Product Development and Innovation', 'Testing and Quality Control'),
(11, '66842450a4d5a.png', 'FAB LAB', 'A Fab Lab, short for Fabrication Laboratory, is a high-tech workshop equipped with advanced tools and machinery for digital fabrication, prototyping, and creative projects, fostering innovation and ha', 'Product Design and Development', 'Education and Training', 'Material Testing and Analysis', 'Mechanical Testing and Quality Control'),
(12, '668424bbbd082.jpeg', 'MINE SIMULATION SPACE', 'My passion for innovation, strategic thinking, and strong interpersonal skills have been instrumental in driving project growth. Continuously striving to learn and adapt, I take pride in making a mean', 'Training and Skill Development', 'Safety Enhancement', 'Optimization and Efficiency', 'Equipment Testing and Validation:'),
(13, '668425101ffb8.jpeg', 'MINE AUTOMATION SPACE', 'Mine automation revolutionizes the mining industry by incorporating robotics and AI, enhancing safety, efficiency, and sustainability. It reduces human intervention and maximizes resource extraction. ', 'Enhanced Safety', 'Higher Efficiency', 'Sustainability', 'Reduced Labor'),
(14, '6684260e58bcf.jpg', 'Electronics And Sensor Space', 'Electronics and Sensor Space\" refers to the domain encompassing electronic devices and sensors. It plays a pivotal role in modern technology, with key applications in.\r\n\r\n', 'IoT and Smart Devices', 'Communication', 'Environmental Monitoring', 'Optimization and Efficiency'),
(15, '6687d7ea9c3f9.jpeg', 'test', 'description', 'p11', 'p22', 'p33', 'p44');

-- --------------------------------------------------------

--
-- Table structure for table `home_slider`
--

CREATE TABLE `home_slider` (
  `id` int(60) NOT NULL,
  `image` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `home_slider`
--

INSERT INTO `home_slider` (`id`, `image`) VALUES
(30, '668413bc9c2d0.png'),
(31, '668413f1de138.jpg'),
(32, '6687d7934af49.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `incubation`
--

CREATE TABLE `incubation` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `email` text NOT NULL,
  `mobile` text NOT NULL,
  `address` varchar(200) NOT NULL,
  `reg_company` text NOT NULL,
  `inv_received` text NOT NULL,
  `co_founder` int(11) NOT NULL,
  `proposal` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `incubation`
--

INSERT INTO `incubation` (`id`, `name`, `email`, `mobile`, `address`, `reg_company`, `inv_received`, `co_founder`, `proposal`) VALUES
(5, 'NEETISH', 'CSC.NEETISH@GMAIL.COM', '8746', 'abc@gmail.com', 'yes', 'no', 10, 'jkv'),
(6, 'NEETISH test', 'CSC.NEETISH@GMAIL.COM', '8746', 'abc@gmail.com', 'no', 'yes', 10, 'jkv');

-- --------------------------------------------------------

--
-- Table structure for table `portfolio`
--

CREATE TABLE `portfolio` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `company_name` text NOT NULL,
  `message` text NOT NULL,
  `image` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `portfolio`
--

INSERT INTO `portfolio` (`id`, `name`, `company_name`, `message`, `image`) VALUES
(7, 'Neetish Raj', 'ygu', 'gyuh', '668929c4bddae.jpeg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `about`
--
ALTER TABLE `about`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `home_labs_infra`
--
ALTER TABLE `home_labs_infra`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `home_slider`
--
ALTER TABLE `home_slider`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `incubation`
--
ALTER TABLE `incubation`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `portfolio`
--
ALTER TABLE `portfolio`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `about`
--
ALTER TABLE `about`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `contact`
--
ALTER TABLE `contact`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `home_labs_infra`
--
ALTER TABLE `home_labs_infra`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `home_slider`
--
ALTER TABLE `home_slider`
  MODIFY `id` int(60) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `incubation`
--
ALTER TABLE `incubation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `portfolio`
--
ALTER TABLE `portfolio`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
