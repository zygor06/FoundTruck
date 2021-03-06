-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema mydb
-- -----------------------------------------------------
-- -----------------------------------------------------
-- Schema db_foundtruck
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema db_foundtruck
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `db_foundtruck` DEFAULT CHARACTER SET utf8 ;
USE `db_foundtruck` ;

-- -----------------------------------------------------
-- Table `db_foundtruck`.`TB_ALIMENTO`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `db_foundtruck`.`TB_ALIMENTO` (
  `NR_ID` INT NOT NULL AUTO_INCREMENT,
  `TE_ALIMENTO` VARCHAR(45) NOT NULL,
  `TE_IMAGEM` VARCHAR(45) NULL DEFAULT NULL,
  PRIMARY KEY (`NR_ID`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = binary;


-- -----------------------------------------------------
-- Table `db_foundtruck`.`TB_USUARIO`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `db_foundtruck`.`TB_USUARIO` (
  `NR_CPF` VARCHAR(11) NOT NULL,
  `TE_EMAIL` VARCHAR(50) NOT NULL,
  `TE_SENHA` VARCHAR(12) NOT NULL,
  `TE_NOME` VARCHAR(50) NOT NULL,
  `CS_ATIVO` INT(2) NOT NULL,
  PRIMARY KEY (`NR_CPF`),
  UNIQUE INDEX `email_UNIQUE` (`TE_EMAIL` ASC))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `db_foundtruck`.`TB_FOODTRUCK`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `db_foundtruck`.`TB_FOODTRUCK` (
  `NR_ID` INT NOT NULL AUTO_INCREMENT,
  `TE_NOME` VARCHAR(45) NOT NULL,
  `NR_LAT` FLOAT(10,6) NULL DEFAULT NULL,
  `NR_LONG` FLOAT(10,6) NULL DEFAULT NULL,
  `NR_CPF_USUARIO` VARCHAR(12) NOT NULL,
  `TE_DESCRICAO` VARCHAR(500) NULL DEFAULT NULL,
  `TE_IMAGEM` VARCHAR(45) NULL DEFAULT NULL,
  `CS_ATIVO` INT(2) NOT NULL,
  PRIMARY KEY (`NR_ID`),
  INDEX `fk_foodtrucks_usuarios_idx` (`NR_CPF_USUARIO` ASC),
  CONSTRAINT `fk_foodtrucks_usuarios`
    FOREIGN KEY (`NR_CPF_USUARIO`)
    REFERENCES `db_foundtruck`.`TB_USUARIO` (`NR_CPF`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `db_foundtruck`.`TB_COMENTARIO`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `db_foundtruck`.`TB_COMENTARIO` (
  `NR_ID` INT NOT NULL AUTO_INCREMENT,
  `TE_COMENTARIO` VARCHAR(500) NULL DEFAULT NULL,
  `NR_ID_FOODTRUCK` INT NOT NULL,
  `DT_DATA` DATE NOT NULL,
  `TE_AUTOR` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`NR_ID`),
  INDEX `fk_TB_COMENTARIOS_TB_FOODTRUCKS1_idx` (`NR_ID_FOODTRUCK` ASC),
  CONSTRAINT `fk_TB_COMENTARIOS_TB_FOODTRUCKS1`
    FOREIGN KEY (`NR_ID_FOODTRUCK`)
    REFERENCES `db_foundtruck`.`TB_FOODTRUCK` (`NR_ID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `db_foundtruck`.`TB_VENDE`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `db_foundtruck`.`TB_VENDE` (
  `TB_ALIMENTO_NR_ID` INT NOT NULL,
  `TB_FOODTRUCK_NR_ID` INT NOT NULL,
  PRIMARY KEY (`TB_ALIMENTO_NR_ID`, `TB_FOODTRUCK_NR_ID`),
  INDEX `fk_tb_alimentos_has_tb_foodtrucks_tb_foodtrucks1_idx` (`TB_FOODTRUCK_NR_ID` ASC),
  INDEX `fk_tb_alimentos_has_tb_foodtrucks_tb_alimentos1_idx` (`TB_ALIMENTO_NR_ID` ASC),
  CONSTRAINT `fk_tb_alimentos_has_tb_foodtrucks_tb_alimentos1`
    FOREIGN KEY (`TB_ALIMENTO_NR_ID`)
    REFERENCES `db_foundtruck`.`TB_ALIMENTO` (`NR_ID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_tb_alimentos_has_tb_foodtrucks_tb_foodtrucks1`
    FOREIGN KEY (`TB_FOODTRUCK_NR_ID`)
    REFERENCES `db_foundtruck`.`TB_FOODTRUCK` (`NR_ID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
