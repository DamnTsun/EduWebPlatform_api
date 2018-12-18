
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



-- Users
INSERT INTO Users (displayName, admin, banned) VALUES ('BobRoss67', DEFAULT, DEFAULT);
INSERT INTO Users (displayName, admin, banned) VALUES ('ExplodingWombat', DEFAULT, DEFAULT);
INSERT INTO Users (displayName, admin, banned) VALUES ('Shuckle', DEFAULT, DEFAULT);
INSERT INTO Users (displayName, admin, banned) VALUES ('I am the 3rd impact', DEFAULT, DEFAULT);
INSERT INTO Users (displayName, admin, banned) VALUES (DEFAULT, DEFAULT, DEFAULT);
INSERT INTO Users (displayName, admin, banned) VALUES (DEFAULT, DEFAULT, DEFAULT);
INSERT INTO Users (displayName, admin, banned) VALUES ('NeverDoMath', true, DEFAULT);
INSERT INTO Users (displayName, admin, banned) VALUES ('Onizuka', true, DEFAULT);
INSERT INTO Users (displayName, admin, banned) VALUES (DEFAULT, DEFAULT, true);
INSERT INTO Users (displayName, admin, banned) VALUES (DEFAULT, DEFAULT, true);

-- Posts
INSERT INTO Posts (title, body, subject_id, `user_id`) VALUES ('Maths is thrilling.', 'I actually put real text in this post.', 1, 7);
INSERT INTO Posts (title, body, subject_id, `user_id`) VALUES ('Just updated something', 'And I added: Absolutely nothing of value.', 1, 7);
INSERT INTO Posts (title, body, subject_id, `user_id`) VALUES ('Anothing update', 'Adding real text sure does take a lot of effort...', 1, 7);
INSERT INTO Posts (title, body, subject_id, `user_id`) VALUES ('Placeholder post', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris auctor nisi at augue sagittis rutrum. Etiam eu pharetra ante. Phasellus eget enim sed tellus rhoncus bibendum. Fusce a mi tellus. Nullam condimentum risus vel condimentum porttitor. In eros nisi, interdum vel nunc vel, pharetra suscipit erat. Cras maximus bibendum suscipit. Etiam placerat nulla sem, quis rhoncus lacus posuere a. Cras lobortis, lectus in semper consequat, massa purus malesuada elit, eu suscipit urna massa id ligula.', 1, 8);
INSERT INTO Posts (title, body, subject_id, `user_id`) VALUES ('Placeholder 2.0', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec accumsan ex vel accumsan sollicitudin. Pellentesque sit amet pharetra dui. Nunc sit amet lacus maximus, luctus metus nec, laoreet nulla. Morbi dui justo, maximus feugiat congue in, fermentum in diam. Nam nec est sit amet nunc elementum auctor. Maecenas elementum semper lacus, et malesuada mi porttitor eu. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Vestibulum consequat facilisis nulla, eget rutrum elit feugiat id. Curabitur sed venenatis ante. Morbi lacinia varius consequat. In hac habitasse platea dictumst. Cras mattis commodo varius.', 1, 8);

INSERT INTO Posts (title, body, subject_id, `user_id`) VALUES ('Placeholder English Language 1', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent id luctus neque. Nam vel eros id velit bibendum imperdiet. Cras a lacus ut ex hendrerit gravida. Duis semper quam urna, et varius ante varius eu. Fusce elementum, magna eget imperdiet porttitor, justo odio scelerisque tellus, eu ultrices ipsum ligula et diam. Nullam sollicitudin quis tellus vel blandit. Quisque sit amet mattis erat. Nullam lobortis lectus ac orci gravida, a tempus ligula pellentesque. Suspendisse ac quam non massa auctor posuere a non mi. Duis fermentum eros dui. Ut lorem neque, fringilla sed diam ut, tincidunt tincidunt sapien. Pellentesque sed vulputate augue. Sed eget iaculis augue.', 2, 7);
INSERT INTO Posts (title, body, subject_id, `user_id`) VALUES ('Placeholder English Language 2', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin finibus dolor at commodo tincidunt. In mollis risus vitae massa scelerisque bibendum. Nullam hendrerit bibendum lacus, quis finibus enim eleifend non. Donec eleifend leo erat, vitae ornare mauris fringilla aliquet. Vestibulum porta nunc metus, a sollicitudin ligula ultricies eleifend. Nam ut dictum augue. Maecenas nec ligula leo. Suspendisse ut sagittis metus. Proin vitae sodales ligula. Cras in sapien ullamcorper, commodo nisi ac, vulputate massa. Vivamus euismod dui lorem, vitae vulputate arcu blandit id. Aliquam luctus pretium orci a ultrices. Proin vitae sollicitudin velit. Pellentesque condimentum hendrerit lacus quis fermentum. Vivamus convallis laoreet pellentesque. Fusce quis tempor urna, eu fermentum mauris.', 2, 7);
INSERT INTO Posts (title, body, subject_id, `user_id`) VALUES ('Placeholder English Language 3', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum porta convallis lorem, quis ultrices mauris ultricies eget. Integer mollis ornare enim, in placerat felis finibus ac. Cras sit amet tellus id est ultrices tempus. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Aenean quis velit ante. In viverra aliquam finibus. Phasellus a dui nulla. Interdum et malesuada fames ac ante ipsum primis in faucibus. Proin sagittis ullamcorper est, eget viverra massa. Aenean tristique, velit ut euismod commodo, odio mauris fringilla urna, at ullamcorper dolor ligula quis diam. Quisque fermentum ut neque eu lacinia. Donec iaculis massa eu lacus euismod, efficitur fermentum leo venenatis. Quisque posuere in odio id interdum.', 2, 7);
INSERT INTO Posts (title, body, subject_id, `user_id`) VALUES ('Placeholder English Language 4', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce facilisis at turpis vel vestibulum. Curabitur semper mattis urna id vehicula. Etiam dapibus, erat vel volutpat pretium, est massa imperdiet erat, sed tincidunt nisl arcu ac nulla. Quisque pulvinar turpis viverra sem vestibulum, quis suscipit lacus porttitor. Donec luctus et est sed placerat. Ut arcu nibh, cursus id sem ut, pulvinar ullamcorper metus. Praesent volutpat molestie leo non efficitur. Curabitur suscipit aliquam eros sit amet pretium. Fusce congue libero non risus consectetur, et bibendum ipsum eleifend. Maecenas ut scelerisque massa. Etiam ultricies aliquet ligula aliquet dignissim. Pellentesque et nunc id ipsum vehicula pharetra nec in felis.', 2, 7);
INSERT INTO Posts (title, body, subject_id, `user_id`) VALUES ('Placeholder English Language 5', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse tortor elit, vestibulum et lacus quis, ultricies ornare magna. Aenean consequat congue diam, id vehicula augue. Vestibulum ac augue sodales, euismod nulla sed, lobortis leo. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vivamus porta ut ex eu tristique. Etiam facilisis, risus a tincidunt condimentum, ante ligula lacinia enim, id iaculis diam risus ut ante. Nullam tristique vulputate eros at vestibulum. Nulla vel dictum leo, dignissim blandit purus. Quisque tempus mauris a nulla vehicula, sit amet auctor diam fermentum. Pellentesque aliquet velit nisl, id interdum leo viverra eget. Donec sit amet ex magna. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam in quam iaculis, cursus leo non, scelerisque nunc.', 2, 8);

INSERT INTO Posts (title, body, subject_id, `user_id`) VALUES ('Placeholder Physics 1', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras lacinia lorem eu pulvinar porta. Nam volutpat justo nec ex fermentum faucibus. Morbi tristique lacinia odio, eget placerat nulla sodales eleifend. Mauris vel orci at dolor tincidunt ultricies a vel ex. Pellentesque non leo consequat, volutpat odio id, porta dui. Nunc sollicitudin nulla sed tellus sagittis, a placerat augue bibendum. Sed mollis lorem dui, vel faucibus nulla aliquet et. Curabitur hendrerit placerat mi, ac porta nisl ultricies vitae. Aenean malesuada imperdiet tellus ut convallis. Vestibulum at ex aliquam, fringilla nibh quis, porta libero. Etiam aliquam rhoncus arcu, sit amet gravida dui tincidunt a. Nulla at pulvinar lorem, tincidunt commodo nulla. Integer pharetra lectus vel turpis scelerisque consequat. Nunc porta quam molestie, sodales nibh sed, suscipit nunc.', 3, 7);
INSERT INTO Posts (title, body, subject_id, `user_id`) VALUES ('Placeholder Physics 2', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut ut nisl mattis, ultricies ligula in, condimentum leo. Donec porta tellus faucibus metus malesuada condimentum. Sed a varius lacus. Aenean pretium ligula a varius iaculis. Duis dictum mi sit amet massa euismod volutpat. Donec maximus convallis consectetur. Suspendisse placerat scelerisque elit eu vehicula. Mauris porttitor lorem eget elit molestie congue. Vestibulum malesuada at lectus ac pretium. Nullam rutrum, massa quis pulvinar egestas, neque leo faucibus libero, sit amet imperdiet est ipsum accumsan nulla. Mauris convallis massa et dictum condimentum. Duis posuere ante in risus ornare iaculis. Donec mauris tellus, convallis non arcu eget, condimentum imperdiet erat.', 3, 8);
INSERT INTO Posts (title, body, subject_id, `user_id`) VALUES ('Placeholder Physics 3', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec ut sapien tempor, aliquam neque id, auctor ex. Morbi quis urna nec enim euismod aliquam. Curabitur vitae bibendum mi, nec convallis nulla. Ut ac elit varius, placerat mauris ac, fermentum purus. In odio tellus, vulputate vitae augue ac, porttitor ornare turpis. Vestibulum accumsan leo ut luctus sodales. Vestibulum venenatis vulputate dolor, vel volutpat velit mollis vitae. Quisque sed pharetra augue. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Suspendisse hendrerit varius sapien, et porttitor libero tincidunt eget. Suspendisse sodales bibendum enim, lacinia efficitur tortor pellentesque eu. Vestibulum et scelerisque tortor. Praesent pretium eleifend odio quis porta. Nullam sed pretium quam.', 3, 8);
INSERT INTO Posts (title, body, subject_id, `user_id`) VALUES ('Placeholder Physics 4', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam a tellus libero. Pellentesque ut lorem quis neque ullamcorper placerat non vel eros. Sed pharetra arcu pellentesque rhoncus facilisis. Phasellus eleifend, lectus sit amet porta luctus, neque nibh varius est, sed sagittis nisi velit id nisl. Vivamus tempus et libero at bibendum. Aliquam quis arcu arcu. Duis rutrum quam ac vestibulum varius. Sed accumsan rutrum maximus. In ultricies vitae mi ac auctor. Aenean laoreet dignissim lectus. Nam dui lorem, tristique non mollis non, vestibulum at nunc. Ut lobortis ligula quis posuere faucibus. Aenean gravida, orci nec venenatis convallis, ipsum urna facilisis massa, ut consectetur ipsum sem efficitur velit. Nunc vel enim enim. Ut tincidunt facilisis tellus, id finibus dolor facilisis eu. Sed non sagittis quam.', 3, 8);
INSERT INTO Posts (title, body, subject_id, `user_id`) VALUES ('Placeholder Physics 5', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent ipsum elit, consequat non eleifend quis, sollicitudin a mauris. In hac habitasse platea dictumst. Nulla varius, risus non posuere vestibulum, sem velit bibendum massa, nec sollicitudin tortor risus non mauris. Duis mattis est non elementum malesuada. Curabitur scelerisque nulla sit amet libero tincidunt commodo. Duis eu erat varius, efficitur libero quis, pretium ante. Proin at orci sit amet felis consequat rutrum. Maecenas bibendum nulla et lorem scelerisque lacinia. Fusce ut urna nunc.', 3, 8);

INSERT INTO Posts (title, body, subject_id, `user_id`) VALUES ('Placeholder Citizenship 1', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent vulputate dui vitae lacus aliquam dictum. Praesent tempus felis eu erat pharetra dictum. Integer viverra, eros non gravida condimentum, enim massa molestie diam, vel imperdiet justo tortor vitae arcu. Donec et justo justo. Etiam lacinia placerat elit sit amet tempus. Curabitur semper ultrices mauris eget accumsan. Nunc magna lorem, vestibulum non tortor vel, pretium dictum arcu.', 4, 8);
INSERT INTO Posts (title, body, subject_id, `user_id`) VALUES ('Placeholder Citizenship 2', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam ullamcorper diam leo, eget consectetur nibh bibendum ut. Vestibulum tincidunt orci ac massa tempor, non congue purus aliquet. Pellentesque purus ipsum, dignissim ac nisl ac, lacinia finibus odio. Duis porttitor ex ex, lacinia aliquet libero pretium non. Etiam non placerat lorem. Nulla at dolor faucibus leo posuere aliquet eget convallis tortor. Morbi id porttitor nibh, in tincidunt elit. Curabitur vitae lacus venenatis, ultrices odio vel, sollicitudin diam. Donec in iaculis enim. Donec et turpis eu massa sodales mollis. Donec laoreet ornare ex quis egestas. Curabitur vulputate diam eu nisi blandit imperdiet. Curabitur vitae odio fermentum, facilisis arcu ac, interdum eros. Nam mollis cursus suscipit. Nulla luctus enim sit amet vestibulum faucibus. Duis eu facilisis purus.', 4, 7);
INSERT INTO Posts (title, body, subject_id, `user_id`) VALUES ('Placeholder Citizenship 3', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris facilisis, lacus in aliquet elementum, sapien quam tincidunt erat, ac dapibus enim turpis vel mi. Etiam vehicula risus eget erat tempor, et malesuada turpis mattis. Vivamus porta enim et metus sollicitudin porta. Quisque nibh libero, iaculis vel metus sed, pulvinar aliquam massa. Pellentesque diam diam, molestie at ligula non, pretium finibus velit. Curabitur cursus ornare nulla vitae consequat. Nulla tempor eros in dui posuere auctor. Phasellus in leo malesuada lorem ornare egestas. Nullam lacinia, nulla eget laoreet commodo, est neque pretium lorem, at blandit nunc nisl ac libero. Duis pulvinar odio nibh, non dapibus mi hendrerit sit amet. Suspendisse non sapien tincidunt, molestie elit eget, tristique massa. Duis scelerisque placerat sapien. Mauris tristique est ornare mauris convallis, quis lacinia ligula venenatis. Nulla sit amet justo sit amet massa egestas mattis.', 4, 8);
INSERT INTO Posts (title, body, subject_id, `user_id`) VALUES ('Placeholder Citizenship 4', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis tincidunt eget mi ac feugiat. Maecenas fermentum libero in leo egestas porta. Duis ultricies congue tristique. Nam ultrices dui a quam mattis, quis condimentum neque venenatis. Duis a porta nunc, at condimentum diam. Duis vitae urna orci. Praesent tempus nisi et elit eleifend, ut ultricies neque vehicula. In egestas porttitor nunc. Mauris elementum imperdiet consequat. Maecenas laoreet erat vel neque semper, id porttitor sem tristique. Aliquam purus dui, interdum quis pellentesque non, placerat ut mi. Etiam sed eros posuere odio ullamcorper sollicitudin.', 4, 8);
INSERT INTO Posts (title, body, subject_id, `user_id`) VALUES ('Placeholder Citizenship 5', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas sed ornare eros. Vivamus diam nisi, aliquet nec varius eu, porta id nisl. Praesent non elit dui. Vivamus eget convallis mi, vitae cursus lacus. Suspendisse potenti. Duis tincidunt interdum sapien, et scelerisque orci ullamcorper id. Vivamus ultrices enim enim, eget rhoncus nibh auctor vitae. Morbi ornare molestie felis eget venenatis. Aenean vitae lectus non est efficitur volutpat sit amet quis mi. Donec vitae velit sed libero ornare aliquet id in ante. Pellentesque tristique lacus nec neque laoreet, nec efficitur nibh faucibus. Sed molestie purus in massa pellentesque maximus.', 4, 7);
