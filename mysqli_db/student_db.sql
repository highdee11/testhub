-- phpMyAdmin SQL Dump
-- version 4.6.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Mar 07, 2017 at 10:34 PM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `student_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `chemistry`
--

CREATE TABLE `chemistry` (
  `id` int(11) NOT NULL,
  `question_set` varchar(100) NOT NULL,
  `no_of_question` int(7) NOT NULL,
  `visible` int(1) NOT NULL,
  `hours` int(2) NOT NULL,
  `mins` int(2) NOT NULL,
  `secs` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `chemistry`
--

INSERT INTO `chemistry` (`id`, `question_set`, `no_of_question`, `visible`, `hours`, `mins`, `secs`) VALUES
(1, 'week1', 8, 1, 0, 10, 0),
(2, 'Week2', 7, 1, 0, 4, 12);

-- --------------------------------------------------------

--
-- Table structure for table `computer_science`
--

CREATE TABLE `computer_science` (
  `id` int(11) NOT NULL,
  `question_set` varchar(100) NOT NULL,
  `no_of_question` int(7) NOT NULL,
  `visible` int(1) NOT NULL,
  `hours` int(2) NOT NULL,
  `mins` int(2) NOT NULL,
  `secs` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `computer_science`
--

INSERT INTO `computer_science` (`id`, `question_set`, `no_of_question`, `visible`, `hours`, `mins`, `secs`) VALUES
(1, 'week1', 5, 0, 0, 8, 3);

-- --------------------------------------------------------

--
-- Table structure for table `comp_hunn`
--

CREATE TABLE `comp_hunn` (
  `id` int(11) NOT NULL,
  `question_set` varchar(100) NOT NULL,
  `no_of_question` int(7) NOT NULL,
  `visible` int(1) NOT NULL,
  `hours` int(2) NOT NULL,
  `mins` int(2) NOT NULL,
  `secs` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `mathematics`
--

CREATE TABLE `mathematics` (
  `id` int(11) NOT NULL,
  `question_set` varchar(100) NOT NULL,
  `no_of_question` int(7) NOT NULL,
  `visible` int(1) NOT NULL,
  `hours` int(2) NOT NULL,
  `mins` int(2) NOT NULL,
  `secs` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pages_staff`
--

CREATE TABLE `pages_staff` (
  `id` int(11) NOT NULL,
  `subjects-id` int(11) NOT NULL,
  `menu-name` varchar(30) NOT NULL,
  `position` int(3) NOT NULL,
  `visible` tinyint(1) NOT NULL,
  `url` varchar(30) NOT NULL,
  `content` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pages_staff`
--

INSERT INTO `pages_staff` (`id`, `subjects-id`, `menu-name`, `position`, `visible`, `url`, `content`) VALUES
(1, 0, 'Home', 1, 1, 'staff_home1.php', 'This is the home page\r\n'),
(2, 0, 'Quiz', 2, 1, 'staff_quiz.php', 'Add and Edit question here.'),
(3, 0, 'Students', 3, 1, 'staff_student.php', 'Add and Edit new students.'),
(4, 0, 'About', 4, 1, 'staff_about.php', 'We promote and support education');

-- --------------------------------------------------------

--
-- Table structure for table `pages_student`
--

CREATE TABLE `pages_student` (
  `id` int(11) NOT NULL,
  `menu-name` varchar(15) NOT NULL,
  `position` int(3) NOT NULL,
  `visible` tinyint(1) NOT NULL,
  `url` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pages_student`
--

INSERT INTO `pages_student` (`id`, `menu-name`, `position`, `visible`, `url`) VALUES
(1, 'Home', 1, 1, 'homepage.php'),
(2, 'Quiz', 2, 1, 'quizpage.php'),
(4, 'About', 4, 1, 'aboutpage.php');

-- --------------------------------------------------------

--
-- Table structure for table `physics`
--

CREATE TABLE `physics` (
  `id` int(11) NOT NULL,
  `question_set` varchar(100) NOT NULL,
  `no_of_question` int(11) NOT NULL,
  `visible` int(1) NOT NULL,
  `hours` int(2) NOT NULL,
  `mins` int(2) NOT NULL,
  `secs` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `physics`
--

INSERT INTO `physics` (`id`, `question_set`, `no_of_question`, `visible`, `hours`, `mins`, `secs`) VALUES
(60, 'week1', 10, 1, 1, 4, 30),
(61, 'Week2', 10, 1, 0, 5, 30);

-- --------------------------------------------------------

--
-- Table structure for table `question`
--

CREATE TABLE `question` (
  `id` int(5) NOT NULL,
  `subject_id` int(2) NOT NULL,
  `content` text NOT NULL,
  `option1` varchar(70) NOT NULL,
  `option2` varchar(70) NOT NULL,
  `option3` varchar(70) NOT NULL,
  `option4` varchar(70) NOT NULL,
  `answer` varchar(11) NOT NULL,
  `image_name` varchar(30) NOT NULL,
  `subject` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `question`
--

INSERT INTO `question` (`id`, `subject_id`, `content`, `option1`, `option2`, `option3`, `option4`, `answer`, `image_name`, `subject`) VALUES
(12, 35, 'which of the following pairs of quantities are fundamental', 'area and luminous intensity', 'electric current and temperature', 'length and pressure', 'mass and momentum', '2', '', 'Physic'),
(13, 35, 'The heat generated when two palms are rubbed together is due to', 'friction', 'pressure', 'pull', 'tension', '1', '', 'Physic'),
(14, 35, 'Which of the following sets of quantities has its middle one expressed by both its magnitude and direction?', 'Displacement, volume, distance, speed', 'Density, volume, force', 'Displacement, mass, force', 'force, work, time', '4', '', 'Physic'),
(15, 35, 'Which of the following sets of quantities has its middle one expressed by both its magnitude and direction?', 'Displacement, volume, distance, speed', 'Density, volume, force', 'Displacement, mass, force', 'force, work, time', '4', '', 'Physic'),
(16, 2, 'A car starts  from rest with an acceleration of 4ms^-2. How long will the car to reach a velocity of 20ms^-1?', '4s', '5S', '16S', '24S', '2', '', 'MEE 211'),
(17, 35, 'Which of the following pairs of energy sources are renewable?', 'Biomass and petroleum', 'coal and solar', 'Hydro and wind', 'ocean tid and natural gas', '3', '', 'Physic'),
(18, 2, 'Which of the following properties is not used to select a thermometric liquid?', 'Boiling point', 'colour', 'conductivity', 'Expansivity', '0', '', 'MEE 211'),
(19, 35, 'which of these devices is used to detect charges only?', 'Capacitor', 'Electrophorus', 'Electroscope', 'proof plane', '3', '', 'Physic'),
(20, 35, 'Which of the following pairs of waves are both electromagnetic?', 'Light and sound', 'Micro and water', 'Radio and light', 'sound and water', '3', '', 'Physic'),
(21, 35, 'Which of the following sets of quantities has its middle one expressed by both its magnitude and direction?', 'Displacement, volume, distance, speed', 'Density, volume, force', 'Displacement, mass, force', 'force, work, time', '4', '', 'Physic'),
(22, 2, 'The image formed by a convex mirror is always \r\nI)at infinity\r\nII)real and inverted\r\nIII)diminished', 'I only', 'II only', 'III only', 'I and II only', '3', '', 'MEE 211'),
(23, 35, 'Which of the following are the emitter and detector of ultraviolet rays respectively?', 'Hot body and aerials', 'Incandescent solids and photo cell', 'Radioactive nuclide and photographic film', 'sparks and eye', '2', '', 'Physic'),
(24, 35, 'Which of the following are the emitter and detector of ultraviolet rays respectively?', 'Hot body and aerials', 'Incandescent solids and photo cell', 'Radioactive nuclide and photographic film', 'sparks and eye', '2', '', 'Physic');

-- --------------------------------------------------------

--
-- Table structure for table `question_set`
--

CREATE TABLE `question_set` (
  `id` int(11) NOT NULL,
  `set_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `question_set`
--

INSERT INTO `question_set` (`id`, `set_name`) VALUES
(29, 'week1'),
(31, 'week2');

-- --------------------------------------------------------

--
-- Table structure for table `staff_tbl`
--

CREATE TABLE `staff_tbl` (
  `id` int(4) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `image_name` varchar(25) NOT NULL,
  `email` varchar(30) NOT NULL,
  `phone_number` int(20) NOT NULL,
  `gender` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `staff_tbl`
--

INSERT INTO `staff_tbl` (`id`, `username`, `password`, `image_name`, `email`, `phone_number`, `gender`) VALUES
(12, 'highdee', 'c4ca4238a0b923820dcc509a6f75849b', 'DSC_0023.JPG', 'highdee.ai@gmail.com', 2147483647, 'male');

-- --------------------------------------------------------

--
-- Table structure for table `student_score`
--

CREATE TABLE `student_score` (
  `id` int(11) NOT NULL,
  `student_name` varchar(50) NOT NULL,
  `student_matric` int(6) NOT NULL,
  `score` int(3) NOT NULL,
  `subject` varchar(11) NOT NULL,
  `question_set` varchar(30) NOT NULL,
  `percentage_score` int(4) NOT NULL,
  `start_time` varchar(11) NOT NULL,
  `date` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `student_score`
--

INSERT INTO `student_score` (`id`, `student_name`, `student_matric`, `score`, `subject`, `question_set`, `percentage_score`, `start_time`, `date`) VALUES
(61, 'Aladesiun Idowu Adedamola', 142902, 0, 'physics', 'week1', 0, '08:44:06', '2016:Nov:Mon'),
(62, 'Aladesiun Idowu Adedamola', 142902, 0, 'physics', 'week1', 0, '08:47:09', '2016:Nov:Mon'),
(63, 'Aladesiun Idowu Adedamola', 142902, 0, 'physics', 'week1', 0, '08:48:53', '2016:Nov:Mon'),
(64, 'Aladesiun Idowu Adedamola', 142902, 0, 'physics', 'week1', 0, '08:49:16', '2016:Nov:Mon'),
(65, 'Aladesiun Idowu Adedamola', 142902, 0, 'physics', 'week1', 0, '09:11:03', '2016:Nov:Mon'),
(66, 'Aladesiun Idowu Adedamola', 142902, 0, 'physics', 'week1', 0, '09:22:10', '2016:Nov:Tue'),
(67, 'Aladesiun Idowu Adedamola', 142902, 0, 'physics', 'week1', 0, '04:37:37', '2016:Dec:Sat'),
(68, 'Aladesiun Idowu Adedamola', 142902, 0, 'physics', 'week1', 0, '05:01:35', '2016:Dec:Sun'),
(69, 'Aladesiun Idowu Adedamola', 142902, 0, 'physics', 'week1', 0, '09:14:27', '2016:Dec:Sun'),
(70, 'Aladesiun Idowu Adedamola', 142902, 2, 'physics', 'week1', 40, '08:46:07', '2016:Dec:Mon'),
(71, 'Aladesiun Idowu Adedamola', 142902, 0, 'physics', 'week1', 0, '04:58:20', '2016:Dec:Wed'),
(72, 'Aladesiun Idowu Adedamola', 142902, 0, 'physics', 'week1', 0, '02:16:48', '2017:Feb:Wed'),
(73, 'Aladesiun Idowu Adedamola', 142902, 0, 'physics', 'week1', 0, '12:21:39', '2017:Feb:Tue');

-- --------------------------------------------------------

--
-- Table structure for table `student_tbl`
--

CREATE TABLE `student_tbl` (
  `id` int(11) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `name` varchar(50) NOT NULL,
  `matric_no` int(10) NOT NULL,
  `department` varchar(50) NOT NULL,
  `phone_number` bigint(12) NOT NULL,
  `address` varchar(100) NOT NULL,
  `dob` varchar(15) NOT NULL,
  `gender` varchar(6) NOT NULL,
  `level` int(3) NOT NULL,
  `image_name` varchar(30) NOT NULL,
  `password` varchar(100) NOT NULL,
  `email` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `student_tbl`
--

INSERT INTO `student_tbl` (`id`, `firstname`, `lastname`, `name`, `matric_no`, `department`, `phone_number`, `address`, `dob`, `gender`, `level`, `image_name`, `password`, `email`) VALUES
(41, 'Aladesiun', 'Idowu Adedamola', 'Aladesiun Idowu Adedamola', 142902, 'CSE', 2347063716919, 'Aladesiun\'s house ,basiri oke ala,ado ekiti ekiti state', '7976', 'male', 200, 'DSC_0020.JPG', '6a734cedb6d49348764d15b285353bab', 'highdee.ai@gmail.com'),
(42, 'Ogunsakin', 'Favour', 'Ogunsakin Favour', 14372, 'civilEngineering', 23470853993, 'ikeja lagos', '1989', 'female', 300, 'IMG_20150430_112006.jpg', '827ccb0eea8a706c4c34a16891f84e7b', 'favour213@gmail.coom'),
(43, 'larry', 'johnson', 'larry johnson', 22901, 'anatomy', 234, 'dddd', '2003', 'male', 400, 'C360_2015-05-01-09-06-13-426.j', '827ccb0eea8a706c4c34a16891f84e7b', 'larry5@gmailc.com');

-- --------------------------------------------------------

--
-- Table structure for table `subjects`
--

CREATE TABLE `subjects` (
  `id` int(2) NOT NULL,
  `subject_name` varchar(40) NOT NULL,
  `subject_code` int(3) NOT NULL,
  `subject_img` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `subjects`
--

INSERT INTO `subjects` (`id`, `subject_name`, `subject_code`, `subject_img`) VALUES
(46, 'physics', 0, ''),
(57, 'Mathematics', 0, ''),
(71, 'Computer Science', 0, ''),
(73, 'chemistry', 0, '');

-- --------------------------------------------------------

--
-- Table structure for table `week1`
--

CREATE TABLE `week1` (
  `id` int(11) NOT NULL,
  `question` varchar(500) NOT NULL,
  `option1` varchar(400) NOT NULL,
  `option2` varchar(400) NOT NULL,
  `option3` varchar(400) NOT NULL,
  `option4` varchar(400) NOT NULL,
  `answer` int(1) NOT NULL,
  `subject` varchar(60) NOT NULL,
  `admin` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `week1`
--

INSERT INTO `week1` (`id`, `question`, `option1`, `option2`, `option3`, `option4`, `answer`, `subject`, `admin`) VALUES
(3, 'Which of the following pairs of quantities are fundamental', 'area and luminous intensity', 'electric current and temperature,electric current and temperature,electric current and temperature,electric current and temperature', 'length and pressure', 'mass and momentum', 4, 'physics', 'highdee'),
(4, 'The heat generated when two palms are rubbed together is due to', 'friction', 'pressure', 'pull', 'reaction', 4, 'physics', 'highdee'),
(5, 'Which of the followinf sets of quantities has its maddle one expressed by both its magnitude and direction', 'Displacement, volume, distance, speed', 'density ,volume,force', 'Displacement, mass, force', 'work,force,time', 1, 'physics', 'highdee'),
(6, 'A car starts from rest with an acceleration of 4 ms^-2\r\n.How long will it take the car to reach a velocity of 20 ms^-1.', '4s', '5s', '16s', '24s', 1, 'physics', 'highdee'),
(8, 'Which of these devices is used to detect charges only', 'Capacitor', 'electrophorus', 'Electroscope', 'ligthening conductor', 1, 'physics', 'highdee'),
(9, 'The image formed by a convex mirror is always?\r\n(i) at infinity \r\n(ii) real and inverted\r\n(iii) diminished\r\nWhich of the following statement is correct?', 'i only', 'ii only', 'iii only', 'I and II only', 4, 'physics', 'highdee'),
(10, 'Which of the following are the emitter and detector of ultraviolet rays respectively?', 'Hot body and aerials', 'Incandescent solids and photo cell', 'Radioactive nuclide and photographic film', 'sparks and eye', 3, 'physics', 'highdee'),
(11, 'For a short sighted person,light rays from a point on a very distant object is focused', 'behind the retina by a diverging lens', 'behind the retina', 'infront of the retina', 'on the blind spot', 4, 'physics', 'highdee'),
(13, 'Which of the following statement is an application of a capacitor? A capacitor can be used to', 'power tv set.', 'prevent sparks in switches', 'produce high current', 'produce charges', 3, 'physics', 'highdee'),
(14, 'In which of the following fields is the force proportional to the masses of the objects', 'electric', 'electromagnetic', 'Electroscope', 'Gravitational', 3, 'physics', 'highdee'),
(15, 'When a stone and feather are thrown up the same time, the feather returns to the ground much later due to', 'acceleration due to gravity', 'air resistance', 'gravitational foce.', 'its weight.', 3, 'chemistry', 'highdee'),
(18, 'A device used for obtaining high e.m.f from a low a.c voltage is', 'd.c generator', 'dynamo', 'electric motor', 'induction coil', 4, 'chemistry', 'highdee');

-- --------------------------------------------------------

--
-- Table structure for table `week2`
--

CREATE TABLE `week2` (
  `id` int(11) NOT NULL,
  `question` varchar(500) NOT NULL,
  `option1` varchar(400) NOT NULL,
  `option2` varchar(400) NOT NULL,
  `option3` varchar(400) NOT NULL,
  `option4` varchar(400) NOT NULL,
  `answer` int(1) NOT NULL,
  `subject` varchar(60) NOT NULL,
  `admin` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `week2`
--

INSERT INTO `week2` (`id`, `question`, `option1`, `option2`, `option3`, `option4`, `answer`, `subject`, `admin`) VALUES
(3, 'The direction of current flow in an electric motor is reversed by a/an', 'armature.', 'carbon-brush', 'coil', 'commutator', 4, 'chemistry', 'highdee'),
(4, 'When a stone and feather are thrown up the same time, the feather returns to the ground much later due to', 'acceleration due to gravity', 'air resistance', 'gravitational foce.', 'its weight.', 3, 'chemistry', 'highdee');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `chemistry`
--
ALTER TABLE `chemistry`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `computer_science`
--
ALTER TABLE `computer_science`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comp_hunn`
--
ALTER TABLE `comp_hunn`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mathematics`
--
ALTER TABLE `mathematics`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pages_staff`
--
ALTER TABLE `pages_staff`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pages_student`
--
ALTER TABLE `pages_student`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `physics`
--
ALTER TABLE `physics`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `question`
--
ALTER TABLE `question`
  ADD PRIMARY KEY (`id`,`subject_id`);

--
-- Indexes for table `question_set`
--
ALTER TABLE `question_set`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `staff_tbl`
--
ALTER TABLE `staff_tbl`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `student_score`
--
ALTER TABLE `student_score`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `student_tbl`
--
ALTER TABLE `student_tbl`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subjects`
--
ALTER TABLE `subjects`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `week1`
--
ALTER TABLE `week1`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `week2`
--
ALTER TABLE `week2`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `chemistry`
--
ALTER TABLE `chemistry`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `computer_science`
--
ALTER TABLE `computer_science`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `comp_hunn`
--
ALTER TABLE `comp_hunn`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `mathematics`
--
ALTER TABLE `mathematics`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `pages_staff`
--
ALTER TABLE `pages_staff`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `pages_student`
--
ALTER TABLE `pages_student`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `physics`
--
ALTER TABLE `physics`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;
--
-- AUTO_INCREMENT for table `question`
--
ALTER TABLE `question`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
--
-- AUTO_INCREMENT for table `question_set`
--
ALTER TABLE `question_set`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;
--
-- AUTO_INCREMENT for table `staff_tbl`
--
ALTER TABLE `staff_tbl`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `student_score`
--
ALTER TABLE `student_score`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=74;
--
-- AUTO_INCREMENT for table `student_tbl`
--
ALTER TABLE `student_tbl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;
--
-- AUTO_INCREMENT for table `subjects`
--
ALTER TABLE `subjects`
  MODIFY `id` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=74;
--
-- AUTO_INCREMENT for table `week1`
--
ALTER TABLE `week1`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT for table `week2`
--
ALTER TABLE `week2`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
