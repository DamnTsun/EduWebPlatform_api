CREATE DATABASE EduWebApp;
USE EduWebApp;
SET default_storage_engine=INNODB;
SET GLOBAL event_scheduler = ON;

/* ***** GENERAL CONTENT RELATED ***** */

CREATE TABLE `subjects` (
    `id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `name` VARCHAR(100) NOT NULL UNIQUE,
    `description` VARCHAR(4096) DEFAULT '',
    `hidden` BOOLEAN DEFAULT FALSE
);


CREATE TABLE `topics` (
    `id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `name` VARCHAR(100) NOT NULL,
    `description` VARCHAR(4096) DEFAULT '',
    `hidden` BOOLEAN DEFAULT FALSE,
    `subject_id` INT NOT NULL,
    FOREIGN KEY (`subject_id`) REFERENCES `subjects`(`id`) ON DELETE CASCADE ON UPDATE CASCADE,
    UNIQUE KEY `subject_topic` (`subject_id`, `name`)
);


CREATE TABLE `lessons` (
    `id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `name` VARCHAR (100) NOT NULL,
    `body` TEXT NOT NULL,
    `hidden` BOOLEAN DEFAULT FALSE,
    `topic_id` INT NOT NULL,
    FOREIGN KEY (`topic_id`) REFERENCES `topics`(`id`) ON DELETE CASCADE ON UPDATE CASCADE,
    UNIQUE KEY `topic_lesson` (`topic_id`, `name`)
);


CREATE TABLE `tests` (
    `id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `name` VARCHAR(100) NOT NULL,
    `description` VARCHAR(4096),
    `hidden` BOOLEAN DEFAULT FALSE,
    `topic_id` INT NOT NULL,
    FOREIGN KEY (`topic_id`) REFERENCES `topics`(`id`) ON DELETE CASCADE ON UPDATE CASCADE,
    UNIQUE KEY `topic_test` (`topic_id`, `name`)
);

-- Test questions table.
-- Contains the question, answer, optional url of image, the associated test, the associated test question type.
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
CREATE TABLE users (
    `id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `displayName` VARCHAR(30) NOT NULL DEFAULT 'unnamed user',
    `lastSignInDate` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `socialMediaID` VARCHAR(255) NOT NULL,
    `socialMediaProvider_id` INT NOT NULL,
    `privilegeLevel_id` INT NOT NULL,
    FOREIGN KEY (`socialMediaProvider_id`) REFERENCES `socialMediaProviders`(`id`) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (`privilegeLevel_id`) REFERENCES `privilegeLevels`(`id`) ON DELETE CASCADE ON UPDATE CASCADE,
    UNIQUE KEY `socialMediaID_socialMediaProvider` (`socialMediaID`, `socialMediaProvider_id`)
);

-- Intermediary table for users - subject many-to-many relationship.
-- Defines which admin users are specialised in a specific subject.
CREATE TABLE subject_admins (
    `user_id` INT NOT NULL,
    `subject_id` INT NOT NULL,
    FOREIGN KEY (`user_id`) REFERENCES `users`(`id`) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (`subject_id`) REFERENCES `subjects`(`id`) ON DELETE CASCADE ON UPDATE CASCADE,
    PRIMARY KEY (`user_id`, `subject_id`)
);
/* END OF USER ACCOUNTS RELATED */



-- Posts table.
-- Contains title, optional body, creationDate (auto set), modificationDate (auto set and updated)
-- ID of subject post is for, ID of user who created / last modified the post.
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


/* ***** USER TEST RESULTS TRACKING RELATED ***** */
-- User tests table.
-- Contains title to differentiate individual user tests. Date of completion.
-- ID of user who completed test. ID of test that the user test is based on.
-- Is used to linked multiple userTestQuestions into a group.
CREATE TABLE `user_tests` (
    `id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `title` VARCHAR(30) NOT NULL DEFAULT 'untitled test',
    `date` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `test_id` INT NOT NULL,
    `user_id` INT NOT NULL,
    FOREIGN KEY (`test_id`) REFERENCES `tests`(`id`) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (`user_id`) REFERENCES `users`(`id`) ON DELETE CASCADE ON UPDATE CASCADE
);


-- User test questions table.
-- Contains user's answer of question.
-- ID of question being answered. ID of user who attempted the question.
-- Multiple are linked together by a userTests record.
CREATE TABLE `user_TestQuestions` (
    `id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `userAnswer` VARCHAR(255) NOT NULL,
    `testQuestion_id` INT NOT NULL,
    `user_Test_id` INT NOT NULL,
    FOREIGN KEY (`testQuestion_id`) REFERENCES `testQuestions`(`id`) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (`user_test_id`) REFERENCES `user_tests`(`id`) ON DELETE CASCADE ON UPDATE CASCADE
);
/* END OF USER TEST RESULTS TRACKING RELATED */





/* ***** USER GROUPS RELATED ***** */
-- User groups table.
-- Contains group name, group description, url of image for group.
CREATE TABLE `groups` (
    `id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `name` VARCHAR(100) NOT NULL DEFAULT 'unnamed group',
    `description` VARCHAR(4096),
    `imageUrl` VARCHAR(255) DEFAULT ''
);

-- User group members table.
-- Intermediary table for users - groups many-to-many relationship.
CREATE TABLE `user_groups` (
    `user_id` INT NOT NULL,
    `group_id` INT NOT NULL,
    FOREIGN KEY (`user_id`) REFERENCES `users`(`id`) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (`group_id`) REFERENCES `groups`(`id`) ON DELETE CASCADE ON UPDATE CASCADE,
    PRIMARY KEY (`user_id`, `group_id`)
);

/* END OF USER GROUPS RELATED */





/* ***** MESSAGING SYSTEM RELATED ***** */
-- Messages table.
-- Contains a message a user has sent
CREATE TABLE `messages` (
    `id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `message` VARCHAR(1024) NOT NULL,
    `date` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `sender_id` INT NOT NULL,
    FOREIGN KEY (`sender_id`) REFERENCES `users`(`id`) ON DELETE CASCADE ON UPDATE CASCADE
);


-- user_message table.
-- Intermediary table for users - messages many-to-many relationship
CREATE TABLE `user_messages` (
    `user_id` INT NOT NULL,
    `message_id` INT NOT NULL,
    FOREIGN KEY (`user_id`) REFERENCES `users`(`id`) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (`message_id`) REFERENCES `messages`(`id`) ON DELETE CASCADE ON UPDATE CASCADE,
    PRIMARY KEY (`user_id`, `message_id`)
);

-- group_message table.
-- Intermediary table for groups - messages many-to-many relationship.
CREATE TABLE `group_messages` (
    `group_id` INT NOT NULL,
    `message_id` INT NOT NULL,
    FOREIGN KEY (`group_id`) REFERENCES `groups`(`id`) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (`message_id`) REFERENCES `messages`(`id`) ON DELETE CASCADE ON UPDATE CASCADE,
    PRIMARY KEY (`group_id`, `message_id`)
);
/* END OF MESSAGING SYSTEM RELATED */



-- Privilege levels
INSERT INTO privilegeLevels (level) VALUES ('Normal');
INSERT INTO privilegeLevels (level) VALUES ('Admin');
INSERT INTO privilegeLevels (level) VALUES ('Banned');

-- Social Media Providers
INSERT INTO socialMediaProviders (name) VALUES ('Google');
INSERT INTO socialMediaProviders (name) VALUES ('Facebook');






/* DATABASE EVENTS */
/**
 * *** GDPR RELATED ***
 * Delete messages that are 7 days or older.
 * Runs once per day at 00:00:00.
 */
CREATE EVENT `delete_old_messages`
    ON SCHEDULE
        EVERY 1 DAY                             -- Every day.
        STARTS '2019-01-01 00:00:00'            -- At 00:00:00.
    ON COMPLETION PRESERVE ENABLE               -- Repeat.
    DO
        DELETE FROM
            `messages`
        WHERE
            `messages`.`date` < CURRENT_TIMESTAMP - INTERVAL 1 WEEK
;


/**
 * *** GDPR RELATED ***
 * Deletes users who have not signed in for 180 days or longer.
 * Runs once per day at 00:00:00.
 */
CREATE EVENT `delete_old_users`
    ON SCHEDULE
        EVERY 1 DAY                             -- Every day.
        STARTS '2019-01-01 00:00:00'            -- At 00:00:00.
    ON COMPLETION PRESERVE ENABLE               -- Repeat.
    DO
        DELETE FROM
            `users`
        WHERE
            `users`.`lastSignInDate` < CURRENT_TIMESTAMP - INTERVAL 180 DAY
;


/**
 * *** Sorta GDPR RELATED ***
 * Deletes users from subject_admin table who are not admins.
 * Subject_admins are not automatically removed from the table when demoted. This way partly in case admin is accidently demoted.
 * Automatically deleting immediately would result in them having to re-assocated with each subject.
 * Runs once per day at 00:00:00.
 */
CREATE EVENT `delete_non-admin_subject_admins`
    ON SCHEDULE
        EVERY 1 DAY
        STARTS '2019-01-01 00:00:00'
    ON COMPLETION PRESERVE ENABLE
    DO
        DELETE FROM
            subject_admins
        WHERE
            -- Where the associated user is not an admin.
            (
                SELECT
                    users.id
                FROM
                    users
                WHERE
                    users.id = subject_admins.user_id
            ) != 2
;