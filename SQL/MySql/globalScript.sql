DROP TABLE IF EXISTS `millshop`.`items_sizes`;
DROP TABLE IF EXISTS `millshop`.`items`;
DROP TABLE IF EXISTS `millshop`.`sizes`;
DROP TABLE IF EXISTS `millshop`.`colors`;
DROP TABLE IF EXISTS `millshop`.`subcategory`;
DROP TABLE IF EXISTS `millshop`.`globcategory`;
DROP TABLE IF EXISTS `millshop`.`users`;

CREATE TABLE `millshop`.`users`(
	`LOGIN` VARCHAR(45) NOT NULL,
	`PASSWORD` VARCHAR(200) NOT NULL,
	`FIRSTNAME` VARCHAR(20) NOT NULL,
	`LASTNAME` VARCHAR(20) NOT NULL,
	PRIMARY KEY (`LOGIN`) 
);

ALTER TABLE millshop.users 
    ADD EMAIL VARCHAR(30) NULL;

CREATE TABLE `millshop`.`colors` (
  `ID` INT NOT NULL ,
  `name` VARCHAR(45) NULL ,
  PRIMARY KEY (`ID`) );

INSERT INTO millshop.colors (ID, name) VALUES (201, 'Black');
INSERT INTO millshop.colors (ID, name) VALUES (202, 'White');
INSERT INTO millshop.colors (ID, name) VALUES (203, 'Gray');
INSERT INTO millshop.colors (ID, name) VALUES (204, 'Brown');
INSERT INTO millshop.colors (ID, name) VALUES (205, 'Green');
INSERT INTO millshop.colors (ID, name) VALUES (206, 'Navy');
INSERT INTO millshop.colors (ID, name) VALUES (207, 'Blue');
INSERT INTO millshop.colors (ID, name) VALUES (208, 'Red');
INSERT INTO millshop.colors (ID, name) VALUES (209, 'Dark Gray');
INSERT INTO millshop.colors (ID, name) VALUES (210, 'Beige');
INSERT INTO millshop.colors (ID, name) VALUES (211, 'Yellow');

CREATE  TABLE `millshop`.`sizes` (
  `ID` INT NOT NULL ,
  `name` VARCHAR(45) NULL ,
  PRIMARY KEY (`ID`) );

INSERT INTO SIZES (ID, NAME) VALUES (101, 'XXS');
INSERT INTO SIZES (ID, NAME) VALUES (102, 'XS');
INSERT INTO SIZES (ID, NAME) VALUES (103, 'S');
INSERT INTO SIZES (ID, NAME) VALUES (104, 'M');
INSERT INTO SIZES (ID, NAME) VALUES (105, 'L');
INSERT INTO SIZES (ID, NAME) VALUES (106, 'XL');
INSERT INTO SIZES (ID, NAME) VALUES (107, 'XXL');

CREATE  TABLE `millshop`.`subcategory` (
  `id` INT NOT NULL ,
  `name` VARCHAR(45) NOT NULL ,
  PRIMARY KEY (`id`) );

INSERT INTO millshop.subcategory (id, name) VALUES (401, 'Shirts');
INSERT INTO millshop.subcategory (id, name) VALUES (402, 'Tees & Polos');
INSERT INTO millshop.subcategory (id, name) VALUES (403, 'Sweaters');
INSERT INTO millshop.subcategory (id, name) VALUES (404, 'Hoodies & Sweatshirts');
INSERT INTO millshop.subcategory (id, name) VALUES (405, 'Pants');
INSERT INTO millshop.subcategory (id, name) VALUES (406, 'Jeans');
INSERT INTO millshop.subcategory (id, name) VALUES (407, 'Shorts');
INSERT INTO millshop.subcategory (id, name) VALUES (408, 'Jackets & Outwear');
INSERT INTO millshop.subcategory (id, name) VALUES (409, 'Accessories');
INSERT INTO millshop.subcategory (id, name) VALUES (410, 'Dress');
INSERT INTO millshop.subcategory (id, name) VALUES (411, 'Skirt');
INSERT INTO millshop.subcategory (id, name) VALUES (412, 'Swimsuit');

CREATE  TABLE `millshop`.`globcategory` (
  `id` INT NOT NULL ,
  `name` VARCHAR(45) NOT NULL ,
  PRIMARY KEY (`id`) );

INSERT INTO millshop.globcategory (id, name) VALUES (301, 'Men');
INSERT INTO millshop.globcategory (id, name) VALUES (302, 'Women');
INSERT INTO millshop.globcategory (id, name) VALUES (303, 'Kids');

CREATE  TABLE `millshop`.`items` (
  `ID` INT NOT NULL ,
  `name` VARCHAR(45) NOT NULL ,
  `price` FLOAT NOT NULL ,
  `size` INT NOT NULL ,
  `color` INT NOT NULL ,
  `image` MEDIUMBLOB NULL ,
  `Description` VARCHAR(900) NULL ,
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

CREATE  TABLE `millshop`.`items_sizes` (
  `item_id` INT NULL ,
  `size_id` INT NULL );

ALTER TABLE `millshop`.`items` DROP FOREIGN KEY `ID_Size` ;

ALTER TABLE `millshop`.`items_sizes` 
  ADD CONSTRAINT `items_FK`
  FOREIGN KEY (`item_id` )
  REFERENCES `millshop`.`items` (`ID` )
  ON DELETE NO ACTION
  ON UPDATE CASCADE, 
  ADD CONSTRAINT `sizes_FK`
  FOREIGN KEY (`size_id` )
  REFERENCES `millshop`.`sizes` (`ID` )
  ON DELETE NO ACTION
  ON UPDATE CASCADE
, ADD INDEX `items_FK_idx` (`item_id` ASC) 
, ADD INDEX `sizes_FK_idx` (`size_id` ASC) ;

ALTER TABLE `millshop`.`items` DROP COLUMN `size` 
, DROP INDEX `ID_Size_idx` ;
