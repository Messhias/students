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
    `email` VARCHAR(80) NOT NULL UNIQUE ,
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


-- creating the procedures / functions to seed the data.
DELIMITER $$
CREATE PROCEDURE insert_random_students()

BEGIN
    DECLARE a INT Default 0 ;
    DECLARE name varchar(255);
    DECLARE email varchar(80);
    simple_loop: LOOP
        -- variable for name, surname, middle name, you can change the value of the rand to generate
        -- how many string you want to
        SET name = genstring(20);
        set email = (SELECT CONCAT(genstring(10), '@', genstring(10), '.',  genstring(10)));


        insert into students(first_name, last_name, middle_name, email, class, guardian_name, phone_number, date_added, date_updated, year_joined)
        values(name, name, name, email, "test", name, rand(), current_timestamp, null, current_timestamp);
        SET a=a+1;
        IF a=5 THEN
            LEAVE simple_loop;
        END IF;
    END LOOP simple_loop;
END $$

DROP function if exists genstring;
delimiter $$
CREATE FUNCTION genstring(in_strlen int) RETURNS VARCHAR(500) DETERMINISTIC
BEGIN
    set @var:='';
    while(in_strlen>0) do
    set @var:=concat(@var,ELT(1+FLOOR(RAND() * 26), 'a','b','c','d','e','f','g','h','i','j','k','l','m','n','o','p','q','r','s','t','u','v','w','x','y','z'));
    set in_strlen:=in_strlen-1;
    end while;
    RETURN @var;
END $$

