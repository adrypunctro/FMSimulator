-- phpMyAdmin SQL Dump
-- version 4.2.7.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: May 04, 2015 at 11:20 PM
-- Server version: 5.6.20
-- PHP Version: 5.5.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `manager.com`
--

-- --------------------------------------------------------

--
-- Table structure for table `fm_competitions`
--

CREATE TABLE IF NOT EXISTS `fm_competitions` (
`competition_id` int(10) unsigned NOT NULL,
  `competition_type_id` tinyint(3) unsigned NOT NULL,
  `competition_rel_id` int(10) unsigned DEFAULT NULL,
  `country_id` int(10) unsigned NOT NULL,
  `level` tinyint(3) unsigned NOT NULL,
  `group` tinyint(3) unsigned NOT NULL,
  `name` varchar(100) NOT NULL,
  `promotes` tinyint(3) unsigned NOT NULL,
  `demotes` tinyint(3) unsigned NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `fm_competitions`
--

INSERT INTO `fm_competitions` (`competition_id`, `competition_type_id`, `competition_rel_id`, `country_id`, `level`, `group`, `name`, `promotes`, `demotes`) VALUES
(1, 2, NULL, 1, 1, 1, 'Liga 1', 0, 4);

-- --------------------------------------------------------

--
-- Table structure for table `fm_competitions_rounds`
--

CREATE TABLE IF NOT EXISTS `fm_competitions_rounds` (
`round_id` int(10) unsigned NOT NULL,
  `competition_id` int(10) unsigned NOT NULL,
  `order` tinyint(3) unsigned NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `fm_competitions_rounds`
--

INSERT INTO `fm_competitions_rounds` (`round_id`, `competition_id`, `order`, `name`) VALUES
(1, 1, 1, 'Etapa 1'),
(2, 1, 2, 'Etapa 2');

-- --------------------------------------------------------

--
-- Table structure for table `fm_competitions_table`
--

CREATE TABLE IF NOT EXISTS `fm_competitions_table` (
  `competition_id` int(10) unsigned NOT NULL,
  `team_id` int(10) unsigned NOT NULL,
  `pld` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `won` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `drn` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `lst` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `for` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `ag` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `pts` tinyint(4) NOT NULL DEFAULT '0',
  `pos` tinyint(3) unsigned NOT NULL,
  `old_pos` tinyint(3) unsigned NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `fm_competitions_table`
--

INSERT INTO `fm_competitions_table` (`competition_id`, `team_id`, `pld`, `won`, `drn`, `lst`, `for`, `ag`, `pts`, `pos`, `old_pos`) VALUES
(1, 1, 1, 1, 0, 0, 2, 1, 3, 1, 1),
(1, 2, 1, 0, 0, 1, 1, 2, 0, 2, 2);

-- --------------------------------------------------------

--
-- Table structure for table `fm_competition_types`
--

CREATE TABLE IF NOT EXISTS `fm_competition_types` (
`competition_type_id` tinyint(3) unsigned NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `fm_competition_types`
--

INSERT INTO `fm_competition_types` (`competition_type_id`, `name`) VALUES
(1, 'Non Competition'),
(2, 'League'),
(3, 'Cup'),
(4, 'Continental'),
(5, 'International');

-- --------------------------------------------------------

--
-- Table structure for table `fm_countries`
--

CREATE TABLE IF NOT EXISTS `fm_countries` (
`country_id` int(10) unsigned NOT NULL,
  `name` varchar(80) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `fm_countries`
--

INSERT INTO `fm_countries` (`country_id`, `name`) VALUES
(1, 'Romania');

-- --------------------------------------------------------

--
-- Table structure for table `fm_fix_scheme`
--

CREATE TABLE IF NOT EXISTS `fm_fix_scheme` (
`day` int(10) unsigned NOT NULL,
  `competition` enum('LE','CL','CU','BR','SC','SE') DEFAULT NULL COMMENT 'LE-Liga,CL-Internationale,CU-Cupa,BR-barag,SC-supercupa,SE-supercupa europei'
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=71 ;

--
-- Dumping data for table `fm_fix_scheme`
--

INSERT INTO `fm_fix_scheme` (`day`, `competition`) VALUES
(1, 'LE'),
(2, 'CU'),
(3, 'LE'),
(4, 'CL'),
(5, 'LE'),
(6, 'CL'),
(7, 'LE'),
(8, 'LE'),
(9, 'CU'),
(10, 'LE'),
(11, 'CL'),
(12, 'LE'),
(13, 'CL'),
(14, 'LE'),
(15, 'LE'),
(16, 'CU'),
(17, 'LE'),
(18, 'CL'),
(19, 'LE'),
(20, 'CL'),
(21, 'LE'),
(22, 'LE'),
(23, 'CU'),
(24, 'LE'),
(25, 'CL'),
(26, 'LE'),
(27, 'CL'),
(28, 'LE'),
(29, 'LE'),
(30, 'CU'),
(31, 'LE'),
(32, 'CL'),
(33, 'LE'),
(34, 'CL'),
(35, 'LE'),
(36, 'LE'),
(37, 'CL'),
(38, 'LE'),
(39, 'CL'),
(40, NULL),
(41, NULL),
(42, NULL),
(43, 'LE'),
(44, 'CU'),
(45, 'LE'),
(46, 'CL'),
(47, 'LE'),
(48, 'CL'),
(49, 'LE'),
(50, 'LE'),
(51, 'CU'),
(52, 'LE'),
(53, 'CL'),
(54, 'LE'),
(55, 'CL'),
(56, 'LE'),
(57, 'LE'),
(58, 'CU'),
(59, 'LE'),
(60, 'CL'),
(61, 'LE'),
(62, 'CL'),
(63, 'LE'),
(64, 'CU'),
(65, 'CL'),
(66, 'BR'),
(67, 'BR'),
(68, NULL),
(69, 'SC'),
(70, 'SE');

-- --------------------------------------------------------

--
-- Table structure for table `fm_matches`
--

CREATE TABLE IF NOT EXISTS `fm_matches` (
`match_id` int(10) unsigned NOT NULL,
  `round_id` int(10) unsigned NOT NULL,
  `team_id1` int(10) unsigned NOT NULL,
  `team_id2` int(10) unsigned NOT NULL,
  `date` date NOT NULL,
  `hour` char(5) NOT NULL DEFAULT '00:00',
  `home_goals` tinyint(3) unsigned DEFAULT NULL,
  `away_goals` tinyint(3) unsigned DEFAULT NULL,
  `home_goals_et` tinyint(3) unsigned DEFAULT NULL,
  `away_goals_et` tinyint(3) unsigned DEFAULT NULL,
  `home_goals_pen` tinyint(3) unsigned DEFAULT NULL,
  `away_goals_pen` tinyint(3) unsigned DEFAULT NULL,
  `supporters` int(10) unsigned DEFAULT NULL,
  `weather` enum('dry','snow','rain') NOT NULL DEFAULT 'dry',
  `temperature` tinyint(4) NOT NULL DEFAULT '13',
  `tv` enum('1','0') NOT NULL DEFAULT '0'
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `fm_matches`
--

INSERT INTO `fm_matches` (`match_id`, `round_id`, `team_id1`, `team_id2`, `date`, `hour`, `home_goals`, `away_goals`, `home_goals_et`, `away_goals_et`, `home_goals_pen`, `away_goals_pen`, `supporters`, `weather`, `temperature`, `tv`) VALUES
(1, 1, 1, 2, '2015-03-29', '14:03', 2, 1, NULL, NULL, NULL, NULL, NULL, 'dry', 13, '0'),
(2, 2, 2, 1, '2015-04-02', '18:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'dry', 13, '1');

-- --------------------------------------------------------

--
-- Table structure for table `fm_matches_live`
--

CREATE TABLE IF NOT EXISTS `fm_matches_live` (
  `match_id` int(10) unsigned NOT NULL,
  `timeline` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `fm_players`
--

CREATE TABLE IF NOT EXISTS `fm_players` (
`player_id` int(10) unsigned NOT NULL,
  `injury_id` int(10) unsigned DEFAULT NULL,
  `name` varchar(120) NOT NULL,
  `born` date NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=17 ;

--
-- Dumping data for table `fm_players`
--

INSERT INTO `fm_players` (`player_id`, `injury_id`, `name`, `born`) VALUES
(1, NULL, 'Jucator 1', '1989-01-03'),
(2, NULL, 'Jucator 2', '1990-01-03'),
(3, NULL, 'Jucator 3', '1991-01-03'),
(4, NULL, 'Jucator 4', '1992-01-03'),
(5, NULL, 'Jucator 5', '1998-01-28'),
(6, NULL, 'Jucator 6', '1998-01-28'),
(7, NULL, 'Jucator 7', '1998-01-28'),
(8, NULL, 'Jucator 8', '1998-01-28'),
(9, NULL, 'Jucator 9', '1998-01-28'),
(10, NULL, 'Jucator 10', '1998-01-28'),
(11, NULL, 'Jucator 11', '1998-01-28'),
(12, NULL, 'Jucator 12', '1998-01-28'),
(13, NULL, 'Jucator 13', '1998-01-28'),
(14, NULL, 'Jucator 14', '1998-01-28'),
(15, NULL, 'Jucator 15', '1998-01-28'),
(16, NULL, 'Jucator 16', '1998-01-28');

-- --------------------------------------------------------

--
-- Table structure for table `fm_players_contracts`
--

CREATE TABLE IF NOT EXISTS `fm_players_contracts` (
`contract_id` int(10) unsigned NOT NULL,
  `team_id` int(10) unsigned NOT NULL,
  `player_id` int(10) unsigned NOT NULL,
  `date_start` date NOT NULL,
  `date_end` date NOT NULL,
  `salary` int(10) unsigned NOT NULL DEFAULT '0',
  `type` enum('transfer','loan') NOT NULL DEFAULT 'transfer'
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=17 ;

--
-- Dumping data for table `fm_players_contracts`
--

INSERT INTO `fm_players_contracts` (`contract_id`, `team_id`, `player_id`, `date_start`, `date_end`, `salary`, `type`) VALUES
(1, 1, 1, '2015-03-01', '2016-03-01', 100000, 'transfer'),
(2, 1, 2, '2015-03-01', '2016-03-01', 100000, 'transfer'),
(3, 1, 3, '2015-03-01', '2015-11-01', 5000, 'loan'),
(4, 1, 4, '2015-03-01', '2017-03-01', 75000, 'transfer'),
(5, 1, 5, '2015-03-01', '2016-03-01', 1000, 'transfer'),
(6, 1, 6, '2015-03-01', '2016-03-01', 1000, 'transfer'),
(7, 1, 7, '2015-03-01', '2016-03-01', 1000, 'transfer'),
(8, 1, 8, '2015-03-01', '2016-03-01', 1000, 'transfer'),
(9, 1, 9, '2015-03-01', '2016-03-01', 1000, 'transfer'),
(10, 1, 10, '2015-03-01', '2016-03-01', 1000, 'transfer'),
(11, 1, 11, '2015-03-01', '2016-03-01', 1000, 'transfer'),
(12, 2, 12, '2015-03-01', '2016-03-01', 1000, 'transfer'),
(13, 2, 13, '2015-03-01', '2016-03-01', 1000, 'transfer'),
(14, 2, 14, '2015-03-01', '2016-03-01', 1000, 'transfer'),
(15, 2, 15, '2015-03-01', '2016-03-01', 1000, 'transfer'),
(16, 2, 16, '2015-03-01', '2016-03-01', 1000, 'transfer');

-- --------------------------------------------------------

--
-- Table structure for table `fm_tactics`
--

CREATE TABLE IF NOT EXISTS `fm_tactics` (
`tactic_id` int(10) unsigned NOT NULL,
  `name` varchar(30) NOT NULL,
  `category` int(11) NOT NULL,
  `GK` tinyint(3) unsigned NOT NULL,
  `D` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `DM` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `M` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `AM` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `F` tinyint(3) unsigned NOT NULL DEFAULT '0'
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `fm_tactics`
--

INSERT INTO `fm_tactics` (`tactic_id`, `name`, `category`, `GK`, `D`, `DM`, `M`, `AM`, `F`) VALUES
(1, '4-4-2', 0, 1, 4, 0, 4, 0, 2);

-- --------------------------------------------------------

--
-- Table structure for table `fm_tactics_pos_no`
--

CREATE TABLE IF NOT EXISTS `fm_tactics_pos_no` (
`pos_no` tinyint(3) unsigned NOT NULL,
  `name` varchar(5) NOT NULL,
  `line` tinyint(3) unsigned NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=34 ;

--
-- Dumping data for table `fm_tactics_pos_no`
--

INSERT INTO `fm_tactics_pos_no` (`pos_no`, `name`, `line`) VALUES
(1, 'GK', 1),
(2, 'DR', 2),
(3, 'DRC', 2),
(4, 'DC', 2),
(5, 'DLC', 2),
(6, 'DL', 2),
(7, 'DMR', 3),
(8, 'DMRC', 3),
(9, 'DMC', 3),
(10, 'DMLC', 3),
(11, 'DML', 3),
(12, 'MR', 4),
(13, 'MRC', 4),
(14, 'MC', 4),
(15, 'MLC', 4),
(16, 'ML', 4),
(17, 'AMR', 5),
(18, 'AMRC', 5),
(19, 'AMC', 5),
(20, 'AMLC', 5),
(21, 'AML', 5),
(22, 'FR', 6),
(23, 'FRC', 6),
(24, 'FC', 6),
(25, 'FLC', 6),
(26, 'FL', 6),
(27, 'S1', 7),
(28, 'S2', 7),
(29, 'S3', 7),
(30, 'S4', 7),
(31, 'S5', 8),
(32, 'S6', 7),
(33, 'S7', 7);

-- --------------------------------------------------------

--
-- Table structure for table `fm_teams`
--

CREATE TABLE IF NOT EXISTS `fm_teams` (
`team_id` int(10) unsigned NOT NULL,
  `user_id` int(10) unsigned DEFAULT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `fm_teams`
--

INSERT INTO `fm_teams` (`team_id`, `user_id`, `name`) VALUES
(1, 1, 'Echipa 1'),
(2, 2, 'Echipa 2');

-- --------------------------------------------------------

--
-- Table structure for table `fm_teams_tactics`
--

CREATE TABLE IF NOT EXISTS `fm_teams_tactics` (
`ttactic_id` int(10) unsigned NOT NULL,
  `team_id` int(10) unsigned NOT NULL,
  `tactic_id` int(10) unsigned NOT NULL,
  `mentality` int(11) DEFAULT NULL,
  `creative` int(11) DEFAULT NULL,
  `passtyle` int(11) DEFAULT NULL,
  `tempo` int(11) DEFAULT NULL,
  `width` int(11) DEFAULT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `fm_teams_tactics`
--

INSERT INTO `fm_teams_tactics` (`ttactic_id`, `team_id`, `tactic_id`, `mentality`, `creative`, `passtyle`, `tempo`, `width`) VALUES
(1, 1, 1, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `fm_teams_tactics_assign`
--

CREATE TABLE IF NOT EXISTS `fm_teams_tactics_assign` (
  `ttactic_id` int(10) unsigned NOT NULL,
  `pos_no` tinyint(3) unsigned NOT NULL,
  `player_id` int(10) unsigned DEFAULT NULL,
  `number` tinyint(2) NOT NULL,
  `mentality` enum('off','def') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `fm_teams_tactics_assign`
--

INSERT INTO `fm_teams_tactics_assign` (`ttactic_id`, `pos_no`, `player_id`, `number`, `mentality`) VALUES
(1, 1, 1, 1, NULL),
(1, 2, 2, 2, NULL),
(1, 3, 3, 3, NULL),
(1, 5, 4, 4, NULL),
(1, 6, 5, 5, NULL),
(1, 12, 6, 6, NULL),
(1, 13, 7, 7, NULL),
(1, 15, 8, 8, NULL),
(1, 16, 9, 9, NULL),
(1, 23, 10, 10, NULL),
(1, 25, 11, 11, NULL),
(1, 27, NULL, 0, NULL),
(1, 28, NULL, 0, NULL),
(1, 29, NULL, 0, NULL),
(1, 30, NULL, 0, NULL),
(1, 31, NULL, 0, NULL),
(1, 32, NULL, 0, NULL),
(1, 33, NULL, 0, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `fm_users`
--

CREATE TABLE IF NOT EXISTS `fm_users` (
`user_id` int(10) unsigned NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(32) NOT NULL,
  `fullname` varchar(100) CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `fm_users`
--

INSERT INTO `fm_users` (`user_id`, `username`, `password`, `fullname`) VALUES
(1, 'adrypunctro', '27d7000dfb5a44c6cb628f826bcd1fc1', 'Adrian Simionescu'),
(2, 'simi', '15dff0aeb6565adc37794c865a98beaa', 'Mădălin Simionescu');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `fm_competitions`
--
ALTER TABLE `fm_competitions`
 ADD PRIMARY KEY (`competition_id`), ADD KEY `country_id` (`country_id`), ADD KEY `competition_type_id` (`competition_type_id`);

--
-- Indexes for table `fm_competitions_rounds`
--
ALTER TABLE `fm_competitions_rounds`
 ADD PRIMARY KEY (`round_id`), ADD KEY `competition_id` (`competition_id`);

--
-- Indexes for table `fm_competitions_table`
--
ALTER TABLE `fm_competitions_table`
 ADD PRIMARY KEY (`competition_id`,`team_id`), ADD KEY `team_id` (`team_id`);

--
-- Indexes for table `fm_competition_types`
--
ALTER TABLE `fm_competition_types`
 ADD PRIMARY KEY (`competition_type_id`);

--
-- Indexes for table `fm_countries`
--
ALTER TABLE `fm_countries`
 ADD PRIMARY KEY (`country_id`);

--
-- Indexes for table `fm_fix_scheme`
--
ALTER TABLE `fm_fix_scheme`
 ADD PRIMARY KEY (`day`);

--
-- Indexes for table `fm_matches`
--
ALTER TABLE `fm_matches`
 ADD PRIMARY KEY (`match_id`), ADD KEY `round_id` (`round_id`), ADD KEY `team_id1` (`team_id1`), ADD KEY `team_id2` (`team_id2`);

--
-- Indexes for table `fm_matches_live`
--
ALTER TABLE `fm_matches_live`
 ADD UNIQUE KEY `match_id` (`match_id`), ADD KEY `match_id_2` (`match_id`);

--
-- Indexes for table `fm_players`
--
ALTER TABLE `fm_players`
 ADD PRIMARY KEY (`player_id`);

--
-- Indexes for table `fm_players_contracts`
--
ALTER TABLE `fm_players_contracts`
 ADD PRIMARY KEY (`contract_id`), ADD KEY `team_id` (`team_id`), ADD KEY `player_id` (`player_id`);

--
-- Indexes for table `fm_tactics`
--
ALTER TABLE `fm_tactics`
 ADD PRIMARY KEY (`tactic_id`);

--
-- Indexes for table `fm_tactics_pos_no`
--
ALTER TABLE `fm_tactics_pos_no`
 ADD PRIMARY KEY (`pos_no`);

--
-- Indexes for table `fm_teams`
--
ALTER TABLE `fm_teams`
 ADD PRIMARY KEY (`team_id`), ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `fm_teams_tactics`
--
ALTER TABLE `fm_teams_tactics`
 ADD PRIMARY KEY (`ttactic_id`), ADD UNIQUE KEY `team_id` (`team_id`,`tactic_id`), ADD KEY `tactic_id` (`tactic_id`);

--
-- Indexes for table `fm_teams_tactics_assign`
--
ALTER TABLE `fm_teams_tactics_assign`
 ADD PRIMARY KEY (`ttactic_id`,`pos_no`), ADD UNIQUE KEY `ttactic_id` (`ttactic_id`,`pos_no`,`number`), ADD KEY `player_id` (`player_id`), ADD KEY `pos_no` (`pos_no`);

--
-- Indexes for table `fm_users`
--
ALTER TABLE `fm_users`
 ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `fm_competitions`
--
ALTER TABLE `fm_competitions`
MODIFY `competition_id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `fm_competitions_rounds`
--
ALTER TABLE `fm_competitions_rounds`
MODIFY `round_id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `fm_competition_types`
--
ALTER TABLE `fm_competition_types`
MODIFY `competition_type_id` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `fm_countries`
--
ALTER TABLE `fm_countries`
MODIFY `country_id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `fm_fix_scheme`
--
ALTER TABLE `fm_fix_scheme`
MODIFY `day` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=71;
--
-- AUTO_INCREMENT for table `fm_matches`
--
ALTER TABLE `fm_matches`
MODIFY `match_id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `fm_players`
--
ALTER TABLE `fm_players`
MODIFY `player_id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT for table `fm_players_contracts`
--
ALTER TABLE `fm_players_contracts`
MODIFY `contract_id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT for table `fm_tactics`
--
ALTER TABLE `fm_tactics`
MODIFY `tactic_id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `fm_tactics_pos_no`
--
ALTER TABLE `fm_tactics_pos_no`
MODIFY `pos_no` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=34;
--
-- AUTO_INCREMENT for table `fm_teams`
--
ALTER TABLE `fm_teams`
MODIFY `team_id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `fm_teams_tactics`
--
ALTER TABLE `fm_teams_tactics`
MODIFY `ttactic_id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `fm_users`
--
ALTER TABLE `fm_users`
MODIFY `user_id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `fm_competitions`
--
ALTER TABLE `fm_competitions`
ADD CONSTRAINT `fm_competitions_ibfk_1` FOREIGN KEY (`country_id`) REFERENCES `fm_countries` (`country_id`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `fm_competitions_ibfk_2` FOREIGN KEY (`competition_type_id`) REFERENCES `fm_competition_types` (`competition_type_id`);

--
-- Constraints for table `fm_competitions_rounds`
--
ALTER TABLE `fm_competitions_rounds`
ADD CONSTRAINT `fm_competitions_rounds_ibfk_1` FOREIGN KEY (`competition_id`) REFERENCES `fm_competitions` (`competition_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `fm_competitions_table`
--
ALTER TABLE `fm_competitions_table`
ADD CONSTRAINT `fm_competitions_table_ibfk_1` FOREIGN KEY (`competition_id`) REFERENCES `fm_competitions` (`competition_id`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `fm_competitions_table_ibfk_2` FOREIGN KEY (`team_id`) REFERENCES `fm_teams` (`team_id`);

--
-- Constraints for table `fm_matches`
--
ALTER TABLE `fm_matches`
ADD CONSTRAINT `fm_matches_ibfk_1` FOREIGN KEY (`round_id`) REFERENCES `fm_competitions_rounds` (`round_id`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `fm_matches_ibfk_2` FOREIGN KEY (`team_id1`) REFERENCES `fm_teams` (`team_id`),
ADD CONSTRAINT `fm_matches_ibfk_3` FOREIGN KEY (`team_id2`) REFERENCES `fm_teams` (`team_id`);

--
-- Constraints for table `fm_matches_live`
--
ALTER TABLE `fm_matches_live`
ADD CONSTRAINT `fm_matches_live_ibfk_1` FOREIGN KEY (`match_id`) REFERENCES `fm_matches` (`match_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `fm_players_contracts`
--
ALTER TABLE `fm_players_contracts`
ADD CONSTRAINT `fm_players_contracts_ibfk_1` FOREIGN KEY (`team_id`) REFERENCES `fm_teams` (`team_id`),
ADD CONSTRAINT `fm_players_contracts_ibfk_2` FOREIGN KEY (`player_id`) REFERENCES `fm_players` (`player_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `fm_teams`
--
ALTER TABLE `fm_teams`
ADD CONSTRAINT `fm_teams_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `fm_users` (`user_id`) ON DELETE SET NULL ON UPDATE SET NULL;

--
-- Constraints for table `fm_teams_tactics`
--
ALTER TABLE `fm_teams_tactics`
ADD CONSTRAINT `fm_teams_tactics_ibfk_1` FOREIGN KEY (`team_id`) REFERENCES `fm_teams` (`team_id`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `fm_teams_tactics_ibfk_2` FOREIGN KEY (`tactic_id`) REFERENCES `fm_tactics` (`tactic_id`);

--
-- Constraints for table `fm_teams_tactics_assign`
--
ALTER TABLE `fm_teams_tactics_assign`
ADD CONSTRAINT `fm_teams_tactics_assign_ibfk_1` FOREIGN KEY (`ttactic_id`) REFERENCES `fm_teams_tactics` (`ttactic_id`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `fm_teams_tactics_assign_ibfk_2` FOREIGN KEY (`player_id`) REFERENCES `fm_players` (`player_id`) ON DELETE SET NULL ON UPDATE SET NULL,
ADD CONSTRAINT `fm_teams_tactics_assign_ibfk_3` FOREIGN KEY (`pos_no`) REFERENCES `fm_tactics_pos_no` (`pos_no`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
