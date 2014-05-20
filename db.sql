-- phpMyAdmin SQL Dump
-- version 2.6.4-pl3
-- http://www.phpmyadmin.net
-- 
-- Serveur: db2660.1and1.fr
-- Généré le : Dimanche 18 Mai 2014 à 20:29
-- Version du serveur: 5.1.73
-- Version de PHP: 5.3.3-7+squeeze19
-- 
-- Base de données: `db362063768`
-- 

-- --------------------------------------------------------

--
-- Création de la base de donnée
--
CREATE DATABASE `nrj`;


-- 
-- Structure de la table `character`
-- 

DROP TABLE IF EXISTS `character`;
CREATE TABLE IF NOT EXISTS `character` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  `img` varchar(45) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8 AUTO_INCREMENT=20 ;

-- 
-- Contenu de la table `character`
-- 

INSERT INTO `character` VALUES (1, 'Mush', 'mush.jpg');
INSERT INTO `character` VALUES (2, 'Kim Jin Su', 'kim_jin_su.jpg');
INSERT INTO `character` VALUES (3, 'Frieda Bergmann', 'frieda_bergmann.jpg');
INSERT INTO `character` VALUES (4, 'Paola Rinaldo', 'paola_rinaldo.jpg');
INSERT INTO `character` VALUES (5, 'Ian Soulton', 'ian_soulton.jpg');
INSERT INTO `character` VALUES (6, 'Finola Keegan', 'finola_keegan.jpg');
INSERT INTO `character` VALUES (7, 'Zhong Chun', 'zhong_chun.jpg');
INSERT INTO `character` VALUES (8, 'Stephen Seagull', 'stephen_seagull.jpg');
INSERT INTO `character` VALUES (9, 'Wang Chao', 'wang_chao.jpg');
INSERT INTO `character` VALUES (10, 'Jiang Hua', 'jiang_hua.jpg');
INSERT INTO `character` VALUES (11, 'Roland Zuccali', 'roland_zuccali.jpg');
INSERT INTO `character` VALUES (12, 'Terrence Archer', 'terrence_archer.jpg');
INSERT INTO `character` VALUES (13, 'Eleesha Williams', 'eleesha_williams.jpg');
INSERT INTO `character` VALUES (14, 'Gioele Rinaldo', 'gioele_rinaldo.jpg');
INSERT INTO `character` VALUES (15, 'Janice Kent', 'janice_kent.jpg');
INSERT INTO `character` VALUES (16, 'Lai Kuan Ti', 'lai_kuan_ti.jpg');
INSERT INTO `character` VALUES (17, 'Raluca Tomescu', 'raluca_tomescu.jpg');
INSERT INTO `character` VALUES (18, 'Derek Hogan', 'derek_hogan.jpg');
INSERT INTO `character` VALUES (19, 'Andie Graham', 'andie_graham.jpg');

-- --------------------------------------------------------

-- 
-- Structure de la table `diary`
-- 

DROP TABLE IF EXISTS `diary`;
CREATE TABLE IF NOT EXISTS `diary` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `dt_start` datetime NOT NULL,
  `dt_end` datetime DEFAULT NULL,
  `the_end` varchar(45) DEFAULT NULL,
  `last_will` longtext,
  `title` text,
  `character_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `finished` tinyint(1) NOT NULL DEFAULT '0',
  `visible` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `fk_diary_character1_idx` (`character_id`),
  KEY `fk_diary_user1_idx` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=575 DEFAULT CHARSET=utf8 AUTO_INCREMENT=575 ;


-- --------------------------------------------------------

-- 
-- Structure de la table `entry`
-- 

DROP TABLE IF EXISTS `entry`;
CREATE TABLE IF NOT EXISTS `entry` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `dt_entry` datetime NOT NULL,
  `day` int(11) DEFAULT NULL,
  `text` longtext,
  `diary_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_entry_diary_idx` (`diary_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2012 DEFAULT CHARSET=utf8 AUTO_INCREMENT=2012 ;


-- --------------------------------------------------------

-- 
-- Structure de la table `user`
-- 

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  `twin_id` int(10) NOT NULL,
  `locale` varchar(2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=453 DEFAULT CHARSET=utf8 AUTO_INCREMENT=453 ;

-- 
-- Contenu de la table `user`
-- 

INSERT INTO `user` VALUES (1, 'Admin', 0, 'fr');

-- 
-- Contraintes pour les tables exportées
-- 

-- 
-- Contraintes pour la table `diary`
-- 
ALTER TABLE `diary`
  ADD CONSTRAINT `fk_diary_character1` FOREIGN KEY (`character_id`) REFERENCES `character` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_diary_user1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

-- 
-- Contraintes pour la table `entry`
-- 
ALTER TABLE `entry`
  ADD CONSTRAINT `fk_entry_diary` FOREIGN KEY (`diary_id`) REFERENCES `diary` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
