-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Dec 01, 2018 at 02:56 AM
-- Server version: 5.6.41-84.1
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `wewillfi_wewillfixyourpc`
--

-- --------------------------------------------------------

--
-- Table structure for table `content`
--

CREATE TABLE `content` (
  `id` int(100) NOT NULL,
  `text` longtext NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `content`
--

INSERT INTO `content` (`id`, `text`, `username`, `password`) VALUES
(1, '<p>We provide a wide range of computer services and support for residential and small business customers in the Cardiff and Caerphilly area. </p>\r\n                        <p>We specialise in repairing computer desktops, laptops and netbooks.</p>\r\n                    <div id=\"bullet\">\r\n                      <ul style=\"margin-top:20px;\">\r\n                        <li>We diagnose, repair, upgrade and rebuild all makes and models.</li>\r\n                        <li>Carry out motherboard component level repairs, power socket replacements (DC Jacks) and laptop screen replacements at very competitive rates with a quick turnaround. </li>\r\n                        <li>24 hour turnaround on virus removal, data recovery, software upgrades, including speeding up your slow pc or laptop.</li>\r\n                        <li>Internet and network setup, parental controls, etc.</li>\r\n                     </ul>\r\n				  </div>\r\n                        <p><strong>Our Prices start from as low as Â£19.00. Click here for our <a href=\"price.php\">price guide.</a></strong> </p> ', 'wewillfix', 'passw0rd1'),
(2, '<p><strong>We have over 15 years of experience serving residential and small businesses. We offer a fast friendly service with:</strong>  </p>\r\n                        <div id=\"circle\">\r\n                            <ul style=\"margin-top:20px;\">\r\n                            <li>Lowest price guarantee.</li>\r\n                            <li>No Fix - No Fee.</li>\r\n                            <li>FREE diagnostics.</li>\r\n                            <li>Quick 24 hour repair turnaround on most services.</li>\r\n                            <li>Specific appointment times to fit around your availability.</li>\r\n                            <li>Longer working hours.</li>\r\n                            <li>90 day guarantee / warranty.</li>\r\n                            <li>FREE collection and delivery.</li>\r\n                            <li>FREE Courtesy laptop available.</li>\r\n                            <li>Local personalised service.</li>\r\n                            <li>We will buy your old laptop for parts!</li>\r\n                            </ul>\r\n						</div>\r\n                        <p><strong>Give us try, Call us now! </strong> </p> ', 'wewillfix', 'passw0rd1'),
(3, ' <div class=\"box4\">\r\n			<div class=\"indent\" style=\"background:#FFFFFF;\"><font color=\"#e46c0a\">All Diagnostics : FREE</font></div>\r\n	   </div>\r\n       \r\n       <div class=\"box4\">\r\n			<div class=\"indent\" style=\"background:#FFFFFF;font-size:14px; color:#000;\">\r\n						<h4>Phone Support & Advice : FREE </h4>\r\n                        <p>Fantastic help and advice given over the phone for anything from a small problem to buying a new computer.</p>\r\n			</div>\r\n		</div>\r\n        \r\n        <div class=\"box4\">\r\n			<div class=\"indent\" style=\"background:#FFFFFF;font-size:14px; color:#000;\">\r\n					<h4>Simple Issues : from as little as Â£19</h4>\r\n                    <p>Routine maintenance such as software installs, data transfer, memory upgrades, password removal etc.</p>\r\n			</div>\r\n		</div>\r\n        \r\n            <div class=\"box4\">\r\n				<div class=\"indent\" style=\"background:#FFFFFF;font-size:14px; color:#000;\">\r\n					<h4>Complex Issues : from as little as Â£39</h4>\r\n                    <p>Hardware and software repairs such as laptop power socket repair, virus removal, system rebuilds etc. </p>\r\n				</div>\r\n			</div>\r\n            \r\n            <div class=\"box4\">\r\n				<div class=\"indent\" style=\"background:#FFFFFF;font-size:14px; color:#000;\">\r\n						<h4>Critical Issues : from as little as Â£69</h4>\r\n                        <p>Hardware issues that require parts such as laptop screen replacements, laptop motherboard repairs etc. </p>\r\n				</div>\r\n			</div>', 'wewillfix', 'passw0rd1'),
(4, '				<strong style=\"color:#3890bd; font-size:14px;\"> By Phone</strong> <br /><br /> \r\n    			<strong style=\"color:#990000;\"> <a href=\"tel:02920766039\" >02920 766039</a> Â Â Â  <- Click to call</strong> <br /> <br /> <strong style=\"color:#990000;\"><a href=\"tel:07999056096\">07999 056096</a>Â Â Â  <- Click to call</strong> <br /><br />\r\n            	<strong style=\"color:#3890bd; font-size:14px;\" >By Email:</strong> <br /><br />\r\n            	<strong style=\"color:#0066cc; text-decoration:underline; font-size:14px;\"><a href=\"mailto:neil@wewillfixyourpc.co.uk\">neil@wewillfixyourpc.co.uk</a> </strong> <br /><br />\r\n            	<strong style=\"color:#3890bd; font-size:14px;\"> By Post or Visit: </strong> <br />\r\n            	39 Lambourne Crescent <br />\r\n				Llanishen <br />\r\n  	    		Cardiff <br />\r\n				CF14 5GG <br />			\r\n           <img src=\"images/Map.jpg\" width=\"244\" />	', 'wewillfix', 'passw0rd1');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_admin_users`
--

CREATE TABLE `tbl_admin_users` (
  `userId` bigint(6) NOT NULL,
  `userName` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `EMail` varchar(100) NOT NULL,
  `department` int(2) NOT NULL,
  `firstName` varchar(100) NOT NULL,
  `lastName` varchar(100) NOT NULL,
  `dateBirth` date DEFAULT NULL,
  `address` text,
  `city` varchar(100) DEFAULT NULL,
  `postcode` varchar(20) DEFAULT NULL,
  `country` varchar(2) NOT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `mobile` varchar(20) DEFAULT NULL,
  `status` char(1) NOT NULL DEFAULT 'E',
  `modifiedon` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_admin_users`
--

INSERT INTO `tbl_admin_users` (`userId`, `userName`, `password`, `EMail`, `department`, `firstName`, `lastName`, `dateBirth`, `address`, `city`, `postcode`, `country`, `phone`, `mobile`, `status`, `modifiedon`) VALUES
(1, 'admin', '036590874f659965f5152b429e947d0e', 'neil@cardifftec.co.uk', 0, 'admin', 'admin', NULL, '3', NULL, '', '', '', NULL, 'E', '2017-05-06 08:30:27');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_appointments`
--

CREATE TABLE `tbl_appointments` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `email` varchar(255) NOT NULL,
  `house_no` varchar(50) NOT NULL,
  `area` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `postal_code` varchar(50) NOT NULL,
  `computer_type` varchar(100) NOT NULL,
  `problem_desc` varchar(1000) DEFAULT NULL,
  `date` varchar(10) NOT NULL,
  `month` varchar(20) NOT NULL,
  `hours` varchar(10) NOT NULL,
  `minutes` varchar(10) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_appointments`
--

INSERT INTO `tbl_appointments` (`id`, `name`, `phone`, `email`, `house_no`, `area`, `city`, `postal_code`, `computer_type`, `problem_desc`, `date`, `month`, `hours`, `minutes`) VALUES
(1, 'Celia Castaneda', '07410989151', 'celia.castanedarios@gmail.com', 'Flat 3, 21 Partridge Road', 'Roath', 'Cardiff', 'CF243QW', 'Desktop', 'Hi, yesterday my charger broke down while i was turning on my laptop. Since then it has not been able to recognize the operating system. I do not have access to any data stored on the hard drive. I need a complete diagnosis and your advice to see if I can back up all my data and get Windows and all the programs restored. Can you please come and pick up the laptop in the afternoon at 5pm, it is when I am back home from work.  Tomorrow 9th of Dec would be great, otherwise Tuesday 10th.  Please call me between 1 and 1.30pm or text me whether you need to get in touch. Thanks a lot for your assistance. Celia.', '09', 'December', '17', '00'),
(2, 'bb', '99', 'kk@kk.com', 'n', 'e.g. Whitchurch', 'Cardiff', '', 'Desktop', '', '01', 'January', '01', '00'),
(3, 'Robyn Bradbury', '07815575959', 'Robynbradbury1@gmail.com', '67 Richmond Road', 'Roach', 'Cardiff', 'cF24 3AR', 'Laptop', 'Laptop very slow and has viruses. I would like the computer cleared of everything, so  I can make a fresh start with no viruses and quicker loading times.', '21', 'January', '19', '30'),
(4, 'Eleri Bateman', '07855384635', 'e.bateman@hotmail.co.uk', '36 Mafeking Road', 'Penylan', 'Cardiff', 'CF23 5DQ', 'Laptop', 'The laptop will not turn on - it gets to the starting windows screen and then fails and the laptop restarts and then brings up the options of turning it on normally or try to repair the problem.  It tries to troubleshoot the problem but this also fails and restarts again.  If I select turning on normally this also fails.', '31', 'January', '10', '00'),
(5, 'Chloe Matthews', '07590310432', 'chlomat@hotmail.co.uk', 'B 6/6 Plas Gwyn', 'Llandaff', 'Cardiff', 'CF5 2XJ', 'Laptop', 'Split liquid on keyboard, and now it doesn\'t work.', '28', 'April', '16', '00'),
(6, 'Kathleen Job', '07815836182', 'kath.job@gmail.com', 'EIP, 9-11 Castle Street', 'Cardiff Centre', 'Cardiff', 'CF10 1BS', 'Laptop', 'Think something wrong with graphics card, display isn\'t right, probably overheating too, been knocked about a bit! Personal laptop but address opposite is my work address - could you collect it from there?', '12', 'June', '13', '00'),
(7, 'Beth Young', '07986283164', 'beth26693@hotmail.com', '45 Lisvane Street', 'Cathays', 'Cardiff', 'CF24 4AQ', 'Laptop', 'My laptop won\'t turn on.', '29', 'July', '17', '30'),
(8, 'Luke Davies', '07800849748', 'lukepauldavies@gmail.com', '19 Clos Dewi Sant', 'Canton/City Centre', 'Cardiff', 'CF11 9EW', 'Laptop', 'My laptop needs a replacement battery on the motherboard. The system keeps telling me that the BIOS battery is failing.\r\n\r\nAlso, my laptop crashes whenever I pay games, seems like it\'s overheating.\r\n\r\nIt\'s a Toshiba Satelitte L750/L755.\r\n\r\nCan you please give me a quote for the likely cost of repairs/fixing the overhearing before sending anyone out.\r\n\r\nThank you,\r\n\r\nLuke', '02', 'August', '10', '00'),
(9, 'Jason Pritchard', '07841435122', 'jasonpritchard6173@hotmail.com', '12 Senghenydd Road', 'Cathays', 'Cardiff', 'Cf24 4AH', 'Laptop', 'Cracked Screen. Laptop is a Samsung Notebook, model number NP530U3C', '19', 'September', '02', '00'),
(10, 'Sandie Clarke', '07889284723', 'foo88clarke@hotmail.com', '7 Falfield Close', 'Lisvane', 'Cardiff', 'CF140GB', 'Laptop', 'Sony Vaio. No desktop page when laptop is switched on. Screen is black and it does not open desktop page.', '04', 'October', '11', '30'),
(11, 'Kerry Jones', '07718267465', 'kaygey@hotmail.com', '218 Ninian Park Road', 'Riverside', 'Cardiff', 'CF11 6JG', 'Desktop', 'Mozilla firefox stopped working properly when avg2014 tried to upload. Cannot use links error message cannot load XPCOM. Tried to uninstall firefox but wont uninstall.\r\nIm working in Big Wheelers on Wednesday 9 til 1 so whatever time suits', '15', 'October', '09', '30'),
(12, 'Laura Evans', '07969273428', 'laevans1986@gmail.com', '146', 'Canton', 'Cardiff', 'CF5 1QQ', 'Laptop', 'Problems with sound-audio too quiet even on highest volume setting, and headphone jack does not work.', '01', 'December', '11', '30'),
(13, 'xvaokfhl', '555-666-0606', 'sample@email.tst', '', 'e.g. Whitchurch', 'Cardiff', '94102', 'Desktop', '', '01', 'January', '01', '00'),
(14, 'jmamyswn', '555-666-0606', 'sample@email.tst', '', 'e.g. Whitchurch', 'Cardiff', '94102', 'Netbook', '', '01', 'January', '01', '00'),
(15, 'xsqhxmhs', '555-666-0606', 'sample@email.tst', '', 'e.g. Whitchurch', 'Cardiff', '94102', 'Laptop', '', '01', 'January', '01', '00'),
(16, 'cbklayqx', '555-666-0606', 'sample@email.tst', '', 'e.g. Whitchurch', 'Cardiff', '94102', 'Desktop', '', '03', 'January', '01', '00'),
(17, 'gedkcrxu', '555-666-0606', 'sample@email.tst', '', 'e.g. Whitchurch', 'Cardiff', '94102', 'Others', '', '01', 'January', '01', '00'),
(18, 'vfkgjmsp', '555-666-0606', 'sample@email.tst', '', 'e.g. Whitchurch', 'Cardiff', '94102', 'Desktop', '', '02', 'January', '01', '00'),
(19, 'rooshi patel', '07904788430', 'rooship1@yahoo.co.uk', '290 whitchurch road', 'heath', 'Cardiff', 'cf14 3ne', 'Laptop', '', '19', 'January', '13', '00'),
(20, 'rooshi patel', '07904788430', 'rooship1@yahoo.co.uk', '290 whitchurch road', 'heath', 'Cardiff', 'cf14 3ne', 'Laptop', 'The backlight is not working properly. On startup it will work normally for a few seconds, then turn off. It comes back on briefly for a fee seconds then turns off again. The screen is working as you can see what\'s happening if you look closely, but without a backlight its completely dim.\r\nThe laptop is a Fujitsu Amilo Li3710.', '19', 'January', '13', '00'),
(21, 'Javier Garrido', '07581440955', 'javigs@msn.com', '14, Clive street', 'Grangetown', 'Cardiff', 'CF11 7JB', 'Laptop', 'Hello,\r\n\r\nmy laptop is a HP dm1 4351ss. When I turn it on, the screen is off, but the fan and all those stuff seem working, and the small lights on top and the capital letter botton is flashing.\r\n\r\nHow much will it costs to repair??\r\n\r\nThank you very much and looking forward to hearing from you soon,\r\n\r\nregards.', '26', 'March', '15', '00'),
(22, 'Blake', '07901655110', 'blake-lewis@hotmail.co.uk', '14 Timbers Square', 'Roath', 'Cardiff', 'CF24 3SG', 'Desktop', 'Hello Ive got an old pc that has lots of virus\' and malware on it. My farther kept using it after surpport for windows xp was removed. I don\'t think it even starts up anymore.\r\n\r\nI have just bought a new pc and would like the photos and files off my old pc put onto a new hard drive. I\'d try it myself but am unable to get it running and don\'t want my new pic infected.\r\n\r\nHow much will it cost me? Can I book it in for tomorrow?\r\n\r\nBlake.', '16', 'June', '09', '30'),
(23, 'Aleksandar Tomov', '07804653624', 'bagajata@abv.bg', '22 Lady Margaret Terrace', 'Splott', 'Cardiff', 'CF24 2AP', 'Laptop', 'The laptop is not booting windows 7 even in safe mode and i need the data recovered.', '13', 'July', '12', '00'),
(24, 'Leo', '07914072484', 'l.guo@me.com', '', 'e.g. Whitchurch', 'Cardiff', '', 'Desktop', 'iMac 2009 fall 21\"\r\nfail to enter the system. black screen with error messages.', '21', 'September', '17', '15'),
(25, 'Mohammad Khan', '01483722239', 'wasimuk@hotmail.co.uk', '151 brookfield', 'wOKING', 'London', 'GU21 3AE', 'Desktop', 'Custom built desktop beeping mother board pin has been bent.', '03', 'September', '06', '00'),
(26, 'test', '02920756099', 'neil@cardifftec.co.uk', '2 Tatham Road', 'e.g. Whitchurch', 'Cardiff', 'CF14 5FB', 'Desktop', 'fdsf', '01', 'April', '01', '00'),
(27, 'John Doe', '123456789', 'john@sample.com', '13th street', 'e.g. Whitchurch', 'Cardiff', '12345', 'Desktop', 'testing form', '01', 'January', '01', '00'),
(28, 'John Doe', '123456789', 'john@sample.com', '13th street', 'e.g. Whitchurch', 'Cardiff', '12345', 'Desktop', 'testing form for val', '01', 'March', '01', '00'),
(29, 'John Doe', '123456789', 'john@sample.com', '13th street', 'e.g. Whitchurch', 'Cardiff', '12345', 'Desktop', 'testing appointment form', '03', 'March', '01', '00'),
(30, 'John Doe', '123456789', 'john@sample.com', '13th street', 'e.g. Whitchurch', 'Cardiff', '12345', 'Desktop', 'testing appointment form by Ishan', '03', 'March', '01', '00'),
(31, 'Alastair Jinks', '07880995624', 'alastairjinks@yahoo.co.uk', '8 Marion Court , Lisvane Road', 'Llanishen', 'Cardiff', 'CF14 0RZ', 'Desktop', 'Tower will not turn on, printer, monitor , broadband etc ar fine', '17', 'March', '18', '00'),
(32, 'Ailsa Bennett', '07561309610', 'missailsabennett@hotmail.co.uk', '143 Moy Road', 'Roath', 'Cardiff', 'CF24 4TG', 'Laptop', 'The power supply socket is loose inside the laptop, meaning it is difficult to get the laptop to charge properly.', '21', 'March', '10', '00'),
(33, 'David Ball', '07904150959', 'dave.ball@stereoboard.com', '55 Rhydhelig Avenue', 'Heath', 'Cardiff', 'CF144DB', 'Laptop', 'Shattered inner screen on Lenovo laptop.', '25', 'March', '09', '30'),
(34, 'Shing ip', '07769319492', 'generalshing@hotmail.co.uk', '', 'Caerphilly', '', 'CF83 1PN', 'Laptop', 'Laptop is overheating and the fans are stopping often. Also got a warning about bios temperature being too high', '26', 'March', '10', '30'),
(35, 'Sophie Wakeham', '07807414422', 'snowfiex3@hotmail.co.uk', '5 Heol Erwin', 'Rhiwbina', 'Cardiff', 'CF14 6QP', 'Laptop', 'Power going throughout motherboard but laptop will not start up. Battery is dead but we checked that power is going through the power adapter and it is. \r\nUnsure of where the issue is coming from.', '29', 'March', '10', '30'),
(36, 'Chris Gorman', '02920763652', 'coggy@btinternet.com', '26 Hampton Crescent West', 'Cyncoed', 'Cardiff', 'CF23 6RB', 'Desktop', 'does not power - up', '29', 'March', '12', '00'),
(37, 'Blaglosov Mihai', '07490261686', 'maddie_madalina@yahoo.com', '', 'e.g. Whitchurch', 'Cardiff', '', 'Desktop', '', '08', 'April', '09', '30'),
(38, 'Margaret LAMPREY', '07941575294', 'mclamprey@gmail.com', '21 Cherrydale Road', 'Ely', 'Cardiff', 'Cf5 4al', 'Desktop', '', '02', 'June', '01', '00'),
(39, 'Neil Paget', '7999056096', 'neil@cardifftec.co.uk', '2 Tatham Road', 'dddd', 'Cardiff', 'CF14 5FB', 'Desktop', 'ddd', '18', 'November', '07', '30'),
(40, 'dssa', '234324324', 'kkk@jjj.com', '5 ggg', 'rfff', 'Cardiff', 'cf145gb', 'Desktop', 'wfd', '19', 'December', '11', '45'),
(41, 'dssa', '21321', 'fff@hhh.com', '3 fffff', 'ddfd', 'ddd', 'cf14 5fb', 'Desktop', 'adsfsadf', '01', 'December', '01', '00'),
(42, 'Keith Watson', '07763723685', 'keithfwatson@yahoo.co.uk', '34 Wyncliffe Gardens', 'Pentwyn', 'Cardiff', 'CF23 7FA', 'Desktop', 'For a while now the PC would sometimes kind of go into standby when unattended but couldn\'t just start up again without pressing the off button to turn it off. Also would sometimes see the dreaded \'Blue screen.\' Now it won\'t log on at all. Not even in \'safe mode.\' Have all our holiday photos on there and not all backed up so very worried the hard drive has gone.', '19', 'October', '17', '30'),
(43, 'Sanda', '', 'Sanda-1142944@hofennik.org.uk', '', 'e.g. Whitchurch', 'Cardiff', '', 'Laptop', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris sed nulla sed odio tempor pretium.', '07', 'May', '13', '00'),
(44, 'Neil Paget', '7999056096', 'neil@cardifftec.co.uk', '2 Tatham Road, Llanishen', 'dddd', 'Cardiff', 'CF14 5FB', 'Laptop', 'test', '19', 'December', '06', '45'),
(45, 'Neil Paget', '7999056096', 'neil@cardifftec.co.uk', '2 Tatham Road, Llanishen', 'e.g. Whitchurch', 'Cardiff', 'CF14 5FB', 'Desktop', 'ccc', '01', 'January', '01', '00'),
(46, 'gemma', '07730517549', 'Gemma.jones@hotmail.com', '257 Ffordd Nowell', 'Colchester avenue', 'Cardiff', 'Cf239fd', 'Laptop', 'Very slow. I think there are a few viruses on it?', '06', 'December', '13', '00'),
(47, 'Chris Harris', '07707663163', 'Chrisharris94@hotmail.com', '107', 'Llanederyn', 'Cardiff', 'Cf23 6Ul', 'Laptop', 'Cracked screen', '09', 'December', '04', '30'),
(48, 'Barnypok', '62516618863', 'jfvynms4281rt@hotmail.com', 'bfAOEwBVVEQlAMDpM', 'New York', 'New York', '3437', 'Laptop', 'uPJLOK http://www.FyLitCl7Pf7ojQdDUOLQOuaxTXbj5iNG.com', '16', 'September', '22', '30'),
(49, 'Sophie Horden', '07587041214', 'sophie.71197@gmail.com', 'Plas Gwyn Residences, Llantrisant Road', 'Llandaff', 'Cardiff', 'CF52XJ', 'Laptop', 'Broken screen', '03', 'March', '12', '00'),
(50, 'Barnypok', '13629561235', 'ecrev22vtv@hotmail.com', 'gSjijtNMoWVeWmch', 'New York', 'New York', '8137', 'Netbook', 'i2uwEm http://www.LnAJ7K8QSpkiStk3sLL0hQP6MO2wQ8gO.com', '05', 'November', '08', '30'),
(51, 'JimmiNu', '13050928995', 'ec12342vtv@hotmail.com', 'fXtjSOuDhbMECKL', 'New York', 'New York', '3263', 'Laptop', 'jKrTI1 http://www.FyLitCl7Pf7ojQdDUOLQOuaxTXbj5iNG.com', '30', 'August', '18', '15'),
(52, 'arachni_name', '1', 'arachni@email.gr', '1', 'e.g. Whitchurch\"\'`--', 'Cardiff', '1', 'Desktop', '1', '01', 'January', '01', '00'),
(53, 'arachni_name', '1', 'arachni@email.gr', '1', 'e.g. Whitchurch', 'Cardiff', '1', 'Desktop\"\'`--', '1', '01', 'January', '01', '00'),
(54, 'arachni_name\"\'`--', '1', 'arachni@email.gr', '1', 'e.g. Whitchurch', 'Cardiff', '1', 'Desktop', '1', '01', 'January', '01', '00'),
(55, 'arachni_name', '1', 'arachni@email.gr\"\'`--', '1', 'e.g. Whitchurch', 'Cardiff', '1', 'Desktop', '1', '01', 'January', '01', '00'),
(56, 'arachni_name', '1', 'arachni@email.gr', '1', 'e.g. Whitchurch', 'Cardiff', '1\"\'`--', 'Desktop', '1', '01', 'January', '01', '00'),
(57, 'arachni_name', '1', 'arachni@email.gr', '1', 'e.g. Whitchurch', 'Cardiff', '1', 'Desktop', '1\"\'`--', '01', 'January', '01', '00'),
(58, 'arachni_name', '1', 'arachni@email.gr', '1', 'e.g. Whitchurch', 'Cardiff', '1', 'Desktop', '1', '01', 'January', '01', '00'),
(59, 'arachni_name', '1', 'arachni@email.gr', '1', 'e.g. Whitchurch', 'Cardiff', '1', 'Desktop', '1', '01', 'January', '01\"\'`--', '00'),
(60, 'arachni_name', '1', 'arachni@email.gr', '1\"\'`--', 'e.g. Whitchurch', 'Cardiff', '1', 'Desktop', '1', '01', 'January', '01', '00'),
(61, 'arachni_name', '1\"\'`--', 'arachni@email.gr', '1', 'e.g. Whitchurch', 'Cardiff', '1', 'Desktop', '1', '01', 'January', '01', '00'),
(62, 'arachni_name', '1', 'arachni@email.gr', '1', 'e.g. Whitchurch', 'Cardiff', '1', 'Desktop', '1', '01', 'January', '01', '00\"\'`--'),
(63, 'arachni_name', '1', 'arachni@email.gr', '1', 'e.g. Whitchurch', 'Cardiff', '1', 'Desktop', '1', '01\"\'`--', 'January', '01', '00'),
(64, 'arachni_name', '1', 'arachni@email.gr', '1', 'e.g. Whitchurch', 'Cardiff', '1', 'Desktop', '1', '01', 'January\"\'`--', '01', '00'),
(65, 'arachni_name', '1', 'arachni@email.gr', '1', 'e.g. Whitchurch', 'Cardiff\"\'`--', '1', 'Desktop', '1', '01', 'January', '01', '00'),
(66, 'arachni_name', '1', 'arachni@email.gr', '1', 'e.g. Whitchurch', 'Cardiff', '1', 'Desktop', '1', '01', 'January', '01', '00'),
(67, 'arachni_name', '1', 'arachni@email.gr', '1', 'e.g. Whitchurch', 'Cardiff', '1', 'Desktop', '1', '01', 'January', '01', '00'),
(68, 'arachni_name)', '1', 'arachni@email.gr', '1', 'e.g. Whitchurch', 'Cardiff', '1', 'Desktop', '1', '01', 'January', '01', '00'),
(69, 'arachni_name', '1', 'arachni@email.gr', '1)', 'e.g. Whitchurch', 'Cardiff', '1', 'Desktop', '1', '01', 'January', '01', '00'),
(70, 'arachni_name', '1)', 'arachni@email.gr', '1', 'e.g. Whitchurch', 'Cardiff', '1', 'Desktop', '1', '01', 'January', '01', '00'),
(71, 'arachni_name', '1', 'arachni@email.gr', '1', 'e.g. Whitchurch', 'Cardiff', '1', 'Desktop)', '1', '01', 'January', '01', '00'),
(72, 'arachni_name', '1', 'arachni@email.gr', '1', 'e.g. Whitchurch', 'Cardiff', '1', 'Desktop', '1', '01', 'January)', '01', '00'),
(73, 'arachni_name', '1', 'arachni@email.gr', '1', 'e.g. Whitchurch', 'Cardiff)', '1', 'Desktop', '1', '01', 'January', '01', '00'),
(74, 'arachni_name', '1', 'arachni@email.gr', '1', 'e.g. Whitchurch', 'Cardiff', '1)', 'Desktop', '1', '01', 'January', '01', '00'),
(75, 'arachni_name', '1', 'arachni@email.gr', '1', 'e.g. Whitchurch', 'Cardiff', '1', 'Desktop', '1', '01)', 'January', '01', '00'),
(76, 'arachni_name', '1', 'arachni@email.gr', '1', 'e.g. Whitchurch', 'Cardiff', '1', 'Desktop', '1', '01', 'January', '01', '00)'),
(77, 'arachni_name', '1', 'arachni@email.gr)', '1', 'e.g. Whitchurch', 'Cardiff', '1', 'Desktop', '1', '01', 'January', '01', '00'),
(78, 'arachni_name', '1', 'arachni@email.gr', '1', 'e.g. Whitchurch)', 'Cardiff', '1', 'Desktop', '1', '01', 'January', '01', '00'),
(79, 'arachni_name', '1', 'arachni@email.gr', '1', 'e.g. Whitchurch', 'Cardiff', '1', 'Desktop', '1)', '01', 'January', '01', '00'),
(80, 'arachni_name', '1', 'arachni@email.gr', '1', 'e.g. Whitchurch', 'Cardiff', '1', 'Desktop', '1', '01', 'January', '01)', '00'),
(81, 'arachni_name', '1', 'arachni@email.gr', '1', '1', '1', '1', 'Desktop', '1', '01', 'January', '01', '00'),
(82, 'arachni_name', '1', 'arachni@email.gr', '1', 'e.g. Whitchurch', 'Cardiff', '1', 'Desktop', '1\"\'`--', '01', 'January', '01', '00'),
(83, 'arachni_name', '1\"\'`--', 'arachni@email.gr', '1', 'e.g. Whitchurch', 'Cardiff', '1', 'Desktop', '1', '01', 'January', '01', '00'),
(84, 'arachni_name', '1', 'arachni@email.gr', '1', 'e.g. Whitchurch', 'Cardiff', '1', 'Desktop\"\'`--', '1', '01', 'January', '01', '00'),
(85, 'arachni_name', '1', 'arachni@email.gr', '1', 'e.g. Whitchurch', 'Cardiff', '1\"\'`--', 'Desktop', '1', '01', 'January', '01', '00'),
(86, 'arachni_name', '1', 'arachni@email.gr', '1', 'e.g. Whitchurch', 'Cardiff', '1', 'Desktop', '1', '01', 'January', '01', '00'),
(87, 'arachni_name', '1', 'arachni@email.gr', '1', 'e.g. Whitchurch\"\'`--', 'Cardiff', '1', 'Desktop', '1', '01', 'January', '01', '00'),
(88, 'arachni_name', '1', 'arachni@email.gr', '1', 'e.g. Whitchurch', 'Cardiff', '1', 'Desktop', '1', '01\"\'`--', 'January', '01', '00'),
(89, 'arachni_name\"\'`--', '1', 'arachni@email.gr', '1', 'e.g. Whitchurch', 'Cardiff', '1', 'Desktop', '1', '01', 'January', '01', '00'),
(90, 'arachni_name', '1', 'arachni@email.gr', '1', 'e.g. Whitchurch', 'Cardiff\"\'`--', '1', 'Desktop', '1', '01', 'January', '01', '00'),
(91, 'arachni_name', '1', 'arachni@email.gr', '1', 'e.g. Whitchurch', 'Cardiff', '1', 'Desktop', '1', '01', 'January\"\'`--', '01', '00'),
(92, 'arachni_name', '1', 'arachni@email.gr', '1\"\'`--', 'e.g. Whitchurch', 'Cardiff', '1', 'Desktop', '1', '01', 'January', '01', '00'),
(93, 'arachni_name', '1', 'arachni@email.gr\"\'`--', '1', 'e.g. Whitchurch', 'Cardiff', '1', 'Desktop', '1', '01', 'January', '01', '00'),
(94, 'arachni_name', '1', 'arachni@email.gr', '1', 'e.g. Whitchurch', 'Cardiff', '1', 'Desktop', '1', '01', 'January', '01', '00\"\'`--'),
(95, 'arachni_name', '1', 'arachni@email.gr', '1', 'e.g. Whitchurch', 'Cardiff', '1', 'Desktop', '1', '01', 'January', '01\"\'`--', '00'),
(96, 'arachni_name', '1', 'arachni@email.gr', '1', 'e.g. Whitchurch', 'Cardiff', '1', 'Desktop', '1', '01', 'January', '01', '00'),
(97, 'arachni_name', '1', 'arachni@email.gr', '1', 'e.g. Whitchurch', 'Cardiff', '1', 'Desktop', '1)', '01', 'January', '01', '00'),
(98, 'arachni_name', '1)', 'arachni@email.gr', '1', 'e.g. Whitchurch', 'Cardiff', '1', 'Desktop', '1', '01', 'January', '01', '00'),
(99, 'arachni_name', '1', 'arachni@email.gr', '1)', 'e.g. Whitchurch', 'Cardiff', '1', 'Desktop', '1', '01', 'January', '01', '00'),
(100, 'arachni_name', '1', 'arachni@email.gr', '1', 'e.g. Whitchurch', 'Cardiff', '1', 'Desktop)', '1', '01', 'January', '01', '00'),
(101, 'arachni_name', '1', 'arachni@email.gr', '1', 'e.g. Whitchurch)', 'Cardiff', '1', 'Desktop', '1', '01', 'January', '01', '00'),
(102, 'arachni_name', '1', 'arachni@email.gr', '1', 'e.g. Whitchurch', 'Cardiff)', '1', 'Desktop', '1', '01', 'January', '01', '00'),
(103, 'arachni_name)', '1', 'arachni@email.gr', '1', 'e.g. Whitchurch', 'Cardiff', '1', 'Desktop', '1', '01', 'January', '01', '00'),
(104, 'arachni_name', '1', 'arachni@email.gr', '1', 'e.g. Whitchurch', 'Cardiff', '1', 'Desktop', '1', '01)', 'January', '01', '00'),
(105, 'arachni_name', '1', 'arachni@email.gr)', '1', 'e.g. Whitchurch', 'Cardiff', '1', 'Desktop', '1', '01', 'January', '01', '00'),
(106, 'arachni_name', '1', 'arachni@email.gr', '1', 'e.g. Whitchurch', 'Cardiff', '1', 'Desktop', '1', '01', 'January', '01', '00)'),
(107, 'arachni_name', '1', 'arachni@email.gr', '1', 'e.g. Whitchurch', 'Cardiff', '1', 'Desktop', '1', '01', 'January)', '01', '00'),
(108, 'arachni_name', '1', 'arachni@email.gr', '1', 'e.g. Whitchurch', 'Cardiff', '1', 'Desktop', '1', '01', 'January', '01', '00'),
(109, 'arachni_name', '1', 'arachni@email.gr', '1', 'e.g. Whitchurch', 'Cardiff', '1', 'Desktop', '1', '01', 'January', '01)', '00'),
(110, 'arachni_name', '1', 'arachni@email.gr', '1', 'e.g. Whitchurch', 'Cardiff', '1)', 'Desktop', '1', '01', 'January', '01', '00'),
(111, 'Simon Cowper', '07810734024', 'simon.cowper@gmail.com', '50 Hind Close', 'Pengam Green', 'Cardiff', 'CF24 2EF', 'Laptop', 'I have been trying to copy files from an external hard drive to my computer, unfortunately something has gone wrong with one or the other!\r\n\r\nSome of the files seem to have disappeared and the laptop is now not recognising the hard drive.\r\n\r\nIf you could help out with this I\'d be extremely grateful!', '08', 'May', '17', '45'),
(112, 'Judix', '54804483844', 'bggfbx@hotmail.com', 'TCvzYniZLzg', 'New York', 'New York', '7386', 'Netbook', '4E5vIl http://www.LnAJ7K8QSpfMO2wQ8gO.com', '05', 'November', '15', '15');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_banner`
--

CREATE TABLE `tbl_banner` (
  `ban_id` tinyint(2) NOT NULL,
  `Banner` varchar(255) NOT NULL,
  `url` text NOT NULL,
  `status` tinyint(2) NOT NULL,
  `created_on` date NOT NULL,
  `modified_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_emailpref`
--

CREATE TABLE `tbl_emailpref` (
  `emailid` int(5) NOT NULL,
  `emailtitle` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `phoneno` varchar(11) NOT NULL,
  `modifiedon` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_emailpref`
--

INSERT INTO `tbl_emailpref` (`emailid`, `emailtitle`, `email`, `phoneno`, `modifiedon`) VALUES
(1, 'Contact Us', 'wewillfixyourpc@gmail.com', '02920766039', '2016-08-06 10:58:42');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_feedback`
--

CREATE TABLE `tbl_feedback` (
  `id` bigint(20) NOT NULL,
  `page` varchar(255) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `status` tinyint(1) DEFAULT '1',
  `created_on` datetime DEFAULT NULL,
  `modified_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_feedback`
--

INSERT INTO `tbl_feedback` (`id`, `page`, `title`, `image`, `status`, `created_on`, `modified_on`) VALUES
(1, 'Home', 'I received a fantastic service. Everything was explained very well and I am extremely pleased with the service I received. I would recommend them any day.  Lisa Green,  Canton.', 'lady2111201117570623112011022212.jpg', 1, '2011-11-27 00:00:00', '2011-11-27 18:29:18'),
(2, 'Who We Help', 'The response to my request to improve my slow computer was first class. I would have no hesitation in recommending this company to others.  George Davies,  Caerphilly.', 't_221112011175719.jpg', 1, '2011-11-27 00:00:00', '2011-11-27 18:29:32'),
(3, 'Why Choose Us', 'After my initial call my computer was picked up and dropped off fixed and working again within 24 hours. The service I received was excellent.  Sandra Thomas,  Lisvane.', 't_321112011175725.jpg', 1, '2011-11-27 00:00:00', '2011-11-27 18:29:43'),
(4, 'Services and Prices', 'It\'s lovely to finally have all the problems with my computers solved so efficiently and well. Thank you, we enjoyed using the service.  Walter Beard,  Whitchurch.', 'walter_beard27112011123012.jpg', 1, '2011-11-27 00:00:00', '2011-11-27 18:30:12'),
(5, 'Contact Us', 'All the problems I had have been sorted out and the advice given to me was all relevant. I would recommend them to anyone who wants a fast and efficient service.  Louise Williams,  Heath.', 't_521112011175745.jpg', 1, '2011-11-27 00:00:00', '2011-11-27 18:30:27'),
(6, 'Appointment ', 'Thanks for your fast and efficient service. My old PC has now been restored to full and correct working order without losing any files. Thanks again.  Nick Jenkins,  Grangetown.', 't_621112011175751.jpg', 1, '2011-11-27 00:00:00', '2011-11-27 18:30:38'),
(7, 'LaptopScreen', 'After breaking my laptop screen I thought my laptop had to be thrown away. These guys fitted a new screen on the same day and it now looks better than ever! Daisy Rees, Llanishen.', 'daisyrees.jpg', 1, '2011-11-27 00:00:00', '2011-11-27 18:30:38');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_home_banner`
--

CREATE TABLE `tbl_home_banner` (
  `bnr_id` int(11) NOT NULL,
  `bnr_title` varchar(255) NOT NULL,
  `bnr_description` varchar(255) NOT NULL,
  `bnr_status` tinyint(1) NOT NULL DEFAULT '1',
  `bnr_img` varchar(500) NOT NULL,
  `bnr_publish_on` date NOT NULL,
  `bnr_created_on` date NOT NULL,
  `bnr_modified_on` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  `bnr_archive` tinyint(2) NOT NULL DEFAULT '0',
  `bnr_link` varchar(400) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_home_banner`
--

INSERT INTO `tbl_home_banner` (`bnr_id`, `bnr_title`, `bnr_description`, `bnr_status`, `bnr_img`, `bnr_publish_on`, `bnr_created_on`, `bnr_modified_on`, `bnr_archive`, `bnr_link`) VALUES
(93, 'Home', '', 1, 'slide11942014110228.gif', '0000-00-00', '0000-00-00', '0000-00-00 00:00:00', 0, ''),
(92, 'Slow PC', '', 1, 'slide21942014110217.gif', '0000-00-00', '0000-00-00', '0000-00-00 00:00:00', 0, ''),
(91, 'Laptop DC Jack', '', 1, 'slide31942014110203.gif', '0000-00-00', '0000-00-00', '2014-04-19 17:06:09', 0, 'http://www.wewillfixyourpc.co.uk/Laptop_Power_Connector_DC_Jack.php'),
(90, 'Laptop Screen', '', 1, 'slide41942014110151.gif', '0000-00-00', '0000-00-00', '2014-04-19 17:06:31', 0, 'http://www.wewillfixyourpc.co.uk/laptop_screen_replacement_cardiff.php'),
(89, 'Laptop Overheating', '', 1, 'slide51942014110127.gif', '0000-00-00', '0000-00-00', '2014-04-19 17:06:54', 0, 'http://www.wewillfixyourpc.co.uk/Laptop_Overheating.php'),
(88, 'Wireless', '', 1, 'slide61942014110111.gif', '0000-00-00', '0000-00-00', '2014-04-19 17:07:21', 0, 'http://www.wewillfixyourpc.co.uk/Wireless_Networking.php'),
(86, 'Testimonial', '', 1, 'slide81942014110036.gif', '0000-00-00', '0000-00-00', '0000-00-00 00:00:00', 0, ''),
(87, 'iPhone and iPad repair', '', 1, 'slide71942014110056.gif', '0000-00-00', '0000-00-00', '2014-04-19 17:04:37', 0, 'http://www.wewillfixyouripad.co.uk');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_laptop_appointments`
--

CREATE TABLE `tbl_laptop_appointments` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `email` varchar(255) NOT NULL,
  `laptop_maker` varchar(100) NOT NULL,
  `laptop_model` varchar(100) NOT NULL,
  `problem_desc` varchar(1000) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_laptop_appointments`
--

INSERT INTO `tbl_laptop_appointments` (`id`, `name`, `phone`, `email`, `laptop_maker`, `laptop_model`, `problem_desc`) VALUES
(304, 'dalimore', '01633 613408', 'rdallimore@sky.com', 'Acer aspire 7551', 'Acer aspire 7551', NULL),
(303, 'Christopher Jones', '07402132701', 'Cmjones2310@hotmail. co.uk', 'Samsung Galaxy 10\" tablet', 'Samsung Galaxy 10\" tablet', NULL),
(302, 'Saffron', '07766106337', 'Saffronhuckle@fsmail.net', 'Acer iconia A1', 'Acer iconia A1', NULL),
(301, 'mmmm', 'mmm', 'mm', 'mmm', 'mmm', NULL),
(300, 'tyry', 'rtyy', 'ryyt', 'tyyt', 'tyyt', NULL),
(299, 'vfc', 'vcxb', 'cvx', 'vxcb', 'vxcb', NULL),
(298, 'neil', '07999 056096', 'neiul@cardifftec.co.ik', 'sdgdfg', 'sdgdfg', NULL),
(297, 'Danielle', '07876214145', 'Danielle.haggett@gmail.com', 'Toshiba c50d-a-13v', 'Toshiba c50d-a-13v', NULL),
(37, 'Phil Hardwick', '07928628736', 'philhardwick81@gmail.com', 'HP', '8460p', 'Looks like one of my kids has sat on my laptop and shattered the LCD display. Looking around for quotes. Please email me the details.'),
(38, 'Shakeel Murtaza', '07581263834', 'shakeelmurtaza@hotmail.co.uk', 'Toshiba', 'Satellite l850-1d5', 'My screen is smashed and I can only see colours like pink and white'),
(39, 'Shakeel Murtaza', '07581263834', 'shakeelmurtaza@hotmail.co.uk', 'Toshiba', 'Satellite l850-1D5', 'My screen is smashed but no glass has come out.'),
(40, 'Shakeel Murtaza', '07581263834', 'shakeelmurtaza@hotmail.co.uk', 'Toshiba', 'Satellite l850-1d5', 'My screen is smashed and I can only see colours like pink and white'),
(41, 'david osmond', '07825681894', 'davidosmond@hotmail.co.uk', 'Toshiba EQUIUM A100-338', 'PSAAQE-006008AV', 'A small crack started at the top of the screen which spread down near the bottom side. Please could you quote for a replacement screen plus fitting.'),
(42, 'Steve', '07896651087', 'steveb10@hotmail.co.uk', 'Acer', '5742Z', ''),
(43, 'Allan', '07920729218', 'allansullivan@live.co.uk', 'HP', 'Pavillion dm4', 'Impacted with floor on left hand side resulting in broken left hinge and the screen bezel has detached slightly from the screen - no actual damage to screen itself.'),
(44, 'MICHELLE TALBOT', '07896570036', 'michelle-talbot@hotmail.co.uk', 'toshhiba', 'SATELLITE C66028T', 'HELP JUST LOGGED BACK IN A BIG PURPLE BLOB WITH A LINE RUNNING DOWN EACH SIDE UNDER A YEAR OLD ?/'),
(45, 'david ayrey', '07530941192', 'davidpinkyayrey@gmail.com', 'sony', 'vaio svezs2', 'the screen is broke on the inside'),
(46, 'lowri', '07580019157', 'lowri.kingston@hotmail.co.uk', 'toshiba', 'satellite C660-2KE', 'half the screen is white the bottom half in unresponsive at times, and there s a black crack in the bottom right hand corner'),
(47, 'Sue Martyn', '07961730574', 's.martyn@hotmail.co.uk', 'H P', 'G56-106SA', 'I am looking for someone to come to Barry, Vale of Glamorgan to replace the screen on the laptop as it has cracked. Thank you Sue Martyn'),
(48, 'hannah poulsom', '07776332209', 'hannahpoulsom@hotmail.co.uk', 'HP', 'Pavilion dv6', 'cracked screen'),
(49, 'George', '07969817534', 'georgemryan1@yahoo.com', 'acer', '7735', ''),
(50, 'Tom morris', '07930845515', 'tomos_morris@hotmail.co.uk', 'hp', 'g70', 'cracked screen (like a lightning fork) and colours are fragmenting and running vertically on screen.'),
(51, 'Maz', '07587023777', 'Mazzruss@hotmail.com', 'Samsung', 'NP-RV510-A0FUK', 'MY FRIENDS SON HAS BROKEN HIS SCREEN IT IS A 15INCH AS FAR AS i KNOW. iT WAS BOUGHT 2011'),
(52, 'Keith Watson', '07876757656', 'Keith@newportsw.co.uk', 'compaq', 'compaq presario CQ61', 'LCD Screen. I bought one from Internet but it is the LED type and don\\\'t fit.'),
(53, 'jodie saunders', '07854820028', 'jojosaunders25@hotmail.com', 'HP', 'pavillion tx2500', 'need to replace this touch screen as it has been dropped and has smashed'),
(54, 'Adrian', '07758004098', 'louie191@msn.com', 'Advent', '4211-c', 'Screen replacement please how much'),
(55, 'Adrian', '07758004098', 'louie191@msn.com', 'Advent', 'n270', 'replacement screen please how much????'),
(56, 'Catherine Powell', '07788249454', 'c_a_t101@hotmail.com', 'Toshiba', 'Satellite  C660-1 J2', 'There is a black circle at the top of the screen and a line from it all the way down to the bottom with purple bleeding from the line.'),
(57, 'Bethan Roberts', '07805729515', 'bethanrroberts@hotmail.com', 'Acer', '5733Z-P614G64Mikk', 'My internal screen has shattered , so I require full replacement. I\\\'m in dispute with Acer at the moment over the repair so I\\\'m looking for quotes just in case they do not repair under warranty.\r\n\r\nThanks'),
(58, 'adam tudor', '07837941081', 'adamtudor1@hotmail.co.uk', 'packard bell', 'easy note ts', 'Screen has a crack in it'),
(59, 'Anwar kulane', '07961708562', 'Anwar.kulane@gmail.com', 'Acer.         - anwar.kulane@gmail.com.  Contact me with this', 'Aspire 5742.    -- I\\\'ve lost my mobile phone so could you contact me on my email.', 'Laptop got dropped on a hard surface whilst still on. Screen got damaged so I had the screen replaced. The laptop turns on now and turns itself off automatically then back on by itself straight after. When it doesn\\\'t do that, it boots up but takes forever and then goes into a screen where it says, it detects some hdd problem and scans forever the. Eventually says problem couldn\\\'t be resolved. Any idea on what the problem could be, because I don\\\'t want to shell out more money to replace the hdd and then find out it still isn\\\'t working'),
(60, 'hannah poulsom', '07776332209', 'hannahpoulsom@hotmail.co.uk', 'HP', 'pavilion dv6', 'screen is cracked and some ink has run along this. There are also vertical white lines running down the screen'),
(61, 'Ceri Whent', '01495790075', 'julie.whent@talktalk.net', 'Acer', 'A5  Aspire  v5-571-32364g32', 'new screen'),
(62, 'Nicola Spiteri', '07896951821', 'Nicola@nspiteri.wanadoo.co.uk', 'Presario', 'F500', 'I was just wondering how much you charge to replace a screen. Mine is ok at the mo but keeps going funny now and again but you tap it and its ok. Guess it could be a bigger problem later down the line.  Weighing up the cost between a fix (as and when necessary which may not be yet) or buying a new one? Look forward to your quote by email.'),
(63, 'Martyn Winters', '01656667133', 'm.winters@ictsus.co.uk', 'Panasonic', 'Toughbook CF-18', 'The screen is cracked.'),
(64, 'LEN MAPLEY', '02920650857', 'len.mapo@ntlworld.com', 'TOSHIBA', 'L350-262', 'NEW SCREEN REQUIRED'),
(65, 'Miles', '07930962429', 'milesdimmick@me.com', 'Acer', 'Aspire 5552 (PEW76)', 'Hi there my daughters laptop screen has developed a crack in it and pixel loss has spread across the screen, can you please email me the cost of  a screen replacement the laptop itself fires up fine but cannot view what\\\'s on it. We would bring the laptop to yourselves for repair while we wait.\r\nCheers,\r\nMiles.'),
(66, 'alan hall', '07957302150', 'alanhall50@googlemail.com', 'acer', 'aspire', 'screen is craked with black blobs'),
(67, 'Max', '07791940646', 'maxkarczmar@yahoo.co.uk', 'toshiba', 'Satellite L300 1G5', 'cracked screen - need to be replaced'),
(68, 'Wilhelmena Soboljew', '07868016009', 'mena1507@hotmail.co.uk', 'Samsung', 'N135', 'Can make out items on the screen but its all distorted red/black dark colours, its definately not the resolution settings and battery seems to be fine.'),
(69, 'francis kandeh', '02920585645', 'fkandeh@hotmail.com', 'toshiba', 'c6660', ''),
(70, 'Roger Jones', '00000101001991', 'rogant101@yahoo.co.uk', 'SONY', 'PCG-71311M', '30 pin connector  LCD backlight'),
(71, 'stephen fitzgerald', '02920251586', 'stevefitz105@hotmail.com', 'compaq presario v6000', 'presario v6000', 'Broken screen'),
(72, 'colin thompson', '01446741215', 'colin.thompson14@yahoo.com', 'samsung', 'np n130', 'price for new screen please'),
(73, 'Susan Bull', '07772268224', 'suejbull@aol.com', 'Dell', 'Inspiron 1545', 'I dropped my laptop and there is a white line down the middle of the screen.  Please can you provide me a quote for a replacement screen.'),
(74, 'hira gurung', '07869522922', 'diamond14_uk@hotmail.com', 'acer', 'aspire 2930', 'need a replacement screen'),
(75, 'Margaret Harding', '07772611226', 'maggimay75@hotmail.co.uk', 'toshiba', 'satellite a300-2iHsysem unit', 'broken the screen model number PSAG8E-05J00TEN'),
(76, 'trudy', '07972803456', 'trudywilletts@yahoo.co.uk', 'sony', 'vaio vpcee3e0e', 'cracked screen'),
(77, 'Tom skone', '07593618284', 'Skoney_12@hotmail.com', 'Sony vaio', 'VPCEL2S1E/W', ''),
(78, 'iwan', '02920844173', 'igjones.55@gmail.com', 'hp', 'pavillion g6', ''),
(79, 'Caroline Brady', '07506457954', 'Brady.caroline@sky.com', 'Dell', 'N5030', 'Can you quote for supply and replacement screen for this laptop\r\nThanks\r\nPlease can you reply via email as I can\\\'t answer my phone in work\r\n\r\nThank you !!'),
(80, 'phillpa burrnet', '447518996834', 'yoshiwarwick87@gmail.com', 'toshiba', 'pspc8e-01fo1yen', 'my laptop screen was damaged every so often it would go off then on again my son accidently broke it when he got mad i need it repaired because i have to use his laptop'),
(81, 'Ramesh', '07805845367', 'Rameshmandanapu@gmail.com', 'Hp', 'Dv4-2170us', 'Screen broken need to tighten the keyboard and other parts .please give me a quote. \r\nI think screen model is LP141wx3 (TL)(N2)\r\nThat\\\'s 14\\\" screen. please let me know if you can fix and the price .\r\nThanks \r\nRamesh'),
(82, 'Y Price', '07790317030', 'woody0025_2@hotmail.com', 'Acer aspire one happy2', 'SNID 12401038825', 'would like a quote for screen replacement part no: LK.1010D.004'),
(83, 'Katie', '07773151460', 'katie-anne90@hotmail.co.uk', 'Gemini', '8\\\' Joytab tablet', 'Screen smashed needs replacing'),
(84, 'Katie', '07773151460', 'katie-anne90@hotmail.co.uk', 'Gemini', '8\\\' Joytab tablet', 'Screen smashed needs replacing'),
(85, 'donna mcclelland', '07854739997', 'xxdonnaxxmcclelland@hotmail.co.uk', 'advent', 'm100', ''),
(86, 'Priscilla Souter', '01446750438', 'priscillasouter520@hotmail.com', 'Advent', 'K4000', 'Screen is cracked and shattered.  Please advise cost of replacement'),
(87, 'amy wilks', '00000000000000000000', 'wilks474@hotmail.com', 'hp', 'cq61-220sa', 'replacement screen needed'),
(88, 'david brough', '02920453537', 'david-brough@sky.com', 'msi', 'u135', ''),
(89, 'Carl', '07919696466', 'Rummage1@aol.com', 'ASUS', 'X52f', ''),
(90, 't hart', '01446400081', 'terry.hart@tiscali.co.uk', 'dell', 'netbook', 'screen fading'),
(91, 't hart', '01446400081', 'terry.hart@tiscali.co.uk', 'dell', 'd630', ''),
(92, 'mick brown', '07989073138', 'byrdhouse59@hotmail.com', 'toshiba', 'equium', 'i have fitted a new screen today, put power through it but the screen will not come on?\r\n\r\nCan you help fix it and how soon?'),
(93, 'mrs a m tarr', '02920551092', 'amtar@talktalk.net', 'samsung notebook np-nc110', 'notebook np=nc110', 'cracked screen needs replacing'),
(94, 'anneka pritchard', '07702053516', 'am_198419@hotmail.com', 'packaed bell', 'easy note', 'Only needs screen fixing'),
(95, 'mr hughes', '01443433246', 'richardhughes68@talktalk.net', 'hp pavillion', 'g6-1163ea', 'screen cracked down one side'),
(96, 'glyn morgan', '01495305151', 'glyn511@hotmail.co.uk', 'toshiba', 'satellite c660   26z', 'screen broken'),
(97, 'Ben Evans', '07972763455', 'benevs88@gmail.com', 'Acer', '4710', 'Screen has cracked and is just a white cracked picture when turned on, will need replacing'),
(98, 'Huw Williams', '07900197625', 'huw.williams5@ntlworld.com', 'ASUS', 'A52F', ''),
(99, 'Mel Taylor', '07543042888', 'melly-mad@hotmail.co.uk', 'Android tablet PC', '?', 'My son has smashed the screen in his tablet, there are no makers details other than androidtabletpc. i bought it on Amazon. can the screen be replaced and for how much?'),
(100, 'Tomos Grove', '02920747364', 'anima800@yahoo.co.uk', 'Toshiba', 'PSLB8E - 160007EN', 'Top plastic hinge loose (concerned whether inbuilt web cam will still function) Screen dented.'),
(101, 'Ryan Roberts', '01633810047', 'k2ryan@hotmail.co.uk', 'Dell inspiron', 'N7010', 'The laptop was on the floor and I didn\\\'t see it there and i stood on it. The screen size is 17\\\''),
(102, 'justin davies', '07538552869', 'justindav69@msn.com', 'samsung', 'nc10', 'requires replacement screen'),
(103, 'william mclean-smith', '07787405531', 'yajack96@gmail.com', 'toshiba', 'satellite C670', 'purple stuff behind screen'),
(104, 'Mark', '07780708942', 'Markrwade@hotmail.com', 'Acer', 'Aspire 5733', 'Screen seems to cracked so only 50% screen visible.'),
(105, 'Leigh', '07737943278', 'leighmurphyuk@yahoo.com', 'toshiba', 'not sure', 'airline have busted my laptop screen can u fix\r\ncheers Leigh'),
(106, 'rhian pearce', '07977019586', 'rej78@hotmail.com', 'toshiba', 'satellite l850-1ek', 'i droppped the laptop and broke the screen and need it repaired'),
(107, 'Matthew Sellwood', '07788990667', 'shelfyboy@hotmail.co.uk', 'Acer', 'aspire one', 'complete screen replacement'),
(108, 'GARETH JONES', '01443838636', 'garethjones56@gmail.com', 'sony', 'VPCYB3V1E', 'HELLO NEEDS A NEW SCREEN .\r\n          REGARDS GARETH.'),
(109, 'Jodie Cadwallader', '07855056296', 'Jodiecad_1995@hotmail.co.uk', 'Compaq', 'Presario CQ56', 'Crack at the top of the screen.'),
(110, 'Louise Holmes', '07813335771', 'Lchvmc@yahoo.co.uk', 'Dell', 'Inspiron 15 r', 'Hello\r\n\r\nI dropped my laptop and the screen cracked inside. I\\\'ve seen that you can buy screens on the internet but I\\\'m not sure whether this is more cost effective or reliable. I can\\\'t afford to spend too much money!\r\n\r\nI\\\'d really appreciate a quote. \r\n\r\nThank you!\r\n\r\nLou'),
(111, 'annette tarr', '07403597153', 'amtarr@talktalk.net', 'samsung notebook np-nc110', 'notebook np-nc110', ''),
(112, 'ashley garrett', '07713278434', 'ashley.garrett@ntlworld.com', 'toshiba equium 200', 'p200d', 'Battery is not charging ,new battery and power lead .'),
(113, 'Dominic Harding', '07817753170', 'dominicharding@yahoo.co.uk', 'Samsung', 'Np350v5c', 'Matte screen'),
(114, 'Ryan Long', '01633412741', 'ianhlong@hotmail.com', 'Samsung', 's3511', ''),
(115, 'Luke Weldon', '07889192644', 'surfpapasmurf@gmail.com', 'Dell', 'Inspiron N5110', 'Back-light on screen has stopped working, (screen faintly visible when light is shone on the screen). When using another monitor I have run tests and it said there is a critical hard drive fail. Not sure if the back-light has been disabled due to software corruption from the damaged hard drive, or whether something else is going on. Broke suddenly for no reason, was looked after well, just over a year old (by a few weeks so couldn\\\'t use warranty).'),
(116, 'Gethin Roberts', '07714752670', 'gethinbobs@hotmail.com', 'Apple Macbook Pro', 'A1226', 'Screen has badly cracked and needs replacing! could you give a quote? Also, would it be possible for you to contact me via e-mail? i\\\'m filming most of the day and night, and my phone will be on silent!! Many thanks, Gethin'),
(117, 'kathryn manley', '07565513493', 'karianwen@hotmail.co.uk', 'emachine em310', 'emachine em310', 'iv been given this netbook, but the screen is badly cracked, and im going to need it for collage, but really need to know how much you would charge, please could you email me back thank you'),
(118, 'mark', '07908466695', 'marklilly2009@hotmail.co.uk', 'asus', 'x5dc', 'laptop screen badly cracked when turn laptop cant see anything'),
(119, 'Jake Portch', '07825685449', 'jakeportch@hotmail.co.uk', 'acer', 'aspire 5755g', 'I am able to fit myself, just checking if you have a replacement screen available? and price?'),
(120, 'Gethin Roberts', '07714752670', 'gethinbobs@hotmail.com', 'Macbook Pro', 'A1226', 'Cracked screen needs replacimg!'),
(121, 'Graham Harwood', '0123456789', 'wallport@sky.com', 'acer', 'aspire 5551-A', 'Screen broken'),
(122, 'Dennis Donovan', '07702602784', 'donovandjp@aol.com', 'HP zd 8000', 'Pavillion', 'I need a new screen 365mm X 230 widescreen for my HP Pavillion zd 8000. the screen has horrizontal lines all over the screen.'),
(123, 'Dennis Donovan', '07702602784', 'donovandjp@aol.com', 'HP Pavillion', 'zd 8000', 'Screen has gone? horizontal lines'),
(124, 'Edward Stubbs', '07531485401', 'edwardstubbs2002@yahoo.co.uk', 'Acer', 'Aspire 5332', ''),
(125, 'Edward Stubbs', '07531485401', 'edwardstubbs2002@yahoo.co.uk', 'Acer', 'Aspire 5332', ''),
(126, 'Shane spencer', '07812385747', 'Shanespencer32@googlemail.com', 'Advent', 'N270  1024mb 160gb', 'Hello I would like a price for a replacement screen for my daughters laptop.'),
(127, 'Glenn Aldred', '07983623567', 'glennaldred0@hotmail.com', 'Samsung', 'Notebook R530', ''),
(128, 'Natalie Harmsworth', '07902907455', 'nat_harmsworth@hotmail.co.uk', 'Dell', 'Inspiron 1545', 'Hi \r\njust wondering how much it would cost to get my screen fixed.'),
(129, 'andy', '01291422245', 'andykaffa@aol.com', 'samsung', 'np-n150', ''),
(130, 'Julian Stevens', '01443441124', 'jstevens360@sky.com', 'lenovo', 'G550', 'kids stood on laptop and cracked lcd screen.  Testing using desktop monitor and everything else appears to work.  Mobile 07780880003'),
(131, 'Louise Young', '07779262743', 'lcwhite78@aol.com', 'Sony Vaio', 'PCG-71312M', 'Think screen was stood on as right of screen black when switched on and faded out and flickering with a reddish line through.  Can I a quote ASAP please?? \r\n\r\nThank you'),
(132, 'Kevin Hurley', '00353061589302', 'kevinhurley92@hotmail.com', 'Toshiba', 'Satellite L750-1DX', ''),
(133, 'lee tillott', '07785468602', 'leetillott@hotmail.co.uk', 'acer', 'aspire 5332', 'the screen has stopped working, it is very dark but you can just about see the cursor moving.'),
(134, 'andrew', '07944032034', 'mellisandy7@gmail.com', 'asus transformer tf300', 'transformer tf300', 'i have a asus touch pad and i have dropped the screen, it has a crack gpoing through the screen and now the touch pad does not repond to touch will you be able to help with a new touch screen?\r\nif you need any more details about the pad please feel free to ring me'),
(135, 'peter james', '07807827767', 'peterjamesccfc@hotmail.com', 'hp', 'compaq presrio c60', ''),
(136, 'Rhian Forde', '07581309571', 'rhian50@live.co.uk', 'HP', 'G56-108SA', ''),
(137, 'fff', '111', 'neil@cardifftec.co.uk', 'fff', 'fff', 'ff'),
(138, 'hghghg', '465', 'neil@neil.cardifftec.co.uk', 'ghhghg', 'hghgh', 'ghhg'),
(139, 'fgfgsd', '435454', 'neil@neil.cardifftec.co.uk', 'dsfsf', 'dsfdfs', 'fdsfds'),
(140, 'fff', '111', 'neil@cardifftec.co.uk', 'fff', 'fff', 'ff'),
(141, 'sara', '07453572775', 's.a.badri@gmail.com', 'apple', 'macbook air', 'replacement screen (cracked)'),
(142, 'Simon', '02920874115', 'brookssp@cardiff.ac.uk', 'Toshiba', 'NB520 10NP', 'notebook dropped and screen knacked.'),
(143, 'Erin Harris', '07403846250', 'Erinharrisx@hotmail.co.uk', 'Toshiba', 'satellite c660-195', 'Screen has multiply hairline cracks with black spots around certain parts of monitor'),
(144, 'Steve', '07958997642', 'Steven.moxey@eel.co.uk', 'Acer', 'Aspire 5735Z', 'The screen needs replacing, I am happy to bring it to you and wait. Screen model number is B156XW01'),
(145, 'Steve', '07958997642', 'Steven.moxey@eel.co.uk', 'Acer', 'Aspire 5735Z', 'The screen needs replacing, I am happy to bring it to you and wait. Screen model number is B156XW01'),
(146, 'paige alcock', '07577678667', 'p.s.alcock@hotmail.co.uk', 'sony vaio', 'SV151D11M', 'i dropped the laptop and the screen completly shattered'),
(147, 'David Griffiths', '07866632945', 'griffithsdfr@gmail.com', 'Apple', '15\\\" macbook pro serial W88280MWYK0.  not unibody, but LED screen', 'hard object dropped on it now only part working  lots of colourful stripes on the rest'),
(148, 'cei ellaway', '07743447200', 'shitzu96@ovi.com', 'dell', 'Inspiron 1564', ''),
(149, 'mr phillip griffiths', '07928443252', 'phill4elaine@hotmail.com', 'Toshiba', 'satellite', 'Broken screen'),
(150, 'mr phillip griffiths', '07928443252', 'phill4elaine@hotmail.com', 'Toshiba', 'satellite', 'Broken screen'),
(151, '', '', 'sonnetdp@gmail.com', '', '', ''),
(152, '', '', 'sonnetdp@gmail.com', '', '', ''),
(153, '', '', 'neil@cardifftec.co.uk', '', '', ''),
(154, 'Luke Morgan', '07932481087', 'designfreak@live.co.uk', 'HP Compaq', 'CQ58-241SA', 'Hi I have a HP compaqCQ58-241SA, I Have broken the screen and i am looking for a replacement, im not very good at understanding computer parts, I need a HD Brightview LED Backlit screen with 1366x768 resolution that is 15.6\\\" in size. Video interface of my model is HDMI / VGA i was wondering if your screen will be compatable with my laptop. If your product is the right type i will then purchase it. many thanks \r\n\r\nLuke Morgan\r\n\r\n\r\n- designfreakluke'),
(155, 'Jamie', '07544093749', 'jamiewiseguy@hotmail.co.uk', 'samsung', 'np305v5a', ''),
(162, 'test', 'test', 'test', 'test', 'test', 'test'),
(163, 'asfasf', '2131234123', 'neil@cardifftec.co.uk', 'asfsa', 'asf', 'asfsf'),
(164, 'asgdfg', 'asdgaesg', 'asgsadfg', 'sfdgsdfg', 'asgsdfg', 'asged'),
(168, 'joanne', '02921400706', 'lovethesunnah@hotmail.co.uk', 'toshiba', 'satelite c850', 'smashed screen'),
(166, 'sdf', 'sdf', 'dsf', 'sdf', 'sdf', 'sdf'),
(169, '', '', 'sonnet@ossjb.com', '', '', ''),
(170, '', '', '', '', '', ''),
(171, '', '', '', '', '', ''),
(172, '', '', '', '', '', ''),
(173, '', '', '', '', '', ''),
(174, '', '', '', '', '', ''),
(175, '', '', 'sonnet@ossjb.com', '', '', ''),
(176, '', '', 'sonnet@ossjb.com', '', '', ''),
(177, '', '', '', '', '', ''),
(178, '', '', '', '', '', ''),
(179, '', '', '', '', '', ''),
(180, '', '', 'sonnet@ossjb.com', '', '', ''),
(181, '', '', 'noemail@nomail.com', '', '', ''),
(182, '', '', '', '', '', ''),
(183, 'neil', 'tester', 'test', 'TOSHIBA', 'C660', 'broken screen'),
(201, 'www', '123', 'sonnet@ossjb.com', 'wer', 'wer', NULL),
(187, '', '', 'ggg', '', '', ''),
(202, 'www', '123', 'sonnet@ossjb.com', 'wer', 'wer', NULL),
(191, '', '', 'asd', '', '', ''),
(194, '', '', 'ddd', '', '', ''),
(203, 'Kazi', '+8801711934691', 'sonnet@ossjb.com', 'Toshiba -', 'Toshiba -', NULL),
(196, '', '', 'vbbb', '', '', ''),
(198, 'Erika', '07908639435', 'erikaweber58@googlemail.com', 'Lenovo', 'Ideapad Z560', 'just wondering how much a new screen would be if fitted by you guys, thanks'),
(199, 'Jack Bradbury', '07525028294', 'jack@bradders.eclipse.co.uk', 'Compaq', 'Precarious CQ62', 'Dropped the plug on my screen and one side is now broken. Would appreciate a quote. If you could ring that would be ideal. Thanks'),
(200, 'Neil paget', '07999056096', 'Neil@fix.pc', '', '', ''),
(204, 'Kazi', '+8801711934691', 'sonnet@ossjb.com', 'Toshiba - sat', 'Toshiba - sat', NULL),
(205, 'Neil', '056657', 'Ngggg', 'Ghhh', 'Ghhh', NULL),
(206, '', '', '', '', '', NULL),
(207, '', '', '', '', '', NULL),
(208, '', '', '', '', '', NULL),
(209, '', '', '', '', '', NULL),
(210, 'Raza', '123456', 'razaali75@hotmail.com', 'abc-122', 'abc-122', NULL),
(211, 'Raza', '123456', 'razaali75@hotmail.com', 'abc-122', 'abc-122', NULL),
(212, 'Raza', '123456', 'razaali75@hotmail.com', 'abc-122', 'abc-122', NULL),
(213, 'Raza', '123456', 'razaali75@hotmail.com', 'abc-122', 'abc-122', NULL),
(214, 'Raza Ali', '+923214041421', 'razaali75@hotmail.com', 'Dell Inspiron 3521', 'Dell Inspiron 3521', NULL),
(215, 'Raza Ali', '+923214041421', 'razaali75@hotmail.com', 'Dell Inspiron 3521', 'Dell Inspiron 3521', NULL),
(216, 'Raza Ali', '123456', 'razaali75@hotmail.com', 'Dell Inspiron 3521', 'Dell Inspiron 3521', NULL),
(217, 'Raza Ali', '123456', 'razaali75@hotmail.com', 'Dell Inspiron 3521', 'Dell Inspiron 3521', NULL),
(218, 'Imran', '654654645', 'razaali75@hotmail.com', '321321', '321321', NULL),
(219, 'Imran', '654654645', 'razaali75@hotmail.com', 'Dell Inspiron 3521', 'Dell Inspiron 3521', NULL),
(220, 'Imran', '654654645', 'razaali75@hotmail.com', 'Dell Inspiron 3521', 'Dell Inspiron 3521', NULL),
(221, 'Imran', '654654645', 'razaali75@hotmail.com', 'Dell Inspiron 3521', 'Dell Inspiron 3521', NULL),
(222, 'neil', '02920 758299', 'neil@cardifftec.co.uk', 'toshiba c660', 'toshiba c660', NULL),
(223, '', '', '', '', '', NULL),
(224, 'tester', '2315423235', 'xzfz@zgfsad.co.uk', 'xzfzxc', 'xzfzxc', NULL),
(225, '', '', '', '', '', NULL),
(226, 'vc', 'cvn', 'cvn', 'cvn', 'cvn', NULL),
(227, 'big ears', '12349213-490213', 'sdfgfds@dfgdf.co.uk', 'assaf', 'assaf', NULL),
(228, 'sdgfsdfgsdg', '', '', '', '', NULL),
(229, '', 'asgasg', '', '', '', NULL),
(230, '', '', 'asdgasg', '', '', NULL),
(231, '', '', '', 'asgasdgadg', 'asgasdgadg', NULL),
(232, '', '', 'blah@blah.co.uk', '', '', NULL),
(233, '', '', 'blah@blah.com', '', '', NULL),
(234, '', '', 'blah@blah.com', '', '', NULL),
(235, '', '', 'neil@neil.net', '', '', NULL),
(236, '', '', 'neil@neil.com', '', '', NULL),
(237, '', '', 'neil@neil.co.uk', '', '', NULL),
(238, '', '', 'neil@neil.net', '', '', NULL),
(239, 'dfg', 'dfg', 'neil@neil.co.uk', 'sdaf', 'sdaf', NULL),
(240, 'neil', '0198873484', 'neil@cardifftecnn.co.uk', 'packard bell ms2345', 'packard bell ms2345', NULL),
(241, 'tester', '123456789', 'tester@tester.co.uk', 'packard bell 23456', 'packard bell 23456', NULL),
(242, '', '', 'tester@neil.co.uk', '', '', NULL),
(243, 'zcv\\zcv', '\\zvz', 'blah@blah.net', '', '', NULL),
(244, '', '', 'blah@blah.co.uk', '', '', NULL),
(245, '', '', 'blah@blah.co.uk', '', '', NULL),
(246, '', '', 'blah@blah.co.uk', '', '', NULL),
(247, '', '', 'blah@blah.co.uk', '', '', NULL),
(248, '', '', 'blah@blah.co.uk', '', '', NULL),
(249, 'Raza Ali', '03213214041421', 'razaali75@hotmail.com', 'Dell Inspiron 3521', 'Dell Inspiron 3521', NULL),
(250, 'Raza Ali', '03213214041421', 'razaali75@hotmail.com', 'Dell Inspiron 3521', 'Dell Inspiron 3521', NULL),
(251, 'Raza Ali', '03213214041421', 'razaali75@hotmail.com', 'Dell Inspiron 3521', 'Dell Inspiron 3521', NULL),
(252, 'Raza Ali', '03213214041421', 'razaali75@hotmail.com', 'Dell Inspiron 3521', 'Dell Inspiron 3521', NULL),
(253, 'Test', '(555444', 'Neil@hfhggj.net', 'Fgggg', 'Fgggg', NULL),
(254, 'Test', '(555444', 'Neil@hfhggj.net', 'Fgggg', 'Fgggg', NULL),
(255, '', '', '', '', '', NULL),
(256, 'Tttt', '', '', '', '', NULL),
(257, 'Tttt', '(555555', '', '', '', NULL),
(258, 'Tttt', '(555555', '', 'Fffffff', 'Fffffff', NULL),
(259, 'Tttt', '(555555', 'Fmvnmbmv', 'Fffffff', 'Fffffff', NULL),
(260, 'Tttt', '(555555', 'Neil@blah.co.uk', 'Fffffff', 'Fffffff', NULL),
(261, 'Tttt', '(555555', 'Manjitbansal@hotmail.com', 'Fffffff', 'Fffffff', NULL),
(262, '', '', 'johnloisz@yahoo.co.uk', 'acer aspire 6920', 'acer aspire 6920', NULL),
(263, 'Sian', '07568594976', 'Sianpocknell1978@o2.co.uk', 'Asus eee', 'Asus eee', NULL),
(264, 'Sian', '07568594976', 'Sianpocknell1978@o2.co.uk', 'Asus eee pc x101ch', 'Asus eee pc x101ch', NULL),
(265, 'Robert Hawkey', '07565513567', 'rhawkey.rh@gmail.com', 'del inspiron m5030', 'del inspiron m5030', NULL),
(266, 'oliver', '07584849399', 'daviespam1@hotmail.co.uk', 'compaq presario', 'compaq presario', NULL),
(267, 'oliver', '07584849399', 'daviespam1@hotmail.co.uk', 'compaq presario', 'compaq presario', NULL),
(268, 'katrina french', '07557969207', 'kate_french@msn.com', 'dell inspiron m5040', 'dell inspiron m5040', NULL),
(269, 'jeff james', '', 'jeffreyjames@sky.com', 'compaq cq61 ccf 20 pin. lhs and inverter plug', 'compaq cq61 ccf 20 pin. lhs and inverter plug', NULL),
(270, 'chris marshall', '07769 671668', 'chrismarshall271@live.co.uk', 'lenovo s205 1038', 'lenovo s205 1038', NULL),
(271, 'Rhys Cutlan', '07809499868', 'rhys.cutlan@hotmail.co.uk', 'Rhys Cutlan', 'Rhys Cutlan', NULL),
(272, 'Rhys Cutlan', '07809499868', 'rhys.cutlan@hotmail.co.uk', 'acer aspire 7420', 'acer aspire 7420', NULL),
(273, 'dawn', '', 'dawnybaldwin@hotmail.com', 'pav70 acer netbook', 'pav70 acer netbook', NULL),
(274, 'Wayne Thomas', '01446774974', 'Wayne.thomas@uwe.ac.uk', 'Acer aspire 5742', 'Acer aspire 5742', NULL),
(275, 'shaun', '', 'shaunyelliott123@gmail.com', '', '', NULL),
(276, 'shaun', '', 'shaunyelliott123@gmail.com', 'acer aspire series', 'acer aspire series', NULL),
(277, 'june', '07863119936', 'poker1967@hotmail.co.uk', 'acer', 'acer', NULL),
(278, 'Ahmed', '07446963799', 'rukab@hotmail.com', 'Fujitsu AH530', 'Fujitsu AH530', NULL),
(279, 'Richard', 'Rodway', '', '', '', NULL),
(280, 'Richard', 'Rodway', 'r.rodway@aurumholdings.co.uk', 'asus tf300 t', 'asus tf300 t', NULL),
(281, 'alex', '', '', 'samsung notebook np300v5', 'samsung notebook np300v5', NULL),
(282, 'Tim driscoll', '07702783294', 'tootalldrisc@hotmail.com', 'Dell inspiron 5040-1040', 'Dell inspiron 5040-1040', NULL),
(283, 'Louise Franklin', '07725736565', 'Cariadcoch@hotmail.com', 'Fujitsu Amilo Notebook Li3910', 'Fujitsu Amilo Notebook Li3910', NULL),
(284, 'A proffit', '', 'A.proffit@ntlworld.com', 'Dell 17inch', 'Dell 17inch', NULL),
(285, 'Suman', '07448791660', 'daruri.sumanth@gmail.com', '5931', '5931', NULL),
(286, 'Glenn Morton', '07909447146', 'mortysden@hotmail.com', 'Compact CQ60', 'Compact CQ60', NULL),
(287, 'Gemma', '02922217777', 'X.x_gemma_x.x@hotmail.com', 'Acer aspire one PAV70', 'Acer aspire one PAV70', NULL),
(288, 'Dai', '', 'david.pritchard65@gmail.com', 'emachines E525', 'emachines E525', NULL),
(289, 'spencer', '07564905104', 'seh455@my.open.ac.uk', 'hp pavillion g6', 'hp pavillion g6', NULL),
(290, 'Jamie', '07971424392', 'Jamy_ty@yahoo.co.uk', 'Samsung r509', 'Samsung r509', NULL),
(291, 'Kai', '07742351120', 'Kaijohnson@hotmail.co.uk', 'Hp G56', 'Hp G56', NULL),
(292, 'Zac', '07974', '', '', '', NULL),
(293, 'Zac', '07973674645', 'Zaklaw@msn. Com', 'Sony vaio vpcs132fx', 'Sony vaio vpcs132fx', NULL),
(294, 'andy', '07445251593', 'ranger1166@live.co.uk', 'dell inspiron 1525', 'dell inspiron 1525', NULL),
(295, 'b delve', '07972899262', 'bettydelve@me.com', 'Dell Inspiron q15r', 'Dell Inspiron q15r', NULL),
(296, 'Harriet', 'Wadsworth', 'harrietwadsworth3@gmail.com', 'Dell inspiron M5030', 'Dell inspiron M5030', NULL),
(305, 'Iolo Jones', '02920919267', 'ijones2@ntlworld.com', '', '', NULL),
(306, 'Iolo Jones', '02920919267', 'ijones2@ntlworld.com', '', '', NULL),
(307, 'Iolo Jones', '02920919267', 'ijones2@ntlworld.com', 'Fujitsu Lifebook A series AH531', 'Fujitsu Lifebook A series AH531', NULL),
(308, 'Helen Gambold', '', 'helengambold@yahoo.co.uk', 'motorola xoom', 'motorola xoom', NULL),
(309, 'Alex Vantwout', '07837407723', 'avantwout953@gmail.com', 'iPad 2', 'iPad 2', NULL),
(310, 'Emma Smith', '', 'emmalsmith1972@yahoo.co.uk', 'ipad 2', 'ipad 2', NULL),
(311, 'louise', '07773490191', 'lou.emm@ntlworld.com', 'packard bell notebook model mumber ze7', 'packard bell notebook model mumber ze7', NULL),
(312, 'Annalise', '07728016331', 'annalise1994@live.co.uk', 'Sony Vaio', 'Sony Vaio', NULL),
(313, 'Annalise', '07728016331', 'annalise1994@live.co.uk', 'Sony Vaio', 'Sony Vaio', NULL),
(314, 'Brian', '07896889499', 'brianedwards@mpct.co.uk', 'Lenovo c340 built in computer to screen (screen damage)', 'Lenovo c340 built in computer to screen (screen damage)', NULL),
(315, 'Jonathan Chavez', '07914021342', 'jachavez1974@yahoo.co.uk', 'compaq presario 16 inches model', 'compaq presario 16 inches model', NULL),
(316, 'michelle', '07976734877', 'chel42014@gmail.com', 'compaq cq58 laptop', 'compaq cq58 laptop', NULL),
(317, 'tyrel', '07938367161', 'tyrelb@hotmail.co.uk', 'hp hstnn-i27c', 'hp hstnn-i27c', NULL),
(318, 'sarah hassan', '', 'hassans36@hotmail.co.uk', 'msi ms-no14', 'msi ms-no14', NULL),
(319, 'Michael Moffett', '07860831588', 'mickmof@gmail.com.com', 'Samsung NP3530EC', 'Samsung NP3530EC', NULL),
(320, '', '', 'Angharradread@hotmail.co.uk', 'Lp series 6', 'Lp series 6', NULL),
(321, 'Emma', '', '', 'samsung netbook', 'samsung netbook', NULL),
(322, 'melvyn jones', '07583827243', 'jones.melvyn45@gmail.com', '', '', NULL),
(323, 'Geraldine', '07463500911', 'Geraldine.lim@gmail.com', 'toshiba protege z930', 'toshiba protege z930', NULL),
(324, 'NEIL JOHN THOMAS', '', 'TSLOGGER@AOL.COM', 'Samsung 303c12', 'Samsung 303c12', NULL),
(325, 'clare price', '07817273791', 'clare.price4@live.co.uk', 'toshiba satellite L850-166', 'toshiba satellite L850-166', NULL),
(326, 'Lucie', '', '07825126578', 'Hp', 'Hp', NULL),
(327, 'melanie greening', '07527992202', 'melaniegreening45@gmail. com', 'eee pc 1000HG asus', 'eee pc 1000HG asus', NULL),
(328, 'alastair', '07518128129', 'al.meredith6@googlemail.com', 'lenovo yoga 2  10`', 'lenovo yoga 2  10`', NULL),
(329, 'Mollie Borg', '07533059270', 'molborg@hotmail.co.uk', 'Happy Pavilion g6 g6-2287sa', 'Happy Pavilion g6 g6-2287sa', NULL),
(330, '', '', '', 'toshiba satellite c5od-b-120 laptop screen', 'toshiba satellite c5od-b-120 laptop screen', NULL),
(331, 'andrea page', '07446348074', 'Andrea.page@live.co.uk', 'Acer aspire 5735', 'Acer aspire 5735', NULL),
(332, '', '', '', 'Acer aspire one 260 dgss', 'Acer aspire one 260 dgss', NULL),
(333, 'Kate', '07967239838', 'kepritchard88@Hotmail.Co.uk', 'Toshiba satellite', 'Toshiba satellite', NULL),
(334, 'nicky', '07501937757', 'nickypearce132@gmail.com', 'asus transformer k010 (tf103c)', 'asus transformer k010 (tf103c)', NULL),
(335, 'Beth Jones', '07580 050937', 'bethan_rae82@hotmail.com', 'HP stream model - 11-d007na', 'HP stream model - 11-d007na', NULL),
(336, 'John', '07979355146', 'heronjoinery@aol.com', 'Samsung R710', 'Samsung R710', NULL),
(337, 'demetrious', '07552556988', '', '', '', NULL),
(338, 'demetrious', '07552556988', 'demetriousborg@gmail. com', 'acer v5-573', 'acer v5-573', NULL),
(339, 'Kurtis Ormond', '07480943897', 'k3ormond@gmail.com', 'sony vaio PCG-71811M', 'sony vaio PCG-71811M', NULL),
(340, 'michael evans', '07713903971', 'michael.evans1980@outlook.com', 'toshiba satellite c55-A-1R9', 'toshiba satellite c55-A-1R9', NULL),
(341, 'phil flowers', '', 'philflow89@gmail.com', 'toshiba c50', 'toshiba c50', NULL),
(342, 'Dean Almond', '07815 895842', 'caraj1005@gmail.com', 'Hewlett Parkard - HP Probook 470 G2', 'Hewlett Parkard - HP Probook 470 G2', NULL),
(343, 'frank', '09834567123', 'mike@mike.com', 'asus k66', 'asus k66', NULL),
(344, 'frank', '09834567123', 'mike@mike.com', 'asus k66', 'asus k66', NULL),
(345, 'frank', '09834567123', 'mike@mike.com', 'asus k66', 'asus k66', NULL),
(346, 'richard test', '09834567123', 'neil@bob.com', 'tosh', 'tosh', NULL),
(347, 'frank', '09834567123', 'mike@mike.com', 'asus k66', 'asus k66', NULL),
(348, 'bob neil t', '0799098765', 'neil@bob.com', 'tosh', 'tosh', NULL),
(349, 'richard test', '02920766543', 'neil@bob.com', 'tosh', 'tosh', NULL),
(350, 'bob neil t', '09834567123', 'neil@bob.com', 'asus k66', 'asus k66', NULL),
(351, 'dev', '1925963258632563', 'babarsohaildev@gmail.com', 'abc', 'abc', NULL),
(352, 'dev', '1925963258632563', 'babarsohaildev@gmail.com', 'fabafdaf', 'fabafdaf', NULL),
(353, 'dev', '1925963258632563', 'babarsohaildev@gmail.com', 'abc', 'abc', NULL),
(354, 'richard test', '09834567123', 'neil@bob.com', 'asus k66', 'asus k66', NULL),
(355, 'bob neil t', '09834567123', 'neil@bob.com', 'asus k66', 'asus k66', NULL),
(356, 'Chris Bloom', '07975503917', 'Chris_bloom@hotmail.co.uk', 'Asus AR5B95', 'Asus AR5B95', NULL),
(357, 'Chris Bloom', '07975503917', 'Chris_bloom@hotmail.co.uk', 'Asus AR5B95', 'Asus AR5B95', NULL),
(358, 'Brian Barnes', '01633 440505', 'Barnesriverside@gmail.com', 'Lenovo IDEAPAD 100-151IBY Model 80MJ', 'Lenovo IDEAPAD 100-151IBY Model 80MJ', NULL),
(359, 'David Burgee', '+447903803230', 'Daveb1812@hotmail.com', 'Acer', 'Acer', NULL),
(360, 'Adam Williams', '07482631144', 'adam-lee12@live.co.uk', 'Hp 15-af157sa', 'Hp 15-af157sa', NULL),
(361, 'Karen davies', '', 's.davies29@sky.com', 'HP 15-ac122na', 'HP 15-ac122na', NULL),
(362, 'Neil Paget', '7999056096', 'neil@cardifftec.co.uk', 'bbb', 'bbb', NULL),
(363, 'harpal singh gora', '9929699936', 'hsgora.gora3@gmail.com', 'test mail for error check', 'test mail for error check', NULL),
(364, 'harpal singh gora', '9929699936', 'hsgora.gora3@gmail.com', 'error checking', 'error checking', NULL),
(365, 'Lisa Fowler', '07989343451', 'lisajoanne75@gmail.com', 'Asus notebook', 'Asus notebook', NULL),
(366, 'ann mcgill', '07704562006', 'ann25362@hotmail.com', 'acera aspire v5 122p', 'acera aspire v5 122p', NULL),
(367, 'Dan bevan', '07564653311', '', 'Hp 11inch', 'Hp 11inch', NULL),
(368, 'Neil David Paget', '7999056096', 'neil@cardifftec.co.uk', 'asus 1234', 'asus 1234', NULL),
(369, 'Jackie lelii', '01554777509', 'Jackielelii@hotmail.co.uk', 'Lenovo ideapad 310', 'Lenovo ideapad 310', NULL),
(370, 'Becca', '07341736222', 'begastrom@gmail.com', 'Dell Inspiron 15 7000', 'Dell Inspiron 15 7000', NULL),
(371, 'Nika', '', '', 'HP 15-bs500na', 'HP 15-bs500na', NULL),
(372, 'Nika', '', 'Nikajankovicvt@gmail.com', 'HP 15-bs500na', 'HP 15-bs500na', NULL),
(373, 'Nika', '', 'Nikajankovicvt@gmail.com', 'HP 15-AC105NM P3L74EA', 'HP 15-AC105NM P3L74EA', NULL),
(374, 'Ryan', '07903222010', 'lambretta007@hotmail.com', 'Hp pavilion x2', 'Hp pavilion x2', NULL),
(375, 'Richard', '07904130980', 'Richard.gurney8@gmail.com', 'Hp pavilion 14 inch', 'Hp pavilion 14 inch', NULL),
(376, 'Carla Davies-Llewellyn', '07411312235', 'carlallewellyn@hotmail.co.uk', 'Acer CB3-431', 'Acer CB3-431', NULL),
(377, 'Marta', '07922015576', 'abellan.marta@gmail.com', 'HP Pavilion 15ab127na', 'HP Pavilion 15ab127na', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_meta_info`
--

CREATE TABLE `tbl_meta_info` (
  `mtp_id` int(11) NOT NULL,
  `mti_description` varchar(2000) NOT NULL,
  `mti_keywords` varchar(2000) NOT NULL,
  `mti_title` varchar(200) NOT NULL,
  `mti_others` varchar(2000) NOT NULL,
  `mti_google` varchar(2000) NOT NULL,
  `mti_modifiedon` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_meta_info`
--

INSERT INTO `tbl_meta_info` (`mtp_id`, `mti_description`, `mti_keywords`, `mti_title`, `mti_others`, `mti_google`, `mti_modifiedon`) VALUES
(1, 'Cardiff Computer, Laptop & PC repair. Call the experts We WILL Fix Your PC on 02920 766039 today for fast computer repair from as little as 19 pounds.', 'computer repair, laptop repair, laptop screen repair, computer shop cardiff, pc repair, computer repair cardiff, laptop repair cardiff, pc repair cardiff, laptop screen repair cardiff', 'Computer Repair Cardiff | We WILL Fix Your PC', '', 'G09uutIpSuwpnWOoq9r97Oh4ltTZH5v79msHqLDzz_w', '2013-11-11 01:11:37'),
(2, 'At We WILL Fix Your PC, we specialise in providing convenient, affordable, dependable repair services to each and every customer.', 'computer repair, laptop repair, laptop screen repair, computer shop cardiff, pc repair, computer repair cardiff, laptop repair cardiff, pc repair cardiff, laptop screen repair cardiff', 'Who we help', '', '', '2012-06-19 01:15:20'),
(3, 'Offering a fast, same day service we are your local computer repair company in Cardiff with the personal touch.', 'computer repair, laptop repair, laptop screen repair, computer shop cardiff, pc repair, computer repair cardiff, laptop repair cardiff, pc repair cardiff, laptop screen repair cardiff', 'Why choose us?', '', '', '2012-06-19 01:15:43'),
(4, 'For general PC troubleshooting our hourly rate is 19 pounds and we are confident that we\'ll beat any quote.', 'computer repair, laptop repair, laptop screen repair, computer shop cardiff, pc repair, computer repair cardiff, laptop repair cardiff, pc repair cardiff, laptop screen repair cardiff', 'Services and Prices', '', '', '2013-04-21 22:34:27'),
(5, 'Great Tech Support is only a phone call away. Talk to us today on 02920 766039.', 'computer repair, laptop repair, laptop screen repair, computer shop cardiff, pc repair, computer repair cardiff, laptop repair cardiff, pc repair cardiff, laptop screen repair cardiff', 'Contact Us', '', '', '2013-11-11 01:11:25'),
(6, 'Great Tech Support is only email away. Book your appointment today!', 'computer repair, laptop repair, laptop screen repair, computer shop cardiff, pc repair, computer repair cardiff, laptop repair cardiff, pc repair cardiff, laptop screen repair cardiff', 'Appointment', '', '', '2012-06-19 01:16:42'),
(37, 'Cardiff Computer, Laptop & PC repair. Call the experts We WILL fix Your PC on 02920 766039 today for fast computer repair from as little as 19 pounds.', 'cyncoed computer repair, laptop repair, laptop screen repair, computer shop cardiff, pc repair, computer repair cardiff, laptop repair cardiff, pc repair cardiff, laptop screen repair cardiff', 'Computer repair in Cyncoed, Cardiff | We WILL fix Your PC', '', '', '2013-11-11 01:09:19'),
(44, 'Cardiff Computer, Laptop & PC repair. Call the experts We WILL fix Your PC on 02920 766039 today for fast computer repair from as little as 19 pounds.', 'heath computer repair, laptop repair, laptop screen repair, computer shop cardiff, pc repair, computer repair cardiff, laptop repair cardiff, pc repair cardiff, laptop screen repair cardiff', 'Computer repair in Heath, Cardiff | We WILL fix Your PC', '', '', '2013-11-11 01:09:30'),
(46, 'Cardiff Computer, Laptop & PC repair. Call the experts We WILL fix Your PC on 02920 766039 today for fast computer repair from as little as 19 pounds.', 'lisvane computer repair, laptop repair, laptop screen repair, computer shop cardiff, pc repair, computer repair cardiff, laptop repair cardiff, pc repair cardiff, laptop screen repair cardiff', 'Computer repair in Lisvane, Cardiff | We WILL fix Your PC', '', '', '2013-11-11 01:09:43'),
(47, 'Cardiff Computer, Laptop & PC repair. Call the experts We WILL fix Your PC on 02920 766039 today for fast computer repair from as little as 19 pounds.', 'llandaff computer repair, laptop repair, laptop screen repair, computer shop cardiff, pc repair, computer repair cardiff, laptop repair cardiff, pc repair cardiff, laptop screen repair cardiff', 'Computer repair in Llandaff, Cardiff | We WILL fix Your PC', '', '', '2013-11-11 01:09:55'),
(49, 'Cardiff Computer, Laptop & PC repair. Call the experts We WILL fix Your PC on 02920 766039 today for fast computer repair from as little as 19 pounds.', 'llanishen computer repair, laptop repair, laptop screen repair, computer shop cardiff, pc repair, computer repair cardiff, laptop repair cardiff, pc repair cardiff, laptop screen repair cardiff', 'Computer repair in Llanishen, Cardiff | We WILL fix Your PC', '', '', '2013-11-11 01:10:07'),
(56, 'Cardiff Computer, Laptop & PC repair. Call the experts We WILL fix Your PC on 02920 766039 today for fast computer repair from as little as 19 pounds.', 'penylan computer repair, laptop repair, laptop screen repair, computer shop cardiff, pc repair, computer repair cardiff, laptop repair cardiff, pc repair cardiff, laptop screen repair cardiff', 'Computer repair in Penylan, Cardiff | We WILL fix Your PC', '', '', '2013-11-11 01:10:17'),
(58, 'Cardiff Computer, Laptop & PC repair. Call the experts We WILL fix Your PC on 02920 766039 today for fast computer repair from as little as 19 pounds.', 'pontprennau computer repair, laptop repair, laptop screen repair, computer shop cardiff, pc repair, computer repair cardiff, laptop repair cardiff, pc repair cardiff, laptop screen repair cardiff', 'Computer repair in Pontprennau, Cardiff | We WILL fix Your PC', '', '', '2013-11-11 01:10:29'),
(60, 'Cardiff Computer, Laptop & PC repair. Call the experts We WILL fix Your PC on 02920 766039 today for fast computer repair from as little as 19 pounds.', 'rhiwbina computer repair, laptop repair, laptop screen repair, computer shop cardiff, pc repair, computer repair cardiff, laptop repair cardiff, pc repair cardiff, laptop screen repair cardiff', 'Computer repair in Rhiwbina, Cardiff | We WILL fix Your PC', '', '', '2013-11-11 01:10:49'),
(62, 'Cardiff Computer, Laptop & PC repair. Call the experts We WILL fix Your PC on 02920 766039 today for fast computer repair from as little as 19 pounds.', 'roath computer repair, laptop repair, laptop screen repair, computer shop cardiff, pc repair, computer repair cardiff, laptop repair cardiff, pc repair cardiff, laptop screen repair cardiff', 'Computer repair in Roath, Cardiff | We WILL fix Your PC', '', '', '2013-11-11 01:11:02'),
(71, 'Cardiff Computer, Laptop & PC repair. Call the experts We WILL fix Your PC on 02920 766039 today for fast computer repair from as little as 19 pounds.', 'whitchurch computer repair, laptop repair, laptop screen repair, computer shop cardiff, pc repair, computer repair cardiff, laptop repair cardiff, pc repair cardiff, laptop screen repair cardiff', 'Computer repair in Whitchurch, Cardiff | We WILL fix Your PC', '', '', '2013-11-11 01:11:14'),
(84, 'Cardiff Computer, Laptop & PC repair. Call the experts We WILL fix Your PC on 02920 766039 today for fast computer repair from as little as 19 pounds.', 'computer repair, laptop repair, laptop screen repair, computer shop cardiff, pc repair, computer repair cardiff, laptop repair cardiff, pc repair cardiff, laptop screen repair cardiff, hard drive cardiff', 'Replacement Hard Drive, Cardiff | We WILL fix Your PC', '', '', '2013-11-11 01:12:39'),
(87, 'Cardiff Computer, Laptop & PC repair. Call the experts We WILL fix Your PC on 02920 766039 today for fast computer repair from as little as 19 pounds.', 'computer repair, laptop repair, laptop screen repair, computer shop cardiff, pc repair, computer repair cardiff, laptop repair cardiff, pc repair cardiff, laptop screen repair cardiff, laptop overheating cardiff', 'Laptop Overheating, Cardiff | We WILL fix Your PC', '', '', '2013-11-11 01:11:48'),
(88, 'Cardiff Computer, Laptop & PC repair. Call the experts We WILL fix Your PC on 02920 766039 today for fast computer repair from as little as 19 pounds.', 'computer repair, laptop repair, laptop screen repair, computer shop cardiff, pc repair, computer repair cardiff, laptop repair cardiff, pc repair cardiff, laptop screen repair cardiff, laptop power connector cardiff, dc jack cardiff', 'Laptop power connector DC Jack, Cardiff | We WILL fix Your PC', '', '', '2013-11-11 01:12:03'),
(91, 'Cardiff Computer, Laptop & PC repair. Call the experts We WILL fix Your PC on 02920 766039 today for fast computer repair from as little as 19 pounds.', 'computer repair, laptop repair, laptop screen repair, computer shop cardiff, pc repair, computer repair cardiff, laptop repair cardiff, pc repair cardiff, laptop screen repair cardiff, lost data cardiff, data recovery cardiff', 'Lost data files recovered, Cardiff | We WILL fix Your PC', '', '', '2013-11-11 01:12:30'),
(97, 'Cardiff Computer, Laptop & PC repair. Call the experts We WILL fix Your PC on 02920 766039 today for fast computer repair from as little as 19 pounds.', 'computer repair, laptop repair, laptop screen repair, computer shop cardiff, pc repair, computer repair cardiff, laptop repair cardiff, pc repair cardiff, laptop screen repair cardiff, virus removal cardiff, spyware removal cardiff', 'Virus removal, Cardiff | We WILL fix Your PC', '', '', '2013-11-11 01:13:07'),
(99, 'Cardiff Computer, Laptop & PC repair. Call the experts We WILL fix Your PC on 02920 766039 today for fast computer repair from as little as 19 pounds.', 'computer repair, laptop repair, laptop screen repair, computer shop cardiff, pc repair, computer repair cardiff, laptop repair cardiff, pc repair cardiff, laptop screen repair cardiff', 'Wireless Networking, Cardiff | We WILL fix Your PC', '', '', '2013-11-11 01:13:46'),
(100, 'Cardiff laptop screen replacement specialist. We hold large stocks for a fast same-day fitting service. Best prices in Cardiff. Call 02920 766039', 'laptop screen repair, laptop screen replacement, broken laptop screen, replace laptop screen, new laptop screen, fix laptop screen cardiff', 'Laptop screen replacement Cardiff |WeWillFixYourPC', '', '', '2013-11-11 01:09:01'),
(101, 'Cardiff Computer, Laptop & PC repair. Call the experts We WILL fix Your PC on 02920 766039 today for fast computer repair from as little as 19 pounds.', 'computer repair, laptop repair, laptop screen repair, computer shop cardiff, pc repair, computer repair cardiff, laptop repair cardiff, pc repair cardiff, laptop screen repair cardiff, Windows xp end', 'Windows XP End of Life | We WILL fix Your PC', '', '', '2013-11-11 01:13:34'),
(102, 'Cardiff Computer, Laptop & PC repair. Call the experts We WILL fix Your PC on 02920 766039 today for fast computer repair from as little as 19 pounds.', 'computer repair, laptop repair, laptop screen repair, computer shop cardiff, pc repair, computer repair cardiff, laptop repair cardiff, pc repair cardiff, laptop screen repair cardiff, sell laptop cardiff', 'Sell your laptop, Cardiff | We WILL fix Your PC', '', '', '2013-11-11 01:12:48'),
(103, 'Cardiff tablet screen replacement specialist. We hold large stocks for a fast same-day fitting service. Best prices in Cardiff. Call 02920 766039', 'tablet screen repair, tablet screen replacement, broken tablet screen, replace tablet screen, new tablet screen, fix tablet screen cardiff', 'Tablet screen replacement Cardiff |WeWillFixYourPC', '', '', '2013-11-11 01:09:01');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_meta_pages`
--

CREATE TABLE `tbl_meta_pages` (
  `mtp_id` int(11) NOT NULL,
  `mtp_page` varchar(50) NOT NULL,
  `mtp_status` tinyint(1) NOT NULL,
  `mtp_modifiedon` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_meta_pages`
--

INSERT INTO `tbl_meta_pages` (`mtp_id`, `mtp_page`, `mtp_status`, `mtp_modifiedon`) VALUES
(1, 'Home', 1, '0000-00-00 00:00:00'),
(2, 'Who We Help', 1, '2012-06-18 23:29:31'),
(3, 'Why Choose Us', 1, '2012-06-18 23:29:31'),
(4, 'Services and Prices', 1, '2012-06-18 23:29:31'),
(5, 'Contact Us', 1, '2012-06-18 23:29:31'),
(6, 'Appointment', 1, '2012-06-18 23:29:31'),
(44, 'Computer repair in Heath', 1, '2012-09-06 20:27:05'),
(46, 'Computer repair in Lisvane', 1, '2012-09-06 20:27:05'),
(47, 'Computer repair in Llandaff', 1, '2012-09-06 20:27:05'),
(49, 'Computer repair in Llanishen', 1, '2012-09-06 20:27:05'),
(56, 'Computer repair in Penylan', 1, '2012-09-06 21:10:18'),
(58, 'Computer repair in Pontprennau', 1, '2012-09-06 20:27:05'),
(60, 'Computer repair in Rhiwbina', 1, '2012-09-06 20:27:05'),
(62, 'Computer repair in Roath', 1, '2012-09-06 20:27:05'),
(71, 'Computer repair in Whitchurch', 1, '2012-09-06 20:27:05'),
(84, 'Replacement Hard Drive', 1, '2013-04-12 21:07:01'),
(87, 'Laptop Overheating', 1, '2013-04-12 21:07:14'),
(88, 'Laptop power connector DC Jack', 1, '2012-09-06 20:27:05'),
(91, 'Lost data files recovered', 1, '2013-04-21 22:41:33'),
(102, 'Sell your laptop', 1, '2013-04-12 21:08:15'),
(101, 'Windows XP End of Life', 1, '2013-04-12 21:07:59'),
(97, 'Virus removal', 1, '2012-09-06 20:27:05'),
(37, 'Computer repair in Cyncoed', 1, '2013-04-12 21:04:42'),
(99, 'Wireless Networking', 1, '2013-04-12 21:07:32'),
(100, 'Appointment for Laptop ', 1, '2012-10-19 19:36:24'),
(103, 'Tablet Screen Repair', 1, '2013-11-24 16:19:04');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_modules`
--

CREATE TABLE `tbl_modules` (
  `moduleId` int(5) NOT NULL,
  `moduleName` varchar(100) NOT NULL,
  `modulemodifiedon` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_modules`
--

INSERT INTO `tbl_modules` (`moduleId`, `moduleName`, `modulemodifiedon`) VALUES
(1, 'Manage Content Items', '0000-00-00 00:00:00'),
(2, 'Manage Portfolio', '0000-00-00 00:00:00'),
(3, 'Manage Email Preferences', '0000-00-00 00:00:00'),
(4, 'manage Addresses', '0000-00-00 00:00:00'),
(5, 'meta-tags', '0000-00-00 00:00:00'),
(6, 'Manage Header ', '0000-00-00 00:00:00'),
(7, 'Manage Meta', '2010-06-12 00:38:11');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_pages`
--

CREATE TABLE `tbl_pages` (
  `pageId` int(5) NOT NULL DEFAULT '0',
  `pageTitle` varchar(100) DEFAULT NULL,
  `pageText` text,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `modifiedon` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_pages`
--

INSERT INTO `tbl_pages` (`pageId`, `pageTitle`, `pageText`, `status`, `modifiedon`) VALUES
(1, 'Welcome to We WILL fix Your PC ', '<p><span style=\"color:rgb(73, 73, 73); font-family:lucida sans unicode,verdana,sans-serif; font-size:13\"><em>Your local Cardiff laptop repair, computer &amp; pc repair specialist. Laptop repairs and laptop screen replacements carried out on site or in our Cardiff workshop...</em><br />\r\n<br />\r\nWelcome. You&rsquo;ve arrived at We WILL fix Your PC.&nbsp; If you&rsquo;re looking for expert help with your desktop or laptop - without breaking the bank - then search no further. Whatever the problem, we&rsquo;ll get your computer working again and running at optimal speed and performance &ndash; fast!<br />\r\n<br />\r\nWe enjoy an excellent reputation built on fifteen years of delivering outstanding service and value for money. When you ask us to repair your computer, you can expect to receive personal and courteous advice and assistance from experts who care. We&rsquo;ll explain what is wrong with your computer, in plain, jargon-free English, and tell you exactly how much it will cost to fix &ndash; and we guarantee that it will be the lowest price you&rsquo;ll find anywhere.<br />\r\n<br />\r\nWe&rsquo;re a local company based in an easily accessible location in Cardiff. But if you&rsquo;re unable to get to us, don&rsquo;t worry, we offer a free pick-up and return delivery service. And if you&rsquo;re stuck without a computer, we&rsquo;ll even loan you a free courtesy laptop while we carry out your repair. We also operate a no-fix-no-fee guarantee, so you can be confident that in the unlikely event that we&rsquo;re unable to fix your computer it won&rsquo;t cost you a penny. <a href=\"choose.php\">Why choose us?</a></span></p>', 1, '2014-03-20 19:27:03'),
(2, 'Phone Support ', '<p>Fantastic help and advice given over the phone for anything from a small problem to buying a new computer.</p>', 1, '2014-03-20 19:28:07'),
(8, 'Why Choose Us', '<div class=\\\"whead3\\\" style=\\\"text-transform: none;\\\">Why choose We WILL fix Your PC?</div>\r\n\r\n<br />\r\n<br />\r\n<div class=\\\"wpara\\\" style=\\\"margin-bottom: 0px;\\\">\r\n<p><span style=\\\"color: rgb(73, 73, 73); line-height: 20px; font-family: Lucida Sans Unicode, Verdana, sans-serif; font-size: 13px; font-weight: normal;\\\">\r\n\r\nThere are a great many computer repair companies in Cardiff - so many, in fact, that unless you know what you&#39;re looking for it can be impossible to tell them apart. So what separates We WILL fix Your PC from other computer repairers? To begin with, we&#39;re significantly less expensive and faster than the high street chain stores. And, unlike in those stores, with us you&#39;ll actually be speaking to the person who is repairing your computer - and not a counter assistant who will simply pack your computer in a box and send it off to a central depot for repair by a faceless engineer. At the other end of the spectrum there&#39;s the 16 year old with a mobile phone only contact number who&#39;s offering their services on Gum Tree, etc. But in most cases they simply don&#39;t have the breadth of experience and expertise of a long-established and qualified computer professional. Secondly, there&#39;s no guarantee that the person working on your computer knows what they&#39;re doing. They may not carry out a proper repair, and in some instances may even cause damage to your computer or lose your data. Also there&#39;s a strong chance they will &#39;be here today and gone tomorrow&#39; - there&#39;s a high turnover among computer repair shops, and they go out of business all the time. We have been in business continually since 1995, so you can be confident we won&#39;t disappear with your computer, and we&#39;ll always be around when you need us.<br />\r\n<br />\r\n<strong>Our Goal: To be the best in Cardiff.</strong><br />\r\n<br />\r\nNo one in Cardiff will work harder for you. No one in Cardiff enjoys our outstanding referrals, customer loyalty and personal testimonials. We&#39;re committed to you and your needs and to getting your computer repaired quickly and affordably. We have a strong work ethic, based on integrity and respect for our customers. You&#39;ll find us patient and friendly to work with, and we always listen to what it is that you really want from a computer repair service.<br />\r\n<br />\r\nHere are some other very good reasons why you&#39;ll be glad you&#39;ve decided to trust us with your computer: </span></p><p>&nbsp;</p>\r\n\r\n<span style=\"color:rgb(73, 73, 73); font-family:lucida sans unicode,verdana,sans-serif; font-size:20\">\r\n&bull;&nbsp;We offer a lowest price guarantee<br />\r\n&bull;&nbsp;Quick repair turnaround<br />\r\n&bull;&nbsp;All work and parts are covered by our no-quibble 90-day guarantee.<br />\r\n&bull;&nbsp;We are your local Cardiff computer repair company and offer service with a personal touch.</span>\r\n\r\n<p>&nbsp;</p>\r\n</div>', 1, '2014-04-19 21:58:17'),
(3, 'Simple Issues ', '<p>Routine maintenance such as software installs, laptop chargers, memory upgrades, drive caddies etc.</p>', 1, '2014-04-19 22:27:32'),
(4, 'Complex Issues ', '<p>Hardware and software repairs such as laptop power socket repair, virus removal, system rebuilds etc.</p>', 1, '2014-03-20 19:28:26'),
(5, 'Critical Issues ', '<p>Hardware issues that require parts such as laptop screen replacements, laptop motherboard repairs etc.</p>', 1, '2014-03-20 19:28:36'),
(6, 'Who We Help', '<div class=\\\"whead3\\\" style=\\\"text-transform: none;\\\">\r\nComputer repair for home and businesses in Cardiff and Caerphilly</div>\r\n\r\n<br />\r\n<br />\r\n<div class=\\\"wpara\\\" style=\\\"margin-bottom: 0px;\\\">\r\n<p><span style=\\\"color: rgb(73, 73, 73); line-height: 20px; font-family: Lucida Sans Unicode, Verdana, sans-serif; font-size: 13px; font-weight: normal;\\\">\r\n\r\n<em>The fast, one-stop shop for computer and laptop repairs and upgrades for residential customers and small businesses in Cardiff and Caerphilly... </em><br />\r\n<br />\r\nWe understand how stressful and frustrating it can be to have a broken computer and be suddenly deprived of your vital data. That&#39;s why we take our repair responsibilities very seriously. Every customer is equally important to us, however small the job. When you ask us for help we work hard to resolve your problems quickly and efficiently and get your computer back up and running like new in the shortest possible time.<br />\r\n<br />\r\nWe&#39;ve been delivering convenient, affordable and dependable repair services to the residents of Cardiff and Caerphilly for more than fifteen years. We&#39;re experts in diagnosing and correcting a wide range of computer issues - including both hardware and software failures, and there are very few problems that we aren&#39;t able to resolve. We enjoy a technical challenge and we&#39;ll always apply our expertise to help you get the most from your computer. </span><br />\r\n&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<div>Your Computer, <strong>Fixed, Fast.</strong><br />\r\n&nbsp;</div>\r\n<span style=\"color:rgb(73, 73, 73); font-family:lucida sans unicode,verdana,sans-serif; font-size:20\">&bull;&nbsp;Highly competitive hourly rate<br />\r\n&bull;&nbsp;Low prices with fast turnaround<br />\r\n&bull;&nbsp;Free diagnostics and estimates<br />\r\n&bull;&nbsp;15 years&rsquo; experience in the IT industry<br />\r\n&bull;&nbsp;Satisfaction guaranteed or your money back </span>\r\n\r\n<p>&nbsp;</p>\r\n</div>\r\n', 1, '2014-04-19 21:57:50'),
(7, 'Services and Prices', '<div class=\\\"whead3\\\" style=\\\"text-transform: none;\\\">Our fantastic services and prices</div>\r\n<br />\r\n<br />\r\n<div class=\\\"wpara\\\" style=\\\"margin-bottom: 0px;\\\">\r\n<p><span style=\\\"color: rgb(73, 73, 73); line-height: 20px; font-family: Lucida Sans Unicode, Verdana, sans-serif; font-size: 13px; font-weight: normal;\\\">\r\n<em>We deliver a comprehensive range of affordable computer services, repairs and support for residential and small business customers in the Cardiff and Caerphilly area. </em><br />\r\n<br />\r\nFor general PC troubleshooting our hourly rate is just &pound;29.00. This covers email problems, configuration issues, regaining lost internet connections and any other troubleshooting issues.<br />\r\n<br />\r\n<strong>Our price cap guarantee...</strong><br />\r\n<br />\r\nWe guarantee that your repair will take no longer than three hours - and if it does we won&#39;t charge you for any additional labour time!<br />\r\n<br />\r\n<strong>What you get...</strong><br />\r\n<br />\r\n&bull;&nbsp;FREE pick-up and drop-off<br />\r\n&bull;&nbsp;A personal, punctual and dependable service<br />\r\n&bull;&nbsp;A flexible and affordable solution to any computer problem<br />\r\n&bull;&nbsp;A FREE courtesy laptop while your computer is being repaired (subject to availability)<br />\r\n&bull;&nbsp;Lowest price anywhere guaranteed<br />\r\n<br />\r\nTalk to us today. You&#39;ll find us friendly, knowledgeable and approachable. As well fixing your PC, laptop and network problems, we can help you with advice on internet connections, computer security, data-backup and virus protection - and any other computer-related issue. Here are just some of the clever things we can do for you at We WILL fix Your PC. All prices you see below and all quotes given include all labour costs and VAT.<br />\r\n<br />\r\n&bull;&nbsp;Fantastic help and advice: FREE!<br />\r\n&bull;&nbsp;Windows password removal: FREE!<br />\r\n&bull;&nbsp;Memory (RAM) upgrades: &pound;15 *<br />\r\n&bull;&nbsp;Replacement laptop charger: &pound;15 *<br />\r\n&bull;&nbsp;Lost Data recovered: &pound;29<br />\r\n&bull;&nbsp;Data transfer or backup: &pound;29<br />\r\n&bull;&nbsp;Laptop overheating issues resolved: &pound;39 *<br />\r\n&bull;&nbsp;Complete Virus removal and system speed up: &pound;39<br />\r\n&bull;&nbsp;Replacement laptop fans fitted: &pound;39 *<br />\r\n&bull;&nbsp;Replacement laptop keyboard: &pound;39 *<br />\r\n&bull;&nbsp;Laptop screen cable replacements: &pound;39 *<br />\r\n&bull;&nbsp;Supply and fit new desktop power supply: &pound;39 *<br />\r\n&bull;&nbsp;Windows reinstallation with all updates and your data backed up: &pound;39<br />\r\n&bull;&nbsp;Laptop power connector replacement (DC Jack): &pound;49<br />\r\n&bull;&nbsp;Wireless router supplied and fitted: &pound;59<br />\r\n&bull;&nbsp;Laptop screen replacements: &pound;59 *<br />\r\n&bull;&nbsp;New hard drive with Windows reinstallation: &pound;69 *<br />\r\n&bull;&nbsp;Laptop motherboard component repair: &pound;69<br />\r\n&bull;&nbsp;Desktop motherboard replacements: &pound;79 *<br />\r\n<br />\r\n* = Price could vary slightly due to the specification, current costs and availability of parts required.</span></p>\r\n</div>\r\n\r\n<p>&nbsp;</p>', 1, '2014-04-19 21:58:33'),
(84, 'Replacement hard drive in Cardiff - We WILL fix Your PC', '<div class=\\\"whead3\\\" style=\\\"text-transform: none;\\\">  <br />\r\nReplacing your Hard Drive  </div>\r\n<br />\r\n<br />\r\n<div class=\\\"wpara\\\" style=\\\"margin-bottom: 0px;\\\">\r\n<p><span style=\\\"color: rgb(73, 73, 73); line-height: 20px; font-family: Lucida Sans Unicode, Verdana, sans-serif; font-size: 13px; font-weight: normal;\\\">  The hard drive in your desktop or laptop will need to be replaced for one of two reasons - you need a faster or bigger drive as you have run out of space or you have experienced a hard drive failure. If you have a desktop PC and just want more capacity then we can just add a second drive for you. This can also be done with certain larger laptops that have a space for a second drive.  <br />\r\n<br />\r\nHere are our current prices for hard drive replacements. <br /><P></p>\r\n160GB = &pound;29<br />\r\n250GB = &pound;35<br />\r\n320GB = &pound;39<br />\r\n500GB = &pound;49<br />\r\n1TB = &pound;69<br />\r\n<br />\r\nPlease enquire for prices of larger sizes and/or solid state drives (SSD).  <br />\r\n<br />\r\nAs the drive will be blank I will also be able to install Windows and all its updates with antivirus for you for &pound;40. So if for example you decide to go for a 160GB drive the total cost will be &pound;29 + &pound;40 = &pound;69. If the original hard drive has not completely failed, then we can try to recover the personal data off it.  <br />\r\n<br />\r\nWe keep stocks of all the drives mentioned above so please call us today on 02920 766039 for an immediate repair.</span></p>\r\n</div>', 1, '2014-04-19 23:15:15'),
(87, 'Laptop overheating repair in Cardiff - We WILL fix Your PC', '<div class=\\\"whead3\\\" style=\\\"text-transform: none;\\\">  <br />\r\nIs your laptop overheating?  </div>\r\n<br />\r\n<br />\r\n<div class=\\\"wpara\\\" style=\\\"margin-bottom: 0px;\\\">\r\n<p><span style=\\\"color: rgb(73, 73, 73); line-height: 20px; font-family: Lucida Sans Unicode, Verdana, sans-serif; font-size: 13px; font-weight: normal;\\\">  The greatest threat to your laptop, apart from your coffee cup, is overheating which causes hardware failure and even permanent damage. You probably don\\\'t realise that this can also be the cause of your lack of performance or why the laptop crashes a lot and before you know it you have a damaged motherboard on your hands.  <br />\r\n<br />\r\nYou may first notice the laptop is getting hot when your fan runs at its maximum speed more often and hot air which is supposed to flow out of the system quickly is no longer doing so.  <br />\r\n<br />\r\nWe offer a strip and clean service for only &pound;39 where we will strip the laptop apart to clean the heatsink and fan and we will also apply new thermal compound to the CPU to ensure the cooling system in your laptop runs as efficently as it should. This will then stop the laptop from shutting down when you were busy using it and even from an early death.  <br />\r\n<br />\r\nPlease call us today on 02920 766039 to stop laptop heat damage in its tracks!</span></p>\r\n</div>', 1, '2014-04-19 17:39:33'),
(88, 'Laptop power connector DC Jack repair in Cardiff - We WILL fix Your PC', '<div class=\\\"whead3\\\" style=\\\"text-transform: none;\\\">  <br />\r\nReplacing your laptop power connector (DC Jack)  </div>\r\n<br />\r\n<br />\r\n<div class=\\\"wpara\\\" style=\\\"margin-bottom: 0px;\\\">\r\n<p><span style=\\\"color: rgb(73, 73, 73); line-height: 20px; font-family: Lucida Sans Unicode, Verdana, sans-serif; font-size: 13px; font-weight: normal;\\\">  Does your laptop charge only intermittently or not at all. Unable to power on your laptop even though its plugged in?  <br />\r\n<br />\r\nYour charger connects to the DC Jack in your laptop which may have become damaged as a result of being knocked or dropped. Also if you have had to push or pull it in a certain way for a few months and now it wont work at all then we can repair this for you.  <br />\r\n<br />\r\nPrice for this repair is &pound;49 and we will replace and strengthen the DC Jack ensuring it\\\'s continued operation for a long time after the repairs been carried out. We also keep most types of Jack in stock for a quick repair (Approx. 24hours)  <br />\r\n<br />\r\nPlease call us today on 02920 766039 or just drop into our Cardiff workshop if you think your laptop is suffering from a power connector problem.</span></p>\r\n</div>', 1, '2014-04-19 17:15:50'),
(91, 'Lost data recovery service in Cardiff - We WILL fix Your PC', '<div class=\\\"whead3\\\" style=\\\"text-transform: none;\\\">  <br />\r\nLost data recovery service  </div>\r\n<br />\r\n<br />\r\n<div class=\\\"wpara\\\" style=\\\"margin-bottom: 0px;\\\">\r\n<p><span style=\\\"color: rgb(73, 73, 73); line-height: 20px; font-family: Lucida Sans Unicode, Verdana, sans-serif; font-size: 13px; font-weight: normal;\\\">  There are many ways data can be lost wether it be from a virus, incorrect software installation or accidential deletion. As long as your hard drive is still spinning then we can offer to recover all your valuble data from your desktop or laptop computer.  <br />\r\n<br />\r\nThe top tips for a better chance of getting your data back after loss are :-  <br />\r\n<br />\r\n<strong>If you are asked to format the drive - say No.<br />\r\nStop using the drive so unplug it or turn it off.<br />\r\nBring it over to us as quickly as possible.</strong><br />\r\n<br />\r\n<br />\r\nPlease call us today on 02920 766039. Our data recovery service starts from as little as &pound;29!</span></p>\r\n</div>', 1, '2014-04-19 23:11:06'),
(97, 'Virus and malware removal in Cardiff - We WILL fix Your PC', '<div class=\\\"whead3\\\" style=\\\"text-transform: none;\\\">  <br />\r\nVirus and Spyware removal services  </div>\r\n<br />\r\n<br />\r\n<div class=\\\"wpara\\\" style=\\\"margin-bottom: 0px;\\\">\r\n<p><span style=\\\"color: rgb(73, 73, 73); line-height: 20px; font-family: Lucida Sans Unicode, Verdana, sans-serif; font-size: 13px; font-weight: normal;\\\">  Think you might have a virus - is your computer suddenly running slowly or having problems getting onto the internet?  <br />\r\n<br />\r\nMalicious software goes by many names: trojans, malware, worms, spyware, adware, conficker, keystroke loggers, and more. &quot;Virus&quot; often is used to mean all malicious software.  <br />\r\n<br />\r\nUsing the latest tools and our experience we can provide a quality virus removal service to clean your computer and then we will install new anti virus protection. Depending on the circumstances, sometimes the correct approach might be to wipe the hard disk clean and re-install Windows. In this case we will ensure all of your personal data is backed up first so you dont lose any valuble photos, documents or music.  <br />\r\n<br />\r\nCall us today on 02920&nbsp;766039 so we can rid you of that virus today!</span></p>\r\n</div>', 1, '2013-11-11 01:05:29'),
(99, 'Wireless services in Cardiff - We WILL fix Your PC', '<div class=\\\"whead3\\\" style=\\\"text-transform: none;\\\">  <br />\r\nWireless troubleshooting and installation services  </div>\r\n<br />\r\n<br />\r\n<div class=\\\"wpara\\\" style=\\\"margin-bottom: 0px;\\\">\r\n<p><span style=\\\"color: rgb(73, 73, 73); line-height: 20px; font-family: Lucida Sans Unicode, Verdana, sans-serif; font-size: 13px; font-weight: normal;\\\">  Are you having problems with your internet or wireless connection? If so, then we can come on-site to fix it. Most of our call outs for these issues would be solved within the first hour and if we can\\\'t fix the problem there and then we can narrow down the cause of the problem so you can follow it up with your internet service provider or we can replace the router etc.  <br />\r\n<br />\r\nWe can also give fantastic advice on increasing your broadband speed and positioning of wireless devices to get the best performance from your internet set-up. We can even use additional hardware to extend your wirless signal to those places in the house its currently unable to reach.  <br />\r\n<br />\r\nWe will also ensure that your wireless network is set up correctly using a secure password, data encryption and with only a trusted network of computers that have permission to use your wireless network.  <br />\r\n<br />\r\nCall us today on 02920 766039 so we can show you how to get the most out of your home or small business network.</span></p>\r\n</div>', 1, '2013-11-11 01:05:44'),
(100, 'Replacement laptop screen in Cardiff - We WILL fix Your PC', '<div class=\\\"whead3\\\" style=\\\"text-transform: none;\\\">  <br />\r\nAffordable Replacement laptop screen in Cardiff</div>\r\n<br />\r\n<br />\r\n<div class=\\\"wpara\\\" style=\\\"margin-bottom: 0px;\\\">\r\n<p><span style=\\\"color: rgb(73, 73, 73); line-height: 20px; font-family: Lucida Sans Unicode, Verdana, sans-serif; font-size: 13px; font-weight: normal;\\\">We\\&#39;ve been fitting laptop screens for many years, so you can be confident that your laptop is in safe hands. We\\&#39;re able to fix all laptop makes and models, with up to 60% off manufacturer prices. We stock a huge range of screens for an immediate fit, or can supply any size and type of screen within 24 hours.<br />\r\n<br />\r\n<strong>We offer three main laptop screen repair services:</strong><br />\r\n<br />\r\n1. You come to us for the replacement screen to be fitted while you wait (approx. 15mins).<br />\r\n<br />\r\n2. We come to you with the replacement screen to be fitted at your home or business premises.<br />\r\n<br />\r\n3. We collect your laptop from your home or work and return it to you fixed at your convenience.<br />\r\n<br />\r\nWe will not require your laptop password, and you don\\&#39;t have to worry about the security of your data, as we won\\&#39;t need to log on to your laptop to test it.<br />\r\n<br />\r\nPlease use our form below to get a quote for your replacement screen today. Nearly all laptops will have the model number located on the base. It can be a combination of letters and numbers. Look for the brand name and then a series of numbers/letters that follow. Have a question? Still can\\&#39;t find the model number? Then contact us today on 02920 766039.</p><br />\r\n<br />\r\n</div>', 1, '2014-04-19 17:22:21'),
(102, 'Sell your laptop in Cardiff  - We WILL fix Your PC', '<div class=\"whead3\" style=\"text-transform:none; \">\r\n\r\n<font size=4><br />If your laptop is broken, faulty, used or just unwanted, trade it in for cash!<font>\r\n\r\n</div><br /><br /><div class=\"wpara\" style=\"margin-bottom:0px;\"><p><span style=\"color: rgb(73, 73, 73); line-height: 20px; font-family: Lucida Sans Unicode, Verdana, sans-serif; font-size: 13; font-weight: normal;\">\r\n\r\nTake the hassle out of recycling laptops for cash. No need to pack it and haul it down to the postoffice hoping it reaches where its going and not knowing when you will get your cash. We will come to collect your laptop whenever it suits you and pay you the cash at the door.\r\n\r\n<br /><br />\r\n\r\nWorried about your confidential data? Don\'t worry we will give you a copy of your data if required then afterwards securely wipe your hard drive so your data is non recoverable. No charge for this service if we buy your laptop.\r\n\r\n<br /><br />\r\n\r\nThe amount we quote is the amount you get, so sell a laptop today!</span></p></div>\r\n', 1, '2013-04-21 21:45:30'),
(103, 'Replacement tablet screen in Cardiff - We WILL fix Your PC', '<div class=\\\"whead3\\\" style=\\\"text-transform: none;\\\">  <br />\r\nTablet screens fitted at up to 60% off manufacturer prices  </div>\r\n<br />\r\n<br />\r\n<div class=\\\"wpara\\\" style=\\\"margin-bottom: 0px;\\\">\r\n<p><span style=\\\"color: rgb(73, 73, 73); line-height: 20px; font-family: Lucida Sans Unicode, Verdana, sans-serif; font-size: 13px; font-weight: normal;\\\">  We\\\'ve been fitting tablet screens for many years, so you can be confident that your laptop is in safe hands. We\\\'re able to fix most tablet makes and models, with up to 60% off manufacturer prices. You can either drop your tablet to us at our workshop in the Cardiff business park in Llanishen or we collect your laptop from your home or work and return it to you fixed at your convenience. </span></p>\r\n<p><span style=\\\"color: rgb(73, 73, 73); line-height: 20px; font-family: Lucida Sans Unicode, Verdana, sans-serif; font-size: 13px; font-weight: normal;\\\"><br />\r\nPlease use our form below to get a quote for your replacement screen today. Nearly all laptops will have the model number located on the base. It can be a combination of letters and numbers. Look for the brand name and then a series of numbers/letters that follow. Have a question? Still can\\\'t find the model number? Then contact us today on 02920 766039.  <br />\r\n</span></p>\r\n</div>', 1, '2013-11-24 16:38:12');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_rightpanel_images`
--

CREATE TABLE `tbl_rightpanel_images` (
  `id` bigint(20) NOT NULL,
  `page` varchar(255) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `status` tinyint(1) DEFAULT '1',
  `created_on` datetime DEFAULT NULL,
  `modified_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_rightpanel_images`
--

INSERT INTO `tbl_rightpanel_images` (`id`, `page`, `title`, `image`, `status`, `created_on`, `modified_on`) VALUES
(1, 'Home Page', 'Home Page Contact', 'home_contact393112016171958.gif', 1, '2016-11-03 00:00:00', '2016-11-03 23:19:58'),
(14, 'Any', 'We are local', 'we_are_local.jpg', 1, '2011-11-21 00:00:00', '2013-04-23 23:34:08'),
(2, 'Any', 'Call us today', 'call_us_today.jpg', 1, '2011-11-21 00:00:00', '2011-11-21 23:32:15'),
(3, 'Any', 'Fast repairs', 'fast_repairs.jpg', 1, '2011-11-21 00:00:00', '2013-04-23 23:36:00'),
(12, 'Any', 'No hidden costs', 'no_hidden_costs.jpg', 1, '2011-11-21 00:00:00', '2013-04-23 23:41:48'),
(13, 'Any', 'Book your repair', 'book_your_repair.jpg', 1, '2011-11-21 00:00:00', '2013-04-23 23:43:33'),
(4, 'Any', 'Courtesy laptops available', 'courtesy_laptops.jpg', 1, '2011-11-21 00:00:00', '2013-04-23 23:36:47'),
(10, 'Any', 'No vat', 'no_vat.jpg', 1, '2011-11-21 00:00:00', '2013-04-23 23:40:29'),
(11, 'Any', 'Sell your laptop', 'sell_your_laptop.jpg', 1, '2011-11-21 00:00:00', '2013-04-23 23:41:10'),
(5, 'Any', 'Free collection', 'free_collection.jpg', 1, '2011-11-21 00:00:00', '2013-04-23 23:37:25'),
(6, 'Any', 'No jargon', 'no_jargon.jpg', 1, '2011-11-21 00:00:00', '2013-04-23 23:37:56'),
(7, 'Any', 'Fixed price repairs', 'fixed_price_repairs.jpg', 1, '2011-11-21 00:00:00', '2013-04-23 23:38:45'),
(8, 'Any', '90 day warranty', '90_day_warranty.jpg', 1, '2011-11-21 00:00:00', '2013-04-23 23:39:15'),
(9, 'Any', 'No fix no fee', 'no_fix_no_fee.jpg', 1, '2011-11-21 00:00:00', '2013-04-23 23:39:59'),
(15, 'Any', 'Credit cards', 'credit_cards.jpg', 1, '2011-11-21 00:00:00', '2013-04-23 23:44:43'),
(16, 'Any', 'Laptop repair', 'laptop_repair.jpg', 1, '2011-11-21 00:00:00', '2013-04-23 23:45:09'),
(17, 'Any', 'Laptop screen', 'laptop_screen.jpg', 1, '2011-11-21 00:00:00', '2013-04-23 23:46:15');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `content`
--
ALTER TABLE `content`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_admin_users`
--
ALTER TABLE `tbl_admin_users`
  ADD PRIMARY KEY (`userId`);

--
-- Indexes for table `tbl_appointments`
--
ALTER TABLE `tbl_appointments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_banner`
--
ALTER TABLE `tbl_banner`
  ADD PRIMARY KEY (`ban_id`);

--
-- Indexes for table `tbl_emailpref`
--
ALTER TABLE `tbl_emailpref`
  ADD PRIMARY KEY (`emailid`);

--
-- Indexes for table `tbl_feedback`
--
ALTER TABLE `tbl_feedback`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_home_banner`
--
ALTER TABLE `tbl_home_banner`
  ADD PRIMARY KEY (`bnr_id`);

--
-- Indexes for table `tbl_laptop_appointments`
--
ALTER TABLE `tbl_laptop_appointments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_meta_pages`
--
ALTER TABLE `tbl_meta_pages`
  ADD PRIMARY KEY (`mtp_id`);

--
-- Indexes for table `tbl_pages`
--
ALTER TABLE `tbl_pages`
  ADD PRIMARY KEY (`pageId`);

--
-- Indexes for table `tbl_rightpanel_images`
--
ALTER TABLE `tbl_rightpanel_images`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `content`
--
ALTER TABLE `content`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_admin_users`
--
ALTER TABLE `tbl_admin_users`
  MODIFY `userId` bigint(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_appointments`
--
ALTER TABLE `tbl_appointments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=113;

--
-- AUTO_INCREMENT for table `tbl_emailpref`
--
ALTER TABLE `tbl_emailpref`
  MODIFY `emailid` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_feedback`
--
ALTER TABLE `tbl_feedback`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tbl_home_banner`
--
ALTER TABLE `tbl_home_banner`
  MODIFY `bnr_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=94;

--
-- AUTO_INCREMENT for table `tbl_laptop_appointments`
--
ALTER TABLE `tbl_laptop_appointments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=378;

--
-- AUTO_INCREMENT for table `tbl_meta_pages`
--
ALTER TABLE `tbl_meta_pages`
  MODIFY `mtp_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=104;

--
-- AUTO_INCREMENT for table `tbl_rightpanel_images`
--
ALTER TABLE `tbl_rightpanel_images`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
