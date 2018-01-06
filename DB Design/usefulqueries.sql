# mentors and courses
select reg, fname, lname, email, cellno, residence, course.id, cname, strength, can_teach.rating from user join mentor on user.reg = mentor.id join can_teach on mentor.id = can_teach.mentorID join course on can_teach.course = course.id order by can_teach.rating DESC;

# list of mentors
SELECT reg, fname, lname, email, cellno, batch, residence, rating from user join mentor on user.reg = mentor.id;

