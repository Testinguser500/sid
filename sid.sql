-- phpMyAdmin SQL Dump
-- version 4.2.7.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jul 26, 2016 at 11:10 AM
-- Server version: 5.6.20
-- PHP Version: 5.5.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `sid`
--

-- --------------------------------------------------------

--
-- Table structure for table `categorys`
--

CREATE TABLE IF NOT EXISTS `categorys` (
`id` int(11) NOT NULL,
  `category_name` varchar(255) NOT NULL,
  `parent_id` int(11) NOT NULL,
  `description` text NOT NULL,
  `image` varchar(255) NOT NULL,
  `status` enum('Active','Inactive','','') NOT NULL,
  `user_id` int(11) NOT NULL,
  `is_delete` enum('0','1','','') NOT NULL,
  `meta_title` varchar(255) NOT NULL,
  `meta_description` varchar(255) NOT NULL,
  `meta_keyword` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=14 ;

--
-- Dumping data for table `categorys`
--

INSERT INTO `categorys` (`id`, `category_name`, `parent_id`, `description`, `image`, `status`, `user_id`, `is_delete`, `meta_title`, `meta_description`, `meta_keyword`, `created_at`, `updated_at`) VALUES
(1, 'gdfgdg', 3, '<h2>sdasad<br/></h2>', '1469019688.png', 'Active', 1, '0', 'dsad', 'sadsad', 'sadsad', '2016-07-11 07:41:35', '2016-07-21 02:05:18'),
(3, 'zx', 0, '<p>xzcxzc<br></p>', '96112.png', 'Inactive', 1, '0', '', '', '', '2016-07-12 23:37:55', '2016-07-12 23:37:55'),
(5, 'sas', 0, '<p>saa<br></p>', '44498.png', 'Inactive', 1, '1', '', '', '', '2016-07-13 00:09:55', '2016-07-13 01:29:45'),
(6, 'fdsf', 1, 'mnbmbn', 'image', 'Active', 1, '0', 'fdsf', 'hjghjj', 'jghjnbmnbmm', '2016-07-19 07:05:16', '2016-07-19 07:05:16'),
(7, 'gfhfgh', 3, 'vbnvbnvbn', 'image', 'Inactive', 1, '0', 'hfghgfh', 'nvnvbn', 'nvbn', '2016-07-19 07:05:40', '2016-07-19 07:05:40'),
(8, 'dfffsdf', 1, 'dfdsf', 'image', 'Inactive', 1, '1', 'dsfdsfdf', 'sfdsfdsfds', 'dfsfdsf', '2016-07-19 07:07:09', '2016-07-19 07:36:31'),
(9, 'vxvccx', 0, 'vccxv', 'image', 'Inactive', 1, '1', 'vcxcxv', 'cxvcxv', 'cxvcxvvcx', '2016-07-19 07:12:23', '2016-07-19 07:35:07'),
(10, 'fgg', 0, 'fgfdg', 'image', 'Active', 1, '1', 'dfgdfg', 'fdgfdg', 'dfgfdg', '2016-07-19 07:13:09', '2016-07-19 07:34:51'),
(11, 'dfgdfg', 0, 'fdgfdg', 'image', 'Active', 1, '1', 'gfdg', 'dgdfg', 'dfgdfg', '2016-07-19 07:14:43', '2016-07-19 07:31:24'),
(12, 'dsfs', 3, '<p>fdsf</p>', '0', 'Active', 1, '0', 'fdsf', 'sfdsf', 'dsfdsf', '2016-07-20 04:07:06', '2016-07-21 02:05:02'),
(13, 'njhgj', 3, '<p>jhgj</p>', '1469007634.jpg', 'Active', 1, '0', 'ghjhg', 'hgj', 'ghjhgj', '2016-07-20 04:10:37', '2016-07-20 04:10:37');

-- --------------------------------------------------------

--
-- Table structure for table `configs`
--

CREATE TABLE IF NOT EXISTS `configs` (
`id` int(11) NOT NULL,
  `key` varchar(255) NOT NULL,
  `value` varchar(255) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `configs`
--

INSERT INTO `configs` (`id`, `key`, `value`, `updated_at`, `created_at`) VALUES
(1, 'Site Name', 'Shop in Discount', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(2, 'E-mail', 'testinguser500@gmail.com', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(3, 'Address Line 1', 'Address Line 1', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(4, 'Address Line 2', 'Address Line 2', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(5, 'Phone No', '9080446241', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(6, 'Website', 'http://infoseeksoftwaresystems.com/staging/SID/design/Shopindiscount/', '2016-07-21 08:16:40', '0000-00-00 00:00:00'),
(7, 'Copyright', 'Copyright © 2016-2017 Shop in Discount. All rights reserved. ', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(8, 'SMTP Host', 'mail.supremecluster.com', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(9, 'SMTP User', 'test@infoseeksoftwaresystems.com', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(10, 'SMTP Password', 'kae8W37rNV', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(11, 'SMTP Port', '25', '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `email_msgs`
--

CREATE TABLE IF NOT EXISTS `email_msgs` (
`id` int(11) NOT NULL,
  `email_section` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email_subject` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email_body` text COLLATE utf8_unicode_ci NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=6 ;

--
-- Dumping data for table `email_msgs`
--

INSERT INTO `email_msgs` (`id`, `email_section`, `email_subject`, `email_body`, `updated_at`, `created_at`) VALUES
(1, 'Registration', 'Welcome to {site_name}', '<table border="0" style="width:100%"> <tbody>  <tr>   <td colspan="2"><strong>Hi {name},</strong></td>  </tr>  <tr>   <td colspan="2">We are happy to have you as the {role} of {site_name}!</td>  </tr>  <tr>   <td colspan="2">This is a registration email as per the details submitted by you. You are now registered as {role} on {site_name} with the following details:</td>  </tr>  <tr>   <td colspan="2">&nbsp;</td>  </tr>  <tr>   <td><strong>Email ID:</strong></td>   <td>{username}</td>  </tr>  <tr>   <td><strong>Password:</strong></td>   <td>{password}</td>  </tr>  <tr>   <td colspan="2">&nbsp;</td>  </tr>  <tr>   <td colspan="2">{link}</td>  </tr>  <tr>   <td colspan="2">&nbsp;</td>  </tr>  <tr>   <td colspan="2">Thanks again. We hope you will visit us again soon and put these special services to work for you.<br />   Please feel free to contact us if you have any questions at all.</td>  </tr>  <tr>   <td colspan="2">&nbsp;</td>  </tr>  <tr>   <td colspan="2">Thank you.<br />   </td>  </tr>  <tr>   <td colspan="2" style="text-align:center">{copyright}</td>  </tr> </tbody></table>', '2016-07-15 10:48:30', '0000-00-00 00:00:00'),
(5, 'Template', 'Temaplate Subject', '<table border="0" style="width:100%"> <tbody>  <tr>   <td colspan="2">{content}</td>  </tr>  <tr>   <td colspan="2">&nbsp;</td>  </tr>  <tr>   <td colspan="2">Thanks again. We hope you will visit us again soon and put these special services to work for you.<br />   Please feel free to contact us if you have any questions at all.</td>  </tr>  <tr>   <td colspan="2">&nbsp;</td>  </tr>  <tr>   <td colspan="2">Thank you.<br />   </td>  </tr>  <tr>   <td colspan="2" style="text-align:center">{copyright}</td>  </tr> </tbody></table>', '2016-07-15 10:48:18', '2016-07-14 18:30:00'),
(3, 'Forgot Password', 'Forgot Password', '<table border="0" style="width:100%"> <tbody>  <tr>   <td colspan="2"><strong>Hi {name},</strong></td>  </tr>  <tr>   <td colspan="2">Your login details are as follows:</td>  </tr>  <tr>   <td colspan="2">&nbsp;</td>  </tr>  <tr>   <td><strong>Email ID:</strong></td>   <td>{username}</td>  </tr>  <tr>   <td><strong>password:</strong></td>   <td>{password}</td>  </tr>  <tr>   <td colspan="2">&nbsp;</td>  </tr>  <tr>   <td colspan="2">Click here to login {link}</td>  </tr>  <tr>   <td colspan="2">&nbsp;</td>  </tr>  <tr>   <td colspan="2">Thank you.<br />   </td>  </tr>  <tr>   <td colspan="2" style="text-align:center">{copyright}</td>  </tr> </tbody></table>', '2016-07-15 10:48:13', '0000-00-00 00:00:00'),
(2, 'Registration Mail to Admin', 'A new {role} has been registered at {site_name}', '<table border="0" style="width:100%"> <tbody>  <tr>   <td colspan="2"><strong>Dear Admin,</strong></td>  </tr>  <tr>   <td colspan="2">A new {role} has been registered at the site with following login details</td>  </tr>  <tr>   <td colspan="2">&nbsp;</td>  </tr>  <tr>   <td><strong>Email ID:</strong></td>   <td>{username}</td>  </tr>  <tr>   <td><strong>Password:</strong></td>   <td>{password}</td>  </tr>  <tr>   <td colspan="2">&nbsp;</td>  </tr>  <tr>   <td colspan="2">Thank you.<br />  </td>  </tr>  <tr>   <td colspan="2" style="text-align:center">{copyright}</td>  </tr> </tbody></table>', '2016-07-15 10:48:02', '0000-00-00 00:00:00'),
(4, 'Change Password', 'Change Password at {site_name}', '<table border="0" style="width:100%"> <tbody>  <tr>   <td colspan="2"><strong>Dear {name},</strong></td>  </tr>  <tr>   <td colspan="2">Your password has been changed.</td>  </tr>   <tr>   <td colspan="2">&nbsp;</td>  </tr>   <tr>   <td colspan="2">Now your login detail is : </td>  </tr>  <tr>   <td colspan="2">&nbsp;</td>  </tr>  <tr>   <td><strong>Email ID:</strong></td>   <td>{username}</td>  </tr>  <tr>   <td><strong>Password:</strong></td>   <td>{password}</td>  </tr>  <tr>   <td colspan="2">&nbsp;</td>  </tr>  <tr>   <td colspan="2">Thank you.<br />  </td>  </tr>  <tr>   <td colspan="2" style="text-align:center">{copyright}</td>  </tr> </tbody></table>', '2016-07-15 10:46:51', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `faqs`
--

CREATE TABLE IF NOT EXISTS `faqs` (
`id` int(11) NOT NULL,
  `quest` varchar(255) NOT NULL,
  `ans` text NOT NULL,
  `status` enum('Active','Inactive','','') NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `faqs`
--

INSERT INTO `faqs` (`id`, `quest`, `ans`, `status`, `created_at`, `updated_at`) VALUES
(4, 'hjgjhj', '<h3>hgjghj</h3>', 'Inactive', '2016-07-21 05:20:09', '2016-07-21 07:20:54'),
(6, 'dsfdsf', '<h3>fdsfds</h3>', 'Inactive', '2016-07-21 07:21:51', '2016-07-21 07:21:51');

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE IF NOT EXISTS `menu` (
`menu_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `icon` varchar(255) NOT NULL,
  `filename` varchar(255) NOT NULL,
  `pid` int(11) NOT NULL,
  `order_no` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`menu_id`, `name`, `icon`, `filename`, `pid`, `order_no`, `created_at`, `updated_at`) VALUES
(1, 'User Management', 'fa-user', 'user', 0, 1, '2016-07-14 09:23:32', '0000-00-00 00:00:00'),
(2, 'Static Content Management', 'fa-table', 'static-content', 0, 2, '2016-07-14 09:25:32', '0000-00-00 00:00:00'),
(3, 'Banner Management', 'fa-picture-o', 'banner', 0, 3, '2016-07-14 09:25:32', '0000-00-00 00:00:00'),
(4, 'Category Management', 'fa-cubes', 'category', 0, 4, '2016-07-14 09:27:50', '0000-00-00 00:00:00'),
(5, 'Brand', 'fa-th', 'brand', 0, 5, '2016-07-14 09:28:25', '0000-00-00 00:00:00'),
(6, 'Newsletter', 'fa-paper-plane', 'newsletter', 0, 6, '2016-07-14 09:30:17', '2016-07-21 13:07:56'),
(7, 'Configuration', 'fa-cogs', 'config', 0, 7, '2016-07-14 09:30:17', '0000-00-00 00:00:00'),
(10, 'Seller Management', 'fa-users', 'seller', 0, 8, '2016-07-14 10:37:33', '0000-00-00 00:00:00'),
(11, 'FAQ', 'fa-question', 'faq', 0, 9, '2016-07-20 18:30:00', '2016-07-21 13:04:40');

-- --------------------------------------------------------

--
-- Table structure for table `newsletters`
--

CREATE TABLE IF NOT EXISTS `newsletters` (
`id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `mob_no` varchar(255) NOT NULL,
  `occupation` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `gender` enum('male','female','','') NOT NULL,
  `subscribe` enum('1','0','','') NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=19 ;

--
-- Dumping data for table `newsletters`
--

INSERT INTO `newsletters` (`id`, `name`, `email`, `mob_no`, `occupation`, `city`, `gender`, `subscribe`, `created_at`, `updated_at`) VALUES
(1, 'Test', 'tset@test.com', '321321321', 'sdas scsd', 'dsads', 'male', '1', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(2, 'xzcz cx', 'czx@assad.sdsa', '12321321', 'sadc sc ', 'sdasd', 'female', '0', '0000-00-00 00:00:00', '2016-07-21 02:09:22'),
(3, 'sdf', 'dfs@sddd.dsad', '4343', 'dfsf', 'dfdsf', 'male', '1', '2016-07-22 08:06:31', '2016-07-22 08:06:31'),
(4, 'fdsf', 'fdsds@dsas.asdsa', '321323', 'sdffds', 'fdfdf', 'male', '1', '2016-07-22 08:10:15', '2016-07-22 08:10:15'),
(5, 'dsfdf', 'sddsf@dsd.cz', '3213', 'fdsf', 'dfds', 'male', '1', '2016-07-22 08:16:38', '2016-07-22 08:16:38'),
(6, 'dgdg', 'dfg@sad.sada', '134324', 'dfdsf', 'fdsf', 'male', '1', '2016-07-22 08:17:44', '2016-07-22 08:17:44'),
(7, 'dsa', 'dsf@sdddsa.sdsa', '2313213', 'cvdsf', 'dfdsf', 'male', '1', '2016-07-22 08:23:00', '2016-07-22 08:23:00'),
(8, 'hfghf', 'hf@sda.cxz', '123', 'dsa', 'sdsa', 'male', '1', '2016-07-22 08:27:33', '2016-07-22 08:27:33'),
(17, 'asd', 'dsa@ds.sda', '3213', 'dsad', 'sdad', 'male', '1', '2016-07-25 00:38:48', '2016-07-25 00:38:48'),
(18, 'sad', 'df@dssa.dsf', '2323', 'fdsdf', 'fds', 'female', '1', '2016-07-25 00:39:03', '2016-07-25 00:39:03');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
`id` int(10) unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `gender` enum('male','female') COLLATE utf8_unicode_ci NOT NULL,
  `address` text COLLATE utf8_unicode_ci NOT NULL,
  `status` enum('Active','Inactive') COLLATE utf8_unicode_ci NOT NULL,
  `role` int(11) NOT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `gender`, `address`, `status`, `role`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'admin@admin.com', '$2y$10$e5Fl5JdSca7tgZ1lDw7FBuvNT674NBU63V3mqB/YDsIXP9wYp9N/O', 'male', '', 'Active', 1, 'Xa6uavOOqMY8hYr23jp89XyuPrgHQpuws6KCeOBpIkJQvXlS2vbzvoU1WRGG', NULL, '2016-07-20 04:58:20');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categorys`
--
ALTER TABLE `categorys`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `configs`
--
ALTER TABLE `configs`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `email_msgs`
--
ALTER TABLE `email_msgs`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `faqs`
--
ALTER TABLE `faqs`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `menu`
--
ALTER TABLE `menu`
 ADD PRIMARY KEY (`menu_id`);

--
-- Indexes for table `newsletters`
--
ALTER TABLE `newsletters`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categorys`
--
ALTER TABLE `categorys`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `configs`
--
ALTER TABLE `configs`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `email_msgs`
--
ALTER TABLE `email_msgs`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `faqs`
--
ALTER TABLE `faqs`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `menu`
--
ALTER TABLE `menu`
MODIFY `menu_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `newsletters`
--
ALTER TABLE `newsletters`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
