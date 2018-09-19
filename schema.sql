CREATE DATABASE math_edu_app;
USE math_edu_app;

CREATE TABLE `users` (
    `id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `googleId` VARCHAR(255) NOT NULL UNIQUE,
    `forename` VARCHAR(100) NOT NULL,
    `surname` VARCHAR(100) NOT NULL,
    `email` VARCHAR(255) NOT NULL,
    `admin` BOOLEAN DEFAULT false,
    `banned` BOOLEAN DEFAULT false
);

CREATE TABLE `posts` (
    `id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `title` VARCHAR(1000) NOT NULL,
    `body` VARCHAR(10000),
    `date` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    `user_id` INT NOT NULL,
    FOREIGN KEY (`user_id`) REFERENCES `users`(`id`)
);

CREATE TABLE `topics` (
    `id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `name` VARCHAR(100) NOT NULL UNIQUE
);

CREATE TABLE `tests` (
    `id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `title` VARCHAR(100) NOT NULL,
    `topic_id` INT NOT NULL,
    `date` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `user_id` INT NOT NULL,
    FOREIGN KEY (`topic_id`) REFERENCES `topic`(`id`),
    FOREIGN KEY (`user_id`) REFERENCES `users`(`id`)
);

CREATE TABLE `questions` (
    `id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `content` VARCHAR(100) NOT NULL,
    `answer` VARCHAR(100) NOT NULL,
    `userAnswer` VARCHAR(100) NOT NULL,
    `test_id` INT NOT NULL,
    FOREIGN KEY (`test_id`) REFERENCES `tests`(`id`)
);



-- Dummy data for testing...
INSERT INTO `users` (`googleId`, `forename`, `surname`, `email`) VALUES
    ('gid01', 'Bob' ,'Jimmies' ,'bobjimmies@googlemail.com'),
    ('gid02', 'Brick' ,'Tardmaster' ,'bricktardmaster@googlemail.com'),
    ('gid03', 'Ronald' ,'Reagan' ,'economicsgenius82@googlemail.com'),
    ('gid04', 'Racketman' ,'Badmintonton' ,'badracketlennyface@googlemail.com'),
    ('gid05', 'Biggus' ,'Dickus' ,'oldbutgold@googlemail.com'
);

INSERT INTO `posts` (`title`, `user_id`) VALUES
    ('mysqli_real_escape_string() still isn''t dead.', 1),
    ('abcdefghijklmnop', 2),
    ('!!drawkcab si egassem', 4),
    ('10111011 00001011 10001011 10001000 10111111 11111000.', 2),
    ('I couldn''t think up another title.', 5
);

INSERT INTO `tests` (`title`, `user_id`) VALUES
    ('Test 01', 1),
    ('Test 02', 2),
    ('Test 03', 2),
    ('Test 04', 4),
    ('Test 05', 5
);

INSERT INTO `questions` (`content`, `answer`, `userAnswer`, `test_id`) VALUES
    ('2 + 2', '4', 'potatoes', 1),
    ('7 + 2', '9', '9', 1),
    ('5²', '25', '2147m', 1),
    ('17 - 5', '12', 'uhh dunno', 1),
    ('2 + 0', '2', '2', 1),

    ('33 + 6', '39', '39', 2),
    ('7 + 8', '15', '15', 2),
    ('8 + 4', '12', '12', 2),
    ('17 - 5', '12', '11', 2),
    ('11 * 2', '22', '23', 2),

    ('4²', '16', '16', 3),
    ('3²', '9', '9', 3),
    ('5 - 2', '3', '3', 3),
    ('12 - 8', '4', '4', 3),
    ('3 - 0', '3', '3', 3),

    ('2 + 2', '4', 'NaN', 4),
    ('12²', '144', '144', 4),
    ('11 + 14', '25', '???', 4),
    ('11 - 1', '10', '10', 4),
    ('4 * 11', '44', '44', 4),

    ('2 + 1', '3', 'cabbages', 5),
    ('9 - 9', '0', '0', 5),
    ('10²', '100', '100', 5),
    ('11 + 1', '12', 'hmmmmm', 5),
    ('3 + 9', '12', '12', 5
);


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

*/Test 02