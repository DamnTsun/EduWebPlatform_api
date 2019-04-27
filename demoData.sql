use EduWebApp;

-- Test users
--  real
INSERT INTO users (displayName, socialMediaID, socialMediaProvider_id, privilegeLevel_id) VALUES ('Scott, the normie', '102562326633765021134', 1, 1); -- Google account, normal.
INSERT INTO users (displayName, socialMediaID, socialMediaProvider_id, privilegeLevel_id) VALUES ('Scott, the admin', '117929523951432123072', 1, 2); -- Google account, admin.
INSERT INTO users (displayName, socialMediaID, socialMediaProvider_id, privilegeLevel_id) VALUES ('Scott, the banned', '111865521247464378466', 1, 3); -- Google account, banned.
INSERT INTO users (displayName, socialMediaID, socialMediaProvider_id, privilegeLevel_id) VALUES ('Facebook dude', '2246571735353343', 2, 1); -- Facebook account, normal.
--  fake
--    regular
INSERT INTO users (socialMediaID, socialMediaProvider_id, privilegeLevel_id) VALUES ('google_regular_01', 1, 1);
INSERT INTO users (socialMediaID, socialMediaProvider_id, privilegeLevel_id) VALUES ('google_regular_02', 1, 1);
INSERT INTO users (socialMediaID, socialMediaProvider_id, privilegeLevel_id) VALUES ('google_regular_03', 1, 1);
INSERT INTO users (socialMediaID, socialMediaProvider_id, privilegeLevel_id) VALUES ('google_regular_04', 1, 1);
INSERT INTO users (socialMediaID, socialMediaProvider_id, privilegeLevel_id) VALUES ('google_regular_05', 1, 1);
INSERT INTO users (socialMediaID, socialMediaProvider_id, privilegeLevel_id) VALUES ('google_regular_06', 1, 1);
INSERT INTO users (socialMediaID, socialMediaProvider_id, privilegeLevel_id) VALUES ('google_regular_07', 1, 1);
INSERT INTO users (socialMediaID, socialMediaProvider_id, privilegeLevel_id) VALUES ('google_regular_08', 1, 1);
INSERT INTO users (socialMediaID, socialMediaProvider_id, privilegeLevel_id) VALUES ('google_regular_09', 1, 1);
INSERT INTO users (socialMediaID, socialMediaProvider_id, privilegeLevel_id) VALUES ('google_regular_10', 1, 1);
INSERT INTO users (socialMediaID, socialMediaProvider_id, privilegeLevel_id) VALUES ('google_regular_11', 1, 1);
INSERT INTO users (socialMediaID, socialMediaProvider_id, privilegeLevel_id) VALUES ('google_regular_12', 1, 1);
INSERT INTO users (socialMediaID, socialMediaProvider_id, privilegeLevel_id) VALUES ('google_regular_13', 1, 1);
INSERT INTO users (socialMediaID, socialMediaProvider_id, privilegeLevel_id) VALUES ('google_regular_14', 1, 1);
INSERT INTO users (socialMediaID, socialMediaProvider_id, privilegeLevel_id) VALUES ('google_regular_15', 1, 1);
--    admin
INSERT INTO users (displayName, socialMediaID, socialMediaProvider_id, privilegeLevel_id) VALUES ('test_admin_01', 'google_admin_01', 1, 2);
INSERT INTO users (displayName, socialMediaID, socialMediaProvider_id, privilegeLevel_id) VALUES ('test_admin_02', 'google_admin_02', 1, 2);
INSERT INTO users (displayName, socialMediaID, socialMediaProvider_id, privilegeLevel_id) VALUES ('test_admin_03', 'google_admin_03', 1, 2);
INSERT INTO users (displayName, socialMediaID, socialMediaProvider_id, privilegeLevel_id) VALUES ('test_admin_04', 'google_admin_04', 1, 2);
INSERT INTO users (displayName, socialMediaID, socialMediaProvider_id, privilegeLevel_id) VALUES ('test_admin_05', 'google_admin_05', 1, 2);
--    banned
INSERT INTO users (socialMediaID, socialMediaProvider_id, privilegeLevel_id) VALUES ('google_banned_01', 1, 3);
INSERT INTO users (socialMediaID, socialMediaProvider_id, privilegeLevel_id) VALUES ('google_banned_02', 1, 3);
INSERT INTO users (socialMediaID, socialMediaProvider_id, privilegeLevel_id) VALUES ('google_banned_03', 1, 3);
INSERT INTO users (socialMediaID, socialMediaProvider_id, privilegeLevel_id) VALUES ('google_banned_04', 1, 3);
INSERT INTO users (socialMediaID, socialMediaProvider_id, privilegeLevel_id) VALUES ('google_banned_05', 1, 3);


-- Subjects
INSERT INTO subjects (name, description, hidden) values ('Mathematics', 'Contains topics covering basic mathematics.', 0);
INSERT INTO subjects (name, description, hidden) values ('zPlaceholder01', 'Placehold text placehold text placehold text placehold text placehold text placehold text placehold text placehold text placehold text placehold text placehold text ', 0);
INSERT INTO subjects (name, description, hidden) values ('zPlaceholder02', 'Placehold text placehold text placehold text placehold text placehold text placehold text placehold text placehold text placehold text placehold text placehold text ', 0);
INSERT INTO subjects (name, description, hidden) values ('zPlaceholder03', 'Placehold text placehold text placehold text placehold text placehold text placehold text placehold text placehold text placehold text placehold text placehold text ', 0);
INSERT INTO subjects (name, description, hidden) values ('zPlaceholder04', 'Placehold text placehold text placehold text placehold text placehold text placehold text placehold text placehold text placehold text placehold text placehold text ', 0);

-- Topics
INSERT INTO topics (name, description, subject_id, hidden) values ('Addition', 'Covers adding numbers together.', 1, 0);
INSERT INTO topics (name, description, subject_id, hidden) values ('Subtraction', 'Covers reducing one number by another.', 1, 0);
INSERT INTO topics (name, description, subject_id, hidden) values ('Multiplication', 'Covers multiplying numbers together.', 1, 0);

-- Lessons
--  Addition
INSERT INTO lessons (name, body, topic_id, hidden) values ('Addition (1 digit)', '<h1>To add two simple numbers together:</h1><ul><li>Add the numbers together:</li></ul><p><br></p><h2>E.g. 2 + 7</h2><p>2 + 7 = 9</p><p><br></p><h2>A harder example...</h2><p>6 + 7</p><p><br></p><ul><li>The result of 6 + 7 is over 10. If the result is greater than 10 then add a tick in front of the result.</li><li>Then for each tick, add 1 to the front of the number.</li></ul><p><br></p><p>E.g. 6 + 7</p><pre class="ql-syntax" spellcheck="false">  6 +
  7
---
\' 3
</pre><p><br></p><p>Now add a 1 in front of the number for each tick mark.</p><pre class="ql-syntax" spellcheck="false">\' 3
---
1 3
</pre><p><br></p><p>6 + 7 = 13.</p>', 1, 0);
INSERT INTO lessons (name, body, topic_id, hidden) values ('Addition (2 digit)', '<h1>Adding two larger numbers, e.g. 2 digit numbers:</h1><ul><li>Place the numbers above each other.</li><li>From the right, go over each column of numbers. E.g. 21 + 34, first go over 1 and 4, then 2 and 3.</li><li>Add each column of numbers and place the result below.</li><li>If then number is 10 or greater, then subtract 10 until the number is no longer 10 or greater.</li><li>For each 10 remove, add a tick mark to the next column.</li><li>Once all columns have been added, add 1 to each column for each tick mark it has.</li></ul><p><br></p><h2>E.g. 17 + 14</h2><p>Place numbers above each other:</p><pre class="ql-syntax" spellcheck="false">1 7 +
1 4
---
</pre><p><br></p><p>Add each column together, going from right to left:</p><pre class="ql-syntax" spellcheck="false">1 7 +
1 4
---
  11
</pre><p><br></p><p>11 is greater than 1! We must subtract 10s until it is less than 10.</p><p>11 - 10 is 1, so we must subtract 10 once. This results in a tick being added to the next column:</p><pre class="ql-syntax" spellcheck="false">1 7 +
1 4
---
\' 1
</pre><p><br></p><p>Now do the next column:</p><pre class="ql-syntax" spellcheck="false">1 7 +
1 4
---
2\'1
</pre><p><br></p><p>Now we have added each column!</p><p>But now we must add 1 to each column for each tick mark that the column has.</p><p>The right column has no tick mark, so nothing happens.</p><p>The left column has 1 tick mark, so 1 should be added to the column:</p><pre class="ql-syntax" spellcheck="false">2\'1
---
3 1
</pre><p><br></p><p>We now have the answer.</p><p>17 + 14 = 31.</p>', 1, 0);
INSERT INTO lessons (name, body, topic_id, hidden) values ('Addition (3 digit)', '<h1>Adding two larger numbers, e.g. 3 digit numbers:</h1><ul><li>Place the numbers above each other.</li><li>From the right, go over each column of numbers. E.g. 215 + 347, first go over 5 and 7, then 1 and 4, then 2 and 3.</li><li>Add each column of numbers and place the result below.</li><li>If then number is 10 or greater, then subtract 10 until the number is no longer 10 or greater.</li><li>For each 10 remove, add a tick mark to the next column.</li><li>Once all columns have been added, add 1 to each column for each tick mark it has.</li></ul><p><br></p><h2>E.g. 193 + 274</h2><p>Place numbers above each other:</p><pre class="ql-syntax" spellcheck="false">1 9 3 +
2 7 4
-----
</pre><p><br></p><p>Add each column together, going from right to left:</p><pre class="ql-syntax" spellcheck="false">1 9 3 +
2 7 4
-----
    7
</pre><p><br></p><p>7 is less than 10, so nothing happens.</p><p>Now add the next column:</p><pre class="ql-syntax" spellcheck="false">1 9 3 +
2 7 4
-----
  16 7
</pre><p><br></p><p>16 is 10 or greater, so we must subtract 10 until it is less than 10.</p><p>We must subtract 10 one time. While doing this, we should add 1 tick mark to the next column:</p><pre class="ql-syntax" spellcheck="false">1 9 3 +
2 7 4
-----
\' 6 7
</pre><p><br></p><p>Now add the final column:</p><pre class="ql-syntax" spellcheck="false">1 9 3 +
2 7 4
-----
3\'6 7
</pre><p><br></p><p>3 is less than 10, so nothing happens.</p><p><br></p><p>Now we must add 1 to each column for each tick mark that the column has:</p><pre class="ql-syntax" spellcheck="false">3\'6 7
-----
4 6 7
</pre><p><br></p><p>We now have the answer!</p><p>193 + 274 = 467.</p>', 1, 0);
--  Subtraction
INSERT INTO lessons (name, body, topic_id, hidden) values ('Subtraction (1 digit)', '<h1>How to subtract two simple numbers (1 digit)</h1><p><br></p><p>Simply subtract the second number from the first number:</p><p>E.g. 5 - 3 = 2</p><p>E.g. 7 - 1 = 6</p><p><br></p>', 2, 0);
INSERT INTO lessons (name, body, topic_id, hidden) values ('Subtraction (2 digit)', '<h1>How to subtract two larger numbers (2 digit)</h1><ul><li>Place the numbers above each other.</li><li>Working from right to left, go over each column and subtract the numbers.</li><li>If the result is less than 0, then you want to place a tick mark on the next column.</li><li>You want the numbers to \'wrap around 0\'. For example: 1 - 3 should give you 8, with you placing a tick mark on the next column.</li><li>After all columns have been covered, you want to subtract 1 from each column for each tick mark.</li></ul><p><br></p><h2>E.g. 54 - 37</h2><p><strong>Place the numbers above each other:</strong></p><pre class="ql-syntax" spellcheck="false">5 4 -
3 7
---

</pre><p><br></p><p><strong>Subtract the columns from right to left. Remember to wrap the result around at 0 if the result is less than 0.</strong></p><pre class="ql-syntax" spellcheck="false">5 4 -
3 7
---
\' 7
</pre><p>Since 4 - 7 was below 0, we have wrapped it around 0.</p><p>Consider 14 - 7. The result is 7.</p><p>Since the result was below 0, we have added a tick mark to the next column.</p><p><br></p><p><strong>Now subtract the next column:</strong></p><pre class="ql-syntax" spellcheck="false">5 4 -
3 7
---
2\'7
</pre><p><br></p><p><strong>Now subtract 1 from each column for each tick mark:</strong></p><pre class="ql-syntax" spellcheck="false">2\'7
---
1 7
</pre><p><br></p><p>The result is 17.</p><p>54 - 37 = 17.</p>', 2, 0);
INSERT INTO lessons (name, body, topic_id, hidden) values ('Subtraction (3 digit)', '<h1>How to subtract two larger numbers (3 digit)</h1><ul><li>Place the numbers above each other.</li><li>Working from right to left, go over each column and subtract the numbers.</li><li>If the result is less than 0, then you want to place a tick mark on the next column.</li><li>You want the numbers to \'wrap around 0\'. For example: 1 - 3 should give you 8, with you placing a tick mark on the next column.</li><li>After all columns have been covered, you want to subtract 1 from each column for each tick mark.</li></ul><p><br></p><h2>E.g. 362 - 144</h2><p><strong>Place the numbers above each other:</strong></p><pre class="ql-syntax" spellcheck="false">3 6 2 -
1 4 4
-----

</pre><p><br></p><p><strong>Subtract the columns from right to left. Remember to wrap the result around at 0 if the result is less than 0.</strong></p><pre class="ql-syntax" spellcheck="false">3 6 2 -
1 4 4
-----
  \' 8
</pre><p>Since 2 - 4 was below 0, we have wrapped it around 0.</p><p>Consider 12 - 4. The result is 8.</p><p>Since the result was below 0, we have added a tick mark to the next column.</p><p><br></p><p><strong>Now subtract the next column:</strong></p><pre class="ql-syntax" spellcheck="false">3 6 2 -
1 4 4
-----
  2\'8
</pre><p>Since 6 - 4 is 0 or greater, nothing happens.</p><p><br></p><p><strong>Now subtract the last column:</strong></p><pre class="ql-syntax" spellcheck="false">3 6 2 -
1 4 4
-----
2 2\'8
</pre><p>Since 3 - 1 is 0 or greater, nothing happens.</p><p><br></p><p><strong>Now subtract 1 from each column for each tick mark:</strong></p><pre class="ql-syntax" spellcheck="false">2 2\'8
-----
2 1 8
</pre><p><br></p><p>The result is 218.</p><p>362 - 144 = 218.</p>', 2, 0);
--  Multiplication
INSERT INTO lessons (name, body, topic_id, hidden) values ('Multiplication (1 digit)', '<h1>How to multiply simple numbers together (1 digit)</h1><ul><li>Take the first number the second number of times.</li><li>Simply add the number to itself for the second number number of times.</li></ul><p><br></p><h2>E.g. 3 x 5</h2><p><br></p><p>Take the first number the second number number of times:</p><p>3 + 3 + 3 + 3 + 3</p><p><br></p><p>3 + 3 + 3 + 3 + 3 = 15.</p><p>So 3 x 5 = 15.</p>', 3, 0);
INSERT INTO lessons (name, body, topic_id, hidden) values ('Multiplication (2 digit)', '<h1>How to multiply larger numbers together (2 digit)</h1><ul><li>Split the second number into groups based on their size. E.g for 25 x 13, split 13 into 10 and 3.</li><li>Multiply the first number by both of the second numbers. E.g. for 25 x 13, do 25 x 10 = 250, and 25 x 3 = 75</li><li>Add the numbers together. E.g. 250 + 75 = 325.</li></ul><p><br></p><h2>E.g. 23 x 14</h2><p><strong>Split the second number:</strong></p><pre class="ql-syntax" spellcheck="false">14 -&gt; 10, 4.
</pre><p><br></p><p><strong>Multiply the first number by the split numbers:</strong></p><pre class="ql-syntax" spellcheck="false">10 x 23 = 230
 4 x 23 =  92
</pre><p><br></p><p><strong>Add the results together:</strong></p><p>First column</p><pre class="ql-syntax" spellcheck="false">2 3 0
  9 2
-----
    2
</pre><p>Second column</p><pre class="ql-syntax" spellcheck="false">2 3 0
  9 2
-----
\' 2 2
</pre><p>Last column</p><pre class="ql-syntax" spellcheck="false">2 3 0
  9 2
-----
3 2 2
</pre><p><br></p><p>The result is 322.</p><p>23 x 14 = 322.</p>', 3, 0);
INSERT INTO lessons (name, body, topic_id, hidden) values ('Multiplication (3 digit)', '<h1>How to multiply larger numbers together (3 digit)</h1><ul><li>Split the second number into groups based on their size. E.g for 253 x 543, split 543 into 500, 40, and 3.</li><li>Multiply the first number by both of the second numbers. E.g. for 253 x 543, do: 500 x 253, 40 x 253, 3 x 253.</li><li>For big numbers, like 500 x 253, you can remove some digits to make it easier then re-add them later.</li><li>E.g. 500 x 253 can become 5 x 253. 5 x 253 = 1265. Since we removed 2 zeroes, we must add 2 zeros. So: 100 x 1265 = 126,500.</li><li>E.g. 40 x 253 can become 4 x 253. 4 x 253 = 1012. Since we removed 1 zero, we must add 1 zero. So: 10 x 1012 = 10,120.</li><li>3 x 253 = 759</li><li>Add the numbers together. E.g. 126,500 + 10,120 + 759 = 137,379.</li></ul><p><br></p><h2>E.g. 203 x 468</h2><p><strong>Split the second number:</strong></p><pre class="ql-syntax" spellcheck="false">468 -&gt; 400, 60, 8
</pre><p><br></p><p><strong>Multiply the first number by the split numbers:</strong></p><pre class="ql-syntax" spellcheck="false">400 x 203   -&gt; 4 x 203 =  812   -&gt; x100 = 81,200
 60 x 203   -&gt; 6 x 203 = 1218   -&gt; x10  = 12,180
  8 x 203                               =  1,624
</pre><p>Here we do 400 x 203 by instead doing 4 x 203.</p><p>Then we multiply the result by 100.</p><p><br></p><p><strong>Add the results together:</strong></p><p>First column</p><pre class="ql-syntax" spellcheck="false">8 1 2 0 0
1 2 1 8 0
  1 6 2 4
---------
        4
</pre><p>Second column</p><pre class="ql-syntax" spellcheck="false">8 1 2 0 0
1 2 1 8 0
  1 6 2 4
---------
    \' 0 4
</pre><p>Third column</p><pre class="ql-syntax" spellcheck="false">8 1 2 0 0
1 2 1 8 0
  1 6 2 4
---------
    9\'0 4
</pre><p>Fourth column</p><pre class="ql-syntax" spellcheck="false">8 1 2 0 0
1 2 1 8 0
  1 6 2 4
---------
  4 9\'0 4
</pre><p>Fifth column</p><pre class="ql-syntax" spellcheck="false">8 1 2 0 0
1 2 1 8 0
  1 6 2 4
---------
9 4 9\'0 4
</pre><p><br></p><p>Adding 1 for tick marks:</p><pre class="ql-syntax" spellcheck="false">8 1 2 0 0
1 2 1 8 0
  1 6 2 4
---------
9 4\'0 0 4
</pre><p>This resulted in another column getting a tick mark. We must repeat:</p><pre class="ql-syntax" spellcheck="false">8 1 2 0 0
1 2 1 8 0
  1 6 2 4
---------
9 5 0 0 4
</pre><p><br></p><p><br></p><p>The result is 95,004.</p><p>203 x 468 = 95,004.</p>', 3, 0);

-- Tests
INSERT INTO tests(name, description, topic_id, hidden) values ('Addition (1 digit)', 'Contains 1 digit addition questions.', 1, 0);
INSERT INTO tests(name, description, topic_id, hidden) values ('Addition (2 digit)', 'Contains 2 digit addition questions.', 1, 0);
INSERT INTO tests(name, description, topic_id, hidden) values ('Addition (3 digit)', 'Contains 3 digit addition questions.', 1, 0);
INSERT INTO tests(name, description, topic_id, hidden) values ('Subtraction (1 digit)', 'Contains 1 digit subtraction questions.', 2, 0);
INSERT INTO tests(name, description, topic_id, hidden) values ('Subtraction (2 digit)', 'Contains 2 digit subtraction questions.', 2, 0);
INSERT INTO tests(name, description, topic_id, hidden) values ('Subtraction (3 digit)', 'Contains 3 digit subtraction questions.', 2, 0);
INSERT INTO tests(name, description, topic_id, hidden) values ('Multiplication (1 digit)', 'Contains 1 digit multiplication questions.', 3, 0);
INSERT INTO tests(name, description, topic_id, hidden) values ('Multiplication (2 digit)', 'Contains 2 digit multiplication questions.', 3, 0);
INSERT INTO tests(name, description, topic_id, hidden) values ('Multiplication (3 digit)', 'Contains 3 digit multiplication questions.', 3, 0);
INSERT INTO tests(name, description, topic_id, hidden) values ('Garbage test (for demo)', 'Every question is a number.\nThe answer is the same as the question.\nThis is for demo purposes so that I don\'t actually have to work out the answer when doing the user_test...\nAlso, this shows off the optional question image functionality, though it just uses placeholder images from https://placehold.it/.', 1, 0);

-- Test questions
--  addition 1
INSERT INTO testQuestions (`question`, answer, test_id) values ('What is 7 + 7?', '14', 1);
INSERT INTO testQuestions (`question`, answer, test_id) values ('What is 3 + 2?', '5', 1);
INSERT INTO testQuestions (`question`, answer, test_id) values ('What is 8 + 0?', '8', 1);
INSERT INTO testQuestions (`question`, answer, test_id) values ('What is 7 + 4?', '11', 1);
INSERT INTO testQuestions (`question`, answer, test_id) values ('What is 0 + 1?', '1', 1);
INSERT INTO testQuestions (`question`, answer, test_id) values ('What is 3 + 1?', '4', 1);
INSERT INTO testQuestions (`question`, answer, test_id) values ('What is 2 + 7?', '9', 1);
INSERT INTO testQuestions (`question`, answer, test_id) values ('What is 1 + 6?', '7', 1);
INSERT INTO testQuestions (`question`, answer, test_id) values ('What is 5 + 6?', '11', 1);
INSERT INTO testQuestions (`question`, answer, test_id) values ('What is 7 + 5?', '12', 1);
INSERT INTO testQuestions (`question`, answer, test_id) values ('What is 8 + 9?', '17', 1);
INSERT INTO testQuestions (`question`, answer, test_id) values ('What is 3 + 4?', '7', 1);
INSERT INTO testQuestions (`question`, answer, test_id) values ('What is 5 + 1?', '6', 1);
INSERT INTO testQuestions (`question`, answer, test_id) values ('What is 0 + 5?', '5', 1);
INSERT INTO testQuestions (`question`, answer, test_id) values ('What is 0 + 9?', '9', 1);
INSERT INTO testQuestions (`question`, answer, test_id) values ('What is 7 + 6?', '13', 1);
INSERT INTO testQuestions (`question`, answer, test_id) values ('What is 1 + 4?', '5', 1);
INSERT INTO testQuestions (`question`, answer, test_id) values ('What is 1 + 3?', '4', 1);
INSERT INTO testQuestions (`question`, answer, test_id) values ('What is 2 + 8?', '10', 1);
INSERT INTO testQuestions (`question`, answer, test_id) values ('What is 9 + 9?', '18', 1);
INSERT INTO testQuestions (`question`, answer, test_id) values ('What is 5 + 3?', '8', 1);
INSERT INTO testQuestions (`question`, answer, test_id) values ('What is 7 + 3?', '10', 1);
INSERT INTO testQuestions (`question`, answer, test_id) values ('What is 6 + 4?', '10', 1);
INSERT INTO testQuestions (`question`, answer, test_id) values ('What is 5 + 9?', '14', 1);
INSERT INTO testQuestions (`question`, answer, test_id) values ('What is 7 + 8?', '15', 1);
INSERT INTO testQuestions (`question`, answer, test_id) values ('What is 6 + 7?', '13', 1);
INSERT INTO testQuestions (`question`, answer, test_id) values ('What is 3 + 5?', '8', 1);
INSERT INTO testQuestions (`question`, answer, test_id) values ('What is 1 + 0?', '1', 1);
INSERT INTO testQuestions (`question`, answer, test_id) values ('What is 2 + 5?', '7', 1);
INSERT INTO testQuestions (`question`, answer, test_id) values ('What is 4 + 2?', '6', 1);
INSERT INTO testQuestions (`question`, answer, test_id) values ('What is 0 + 0?', '0', 1);
INSERT INTO testQuestions (`question`, answer, test_id) values ('What is 8 + 2?', '10', 1);
INSERT INTO testQuestions (`question`, answer, test_id) values ('What is 2 + 0?', '2', 1);
INSERT INTO testQuestions (`question`, answer, test_id) values ('What is 9 + 2?', '11', 1);
INSERT INTO testQuestions (`question`, answer, test_id) values ('What is 8 + 1?', '9', 1);
INSERT INTO testQuestions (`question`, answer, test_id) values ('What is 4 + 5?', '9', 1);
INSERT INTO testQuestions (`question`, answer, test_id) values ('What is 3 + 3?', '6', 1);
INSERT INTO testQuestions (`question`, answer, test_id) values ('What is 0 + 8?', '8', 1);
INSERT INTO testQuestions (`question`, answer, test_id) values ('What is 6 + 6?', '12', 1);
INSERT INTO testQuestions (`question`, answer, test_id) values ('What is 6 + 9?', '15', 1);
INSERT INTO testQuestions (`question`, answer, test_id) values ('What is 2 + 9?', '11', 1);
INSERT INTO testQuestions (`question`, answer, test_id) values ('What is 6 + 5?', '11', 1);
INSERT INTO testQuestions (`question`, answer, test_id) values ('What is 7 + 2?', '9', 1);
INSERT INTO testQuestions (`question`, answer, test_id) values ('What is 6 + 8?', '14', 1);
INSERT INTO testQuestions (`question`, answer, test_id) values ('What is 4 + 0?', '4', 1);
INSERT INTO testQuestions (`question`, answer, test_id) values ('What is 9 + 4?', '13', 1);
INSERT INTO testQuestions (`question`, answer, test_id) values ('What is 8 + 3?', '11', 1);
INSERT INTO testQuestions (`question`, answer, test_id) values ('What is 5 + 8?', '13', 1);
INSERT INTO testQuestions (`question`, answer, test_id) values ('What is 6 + 3?', '9', 1);
INSERT INTO testQuestions (`question`, answer, test_id) values ('What is 9 + 7?', '16', 1);
--  addition 2
INSERT INTO testQuestions (`question`, answer, test_id) values ('What is 39 + 39?', '78', 2);
INSERT INTO testQuestions (`question`, answer, test_id) values ('What is 38 + 85?', '123', 2);
INSERT INTO testQuestions (`question`, answer, test_id) values ('What is 23 + 72?', '95', 2);
INSERT INTO testQuestions (`question`, answer, test_id) values ('What is 4 + 17?', '21', 2);
INSERT INTO testQuestions (`question`, answer, test_id) values ('What is 67 + 74?', '141', 2);
INSERT INTO testQuestions (`question`, answer, test_id) values ('What is 56 + 22?', '78', 2);
INSERT INTO testQuestions (`question`, answer, test_id) values ('What is 64 + 62?', '126', 2);
INSERT INTO testQuestions (`question`, answer, test_id) values ('What is 83 + 86?', '169', 2);
INSERT INTO testQuestions (`question`, answer, test_id) values ('What is 29 + 93?', '122', 2);
INSERT INTO testQuestions (`question`, answer, test_id) values ('What is 45 + 80?', '125', 2);
INSERT INTO testQuestions (`question`, answer, test_id) values ('What is 78 + 7?', '85', 2);
INSERT INTO testQuestions (`question`, answer, test_id) values ('What is 99 + 92?', '191', 2);
INSERT INTO testQuestions (`question`, answer, test_id) values ('What is 23 + 61?', '84', 2);
INSERT INTO testQuestions (`question`, answer, test_id) values ('What is 65 + 59?', '124', 2);
INSERT INTO testQuestions (`question`, answer, test_id) values ('What is 40 + 27?', '67', 2);
INSERT INTO testQuestions (`question`, answer, test_id) values ('What is 40 + 81?', '121', 2);
INSERT INTO testQuestions (`question`, answer, test_id) values ('What is 8 + 23?', '31', 2);
INSERT INTO testQuestions (`question`, answer, test_id) values ('What is 57 + 35?', '92', 2);
INSERT INTO testQuestions (`question`, answer, test_id) values ('What is 16 + 18?', '34', 2);
INSERT INTO testQuestions (`question`, answer, test_id) values ('What is 12 + 75?', '87', 2);
INSERT INTO testQuestions (`question`, answer, test_id) values ('What is 73 + 27?', '100', 2);
INSERT INTO testQuestions (`question`, answer, test_id) values ('What is 34 + 23?', '57', 2);
INSERT INTO testQuestions (`question`, answer, test_id) values ('What is 56 + 28?', '84', 2);
INSERT INTO testQuestions (`question`, answer, test_id) values ('What is 79 + 86?', '165', 2);
INSERT INTO testQuestions (`question`, answer, test_id) values ('What is 81 + 96?', '177', 2);
INSERT INTO testQuestions (`question`, answer, test_id) values ('What is 66 + 27?', '93', 2);
INSERT INTO testQuestions (`question`, answer, test_id) values ('What is 88 + 18?', '106', 2);
INSERT INTO testQuestions (`question`, answer, test_id) values ('What is 12 + 10?', '22', 2);
INSERT INTO testQuestions (`question`, answer, test_id) values ('What is 93 + 39?', '132', 2);
INSERT INTO testQuestions (`question`, answer, test_id) values ('What is 65 + 74?', '139', 2);
INSERT INTO testQuestions (`question`, answer, test_id) values ('What is 89 + 61?', '150', 2);
INSERT INTO testQuestions (`question`, answer, test_id) values ('What is 46 + 21?', '67', 2);
INSERT INTO testQuestions (`question`, answer, test_id) values ('What is 35 + 28?', '63', 2);
INSERT INTO testQuestions (`question`, answer, test_id) values ('What is 51 + 58?', '109', 2);
INSERT INTO testQuestions (`question`, answer, test_id) values ('What is 40 + 36?', '76', 2);
INSERT INTO testQuestions (`question`, answer, test_id) values ('What is 7 + 5?', '12', 2);
INSERT INTO testQuestions (`question`, answer, test_id) values ('What is 78 + 33?', '111', 2);
INSERT INTO testQuestions (`question`, answer, test_id) values ('What is 50 + 70?', '120', 2);
INSERT INTO testQuestions (`question`, answer, test_id) values ('What is 73 + 1?', '74', 2);
INSERT INTO testQuestions (`question`, answer, test_id) values ('What is 62 + 72?', '134', 2);
INSERT INTO testQuestions (`question`, answer, test_id) values ('What is 41 + 71?', '112', 2);
INSERT INTO testQuestions (`question`, answer, test_id) values ('What is 82 + 93?', '175', 2);
INSERT INTO testQuestions (`question`, answer, test_id) values ('What is 97 + 11?', '108', 2);
INSERT INTO testQuestions (`question`, answer, test_id) values ('What is 3 + 99?', '102', 2);
INSERT INTO testQuestions (`question`, answer, test_id) values ('What is 24 + 64?', '88', 2);
INSERT INTO testQuestions (`question`, answer, test_id) values ('What is 60 + 79?', '139', 2);
INSERT INTO testQuestions (`question`, answer, test_id) values ('What is 35 + 3?', '38', 2);
INSERT INTO testQuestions (`question`, answer, test_id) values ('What is 63 + 84?', '147', 2);
INSERT INTO testQuestions (`question`, answer, test_id) values ('What is 13 + 40?', '53', 2);
INSERT INTO testQuestions (`question`, answer, test_id) values ('What is 57 + 0?', '57', 2);
--  addition 3
INSERT INTO testQuestions (`question`, answer, test_id) values ('What is 815 + 34?', '849', 3);
INSERT INTO testQuestions (`question`, answer, test_id) values ('What is 820 + 683?', '1503', 3);
INSERT INTO testQuestions (`question`, answer, test_id) values ('What is 804 + 539?', '1343', 3);
INSERT INTO testQuestions (`question`, answer, test_id) values ('What is 300 + 127?', '427', 3);
INSERT INTO testQuestions (`question`, answer, test_id) values ('What is 262 + 277?', '539', 3);
INSERT INTO testQuestions (`question`, answer, test_id) values ('What is 543 + 607?', '1150', 3);
INSERT INTO testQuestions (`question`, answer, test_id) values ('What is 990 + 506?', '1496', 3);
INSERT INTO testQuestions (`question`, answer, test_id) values ('What is 23 + 938?', '961', 3);
INSERT INTO testQuestions (`question`, answer, test_id) values ('What is 595 + 660?', '1255', 3);
INSERT INTO testQuestions (`question`, answer, test_id) values ('What is 18 + 141?', '159', 3);
INSERT INTO testQuestions (`question`, answer, test_id) values ('What is 758 + 935?', '1693', 3);
INSERT INTO testQuestions (`question`, answer, test_id) values ('What is 373 + 614?', '987', 3);
INSERT INTO testQuestions (`question`, answer, test_id) values ('What is 135 + 331?', '466', 3);
INSERT INTO testQuestions (`question`, answer, test_id) values ('What is 934 + 800?', '1734', 3);
INSERT INTO testQuestions (`question`, answer, test_id) values ('What is 297 + 360?', '657', 3);
INSERT INTO testQuestions (`question`, answer, test_id) values ('What is 799 + 163?', '962', 3);
INSERT INTO testQuestions (`question`, answer, test_id) values ('What is 540 + 945?', '1485', 3);
INSERT INTO testQuestions (`question`, answer, test_id) values ('What is 613 + 710?', '1323', 3);
INSERT INTO testQuestions (`question`, answer, test_id) values ('What is 561 + 424?', '985', 3);
INSERT INTO testQuestions (`question`, answer, test_id) values ('What is 402 + 250?', '652', 3);
INSERT INTO testQuestions (`question`, answer, test_id) values ('What is 728 + 96?', '824', 3);
INSERT INTO testQuestions (`question`, answer, test_id) values ('What is 808 + 28?', '836', 3);
INSERT INTO testQuestions (`question`, answer, test_id) values ('What is 746 + 763?', '1509', 3);
INSERT INTO testQuestions (`question`, answer, test_id) values ('What is 700 + 13?', '713', 3);
INSERT INTO testQuestions (`question`, answer, test_id) values ('What is 791 + 537?', '1328', 3);
INSERT INTO testQuestions (`question`, answer, test_id) values ('What is 846 + 207?', '1053', 3);
INSERT INTO testQuestions (`question`, answer, test_id) values ('What is 462 + 30?', '492', 3);
INSERT INTO testQuestions (`question`, answer, test_id) values ('What is 293 + 132?', '425', 3);
INSERT INTO testQuestions (`question`, answer, test_id) values ('What is 673 + 61?', '734', 3);
INSERT INTO testQuestions (`question`, answer, test_id) values ('What is 895 + 388?', '1283', 3);
INSERT INTO testQuestions (`question`, answer, test_id) values ('What is 223 + 666?', '889', 3);
INSERT INTO testQuestions (`question`, answer, test_id) values ('What is 537 + 405?', '942', 3);
INSERT INTO testQuestions (`question`, answer, test_id) values ('What is 348 + 51?', '399', 3);
INSERT INTO testQuestions (`question`, answer, test_id) values ('What is 758 + 393?', '1151', 3);
INSERT INTO testQuestions (`question`, answer, test_id) values ('What is 163 + 707?', '870', 3);
INSERT INTO testQuestions (`question`, answer, test_id) values ('What is 221 + 460?', '681', 3);
INSERT INTO testQuestions (`question`, answer, test_id) values ('What is 921 + 321?', '1242', 3);
INSERT INTO testQuestions (`question`, answer, test_id) values ('What is 466 + 962?', '1428', 3);
INSERT INTO testQuestions (`question`, answer, test_id) values ('What is 956 + 316?', '1272', 3);
INSERT INTO testQuestions (`question`, answer, test_id) values ('What is 111 + 364?', '475', 3);
INSERT INTO testQuestions (`question`, answer, test_id) values ('What is 981 + 186?', '1167', 3);
INSERT INTO testQuestions (`question`, answer, test_id) values ('What is 827 + 398?', '1225', 3);
INSERT INTO testQuestions (`question`, answer, test_id) values ('What is 388 + 412?', '800', 3);
INSERT INTO testQuestions (`question`, answer, test_id) values ('What is 670 + 174?', '844', 3);
INSERT INTO testQuestions (`question`, answer, test_id) values ('What is 245 + 855?', '1100', 3);
INSERT INTO testQuestions (`question`, answer, test_id) values ('What is 943 + 379?', '1322', 3);
INSERT INTO testQuestions (`question`, answer, test_id) values ('What is 857 + 192?', '1049', 3);
INSERT INTO testQuestions (`question`, answer, test_id) values ('What is 21 + 321?', '342', 3);
INSERT INTO testQuestions (`question`, answer, test_id) values ('What is 748 + 232?', '980', 3);
INSERT INTO testQuestions (`question`, answer, test_id) values ('What is 705 + 836?', '1541', 3);
--  subtraction 1
INSERT INTO testQuestions (`question`, answer, test_id) values ('What is 9 - 2?', '7', 4);
INSERT INTO testQuestions (`question`, answer, test_id) values ('What is 0 - 9?', '-9', 4);
INSERT INTO testQuestions (`question`, answer, test_id) values ('What is 1 - 2?', '-1', 4);
INSERT INTO testQuestions (`question`, answer, test_id) values ('What is 3 - 7?', '-4', 4);
INSERT INTO testQuestions (`question`, answer, test_id) values ('What is 8 - 6?', '2', 4);
INSERT INTO testQuestions (`question`, answer, test_id) values ('What is 0 - 7?', '-7', 4);
INSERT INTO testQuestions (`question`, answer, test_id) values ('What is 8 - 3?', '5', 4);
INSERT INTO testQuestions (`question`, answer, test_id) values ('What is 1 - 4?', '-3', 4);
INSERT INTO testQuestions (`question`, answer, test_id) values ('What is 0 - 6?', '-6', 4);
INSERT INTO testQuestions (`question`, answer, test_id) values ('What is 5 - 0?', '5', 4);
INSERT INTO testQuestions (`question`, answer, test_id) values ('What is 2 - 8?', '-6', 4);
INSERT INTO testQuestions (`question`, answer, test_id) values ('What is 0 - 3?', '-3', 4);
INSERT INTO testQuestions (`question`, answer, test_id) values ('What is 7 - 2?', '5', 4);
INSERT INTO testQuestions (`question`, answer, test_id) values ('What is 8 - 5?', '3', 4);
INSERT INTO testQuestions (`question`, answer, test_id) values ('What is 9 - 9?', '0', 4);
INSERT INTO testQuestions (`question`, answer, test_id) values ('What is 4 - 3?', '1', 4);
INSERT INTO testQuestions (`question`, answer, test_id) values ('What is 3 - 2?', '1', 4);
INSERT INTO testQuestions (`question`, answer, test_id) values ('What is 6 - 1?', '5', 4);
INSERT INTO testQuestions (`question`, answer, test_id) values ('What is 0 - 5?', '-5', 4);
INSERT INTO testQuestions (`question`, answer, test_id) values ('What is 3 - 4?', '-1', 4);
INSERT INTO testQuestions (`question`, answer, test_id) values ('What is 2 - 4?', '-2', 4);
INSERT INTO testQuestions (`question`, answer, test_id) values ('What is 6 - 5?', '1', 4);
INSERT INTO testQuestions (`question`, answer, test_id) values ('What is 4 - 5?', '-1', 4);
INSERT INTO testQuestions (`question`, answer, test_id) values ('What is 6 - 4?', '2', 4);
INSERT INTO testQuestions (`question`, answer, test_id) values ('What is 4 - 6?', '-2', 4);
INSERT INTO testQuestions (`question`, answer, test_id) values ('What is 1 - 8?', '-7', 4);
INSERT INTO testQuestions (`question`, answer, test_id) values ('What is 6 - 8?', '-2', 4);
INSERT INTO testQuestions (`question`, answer, test_id) values ('What is 1 - 0?', '1', 4);
INSERT INTO testQuestions (`question`, answer, test_id) values ('What is 2 - 9?', '-7', 4);
INSERT INTO testQuestions (`question`, answer, test_id) values ('What is 9 - 4?', '5', 4);
INSERT INTO testQuestions (`question`, answer, test_id) values ('What is 3 - 0?', '3', 4);
INSERT INTO testQuestions (`question`, answer, test_id) values ('What is 2 - 3?', '-1', 4);
INSERT INTO testQuestions (`question`, answer, test_id) values ('What is 6 - 3?', '3', 4);
INSERT INTO testQuestions (`question`, answer, test_id) values ('What is 6 - 0?', '6', 4);
INSERT INTO testQuestions (`question`, answer, test_id) values ('What is 8 - 7?', '1', 4);
INSERT INTO testQuestions (`question`, answer, test_id) values ('What is 2 - 6?', '-4', 4);
INSERT INTO testQuestions (`question`, answer, test_id) values ('What is 7 - 0?', '7', 4);
INSERT INTO testQuestions (`question`, answer, test_id) values ('What is 8 - 0?', '8', 4);
INSERT INTO testQuestions (`question`, answer, test_id) values ('What is 4 - 7?', '-3', 4);
INSERT INTO testQuestions (`question`, answer, test_id) values ('What is 5 - 6?', '-1', 4);
INSERT INTO testQuestions (`question`, answer, test_id) values ('What is 7 - 5?', '2', 4);
INSERT INTO testQuestions (`question`, answer, test_id) values ('What is 5 - 2?', '3', 4);
INSERT INTO testQuestions (`question`, answer, test_id) values ('What is 4 - 0?', '4', 4);
INSERT INTO testQuestions (`question`, answer, test_id) values ('What is 0 - 2?', '-2', 4);
INSERT INTO testQuestions (`question`, answer, test_id) values ('What is 5 - 3?', '2', 4);
INSERT INTO testQuestions (`question`, answer, test_id) values ('What is 9 - 0?', '9', 4);
INSERT INTO testQuestions (`question`, answer, test_id) values ('What is 8 - 9?', '-1', 4);
INSERT INTO testQuestions (`question`, answer, test_id) values ('What is 2 - 0?', '2', 4);
INSERT INTO testQuestions (`question`, answer, test_id) values ('What is 9 - 5?', '4', 4);
INSERT INTO testQuestions (`question`, answer, test_id) values ('What is 1 - 3?', '-2', 4);
--  subtraction 2
INSERT INTO testQuestions (`question`, answer, test_id) values ('What is 43 - 4?', '39', 5);
INSERT INTO testQuestions (`question`, answer, test_id) values ('What is 57 - 10?', '47', 5);
INSERT INTO testQuestions (`question`, answer, test_id) values ('What is 83 - 50?', '33', 5);
INSERT INTO testQuestions (`question`, answer, test_id) values ('What is 63 - 74?', '-11', 5);
INSERT INTO testQuestions (`question`, answer, test_id) values ('What is 19 - 84?', '-65', 5);
INSERT INTO testQuestions (`question`, answer, test_id) values ('What is 29 - 94?', '-65', 5);
INSERT INTO testQuestions (`question`, answer, test_id) values ('What is 61 - 8?', '53', 5);
INSERT INTO testQuestions (`question`, answer, test_id) values ('What is 54 - 58?', '-4', 5);
INSERT INTO testQuestions (`question`, answer, test_id) values ('What is 7 - 8?', '-1', 5);
INSERT INTO testQuestions (`question`, answer, test_id) values ('What is 36 - 65?', '-29', 5);
INSERT INTO testQuestions (`question`, answer, test_id) values ('What is 35 - 42?', '-7', 5);
INSERT INTO testQuestions (`question`, answer, test_id) values ('What is 90 - 41?', '49', 5);
INSERT INTO testQuestions (`question`, answer, test_id) values ('What is 50 - 85?', '-35', 5);
INSERT INTO testQuestions (`question`, answer, test_id) values ('What is 11 - 35?', '-24', 5);
INSERT INTO testQuestions (`question`, answer, test_id) values ('What is 77 - 65?', '12', 5);
INSERT INTO testQuestions (`question`, answer, test_id) values ('What is 35 - 89?', '-54', 5);
INSERT INTO testQuestions (`question`, answer, test_id) values ('What is 82 - 47?', '35', 5);
INSERT INTO testQuestions (`question`, answer, test_id) values ('What is 83 - 43?', '40', 5);
INSERT INTO testQuestions (`question`, answer, test_id) values ('What is 32 - 35?', '-3', 5);
INSERT INTO testQuestions (`question`, answer, test_id) values ('What is 98 - 14?', '84', 5);
INSERT INTO testQuestions (`question`, answer, test_id) values ('What is 15 - 81?', '-66', 5);
INSERT INTO testQuestions (`question`, answer, test_id) values ('What is 72 - 92?', '-20', 5);
INSERT INTO testQuestions (`question`, answer, test_id) values ('What is 44 - 6?', '38', 5);
INSERT INTO testQuestions (`question`, answer, test_id) values ('What is 87 - 74?', '13', 5);
INSERT INTO testQuestions (`question`, answer, test_id) values ('What is 10 - 66?', '-56', 5);
INSERT INTO testQuestions (`question`, answer, test_id) values ('What is 69 - 5?', '64', 5);
INSERT INTO testQuestions (`question`, answer, test_id) values ('What is 84 - 85?', '-1', 5);
INSERT INTO testQuestions (`question`, answer, test_id) values ('What is 74 - 52?', '22', 5);
INSERT INTO testQuestions (`question`, answer, test_id) values ('What is 74 - 80?', '-6', 5);
INSERT INTO testQuestions (`question`, answer, test_id) values ('What is 3 - 83?', '-80', 5);
INSERT INTO testQuestions (`question`, answer, test_id) values ('What is 44 - 1?', '43', 5);
INSERT INTO testQuestions (`question`, answer, test_id) values ('What is 96 - 96?', '0', 5);
INSERT INTO testQuestions (`question`, answer, test_id) values ('What is 71 - 62?', '9', 5);
INSERT INTO testQuestions (`question`, answer, test_id) values ('What is 54 - 97?', '-43', 5);
INSERT INTO testQuestions (`question`, answer, test_id) values ('What is 54 - 85?', '-31', 5);
INSERT INTO testQuestions (`question`, answer, test_id) values ('What is 85 - 96?', '-11', 5);
INSERT INTO testQuestions (`question`, answer, test_id) values ('What is 15 - 98?', '-83', 5);
INSERT INTO testQuestions (`question`, answer, test_id) values ('What is 34 - 99?', '-65', 5);
INSERT INTO testQuestions (`question`, answer, test_id) values ('What is 85 - 88?', '-3', 5);
INSERT INTO testQuestions (`question`, answer, test_id) values ('What is 33 - 71?', '-38', 5);
INSERT INTO testQuestions (`question`, answer, test_id) values ('What is 33 - 45?', '-12', 5);
INSERT INTO testQuestions (`question`, answer, test_id) values ('What is 49 - 35?', '14', 5);
INSERT INTO testQuestions (`question`, answer, test_id) values ('What is 65 - 63?', '2', 5);
INSERT INTO testQuestions (`question`, answer, test_id) values ('What is 29 - 47?', '-18', 5);
INSERT INTO testQuestions (`question`, answer, test_id) values ('What is 20 - 51?', '-31', 5);
INSERT INTO testQuestions (`question`, answer, test_id) values ('What is 85 - 35?', '50', 5);
INSERT INTO testQuestions (`question`, answer, test_id) values ('What is 24 - 28?', '-4', 5);
INSERT INTO testQuestions (`question`, answer, test_id) values ('What is 45 - 97?', '-52', 5);
INSERT INTO testQuestions (`question`, answer, test_id) values ('What is 33 - 24?', '9', 5);
INSERT INTO testQuestions (`question`, answer, test_id) values ('What is 11 - 3?', '8', 5);
--  subtraction 3
INSERT INTO testQuestions (`question`, answer, test_id) values ('What is 267 - 415?', '-148', 6);
INSERT INTO testQuestions (`question`, answer, test_id) values ('What is 309 - 839?', '-530', 6);
INSERT INTO testQuestions (`question`, answer, test_id) values ('What is 932 - 224?', '708', 6);
INSERT INTO testQuestions (`question`, answer, test_id) values ('What is 334 - 568?', '-234', 6);
INSERT INTO testQuestions (`question`, answer, test_id) values ('What is 178 - 857?', '-679', 6);
INSERT INTO testQuestions (`question`, answer, test_id) values ('What is 969 - 358?', '611', 6);
INSERT INTO testQuestions (`question`, answer, test_id) values ('What is 916 - 197?', '719', 6);
INSERT INTO testQuestions (`question`, answer, test_id) values ('What is 722 - 521?', '201', 6);
INSERT INTO testQuestions (`question`, answer, test_id) values ('What is 862 - 856?', '6', 6);
INSERT INTO testQuestions (`question`, answer, test_id) values ('What is 691 - 668?', '23', 6);
INSERT INTO testQuestions (`question`, answer, test_id) values ('What is 636 - 723?', '-87', 6);
INSERT INTO testQuestions (`question`, answer, test_id) values ('What is 988 - 38?', '950', 6);
INSERT INTO testQuestions (`question`, answer, test_id) values ('What is 562 - 679?', '-117', 6);
INSERT INTO testQuestions (`question`, answer, test_id) values ('What is 34 - 63?', '-29', 6);
INSERT INTO testQuestions (`question`, answer, test_id) values ('What is 670 - 81?', '589', 6);
INSERT INTO testQuestions (`question`, answer, test_id) values ('What is 559 - 575?', '-16', 6);
INSERT INTO testQuestions (`question`, answer, test_id) values ('What is 862 - 465?', '397', 6);
INSERT INTO testQuestions (`question`, answer, test_id) values ('What is 204 - 445?', '-241', 6);
INSERT INTO testQuestions (`question`, answer, test_id) values ('What is 26 - 956?', '-930', 6);
INSERT INTO testQuestions (`question`, answer, test_id) values ('What is 302 - 765?', '-463', 6);
INSERT INTO testQuestions (`question`, answer, test_id) values ('What is 726 - 728?', '-2', 6);
INSERT INTO testQuestions (`question`, answer, test_id) values ('What is 26 - 183?', '-157', 6);
INSERT INTO testQuestions (`question`, answer, test_id) values ('What is 789 - 549?', '240', 6);
INSERT INTO testQuestions (`question`, answer, test_id) values ('What is 356 - 847?', '-491', 6);
INSERT INTO testQuestions (`question`, answer, test_id) values ('What is 784 - 258?', '526', 6);
INSERT INTO testQuestions (`question`, answer, test_id) values ('What is 11 - 171?', '-160', 6);
INSERT INTO testQuestions (`question`, answer, test_id) values ('What is 631 - 751?', '-120', 6);
INSERT INTO testQuestions (`question`, answer, test_id) values ('What is 819 - 441?', '378', 6);
INSERT INTO testQuestions (`question`, answer, test_id) values ('What is 152 - 778?', '-626', 6);
INSERT INTO testQuestions (`question`, answer, test_id) values ('What is 127 - 561?', '-434', 6);
INSERT INTO testQuestions (`question`, answer, test_id) values ('What is 297 - 144?', '153', 6);
INSERT INTO testQuestions (`question`, answer, test_id) values ('What is 874 - 589?', '285', 6);
INSERT INTO testQuestions (`question`, answer, test_id) values ('What is 529 - 550?', '-21', 6);
INSERT INTO testQuestions (`question`, answer, test_id) values ('What is 411 - 708?', '-297', 6);
INSERT INTO testQuestions (`question`, answer, test_id) values ('What is 649 - 360?', '289', 6);
INSERT INTO testQuestions (`question`, answer, test_id) values ('What is 11 - 191?', '-180', 6);
INSERT INTO testQuestions (`question`, answer, test_id) values ('What is 902 - 705?', '197', 6);
INSERT INTO testQuestions (`question`, answer, test_id) values ('What is 40 - 250?', '-210', 6);
INSERT INTO testQuestions (`question`, answer, test_id) values ('What is 504 - 959?', '-455', 6);
INSERT INTO testQuestions (`question`, answer, test_id) values ('What is 592 - 634?', '-42', 6);
INSERT INTO testQuestions (`question`, answer, test_id) values ('What is 899 - 507?', '392', 6);
INSERT INTO testQuestions (`question`, answer, test_id) values ('What is 874 - 392?', '482', 6);
INSERT INTO testQuestions (`question`, answer, test_id) values ('What is 738 - 288?', '450', 6);
INSERT INTO testQuestions (`question`, answer, test_id) values ('What is 769 - 491?', '278', 6);
INSERT INTO testQuestions (`question`, answer, test_id) values ('What is 871 - 362?', '509', 6);
INSERT INTO testQuestions (`question`, answer, test_id) values ('What is 791 - 148?', '643', 6);
INSERT INTO testQuestions (`question`, answer, test_id) values ('What is 63 - 460?', '-397', 6);
INSERT INTO testQuestions (`question`, answer, test_id) values ('What is 714 - 639?', '75', 6);
INSERT INTO testQuestions (`question`, answer, test_id) values ('What is 543 - 770?', '-227', 6);
INSERT INTO testQuestions (`question`, answer, test_id) values ('What is 984 - 68?', '916', 6);
--  multiplication 1
INSERT INTO testQuestions (`question`, answer, test_id) values ('What is 1 x 5?', '5', 7);
INSERT INTO testQuestions (`question`, answer, test_id) values ('What is 2 x 2?', '4', 7);
INSERT INTO testQuestions (`question`, answer, test_id) values ('What is 1 x 8?', '8', 7);
INSERT INTO testQuestions (`question`, answer, test_id) values ('What is 7 x 7?', '49', 7);
INSERT INTO testQuestions (`question`, answer, test_id) values ('What is 5 x 8?', '40', 7);
INSERT INTO testQuestions (`question`, answer, test_id) values ('What is 2 x 6?', '12', 7);
INSERT INTO testQuestions (`question`, answer, test_id) values ('What is 3 x 5?', '15', 7);
INSERT INTO testQuestions (`question`, answer, test_id) values ('What is 9 x 5?', '45', 7);
INSERT INTO testQuestions (`question`, answer, test_id) values ('What is 0 x 2?', '0', 7);
INSERT INTO testQuestions (`question`, answer, test_id) values ('What is 9 x 8?', '72', 7);
INSERT INTO testQuestions (`question`, answer, test_id) values ('What is 7 x 9?', '63', 7);
INSERT INTO testQuestions (`question`, answer, test_id) values ('What is 6 x 2?', '12', 7);
INSERT INTO testQuestions (`question`, answer, test_id) values ('What is 6 x 8?', '48', 7);
INSERT INTO testQuestions (`question`, answer, test_id) values ('What is 8 x 0?', '0', 7);
INSERT INTO testQuestions (`question`, answer, test_id) values ('What is 0 x 0?', '0', 7);
INSERT INTO testQuestions (`question`, answer, test_id) values ('What is 3 x 6?', '18', 7);
INSERT INTO testQuestions (`question`, answer, test_id) values ('What is 9 x 2?', '18', 7);
INSERT INTO testQuestions (`question`, answer, test_id) values ('What is 0 x 9?', '0', 7);
INSERT INTO testQuestions (`question`, answer, test_id) values ('What is 8 x 1?', '8', 7);
INSERT INTO testQuestions (`question`, answer, test_id) values ('What is 6 x 5?', '30', 7);
INSERT INTO testQuestions (`question`, answer, test_id) values ('What is 8 x 7?', '56', 7);
INSERT INTO testQuestions (`question`, answer, test_id) values ('What is 1 x 0?', '0', 7);
INSERT INTO testQuestions (`question`, answer, test_id) values ('What is 3 x 1?', '3', 7);
INSERT INTO testQuestions (`question`, answer, test_id) values ('What is 8 x 8?', '64', 7);
INSERT INTO testQuestions (`question`, answer, test_id) values ('What is 7 x 0?', '0', 7);
INSERT INTO testQuestions (`question`, answer, test_id) values ('What is 3 x 2?', '6', 7);
INSERT INTO testQuestions (`question`, answer, test_id) values ('What is 1 x 2?', '2', 7);
INSERT INTO testQuestions (`question`, answer, test_id) values ('What is 2 x 3?', '6', 7);
INSERT INTO testQuestions (`question`, answer, test_id) values ('What is 4 x 1?', '4', 7);
INSERT INTO testQuestions (`question`, answer, test_id) values ('What is 7 x 3?', '21', 7);
INSERT INTO testQuestions (`question`, answer, test_id) values ('What is 5 x 9?', '45', 7);
INSERT INTO testQuestions (`question`, answer, test_id) values ('What is 0 x 4?', '0', 7);
INSERT INTO testQuestions (`question`, answer, test_id) values ('What is 6 x 7?', '42', 7);
INSERT INTO testQuestions (`question`, answer, test_id) values ('What is 8 x 4?', '32', 7);
INSERT INTO testQuestions (`question`, answer, test_id) values ('What is 5 x 6?', '30', 7);
INSERT INTO testQuestions (`question`, answer, test_id) values ('What is 9 x 6?', '54', 7);
INSERT INTO testQuestions (`question`, answer, test_id) values ('What is 3 x 9?', '27', 7);
INSERT INTO testQuestions (`question`, answer, test_id) values ('What is 1 x 3?', '3', 7);
INSERT INTO testQuestions (`question`, answer, test_id) values ('What is 8 x 2?', '16', 7);
INSERT INTO testQuestions (`question`, answer, test_id) values ('What is 4 x 3?', '12', 7);
INSERT INTO testQuestions (`question`, answer, test_id) values ('What is 2 x 0?', '0', 7);
INSERT INTO testQuestions (`question`, answer, test_id) values ('What is 0 x 1?', '0', 7);
INSERT INTO testQuestions (`question`, answer, test_id) values ('What is 9 x 0?', '0', 7);
INSERT INTO testQuestions (`question`, answer, test_id) values ('What is 2 x 7?', '14', 7);
INSERT INTO testQuestions (`question`, answer, test_id) values ('What is 3 x 0?', '0', 7);
INSERT INTO testQuestions (`question`, answer, test_id) values ('What is 9 x 9?', '81', 7);
INSERT INTO testQuestions (`question`, answer, test_id) values ('What is 9 x 4?', '36', 7);
INSERT INTO testQuestions (`question`, answer, test_id) values ('What is 9 x 7?', '63', 7);
INSERT INTO testQuestions (`question`, answer, test_id) values ('What is 4 x 0?', '0', 7);
INSERT INTO testQuestions (`question`, answer, test_id) values ('What is 7 x 1?', '7', 7);
--  multiplication 2
INSERT INTO testQuestions (`question`, answer, test_id) values ('What is 3 x 95?', '285', 8);
INSERT INTO testQuestions (`question`, answer, test_id) values ('What is 40 x 29?', '1160', 8);
INSERT INTO testQuestions (`question`, answer, test_id) values ('What is 11 x 66?', '726', 8);
INSERT INTO testQuestions (`question`, answer, test_id) values ('What is 7 x 36?', '252', 8);
INSERT INTO testQuestions (`question`, answer, test_id) values ('What is 22 x 54?', '1188', 8);
INSERT INTO testQuestions (`question`, answer, test_id) values ('What is 56 x 1?', '56', 8);
INSERT INTO testQuestions (`question`, answer, test_id) values ('What is 93 x 12?', '1116', 8);
INSERT INTO testQuestions (`question`, answer, test_id) values ('What is 2 x 18?', '36', 8);
INSERT INTO testQuestions (`question`, answer, test_id) values ('What is 48 x 34?', '1632', 8);
INSERT INTO testQuestions (`question`, answer, test_id) values ('What is 59 x 4?', '236', 8);
INSERT INTO testQuestions (`question`, answer, test_id) values ('What is 94 x 61?', '5734', 8);
INSERT INTO testQuestions (`question`, answer, test_id) values ('What is 54 x 25?', '1350', 8);
INSERT INTO testQuestions (`question`, answer, test_id) values ('What is 38 x 83?', '3154', 8);
INSERT INTO testQuestions (`question`, answer, test_id) values ('What is 80 x 80?', '6400', 8);
INSERT INTO testQuestions (`question`, answer, test_id) values ('What is 47 x 81?', '3807', 8);
INSERT INTO testQuestions (`question`, answer, test_id) values ('What is 38 x 32?', '1216', 8);
INSERT INTO testQuestions (`question`, answer, test_id) values ('What is 29 x 39?', '1131', 8);
INSERT INTO testQuestions (`question`, answer, test_id) values ('What is 52 x 96?', '4992', 8);
INSERT INTO testQuestions (`question`, answer, test_id) values ('What is 56 x 72?', '4032', 8);
INSERT INTO testQuestions (`question`, answer, test_id) values ('What is 54 x 48?', '2592', 8);
INSERT INTO testQuestions (`question`, answer, test_id) values ('What is 14 x 27?', '378', 8);
INSERT INTO testQuestions (`question`, answer, test_id) values ('What is 62 x 92?', '5704', 8);
INSERT INTO testQuestions (`question`, answer, test_id) values ('What is 99 x 27?', '2673', 8);
INSERT INTO testQuestions (`question`, answer, test_id) values ('What is 89 x 51?', '4539', 8);
INSERT INTO testQuestions (`question`, answer, test_id) values ('What is 98 x 79?', '7742', 8);
INSERT INTO testQuestions (`question`, answer, test_id) values ('What is 28 x 16?', '448', 8);
INSERT INTO testQuestions (`question`, answer, test_id) values ('What is 57 x 83?', '4731', 8);
INSERT INTO testQuestions (`question`, answer, test_id) values ('What is 81 x 82?', '6642', 8);
INSERT INTO testQuestions (`question`, answer, test_id) values ('What is 71 x 82?', '5822', 8);
INSERT INTO testQuestions (`question`, answer, test_id) values ('What is 26 x 35?', '910', 8);
INSERT INTO testQuestions (`question`, answer, test_id) values ('What is 98 x 67?', '6566', 8);
INSERT INTO testQuestions (`question`, answer, test_id) values ('What is 60 x 83?', '4980', 8);
INSERT INTO testQuestions (`question`, answer, test_id) values ('What is 49 x 16?', '784', 8);
INSERT INTO testQuestions (`question`, answer, test_id) values ('What is 48 x 25?', '1200', 8);
INSERT INTO testQuestions (`question`, answer, test_id) values ('What is 98 x 89?', '8722', 8);
INSERT INTO testQuestions (`question`, answer, test_id) values ('What is 26 x 8?', '208', 8);
INSERT INTO testQuestions (`question`, answer, test_id) values ('What is 14 x 50?', '700', 8);
INSERT INTO testQuestions (`question`, answer, test_id) values ('What is 46 x 74?', '3404', 8);
INSERT INTO testQuestions (`question`, answer, test_id) values ('What is 85 x 39?', '3315', 8);
INSERT INTO testQuestions (`question`, answer, test_id) values ('What is 16 x 85?', '1360', 8);
INSERT INTO testQuestions (`question`, answer, test_id) values ('What is 33 x 0?', '0', 8);
INSERT INTO testQuestions (`question`, answer, test_id) values ('What is 85 x 49?', '4165', 8);
INSERT INTO testQuestions (`question`, answer, test_id) values ('What is 0 x 91?', '0', 8);
INSERT INTO testQuestions (`question`, answer, test_id) values ('What is 13 x 47?', '611', 8);
INSERT INTO testQuestions (`question`, answer, test_id) values ('What is 71 x 30?', '2130', 8);
INSERT INTO testQuestions (`question`, answer, test_id) values ('What is 42 x 38?', '1596', 8);
INSERT INTO testQuestions (`question`, answer, test_id) values ('What is 6 x 53?', '318', 8);
INSERT INTO testQuestions (`question`, answer, test_id) values ('What is 60 x 48?', '2880', 8);
INSERT INTO testQuestions (`question`, answer, test_id) values ('What is 64 x 95?', '6080', 8);
INSERT INTO testQuestions (`question`, answer, test_id) values ('What is 72 x 5?', '360', 8);
--  multiplication 3
INSERT INTO testQuestions (`question`, answer, test_id) values ('What is 468 x 657?', '307476', 9);
INSERT INTO testQuestions (`question`, answer, test_id) values ('What is 478 x 690?', '329820', 9);
INSERT INTO testQuestions (`question`, answer, test_id) values ('What is 575 x 416?', '239200', 9);
INSERT INTO testQuestions (`question`, answer, test_id) values ('What is 59 x 13?', '767', 9);
INSERT INTO testQuestions (`question`, answer, test_id) values ('What is 737 x 552?', '406824', 9);
INSERT INTO testQuestions (`question`, answer, test_id) values ('What is 612 x 114?', '69768', 9);
INSERT INTO testQuestions (`question`, answer, test_id) values ('What is 150 x 918?', '137700', 9);
INSERT INTO testQuestions (`question`, answer, test_id) values ('What is 786 x 425?', '334050', 9);
INSERT INTO testQuestions (`question`, answer, test_id) values ('What is 426 x 98?', '41748', 9);
INSERT INTO testQuestions (`question`, answer, test_id) values ('What is 641 x 249?', '159609', 9);
INSERT INTO testQuestions (`question`, answer, test_id) values ('What is 396 x 390?', '154440', 9);
INSERT INTO testQuestions (`question`, answer, test_id) values ('What is 498 x 59?', '29382', 9);
INSERT INTO testQuestions (`question`, answer, test_id) values ('What is 455 x 828?', '376740', 9);
INSERT INTO testQuestions (`question`, answer, test_id) values ('What is 468 x 313?', '146484', 9);
INSERT INTO testQuestions (`question`, answer, test_id) values ('What is 743 x 432?', '320976', 9);
INSERT INTO testQuestions (`question`, answer, test_id) values ('What is 190 x 24?', '4560', 9);
INSERT INTO testQuestions (`question`, answer, test_id) values ('What is 965 x 330?', '318450', 9);
INSERT INTO testQuestions (`question`, answer, test_id) values ('What is 29 x 740?', '21460', 9);
INSERT INTO testQuestions (`question`, answer, test_id) values ('What is 752 x 925?', '695600', 9);
INSERT INTO testQuestions (`question`, answer, test_id) values ('What is 989 x 715?', '707135', 9);
INSERT INTO testQuestions (`question`, answer, test_id) values ('What is 673 x 871?', '586183', 9);
INSERT INTO testQuestions (`question`, answer, test_id) values ('What is 342 x 371?', '126882', 9);
INSERT INTO testQuestions (`question`, answer, test_id) values ('What is 139 x 89?', '12371', 9);
INSERT INTO testQuestions (`question`, answer, test_id) values ('What is 735 x 177?', '130095', 9);
INSERT INTO testQuestions (`question`, answer, test_id) values ('What is 478 x 665?', '317870', 9);
INSERT INTO testQuestions (`question`, answer, test_id) values ('What is 800 x 250?', '200000', 9);
INSERT INTO testQuestions (`question`, answer, test_id) values ('What is 725 x 607?', '440075', 9);
INSERT INTO testQuestions (`question`, answer, test_id) values ('What is 318 x 42?', '13356', 9);
INSERT INTO testQuestions (`question`, answer, test_id) values ('What is 689 x 734?', '505726', 9);
INSERT INTO testQuestions (`question`, answer, test_id) values ('What is 850 x 918?', '780300', 9);
INSERT INTO testQuestions (`question`, answer, test_id) values ('What is 50 x 999?', '49950', 9);
INSERT INTO testQuestions (`question`, answer, test_id) values ('What is 989 x 704?', '696256', 9);
INSERT INTO testQuestions (`question`, answer, test_id) values ('What is 421 x 937?', '394477', 9);
INSERT INTO testQuestions (`question`, answer, test_id) values ('What is 277 x 503?', '139331', 9);
INSERT INTO testQuestions (`question`, answer, test_id) values ('What is 351 x 249?', '87399', 9);
INSERT INTO testQuestions (`question`, answer, test_id) values ('What is 956 x 801?', '765756', 9);
INSERT INTO testQuestions (`question`, answer, test_id) values ('What is 802 x 158?', '126716', 9);
INSERT INTO testQuestions (`question`, answer, test_id) values ('What is 960 x 669?', '642240', 9);
INSERT INTO testQuestions (`question`, answer, test_id) values ('What is 638 x 352?', '224576', 9);
INSERT INTO testQuestions (`question`, answer, test_id) values ('What is 93 x 154?', '14322', 9);
INSERT INTO testQuestions (`question`, answer, test_id) values ('What is 457 x 511?', '233527', 9);
INSERT INTO testQuestions (`question`, answer, test_id) values ('What is 898 x 1?', '898', 9);
INSERT INTO testQuestions (`question`, answer, test_id) values ('What is 215 x 412?', '88580', 9);
INSERT INTO testQuestions (`question`, answer, test_id) values ('What is 274 x 579?', '158646', 9);
INSERT INTO testQuestions (`question`, answer, test_id) values ('What is 705 x 930?', '655650', 9);
INSERT INTO testQuestions (`question`, answer, test_id) values ('What is 301 x 694?', '208894', 9);
INSERT INTO testQuestions (`question`, answer, test_id) values ('What is 697 x 967?', '673999', 9);
INSERT INTO testQuestions (`question`, answer, test_id) values ('What is 598 x 286?', '171028', 9);
INSERT INTO testQuestions (`question`, answer, test_id) values ('What is 370 x 287?', '106190', 9);
INSERT INTO testQuestions (`question`, answer, test_id) values ('What is 412 x 196?', '80752', 9);
--  garbage test questions
INSERT INTO testQuestions (`question`, answer, test_id, imageUrl) values ('1', '1', 10, 'https://placehold.it/256x256');
INSERT INTO testQuestions (`question`, answer, test_id, imageUrl) values ('2', '2', 10, 'https://placehold.it/256x256');
INSERT INTO testQuestions (`question`, answer, test_id, imageUrl) values ('3', '3', 10, 'https://placehold.it/256x256');
INSERT INTO testQuestions (`question`, answer, test_id, imageUrl) values ('4', '4', 10, 'https://placehold.it/256x256');
INSERT INTO testQuestions (`question`, answer, test_id, imageUrl) values ('5', '5', 10, 'https://placehold.it/256x256');
INSERT INTO testQuestions (`question`, answer, test_id, imageUrl) values ('6', '6', 10, 'https://placehold.it/256x256');
INSERT INTO testQuestions (`question`, answer, test_id, imageUrl) values ('7', '7', 10, 'https://placehold.it/256x256');
INSERT INTO testQuestions (`question`, answer, test_id, imageUrl) values ('8', '8', 10, 'https://placehold.it/256x256');
INSERT INTO testQuestions (`question`, answer, test_id, imageUrl) values ('9', '9', 10, 'https://placehold.it/256x256');
INSERT INTO testQuestions (`question`, answer, test_id, imageUrl) values ('10', '10', 10, 'https://placehold.it/256x256');
INSERT INTO testQuestions (`question`, answer, test_id, imageUrl) values ('11', '11', 10, 'https://placehold.it/256x256');
INSERT INTO testQuestions (`question`, answer, test_id, imageUrl) values ('12', '12', 10, 'https://placehold.it/256x256');
INSERT INTO testQuestions (`question`, answer, test_id, imageUrl) values ('13', '13', 10, 'https://placehold.it/256x256');
INSERT INTO testQuestions (`question`, answer, test_id, imageUrl) values ('14', '14', 10, 'https://placehold.it/256x256');
INSERT INTO testQuestions (`question`, answer, test_id, imageUrl) values ('15', '15', 10, 'https://placehold.it/256x256');
INSERT INTO testQuestions (`question`, answer, test_id, imageUrl) values ('16', '16', 10, 'https://placehold.it/256x256');
INSERT INTO testQuestions (`question`, answer, test_id, imageUrl) values ('17', '17', 10, 'https://placehold.it/256x256');
INSERT INTO testQuestions (`question`, answer, test_id, imageUrl) values ('18', '18', 10, 'https://placehold.it/256x256');
INSERT INTO testQuestions (`question`, answer, test_id, imageUrl) values ('19', '19', 10, 'https://placehold.it/256x256');
INSERT INTO testQuestions (`question`, answer, test_id, imageUrl) values ('20', '20', 10, 'https://placehold.it/256x256');
INSERT INTO testQuestions (`question`, answer, test_id, imageUrl) values ('21', '21', 10, 'https://placehold.it/256x256');
INSERT INTO testQuestions (`question`, answer, test_id, imageUrl) values ('22', '22', 10, 'https://placehold.it/256x256');
INSERT INTO testQuestions (`question`, answer, test_id, imageUrl) values ('23', '23', 10, 'https://placehold.it/256x256');
INSERT INTO testQuestions (`question`, answer, test_id, imageUrl) values ('24', '24', 10, 'https://placehold.it/256x256');
INSERT INTO testQuestions (`question`, answer, test_id, imageUrl) values ('25', '25', 10, 'https://placehold.it/256x256');
INSERT INTO testQuestions (`question`, answer, test_id, imageUrl) values ('26', '26', 10, 'https://placehold.it/256x256');
INSERT INTO testQuestions (`question`, answer, test_id, imageUrl) values ('27', '27', 10, 'https://placehold.it/256x256');
INSERT INTO testQuestions (`question`, answer, test_id, imageUrl) values ('28', '28', 10, 'https://placehold.it/256x256');
INSERT INTO testQuestions (`question`, answer, test_id, imageUrl) values ('29', '29', 10, 'https://placehold.it/256x256');
INSERT INTO testQuestions (`question`, answer, test_id, imageUrl) values ('30', '30', 10, 'https://placehold.it/256x256');


-- User tests
--  user_test records
INSERT INTO user_tests (title, test_id, user_id, `date`) values ('addition user_test 01', 1, 2, '2019-03-01 00:00:00');
INSERT INTO user_tests (title, test_id, user_id, `date`) values ('addition user_test 02', 1, 2, '2019-03-01 00:01:00');
INSERT INTO user_tests (title, test_id, user_id, `date`) values ('addition user_test 03', 1, 2, '2019-03-01 00:02:00');
INSERT INTO user_tests (title, test_id, user_id, `date`) values ('addition user_test 04', 1, 2, '2019-03-01 00:03:00');
INSERT INTO user_tests (title, test_id, user_id, `date`) values ('addition user_test 05', 1, 2, '2019-03-01 00:04:00');
INSERT INTO user_tests (title, test_id, user_id, `date`) values ('addition user_test 06', 1, 2, '2019-03-01 00:05:00');
INSERT INTO user_tests (title, test_id, user_id, `date`) values ('addition user_test 07', 1, 2, '2019-03-01 00:06:00');
INSERT INTO user_tests (title, test_id, user_id, `date`) values ('addition user_test 08', 1, 2, '2019-03-01 00:07:00');
INSERT INTO user_tests (title, test_id, user_id, `date`) values ('addition user_test 09', 1, 2, '2019-03-01 00:08:00');
INSERT INTO user_tests (title, test_id, user_id, `date`) values ('addition user_test 10', 1, 2, '2019-03-01 00:09:00');

-- user_testQuestion records
INSERT INTO user_TestQuestions (userAnswer, testQuestion_id, user_Test_id) values ('14', 1, 1);
INSERT INTO user_TestQuestions (userAnswer, testQuestion_id, user_Test_id) values ('5', 2, 1);
INSERT INTO user_TestQuestions (userAnswer, testQuestion_id, user_Test_id) values ('8', 3, 1);
INSERT INTO user_TestQuestions (userAnswer, testQuestion_id, user_Test_id) values ('11', 4, 1);
INSERT INTO user_TestQuestions (userAnswer, testQuestion_id, user_Test_id) values ('1', 5, 1);

INSERT INTO user_TestQuestions (userAnswer, testQuestion_id, user_Test_id) values ('14', 1, 2);
INSERT INTO user_TestQuestions (userAnswer, testQuestion_id, user_Test_id) values ('5', 2, 2);
INSERT INTO user_TestQuestions (userAnswer, testQuestion_id, user_Test_id) values ('8', 3, 2);
INSERT INTO user_TestQuestions (userAnswer, testQuestion_id, user_Test_id) values ('111', 4, 2);
INSERT INTO user_TestQuestions (userAnswer, testQuestion_id, user_Test_id) values ('1', 5, 2);

INSERT INTO user_TestQuestions (userAnswer, testQuestion_id, user_Test_id) values ('a', 1, 3);
INSERT INTO user_TestQuestions (userAnswer, testQuestion_id, user_Test_id) values ('b', 2, 3);
INSERT INTO user_TestQuestions (userAnswer, testQuestion_id, user_Test_id) values ('c', 3, 3);
INSERT INTO user_TestQuestions (userAnswer, testQuestion_id, user_Test_id) values ('11', 4, 3);
INSERT INTO user_TestQuestions (userAnswer, testQuestion_id, user_Test_id) values ('1', 5, 3);

INSERT INTO user_TestQuestions (userAnswer, testQuestion_id, user_Test_id) values ('a', 1, 4);
INSERT INTO user_TestQuestions (userAnswer, testQuestion_id, user_Test_id) values ('5', 2, 4);
INSERT INTO user_TestQuestions (userAnswer, testQuestion_id, user_Test_id) values ('8', 3, 4);

INSERT INTO user_TestQuestions (userAnswer, testQuestion_id, user_Test_id) values ('14', 1, 5);
INSERT INTO user_TestQuestions (userAnswer, testQuestion_id, user_Test_id) values ('5', 2, 5);
INSERT INTO user_TestQuestions (userAnswer, testQuestion_id, user_Test_id) values ('8', 3, 5);

INSERT INTO user_TestQuestions (userAnswer, testQuestion_id, user_Test_id) values ('wrong', 1, 6);
INSERT INTO user_TestQuestions (userAnswer, testQuestion_id, user_Test_id) values ('also wrong', 2, 6);

INSERT INTO user_TestQuestions (userAnswer, testQuestion_id, user_Test_id) values ('14', 1, 7);

INSERT INTO user_TestQuestions (userAnswer, testQuestion_id, user_Test_id) values ('14', 1, 8);
INSERT INTO user_TestQuestions (userAnswer, testQuestion_id, user_Test_id) values ('5', 2, 8);
INSERT INTO user_TestQuestions (userAnswer, testQuestion_id, user_Test_id) values ('8', 3, 8);

INSERT INTO user_TestQuestions (userAnswer, testQuestion_id, user_Test_id) values ('wrong', 1, 9);
INSERT INTO user_TestQuestions (userAnswer, testQuestion_id, user_Test_id) values ('5', 2, 9);

INSERT INTO user_TestQuestions (userAnswer, testQuestion_id, user_Test_id) values ('14', 1, 10);
INSERT INTO user_TestQuestions (userAnswer, testQuestion_id, user_Test_id) values ('5', 2, 10);
INSERT INTO user_TestQuestions (userAnswer, testQuestion_id, user_Test_id) values ('8', 3, 10);
INSERT INTO user_TestQuestions (userAnswer, testQuestion_id, user_Test_id) values ('11', 4, 10);
INSERT INTO user_TestQuestions (userAnswer, testQuestion_id, user_Test_id) values ('1', 5, 10);

-- subject news post.
INSERT INTO posts (title, body, subject_id, user_id, modificationDate) values ('News post 1', '', 1, 2, '2019-03-01 00:01:00');
INSERT INTO posts (title, body, subject_id, user_id, modificationDate) values ('News post 2', '', 1, 2, '2019-03-01 00:02:00');
INSERT INTO posts (title, body, subject_id, user_id, modificationDate) values ('New lessons have been released!', 'New lessons have been released covering 2 and 3 digit addition.', 1, 2, '2019-03-01 00:02:00');
INSERT INTO posts (title, body, subject_id, user_id, modificationDate) values ('New test have been released!', 'New tests have been released covering 2 and 3 digit addition.', 1, 2, '2019-03-01 00:03:00');
INSERT INTO posts (title, body, subject_id, user_id, modificationDate) values ('News posts can be styled using Markdown and HTML.', '## This is a heading 2.

#### This is a heading 4.

Tables are also supported, although they can be a little awkward to use.

|Col 1 | Col 2 | Col 3|
|---|---|---|
|aaaaaaaaaa|aaaaaaaaaa|aaaaaaaaaa|
|bbb|bbb|bbb|

<center>Text can also be centered using < center > tags!</center>

<div style="color:red">Text can also be styled, such as changing the color to red!</div>

Though it requires using div or p tags with style attributes, e.g. < div style="color:red" > text < /div >

Also, images. Though they cannot have custom sizes.

![Placeholder image](https://placehold.it/256x256)

Images can also be centered using < center > tags.', 1, 2, '2019-03-01 00:05:00');


-- User chat messages.
INSERT INTO messages (message, `date`, sender_id) values ('Do you know the answers to the test?', '2019-04-01 00:00:00', 1);
INSERT INTO messages (message, `date`, sender_id) values ('Whch test?', '2019-04-01 00:00:50', 2);
INSERT INTO messages (message, `date`, sender_id) values ('*Which', '2019-04-01 00:00:52', 2);
INSERT INTO messages (message, `date`, sender_id) values ('Addition (3 digit)', '2019-04-01 00:01:00', 1);
INSERT INTO messages (message, `date`, sender_id) values ('Okay. Which question?', '2019-04-01 00:02:00', 2);
INSERT INTO messages (message, `date`, sender_id) values ('Uh, 123 + 123.', '2019-04-01 00:05:00', 1);
INSERT INTO messages (message, `date`, sender_id) values ('Really struggling to work out the answer.', '2019-04-01 00:06:00', 1);
INSERT INTO messages (message, `date`, sender_id) values ('Okay.', '2019-04-01 00:00:00', 2);
INSERT INTO messages (message, `date`, sender_id) values ('So you can break each number down by size.', '2019-04-01 00:07:00', 2);
INSERT INTO messages (message, `date`, sender_id) values ('What do you mean?', '2019-04-01 00:40:00', 1);
INSERT INTO messages (message, `date`, sender_id) values ('Basically break 123 down into 100, 20, 3.', '2019-04-01 00:50:00', 2);
INSERT INTO messages (message, `date`, sender_id) values ('Okay.', '2019-04-01 00:51:00', 1);
INSERT INTO messages (message, `date`, sender_id) values ('Makes sense.', '2019-04-01 00:52:00', 1);
INSERT INTO messages (message, `date`, sender_id) values ('Then what?', '2019-04-01 00:53:00', 1);
INSERT INTO messages (message, `date`, sender_id) values ('Add each of the bits together.', '2019-04-01 00:54:00', 2);
INSERT INTO messages (message, `date`, sender_id) values ('Then add the results together.', '2019-04-01 00:55:00', 2);
INSERT INTO messages (message, `date`, sender_id) values ('So do 100 + 100, then 20 + 20, then 3 + 3.', '2019-04-01 00:56:00', 2);
INSERT INTO messages (message, `date`, sender_id) values ('Then add the result together.', '2019-04-01 00:57:00', 2);
INSERT INTO messages (message, `date`, sender_id) values ('Okay, thanks.', '2019-04-01 00:58:00', 1);
INSERT INTO messages (message, `date`, sender_id) values ('I got it right.', '2019-04-01 00:59:00', 1);

INSERT INTO user_messages (message_id, user_id) values (1, 2);
INSERT INTO user_messages (message_id, user_id) values (2, 1);
INSERT INTO user_messages (message_id, user_id) values (3, 1);
INSERT INTO user_messages (message_id, user_id) values (4, 2);
INSERT INTO user_messages (message_id, user_id) values (5, 1);
INSERT INTO user_messages (message_id, user_id) values (6, 2);
INSERT INTO user_messages (message_id, user_id) values (7, 2);
INSERT INTO user_messages (message_id, user_id) values (8, 1);
INSERT INTO user_messages (message_id, user_id) values (9, 1);
INSERT INTO user_messages (message_id, user_id) values (10, 2);
INSERT INTO user_messages (message_id, user_id) values (11, 1);
INSERT INTO user_messages (message_id, user_id) values (12, 2);
INSERT INTO user_messages (message_id, user_id) values (13, 2);
INSERT INTO user_messages (message_id, user_id) values (14, 2);
INSERT INTO user_messages (message_id, user_id) values (15, 1);
INSERT INTO user_messages (message_id, user_id) values (16, 1);
INSERT INTO user_messages (message_id, user_id) values (17, 1);
INSERT INTO user_messages (message_id, user_id) values (18, 1);
INSERT INTO user_messages (message_id, user_id) values (19, 2);
INSERT INTO user_messages (message_id, user_id) values (20, 2);


-- Groups
INSERT INTO groups (name, description, imageUrl) values ('Blue Group', 'This is the description for the blue group.

---

The **best** group.', 'https://placehold.it/512');
INSERT INTO groups (name, description, imageUrl) values ('Red Group', 'This is the description for the red group.

---

The *best* group.', 'https://placehold.it/512');
INSERT INTO groups (name, description, imageUrl) values ('Yellow Group', 'This is the description for the yellow group.

---

The ~best~ most awesome group...', '');
INSERT INTO groups (name, description, imageUrl) values ('Gold Group', 'This is the description for the gold group.

---

## G O L D', '');
INSERT INTO groups (name, description, imageUrl) values ('Yet another Group', 'Just another group...

Turns out the separator line is optional.

## codeblock!!
```
function fizzbuzz(n) {
    return \'No.\';
}
```', '');
-- Group members
INSERT INTO user_groups (group_id, user_id) values (1, 1);
INSERT INTO user_groups (group_id, user_id) values (1, 2);
INSERT INTO user_groups (group_id, user_id) values (1, 4);
INSERT INTO user_groups (group_id, user_id) values (1, 5);
INSERT INTO user_groups (group_id, user_id) values (1, 6);

INSERT INTO user_groups (group_id, user_id) values (2, 1);
INSERT INTO user_groups (group_id, user_id) values (2, 2);
INSERT INTO user_groups (group_id, user_id) values (2, 4);
INSERT INTO user_groups (group_id, user_id) values (2, 5);

INSERT INTO user_groups (group_id, user_id) values (3, 1);
INSERT INTO user_groups (group_id, user_id) values (3, 2);
INSERT INTO user_groups (group_id, user_id) values (3, 4);
INSERT INTO user_groups (group_id, user_id) values (3, 11);
INSERT INTO user_groups (group_id, user_id) values (3, 26);

INSERT INTO user_groups (group_id, user_id) values (4, 27);
INSERT INTO user_groups (group_id, user_id) values (4, 1);
INSERT INTO user_groups (group_id, user_id) values (4, 4);
INSERT INTO user_groups (group_id, user_id) values (4, 5);
INSERT INTO user_groups (group_id, user_id) values (4, 17);
INSERT INTO user_groups (group_id, user_id) values (4, 16);
INSERT INTO user_groups (group_id, user_id) values (4, 14);
INSERT INTO user_groups (group_id, user_id) values (4, 18);

INSERT INTO user_groups (group_id, user_id) values (5, 18);
INSERT INTO user_groups (group_id, user_id) values (5, 1);
INSERT INTO user_groups (group_id, user_id) values (5, 4);


-- Group messages
