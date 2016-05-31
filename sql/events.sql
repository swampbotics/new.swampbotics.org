-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: May 30, 2016 at 09:59 PM
-- Server version: 5.5.44-0ubuntu0.14.04.1
-- PHP Version: 5.5.9-1ubuntu4.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `swampbotics`
--

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE IF NOT EXISTS `events` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `game` text NOT NULL,
  `name` text NOT NULL,
  `tagline` text NOT NULL,
  `date` date NOT NULL,
  `robots` text NOT NULL,
  `rank` text NOT NULL,
  `content` text NOT NULL,
  `description` text NOT NULL,
  `folder` text NOT NULL,
  `release_date` date NOT NULL,
  `year` int(4) NOT NULL,
  `slug` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`id`, `game`, `name`, `tagline`, `date`, `robots`, `rank`, `content`, `description`, `folder`, `release_date`, `year`, `slug`) VALUES
(1, 'Nothing But Net', 'Lambert Invitational', 'OUR FIRST COMPETITION OF THE SEASON', '2015-10-10', '2105A', '1st', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin rutrum sed lacus sit amet egestas. Praesent at mollis ex. Sed suscipit elit in eleifend finibus. Vestibulum quis neque cursus, tincidunt nunc sit amet, mattis ante. Donec id euismod diam. Morbi finibus ex at augue convallis malesuada. Aliquam at nulla vel justo suscipit vestibulum vitae ultrices nibh.\r\n\r\nMaecenas imperdiet elementum egestas. Proin congue neque eu ligula luctus dictum. Nullam egestas nulla quis ipsum ullamcorper, sit amet varius velit fermentum. Aliquam vestibulum turpis ut odio tincidunt finibus. Curabitur vulputate tincidunt sem a euismod. Nulla dapibus orci at fringilla varius. Etiam ut velit felis.\r\n\r\nInteger turpis elit, venenatis et leo eget, ultricies mollis quam. Donec id euismod urna. Nunc ac leo scelerisque, rutrum purus vitae, hendrerit ex. Sed porttitor enim vel neque volutpat, ut euismod velit bibendum. Morbi mi nisi, lobortis nec sagittis aliquet, lobortis a neque. Mauris eu dignissim libero, vel mollis augue. Aliquam vestibulum sed sapien pellentesque maximus. Vivamus ut facilisis nisi, quis vehicula urna. Aenean eu laoreet magna. Cras ac fringilla nisl, a euismod erat. Vivamus vulputate justo eget mauris sagittis, ac sollicitudin felis porttitor. Vestibulum tincidunt est nec posuere mattis. Morbi varius id ligula non porttitor. In metus nisl, tempor ac dui ut, convallis posuere tellus.', 'Swampbotics 2105A takes home the Tournament Champion trophy, in alliance with 675E (RoboDragons) and 6297B.', 'lambert', '2015-10-12', 2015, 'lambert'),
(2, 'Nothing But Net', 'Coffee Competition', 'FIRST COMPETITION WITH ALL OF OUR ROBOTS', '2015-11-07', '2105B, 2105C, 2105A', '1st, 5th, 6th', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin rutrum sed lacus sit amet egestas. Praesent at mollis ex. Sed suscipit elit in eleifend finibus. Vestibulum quis neque cursus, tincidunt nunc sit amet, mattis ante. Donec id euismod diam. Morbi finibus ex at augue convallis malesuada. Aliquam at nulla vel justo suscipit vestibulum vitae ultrices nibh.\r\n\r\nMaecenas imperdiet elementum egestas. Proin congue neque eu ligula luctus dictum. Nullam egestas nulla quis ipsum ullamcorper, sit amet varius velit fermentum. Aliquam vestibulum turpis ut odio tincidunt finibus. Curabitur vulputate tincidunt sem a euismod. Nulla dapibus orci at fringilla varius. Etiam ut velit felis.\r\n\r\nInteger turpis elit, venenatis et leo eget, ultricies mollis quam. Donec id euismod urna. Nunc ac leo scelerisque, rutrum purus vitae, hendrerit ex. Sed porttitor enim vel neque volutpat, ut euismod velit bibendum. Morbi mi nisi, lobortis nec sagittis aliquet, lobortis a neque. Mauris eu dignissim libero, vel mollis augue. Aliquam vestibulum sed sapien pellentesque maximus. Vivamus ut facilisis nisi, quis vehicula urna. Aenean eu laoreet magna. Cras ac fringilla nisl, a euismod erat. Vivamus vulputate justo eget mauris sagittis, ac sollicitudin felis porttitor. Vestibulum tincidunt est nec posuere mattis. Morbi varius id ligula non porttitor. In metus nisl, tempor ac dui ut, convallis posuere tellus.', 'Swampbotics 2105B takes home the Tournament Champion Trophy, in alliance with 675C (RoboDragons) and 7201N, competing against Swampbotics 2105C, 3536M, and 5668A in the finals. Meanwhile, 2105A receives it''s first Design award of the season.', 'coffee', '2015-11-09', 2015, 'coffee'),
(3, 'Nothing But Net', 'GA TSA FLC', 'BIGGEST COMPETITION YET', '2015-11-14', '2105B, 2105A', '1st, 4th', 'test', 'Swampbotics 2105B takes home yet another Tournament Champion Trophy, in alliance with 1320A (Tucker) and 265. 2105B also sets a world wide record of 10th place in robot skills, and 2105A receives it''s second Design award of the season.', 'flc', '2015-11-16', 2015, 'flc');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
