CREATE DATABASE EduWebApp;
USE EduWebApp;
SET default_storage_engine=INNODB;

/* ***** GENERAL CONTENT RELATED ***** */

CREATE TABLE `subjects` (
    `id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `name` VARCHAR(100) NOT NULL UNIQUE,
    `description` VARCHAR(4096) DEFAULT '',
    `homepageContent` TEXT
);


CREATE TABLE `topics` (
    `id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `name` VARCHAR(100) NOT NULL,
    `description` VARCHAR(4096) DEFAULT '',
    `subject_id` INT NOT NULL,
    FOREIGN KEY (`subject_id`) REFERENCES `subjects`(`id`) ON DELETE CASCADE ON UPDATE CASCADE,
    UNIQUE KEY `subject_topic` (`subject_id`, `name`)
);


CREATE TABLE `lessons` (
    `id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `name` VARCHAR (100) NOT NULL,
    `body` TEXT NOT NULL,
    `topic_id` INT NOT NULL,
    FOREIGN KEY (`topic_id`) REFERENCES `topics`(`id`) ON DELETE CASCADE ON UPDATE CASCADE,
    UNIQUE KEY `topic_lesson` (`topic_id`, `name`)
);


CREATE TABLE `tests` (
    `id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `name` VARCHAR(100) NOT NULL,
    `description` VARCHAR(4096),
    `topic_id` INT NOT NULL,
    FOREIGN KEY (`topic_id`) REFERENCES `topics`(`id`) ON DELETE CASCADE ON UPDATE CASCADE,
    UNIQUE KEY `topic_test` (`topic_id`, `name`)
);


CREATE TABLE `testQuestions` (
    `id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `question` VARCHAR(255) NOT NULL,
    `answer` VARCHAR(255) NOT NULL,
    `imageUrl` VARCHAR(255) DEFAULT '',
    `test_id` INT NOT NULL,
    FOREIGN KEY (`test_id`) REFERENCES `tests`(`id`) ON DELETE CASCADE ON UPDATE CASCADE,
    UNIQUE KEY `testQuestion_test` (`test_id`, `question`)
);
/* END OF GENERAL CONTENT RELATED */



/* ***** USER ACCOUNT RELATED ***** */
-- User privilegeLevels table.
-- Defines level of privileges that user has in the system. Also includes 'banned' as a 'privilege level'.
-- Contains (22/12/2018): normal, admin, banned.
CREATE TABLE `privilegeLevels` (
    `id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `level` VARCHAR(30) NOT NULL UNIQUE
);


-- Social media providers table.
-- Used for linking a users social media account id to their internal user account.
-- Contains (22/12/2018): Google, Facebook, LinkedIn.
CREATE TABLE `socialMediaProviders` (
    `id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `name` VARCHAR(30) NOT NULL UNIQUE
);

-- Users table.
-- Contains id, their (non-unique) display name, socialMediaID, reference to socialMediaProvider, reference to privilegeLevel.
-- A user CANNOT have the same socialMediaID for the same socialMediaProvider. - id 'aaa', provider 'google' for 2 records.
-- A user CAN have the same socialMediaID for different socialMediaProviders. - id 'aaa', provider 'google' - id 'aaa', provider 'facebook'.
CREATE TABLE `users` (
    `id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `displayName` VARCHAR(30) NOT NULL DEFAULT 'unnamed user',
    `socialMediaID` VARCHAR(255) NOT NULL,
    `socialMediaProvider_id` INT NOT NULL,
    `privilegeLevel_id` INT NOT NULL,
    FOREIGN KEY (`socialMediaProvider_id`) REFERENCES `socialMediaProviders`(`id`) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (`privilegeLevel_id`) REFERENCES `privilegeLevels`(`id`) ON DELETE CASCADE ON UPDATE CASCADE,
    UNIQUE KEY `socialMediaID_socialMediaProvider` (`socialMediaID`, `socialMediaProvider_id`)
);
/* END OF USER ACCOUNTS RELATED */



/* ***** OTHER ***** */
CREATE TABLE `posts` (
    `id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `title` VARCHAR(1000) NOT NULL,
    `body` TEXT,
    `creationDate` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `modificationDate` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    `subject_id` INT NOT NULL,
    `user_id` INT NOT NULL,
    FOREIGN KEY (`subject_id`) REFERENCES `subjects`(`id`) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (`user_id`) REFERENCES `users`(`id`) ON DELETE CASCADE ON UPDATE CASCADE
);
