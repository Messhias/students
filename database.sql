-- Fabio William Conceiçãp
-- Mon Jun 17 19:24:20 2019
-- Model: New database

-- setting the mysql checks to avoid keys complexions with another databases
-- setting also the new full groups and sql modes for table creation without database
-- configurations issues.
SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema students_docker
--
-- if necessary change 'students_docker' to your database name
--
-- -----------------------------------------------------
-- -----------------------------------------------------
-- Schema students_docker
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `students_docker` DEFAULT CHARACTER SET utf8 ;
USE `students_docker`;

-- -----------------------------------------------------
-- Table `students_docker`.`students`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `students_docker`.`students` (
  `id` INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
  `first_name` VARCHAR(255) NOT NULL,
  `last_name` VARCHAR(255) NULL,
  `middle_name` VARCHAR(255) NOT NULL,
  `email` VARCHAR(80) NOT NULL,
  `class` VARCHAR(120) NOT NULL,
  `guardian_name` VARCHAR(255) NOT NULL,
  `phone_number` VARCHAR(20) NOT NULL,
  `date_added` TIMESTAMP NOT NULL DEFAULT current_timestamp,
  `date_updated` TIMESTAMP NULL,
  `year_joined` TIMESTAMP NOT NULL DEFAULT current_timestamp)
ENGINE = InnoDB;

-- returning the sql to previously state.
SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
