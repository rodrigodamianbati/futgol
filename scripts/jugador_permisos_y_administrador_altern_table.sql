ALTER TABLE `jugador` ADD `permisos` TINYINT(1) NOT NULL DEFAULT '0' AFTER `permisos`;

ALTER TABLE `jugador` ADD `administrador` TINYINT(1) NOT NULL DEFAULT '0' AFTER `administrador`;