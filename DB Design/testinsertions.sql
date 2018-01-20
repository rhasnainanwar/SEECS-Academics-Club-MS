insert into can_teach(mentorID, course, strength, rating) values (192135, 'MATH112', 'ODEs', 4.6);
insert into can_teach(mentorID, course, strength, rating) values (192135, 'CS220', 'Normalization', 3.6);
insert into can_teach(mentorID, course, strength, rating) values (182599, 'CS250', 'trees', 4.6);
insert into wants_to_study(stdID, courseID) values (192135, 'CS110');
insert into wants_to_study(stdID, courseID) values (192135, 'CS250');
insert into feedback (mentorID, sessID, stdID, suggestions, ftime) VALUES (192135, 1, 182599, 'The mentor needs to give more time to the presentation', '2018-01-09 14:25:00');
insert into helpsession (stime, room, topics, courseID, incharge, batch) VALUES ('2018-01-09 14:0', 'CR-15', 'Series', 'CS110', 182599, 'BSCS7');
insert into registers(stdID, sessID, attended) values (182599, 1, true);
insert into registers(stdID, sessID, attended) values (192135, 1, false);