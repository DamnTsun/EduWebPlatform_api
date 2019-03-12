use EduWebApp;


-- Users for Testing
INSERT INTO users (displayName, socialMediaID, socialMediaProvider_id, privilegeLevel_id) VALUES ('Scott, the normie', '102562326633765021134', 1, 1); -- Google account, normal.
INSERT INTO users (displayName, socialMediaID, socialMediaProvider_id, privilegeLevel_id) VALUES ('Scott, the admin', '117929523951432123072', 1, 2); -- Google account, admin.
INSERT INTO users (displayName, socialMediaID, socialMediaProvider_id, privilegeLevel_id) VALUES ('Scott, the banned', '111865521247464378466', 1, 3); -- Google account, banned.
INSERT INTO users (displayName, socialMediaID, socialMediaProvider_id, privilegeLevel_id) VALUES ('Facebook dude', '2246571735353343', 2, 1); -- Facebook account, normal.

-- Subjects
insert into subjects (name, description, hidden) values ('normal subject 1', '', 0);
insert into subjects (name, description, hidden) values ('normal subject 2', '', 0);
insert into subjects (name, description, hidden) values ('normal subject 3', '', 0);
    -- hidden/auto-hidden
insert into subjects (name, description, hidden) values ('hidden subject', '', 1); -- 4
insert into subjects (name, description, hidden) values ('auto-hidden subject', '', 0); -- 5
insert into subjects (name, description, hidden) values ('delete subject', '', 0); -- 6



-- topics
insert into topics (name, description, subject_id, hidden) values ('normal topic 1.1', '', 1, 0);
insert into topics (name, description, subject_id, hidden) values ('normal topic 1.2', '', 1, 0);
insert into topics (name, description, subject_id, hidden) values ('normal topic 1.3', '', 1, 0);
insert into topics (name, description, subject_id, hidden) values ('normal topic 2.1', '', 2, 0);
insert into topics (name, description, subject_id, hidden) values ('normal topic 2.2', '', 2, 0);
insert into topics (name, description, subject_id, hidden) values ('normal topic 2.3', '', 2, 0);
insert into topics (name, description, subject_id, hidden) values ('normal topic 3.1', '', 3, 0);
insert into topics (name, description, subject_id, hidden) values ('normal topic 3.2', '', 3, 0);
insert into topics (name, description, subject_id, hidden) values ('normal topic 3.3', '', 3, 0);

insert into topics (name, description, subject_id, hidden) values ('hidden subject topic', '', 4, 0); -- 10

insert into topics (name, description, subject_id, hidden) values ('hidden topic', '', 1, 1); -- 11
insert into topics (name, description, subject_id, hidden) values ('auto-hidden topic', '', 1, 0); -- 12
insert into topics (name, description, subject_id, hidden) values ('delete topic', '', 1, 0); -- 13



-- lessons
insert into lessons (name, body, topic_id, hidden) values ('normal lesson 1.1.1', '', 1, 0);
insert into lessons (name, body, topic_id, hidden) values ('normal lesson 1.1.2', '', 1, 0);
insert into lessons (name, body, topic_id, hidden) values ('normal lesson 1.1.3', '', 1, 0);
insert into lessons (name, body, topic_id, hidden) values ('normal lesson 1.2.1', '', 2, 0);
insert into lessons (name, body, topic_id, hidden) values ('normal lesson 1.2.2', '', 2, 0);
insert into lessons (name, body, topic_id, hidden) values ('normal lesson 1.2.3', '', 2, 0);
insert into lessons (name, body, topic_id, hidden) values ('normal lesson 1.3.1', '', 3, 0);
insert into lessons (name, body, topic_id, hidden) values ('normal lesson 1.3.2', '', 3, 0);
insert into lessons (name, body, topic_id, hidden) values ('normal lesson 1.3.3', '', 3, 0);
insert into lessons (name, body, topic_id, hidden) values ('normal lesson 2.1.1', '', 4, 0);
insert into lessons (name, body, topic_id, hidden) values ('normal lesson 2.1.2', '', 4, 0);
insert into lessons (name, body, topic_id, hidden) values ('normal lesson 2.1.3', '', 4, 0);
insert into lessons (name, body, topic_id, hidden) values ('normal lesson 2.2.1', '', 5, 0);
insert into lessons (name, body, topic_id, hidden) values ('normal lesson 2.2.2', '', 5, 0);
insert into lessons (name, body, topic_id, hidden) values ('normal lesson 2.2.3', '', 5, 0);
insert into lessons (name, body, topic_id, hidden) values ('normal lesson 2.3.1', '', 6, 0);
insert into lessons (name, body, topic_id, hidden) values ('normal lesson 2.3.2', '', 6, 0);
insert into lessons (name, body, topic_id, hidden) values ('normal lesson 2.3.3', '', 6, 0);
insert into lessons (name, body, topic_id, hidden) values ('normal lesson 3.1.1', '', 7, 0);
insert into lessons (name, body, topic_id, hidden) values ('normal lesson 3.1.2', '', 7, 0);
insert into lessons (name, body, topic_id, hidden) values ('normal lesson 3.1.3', '', 7, 0);
insert into lessons (name, body, topic_id, hidden) values ('normal lesson 3.2.1', '', 8, 0);
insert into lessons (name, body, topic_id, hidden) values ('normal lesson 3.2.2', '', 8, 0);
insert into lessons (name, body, topic_id, hidden) values ('normal lesson 3.2.3', '', 8, 0);
insert into lessons (name, body, topic_id, hidden) values ('normal lesson 3.3.1', '', 9, 0);
insert into lessons (name, body, topic_id, hidden) values ('normal lesson 3.3.2', '', 9, 0);
insert into lessons (name, body, topic_id, hidden) values ('normal lesson 3.3.3', '', 9, 0);

insert into lessons (name, body, topic_id, hidden) values ('hidden subject lesson', '', 10, 0); -- 28
insert into lessons (name, body, topic_id, hidden) values ('hidden topic lesson', '', 11, 0); -- 29

insert into lessons (name, body, topic_id, hidden) values ('hidden lesson', '', 1, 1); -- 30
insert into lessons (name, body, topic_id, hidden) values ('delete lesson', '', 1, 1); -- 31



-- tests
insert into tests (name, description, topic_id, hidden) values ('normal test 1.1.1', '', 1, 0);
insert into tests (name, description, topic_id, hidden) values ('normal test 1.1.2', '', 1, 0);
insert into tests (name, description, topic_id, hidden) values ('normal test 1.1.3', '', 1, 0);
insert into tests (name, description, topic_id, hidden) values ('normal test 1.2.1', '', 2, 0);
insert into tests (name, description, topic_id, hidden) values ('normal test 1.2.2', '', 2, 0);
insert into tests (name, description, topic_id, hidden) values ('normal test 1.2.3', '', 2, 0);
insert into tests (name, description, topic_id, hidden) values ('normal test 1.3.1', '', 3, 0);
insert into tests (name, description, topic_id, hidden) values ('normal test 1.3.2', '', 3, 0);
insert into tests (name, description, topic_id, hidden) values ('normal test 1.3.3', '', 3, 0);
insert into tests (name, description, topic_id, hidden) values ('normal test 2.1.1', '', 4, 0);
insert into tests (name, description, topic_id, hidden) values ('normal test 2.1.2', '', 4, 0);
insert into tests (name, description, topic_id, hidden) values ('normal test 2.1.3', '', 4, 0);
insert into tests (name, description, topic_id, hidden) values ('normal test 2.2.1', '', 5, 0);
insert into tests (name, description, topic_id, hidden) values ('normal test 2.2.2', '', 5, 0);
insert into tests (name, description, topic_id, hidden) values ('normal test 2.2.3', '', 5, 0);
insert into tests (name, description, topic_id, hidden) values ('normal test 2.3.1', '', 6, 0);
insert into tests (name, description, topic_id, hidden) values ('normal test 2.3.2', '', 6, 0);
insert into tests (name, description, topic_id, hidden) values ('normal test 2.3.3', '', 6, 0);
insert into tests (name, description, topic_id, hidden) values ('normal test 3.1.1', '', 7, 0);
insert into tests (name, description, topic_id, hidden) values ('normal test 3.1.2', '', 7, 0);
insert into tests (name, description, topic_id, hidden) values ('normal test 3.1.3', '', 7, 0);
insert into tests (name, description, topic_id, hidden) values ('normal test 3.2.1', '', 8, 0);
insert into tests (name, description, topic_id, hidden) values ('normal test 3.2.2', '', 8, 0);
insert into tests (name, description, topic_id, hidden) values ('normal test 3.2.3', '', 8, 0);
insert into tests (name, description, topic_id, hidden) values ('normal test 3.3.1', '', 9, 0);
insert into tests (name, description, topic_id, hidden) values ('normal test 3.3.2', '', 9, 0);
insert into tests (name, description, topic_id, hidden) values ('normal test 3.3.3', '', 9, 0);

insert into tests (name, description, topic_id, hidden) values ('hidden subject test', '', 10, 0); -- 28
insert into tests (name, description, topic_id, hidden) values ('hidden topic test', '', 11, 0); -- 29

insert into tests (name, description, topic_id, hidden) values ('hidden test', '', 1, 1); -- 30
insert into tests (name, description, topic_id, hidden) values ('auto-hidden test', '', 1,0); -- 31
insert into tests (name, description, topic_id, hidden) values ('delete test', '', 1, 0); -- 32



-- test questions
insert into testQuestions (`question`, answer, test_id) values ('0', '0', 1);
insert into testQuestions (`question`, answer, test_id) values ('1', '1', 1);
insert into testQuestions (`question`, answer, test_id) values ('2', '2', 1);
insert into testQuestions (`question`, answer, test_id) values ('3', '3', 1);
insert into testQuestions (`question`, answer, test_id) values ('4', '4', 1);
insert into testQuestions (`question`, answer, test_id) values ('5', '5', 1);
insert into testQuestions (`question`, answer, test_id) values ('6', '6', 1);
insert into testQuestions (`question`, answer, test_id) values ('7', '7', 1);
insert into testQuestions (`question`, answer, test_id) values ('8', '8', 1);
insert into testQuestions (`question`, answer, test_id) values ('9', '9', 1);

insert into testQuestions (`question`, answer, test_id) values ('0', '0', 2);
insert into testQuestions (`question`, answer, test_id) values ('1', '1', 2);
insert into testQuestions (`question`, answer, test_id) values ('2', '2', 2);
insert into testQuestions (`question`, answer, test_id) values ('3', '3', 2);
insert into testQuestions (`question`, answer, test_id) values ('4', '4', 2);
insert into testQuestions (`question`, answer, test_id) values ('5', '5', 2);
insert into testQuestions (`question`, answer, test_id) values ('6', '6', 2);
insert into testQuestions (`question`, answer, test_id) values ('7', '7', 2);
insert into testQuestions (`question`, answer, test_id) values ('8', '8', 2);
insert into testQuestions (`question`, answer, test_id) values ('9', '9', 2);

insert into testQuestions (`question`, answer, test_id) values ('0', '0', 3);
insert into testQuestions (`question`, answer, test_id) values ('1', '1', 3);
insert into testQuestions (`question`, answer, test_id) values ('2', '2', 3);
insert into testQuestions (`question`, answer, test_id) values ('3', '3', 3);
insert into testQuestions (`question`, answer, test_id) values ('4', '4', 3);
insert into testQuestions (`question`, answer, test_id) values ('5', '5', 3);
insert into testQuestions (`question`, answer, test_id) values ('6', '6', 3);
insert into testQuestions (`question`, answer, test_id) values ('7', '7', 3);
insert into testQuestions (`question`, answer, test_id) values ('8', '8', 3);
insert into testQuestions (`question`, answer, test_id) values ('9', '9', 3);

insert into testQuestions (`question`, answer, test_id) values ('0', '0', 4);
insert into testQuestions (`question`, answer, test_id) values ('1', '1', 4);
insert into testQuestions (`question`, answer, test_id) values ('2', '2', 4);
insert into testQuestions (`question`, answer, test_id) values ('3', '3', 4);
insert into testQuestions (`question`, answer, test_id) values ('4', '4', 4);
insert into testQuestions (`question`, answer, test_id) values ('5', '5', 4);
insert into testQuestions (`question`, answer, test_id) values ('6', '6', 4);
insert into testQuestions (`question`, answer, test_id) values ('7', '7', 4);
insert into testQuestions (`question`, answer, test_id) values ('8', '8', 4);
insert into testQuestions (`question`, answer, test_id) values ('9', '9', 4);

insert into testQuestions (`question`, answer, test_id) values ('0', '0', 5);
insert into testQuestions (`question`, answer, test_id) values ('1', '1', 5);
insert into testQuestions (`question`, answer, test_id) values ('2', '2', 5);
insert into testQuestions (`question`, answer, test_id) values ('3', '3', 5);
insert into testQuestions (`question`, answer, test_id) values ('4', '4', 5);
insert into testQuestions (`question`, answer, test_id) values ('5', '5', 5);
insert into testQuestions (`question`, answer, test_id) values ('6', '6', 5);
insert into testQuestions (`question`, answer, test_id) values ('7', '7', 5);
insert into testQuestions (`question`, answer, test_id) values ('8', '8', 5);
insert into testQuestions (`question`, answer, test_id) values ('9', '9', 5);

insert into testQuestions (`question`, answer, test_id) values ('0', '0', 6);
insert into testQuestions (`question`, answer, test_id) values ('1', '1', 6);
insert into testQuestions (`question`, answer, test_id) values ('2', '2', 6);
insert into testQuestions (`question`, answer, test_id) values ('3', '3', 6);
insert into testQuestions (`question`, answer, test_id) values ('4', '4', 6);
insert into testQuestions (`question`, answer, test_id) values ('5', '5', 6);
insert into testQuestions (`question`, answer, test_id) values ('6', '6', 6);
insert into testQuestions (`question`, answer, test_id) values ('7', '7', 6);
insert into testQuestions (`question`, answer, test_id) values ('8', '8', 6);
insert into testQuestions (`question`, answer, test_id) values ('9', '9', 6);

insert into testQuestions (`question`, answer, test_id) values ('0', '0', 7);
insert into testQuestions (`question`, answer, test_id) values ('1', '1', 7);
insert into testQuestions (`question`, answer, test_id) values ('2', '2', 7);
insert into testQuestions (`question`, answer, test_id) values ('3', '3', 7);
insert into testQuestions (`question`, answer, test_id) values ('4', '4', 7);
insert into testQuestions (`question`, answer, test_id) values ('5', '5', 7);
insert into testQuestions (`question`, answer, test_id) values ('6', '6', 7);
insert into testQuestions (`question`, answer, test_id) values ('7', '7', 7);
insert into testQuestions (`question`, answer, test_id) values ('8', '8', 7);
insert into testQuestions (`question`, answer, test_id) values ('9', '9', 7);

insert into testQuestions (`question`, answer, test_id) values ('0', '0', 8);
insert into testQuestions (`question`, answer, test_id) values ('1', '1', 8);
insert into testQuestions (`question`, answer, test_id) values ('2', '2', 8);
insert into testQuestions (`question`, answer, test_id) values ('3', '3', 8);
insert into testQuestions (`question`, answer, test_id) values ('4', '4', 8);
insert into testQuestions (`question`, answer, test_id) values ('5', '5', 8);
insert into testQuestions (`question`, answer, test_id) values ('6', '6', 8);
insert into testQuestions (`question`, answer, test_id) values ('7', '7', 8);
insert into testQuestions (`question`, answer, test_id) values ('8', '8', 8);
insert into testQuestions (`question`, answer, test_id) values ('9', '9', 8);

insert into testQuestions (`question`, answer, test_id) values ('0', '0', 9);
insert into testQuestions (`question`, answer, test_id) values ('1', '1', 9);
insert into testQuestions (`question`, answer, test_id) values ('2', '2', 9);
insert into testQuestions (`question`, answer, test_id) values ('3', '3', 9);
insert into testQuestions (`question`, answer, test_id) values ('4', '4', 9);
insert into testQuestions (`question`, answer, test_id) values ('5', '5', 9);
insert into testQuestions (`question`, answer, test_id) values ('6', '6', 9);
insert into testQuestions (`question`, answer, test_id) values ('7', '7', 9);
insert into testQuestions (`question`, answer, test_id) values ('8', '8', 9);
insert into testQuestions (`question`, answer, test_id) values ('9', '9', 9);

insert into testQuestions (`question`, answer, test_id) values ('0', '0', 10);
insert into testQuestions (`question`, answer, test_id) values ('1', '1', 10);
insert into testQuestions (`question`, answer, test_id) values ('2', '2', 10);
insert into testQuestions (`question`, answer, test_id) values ('3', '3', 10);
insert into testQuestions (`question`, answer, test_id) values ('4', '4', 10);
insert into testQuestions (`question`, answer, test_id) values ('5', '5', 10);
insert into testQuestions (`question`, answer, test_id) values ('6', '6', 10);
insert into testQuestions (`question`, answer, test_id) values ('7', '7', 10);
insert into testQuestions (`question`, answer, test_id) values ('8', '8', 10);
insert into testQuestions (`question`, answer, test_id) values ('9', '9', 10);

insert into testQuestions (`question`, answer, test_id) values ('0', '0', 11);
insert into testQuestions (`question`, answer, test_id) values ('1', '1', 11);
insert into testQuestions (`question`, answer, test_id) values ('2', '2', 11);
insert into testQuestions (`question`, answer, test_id) values ('3', '3', 11);
insert into testQuestions (`question`, answer, test_id) values ('4', '4', 11);
insert into testQuestions (`question`, answer, test_id) values ('5', '5', 11);
insert into testQuestions (`question`, answer, test_id) values ('6', '6', 11);
insert into testQuestions (`question`, answer, test_id) values ('7', '7', 11);
insert into testQuestions (`question`, answer, test_id) values ('8', '8', 11);
insert into testQuestions (`question`, answer, test_id) values ('9', '9', 11);

insert into testQuestions (`question`, answer, test_id) values ('0', '0', 12);
insert into testQuestions (`question`, answer, test_id) values ('1', '1', 12);
insert into testQuestions (`question`, answer, test_id) values ('2', '2', 12);
insert into testQuestions (`question`, answer, test_id) values ('3', '3', 12);
insert into testQuestions (`question`, answer, test_id) values ('4', '4', 12);
insert into testQuestions (`question`, answer, test_id) values ('5', '5', 12);
insert into testQuestions (`question`, answer, test_id) values ('6', '6', 12);
insert into testQuestions (`question`, answer, test_id) values ('7', '7', 12);
insert into testQuestions (`question`, answer, test_id) values ('8', '8', 12);
insert into testQuestions (`question`, answer, test_id) values ('9', '9', 12);

insert into testQuestions (`question`, answer, test_id) values ('0', '0', 13);
insert into testQuestions (`question`, answer, test_id) values ('1', '1', 13);
insert into testQuestions (`question`, answer, test_id) values ('2', '2', 13);
insert into testQuestions (`question`, answer, test_id) values ('3', '3', 13);
insert into testQuestions (`question`, answer, test_id) values ('4', '4', 13);
insert into testQuestions (`question`, answer, test_id) values ('5', '5', 13);
insert into testQuestions (`question`, answer, test_id) values ('6', '6', 13);
insert into testQuestions (`question`, answer, test_id) values ('7', '7', 13);
insert into testQuestions (`question`, answer, test_id) values ('8', '8', 13);
insert into testQuestions (`question`, answer, test_id) values ('9', '9', 13);

insert into testQuestions (`question`, answer, test_id) values ('0', '0', 14);
insert into testQuestions (`question`, answer, test_id) values ('1', '1', 14);
insert into testQuestions (`question`, answer, test_id) values ('2', '2', 14);
insert into testQuestions (`question`, answer, test_id) values ('3', '3', 14);
insert into testQuestions (`question`, answer, test_id) values ('4', '4', 14);
insert into testQuestions (`question`, answer, test_id) values ('5', '5', 14);
insert into testQuestions (`question`, answer, test_id) values ('6', '6', 14);
insert into testQuestions (`question`, answer, test_id) values ('7', '7', 14);
insert into testQuestions (`question`, answer, test_id) values ('8', '8', 14);
insert into testQuestions (`question`, answer, test_id) values ('9', '9', 14);

insert into testQuestions (`question`, answer, test_id) values ('0', '0', 15);
insert into testQuestions (`question`, answer, test_id) values ('1', '1', 15);
insert into testQuestions (`question`, answer, test_id) values ('2', '2', 15);
insert into testQuestions (`question`, answer, test_id) values ('3', '3', 15);
insert into testQuestions (`question`, answer, test_id) values ('4', '4', 15);
insert into testQuestions (`question`, answer, test_id) values ('5', '5', 15);
insert into testQuestions (`question`, answer, test_id) values ('6', '6', 15);
insert into testQuestions (`question`, answer, test_id) values ('7', '7', 15);
insert into testQuestions (`question`, answer, test_id) values ('8', '8', 15);
insert into testQuestions (`question`, answer, test_id) values ('9', '9', 15);

insert into testQuestions (`question`, answer, test_id) values ('0', '0', 16);
insert into testQuestions (`question`, answer, test_id) values ('1', '1', 16);
insert into testQuestions (`question`, answer, test_id) values ('2', '2', 16);
insert into testQuestions (`question`, answer, test_id) values ('3', '3', 16);
insert into testQuestions (`question`, answer, test_id) values ('4', '4', 16);
insert into testQuestions (`question`, answer, test_id) values ('5', '5', 16);
insert into testQuestions (`question`, answer, test_id) values ('6', '6', 16);
insert into testQuestions (`question`, answer, test_id) values ('7', '7', 16);
insert into testQuestions (`question`, answer, test_id) values ('8', '8', 16);
insert into testQuestions (`question`, answer, test_id) values ('9', '9', 16);

insert into testQuestions (`question`, answer, test_id) values ('0', '0', 17);
insert into testQuestions (`question`, answer, test_id) values ('1', '1', 17);
insert into testQuestions (`question`, answer, test_id) values ('2', '2', 17);
insert into testQuestions (`question`, answer, test_id) values ('3', '3', 17);
insert into testQuestions (`question`, answer, test_id) values ('4', '4', 17);
insert into testQuestions (`question`, answer, test_id) values ('5', '5', 17);
insert into testQuestions (`question`, answer, test_id) values ('6', '6', 17);
insert into testQuestions (`question`, answer, test_id) values ('7', '7', 17);
insert into testQuestions (`question`, answer, test_id) values ('8', '8', 17);
insert into testQuestions (`question`, answer, test_id) values ('9', '9', 17);

insert into testQuestions (`question`, answer, test_id) values ('0', '0', 18);
insert into testQuestions (`question`, answer, test_id) values ('1', '1', 18);
insert into testQuestions (`question`, answer, test_id) values ('2', '2', 18);
insert into testQuestions (`question`, answer, test_id) values ('3', '3', 18);
insert into testQuestions (`question`, answer, test_id) values ('4', '4', 18);
insert into testQuestions (`question`, answer, test_id) values ('5', '5', 18);
insert into testQuestions (`question`, answer, test_id) values ('6', '6', 18);
insert into testQuestions (`question`, answer, test_id) values ('7', '7', 18);
insert into testQuestions (`question`, answer, test_id) values ('8', '8', 18);
insert into testQuestions (`question`, answer, test_id) values ('9', '9', 18);

insert into testQuestions (`question`, answer, test_id) values ('0', '0', 19);
insert into testQuestions (`question`, answer, test_id) values ('1', '1', 19);
insert into testQuestions (`question`, answer, test_id) values ('2', '2', 19);
insert into testQuestions (`question`, answer, test_id) values ('3', '3', 19);
insert into testQuestions (`question`, answer, test_id) values ('4', '4', 19);
insert into testQuestions (`question`, answer, test_id) values ('5', '5', 19);
insert into testQuestions (`question`, answer, test_id) values ('6', '6', 19);
insert into testQuestions (`question`, answer, test_id) values ('7', '7', 19);
insert into testQuestions (`question`, answer, test_id) values ('8', '8', 19);
insert into testQuestions (`question`, answer, test_id) values ('9', '9', 19);

insert into testQuestions (`question`, answer, test_id) values ('0', '0', 20);
insert into testQuestions (`question`, answer, test_id) values ('1', '1', 20);
insert into testQuestions (`question`, answer, test_id) values ('2', '2', 20);
insert into testQuestions (`question`, answer, test_id) values ('3', '3', 20);
insert into testQuestions (`question`, answer, test_id) values ('4', '4', 20);
insert into testQuestions (`question`, answer, test_id) values ('5', '5', 20);
insert into testQuestions (`question`, answer, test_id) values ('6', '6', 20);
insert into testQuestions (`question`, answer, test_id) values ('7', '7', 20);
insert into testQuestions (`question`, answer, test_id) values ('8', '8', 20);
insert into testQuestions (`question`, answer, test_id) values ('9', '9', 20);

insert into testQuestions (`question`, answer, test_id) values ('0', '0', 21);
insert into testQuestions (`question`, answer, test_id) values ('1', '1', 21);
insert into testQuestions (`question`, answer, test_id) values ('2', '2', 21);
insert into testQuestions (`question`, answer, test_id) values ('3', '3', 21);
insert into testQuestions (`question`, answer, test_id) values ('4', '4', 21);
insert into testQuestions (`question`, answer, test_id) values ('5', '5', 21);
insert into testQuestions (`question`, answer, test_id) values ('6', '6', 21);
insert into testQuestions (`question`, answer, test_id) values ('7', '7', 21);
insert into testQuestions (`question`, answer, test_id) values ('8', '8', 21);
insert into testQuestions (`question`, answer, test_id) values ('9', '9', 21);

insert into testQuestions (`question`, answer, test_id) values ('0', '0', 22);
insert into testQuestions (`question`, answer, test_id) values ('1', '1', 22);
insert into testQuestions (`question`, answer, test_id) values ('2', '2', 22);
insert into testQuestions (`question`, answer, test_id) values ('3', '3', 22);
insert into testQuestions (`question`, answer, test_id) values ('4', '4', 22);
insert into testQuestions (`question`, answer, test_id) values ('5', '5', 22);
insert into testQuestions (`question`, answer, test_id) values ('6', '6', 22);
insert into testQuestions (`question`, answer, test_id) values ('7', '7', 22);
insert into testQuestions (`question`, answer, test_id) values ('8', '8', 22);
insert into testQuestions (`question`, answer, test_id) values ('9', '9', 22);

insert into testQuestions (`question`, answer, test_id) values ('0', '0', 23);
insert into testQuestions (`question`, answer, test_id) values ('1', '1', 23);
insert into testQuestions (`question`, answer, test_id) values ('2', '2', 23);
insert into testQuestions (`question`, answer, test_id) values ('3', '3', 23);
insert into testQuestions (`question`, answer, test_id) values ('4', '4', 23);
insert into testQuestions (`question`, answer, test_id) values ('5', '5', 23);
insert into testQuestions (`question`, answer, test_id) values ('6', '6', 23);
insert into testQuestions (`question`, answer, test_id) values ('7', '7', 23);
insert into testQuestions (`question`, answer, test_id) values ('8', '8', 23);
insert into testQuestions (`question`, answer, test_id) values ('9', '9', 23);

insert into testQuestions (`question`, answer, test_id) values ('0', '0', 24);
insert into testQuestions (`question`, answer, test_id) values ('1', '1', 24);
insert into testQuestions (`question`, answer, test_id) values ('2', '2', 24);
insert into testQuestions (`question`, answer, test_id) values ('3', '3', 24);
insert into testQuestions (`question`, answer, test_id) values ('4', '4', 24);
insert into testQuestions (`question`, answer, test_id) values ('5', '5', 24);
insert into testQuestions (`question`, answer, test_id) values ('6', '6', 24);
insert into testQuestions (`question`, answer, test_id) values ('7', '7', 24);
insert into testQuestions (`question`, answer, test_id) values ('8', '8', 24);
insert into testQuestions (`question`, answer, test_id) values ('9', '9', 24);

insert into testQuestions (`question`, answer, test_id) values ('0', '0', 25);
insert into testQuestions (`question`, answer, test_id) values ('1', '1', 25);
insert into testQuestions (`question`, answer, test_id) values ('2', '2', 25);
insert into testQuestions (`question`, answer, test_id) values ('3', '3', 25);
insert into testQuestions (`question`, answer, test_id) values ('4', '4', 25);
insert into testQuestions (`question`, answer, test_id) values ('5', '5', 25);
insert into testQuestions (`question`, answer, test_id) values ('6', '6', 25);
insert into testQuestions (`question`, answer, test_id) values ('7', '7', 25);
insert into testQuestions (`question`, answer, test_id) values ('8', '8', 25);
insert into testQuestions (`question`, answer, test_id) values ('9', '9', 25);

insert into testQuestions (`question`, answer, test_id) values ('0', '0', 26);
insert into testQuestions (`question`, answer, test_id) values ('1', '1', 26);
insert into testQuestions (`question`, answer, test_id) values ('2', '2', 26);
insert into testQuestions (`question`, answer, test_id) values ('3', '3', 26);
insert into testQuestions (`question`, answer, test_id) values ('4', '4', 26);
insert into testQuestions (`question`, answer, test_id) values ('5', '5', 26);
insert into testQuestions (`question`, answer, test_id) values ('6', '6', 26);
insert into testQuestions (`question`, answer, test_id) values ('7', '7', 26);
insert into testQuestions (`question`, answer, test_id) values ('8', '8', 26);
insert into testQuestions (`question`, answer, test_id) values ('9', '9', 26);

insert into testQuestions (`question`, answer, test_id) values ('0', '0', 27);
insert into testQuestions (`question`, answer, test_id) values ('1', '1', 27);
insert into testQuestions (`question`, answer, test_id) values ('2', '2', 27);
insert into testQuestions (`question`, answer, test_id) values ('3', '3', 27);
insert into testQuestions (`question`, answer, test_id) values ('4', '4', 27);
insert into testQuestions (`question`, answer, test_id) values ('5', '5', 27);
insert into testQuestions (`question`, answer, test_id) values ('6', '6', 27);
insert into testQuestions (`question`, answer, test_id) values ('7', '7', 27);
insert into testQuestions (`question`, answer, test_id) values ('8', '8', 27);
insert into testQuestions (`question`, answer, test_id) values ('9', '9', 27); -- 270

insert into testQuestions (`question`, answer, test_id) values ('delete question', 'a', 1); -- 271


-- Subject posts
insert into posts (title, body, subject_id, user_id) values ('post1.1', '', 1, 2);
insert into posts (title, body, subject_id, user_id) values ('post1.2', '', 1, 2);
insert into posts (title, body, subject_id, user_id) values ('post1.3', '', 1, 2);

insert into posts (title, body, subject_id, user_id) values ('post2.1', '', 2, 2);
insert into posts (title, body, subject_id, user_id) values ('post2.2', '', 2, 2);
insert into posts (title, body, subject_id, user_id) values ('post2.3', '', 2, 2);

-- Test users and subject admins
insert into users (displayName, socialMediaID, socialMediaProvider_id, privilegeLevel_id, lastSignInDate) values ('test_user1', 'test1', 1, 1, CURRENT_TIMESTAMP);
insert into users (displayName, socialMediaID, socialMediaProvider_id, privilegeLevel_id, lastSignInDate) values ('test_user2', 'test2', 1, 1, CURRENT_TIMESTAMP);
insert into users (displayName, socialMediaID, socialMediaProvider_id, privilegeLevel_id, lastSignInDate) values ('test_user3', 'test3', 1, 1, CURRENT_TIMESTAMP);
insert into users (displayName, socialMediaID, socialMediaProvider_id, privilegeLevel_id, lastSignInDate) values ('test_user4', 'test4', 1, 1, CURRENT_TIMESTAMP);
insert into users (displayName, socialMediaID, socialMediaProvider_id, privilegeLevel_id, lastSignInDate) values ('test_user5', 'test5', 1, 1, CURRENT_TIMESTAMP); -- 9

insert into users (displayName, socialMediaID, socialMediaProvider_id, privilegeLevel_id, lastSignInDate) values ('test_admin', 'test1a', 1, 2, CURRENT_TIMESTAMP);
insert into users (displayName, socialMediaID, socialMediaProvider_id, privilegeLevel_id, lastSignInDate) values ('test_admin', 'test2a', 1, 2, CURRENT_TIMESTAMP);
insert into users (displayName, socialMediaID, socialMediaProvider_id, privilegeLevel_id, lastSignInDate) values ('test_admin', 'test3a', 1, 2, CURRENT_TIMESTAMP);
insert into users (displayName, socialMediaID, socialMediaProvider_id, privilegeLevel_id, lastSignInDate) values ('test_admin', 'test4a', 1, 2, CURRENT_TIMESTAMP);
insert into users (displayName, socialMediaID, socialMediaProvider_id, privilegeLevel_id, lastSignInDate) values ('test_admin', 'test5a', 1, 2, CURRENT_TIMESTAMP);

insert into subject_admins (user_id, subject_id) values (12, 1);
insert into subject_admins (user_id, subject_id) values (10, 1);
insert into subject_admins (user_id, subject_id) values (11, 1);

insert into subject_admins (user_id, subject_id) values (2, 2);
insert into subject_admins (user_id, subject_id) values (12, 2);
insert into subject_admins (user_id, subject_id) values (13, 2);



-- user tests
insert into user_tests (title, test_id, user_id, `date`) values ('test1.1', 1, 2, '2019-02-10 00:00:00');
insert into user_tests (title, test_id, user_id, `date`) values ('test1.2', 1, 2, '2019-03-10 00:00:00');
insert into user_tests (title, test_id, user_id, `date`) values ('test1.3', 2, 2, '2019-03-10 00:00:10');

insert into user_tests (title, test_id, user_id) values ('test2.1', 1, 4);
insert into user_tests (title, test_id, user_id) values ('test2.2', 2, 4);
insert into user_tests (title, test_id, user_id) values ('test2.3', 2, 4);

-- user test questions
insert into user_testQuestions (userAnswer, testQuestion_id, user_Test_id) values ('a', 1, 1);
insert into user_testQuestions (userAnswer, testQuestion_id, user_Test_id) values ('a', 2, 1);
insert into user_testQuestions (userAnswer, testQuestion_id, user_Test_id) values ('a', 3, 1);

insert into user_testQuestions (userAnswer, testQuestion_id, user_Test_id) values ('a', 3, 2);
insert into user_testQuestions (userAnswer, testQuestion_id, user_Test_id) values ('a', 4, 2);
insert into user_testQuestions (userAnswer, testQuestion_id, user_Test_id) values ('a', 5, 2);

insert into user_testQuestions (userAnswer, testQuestion_id, user_Test_id) values ('a', 11, 3);
insert into user_testQuestions (userAnswer, testQuestion_id, user_Test_id) values ('a', 12, 3);
insert into user_testQuestions (userAnswer, testQuestion_id, user_Test_id) values ('a', 13, 3);


insert into user_testQuestions (userAnswer, testQuestion_id, user_Test_id) values ('a', 1, 4);
insert into user_testQuestions (userAnswer, testQuestion_id, user_Test_id) values ('a', 2, 4);
insert into user_testQuestions (userAnswer, testQuestion_id, user_Test_id) values ('a', 3, 4);

insert into user_testQuestions (userAnswer, testQuestion_id, user_Test_id) values ('a', 11, 5);
insert into user_testQuestions (userAnswer, testQuestion_id, user_Test_id) values ('a', 12, 5);
insert into user_testQuestions (userAnswer, testQuestion_id, user_Test_id) values ('a', 13, 5);

insert into user_testQuestions (userAnswer, testQuestion_id, user_Test_id) values ('a', 16, 6);
insert into user_testQuestions (userAnswer, testQuestion_id, user_Test_id) values ('a', 17, 6);
insert into user_testQuestions (userAnswer, testQuestion_id, user_Test_id) values ('a', 18, 6);



-- user messages.
insert into messages (message, `date`, sender_id) values ('m1', '2019-01-01 12:00:00', 2);
insert into messages (message, `date`, sender_id) values ('m2', '2019-01-01 12:00:01', 2);
insert into messages (message, `date`, sender_id) values ('m3', '2019-01-01 12:00:02', 2);
insert into messages (message, `date`, sender_id) values ('m4', '2019-01-01 12:00:03', 4);
insert into messages (message, `date`, sender_id) values ('m5', '2019-01-01 12:00:04', 4);
insert into messages (message, `date`, sender_id) values ('m6', '2019-01-01 12:00:05', 2);
insert into messages (message, `date`, sender_id) values ('m7', '2019-01-01 12:00:06', 2);
insert into messages (message, `date`, sender_id) values ('m8', '2019-01-01 12:00:07', 4);
insert into messages (message, `date`, sender_id) values ('m9', '2019-01-01 12:00:08', 4);
insert into messages (message, `date`, sender_id) values ('m10', '2019-01-01 12:00:09', 4); -- 10

insert into user_messages (message_id, user_id) values (1, 4);
insert into user_messages (message_id, user_id) values (2, 4);
insert into user_messages (message_id, user_id) values (3, 4);
insert into user_messages (message_id, user_id) values (4, 2);
insert into user_messages (message_id, user_id) values (5, 2);
insert into user_messages (message_id, user_id) values (6, 4);
insert into user_messages (message_id, user_id) values (7, 4);
insert into user_messages (message_id, user_id) values (8, 2);
insert into user_messages (message_id, user_id) values (9, 2);
insert into user_messages (message_id, user_id) values (10, 2);


insert into messages (message, `date`, sender_id) values ('mm1', '2019-01-01 12:00:00', 1);
insert into messages (message, `date`, sender_id) values ('mm2', '2019-01-01 12:00:01', 1);
insert into messages (message, `date`, sender_id) values ('mm3', '2019-01-01 12:00:02', 1);
insert into messages (message, `date`, sender_id) values ('mm4', '2019-01-01 12:00:03', 2);
insert into messages (message, `date`, sender_id) values ('mm5', '2019-01-01 12:00:04', 2);
insert into messages (message, `date`, sender_id) values ('mm6', '2019-01-01 12:00:05', 2);
insert into messages (message, `date`, sender_id) values ('mm7', '2019-01-01 12:00:06', 2);
insert into messages (message, `date`, sender_id) values ('mm8', '2019-01-01 12:00:07', 1);
insert into messages (message, `date`, sender_id) values ('mm9', '2019-01-01 12:00:08', 1);
insert into messages (message, `date`, sender_id) values ('mm10', '2019-01-01 12:00:09', 1); -- 20

insert into user_messages (message_id, user_id) values (11, 2);
insert into user_messages (message_id, user_id) values (12, 2);
insert into user_messages (message_id, user_id) values (13, 2);
insert into user_messages (message_id, user_id) values (14, 1);
insert into user_messages (message_id, user_id) values (15, 1);
insert into user_messages (message_id, user_id) values (16, 1);
insert into user_messages (message_id, user_id) values (17, 1);
insert into user_messages (message_id, user_id) values (18, 2);
insert into user_messages (message_id, user_id) values (19, 2);
insert into user_messages (message_id, user_id) values (20, 2);



-- groups
insert into groups (name, description) values ('group1', '');
insert into groups (name, description) values ('group2', '');
insert into groups (name, description) values ('group3', '');

insert into user_groups (user_id, group_id) values (1, 1);
insert into user_groups (user_id, group_id) values (2, 1);
insert into user_groups (user_id, group_id) values (4, 1);

insert into user_groups (user_id, group_id) values (2, 2);
insert into user_groups (user_id, group_id) values (5, 2);
insert into user_groups (user_id, group_id) values (6, 2);

insert into user_groups (user_id, group_id) values (4, 3);
insert into user_groups (user_id, group_id) values (5, 3);
insert into user_groups (user_id, group_id) values (6, 3);



-- group messages
insert into messages (message, `date`, sender_id) values ('gm1', '2019-01-01 12:00:00', 1);
insert into messages (message, `date`, sender_id) values ('gm2', '2019-01-01 12:00:01', 1);
insert into messages (message, `date`, sender_id) values ('gm3', '2019-01-01 12:00:02', 2);
insert into messages (message, `date`, sender_id) values ('gm4', '2019-01-01 12:00:03', 4);
insert into messages (message, `date`, sender_id) values ('gm5', '2019-01-01 12:00:04', 2);
insert into messages (message, `date`, sender_id) values ('gm6', '2019-01-01 12:00:05', 2);
insert into messages (message, `date`, sender_id) values ('gm7', '2019-01-01 12:00:06', 1);
insert into messages (message, `date`, sender_id) values ('gm8', '2019-01-01 12:00:07', 1);
insert into messages (message, `date`, sender_id) values ('gm9', '2019-01-01 12:00:08', 2);
insert into messages (message, `date`, sender_id) values ('gm10', '2019-01-01 12:00:09', 4); -- 30

insert into group_messages (message_id, group_id) values (21, 1);
insert into group_messages (message_id, group_id) values (22, 1);
insert into group_messages (message_id, group_id) values (23, 1);
insert into group_messages (message_id, group_id) values (24, 1);
insert into group_messages (message_id, group_id) values (25, 1);
insert into group_messages (message_id, group_id) values (26, 1);
insert into group_messages (message_id, group_id) values (27, 1);
insert into group_messages (message_id, group_id) values (28, 1);
insert into group_messages (message_id, group_id) values (29, 1);
insert into group_messages (message_id, group_id) values (30, 1);

insert into messages (message, `date`, sender_id) values ('gmm1', '2019-01-01 12:00:00', 2);
insert into messages (message, `date`, sender_id) values ('gmm2', '2019-01-01 12:00:01', 2);
insert into messages (message, `date`, sender_id) values ('gmm3', '2019-01-01 12:00:02', 5);
insert into messages (message, `date`, sender_id) values ('gmm4', '2019-01-01 12:00:03', 6);
insert into messages (message, `date`, sender_id) values ('gmm5', '2019-01-01 12:00:04', 6);
insert into messages (message, `date`, sender_id) values ('gmm6', '2019-01-01 12:00:05', 6);
insert into messages (message, `date`, sender_id) values ('gmm7', '2019-01-01 12:00:06', 5);
insert into messages (message, `date`, sender_id) values ('gmm8', '2019-01-01 12:00:07', 2);
insert into messages (message, `date`, sender_id) values ('gmm9', '2019-01-01 12:00:08', 5);
insert into messages (message, `date`, sender_id) values ('gmm10', '2019-01-01 12:00:09', 2); -- 40

insert into group_messages (message_id, group_id) values (31, 2);
insert into group_messages (message_id, group_id) values (32, 2);
insert into group_messages (message_id, group_id) values (33, 2);
insert into group_messages (message_id, group_id) values (34, 2);
insert into group_messages (message_id, group_id) values (35, 2);
insert into group_messages (message_id, group_id) values (36, 2);
insert into group_messages (message_id, group_id) values (37, 2);
insert into group_messages (message_id, group_id) values (38, 2);
insert into group_messages (message_id, group_id) values (39, 2);
insert into group_messages (message_id, group_id) values (40, 2);

insert into messages (message, `date`, sender_id) values ('gmmm1', '2019-01-01 12:00:00', 4);
insert into messages (message, `date`, sender_id) values ('gmmm1', '2019-01-01 12:00:01', 4);
insert into messages (message, `date`, sender_id) values ('gmmm1', '2019-01-01 12:00:02', 5);
insert into messages (message, `date`, sender_id) values ('gmmm1', '2019-01-01 12:00:03', 5);
insert into messages (message, `date`, sender_id) values ('gmmm1', '2019-01-01 12:00:04', 6);
insert into messages (message, `date`, sender_id) values ('gmmm1', '2019-01-01 12:00:05', 4);
insert into messages (message, `date`, sender_id) values ('gmmm1', '2019-01-01 12:00:06', 4);
insert into messages (message, `date`, sender_id) values ('gmmm1', '2019-01-01 12:00:07', 6);
insert into messages (message, `date`, sender_id) values ('gmmm1', '2019-01-01 12:00:08', 5);
insert into messages (message, `date`, sender_id) values ('gmmm1', '2019-01-01 12:00:10', 5); -- 50

insert into group_messages (message_id, group_id) values (41, 3);
insert into group_messages (message_id, group_id) values (42, 3);
insert into group_messages (message_id, group_id) values (43, 3);
insert into group_messages (message_id, group_id) values (44, 3);
insert into group_messages (message_id, group_id) values (45, 3);
insert into group_messages (message_id, group_id) values (46, 3);
insert into group_messages (message_id, group_id) values (47, 3);
insert into group_messages (message_id, group_id) values (48, 3);
insert into group_messages (message_id, group_id) values (49, 3);
insert into group_messages (message_id, group_id) values (50, 3);