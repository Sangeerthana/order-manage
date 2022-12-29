-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 29, 2022 at 09:21 AM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

--
-- Database: `digit_web`
--

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user` int(11) NOT NULL,
  `user_firstname` text DEFAULT NULL,
  `user_lastname` text DEFAULT NULL,
  `user_email` text DEFAULT NULL,
  `user_contact` int(11) DEFAULT NULL,
  `user_name` varchar(20) DEFAULT NULL,
  `user_password` text DEFAULT NULL,
  `user_branch` text DEFAULT NULL,
  `user_role` int(11) DEFAULT NULL,
  `created_at` date DEFAULT NULL,
  `updated_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user`, `user_firstname`, `user_lastname`, `user_email`, `user_contact`, `user_name`, `user_password`, `user_branch`, `user_role`, `created_at`, `updated_at`) VALUES
(1, 'thinushan', 'Ramesh', 'rameshthinushan@gmail.com', 763256327, 'thinu', '$2y$10$FEzvNAf46SDu1jYJc1dCgezJA4OODh57ZjdeTmvUqgPMIEqKRfbDG', 'Jaffna', 1, '2022-11-29', '2022-11-29');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;
