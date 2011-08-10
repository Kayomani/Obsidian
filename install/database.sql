-- phpMyAdmin SQL Dump
-- version 3.3.9
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Aug 10, 2011 at 09:27 PM
-- Server version: 5.5.8
-- PHP Version: 5.3.5

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `lan`
--

-- --------------------------------------------------------

--
-- Table structure for table `e107_user`
--

CREATE TABLE IF NOT EXISTS `e107_user` (
  `user_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_name` varchar(100) NOT NULL DEFAULT '',
  `user_loginname` varchar(100) NOT NULL DEFAULT '',
  `user_customtitle` varchar(100) NOT NULL DEFAULT '',
  `user_password` varchar(32) NOT NULL DEFAULT '',
  `user_sess` varchar(100) NOT NULL DEFAULT '',
  `user_email` varchar(100) NOT NULL DEFAULT '',
  `user_signature` text NOT NULL,
  `user_image` varchar(100) NOT NULL DEFAULT '',
  `user_timezone` varchar(3) NOT NULL DEFAULT '',
  `user_hideemail` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `user_join` int(10) unsigned NOT NULL DEFAULT '0',
  `user_lastvisit` int(10) unsigned NOT NULL DEFAULT '0',
  `user_currentvisit` int(10) unsigned NOT NULL DEFAULT '0',
  `user_lastpost` int(10) unsigned NOT NULL DEFAULT '0',
  `user_chats` int(10) unsigned NOT NULL DEFAULT '0',
  `user_comments` int(10) unsigned NOT NULL DEFAULT '0',
  `user_forums` int(10) unsigned NOT NULL DEFAULT '0',
  `user_ip` varchar(20) NOT NULL DEFAULT '',
  `user_ban` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `user_prefs` text NOT NULL,
  `user_new` text NOT NULL,
  `user_viewed` text NOT NULL,
  `user_visits` int(10) unsigned NOT NULL DEFAULT '0',
  `user_admin` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `user_login` varchar(100) NOT NULL DEFAULT '',
  `user_class` text NOT NULL,
  `user_perms` text NOT NULL,
  `user_realm` text NOT NULL,
  `user_pwchange` int(10) unsigned NOT NULL DEFAULT '0',
  `user_xup` varchar(100) NOT NULL DEFAULT '',
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `user_name` (`user_name`),
  KEY `user_ban_index` (`user_ban`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `e107_user`
--

INSERT INTO `e107_user` (`user_id`, `user_name`, `user_loginname`, `user_customtitle`, `user_password`, `user_sess`, `user_email`, `user_signature`, `user_image`, `user_timezone`, `user_hideemail`, `user_join`, `user_lastvisit`, `user_currentvisit`, `user_lastpost`, `user_chats`, `user_comments`, `user_forums`, `user_ip`, `user_ban`, `user_prefs`, `user_new`, `user_viewed`, `user_visits`, `user_admin`, `user_login`, `user_class`, `user_perms`, `user_realm`, `user_pwchange`, `user_xup`) VALUES
(1, 'Admin', 'Admin', '', '5f4dcc3b5aa765d61d8327deb882cf99', '', '', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, '', 0, '', '', '', 0, 0, '', '', '', '', 0, '');

-- --------------------------------------------------------

--
-- Table structure for table `e107_user_extended`
--

CREATE TABLE IF NOT EXISTS `e107_user_extended` (
  `user_extended_id` int(10) unsigned NOT NULL DEFAULT '0',
  `user_hidden_fields` text NOT NULL,
  `user_seatID` varchar(255) DEFAULT NULL,
  `user_clantag` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`user_extended_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `e107_user_extended`
--


-- --------------------------------------------------------

--
-- Table structure for table `lan_addons_events`
--

CREATE TABLE IF NOT EXISTS `lan_addons_events` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `lan_id` int(11) NOT NULL,
  `addon_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `lan_addons_events`
--


-- --------------------------------------------------------

--
-- Table structure for table `lan_addons_groups`
--

CREATE TABLE IF NOT EXISTS `lan_addons_groups` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `price` decimal(10,0) NOT NULL,
  `allowSeating` tinyint(1) NOT NULL,
  `availible` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `lan_addons_groups`
--

INSERT INTO `lan_addons_groups` (`id`, `name`, `price`, `allowSeating`, `availible`) VALUES
(1, 'Full weekend', 30, 1, 1),
(2, 'Spectator', 5, 0, 1),
(3, 'Saturday Only', 20, 1, 1),
(4, 'Sunday Only', 20, 1, 1),
(5, 'Staff', 0, 0, 0),
(6, 'Saturday Only (Free)', 0, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `lan_addons_sold`
--

CREATE TABLE IF NOT EXISTS `lan_addons_sold` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `lan_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `addon_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `lan_addons_sold`
--


-- --------------------------------------------------------

--
-- Table structure for table `lan_arrivals`
--

CREATE TABLE IF NOT EXISTS `lan_arrivals` (
  `aid` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `lan_id` int(11) NOT NULL,
  PRIMARY KEY (`aid`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `lan_arrivals`
--


-- --------------------------------------------------------

--
-- Table structure for table `lan_attendees`
--

CREATE TABLE IF NOT EXISTS `lan_attendees` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `lan_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `lan_attendees`
--


-- --------------------------------------------------------

--
-- Table structure for table `lan_events`
--

CREATE TABLE IF NOT EXISTS `lan_events` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `mode_id` int(11) NOT NULL,
  `start` datetime NOT NULL,
  `end` datetime NOT NULL,
  `places` int(11) NOT NULL,
  `layout` text NOT NULL,
  `text` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `lan_events`
--

INSERT INTO `lan_events` (`id`, `name`, `mode_id`, `start`, `end`, `places`, `layout`, `text`) VALUES
(1, 'Test Lan', 0, '2010-08-05 01:00:00', '2010-08-07 01:00:00', 50, 'images/Lanops.8.rev.2.5.png', 'Test lan desc');

-- --------------------------------------------------------

--
-- Table structure for table `lan_games`
--

CREATE TABLE IF NOT EXISTS `lan_games` (
  `game_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` text NOT NULL,
  `picture` text NOT NULL,
  PRIMARY KEY (`game_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=835 ;

--
-- Dumping data for table `lan_games`
--

INSERT INTO `lan_games` (`game_id`, `name`, `picture`) VALUES
(1, 'Act of War Direct Action ', 'Act-of-War-Direct-Action.png'),
(2, 'Act of War High Treason ', 'Act-of-War-High-Treason.png'),
(3, 'Age of Conan ', 'Age-of-Conan.png'),
(4, 'Age of Empires II The Conquerors ', 'Age-of-Empires-II-The-Conquerors.png'),
(5, 'Age of Empires II ', 'Age-of-Empires-II.png'),
(6, 'Age of Empires III Complete Collection ', 'Age-of-Empires-III-Complete-Collection.png'),
(7, 'Age of Empires III Gold Edition ', 'Age-of-Empires-III-Gold-Edition.png'),
(8, 'Age of Empires III The Asian Dynasties ', 'Age-of-Empires-III-The-Asian-Dynasties.png'),
(9, 'Age of Empires III The WarChiefs ', 'Age-of-Empires-III-The-WarChiefs.png'),
(10, 'Age of Empires III ', 'Age-of-Empires-III.png'),
(11, 'Age of Empires ', 'Age-of-Empires.png'),
(12, 'Age of Mythology The Titans ', 'Age-of-Mythology-The-Titans.png'),
(13, 'Age of Mythology ', 'Age-of-Mythology.png'),
(14, 'Age of Pirates 2 ', 'Age-of-Pirates-2.png'),
(15, 'Age of Pirates ', 'Age-of-Pirates.png'),
(16, 'Age of Wonders Shadow Magic ', 'Age-of-Wonders-Shadow-Magic.png'),
(17, 'Aggression Reign over Europe ', 'Aggression-Reign-over-Europe.png'),
(18, 'Aion The Tower of Eternity ', 'Aion-The-Tower-of-Eternity.png'),
(19, 'Aion ', 'Aion.png'),
(20, 'Air Conflicts Air Battles of World War II ', 'Air-Conflicts-Air-Battles-of-World-War-II.png'),
(21, 'Alarm for Cobra 11 Crash Time 2 ', 'Alarm-for-Cobra-11-Crash-Time-2.png'),
(22, 'Alexander ', 'Alexander.png'),
(23, 'Alien Breed Evolution ', 'Alien-Breed-Evolution.png'),
(24, 'Alien Shooter 2 ', 'Alien-Shooter-2.png'),
(25, 'Alien Shooter Vengeance ', 'Alien-Shooter-Vengeance.png'),
(26, 'Aliens versus Predator 2 Primal Hunt ', 'Aliens-versus-Predator-2-Primal-Hunt.png'),
(27, 'Aliens versus Predator 2 ', 'Aliens-versus-Predator-2.png'),
(28, 'Aliens versus Predator ', 'Aliens-versus-Predator.png'),
(29, 'Aliens vs Predator ', 'Aliens-vs-Predator.png'),
(30, 'Alpha Prime ', 'Alpha-Prime.png'),
(31, 'America''s Army 3 ', 'America''s-Army-3.png'),
(32, 'American Civil War ', 'American-Civil-War.png'),
(33, 'American Conquest Fight Back ', 'American-Conquest-Fight-Back.png'),
(34, 'American Conquest ', 'American-Conquest.png'),
(35, 'Anno 1404 Venice ', 'Anno-1404-Venice.png'),
(36, 'Anno 1404 ', 'Anno-1404.png'),
(37, 'Anno 1503 The New World ', 'Anno-1503-The-New-World.png'),
(38, 'Anno 1503 Treasures, Monsters & Pirates ', 'Anno-1503-Treasures,-Monsters-&-Pirates.png'),
(39, 'Anno 1701   The Sunken Dragon ', 'Anno-1701---The-Sunken-Dragon.png'),
(40, 'Anno 1701 ', 'Anno-1701.png'),
(41, 'Apocalyptica ', 'Apocalyptica.png'),
(42, 'ArchLord ', 'ArchLord.png'),
(43, 'Area 51 ', 'Area-51.png'),
(44, 'Arena Wars ', 'Arena-Wars.png'),
(45, 'Arma 2 ', 'Arma-2.png'),
(46, 'Arma Armed Assault ', 'Arma-Armed-Assault.png'),
(47, 'Armada 2526 ', 'Armada-2526.png'),
(48, 'Armed & Dangerous ', 'Armed-&-Dangerous.png'),
(49, 'Armies of Exigo ', 'Armies-of-Exigo.png'),
(50, 'Army Men Sarge''s War ', 'Army-Men-Sarge''s-War.png'),
(51, 'Arsenal of Democracy ', 'Arsenal-of-Democracy.png'),
(52, 'Audiosurf ', 'Audiosurf.png'),
(53, 'Auto Assault ', 'Auto-Assault.png'),
(54, 'Axis & Allies ', 'Axis-&-Allies.png'),
(55, 'B.A.S.E. Jumping ', 'B.A.S.E.-Jumping.png'),
(56, 'Battle Forge ', 'Battle-Forge.png'),
(57, 'Battle Rage The Robot Wars ', 'Battle-Rage-The-Robot-Wars.png'),
(58, 'Battlefield 1942 Secret Weapons of WWII ', 'Battlefield-1942-Secret-Weapons-of-WWII.png'),
(59, 'Battlefield 1942 The Road to Rome ', 'Battlefield-1942-The-Road-to-Rome.png'),
(60, 'Battlefield 1942 ', 'Battlefield-1942.png'),
(61, 'Battlefield 1943 ', 'Battlefield-1943.png'),
(62, 'Battlefield 2 Complete Collection ', 'Battlefield-2-Complete-Collection.png'),
(63, 'Battlefield 2 Project Reality ', 'Battlefield-2-Project-Reality.png'),
(64, 'Battlefield 2 SF ', 'Battlefield-2-SF.png'),
(65, 'Battlefield 2 ', 'Battlefield-2.png'),
(66, 'Battlefield 2142 Deluxe Edition ', 'Battlefield-2142-Deluxe-Edition.png'),
(67, 'Battlefield 2142 Northern Strike ', 'Battlefield-2142-Northern-Strike.png'),
(68, 'Battlefield 2142 ', 'Battlefield-2142.png'),
(69, 'Battlefield Bad Company 2 Limited Edition ', 'Battlefield-Bad-Company-2-Limited-Edition.png'),
(70, 'Battlefield Bad Company 2 ', 'Battlefield-Bad-Company-2.png'),
(71, 'Battlefield Heroes ', 'Battlefield-Heroes.png'),
(72, 'Battlefield Vietnam ', 'Battlefield-Vietnam.png'),
(73, 'Battlestations Midway ', 'Battlestations-Midway.png'),
(74, 'Battlestations Pacific ', 'Battlestations-Pacific.png'),
(75, 'Battlestrike Shadow Of Stalingrad ', 'Battlestrike-Shadow-Of-Stalingrad.png'),
(76, 'Beowulf The Game ', 'Beowulf-The-Game.png'),
(77, 'Besieger ', 'Besieger.png'),
(78, 'Beyond Divinity ', 'Beyond-Divinity.png'),
(79, 'BIA HH ', 'BIA-HH.png'),
(80, 'Bionic Commando Rearmed ', 'Bionic-Commando-Rearmed.png'),
(81, 'Bionic Commando ', 'Bionic-Commando.png'),
(82, 'Black & White 2 Battle of the Gods ', 'Black-&-White-2-Battle-of-the-Gods.png'),
(83, 'Black & White 2 ', 'Black-&-White-2.png'),
(84, 'Black Buccaneer ', 'Black-Buccaneer.png'),
(85, 'BlackSite Area 51 ', 'BlackSite-Area-51.png'),
(86, 'BlazBlue Calamity Trigger ', 'BlazBlue-Calamity-Trigger.png'),
(87, 'BlazBlue Continuum Shift ', 'BlazBlue-Continuum-Shift.png'),
(88, 'Blazing Angels Squadrons of WWII ', 'Blazing-Angels-Squadrons-of-WWII.png'),
(89, 'Blitzkrieg Attack is the only Defense ', 'Blitzkrieg-Attack-is-the-only-Defense.png'),
(90, 'Blood Bowl ', 'Blood-Bowl.png'),
(91, 'BloodRayne 2 ', 'BloodRayne-2.png'),
(92, 'BloodRayne ', 'BloodRayne.png'),
(93, 'Blur ', 'Blur.png'),
(94, 'Boiling Point Road to Hell ', 'Boiling-Point-Road-to-Hell.png'),
(95, 'Borderlands ', 'Borderlands.png'),
(96, 'BorderZone ', 'BorderZone.png'),
(97, 'Braid ', 'Braid.png'),
(98, 'Breed ', 'Breed.png'),
(99, 'Broken Sword The Sleeping Dragon ', 'Broken-Sword-The-Sleeping-Dragon.png'),
(100, 'Brothers in Arms Earned In Blood ', 'Brothers-in-Arms-Earned-In-Blood.png'),
(101, 'Brothers in Arms Road to Hill 30 ', 'Brothers-in-Arms-Road-to-Hill-30.png'),
(102, 'Burnout Paradise The Ultimate Box ', 'Burnout-Paradise-The-Ultimate-Box.png'),
(103, 'Bus Simulator 2009 ', 'Bus-Simulator-2009.png'),
(104, 'Caesar IV ', 'Caesar-IV.png'),
(105, 'Call of Duty 2 ', 'Call-of-Duty-2.png'),
(106, 'Call of Duty 4 ', 'Call-of-Duty-4.png'),
(107, 'Call of Duty Modern Warfare 2 ', 'Call-of-Duty-Modern-Warfare-2.png'),
(108, 'Call of Duty United Offensive ', 'Call-of-Duty-United-Offensive.png'),
(109, 'Call of Duty WAW ', 'Call-of-Duty-WAW.png'),
(110, 'Call of Duty ', 'Call-of-Duty.png'),
(111, 'Call of Juarez Bound in Blood ', 'Call-of-Juarez-Bound-in-Blood.png'),
(112, 'Call of Juarez ', 'Call-of-Juarez.png'),
(113, 'Champions Online ', 'Champions-Online.png'),
(114, 'Championship Manager 03 04 ', 'Championship-Manager-03-04.png'),
(115, 'Championship Manager 2009 ', 'Championship-Manager-2009.png'),
(116, 'Championship Manager 2010 ', 'Championship-Manager-2010.png'),
(117, 'Championship Manager 4 ', 'Championship-Manager-4.png'),
(118, 'Championship Manager 5 ', 'Championship-Manager-5.png'),
(119, 'Chrome Specforce ', 'Chrome-Specforce.png'),
(120, 'Chrome ', 'Chrome.png'),
(121, 'City of Villains ', 'City-of-Villains.png'),
(122, 'Civ 4 Beyond the Sword ', 'Civ-4-Beyond-the-Sword.png'),
(123, 'Civ 4 Colonization ', 'Civ-4-Colonization.png'),
(124, 'Civ 4 Warlords ', 'Civ-4-Warlords.png'),
(125, 'Civ 4 ', 'Civ-4.png'),
(126, 'Civilization III Conquests ', 'Civilization-III-Conquests.png'),
(127, 'Clive Barkers Jericho ', 'Clive-Barkers-Jericho.png'),
(128, 'Code of Honor 2 Conspiracy Island ', 'Code-of-Honor-2-Conspiracy-Island.png'),
(129, 'Code Of Honor 3 ', 'Code-Of-Honor-3.png'),
(130, 'Code of Honor ', 'Code-of-Honor.png'),
(131, 'Codename Panzers Cold War ', 'Codename-Panzers-Cold-War.png'),
(132, 'Codename Panzers Phase One ', 'Codename-Panzers-Phase-One.png'),
(133, 'Cold Fear ', 'Cold-Fear.png'),
(134, 'Colin McRae Dirt 2 ', 'Colin-McRae-Dirt-2.png'),
(135, 'Colin McRae Rally 04 ', 'Colin-McRae-Rally-04.png'),
(136, 'Colin McRae Rally 2.0 ', 'Colin-McRae-Rally-2.0.png'),
(137, 'Colin McRae Rally 2005 ', 'Colin-McRae-Rally-2005.png'),
(138, 'Colin McRae Rally 3 ', 'Colin-McRae-Rally-3.png'),
(139, 'Colin McRae Rally ', 'Colin-McRae-Rally.png'),
(140, 'Combat Arms ', 'Combat-Arms.png'),
(141, 'Command & Conquer 3 Kane Edition ', 'Command-&-Conquer-3-Kane-Edition.png'),
(142, 'Command & Conquer 3 Kanes Wrath ', 'Command-&-Conquer-3-Kanes-Wrath.png'),
(143, 'Command & Conquer 3 Tiberium Wars ', 'Command-&-Conquer-3-Tiberium-Wars.png'),
(144, 'Command & Conquer 4 Tiberian Twilight ', 'Command-&-Conquer-4-Tiberian-Twilight.png'),
(145, 'Command & Conquer Generals Zero Hour ', 'Command-&-Conquer-Generals-Zero-Hour.png'),
(146, 'Command & Conquer Generals ', 'Command-&-Conquer-Generals.png'),
(147, 'Command & Conquer Renegade ', 'Command-&-Conquer-Renegade.png'),
(148, 'Commandos 3 Destination Berlin ', 'Commandos-3-Destination-Berlin.png'),
(149, 'Company of Heroes Eastern Front ', 'Company-of-Heroes-Eastern-Front.png'),
(150, 'Company of Heroes OF ', 'Company-of-Heroes-OF.png'),
(151, 'Company of Heroes Tales of Valor ', 'Company-of-Heroes-Tales-of-Valor.png'),
(152, 'Company of Heroes ', 'Company-of-Heroes.png'),
(153, 'Condemned Criminal Origins ', 'Condemned-Criminal-Origins.png'),
(154, 'Conflict Denied Ops ', 'Conflict-Denied-Ops.png'),
(155, 'Conflict Desert Storm II ', 'Conflict-Desert-Storm-II.png'),
(156, 'Conflict Vietnam ', 'Conflict-Vietnam.png'),
(157, 'Counter Strike Condition Zero ', 'Counter-Strike-Condition-Zero.png'),
(158, 'Counter Strike Source ', 'Counter-Strike-Source.png'),
(159, 'Crash Time 3 ', 'Crash-Time-3.png'),
(160, 'Crash Time ', 'Crash-Time.png'),
(161, 'Crashday ', 'Crashday.png'),
(162, 'CrimeCraft ', 'CrimeCraft.png'),
(163, 'Crimes of War ', 'Crimes-of-War.png'),
(164, 'Cross Fire ', 'Cross-Fire.png'),
(165, 'Crysis Warhead ', 'Crysis-Warhead.png'),
(166, 'Crysis Wars ', 'Crysis-Wars.png'),
(167, 'Crysis ', 'Crysis.png'),
(168, 'D Day ', 'D-Day.png'),
(169, 'Damnation ', 'Damnation.png'),
(170, 'Dark Age of Camelot ', 'Dark-Age-of-Camelot.png'),
(171, 'Dark Horizon ', 'Dark-Horizon.png'),
(172, 'Dark Messiah of Might and Magic ', 'Dark-Messiah-of-Might-and-Magic.png'),
(173, 'Dark Sector ', 'Dark-Sector.png'),
(174, 'Dark Void ', 'Dark-Void.png'),
(175, 'Darkness Within ', 'Darkness-Within.png'),
(176, 'Darksiders ', 'Darksiders.png'),
(177, 'DarkStar One ', 'DarkStar-One.png'),
(178, 'Dawn of Magic 2 ', 'Dawn-of-Magic-2.png'),
(179, 'Dawn of Magic ', 'Dawn-of-Magic.png'),
(180, 'Dawn of War Soulstorm ', 'Dawn-of-War-Soulstorm.png'),
(181, 'Dawnspire ', 'Dawnspire.png'),
(182, 'Day of Defeat Source ', 'Day-of-Defeat-Source.png'),
(183, 'Day of Defeat ', 'Day-of-Defeat.png'),
(184, 'Day of the Zombie ', 'Day-of-the-Zombie.png'),
(185, 'Death Track Resurrection ', 'Death-Track-Resurrection.png'),
(186, 'Deathmatch Classic ', 'Deathmatch-Classic.png'),
(187, 'Delta Force Black Hawk Down Team Sabre ', 'Delta-Force-Black-Hawk-Down-Team-Sabre.png'),
(188, 'Delta Force Black Hawk Down ', 'Delta-Force-Black-Hawk-Down.png'),
(189, 'Delta Force Xtreme 2 ', 'Delta-Force-Xtreme-2.png'),
(190, 'Delta Force Xtreme ', 'Delta-Force-Xtreme.png'),
(191, 'Demigod ', 'Demigod.png'),
(192, 'Descent II The Infinite Abyss ', 'Descent-II-The-Infinite-Abyss.png'),
(193, 'Descent ', 'Descent.png'),
(194, 'Deus Ex Invisible War ', 'Deus-Ex-Invisible-War.png'),
(195, 'Deus Ex ', 'Deus-Ex.png'),
(196, 'Diablo Hellfire ', 'Diablo-Hellfire.png'),
(197, 'Diablo II Lord of Destruction ', 'Diablo-II-Lord-of-Destruction.png'),
(198, 'Diablo II ', 'Diablo-II.png'),
(199, 'Diablo ', 'Diablo.png'),
(200, 'Diabolik The Original Sin ', 'Diabolik-The-Original-Sin.png'),
(201, 'Dimensity ', 'Dimensity.png'),
(202, 'DIRT Origin of the Species ', 'DIRT-Origin-of-the-Species.png'),
(203, 'Dirt ', 'Dirt.png'),
(204, 'Disciples III Renaissance ', 'Disciples-III-Renaissance.png'),
(205, 'Doom 2 ', 'Doom-2.png'),
(206, 'Doom 3 ROE ', 'Doom-3-ROE.png'),
(207, 'Doom 3 ', 'Doom-3.png'),
(208, 'Doom 64 ', 'Doom-64.png'),
(209, 'Downtown Run ', 'Downtown-Run.png'),
(210, 'Driv3r ', 'Driv3r.png'),
(211, 'Driver Parallel Lines ', 'Driver-Parallel-Lines.png'),
(212, 'Dungeon Siege II Broken World ', 'Dungeon-Siege-II-Broken-World.png'),
(213, 'Dungeon Siege II ', 'Dungeon-Siege-II.png'),
(214, 'Dungeon Siege Legends of Aranna ', 'Dungeon-Siege-Legends-of-Aranna.png'),
(215, 'Dungeon Siege ', 'Dungeon-Siege.png'),
(216, 'Dungeons & Dragons Online Stormreach ', 'Dungeons-&-Dragons-Online-Stormreach.png'),
(217, 'Dynasty Warriors 6 ', 'Dynasty-Warriors-6.png'),
(218, 'Echelon Wind Warriors ', 'Echelon-Wind-Warriors.png'),
(219, 'Empire Earth 3 ', 'Empire-Earth-3.png'),
(220, 'Empire Earth II The Art of Supremacy ', 'Empire-Earth-II-The-Art-of-Supremacy.png'),
(221, 'Empire Earth II ', 'Empire-Earth-II.png'),
(222, 'Empire Total War ', 'Empire-Total-War.png'),
(223, 'Europa Universalis III ', 'Europa-Universalis-III.png'),
(224, 'Europa Universalis Rome Gold ', 'Europa-Universalis-Rome-Gold.png'),
(225, 'Europa Universalis Rome ', 'Europa-Universalis-Rome.png'),
(226, 'Eve Online Special Edition ', 'Eve-Online-Special-Edition.png'),
(227, 'Everquest II Sentinel''s Fate ', 'Everquest-II-Sentinel''s-Fate.png'),
(228, 'EverQuest II The Shadow Odyssey ', 'EverQuest-II-The-Shadow-Odyssey.png'),
(229, 'EverQuest Lost Dungeons of Norrath ', 'EverQuest-Lost-Dungeons-of-Norrath.png'),
(230, 'F.E.A.R. 2 Project Origin ', 'F.E.A.R.-2-Project-Origin.png'),
(231, 'F.E.A.R. 3 ', 'F.E.A.R.-3.png'),
(232, 'F.E.A.R. Extraction Point ', 'F.E.A.R.-Extraction-Point.png'),
(233, 'F.E.A.R. Perseus Mandate ', 'F.E.A.R.-Perseus-Mandate.png'),
(234, 'F.E.A.R. ', 'F.E.A.R..png'),
(235, 'Fable 3 ', 'Fable-3.png'),
(236, 'Far Cry 2 ', 'Far-Cry-2.png'),
(237, 'FarCry ', 'FarCry.png'),
(238, 'FIFA 06 ', 'FIFA-06.png'),
(239, 'FIFA 07 ', 'FIFA-07.png'),
(240, 'FIFA 08 ', 'FIFA-08.png'),
(241, 'FIFA 09 ', 'FIFA-09.png'),
(242, 'FIFA 10 ', 'FIFA-10.png'),
(243, 'FIFA Football 2004 ', 'FIFA-Football-2004.png'),
(244, 'FIFA Football 2005 ', 'FIFA-Football-2005.png'),
(245, 'FIFA Manager 06 ', 'FIFA-Manager-06.png'),
(246, 'FIFA Manager 07 ', 'FIFA-Manager-07.png'),
(247, 'FIFA Manager 08 ', 'FIFA-Manager-08.png'),
(248, 'FIFA Manager 09 ', 'FIFA-Manager-09.png'),
(249, 'FIFA Manager 10 (EU) ', 'FIFA-Manager-10 (EU).png'),
(250, 'FIFA Manager 10 ', 'FIFA-Manager-10.png'),
(251, 'FIFA Soccer 09 ', 'FIFA-Soccer-09.png'),
(252, 'Final Doom ', 'Final-Doom.png'),
(253, 'FlatOut 2 ', 'FlatOut-2.png'),
(254, 'Flatout Ultimate Carnage ', 'Flatout-Ultimate-Carnage.png'),
(255, 'FlatOut ', 'FlatOut.png'),
(256, 'Football Manager 2005 ', 'Football-Manager-2005.png'),
(257, 'Football Manager 2006 ', 'Football-Manager-2006.png'),
(258, 'Football Manager 2007 ', 'Football-Manager-2007.png'),
(259, 'Football Manager 2008 ', 'Football-Manager-2008.png'),
(260, 'Football Manager 2009 ', 'Football-Manager-2009.png'),
(261, 'Football Manager 2010 ', 'Football-Manager-2010.png'),
(262, 'Football Manager Live ', 'Football-Manager-Live.png'),
(263, 'Freelancer ', 'Freelancer.png'),
(264, 'FreeSpace 2 ', 'FreeSpace-2.png'),
(265, 'Frets on Fire Rock Band ', 'Frets-on-Fire-Rock-Band.png'),
(266, 'Front Mission Evolved (EU) ', 'Front-Mission-Evolved (EU).png'),
(267, 'Front Mission Evolved (US) ', 'Front-Mission-Evolved (US).png'),
(268, 'Frontline Fields of Thunder ', 'Frontline-Fields-of-Thunder.png'),
(269, 'Frontlines Fuel of War ', 'Frontlines-Fuel-of-War.png'),
(270, 'Fuel (FB) ', 'Fuel (FB).png'),
(271, 'FUEL ', 'FUEL.png'),
(272, 'Full Spectrum Warrior Ten Hammers ', 'Full-Spectrum-Warrior-Ten-Hammers.png'),
(273, 'Full Spectrum Warrior ', 'Full-Spectrum-Warrior.png'),
(274, 'Garry''s Mod ', 'Garry''s-Mod.png'),
(275, 'GearGrinder ', 'GearGrinder.png'),
(276, 'Gears of War ', 'Gears-of-War.png'),
(277, 'Ghost Recon Advanced Warfighter 2 ', 'Ghost-Recon-Advanced-Warfighter-2.png'),
(278, 'Ghost Recon Advanced Warfighter ', 'Ghost-Recon-Advanced-Warfighter.png'),
(279, 'Global Agenda ', 'Global-Agenda.png'),
(280, 'God of War 2 ', 'God-of-War-2.png'),
(281, 'Grand Ages Rome (alt) ', 'Grand-Ages-Rome (alt).png'),
(282, 'Grand Ages Rome ', 'Grand-Ages-Rome.png'),
(283, 'Grand Theft Auto 2 ', 'Grand-Theft-Auto-2.png'),
(284, 'Grand Theft Auto Episodes from Liberty City ', 'Grand-Theft-Auto-Episodes-from-Liberty-City.png'),
(285, 'Grand Theft Auto III (FB) ', 'Grand-Theft-Auto-III (FB).png'),
(286, 'Grand Theft Auto III ', 'Grand-Theft-Auto-III.png'),
(287, 'Grand Theft Auto San Andreas ', 'Grand-Theft-Auto-San-Andreas.png'),
(288, 'Grand Theft Auto Vice City ', 'Grand-Theft-Auto-Vice-City.png'),
(289, 'GRID ', 'GRID.png'),
(290, 'GTA4 ', 'GTA4.png'),
(291, 'GTR 2 ', 'GTR-2.png'),
(292, 'GTR Evolution ', 'GTR-Evolution.png'),
(293, 'GTR FIA GT Racing Game ', 'GTR-FIA-GT-Racing-Game.png'),
(294, 'Guild Wars Eye of the North ', 'Guild-Wars-Eye-of-the-North.png'),
(295, 'Guild Wars Factions ', 'Guild-Wars-Factions.png'),
(296, 'Guild Wars Nightfall ', 'Guild-Wars-Nightfall.png'),
(297, 'Guild Wars Platinum Edition ', 'Guild-Wars-Platinum-Edition.png'),
(298, 'Guild Wars ', 'Guild-Wars.png'),
(299, 'GUN ', 'GUN.png'),
(300, 'Half Life 2 Deathmatch ', 'Half-Life-2-Deathmatch.png'),
(301, 'Half Life 2 ', 'Half-Life-2.png'),
(302, 'Half Life Counter Strike ', 'Half-Life-Counter-Strike.png'),
(303, 'Half Life Deathmatch Source ', 'Half-Life-Deathmatch-Source.png'),
(304, 'Half Life Opposing Force ', 'Half-Life-Opposing-Force.png'),
(305, 'Half Life Source ', 'Half-Life-Source.png'),
(306, 'Half Life ', 'Half-Life.png'),
(307, 'Halo 2 ', 'Halo-2.png'),
(308, 'Halo ', 'Halo.png'),
(309, 'Hearts of Iron III Semper Fi ', 'Hearts-of-Iron-III-Semper-Fi.png'),
(310, 'Heretic 2 ', 'Heretic-2.png'),
(311, 'Heroes of Might and Magic III ', 'Heroes-of-Might-and-Magic-III.png'),
(312, 'Heroes of Might and Magic IV Gathering Storm ', 'Heroes-of-Might-and-Magic-IV-Gathering-Storm.png'),
(313, 'Heroes of Might and Magic IV Winds of War ', 'Heroes-of-Might-and-Magic-IV-Winds-of-War.png'),
(314, 'Heroes of Might and Magic IV ', 'Heroes-of-Might-and-Magic-IV.png'),
(315, 'Heroes of Might and Magic V Hammers of Fate ', 'Heroes-of-Might-and-Magic-V-Hammers-of-Fate.png'),
(316, 'Heroes of Might and Magic V Tribes of the East ', 'Heroes-of-Might-and-Magic-V-Tribes-of-the-East.png'),
(317, 'Heroes of Might and Magic V ', 'Heroes-of-Might-and-Magic-V.png'),
(318, 'Heroes of Newerth ', 'Heroes-of-Newerth.png'),
(319, 'Heroes over Europe ', 'Heroes-over-Europe.png'),
(320, 'Hexen 2 Portal of Praevus ', 'Hexen-2-Portal-of-Praevus.png'),
(321, 'Hexen 2 ', 'Hexen-2.png'),
(322, 'Hexen Deathkings of the Dark Citadel ', 'Hexen-Deathkings-of-the-Dark-Citadel.png'),
(323, 'Hexen ', 'Hexen.png'),
(324, 'Hidden & Dangerous 2 Sabre Squadron ', 'Hidden-&-Dangerous-2-Sabre-Squadron.png'),
(325, 'Hidden & Dangerous 2 ', 'Hidden-&-Dangerous-2.png'),
(326, 'Hidden Stroke II ', 'Hidden-Stroke-II.png'),
(327, 'Homeworld 2 ', 'Homeworld-2.png'),
(328, 'IGI 2 Covert Strike ', 'IGI-2-Covert-Strike.png'),
(329, 'Juiced 2 Hot Import Nights ', 'Juiced-2-Hot-Import-Nights.png'),
(330, 'Juiced ', 'Juiced.png'),
(331, 'Jumpgate Evolution ', 'Jumpgate-Evolution.png'),
(332, 'Just Cause 2 ', 'Just-Cause-2.png'),
(333, 'Just Cause ', 'Just-Cause.png'),
(334, 'Kane & Lynch 2 Dog Days (FB) ', 'Kane-&-Lynch-2-Dog-Days (FB).png'),
(335, 'Kane & Lynch Dead Men ', 'Kane-&-Lynch-Dead-Men.png'),
(336, 'KAROS Online ', 'KAROS-Online.png'),
(337, 'Kart Racer ', 'Kart-Racer.png'),
(338, 'Kharkov Disaster on the Donets ', 'Kharkov-Disaster-on-the-Donets.png'),
(339, 'Killing Floor ', 'Killing-Floor.png'),
(340, 'Kreed ', 'Kreed.png'),
(341, 'Left 4 Dead 2 ', 'Left-4-Dead-2.png'),
(342, 'Left 4 Dead ', 'Left-4-Dead.png'),
(343, 'Legio ', 'Legio.png'),
(344, 'LEGO Drome Racers ', 'LEGO-Drome-Racers.png'),
(345, 'Lineage II The Chaotic Throne ', 'Lineage-II-The-Chaotic-Throne.png'),
(346, 'Maelstrom ', 'Maelstrom.png'),
(347, 'Mafia ', 'Mafia.png'),
(348, 'Magic The Gathering Battlegrounds ', 'Magic-The-Gathering-Battlegrounds.png'),
(349, 'Manhunt 2 ', 'Manhunt-2.png'),
(350, 'Manhunt ', 'Manhunt.png'),
(351, 'Mashed ', 'Mashed.png'),
(352, 'Max Payne 2 ', 'Max-Payne-2.png'),
(353, 'Medal of Honor Airborne ', 'Medal-of-Honor-Airborne.png'),
(354, 'Medal of Honor Allied Assault Breakthrough ', 'Medal-of-Honor-Allied-Assault-Breakthrough.png'),
(355, 'Medal of Honor Allied Assault ', 'Medal-of-Honor-Allied-Assault.png'),
(356, 'Medal of Honor Pacific Assault ', 'Medal-of-Honor-Pacific-Assault.png'),
(357, 'Medieval II Total War Gold Edition ', 'Medieval-II-Total-War-Gold-Edition.png'),
(358, 'Medieval II Total War Kingdoms ', 'Medieval-II-Total-War-Kingdoms.png'),
(359, 'Medieval II Total War ', 'Medieval-II-Total-War.png'),
(360, 'Medieval Lords ', 'Medieval-Lords.png'),
(361, 'Mercenaries 2 ', 'Mercenaries-2.png'),
(362, 'Metal Gear Solid 2 Substance ', 'Metal-Gear-Solid-2-Substance.png'),
(363, 'Metro 2033 ', 'Metro-2033.png'),
(364, 'Midnight Club 2 ', 'Midnight-Club-2.png'),
(365, 'Midtown Madness 2 ', 'Midtown-Madness-2.png'),
(366, 'Midtown Madness ', 'Midtown-Madness.png'),
(367, 'Military History Commander Europe at War ', 'Military-History-Commander-Europe-at-War.png'),
(368, 'Mortal Online ', 'Mortal-Online.png'),
(369, 'MotoGP 08 ', 'MotoGP-08.png'),
(370, 'MotoGP 2 ', 'MotoGP-2.png'),
(371, 'Mount & Blade Warband (FB) ', 'Mount-&-Blade-Warband (FB).png'),
(372, 'Multiwinia ', 'Multiwinia.png'),
(373, 'Napoleon Total War ', 'Napoleon-Total-War.png'),
(374, 'NecroVisioN Lost Company ', 'NecroVisioN-Lost-Company.png'),
(375, 'Need for Speed Hot Pursuit 2 ', 'Need-for-Speed-Hot-Pursuit-2.png'),
(376, 'Need for Speed SHIFT ', 'Need-for-Speed-SHIFT.png'),
(377, 'Need for Speed Underground 2 ', 'Need-for-Speed-Underground-2.png'),
(378, 'Need for Speed Underground ', 'Need-for-Speed-Underground.png'),
(379, 'NEOTOKYO ', 'NEOTOKYO.png'),
(380, 'Neverwinter Nights 2 Gold ', 'Neverwinter-Nights-2-Gold.png'),
(381, 'Neverwinter Nights 2 Mask of the Betrayer ', 'Neverwinter-Nights-2-Mask-of-the-Betrayer.png'),
(382, 'Neverwinter Nights 2 Storm of Zehir ', 'Neverwinter-Nights-2-Storm-of-Zehir.png'),
(383, 'Neverwinter Nights 2 ', 'Neverwinter-Nights-2.png'),
(384, 'Neverwinter Nights Hordes of the Underdark ', 'Neverwinter-Nights-Hordes-of-the-Underdark.png'),
(385, 'Neverwinter Nights Shadows of Undrentide ', 'Neverwinter-Nights-Shadows-of-Undrentide.png'),
(386, 'Neverwinter Nights ', 'Neverwinter-Nights.png'),
(387, 'Nexus The Jupiter Incident ', 'Nexus-The-Jupiter-Incident.png'),
(388, 'NFS Carbon ', 'NFS-Carbon.png'),
(389, 'NFS Most Wanted ', 'NFS-Most-Wanted.png'),
(390, 'NFS Pro Street ', 'NFS-Pro-Street.png'),
(391, 'NFS Undercover ', 'NFS-Undercover.png'),
(392, 'Operation Flashpoint 2 Dragon Rising ', 'Operation-Flashpoint-2-Dragon-Rising.png'),
(393, 'Operation Flashpoint Cold War Crisis ', 'Operation-Flashpoint-Cold-War-Crisis.png'),
(394, 'Operation Flashpoint Resistance ', 'Operation-Flashpoint-Resistance.png'),
(395, 'Operation Thunderstorm ', 'Operation-Thunderstorm.png'),
(396, 'other ', 'other.png'),
(397, 'Perimeter 2 New Earth ', 'Perimeter-2-New-Earth.png'),
(398, 'Perimeter ', 'Perimeter.png'),
(399, 'PES 2009 ', 'PES-2009.png'),
(400, 'PlanetSide Core Combat ', 'PlanetSide-Core-Combat.png'),
(401, 'PlanetSide ', 'PlanetSide.png'),
(402, 'Plants vs. Zombie ', 'Plants-vs.-Zombie.png'),
(403, 'Plants vs. Zombies (FB) ', 'Plants-vs.-Zombies (FB).png'),
(404, 'Postal 2 ', 'Postal-2.png'),
(405, 'Prey ', 'Prey.png'),
(406, 'Prince of Persia The Forgotten Sands (EU) ', 'Prince-of-Persia-The-Forgotten-Sands (EU).png'),
(407, 'Prince of Persia The Forgotten Sands ', 'Prince-of-Persia-The-Forgotten-Sands.png'),
(408, 'Prince of Persia The Sands of Time ', 'Prince-of-Persia-The-Sands-of-Time.png'),
(409, 'Prince of Persia The Two Thrones ', 'Prince-of-Persia-The-Two-Thrones.png'),
(410, 'Prince of Persia Warrior Within ', 'Prince-of-Persia-Warrior-Within.png'),
(411, 'Prince of Persia ', 'Prince-of-Persia.png'),
(412, 'Pro Evolution Soccer 2008 ', 'Pro-Evolution-Soccer-2008.png'),
(413, 'Pro Evolution Soccer 2010 ', 'Pro-Evolution-Soccer-2010.png'),
(414, 'Pro Evolution Soccer 3 ', 'Pro-Evolution-Soccer-3.png'),
(415, 'Pro Evolution Soccer 4 ', 'Pro-Evolution-Soccer-4.png'),
(416, 'Pro Evolution Soccer 5 ', 'Pro-Evolution-Soccer-5.png'),
(417, 'Pro Evolution Soccer 6 ', 'Pro-Evolution-Soccer-6.png'),
(418, 'Pro Rugby Manager 2 ', 'Pro-Rugby-Manager-2.png'),
(419, 'Professor Heinz Wolff''s Gravity ', 'Professor-Heinz-Wolff''s-Gravity.png'),
(420, 'Project Eden ', 'Project-Eden.png'),
(421, 'ProStroke Golf World Tour 2007 ', 'ProStroke-Golf-World-Tour-2007.png'),
(422, 'Pure ', 'Pure.png'),
(423, 'Quake 2 Ground Zero ', 'Quake-2-Ground-Zero.png'),
(424, 'Quake 2 The Reckoning ', 'Quake-2-The-Reckoning.png'),
(425, 'Quake 2 ', 'Quake-2.png'),
(426, 'Quake 3 Team Arena ', 'Quake-3-Team-Arena.png'),
(427, 'Quake 3 ', 'Quake-3.png'),
(428, 'Quake 4 ', 'Quake-4.png'),
(429, 'Quake Dissolution of Eternity ', 'Quake-Dissolution-of-Eternity.png'),
(430, 'Quake II Netpack I Extremities ', 'Quake-II-Netpack-I-Extremities.png'),
(431, 'Quake Live ', 'Quake-Live.png'),
(432, 'Quake Scourge of Armagon ', 'Quake-Scourge-of-Armagon.png'),
(433, 'Quake Wars ', 'Quake-Wars.png'),
(434, 'Quake ', 'Quake.png'),
(435, 'R.U.S.E. ', 'R.U.S.E..png'),
(436, 'Race 07 Official WTCC Game ', 'Race-07-Official-WTCC-Game.png'),
(437, 'RACE On ', 'RACE-On.png'),
(438, 'Race The WTCC Game ', 'Race-The-WTCC-Game.png'),
(439, 'Race vs. GTR ', 'Race-vs.-GTR.png'),
(440, 'Ragnarok Online ', 'Ragnarok-Online.png'),
(441, 'Red Alert 3 Uprising ', 'Red-Alert-3-Uprising.png'),
(442, 'Red Alert 3 ', 'Red-Alert-3.png'),
(443, 'Red Faction Guerrilla ', 'Red-Faction-Guerrilla.png'),
(444, 'Red Faction II ', 'Red-Faction-II.png'),
(445, 'Redneck Rampage Rides Again ', 'Redneck-Rampage-Rides-Again.png'),
(446, 'Redneck Rampage Suckin'' Grits on Route 66 ', 'Redneck-Rampage-Suckin''-Grits-on-Route-66.png'),
(447, 'Redneck Rampage ', 'Redneck-Rampage.png'),
(448, 'Return to Castle Wolfenstein ', 'Return-to-Castle-Wolfenstein.png'),
(449, 'RF Online ', 'RF-Online.png'),
(450, 'rFactor ', 'rFactor.png'),
(451, 'Ricochet ', 'Ricochet.png'),
(452, 'Rise of Nations Gold Edition ', 'Rise-of-Nations-Gold-Edition.png'),
(453, 'Rise of Nations Rise of Legends ', 'Rise-of-Nations-Rise-of-Legends.png'),
(454, 'Rise of Nations Thrones & Patriots ', 'Rise-of-Nations-Thrones-&-Patriots.png'),
(455, 'Rise of the Argonauts ', 'Rise-of-the-Argonauts.png'),
(456, 'Rome Total War Alexander ', 'Rome-Total-War-Alexander.png'),
(457, 'Rome Total War Barbarian Invasion ', 'Rome-Total-War-Barbarian-Invasion.png'),
(458, 'Rome Total War Gold Edition ', 'Rome-Total-War-Gold-Edition.png'),
(459, 'Rome Total War ', 'Rome-Total-War.png'),
(460, 'Sacred Gold ', 'Sacred-Gold.png'),
(461, 'Section 8 ', 'Section-8.png'),
(462, 'Sega Rally Revo ', 'Sega-Rally-Revo.png'),
(463, 'Serious Sam 2 ', 'Serious-Sam-2.png'),
(464, 'Serious Sam HD The First Encounter ', 'Serious-Sam-HD-The-First-Encounter.png'),
(465, 'Serious Sam The First Encounter ', 'Serious-Sam-The-First-Encounter.png'),
(466, 'Serious Sam The Second Encounter ', 'Serious-Sam-The-Second-Encounter.png'),
(467, 'Shadow Ops Red Mercury ', 'Shadow-Ops-Red-Mercury.png'),
(468, 'Shadow Vault ', 'Shadow-Vault.png'),
(469, 'Shadow Warrior ', 'Shadow-Warrior.png'),
(470, 'Shadowrun ', 'Shadowrun.png'),
(471, 'Shark Tale ', 'Shark-Tale.png'),
(472, 'Shattered Horizon ', 'Shattered-Horizon.png'),
(473, 'Shaun White Snowboarding ', 'Shaun-White-Snowboarding.png'),
(474, 'Silent Hunter 5 Battle of the Atlantic ', 'Silent-Hunter-5-Battle-of-the-Atlantic.png'),
(475, 'Sin ', 'Sin.png'),
(476, 'Singularity (EU) ', 'Singularity (EU).png'),
(477, 'Sins of a Solar Empire Entrenchment ', 'Sins-of-a-Solar-Empire-Entrenchment.png'),
(478, 'Sins of a Solar Empire ', 'Sins-of-a-Solar-Empire.png'),
(479, 'Smash Up Derby ', 'Smash-Up-Derby.png'),
(480, 'Sniper Ghost Warrior ', 'Sniper-Ghost-Warrior.png'),
(481, 'Soldier of Fortune 2 Gold Edition ', 'Soldier-of-Fortune-2-Gold-Edition.png'),
(482, 'Soldier of Fortune Payback ', 'Soldier-of-Fortune-Payback.png'),
(483, 'Soldier of Fortune Platinum Edition ', 'Soldier-of-Fortune-Platinum-Edition.png'),
(484, 'Sonic Heroes ', 'Sonic-Heroes.png'),
(485, 'Sonic Riders ', 'Sonic-Riders.png'),
(486, 'Space Empires IV ', 'Space-Empires-IV.png'),
(487, 'Space Empires V ', 'Space-Empires-V.png'),
(488, 'Space Siege ', 'Space-Siege.png'),
(489, 'SSX 3 ', 'SSX-3.png'),
(490, 'SSX On Tour ', 'SSX-On-Tour.png'),
(491, 'SSX Tricky ', 'SSX-Tricky.png'),
(492, 'SSX ', 'SSX.png'),
(493, 'Stalker Call of Pripyat Collector''s Edition ', 'Stalker-Call-of-Pripyat-Collector''s-Edition.png'),
(494, 'Stalker Call of Pripyat ', 'Stalker-Call-of-Pripyat.png'),
(495, 'Stalker clear sky ', 'Stalker-clear-sky.png'),
(496, 'Stalker Shadow of Chernobyl ', 'Stalker-Shadow-of-Chernobyl.png'),
(497, 'Star Trek Armada 2 ', 'Star-Trek-Armada-2.png'),
(498, 'Star Trek Armada ', 'Star-Trek-Armada.png'),
(499, 'Star Trek Away Team ', 'Star-Trek-Away-Team.png'),
(500, 'Star Trek Bridge Commander ', 'Star-Trek-Bridge-Commander.png'),
(501, 'Star Trek Conquest Online ', 'Star-Trek-Conquest-Online.png'),
(502, 'Star Trek Dominion Wars ', 'Star-Trek-Dominion-Wars.png'),
(503, 'Star Trek Hidden Evil ', 'Star-Trek-Hidden-Evil.png'),
(504, 'Star Trek Klingon Academy ', 'Star-Trek-Klingon-Academy.png'),
(505, 'Star Trek The Fallen ', 'Star-Trek-The-Fallen.png'),
(506, 'Star Trek Voyager   Elite Force EP ', 'Star-Trek-Voyager---Elite-Force-EP.png'),
(507, 'Star Trek Voyager Elite Force ', 'Star-Trek-Voyager-Elite-Force.png'),
(508, 'Star Wars Battlefront II ', 'Star-Wars-Battlefront-II.png'),
(509, 'Star Wars Battlefront ', 'Star-Wars-Battlefront.png'),
(510, 'Star Wars Empire at War Forces of Corruption ', 'Star-Wars-Empire-at-War-Forces-of-Corruption.png'),
(511, 'Star Wars Empire at War ', 'Star-Wars-Empire-at-War.png'),
(512, 'Star Wars Episode 1 Racer ', 'Star-Wars-Episode-1-Racer.png'),
(513, 'Star Wars Galactic Battlegrounds Clone Campaigns ', 'Star-Wars-Galactic-Battlegrounds-Clone-Campaigns.png'),
(514, 'Star Wars Galactic Battlegrounds ', 'Star-Wars-Galactic-Battlegrounds.png'),
(515, 'Star Wars Galaxies An Empire Divided ', 'Star-Wars-Galaxies-An-Empire-Divided.png'),
(516, 'Star Wars Galaxies Jump to Lightspeed ', 'Star-Wars-Galaxies-Jump-to-Lightspeed.png'),
(517, 'Star Wars Jedi Knight Dark Forces II ', 'Star-Wars-Jedi-Knight-Dark-Forces-II.png'),
(518, 'Star Wars Jedi Knight II Jedi Outcast ', 'Star-Wars-Jedi-Knight-II-Jedi-Outcast.png'),
(519, 'Star Wars Jedi Knight Jedi Academy ', 'Star-Wars-Jedi-Knight-Jedi-Academy.png'),
(520, 'Star Wars Knights of the old Republic II The sith Lords ', 'Star-Wars-Knights-of-the-old-Republic-II-The-sith-Lords.png'),
(521, 'Star Wars Knights of the old Republic ', 'Star-Wars-Knights-of-the-old-Republic.png'),
(522, 'Star Wars Republic Commando ', 'Star-Wars-Republic-Commando.png'),
(523, 'Star Wars Starfighter ', 'Star-Wars-Starfighter.png'),
(524, 'Star Wars The Clone Wars Republic Heroes (US) ', 'Star-Wars-The-Clone-Wars-Republic-Heroes (US).png'),
(525, 'Star Wars The Clone Wars Republic Heroes ', 'Star-Wars-The-Clone-Wars-Republic-Heroes.png'),
(526, 'Star Wars The Force Unleashed Ultimate Sith Edition ', 'Star-Wars-The-Force-Unleashed-Ultimate-Sith-Edition.png'),
(527, 'StarCraft Brood War ', 'StarCraft-Brood-War.png'),
(528, 'StarCraft II Beta ', 'StarCraft-II-Beta.png'),
(529, 'StarCraft ', 'StarCraft.png'),
(530, 'Starfleet Command 2 Empires At War ', 'Starfleet-Command-2-Empires-At-War.png'),
(531, 'Starship Troopers ', 'Starship-Troopers.png'),
(532, 'Still Life 2 (FB) ', 'Still-Life-2 (FB).png'),
(533, 'Stormrise ', 'Stormrise.png'),
(534, 'Stranger ', 'Stranger.png'),
(535, 'Street Fighter IV ', 'Street-Fighter-IV.png'),
(536, 'Stronghold 2 ', 'Stronghold-2.png'),
(537, 'Stronghold Crusader Extreme ', 'Stronghold-Crusader-Extreme.png'),
(538, 'Stronghold Crusader ', 'Stronghold-Crusader.png'),
(539, 'Stronghold Legends ', 'Stronghold-Legends.png'),
(540, 'Sudden Strike 2 ', 'Sudden-Strike-2.png'),
(541, 'Sudden Strike 3 Arms for Victory ', 'Sudden-Strike-3-Arms-for-Victory.png'),
(542, 'Supreme Commander 2 ', 'Supreme-Commander-2.png'),
(543, 'Supreme Commander FA ', 'Supreme-Commander-FA.png'),
(544, 'Supreme Commander ', 'Supreme-Commander.png'),
(545, 'Supreme Ruler 2020 Global Crisis ', 'Supreme-Ruler-2020-Global-Crisis.png'),
(546, 'Supreme Ruler 2020 ', 'Supreme-Ruler-2020.png'),
(547, 'SWAT 3 ', 'SWAT-3.png'),
(548, 'SWAT 4 The Stetchkov Syndicate ', 'SWAT-4-The-Stetchkov-Syndicate.png'),
(549, 'SWAT 4 ', 'SWAT-4.png'),
(550, 'Sword of the Stars Complete Collection ', 'Sword-of-the-Stars-Complete-Collection.png'),
(551, 'Tabula Rasa ', 'Tabula-Rasa.png'),
(552, 'Team Fortress 2 ', 'Team-Fortress-2.png'),
(553, 'Team Fortress Classic ', 'Team-Fortress-Classic.png'),
(554, 'The Elder Scrolls 4 Oblivion ', 'The-Elder-Scrolls-4-Oblivion.png'),
(555, 'The Lord of the Rings Online Mines of Moria ', 'The-Lord-of-the-Rings-Online-Mines-of-Moria.png'),
(556, 'The Movies ', 'The-Movies.png'),
(557, 'The Royal Marines Commando ', 'The-Royal-Marines-Commando.png'),
(558, 'The Settlers 7 Paths to a Kingdom ', 'The-Settlers-7-Paths-to-a-Kingdom.png'),
(559, 'The Settlers Heritage of Kings ', 'The-Settlers-Heritage-of-Kings.png'),
(560, 'The Settlers II 10th Anniversary ', 'The-Settlers-II-10th-Anniversary.png'),
(561, 'The Settlers VI Rise of an Empire ', 'The-Settlers-VI-Rise-of-an-Empire.png'),
(562, 'The Settlers VI The Eastern Realm ', 'The-Settlers-VI-The-Eastern-Realm.png'),
(563, 'The Simpsons Hit & Run ', 'The-Simpsons-Hit-&-Run.png'),
(564, 'The Ultimate Doom ', 'The-Ultimate-Doom.png'),
(565, 'Theatre of War 2 Africa 1943 ', 'Theatre-of-War-2-Africa-1943.png'),
(566, 'Theatre of War ', 'Theatre-of-War.png'),
(567, 'Thumbs.db', 'Thumbs.db'),
(568, 'Tiger Woods PGA Tour 06 ', 'Tiger-Woods-PGA-Tour-06.png'),
(569, 'Tiger Woods PGA Tour 07 ', 'Tiger-Woods-PGA-Tour-07.png'),
(570, 'Tiger Woods PGA Tour 08 ', 'Tiger-Woods-PGA-Tour-08.png'),
(571, 'Tiger Woods PGA Tour 10 ', 'Tiger-Woods-PGA-Tour-10.png'),
(572, 'Tiger Woods PGA Tour 2003 ', 'Tiger-Woods-PGA-Tour-2003.png'),
(573, 'Tiger Woods PGA Tour 2004 ', 'Tiger-Woods-PGA-Tour-2004.png'),
(574, 'Tiger Woods PGA Tour 2005 ', 'Tiger-Woods-PGA-Tour-2005.png'),
(575, 'Time of Shadows ', 'Time-of-Shadows.png'),
(576, 'TimeShift ', 'TimeShift.png'),
(577, 'Titan Quest Immortal Throne ', 'Titan-Quest-Immortal-Throne.png'),
(578, 'Titan Quest ', 'Titan-Quest.png'),
(579, 'TOCA Race Driver 2 ', 'TOCA-Race-Driver-2.png'),
(580, 'TOCA Race Driver 3 ', 'TOCA-Race-Driver-3.png'),
(581, 'TOCA Race Driver ', 'TOCA-Race-Driver.png'),
(582, 'Tom Clancy''s Endwar (Alt) ', 'Tom-Clancy''s-Endwar (Alt).png'),
(583, 'Tom Clancy''s Endwar ', 'Tom-Clancy''s-Endwar.png'),
(584, 'Tom Clancy''s Rainbow Six 3 Athena Sword ', 'Tom-Clancy''s-Rainbow-Six-3-Athena-Sword.png'),
(585, 'Tom Clancy''s Rainbow Six 3 Raven Shield ', 'Tom-Clancy''s-Rainbow-Six-3-Raven-Shield.png'),
(586, 'Tom Clancy''s Rainbow Six Lockdown ', 'Tom-Clancy''s-Rainbow-Six-Lockdown.png'),
(587, 'Tom Clancy''s Rainbow Six Vegas ', 'Tom-Clancy''s-Rainbow-Six-Vegas.png'),
(588, 'Tom Clancy''s Splinter Cell Chaos Theory ', 'Tom-Clancy''s-Splinter-Cell-Chaos-Theory.png'),
(589, 'Tom Clancy''s Splinter Cell Conviction ', 'Tom-Clancy''s-Splinter-Cell-Conviction.png'),
(590, 'Tom Clancy''s Splinter Cell Double Agent ', 'Tom-Clancy''s-Splinter-Cell-Double-Agent.png'),
(591, 'Tom Clancy''s Splinter Cell Pandora Tomorrow ', 'Tom-Clancy''s-Splinter-Cell-Pandora-Tomorrow.png'),
(592, 'Tom Clancy''s Splinter Cell ', 'Tom-Clancy''s-Splinter-Cell.png'),
(593, 'Tom Clancys HAWX ', 'Tom-Clancys-HAWX.png'),
(594, 'Top Spin 2 ', 'Top-Spin-2.png'),
(595, 'Total Annihilation ', 'Total-Annihilation.png'),
(596, 'Total Club Manager 2004 ', 'Total-Club-Manager-2004.png'),
(597, 'Total Club Manager 2005 ', 'Total-Club-Manager-2005.png'),
(598, 'Trackmania Nations Forever ', 'Trackmania-Nations-Forever.png'),
(599, 'TrackMania Sunrise ', 'TrackMania-Sunrise.png'),
(600, 'TrackMania United Forever ', 'TrackMania-United-Forever.png'),
(601, 'TrackMania United ', 'TrackMania-United.png'),
(602, 'Tribes Vengeance ', 'Tribes-Vengeance.png'),
(603, 'Ultima Online Age of Shadows ', 'Ultima-Online-Age-of-Shadows.png'),
(604, 'Universe at War ', 'Universe-at-War.png'),
(605, 'Unreal Gold ', 'Unreal-Gold.png'),
(606, 'Unreal Tournament 2003 ', 'Unreal-Tournament-2003.png'),
(607, 'Unreal Tournament 2004 ', 'Unreal-Tournament-2004.png'),
(608, 'Unreal Tournament 3 ', 'Unreal-Tournament-3.png'),
(609, 'Unreal Tournament ', 'Unreal-Tournament.png'),
(610, 'Vegas 2 ', 'Vegas-2.png'),
(611, 'Virtua Tennis 2009 ', 'Virtua-Tennis-2009.png'),
(612, 'Virtua Tennis 3 ', 'Virtua-Tennis-3.png'),
(613, 'Wanted Weapons of Fate ', 'Wanted-Weapons-of-Fate.png'),
(614, 'War Leaders Clash Of Nations ', 'War-Leaders-Clash-Of-Nations.png'),
(615, 'Warcraft 3 The Frozen Throne ', 'Warcraft-3-The-Frozen-Throne.png'),
(616, 'Warcraft 3 ', 'Warcraft-3.png'),
(617, 'Warhammer 40.000 Dawn of War Dark Crusade ', 'Warhammer-40.000-Dawn-of-War-Dark-Crusade.png'),
(618, 'Warhammer 40.000 Dawn of War Winter Assault ', 'Warhammer-40.000-Dawn-of-War-Winter-Assault.png'),
(619, 'Warhammer 40.000 Dawn of War ', 'Warhammer-40.000-Dawn-of-War.png'),
(620, 'Warhammer 40.000 Fire Warrior ', 'Warhammer-40.000-Fire-Warrior.png'),
(621, 'Warhammer 40k Dawn of War II Chaos Rising ', 'Warhammer-40k-Dawn-of-War-II-Chaos-Rising.png'),
(622, 'Warhammer 40k Dawn of War II ', 'Warhammer-40k-Dawn-of-War-II.png'),
(623, 'Warhammer Mark of Chaos Battle March ', 'Warhammer-Mark-of-Chaos-Battle-March.png'),
(624, 'Warhammer Online ', 'Warhammer-Online.png'),
(625, 'Wolfenstein 3D ', 'Wolfenstein-3D.png'),
(626, 'Wolfenstein ', 'Wolfenstein.png'),
(627, 'World in Conflict Complete Edition ', 'World-in-Conflict-Complete-Edition.png'),
(628, 'World in Conflict Soviet Assault ', 'World-in-Conflict-Soviet-Assault.png'),
(629, 'World of Conflict ', 'World-of-Conflict.png'),
(630, 'World of Warcraft The Burning Crusade ', 'World-of-Warcraft-The-Burning-Crusade.png'),
(631, 'World of WarCraft Wrath of the Lich King ', 'World-of-WarCraft-Wrath-of-the-Lich-King.png'),
(632, 'World of Warcraft ', 'World-of-Warcraft.png'),
(633, 'Worms 3D ', 'Worms-3D.png'),
(634, 'Worms 4 ', 'Worms-4.png'),
(635, 'Worms Armageddon ', 'Worms-Armageddon.png'),
(636, 'Worms Blast ', 'Worms-Blast.png'),
(637, 'Worms Forts Under Siege ', 'Worms-Forts-Under-Siege.png'),
(638, 'Xpand Rally Xtreme ', 'Xpand-Rally-Xtreme.png'),
(639, 'Real Warfare 1242 ', 'Real-Warfare-1242.png'),
(640, 'Lords of Magic Special Edition ', 'Lords-of-Magic-Special-Edition.png'),
(641, 'Command & Conquer Yuri''s Revenge ', 'Command-&-Conquer-Yuri''s-Revenge.png'),
(642, 'Blood ', 'Blood.png'),
(643, 'Rise of the Triad Dark War ', 'Rise-of-the-Triad-Dark-War.png'),
(644, 'Pirates, Vikings and Knights II ', 'Pirates,-Vikings-and-Knights-II.png'),
(645, 'Battle Chess Special Edition ', 'Battle-Chess-Special-Edition.png'),
(646, 'Storm Over the Pacific ', 'Storm-Over-the-Pacific.png'),
(647, 'Sniper Ghost Warrior (FB) ', 'Sniper-Ghost-Warrior (FB).png'),
(648, 'Portal Prelude ', 'Portal-Prelude.png'),
(649, 'Europa Universalis III Heir to the Throne ', 'Europa-Universalis-III-Heir-to-the-Throne.png'),
(650, 'King`s Bounty Gold Edition ', 'King`s-Bounty-Gold-Edition.png'),
(651, 'Handball Simulator European Tournament 2010 ', 'Handball-Simulator-European-Tournament-2010.png'),
(652, 'Interstate ''76 Arsenal ', 'Interstate-''76-Arsenal.png'),
(653, 'Monkey Island 2 Special Edition ', 'Monkey-Island-2-Special-Edition.png'),
(654, 'Tactical Ops Assault on Terror ', 'Tactical-Ops-Assault-on-Terror.png'),
(655, 'No One Lives Forever ', 'No-One-Lives-Forever.png'),
(656, 'Lords of the Realm Royal Edition ', 'Lords-of-the-Realm-Royal-Edition.png'),
(657, 'Dark Reign 2 ', 'Dark-Reign-2.png'),
(658, 'Screamer ', 'Screamer.png'),
(659, 'Strife ', 'Strife.png'),
(660, 'FreeSpace ', 'FreeSpace.png'),
(661, 'Dark Reign Rise of the Shadowhand ', 'Dark-Reign-Rise-of-the-Shadowhand.png'),
(662, 'Deus Ex The Nameless Mod ', 'Deus-Ex-The-Nameless-Mod.png'),
(663, 'Pro Pinball Big Race USA ', 'Pro-Pinball-Big-Race-USA.png'),
(664, 'Command & Conquer Red Alert ', 'Command-&-Conquer-Red-Alert.png'),
(665, 'Rune ', 'Rune.png'),
(666, 'Allegiance ', 'Allegiance.png'),
(667, 'Plain Sight ', 'Plain-Sight.png'),
(668, 'Death Rally ', 'Death-Rally.png'),
(669, 'Phantasmagoria 2 ', 'Phantasmagoria-2.png'),
(670, 'Return to Krondor ', 'Return-to-Krondor.png'),
(671, 'Victoria II ', 'Victoria-II.png'),
(672, 'Pool Hall Pro ', 'Pool-Hall-Pro.png'),
(673, 'Dark Reign The Future of War ', 'Dark-Reign-The-Future-of-War.png'),
(674, 'Blacklight Tango Down ', 'Blacklight-Tango-Down.png'),
(675, 'Jolly Rover ', 'Jolly-Rover.png'),
(676, 'Command and Conquer Red Alert 2 ', 'Command-and-Conquer-Red-Alert-2.png'),
(677, 'No One Lives Forever Game Of The Year Edition ', 'No-One-Lives-Forever-Game-Of-The-Year-Edition.png'),
(678, 'Ground Control ', 'Ground-Control.png'),
(679, 'Phantasmagoria ', 'Phantasmagoria.png'),
(680, 'Altitude ', 'Altitude.png'),
(681, 'Outcast ', 'Outcast.png'),
(682, 'VVVVVV ', 'VVVVVV.png'),
(683, 'Return to Castle Wolfenstein Platinum Edition ', 'Return-to-Castle-Wolfenstein-Platinum-Edition.png'),
(684, 'Shatter ', 'Shatter.png'),
(685, 'Insurgency Modern Infantry Combat ', 'Insurgency Modern Infantry Combat.png'),
(686, 'Men of War Gold Edition ', 'Men-of-War-Gold-Edition.png'),
(687, 'Numen Contest of Heroes ', 'Numen-Contest-of-Heroes.png'),
(688, 'Medal of Honor Allied Assault Spearhead ', 'Medal-of-Honor-Allied-Assault-Spearhead.png'),
(689, 'Command and Conquer Tiberian Sun ', 'Command_and_Conquer_Tiberian_Sun.png'),
(690, 'Counter Strike 1.6 ', 'Counter_Strike_1.6.png'),
(691, 'Alien vs. Predator ', 'Alien_vs._Predator.png'),
(692, 'Natural Selection ', 'Natural_Selection.png'),
(693, 'Alien vs. Predator 2 ', 'Alien_vs._Predator_2.png'),
(694, 'StarCraft II ', 'StarCraft-II.png'),
(695, 'Osmos ', 'Osmos.png'),
(696, 'Heroes of Might and Magic Online ', 'Heroes-of-Might-and-Magic-Online.png'),
(697, 'Dawn of War 2 II Retribution Collectors Edition ', 'Dawn-of-War-2-II-Retribution-Collectors-Edition.png'),
(698, 'Nail''d ', 'Nail''d.png'),
(699, 'Warrior Epic ', 'Warrior-Epic.png'),
(700, 'F1 2011 ', 'F1-2011.png'),
(701, 'Crysis 2 ', 'Crysis-2.png'),
(702, 'Bracken Tor The Time of Tooth and Claw ', 'Bracken-Tor-The-Time-of-Tooth-and-Claw.png'),
(703, 'Achtung Panzer Kharkov 1943 ', 'Achtung-Panzer-Kharkov-1943.png'),
(704, 'MechWarrior 4 Clan ', 'MechWarrior-4-Clan.png'),
(705, 'Minecraft ', 'Minecraft.png'),
(706, 'Majesty 2 Kingmaker ', 'Majesty-2-Kingmaker.png'),
(707, 'Firearms Source ', 'Firearms-Source.png'),
(708, 'F1 2010 ', 'F1-2010.png'),
(709, 'Brink ', 'Brink.png'),
(710, 'Red Baron ', 'Red-Baron.png'),
(711, 'S.T.A.L.K.E.R. Call of Pripyat ', 'S.T.A.L.K.E.R.-Call-of-Pripyat.png'),
(712, 'Black & White (ALT) ', 'Black-&-White (ALT).png'),
(713, 'The Club ', 'The-Club.png'),
(714, 'Blood II The Chosen ', 'Blood-II-The-Chosen.png'),
(715, 'Aika Online ', 'Aika-Online.png'),
(716, 'Magicka ', 'Magicka.png'),
(717, 'Theatre of War 3 Korea ', 'Theatre-of-War-3-Korea.png'),
(718, 'Red Faction ', 'Red-Faction.png'),
(719, 'Air Conflicts Secret Wars ', 'Air-Conflicts-Secret-Wars.png'),
(720, 'WRC FIA World Rally Championship ', 'WRC-FIA-World-Rally-Championship.png'),
(721, 'Darwinia ', 'Darwinia.png'),
(722, 'Singularity ', 'Singularity.png'),
(723, 'Civilization II Gold Edition ', 'Civilization-II-Gold-Edition.png'),
(724, 'Portal 2 ', 'Portal-2.png'),
(725, 'Anomaly Warzone Earth ', 'Anomaly-Warzone-Earth.png'),
(726, 'Dungeons ', 'Dungeons.png'),
(727, 'Civilization IV The Complete Edition ', 'Civilization-IV-The-Complete-Edition.png'),
(728, 'Imagine Fashion Designer ', 'Imagine-Fashion-Designer.png'),
(729, 'Sins of a Solar Empire Diplomacy ', 'Sins-of-a-Solar-Empire-Diplomacy.png'),
(730, 'Sins of a Solar Empire Trinity ', 'Sins-of-a-Solar-Empire-Trinity.png'),
(731, 'Penumbra Requiem ', 'Penumbra-Requiem.png'),
(732, 'Warhammer 40.000 Dawn of War II Retribution ', 'Warhammer-40.000-Dawn-of-War-II-Retribution.png'),
(733, 'Earthrise ', 'Earthrise.png'),
(734, 'Call of Duty Black Ops ', 'Call-of-Duty-Black-Ops.png'),
(735, 'Dungeon Keeper ', 'Dungeon-Keeper.png'),
(736, 'MechWarrior 2 ', 'MechWarrior-2.png'),
(737, 'BlazBlue Calamity Trigger (EU) ', 'BlazBlue-Calamity-Trigger-(EU).png'),
(738, 'Fear 2 Reborn ', 'Fear-2-Reborn.png'),
(739, 'Need for Speed World Online ', 'Need-for-Speed-World-Online.png'),
(740, 'All Points Bulletin ', 'All-Points-Bulletin.png'),
(741, 'City of Heroes Going Rogue Complete Collection ', 'City-of-Heroes-Going-Rogue-Complete-Collection.png'),
(742, 'Powerslide ', 'Powerslide.png'),
(743, '1nsane ', '1nsane.png'),
(744, 'Aquanox ', 'Aquanox.png'),
(745, 'ARMA II Operation Arrowhead ', 'ARMA-II-Operation-Arrowhead.png'),
(746, 'MechWarrior 4 Black Knight ', 'MechWarrior-4-Black-Knight.png'),
(747, 'Rift ', 'Rift.png'),
(748, 'Audiosurf (FB) ', 'Audiosurf (FB).png'),
(749, 'Test Drive Unlimited 2 ', 'Test-Drive-Unlimited-2.png'),
(750, 'M.U.D. TV ', 'M.U.D.-TV.png'),
(751, 'Pirates! Gold ', 'Pirates!-Gold.png'),
(752, 'Indiana Jones and the Fate of Atlantis ', 'Indiana-Jones-and-the-Fate-of-Atlantis.png'),
(753, 'Call of Juarez The Cartel ', 'Call-of-Juarez-The-Cartel.png'),
(754, 'Alien Breed Impact ', 'Alien-Breed-Impact.png'),
(755, 'Serious Sam HD The Second Encounter ', 'Serious-Sam-HD-The-Second-Encounter.png'),
(756, 'Batman Arkham Asylum Game of the Year Edition ', 'Batman-Arkham-Asylum-Game-of-the-Year-Edition.png'),
(757, 'Battlefield Bad Company 2 Vietnam ', 'Battlefield-Bad-Company-2-Vietnam.png'),
(758, 'Incoming + Forces ', 'Incoming-+-Forces.png'),
(759, 'A.R.E.S. Extinction Agenda ', 'A.R.E.S.-Extinction-Agenda.png'),
(760, 'Heroes of Might and Magic ', 'Heroes-of-Might-and-Magic.png'),
(761, 'Assassin''s Creed Brotherhood ', 'Assassin''s-Creed-Brotherhood.png'),
(762, 'Age of Conan Rise of the Godslayer ', 'Age-of-Conan-Rise-of-the-Godslayer.png'),
(763, 'Command Ops Battles From the Bulge ', 'Command-Ops-Battles-From-the-Bulge.png'),
(764, 'Luxor Zuma ', 'Luxor-Zuma.png'),
(765, 'Breach ', 'Breach.png'),
(766, 'MechWarrior 4 Mercenaries ', 'MechWarrior-4-Mercenaries.png'),
(767, 'Crash Time 4 The Syndicate ', 'Crash-Time-4-The-Syndicate.png'),
(768, 'Mafia II ', 'Mafia-II.png'),
(769, 'Alien Breed 3 Descent ', 'Alien-Breed-3-Descent.png'),
(770, 'Split Second ', 'Split-Second.png'),
(771, 'Need for Speed Hot Pursuit ', 'Need-for-Speed-Hot-Pursuit.png'),
(772, 'Crasher ', 'Crasher.png'),
(773, 'The Ball ', 'The-Ball.png'),
(774, 'Red Baron II ', 'Red-Baron-II.png'),
(775, 'Defcon ', 'Defcon.png'),
(776, 'Hidden & Dangerous Deluxe ', 'Hidden-&-Dangerous-Deluxe.png'),
(777, 'Invictus In the Shadow of Olympus ', 'Invictus-In-the-Shadow-of-Olympus.png'),
(778, 'Battlefield 3 ', 'Battlefield-3.png'),
(779, 'MechWarrior 4 Inner Sphere ', 'MechWarrior-4-Inner-Sphere.png'),
(780, 'Need for Speed Hot Pursuit Limited Edition ', 'Need-for-Speed-Hot-Pursuit-Limited-Edition.png'),
(781, 'The Beast Within A Gabriel Knight Mystery ', 'The-Beast-Within-A-Gabriel-Knight-Mystery.png'),
(782, 'MechWarrior 4 Vengeance ', 'MechWarrior-4-Vengeance.png'),
(783, 'Age of Empires The Rise of Rome ', 'Age-of-Empires-The-Rise-of-Rome.png'),
(784, 'Dark Void (Live Edition) ', 'Dark-Void (Live-Edition).png'),
(785, 'MotorM4X Offroad Extreme ', 'MotorM4X-Offroad-Extreme.png'),
(786, 'World of WarCraft Cataclysm ', 'World-of-WarCraft-Cataclysm.png'),
(787, 'Red Faction Armageddon ', 'Red-Faction-Armageddon.png'),
(788, 'Age of Chivalry ', 'Age-of-Chivalry.png'),
(789, 'Aquanox 2 ', 'Aquanox-2.png'),
(790, 'Dark Messiah of Might and Magic (US) ', 'Dark-Messiah-of-Might-and-Magic (US).png'),
(791, 'Commander Conquest of the Americas ', 'Commander-Conquest-of-the-Americas.png'),
(792, 'MechWarrior 3 ', 'MechWarrior-3.png'),
(793, 'Operation Flashpoint Red River ', 'Operation-Flashpoint-Red-River.png'),
(794, 'Luxor 5th Passage ', 'Luxor-5th-Passage.png'),
(795, 'Alpha Protocol ', 'Alpha-Protocol.png'),
(796, 'Reload Target Down ', 'Reload-Target-Down.png'),
(797, 'Dungeon Keeper 2 ', 'Dungeon-Keeper-2.png'),
(798, 'Kingpin Life of Crime ', 'Kingpin-Life-of-Crime.png'),
(799, 'Civilization IV Complete ', 'Civilization-IV-Complete.png'),
(800, 'DiRT 3 ', 'DiRT-3.png'),
(801, 'Defense Grid The Awakening (FB) ', 'Defense-Grid-The-Awakening (FB).png'),
(802, 'Arma 2 Reinforcements ', 'Arma-2-Reinforcements.png'),
(803, 'MechWarrior 3 Pirates Moon ', 'MechWarrior-3-Pirates-Moon.png'),
(804, 'Bulletstorm ', 'Bulletstorm.png'),
(805, 'OpenTTD ', 'OpenTTD.png'),
(806, 'Cities XL 2011 ', 'Cities-XL-2011.png'),
(807, 'Duke Nukem 3D Atomic Edition ', 'Duke-Nukem-3D-Atomic-Edition.png'),
(808, 'Iron Cross ', 'Iron-Cross.png'),
(809, 'Borderlands Game of the Year Edition ', 'Borderlands-Game-of-the-Year-Edition.png'),
(810, 'Worms Reloaded ', 'Worms-Reloaded.png'),
(811, 'Supreme Commander (EU) ', 'Supreme-Commander (EU).png'),
(812, 'Dead Rising 2 ', 'Dead-Rising-2.png'),
(813, 'Black Prophecy ', 'Black-Prophecy.png'),
(814, 'Command & Conquer Red Alert 2 ', 'Command-&-Conquer-Red-Alert-2.png'),
(815, 'Duke Nukem Forever ', 'Duke-Nukem-Forever.png'),
(816, 'Warhammer 40.000 Dawn of War II ', 'Warhammer-40.000-Dawn-of-War-II.png'),
(817, 'Homefront ', 'Homefront.png'),
(818, 'Black & White ', 'Black-&-White.png'),
(819, 'Darkspore ', 'Darkspore.png'),
(820, 'Medal of Honor ', 'Medal-of-Honor.png'),
(821, 'Imagine Pet Vet ', 'Imagine-Pet-Vet.png'),
(822, 'Age of Wonders II The Wizard''s Throne ', 'Age-of-Wonders-II-The-Wizard''s-Throne.png'),
(823, 'Mobile Forces ', 'Mobile-Forces.png'),
(824, 'MechWarrior 2 Ghost Bears Legacy ', 'MechWarrior-2-Ghost-Bears-Legacy.png'),
(825, 'Alien Swarm ', 'Alien-Swarm.png'),
(826, 'Universe at War Earth Assault ', 'Universe-at-War-Earth-Assault.png'),
(827, 'Agon Lost Sword of Toledo ', 'Agon-Lost-Sword-of-Toledo.png'),
(828, 'Magic The Gathering Duels of the Planeswalkers ', 'Magic-The-Gathering-Duels-of-the-Planeswalkers.png'),
(829, 'Heroes of Might and Magic IV Complete ', 'Heroes-of-Might-and-Magic-IV-Complete.png'),
(830, 'Aion Assault on Balaurea ', 'Aion-Assault-on-Balaurea.png'),
(831, 'Alien Breed 2 Assault ', 'Alien-Breed-2-Assault.png'),
(832, 'Monday Night Combat ', 'Monday-Night-Combat.png'),
(833, 'Dungeon Siege III ', 'Dungeon-Siege-III.png'),
(834, 'Majesty 2 Battles Of Arcania ', 'Majesty-2-Battles-Of-Arcania.png');

-- --------------------------------------------------------

--
-- Table structure for table `lan_games_seq`
--

CREATE TABLE IF NOT EXISTS `lan_games_seq` (
  `sequence` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`sequence`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `lan_games_seq`
--


-- --------------------------------------------------------

--
-- Table structure for table `lan_log`
--

CREATE TABLE IF NOT EXISTS `lan_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `when` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `user_id` int(11) NOT NULL,
  `type` int(11) NOT NULL,
  `message` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `lan_log`
--


-- --------------------------------------------------------

--
-- Table structure for table `lan_pages`
--

CREATE TABLE IF NOT EXISTS `lan_pages` (
  `page_id` int(11) NOT NULL AUTO_INCREMENT,
  `module` varchar(30) NOT NULL,
  `file` varchar(30) NOT NULL,
  `name` varchar(30) NOT NULL,
  `template` varchar(50) DEFAULT NULL,
  `friendlyname` varchar(50) NOT NULL,
  PRIMARY KEY (`page_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=30 ;

--
-- Dumping data for table `lan_pages`
--

INSERT INTO `lan_pages` (`page_id`, `module`, `file`, `name`, `template`, `friendlyname`) VALUES
(1, 'timetable', 'timetable', 'timetable', NULL, 'Timetable'),
(2, 'timetable', 'game', 'game', NULL, 'View Game'),
(3, 'users', 'users', 'userlist', NULL, 'User list'),
(4, 'timetable', 'foodrun', 'foodrun', NULL, 'View food run'),
(5, 'users', 'profile', 'profile', NULL, 'User profile'),
(6, 'attendance', 'attendance', 'attendance', NULL, 'Attendance'),
(7, 'seating', 'seats', 'seating', NULL, 'Seating'),
(8, 'admin', 'pullusers', 'pullusers', NULL, 'Pull user info'),
(9, 'timetable', 'ttedit', 'ttedit', NULL, 'Edit event'),
(10, 'admin', 'permissions', 'permissions', NULL, 'Edit permissions'),
(11, 'admin', 'menu', 'adminmenu', NULL, 'Admin Menu (Mere mortals may not pass)'),
(13, 'servers', 'serverlist', 'serverlist', NULL, 'Server list'),
(14, 'admin', 'gameslist', 'gameslist', NULL, 'Regenerate games list'),
(15, 'admin', 'sync', 'sync', NULL, 'Resync user info'),
(16, 'admin', 'editlan', 'editlan', NULL, 'Edit LAN Party'),
(17, 'attendance', 'admin', 'attendanceadmin', NULL, 'Attendance administration'),
(18, 'logs', 'log', 'systemlogs', NULL, 'System logs'),
(19, 'seating', 'admin', 'seatingadmin', NULL, 'Seating administration'),
(20, 'users', 'editprofile', 'editprofile', NULL, 'Edit profile'),
(21, 'timetable', 'getpic', 'ttgetpic', NULL, ''),
(22, 'fileshare', 'index', 'fileshare', NULL, 'File sharing'),
(23, 'servers', 'edit', 'editserver', NULL, 'Edit server'),
(24, 'timetable', 'other', 'otherevent', NULL, 'View Event'),
(26, 'timetable', 'timetablexml', 'timetablexml', 'ajax', 'timetablexml'),
(27, 'timetable', 'jukebox', 'jukeboxtimetable', 'jukebox', 'Timetable'),
(28, 'servers', 'serverlist', 'serverlistplain', 'jukebox', 'Server List'),
(29, 'timetable', 'timetable', 'timetablejb', 'jukebox', 'Timetable');

-- --------------------------------------------------------

--
-- Table structure for table `lan_permission`
--

CREATE TABLE IF NOT EXISTS `lan_permission` (
  `permission_id` int(11) NOT NULL AUTO_INCREMENT,
  `module` varchar(50) NOT NULL,
  `action` varchar(50) NOT NULL,
  PRIMARY KEY (`permission_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `lan_permission`
--

INSERT INTO `lan_permission` (`permission_id`, `module`, `action`) VALUES
(1, 'admin', 'view admin menu'),
(2, 'admin', 'change permissions'),
(3, 'timetable', 'add event'),
(4, 'timetable', 'edit own event'),
(5, 'timetable', 'edit all events'),
(6, 'admin', 'edit lans');

-- --------------------------------------------------------

--
-- Table structure for table `lan_permission_groups`
--

CREATE TABLE IF NOT EXISTS `lan_permission_groups` (
  `permgroup_id` int(11) NOT NULL AUTO_INCREMENT,
  `group_name` varchar(50) NOT NULL,
  `user_group` tinyint(1) NOT NULL,
  PRIMARY KEY (`permgroup_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `lan_permission_groups`
--

INSERT INTO `lan_permission_groups` (`permgroup_id`, `group_name`, `user_group`) VALUES
(1, 'Anonymous', 0),
(2, 'Registered', 0),
(3, 'Attending', 0),
(4, 'Booked', 0),
(5, 'Helper', 1),
(6, 'Administrator', 1);

-- --------------------------------------------------------

--
-- Table structure for table `lan_permission_membership`
--

CREATE TABLE IF NOT EXISTS `lan_permission_membership` (
  `group_member_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `permgroup_id` int(11) NOT NULL,
  PRIMARY KEY (`group_member_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `lan_permission_membership`
--

INSERT INTO `lan_permission_membership` (`group_member_id`, `user_id`, `permgroup_id`) VALUES
(2, 1, 6);

-- --------------------------------------------------------

--
-- Table structure for table `lan_permission_modes`
--

CREATE TABLE IF NOT EXISTS `lan_permission_modes` (
  `mode_id` int(11) NOT NULL AUTO_INCREMENT,
  `mode_name` varchar(50) NOT NULL,
  PRIMARY KEY (`mode_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `lan_permission_modes`
--

INSERT INTO `lan_permission_modes` (`mode_id`, `mode_name`) VALUES
(0, 'internet'),
(1, 'intranet'),
(2, 'disabled');

-- --------------------------------------------------------

--
-- Table structure for table `lan_permission_settings`
--

CREATE TABLE IF NOT EXISTS `lan_permission_settings` (
  `perset_id` int(11) NOT NULL AUTO_INCREMENT,
  `mode_id` int(11) NOT NULL,
  `permission_id` int(11) NOT NULL,
  `group_id` int(11) NOT NULL,
  PRIMARY KEY (`perset_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=254 ;

--
-- Dumping data for table `lan_permission_settings`
--

INSERT INTO `lan_permission_settings` (`perset_id`, `mode_id`, `permission_id`, `group_id`) VALUES
(253, 0, 5, 6),
(252, 0, 5, 5),
(251, 0, 4, 6),
(250, 0, 4, 5),
(249, 0, 4, 4),
(248, 0, 3, 6),
(247, 0, 3, 5),
(246, 0, 6, 6),
(245, 0, 2, 6),
(244, 0, 1, 6),
(243, 0, 1, 5);

-- --------------------------------------------------------

--
-- Table structure for table `lan_schedule`
--

CREATE TABLE IF NOT EXISTS `lan_schedule` (
  `id` int(11) NOT NULL,
  `lan_id` int(11) NOT NULL,
  `when` date NOT NULL,
  `name` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `lan_schedule`
--


-- --------------------------------------------------------

--
-- Table structure for table `lan_seats`
--

CREATE TABLE IF NOT EXISTS `lan_seats` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `lan_id` int(11) NOT NULL,
  `seat_name` varchar(20) DEFAULT NULL,
  `user_id` int(11) NOT NULL DEFAULT '0',
  `x` int(4) NOT NULL,
  `y` int(4) NOT NULL,
  `type` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `lan_seats`
--

INSERT INTO `lan_seats` (`id`, `lan_id`, `seat_name`, `user_id`, `x`, `y`, `type`) VALUES
(1, 1, NULL, 0, 139, 122, 0),
(2, 1, NULL, 0, 182, 122, 0);

-- --------------------------------------------------------

--
-- Table structure for table `lan_servers`
--

CREATE TABLE IF NOT EXISTS `lan_servers` (
  `server_id` int(11) NOT NULL AUTO_INCREMENT,
  `address` text NOT NULL,
  `cport` int(11) NOT NULL,
  `qport` int(11) NOT NULL DEFAULT '0',
  `sport` int(11) NOT NULL DEFAULT '0',
  `ping` int(11) DEFAULT NULL,
  `game` text NOT NULL,
  `gamename` varchar(50) NOT NULL,
  `protocol` varchar(15) NOT NULL,
  `map` text,
  `playerinfo` text,
  `maxplayers` int(11) DEFAULT NULL,
  `playercount` int(11) DEFAULT NULL,
  `dedicated` tinyint(1) DEFAULT NULL,
  `password` int(11) NOT NULL,
  `servervars` varchar(10000) DEFAULT NULL,
  `hostname` text,
  `hostnameoverride` text,
  `comment` text,
  `lastupdated` datetime NOT NULL,
  `type` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`server_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `lan_servers`
--


-- --------------------------------------------------------

--
-- Table structure for table `lan_timetable`
--

CREATE TABLE IF NOT EXISTS `lan_timetable` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `occurs` datetime NOT NULL,
  `type` text NOT NULL,
  `lan_id` int(11) NOT NULL,
  `owner` int(11) NOT NULL,
  `game` int(11) DEFAULT NULL,
  `eventname` text NOT NULL,
  `othergame` text,
  `maxplayers` int(11) DEFAULT '0',
  `minplayers` int(11) DEFAULT '0',
  `userevent` int(11) NOT NULL,
  `details` text,
  `allowsignups` int(11) NOT NULL,
  `teambased` int(11) NOT NULL,
  `teamsize` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `lan_timetable`
--


-- --------------------------------------------------------

--
-- Table structure for table `lan_timetable_signups`
--

CREATE TABLE IF NOT EXISTS `lan_timetable_signups` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `timetable_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `lan_timetable_signups`
--


-- --------------------------------------------------------

--
-- Table structure for table `lan_timetable_teams`
--

CREATE TABLE IF NOT EXISTS `lan_timetable_teams` (
  `team_id` int(11) NOT NULL AUTO_INCREMENT,
  `timetable_id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `owner` int(11) NOT NULL,
  `tag` varchar(30) NOT NULL,
  PRIMARY KEY (`team_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `lan_timetable_teams`
--


-- --------------------------------------------------------

--
-- Table structure for table `lan_timetable_team_members`
--

CREATE TABLE IF NOT EXISTS `lan_timetable_team_members` (
  `tm_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `team_id` int(11) NOT NULL,
  PRIMARY KEY (`tm_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `lan_timetable_team_members`
--


-- --------------------------------------------------------

--
-- Table structure for table `lan_timetable_team_members_seq`
--

CREATE TABLE IF NOT EXISTS `lan_timetable_team_members_seq` (
  `sequence` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`sequence`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `lan_timetable_team_members_seq`
--


-- --------------------------------------------------------

--
-- Table structure for table `lan_users`
--

CREATE TABLE IF NOT EXISTS `lan_users` (
  `user_id` int(11) NOT NULL,
  `username` text NOT NULL,
  `password` text NOT NULL,
  `email` text,
  `clan` text,
  `ip` text,
  `netbios` text,
  `avatar` varchar(200) NOT NULL,
  `smallavatar` varchar(200) NOT NULL,
  `steamdata` varchar(65000) NOT NULL,
  `steamprofile` varchar(50) NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `lan_users`
--

INSERT INTO `lan_users` (`user_id`, `username`, `password`, `email`, `clan`, `ip`, `netbios`, `avatar`, `smallavatar`, `steamdata`, `steamprofile`) VALUES
(1, 'Admin', '5f4dcc3b5aa765d61d8327deb882cf99', NULL, NULL, '127.0.0.1', NULL, '', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `lgsl`
--

CREATE TABLE IF NOT EXISTS `lgsl` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(50) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `ip` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `c_port` varchar(5) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `q_port` varchar(5) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `s_port` varchar(5) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `zone` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `disabled` tinyint(1) NOT NULL DEFAULT '0',
  `comment` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `cache` text COLLATE utf8_unicode_ci NOT NULL,
  `cache_time` text COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

--
-- Dumping data for table `lgsl`
--

