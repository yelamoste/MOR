-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 16, 2024 at 10:33 AM
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
-- Database: `mor_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_users`
--

CREATE TABLE `admin_users` (
  `id` int(11) NOT NULL,
  `admin_name` varchar(255) NOT NULL,
  `school_id` varchar(255) NOT NULL,
  `pup_webmail` varchar(255) NOT NULL,
  `password` varchar(16) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `approval_committee`
--

CREATE TABLE `approval_committee` (
  `id` int(11) NOT NULL,
  `committees` int(11) NOT NULL,
  `thesis` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `comment`
--

CREATE TABLE `comment` (
  `id` int(11) NOT NULL,
  `users_id` int(11) NOT NULL,
  `comments` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `committees`
--

CREATE TABLE `committees` (
  `id` int(11) NOT NULL,
  `faculty_users` int(11) NOT NULL,
  `response` enum('approved','rejected','conditional','processing') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `id` int(11) NOT NULL,
  `courses` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`id`, `courses`) VALUES
(3, 'BS in Architecture'),
(2, 'BS in Civil Engineering'),
(1, 'BS in Computer Engineering'),
(5, 'BS in Electrical Engineering'),
(4, 'BS in Electronic Engineering');

-- --------------------------------------------------------

--
-- Table structure for table `faculty_roles`
--

CREATE TABLE `faculty_roles` (
  `id` int(11) NOT NULL,
  `theses` int(11) NOT NULL,
  `roles` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `faculty_roles`
--

INSERT INTO `faculty_roles` (`id`, `theses`, `roles`) VALUES
(88, 733, ''),
(89, 736, ''),
(90, 739, '');

-- --------------------------------------------------------

--
-- Table structure for table `faculty_users`
--

CREATE TABLE `faculty_users` (
  `id` int(11) NOT NULL,
  `faculty_name` varchar(255) NOT NULL,
  `school_id` varchar(255) NOT NULL,
  `faculty_webmail` varchar(255) NOT NULL,
  `roles_id` int(11) NOT NULL,
  `department` varchar(255) NOT NULL,
  `password` varchar(16) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `faculty_users`
--

INSERT INTO `faculty_users` (`id`, `faculty_name`, `school_id`, `faculty_webmail`, `roles_id`, `department`, `password`) VALUES
(3, 'Juan Dela Cruz', '2017-12578-MN-0', 'jdc@iskolarngbayan.pup.edu.ph', 0, 'Computer Engineering', '1234'),
(4, 'Farah Dela Rosa', '2017-15678-MN-0', 'fdr@iskolarngbayan.pup.edu.ph', 0, 'Computer Engineering', '1234');

-- --------------------------------------------------------

--
-- Table structure for table `group_members`
--

CREATE TABLE `group_members` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `group_number` int(50) NOT NULL,
  `course` int(11) NOT NULL,
  `yearnsection` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `group_members`
--

INSERT INTO `group_members` (`id`, `user_id`, `name`, `group_number`, `course`, `yearnsection`) VALUES
(1624, 1, 'sfas', 3, 1, 11),
(1625, 1, 'asdasd', 3, 1, 11),
(1626, 1, 'asdasd', 3, 1, 11),
(1627, 1, 'asd', 3, 1, 11),
(1628, 1, 'asd', 3, 1, 11),
(1629, 1, 'sfas', 3, 1, 11),
(1630, 1, 'asdasd', 3, 1, 11),
(1631, 1, 'asdasd', 3, 1, 11),
(1632, 1, 'asd', 3, 1, 11),
(1633, 1, 'asd', 3, 1, 11),
(1634, 2, 'sdasd', 2, 2, 9),
(1635, 2, 'asd', 2, 2, 9),
(1636, 2, 'asd', 2, 2, 9),
(1637, 2, 'asd', 2, 2, 9),
(1638, 2, 'asd', 2, 2, 9),
(1639, 2, 'asdasd', 4, 2, 11),
(1640, 2, 'asdasd', 4, 2, 11),
(1641, 2, 'dasdad', 4, 2, 11),
(1642, 2, 'asdasd', 4, 2, 11),
(1643, 2, 'asdasd', 4, 2, 11);

-- --------------------------------------------------------

--
-- Table structure for table `group_numbers`
--

CREATE TABLE `group_numbers` (
  `id` int(11) NOT NULL,
  `group_number` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `group_numbers`
--

INSERT INTO `group_numbers` (`id`, `group_number`) VALUES
(1, 1),
(2, 2),
(3, 3),
(4, 4),
(5, 5),
(6, 6),
(7, 7),
(8, 8),
(9, 9),
(10, 10);

-- --------------------------------------------------------

--
-- Table structure for table `student_users`
--

CREATE TABLE `student_users` (
  `id` int(11) NOT NULL,
  `student_name` varchar(255) NOT NULL,
  `school_id` varchar(255) NOT NULL,
  `student_webmail` text NOT NULL,
  `password` varchar(255) NOT NULL,
  `thesis` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `student_users`
--

INSERT INTO `student_users` (`id`, `student_name`, `school_id`, `student_webmail`, `password`, `thesis`) VALUES
(1, 'Yvonne Lamoste', '2022-17878-MN-0', 'yel@iskolarngbayan.pup.edu.ph', '1234', 0),
(2, 'Zandria Amadeus', '2022-48462-MN-0', 'sz@iskolarngbayan.pup.edu.ph', '123', 0);

-- --------------------------------------------------------

--
-- Table structure for table `theses`
--

CREATE TABLE `theses` (
  `id` int(11) NOT NULL,
  `thesis_info` int(11) NOT NULL,
  `response` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `theses`
--

INSERT INTO `theses` (`id`, `thesis_info`, `response`) VALUES
(731, 537, ''),
(732, 538, ''),
(733, 539, ''),
(734, 540, ''),
(735, 541, ''),
(736, 542, ''),
(737, 543, ''),
(738, 544, ''),
(739, 545, '');

-- --------------------------------------------------------

--
-- Table structure for table `thesis_basic_info`
--

CREATE TABLE `thesis_basic_info` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `group_members` int(11) NOT NULL,
  `research_adviser` int(11) NOT NULL,
  `title_proposal_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `thesis_basic_info`
--

INSERT INTO `thesis_basic_info` (`id`, `user_id`, `group_members`, `research_adviser`, `title_proposal_id`) VALUES
(537, 1, 3, 3, 699),
(538, 1, 3, 3, 700),
(539, 1, 3, 3, 701),
(540, 2, 2, 3, 702),
(541, 2, 2, 3, 703),
(542, 2, 2, 3, 704),
(543, 2, 4, 4, 705),
(544, 2, 4, 4, 706),
(545, 2, 4, 4, 707);

-- --------------------------------------------------------

--
-- Table structure for table `title_proposals`
--

CREATE TABLE `title_proposals` (
  `id` int(11) NOT NULL,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_nopad_ci NOT NULL,
  `filename` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `folder_path` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `time_stamp` datetime NOT NULL,
  `status` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `title_proposals`
--

INSERT INTO `title_proposals` (`id`, `title`, `filename`, `folder_path`, `time_stamp`, `status`) VALUES
(698, 'dasd', 'Lab-Activity-3.pdf', '../pdf/', '2024-05-15 18:05:57', 'Approved'),
(699, 'dasd', 'Lab-Activity-3.pdf', '../pdf/', '2024-05-15 18:05:25', 'Rejected'),
(700, 'asd', 'Lab-Activity-3.pdf', '../pdf/', '2024-05-15 18:05:25', 'Approved'),
(701, 'asd', 'Lab-Activity-3.pdf', '../pdf/', '2024-05-15 18:05:25', 'Processing'),
(702, 'ert', 'Title-Proposal-Template.pdf', '../pdf/', '2024-05-15 18:05:36', 'Processing'),
(703, 'sdfsd', 'Title-Proposal-Template.pdf', '../pdf/', '2024-05-15 18:05:36', 'Processing'),
(704, 'sdfsd', 'Title-Proposal-Template.pdf', '../pdf/', '2024-05-15 18:05:36', 'Conditional'),
(705, 'asdasdasd', 'Implementation-of-a-Kiosk-based-Information-Management-System-for-the-CPE-Departments-Research-Defense-1 (1).pdf', '../pdf/', '2024-05-15 22:05:55', 'Processing'),
(706, 'asdasd', 'Implementation-of-a-Kiosk-based-Information-Management-System-for-the-CPE-Departments-Research-Defense-1 (1).pdf', '../pdf/', '2024-05-15 22:05:55', 'Approved'),
(707, 'dasdasdasd', 'Implementation-of-a-Kiosk-based-Information-Management-System-for-the-CPE-Departments-Research-Defense-1 (1).pdf', '../pdf/', '2024-05-15 22:05:55', 'Processing');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `faculty_id` int(11) NOT NULL,
  `admin_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `yearnsection`
--

CREATE TABLE `yearnsection` (
  `id` int(11) NOT NULL,
  `yearnsection` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `yearnsection`
--

INSERT INTO `yearnsection` (`id`, `yearnsection`) VALUES
(1, '1-1'),
(2, '1-2'),
(3, '1-3'),
(4, '1-4'),
(5, '1-5'),
(6, '1-6'),
(7, '2-1'),
(8, '2-2'),
(9, '2-3'),
(10, '2-4'),
(11, '2-5'),
(12, '2-6'),
(13, '3-1'),
(14, '3-2'),
(15, '3-3'),
(16, '3-4'),
(17, '3-5'),
(18, '3-6'),
(19, '4-1'),
(20, '4-2'),
(21, '4-3');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_users`
--
ALTER TABLE `admin_users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `approval_committee`
--
ALTER TABLE `approval_committee`
  ADD PRIMARY KEY (`id`),
  ADD KEY `committees` (`committees`),
  ADD KEY `thesis` (`thesis`);

--
-- Indexes for table `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`id`),
  ADD KEY `users_id` (`users_id`);

--
-- Indexes for table `committees`
--
ALTER TABLE `committees`
  ADD PRIMARY KEY (`id`),
  ADD KEY `faculty_users` (`faculty_users`);

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `courses` (`courses`);

--
-- Indexes for table `faculty_roles`
--
ALTER TABLE `faculty_roles`
  ADD PRIMARY KEY (`id`),
  ADD KEY `theses` (`theses`);

--
-- Indexes for table `faculty_users`
--
ALTER TABLE `faculty_users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `roles_id` (`roles_id`);

--
-- Indexes for table `group_members`
--
ALTER TABLE `group_members`
  ADD PRIMARY KEY (`id`),
  ADD KEY `course` (`course`,`yearnsection`),
  ADD KEY `yearnsection` (`yearnsection`),
  ADD KEY `group_number` (`group_number`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `group_numbers`
--
ALTER TABLE `group_numbers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `student_users`
--
ALTER TABLE `student_users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `thesis` (`thesis`);

--
-- Indexes for table `theses`
--
ALTER TABLE `theses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `title_proposal` (`thesis_info`);

--
-- Indexes for table `thesis_basic_info`
--
ALTER TABLE `thesis_basic_info`
  ADD PRIMARY KEY (`id`),
  ADD KEY `group_members` (`group_members`),
  ADD KEY `title_proposal_id` (`title_proposal_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `research_adviser` (`research_adviser`);

--
-- Indexes for table `title_proposals`
--
ALTER TABLE `title_proposals`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `admin_id` (`admin_id`),
  ADD KEY `student_id` (`student_id`),
  ADD KEY `faculty_id` (`faculty_id`);

--
-- Indexes for table `yearnsection`
--
ALTER TABLE `yearnsection`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_users`
--
ALTER TABLE `admin_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `approval_committee`
--
ALTER TABLE `approval_committee`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `comment`
--
ALTER TABLE `comment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `committees`
--
ALTER TABLE `committees`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `faculty_roles`
--
ALTER TABLE `faculty_roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=91;

--
-- AUTO_INCREMENT for table `faculty_users`
--
ALTER TABLE `faculty_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `group_members`
--
ALTER TABLE `group_members`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1644;

--
-- AUTO_INCREMENT for table `group_numbers`
--
ALTER TABLE `group_numbers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `student_users`
--
ALTER TABLE `student_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `theses`
--
ALTER TABLE `theses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=740;

--
-- AUTO_INCREMENT for table `thesis_basic_info`
--
ALTER TABLE `thesis_basic_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=546;

--
-- AUTO_INCREMENT for table `title_proposals`
--
ALTER TABLE `title_proposals`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=708;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `yearnsection`
--
ALTER TABLE `yearnsection`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `approval_committee`
--
ALTER TABLE `approval_committee`
  ADD CONSTRAINT `approval_committee_ibfk_1` FOREIGN KEY (`committees`) REFERENCES `committees` (`id`),
  ADD CONSTRAINT `approval_committee_ibfk_2` FOREIGN KEY (`thesis`) REFERENCES `theses` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `comment`
--
ALTER TABLE `comment`
  ADD CONSTRAINT `comment_ibfk_1` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `committees`
--
ALTER TABLE `committees`
  ADD CONSTRAINT `committees_ibfk_1` FOREIGN KEY (`faculty_users`) REFERENCES `faculty_users` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `faculty_roles`
--
ALTER TABLE `faculty_roles`
  ADD CONSTRAINT `faculty_roles_ibfk_1` FOREIGN KEY (`theses`) REFERENCES `theses` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `group_members`
--
ALTER TABLE `group_members`
  ADD CONSTRAINT `group_members_ibfk_1` FOREIGN KEY (`course`) REFERENCES `courses` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `group_members_ibfk_2` FOREIGN KEY (`yearnsection`) REFERENCES `yearnsection` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `group_members_ibfk_3` FOREIGN KEY (`group_number`) REFERENCES `group_numbers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `group_members_ibfk_4` FOREIGN KEY (`user_id`) REFERENCES `student_users` (`id`);

--
-- Constraints for table `thesis_basic_info`
--
ALTER TABLE `thesis_basic_info`
  ADD CONSTRAINT `thesis_basic_info_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `student_users` (`id`),
  ADD CONSTRAINT `thesis_basic_info_ibfk_2` FOREIGN KEY (`title_proposal_id`) REFERENCES `title_proposals` (`id`),
  ADD CONSTRAINT `thesis_basic_info_ibfk_3` FOREIGN KEY (`research_adviser`) REFERENCES `faculty_users` (`id`);

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `student_users` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `users_ibfk_2` FOREIGN KEY (`faculty_id`) REFERENCES `faculty_users` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `users_ibfk_3` FOREIGN KEY (`admin_id`) REFERENCES `admin_users` (`id`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
