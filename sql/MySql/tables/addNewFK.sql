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