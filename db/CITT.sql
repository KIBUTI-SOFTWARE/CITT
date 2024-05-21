-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Jul 15, 2023 at 04:01 PM
-- Server version: 5.7.34
-- PHP Version: 8.0.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `CITT`
--

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `category_id` varchar(20) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` json NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1' COMMENT '0-Inactive\r\n1-Active',
  `created_by` varchar(20) NOT NULL,
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted_by` varchar(20) DEFAULT NULL,
  `deleted_on` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `deleted_flag` tinyint(4) DEFAULT '0' COMMENT '0-Not Deleted\r\n1-Deleted'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `category_id`, `name`, `description`, `status`, `created_by`, `created_on`, `updated_on`, `deleted_by`, `deleted_on`, `deleted_flag`) VALUES
(1, 'CT230608560006322', 'UNDP', '\"Test Categoryggg\"', 1, 'US221202353908764', '2023-06-08 07:20:28', '2023-06-09 08:36:19', NULL, NULL, 0),
(2, 'CT230609076008275', 'MAKISATU', '\"MAKISATU Events\"', 1, 'US221202353908764', '2023-06-09 08:36:03', '2023-06-09 08:36:03', NULL, '2023-06-09 08:36:03', 0);

-- --------------------------------------------------------

--
-- Table structure for table `colleges`
--

CREATE TABLE `colleges` (
  `id` int(11) NOT NULL,
  `college_id` varchar(20) NOT NULL,
  `college_name` varchar(200) NOT NULL,
  `short_name` varchar(15) NOT NULL,
  `departments` json DEFAULT NULL,
  `others` json DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1' COMMENT '0-Inactive\r\n1-Active',
  `created_by` varchar(20) NOT NULL,
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted_flag` tinyint(4) NOT NULL DEFAULT '0' COMMENT '0-Not Deleted\r\n1-Deleted',
  `deleted_on` timestamp NULL DEFAULT NULL,
  `deleted_by` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `colleges`
--

INSERT INTO `colleges` (`id`, `college_id`, `college_name`, `short_name`, `departments`, `others`, `status`, `created_by`, `created_on`, `updated_on`, `deleted_flag`, `deleted_on`, `deleted_by`) VALUES
(1, 'CO230610556604055', 'College of Information and Communication Technology', 'CoICT', '{\"DP230610511601475\": \"IST\", \"DP230610697109772\": \"DCE\"}', '\"Test College\"', 1, 'US221202353908764', '2023-06-10 04:28:44', '2023-06-10 05:40:24', 0, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `id` int(11) NOT NULL,
  `event_id` varchar(20) NOT NULL,
  `event_name` varchar(250) NOT NULL,
  `projects` json NOT NULL,
  `event_leader` varchar(20) NOT NULL,
  `starts_on` date NOT NULL,
  `ends_on` date NOT NULL,
  `event_description` json NOT NULL,
  `created_by` int(11) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `deleted_flag` tinyint(4) NOT NULL DEFAULT '0',
  `deleted_on` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `deleted_by` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`id`, `event_id`, `event_name`, `projects`, `event_leader`, `starts_on`, `ends_on`, `event_description`, `created_by`, `status`, `created_on`, `deleted_flag`, `deleted_on`, `deleted_by`) VALUES
(1, 'EV230715186401083', 'TCU Exhibitions', '[\"PR230714273207991\"]', 'US230713785105618', '2023-07-15', '2023-07-23', '\"TCU Exhibitons Held in Daressalaam.\"', 0, 0, '2023-07-15 02:24:52', 1, '2023-07-15 03:02:46', 'US221202353908764'),
(2, 'EV230715222606058', 'Nane Nane', '[\"PR230714273207991\", \"PR230714481202203\"]', 'US230713785105618', '2023-07-16', '2023-07-21', '\"Test Multiple Projects Event.\"', 0, 1, '2023-07-15 02:51:45', 0, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `gallery`
--

CREATE TABLE `gallery` (
  `id` int(11) NOT NULL,
  `event_id` varchar(20) NOT NULL,
  `photos` json NOT NULL,
  `created_by` varchar(20) NOT NULL,
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `deleted_flag` tinyint(4) NOT NULL DEFAULT '0',
  `deleted_on` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `deleted_by` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `members`
--

CREATE TABLE `members` (
  `id` int(11) NOT NULL,
  `member_id` varchar(20) NOT NULL,
  `user_id` varchar(20) NOT NULL,
  `member_details` json NOT NULL COMMENT 'Firstname,Lastname,Gender, Department,Programme',
  `email` varchar(100) NOT NULL,
  `phone` varchar(10) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1' COMMENT '0-Active\r\n1-Inactive',
  `role_id` varchar(20) NOT NULL,
  `level` tinyint(4) NOT NULL DEFAULT '4',
  `password` varchar(200) NOT NULL,
  `created_by` varchar(20) NOT NULL,
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_on` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `deleted_flag` tinyint(4) DEFAULT '0' COMMENT '0-Not Deleted\r\n1-Deleted',
  `deleted_on` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `deleted_by` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `members`
--

INSERT INTO `members` (`id`, `member_id`, `user_id`, `member_details`, `email`, `phone`, `status`, `role_id`, `level`, `password`, `created_by`, `created_on`, `updated_on`, `deleted_flag`, `deleted_on`, `deleted_by`) VALUES
(1, 'MB230713727307765', 'MB230713727307765', '{\"gender\": \"Male\", \"lastname\": \"Nizary\", \"firstname\": \"Abdulmujib\", \"department\": \"DP230610697109772\"}', 'test@gmail.com', '0988909890', 1, 'RO230713062508193', 4, '$2y$10$lxGUfLc5VvAr2h/9.TnAdubr0aWXsE3n5zr3Ivkjr1rOHlRQBqfKm', 'US221202353908764', '2023-07-13 16:12:08', '2023-07-13 16:12:08', 0, '2023-07-13 16:12:08', NULL),
(2, 'MB230714359900875', 'MB230714359900875', '{\"gender\": \"Female\", \"lastname\": \"Member\", \"firstname\": \"Test\", \"department\": \"DP230610511601475\"}', 'member@gmail.com', '0988778900', 1, 'RO230713062508193', 4, '$2y$10$WcWBrE/JEh4BEUevBEnZJ.U2HBE6phTUkkEbI7Mn1XUtiLaGhcxdm', 'US221202353908764', '2023-07-14 13:50:45', '2023-07-14 13:50:45', 0, '2023-07-14 13:50:45', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `OTP`
--

CREATE TABLE `OTP` (
  `id` int(11) NOT NULL,
  `sent_to` varchar(10) NOT NULL,
  `OTP` varchar(10) NOT NULL,
  `sent_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `deleted_flag` smallint(6) NOT NULL DEFAULT '0',
  `deleted_on` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `OTP`
--

INSERT INTO `OTP` (`id`, `sent_to`, `OTP`, `sent_on`, `deleted_flag`, `deleted_on`) VALUES
(1, '0745377504', '620440', '2023-03-28 14:15:25', 0, NULL),
(2, '0745377504', '300450', '2023-03-28 14:17:28', 0, NULL),
(3, '0745377504', '241915', '2023-03-28 14:27:55', 0, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `project`
--

CREATE TABLE `project` (
  `id` int(11) NOT NULL,
  `project_id` varchar(20) NOT NULL,
  `project_title` varchar(200) NOT NULL,
  `category` varchar(20) NOT NULL,
  `lead_developer` varchar(20) NOT NULL,
  `other_developers` json NOT NULL,
  `department` varchar(200) NOT NULL,
  `stage` tinyint(4) NOT NULL,
  `reg_status` tinyint(4) NOT NULL COMMENT '1-Registered\r\n2-On Progress\r\n3-Unregistered',
  `project_description` json NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1' COMMENT '0-Inactive\r\n1-Active',
  `created_by` varchar(20) NOT NULL,
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted_flag` tinyint(4) NOT NULL DEFAULT '0' COMMENT '0-Not Deleted\r\n1-Deleted',
  `deleted_on` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `deleted_by` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `project`
--

INSERT INTO `project` (`id`, `project_id`, `project_title`, `category`, `lead_developer`, `other_developers`, `department`, `stage`, `reg_status`, `project_description`, `status`, `created_by`, `created_on`, `updated_on`, `deleted_flag`, `deleted_on`, `deleted_by`) VALUES
(1, 'PR230714397002866', 'Test Project', 'CT230608560006322', 'MB230713727307765', '[\"MB230713727307765\"]', 'DP230610697109772', 1, 2, '\"Test Project.\"', 0, 'US221202353908764', '2023-07-14 06:45:35', '2023-07-14 13:29:57', 1, '2023-07-14 13:29:57', 'US221202353908764'),
(2, 'PR230714423420893', 'Another Test', 'CT230609076008275', 'MB230713727307765', '[\"MB230713727307765\"]', 'DP230610511601475', 2, 3, '\"Another Test\"', 0, 'US221202353908764', '2023-07-14 12:51:52', '2023-07-14 15:29:18', 1, '2023-07-14 15:29:18', 'US221202353908764'),
(3, 'PR230714395104401', 'Test Project', 'CT230608560006322', 'MB230713727307765', '[\"MB230713727307765\"]', 'CO230610556604055', 1, 3, '\"Test Project.\"', 0, 'US221202353908764', '2023-07-14 13:30:23', '2023-07-14 15:29:14', 1, '2023-07-14 15:29:14', 'US221202353908764'),
(4, 'PR230714273207991', 'Another Test', 'CT230609076008275', 'MB230714359900875', '[\"MB230713727307765\", \"MB230714359900875\"]', 'CO230610556604055', 3, 2, '\"Another Test Project.\"', 1, 'US221202353908764', '2023-07-14 13:51:20', '2023-07-14 13:51:20', 0, '2023-07-14 13:51:20', NULL),
(5, 'PR230714481202203', 'Test Project', 'CT230609076008275', 'MB230713727307765', '[\"MB230713727307765\", \"MB230714359900875\"]', 'CO230610556604055', 2, 3, '\"Test Project\"', 1, 'US221202353908764', '2023-07-14 15:29:49', '2023-07-15 12:18:42', 0, '2023-07-14 15:29:49', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `reports`
--

CREATE TABLE `reports` (
  `id` int(11) NOT NULL,
  `report_id` varchar(20) NOT NULL,
  `file` varchar(50) NOT NULL,
  `report_event` varchar(20) DEFAULT NULL,
  `report_project` varchar(20) DEFAULT NULL,
  `report_description` json DEFAULT NULL,
  `created_by` varchar(20) NOT NULL,
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `deleted_flag` tinyint(4) NOT NULL DEFAULT '0',
  `deleted_on` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `deleted_by` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE `role` (
  `id` int(11) NOT NULL,
  `role_id` varchar(20) NOT NULL,
  `role_name` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `privileges` json NOT NULL,
  `created_by` varchar(20) NOT NULL,
  `status` smallint(6) NOT NULL DEFAULT '1' COMMENT '0-Active\r\n1-Inactive',
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted_flag` smallint(6) NOT NULL DEFAULT '0',
  `deleted_by` varchar(20) DEFAULT NULL,
  `deleted_on` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`id`, `role_id`, `role_name`, `description`, `privileges`, `created_by`, `status`, `created_on`, `updated_on`, `deleted_flag`, `deleted_by`, `deleted_on`) VALUES
(3, 'RO230315319303212', 'System Administrator', 'Overall System Administrator', '{\"add_role\": 1, \"add_user\": 1, \"edit_role\": 1, \"edit_user\": 1, \"view_role\": 1, \"view_user\": 1, \"add_events\": 1, \"add_gallery\": 1, \"add_members\": 1, \"delete_role\": 1, \"delete_user\": 1, \"edit_events\": 1, \"view_events\": 1, \"add_projects\": 1, \"edit_gallery\": 1, \"edit_members\": 1, \"view_deleted\": 1, \"view_gallery\": 1, \"view_members\": 1, \"view_reports\": 1, \"delete_events\": 1, \"edit_projects\": 1, \"view_projects\": 1, \"add_categories\": 1, \"create_reports\": 1, \"delete_gallery\": 1, \"delete_members\": 1, \"delete_projects\": 1, \"edit_categories\": 1, \"recover_deleted\": 1, \"view_categories\": 1, \"delete_categories\": 1}', 'US221202353908764', 0, '2023-03-15 12:52:36', '2023-07-13 14:18:57', 1, 'US221202353908764', '2023-07-13 14:18:57'),
(4, 'RO230713095706987', 'System Admin', 'Overall System Administrator', '{\"add_role\": 1, \"add_user\": 1, \"edit_role\": 1, \"edit_user\": 1, \"view_role\": 1, \"view_user\": 1, \"add_events\": 1, \"add_members\": 1, \"delete_role\": 1, \"delete_user\": 1, \"edit_events\": 1, \"view_events\": 1, \"add_colleges\": 1, \"add_projects\": 1, \"edit_members\": 1, \"view_members\": 1, \"view_reports\": 1, \"delete_events\": 1, \"edit_colleges\": 1, \"edit_projects\": 1, \"view_colleges\": 1, \"view_projects\": 1, \"add_categories\": 1, \"create_reports\": 1, \"delete_members\": 1, \"delete_reports\": 1, \"delete_colleges\": 1, \"delete_projects\": 1, \"edit_categories\": 1, \"view_categories\": 1, \"delete_categories\": 1}', 'US221202353908764', 1, '2023-07-13 14:03:25', '2023-07-13 14:03:25', 0, NULL, NULL),
(5, 'RO230713062508193', 'Member', 'Member', '{\"add_role\": 0, \"add_user\": 0, \"edit_role\": 0, \"edit_user\": 0, \"view_role\": 0, \"view_user\": 0, \"add_events\": 0, \"add_members\": 0, \"delete_role\": 0, \"delete_user\": 0, \"edit_events\": 0, \"view_events\": 1, \"add_colleges\": 0, \"add_projects\": 0, \"edit_members\": 0, \"view_members\": 0, \"view_reports\": 1, \"delete_events\": 0, \"edit_colleges\": 0, \"edit_projects\": 1, \"view_colleges\": 1, \"view_projects\": 1, \"add_categories\": 0, \"create_reports\": 1, \"delete_members\": 0, \"delete_reports\": 0, \"delete_colleges\": 0, \"delete_projects\": 0, \"edit_categories\": 0, \"view_categories\": 0, \"delete_categories\": 0}', 'US221202353908764', 1, '2023-07-13 14:41:38', '2023-07-13 14:41:38', 0, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `user_id` varchar(20) NOT NULL,
  `role_id` varchar(20) NOT NULL,
  `firstname` varchar(100) NOT NULL,
  `lastname` varchar(100) NOT NULL,
  `phone` varchar(11) NOT NULL,
  `email` varchar(40) NOT NULL,
  `password` varchar(255) NOT NULL,
  `level` tinyint(1) NOT NULL DEFAULT '4' COMMENT '1-System Admin 2-Sub Admin 3-Branch Admin 4-Normal User',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1-Active 0-Inactive',
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted_flag` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0-Not Deleted 1-Deleted',
  `deleted_by` varchar(100) DEFAULT NULL,
  `deleted_on` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `user_id`, `role_id`, `firstname`, `lastname`, `phone`, `email`, `password`, `level`, `status`, `created_on`, `updated_on`, `deleted_flag`, `deleted_by`, `deleted_on`) VALUES
(13, 'US221202353908764', 'RO230713095706987', 'System', 'Admin', '0745377504', 'system@admin.com', '$2y$10$Vwo3nQv1w/D/aCOqXt.Tzugeo6O6OapvXtVKLyOpa1Z/CMPtXcz7e', 1, 1, '2022-12-02 03:19:21', '2023-07-13 14:17:38', 0, NULL, NULL),
(20, 'US230713785105618', 'RO230713095706987', 'Dr.', 'Kazema', '0987890987', 'kazema@gmail.com', '$2y$10$Q2ILEAXT4lywoglrOI9BB.9gH/a2je3N9ZL7QyzsdPLvKxiaIG3u2', 3, 1, '2023-07-13 14:13:27', '2023-07-13 14:15:57', 0, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `colleges`
--
ALTER TABLE `colleges`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gallery`
--
ALTER TABLE `gallery`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `members`
--
ALTER TABLE `members`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `OTP`
--
ALTER TABLE `OTP`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `project`
--
ALTER TABLE `project`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reports`
--
ALTER TABLE `reports`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`id`),
  ADD KEY `role` (`role_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user` (`user_id`,`phone`,`email`,`role_id`) USING BTREE;

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `colleges`
--
ALTER TABLE `colleges`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `gallery`
--
ALTER TABLE `gallery`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `members`
--
ALTER TABLE `members`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `OTP`
--
ALTER TABLE `OTP`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `project`
--
ALTER TABLE `project`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `reports`
--
ALTER TABLE `reports`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `role`
--
ALTER TABLE `role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
