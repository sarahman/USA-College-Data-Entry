SET FOREIGN_KEY_CHECKS=0;
SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


CREATE TABLE IF NOT EXISTS `colleges` (
  `college_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `city` varchar(50) DEFAULT NULL,
  `state` varchar(50) DEFAULT NULL,
  `college_type` varchar(100) DEFAULT NULL,
  `school_logo_link` varchar(255) DEFAULT NULL,
  `athletic_logo_link` varchar(255) DEFAULT NULL,
  `division` varchar(25) DEFAULT NULL,
  `weather_rating` tinyint(4) DEFAULT NULL,
  `in_state_tution_fee` float DEFAULT NULL,
  `out_state_tution_fee` float DEFAULT NULL,
  `student_enrollment` smallint(6) DEFAULT NULL,
  PRIMARY KEY (`college_id`),
  KEY `college_type` (`college_type`),
  KEY `weather_rating` (`weather_rating`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `college_types` (
  `college_type` varchar(100) NOT NULL,
  PRIMARY KEY (`college_type`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `data_storage` (
  `CollegeName` varchar(78) DEFAULT NULL,
  `SportsOffered` varchar(285) DEFAULT NULL,
  `Majors` varchar(99) DEFAULT NULL,
  `SchoolLogo` varchar(76) DEFAULT NULL,
  `AthleticLogo` varchar(109) DEFAULT NULL,
  `State` varchar(17) DEFAULT NULL,
  `City` varchar(16) DEFAULT NULL,
  `Division` varchar(9) DEFAULT NULL,
  `SchoolEnrollment` varchar(17) DEFAULT NULL,
  `Weather` varchar(7) DEFAULT NULL,
  `Tuition` varchar(101) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `divisions` (
  `division` varchar(25) NOT NULL,
  PRIMARY KEY (`division`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `majors` (
  `major_id` int(11) NOT NULL AUTO_INCREMENT,
  `college_id` int(11) NOT NULL,
  `subject_name` varchar(100) NOT NULL,
  PRIMARY KEY (`major_id`),
  KEY `college_id` (`college_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `sports_names` (
  `sport_name` varchar(100) NOT NULL,
  PRIMARY KEY (`sport_name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `sports_offers` (
  `sport_offer_id` int(11) NOT NULL AUTO_INCREMENT,
  `college_id` int(11) NOT NULL,
  `sport_name` varchar(100) NOT NULL,
  PRIMARY KEY (`sport_offer_id`),
  KEY `college_id` (`college_id`,`sport_name`),
  KEY `sport_name` (`sport_name`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `student_enrollments` (
  `college_id` int(11) NOT NULL,
  `semester` enum('Summer','Fall','Winter','Spring') DEFAULT NULL,
  `year` int(11) DEFAULT NULL,
  `no_of_students` mediumint(9) DEFAULT NULL,
  KEY `college_id` (`college_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `weather_ratings` (
  `weather_rating` tinyint(4) NOT NULL AUTO_INCREMENT,
  `type` varchar(25) NOT NULL,
  PRIMARY KEY (`weather_rating`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;


ALTER TABLE `colleges`
  ADD CONSTRAINT `colleges_ibfk_1` FOREIGN KEY (`college_type`) REFERENCES `college_types` (`college_type`) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE `majors`
  ADD CONSTRAINT `majors_ibfk_1` FOREIGN KEY (`college_id`) REFERENCES `colleges` (`college_id`) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE `sports_offers`
  ADD CONSTRAINT `sports_offers_ibfk_1` FOREIGN KEY (`college_id`) REFERENCES `colleges` (`college_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `sports_offers_ibfk_2` FOREIGN KEY (`sport_name`) REFERENCES `sports_names` (`sport_name`) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE `student_enrollments`
  ADD CONSTRAINT `student_enrollments_ibfk_1` FOREIGN KEY (`college_id`) REFERENCES `colleges` (`college_id`) ON DELETE CASCADE ON UPDATE CASCADE;


SET FOREIGN_KEY_CHECKS=1;