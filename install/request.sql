-- phpMyAdmin SQL Dump
-- version 3.2.1
-- http://www.phpmyadmin.net
--
-- Serveur: localhost
-- Généré le : Mar 28 Septembre 2010 à 03:27
-- Version du serveur: 5.1.37
-- Version de PHP: 5.3.0

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

--
-- Base de données: `ikariam`
--

-- --------------------------------------------------------

--
-- Structure de la table `%PREFIX%active`
--

CREATE TABLE IF NOT EXISTS `%PREFIX%active` (
  `username` varchar(15) NOT NULL,
  `timestamp` int(11) NOT NULL,
  PRIMARY KEY (`username`,`timestamp`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Contenu de la table `%PREFIX%active`
--


-- --------------------------------------------------------

--
-- Structure de la table `%PREFIX%barbarian`
--

CREATE TABLE IF NOT EXISTS `%PREFIX%barbarian` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL,
  `level` tinyint(2) NOT NULL DEFAULT '1',
  `barbarians` smallint(5) NOT NULL DEFAULT '1',
  `wall` tinyint(2) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Contenu de la table `%PREFIX%barbarian`
--

INSERT INTO `%PREFIX%barbarian` (`id`, `uid`, `level`, `barbarians`, `wall`) VALUES
(1, 1, 1, 1, 0),
(4, 6, 1, 1, 0);

-- --------------------------------------------------------

--
-- Structure de la table `%PREFIX%bdata`
--

CREATE TABLE IF NOT EXISTS `%PREFIX%bdata` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cid` int(11) NOT NULL,
  `pos` tinyint(2) NOT NULL,
  `type` tinyint(2) NOT NULL,
  `levelfrom` tinyint(2) NOT NULL,
  `levelto` tinyint(2) NOT NULL,
  `starttime` int(11) NOT NULL,
  `timestamp` int(11) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=101 ;

--
-- Contenu de la table `%PREFIX%bdata`
--


-- --------------------------------------------------------

--
-- Structure de la table `%PREFIX%bships`
--

CREATE TABLE IF NOT EXISTS `%PREFIX%bships` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cid` int(11) NOT NULL,
  `s210` int(11) NOT NULL DEFAULT '0',
  `s211` int(11) NOT NULL DEFAULT '0',
  `s212` int(11) NOT NULL DEFAULT '0',
  `s213` int(11) NOT NULL DEFAULT '0',
  `s214` int(11) NOT NULL DEFAULT '0',
  `s215` int(11) NOT NULL DEFAULT '0',
  `s216` int(11) NOT NULL DEFAULT '0',
  `starttime` int(11) NOT NULL,
  `timestamp` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Contenu de la table `%PREFIX%bships`
--


-- --------------------------------------------------------

--
-- Structure de la table `%PREFIX%bspy`
--

CREATE TABLE IF NOT EXISTS `%PREFIX%bspy` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cid` int(11) NOT NULL,
  `starttime` int(11) NOT NULL,
  `timestamp` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Contenu de la table `%PREFIX%bspy`
--


-- --------------------------------------------------------

--
-- Structure de la table `%PREFIX%buildingsdata`
--

CREATE TABLE IF NOT EXISTS `%PREFIX%buildingsdata` (
  `cid` int(11) NOT NULL,
  `b0` tinyint(2) NOT NULL DEFAULT '1',
  `b1` tinyint(2) NOT NULL,
  `b1t` tinyint(2) NOT NULL,
  `b2` tinyint(2) NOT NULL,
  `b2t` tinyint(2) NOT NULL,
  `b3` tinyint(2) NOT NULL,
  `b3t` tinyint(2) NOT NULL,
  `b4` tinyint(2) NOT NULL,
  `b4t` tinyint(2) NOT NULL,
  `b5` tinyint(2) NOT NULL,
  `b5t` tinyint(2) NOT NULL,
  `b6` tinyint(2) NOT NULL,
  `b6t` tinyint(2) NOT NULL,
  `b7` tinyint(2) NOT NULL,
  `b7t` tinyint(2) NOT NULL,
  `b8` tinyint(2) NOT NULL,
  `b8t` tinyint(2) NOT NULL,
  `b9` tinyint(2) NOT NULL,
  `b9t` int(2) NOT NULL,
  `b10` int(2) NOT NULL,
  `b10t` int(2) NOT NULL,
  `b11` int(2) NOT NULL,
  `b11t` int(2) NOT NULL,
  `b12` int(2) NOT NULL,
  `b12t` int(2) NOT NULL,
  `b13` int(2) NOT NULL,
  `b13t` int(2) NOT NULL,
  `b14` int(2) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Contenu de la table `%PREFIX%buildingsdata`
--

INSERT INTO `%PREFIX%buildingsdata` (`cid`, `b0`, `b1`, `b1t`, `b2`, `b2t`, `b3`, `b3t`, `b4`, `b4t`, `b5`, `b5t`, `b6`, `b6t`, `b7`, `b7t`, `b8`, `b8t`, `b9`, `b9t`, `b10`, `b10t`, `b11`, `b11t`, `b12`, `b12t`, `b13`, `b13t`, `b14`) VALUES
(1, 11, 1, 3, 7, 4, 2, 23, 2, 20, 8, 8, 2, 19, 2, 10, 18, 6, 4, 1, 14, 2, 8, 9, 1, 12, 1, 17, 1),
(37, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 6, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(36, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(35, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(34, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(33, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(32, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(30, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(25, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(24, 3, 0, 0, 0, 0, 0, 0, 0, 0, 1, 8, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(38, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 6, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(39, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 6, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Structure de la table `%PREFIX%building_log`
--

CREATE TABLE IF NOT EXISTS `%PREFIX%building_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL,
  `log` text NOT NULL,
  `isNew` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=97 ;

--
-- Contenu de la table `%PREFIX%building_log`
--

INSERT INTO `%PREFIX%building_log` (`id`, `uid`, `log`, `isNew`) VALUES
(1, 1, '<a title="?§U‚U??² ?§U„U‰ ?§U„U…?¯U?U†?©Juma" href="?view=city&id=1">Juma</a></td><td class="date">13.10.2010 0:45</td><td class="subject">?¨U†?§U???Uƒ <a href="?view=warehouse&id=1&position=8">U…U†?²U„ ?§U„???­?²U?U†</a> ?·U?Uˆ?±?? ?¥U„U‰ ?§U„U…?³??UˆU‰ 1', 0),
(2, 1, '<a title="?§U‚U??² ?§U„U‰ ?§U„U…?¯U?U†?©Juma" href="?view=city&id=1">Juma</a></td><td class="date">13.10.2010 1:17</td><td class="subject">?¨U†?§U???Uƒ <a href="?view=warehouse&id=1&position=8">U…U†?²U„ ?§U„???­?²U?U†</a> ?·U?Uˆ?±?? ?¥U„U‰ ?§U„U…?³??UˆU‰ 2', 0),
(3, 1, '<a title="?§U‚U??² ?§U„U‰ ?§U„U…?¯U?U†?©Juma" href="?view=city&id=1">Juma</a></td><td class="date">13.10.2010 1:53</td><td class="subject">?¨U†?§U???Uƒ <a href="?view=warehouse&id=1&position=8">U…U†?²U„ ?§U„???­?²U?U†</a> ?·U?Uˆ?±?? ?¥U„U‰ ?§U„U…?³??UˆU‰ 3', 0),
(4, 1, '<a title="?§U‚U??² ?§U„U‰ ?§U„U…?¯U?U†?©Juma" href="?view=city&id=1">Juma</a></td><td class="date">13.10.2010 2:53</td><td class="subject">?¨U†?§U???Uƒ <a href="?view=warehouse&id=1&position=8">U…U†?²U„ ?§U„???­?²U?U†</a> ?·U?Uˆ?±?? ?¥U„U‰ ?§U„U…?³??UˆU‰ 4', 0),
(5, 1, '<a title="?§U‚U??² ?§U„U‰ ?§U„U…?¯U?U†?©Juma" href="?view=city&id=1">Juma</a></td><td class="date">13.10.2010 3:53</td><td class="subject">?¨U†?§U???Uƒ <a href="?view=warehouse&id=1&position=8">U…U†?²U„ ?§U„???­?²U?U†</a> ?·U?Uˆ?±?? ?¥U„U‰ ?§U„U…?³??UˆU‰ 5', 0),
(6, 1, '<a title="?§U‚U??² ?§U„U‰ ?§U„U…?¯U?U†?©Juma" href="?view=city&id=1">Juma</a></td><td class="date">13.10.2010 5:05</td><td class="subject">?¨U†?§U???Uƒ <a href="?view=warehouse&id=1&position=8">U…U†?²U„ ?§U„???­?²U?U†</a> ?·U?Uˆ?±?? ?¥U„U‰ ?§U„U…?³??UˆU‰ 6', 0),
(7, 1, '<a title="?§U‚U??² ?§U„U‰ ?§U„U…?¯U?U†?©Juma" href="?view=city&id=1">Juma</a></td><td class="date">13.10.2010 6:40</td><td class="subject">?¨U†?§U???Uƒ <a href="?view=warehouse&id=1&position=8">U…U†?²U„ ?§U„???­?²U?U†</a> ?·U?Uˆ?±?? ?¥U„U‰ ?§U„U…?³??UˆU‰ 7', 0),
(8, 1, '<a title="?§U‚U??² ?§U„U‰ ?§U„U…?¯U?U†?©Juma" href="?view=city&id=1">Juma</a></td><td class="date">13.10.2010 8:40</td><td class="subject">?¨U†?§U???Uƒ <a href="?view=warehouse&id=1&position=8">U…U†?²U„ ?§U„???­?²U?U†</a> ?·U?Uˆ?±?? ?¥U„U‰ ?§U„U…?³??UˆU‰ 8', 0),
(9, 1, '<a title="?§U‚U??² ?§U„U‰ ?§U„U…?¯U?U†?©Juma" href="?view=city&id=1">Juma</a></td><td class="date">13.10.2010 10:41</td><td class="subject">?¨U†?§U???Uƒ <a href="?view=warehouse&id=1&position=8">U…U†?²U„ ?§U„???­?²U?U†</a> ?·U?Uˆ?±?? ?¥U„U‰ ?§U„U…?³??UˆU‰ 9', 0),
(10, 1, '<a title="?§U‚U??² ?§U„U‰ ?§U„U…?¯U?U†?©Juma" href="?view=city&id=1">Juma</a></td><td class="date">13.10.2010 13:02</td><td class="subject">?¨U†?§U???Uƒ <a href="?view=warehouse&id=1&position=8">U…U†?²U„ ?§U„???­?²U?U†</a> ?·U?Uˆ?±?? ?¥U„U‰ ?§U„U…?³??UˆU‰ 10', 0),
(11, 1, '<a title="?§U‚U??² ?§U„U‰ ?§U„U…?¯U?U†?©Juma" href="?view=city&id=1">Juma</a></td><td class="date">13.10.2010 16:14</td><td class="subject">?¨U†?§U???Uƒ <a href="?view=warehouse&id=1&position=8">U…U†?²U„ ?§U„???­?²U?U†</a> ?·U?Uˆ?±?? ?¥U„U‰ ?§U„U…?³??UˆU‰ 11', 0),
(12, 1, '<a title="?§U‚U??² ?§U„U‰ ?§U„U…?¯U?U†?©Juma" href="?view=city&id=1">Juma</a></td><td class="date">13.10.2010 19:30</td><td class="subject">?¨U†?§U???Uƒ <a href="?view=warehouse&id=1&position=8">U…U†?²U„ ?§U„???­?²U?U†</a> ?·U?Uˆ?±?? ?¥U„U‰ ?§U„U…?³??UˆU‰ 12', 0),
(13, 1, '<a title="?§U‚U??² ?§U„U‰ ?§U„U…?¯U?U†?©Juma" href="?view=city&id=1">Juma</a></td><td class="date">13.10.2010 23:20</td><td class="subject">?¨U†?§U???Uƒ <a href="?view=warehouse&id=1&position=8">U…U†?²U„ ?§U„???­?²U?U†</a> ?·U?Uˆ?±?? ?¥U„U‰ ?§U„U…?³??UˆU‰ 13', 0),
(14, 1, '<a title="?§U‚U??² ?§U„U‰ ?§U„U…?¯U?U†?©Juma" href="?view=city&id=1">Juma</a></td><td class="date">14.10.2010 3:50</td><td class="subject">?¨U†?§U???Uƒ <a href="?view=warehouse&id=1&position=8">U…U†?²U„ ?§U„???­?²U?U†</a> ?·U?Uˆ?±?? ?¥U„U‰ ?§U„U…?³??UˆU‰ 14', 0),
(15, 1, '<a title="?§U‚U??² ?§U„U‰ ?§U„U…?¯U?U†?©Juma" href="?view=city&id=1">Juma</a></td><td class="date">14.10.2010 8:57</td><td class="subject">?¨U†?§U???Uƒ <a href="?view=warehouse&id=1&position=8">U…U†?²U„ ?§U„???­?²U?U†</a> ?·U?Uˆ?±?? ?¥U„U‰ ?§U„U…?³??UˆU‰ 15', 0),
(16, 1, '<a title="?§U‚U??² ?§U„U‰ ?§U„U…?¯U?U†?©Juma" href="?view=city&id=1">Juma</a></td><td class="date">14.10.2010 14:58</td><td class="subject">?¨U†?§U???Uƒ <a href="?view=warehouse&id=1&position=8">U…U†?²U„ ?§U„???­?²U?U†</a> ?·U?Uˆ?±?? ?¥U„U‰ ?§U„U…?³??UˆU‰ 16', 0),
(17, 1, '<a title="?§U‚U??² ?§U„U‰ ?§U„U…?¯U?U†?©Juma" href="?view=city&id=1">Juma</a></td><td class="date">14.10.2010 21:58</td><td class="subject">?¨U†?§U???Uƒ <a href="?view=warehouse&id=1&position=8">U…U†?²U„ ?§U„???­?²U?U†</a> ?·U?Uˆ?±?? ?¥U„U‰ ?§U„U…?³??UˆU‰ 17', 0),
(18, 1, '<a title="?§U‚U??² ?§U„U‰ ?§U„U…?¯U?U†?©Juma" href="?view=city&id=1">Juma</a></td><td class="date">15.10.2010 5:59</td><td class="subject">?¨U†?§U???Uƒ <a href="?view=warehouse&id=1&position=8">U…U†?²U„ ?§U„???­?²U?U†</a> ?·U?Uˆ?±?? ?¥U„U‰ ?§U„U…?³??UˆU‰ 18', 0),
(19, 1, '<a title="?§U‚U??² ?§U„U‰ ?§U„U…?¯U?U†?©Juma" href="?view=city&id=1">Juma</a></td><td class="date">15.10.2010 7:00</td><td class="subject">?¨U†?§U???Uƒ <a href="?view=townHall&id=1&position=0">?¯?§?± ?§U„?¨U„?¯U??©</a> ?·U?Uˆ?±?? ?¥U„U‰ ?§U„U…?³??UˆU‰ 2', 0),
(20, 1, '<a title="?§U‚U??² ?§U„U‰ ?§U„U…?¯U?U†?©Juma" href="?view=city&id=1">Juma</a></td><td class="date">15.10.2010 8:10</td><td class="subject">?¨U†?§U???Uƒ <a href="?view=townHall&id=1&position=0">?¯?§?± ?§U„?¨U„?¯U??©</a> ?·U?Uˆ?±?? ?¥U„U‰ ?§U„U…?³??UˆU‰ 3', 0),
(21, 1, '<a title="?§U‚U??² ?§U„U‰ ?§U„U…?¯U?U†?©Juma" href="?view=city&id=1">Juma</a></td><td class="date">15.10.2010 9:25</td><td class="subject">?¨U†?§U???Uƒ <a href="?view=townHall&id=1&position=0">?¯?§?± ?§U„?¨U„?¯U??©</a> ?·U?Uˆ?±?? ?¥U„U‰ ?§U„U…?³??UˆU‰ 4', 0),
(22, 1, '<a title="?§U‚U??² ?§U„U‰ ?§U„U…?¯U?U†?©Juma" href="?view=city&id=1">Juma</a></td><td class="date">15.10.2010 10:59</td><td class="subject">?¨U†?§U???Uƒ <a href="?view=townHall&id=1&position=0">?¯?§?± ?§U„?¨U„?¯U??©</a> ?·U?Uˆ?±?? ?¥U„U‰ ?§U„U…?³??UˆU‰ 5', 0),
(23, 1, '<a title="?§U‚U??² ?§U„U‰ ?§U„U…?¯U?U†?©Juma" href="?view=city&id=1">Juma</a></td><td class="date">12.11.2010 23:30</td><td class="subject">?¨U†?§U???Uƒ <a href="?view=townHall&id=1&position=0">?¯?§?± ?§U„?¨U„?¯U??©</a> ?·U?Uˆ?±?? ?¥U„U‰ ?§U„U…?³??UˆU‰ 6', 0),
(24, 1, '<a title="?§U‚U??² ?§U„U‰ ?§U„U…?¯U?U†?©Juma" href="?view=city&id=1">Juma</a></td><td class="date">12.11.2010 23:50</td><td class="subject">?¨U†?§U???Uƒ <a href="?view=tavern&id=1&position=11">?¥?³???±?§?­?©</a> ?·U?Uˆ?±?? ?¥U„U‰ ?§U„U…?³??UˆU‰ 1', 0),
(25, 1, '<a title="?§U‚U??² ?§U„U‰ ?§U„U…?¯U?U†?©Juma" href="?view=city&id=1">Juma</a></td><td class="date">13.11.2010 0:16</td><td class="subject">?¨U†?§U???Uƒ <a href="?view=tavern&id=1&position=11">?¥?³???±?§?­?©</a> ?·U?Uˆ?±?? ?¥U„U‰ ?§U„U…?³??UˆU‰ 2', 0),
(26, 1, '<a title="?§U‚U??² ?§U„U‰ ?§U„U…?¯U?U†?©Juma" href="?view=city&id=1">Juma</a></td><td class="date">13.11.2010 1:16</td><td class="subject">?¨U†?§U???Uƒ <a href="?view=tavern&id=1&position=11">?¥?³???±?§?­?©</a> ?·U?Uˆ?±?? ?¥U„U‰ ?§U„U…?³??UˆU‰ 3', 0),
(27, 1, '<a title="?§U‚U??² ?§U„U‰ ?§U„U…?¯U?U†?©Juma" href="?view=city&id=1">Juma</a></td><td class="date">13.11.2010 2:17</td><td class="subject">?¨U†?§U???Uƒ <a href="?view=tavern&id=1&position=11">?¥?³???±?§?­?©</a> ?·U?Uˆ?±?? ?¥U„U‰ ?§U„U…?³??UˆU‰ 4', 0),
(28, 1, '<a title="?§U‚U??² ?§U„U‰ ?§U„U…?¯U?U†?©Juma" href="?view=city&id=1">Juma</a></td><td class="date">13.11.2010 6:30</td><td class="subject">?¨U†?§U???Uƒ <a href="?view=tavern&id=1&position=11">?¥?³???±?§?­?©</a> ?·U?Uˆ?±?? ?¥U„U‰ ?§U„U…?³??UˆU‰ 5', 0),
(29, 1, '<a title="?§U‚U??² ?§U„U‰ ?§U„U…?¯U?U†?©Juma" href="?view=city&id=1">Juma</a></td><td class="date">13.11.2010 8:41</td><td class="subject">?¨U†?§U???Uƒ <a href="?view=townHall&id=1&position=0">?¯?§?± ?§U„?¨U„?¯U??©</a> ?·U?Uˆ?±?? ?¥U„U‰ ?§U„U…?³??UˆU‰ 7', 0),
(30, 1, '<a title="?§U‚U??² ?§U„U‰ ?§U„U…?¯U?U†?©Juma" href="?view=city&id=1">Juma</a></td><td class="date">13.11.2010 10:44</td><td class="subject">?¨U†?§U???Uƒ <a href="?view=townHall&id=1&position=0">?¯?§?± ?§U„?¨U„?¯U??©</a> ?·U?Uˆ?±?? ?¥U„U‰ ?§U„U…?³??UˆU‰ 8', 0),
(31, 1, '<a title="?§U‚U??² ?§U„U‰ ?§U„U…?¯U?U†?©Juma" href="?view=city&id=1">Juma</a></td><td class="date">13.11.2010 15:20</td><td class="subject">?¨U†?§U???Uƒ <a href="?view=palace&id=1&position=5">U‚?µ?±</a> ?·U?Uˆ?±?? ?¥U„U‰ ?§U„U…?³??UˆU‰ 1', 0),
(32, 0, '<a title="?§U‚U??² ?§U„U‰ ?§U„U…?¯U?U†?©" href="?view=city&id="></a></td><td class="date">13.11.2010 15:44</td><td class="subject">U„U‚?¯ ?£U†?´?£?? U…?³???¹U…?±?© ?¬?¯U??¯?© <a href="?view=&id=&position=">U…?­?§U??¶?©</a>UˆU†U‚U„?? ?¥U„U?U‡?§<ul class="resources"></ul>', 1),
(33, 0, '<a title="?§U‚U??² ?§U„U‰ ?§U„U…?¯U?U†?©Juma" href="?view=city&id=1">Juma</a></td><td class="date">13.11.2010 16:00</td><td class="subject">U„U‚?¯ ?£U†?´?£?? U…?³???¹U…?±?© ?¬?¯U??¯?© <a href="?view=&id=&position=">U…?­?§U??¶?©</a>UˆU†U‚U„?? ?¥U„U?U‡?§<ul class="resources"><li class="wood"><span class="textLabel">U…?§?¯?© ?µU†?§?¹U??©: </span>1000</li></ul>', 1),
(34, 0, '<a title="?§U‚U??² ?§U„U‰ ?§U„U…?¯U?U†?©Juma" href="?view=city&id=1">Juma</a></td><td class="date">13.11.2010 16:15</td><td class="subject">U„U‚?¯ ?£U†?´?£?? U…?³???¹U…?±?© ?¬?¯U??¯?© <a href="?view=city&id=23">U…?­?§U??¶?©</a>UˆU†U‚U„?? ?¥U„U?U‡?§<ul class="resources"><li class="wood"><span class="textLabel">U…?§?¯?© ?µU†?§?¹U??©: </span>1000</li></ul>', 1),
(35, 1, '<a title="?§U‚U??² ?§U„U‰ ?§U„U…?¯U?U†?©Juma" href="?view=city&id=1">Juma</a></td><td class="date">13.11.2010 16:30</td><td class="subject">U„U‚?¯ ?£U†?´?£?? U…?³???¹U…?±?© ?¬?¯U??¯?© <a href="?view=city&id=24">U…?­?§U??¶?©</a>UˆU†U‚U„?? ?¥U„U?U‡?§<ul class="resources"><li class="wood"><span class="textLabel">U…?§?¯?© ?µU†?§?¹U??©: </span>1000</li></ul>', 0),
(36, 1, '<a title="?§U‚U??² ?§U„U‰ ?§U„U…?¯U?U†?©Juma" href="?view=city&id=1">Juma</a></td><td class="date">13.11.2010 16:45</td><td class="subject">?¨U†?§U???Uƒ <a href="?view=barracks&id=1&position=10">?«UƒU†?©</a> ?·U?Uˆ?±?? ?¥U„U‰ ?§U„U…?³??UˆU‰ 1', 0),
(37, 1, '<a title="?§U‚U??² ?§U„U‰ ?§U„U…?¯U?U†?©Juma" href="?view=city&id=1">Juma</a></td><td class="date">13.11.2010 17:10</td><td class="subject">?¨U†?§U???Uƒ <a href="?view=barracks&id=1&position=10">?«UƒU†?©</a> ?·U?Uˆ?±?? ?¥U„U‰ ?§U„U…?³??UˆU‰ 2', 0),
(38, 1, '<a title="?§U‚U??² ?§U„U‰ ?§U„U…?¯U?U†?©Juma" href="?view=city&id=1">Juma</a></td><td class="date">13.11.2010 20:48</td><td class="subject">?¨U†?§U???Uƒ <a href="?view=barracks&id=1&position=10">?«UƒU†?©</a> ?·U?Uˆ?±?? ?¥U„U‰ ?§U„U…?³??UˆU‰ 3', 0),
(39, 1, '<a title="?§U‚U??² ?§U„U‰ ?§U„U…?¯U?U†?©Juma" href="?view=city&id=1">Juma</a></td><td class="date">13.11.2010 21:48</td><td class="subject">?¨U†?§U???Uƒ <a href="?view=barracks&id=1&position=10">?«UƒU†?©</a> ?·U?Uˆ?±?? ?¥U„U‰ ?§U„U…?³??UˆU‰ 4', 0),
(40, 1, '<a title="?§U‚U??² ?§U„U‰ ?§U„U…?¯U?U†?©Juma" href="?view=city&id=1">Juma</a></td><td class="date">13.11.2010 22:48</td><td class="subject">?¨U†?§U???Uƒ <a href="?view=barracks&id=1&position=10">?«UƒU†?©</a> ?·U?Uˆ?±?? ?¥U„U‰ ?§U„U…?³??UˆU‰ 5', 0),
(41, 1, '<a title="?§U‚U??² ?§U„U‰ ?§U„U…?¯U?U†?©Juma" href="?view=city&id=1">Juma</a></td><td class="date">13.11.2010 23:48</td><td class="subject">?¨U†?§U???Uƒ <a href="?view=barracks&id=1&position=10">?«UƒU†?©</a> ?·U?Uˆ?±?? ?¥U„U‰ ?§U„U…?³??UˆU‰ 6', 0),
(42, 1, '<a title="?§U‚U??² ?§U„U‰ ?§U„U…?¯U?U†?©Juma" href="?view=city&id=1">Juma</a></td><td class="date">24.09.2010 0:30</td><td class="subject">?¨U†?§U???Uƒ <a href="?view=safehouse&id=1&position=7">U…?®?¨?£</a> ?·U?Uˆ?±?? ?¥U„U‰ ?§U„U…?³??UˆU‰ 1', 0),
(43, 1, '<a title="?§U‚U??² ?§U„U‰ ?§U„U…?¯U?U†?©Juma" href="?view=city&id=1">Juma</a></td><td class="date">24.09.2010 2:07</td><td class="subject">?¨U†?§U???Uƒ <a href="?view=safehouse&id=1&position=7">U…?®?¨?£</a> ?·U?Uˆ?±?? ?¥U„U‰ ?§U„U…?³??UˆU‰ 2', 0),
(44, 1, '<a title="?§U‚U??² ?§U„U‰ ?§U„U…?¯U?U†?©Juma" href="?view=city&id=1">Juma</a></td><td class="date">24.09.2010 8:28</td><td class="subject">?¨U†?§U???Uƒ <a href="?view=barracks&id=1&position=10">?«UƒU†?©</a> ?·U?Uˆ?±?? ?¥U„U‰ ?§U„U…?³??UˆU‰ 7', 0),
(45, 1, '<a title="?§U‚U??² ?§U„U‰ ?§U„U…?¯U?U†?©Juma" href="?view=city&id=1">Juma</a></td><td class="date">26.09.2010 1:20</td><td class="subject">?¨U†?§U???Uƒ <a href="?view=barracks&id=1&position=10">?«UƒU†?©</a> ?·U?Uˆ?±?? ?¥U„U‰ ?§U„U…?³??UˆU‰ 8', 0),
(46, 1, '<a title="?§U‚U??² ?§U„U‰ ?§U„U…?¯U?U†?©U…?­?§U??¸?©" href="?view=city&id=24">U…?­?§U??¸?©</a></td><td class="date">26.09.2010 1:20</td><td class="subject">?¨U†?§U???Uƒ <a href="?view=palace&id=24&position=5">U‚?µ?±</a> ?·U?Uˆ?±?? ?¥U„U‰ ?§U„U…?³??UˆU‰ 1', 0),
(47, 1, '<a title="?§U‚U??² ?§U„U‰ ?§U„U…?¯U?U†?©Juma" href="?view=city&id=1">Juma</a></td><td class="date">26.09.2010 9:05</td><td class="subject">?¨U†?§U???Uƒ <a href="?view=museum&id=1&position=6"></a> ?·U?Uˆ?±?? ?¥U„U‰ ?§U„U…?³??UˆU‰ 1', 0),
(48, 1, '<a title="?§U‚U??² ?§U„U‰ ?§U„U…?¯U?U†?©Juma" href="?view=city&id=1">Juma</a></td><td class="date">26.09.2010 11:12</td><td class="subject">?¨U†?§U???Uƒ <a href="?view=barracks&id=1&position=10">?«UƒU†?©</a> ?·U?Uˆ?±?? ?¥U„U‰ ?§U„U…?³??UˆU‰ 9', 0),
(49, 1, '<a title="?§U‚U??² ?§U„U‰ ?§U„U…?¯U?U†?©Juma" href="?view=city&id=1">Juma</a></td><td class="date">26.09.2010 15:10</td><td class="subject">?¨U†?§U???Uƒ <a href="?view=barracks&id=1&position=10">?«UƒU†?©</a> ?·U?Uˆ?±?? ?¥U„U‰ ?§U„U…?³??UˆU‰ 10', 0),
(50, 1, '<a title="?§U‚U??² ?§U„U‰ ?§U„U…?¯U?U†?©Juma" href="?view=city&id=1">Juma</a></td><td class="date">26.09.2010 16:30</td><td class="subject">?¨U†?§U???Uƒ <a href="?view=barracks&id=1&position=10">?«UƒU†?©</a> ?·U?Uˆ?±?? ?¥U„U‰ ?§U„U…?³??UˆU‰ 11', 0),
(51, 1, '<a title="?§U‚U??² ?§U„U‰ ?§U„U…?¯U?U†?©Juma" href="?view=city&id=1">Juma</a></td><td class="date">26.09.2010 18:01</td><td class="subject">?¨U†?§U???Uƒ <a href="?view=barracks&id=1&position=10">?«UƒU†?©</a> ?·U?Uˆ?±?? ?¥U„U‰ ?§U„U…?³??UˆU‰ 12', 0),
(52, 1, '<a title="?§U‚U??² ?§U„U‰ ?§U„U…?¯U?U†?©Juma" href="?view=city&id=1">Juma</a></td><td class="date">26.09.2010 20:02</td><td class="subject">?¨U†?§U???Uƒ <a href="?view=barracks&id=1&position=10">?«UƒU†?©</a> ?·U?Uˆ?±?? ?¥U„U‰ ?§U„U…?³??UˆU‰ 13', 0),
(53, 1, '<a title="?§U‚U??² ?§U„U‰ ?§U„U…?¯U?U†?©Juma" href="?view=city&id=1">Juma</a></td><td class="date">27.09.2010 9:29</td><td class="subject">?¨U†?§U???Uƒ <a href="?view=barracks&id=1&position=10">?«UƒU†?©</a> ?·U?Uˆ?±?? ?¥U„U‰ ?§U„U…?³??UˆU‰ 14', 0),
(54, 1, '<a title="?§U‚U??² ?§U„U‰ ?§U„U…?¯U?U†?©Juma" href="?view=city&id=1">Juma</a></td><td class="date">27.09.2010 12:00</td><td class="subject">?¨U†?§U???Uƒ <a href="?view=academy&id=1&position=9">?£Uƒ?§?¯U?U…U??©</a> ?·U?Uˆ?±?? ?¥U„U‰ ?§U„U…?³??UˆU‰ 1', 0),
(55, 1, '<a title="?§U‚U??² ?§U„U‰ ?§U„U…?¯U?U†?©Juma" href="?view=city&id=1">Juma</a></td><td class="date">27.09.2010 12:30</td><td class="subject">?¨U†?§U???Uƒ <a href="?view=academy&id=1&position=9">?£Uƒ?§?¯U?U…U??©</a> ?·U?Uˆ?±?? ?¥U„U‰ ?§U„U…?³??UˆU‰ 2', 0),
(56, 1, '<a title="?§U‚U??² ?§U„U‰ ?§U„U…?¯U?U†?©Juma" href="?view=city&id=1">Juma</a></td><td class="date">27.09.2010 12:45</td><td class="subject">?¨U†?§U???Uƒ <a href="?view=academy&id=1&position=9">?£Uƒ?§?¯U?U…U??©</a> ?·U?Uˆ?±?? ?¥U„U‰ ?§U„U…?³??UˆU‰ 3', 0),
(57, 1, '<a title="?§U‚U??² ?§U„U‰ ?§U„U…?¯U?U†?©Juma" href="?view=city&id=1">Juma</a></td><td class="date">27.09.2010 13:30</td><td class="subject">?¨U†?§U???Uƒ <a href="?view=academy&id=1&position=9">?£Uƒ?§?¯U?U…U??©</a> ?·U?Uˆ?±?? ?¥U„U‰ ?§U„U…?³??UˆU‰ 4', 0),
(58, 1, '<a title="?§U‚U??² ?§U„U‰ ?§U„U…?¯U?U†?©Juma" href="?view=city&id=1">Juma</a></td><td class="date">14.09.2010 7:45</td><td class="subject">?¨U†?§U???Uƒ <a href="?view=tavern&id=1&position=11">?¥?³???±?§?­?©</a> ?·U?Uˆ?±?? ?¥U„U‰ ?§U„U…?³??UˆU‰ 6', 0),
(59, 1, '<a title="?§U‚U??² ?§U„U‰ ?§U„U…?¯U?U†?©Juma" href="?view=city&id=1">Juma</a></td><td class="date">14.09.2010 9:45</td><td class="subject">?¨U†?§U???Uƒ <a href="?view=tavern&id=1&position=11">?¥?³???±?§?­?©</a> ?·U?Uˆ?±?? ?¥U„U‰ ?§U„U…?³??UˆU‰ 7', 0),
(60, 1, '<a title="?§U‚U??² ?§U„U‰ ?§U„U…?¯U?U†?©Juma" href="?view=city&id=1">Juma</a></td><td class="date">14.09.2010 11:45</td><td class="subject">?¨U†?§U???Uƒ <a href="?view=tavern&id=1&position=11">?¥?³???±?§?­?©</a> ?·U?Uˆ?±?? ?¥U„U‰ ?§U„U…?³??UˆU‰ 8', 0),
(61, 1, '<a title="?§U‚U??² ?§U„U‰ ?§U„U…?¯U?U†?©Juma" href="?view=city&id=1">Juma</a></td><td class="date">14.09.2010 13:58</td><td class="subject">?¨U†?§U???Uƒ <a href="?view=townHall&id=1&position=0">?¯?§?± ?§U„?¨U„?¯U??©</a> ?·U?Uˆ?±?? ?¥U„U‰ ?§U„U…?³??UˆU‰ 9', 0),
(62, 1, '<a title="?§U‚U??² ?§U„U‰ ?§U„U…?¯U?U†?©Juma" href="?view=city&id=1">Juma</a></td><td class="date">14.09.2010 17:00</td><td class="subject">?¨U†?§U???Uƒ <a href="?view=townHall&id=1&position=0">?¯?§?± ?§U„?¨U„?¯U??©</a> ?·U?Uˆ?±?? ?¥U„U‰ ?§U„U…?³??UˆU‰ 10', 0),
(63, 1, '<a title="?§U‚U??² ?§U„U‰ ?§U„U…?¯U?U†?©U…?­?§U??¸?©" href="?view=city&id=24">U…?­?§U??¸?©</a></td><td class="date">14.09.2010 18:00</td><td class="subject">?¨U†?§U???Uƒ <a href="?view=townHall&id=24&position=0">?¯?§?± ?§U„?¨U„?¯U??©</a> ?·U?Uˆ?±?? ?¥U„U‰ ?§U„U…?³??UˆU‰ 2', 0),
(64, 1, '<a title="?§U‚U??² ?§U„U‰ ?§U„U…?¯U?U†?©U…?­?§U??¸?©" href="?view=city&id=24">U…?­?§U??¸?©</a></td><td class="date">14.09.2010 19:10</td><td class="subject">?¨U†?§U???Uƒ <a href="?view=townHall&id=24&position=0">?¯?§?± ?§U„?¨U„?¯U??©</a> ?·U?Uˆ?±?? ?¥U„U‰ ?§U„U…?³??UˆU‰ 3', 0),
(65, 1, '<a title="?§U‚U??² ?§U„U‰ ?§U„U…?¯U?U†?©Juma" href="?view=city&id=1">Juma</a></td><td class="date">14.09.2010 19:50</td><td class="subject">?¨U†?§U???Uƒ <a href="?view=wall&id=1&position=14">?³Uˆ?± ?§U„U…?¯U?U†?©</a> ?·U?Uˆ?±?? ?¥U„U‰ ?§U„U…?³??UˆU‰ 1', 0),
(66, 1, '<a title="?§U‚U??² ?§U„U‰ ?§U„U…?¯U?U†?©Juma" href="?view=city&id=1">Juma</a></td><td class="date">15.09.2010 2:10</td><td class="subject">?¨U†?§U???Uƒ <a href="?view=palace&id=1&position=5">U‚?µ?±</a> ?·U?Uˆ?±?? ?¥U„U‰ ?§U„U…?³??UˆU‰ 2', 0),
(67, 1, '<a title="?§U‚U??² ?§U„U‰ ?§U„U…?¯U?U†?©Juma" href="?view=city&id=1">Juma</a></td><td class="date">15.09.2010 11:11</td><td class="subject">?¨U†?§U???Uƒ <a href="?view=palace&id=1&position=5">U‚?µ?±</a> ?·U?Uˆ?±?? ?¥U„U‰ ?§U„U…?³??UˆU‰ 3', 0),
(68, 1, '<a title="?§U‚U??² ?§U„U‰ ?§U„U…?¯U?U†?©Juma" href="?view=city&id=1">Juma</a></td><td class="date">16.09.2010 0:11</td><td class="subject">?¨U†?§U???Uƒ <a href="?view=palace&id=1&position=5">U‚?µ?±</a> ?·U?Uˆ?±?? ?¥U„U‰ ?§U„U…?³??UˆU‰ 4', 0),
(69, 1, '<a title="?§U‚U??² ?§U„U‰ ?§U„U…?¯U?U†?©Juma" href="?view=city&id=1">Juma</a></td><td class="date">16.09.2010 19:11</td><td class="subject">?¨U†?§U???Uƒ <a href="?view=palace&id=1&position=5">U‚?µ?±</a> ?·U?Uˆ?±?? ?¥U„U‰ ?§U„U…?³??UˆU‰ 5', 0),
(70, 1, '<a title="?§U‚U??² ?§U„U‰ ?§U„U…?¯U?U†?©Juma" href="?view=city&id=1">Juma</a></td><td class="date">17.09.2010 20:11</td><td class="subject">?¨U†?§U???Uƒ <a href="?view=palace&id=1&position=5">U‚?µ?±</a> ?·U?Uˆ?±?? ?¥U„U‰ ?§U„U…?³??UˆU‰ 6', 0),
(71, 1, '<a title="?§U‚U??² ?§U„U‰ ?§U„U…?¯U?U†?©Juma" href="?view=city&id=1">Juma</a></td><td class="date">19.09.2010 21:11</td><td class="subject">?¨U†?§U???Uƒ <a href="?view=palace&id=1&position=5">U‚?µ?±</a> ?·U?Uˆ?±?? ?¥U„U‰ ?§U„U…?³??UˆU‰ 7', 0),
(72, 1, '<a title="?§U‚U??² ?§U„U‰ ?§U„U…?¯U?U†?©Juma" href="?view=city&id=1">Juma</a></td><td class="date">19.09.2010 21:35</td><td class="subject">?¨U†?§U???Uƒ <a href="?view=port&id=1&position=1">U…?±U??£ ???¬?§?±U?</a> ?·U?Uˆ?±?? ?¥U„U‰ ?§U„U…?³??UˆU‰ 1', 0),
(73, 1, '<a title="?§U‚U??² ?§U„U‰ ?§U„U…?¯U?U†?©Juma" href="?view=city&id=1">Juma</a></td><td class="date">19.09.2010 22:35</td><td class="subject">?¨U†?§U???Uƒ <a href="?view=shipyard&id=1&position=2">?­Uˆ?¶ ?¨U†?§?? ?§U„?³U?U†</a> ?·U?Uˆ?±?? ?¥U„U‰ ?§U„U…?³??UˆU‰ 1', 0),
(74, 1, '<a title="?§U‚U??² ?§U„U‰ ?§U„U…?¯U?U†?©Juma" href="?view=city&id=1">Juma</a></td><td class="date">19.09.2010 22:35</td><td class="subject"> U„U‚?¯ ?£U†?´?£?? U…?³???¹U…?±?© ?¬?¯U??¯?© <a href="?view=city&id=30"> U…?­?§U??¶?© </a>UˆU†U‚U„?? ?¥U„U?U‡?§<ul class="resources"><li class="wood"><span class="textLabel">U…?§?¯?© ?µU†?§?¹U??©: </span>500</li></ul>', 0),
(75, 1, '<a title="?§U‚U??² ?§U„U‰ ?§U„U…?¯U?U†?©Juma" href="?view=city&id=1">Juma</a></td><td class="date">19.09.2010 23:47</td><td class="subject">?¨U†?§U???Uƒ <a href="?view=shipyard&id=1&position=2">?­Uˆ?¶ ?¨U†?§?? ?§U„?³U?U†</a> ?·U?Uˆ?±?? ?¥U„U‰ ?§U„U…?³??UˆU‰ 2', 0),
(76, 1, '<a title="?§U‚U??² ?§U„U‰ ?§U„U…?¯U?U†?©Juma" href="?view=city&id=1">Juma</a></td><td class="date">20.09.2010 0:47</td><td class="subject">?¨U†?§U???Uƒ <a href="?view=shipyard&id=1&position=2">?­Uˆ?¶ ?¨U†?§?? ?§U„?³U?U†</a> ?·U?Uˆ?±?? ?¥U„U‰ ?§U„U…?³??UˆU‰ 3', 0),
(77, 1, '<a title="?§U‚U??² ?§U„U‰ ?§U„U…?¯U?U†?©Juma" href="?view=city&id=1">Juma</a></td><td class="date">20.09.2010 2:01</td><td class="subject">?¨U†?§U???Uƒ <a href="?view=shipyard&id=1&position=2">?­Uˆ?¶ ?¨U†?§?? ?§U„?³U?U†</a> ?·U?Uˆ?±?? ?¥U„U‰ ?§U„U…?³??UˆU‰ 4', 0),
(78, 1, '<a title="?§U‚U??² ?§U„U‰ ?§U„U…?¯U?U†?©Juma" href="?view=city&id=1">Juma</a></td><td class="date">20.09.2010 11:47</td><td class="subject">?¨U†?§U???Uƒ <a href="?view=shipyard&id=1&position=2">?­Uˆ?¶ ?¨U†?§?? ?§U„?³U?U†</a> ?·U?Uˆ?±?? ?¥U„U‰ ?§U„U…?³??UˆU‰ 5', 0),
(79, 1, '<a title="?§U‚U??² ?§U„U‰ ?§U„U…?¯U?U†?©Juma" href="?view=city&id=1">Juma</a></td><td class="date">20.09.2010 21:14</td><td class="subject">?¨U†?§U???Uƒ <a href="?view=shipyard&id=1&position=2">?­Uˆ?¶ ?¨U†?§?? ?§U„?³U?U†</a> ?·U?Uˆ?±?? ?¥U„U‰ ?§U„U…?³??UˆU‰ 6', 0),
(80, 1, '<a title="?§U‚U??² ?§U„U‰ ?§U„U…?¯U?U†?©Juma" href="?view=city&id=1">Juma</a></td><td class="date">21.09.2010 2:01</td><td class="subject">?¨U†?§U???Uƒ <a href="?view=shipyard&id=1&position=2">?­Uˆ?¶ ?¨U†?§?? ?§U„?³U?U†</a> ?·U?Uˆ?±?? ?¥U„U‰ ?§U„U…?³??UˆU‰ 7', 0),
(81, 1, '<a title="?§U‚U??² ?§U„U‰ ?§U„U…?¯U?U†?©Juma" href="?view=city&id=1">Juma</a></td><td class="date">23.09.2010 19:00</td><td class="subject">?¨U†?§U???Uƒ <a href="?view=palace&id=1&position=5">U‚?µ?±</a> ?·U?Uˆ?±?? ?¥U„U‰ ?§U„U…?³??UˆU‰ 8', 0),
(82, 1, '<a title="?§U‚U??² ?§U„U‰ ?§U„U…?¯U?U†?©Juma" href="?view=city&id=1">Juma</a></td><td class="date">24.09.2010 12:00</td><td class="subject">?¨U†?§U???Uƒ <a href="?view=museum&id=1&position=6"></a> ?·U?Uˆ?±?? ?¥U„U‰ ?§U„U…?³??UˆU‰ 2', 0),
(83, 1, '<a title="?§U‚U??² ?§U„U‰ ?§U„U…?¯U?U†?©Juma" href="?view=city&id=1">Juma</a></td><td class="date">27.09.2010 0:02</td><td class="subject"> U„U‚?¯ ?£U†?´?£?? U…?³???¹U…?±?© ?¬?¯U??¯?© <a href="?view=city&id=37"> U…?­?§U??¶?© </a>UˆU†U‚U„?? ?¥U„U?U‡?§<ul class="resources"><li class="wood"><span class="textLabel">U…?§?¯?© ?µU†?§?¹U??©: </span>500</li></ul>', 0),
(84, 1, '<a title="?§U‚U??² ?§U„U‰ ?§U„U…?¯U?U†?©Juma" href="?view=city&id=1">Juma</a></td><td class="date">27.09.2010 0:02</td><td class="subject"> U„U‚?¯ ?£U†?´?£?? U…?³???¹U…?±?© ?¬?¯U??¯?© <a href="?view=city&id=39"> U…?­?§U??¶?© </a>UˆU†U‚U„?? ?¥U„U?U‡?§<ul class="resources"><li class="wood"><span class="textLabel">U…?§?¯?© ?µU†?§?¹U??©: </span>500</li></ul>', 0),
(85, 1, '<a title="?§U‚U??² ?§U„U‰ ?§U„U…?¯U?U†?©Juma" href="?view=city&id=1">Juma</a></td><td class="date">27.09.2010 0:02</td><td class="subject"> U„U‚?¯ ?£U†?´?£?? U…?³???¹U…?±?© ?¬?¯U??¯?© <a href="?view=city&id=38"> U…?­?§U??¶?© </a>UˆU†U‚U„?? ?¥U„U?U‡?§<ul class="resources"><li class="wood"><span class="textLabel">U…?§?¯?© ?µU†?§?¹U??©: </span>500</li></ul>', 0),
(86, 1, '<a title="?§U‚U??² ?§U„U‰ ?§U„U…?¯U?U†?©Juma" href="?view=city&id=1">Juma</a></td><td class="date">27.09.2010 2:04</td><td class="subject">?¨U†?§U???Uƒ <a href="?view=townHall&id=1&position=0">?¯?§?± ?§U„?¨U„?¯U??©</a> ?·U?Uˆ?±?? ?¥U„U‰ ?§U„U…?³??UˆU‰ 11', 0),
(87, 1, '<a title="?§U‚U??² ?§U„U‰ ?§U„U…?¯U?U†?©kilea" href="?view=city&id=38">kilea</a></td><td class="date">27.09.2010 2:04</td><td class="subject">?¨U†?§U???Uƒ <a href="?view=warehouse&id=38&position=8">U…U†?²U„ ?§U„???­?²U?U†</a> ?·U?Uˆ?±?? ?¥U„U‰ ?§U„U…?³??UˆU‰ 1', 0),
(88, 1, '<a title="?§U‚U??² ?§U„U‰ ?§U„U…?¯U?U†?©donien" href="?view=city&id=39">donien</a></td><td class="date">27.09.2010 2:04</td><td class="subject">?¨U†?§U???Uƒ <a href="?view=warehouse&id=39&position=8">U…U†?²U„ ?§U„???­?²U?U†</a> ?·U?Uˆ?±?? ?¥U„U‰ ?§U„U…?³??UˆU‰ 1', 0),
(89, 1, '<a title="?§U‚U??² ?§U„U‰ ?§U„U…?¯U?U†?©Salera" href="?view=city&id=37">Salera</a></td><td class="date">27.09.2010 2:04</td><td class="subject">?¨U†?§U???Uƒ <a href="?view=warehouse&id=37&position=8">U…U†?²U„ ?§U„???­?²U?U†</a> ?·U?Uˆ?±?? ?¥U„U‰ ?§U„U…?³??UˆU‰ 1', 0),
(90, 1, '<a title="?§U‚U??² ?§U„U‰ ?§U„U…?¯U?U†?©Juma" href="?view=city&id=1">Juma</a></td><td class="date">27.09.2010 3:04</td><td class="subject">?¨U†?§U???Uƒ <a href="?view=architect&id=1&position=4"></a> ?·U?Uˆ?±?? ?¥U„U‰ ?§U„U…?³??UˆU‰ 1', 0),
(91, 1, '<a title="?§U‚U??² ?§U„U‰ ?§U„U…?¯U?U†?©Juma" href="?view=city&id=1">Juma</a></td><td class="date">27.09.2010 0:30</td><td class="subject">?¨U†?§U???Uƒ <a href="?view=architect&id=1&position=4">U…Uƒ???¨ ?§U„U…U‡U†?¯?³</a> ?·U?Uˆ?±?? ?¥U„U‰ ?§U„U…?³??UˆU‰ 1', 0),
(92, 1, '<a title="?§U‚U??² ?§U„U‰ ?§U„U…?¯U?U†?©Juma" href="?view=city&id=1">Juma</a></td><td class="date">27.09.2010 1:50</td><td class="subject">?¨U†?§U???Uƒ <a href="?view=architect&id=1&position=4">U…Uƒ???¨ ?§U„U…U‡U†?¯?³</a> ?·U?Uˆ?±?? ?¥U„U‰ ?§U„U…?³??UˆU‰ 2', 0),
(93, 1, '<a title="?§U‚U??² ?§U„U‰ ?§U„U…?¯U?U†?©Juma" href="?view=city&id=1">Juma</a></td><td class="date">27.09.2010 2:51</td><td class="subject">?¨U†?§U???Uƒ <a href="?view=carpentering&id=1&position=3">U…?¨U†U‰ ?§U„U†?¬?§?±?©</a> ?·U?Uˆ?±?? ?¥U„U‰ ?§U„U…?³??UˆU‰ 1', 0),
(94, 1, '<a title="?§U‚U??² ?§U„U‰ ?§U„U…?¯U?U†?©Juma" href="?view=city&id=1">Juma</a></td><td class="date">28.09.2010 0:48</td><td class="subject">?¨U†?§U???Uƒ <a href="?view=carpentering&id=1&position=3">U…?¨U†U‰ ?§U„U†?¬?§?±?©</a> ?·U?Uˆ?±?? ?¥U„U‰ ?§U„U…?³??UˆU‰ 2', 0),
(95, 1, '<a title="?§U‚U??² ?§U„U‰ ?§U„U…?¯U?U†?©Juma" href="?view=city&id=1">Juma</a></td><td class="date">28.09.2010 2:05</td><td class="subject">?¨U†?§U???Uƒ <a href="?view=forester&id=1&position=12">?¨U??? ?§U„?­?·?§?¨</a> ?·U?Uˆ?±?? ?¥U„U‰ ?§U„U…?³??UˆU‰ 1', 0),
(96, 1, '<a title="?§U‚U??² ?§U„U‰ ?§U„U…?¯U?U†?©Juma" href="?view=city&id=1">Juma</a></td><td class="date">28.09.2010 3:12</td><td class="subject">?¨U†?§U???Uƒ <a href="?view=workshop&id=1&position=13">U…Uƒ?§U† ?¹U…U„ ?§U„U…?®???±?¹U?U†</a> ?·U?Uˆ?±?? ?¥U„U‰ ?§U„U…?³??UˆU‰ 1', 0);

-- --------------------------------------------------------

--
-- Structure de la table `%PREFIX%bunits`
--

CREATE TABLE IF NOT EXISTS `%PREFIX%bunits` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cid` int(11) NOT NULL,
  `u301` int(5) NOT NULL DEFAULT '0',
  `u302` int(5) NOT NULL DEFAULT '0',
  `u303` int(5) NOT NULL DEFAULT '0',
  `u304` int(5) NOT NULL DEFAULT '0',
  `u305` int(5) NOT NULL DEFAULT '0',
  `u306` int(5) NOT NULL DEFAULT '0',
  `u307` int(5) NOT NULL DEFAULT '0',
  `u308` int(5) NOT NULL DEFAULT '0',
  `u309` int(5) NOT NULL DEFAULT '0',
  `u310` int(5) NOT NULL DEFAULT '0',
  `u311` int(5) NOT NULL DEFAULT '0',
  `u312` int(5) NOT NULL DEFAULT '0',
  `u313` int(5) NOT NULL DEFAULT '0',
  `u314` smallint(5) NOT NULL DEFAULT '0',
  `u315` int(5) NOT NULL DEFAULT '0',
  `starttime` int(11) NOT NULL,
  `timestamp` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=30 ;

--
-- Contenu de la table `%PREFIX%bunits`
--


-- --------------------------------------------------------

--
-- Structure de la table `%PREFIX%cdata`
--

CREATE TABLE IF NOT EXISTS `%PREFIX%cdata` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `iid` int(10) unsigned NOT NULL,
  `uid` int(10) unsigned NOT NULL,
  `name` varchar(32) NOT NULL,
  `position` int(2) unsigned NOT NULL,
  `capital` int(2) unsigned NOT NULL,
  `pop` int(5) unsigned NOT NULL,
  `maxpop` int(10) unsigned NOT NULL,
  `citizens` smallint(6) NOT NULL DEFAULT '40',
  `woodworkers` smallint(6) NOT NULL DEFAULT '0',
  `specialworkers` smallint(6) NOT NULL DEFAULT '0',
  `scientists` smallint(6) NOT NULL DEFAULT '0',
  `priests` smallint(6) NOT NULL DEFAULT '0',
  `maxtroops` smallint(6) NOT NULL DEFAULT '300',
  `wood` int(10) unsigned NOT NULL,
  `crystal` int(10) unsigned NOT NULL,
  `marble` int(10) unsigned NOT NULL,
  `sulfur` int(10) unsigned NOT NULL,
  `wine` int(10) unsigned NOT NULL,
  `tavernWine` smallint(4) NOT NULL DEFAULT '0',
  `maxstore` int(10) unsigned NOT NULL DEFAULT '1500',
  `movpoints` int(3) NOT NULL DEFAULT '3',
  `wooddonations` int(12) NOT NULL DEFAULT '0',
  `minedonations` int(12) NOT NULL DEFAULT '0',
  `wonderdonations` int(12) NOT NULL DEFAULT '0',
  `lastupdate` int(11) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=40 ;

--
-- Contenu de la table `%PREFIX%cdata`
--

INSERT INTO `%PREFIX%cdata` (`id`, `iid`, `uid`, `name`, `position`, `capital`, `pop`, `maxpop`, `citizens`, `woodworkers`, `specialworkers`, `scientists`, `priests`, `maxtroops`, `wood`, `crystal`, `marble`, `sulfur`, `wine`, `tavernWine`, `maxstore`, `movpoints`, `wooddonations`, `minedonations`, `wonderdonations`, `lastupdate`) VALUES
(1, 1, 1, 'Juma', 2, 1, 934, 1018, 2185, 24, 0, 22, 0, 600, 538889, 530992, 545846, 550000, 546992, 32, 577500, 13, 740, 0, 0, 1285629320),
(25, 2, 6, 'U…?­?§U??¸?©', 6, 1, 40, 60, 40, 0, 0, 0, 0, 300, 500, 0, 0, 0, 0, 0, 1500, 3, 0, 0, 0, 1285476523),
(38, 1, 1, 'kilea', 3, 0, 60, 60, 60, 0, 0, 0, 0, 300, 382, 0, 0, 0, 0, 0, 33500, 3, 0, 0, 0, 1285629320),
(39, 1, 1, 'donien', 10, 0, 60, 60, 60, 0, 0, 0, 0, 300, 382, 0, 0, 0, 0, 0, 33500, 3, 0, 0, 0, 1285629320),
(37, 2, 1, 'Salera', 9, 0, 60, 60, 60, 0, 0, 0, 0, 300, 382, 0, 0, 0, 0, 0, 33500, 3, 0, 0, 0, 1285629320);

-- --------------------------------------------------------

--
-- Structure de la table `%PREFIX%cspies`
--

CREATE TABLE IF NOT EXISTS `%PREFIX%cspies` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cid` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Contenu de la table `%PREFIX%cspies`
--


-- --------------------------------------------------------

--
-- Structure de la table `%PREFIX%experiments`
--

CREATE TABLE IF NOT EXISTS `%PREFIX%experiments` (
  `uid` int(11) NOT NULL,
  `reqCrystal` int(11) NOT NULL DEFAULT '4300',
  `timestamp` int(11) NOT NULL,
  PRIMARY KEY (`uid`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Contenu de la table `%PREFIX%experiments`
--

INSERT INTO `%PREFIX%experiments` (`uid`, `reqCrystal`, `timestamp`) VALUES
(1, 12005, 0);

-- --------------------------------------------------------

--
-- Structure de la table `%PREFIX%login_log`
--

CREATE TABLE IF NOT EXISTS `%PREFIX%login_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(24) NOT NULL,
  `ip` varchar(16) NOT NULL,
  `time` varchar(32) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=17 ;

--
-- Contenu de la table `%PREFIX%login_log`
--

INSERT INTO `%PREFIX%login_log` (`id`, `username`, `ip`, `time`) VALUES
(1, 'bbbb', '127.0.0.1', 'September 26, 2010, 6:43 am'),
(2, 'bbbb', '127.0.0.1', 'September 26, 2010, 6:48 am'),
(3, 'aaaa', '127.0.0.1', 'September 26, 2010, 6:48 am'),
(4, 'aaaa', '127.0.0.1', 'September 26, 2010, 6:52 am'),
(5, 'aaaa', '127.0.0.1', 'September 14, 2010, 12:14 am'),
(6, 'aaaa', '127.0.0.1', 'September 21, 2010, 9:07 am'),
(7, 'aaaa', '127.0.0.1', 'September 24, 2010, 9:26 am'),
(8, 'aaaa', '127.0.0.1', 'September 26, 2010, 8:08 pm'),
(9, 'aaaa', '127.0.0.1', 'September 26, 2010, 10:07 pm'),
(10, 'aaaa', '127.0.0.1', 'September 26, 2010, 10:10 pm'),
(11, 'aaaa', '127.0.0.1', 'September 27, 2010, 12:02 am'),
(12, 'aaaa', '127.0.0.1', 'September 27, 2010, 12:06 am'),
(13, 'aaaa', '127.0.0.1', 'September 28, 2010, 12:04 am'),
(14, 'aaaa', '127.0.0.1', 'September 28, 2010, 4:49 am'),
(15, 'aaaa', '127.0.0.1', 'September 28, 2010, 12:03 am'),
(16, 'aaaa', '127.0.0.1', 'September 28, 2010, 1:15 am');

-- --------------------------------------------------------

--
-- Structure de la table `%PREFIX%movement`
--

CREATE TABLE IF NOT EXISTS `%PREFIX%movement` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL,
  `from_cid` int(11) NOT NULL,
  `to_cid` int(11) NOT NULL,
  `to_iid` smallint(5) NOT NULL,
  `to_pos` tinyint(2) NOT NULL,
  `ships` smallint(3) NOT NULL,
  `wood` smallint(5) NOT NULL DEFAULT '0',
  `wine` smallint(5) NOT NULL DEFAULT '0',
  `marble` smallint(5) NOT NULL DEFAULT '0',
  `crystal` smallint(5) NOT NULL DEFAULT '0',
  `sulfur` smallint(5) NOT NULL DEFAULT '0',
  `type` varchar(16) NOT NULL,
  `go_back` tinyint(1) NOT NULL DEFAULT '1',
  `journeyTime` int(11) NOT NULL,
  `loadingEndTime` int(11) NOT NULL,
  `endTime` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=20 ;

--
-- Contenu de la table `%PREFIX%movement`
--


-- --------------------------------------------------------

--
-- Structure de la table `%PREFIX%researches`
--

CREATE TABLE IF NOT EXISTS `%PREFIX%researches` (
  `uid` int(11) NOT NULL,
  `R1` tinyint(2) NOT NULL DEFAULT '0',
  `R2` tinyint(2) NOT NULL DEFAULT '0',
  `R3` tinyint(2) NOT NULL DEFAULT '0',
  `R4` tinyint(2) NOT NULL DEFAULT '0',
  PRIMARY KEY (`uid`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Contenu de la table `%PREFIX%researches`
--

INSERT INTO `%PREFIX%researches` (`uid`, `R1`, `R2`, `R3`, `R4`) VALUES
(1, 19, 15, 20, 22);

-- --------------------------------------------------------

--
-- Structure de la table `%PREFIX%ships`
--

CREATE TABLE IF NOT EXISTS `%PREFIX%ships` (
  `cid` int(11) NOT NULL,
  `s210` int(11) NOT NULL,
  `s211` int(11) NOT NULL DEFAULT '0',
  `s212` int(11) NOT NULL DEFAULT '0',
  `s213` int(11) NOT NULL DEFAULT '0',
  `s214` int(11) NOT NULL DEFAULT '0',
  `s215` int(11) NOT NULL DEFAULT '0',
  `s216` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Contenu de la table `%PREFIX%ships`
--

INSERT INTO `%PREFIX%ships` (`cid`, `s210`, `s211`, `s212`, `s213`, `s214`, `s215`, `s216`) VALUES
(1, 2, 5, 3, 1, 2, 0, 10),
(37, 0, 0, 0, 0, 0, 0, 0),
(39, 0, 0, 0, 0, 0, 0, 0),
(25, 0, 0, 0, 0, 0, 0, 0),
(38, 0, 0, 0, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Structure de la table `%PREFIX%units`
--

CREATE TABLE IF NOT EXISTS `%PREFIX%units` (
  `cid` int(11) NOT NULL,
  `u301` int(5) NOT NULL DEFAULT '0',
  `u302` int(5) NOT NULL DEFAULT '0',
  `u303` int(5) NOT NULL DEFAULT '0',
  `u304` int(5) NOT NULL DEFAULT '0',
  `u305` int(5) NOT NULL DEFAULT '0',
  `u306` int(5) NOT NULL DEFAULT '0',
  `u307` int(5) NOT NULL DEFAULT '0',
  `u308` int(5) NOT NULL DEFAULT '0',
  `u309` int(5) NOT NULL DEFAULT '0',
  `u310` int(5) NOT NULL DEFAULT '0',
  `u311` int(5) NOT NULL DEFAULT '0',
  `u312` int(5) NOT NULL DEFAULT '0',
  `u313` int(5) NOT NULL DEFAULT '0',
  `u314` smallint(4) NOT NULL DEFAULT '0',
  `u315` int(5) NOT NULL DEFAULT '0',
  PRIMARY KEY (`cid`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Contenu de la table `%PREFIX%units`
--

INSERT INTO `%PREFIX%units` (`cid`, `u301`, `u302`, `u303`, `u304`, `u305`, `u306`, `u307`, `u308`, `u309`, `u310`, `u311`, `u312`, `u313`, `u314`, `u315`) VALUES
(1, 11, 21, 12, 22, 8, 10, 10, 35, 5, 14, 8, 7, 10, 0, 0),
(37, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(39, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(25, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(38, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Structure de la table `%PREFIX%users`
--

CREATE TABLE IF NOT EXISTS `%PREFIX%users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(32) NOT NULL,
  `password` varchar(32) NOT NULL,
  `email` varchar(32) NOT NULL,
  `access` tinyint(2) NOT NULL,
  `act` int(11) NOT NULL,
  `sessid` int(11) NOT NULL DEFAULT '0',
  `ambrosia` int(11) NOT NULL DEFAULT '0',
  `gold` int(11) NOT NULL DEFAULT '1000',
  `researches` int(11) NOT NULL DEFAULT '0',
  `points` int(11) NOT NULL DEFAULT '40',
  `building_score` int(9) NOT NULL DEFAULT '0',
  `research_score` int(9) NOT NULL DEFAULT '0',
  `army_score` int(9) NOT NULL DEFAULT '0',
  `allyid` int(5) NOT NULL DEFAULT '0',
  `ships` int(3) NOT NULL DEFAULT '0',
  `timestamp` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Contenu de la table `%PREFIX%users`
--

INSERT INTO `%PREFIX%users` (`id`, `username`, `password`, `email`, `access`, `act`, `sessid`, `ambrosia`, `gold`, `researches`, `points`, `building_score`, `research_score`, `army_score`, `allyid`, `ships`, `timestamp`) VALUES
(1, 'aaaa', '4a7d1ed414474e4033ac29ccb8653d9b', 'aa@aa.aa', 0, 0, 3608, 0, 2917830, 7585393, 18321, 14322, 383, 1437, 0, 50, 1285629320),
(6, 'bbbb', '4a7d1ed414474e4033ac29ccb8653d9b', 'bb@bb.bb', 0, 0, 0, 0, 1010, 0, 40, 0, 0, 0, 0, 0, 1285476523);

-- --------------------------------------------------------

--
-- Structure de la table `%PREFIX%wdata`
--

CREATE TABLE IF NOT EXISTS `%PREFIX%wdata` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `itype` tinyint(2) NOT NULL,
  `rtype` varchar(16) NOT NULL,
  `wid` int(11) NOT NULL,
  `isoccupied` tinyint(2) NOT NULL DEFAULT '0',
  `x` int(11) NOT NULL DEFAULT '0',
  `y` int(11) NOT NULL DEFAULT '0',
  `p0` int(11) NOT NULL DEFAULT '0',
  `p1` int(11) NOT NULL DEFAULT '0',
  `p2` int(11) NOT NULL DEFAULT '0',
  `p3` int(11) NOT NULL DEFAULT '0',
  `p4` int(11) NOT NULL DEFAULT '0',
  `p5` int(11) NOT NULL DEFAULT '0',
  `p6` int(11) NOT NULL DEFAULT '0',
  `p7` int(11) NOT NULL DEFAULT '0',
  `p8` int(11) NOT NULL DEFAULT '0',
  `p9` int(11) NOT NULL DEFAULT '0',
  `p10` int(11) NOT NULL DEFAULT '0',
  `p11` int(11) NOT NULL DEFAULT '0',
  `p12` int(11) NOT NULL DEFAULT '0',
  `p13` int(11) NOT NULL DEFAULT '0',
  `p14` int(11) NOT NULL DEFAULT '0',
  `p15` int(11) NOT NULL DEFAULT '0',
  `name` varchar(16) NOT NULL DEFAULT 'Jazeera',
  `woodlevel` tinyint(2) NOT NULL DEFAULT '1',
  `minelevel` tinyint(2) NOT NULL DEFAULT '1',
  `wonderlevel` tinyint(2) NOT NULL DEFAULT '1',
  `wooddonations` int(12) NOT NULL DEFAULT '0',
  `minedonations` int(12) NOT NULL DEFAULT '0',
  `wonderdonations` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Contenu de la table `%PREFIX%wdata`
--

INSERT INTO `%PREFIX%wdata` (`id`, `itype`, `rtype`, `wid`, `isoccupied`, `x`, `y`, `p0`, `p1`, `p2`, `p3`, `p4`, `p5`, `p6`, `p7`, `p8`, `p9`, `p10`, `p11`, `p12`, `p13`, `p14`, `p15`, `name`, `woodlevel`, `minelevel`, `wonderlevel`, `wooddonations`, `minedonations`, `wonderdonations`) VALUES
(1, 2, 'crystal', 1, 0, 14, 15, 0, 0, 1, 38, 0, 0, 0, 0, 0, 0, 39, 0, 0, 0, 0, 0, 'Cymios', 1, 1, 1, 100, 0, 0),
(2, 2, 'wine', 2, 0, 15, 15, 0, 0, 0, 0, 0, 0, 25, 0, 0, 37, 0, 0, 0, 0, 0, 0, 'Slaxios', 1, 1, 1, 0, 0, 0),
(3, 4, 'sulfur', 5, 0, 14, 16, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'Samuios', 1, 1, 1, 0, 0, 0),
(4, 2, 'marble', 8, 0, 17, 16, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'Lohios', 1, 1, 1, 0, 0, 0);
