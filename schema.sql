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
    `name` VARCHAR(100) NOT NULL UNIQUE,
    `imageUrl` VARCHAR(100) DEFAULT ''
);

CREATE TABLE `lessons` (
    `id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `title` VARCHAR (1000) NOT NULL,
    `body` VARCHAR (10000) NOT NULL,
    `topic_id` INT NOT NULL,
    FOREIGN KEY (`topic_id`) REFERENCES `topics`(`id`)
);

CREATE TABLE `tests` (
    `id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `title` VARCHAR(100) NOT NULL,
    `date` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `topic_id` INT NOT NULL,
    `user_id` INT NOT NULL,
    FOREIGN KEY (`topic_id`) REFERENCES `topics`(`id`),
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

INSERT INTO `topics` (`name`, `imageUrl`) VALUES
    ('Addition', 'public/image/test.png'),
    ('Subtraction', 'public/image/test.png'),
    ('Multiplication', 'public/image/test.png'),
    ('Division', 'public/image/test.png'),
    ('Fractions', 'https://via.placeholder.com/64x64'
);

INSERT INTO `tests` (`title`, `user_id`, `topic_id`) VALUES
    ('Addition 01', 1, 1),
    ('Addition 02', 2, 1),
    ('Subtraction 01', 2, 2),
    ('Multiplication 01', 4, 3),
    ('Division 01', 5, 4
);

INSERT INTO `questions` (`content`, `answer`, `userAnswer`, `test_id`) VALUES
    ('2 + 2', '4', '4', 1),
    ('7 + 2', '9', '8', 1),
    ('5 + 2', '10', '7', 1),
    ('17 + 5', '22', '22', 1),
    ('2 + 0', '2', '2', 1),

    ('33 + 6', '39', '39', 2),
    ('7 + 8', '15', '15', 2),
    ('8 + 4', '12', '12', 2),
    ('17 + 5', '22', '22', 2),
    ('11 + 2', '13', '11', 2),

    ('4 - 1', '3', '3', 3),
    ('3 - 5', '-2', '0', 3),
    ('5 - 2', '3', '3', 3),
    ('12 - 8', '4', '4', 3),
    ('3 - 0', '3', '3', 3),

    ('2 * 2', '4', '5', 4),
    ('12 * 2', '24', '24', 4),
    ('11 * 4', '44', '44', 4),
    ('11 * 2', '22', '22', 4),
    ('4 * 7', '28', '28', 4),

    ('2 / 1', '2', '2', 5),
    ('9 / 9', '1', '1', 5),
    ('10 / 2', '5', '5', 5),
    ('15 / 3', '5', '5', 5),
    ('2 / 2', '1', '1', 5
);

INSERT INTO `lessons` (`title`, `body`, `topic_id`) VALUES
    ('Addition', '"<p>blah</p><p>&nbsp;</p><p>blahhbhbhhg</p><p>rggwr</p><p><strong>wrgwrgwgwrgwg</strong> rgwgr rwg</p>"', 1),
    ('Addition 2.0 Electric Boogaloo', '"<p>blah</p><p>&nbsp;</p><p>blahhbhbhhg</p><p>rggwr</p><p><strong>wrgwrgwgwrgwg</strong> rgwgr rwg</p>"', 1),
    ('Subtraction', '"<p>blah</p><p>&nbsp;</p><p>blahhbhbhhg</p><p>rggwr</p><p><strong>wrgwrgwgwrgwg</strong> rgwgr rwg</p>"', 2),
    ('Multiplication', '"<p>blah</p><p>&nbsp;</p><p>blahhbhbhhg</p><p>rggwr</p><p><strong>wrgwrgwgwrgwg</strong> rgwgr rwg</p>"', 3),
    ('Division', '"<p>blah</p><p>&nbsp;</p><p>blahhbhbhhg</p><p>rggwr</p><p><strong>wrgwrgwgwrgwg</strong> rgwgr rwg</p>"', 4),
    ('Fractions', '"<p>blah</p><p>&nbsp;</p><p>blahhbhbhhg</p><p>rggwr</p><p><strong>wrgwrgwgwrgwg</strong> rgwgr rwg</p>"', 5
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

*/