-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jan 05, 2017 at 03:35 AM
-- Server version: 10.1.19-MariaDB
-- PHP Version: 5.6.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `books_authors`
--

-- --------------------------------------------------------

--
-- Table structure for table `authors`
--

CREATE TABLE `authors` (
  `id` int(11) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `birthday` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `authors`
--

INSERT INTO `authors` (`id`, `first_name`, `last_name`, `phone`, `email`, `birthday`) VALUES
(1, 'a1', 'b1', '123', 'a@a.ro', '2016-12-01'),
(2, 'a2', 'b2', '2', 'b@b.ro', '2016-12-02'),
(3, 'a3', 'b3', '3', 'bb@b.ro', '2016-12-03'),
(9, 'sadasd', 'dasdasd', '31231231232131', 'a@a.cc', '2021-02-01');

-- --------------------------------------------------------

--
-- Table structure for table `author_book`
--

CREATE TABLE `author_book` (
  `id` int(11) NOT NULL,
  `id_author` int(11) NOT NULL,
  `id_book` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `author_book`
--

INSERT INTO `author_book` (`id`, `id_author`, `id_book`) VALUES
(48, 1, 2),
(49, 2, 2),
(50, 3, 2),
(51, 9, 2),
(52, 2, 3),
(53, 9, 4),
(72, 1, 0),
(73, 2, 0),
(74, 3, 0);

-- --------------------------------------------------------

--
-- Table structure for table `books`
--

CREATE TABLE `books` (
  `id` int(11) NOT NULL,
  `title` varchar(250) NOT NULL,
  `summary` text NOT NULL,
  `page_no` int(11) NOT NULL,
  `publication_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `books`
--

INSERT INTO `books` (`id`, `title`, `summary`, `page_no`, `publication_date`) VALUES
(1, 'book1', 'dfdsdsfsdfds', 12, '2016-12-01'),
(2, 'book2', 'dffgfdg dsfgv cxvxv', 4, '2016-12-02'),
(3, 'book3', 'asdasdasdasdasdas', 100, '2016-12-03'),
(4, 'book4', 'fdfdasfdsfsadf', 200, '2016-12-04');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `authors`
--
ALTER TABLE `authors`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `author_book`
--
ALTER TABLE `author_book`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `authors`
--
ALTER TABLE `authors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `author_book`
--
ALTER TABLE `author_book`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=81;
--
-- AUTO_INCREMENT for table `books`
--
ALTER TABLE `books`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;