-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema BD_FOUNDTRUCKS
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema BD_FOUNDTRUCKS
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `BD_FOUNDTRUCKS` ;
USE `BD_FOUNDTRUCKS` ;

-- -----------------------------------------------------
-- Table `BD_FOUNDTRUCKS`.`TB_USUARIO`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `BD_FOUNDTRUCKS`.`TB_USUARIO` (
  `NM_CPF` INT NOT NULL AUTO_INCREMENT,
  `TE_EMAIL` VARCHAR(45) NOT NULL,
  `TE_SENHA` VARCHAR(45) NOT NULL,
  `TE_NOME` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`NM_CPF`),
  UNIQUE INDEX `email_UNIQUE` (`TE_EMAIL` ASC))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `BD_FOUNDTRUCKS`.`TB_FOODTRUCK`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `BD_FOUNDTRUCKS`.`TB_FOODTRUCK` (
  `NM_ID` INT NOT NULL AUTO_INCREMENT,
  `TE_NOME` VARCHAR(45) NOT NULL,
  `NM_LAT` FLOAT(10,6) NULL,
  `NM_LONG` FLOAT(10,6) NULL,
  `NM_CPF_USUARIO` INT NOT NULL,
  `TE_DESCRICAO` VARCHAR(500) NULL,
  `TE_IMAGEM` VARCHAR(45) NULL,
  PRIMARY KEY (`NM_ID`),
  INDEX `fk_foodtrucks_usuarios_idx` (`NM_CPF_USUARIO` ASC),
  CONSTRAINT `fk_foodtrucks_usuarios`
    FOREIGN KEY (`NM_CPF_USUARIO`)
    REFERENCES `BD_FOUNDTRUCKS`.`TB_USUARIO` (`NM_CPF`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `BD_FOUNDTRUCKS`.`TB_ALIMENTO`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `BD_FOUNDTRUCKS`.`TB_ALIMENTO` (
  `NM_ID` INT NOT NULL AUTO_INCREMENT,
  `TE_ALIMENTO` VARCHAR(45) NOT NULL,
  `TE_IMAGEM` VARCHAR(45) NULL,
  PRIMARY KEY (`NM_ID`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `BD_FOUNDTRUCKS`.`TB_ALIMENTO_HAS_TB_FOODTRUCK`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `BD_FOUNDTRUCKS`.`TB_ALIMENTO_HAS_TB_FOODTRUCK` (
  `TB_ALIMENTO_NM_ID` INT NOT NULL,
  `TB_FOODTRUCK_NM_ID` INT NOT NULL,
  PRIMARY KEY (`TB_ALIMENTO_NM_ID`, `TB_FOODTRUCK_NM_ID`),
  INDEX `fk_tb_alimentos_has_tb_foodtrucks_tb_foodtrucks1_idx` (`TB_FOODTRUCK_NM_ID` ASC),
  INDEX `fk_tb_alimentos_has_tb_foodtrucks_tb_alimentos1_idx` (`TB_ALIMENTO_NM_ID` ASC),
  CONSTRAINT `fk_tb_alimentos_has_tb_foodtrucks_tb_alimentos1`
    FOREIGN KEY (`TB_ALIMENTO_NM_ID`)
    REFERENCES `BD_FOUNDTRUCKS`.`TB_ALIMENTO` (`NM_ID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_tb_alimentos_has_tb_foodtrucks_tb_foodtrucks1`
    FOREIGN KEY (`TB_FOODTRUCK_NM_ID`)
    REFERENCES `BD_FOUNDTRUCKS`.`TB_FOODTRUCK` (`NM_ID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `BD_FOUNDTRUCKS`.`TB_COMENTARIO`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `BD_FOUNDTRUCKS`.`TB_COMENTARIO` (
  `NM_ID` INT NOT NULL AUTO_INCREMENT,
  `TE_COMENTARIO` VARCHAR(500) NULL,
  `NM_ID_FOODTRUCK` INT NOT NULL,
  PRIMARY KEY (`NM_ID`),
  INDEX `fk_TB_COMENTARIOS_TB_FOODTRUCKS1_idx` (`NM_ID_FOODTRUCK` ASC),
  CONSTRAINT `fk_TB_COMENTARIOS_TB_FOODTRUCKS1`
    FOREIGN KEY (`NM_ID_FOODTRUCK`)
    REFERENCES `BD_FOUNDTRUCKS`.`TB_FOODTRUCK` (`NM_ID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
