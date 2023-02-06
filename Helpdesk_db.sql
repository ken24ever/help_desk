-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jan 25, 2023 at 09:13 AM
-- Server version: 10.3.37-MariaDB
-- PHP Version: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `edoictas_IctaHelpdesk`
--

-- --------------------------------------------------------

--
-- Table structure for table `comments_logs`
--

CREATE TABLE `comments_logs` (
  `id` int(11) NOT NULL,
  `ticket_id` text NOT NULL,
  `created_at` text NOT NULL,
  `ticket_issuer` text NOT NULL,
  `commentBy` text NOT NULL,
  `commentsBody` text NOT NULL,
  `checkSeen` int(11) NOT NULL DEFAULT 0,
  `timeCreated` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `comments_logs`
--

INSERT INTO `comments_logs` (`id`, `ticket_id`, `created_at`, `ticket_issuer`, `commentBy`, `commentsBody`, `checkSeen`, `timeCreated`) VALUES
(1, '#6951743', 'Jan 24 2023 04:25:48pm ', 'Japhet  Aliu', 'Kenneth Osasumwen Enobakhare', 'Hello Japhet, kindly come to the office with you gadget by tomorrow morning. Thanks', 0, '1674577548'),
(2, '#6951743', 'Jan 24 2023 04:37:24pm ', 'Japhet  Aliu', 'Kenneth Osasumwen Enobakhare', 'You can come by 9:00 Am tomorrow.', 0, '1674578244');

-- --------------------------------------------------------

--
-- Table structure for table `comment_registry`
--

CREATE TABLE `comment_registry` (
  `id` int(11) NOT NULL,
  `ticket_id` text NOT NULL,
  `issuer_name` text NOT NULL,
  `seen` int(11) NOT NULL DEFAULT 0,
  `ticket_status` text NOT NULL,
  `commented_by` text NOT NULL,
  `user_id` int(11) NOT NULL,
  `access_lv` int(11) NOT NULL,
  `created_at` text NOT NULL,
  `timeCreated` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `comment_registry`
--

INSERT INTO `comment_registry` (`id`, `ticket_id`, `issuer_name`, `seen`, `ticket_status`, `commented_by`, `user_id`, `access_lv`, `created_at`, `timeCreated`) VALUES
(1, '#6951743', 'Japhet  Aliu', 0, 'Closed', 'Kenneth Osasumwen Enobakhare', 0, 4, 'Jan 24 2023 04:25:48pm ', '1674578244');

-- --------------------------------------------------------

--
-- Table structure for table `icta_units`
--

CREATE TABLE `icta_units` (
  `id` int(11) NOT NULL,
  `departments_units` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `icta_units`
--

INSERT INTO `icta_units` (`id`, `departments_units`) VALUES
(2, 'Customer Service and Content Management Unit'),
(3, 'IT Project Management Office (ITPMO)'),
(4, 'Infrastructure and System Engineering Unit'),
(5, 'Planning and Scheduling Unit'),
(6, 'Application Management & Support (HQ Operation)'),
(7, 'Service Desk & Service Level Management'),
(8, 'Accounts'),
(9, 'Architecture/Information Mangement'),
(10, 'Data Center Operations'),
(11, 'Dabase Management & Surpport(HQ Operation)'),
(12, 'Buisness (MDA) Relationship Management'),
(13, 'IT Strategy and Buisness Alignment:'),
(14, 'IT Audit and System Control:'),
(15, 'IT, HR, & Admin/Store'),
(16, 'MDA Application management & Surpport LGA Operation)'),
(17, 'Hardware Maintenance/ End-User Computing'),
(18, 'Network Infrastructure Support (HQ)'),
(19, 'Network Infrastructure Support (LGA)'),
(20, 'Portfolio Delivery & Meaasurment'),
(21, 'Server & Storage Support'),
(22, 'Service Desk & Service Level Management'),
(23, 'NONE');

-- --------------------------------------------------------

--
-- Table structure for table `ministries`
--

CREATE TABLE `ministries` (
  `id` int(11) NOT NULL,
  `namesOfMinistries` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ministries`
--

INSERT INTO `ministries` (`id`, `namesOfMinistries`) VALUES
(1, 'OFFICE OF THE GOVERNOR'),
(2, 'DIRECTORATE OF CABINET AFFAIRS AND SPECIAL SERVICES'),
(3, 'GENERAL SERVICES (CENTRAL ADMINISTRATION)'),
(4, 'HUMAN RESOURCES MANAGEMENT (ESTABLISHMENT, TRAINING AND MANPOWER DEVELOPMENTS)'),
(5, 'OFFICE OF THE CHIEF OF STAFF'),
(6, 'OFFICE OF THE DEPUTY GOVERNOR'),
(7, 'OFFICE OF THE HEAD OF SERVICE'),
(8, 'OFFICE OF THE SECRETARY TO THE STATE GOVERNMENT'),
(9, 'DIRECTORATE OF GOVERNMENT HOUSE AND PROTOCOL'),
(10, 'STRATEGY, POLICY, PROJECT AND PERFORMANCE MANAGEMENT OFFICE'),
(11, 'EDO STATE SKILLS DEVELOPMENT AGENCY'),
(12, 'PUBLIC PRIVATE PARTNERSHIP OFFICE (PPP)'),
(13, 'PUBLIC WORKS VOLUNTEER (PUWOV)'),
(14, 'MINISTRY OF WATER RESOURCES'),
(15, 'OFFICE OF THE SPECIAL ADVICER ON MEDIA PROJECT'),
(16, 'ABUJA LIASON OFFICE'),
(17, 'MINISTRY OF BUDGET, PLANNING AND ECONOMIC DEVEVELOPMENT'),
(18, 'MINISTRY OF ENVIRONMENT AND SUSTAINABILITY'),
(19, 'BOARD FOR TECHNICAL AND VOCATIONAL EDUCATION (BTVE'),
(20, 'EDO STATE FLOOD & EROSION WATERSHED MANAGEMENT AGENCY (FEWMA)'),
(21, 'EDO STATE EMPLOYMENT AND EXPENDITURE FOR RESULT (SEEFOR)'),
(22, 'INFORMATION COMMUNICATION TECHNOLOGY AGENCY'),
(23, 'EDO STATE INVESTMENT PROMOTION OFFICE  (ESIPO)'),
(24, 'MINISTRY OF FINANCE'),
(25, 'OFFICE OF THE ACCOUNTANT GENERAL'),
(26, 'OFFICE OF THE AUDITOR GENERAL (STATE)'),
(27, 'MINISTRY OF MINING, OIL AND GAS'),
(28, 'MINISTRY OF YOUTHS AND SOCIAL MOBILIZATION'),
(29, 'MINISTRY OF COMMUNICATION & ORIENTATION'),
(30, 'MINISTRY OF AGRICULTURE AND FOOD SECURITY'),
(31, 'EDO STATE UNIVERSAL BASIC EDUCATION BOARD'),
(32, 'MINISTRY OF HEALTH'),
(33, 'STATE AGENCY OF THE CONTROL OF HIV/AIDS (ED-SACA)'),
(34, 'MINISTRY OF EDUCATION (COMMISSIONER)'),
(35, 'EDO STATE EMERGENCY MANAGEMENT AGENCY (SEMA)'),
(36, 'EDO STATE CHRISTIAN PILGRIMS WELFARE BOARD'),
(37, 'MINISTRY OF LOCAL GOVERNMENT AFFAIRS'),
(38, 'MINISTRY OF ARTS & CULTURE'),
(39, 'MINISTRY OF SCIENCE AND TECHNOLOGY'),
(40, 'MINISTRY OF COMMUNITY AND CHIEFTAINCY AFFAIRS'),
(41, 'EDO STATE PUBLIC PROCUREMENT AGENCY'),
(42, 'EDO STATE PUBLIC BUILDING & MAINTENANCE AGENCY'),
(43, 'ELECTRICITY REGULATORY COMMISSION'),
(44, 'MINISTRY OF INDUSTRY TRADE AND COOPERATION (WEALTH CREATION)'),
(45, 'MINISTRY OF PHYSICAL PLANNING, URBAN & REGIONAL DEVELOPMENT'),
(46, 'EDO STATE HEALTH INSURANCE COMMISSION'),
(47, 'MINISTRY OF SOCIAL DEVELOPMENT & GENDER ISSUES'),
(48, 'MINISTRY OF JUSTICE'),
(49, 'EDO STATE COLLEGE OF NURSING SCIENCES'),
(50, 'EDO STATE GEOGRAPHIC AND INFORMATION SYSTEM'),
(51, 'EDO STATE SMALL TOWN AND RURAL WATER SUPPLY AND SANITATION AGENCY(STRUWASSA)'),
(52, 'EDO STATE URBAN WATER CORPORATION'),
(53, 'MINISTRY OF ROADS AND BRIDGES'),
(54, 'MINISTRY OF TRANSPORTATION'),
(55, 'MINISTRY OF HOUSING'),
(56, 'MINISTRY OF PUBLIC SAFETY & SECURITY'),
(57, 'EDO STATE PENSIONS BUREAU'),
(58, 'EDO STATE HOSPITALS MANAGEMENT AGENCY'),
(59, 'EDO STATE PRIMARY HEALTH CARE DEVELOPMENT AGENCY'),
(60, 'EDO STATE INTERNAL REVENUE SERVICE'),
(61, 'EDO DEVELOPMENT AND PROPERTY AGENCY (EDPA)'),
(62, 'EDO STATE LIBRARY BOARD '),
(63, 'EDO STATE CIVIL SERVICE COMMISSION'),
(64, 'EDO STATE WASTE MANAGEMENT BOARD'),
(65, 'LOCAL GOVERNMENT SERVICE COMMISSION'),
(66, 'PRIVATE PROPERTY PROTECTION COMMITTEE'),
(67, 'OFFICE OF THE AUDITOR GENERAL (LOCAL GOVERNMENT)'),
(68, 'PUBLIC SERVICE ACADEMY'),
(69, 'BENDEL NEWSPAPER CORPORATION'),
(70, 'EDO STATE DIASPORA AGENCY'),
(71, 'EDO STATE TOURISM AGENCY'),
(72, 'EDO STATE DEVELOPMENT CONTROL AGENCY'),
(73, 'EDO STATE FORESTRY COMMISSION'),
(74, 'EDO STATE BUREAU OF STATISTICS'),
(75, 'AUDIT SERVICE COMMISSION'),
(76, 'SUSTAINABLE DEVELOPMENT GOALS PROGRAMME'),
(77, 'LOCAL GOVERNMENT PENSION BOARD'),
(78, 'EDO STATE FIRE SERVICE'),
(79, 'LAW REFORM COMMISSION'),
(80, 'EDO STATE INDEPENDENCE ELECTORAL COMMISSION (EDSIEC)'),
(81, 'EDO STATE SPORTS COMMISSION'),
(82, 'EDO COMMUNICATIONS OFFICE'),
(83, 'RURAL ACCESS AGRICULTURAL MOBILITY PROJECT(RAAMP)'),
(84, 'EDO CITY TRANSPORT SERVICE'),
(85, 'TRADITIONAL MEDICINE BOARD '),
(86, 'EDO STATE ELECTRIFICATION AGENCY'),
(87, 'EDO BROADCASTING SERVICE (EBS)'),
(88, 'EDO STATE TASKFORCE AGAINST HUMAN TRAFFICKING (ETAHT)'),
(89, 'EDO STATE MUSLIM PILGRIMS WELFARE BOARD'),
(90, 'POST BASIC EDUCATION BOARD'),
(91, 'AGRICULTURAL DEVELOPMENT PROGRAMME (ADP)'),
(92, 'EDO STATE TRAFFIC CONTROL AND MANAGEMENT AGENCY'),
(93, 'EDO STATE OIL AND GAS PRODUCING AREA DEVELOPMENT COMMISSION'),
(94, 'EDO STATE HOUSE OF ASSEMBLY COMMISSION'),
(95, 'JUDICIAL SERVICE COMMISSION'),
(96, 'SCHOOL OF HEALTH AND TECHNOLOGY'),
(97, 'COLLEGE OF AGRICULTURE, IGUORIAKHI'),
(98, 'EDO STATE POLYTECHNIC, USEN'),
(99, 'EDO STATE COLLEGE OF EDUCATION'),
(100, 'AMBROSE ALLI UNIVERSITY, EKPOMA (AAU)'),
(101, 'EDO STATE UNIVERSITY, UZAIRUE'),
(102, 'EDO STATE PARKS AND GARDENS AGENCY'),
(103, 'EDO PHARMACEUTICAL COMPANY'),
(104, 'EDO SIGNANGE AGENCY'),
(105, 'LAGOS LIASON OFFICE');

-- --------------------------------------------------------

--
-- Table structure for table `ticket_details`
--

CREATE TABLE `ticket_details` (
  `id` int(11) NOT NULL,
  `title` text NOT NULL,
  `fullNames` text NOT NULL,
  `firstName` text NOT NULL,
  `middle_name` text NOT NULL,
  `lastName` text NOT NULL,
  `staff_email` text NOT NULL,
  `access_level` text NOT NULL,
  `job_title` text NOT NULL,
  `ticket_status` text NOT NULL,
  `MDAs` text NOT NULL,
  `assign_unit` text NOT NULL,
  `ticket_no` text NOT NULL,
  `ticketCreatedBy` text NOT NULL,
  `ticketCat` text NOT NULL,
  `complaints` text NOT NULL,
  `comments` text NOT NULL,
  `files` text NOT NULL,
  `date_issued` text NOT NULL,
  `timeOfIssue` text NOT NULL,
  `actionOnTickets` text NOT NULL,
  `assigned_time` int(11) NOT NULL DEFAULT 0,
  `assigned_to` text NOT NULL,
  `newOfficer` text NOT NULL,
  `priorityLevel` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ticket_details`
--

INSERT INTO `ticket_details` (`id`, `title`, `fullNames`, `firstName`, `middle_name`, `lastName`, `staff_email`, `access_level`, `job_title`, `ticket_status`, `MDAs`, `assign_unit`, `ticket_no`, `ticketCreatedBy`, `ticketCat`, `complaints`, `comments`, `files`, `date_issued`, `timeOfIssue`, `actionOnTickets`, `assigned_time`, `assigned_to`, `newOfficer`, `priorityLevel`) VALUES
(3, 'Mr', 'Vincent  Ikeke', 'Vincent', '', 'Ikeke', 'v.ikeke@edostate.gov.ng', '3', 'Application Management (HQ)', 'Attended', 'INFORMATION COMMUNICATION TECHNOLOGY AGENCY', 'Application Management & Support (HQ Operation)', '#3907271', 'o.guobadia@edostate.gov.ng', 'request', 'EMAIL', 'Request for EDSG email for the staff of Ministry of Finance, Budget and Economic Planning', 'E-GOV ENROLLMENT MFBEP NEW STAFF.pdf', '2023-01-16', '1673866046', 'Closed', 1673866093, 'Vincent  Ikeke', '', 'Medium'),
(4, 'Mr', 'Elvis  Ewansiha', 'Elvis', '', 'Ewansiha', 'o.guobadia@edostate.gov.ng', '4', 'Service Desk &amp; Service Level Management', 'Attended', 'INFORMATION COMMUNICATION TECHNOLOGY AGENCY', 'Service Desk & Service Level Management', '#3868844', 'o.guobadia@edostate.gov.ng', 'request', 'EMAIL', 'Kindly reset password', '', '2023-01-16', '1673881617', 'Closed', 1673881675, 'Uhunoma Elvis Ewansiha', '', 'Medium'),
(5, 'Mr', 'Brooks  Okundaye', 'Brooks', '', 'Okundaye', 'b.okundaye@edostate.gov.ng', '2', 'Infrastructure and System Enginerring', 'Pending', 'INFORMATION COMMUNICATION TECHNOLOGY AGENCY', 'Infrastructure and System Engineering Unit', '#8921828', 'o.guobadia@edostate.gov.ng', 'request', 'EMAIL', 'Kindly do a migration of EDSG email for the staff of EDO-CSDA.\r\n	NAMES	DESIGNATION	E-MAIL\r\n1	Aiyedun Olorunfemi Stanley	Auditor	s.aiyedun@edostate.gov.ng\r\n2	Obarisiagbon Davids Nosa	M &amp; E Officer	d.obarisiagbon@edostate.gov.ng\r\n3	Omoruyi Osayimwense Paul	M &amp; E Officer	p.omoruyi@edostate.gov.ng\r\n4	Enakhimion John Ose	Operations Officer	j.enakhimion@edostate.gov.ng', '', '2023-01-17', '1673953746', 'Opened', 1673953795, 'Ogieva Brooks Okundaye', '', 'Medium'),
(6, 'Mr', 'Brooks  Okundaye', 'Brooks', '', 'Okundaye', 'b.okundaye@edostate.gov.ng', '2', 'Infrastructure and System Enginerring', 'Pending', 'INFORMATION COMMUNICATION TECHNOLOGY AGENCY', 'Infrastructure and System Engineering Unit', '#1316606', 'o.guobadia@edostate.gov.ng', 'request', 'EMAIL', 'Kindly migrate the email addresses of Staff of Primary Health Care', '', '2023-01-17', '1673958494', 'Opened', 1673958537, 'Ogieva Brooks Okundaye', '', 'Medium'),
(7, 'Mr', 'Courage Obehi Adaghe', 'Courage', 'Obehi', 'Adaghe', 'c.adaghe@edostate.gov.ng', '', 'Infrastructure/System Engineering', 'Attended', 'INFORMATION COMMUNICATION TECHNOLOGY AGENCY', 'Infrastructure and System Engineering Unit', '#6895420', 'c.adaghe@edostate.gov.ng', 'request', 'OTHERS', 'How do we manage to publish this? what is the user expected to do? Whois managing the backend? how do we get notifications when we are assigned tasks', '', '2023-01-19', '1674118934', 'Closed', 1674126679, 'Courage Obehi Adaghe', '', 'Medium'),
(8, 'Mr', 'Courage Obehi Adaghe', 'Courage', 'Obehi', 'Adaghe', 'c.adaghe@edostate.gov.ng', '', 'Infrastructure/System Engineering', 'Waiting', 'INFORMATION COMMUNICATION TECHNOLOGY AGENCY', 'Infrastructure and System Engineering Unit', '#5274547', 'c.adaghe@edostate.gov.ng', 'request', 'OTHERS', 'How do we manage to publish this? what is the user expected to do? Whois managing the backend? how do we get notifications when we are assigned tasks', '', '2023-01-19', '1674573454', 'Opened', 1674126692, 'Courage Obehi Adaghe', '', 'Medium'),
(9, 'Mr', 'Japhet  Aliu', 'Japhet', '', 'Aliu', 'j.aliu@edostate.gov.ng', '', 'Mechanical Engineer 1', 'Attended', 'EDO STATE PUBLIC BUILDING &amp; MAINTENANCE AGENCY', 'Customer Service and Content Management Unit', '#6951743', 'j.aliu@edostate.gov.ng', 'request', 'NETWORK', 'My System logged out of EDSG NETWORK. Error message that says &quot;incorrect username or password&quot; kept popping up upon trying to re-login.', '', '2023-01-24', '1674547784', 'Closed', 1674557237, 'Kenneth Osasumwen Enobakhare', '', 'Medium');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `fullnames` text NOT NULL,
  `firstName` text NOT NULL,
  `middleName` text NOT NULL,
  `lastName` text NOT NULL,
  `gender` text NOT NULL,
  `display_pic` text NOT NULL,
  `jobTitle` text NOT NULL,
  `access_level` text NOT NULL,
  `email_address` text NOT NULL,
  `pass_word` text NOT NULL,
  `MDA` text NOT NULL,
  `units` text NOT NULL,
  `created_at` text NOT NULL,
  `updated_at` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `fullnames`, `firstName`, `middleName`, `lastName`, `gender`, `display_pic`, `jobTitle`, `access_level`, `email_address`, `pass_word`, `MDA`, `units`, `created_at`, `updated_at`) VALUES
(1, 'Kenneth Osasumwen Enobakhare', 'Kenneth', 'Osasumwen', 'Enobakhare', 'Male', '', 'Application Developer', '4', 'e.kenneth@edostate.gov.ng', '16371405d1eb6d8188f3a7d67a1db24f', 'INFORMATION COMMUNICATION TECHNOLOGY AGENCY', 'Customer Service and Content Management Unit', 'Jul 03 2022', 'Jan, 25, 2023'),
(3, 'Vincent Ikeke', 'Vincent', '', 'Ikeke', 'Male', '', 'Application Management &amp; Support (HQ Operation):', '3', 'v.ikeke@edostate.gov.ng', 'e0d70e282aedc6a6be9912ee058bc85e', 'INFORMATION COMMUNICATION TECHNOLOGY AGENCY', 'Application Management &amp; Support (HQ Operation)', 'Jul 04 2022', 'Jan, 16, 2023'),
(6, 'Eghosa Junior Omoregbe', 'EGHOSA', 'JUNIOR', 'OMOREGBE', 'Male', '', 'Application Management &amp; Support (HQ Operation)', '1', 'e.omoregbee@edostate.gov.ng', 'b95224e9e2006ecfb39823451a0846eb', 'INFORMATION COMMUNICATION TECHNOLOGY AGENCY', 'Application Management &amp; Support (HQ Operation)', 'Jul 04 2022', ''),
(7, 'Juliet Toyin Agbadun', 'Juliet', 'Toyin', 'Agbadun', 'Female', '', 'Accounts', '1', 'j.agbadun@edostate.gov.ng', '4631094ebd0c2054c43b830156eb9feb', 'INFORMATION COMMUNICATION TECHNOLOGY AGENCY', 'Accounts', 'Jul 04 2022', ''),
(8, 'Donatus Igiekhume', 'Donatus', '', 'Igiekhume', 'Male', '', 'Customer Service &amp; Content Management', '4', 'd.igiekhume@edostate.gov.ng', '9ea1f387bd640dee2897ce1dab401a14', 'INFORMATION COMMUNICATION TECHNOLOGY AGENCY', 'Customer Service and Content Management Unit', 'Jul 04 2022', 'Jan, 16, 2023'),
(9, 'Ikhidero Patrick Ohaime', 'Ikhidero', 'Patrick', 'Ohaime', 'Male', '', 'Customer Service &amp; Content Management', '1', 'o.ikhidero@gmail.com', 'ec806ea43fae3199683773dd0d7713f7', 'INFORMATION COMMUNICATION TECHNOLOGY AGENCY', 'Customer Service and Content Management Unit', 'Jul 04 2022', ''),
(10, 'Samson Ohiomero Okhawere', 'Samson', 'Ohiomero', 'Okhawere', 'Male', '', 'Data Center Operations', '1', 's.okhawere@edostate.gov.ng', 'd6acff3b3d7348a9e66c766728c42d53', 'INFORMATION COMMUNICATION TECHNOLOGY AGENCY', 'Data Center Operations', 'Jul 04 2022', ''),
(11, 'George Utomi Iyoha', 'George', 'Utomi', 'Iyoha', 'Male', '', 'IT Audit and System Control', '1', 'g.iyoha@edostate.gov.ng', 'c91fd364cbdb687d8b84d3f5be0f5685', 'INFORMATION COMMUNICATION TECHNOLOGY AGENCY', 'IT Audit and System Control:', 'Jul 04 2022', ''),
(12, 'Godswill Osayanmo Alarezomo', 'Godswill', 'Osayanmo', 'Alarezomo', 'Male', '', 'IT Strategy and Buisness Alignment', '1', 'a.osayanmo@edostate.gov.ng', '54d0d208bbde7d8e8e359a1fec1f1825', 'INFORMATION COMMUNICATION TECHNOLOGY AGENCY', 'IT Strategy and Buisness Alignment:', 'Jul 04 2022', ''),
(13, 'Kelvin Osemenlu Ijieh', 'Kelvin', 'Osemenlu', 'Ijieh', 'Male', '', 'IT, HR, &amp; Admin/Store', '1', 'k.ijieh@edostate.gov.ng', '7660fca6c9df250d4d4fe30153d24c99', 'INFORMATION COMMUNICATION TECHNOLOGY AGENCY', 'IT, HR, &amp; Admin/Store', 'Jul 04 2022', ''),
(14, 'Solomon Ayemoba', 'Solomon', '', 'Ayemoba', 'Male', '', 'IT Project Management Office (ITPMO)', '1', 's.ayemobo@edostate.gov.ng', 'aee3ab2fd3bc71647ec79aa81af1d19d', 'INFORMATION COMMUNICATION TECHNOLOGY AGENCY', 'IT Project Management Office (ITPMO)', 'Jul 04 2022', ''),
(15, 'Malcolm Nosakhare Oputa', 'Malcolm', 'Nosakhare', 'Oputa', 'Male', '', 'IT Project Management Office (ITPMO)', '1', 'malcolmoputa@gmail.com', '32d73891a493faaef78e48de58aaf2c1', 'INFORMATION COMMUNICATION TECHNOLOGY AGENCY', 'IT Project Management Office (ITPMO)', 'Jul 05 2022', ''),
(16, 'Vincent Ojeh Olurunbe', 'Vincent', 'Ojeh', 'Olurunbe', 'Male', '', 'Hardware Maintenance/ End-User Computing', '2', 'vincent.olorunbe3@gmail.com', '3ffa3b2bd09c893adbad3fb72b85a62c', 'INFORMATION COMMUNICATION TECHNOLOGY AGENCY', 'Hardware Maintenance/ End-User Computing', 'Jul 05 2022', ''),
(17, 'Iroghama Queen Uwaifo', 'Iroghama', 'Queen', 'Uwaifo', 'Female', '', 'Network Infrastructure Support (HQ)', '1', 'q.uwaifo@edostate.gov.ng', 'e920eee418f0afa864fec83c2328555f', 'INFORMATION COMMUNICATION TECHNOLOGY AGENCY', 'Network Infrastructure Support (HQ)', 'Jul 05 2022', ''),
(18, 'Michael Oshiogwemoh Oshioshio', 'Michael', 'Oshiogwemoh', 'Oshioshio', 'Male', '', 'Network Infrastructure Support (HQ)', '1', 'm.oshioshio@edostate.gov.ng', '74f3aab1bcb9d142fc5c64dab74a3c6f', 'INFORMATION COMMUNICATION TECHNOLOGY AGENCY', 'Network Infrastructure Support (HQ)', 'Jul 05 2022', 'Jan, 16, 2023'),
(19, 'Eseosa Eghomwanre', 'Eseosa', '', 'Eghomwanre', 'Male', '', 'Network Infrastructure Support (HQ)', '1', 'e.eghomwanre@edostate.gov.ng', '4707347c1ed7a499834e40ced5752c08', 'INFORMATION COMMUNICATION TECHNOLOGY AGENCY', 'Network Infrastructure Support (HQ)', 'Jul 05 2022', ''),
(20, 'Odianoise John Ijanmi', 'Odianoise', 'John', 'Ijanmi', 'Male', '', 'Network Infrastructure Support (HQ)', '1', 'i.odianoise@edostate.gov.ng', '48b6cb898d86261c436d9b3d566b4fb3', 'INFORMATION COMMUNICATION TECHNOLOGY AGENCY', 'Network Infrastructure Support (HQ)', 'Jul 05 2022', ''),
(21, 'Ogiegbaen Uyiekpen Aduwa', 'Ogiegbaen', 'Uyiekpen', 'Aduwa', 'Male', '', 'Network Infrastructure Support (HQ)', '1', 'u.aduwa@edostate.gov.ng', '84f643d8d10de9f124262730ca8becfb', 'INFORMATION COMMUNICATION TECHNOLOGY AGENCY', 'Network Infrastructure Support (HQ)', 'Jul 05 2022', ''),
(22, 'Eromosele Matthew Owede', 'Eromosele', 'Matthew', 'Owede', 'Male', '', 'Network Infrastructure Support (LGA)', '1', 'm.owede@edostate.gov.ng', '2c95e50ec6e8072946330b3aa8a5e5cb', 'INFORMATION COMMUNICATION TECHNOLOGY AGENCY', 'Network Infrastructure Support (LGA)', 'Jul 05 2022', ''),
(23, 'Abiodun Rodney Ayeni', 'Abiodun', 'Rodney', 'Ayeni', 'Male', '', 'Network Infrastructure Support (LGA)', '1', 'a.abiodun@edostate.gov.ng', '2c9fe1f8daebe23860ee7528874b7260', 'INFORMATION COMMUNICATION TECHNOLOGY AGENCY', 'Network Infrastructure Support (LGA)', 'Jul 05 2022', 'Jan, 17, 2023'),
(24, 'Omorogbe Benjamin Obaiwi', 'Omorogbe', 'Benjamin', 'Obaiwi', 'Male', '', 'Network Infrastructure Support (LGA)', '1', 'o.benjamin@edostate.gov.ng', '61e74e80270c33a1ba8b1cddd3b9bb33', 'INFORMATION COMMUNICATION TECHNOLOGY AGENCY', 'Network Infrastructure Support (LGA)', 'Jul 05 2022', ''),
(25, 'Peter Osarenoma Igbinoba', 'Peter', 'Osarenoma', 'Igbinoba', 'Male', '', 'Network Infrastructure Support (LGA)', '2', 'i.osarenoma@edostate.gov.ng', '52774d7dc58dcf34fa5ed1ab75edb221', 'INFORMATION COMMUNICATION TECHNOLOGY AGENCY', 'Network Infrastructure Support (LGA)', 'Jul 05 2022', ''),
(26, 'Steven Isabeimoh', 'Steven', '', 'Isabeimoh', 'Male', '', 'Network Infrastructure Support (LGA)', '1', 's.isabeimoh@edostate.gov.ng', 'e1590bf0fa8d39212c05f0d4172762cb', 'INFORMATION COMMUNICATION TECHNOLOGY AGENCY', 'Network Infrastructure Support (LGA)', 'Jul 05 2022', ''),
(27, 'John Omoneka Etute', 'John', 'Omoneka', 'Etute', 'Male', '', 'Planning &amp; Scheduling', '2', 'j.etute@edostate.gov.ng', '9bef60e28493a2259a0c0b76be5a79b8', 'INFORMATION COMMUNICATION TECHNOLOGY AGENCY', 'Planning and Scheduling Unit', 'Jul 05 2022', 'Jan, 16, 2023'),
(28, 'Joy Amen Ajayi', 'Joy', 'Amen', 'Ajayi', 'Female', '', 'Portfolio Delivery &amp; Meaasurment', '1', 'a.ajayi@edostate.gov.ng', '9cd6a3e6abff585616d625bda8aad5ab', 'INFORMATION COMMUNICATION TECHNOLOGY AGENCY', 'Portfolio Delivery &amp; Meaasurment', 'Jul 05 2022', 'Jan, 16, 2023'),
(29, 'Onokhotinagbo Matthew Egbabe', 'Onokhotinagbo', 'Matthew', 'Egbabe', 'Male', '', 'Portfolio Delivery &amp; Meaasurment', '1', 'matthewegbagbe@gmail.com', '92b4a1ed4a43486d1b3f9c3f3e8cfa5d', 'INFORMATION COMMUNICATION TECHNOLOGY AGENCY', 'Portfolio Delivery &amp; Meaasurment', 'Jul 05 2022', ''),
(30, 'Nwokere Anthony Okpujie', 'Nwokere', 'Anthony', 'Okpujie', 'Male', '', 'Server &amp; Storage Support', '1', 'a.okokpujie@edostate.gov.ng', 'ce813a854c20c7f9316a75eabcff080a', 'INFORMATION COMMUNICATION TECHNOLOGY AGENCY', 'Server &amp; Storage Support', 'Jul 05 2022', ''),
(31, 'Osayi Endurance Vincent', 'Osayi', 'Endurance', 'Vincent', 'Male', '', 'Service Desk &amp; Service Level Management', '1', 'v.osayi@edostate.gov.ng', '2d8c2d39d0346eec96d709ea0aafb028', 'INFORMATION COMMUNICATION TECHNOLOGY AGENCY', 'Service Desk &amp; Service Level Management', 'Jul 05 2022', ''),
(32, 'Uhunoma Elvis Ewansiha', 'Uhunoma', 'Elvis', 'Ewansiha', 'Male', '', 'Service Desk &amp; Service Level Management', '4', 'e.elvis@edostate.gov.ng', 'd9557da97a59c90808a2b93cc46053fb', 'INFORMATION COMMUNICATION TECHNOLOGY AGENCY', 'Service Desk &amp; Service Level Management', 'Jul 05 2022', 'Jan, 25, 2023'),
(33, 'Goodluck Igbinedion', 'Goodluck', '', 'Igbinedion', 'Male', '', 'Managing Director', '1', 'g.igbinedion@edostate .gov.ng', '70df542e017cb72ffcf0dc2eb3b6594d', 'INFORMATION COMMUNICATION TECHNOLOGY AGENCY', 'NONE', 'Jul 06 2022', ''),
(34, 'Emojabo Iyamah', 'Emojabo', '', 'Iyamah', 'Female', '', 'Director', '1', 'e.iyamah@edostate .gov.ng', 'c86ab46b39f47af380d93ecb7265dffc', 'INFORMATION COMMUNICATION TECHNOLOGY AGENCY', 'NONE', 'Jul 06 2022', ''),
(35, 'Sunday Odiagbe', 'Sunday', '', 'Odiagbe', 'Male', '', 'None', '3', 's.odiagbe@edostate .gov.ng', '16371405d1eb6d8188f3a7d67a1db24f', 'INFORMATION COMMUNICATION TECHNOLOGY AGENCY', 'NONE', 'Jul 06 2022', 'Jan, 11, 2023'),
(36, 'Endurance Adoghe Ebehiwialu', 'Endurance', 'Adoghe', 'Ebehiwialu', 'Male', '', 'IT Strategy and Buisness Alignment', '3', 'e.ebehiwialu@edostate.gov.ng', '16371405d1eb6d8188f3a7d67a1db24f', 'INFORMATION COMMUNICATION TECHNOLOGY AGENCY', 'IT Strategy and Buisness Alignment:', 'Jul 06 2022', 'Jan, 12, 2023'),
(37, 'Lateef Ademola Adewunmi', 'Lateef', 'Ademola', 'Adewunmi', 'Male', '', 'Planning &amp; Scheduling', '1', 'l.ademola@edosate.gov.ng', '17668b435d64815b1eb8170bd52e35ea', 'INFORMATION COMMUNICATION TECHNOLOGY AGENCY', 'Planning and Scheduling Unit', 'Jul 06 2022', ''),
(38, 'Courage Obehi Adaghe', 'Courage', 'Obehi', 'Adaghe', 'Male', '', 'Infrastructure/System Engineering', '3', 'c.adaghe@edostate.gov.ng', 'cee60eee420af78bafbb3bb89eff9404', 'INFORMATION COMMUNICATION TECHNOLOGY AGENCY', 'Infrastructure and System Engineering Unit', 'Jul 06 2022', 'Jan, 19, 2023'),
(39, 'Evelyn Izogie Okouronmhu', 'Evelyn', 'Izogie', 'Okouronmhu', 'Female', '', 'MDA Application management &amp; Surpport LGA Operation)', '1', 'e.okouronmhu@edostate.gov.ng', '00a94d0b71b8d15c31e7fd623d96b84c', 'INFORMATION COMMUNICATION TECHNOLOGY AGENCY', 'MDA Application management &amp; Surpport LGA Operation)', 'Jul 06 2022', ''),
(40, 'Osamudiamen Guobadia', 'Osamudiamen', '', 'Guobadia', 'Female', '', 'Service Desk &amp; Service Level Management', '4', 'o.guobadia@edostate.gov.ng', '38c66a44f692bcef41d99fb2fe61f33c', 'INFORMATION COMMUNICATION TECHNOLOGY AGENCY', 'Service Desk &amp; Service Level Management', 'Jul 06 2022', 'Jan, 25, 2023'),
(41, 'Godwin Ototo', 'Godwin', '', 'Ototo', 'Male', '', 'Dabase Management &amp; Surpport(HQ Operation)', '1', 'g.ototo@edostate.gov.ng', '135f0e391c25688221c6c85adbb1fb51', 'INFORMATION COMMUNICATION TECHNOLOGY AGENCY', 'Dabase Management &amp; Surpport(HQ Operation)', 'Jul 06 2022', ''),
(42, 'Usman Sule Oseni', 'Usman', 'Sule', 'Oseni', 'Male', '', 'Data Center Operations', '1', 'o.usman@edostate.gov.ng', '7ffc1792cb191b41faa2e81d941f9f35', 'INFORMATION COMMUNICATION TECHNOLOGY AGENCY', 'Data Center Operations', 'Jul 06 2022', ''),
(43, 'Avwerosuo Emuesiri Otevia', 'Avwerosuo', 'Emuesiri', 'Otevia', 'Female', '', 'IT, HR, &amp; Admin/Store', '1', 'a.otevia@edostate.gov.ng', '9c2f54b85cca7495169e26f81684f00a', 'INFORMATION COMMUNICATION TECHNOLOGY AGENCY', 'IT, HR, &amp; Admin/Store', 'Jul 06 2022', ''),
(44, 'Samuel Usifoh Aramude', 'Samuel', 'Usifoh', 'Aramude', 'Male', '', 'Database Management &amp; Support(HQ Operation)', '1', 'SamuelAramude@edostate.gov.ng', '521b9200ff898446639868e739fc1026', 'INFORMATION COMMUNICATION TECHNOLOGY AGENCY', 'Dabase Management &amp; Surpport(HQ Operation)', 'Jul 06 2022', ''),
(45, 'James Ufuoma Sorogheye', 'James', 'Ufuoma', 'Sorogheye', 'Male', '', 'Dabase Management &amp; Surpport(HQ Operation)', '1', 'j.sorogheye@edosate.gov.ng', '759f0006e22924efe66cd70b7238ce4e', 'INFORMATION COMMUNICATION TECHNOLOGY AGENCY', 'Dabase Management &amp; Surpport(HQ Operation)', 'Jul 06 2022', ''),
(46, 'Eghosa Erhatiemwonmon', 'Eghosa', '', 'erhatiemwonmon', 'Male', '', 'Dabase Management &amp; Surpport(HQ Operation)', '1', 'e.erhatiemwonmon@edostate.gov.ng', '03cc5a574fa748d32cd25b391bc40863', 'INFORMATION COMMUNICATION TECHNOLOGY AGENCY', 'Dabase Management &amp; Surpport(HQ Operation)', 'Jul 06 2022', ''),
(47, 'Ojeikere Omokhoje', 'Ojeikere', '', 'Omokhoje', 'Male', '', 'Architecture/Information Mangement', '3', 'o.ojeikere@edostate.gov.ng', '16371405d1eb6d8188f3a7d67a1db24f', 'INFORMATION COMMUNICATION TECHNOLOGY AGENCY', 'Architecture/Information Mangement', 'Jul 06 2022', 'Jan, 09, 2023'),
(48, 'Nosariere Doreen Adams', 'Nosariere', 'Doreen', 'Adams', 'Female', '', 'Buisness (MDA) Relationship Management', '1', 'n.ogieva@edostate.gov.ng', '11643912e02571117c44033c4448ffbc', 'INFORMATION COMMUNICATION TECHNOLOGY AGENCY', 'Buisness (MDA) Relationship Management', 'Jul 06 2022', ''),
(49, 'Odion Peter Okodugha', 'Odion', 'Peter', 'Okodugha', 'Male', '', 'Network Infrastructure Support (HQ)', '2', 'o.okodugha@edostate.gov.ng', 'c26616f39eb869fe123f8321934bcfe8', 'INFORMATION COMMUNICATION TECHNOLOGY AGENCY', 'Network Infrastructure Support (HQ)', 'Jul 06 2022', ''),
(50, 'Abdulsalami Peters Mohammed', 'Abdulsalami', 'Peters', 'Mohammed', 'Male', '', 'Project Manager', '1', 'a.peters@edostate.gov.ng', '749409ff7dbfb90ec02271bd0be2a9ba', 'INFORMATION COMMUNICATION TECHNOLOGY AGENCY', 'Planning and Scheduling Unit', 'Jul 06 2022', ''),
(51, 'Ogieva Brooks Okundaye', 'Ogieva', 'Brooks', 'Okundaye', 'Male', '', 'Infrastructure/System Engineering', '2', 'b.okundaye@edostate.gov.ng', '16371405d1eb6d8188f3a7d67a1db24f', 'INFORMATION COMMUNICATION TECHNOLOGY AGENCY', 'Infrastructure and System Engineering Unit', 'Jul 06 2022', 'Jan, 17, 2023'),
(52, 'Osakpolor Joseph Enofe', 'Osakpolor', 'Joseph', 'Enofe', 'Male', '', 'Customer Service &amp; Content Management', '2', 'o.enofe@edostate.gov.ng', '16371405d1eb6d8188f3a7d67a1db24f', 'INFORMATION COMMUNICATION TECHNOLOGY AGENCY', 'Customer Service and Content Management Unit', 'Jul 06 2022', 'Jan, 11, 2023'),
(53, 'Osas Matthew Igunma', 'Osas', 'Matthew', 'Igunma', 'Male', '', 'Data Center Operations', '1', 'mtigunma@gmail.com', '5e71d9a975a7fd14c46dbdbe5cf2425a', 'INFORMATION COMMUNICATION TECHNOLOGY AGENCY', 'Data Center Operations', 'Jul 06 2022', ''),
(54, 'Joshua Aisosa Aluyi', 'Joshua', 'Aisosa', 'Aluyi', 'Male', '', 'Data Center Operations', '1', 'a.joshua@edostate.gov.ng', '932541a7236571f6fdb48da0e020dfc6', 'INFORMATION COMMUNICATION TECHNOLOGY AGENCY', 'Data Center Operations', 'Jul 06 2022', ''),
(55, 'Oriazowan Confidence Oyakhilome', 'Oriazowan', 'Confidence', 'Oyakhilome', 'Male', '', 'Architecture/Information Mangement', '1', 'o.oyakhilome@edogov.ng', 'd947f7959c846a9696fc2c391dcdb0b0', 'INFORMATION COMMUNICATION TECHNOLOGY AGENCY', 'Architecture/Information Mangement', 'Jul 06 2022', ''),
(56, 'Ovienmhanda Basil', 'Ovienmhanda', 'Basil', 'Osemudiamhen', 'Male', '', 'IT, HR, &amp; Admin/Store', '1', 'o.osemudiamhen@edostate.gov.ng', '6e274ed89a8adf2ba9c0b22ff700b0b7', 'INFORMATION COMMUNICATION TECHNOLOGY AGENCY', 'IT, HR, &amp; Admin/Store', 'Jul 06 2022', ''),
(57, 'Rita Ehidiamen ', 'Rita', '', 'Ehidiamen', 'Female', '', 'IT, HR, &amp; Admin/Store', '1', 'r.ehidiamhen@edostate.gov.ng', '201441e9fac5c5ae6bff2ee78c686618', 'INFORMATION COMMUNICATION TECHNOLOGY AGENCY', 'IT, HR, &amp; Admin/Store', 'Jul 06 2022', ''),
(58, 'Hope Aremoh', 'Hope', '', 'Aremoh', 'Male', '', 'Application Management &amp; Support (HQ Operation)', '1', 'h.aremoh@edostate.gov.ng', '372baba64defabb940399901f3725be3', 'INFORMATION COMMUNICATION TECHNOLOGY AGENCY', 'Application Management &amp; Support (HQ Operation)', 'Jul 06 2022', ''),
(59, 'Samuel Chinedu Irubor', 'Samuel', 'Chinedu', 'Irubor', 'Male', '', 'Architecture/Information Mangement', '1', 's.irubor@edostate.gov.ng', '83af09c6a18b8cf9e9ddf18929cba8fc', 'INFORMATION COMMUNICATION TECHNOLOGY AGENCY', 'Architecture/Information Mangement', 'Jul 06 2022', ''),
(60, 'Ehijimentor Victor Asein', 'Ehijimentor', 'Victor', 'Asein', 'Male', '', 'None', '1', 'asainehis@gmail.com', '94058720f66a8c9affce2e99a9072c2b', 'INFORMATION COMMUNICATION TECHNOLOGY AGENCY', 'NONE', 'Jul 06 2022', ''),
(61, 'Ayo Omobude', 'Ayo', '', 'Omobude', 'Male', '', 'Data Center Operations', '1', 'a.omobude@edostate.gov.ng', '150baee4846cd65795299b9de686049a', 'INFORMATION COMMUNICATION TECHNOLOGY AGENCY', 'Data Center Operations', 'Jul 06 2022', ''),
(62, 'Nathaniel Osemudiamen Aghughu', 'Nathaniel', 'Osemudiamen', 'Aghughu', 'Male', '', 'IT Project Management Office(ITPMO)', '1', 'n.aghughu@edostate.gov.ng', '55b7a78a6e595874441c59744b58b0e5', 'INFORMATION COMMUNICATION TECHNOLOGY AGENCY', 'IT Project Management Office (ITPMO)', 'Jul 06 2022', ''),
(63, 'Samuel Ademola Ola', 'Samuel', 'Ademola', 'Ola', 'Male', '', 'IT, HR, &amp; Admin', '1', 'SamuelOla@edostate.gov.ng', '16371405d1eb6d8188f3a7d67a1db24f', 'OFFICE OF THE DEPUTY GOVERNOR', '', 'Jan 09 2023', 'Jan, 09, 2023'),
(65, 'Mark  Obasuyi', 'Mark', '', 'Obasuyi', 'Male', '', 'Admin II', '1', 'kenenobas@gmail.com', '16371405d1eb6d8188f3a7d67a1db24f', 'MINISTRY OF FINANCE', '', 'Jan 11 2023', 'Jan, 12, 2023'),
(66, 'Frank Osayi Uwaifo', 'Frank', 'Osayi', 'Uwaifo', 'Male', '', 'data analyst officer II', '1', 'frank_osayi@edostate.gov.ng', '16371405d1eb6d8188f3a7d67a1db24f', 'INFORMATION COMMUNICATION TECHNOLOGY AGENCY', 'Data Center Operations', 'Jan 12 2023', 'Jan, 24, 2023'),
(68, 'Japhet  Aliu', 'Japhet', '', 'Aliu', 'Male', '', 'Mechanical Engineer 1', '1', 'j.aliu@edostate.gov.ng', '0e667f2173b4150e67c4e704fe870164', 'EDO STATE PUBLIC BUILDING &amp; MAINTENANCE AGENCY', '', 'Jan 23 2023', 'Jan, 24, 2023');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comments_logs`
--
ALTER TABLE `comments_logs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comment_registry`
--
ALTER TABLE `comment_registry`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `icta_units`
--
ALTER TABLE `icta_units`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ministries`
--
ALTER TABLE `ministries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ticket_details`
--
ALTER TABLE `ticket_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comments_logs`
--
ALTER TABLE `comments_logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `comment_registry`
--
ALTER TABLE `comment_registry`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `icta_units`
--
ALTER TABLE `icta_units`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `ministries`
--
ALTER TABLE `ministries`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=106;

--
-- AUTO_INCREMENT for table `ticket_details`
--
ALTER TABLE `ticket_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
