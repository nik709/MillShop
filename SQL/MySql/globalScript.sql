DROP TABLE IF EXISTS `millshop`.`items`;
DROP TABLE IF EXISTS `millshop`.`sizes`;
DROP TABLE IF EXISTS `millshop`.`colors`;
DROP TABLE IF EXISTS `millshop`.`subcategory`;
DROP TABLE IF EXISTS `millshop`.`globcategory`;

CREATE TABLE `millshop`.`colors` (
  `ID` INT NOT NULL ,
  `name` VARCHAR(45) NULL ,
  PRIMARY KEY (`ID`) );

CREATE  TABLE `millshop`.`sizes` (
  `ID` INT NOT NULL ,
  `name` VARCHAR(45) NULL ,
  PRIMARY KEY (`ID`) );

CREATE  TABLE `millshop`.`subcategory` (
  `id` INT NOT NULL ,
  `name` VARCHAR(45) NOT NULL ,
  PRIMARY KEY (`id`) );

CREATE  TABLE `millshop`.`globcategory` (
  `id` INT NOT NULL ,
  `name` VARCHAR(45) NOT NULL ,
  PRIMARY KEY (`id`) );

CREATE  TABLE `millshop`.`items` (
  `ID` INT NOT NULL ,
  `name` VARCHAR(45) NOT NULL ,
  `price` FLOAT NOT NULL ,
  `size` INT NOT NULL ,
  `color` INT NOT NULL ,
  `image` MEDIUMBLOB NULL ,
  `Description` VARCHAR(200) NULL ,
  PRIMARY KEY (`ID`) ,
  INDEX `ID_idx` (`color` ASC) ,
  INDEX `ID_Size_idx` (`size` ASC) ,
  CONSTRAINT `ID_Color`
    FOREIGN KEY (`color` )
    REFERENCES `millshop`.`colors` (`ID` )
    ON DELETE NO ACTION
    ON UPDATE CASCADE,
  CONSTRAINT `ID_Size`
    FOREIGN KEY (`size` )
    REFERENCES `millshop`.`sizes` (`ID` )
    ON DELETE NO ACTION
    ON UPDATE CASCADE);

ALTER TABLE `millshop`.`items` ADD COLUMN `subcategory` INT NULL  AFTER `Description` , ADD COLUMN `globcategory` INT NULL  AFTER `subcategory` , 
  ADD CONSTRAINT `ID_Subcategory`
  FOREIGN KEY (`subcategory` )
  REFERENCES `millshop`.`subcategory` (`id` )
  ON DELETE NO ACTION
  ON UPDATE CASCADE, 
  ADD CONSTRAINT `ID_Globcategory`
  FOREIGN KEY (`globcategory` )
  REFERENCES `millshop`.`globcategory` (`id` )
  ON DELETE NO ACTION
  ON UPDATE CASCADE
, ADD INDEX `ID_subcategory_idx` (`subcategory` ASC) 
, ADD INDEX `ID_Globcategory_idx` (`globcategory` ASC) ;

ALTER TABLE `millshop`.`items` ADD COLUMN `discount` FLOAT NULL DEFAULT 0.0  AFTER `globcategory` ;
