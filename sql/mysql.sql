-- phpMyAdmin SQL Dump
-- version 4.4.15.10
-- https://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Nov 07, 2018 at 09:14 AM
-- Server version: 5.5.60-MariaDB
-- PHP Version: 5.6.38

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `haci`
--

-- --------------------------------------------------------

--
-- Table structure for table `app_nav_menu`
--

CREATE TABLE IF NOT EXISTS `app_nav_menu` (
  `nav_menu_id` int(11) NOT NULL,
  `nav_menu_name` varchar(128) NOT NULL,
  `nav_menu_location` varchar(128) NOT NULL,
  `nav_menu_sort` int(11) NOT NULL,
  `nav_menu_icon` varchar(128) NOT NULL,
  `nav_menu_module` varchar(64) NOT NULL,
  `nav_menu_link` varchar(128) NOT NULL,
  `nav_menu_parent_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `app_nav_menu`
--

INSERT INTO `app_nav_menu` (`nav_menu_id`, `nav_menu_name`, `nav_menu_location`, `nav_menu_sort`, `nav_menu_icon`, `nav_menu_module`, `nav_menu_link`, `nav_menu_parent_id`, `created_at`, `updated_at`) VALUES
(1, 'Dashboard', 'sidebar_admin_menu', 0, 'fa fa-dashboard', 'dashboard', '#', 0, '2018-10-02 20:36:32', '2018-10-02 20:36:32'),
(2, 'Dashboard v1', 'sidebar_admin_menu', 1, 'fa fa-dashboard', 'dashboard', 'dashboard', 1, '2018-10-02 20:42:12', '2018-10-02 20:42:12'),
(3, 'Dashboard v2', 'sidebar_admin_menu', 2, 'fa fa-circle-o', 'dashboard', '#', 1, '2018-10-03 10:25:17', '2018-10-03 10:25:17'),
(4, 'Users', 'sidebar_admin_menu', 3, 'fa fa-users', 'users', '#', 0, '2018-10-03 10:29:50', '2018-10-03 10:29:50'),
(5, 'Multilevel', 'sidebar_admin_menu', 1, 'fa fa-share', '', '#', 0, '2018-10-03 14:03:00', '2018-10-03 14:03:00'),
(6, 'Level One', 'sidebar_admin_menu', 2, 'fa fa-circle-o', '', '#', 5, '2018-10-03 14:03:00', '2018-10-03 14:03:00'),
(7, 'Level One ', 'sidebar_admin_menu', 3, 'fa fa-circle-o', '', '#', 5, '2018-10-03 14:03:00', '2018-10-03 14:03:00'),
(8, 'Level Two', 'sidebar_admin_menu', 4, 'fa fa-circle-o', '', '#', 7, '2018-10-03 14:03:00', '2018-10-03 14:03:00'),
(9, 'Level Two', 'sidebar_admin_menu', 5, 'fa fa-circle-o', '', '#', 7, '2018-10-03 14:03:00', '2018-10-03 14:03:00'),
(10, 'Level Three', 'sidebar_admin_menu', 6, 'fa fa-circle-o', '', '#', 9, '2018-10-03 14:03:00', '2018-10-03 14:03:00'),
(11, 'Level Three', 'sidebar_admin_menu', 7, 'fa fa-circle-o', '', '#', 9, '2018-10-03 14:03:00', '2018-10-03 14:03:00'),
(12, 'Level One', 'sidebar_admin_menu', 8, 'fa fa-circle-o', '', '#', 5, '2018-10-03 14:03:00', '2018-10-03 14:03:00'),
(13, 'Users', 'sidebar_admin_menu', 0, 'fa fa-circle-o', 'users', 'users', 4, '2018-10-03 10:29:50', '2018-10-03 10:29:50'),
(14, 'Add User', 'sidebar_admin_menu', 1, 'fa fa-circle-o', 'users', 'users/add', 4, '2018-10-03 10:29:50', '2018-10-03 10:29:50'),
(15, 'Groups', 'sidebar_admin_menu', 0, 'fa fa-circle-o', 'users', 'users/groups', 4, '2018-10-03 10:29:50', '2018-10-03 10:29:50'),
(16, 'Add Group', 'sidebar_admin_menu', 1, 'fa fa-circle-o', 'users', 'users/groups/add', 4, '2018-10-03 10:29:50', '2018-10-03 10:29:50');

-- --------------------------------------------------------

--
-- Table structure for table `app_setting`
--

CREATE TABLE IF NOT EXISTS `app_setting` (
  `setting_id` int(11) NOT NULL,
  `setting_name` varchar(128) NOT NULL,
  `setting_value` longtext NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `app_setting`
--

INSERT INTO `app_setting` (`setting_id`, `setting_name`, `setting_value`, `created_at`, `updated_at`) VALUES
(1, 'title_admin_name', 'Haci App', '2018-09-17 10:00:05', '2018-09-17 10:00:05'),
(2, 'title_public_name', 'Homepage Haci', '2018-09-17 10:11:07', '2018-09-17 10:11:07'),
(3, 'admin_theme', 'adminlte', '2018-09-19 13:53:52', '2018-09-19 13:53:52'),
(4, 'public_theme', 'madedesign', '2018-09-19 13:54:19', '2018-09-19 13:54:19');

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

CREATE TABLE IF NOT EXISTS `groups` (
  `id` mediumint(8) unsigned NOT NULL,
  `name` varchar(20) NOT NULL,
  `description` varchar(100) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `groups`
--

INSERT INTO `groups` (`id`, `name`, `description`) VALUES
(1, 'admin', 'Administrator'),
(2, 'members', 'General User');

-- --------------------------------------------------------

--
-- Table structure for table `login_attempts`
--

CREATE TABLE IF NOT EXISTS `login_attempts` (
  `id` int(11) unsigned NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `login` varchar(100) NOT NULL,
  `time` int(11) unsigned DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) unsigned NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `username` varchar(100) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `salt` varchar(255) DEFAULT NULL,
  `email` varchar(254) NOT NULL,
  `activation_code` varchar(40) DEFAULT NULL,
  `forgotten_password_code` varchar(40) DEFAULT NULL,
  `forgotten_password_time` int(11) unsigned DEFAULT NULL,
  `remember_code` varchar(40) DEFAULT NULL,
  `created_on` int(11) unsigned NOT NULL,
  `last_login` int(11) unsigned DEFAULT NULL,
  `active` tinyint(1) unsigned DEFAULT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `company` varchar(100) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `ip_address`, `username`, `password`, `salt`, `email`, `activation_code`, `forgotten_password_code`, `forgotten_password_time`, `remember_code`, `created_on`, `last_login`, `active`, `first_name`, `last_name`, `company`, `phone`) VALUES
(1, '127.0.0.1', 'administrator', '$2a$07$SeBknntpZror9uyftVopmu61qg0ms8Qv1yV6FG.kQOSM.9QhmTo36', '', 'admin@admin.com', '', 'D-j0b-uyPpBQeKbK.m1V5ua6275b1686e272741b', 1538277911, '0y7Qy6s0HP5C3nMziMMTx.', 1268889823, 1541331596, 1, 'Administrator', 'Haci', 'ADMIN', '0'),
(2, '192.168.188.1', 'taufik.arief.widodo@gmail.com', '$2y$08$7jkYHN0I7inbiqBL7qoXMuw3sS/0ZybQ0VVZvA5LKKPbTPAsJ5VoO', NULL, 'taufik.arief.widodo@gmail.com', NULL, NULL, NULL, NULL, 1539920091, 1540636229, 1, 'Cak', 'Topik', 'caktopik.id', '0');

-- --------------------------------------------------------

--
-- Table structure for table `users_groups`
--

CREATE TABLE IF NOT EXISTS `users_groups` (
  `id` int(11) unsigned NOT NULL,
  `user_id` int(11) unsigned NOT NULL,
  `group_id` mediumint(8) unsigned NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users_groups`
--

INSERT INTO `users_groups` (`id`, `user_id`, `group_id`) VALUES
(1, 1, 1),
(2, 1, 2),
(26, 2, 1),
(27, 2, 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `app_nav_menu`
--
ALTER TABLE `app_nav_menu`
  ADD PRIMARY KEY (`nav_menu_id`);

--
-- Indexes for table `app_setting`
--
ALTER TABLE `app_setting`
  ADD PRIMARY KEY (`setting_id`);

--
-- Indexes for table `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `login_attempts`
--
ALTER TABLE `login_attempts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users_groups`
--
ALTER TABLE `users_groups`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uc_users_groups` (`user_id`,`group_id`),
  ADD KEY `fk_users_groups_users1_idx` (`user_id`),
  ADD KEY `fk_users_groups_groups1_idx` (`group_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `app_nav_menu`
--
ALTER TABLE `app_nav_menu`
  MODIFY `nav_menu_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT for table `app_setting`
--
ALTER TABLE `app_setting`
  MODIFY `setting_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `groups`
--
ALTER TABLE `groups`
  MODIFY `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `login_attempts`
--
ALTER TABLE `login_attempts`
  MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `users_groups`
--
ALTER TABLE `users_groups`
  MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=28;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `users_groups`
--
ALTER TABLE `users_groups`
  ADD CONSTRAINT `fk_users_groups_groups1` FOREIGN KEY (`group_id`) REFERENCES `groups` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_users_groups_users1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
