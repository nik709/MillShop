CREATE  TABLE `millshop`.`items` (
  `ID` INT NOT NULL ,
  `name` VARCHAR(45) NOT NULL ,
  `price` VARCHAR(45) NOT NULL ,
  `size` INT NOT NULL ,
  `color` INT NOT NULL ,
  `image` BLOB NULL ,
  `Description` VARCHAR(45) NULL ,
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