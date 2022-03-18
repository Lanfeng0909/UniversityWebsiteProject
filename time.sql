SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


CREATE TABLE IF NOT EXISTS `time` (
  `time_id` int(11) NOT NULL AUTO_INCREMENT,
  `weektime` varchar(32) NOT NULL,
  PRIMARY KEY (`time_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

INSERT INTO `time` (`time_id`, `weektime`) VALUES
(1, '9:00-11:00 Mon'),
(2, '10:00-12:00 Mon'),
(3, '11:00-13:00 Mon'),
(4, '12:00-14:00 Mon'),
(5, '13:00-15:00 Mon'),
(6, '14:00-16:00 Mon'),
(7, '15:00-17:00 Mon'),
(8, '16:00-18:00 Mon'),
(9, '9:00-11:00 Tue'),
(10, '10:00-12:00 Tue'),
(11, '11:00-13:00 Tue'),
(12, '12:00-14:00 Tue'),
(13, '13:00-15:00 Tue'),
(14, '14:00-16:00 Tue'),
(15, '15:00-17:00 Tue'),
(16, '12:00-14:00 Wed'),
(17, '15:00-17:00 Wed'),
(18, '11:00-13:00 Wed'),
(19, '9:00-11:00 Thu'),
(20, '9:00-11:00 Fri'),
(21, '16:00-18:00 Thu'),
(22, '16:00-18:00 Fri');