-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema webdev
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema webdev
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `webdev` ;
USE `webdev` ;

-- -----------------------------------------------------
-- Table `webdev`.`TB_USUARIOS`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `webdev`.`TB_USUARIOS` (
  `id_usuarios` INT NOT NULL AUTO_INCREMENT,
  `email` VARCHAR(45) NOT NULL,
  `senha` VARCHAR(45) NOT NULL,
  `nome` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`id_usuarios`),
  UNIQUE INDEX `email_UNIQUE` (`email` ASC))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `webdev`.`TB_FOODTRUCKS`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `webdev`.`TB_FOODTRUCKS` (
  `id_foodtrucks` INT NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(45) NOT NULL,
  `lat` FLOAT(10,6) NULL,
  `lng` FLOAT(10,6) NULL,
  `id_usuarios_fk` INT NOT NULL,
  `descricao` VARCHAR(500) NULL,
  `imagem` VARCHAR(45) NULL,
  PRIMARY KEY (`id_foodtrucks`),
  INDEX `fk_foodtrucks_usuarios_idx` (`id_usuarios_fk` ASC),
  CONSTRAINT `fk_foodtrucks_usuarios`
    FOREIGN KEY (`id_usuarios_fk`)
    REFERENCES `webdev`.`TB_USUARIOS` (`id_usuarios`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `webdev`.`TB_ALIMENTOS`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `webdev`.`TB_ALIMENTOS` (
  `id_alimentos` INT NOT NULL AUTO_INCREMENT,
  `alimento` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`id_alimentos`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `webdev`.`TB_ALIMENTOS_HAS_TB_FOODTRUCKS`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `webdev`.`TB_ALIMENTOS_HAS_TB_FOODTRUCKS` (
  `tb_alimentos_id_alimentos` INT NOT NULL,
  `tb_foodtrucks_id_foodtrucks` INT NOT NULL,
  PRIMARY KEY (`tb_alimentos_id_alimentos`, `tb_foodtrucks_id_foodtrucks`),
  INDEX `fk_tb_alimentos_has_tb_foodtrucks_tb_foodtrucks1_idx` (`tb_foodtrucks_id_foodtrucks` ASC),
  INDEX `fk_tb_alimentos_has_tb_foodtrucks_tb_alimentos1_idx` (`tb_alimentos_id_alimentos` ASC),
  CONSTRAINT `fk_tb_alimentos_has_tb_foodtrucks_tb_alimentos1`
    FOREIGN KEY (`tb_alimentos_id_alimentos`)
    REFERENCES `webdev`.`TB_ALIMENTOS` (`id_alimentos`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_tb_alimentos_has_tb_foodtrucks_tb_foodtrucks1`
    FOREIGN KEY (`tb_foodtrucks_id_foodtrucks`)
    REFERENCES `webdev`.`TB_FOODTRUCKS` (`id_foodtrucks`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `webdev`.`TB_COMENTARIOS`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `webdev`.`TB_COMENTARIOS` (
  `id_comentarios` INT NOT NULL AUTO_INCREMENT,
  `comentario` VARCHAR(500) NULL,
  `tb_foodtrucks_id_foodtrucks` INT NOT NULL,
  PRIMARY KEY (`id_comentarios`),
  INDEX `fk_TB_COMENTARIOS_TB_FOODTRUCKS1_idx` (`tb_foodtrucks_id_foodtrucks` ASC),
  CONSTRAINT `fk_TB_COMENTARIOS_TB_FOODTRUCKS1`
    FOREIGN KEY (`tb_foodtrucks_id_foodtrucks`)
    REFERENCES `webdev`.`TB_FOODTRUCKS` (`id_foodtrucks`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
