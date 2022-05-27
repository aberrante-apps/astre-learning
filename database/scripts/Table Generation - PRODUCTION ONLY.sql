-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema ICS199Group03_prod
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema ICS199Group03_prod
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `ICS199Group03_prod` DEFAULT CHARACTER SET utf8 ;
USE `ICS199Group03_prod` ;

-- -----------------------------------------------------
-- Table `ICS199Group03_prod`.`Products`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `ICS199Group03_prod`.`Products` ;

CREATE TABLE IF NOT EXISTS `ICS199Group03_prod`.`Products` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(255) NOT NULL,
  `description` MEDIUMTEXT NOT NULL,
  `picture` VARCHAR(255) NOT NULL,
  `price` DECIMAL(6,2) NOT NULL,
  `stock` INT NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `prod_name_UNIQUE` (`name` ASC) ,
  UNIQUE INDEX `prod_picture_UNIQUE` (`picture` ASC) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `ICS199Group03_prod`.`Categories`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `ICS199Group03_prod`.`Categories` ;

CREATE TABLE IF NOT EXISTS `ICS199Group03_prod`.`Categories` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `cat_name_UNIQUE` (`name` ASC) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `ICS199Group03_prod`.`Logins`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `ICS199Group03_prod`.`Logins` ;

CREATE TABLE IF NOT EXISTS `ICS199Group03_prod`.`Logins` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `first_name` VARCHAR(45) NOT NULL,
  `last_name` VARCHAR(45) NOT NULL,
  `email_address` VARCHAR(45) NOT NULL,
  `phone_number` VARCHAR(45) NOT NULL,
  `password` VARCHAR(45) NOT NULL,
  `shipping_address` VARCHAR(255) NOT NULL,
  `admin` TINYINT NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `email_address_UNIQUE` (`email_address` ASC) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `ICS199Group03_prod`.`Orders`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `ICS199Group03_prod`.`Orders` ;

CREATE TABLE IF NOT EXISTS `ICS199Group03_prod`.`Orders` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `login_id` INT NOT NULL,
  `timestamp` DATETIME NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_Orders_Logins1_idx` (`login_id` ASC) ,
  CONSTRAINT `fk_Orders_Logins1`
    FOREIGN KEY (`login_id`)
    REFERENCES `ICS199Group03_prod`.`Logins` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `ICS199Group03_prod`.`OrderedProducts`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `ICS199Group03_prod`.`OrderedProducts` ;

CREATE TABLE IF NOT EXISTS `ICS199Group03_prod`.`OrderedProducts` (
  `order_id` INT NOT NULL,
  `product_id` INT NOT NULL,
  `price` DECIMAL(6,2) NOT NULL,
  `quantity` INT NOT NULL,
  PRIMARY KEY (`order_id`, `product_id`),
  INDEX `fk_OrderedProducts_Products1_idx` (`product_id` ASC) ,
  CONSTRAINT `fk_OrderedProducts_Orders1`
    FOREIGN KEY (`order_id`)
    REFERENCES `ICS199Group03_prod`.`Orders` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_OrderedProducts_Products1`
    FOREIGN KEY (`product_id`)
    REFERENCES `ICS199Group03_prod`.`Products` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `ICS199Group03_prod`.`ProductCategories`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `ICS199Group03_prod`.`ProductCategories` ;

CREATE TABLE IF NOT EXISTS `ICS199Group03_prod`.`ProductCategories` (
  `product_id` INT NOT NULL,
  `category_id` INT NOT NULL,
  PRIMARY KEY (`product_id`, `category_id`),
  INDEX `fk_ProductCategories_Products1_idx` (`product_id` ASC) ,
  CONSTRAINT `fk_ProductCategories_Categories1`
    FOREIGN KEY (`category_id`)
    REFERENCES `ICS199Group03_prod`.`Categories` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_ProductCategories_Products1`
    FOREIGN KEY (`product_id`)
    REFERENCES `ICS199Group03_prod`.`Products` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `ICS199Group03_prod`.`Types`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `ICS199Group03_prod`.`Types` ;

CREATE TABLE IF NOT EXISTS `ICS199Group03_prod`.`Types` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `type_name_UNIQUE` (`name` ASC) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `ICS199Group03_prod`.`ProductTypes`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `ICS199Group03_prod`.`ProductTypes` ;

CREATE TABLE IF NOT EXISTS `ICS199Group03_prod`.`ProductTypes` (
  `product_id` INT NOT NULL,
  `type_id` INT NOT NULL,
  PRIMARY KEY (`product_id`, `type_id`),
  INDEX `fk_ProductTypes_Products1_idx` (`product_id` ASC) ,
  CONSTRAINT `fk_ProductTypes_Types1`
    FOREIGN KEY (`type_id`)
    REFERENCES `ICS199Group03_prod`.`Types` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_ProductTypes_Products1`
    FOREIGN KEY (`product_id`)
    REFERENCES `ICS199Group03_prod`.`Products` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `ICS199Group03_prod`.`Cart`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `ICS199Group03_prod`.`Cart` ;

CREATE TABLE IF NOT EXISTS `ICS199Group03_prod`.`Cart` (
  `login_id` INT NOT NULL,
  `product_id` INT NOT NULL,
  `quantity` INT NOT NULL,
  PRIMARY KEY (`login_id`, `product_id`),
  INDEX `fk_Cart_Products1_idx` (`product_id` ASC) ,
  CONSTRAINT `fk_Cart_Logins1`
    FOREIGN KEY (`login_id`)
    REFERENCES `ICS199Group03_prod`.`Logins` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Cart_Products1`
    FOREIGN KEY (`product_id`)
    REFERENCES `ICS199Group03_prod`.`Products` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
