-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema ICS199Group03_dev
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema ICS199Group03_dev
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `ICS199Group03_dev` DEFAULT CHARACTER SET utf8 ;
USE `ICS199Group03_dev` ;

-- -----------------------------------------------------
-- Table `ICS199Group03_dev`.`ProductCategories`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `ICS199Group03_dev`.`ProductCategories` ;

CREATE TABLE IF NOT EXISTS `ICS199Group03_dev`.`ProductCategories` (
  `cat_id` INT NOT NULL AUTO_INCREMENT,
  `cat_name` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`cat_id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `ICS199Group03_dev`.`Products`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `ICS199Group03_dev`.`Products` ;

CREATE TABLE IF NOT EXISTS `ICS199Group03_dev`.`Products` (
  `prod_id` INT NOT NULL AUTO_INCREMENT,
  `prod_name` VARCHAR(255) NOT NULL,
  `prod_type` VARCHAR(45) NOT NULL,
  `prod_description` MEDIUMTEXT NOT NULL,
  `prod_picture` VARCHAR(255) NOT NULL,
  `prod_price` VARCHAR(45) NOT NULL,
  `prod_avail` VARCHAR(45) NOT NULL,
  `ProductCategories_cat_id` INT NOT NULL,
  PRIMARY KEY (`prod_id`, `ProductCategories_cat_id`),
  INDEX `fk_Products_ProductCategories_idx` (`ProductCategories_cat_id` ASC),
  CONSTRAINT `fk_Products_ProductCategories`
    FOREIGN KEY (`ProductCategories_cat_id`)
    REFERENCES `ICS199Group03_dev`.`ProductCategories` (`cat_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `ICS199Group03_dev`.`Logins`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `ICS199Group03_dev`.`Logins` ;

CREATE TABLE IF NOT EXISTS `ICS199Group03_dev`.`Logins` (
  `login_id` INT NOT NULL AUTO_INCREMENT,
  `first_name` VARCHAR(45) NULL,
  `last_name` VARCHAR(45) NULL,
  `password` VARCHAR(45) NULL,
  `shipping_address` VARCHAR(255) NULL,
  `email_address` VARCHAR(45) NULL,
  `phone_number` VARCHAR(45) NULL,
  `admin_toggle` TINYINT NULL,
  PRIMARY KEY (`login_id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `ICS199Group03_dev`.`OrderDetails`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `ICS199Group03_dev`.`OrderDetails` ;

CREATE TABLE IF NOT EXISTS `ICS199Group03_dev`.`OrderDetails` (
  `order_id` INT NOT NULL AUTO_INCREMENT,
  `login_id` VARCHAR(45) NOT NULL,
  `order_complete` TINYINT(1) NOT NULL,
  `order_cost` VARCHAR(45) NOT NULL,
  `order_timestamp` DATETIME NOT NULL,
  PRIMARY KEY (`order_id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `ICS199Group03_dev`.`OrderedProducts`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `ICS199Group03_dev`.`OrderedProducts` ;

CREATE TABLE IF NOT EXISTS `ICS199Group03_dev`.`OrderedProducts` (
  `OrderDetails_order_id` INT NOT NULL,
  `prod_id` VARCHAR(45) NOT NULL,
  `prod_quantity` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`OrderDetails_order_id`),
  INDEX `fk_OrderedProducts_OrderDetails1_idx` (`OrderDetails_order_id` ASC),
  CONSTRAINT `fk_OrderedProducts_OrderDetails1`
    FOREIGN KEY (`OrderDetails_order_id`)
    REFERENCES `ICS199Group03_dev`.`OrderDetails` (`order_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
