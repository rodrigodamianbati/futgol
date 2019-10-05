-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema futgol
-- -----------------------------------------------------
DROP SCHEMA IF EXISTS `futgol` ;

-- -----------------------------------------------------
-- Schema futgol
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `futgol` DEFAULT CHARACTER SET utf8 ;
USE `futgol` ;

-- -----------------------------------------------------
-- Table `ciudad`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `ciudad` ;

CREATE TABLE IF NOT EXISTS `ciudad` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `rol`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `rol` ;

CREATE TABLE IF NOT EXISTS `rol` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `usuario`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `usuario` ;

CREATE TABLE IF NOT EXISTS `usuario` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `email` VARCHAR(45) NOT NULL,
  `nombre` VARCHAR(45) NOT NULL,
  `apellido` VARCHAR(45) NOT NULL,
  `activo` TINYINT(1) NOT NULL DEFAULT 1,
  `pwd` VARCHAR(20) NOT NULL,
  `imagen` VARCHAR(200) NULL,
  `rol_id` INT NOT NULL,
  `usuario` VARCHAR(45) NULL,
  PRIMARY KEY (`id`, `rol_id`),
  CONSTRAINT `fk_Usuario_Rol1`
    FOREIGN KEY (`rol_id`)
    REFERENCES `rol` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

CREATE UNIQUE INDEX `email_UNIQUE` ON `usuario` (`email` ASC);

CREATE INDEX `fk_Usuario_Rol1_idx` ON `usuario` (`rol_id` ASC);


-- -----------------------------------------------------
-- Table `complejo`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `complejo` ;

CREATE TABLE IF NOT EXISTS `complejo` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `ciudad_id` INT NOT NULL,
  `nombre` VARCHAR(45) NOT NULL,
  `direccion` VARCHAR(45) NOT NULL,
  `telefono` VARCHAR(20) NULL,
  `email` VARCHAR(45) NULL,
  `usuario_id` INT NOT NULL,
  `descripcion` VARCHAR(500) NULL,
  PRIMARY KEY (`id`, `usuario_id`),
  CONSTRAINT `fk_Complejo_Localidad1`
    FOREIGN KEY (`ciudad_id`)
    REFERENCES `ciudad` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Complejo_Usuario1`
    FOREIGN KEY (`usuario_id`)
    REFERENCES `usuario` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

CREATE INDEX `fk_Complejo_Localidad1_idx` ON `complejo` (`ciudad_id` ASC);

CREATE INDEX `fk_Complejo_Usuario1_idx` ON `complejo` (`usuario_id` ASC);


-- -----------------------------------------------------
-- Table `tipo_superficie`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `tipo_superficie` ;

CREATE TABLE IF NOT EXISTS `tipo_superficie` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `cancha`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `cancha` ;

CREATE TABLE IF NOT EXISTS `cancha` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `complejo_id` INT NOT NULL,
  `jugadores` INT NOT NULL,
  `abierta` TINYINT(1) NOT NULL DEFAULT 1,
  `caracteristicas` VARCHAR(255) NULL,
  `tipo_superficie_id` INT NOT NULL,
  PRIMARY KEY (`id`, `tipo_superficie_id`),
  CONSTRAINT `fk_Cancha_Complejo`
    FOREIGN KEY (`complejo_id`)
    REFERENCES `complejo` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Cancha_Tipo_superficie1`
    FOREIGN KEY (`tipo_superficie_id`)
    REFERENCES `tipo_superficie` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

CREATE INDEX `fk_Cancha_Complejo_idx` ON `cancha` (`complejo_id` ASC);

CREATE INDEX `fk_Cancha_Tipo_superficie1_idx` ON `cancha` (`tipo_superficie_id` ASC);


-- -----------------------------------------------------
-- Table `usuario_complejo`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `usuario_complejo` ;

CREATE TABLE IF NOT EXISTS `usuario_complejo` (
  `usuario_id` INT NOT NULL,
  `complejo_id` INT NOT NULL,
  PRIMARY KEY (`usuario_id`, `complejo_id`),
  CONSTRAINT `fk_usuario_has_complejo_usuario1`
    FOREIGN KEY (`usuario_id`)
    REFERENCES `usuario` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_usuario_has_complejo_complejo1`
    FOREIGN KEY (`complejo_id`)
    REFERENCES `complejo` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

CREATE INDEX `fk_usuario_has_complejo_complejo1_idx` ON `usuario_complejo` (`complejo_id` ASC);

CREATE INDEX `fk_usuario_has_complejo_usuario1_idx` ON `usuario_complejo` (`usuario_id` ASC);


-- -----------------------------------------------------
-- Table `reserva`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `reserva` ;

CREATE TABLE IF NOT EXISTS `reserva` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `usuario_id` INT NOT NULL,
  `cancha_id` INT NOT NULL,
  `fecha` DATETIME NOT NULL,
  `cancelada` TINYINT(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`),
  CONSTRAINT `fk_Reserva_Usuario1`
    FOREIGN KEY (`usuario_id`)
    REFERENCES `usuario` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Reserva_Cancha1`
    FOREIGN KEY (`cancha_id`)
    REFERENCES `cancha` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

CREATE INDEX `fk_Reserva_Usuario1_idx` ON `reserva` (`usuario_id` ASC);

CREATE INDEX `fk_Reserva_Cancha1_idx` ON `reserva` (`cancha_id` ASC);


-- -----------------------------------------------------
-- Table `partido`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `partido` ;

CREATE TABLE IF NOT EXISTS `partido` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `reserva_id` INT NOT NULL,
  PRIMARY KEY (`id`, `reserva_id`),
  CONSTRAINT `fk_Partido_Reserva1`
    FOREIGN KEY (`reserva_id`)
    REFERENCES `reserva` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

CREATE INDEX `fk_Partido_Reserva1_idx` ON `partido` (`reserva_id` ASC);


-- -----------------------------------------------------
-- Table `invitacion`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `invitacion` ;

CREATE TABLE IF NOT EXISTS `invitacion` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `usuario_id` INT NOT NULL,
  `partido_id` INT NOT NULL,
  `aceptada` TINYINT(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`),
  CONSTRAINT `fk_Invitacion_Usuario1`
    FOREIGN KEY (`usuario_id`)
    REFERENCES `usuario` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Invitacion_Partido1`
    FOREIGN KEY (`partido_id`)
    REFERENCES `partido` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

CREATE INDEX `fk_Invitacion_Usuario1_idx` ON `invitacion` (`usuario_id` ASC);

CREATE INDEX `fk_Invitacion_Partido1_idx` ON `invitacion` (`partido_id` ASC);


-- -----------------------------------------------------
-- Table `dia_semana`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `dia_semana` ;

CREATE TABLE IF NOT EXISTS `dia_semana` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `descripcion` VARCHAR(15) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `turno`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `turno` ;

CREATE TABLE IF NOT EXISTS `turno` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `dia` INT NOT NULL,
  `hora` INT NOT NULL,
  `cancha_id` INT NOT NULL,
  PRIMARY KEY (`id`),
  CONSTRAINT `fk_Turno_Cancha1`
    FOREIGN KEY (`cancha_id`)
    REFERENCES `cancha` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_turno_dia_semana1`
    FOREIGN KEY (`dia`)
    REFERENCES `dia_semana` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

CREATE INDEX `fk_Turno_Cancha1_idx` ON `turno` (`cancha_id` ASC);

CREATE INDEX `fk_turno_dia_semana1_idx` ON `turno` (`dia` ASC);


-- -----------------------------------------------------
-- Table `imagen_complejo`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `imagen_complejo` ;

CREATE TABLE IF NOT EXISTS `imagen_complejo` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(45) NOT NULL,
  `path` VARCHAR(255) NOT NULL,
  `complejo_id` INT NOT NULL,
  PRIMARY KEY (`id`),
  CONSTRAINT `fk_imagen_complejo_complejo1`
    FOREIGN KEY (`complejo_id`)
    REFERENCES `complejo` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

CREATE INDEX `fk_imagen_complejo_complejo1_idx` ON `imagen_complejo` (`complejo_id` ASC);


-- -----------------------------------------------------
-- Table `servicio`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `servicio` ;

CREATE TABLE IF NOT EXISTS `servicio` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(45) NOT NULL,
  `icono` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `servicio_complejo`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `servicio_complejo` ;

CREATE TABLE IF NOT EXISTS `servicio_complejo` (
  `servicio_id` INT NOT NULL,
  `complejo_id` INT NOT NULL,
  PRIMARY KEY (`servicio_id`, `complejo_id`),
  CONSTRAINT `fk_Servicio_has_Complejo_Servicio1`
    FOREIGN KEY (`servicio_id`)
    REFERENCES `servicio` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Servicio_has_Complejo_Complejo1`
    FOREIGN KEY (`complejo_id`)
    REFERENCES `complejo` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

CREATE INDEX `fk_Servicio_has_Complejo_Complejo1_idx` ON `servicio_complejo` (`complejo_id` ASC);

CREATE INDEX `fk_Servicio_has_Complejo_Servicio1_idx` ON `servicio_complejo` (`servicio_id` ASC);


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;

-- -----------------------------------------------------
-- Data for table `ciudad`
-- -----------------------------------------------------
START TRANSACTION;
USE `futgol`;
INSERT INTO `ciudad` (`id`, `nombre`) VALUES (1, 'Viedma');

COMMIT;


-- -----------------------------------------------------
-- Data for table `rol`
-- -----------------------------------------------------
START TRANSACTION;
USE `futgol`;
INSERT INTO `rol` (`id`, `nombre`) VALUES (1, 'Jugador');
INSERT INTO `rol` (`id`, `nombre`) VALUES (2, 'Administrador');
INSERT INTO `rol` (`id`, `nombre`) VALUES (3, 'Programador');

COMMIT;


-- -----------------------------------------------------
-- Data for table `tipo_superficie`
-- -----------------------------------------------------
START TRANSACTION;
USE `futgol`;
INSERT INTO `tipo_superficie` (`id`, `nombre`) VALUES (1, 'Cemento');
INSERT INTO `tipo_superficie` (`id`, `nombre`) VALUES (2, 'Sintético');
INSERT INTO `tipo_superficie` (`id`, `nombre`) VALUES (3, 'Tierra');

COMMIT;


START TRANSACTION;
USE `futgol`;
INSERT INTO usuario VALUES(1,'a@a.com','Alvaro','AA',1,'seu.8HpuOxyTU',NULL,1,'Alvaro');
INSERT INTO usuario VALUES(2, 'b@b.com', 'Bb', 'BB', 1, 'seu.8HpuOxyTU', NULL, 1,'Beto');
COMMIT;


START TRANSACTION;
USE `futgol`;
INSERT INTO `futgol`.`dia_semana`(`id`,`descripcion`) VALUES ( NULL,'Lunes'); 
INSERT INTO `futgol`.`dia_semana`(`id`,`descripcion`) VALUES ( NULL,'Martes'); 
INSERT INTO `futgol`.`dia_semana`(`id`,`descripcion`) VALUES ( NULL,'Miércoles'); 
INSERT INTO `futgol`.`dia_semana`(`id`,`descripcion`) VALUES ( NULL,'Jueves'); 
INSERT INTO `futgol`.`dia_semana`(`id`,`descripcion`) VALUES ( NULL,'Viernes'); 
INSERT INTO `futgol`.`dia_semana`(`id`,`descripcion`) VALUES ( NULL,'Sábado'); 
INSERT INTO `futgol`.`dia_semana`(`id`,`descripcion`) VALUES ( NULL,'Domingo'); 
COMMIT;

START TRANSACTION;
USE `futgol`;
INSERT INTO servicio VALUES ('1', 'WiFi', 'icon-connection');
INSERT INTO servicio VALUES ('2', 'Duchas', 'fa fa-shower');
INSERT INTO servicio VALUES ('3', 'Bar', 'fa fa-beer');
INSERT INTO servicio VALUES ('4', 'Estac. gratis', 'fa fa-etsy');
INSERT INTO servicio VALUES ('5', 'Cumpleaños', 'fa fa-birthday-cake');
INSERT INTO servicio VALUES ('6', 'Asador', 'glyphicon glyphicon-fire');
INSERT INTO servicio VALUES ('7', 'Quincho', 'glyphicon glyphicon-cutlery');
COMMIT;
