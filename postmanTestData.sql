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
    -- subject to test frontend loading of additional subjects.
insert into subjects (name, description, hidden) values ('z_subject01', '', 0);
insert into subjects (name, description, hidden) values ('z_subject02', '', 0);
insert into subjects (name, description, hidden) values ('z_subject03', '', 0);
insert into subjects (name, description, hidden) values ('z_subject04', '', 0);
insert into subjects (name, description, hidden) values ('z_subject05', '', 0);
insert into subjects (name, description, hidden) values ('z_subject06', '', 0);
insert into subjects (name, description, hidden) values ('z_subject07', '', 0);
insert into subjects (name, description, hidden) values ('z_subject08', '', 0);
insert into subjects (name, description, hidden) values ('z_subject09', '', 0);
insert into subjects (name, description, hidden) values ('z_subject10', '', 0);
insert into subjects (name, description, hidden) values ('z_subject11', '', 0);
insert into subjects (name, description, hidden) values ('z_subject12', '', 0);
insert into subjects (name, description, hidden) values ('z_subject13', '', 0);
insert into subjects (name, description, hidden) values ('z_subject14', '', 0);
insert into subjects (name, description, hidden) values ('z_subject15', '', 0);
insert into subjects (name, description, hidden) values ('z_subject16', '', 0);
insert into subjects (name, description, hidden) values ('z_subject17', '', 0);
insert into subjects (name, description, hidden) values ('z_subject18', '', 0);
insert into subjects (name, description, hidden) values ('z_subject19', '', 0);
insert into subjects (name, description, hidden) values ('z_subject20', '', 0);



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
    -- subject to test frontend loading of additional topics.
insert into topics (name, description, subject_id, hidden) values ('z_topic01', '', 1, 0);
insert into topics (name, description, subject_id, hidden) values ('z_topic02', '', 1, 0);
insert into topics (name, description, subject_id, hidden) values ('z_topic03', '', 1, 0);
insert into topics (name, description, subject_id, hidden) values ('z_topic04', '', 1, 0);
insert into topics (name, description, subject_id, hidden) values ('z_topic05', '', 1, 0);
insert into topics (name, description, subject_id, hidden) values ('z_topic06', '', 1, 0);
insert into topics (name, description, subject_id, hidden) values ('z_topic07', '', 1, 0);
insert into topics (name, description, subject_id, hidden) values ('z_topic08', '', 1, 0);
insert into topics (name, description, subject_id, hidden) values ('z_topic09', '', 1, 0);
insert into topics (name, description, subject_id, hidden) values ('z_topic10', '', 1, 0);
insert into topics (name, description, subject_id, hidden) values ('z_topic11', '', 1, 0);
insert into topics (name, description, subject_id, hidden) values ('z_topic12', '', 1, 0);
insert into topics (name, description, subject_id, hidden) values ('z_topic13', '', 1, 0);
insert into topics (name, description, subject_id, hidden) values ('z_topic14', '', 1, 0);
insert into topics (name, description, subject_id, hidden) values ('z_topic15', '', 1, 0);
insert into topics (name, description, subject_id, hidden) values ('z_topic16', '', 1, 0);
insert into topics (name, description, subject_id, hidden) values ('z_topic17', '', 1, 0);
insert into topics (name, description, subject_id, hidden) values ('z_topic18', '', 1, 0);
insert into topics (name, description, subject_id, hidden) values ('z_topic19', '', 1, 0);
insert into topics (name, description, subject_id, hidden) values ('z_topic20', '', 1, 0);



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
    -- subject to test frontend loading of additional lessons.
insert into lessons (name, body, topic_id, hidden) values ('z_lesson01', '', 1, 0);
insert into lessons (name, body, topic_id, hidden) values ('z_lesson02', '', 1, 0);
insert into lessons (name, body, topic_id, hidden) values ('z_lesson03', '', 1, 0);
insert into lessons (name, body, topic_id, hidden) values ('z_lesson04', '', 1, 0);
insert into lessons (name, body, topic_id, hidden) values ('z_lesson05', '', 1, 0);
insert into lessons (name, body, topic_id, hidden) values ('z_lesson06', '', 1, 0);
insert into lessons (name, body, topic_id, hidden) values ('z_lesson07', '', 1, 0);
insert into lessons (name, body, topic_id, hidden) values ('z_lesson08', '', 1, 0);
insert into lessons (name, body, topic_id, hidden) values ('z_lesson09', '', 1, 0);
insert into lessons (name, body, topic_id, hidden) values ('z_lesson10', '', 1, 0);
insert into lessons (name, body, topic_id, hidden) values ('z_lesson11', '', 1, 0);
insert into lessons (name, body, topic_id, hidden) values ('z_lesson12', '', 1, 0);
insert into lessons (name, body, topic_id, hidden) values ('z_lesson13', '', 1, 0);
insert into lessons (name, body, topic_id, hidden) values ('z_lesson14', '', 1, 0);
insert into lessons (name, body, topic_id, hidden) values ('z_lesson15', '', 1, 0);
insert into lessons (name, body, topic_id, hidden) values ('z_lesson16', '', 1, 0);
insert into lessons (name, body, topic_id, hidden) values ('z_lesson17', '', 1, 0);
insert into lessons (name, body, topic_id, hidden) values ('z_lesson18', '', 1, 0);
insert into lessons (name, body, topic_id, hidden) values ('z_lesson19', '', 1, 0);
insert into lessons (name, body, topic_id, hidden) values ('z_lesson20', '', 1, 0);



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
    -- subject to test frontend loading of additional lessons.
insert into tests (name, description, topic_id, hidden) values ('z_test01', '', 1, 0);
insert into tests (name, description, topic_id, hidden) values ('z_test02', '', 1, 0);
insert into tests (name, description, topic_id, hidden) values ('z_test03', '', 1, 0);
insert into tests (name, description, topic_id, hidden) values ('z_test04', '', 1, 0);
insert into tests (name, description, topic_id, hidden) values ('z_test05', '', 1, 0);
insert into tests (name, description, topic_id, hidden) values ('z_test06', '', 1, 0);
insert into tests (name, description, topic_id, hidden) values ('z_test07', '', 1, 0);
insert into tests (name, description, topic_id, hidden) values ('z_test08', '', 1, 0);
insert into tests (name, description, topic_id, hidden) values ('z_test09', '', 1, 0);
insert into tests (name, description, topic_id, hidden) values ('z_test10', '', 1, 0);
insert into tests (name, description, topic_id, hidden) values ('z_test11', '', 1, 0);
insert into tests (name, description, topic_id, hidden) values ('z_test12', '', 1, 0);
insert into tests (name, description, topic_id, hidden) values ('z_test13', '', 1, 0);
insert into tests (name, description, topic_id, hidden) values ('z_test14', '', 1, 0);
insert into tests (name, description, topic_id, hidden) values ('z_test15', '', 1, 0);
insert into tests (name, description, topic_id, hidden) values ('z_test16', '', 1, 0);
insert into tests (name, description, topic_id, hidden) values ('z_test17', '', 1, 0);
insert into tests (name, description, topic_id, hidden) values ('z_test18', '', 1, 0);
insert into tests (name, description, topic_id, hidden) values ('z_test19', '', 1, 0);
insert into tests (name, description, topic_id, hidden) values ('z_test20', '', 1, 0);



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
    -- subject to test frontend loading of additional lessons.
insert into posts (title, body, subject_id, user_id) values ('z_post01', '', 1, 2);
insert into posts (title, body, subject_id, user_id) values ('z_post02', '', 1, 2);
insert into posts (title, body, subject_id, user_id) values ('z_post03', '', 1, 2);
insert into posts (title, body, subject_id, user_id) values ('z_post04', '', 1, 2);
insert into posts (title, body, subject_id, user_id) values ('z_post05', '', 1, 2);
insert into posts (title, body, subject_id, user_id) values ('z_post06', '', 1, 2);
insert into posts (title, body, subject_id, user_id) values ('z_post07', '', 1, 2);
insert into posts (title, body, subject_id, user_id) values ('z_post08', '', 1, 2);
insert into posts (title, body, subject_id, user_id) values ('z_post09', '', 1, 2);
insert into posts (title, body, subject_id, user_id) values ('z_post10', '', 1, 2);
insert into posts (title, body, subject_id, user_id) values ('z_post11', '', 1, 2);
insert into posts (title, body, subject_id, user_id) values ('z_post12', '', 1, 2);
insert into posts (title, body, subject_id, user_id) values ('z_post13', '', 1, 2);
insert into posts (title, body, subject_id, user_id) values ('z_post14', '', 1, 2);
insert into posts (title, body, subject_id, user_id) values ('z_post15', '', 1, 2);
insert into posts (title, body, subject_id, user_id) values ('z_post16', '', 1, 2);
insert into posts (title, body, subject_id, user_id) values ('z_post17', '', 1, 2);
insert into posts (title, body, subject_id, user_id) values ('z_post18', '', 1, 2);
insert into posts (title, body, subject_id, user_id) values ('z_post19', '', 1, 2);
insert into posts (title, body, subject_id, user_id) values ('z_post20', '', 1, 2);




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
    -- Addition users for testing frontend getting additional users.
insert into users (displayName, socialMediaID, socialMediaProvider_id, privilegeLevel_id, lastSignInDate) values ('z_user01', 'test__01', 1, 1, CURRENT_TIMESTAMP);
insert into users (displayName, socialMediaID, socialMediaProvider_id, privilegeLevel_id, lastSignInDate) values ('z_user02', 'test__02', 1, 1, CURRENT_TIMESTAMP);
insert into users (displayName, socialMediaID, socialMediaProvider_id, privilegeLevel_id, lastSignInDate) values ('z_user03', 'test__03', 1, 1, CURRENT_TIMESTAMP);
insert into users (displayName, socialMediaID, socialMediaProvider_id, privilegeLevel_id, lastSignInDate) values ('z_user04', 'test__04', 1, 1, CURRENT_TIMESTAMP);
insert into users (displayName, socialMediaID, socialMediaProvider_id, privilegeLevel_id, lastSignInDate) values ('z_user05', 'test__05', 1, 1, CURRENT_TIMESTAMP);
insert into users (displayName, socialMediaID, socialMediaProvider_id, privilegeLevel_id, lastSignInDate) values ('z_user06', 'test__06', 1, 1, CURRENT_TIMESTAMP);
insert into users (displayName, socialMediaID, socialMediaProvider_id, privilegeLevel_id, lastSignInDate) values ('z_user07', 'test__07', 1, 1, CURRENT_TIMESTAMP);
insert into users (displayName, socialMediaID, socialMediaProvider_id, privilegeLevel_id, lastSignInDate) values ('z_user08', 'test__08', 1, 1, CURRENT_TIMESTAMP);
insert into users (displayName, socialMediaID, socialMediaProvider_id, privilegeLevel_id, lastSignInDate) values ('z_user09', 'test__09', 1, 1, CURRENT_TIMESTAMP);
insert into users (displayName, socialMediaID, socialMediaProvider_id, privilegeLevel_id, lastSignInDate) values ('z_user10', 'test__10', 1, 1, CURRENT_TIMESTAMP);
insert into users (displayName, socialMediaID, socialMediaProvider_id, privilegeLevel_id, lastSignInDate) values ('z_user11', 'test__11', 1, 1, CURRENT_TIMESTAMP);
insert into users (displayName, socialMediaID, socialMediaProvider_id, privilegeLevel_id, lastSignInDate) values ('z_user12', 'test__12', 1, 1, CURRENT_TIMESTAMP);
insert into users (displayName, socialMediaID, socialMediaProvider_id, privilegeLevel_id, lastSignInDate) values ('z_user13', 'test__13', 1, 1, CURRENT_TIMESTAMP);
insert into users (displayName, socialMediaID, socialMediaProvider_id, privilegeLevel_id, lastSignInDate) values ('z_user14', 'test__14', 1, 1, CURRENT_TIMESTAMP);
insert into users (displayName, socialMediaID, socialMediaProvider_id, privilegeLevel_id, lastSignInDate) values ('z_user15', 'test__15', 1, 1, CURRENT_TIMESTAMP);
insert into users (displayName, socialMediaID, socialMediaProvider_id, privilegeLevel_id, lastSignInDate) values ('z_user16', 'test__16', 1, 1, CURRENT_TIMESTAMP);
insert into users (displayName, socialMediaID, socialMediaProvider_id, privilegeLevel_id, lastSignInDate) values ('z_user17', 'test__17', 1, 1, CURRENT_TIMESTAMP);
insert into users (displayName, socialMediaID, socialMediaProvider_id, privilegeLevel_id, lastSignInDate) values ('z_user18', 'test__18', 1, 1, CURRENT_TIMESTAMP);
insert into users (displayName, socialMediaID, socialMediaProvider_id, privilegeLevel_id, lastSignInDate) values ('z_user19', 'test__19', 1, 1, CURRENT_TIMESTAMP);
insert into users (displayName, socialMediaID, socialMediaProvider_id, privilegeLevel_id, lastSignInDate) values ('z_user20', 'test__20', 1, 1, CURRENT_TIMESTAMP);

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

    -- additional tests for frontend getting additional
insert into user_tests (title, test_id, user_id, `date`) values ('z_test01', 1, 2, '2019-03-10 00:00:01');
insert into user_tests (title, test_id, user_id, `date`) values ('z_test02', 1, 2, '2019-03-10 00:00:02');
insert into user_tests (title, test_id, user_id, `date`) values ('z_test03', 1, 2, '2019-03-10 00:00:03');
insert into user_tests (title, test_id, user_id, `date`) values ('z_test04', 1, 2, '2019-03-10 00:00:04');
insert into user_tests (title, test_id, user_id, `date`) values ('z_test05', 1, 2, '2019-03-10 00:00:05');
insert into user_tests (title, test_id, user_id, `date`) values ('z_test06', 1, 2, '2019-03-10 00:00:06');
insert into user_tests (title, test_id, user_id, `date`) values ('z_test07', 1, 2, '2019-03-10 00:00:07');
insert into user_tests (title, test_id, user_id, `date`) values ('z_test08', 1, 2, '2019-03-10 00:00:08');
insert into user_tests (title, test_id, user_id, `date`) values ('z_test09', 1, 2, '2019-03-10 00:00:09');
insert into user_tests (title, test_id, user_id, `date`) values ('z_test10', 1, 2, '2019-03-10 00:00:10');
insert into user_tests (title, test_id, user_id, `date`) values ('z_test11', 1, 2, '2019-03-10 00:00:11');
insert into user_tests (title, test_id, user_id, `date`) values ('z_test12', 1, 2, '2019-03-10 00:00:12');
insert into user_tests (title, test_id, user_id, `date`) values ('z_test13', 1, 2, '2019-03-10 00:00:13');
insert into user_tests (title, test_id, user_id, `date`) values ('z_test14', 1, 2, '2019-03-10 00:00:14');
insert into user_tests (title, test_id, user_id, `date`) values ('z_test15', 1, 2, '2019-03-10 00:00:15');
insert into user_tests (title, test_id, user_id, `date`) values ('z_test16', 1, 2, '2019-03-10 00:00:16');
insert into user_tests (title, test_id, user_id, `date`) values ('z_test17', 1, 2, '2019-03-10 00:00:17');
insert into user_tests (title, test_id, user_id, `date`) values ('z_test18', 1, 2, '2019-03-10 00:00:18');
insert into user_tests (title, test_id, user_id, `date`) values ('z_test19', 1, 2, '2019-03-10 00:00:19');
insert into user_tests (title, test_id, user_id, `date`) values ('z_test20', 1, 2, '2019-03-10 00:00:20');



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

    -- user test questions for addition user tests...
insert into user_testQuestions (userAnswer, testQuestion_id, user_Test_id) values ('a', 1, 7);
insert into user_testQuestions (userAnswer, testQuestion_id, user_Test_id) values ('a', 2, 7);

insert into user_testQuestions (userAnswer, testQuestion_id, user_Test_id) values ('1', 1, 8);
insert into user_testQuestions (userAnswer, testQuestion_id, user_Test_id) values ('a', 2, 8);

insert into user_testQuestions (userAnswer, testQuestion_id, user_Test_id) values ('a', 1, 9);
insert into user_testQuestions (userAnswer, testQuestion_id, user_Test_id) values ('2', 2, 9);

insert into user_testQuestions (userAnswer, testQuestion_id, user_Test_id) values ('1', 1, 10);
insert into user_testQuestions (userAnswer, testQuestion_id, user_Test_id) values ('2', 2, 10);

insert into user_testQuestions (userAnswer, testQuestion_id, user_Test_id) values ('1', 1, 11);
insert into user_testQuestions (userAnswer, testQuestion_id, user_Test_id) values ('a', 2, 11);

insert into user_testQuestions (userAnswer, testQuestion_id, user_Test_id) values ('a', 1, 12);
insert into user_testQuestions (userAnswer, testQuestion_id, user_Test_id) values ('2', 2, 12);

insert into user_testQuestions (userAnswer, testQuestion_id, user_Test_id) values ('1', 1, 13);
insert into user_testQuestions (userAnswer, testQuestion_id, user_Test_id) values ('a', 2, 13);

insert into user_testQuestions (userAnswer, testQuestion_id, user_Test_id) values ('a', 1, 14);
insert into user_testQuestions (userAnswer, testQuestion_id, user_Test_id) values ('a', 2, 14);

insert into user_testQuestions (userAnswer, testQuestion_id, user_Test_id) values ('1', 1, 15);
insert into user_testQuestions (userAnswer, testQuestion_id, user_Test_id) values ('2', 2, 15);

insert into user_testQuestions (userAnswer, testQuestion_id, user_Test_id) values ('1', 1, 16);
insert into user_testQuestions (userAnswer, testQuestion_id, user_Test_id) values ('a', 2, 16);
insert into user_testQuestions (userAnswer, testQuestion_id, user_Test_id) values ('3', 3, 16);
insert into user_testQuestions (userAnswer, testQuestion_id, user_Test_id) values ('4', 4, 16);

insert into user_testQuestions (userAnswer, testQuestion_id, user_Test_id) values ('1', 1, 17);
insert into user_testQuestions (userAnswer, testQuestion_id, user_Test_id) values ('a', 2, 17);
insert into user_testQuestions (userAnswer, testQuestion_id, user_Test_id) values ('3', 3, 17);
insert into user_testQuestions (userAnswer, testQuestion_id, user_Test_id) values ('4', 4, 17);

insert into user_testQuestions (userAnswer, testQuestion_id, user_Test_id) values ('1', 1, 18);
insert into user_testQuestions (userAnswer, testQuestion_id, user_Test_id) values ('a', 2, 18);
insert into user_testQuestions (userAnswer, testQuestion_id, user_Test_id) values ('3', 3, 18);
insert into user_testQuestions (userAnswer, testQuestion_id, user_Test_id) values ('4', 4, 18);

insert into user_testQuestions (userAnswer, testQuestion_id, user_Test_id) values ('a', 1, 19);
insert into user_testQuestions (userAnswer, testQuestion_id, user_Test_id) values ('a', 2, 19);
insert into user_testQuestions (userAnswer, testQuestion_id, user_Test_id) values ('3', 3, 19);
insert into user_testQuestions (userAnswer, testQuestion_id, user_Test_id) values ('4', 4, 19);

insert into user_testQuestions (userAnswer, testQuestion_id, user_Test_id) values ('a', 1, 20);
insert into user_testQuestions (userAnswer, testQuestion_id, user_Test_id) values ('a', 2, 20);
insert into user_testQuestions (userAnswer, testQuestion_id, user_Test_id) values ('a', 3, 20);
insert into user_testQuestions (userAnswer, testQuestion_id, user_Test_id) values ('a', 4, 20);

insert into user_testQuestions (userAnswer, testQuestion_id, user_Test_id) values ('a', 1, 21);
insert into user_testQuestions (userAnswer, testQuestion_id, user_Test_id) values ('a', 2, 21);
insert into user_testQuestions (userAnswer, testQuestion_id, user_Test_id) values ('3', 3, 21);
insert into user_testQuestions (userAnswer, testQuestion_id, user_Test_id) values ('a', 4, 21);

insert into user_testQuestions (userAnswer, testQuestion_id, user_Test_id) values ('1', 1, 22);
insert into user_testQuestions (userAnswer, testQuestion_id, user_Test_id) values ('2', 2, 22);
insert into user_testQuestions (userAnswer, testQuestion_id, user_Test_id) values ('3', 3, 22);
insert into user_testQuestions (userAnswer, testQuestion_id, user_Test_id) values ('4', 4, 22);

insert into user_testQuestions (userAnswer, testQuestion_id, user_Test_id) values ('1', 1, 23);
insert into user_testQuestions (userAnswer, testQuestion_id, user_Test_id) values ('2', 2, 23);
insert into user_testQuestions (userAnswer, testQuestion_id, user_Test_id) values ('3', 3, 23);
insert into user_testQuestions (userAnswer, testQuestion_id, user_Test_id) values ('4', 4, 23);

insert into user_testQuestions (userAnswer, testQuestion_id, user_Test_id) values ('1', 1, 24);
insert into user_testQuestions (userAnswer, testQuestion_id, user_Test_id) values ('a', 2, 24);
insert into user_testQuestions (userAnswer, testQuestion_id, user_Test_id) values ('3', 3, 24);
insert into user_testQuestions (userAnswer, testQuestion_id, user_Test_id) values ('4', 4, 24);

insert into user_testQuestions (userAnswer, testQuestion_id, user_Test_id) values ('a', 1, 25);
insert into user_testQuestions (userAnswer, testQuestion_id, user_Test_id) values ('a', 2, 25);
insert into user_testQuestions (userAnswer, testQuestion_id, user_Test_id) values ('3', 3, 25);
insert into user_testQuestions (userAnswer, testQuestion_id, user_Test_id) values ('4', 4, 25);

insert into user_testQuestions (userAnswer, testQuestion_id, user_Test_id) values ('1', 1, 26);
insert into user_testQuestions (userAnswer, testQuestion_id, user_Test_id) values ('a', 2, 26);
insert into user_testQuestions (userAnswer, testQuestion_id, user_Test_id) values ('a', 3, 26);
insert into user_testQuestions (userAnswer, testQuestion_id, user_Test_id) values ('4', 4, 26);





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
    -- empty groups for frontend testing purposes. (loading additional for list)
insert into groups (name, description) values ('z_group01', '');
insert into groups (name, description) values ('z_group02', '');
insert into groups (name, description) values ('z_group03', '');
insert into groups (name, description) values ('z_group04', '');
insert into groups (name, description) values ('z_group05', '');
insert into groups (name, description) values ('z_group06', '');
insert into groups (name, description) values ('z_group07', '');
insert into groups (name, description) values ('z_group08', '');
insert into groups (name, description) values ('z_group09', '');
insert into groups (name, description) values ('z_group10', '');
insert into groups (name, description) values ('z_group11', '');
insert into groups (name, description) values ('z_group12', '');
insert into groups (name, description) values ('z_group13', '');
insert into groups (name, description) values ('z_group14', '');
insert into groups (name, description) values ('z_group15', '');
insert into groups (name, description) values ('z_group16', '');
insert into groups (name, description) values ('z_group17', '');
insert into groups (name, description) values ('z_group18', '');
insert into groups (name, description) values ('z_group19', '');
insert into groups (name, description) values ('z_group20', '');



insert into user_groups (user_id, group_id) values (1, 1);
insert into user_groups (user_id, group_id) values (2, 1);
insert into user_groups (user_id, group_id) values (4, 1);

insert into user_groups (user_id, group_id) values (2, 2);
insert into user_groups (user_id, group_id) values (5, 2);
insert into user_groups (user_id, group_id) values (6, 2);

insert into user_groups (user_id, group_id) values (4, 3);
insert into user_groups (user_id, group_id) values (5, 3);
insert into user_groups (user_id, group_id) values (6, 3);
    -- Add users 2 and 8 to group 4 for testing purposes.
insert into user_groups (user_id, group_id) values (2, 4);
insert into user_groups (user_id, group_id) values (8, 4);



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



    -- Additional messages for frontend testing.
-- between user 2 and 7
insert into messages (message, `date`, sender_id) values ('test_msg_01', '2019-01-01 12:00:00', 2); -- 51
insert into messages (message, `date`, sender_id) values ('test_msg_02', '2019-01-01 12:00:01', 2);
insert into messages (message, `date`, sender_id) values ('test_msg_03', '2019-01-01 12:00:02', 8);
insert into messages (message, `date`, sender_id) values ('test_msg_04', '2019-01-01 12:00:03', 8);
insert into messages (message, `date`, sender_id) values ('test_msg_05', '2019-01-01 12:00:04', 8);
insert into messages (message, `date`, sender_id) values ('test_msg_06', '2019-01-01 12:00:05', 8);
insert into messages (message, `date`, sender_id) values ('test_msg_07', '2019-01-01 12:00:06', 8);
insert into messages (message, `date`, sender_id) values ('test_msg_08', '2019-01-01 12:00:07', 8);
insert into messages (message, `date`, sender_id) values ('test_msg_09', '2019-01-01 12:00:08', 8);
insert into messages (message, `date`, sender_id) values ('test_msg_10', '2019-01-01 12:00:09', 2);
insert into messages (message, `date`, sender_id) values ('test_msg_11', '2019-01-01 12:00:10', 8);
insert into messages (message, `date`, sender_id) values ('test_msg_12', '2019-01-01 12:00:11', 8);
insert into messages (message, `date`, sender_id) values ('test_msg_13', '2019-01-01 12:00:12', 2);
insert into messages (message, `date`, sender_id) values ('test_msg_14', '2019-01-01 12:00:13', 2);
insert into messages (message, `date`, sender_id) values ('test_msg_15', '2019-01-01 12:00:14', 2);
insert into messages (message, `date`, sender_id) values ('test_msg_16', '2019-01-01 12:00:15', 2);
insert into messages (message, `date`, sender_id) values ('test_msg_17', '2019-01-01 12:00:16', 8);
insert into messages (message, `date`, sender_id) values ('test_msg_18', '2019-01-01 12:00:17', 2);
insert into messages (message, `date`, sender_id) values ('test_msg_19', '2019-01-01 12:00:18', 8);
insert into messages (message, `date`, sender_id) values ('test_msg_20', '2019-01-01 12:00:19', 2);
insert into messages (message, `date`, sender_id) values ('test_msg_21', '2019-01-01 12:00:20', 2);
insert into messages (message, `date`, sender_id) values ('test_msg_22', '2019-01-01 12:00:21', 8);
insert into messages (message, `date`, sender_id) values ('test_msg_23', '2019-01-01 12:00:22', 2);
insert into messages (message, `date`, sender_id) values ('test_msg_24', '2019-01-01 12:00:23', 8);
insert into messages (message, `date`, sender_id) values ('test_msg_25', '2019-01-01 12:00:24', 8); -- 75

insert into user_messages (message_id, user_id) values (51, 8);
insert into user_messages (message_id, user_id) values (52, 8);
insert into user_messages (message_id, user_id) values (53, 2);
insert into user_messages (message_id, user_id) values (54, 2);
insert into user_messages (message_id, user_id) values (55, 2);
insert into user_messages (message_id, user_id) values (56, 2);
insert into user_messages (message_id, user_id) values (57, 2);
insert into user_messages (message_id, user_id) values (58, 2);
insert into user_messages (message_id, user_id) values (59, 2);
insert into user_messages (message_id, user_id) values (60, 8);
insert into user_messages (message_id, user_id) values (61, 2);
insert into user_messages (message_id, user_id) values (62, 2);
insert into user_messages (message_id, user_id) values (63, 8);
insert into user_messages (message_id, user_id) values (64, 8);
insert into user_messages (message_id, user_id) values (65, 8);
insert into user_messages (message_id, user_id) values (66, 8);
insert into user_messages (message_id, user_id) values (67, 2);
insert into user_messages (message_id, user_id) values (68, 8);
insert into user_messages (message_id, user_id) values (69, 2);
insert into user_messages (message_id, user_id) values (70, 8);
insert into user_messages (message_id, user_id) values (71, 8);
insert into user_messages (message_id, user_id) values (72, 2);
insert into user_messages (message_id, user_id) values (73, 8);
insert into user_messages (message_id, user_id) values (74, 2);
insert into user_messages (message_id, user_id) values (75, 2);

-- between group 4 (2, 8)
insert into messages (message, `date`, sender_id) values ('test_msg_100', '2019-01-01 12:00:00', 2); -- 76
insert into messages (message, `date`, sender_id) values ('test_msg_101', '2019-01-01 12:00:01', 2);
insert into messages (message, `date`, sender_id) values ('test_msg_102', '2019-01-01 12:00:02', 8);
insert into messages (message, `date`, sender_id) values ('test_msg_103', '2019-01-01 12:00:03', 8);
insert into messages (message, `date`, sender_id) values ('test_msg_104', '2019-01-01 12:00:04', 2);
insert into messages (message, `date`, sender_id) values ('test_msg_105', '2019-01-01 12:00:05', 2);
insert into messages (message, `date`, sender_id) values ('test_msg_106', '2019-01-01 12:00:06', 2);
insert into messages (message, `date`, sender_id) values ('test_msg_107', '2019-01-01 12:00:07', 2);
insert into messages (message, `date`, sender_id) values ('test_msg_108', '2019-01-01 12:00:08', 8);
insert into messages (message, `date`, sender_id) values ('test_msg_109', '2019-01-01 12:00:09', 8);
insert into messages (message, `date`, sender_id) values ('test_msg_110', '2019-01-01 12:00:10', 2);
insert into messages (message, `date`, sender_id) values ('test_msg_111', '2019-01-01 12:00:11', 2);
insert into messages (message, `date`, sender_id) values ('test_msg_112', '2019-01-01 12:00:12', 2);
insert into messages (message, `date`, sender_id) values ('test_msg_113', '2019-01-01 12:00:13', 2);
insert into messages (message, `date`, sender_id) values ('test_msg_114', '2019-01-01 12:00:14', 2);
insert into messages (message, `date`, sender_id) values ('test_msg_115', '2019-01-01 12:00:15', 8);
insert into messages (message, `date`, sender_id) values ('test_msg_116', '2019-01-01 12:00:16', 8);
insert into messages (message, `date`, sender_id) values ('test_msg_117', '2019-01-01 12:00:17', 8);
insert into messages (message, `date`, sender_id) values ('test_msg_118', '2019-01-01 12:00:18', 2);
insert into messages (message, `date`, sender_id) values ('test_msg_119', '2019-01-01 12:00:19', 8);
insert into messages (message, `date`, sender_id) values ('test_msg_120', '2019-01-01 12:00:20', 8);
insert into messages (message, `date`, sender_id) values ('test_msg_121', '2019-01-01 12:00:21', 2);
insert into messages (message, `date`, sender_id) values ('test_msg_122', '2019-01-01 12:00:22', 2);
insert into messages (message, `date`, sender_id) values ('test_msg_123', '2019-01-01 12:00:23', 2);
insert into messages (message, `date`, sender_id) values ('test_msg_124', '2019-01-01 12:00:24', 8); -- 100

insert into group_messages (message_id, group_id) values (76, 4);
insert into group_messages (message_id, group_id) values (77, 4);
insert into group_messages (message_id, group_id) values (78, 4);
insert into group_messages (message_id, group_id) values (79, 4);
insert into group_messages (message_id, group_id) values (80, 4);
insert into group_messages (message_id, group_id) values (81, 4);
insert into group_messages (message_id, group_id) values (82, 4);
insert into group_messages (message_id, group_id) values (83, 4);
insert into group_messages (message_id, group_id) values (84, 4);
insert into group_messages (message_id, group_id) values (85, 4);
insert into group_messages (message_id, group_id) values (86, 4);
insert into group_messages (message_id, group_id) values (87, 4);
insert into group_messages (message_id, group_id) values (88, 4);
insert into group_messages (message_id, group_id) values (89, 4);
insert into group_messages (message_id, group_id) values (90, 4);
insert into group_messages (message_id, group_id) values (91, 4);
insert into group_messages (message_id, group_id) values (92, 4);
insert into group_messages (message_id, group_id) values (93, 4);
insert into group_messages (message_id, group_id) values (94, 4);
insert into group_messages (message_id, group_id) values (95, 4);
insert into group_messages (message_id, group_id) values (96, 4);
insert into group_messages (message_id, group_id) values (97, 4);
insert into group_messages (message_id, group_id) values (98, 4);
insert into group_messages (message_id, group_id) values (99, 4);
insert into group_messages (message_id, group_id) values (100, 4);