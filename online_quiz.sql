-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 08, 2024 at 11:40 AM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `online_quiz`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_data`
--

CREATE TABLE `admin_data` (
  `id` int(5) NOT NULL,
  `fistname` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `contact_no` varchar(50) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin_data`
--

INSERT INTO `admin_data` (`id`, `fistname`, `lastname`, `email`, `contact_no`, `gender`, `username`, `password`) VALUES
(1, 'ashish', 'kalsara', 'ashishkalsara@gmail.com', '9499648505', 'male', 'admin', 'admin@123');

-- --------------------------------------------------------

--
-- Table structure for table `exam_category`
--

CREATE TABLE `exam_category` (
  `id` int(5) NOT NULL,
  `category` varchar(100) NOT NULL,
  `exam_time` varchar(50) NOT NULL,
  `imgpath` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `exam_category`
--

INSERT INTO `exam_category` (`id`, `category`, `exam_time`, `imgpath`) VALUES
(1, 'php', '5', 'images/php.jpg'),
(2, 'html', '8', 'images/html.jpeg'),
(3, 'css', '5', 'images/css.jpeg'),
(4, 'java', '8', 'images/java.png'),
(5, 'c++', '10', 'images/c.jpeg'),
(6, 'linux', '8', 'images/linux.png'),
(7, 'python', '10', 'images/python.jpeg'),
(8, 'j2ee', '8', 'images/java.png');

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

CREATE TABLE `questions` (
  `id` int(10) NOT NULL,
  `question_no` varchar(20) NOT NULL,
  `question` varchar(500) NOT NULL,
  `opt1` varchar(200) NOT NULL,
  `opt2` varchar(200) NOT NULL,
  `opt3` varchar(200) NOT NULL,
  `opt4` varchar(200) NOT NULL,
  `answer` varchar(200) NOT NULL,
  `category` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `questions`
--

INSERT INTO `questions` (`id`, `question_no`, `question`, `opt1`, `opt2`, `opt3`, `opt4`, `answer`, `category`) VALUES
(1, '1', 'What does PHP stand for?', 'Personal Home Page', 'Hypertext Preprocessor', 'Preprocessor Home Page', ' Private Hypertext Page', 'Hypertext Preprocessor', 'php'),
(2, '2', 'What is the correct way to declare a variable in PHP?', '$variable;', 'var variable;', ' variable $;', 'declare variable;', '$variable;', 'php'),
(3, '3', 'How can you include a file in PHP?', ' include \"file.php\";', 'include file.php;', ' require \"file.php\";', ' Both A and C', ' Both A and C', 'php'),
(4, '4', 'What is the purpose of the isset() function?', 'To check if a variable is empty', 'To check if a variable is set and is not NULL', ' To delete a variable', 'To create a variable', 'To check if a variable is set and is not NULL', 'php'),
(5, '5', 'Which of the following is used to connect to a MySQL database in PHP?', 'mysqli_connect()', 'db_connect()', 'mysql_connect()', 'connect_mysql()', 'mysqli_connect()', 'php'),
(6, '6', 'What is the correct syntax to create a function in PHP?', 'function myFunction() {}', 'create myFunction() {}', 'define myFunction() {}', 'function: myFunction() {}', 'function myFunction() {}', 'php'),
(7, '7', 'How do you comment in PHP?', '// This is a comment', ' /* This is a comment */', 'Both A and B', '<!-- This is a comment -->', 'Both A and B', 'php'),
(8, '8', 'Which of the following operators is used for concatenation in PHP?', '+', '.', '&', ',', '.', 'php'),
(9, '9', 'What does the strlen() function do?', 'Counts the number of words in a string', 'Returns the length of a string', 'Converts a string to lowercase', 'Reverses a string', 'Returns the length of a string', 'php'),
(10, '10', 'Which of the following is a loop structure in PHP?', 'for', 'while', 'foreach', 'All of the above', 'All of the above', 'php'),
(11, '11', 'What will be the output of echo 5 + \"10th\" ;?', '15', '510', '5', 'Error', '15', 'php'),
(12, '12', 'Which of the following functions can be used to remove whitespace from the beginning and end of a string?', 'trim()', 'strip()', 'clean()', 'clear()', 'trim()', 'php'),
(13, '13', 'Which PHP superglobal is used to access session variables?', '$_SESSION', '$_COOKIE', '$_POST', '$_GET', '$_SESSION', 'php'),
(14, '14', 'What is the default session timeout in PHP?', '10 minutes', '30 minutes', '20 minutes', 'It depends on server settings', 'It depends on server settings', 'php'),
(15, '15', 'How do you define a constant in PHP?', 'const NAME = \"value\";', 'define(\"NAME\", \"value\");', 'constant NAME = \"value\";', 'Both A and B', 'Both A and B', 'php'),
(16, '16', 'Which PHP function is used to escape special characters in a string for use in an SQL statement?', 'mysql_escape_string()', 'mysqli_real_escape_string()', 'escape_string()', 'addslashes()', 'mysqli_real_escape_string()', 'php'),
(17, '17', 'What does the die() function do in PHP?', 'Ends the script execution', 'Outputs a message and ends the script', 'Both A and B', 'Does nothing', 'Both A and B', 'php'),
(18, '18', 'How do you declare an array in PHP?', '$array = array();', '$array = {};', '$array = [];', 'Both A and C', 'Both A and C', 'php'),
(19, '19', 'Which of the following is not a valid variable name in PHP?', '$var', '$1var', '$_var', '$var_name', '$1var', 'php'),
(20, '20', 'Which function is used to find the largest number in an array?', 'max()', 'largest()', 'high()', 'find_max()', 'max()', 'php');

-- --------------------------------------------------------

--
-- Table structure for table `result`
--

CREATE TABLE `result` (
  `result_id` int(5) NOT NULL,
  `user_id` int(5) NOT NULL,
  `username` varchar(50) NOT NULL,
  `exam_type` varchar(50) NOT NULL,
  `total_question` varchar(10) NOT NULL,
  `correct_answer` varchar(10) NOT NULL,
  `wrong_answer` varchar(10) NOT NULL,
  `exam_date` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `result`
--

INSERT INTO `result` (`result_id`, `user_id`, `username`, `exam_type`, `total_question`, `correct_answer`, `wrong_answer`, `exam_date`) VALUES
(1, 3, 'ashish', 'php', '20', '7', '13', '2024-10-08');

-- --------------------------------------------------------

--
-- Table structure for table `user_data`
--

CREATE TABLE `user_data` (
  `user_id` int(5) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `contact_no` varchar(11) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_data`
--

INSERT INTO `user_data` (`user_id`, `firstname`, `lastname`, `email`, `contact_no`, `gender`, `username`, `password`) VALUES
(3, 'ashish', 'kalsara', 'ashishkalsara@gmail.com', '9499648505', 'male', 'ashish', 'ashish@123'),
(4, 'jay', 'pandya', 'jaypandya@gmail.com', '1234567890', 'male', 'jay', 'jay@12345'),
(5, 'kunj', 'ramdevputra', 'kunjramdevputra@gmail.com', '1234567890', 'male', 'kunj', 'kunj@1234'),
(6, 'jaymin', 'dholkiya', 'jaymindholakiya@gmail.com', '1234567890', 'male', 'jaymin', 'jaymin@123'),
(7, 'raj', 'desai', 'rajdesai@gmail.com', '1234567890', 'male', 'raj', 'raj@12345'),
(8, 'ankit', 'dafda', 'ankitdafda@gmail.com', '1234567890', 'male', 'ankit', 'ankit@123'),
(9, 'dhruv', 'makwana', 'dhruvmakwana@gmail.com', '1234567890', 'male', 'dhruv', 'dhruv@123'),
(10, 'maulik', 'devganiya', 'maulikdevganiya@gmail.com', '1234567890', 'male', 'maulik', 'maulik@123'),
(11, 'hardik', 'gondaliya', 'hardikgondaliya@gmail.com', '1234567890', 'male', 'hardik', 'hardik@123'),
(12, 'abhay', 'makwana', 'abhaymakwana@gmail.com', '1234567890', 'male', 'abhay', 'abhay@123');

-- --------------------------------------------------------

--
-- Table structure for table `user_feedback`
--

CREATE TABLE `user_feedback` (
  `user_id` int(10) NOT NULL,
  `user_name` varchar(30) NOT NULL,
  `name` varchar(30) NOT NULL,
  `email` varchar(30) NOT NULL,
  `message` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_feedback`
--

INSERT INTO `user_feedback` (`user_id`, `user_name`, `name`, `email`, `message`) VALUES
(3, 'ashish', 'ashish', 'ashish@gmail.com', 'hello sir');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_data`
--
ALTER TABLE `admin_data`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `exam_category`
--
ALTER TABLE `exam_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `result`
--
ALTER TABLE `result`
  ADD PRIMARY KEY (`result_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `user_data`
--
ALTER TABLE `user_data`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_data`
--
ALTER TABLE `admin_data`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `exam_category`
--
ALTER TABLE `exam_category`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `questions`
--
ALTER TABLE `questions`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `result`
--
ALTER TABLE `result`
  MODIFY `result_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `user_data`
--
ALTER TABLE `user_data`
  MODIFY `user_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `result`
--
ALTER TABLE `result`
  ADD CONSTRAINT `result_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user_data` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
