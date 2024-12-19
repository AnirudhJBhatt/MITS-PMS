-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 06, 2024 at 04:48 PM
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
-- Database: `mits_pms`
--

-- --------------------------------------------------------

--
-- Table structure for table `application`
--

CREATE TABLE `application` (
  `App_ID` int(11) NOT NULL,
  `Stud_ID` varchar(50) NOT NULL,
  `J_ID` int(11) NOT NULL,
  `C_ID` int(10) NOT NULL,
  `App_Status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `application`
--

INSERT INTO `application` (`App_ID`, `Stud_ID`, `J_ID`, `C_ID`, `App_Status`) VALUES
(6, '23MCA08', 1, 1001, 'Approved'),
(9, '23MCA08', 2, 1002, 'Pending'),
(10, '23MCA01', 1, 1001, 'Approved'),
(11, '23MCA01', 2, 1002, 'Pending');

-- --------------------------------------------------------

--
-- Table structure for table `company`
--

CREATE TABLE `company` (
  `C_ID` int(50) NOT NULL,
  `C_Name` varchar(50) NOT NULL,
  `C_Type` varchar(50) NOT NULL,
  `C_YOE` varchar(15) NOT NULL,
  `C_Address` varchar(100) NOT NULL,
  `C_Email` varchar(50) NOT NULL,
  `C_Phone` varchar(50) NOT NULL,
  `C_Person` varchar(50) NOT NULL,
  `C_Website` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `company`
--

INSERT INTO `company` (`C_ID`, `C_Name`, `C_Type`, `C_YOE`, `C_Address`, `C_Email`, `C_Phone`, `C_Person`, `C_Website`) VALUES
(1001, 'EY Wavespace', 'Cyber Security', '2000-01-01', 'Trivandrum', 'ey@gmail.com', '1234567890', 'Santhosh', 'www.ey.co.in'),
(1002, 'Infosys', 'IT', '2022-01-01', 'Kochi', 'infosys@gmail.com', '1357924680', 'Varun', 'www.infosys.com'),
(1003, 'Tech Innovators', 'Technology', '2010', '123 Tech Park, Silicon Valley', 'info@techinnovators.com', '1234567890', 'John Smith', 'www.techinnovators.com'),
(1004, 'Green Energy Solutions', 'Energy', '2015', '456 Solar Ave, Austin', 'contact@greenenergy.com', '2345678901', 'Emma Green', 'www.greenenergy.com'),
(1005, 'Urban Builders', 'Construction', '2008', '789 Build St, New York', 'info@urbanbuilders.com', '3456789012', 'Michael Brown', 'www.urbanbuilders.com'),
(1006, 'HealthFirst Pharmaceuticals', 'Healthcare', '2012', '321 Wellness Rd, Boston', 'support@healthfirst.com', '4567890123', 'Laura White', 'www.healthfirst.com'),
(1007, 'EduSmart Systems', 'Education', '2018', '654 Knowledge Blvd, Chicago', 'hello@edusmart.com', '5678901234', 'Chris Black', 'www.edusmart.com');

-- --------------------------------------------------------

--
-- Table structure for table `job`
--

CREATE TABLE `job` (
  `J_ID` int(11) NOT NULL,
  `J_Title` varchar(50) NOT NULL,
  `J_Desc` varchar(50) NOT NULL,
  `J_Type` varchar(50) NOT NULL,
  `J_Loc` varchar(50) NOT NULL,
  `J_Eligibility` varchar(50) NOT NULL,
  `J_Package` varchar(50) NOT NULL,
  `J_Date` varchar(50) NOT NULL,
  `C_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `job`
--

INSERT INTO `job` (`J_ID`, `J_Title`, `J_Desc`, `J_Type`, `J_Loc`, `J_Eligibility`, `J_Package`, `J_Date`, `C_ID`) VALUES
(1, 'Software Developer', 'Developing softwares', 'Full Time', 'Kochi', 'CGPA 7 and above', '12LPA', '2024-07-31', 1001),
(2, 'Software Tester', 'Testing softwares', 'Full Time', 'Kochi', 'CGPA 7 and above', '24LPA', '2024-08-07', 1002);

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `ID` int(11) NOT NULL,
  `user_id` varchar(30) NOT NULL,
  `Password` varchar(30) NOT NULL,
  `Role` varchar(10) NOT NULL,
  `account` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`ID`, `user_id`, `Password`, `Role`, `account`) VALUES
(1, '1003', 'Company123*', 'Company', 'Activate'),
(2, '1004', 'Company123*', 'Company', 'Activate'),
(3, '1005', 'Company123*', 'Company', 'Activate'),
(4, '1006', 'Company123*', 'Company', 'Activate'),
(5, '1007', 'Company123*', 'Company', 'Activate'),
(100, 'Sheila100', 'teacher123*', 'Teacher', 'Activate'),
(123, 'admin@gmail.com', 'admin123*', 'Admin', ''),
(321, 'staff1@gmail.com', 'teacher123*', 'Teacher', 'Activate'),
(5004, '23MCA08', 'Student123*', 'Student', 'Activate'),
(5005, '1001', 'Company123*', 'Company', 'Activate'),
(5008, '1002', 'Company123*', 'Company', 'Activate'),
(5009, '1003', 'Company123*', 'Company', 'Activate'),
(5022, '23MCA11', 'Student123*', 'Student', 'Activate'),
(5023, '23MCA01', 'Student123*', 'Student', 'Activate'),
(5024, '23MCA02', 'Student123*', 'Student', 'Activate'),
(5025, '23MCA03', 'Student123*', 'Student', 'Activate'),
(5026, '23MCA04', 'Student123*', 'Student', 'Activate'),
(5027, '23MCA05', 'Student123*', 'Student', 'Activate');

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `Stud_ID` varchar(50) NOT NULL,
  `Stud_Name` varchar(50) NOT NULL,
  `Stud_DOB` date NOT NULL,
  `Stud_Gender` varchar(10) NOT NULL,
  `Stud_Mob` varchar(15) NOT NULL,
  `Stud_Email` varchar(50) NOT NULL,
  `Stud_Address` varchar(250) NOT NULL,
  `Stud_Caste` varchar(50) NOT NULL,
  `Stud_M_T` varchar(50) NOT NULL,
  `Stud_Course` varchar(50) NOT NULL,
  `Stud_Batch` varchar(25) NOT NULL,
  `Stud_Year` varchar(11) NOT NULL,
  `Stud_ID_No` varchar(15) NOT NULL,
  `Stud_Reg_No` varchar(50) NOT NULL,
  `Stud_Father_Name` varchar(50) NOT NULL,
  `Stud_Father_Occ` varchar(50) NOT NULL,
  `Stud_Father_No` varchar(11) NOT NULL,
  `Stud_Mother_Name` varchar(50) NOT NULL,
  `Stud_Mother_Occ` varchar(50) NOT NULL,
  `Stud_Mother_No` varchar(11) NOT NULL,
  `Guardian_Email` varchar(50) NOT NULL,
  `Annual_Income` int(11) NOT NULL,
  `UG_Univ` varchar(50) NOT NULL,
  `UG_College` varchar(50) NOT NULL,
  `UG_Course` varchar(50) NOT NULL,
  `YOP_UG` int(5) NOT NULL,
  `Marks_UG` int(15) NOT NULL,
  `Board_12th` varchar(25) NOT NULL,
  `School_12th` varchar(50) NOT NULL,
  `Stream_12th` varchar(50) NOT NULL,
  `YOP_12th` int(5) NOT NULL,
  `Marks_12th` int(15) NOT NULL,
  `Board_10th` varchar(25) NOT NULL,
  `School_10th` varchar(50) NOT NULL,
  `YOP_10th` int(5) NOT NULL,
  `Marks_10th` int(15) NOT NULL,
  `CGPA` int(5) NOT NULL,
  `Stud_Image` varchar(50) NOT NULL,
  `Mark_List_10th` varchar(50) NOT NULL,
  `Mark_List_12th` varchar(50) NOT NULL,
  `Mark_List_UG` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`Stud_ID`, `Stud_Name`, `Stud_DOB`, `Stud_Gender`, `Stud_Mob`, `Stud_Email`, `Stud_Address`, `Stud_Caste`, `Stud_M_T`, `Stud_Course`, `Stud_Batch`, `Stud_Year`, `Stud_ID_No`, `Stud_Reg_No`, `Stud_Father_Name`, `Stud_Father_Occ`, `Stud_Father_No`, `Stud_Mother_Name`, `Stud_Mother_Occ`, `Stud_Mother_No`, `Guardian_Email`, `Annual_Income`, `UG_Univ`, `UG_College`, `UG_Course`, `YOP_UG`, `Marks_UG`, `Board_12th`, `School_12th`, `Stream_12th`, `YOP_12th`, `Marks_12th`, `Board_10th`, `School_10th`, `YOP_10th`, `Marks_10th`, `CGPA`, `Stud_Image`, `Mark_List_10th`, `Mark_List_12th`, `Mark_List_UG`) VALUES
('23MCA01', 'John Doe', '2000-05-14', 'Male', '1234567890', 'john@example.com', '123 Main St', 'General', 'A', 'B.Tech', 'CS', '1', '123456789012', 'REG123', 'Michael Doe', 'Engineer', '1234567890', 'Sarah Doe', 'Teacher', '0987654321', 'john.guardian@example.com', 50000, 'XYZ University', 'XYZ College', 'B.Tech', 2022, 85, 'CBSE', 'ABC High School', 'Science', 2018, 90, 'CBSE', 'XYZ School', 2016, 88, 4, 'image1.jpg', '10th.pdf', '12th.pdf', 'UG.pdf'),
('23MCA02', 'Jane Smith', '2001-08-22', 'Female', '2345678901', 'jane@example.com', '456 Elm St', 'OBC', 'B', 'B.Tech', 'CE', '2', '123456789012', 'REG124', 'David Smith', 'Doctor', '2345678901', 'Maria Smith', 'Nurse', '1234567890', 'jane.guardian@example.com', 60000, 'ABC University', 'ABC College', 'B.Sc', 2021, 88, 'ICSE', 'XYZ High School', 'Commerce', 2019, 85, 'ICSE', 'DEF School', 2017, 82, 4, 'image2.jpg', '10th-2.pdf', '12th-2.pdf', 'UG-2.pdf'),
('23MCA03', 'Mark Johnson', '1999-12-10', 'Male', '3456789012', 'mark@example.com', '789 Oak St', 'SC', 'A', 'B.Tech', 'EEE', '1', '123456789012', 'REG125', 'Tom Johnson', 'Businessman', '3456789012', 'Linda Johnson', 'Engineer', '2345678901', 'mark.guardian@example.com', 70000, 'LMN University', 'LMN College', 'B.Com', 2020, 80, 'State Board', 'LMN High School', 'Science', 2017, 78, 'State Board', 'GHI School', 2015, 75, 4, 'image3.jpg', '10th-3.pdf', '12th-3.pdf', 'UG-3.pdf'),
('23MCA04', 'Emily Davis', '2002-03-15', 'Female', '4567890123', 'emily@example.com', '321 Pine St', 'ST', 'B', 'B.Tech', 'CS-AI', '2', '123456789012', 'REG126', 'Robert Davis', 'Lawyer', '4567890123', 'Susan Davis', 'Chef', '3456789012', 'emily.guardian@example.com', 80000, 'PQR University', 'PQR College', 'B.A.', 2021, 90, 'CBSE', 'PQR High School', 'Arts', 2019, 87, 'CBSE', 'JKL School', 2017, 84, 4, 'image4.jpg', '10th-4.pdf', '12th-4.pdf', 'UG-4.pdf'),
('23MCA05', 'Chris Brown', '2003-11-20', 'Male', '5678901234', 'chris@example.com', '654 Cedar St', 'General', 'A', 'B.Tech', 'ME', '1', '123456789012', 'REG127', 'Paul Brown', 'Mechanic', '5678901234', 'Nancy Brown', 'Teacher', '4567890123', 'chris.guardian@example.com', 45000, 'DEF University', 'DEF College', 'BCA', 2022, 86, 'State Board', 'DEF High School', 'Commerce', 2020, 89, 'State Board', 'MNO School', 2018, 83, 4, 'image5.jpg', '10th-5.pdf', '12th-5.pdf', 'UG-5.pdf'),
('23MCA08', 'Anirudh J Bhatt', '2003-01-14', 'Male', '8281020395', '23mca08@mgits.ac.in', 'Kochi', 'Hindu', 'Konkani', 'MCA', 'Computer Applications', '3', '123456789012', 'MUT23MCA-2011', 'V Jagannath Bhatt', 'Retired', '9188130395', 'Chandrakala', 'House Wife', '8547063395', 'jagannathvbhatyahoo.co.in', 3000000, 'MG University', 'SRBS Gujarati College', 'BCA', 2023, 87, 'CBSE', 'BVMG', 'Computer Science', 2020, 75, 'CBSE', 'BVMG', 2018, 80, 9, 'student.png', 'student.png', 'ANIRUDH J BHATT.png', 'Blank Page.pdf');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `application`
--
ALTER TABLE `application`
  ADD PRIMARY KEY (`App_ID`),
  ADD KEY `Stud_ID` (`Stud_ID`),
  ADD KEY `J_ID` (`J_ID`),
  ADD KEY `C_ID` (`C_ID`);

--
-- Indexes for table `company`
--
ALTER TABLE `company`
  ADD PRIMARY KEY (`C_ID`);

--
-- Indexes for table `job`
--
ALTER TABLE `job`
  ADD PRIMARY KEY (`J_ID`),
  ADD KEY `C_ID` (`C_ID`);

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`Stud_ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `application`
--
ALTER TABLE `application`
  MODIFY `App_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `job`
--
ALTER TABLE `job`
  MODIFY `J_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `login`
--
ALTER TABLE `login`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5028;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `application`
--
ALTER TABLE `application`
  ADD CONSTRAINT `application_ibfk_1` FOREIGN KEY (`Stud_ID`) REFERENCES `student` (`Stud_ID`),
  ADD CONSTRAINT `application_ibfk_2` FOREIGN KEY (`J_ID`) REFERENCES `job` (`J_ID`),
  ADD CONSTRAINT `application_ibfk_3` FOREIGN KEY (`C_ID`) REFERENCES `company` (`C_ID`);

--
-- Constraints for table `job`
--
ALTER TABLE `job`
  ADD CONSTRAINT `job_ibfk_1` FOREIGN KEY (`C_ID`) REFERENCES `company` (`C_ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
