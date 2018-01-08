# mentors and courses
select reg, fname, lname, email, cellno, residence, course.id, cname, strength, can_teach.rating from user join mentor on user.reg = mentor.id join can_teach on mentor.id = can_teach.mentorID join course on can_teach.course = course.id order by can_teach.rating DESC;

# list of mentors
SELECT reg, fname, lname, email, cellno, batch, residence, rating from user join mentor on user.reg = mentor.id;

# mentors
SELECT reg, fname, lname, email, cellno, batch, residence, role FROM user JOIN executive ON reg = id; 

# wants to study
SELECT id, cname, dept FROM course JOIN wants_to_study ON courseID = id WHERE stdID = 192135;

# remaining courses

SELECT id, cname, dept FROM course WHERE id NOT IN ( SELECT courseID FROM wants_to_study WHERE stdID = 192135);

# can teach
SELECT mentorID FROM can_teach WHERE mentorID = 192135 && course = 'CS123';