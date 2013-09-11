
CREATE TABLE IF NOT EXISTS `hemayat` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `user` mediumtext NOT NULL,
  `cost` mediumtext NOT NULL,
  `refID` mediumtext NOT NULL,
  `item` mediumtext NOT NULL,
  `date` mediumtext NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `hemayat`
--

INSERT INTO `hemayat` (`id`, `user`, `cost`, `refID`, `item`, `date`) VALUES
(1, 'hamed', '100', '313575204', 'Ø­Ù…Ø§ÛŒØª Ø§Ø² Ø³Ø§ÛŒØª Ù†ÛŒÙˆÚ© ÙˆÛŒØ±Ø§ÛŒØ´ 8.3', '2012-05-24 14:12:39');


CREATE TABLE IF NOT EXISTS `hemayatverify` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `user` mediumtext NOT NULL,
  `res` mediumtext NOT NULL,
  `amount` mediumtext NOT NULL,
  `merchant` mediumtext NOT NULL,
  `item` mediumtext NOT NULL,
  `date` mediumtext NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

