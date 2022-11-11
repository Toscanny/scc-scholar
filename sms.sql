-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 19, 2022 at 04:49 AM
-- Server version: 10.4.20-MariaDB
-- PHP Version: 8.0.8

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
-- Table structure for table `tbl_newstudent`
--

CREATE TABLE `tbl_newstudent` (
  `s_id` int(11) NOT NULL,
  `ss_id` varchar(20) DEFAULT NULL,
  `s_image` varchar(50) DEFAULT NULL,
  `slname` varchar(50) DEFAULT NULL,
  `sfname` varchar(50) DEFAULT NULL,
  `smname` varchar(50) DEFAULT NULL,
  `sgender` varchar(10) DEFAULT NULL,
  `sdbirth` varchar(10) DEFAULT NULL,
  `scontact` varchar(20) DEFAULT NULL,
  `saddress` varchar(100) DEFAULT NULL,
  `spschname` varchar(50) DEFAULT NULL,
  `sccourse` varchar(20) DEFAULT NULL,
  `syrlvl` varchar(20) DEFAULT NULL,
  `semail` varchar(50) DEFAULT NULL,
  `sflname` varchar(50) DEFAULT NULL,
  `sffname` varchar(50) DEFAULT NULL,
  `sfmname` varchar(50) DEFAULT NULL,
  `sfoccu` varchar(30) DEFAULT NULL,
  `smlname` varchar(50) DEFAULT NULL,
  `smfname` varchar(50) DEFAULT NULL,
  `smmname` varchar(50) DEFAULT NULL,
  `smoccu` varchar(30) DEFAULT NULL,
  `s4psno` varchar(20) DEFAULT NULL,
  `spcyincome` varchar(20) DEFAULT NULL,
  `S_disability` varchar(20) DEFAULT NULL,
  `s_datefil` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_newstudent`
--

INSERT INTO `tbl_newstudent` (`s_id`, `ss_id`, `s_image`, `slname`, `sfname`, `smname`, `sgender`, `sdbirth`, `scontact`, `saddress`, `spschname`, `sccourse`, `syrlvl`, `semail`, `sflname`, `sffname`, `sfmname`, `sfoccu`, `smlname`, `smfname`, `smmname`, `smoccu`, `s4psno`, `spcyincome`, `S_disability`, `s_datefil`) VALUES
(1, 'Scc-048294234', NULL, 'Paradero', 'Lira Mae', 'Tapasao', 'Female', '05-17-2000', '566243424', 'rsfsdsv', 'gfgfgsg', 'gsgs', 'fsdfsdf', 'sdfsf', 'fsdf', 'fsfs', 'fsdf', 'ghfgh', 'adas', 'vvxc', 'sadsad', 'ffa', 'fafadf', 'fdfs', 'fsdfs', 'fsdfsdf');

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
(984, 'SCC-18-0005842', 'Jhezer', 'R.', 'Libor', 'N/A', '1998-11-01', 'Male', 'Langtad, City of Naga, Cebu', NULL, '9124345667', 'jhezerlibor@yopmail.com', 'Filipino', 'Single', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Alma R. Libor', '', '', '', NULL, NULL, 'Ea suscipit cillum a', 'Officia qui voluptat', 'Ipsa atque id eos', 'Charles and Sexton Trading', 'Jeffrey Y. Libor', '', '', '', NULL, NULL, 'Est excepteur volup', 'Eveniet magnam volu', 'Lorem sint in qui ev', 'Dickson and Howell Plc', 'Alma R. Libor', '', '', '', NULL, NULL, 'Eaque non voluptates', 'Rem ut id quisquam q', 'Lorem suscipit venia', 'Delgado Wyatt Co', NULL, '995', 'scc', NULL, NULL, NULL, NULL, 88, 'N/A', '2022-02-17', NULL, NULL, NULL, 'BSIT', NULL, '3rd Year', '$argon2i$v=19$m=65536,t=4,p=1$Y2dYcDlJYW5DdTlUNGRzQw$N8aHQyRlGtyPMJ8OddIercW+WFXNG/0m8nGPhfBwJvc', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-02-18', '2022-02-18', 'dff8e49d5e315305002935b8de9ac9b5', '', 'Yes', 'Active', '', 'Approved', 'Academic'),
(986, 'SCC-16-0003180', 'Angelika', 'N/A', 'Singcol', 'N/A', '1999-10-05', 'Female', 'Pungsod Lawa-an 3, Talisay City', '6045', '9673159901', 'angelikasingcol945@gmail.com', 'Filipino', 'Single', NULL, 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', NULL, 'Ricky Sarsalijo', 'Quintano', 'Sarsalijo', 'N/A', 'Living', 'High school graduate', '09560561438', 'Lawaan 3 Talisay city', 'Helper', 'Singcol sticker &amp;amp;amp;a', 'Ricky Sarsalijo', 'Quintano', 'Sarsalijo', 'N/A', 'Living', 'High school graduate', '09560561438', 'Lawaan 3 Talisay city', 'construction', 'Singcol sticker &amp;amp;amp;a', 'Jessica Singcol', 'Bueno', 'Singcol', 'N/A', 'Living', 'High school graduate', '09560561438', 'Lawaan 3 Talisay city', 'Housewife', 'N/A', '2', '12,00', 'scc', 'Poblacion ward 2 minglanilla cebu', 'Private', 'Bsit', '4th yr', NULL, NULL, NULL, 'St.cecilia\'s college cebu-inc', 'Poblacion ward 2', 'Private', 'BSIT', 'Priority', '4th Year', '$argon2i$v=19$m=65536,t=4,p=1$VmdQR0lQVkIuVkxEL3VROA$mIstmuuDnN74uk8flQodpNQHgFThUJWV1+kH4bpJCE4', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-02-18', '2022-02-18', 'bba6de0e7aac6af923bab2574aabaf19', '', 'Yes', 'Active', '', 'Approved', 'Non-Academic'),
(988, 'SCC-18-0008647', 'Junmar', 'T.', 'Cavalida', NULL, '1999-11-03', 'M', 'Aloguinsan Cebu', NULL, '0991-742-7817', 'cilinjohnrey@gmail.com', NULL, 'Single', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Virginia Cavalida', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Mariano Cavalida', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Driver', NULL, 'Virginia Cavalida', NULL, NULL, NULL, NULL, NULL, NULL, NULL, ' ', NULL, NULL, NULL, 'SCC', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'BSIT', NULL, '3rd Year', '$argon2i$v=19$m=65536,t=4,p=1$VlZRemJqQU9udmRsWDhEZw$Vd38pJJGBDvIBl3on3YktFF0O3zR8Nl8xZzTjaF4fJc', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-02-19', NULL, '3802688be78812b618ed4265075492de', '', 'Yes', 'Active', '', '', 'New Unifast'),
(989, 'SCC-16-0004091', 'John Carlo', 'G.', 'Largo', 'N/A', '2000-03-30', 'Male', 'Poblacion Ward 2 Minglanilla Cebu', '6046', '09685859243', 'carlolargo@yopmail.com', 'Filipino', 'Single', 'Minglanill', 'N/A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Vilma G. Largo', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Santos F. Largo', NULL, NULL, NULL, 'Living', 'High School', NULL, 'Poblacion Ward 2 Minglanilla, Cebu', 'Utility Worker', NULL, 'Vilma G. Largo', NULL, NULL, NULL, 'Living', 'High School', NULL, 'Poblacion Ward 2 Minglanilla, Cebu', 'Manicurist', NULL, '2', '10000', 'scc', 'Ward 2', 'Private', NULL, 'Grade 12', NULL, NULL, NULL, 'St. Cecilia\'s College', 'Ward 2', 'Private', 'BSIT', 'Priority', '3rd Year', '$argon2i$v=19$m=65536,t=4,p=1$QWwwUTRjb083SmRSTndQaA$+jVxm2RkMj2ONlO/riWxrBw3r/cNPJQc84ZQ6RHO91Y', '', 'Not-Received', '', 'Not-Received', NULL, NULL, NULL, NULL, '', 'Not-Received', NULL, NULL, NULL, NULL, NULL, NULL, 'N/A', '2022-02-18', '2022-02-18', 'bc1159410407e3fd08503c209f2f7d24', '', 'Yes', 'Active', '', 'Renewal', 'CHED'),
(990, 'SCC-18-0007536', 'Jun Carlo', '', 'Oros', NULL, '1997-09-12', 'M', 'Mayana City of Naga', NULL, '0961-604-1438', 'juncarlooros@yopmail.com', NULL, 'Single', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Eladia Oros', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Clito Oros', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Construction worker', NULL, 'Eladia Oros', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, 'scc', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'BSIT', NULL, '3rd Year', '$argon2i$v=19$m=65536,t=4,p=1$QjRzOS9wMXNMUkVHLjRoOA$uo5pPHBCwFajGh8NQ+I0s2Mq5TAXU5+fZhMiq1wYL7I', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-02-19', NULL, 'aef2faa404bd8705d67df54ef8bc8707', '', 'No', 'Active', '', '', 'New Unifast'),
(991, 'SS-17-0004665', 'Lira Mae', 'Tapasao', 'Paradero', 'BSIT 4th', '05/17/2000', 'Female', 'Tungkop', '6046', '09321315494', 'paraderolira17@gmail.com', 'Filipino', 'Single', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, 'Inactive', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `S_id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`S_id`, `username`, `password`, `created_at`) VALUES
(1, 'admin', '$2y$10$617nkpPqN6AI/o8R1v4l3.lzi72bzere4rROIOiFMpwZZeZDpsOvy', '2022-09-28 18:05:30'),
(2, 'adminasd', '$2y$10$JWBel.4wpKrSeMfePjQJb.ZlGWhwE2TkoWgT.8jG81m09WF3JwG3O', '2022-09-28 18:07:41'),
(3, 'root', '$2y$10$umP67pmcMTK8xjTQxWHlAu6gK0p5k7mWPPklC3dtCxcuRaL7rv6La', '2022-09-28 23:16:09'),
(4, 'justonce', '$2y$10$RpHHY4O5zQ2Q0ReqF1qdiOpoTwV52D5WFjX72v.E90pTpaEHW61zO', '2022-09-30 09:06:31'),
(5, 'ddadasdd', '$2y$10$k2mVZ1UTQksFM9ua5VOopeYq/w93utZjtutoj18.EYhaFQTEY/LSq', '2022-09-30 09:39:50'),
(6, 'sdsadasdsfafac', '$2y$10$RCvN.sPd40Vk7JT2Mh4rl.MU/FNnYe63t0uxa/CReL3t61lAcOBWy', '2022-09-30 15:07:47'),
(7, 'sumalinao', '$2y$10$WCbd99MQEezMaQBa1Et8uu7j8okLlUzhMcDnLHyiWrw8FqZHTMGkO', '2022-09-30 15:38:23'),
(8, 'ARRARRARRA', '$2y$10$1K1wHNCERTBJDot5tkyIQeX/wAQsvJ9bdu6TW.PEQQ9YxjDBcScE6', '2022-09-30 22:35:02'),
(9, 'liramae', '$2y$10$xcy6QSGs0x5n8TO3cF5HO.ciZd9CYLQM92VFly0dXd6f38iU9lCQ6', '2022-10-17 21:57:12'),
(10, 'liraliraliralira', '$2y$10$3.5em.tWuWKkQ3tpXQnZgO3i2yMo38sbWrEzppOvcqLGaDfEVklSm', '2022-10-18 23:37:47');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `tbl_newstudent`
--
ALTER TABLE `tbl_newstudent`
  ADD PRIMARY KEY (`s_id`);

--
-- Indexes for table `tbl_student`
--
ALTER TABLE `tbl_student`
  ADD PRIMARY KEY (`s_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`S_id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_newstudent`
--
ALTER TABLE `tbl_newstudent`
  MODIFY `s_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_student`
--
ALTER TABLE `tbl_student`
  MODIFY `s_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=992;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `S_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
