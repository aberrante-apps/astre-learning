-- ------------------------------------------------------------------------------
-- Automated Script For Creation of Pre-Defined Tables to Be Used In the Database
-- ------------------------------------------------------------------------------

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
-- Table `ICS199Group03_dev`.`Products`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `ICS199Group03_dev`.`Products` ;

CREATE TABLE IF NOT EXISTS `ICS199Group03_dev`.`Products` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(255) NOT NULL,
  `description` MEDIUMTEXT NOT NULL,
  `picture` VARCHAR(255) NOT NULL,
  `price` DECIMAL(6,2) NOT NULL,
  `stock` INT NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `prod_name_UNIQUE` (`name` ASC),
  UNIQUE INDEX `prod_picture_UNIQUE` (`picture` ASC))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `ICS199Group03_dev`.`Categories`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `ICS199Group03_dev`.`Categories` ;

CREATE TABLE IF NOT EXISTS `ICS199Group03_dev`.`Categories` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `cat_name_UNIQUE` (`name` ASC))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `ICS199Group03_dev`.`Logins`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `ICS199Group03_dev`.`Logins` ;

CREATE TABLE IF NOT EXISTS `ICS199Group03_dev`.`Logins` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `first_name` VARCHAR(45) NOT NULL,
  `last_name` VARCHAR(45) NOT NULL,
  `email_address` VARCHAR(45) NOT NULL,
  `phone_number` VARCHAR(45) NULL,
  `password` VARCHAR(45) NOT NULL,
  `admin` TINYINT NOT NULL,
  `data_permission` TINYINT NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `email_address_UNIQUE` (`email_address` ASC))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `ICS199Group03_dev`.`Orders`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `ICS199Group03_dev`.`Orders` ;

CREATE TABLE IF NOT EXISTS `ICS199Group03_dev`.`Orders` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `login_id` INT NOT NULL,
  `timestamp` DATETIME NOT NULL,
  `shipping_address` VARCHAR(255) NOT NULL,
  `billing_address` VARCHAR(255) NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_Orders_Logins1_idx` (`login_id` ASC),
  CONSTRAINT `fk_Orders_Logins1`
    FOREIGN KEY (`login_id`)
    REFERENCES `ICS199Group03_dev`.`Logins` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `ICS199Group03_dev`.`OrderedProducts`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `ICS199Group03_dev`.`OrderedProducts` ;

CREATE TABLE IF NOT EXISTS `ICS199Group03_dev`.`OrderedProducts` (
  `order_id` INT NOT NULL,
  `product_id` INT NOT NULL,
  `price` DECIMAL(6,2) NOT NULL,
  `quantity` INT NOT NULL,
  PRIMARY KEY (`order_id`, `product_id`),
  INDEX `fk_OrderedProducts_Products1_idx` (`product_id` ASC),
  CONSTRAINT `fk_OrderedProducts_Orders1`
    FOREIGN KEY (`order_id`)
    REFERENCES `ICS199Group03_dev`.`Orders` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_OrderedProducts_Products1`
    FOREIGN KEY (`product_id`)
    REFERENCES `ICS199Group03_dev`.`Products` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `ICS199Group03_dev`.`ProductCategories`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `ICS199Group03_dev`.`ProductCategories` ;

CREATE TABLE IF NOT EXISTS `ICS199Group03_dev`.`ProductCategories` (
  `product_id` INT NOT NULL,
  `category_id` INT NOT NULL,
  PRIMARY KEY (`product_id`, `category_id`),
  INDEX `fk_ProductCategories_Products1_idx` (`product_id` ASC),
  CONSTRAINT `fk_ProductCategories_Categories1`
    FOREIGN KEY (`category_id`)
    REFERENCES `ICS199Group03_dev`.`Categories` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_ProductCategories_Products1`
    FOREIGN KEY (`product_id`)
    REFERENCES `ICS199Group03_dev`.`Products` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `ICS199Group03_dev`.`Types`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `ICS199Group03_dev`.`Types` ;

CREATE TABLE IF NOT EXISTS `ICS199Group03_dev`.`Types` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `type_name_UNIQUE` (`name` ASC))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `ICS199Group03_dev`.`ProductTypes`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `ICS199Group03_dev`.`ProductTypes` ;

CREATE TABLE IF NOT EXISTS `ICS199Group03_dev`.`ProductTypes` (
  `product_id` INT NOT NULL,
  `type_id` INT NOT NULL,
  PRIMARY KEY (`product_id`, `type_id`),
  INDEX `fk_ProductTypes_Products1_idx` (`product_id` ASC),
  CONSTRAINT `fk_ProductTypes_Types1`
    FOREIGN KEY (`type_id`)
    REFERENCES `ICS199Group03_dev`.`Types` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_ProductTypes_Products1`
    FOREIGN KEY (`product_id`)
    REFERENCES `ICS199Group03_dev`.`Products` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `ICS199Group03_dev`.`Cart`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `ICS199Group03_dev`.`Cart` ;

CREATE TABLE IF NOT EXISTS `ICS199Group03_dev`.`Cart` (
  `login_id` INT NOT NULL,
  `product_id` INT NOT NULL,
  `quantity` INT NOT NULL,
  PRIMARY KEY (`login_id`, `product_id`),
  INDEX `fk_Cart_Products1_idx` (`product_id` ASC),
  CONSTRAINT `fk_Cart_Logins1`
    FOREIGN KEY (`login_id`)
    REFERENCES `ICS199Group03_dev`.`Logins` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Cart_Products1`
    FOREIGN KEY (`product_id`)
    REFERENCES `ICS199Group03_dev`.`Products` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
