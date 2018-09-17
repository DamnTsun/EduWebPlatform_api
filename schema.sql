CREATE DATABASE math_edu_app;
USE math_edu_app;

CREATE TABLE `posts` (
    `id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `title` VARCHAR(1000) NOT NULL,
    `body` VARCHAR(10000),
    `date` DATETIME NOT NULL
);