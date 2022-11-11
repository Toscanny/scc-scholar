-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 26, 2022 at 02:22 AM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sms`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_admin`
--

CREATE TABLE `tbl_admin` (
  `admin_id` int(11) NOT NULL,
  `admin_idno` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `admin_email_address` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `admin_password` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `admin_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `admin_position` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `admin_address` varchar(300) COLLATE utf8_unicode_ci NOT NULL,
  `admin_contact_no` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `admin_verification_code` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `admin_user_otp` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `admin_email_verify` varchar(10) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tbl_admin`
--

INSERT INTO `tbl_admin` (`admin_id`, `admin_idno`, `admin_email_address`, `admin_password`, `admin_name`, `admin_position`, `admin_address`, `admin_contact_no`, `admin_verification_code`, `admin_user_otp`, `admin_email_verify`) VALUES
(1, 'SCC-0001368', 'unswaa20@gmail.com', '$argon2i$v=19$m=65536,t=4,p=1$TDZHeTg0NXp5S2JUVFZNSg$36gjUAd6KxFAcsDzinlxtKthHoOkoJesox3WUuPEUs8', 'Administrator', 'Chairman', 'Natalio B. Bacalso S National Hwy, Minglanilla, Cebu', '(032) 490 8511', '269010', '', 'Yes');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_student`
--

CREATE TABLE `tbl_student` (
  `s_id` int(11) NOT NULL,
  `ss_id` varchar(20) DEFAULT NULL,
  `sfname` varchar(50) DEFAULT NULL,
  `smname` varchar(50) DEFAULT NULL,
  `slname` varchar(50) DEFAULT NULL,
  `snext` varchar(10) DEFAULT NULL,
  `sdbirth` varchar(10) DEFAULT NULL,
  `sgender` varchar(10) DEFAULT NULL,
  `saddress` text DEFAULT NULL,
  `szcode` varchar(10) DEFAULT NULL,
  `scontact` varchar(20) DEFAULT NULL,
  `semail` varchar(50) DEFAULT NULL,
  `sctship` varchar(20) DEFAULT NULL,
  `scivilstat` varchar(20) DEFAULT NULL,
  `spbirth` text DEFAULT NULL,
  `sdisability` varchar(20) DEFAULT NULL,
  `s4psno` varchar(20) DEFAULT NULL,
  `spwdid` varchar(20) DEFAULT NULL,
  `srappsship` text DEFAULT NULL,
  `srappnas` text DEFAULT NULL,
  `sbos` text DEFAULT NULL,
  `ssskills` text DEFAULT NULL,
  `stwinterest` text DEFAULT NULL,
  `ssdfile` varchar(10) DEFAULT NULL,
  `sgfname` varchar(50) DEFAULT NULL,
  `sgmname` varchar(50) DEFAULT NULL,
  `sglname` varchar(50) DEFAULT NULL,
  `sgnext` varchar(10) DEFAULT NULL,
  `sglstatus` varchar(10) DEFAULT NULL,
  `sgeduc` text DEFAULT NULL,
  `sgcontact` varchar(20) DEFAULT NULL,
  `sgaddress` text DEFAULT NULL,
  `sgoccu` varchar(30) DEFAULT NULL,
  `sgcompany` varchar(30) DEFAULT NULL,
  `sffname` varchar(50) DEFAULT NULL,
  `sfmname` varchar(50) DEFAULT NULL,
  `sflname` varchar(50) DEFAULT NULL,
  `sfnext` varchar(10) DEFAULT NULL,
  `sflstatus` varchar(10) DEFAULT NULL,
  `sfeduc` text DEFAULT NULL,
  `sfcontact` varchar(20) DEFAULT NULL,
  `sfaddress` text DEFAULT NULL,
  `sfoccu` varchar(30) DEFAULT NULL,
  `sfcompany` varchar(30) DEFAULT NULL,
  `smfname` varchar(50) DEFAULT NULL,
  `smmname` varchar(50) DEFAULT NULL,
  `smlname` varchar(50) DEFAULT NULL,
  `smnext` varchar(10) DEFAULT NULL,
  `smlstatus` varchar(10) DEFAULT NULL,
  `smeduc` text DEFAULT NULL,
  `smcontact` varchar(20) DEFAULT NULL,
  `smaddress` text DEFAULT NULL,
  `smoccu` varchar(30) DEFAULT NULL,
  `smcompany` varchar(30) DEFAULT NULL,
  `snsibling` varchar(10) DEFAULT NULL,
  `spcyincome` varchar(50) DEFAULT NULL,
  `spschname` text DEFAULT NULL,
  `spsaddress` text DEFAULT NULL,
  `spstype` varchar(20) DEFAULT NULL,
  `spscourse` varchar(20) DEFAULT NULL,
  `spsyrlvl` varchar(20) DEFAULT NULL,
  `spsgwa` int(10) DEFAULT NULL,
  `spsraward` text DEFAULT NULL,
  `spsdawardrceive` date DEFAULT NULL,
  `scsintend` text DEFAULT NULL,
  `scsadd` text DEFAULT NULL,
  `scschooltype` varchar(20) DEFAULT NULL,
  `sccourse` varchar(20) DEFAULT NULL,
  `sccourseprio` varchar(20) DEFAULT NULL,
  `scsyrlvl` varchar(20) DEFAULT NULL,
  `spass` varchar(100) DEFAULT NULL,
  `sdsprc` varchar(20) DEFAULT NULL,
  `sdsprcstat` varchar(20) DEFAULT NULL,
  `sdspgm` varchar(20) DEFAULT NULL,
  `sdspgmstat` varchar(20) DEFAULT NULL,
  `sdspcr` varchar(20) DEFAULT NULL,
  `sdspcrstat` varchar(20) DEFAULT NULL,
  `sdstbytpic` varchar(20) DEFAULT NULL,
  `sdstbytpicstat` varchar(20) DEFAULT NULL,
  `sdsbrgyin` varchar(20) DEFAULT NULL,
  `sdsbrgyinstat` varchar(20) DEFAULT NULL,
  `sdscef` varchar(20) DEFAULT NULL,
  `sdscefstat` varchar(20) DEFAULT NULL,
  `sdspsa` varchar(20) DEFAULT NULL,
  `sdspsastat` varchar(20) DEFAULT NULL,
  `sdsobr` varchar(20) DEFAULT NULL,
  `sdsobrstat` varchar(20) DEFAULT NULL,
  `s_scholarship_note` text DEFAULT NULL,
  `s_added_on` date DEFAULT NULL,
  `s_applied_on` date DEFAULT NULL,
  `s_verification_code` varchar(100) DEFAULT NULL,
  `s_user_otp` varchar(10) NOT NULL,
  `s_email_verify` varchar(10) DEFAULT NULL,
  `s_account_status` varchar(20) DEFAULT NULL,
  `s_grant_stat` varchar(20) NOT NULL,
  `s_scholar_stat` varchar(20) NOT NULL,
  `s_scholarship_type` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_student`
--

INSERT INTO `tbl_student` (`s_id`, `ss_id`, `sfname`, `smname`, `slname`, `snext`, `sdbirth`, `sgender`, `saddress`, `szcode`, `scontact`, `semail`, `sctship`, `scivilstat`, `spbirth`, `sdisability`, `s4psno`, `spwdid`, `srappsship`, `srappnas`, `sbos`, `ssskills`, `stwinterest`, `ssdfile`, `sgfname`, `sgmname`, `sglname`, `sgnext`, `sglstatus`, `sgeduc`, `sgcontact`, `sgaddress`, `sgoccu`, `sgcompany`, `sffname`, `sfmname`, `sflname`, `sfnext`, `sflstatus`, `sfeduc`, `sfcontact`, `sfaddress`, `sfoccu`, `sfcompany`, `smfname`, `smmname`, `smlname`, `smnext`, `smlstatus`, `smeduc`, `smcontact`, `smaddress`, `smoccu`, `smcompany`, `snsibling`, `spcyincome`, `spschname`, `spsaddress`, `spstype`, `spscourse`, `spsyrlvl`, `spsgwa`, `spsraward`, `spsdawardrceive`, `scsintend`, `scsadd`, `scschooltype`, `sccourse`, `sccourseprio`, `scsyrlvl`, `spass`, `sdsprc`, `sdsprcstat`, `sdspgm`, `sdspgmstat`, `sdspcr`, `sdspcrstat`, `sdstbytpic`, `sdstbytpicstat`, `sdsbrgyin`, `sdsbrgyinstat`, `sdscef`, `sdscefstat`, `sdspsa`, `sdspsastat`, `sdsobr`, `sdsobrstat`, `s_scholarship_note`, `s_added_on`, `s_applied_on`, `s_verification_code`, `s_user_otp`, `s_email_verify`, `s_account_status`, `s_grant_stat`, `s_scholar_stat`, `s_scholarship_type`) VALUES
(982, 'SCC-18-0007077', 'Vincent Xyron', 'A.', 'Albina', 'N/A', '1999-02-07', 'M', '651 South Boundary Tungkop, Minglanilla, Cebu', NULL, '0933-933-0521', NULL, NULL, 'Single', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Mary Ann A. Albina', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Arman Albina', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Instructor', NULL, 'Mary Ann A. Albina', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Housewife', NULL, NULL, NULL, 'scc', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'BSIT', NULL, '3rd Year', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, 'Active', '', '', 'New Unifast'),
(983, 'SCC-16-0003965', 'John Rey', 'T.', 'Cilin', 'N/A', '1999-01-23', 'Male', 'Tubod Hillroad Minglanilla Cebu', '6046', '09970750660', 'cilinjohnrey19@gmail.com', 'Filipino', 'Single', NULL, 'N/A', 'N/A', 'N/A', 'N/A', NULL, NULL, NULL, NULL, NULL, 'Gina', 'Talandron', 'Cilin', 'N/A', 'Living', 'College', '09942348996', 'Tubod Minglanilla, Cebu', 'Housewife', 'N/A', 'Reynaldo Cilin', 'Paraiso', 'Cilin', 'N/A', 'Living', 'High School', '09058155432', 'Tubod Minglanilla, Cebu', 'DRIVER', 'N/A', 'Gina Cilin', 'Talandron', 'Cilin', 'N/A', 'Living', 'College', '09953421678', 'Tubod Minglanilla, Cebu', 'HOUSEWIFE', 'N/A', '3', '10000', 'scc', 'Poblacion Ward 2, Minglanilla Cebu', 'Private', 'BSIT', '2nd Year', NULL, NULL, NULL, 'SCC', 'Poblacion Ward 2, Minglanilla Cebu', 'Private', 'BSIT', 'BSIT', '3rd Year', '$argon2i$v=19$m=65536,t=4,p=1$Y1ZtSkF2YmVFMkpxYWt6eg$k/DDFfZajh1UbfoCEsNb34JaXp5dfj7oYLQPoBEiOJU', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-02-18', NULL, 'd2ff3ecafaec4825a8bb63180f13eb14', '', 'Yes', 'Active', '', 'Renewal', 'New Unifast'),
(984, 'SCC-18-0005842', 'Jhezer', 'R.', 'Libor', 'N/A', '1998-11-01', 'Male', 'Langtad, City of Naga, Cebu', NULL, '9124345667', 'jhezerlibor@yopmail.com', 'Filipino', 'Single', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Alma R. Libor', '', '', '', NULL, NULL, 'Ea suscipit cillum a', 'Officia qui voluptat', 'Ipsa atque id eos', 'Charles and Sexton Trading', 'Jeffrey Y. Libor', '', '', '', NULL, NULL, 'Est excepteur volup', 'Eveniet magnam volu', 'Lorem sint in qui ev', 'Dickson and Howell Plc', 'Alma R. Libor', '', '', '', NULL, NULL, 'Eaque non voluptates', 'Rem ut id quisquam q', 'Lorem suscipit venia', 'Delgado Wyatt Co', NULL, '995', 'scc', NULL, NULL, NULL, NULL, 88, 'N/A', '2022-02-17', NULL, NULL, NULL, 'BSIT', NULL, '3rd Year', '$argon2i$v=19$m=65536,t=4,p=1$Y2dYcDlJYW5DdTlUNGRzQw$N8aHQyRlGtyPMJ8OddIercW+WFXNG/0m8nGPhfBwJvc', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-02-18', '2022-02-18', 'dff8e49d5e315305002935b8de9ac9b5', '', 'Yes', 'Active', '', 'Pending', 'Academic'),
(985, 'SCC-16-0003997', 'Joshua', '', 'Parba', NULL, '1996-10-25', 'M', 'Poblacion Ward II, Minglanilla Cebu', NULL, '0956-056-1438', NULL, NULL, 'Single', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'N/A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Edgar Parages', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'CONSTRUCTION', NULL, 'Emily Parba', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'HOUSEWIFE', NULL, NULL, NULL, 'scc', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'BSIT', NULL, '3rd Year', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, 'Active', '', '', 'New Unifast'),
(986, 'SCC-16-0003180', 'Angelika', 'N/A', 'Singcol', 'N/A', '1999-10-05', 'Female', 'Pungsod Lawa-an 3, Talisay City', '6045', '9673159901', 'angelikasingcol945@gmail.com', 'Filipino', 'Single', NULL, 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', NULL, 'Ricky Sarsalijo', 'Quintano', 'Sarsalijo', 'N/A', 'Living', 'High school graduate', '09560561438', 'Lawaan 3 Talisay city', 'Helper', 'Singcol sticker &amp;amp;amp;a', 'Ricky Sarsalijo', 'Quintano', 'Sarsalijo', 'N/A', 'Living', 'High school graduate', '09560561438', 'Lawaan 3 Talisay city', 'construction', 'Singcol sticker &amp;amp;amp;a', 'Jessica Singcol', 'Bueno', 'Singcol', 'N/A', 'Living', 'High school graduate', '09560561438', 'Lawaan 3 Talisay city', 'Housewife', 'N/A', '2', '12,00', 'scc', 'Poblacion ward 2 minglanilla cebu', 'Private', 'Bsit', '4th yr', NULL, NULL, NULL, 'St.cecilia\'s college cebu-inc', 'Poblacion ward 2', 'Private', 'BSIT', 'Priority', '4th Year', '$argon2i$v=19$m=65536,t=4,p=1$VmdQR0lQVkIuVkxEL3VROA$mIstmuuDnN74uk8flQodpNQHgFThUJWV1+kH4bpJCE4', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-02-18', '2022-02-18', 'bba6de0e7aac6af923bab2574aabaf19', '', 'Yes', 'Active', '', 'Approved', 'Non-Academic'),
(987, 'SCC-18-0007501', 'Eliezer', 'C.', 'Aguipo', NULL, '2000-01-05', 'M', 'Cantao-an Naga City Cebu', NULL, '9532219598', NULL, NULL, 'Single', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Exequila Aguipo', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Asis Aguipo', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Driver', NULL, 'Exequila Aguipo', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'House Wife', NULL, NULL, NULL, 'scc', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'BSIT', NULL, '3rd Year', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, 'Active', '', '', 'Naga Scholar 1516 ne'),
(988, 'SCC-18-0008647', 'Junmar', 'T.', 'Cavalida', NULL, '1999-11-03', 'M', 'Aloguinsan Cebu', NULL, '0991-742-7817', 'cilinjohnrey@gmail.com', NULL, 'Single', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Virginia Cavalida', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Mariano Cavalida', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Driver', NULL, 'Virginia Cavalida', NULL, NULL, NULL, NULL, NULL, NULL, NULL, ' ', NULL, NULL, NULL, 'SCC', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'BSIT', NULL, '3rd Year', '$argon2i$v=19$m=65536,t=4,p=1$VlZRemJqQU9udmRsWDhEZw$Vd38pJJGBDvIBl3on3YktFF0O3zR8Nl8xZzTjaF4fJc', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-02-19', NULL, '3802688be78812b618ed4265075492de', '', 'Yes', 'Active', '', '', 'New Unifast'),
(989, 'SCC-16-0004091', 'John Carlo', 'G.', 'Largo', 'N/A', '2000-03-30', 'Male', 'Poblacion Ward 2 Minglanilla Cebu', '6046', '09685859243', 'carlolargo@yopmail.com', 'Filipino', 'Single', 'Minglanill', 'N/A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Vilma G. Largo', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Santos F. Largo', NULL, NULL, NULL, 'Living', 'High School', NULL, 'Poblacion Ward 2 Minglanilla, Cebu', 'Utility Worker', NULL, 'Vilma G. Largo', NULL, NULL, NULL, 'Living', 'High School', NULL, 'Poblacion Ward 2 Minglanilla, Cebu', 'Manicurist', NULL, '2', '10000', 'scc', 'Ward 2', 'Private', NULL, 'Grade 12', NULL, NULL, NULL, 'St. Cecilia\'s College', 'Ward 2', 'Private', 'BSIT', 'Priority', '3rd Year', '$argon2i$v=19$m=65536,t=4,p=1$QWwwUTRjb083SmRSTndQaA$+jVxm2RkMj2ONlO/riWxrBw3r/cNPJQc84ZQ6RHO91Y', '', 'Not-Received', '', 'Not-Received', NULL, NULL, NULL, NULL, '', 'Not-Received', NULL, NULL, NULL, NULL, NULL, NULL, 'N/A', '2022-02-18', '2022-02-18', 'bc1159410407e3fd08503c209f2f7d24', '', 'Yes', 'Active', '', 'Pending', 'CHED'),
(990, 'SCC-18-0007536', 'Jun Carlo', '', 'Oros', NULL, '1997-09-12', 'M', 'Mayana City of Naga', NULL, '0961-604-1438', 'juncarlooros@yopmail.com', NULL, 'Single', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Eladia Oros', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Clito Oros', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Construction worker', NULL, 'Eladia Oros', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, 'scc', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'BSIT', NULL, '3rd Year', '$argon2i$v=19$m=65536,t=4,p=1$QjRzOS9wMXNMUkVHLjRoOA$uo5pPHBCwFajGh8NQ+I0s2Mq5TAXU5+fZhMiq1wYL7I', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-02-19', NULL, 'aef2faa404bd8705d67df54ef8bc8707', '', 'No', 'Active', '', '', 'New Unifast');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `tbl_student`
--
ALTER TABLE `tbl_student`
  ADD PRIMARY KEY (`s_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_student`
--
ALTER TABLE `tbl_student`
  MODIFY `s_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=991;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
