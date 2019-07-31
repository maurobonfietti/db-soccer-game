-- ----------------------------
-- Table structure for player
-- ----------------------------
DROP TABLE IF EXISTS `player`;
CREATE TABLE `player` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `won` int(11) DEFAULT 0,
  `drawn` int(11) DEFAULT 0,
  `lost` int(11) DEFAULT 0,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of player
-- ----------------------------
INSERT INTO `player` (`name`) VALUES ('Mauro Bonfietti');
INSERT INTO `player` (`name`) VALUES ('Carlos Tevez');
INSERT INTO `player` (`name`) VALUES ('Paulo Dybala');
INSERT INTO `player` (`name`) VALUES ('Lionel Messi');
INSERT INTO `player` (`name`) VALUES ('Cristiano Ronaldo');
INSERT INTO `player` (`name`) VALUES ('Luka Modrić');
INSERT INTO `player` (`name`) VALUES ('Luis Suarez');
INSERT INTO `player` (`name`) VALUES ('Antoine Griezmann');
INSERT INTO `player` (`name`) VALUES ('James Rodriguez');
INSERT INTO `player` (`name`) VALUES ('Neymar');
INSERT INTO `player` (`name`) VALUES ('Dani Alves');
INSERT INTO `player` (`name`) VALUES ('Matthijs de Ligt');
INSERT INTO `player` (`name`) VALUES ('Frenkie de Jong');
INSERT INTO `player` (`name`) VALUES ('Virgil van Dijk');
INSERT INTO `player` (`name`) VALUES ('Sergio Busquets');
INSERT INTO `player` (`name`) VALUES ('Eden Hazard');
INSERT INTO `player` (`name`) VALUES ('Paul Pogba');
INSERT INTO `player` (`name`) VALUES ('Kevin De Bruyne');
INSERT INTO `player` (`name`) VALUES ('Sergio Agüero');
INSERT INTO `player` (`name`) VALUES ('Gerard Piqué');
INSERT INTO `player` (`name`) VALUES ('Trent Alexander-Arnold');
INSERT INTO `player` (`name`) VALUES ('Moussa Sissoko');
INSERT INTO `player` (`name`) VALUES ('Tanguy Ndombélé');
INSERT INTO `player` (`name`) VALUES ('Raheem Sterling');
INSERT INTO `player` (`name`) VALUES ('Lucas Moura');
INSERT INTO `player` (`name`) VALUES ('Kylian Mbappé');
INSERT INTO `player` (`name`) VALUES ('Raphaël Varane');

-- ----------------------------
-- Table structure for matches
-- ----------------------------
DROP TABLE IF EXISTS `match`;
CREATE TABLE `match` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `match` varchar(1000),
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of matches
-- ----------------------------
INSERT INTO `match` (`match`) VALUES ('{}');
