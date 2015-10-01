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
  `ordering` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS `prefix_cart` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL DEFAULT '1',
  `content` text,
  `date` datetime NOT NULL,
  `date_update` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS `prefix_categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name_1` varchar(255) DEFAULT NULL,
  `description_1` text,
  `name_2` varchar(255) DEFAULT NULL,
  `description_2` text,
  `name_3` varchar(255) DEFAULT NULL,
  `description_3` text,
  `name_4` varchar(255) DEFAULT NULL,
  `description_4` text,
  `name_5` varchar(255) DEFAULT NULL,
  `description_5` text,
  `name_6` varchar(255) DEFAULT NULL,
  `description_6` text,
  `category_type` varchar(255) DEFAULT NULL,
  `date` date NOT NULL,
  `date_update` datetime NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `code` text,
  `published` tinyint(1) DEFAULT NULL,
  `ordering` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `fk_prefix_categories_prefix_articles` (`id`),
  KEY `fk_prefix_categories_prefix_products1` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

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

CREATE TABLE IF NOT EXISTS `prefix_files_type` (
  `type` varchar(255) CHARACTER SET utf8 NOT NULL,
  `extension` varchar(255) CHARACTER SET utf8 NOT NULL,
  `upload_format` enum('image','document') CHARACTER SET utf8 NOT NULL,
  UNIQUE KEY `type` (`type`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `prefix_history` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `module` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `descrition` text CHARACTER SET utf8,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS `prefix_newsletters` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(255) CHARACTER SET utf8 NOT NULL,
  `code` text CHARACTER SET utf8 NOT NULL,
  `date` datetime NOT NULL,
  `date_update` datetime NOT NULL,
  `active` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS `prefix_orders` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `cart` text CHARACTER SET utf8 NOT NULL,
  `code` text,
  `date` datetime NOT NULL,
  `date_update` datetime NOT NULL,
  `status` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

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
  `ordering` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS `prefix_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `rank` enum('owner','manager','member') DEFAULT 'member',
  `email` varchar(255) DEFAULT NULL,
  `code` text,
  `stringcode` text NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`),
  UNIQUE KEY `email` (`email`),
  KEY `fk_prefix_users_prefix_products1` (`id`),
  KEY `fk_prefix_users_prefix_articles1` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS `prefix_variables` (
  `variable` varchar(50) CHARACTER SET utf8 NOT NULL,
  `value` varchar(50) CHARACTER SET utf8 NOT NULL,
  UNIQUE KEY `variable` (`variable`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


CREATE TABLE IF NOT EXISTS `prefix_vcard` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `data` text NOT NULL,
  `date` datetime NOT NULL,
  `date_update` datetime NOT NULL,
  `published` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;
