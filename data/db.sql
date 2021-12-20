-- phpMyAdmin SQL Dump
-- version 4.6.6deb5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Dec 20, 2021 at 01:07 AM
-- Server version: 5.7.27-0ubuntu0.18.04.1
-- PHP Version: 7.4.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `fin_url_short`
--

-- --------------------------------------------------------

--
-- Table structure for table `short_links`
--

CREATE TABLE `short_links` (
  `id` int(11) NOT NULL,
  `code` varchar(30) NOT NULL,
  `url` text NOT NULL,
  `count` int(11) NOT NULL,
  `timestamp` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `short_links`
--
--Sample test records
INSERT INTO `short_links` (`id`, `code`, `url`, `count`, `timestamp`) VALUES
(1, 'LfbkwVB', 'https://www.amazon.in/Tata-Tea-Gold-1kg/dp/B00GLDJ9WA/?_encoding=UTF8&pd_rd_w=fE14a&pf_rd_p=7c8ac579-0ed8-49fc-9fbe-9483bdb819d3&pf_rd_r=N8H2VM8G5D5DQ2X2VQMY&pd_rd_r=f601e8a3-e140-4f6c-9dc8-d42d71561658&pd_rd_wg=5ulJx&ref_=pd_gw_trq_ed_j46mvn6n', 0, 1639920109),
(2, 'KYNhl63', 'https://www.amazon.in/mobile-phones/b/?ie=UTF8&node=1389401031&ref_=nav_cs_mobiles', 0, 1639940424);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `short_links`
--
ALTER TABLE `short_links`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `short_links`
--
ALTER TABLE `short_links`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;