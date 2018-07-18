-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 09, 2018 at 12:24 PM
-- Server version: 10.1.31-MariaDB
-- PHP Version: 7.2.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `valam_bhakti_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_aboutus`
--

CREATE TABLE `tbl_aboutus` (
  `id` varchar(10) NOT NULL,
  `notes` text NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '0=inactive, 1=active',
  `create_at` datetime NOT NULL,
  `create_by` varchar(10) NOT NULL,
  `update_at` datetime NOT NULL,
  `update_by` varchar(10) NOT NULL,
  `is_delete` tinyint(1) NOT NULL DEFAULT '1',
  `delete_at` datetime NOT NULL,
  `delete_by` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_aboutus`
--

INSERT INTO `tbl_aboutus` (`id`, `notes`, `status`, `create_at`, `create_by`, `update_at`, `update_by`, `is_delete`, `delete_at`, `delete_by`) VALUES
('16B94C03', '<strong style=\"margin: 0px; padding: 0px; font-family: &quot;Open Sans&quot;, Arial, sans-serif; text-align: justify;\">Lorem Ipsum</strong><span style=\"font-family: &quot;Open Sans&quot;, Arial, sans-serif; text-align: justify;\">&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</span>', 1, '2018-07-09 14:41:37', '1', '0000-00-00 00:00:00', '', 0, '2018-07-09 14:46:22', ''),
('37', '<p><strong style=\"margin: 0px; padding: 0px; font-family: &quot;Open Sans&quot;, Arial, sans-serif; text-align: justify;\">Lorem Ipsum</strong><span style=\"font-family: &quot;Open Sans&quot;, Arial, sans-serif; text-align: justify;\">&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</span><br></p>', 1, '2018-07-07 11:09:43', '1', '2018-07-09 11:19:55', '1', 0, '2018-07-09 14:38:03', ''),
('402BF1EE', '<p><span style=\"font-family: \" open=\"\" sans\",=\"\" arial,=\"\" sans-serif;=\"\" text-align:=\"\" justify;\"=\"\">It is a long <b>established </b>fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \'Content here, content here\', making it look like readable English. <b>Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy</b>. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).</span><br></p>', 1, '2018-07-09 14:49:22', '1', '2018-07-09 14:52:56', '1', 1, '0000-00-00 00:00:00', ''),
('8663D94C', '<span style=\"font-family: &quot;Open Sans&quot;, Arial, sans-serif; text-align: justify;\">Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of \"de Finibus Bonorum et Malorum\" (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, \"Lorem ipsum dolor sit amet..\", comes from a line in section 1.10.32.</span><br>', 1, '2018-07-09 11:50:25', '1', '2018-07-09 13:45:36', '1', 0, '2018-07-09 14:49:08', '');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_admin`
--

CREATE TABLE `tbl_admin` (
  `id` int(11) NOT NULL,
  `admin_name` varchar(100) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `role` varchar(20) NOT NULL COMMENT '1 = admin, 2 = sub-admin  '
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_admin`
--

INSERT INTO `tbl_admin` (`id`, `admin_name`, `email`, `password`, `role`) VALUES
(1, 'IBL Test', 'ibltest@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', '1');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_silder_photo`
--

CREATE TABLE `tbl_silder_photo` (
  `id` varchar(10) NOT NULL,
  `photo` varchar(50) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `create_by` datetime NOT NULL,
  `create_at` varchar(10) NOT NULL,
  `upadate_by` datetime NOT NULL,
  `update_by` varchar(10) NOT NULL,
  `is_delete` tinyint(4) NOT NULL DEFAULT '1',
  `delete_at` datetime NOT NULL,
  `delete_by` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_videos`
--

CREATE TABLE `tbl_videos` (
  `id` varchar(10) NOT NULL,
  `video_link` varchar(200) NOT NULL,
  `viedo_image` varchar(200) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1' COMMENT '0=inactive, 1=active',
  `create_at` datetime NOT NULL,
  `create_by` varchar(10) NOT NULL,
  `upadate_at` datetime NOT NULL,
  `update_by` varchar(10) NOT NULL,
  `is_delete` tinyint(4) NOT NULL DEFAULT '1',
  `delete_at` datetime NOT NULL,
  `delete_by` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_videos`
--

INSERT INTO `tbl_videos` (`id`, `video_link`, `viedo_image`, `status`, `create_at`, `create_by`, `upadate_at`, `update_by`, `is_delete`, `delete_at`, `delete_by`) VALUES
('0E2A55FB', 'https://www.youtube.com/watch?v=Isb1xmqFiWQ', 'Isb1xmqFiWQ_thumb.jpg', 1, '2018-07-04 17:53:27', '1', '0000-00-00 00:00:00', '', 0, '2018-07-04 18:08:55', ''),
('289FBF2C', 'https://www.youtube.com/watch?v=UX3YrOB_gQA', 'UX3YrOB_gQA_thumb.jpg', 1, '2018-07-06 14:03:04', '1', '0000-00-00 00:00:00', '', 0, '2018-07-06 14:04:27', ''),
('3065857C', 'https://www.youtube.com/watch?v=UX3YrOB_gQA', 'UX3YrOB_gQA_thumb.jpg', 1, '2018-07-04 18:10:43', '1', '0000-00-00 00:00:00', '', 0, '2018-07-04 18:12:18', ''),
('318A8B6D', 'https://www.youtube.com/watch?v=Isb1xmqFiWQ', 'Isb1xmqFiWQ_thumb.jpg', 1, '2018-07-04 17:47:08', '1', '0000-00-00 00:00:00', '', 0, '2018-07-04 18:08:56', ''),
('3331583F', 'https://www.youtube.com/watch?v=3SWc5G8Gx7E', '3SWc5G8Gx7E_thumb.jpg', 1, '2018-07-04 18:04:45', '1', '0000-00-00 00:00:00', '', 0, '2018-07-04 18:08:57', ''),
('4F16BEAB', 'https://www.youtube.com/watch?v=Isb1xmqFiWQ', 'Isb1xmqFiWQ_thumb.jpg', 1, '2018-07-04 17:58:03', '1', '0000-00-00 00:00:00', '', 0, '2018-07-04 18:08:58', ''),
('622789EA', 'https://www.youtube.com/watch?v=UX3YrOB_gQA', 'UX3YrOB_gQA_thumb.jpg', 1, '2018-07-04 17:59:44', '1', '0000-00-00 00:00:00', '', 0, '2018-07-04 18:08:59', ''),
('72B39A25', 'https://www.youtube.com/watch?v=UX3YrOB_gQA', 'UX3YrOB_gQA_thumb.jpg', 1, '2018-07-04 17:48:42', '1', '0000-00-00 00:00:00', '', 0, '2018-07-04 18:09:04', ''),
('88BF3813', 'https://www.youtube.com/watch?v=UX3YrOB_gQA', 'UX3YrOB_gQA_thumb.jpg', 1, '2018-07-04 18:34:25', '1', '0000-00-00 00:00:00', '', 0, '2018-07-06 13:57:35', ''),
('95842C15', 'https://www.youtube.com/watch?v=UX3YrOB_gQA', 'UX3YrOB_gQA_thumb.jpg', 1, '2018-07-06 14:04:35', '1', '0000-00-00 00:00:00', '', 1, '0000-00-00 00:00:00', ''),
('A0908436', 'https://www.youtube.com/watch?v=ij_0p_6qTss', 'ij_0p_6qTss_thumb.jpg', 1, '2018-07-04 17:50:55', '1', '0000-00-00 00:00:00', '', 0, '2018-07-04 18:09:06', ''),
('ADE2E1D4', 'https://www.youtube.com/watch?v=UX3YrOB_gQA', 'UX3YrOB_gQA_thumb.jpg', 1, '2018-07-04 13:03:45', '1', '0000-00-00 00:00:00', '', 0, '2018-07-04 17:33:18', ''),
('B57F58E6', 'https://www.youtube.com/watch?v=ij_0p_6qTss', 'ij_0p_6qTss_thumb.jpg', 1, '2018-07-04 18:01:33', '1', '0000-00-00 00:00:00', '', 0, '2018-07-04 18:09:08', ''),
('B78C27F7', 'https://www.youtube.com/watch?v=ij_0p_6qTss', 'ij_0p_6qTss_thumb.jpg', 1, '2018-07-04 18:11:10', '1', '0000-00-00 00:00:00', '', 0, '2018-07-06 13:55:14', ''),
('C2FB7611', 'https://www.youtube.com/watch?v=UX3YrOB_gQA', 'UX3YrOB_gQA_thumb.jpg', 1, '2018-07-04 17:58:52', '1', '0000-00-00 00:00:00', '', 0, '2018-07-04 18:09:22', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_aboutus`
--
ALTER TABLE `tbl_aboutus`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_silder_photo`
--
ALTER TABLE `tbl_silder_photo`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_videos`
--
ALTER TABLE `tbl_videos`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
