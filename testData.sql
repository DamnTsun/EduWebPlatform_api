
USE EduWebApp;

-- Subjects
insert into Subjects (name, description, homepageContent) values ('Mathematics', 'Covers mathematics, such as: basic arithmetic, basic fractions, basic algebra, and similar.', 'Not sure what to put here... Placeholder placeholder placeholder.');
insert into Subjects (name, description, homepageContent) values ('English Language', 'This is just a placeholder.', 'Not sure what to put here... Placeholder placeholder placeholder.');
insert into Subjects (name, description, homepageContent) values ('Physics', 'Again. A placeholder.', 'Not sure what to put here... Placeholder placeholder placeholder.');
insert into Subjects (name, description, homepageContent) values ('Citizenship', 'Guess what? Placeholder.', 'Not sure what to put here... Placeholder placeholder placeholder.');


-- Topics
insert into Topics (name, description, subject_id) values ('Addition', 'How to add numbers together...', 1);
insert into Topics (name, description, subject_id) values ('Subtraction', 'How to take one number from another...', 1);
insert into Topics (name, description, subject_id) values ('Multiplication', 'How to multiply numbers together...', 1);
insert into Topics (name, description, subject_id) values ('Division', 'How divide numbers... (and then conquer them)', 1);

insert into Topics (name, description, subject_id) values ('English Language placeholder 1', '38ru29n4v9fhrugir', 2);
insert into Topics (name, description, subject_id) values ('English Language placeholder 2', 'wigjwroigwrogwrouhsfviufig', 2);

insert into Topics (name, description, subject_id) values ('Physics placeholder 1', 'eoqeofiqgourhgiuwrghiwurghwiru', 3);
insert into Topics (name, description, subject_id) values ('Physics placeholder 2', 'wrgwrgwrgwrg', 3);

insert into Topics (name, description, subject_id) values ('Citizenship placeholder 1', 'fijwrowrogrhi', 4);
insert into Topics (name, description, subject_id) values ('Citizenship placeholder 2', 'oefeohrwuhrwgiwurhgwiu', 4);


-- Lessons
insert into Lessons (name, body, topic_id) values ('Addition 1', '2 + 2 = 4', 1);
insert into Lessons (name, body, topic_id) values ('Addition 2', '3 + 3 = 6', 1);
insert into Lessons (name, body, topic_id) values ('Addition 3', 'Do you really not understand?', 1);
insert into Lessons (name, body, topic_id) values ('Subtraction 1', '2 - 2 = 0', 2);
insert into Lessons (name, body, topic_id) values ('Subtraction 2', '3 - 3 = 0', 2);
insert into Lessons (name, body, topic_id) values ('Subtraction 3', 'Do you really not understand?', 2);
insert into Lessons (name, body, topic_id) values ('Multiplication 1', '2 * 2 = 4', 3);
insert into Lessons (name, body, topic_id) values ('Multiplication 2', '3 * 3 = 9', 3);
insert into Lessons (name, body, topic_id) values ('Multiplication 3', 'Do you really not understand?', 3);
insert into Lessons (name, body, topic_id) values ('Division 1', '2 / 2 = 1', 4);
insert into Lessons (name, body, topic_id) values ('Division 2', '3 / 3 = 1', 4);
insert into Lessons (name, body, topic_id) values ('Division 3', 'Do you really not understand?', 4);


-- Tests
insert into Tests (name, description, topic_id) values ('Addition 1', 'Basic addition. (1 digit)', 1);
insert into Tests (name, description, topic_id) values ('Addition 2', 'Basic addition. (2 digit)', 1);
insert into Tests (name, description, topic_id) values ('Addition 3', 'Intermediate addition. (3 digit)', 1);

insert into Tests (name, description, topic_id) values ('Subtraction 1', 'Basic subtraction. (1 digit)', 2);
insert into Tests (name, description, topic_id) values ('Subtraction 2', 'Basic subtraction. (2 digit)', 2);
insert into Tests (name, description, topic_id) values ('Subtraction 3', 'Intermediate subtraction. (3 digit)', 2);

insert into Tests (name, description, topic_id) values ('Multiplication 1', 'Basic multiplication. (1 digit)', 3);
insert into Tests (name, description, topic_id) values ('Multiplication 2', 'Basic multiplication. (2 digit)', 3);
insert into Tests (name, description, topic_id) values ('Multiplication 3', 'Intermediate multiplication. (3 digit)', 3);

insert into Tests (name, description, topic_id) values ('Division 1', 'Basic division. (1 digit)', 4);
insert into Tests (name, description, topic_id) values ('Division 2', 'Basic division. (2 digit)', 4);
insert into Tests (name, description, topic_id) values ('Division 3', 'Intermediate division. (3 digit)', 4);


-- Test questions
-- addition
INSERT INTO TestQuestions (content, answer, imageUrl, test_id) VALUES ('9 + 10', '19', '', 1);
INSERT INTO TestQuestions (content, answer, imageUrl, test_id) VALUES ('2 + 4', '6', '', 1);
INSERT INTO TestQuestions (content, answer, imageUrl, test_id) VALUES ('7 + 0', '7', '', 1);
INSERT INTO TestQuestions (content, answer, imageUrl, test_id) VALUES ('10 + 6', '16', '', 1);
INSERT INTO TestQuestions (content, answer, imageUrl, test_id) VALUES ('0 + 1', '1', '', 1);
INSERT INTO TestQuestions (content, answer, imageUrl, test_id) VALUES ('0 + 1', '1', '', 1);
INSERT INTO TestQuestions (content, answer, imageUrl, test_id) VALUES ('9 + 6', '15', '', 1);
INSERT INTO TestQuestions (content, answer, imageUrl, test_id) VALUES ('3 + 8', '11', '', 1);
INSERT INTO TestQuestions (content, answer, imageUrl, test_id) VALUES ('6 + 1', '7', '', 1);
INSERT INTO TestQuestions (content, answer, imageUrl, test_id) VALUES ('10 + 6', '16', '', 1);

INSERT INTO TestQuestions (content, answer, imageUrl, test_id) VALUES ('82 + 60', '142', '', 2);
INSERT INTO TestQuestions (content, answer, imageUrl, test_id) VALUES ('61 + 17', '78', '', 2);
INSERT INTO TestQuestions (content, answer, imageUrl, test_id) VALUES ('5 + 93', '98', '', 2);
INSERT INTO TestQuestions (content, answer, imageUrl, test_id) VALUES ('63 + 22', '85', '', 2);
INSERT INTO TestQuestions (content, answer, imageUrl, test_id) VALUES ('4 + 48', '52', '', 2);
INSERT INTO TestQuestions (content, answer, imageUrl, test_id) VALUES ('82 + 72', '154', '', 2);
INSERT INTO TestQuestions (content, answer, imageUrl, test_id) VALUES ('36 + 89', '125', '', 2);
INSERT INTO TestQuestions (content, answer, imageUrl, test_id) VALUES ('18 + 26', '44', '', 2);
INSERT INTO TestQuestions (content, answer, imageUrl, test_id) VALUES ('97 + 92', '189', '', 2);
INSERT INTO TestQuestions (content, answer, imageUrl, test_id) VALUES ('6 + 40', '46', '', 2);

INSERT INTO TestQuestions (content, answer, imageUrl, test_id) VALUES ('858 + 788', '1646', '', 3);
INSERT INTO TestQuestions (content, answer, imageUrl, test_id) VALUES ('912 + 98', '1010', '', 3);
INSERT INTO TestQuestions (content, answer, imageUrl, test_id) VALUES ('634 + 380', '1014', '', 3);
INSERT INTO TestQuestions (content, answer, imageUrl, test_id) VALUES ('824 + 691', '1515', '', 3);
INSERT INTO TestQuestions (content, answer, imageUrl, test_id) VALUES ('696 + 199', '895', '', 3);
INSERT INTO TestQuestions (content, answer, imageUrl, test_id) VALUES ('859 + 437', '1296', '', 3);
INSERT INTO TestQuestions (content, answer, imageUrl, test_id) VALUES ('740 + 333', '1073', '', 3);
INSERT INTO TestQuestions (content, answer, imageUrl, test_id) VALUES ('53 + 190', '243', '', 3);
INSERT INTO TestQuestions (content, answer, imageUrl, test_id) VALUES ('105 + 403', '508', '', 3);
INSERT INTO TestQuestions (content, answer, imageUrl, test_id) VALUES ('973 + 805', '1778', '', 3);

-- subtraction
INSERT INTO TestQuestions (content, answer, imageUrl, test_id) VALUES ('9 - 7', '2', '', 4);
INSERT INTO TestQuestions (content, answer, imageUrl, test_id) VALUES ('8 - 4', '4', '', 4);
INSERT INTO TestQuestions (content, answer, imageUrl, test_id) VALUES ('5 - 5', '0', '', 4);
INSERT INTO TestQuestions (content, answer, imageUrl, test_id) VALUES ('9 - 8', '1', '', 4);
INSERT INTO TestQuestions (content, answer, imageUrl, test_id) VALUES ('5 - 0', '5', '', 4);
INSERT INTO TestQuestions (content, answer, imageUrl, test_id) VALUES ('3 - 2', '1', '', 4);
INSERT INTO TestQuestions (content, answer, imageUrl, test_id) VALUES ('10 - 9', '1', '', 4);
INSERT INTO TestQuestions (content, answer, imageUrl, test_id) VALUES ('7 - 5', '2', '', 4);
INSERT INTO TestQuestions (content, answer, imageUrl, test_id) VALUES ('7 - 0', '7', '', 4);
INSERT INTO TestQuestions (content, answer, imageUrl, test_id) VALUES ('5 - 0', '5', '', 4);

INSERT INTO TestQuestions (content, answer, imageUrl, test_id) VALUES ('52 - 30', '22', '', 5);
INSERT INTO TestQuestions (content, answer, imageUrl, test_id) VALUES ('28 - 23', '5', '', 5);
INSERT INTO TestQuestions (content, answer, imageUrl, test_id) VALUES ('45 - 16', '29', '', 5);
INSERT INTO TestQuestions (content, answer, imageUrl, test_id) VALUES ('66 - 43', '23', '', 5);
INSERT INTO TestQuestions (content, answer, imageUrl, test_id) VALUES ('4 - 4', '0', '', 5);
INSERT INTO TestQuestions (content, answer, imageUrl, test_id) VALUES ('91 - 25', '66', '', 5);
INSERT INTO TestQuestions (content, answer, imageUrl, test_id) VALUES ('58 - 29', '29', '', 5);
INSERT INTO TestQuestions (content, answer, imageUrl, test_id) VALUES ('53 - 46', '7', '', 5);
INSERT INTO TestQuestions (content, answer, imageUrl, test_id) VALUES ('95 - 57', '38', '', 5);
INSERT INTO TestQuestions (content, answer, imageUrl, test_id) VALUES ('94 - 4', '90', '', 5);

INSERT INTO TestQuestions (content, answer, imageUrl, test_id) VALUES ('784 - 189', '595', '', 6);
INSERT INTO TestQuestions (content, answer, imageUrl, test_id) VALUES ('523 - 225', '298', '', 6);
INSERT INTO TestQuestions (content, answer, imageUrl, test_id) VALUES ('416 - 392', '24', '', 6);
INSERT INTO TestQuestions (content, answer, imageUrl, test_id) VALUES ('710 - 29', '681', '', 6);
INSERT INTO TestQuestions (content, answer, imageUrl, test_id) VALUES ('790 - 37', '753', '', 6);
INSERT INTO TestQuestions (content, answer, imageUrl, test_id) VALUES ('793 - 76', '717', '', 6);
INSERT INTO TestQuestions (content, answer, imageUrl, test_id) VALUES ('992 - 656', '336', '', 6);
INSERT INTO TestQuestions (content, answer, imageUrl, test_id) VALUES ('992 - 683', '309', '', 6);
INSERT INTO TestQuestions (content, answer, imageUrl, test_id) VALUES ('585 - 106', '479', '', 6);
INSERT INTO TestQuestions (content, answer, imageUrl, test_id) VALUES ('734 - 89', '645', '', 6);