-- phpMyAdmin SQL Dump
-- version 4.1.6
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: May 27, 2014 at 06:14 
-- Server version: 5.5.36
-- PHP Version: 5.4.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

-- --------------------------------------------------------

--
-- Table structure for table `prefix_articles`
--

CREATE TABLE IF NOT EXISTS `prefix_articles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title_1` varchar(255) DEFAULT NULL,
  `content_1` text,
  `title_2` varchar(255) DEFAULT NULL,
  `content_2` text,
  `title_3` varchar(255) DEFAULT NULL,
  `content_3` text,
  `title_4` varchar(255) DEFAULT NULL,
  `content_4` text,
  `title_5` varchar(255) DEFAULT NULL,
  `content_5` text,
  `title_6` varchar(255) DEFAULT NULL,
  `content_6` text,
  `code` text,
  `user_id` int(11) DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL,
  `date` datetime DEFAULT NULL,
  `date_update` varchar(255) NOT NULL,
  `published` tinyint(1) DEFAULT NULL,
  `onhome` tinyint(1) DEFAULT NULL,
  `priority` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `prefix_articles`
--

INSERT INTO `prefix_articles` (`id`, `title_1`, `content_1`, `title_2`, `content_2`, `title_3`, `content_3`, `title_4`, `content_4`, `title_5`, `content_5`, `title_6`, `content_6`, `code`, `user_id`, `category_id`, `date`, `date_update`, `published`, `onhome`, `priority`) VALUES
(1, '1st Article', '<br>', '', '<br>', '', '<br>', '', '<br>', '', '<br>', '', '<br>', '', 3, 1, '2014-03-15 01:48:54', '', 1, 0, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `prefix_categories`
--

CREATE TABLE IF NOT EXISTS `prefix_categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name_1` varchar(255) DEFAULT NULL,
  `description_1` text,
  `name_2` varchar(255) DEFAULT NULL,
  `description_2` int(11) DEFAULT NULL,
  `name_3` varchar(255) DEFAULT NULL,
  `description_3` int(11) DEFAULT NULL,
  `name_4` varchar(255) DEFAULT NULL,
  `description_4` int(11) DEFAULT NULL,
  `name_5` varchar(255) DEFAULT NULL,
  `description_5` int(11) DEFAULT NULL,
  `name_6` varchar(255) DEFAULT NULL,
  `description_6` int(11) DEFAULT NULL,
  `category_type` varchar(255) DEFAULT NULL,
  `date` date NOT NULL,
  `date_update` datetime NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `code` text,
  `published` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_prefix_categories_prefix_articles` (`id`),
  KEY `fk_prefix_categories_prefix_products1` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `prefix_categories`
--

INSERT INTO `prefix_categories` (`id`, `name_1`, `description_1`, `name_2`, `description_2`, `name_3`, `description_3`, `name_4`, `description_4`, `name_5`, `description_5`, `name_6`, `description_6`, `category_type`, `date`, `date_update`, `user_id`, `code`, `published`) VALUES
(1, '1st Article Category', '<br>', '', NULL, '', NULL, '', NULL, '', NULL, '', NULL, 'articles', '0000-00-00', '0000-00-00 00:00:00', 0, '', 1),
(2, '1st Product Category', '<br>', '', NULL, '', NULL, '', NULL, '', NULL, '', NULL, 'products', '0000-00-00', '0000-00-00 00:00:00', 0, '', 1);

-- --------------------------------------------------------

--
-- Table structure for table `prefix_documents`
--

CREATE TABLE IF NOT EXISTS `prefix_documents` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `file` varchar(255) DEFAULT NULL,
  `alt_1` varchar(255) DEFAULT NULL,
  `alt_2` varchar(255) DEFAULT NULL,
  `module` varchar(255) DEFAULT NULL,
  `priority` int(11) DEFAULT NULL,
  `id_ass` int(11) DEFAULT NULL,
  `date` datetime DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='<' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `prefix_files_type`
--

CREATE TABLE IF NOT EXISTS `prefix_files_type` (
  `type` varchar(255) CHARACTER SET utf8 NOT NULL,
  `extension` varchar(255) CHARACTER SET utf8 NOT NULL,
  `upload_format` enum('image','document') CHARACTER SET utf8 NOT NULL,
  UNIQUE KEY `type` (`type`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `prefix_files_type`
--

INSERT INTO `prefix_files_type` (`type`, `extension`, `upload_format`) VALUES
('application/mac-compactpro', 'cpt', 'document'),
('application/msword', 'doc', 'document'),
('application/octet-stream', 'dwg', 'document'),
('application/pdf', 'pdf', 'document'),
('application/vnd.corel-draw', 'cdr', 'document'),
('application/vnd.ms-excel', 'xls', 'document'),
('application/vnd.ms-powerpoint', 'ppt', 'document'),
('application/vnd.oasis.opendocument.spreadsheet', 'ods', 'document'),
('application/vnd.openxmlformats-officedocument.presentationml.slideshow', 'pptx', 'document'),
('application/vnd.openxmlformats-officedocument.spreadsheetml.sheet', 'xlsx', 'document'),
('application/vnd.openxmlformats-officedocument.wordprocessingml.document', 'docx', 'document'),
('application/zip', 'zip', 'document'),
('image/bmp', 'bmp', 'image'),
('image/gif', 'gif', 'image'),
('image/jpeg', 'jpg', 'image'),
('image/png', 'png', 'image'),
('image/svg+xml', 'svg', 'image'),
('image/tiff', 'tiff', 'document'),
('image/vnd.adobe.photoshop', 'psd', 'document');

-- --------------------------------------------------------

--
-- Table structure for table `prefix_history`
--

CREATE TABLE IF NOT EXISTS `prefix_history` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `module` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `descrition` text CHARACTER SET utf8,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `prefix_images`
--

CREATE TABLE IF NOT EXISTS `prefix_images` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `file` varchar(255) DEFAULT NULL,
  `alt_1` varchar(255) DEFAULT NULL,
  `alt_2` varchar(255) DEFAULT NULL,
  `module` varchar(255) DEFAULT NULL,
  `priority` int(11) DEFAULT NULL,
  `id_ass` int(11) DEFAULT NULL,
  `date` datetime DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `prefix_newsletters`
--

CREATE TABLE IF NOT EXISTS `prefix_newsletters` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(255) CHARACTER SET utf8 NOT NULL,
  `code` text CHARACTER SET utf8 NOT NULL,
  `date` datetime NOT NULL,
  `date_update` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `prefix_products`
--

CREATE TABLE IF NOT EXISTS `prefix_products` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `reference` varchar(255) NOT NULL,
  `title_1` varchar(255) DEFAULT NULL,
  `content_1` text,
  `title_2` varchar(255) DEFAULT NULL,
  `content_2` text,
  `title_3` varchar(255) DEFAULT NULL,
  `content_3` text,
  `title_4` varchar(255) DEFAULT NULL,
  `content_4` text,
  `title_5` varchar(255) DEFAULT NULL,
  `content_5` text,
  `title_6` varchar(255) DEFAULT NULL,
  `content_6` text,
  `code` text,
  `service` tinyint(1) NOT NULL DEFAULT '0',
  `price` double NOT NULL DEFAULT '0',
  `vat` double NOT NULL DEFAULT '0',
  `discount` double NOT NULL DEFAULT '0',
  `user_id` int(11) DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL,
  `date` datetime DEFAULT NULL,
  `date_update` datetime NOT NULL,
  `published` tinyint(1) DEFAULT NULL,
  `onhome` tinyint(1) DEFAULT NULL,
  `priority` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `prefix_products`
--

INSERT INTO `prefix_products` (`id`, `reference`, `title_1`, `content_1`, `title_2`, `content_2`, `title_3`, `content_3`, `title_4`, `content_4`, `title_5`, `content_5`, `title_6`, `content_6`, `code`, `service`, `price`, `vat`, `discount`, `user_id`, `category_id`, `date`, `date_update`, `published`, `onhome`, `priority`) VALUES
(5, '', 'aqui referencia', 'produto de teste', 'alguma descrição<br>', '', '<br>', '', '<br>', '', '<br>', '', '<br>', '', '<br>', 0, 1, 23, 0, 3, 0, '2014-05-10 19:12:56', '0000-00-00 00:00:00', 1, 0, NULL),
(6, '', 'nome', 'aqui texto<br>', 'nome', '<br>', 'nome', '<br>', 'nome', '<br>', 'nome', '<br>', 'nome', '<br>', '', 0, 1.23, 23.25, 0, 3, 2, '2014-05-18 14:53:40', '2014-05-18 14:53:40', 0, 0, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `prefix_users`
--

CREATE TABLE IF NOT EXISTS `prefix_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `rank` enum('owner','manager','member') DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `code` text,
  PRIMARY KEY (`id`),
  KEY `fk_prefix_users_prefix_products1` (`id`),
  KEY `fk_prefix_users_prefix_articles1` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `prefix_users`
--

INSERT INTO `prefix_users` (`id`, `name`, `password`, `rank`, `email`, `code`) VALUES
(1, 'system', 'cf0c5ad9322d0ee3add71eeedc3305734a243823', 'owner', 'suporte@nexus-pt.eu', NULL),
(3, 'demo', '9ccc4065e071a93e89b4327bb48b2aefe4f51a3e', 'manager', 'demo@nexus-pt.eu', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `prefix_variables`
--

CREATE TABLE IF NOT EXISTS `prefix_variables` (
  `variable` varchar(50) CHARACTER SET utf8 NOT NULL,
  `value` varchar(50) CHARACTER SET utf8 NOT NULL,
  UNIQUE KEY `variable` (`variable`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
