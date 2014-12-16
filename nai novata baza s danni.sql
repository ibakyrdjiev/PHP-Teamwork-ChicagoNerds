-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Dec 16, 2014 at 11:18 AM
-- Server version: 5.6.21
-- PHP Version: 5.5.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `test`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE IF NOT EXISTS `categories` (
`cat_id` int(8) NOT NULL,
  `cat_name` varchar(255) CHARACTER SET utf8 NOT NULL,
  `cat_description` varchar(255) NOT NULL,
  `cat_date` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`cat_id`, `cat_name`, `cat_description`, `cat_date`) VALUES
(34, 'saidasd', 'jiaodsjiosd', '2014-12-14 14:39:46'),
(35, 'ÑÐ¼Ð°Ð»ÐºÐ´Ð°ÑÐ»Ð¼', 'Ð»ÐºÐ°Ð´ÑÐ¼ÑÐ´Ð°Ð»ÐºÐ¼ÐºÐ´Ñ', '2014-12-14 18:44:12'),
(36, 'asdasdasd', 'asdasdasdasdasdasdasd', '2014-12-15 17:37:09');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE IF NOT EXISTS `posts` (
`post_id` int(8) NOT NULL,
  `post_content` text NOT NULL,
  `post_date` datetime NOT NULL,
  `post_topic` int(8) NOT NULL,
  `post_by` int(8) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`post_id`, `post_content`, `post_date`, `post_topic`, `post_by`) VALUES
(17, 'asdsad', '2014-12-14 14:39:52', 11, 34),
(18, 'sadoijsadio', '2014-12-14 14:42:24', 11, 34),
(19, 'sadajid', '2014-12-14 16:30:08', 11, 34),
(20, 'sadnasdnkj', '2014-12-14 16:30:16', 11, 34),
(21, 'sjdaiojdsaio', '2014-12-14 18:41:05', 12, 34),
(22, 'Ð°Ð¹Ð´Ð¾ÑÐ¸Ð¹ÑÐ°Ð´Ð¸Ð¾', '2014-12-14 18:43:55', 13, 34),
(23, 'ÑÐ°Ð´Ð»ÐºÐ°ÑÐ´Ð¼', '2014-12-14 18:44:25', 13, 34),
(24, 'kurami\r\n', '2014-12-14 20:32:56', 14, 34),
(25, 'adsasd', '2014-12-14 20:32:56', 15, 34),
(26, '<script>alert("hello")</script>\r\n', '2014-12-15 07:45:29', 14, 34),
(27, '<script>alert("hello")</script>\r\n', '2014-12-15 07:45:59', 14, 34),
(28, '			asdsasdasdadsdasdsadas', '2014-12-15 17:36:58', 16, 34),
(29, '34', '2014-12-16 11:55:22', 17, 34),
(30, '34', '2014-12-16 12:16:25', 18, 34),
(31, 'Ð¹Ð´Ð°Ð¸ÑÐ¾Ð¹Ð´Ð¸Ð¾Ð°', '2014-12-16 12:16:45', 18, 34);

-- --------------------------------------------------------

--
-- Table structure for table `topics`
--

CREATE TABLE IF NOT EXISTS `topics` (
`topic_id` int(8) NOT NULL,
  `topic_subject` varchar(255) NOT NULL,
  `topic_date` datetime NOT NULL,
  `topic_cat` int(8) NOT NULL,
  `topic_by` int(8) NOT NULL,
  `topic_seen` int(255) NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `topics`
--

INSERT INTO `topics` (`topic_id`, `topic_subject`, `topic_date`, `topic_cat`, `topic_by`, `topic_seen`) VALUES
(11, 'asdasd', '2014-12-14 14:39:52', 34, 34, 0),
(12, 'jadsij', '2014-12-14 18:41:05', 34, 34, 0),
(13, 'ÑÐ°Ð¹Ð´Ð°Ð¸ÑÐ¾Ð¹ÑÐ°Ð´Ð¸Ð¾Ð¹Ð´Ð°ÑÐ¾Ð¸', '2014-12-14 18:43:55', 34, 34, 0),
(14, 'asd', '2014-12-14 20:32:56', 34, 34, 4),
(15, 'asd', '2014-12-14 20:32:56', 34, 34, 0),
(16, 'asdasdasd', '2014-12-15 17:36:58', 34, 34, 9),
(17, 'saidjasi', '2014-12-16 11:55:22', 34, 34, 52),
(18, 'ÑÐ°Ð´Ð¸Ð¾Ð¹Ð°ÑÐ´Ð¸Ð¾Ð¹', '2014-12-16 12:16:25', 34, 34, 3);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
`user_id` int(8) NOT NULL,
  `user_name` varchar(30) NOT NULL,
  `user_pass` varchar(255) NOT NULL,
  `user_email` varchar(255) NOT NULL,
  `user_date` datetime NOT NULL,
  `user_level` int(8) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `user_name`, `user_pass`, `user_email`, `user_date`, `user_level`) VALUES
(34, 'admin', 'd033e22ae348aeb5660fc2140aec35850c4da997', 'admin@admin.com', '2014-12-13 14:06:05', 1),
(35, 'MinkaSvirkata', '8cb2237d0679ca88db6464eac60da96345513964', 'minka@minka', '2014-12-13 16:19:46', 0),
(36, 'Jorko', '62ba8ae93107a8cf4676c166274b4b2330fc6366', 'georgi_velchev@mail.bg', '2014-12-13 16:23:11', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
 ADD PRIMARY KEY (`cat_id`), ADD UNIQUE KEY `cat_name` (`cat_name`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
 ADD PRIMARY KEY (`post_id`), ADD KEY `post_topic` (`post_topic`), ADD KEY `post_by` (`post_by`);

--
-- Indexes for table `topics`
--
ALTER TABLE `topics`
 ADD PRIMARY KEY (`topic_id`), ADD KEY `topic_cat` (`topic_cat`), ADD KEY `topic_by` (`topic_by`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
 ADD PRIMARY KEY (`user_id`), ADD UNIQUE KEY `user_name` (`user_name`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
MODIFY `cat_id` int(8) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=37;
--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
MODIFY `post_id` int(8) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=32;
--
-- AUTO_INCREMENT for table `topics`
--
ALTER TABLE `topics`
MODIFY `topic_id` int(8) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
MODIFY `user_id` int(8) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=37;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `posts`
--
ALTER TABLE `posts`
ADD CONSTRAINT `posts_ibfk_1` FOREIGN KEY (`post_topic`) REFERENCES `topics` (`topic_id`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `posts_ibfk_2` FOREIGN KEY (`post_by`) REFERENCES `users` (`user_id`) ON UPDATE CASCADE,
ADD CONSTRAINT `posts_ibfk_3` FOREIGN KEY (`post_topic`) REFERENCES `topics` (`topic_id`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `posts_ibfk_4` FOREIGN KEY (`post_by`) REFERENCES `users` (`user_id`) ON UPDATE CASCADE;

--
-- Constraints for table `topics`
--
ALTER TABLE `topics`
ADD CONSTRAINT `topics_ibfk_1` FOREIGN KEY (`topic_cat`) REFERENCES `categories` (`cat_id`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `topics_ibfk_2` FOREIGN KEY (`topic_by`) REFERENCES `users` (`user_id`) ON UPDATE CASCADE,
ADD CONSTRAINT `topics_ibfk_3` FOREIGN KEY (`topic_cat`) REFERENCES `categories` (`cat_id`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `topics_ibfk_4` FOREIGN KEY (`topic_by`) REFERENCES `users` (`user_id`) ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
