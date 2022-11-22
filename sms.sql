-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 22, 2022 at 05:59 PM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 8.1.10

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
(1, 'SCC-0001368', 'tjiecarmen90@gmail.com', '$argon2i$v=19$m=65536,t=4,p=1$TDZHeTg0NXp5S2JUVFZNSg$36gjUAd6KxFAcsDzinlxtKthHoOkoJesox3WUuPEUs8', 'Administrator', 'Chairman', 'Natalio B. Bacalso S National Hwy, Minglanilla, Cebu', '(032) 490 8511', '961571', '', 'No');

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
  `s_datefil` varchar(20) DEFAULT NULL,
  `s_scholar_stat` varchar(20) NOT NULL,
  `s_scholarship_type` varchar(20) NOT NULL,
  `snext` varchar(10) NOT NULL,
  `spscourse` varchar(20) NOT NULL,
  `scsyrlvl` varchar(20) NOT NULL,
  `spwdid` varchar(20) NOT NULL,
  `ssdfile` varchar(10) NOT NULL,
  `sdstbytpic` varchar(20) NOT NULL,
  `sdstbytpicstat` varchar(20) NOT NULL,
  `sdspsa` varchar(20) NOT NULL,
  `sdspsastat` varchar(20) NOT NULL,
  `sdsbrgyin` varchar(20) NOT NULL,
  `sdsbrgyinstat` varchar(20) NOT NULL,
  `spass` varchar(100) NOT NULL,
  `s_verification_code` varchar(100) NOT NULL,
  `s_email_verify` varchar(10) NOT NULL,
  `s_account_status` varchar(20) NOT NULL,
  `s_scholarship_note` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_newstudent`
--

INSERT INTO `tbl_newstudent` (`s_id`, `ss_id`, `s_image`, `slname`, `sfname`, `smname`, `sgender`, `sdbirth`, `scontact`, `saddress`, `spschname`, `sccourse`, `syrlvl`, `semail`, `sflname`, `sffname`, `sfmname`, `sfoccu`, `smlname`, `smfname`, `smmname`, `smoccu`, `s4psno`, `spcyincome`, `S_disability`, `s_datefil`, `s_scholar_stat`, `s_scholarship_type`, `snext`, `spscourse`, `scsyrlvl`, `spwdid`, `ssdfile`, `sdstbytpic`, `sdstbytpicstat`, `sdspsa`, `sdspsastat`, `sdsbrgyin`, `sdsbrgyinstat`, `spass`, `s_verification_code`, `s_email_verify`, `s_account_status`, `s_scholarship_note`) VALUES
(11, '234789', '', 'Carmen', 'Toscanny', 'Sellote', 'male', '2022-11-22', '09664932334', 'Cadulawan, Minglanilla', 'St. Cecilia College', 'BSIT', '4', 'tjiecarmen90@gmail.com', 'Serate', 'Carmen', 'Glenn', 'Driver', 'Sellote', 'Carmen', 'Leone', 'Dressmaker', '6', NULL, '653678', '', 'Approved', 'UNIFAST', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '');

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
(988, 'SCC-18-0008647', 'Junmar', 'T.', 'Cavalida', NULL, '1999-11-03', 'M', 'Aloguinsan Cebu', NULL, '0991-742-7817', 'cilinjohnrey@gmail.com', NULL, 'Single', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Virginia Cavalida', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Mariano Cavalida', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Driver', NULL, 'Virginia Cavalida', NULL, NULL, NULL, NULL, NULL, NULL, NULL, ' ', NULL, NULL, NULL, 'SCC', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'BSIT', NULL, '3rd Year', '$argon2i$v=19$m=65536,t=4,p=1$VlZRemJqQU9udmRsWDhEZw$Vd38pJJGBDvIBl3on3YktFF0O3zR8Nl8xZzTjaF4fJc', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-02-19', NULL, '3802688be78812b618ed4265075492de', '', 'Yes', 'Active', '', '', 'New Unifast'),
(990, 'SCC-18-0007536', 'Jun Carlo', '', 'Oros', NULL, '1997-09-12', 'M', 'Mayana City of Naga', NULL, '0961-604-1438', 'juncarlooros@yopmail.com', NULL, 'Single', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Eladia Oros', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Clito Oros', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Construction worker', NULL, 'Eladia Oros', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, 'scc', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'BSIT', NULL, '3rd Year', '$argon2i$v=19$m=65536,t=4,p=1$QjRzOS9wMXNMUkVHLjRoOA$uo5pPHBCwFajGh8NQ+I0s2Mq5TAXU5+fZhMiq1wYL7I', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-02-19', NULL, 'aef2faa404bd8705d67df54ef8bc8707', '', 'No', 'Active', '', '', 'New Unifast'),
(991, 'SS-17-0004665', 'Lira Mae', 'Tapasao', 'Paradero', 'BSIT 4th', '05/17/2000', 'Female', 'Tungkop', '6046', '09321315494', 'paraderolira17@gmail.com', 'Filipino', 'Single', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, 'Inactive', '', '', ''),
(992, '2131321', 'Criscia', 'Carmen', 'Dama', 'N/A', '2012-02-09', 'Female', 'tagum', NULL, '09155813389', 'criscia@1nurse.com', NULL, NULL, NULL, NULL, 'na', 'na', NULL, NULL, NULL, NULL, NULL, '2022-11-21', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Ferdinand', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Jean', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'test', 'na', NULL, NULL, 'na', 'na', NULL, NULL, NULL, NULL, NULL, NULL, 'BSIT', NULL, '4th Year', '$argon2i$v=19$m=65536,t=4,p=1$ZzI0MHJ5d1lRTkpoWHVZQg$1gs4q6vL7QtoOon6eSZfmLVB6sINOUoQ5dOjFOqsinM', NULL, NULL, NULL, NULL, NULL, NULL, '2022-11-18', 'Received', '2022-11-21', 'Received', NULL, NULL, '2022-11-19', 'Received', NULL, NULL, 'na', NULL, '2022-11-21', '41b4002147f103094230a2e37aa28da3', '', 'No', 'Active', '', 'Rejected', 'UNIFAST'),
(993, '2131321', 'Toscanny', 'NA', 'Carmen', 'N/A', '2022-11-10', 'Male', 'NA', NULL, '096546534', 'toscanny@gmail.com', NULL, NULL, NULL, NULL, 'NA', 'NA', NULL, NULL, NULL, NULL, NULL, '2022-10-31', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'na', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'na', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'NA', 'NA', NULL, NULL, 'test', 'NA', NULL, NULL, NULL, NULL, NULL, NULL, 'BSIT', NULL, '4th Year', '$argon2i$v=19$m=65536,t=4,p=1$WmgwWG4yazF2R1JDT1diOQ$Xx7tXXj6z2rHLIHBi4LyHwYqt2Y0ha/nzB7pQnBTHIk', NULL, NULL, NULL, NULL, NULL, NULL, '2022-11-15', 'Received', '2022-11-22', 'Received', NULL, NULL, '2022-11-23', 'Received', NULL, NULL, 'NA', NULL, '2022-11-21', 'f2a674a861de5c6e57909b9bb7dd7ae7', '', 'No', 'Active', '', 'Rejected', 'UNIFAST'),
(994, '2131321', 'Criscia', 'NA', 'Dama', 'N/A', '2022-11-17', 'Female', 'NA', NULL, '09155813389', 'damacriscia@gmail.com', NULL, NULL, NULL, NULL, 'NA', 'NA', NULL, NULL, NULL, NULL, NULL, '2022-11-21', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Ferdinand', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'na', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'NA', 'NA', NULL, NULL, 'BSIT', '4th Year', NULL, NULL, NULL, NULL, NULL, NULL, 'BSIT', NULL, '4th Year', '$argon2i$v=19$m=65536,t=4,p=1$REwuenhkNXkwcWdnc0oxZw$QLrdoBkjxJW02RBAUANwkLGh3UeQbWVH0UJ1KcRnS84', NULL, NULL, NULL, NULL, NULL, NULL, '2022-11-20', 'Received', '2022-11-22', 'Received', NULL, NULL, '2022-11-22', 'Received', NULL, NULL, 'NA', NULL, '2022-11-21', '6ea0b386c810290aca67bad9d55fb58d', '', 'No', 'Active', '', 'Approved', 'UNIFAST'),
(995, '000000', 'Dimple', 'Carmen', 'Carmen', 'N/A', '2022-11-17', 'Female', 'NA', NULL, '09564645634', 'dimple@gmail.com', NULL, NULL, NULL, NULL, 'NA', 'NA', NULL, NULL, NULL, NULL, NULL, '2022-11-16', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'na', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'na', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'NA', 'NA', NULL, NULL, 'NA', '3rd Year', NULL, NULL, NULL, NULL, NULL, NULL, 'BSHM', NULL, '3rd Year', '$argon2i$v=19$m=65536,t=4,p=1$Z0dZREkuUEd2NTAzVDQ3dQ$AiGwIlwWorlhR/w0UbUiqIxv4ELtEtRq1XtBkWwrosk', NULL, NULL, NULL, NULL, NULL, NULL, '2022-11-16', 'Received', '2022-11-15', 'Received', NULL, NULL, '2022-11-15', 'Received', NULL, NULL, 'dsad', NULL, '2022-11-21', '6b3df67dbcb8cd90c8ece294c64c4896', '', 'No', 'Active', '', 'Approved', 'UNIFAST'),
(996, '2131321', 'Dimple', 'NA', 'Carmen', 'N/A', '2022-11-09', 'Female', 'tgghj', NULL, '09155813389', 'dimpley@gmail.com', NULL, NULL, NULL, NULL, 'test', 'test', NULL, NULL, NULL, NULL, NULL, '2022-11-18', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Ferdinand', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Jean', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'test', 'frhh', NULL, NULL, 'ytyh', '87', NULL, NULL, NULL, NULL, NULL, NULL, 'BSHM', NULL, '4th Year', '$argon2i$v=19$m=65536,t=4,p=1$Y2R5M2dBT2htTGU5Y29Jdg$EgkOFjI/wVngc8Y9A/ezGHvhjGh62U5ucT1q4hsj19o', NULL, NULL, NULL, NULL, NULL, NULL, '2022-11-16', 'Received', '2022-11-24', 'Received', NULL, NULL, '2022-11-11', 'Received', NULL, NULL, 'hhu', NULL, '2022-11-21', '605a18ef3772273733fb1983c9efe28d', '', 'No', 'Active', '', 'Approved', 'UNIFAST');

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
(10, 'liraliraliralira', '$2y$10$3.5em.tWuWKkQ3tpXQnZgO3i2yMo38sbWrEzppOvcqLGaDfEVklSm', '2022-10-18 23:37:47'),
(11, 'criscia', '$2y$10$JSpVE1MLG09quj0GlKxA/OLMQp.j51jMZ2dLO1jgk6IftZv9ZWEm6', '2022-11-21 03:01:27'),
(12, 'tricia_shang', '$2y$10$gKhDrgy7MjHbqdwFqQqbSuO5yi3UBVcYUXv8gl1FjRtutnH.ymB6e', '2022-11-21 17:54:34');

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
  MODIFY `s_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `tbl_student`
--
ALTER TABLE `tbl_student`
  MODIFY `s_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=997;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `S_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
