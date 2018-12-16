CREATE DATABASE EduWebApp;
USE EduWebApp;


/*
 * General content related tables.
 */
CREATE TABLE `subjects` (
    `id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `name` VARCHAR(100) NOT NULL UNIQUE,
    `description` VARCHAR(4096) DEFAULT '',
    `homepageContent` TEXT
);


CREATE TABLE `topics` (
    `id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `name` VARCHAR(100) NOT NULL UNIQUE,
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
    `content` VARCHAR(255) NOT NULL,
    `answer` VARCHAR(255) NOT NULL,
    `imageUrl` VARCHAR(255) DEFAULT '',
    `test_id` INT NOT NULL,
    FOREIGN KEY (`test_id`) REFERENCES `tests`(`id`) ON DELETE CASCADE ON UPDATE CASCADE
);



/*
 * Users records section.
 * `users` is the base users table. This holds the internal user records.
 * other users tables, such as `users_google` handle social media logins.
 *   - contains user_id. Links to an internal user record.
 *   - contains <x>_id. Is the id of the social media account, such as a Google account.
 *   - user_id and <x>_id form a composite primary key.
 * the intention is that this design will be expandable, making adding support for new social media account types easy.
 */
-- Base users table.
CREATE TABLE `users` (
    `id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `displayName` VARCHAR(30) NOT NULL DEFAULT 'unnamed user',
    `admin` BOOLEAN DEFAULT false,
    `banned` BOOLEAN DEFAULT false
);

-- Google accounts
CREATE TABLE `users_google` (
    `user_id` INT NOT NULL UNIQUE,
    `google_id` INT NOT NULL UNIQUE,
    PRIMARY KEY (`user_id`, `google_id`),
    FOREIGN KEY (`user_id`) REFERENCES `users`(`id`) ON DELETE CASCADE ON UPDATE CASCADE
);



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

-- not in use
/*
CREATE TABLE `users` (
    `id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `googleId` VARCHAR(255) NOT NULL UNIQUE,
    `forename` VARCHAR(100) NOT NULL,
    `surname` VARCHAR(100) NOT NULL,
    `email` VARCHAR(255) NOT NULL,
    `admin` BOOLEAN DEFAULT false,
    `banned` BOOLEAN DEFAULT false
);
*/







-- Early tests. Don't delete yet... Maybe later...
-- SELECT STATEMENTS
/* Get posts with author (users.forename + ' ' + users.surname). Ordered by date, newest to oldest.

SELECT
    posts.title,
    posts.body,
    posts.date,
    CONCAT (users.forename, ' ', users.surname) AS 'author'
FROM
    posts,
    users
WHERE
    posts.user_id = users.id
ORDER BY
    posts.date DESC;
*/


/* Get tests by a specified user, include how many questions were on test and how many questions were answered correctly.

SELECT
    tests.title,
    (SELECT COUNT(questions.id) FROM questions WHERE questions.test_id = tests.id) AS 'Questions',
    (SELECT COUNT(questions.id) FROM questions WHERE questions.test_id = tests.id AND questions.answer = questions.userAnswer) AS 'Score',
    tests.date
FROM
    tests
WHERE
    tests.user_id = 2
ORDER BY
    tests.date DESC;
*/

/* Gets all questions on all tests a specific user has completed ordered by id.

SELECT
	tests.title AS 'Test',
	content AS 'Question',
    userAnswer AS 'Your Answer',
    answer AS 'Correct Answer'
FROM
	questions, tests
WHERE
	test_id = tests.id AND tests.user_id = 1
ORDER BY
	questions.id ASC;

-- Same as above but only returns questions for a specific tests.id value.

SELECT
	tests.title AS 'Test',
	content AS 'Question',
    userAnswer AS 'Your Answer',
    answer AS 'Correct Answer',
    IF (userAnswer = answer, 'Yes', 'No') AS 'Correct?'
FROM
	questions, tests
WHERE
	test_id = tests.id AND tests.user_id = 2 AND tests.id = 2
ORDER BY
	questions.id ASC;

*/