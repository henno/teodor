-- phpMyAdmin SQL Dump
-- version 4.2.7.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Nov 19, 2014 at 12:21 PM
-- Server version: 5.6.20
-- PHP Version: 5.5.15

SET FOREIGN_KEY_CHECKS=0;
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `teodor`
--

-- --------------------------------------------------------

--
-- Table structure for table `building`
--

CREATE TABLE IF NOT EXISTS `building` (
`building_id` int(10) unsigned NOT NULL,
  `building_name` varchar(255) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `building`
--

INSERT INTO `building` (`building_id`, `building_name`) VALUES
(1, 'Kopli'),
(2, 'Põllu');

-- --------------------------------------------------------

--
-- Table structure for table `building_section`
--

CREATE TABLE IF NOT EXISTS `building_section` (
`building_section_id` int(10) unsigned NOT NULL,
  `building_section_name` varchar(255) NOT NULL,
  `building_id` int(10) unsigned NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `building_section`
--

INSERT INTO `building_section` (`building_section_id`, `building_section_name`, `building_id`) VALUES
(1, 'A', 1),
(2, 'B', 1),
(3, 'C', 1),
(4, 'A', 2),
(5, 'B', 2),
(6, 'E', 2),
(7, 'F', 2);

-- --------------------------------------------------------

--
-- Table structure for table `course`
--

CREATE TABLE IF NOT EXISTS `course` (
`course_id` int(10) unsigned NOT NULL,
  `subject_id` int(10) unsigned NOT NULL,
  `person_id` int(10) unsigned NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `course`
--

INSERT INTO `course` (`course_id`, `subject_id`, `person_id`) VALUES
(1, 1, 2),
(2, 2, 3);

-- --------------------------------------------------------

--
-- Table structure for table `group`
--

CREATE TABLE IF NOT EXISTS `group` (
`group_id` int(10) unsigned NOT NULL,
  `group_name` varchar(25) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `group`
--

INSERT INTO `group` (`group_id`, `group_name`) VALUES
(1, 'gr-1');

-- --------------------------------------------------------

--
-- Table structure for table `period`
--

CREATE TABLE IF NOT EXISTS `period` (
`period_id` int(10) unsigned NOT NULL,
  `period_name` varchar(25) NOT NULL,
  `year_id` int(10) unsigned NOT NULL,
  `period_start` date NOT NULL,
  `period_end` date NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `period`
--

INSERT INTO `period` (`period_id`, `period_name`, `year_id`, `period_start`, `period_end`) VALUES
(1, '1.periood', 1, '2014-09-01', '2014-10-05'),
(2, '2.periood', 1, '2014-10-06', '2014-11-02');

-- --------------------------------------------------------

--
-- Table structure for table `period_courses`
--

CREATE TABLE IF NOT EXISTS `period_courses` (
  `period_id` int(11) unsigned NOT NULL,
  `course_id` int(11) unsigned NOT NULL,
  `planned_lessons` int(10) unsigned NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `period_courses`
--

INSERT INTO `period_courses` (`period_id`, `course_id`, `planned_lessons`) VALUES
(1, 2, 40),
(1, 2, 40);

-- --------------------------------------------------------

--
-- Table structure for table `person`
--

CREATE TABLE IF NOT EXISTS `person` (
`person_id` int(10) unsigned NOT NULL,
  `person_name` varchar(70) NOT NULL,
  `username` varchar(25) NOT NULL,
  `is_admin` tinyint(4) NOT NULL DEFAULT '0',
  `password` varchar(255) NOT NULL,
  `active` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `email` varchar(255) NOT NULL,
  `deleted` tinyint(1) unsigned NOT NULL DEFAULT '0'
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `person`
--

INSERT INTO `person` (`person_id`, `person_name`, `username`, `is_admin`, `password`, `active`, `email`, `deleted`) VALUES
(1, 'Sammal Habe', 'sammal.habe', 1, 'sammal', 0, '', 0),
(2, 'King Pool', 'king.pool', 1, 'king', 0, '', 0),
(3, 'Muh V', 'muh.v', 0, 'muh', 0, '', 0),
(4, 'test', 'test', 1, 'test', 0, '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `room`
--

CREATE TABLE IF NOT EXISTS `room` (
`room_id` int(10) unsigned NOT NULL,
  `room_nr` varchar(255) NOT NULL,
  `building_section_id` int(10) unsigned NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `room`
--

INSERT INTO `room` (`room_id`, `room_nr`, `building_section_id`) VALUES
(1, '404', 1),
(2, '411', 1),
(3, '418', 1);

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE IF NOT EXISTS `student` (
  `person_id` int(10) unsigned NOT NULL,
  `group_id` int(10) unsigned NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`person_id`, `group_id`) VALUES
(2, 1),
(3, 1);

-- --------------------------------------------------------

--
-- Table structure for table `subject`
--

CREATE TABLE IF NOT EXISTS `subject` (
`subject_id` int(10) unsigned NOT NULL,
  `subject_name` varchar(70) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `subject`
--

INSERT INTO `subject` (`subject_id`, `subject_name`) VALUES
(1, 'Metsateadused palspalsdplapsfsvfsdy'),
(2, 'Ornitoloogia');

-- --------------------------------------------------------

--
-- Table structure for table `teacher`
--

CREATE TABLE IF NOT EXISTS `teacher` (
  `person_id` int(10) unsigned NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `teacher`
--

INSERT INTO `teacher` (`person_id`) VALUES
(1);

-- --------------------------------------------------------

--
-- Table structure for table `test`
--

CREATE TABLE IF NOT EXISTS `test` (
`test_id` int(10) unsigned NOT NULL,
  `test_name` varchar(255) NOT NULL,
  `test_max_allowed_time` timestamp NULL DEFAULT NULL,
  `test_max_allowed_attempts` int(10) unsigned DEFAULT NULL,
  `test_min_score` int(10) DEFAULT NULL,
  `person_id` int(10) unsigned NOT NULL,
  `subject_id` int(10) unsigned DEFAULT NULL,
  `lecture_id` int(10) unsigned DEFAULT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=17 ;

--
-- Dumping data for table `test`
--

INSERT INTO `test` (`test_id`, `test_name`, `test_max_allowed_time`, `test_max_allowed_attempts`, `test_min_score`, `person_id`, `subject_id`, `lecture_id`) VALUES
(1, 'Metsateaduste töö', '2014-10-12 21:15:00', 3, NULL, 1, 1, NULL),
(9, 'zooloogia', NULL, NULL, NULL, 1, NULL, NULL),
(10, 'botaanika', NULL, NULL, NULL, 1, NULL, NULL),
(11, 'geoloogia', NULL, NULL, NULL, 1, NULL, NULL),
(12, 'bioloogia', NULL, NULL, NULL, 1, NULL, NULL),
(13, 'matemaatika', NULL, NULL, NULL, 1, NULL, NULL),
(14, 'keemia', NULL, NULL, NULL, 1, NULL, NULL),
(15, 'füüsika', NULL, NULL, NULL, 1, NULL, NULL),
(16, 'klaabu', NULL, NULL, NULL, 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `test_participants`
--

CREATE TABLE IF NOT EXISTS `test_participants` (
  `person_id` int(10) unsigned NOT NULL,
  `test_id` int(10) unsigned NOT NULL,
  `test_started_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `test_ended_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `test_participants`
--

INSERT INTO `test_participants` (`person_id`, `test_id`, `test_started_at`, `test_ended_at`) VALUES
(2, 1, '2014-10-13 13:20:38', '2014-10-13 13:20:38');

-- --------------------------------------------------------

--
-- Table structure for table `test_question`
--

CREATE TABLE IF NOT EXISTS `test_question` (
`test_question_id` int(10) unsigned NOT NULL,
  `test_question_text` text NOT NULL,
  `test_question_score` float NOT NULL,
  `test_id` int(10) unsigned NOT NULL,
  `test_question_type_id` int(10) unsigned NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `test_question`
--

INSERT INTO `test_question` (`test_question_id`, `test_question_text`, `test_question_score`, `test_id`, `test_question_type_id`) VALUES
(1, 'Kas mets mühiseb?', 2, 1, 1),
(2, 'Mitu puud moodustavad metsa?', 1, 1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `test_question_answer`
--

CREATE TABLE IF NOT EXISTS `test_question_answer` (
`test_question_answer_id` int(10) unsigned NOT NULL,
  `test_question_answer_text` text NOT NULL,
  `test_question_correct` tinyint(3) unsigned NOT NULL,
  `test_question_type_id` int(10) unsigned NOT NULL,
  `test_question_id` int(10) unsigned NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `test_question_answer`
--

INSERT INTO `test_question_answer` (`test_question_answer_id`, `test_question_answer_text`, `test_question_correct`, `test_question_type_id`, `test_question_id`) VALUES
(1, 'jah', 1, 1, 1),
(2, 'ei', 0, 1, 1),
(3, 'üks', 0, 2, 2),
(4, 'kaks', 0, 2, 2),
(5, 'palju', 1, 2, 2);

-- --------------------------------------------------------

--
-- Table structure for table `test_question_type`
--

CREATE TABLE IF NOT EXISTS `test_question_type` (
`test_question_type_id` int(10) unsigned NOT NULL,
  `test_question_type_name` varchar(50) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `test_question_type`
--

INSERT INTO `test_question_type` (`test_question_type_id`, `test_question_type_name`) VALUES
(1, 'true/false'),
(2, 'multiple choice'),
(3, 'multiple response'),
(4, 'fill in the blank');

-- --------------------------------------------------------

--
-- Table structure for table `thesis`
--

CREATE TABLE IF NOT EXISTS `thesis` (
  `thesis_id` int(10) unsigned NOT NULL,
  `thesis_title` varchar(255) NOT NULL,
  `person_id_author` int(10) unsigned NOT NULL,
  `person_id_instructor` int(10) unsigned DEFAULT NULL,
  `thesis_instructor_confirmed_at` timestamp NULL DEFAULT NULL,
  `thesis_title_confirmed_at` timestamp NULL DEFAULT NULL,
  `thesis_defended_at` timestamp NULL DEFAULT NULL,
  `thesis_file_id_draft` int(10) unsigned DEFAULT NULL,
  `thesis_file_id_final` int(10) unsigned DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `thesis`
--

INSERT INTO `thesis` (`thesis_id`, `thesis_title`, `person_id_author`, `person_id_instructor`, `thesis_instructor_confirmed_at`, `thesis_title_confirmed_at`, `thesis_defended_at`, `thesis_file_id_draft`, `thesis_file_id_final`) VALUES
(1, 'Mingi lõputöö', 1, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `thesis_file`
--

CREATE TABLE IF NOT EXISTS `thesis_file` (
`thesis_file_id` int(10) unsigned NOT NULL,
  `thesis_id` int(10) unsigned NOT NULL,
  `thesis_file_name` varchar(255) NOT NULL,
  `thesis_file_content` longblob,
  `thesis_file_uploaded_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `timetable`
--

CREATE TABLE IF NOT EXISTS `timetable` (
`timetable_id` int(10) unsigned NOT NULL,
  `group_id` int(10) unsigned NOT NULL,
  `person_id` int(10) unsigned NOT NULL,
  `room_id` int(10) unsigned NOT NULL,
  `subject_id` int(10) unsigned NOT NULL,
  `start` datetime NOT NULL,
  `end` datetime NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `timetable`
--

INSERT INTO `timetable` (`timetable_id`, `group_id`, `person_id`, `room_id`, `subject_id`, `start`, `end`) VALUES
(1, 1, 1, 2, 1, '2014-11-10 09:08:00', '2014-11-10 11:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `year`
--

CREATE TABLE IF NOT EXISTS `year` (
`year_id` int(10) unsigned NOT NULL,
  `year_name` varchar(11) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `year`
--

INSERT INTO `year` (`year_id`, `year_name`) VALUES
(1, '2014/2015');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `building`
--
ALTER TABLE `building`
 ADD PRIMARY KEY (`building_id`);

--
-- Indexes for table `building_section`
--
ALTER TABLE `building_section`
 ADD PRIMARY KEY (`building_section_id`), ADD KEY `building_id` (`building_id`);

--
-- Indexes for table `course`
--
ALTER TABLE `course`
 ADD PRIMARY KEY (`course_id`), ADD KEY `subject_id` (`subject_id`), ADD KEY `person_id` (`person_id`);

--
-- Indexes for table `group`
--
ALTER TABLE `group`
 ADD PRIMARY KEY (`group_id`);

--
-- Indexes for table `period`
--
ALTER TABLE `period`
 ADD PRIMARY KEY (`period_id`), ADD KEY `period_year_id` (`year_id`);

--
-- Indexes for table `period_courses`
--
ALTER TABLE `period_courses`
 ADD KEY `course_id` (`course_id`), ADD KEY `period_id` (`period_id`);

--
-- Indexes for table `person`
--
ALTER TABLE `person`
 ADD PRIMARY KEY (`person_id`), ADD UNIQUE KEY `UNIQUE` (`username`);

--
-- Indexes for table `room`
--
ALTER TABLE `room`
 ADD PRIMARY KEY (`room_id`), ADD KEY `room_nr` (`room_nr`), ADD KEY `section_id` (`building_section_id`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
 ADD PRIMARY KEY (`person_id`,`group_id`), ADD KEY `group_id` (`group_id`);

--
-- Indexes for table `subject`
--
ALTER TABLE `subject`
 ADD PRIMARY KEY (`subject_id`);

--
-- Indexes for table `teacher`
--
ALTER TABLE `teacher`
 ADD PRIMARY KEY (`person_id`);

--
-- Indexes for table `test`
--
ALTER TABLE `test`
 ADD PRIMARY KEY (`test_id`), ADD KEY `person_id_author` (`person_id`), ADD KEY `subject_id` (`subject_id`);

--
-- Indexes for table `test_participants`
--
ALTER TABLE `test_participants`
 ADD PRIMARY KEY (`person_id`,`test_id`), ADD KEY `test_id` (`test_id`);

--
-- Indexes for table `test_question`
--
ALTER TABLE `test_question`
 ADD PRIMARY KEY (`test_question_id`), ADD KEY `test_id` (`test_id`), ADD KEY `test_question_type_id` (`test_question_type_id`);

--
-- Indexes for table `test_question_answer`
--
ALTER TABLE `test_question_answer`
 ADD PRIMARY KEY (`test_question_answer_id`), ADD KEY `test_question_type_id` (`test_question_type_id`), ADD KEY `test_question_id` (`test_question_id`);

--
-- Indexes for table `test_question_type`
--
ALTER TABLE `test_question_type`
 ADD PRIMARY KEY (`test_question_type_id`);

--
-- Indexes for table `thesis`
--
ALTER TABLE `thesis`
 ADD PRIMARY KEY (`thesis_id`), ADD KEY `person_id_author` (`person_id_author`,`person_id_instructor`), ADD KEY `thesis_file_id_draft` (`thesis_file_id_draft`), ADD KEY `thesis_file_id_final` (`thesis_file_id_final`), ADD KEY `person_id_instructor` (`person_id_instructor`);

--
-- Indexes for table `thesis_file`
--
ALTER TABLE `thesis_file`
 ADD PRIMARY KEY (`thesis_file_id`);

--
-- Indexes for table `timetable`
--
ALTER TABLE `timetable`
 ADD PRIMARY KEY (`timetable_id`), ADD KEY `group_id` (`group_id`), ADD KEY `person_id` (`person_id`), ADD KEY `room_id` (`room_id`), ADD KEY `subject_id` (`subject_id`), ADD KEY `start_time` (`start`), ADD KEY `end_time` (`end`);

--
-- Indexes for table `year`
--
ALTER TABLE `year`
 ADD PRIMARY KEY (`year_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `building`
--
ALTER TABLE `building`
MODIFY `building_id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `building_section`
--
ALTER TABLE `building_section`
MODIFY `building_section_id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `course`
--
ALTER TABLE `course`
MODIFY `course_id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `group`
--
ALTER TABLE `group`
MODIFY `group_id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `period`
--
ALTER TABLE `period`
MODIFY `period_id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `person`
--
ALTER TABLE `person`
MODIFY `person_id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `room`
--
ALTER TABLE `room`
MODIFY `room_id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `subject`
--
ALTER TABLE `subject`
MODIFY `subject_id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `test`
--
ALTER TABLE `test`
MODIFY `test_id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT for table `test_question`
--
ALTER TABLE `test_question`
MODIFY `test_question_id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `test_question_answer`
--
ALTER TABLE `test_question_answer`
MODIFY `test_question_answer_id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `test_question_type`
--
ALTER TABLE `test_question_type`
MODIFY `test_question_type_id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `thesis_file`
--
ALTER TABLE `thesis_file`
MODIFY `thesis_file_id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `timetable`
--
ALTER TABLE `timetable`
MODIFY `timetable_id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `year`
--
ALTER TABLE `year`
MODIFY `year_id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `building_section`
--
ALTER TABLE `building_section`
ADD CONSTRAINT `building_section_ibfk_1` FOREIGN KEY (`building_id`) REFERENCES `building` (`building_id`);

--
-- Constraints for table `course`
--
ALTER TABLE `course`
ADD CONSTRAINT `course_ibfk_1` FOREIGN KEY (`subject_id`) REFERENCES `subject` (`subject_id`),
ADD CONSTRAINT `course_ibfk_2` FOREIGN KEY (`person_id`) REFERENCES `person` (`person_id`);

--
-- Constraints for table `period`
--
ALTER TABLE `period`
ADD CONSTRAINT `period_ibfk_1` FOREIGN KEY (`year_id`) REFERENCES `year` (`year_id`);

--
-- Constraints for table `period_courses`
--
ALTER TABLE `period_courses`
ADD CONSTRAINT `period_courses_ibfk_1` FOREIGN KEY (`course_id`) REFERENCES `course` (`course_id`),
ADD CONSTRAINT `period_courses_ibfk_2` FOREIGN KEY (`period_id`) REFERENCES `period` (`period_id`);

--
-- Constraints for table `room`
--
ALTER TABLE `room`
ADD CONSTRAINT `room_ibfk_1` FOREIGN KEY (`building_section_id`) REFERENCES `building_section` (`building_section_id`);

--
-- Constraints for table `student`
--
ALTER TABLE `student`
ADD CONSTRAINT `student_ibfk_1` FOREIGN KEY (`person_id`) REFERENCES `person` (`person_id`),
ADD CONSTRAINT `student_ibfk_2` FOREIGN KEY (`group_id`) REFERENCES `group` (`group_id`);

--
-- Constraints for table `teacher`
--
ALTER TABLE `teacher`
ADD CONSTRAINT `teacher_ibfk_1` FOREIGN KEY (`person_id`) REFERENCES `person` (`person_id`);

--
-- Constraints for table `test`
--
ALTER TABLE `test`
ADD CONSTRAINT `test_ibfk_2` FOREIGN KEY (`subject_id`) REFERENCES `subject` (`subject_id`),
ADD CONSTRAINT `test_ibfk_3` FOREIGN KEY (`person_id`) REFERENCES `person` (`person_id`);

--
-- Constraints for table `test_participants`
--
ALTER TABLE `test_participants`
ADD CONSTRAINT `test_participants_ibfk_1` FOREIGN KEY (`person_id`) REFERENCES `person` (`person_id`),
ADD CONSTRAINT `test_participants_ibfk_2` FOREIGN KEY (`test_id`) REFERENCES `test` (`test_id`);

--
-- Constraints for table `test_question`
--
ALTER TABLE `test_question`
ADD CONSTRAINT `test_question_ibfk_1` FOREIGN KEY (`test_id`) REFERENCES `test` (`test_id`),
ADD CONSTRAINT `test_question_ibfk_2` FOREIGN KEY (`test_question_type_id`) REFERENCES `test_question_type` (`test_question_type_id`);

--
-- Constraints for table `test_question_answer`
--
ALTER TABLE `test_question_answer`
ADD CONSTRAINT `test_question_answer_ibfk_1` FOREIGN KEY (`test_question_type_id`) REFERENCES `test_question_type` (`test_question_type_id`),
ADD CONSTRAINT `test_question_answer_ibfk_2` FOREIGN KEY (`test_question_id`) REFERENCES `test_question` (`test_question_id`);

--
-- Constraints for table `thesis`
--
ALTER TABLE `thesis`
ADD CONSTRAINT `thesis_ibfk_1` FOREIGN KEY (`person_id_author`) REFERENCES `person` (`person_id`),
ADD CONSTRAINT `thesis_ibfk_2` FOREIGN KEY (`person_id_instructor`) REFERENCES `person` (`person_id`);

--
-- Constraints for table `timetable`
--
ALTER TABLE `timetable`
ADD CONSTRAINT `timetable_ibfk_1` FOREIGN KEY (`group_id`) REFERENCES `group` (`group_id`),
ADD CONSTRAINT `timetable_ibfk_2` FOREIGN KEY (`person_id`) REFERENCES `person` (`person_id`),
ADD CONSTRAINT `timetable_ibfk_3` FOREIGN KEY (`subject_id`) REFERENCES `subject` (`subject_id`),
ADD CONSTRAINT `timetable_ibfk_4` FOREIGN KEY (`room_id`) REFERENCES `room` (`room_id`);
SET FOREIGN_KEY_CHECKS=1;
