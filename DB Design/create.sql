CREATE DATABASE cogman;

USE cogman;
CREATE TABLE helpsession (
	id INT AUTO_INCREMENT PRIMARY KEY,
    stime VARCHAR(99),
    room VARCHAR(5),
    topics TINYTEXT,
    courseID VARCHAR(7) REFERENCES course(id),
    incharge INT REFERENCES executive(id),
    batch VARCHAR(5)
);


CREATE TABLE user (
	reg INT PRIMARY KEY,
    fname VARCHAR(25),
    lname VARCHAR(25),
    email VARCHAR(35),
    pass CHAR(64) NOT NULL,
    cellno VARCHAR(11),
    residence CHAR(1), # H or D
    batch VARCHAR(5)
);

CREATE TABLE mentor (
	id INT,
    speechRating FLOAT,
    knowledgeRating FLOAT,
    presentationRating FLOAT,
    studyMaterialRating FLOAT,
    timeManagementRating FLOAT,
    interationRating FLOAT,
    QARating FLOAT,
    rating FLOAT,
    PRIMARY KEY(id),
    FOREIGN KEY (id) REFERENCES user(reg) ON DELETE CASCADE
);

CREATE TABLE executive (
	id INT,
    role VARCHAR(25),
    PRIMARY KEY(id),
    FOREIGN KEY (id) REFERENCES user(reg) ON DELETE CASCADE
);

CREATE TABLE course (
	id VARCHAR(7) PRIMARY KEY,
    cname VARCHAR(65),
    dept VARCHAR(4) # abbreviation
);

CREATE TABLE experience (
	mentorID INT UNIQUE REFERENCES mentor(id),
    period INT,
    description TEXT
);

CREATE TABLE registers (
	stdID INT REFERENCES student(id),
    sessID INT REFERENCES helpsession(id),
    attended BOOLEAN,
    PRIMARY KEY(stdID, sessID)
);

CREATE TABLE teaches (
	mentorID INT REFERENCES mentor(id),
    sessID INT REFERENCES helpsession(id)
);

CREATE TABLE can_teach (
	mentorID INT REFERENCES mentor(id),
    course VARCHAR(7) REFERENCES course(id),
    strength TEXT,
    rating FLOAT,
    PRIMARY KEY(mentorID, course)
);

CREATE TABLE wants_to_study (
	stdID INT REFERENCES student(id),
    courseID VARCHAR(7) REFERENCES course(id),
    PRIMARY KEY (stdID, courseID)
);

CREATE TABLE feedback (
	mentorID INT REFERENCES mentor(id),
    sessID INT REFERENCES helpsession(id),
    stdID INT REFERENCES user(id),
    speechRating FLOAT,
    knowledgeRating FLOAT,
    presentationRating FLOAT,
    studyMaterialRating FLOAT,
    timeManagementRating FLOAT,
    interationRating FLOAT,
    QARating FLOAT,
    suggestions TEXT,
    ftime timestamp,
    PRIMARY KEY(stdID, mentorID, sessID)
);

CREATE TABLE admins (
	username VARCHAR(20) PRIMARY KEY,
    pass CHAR(64) NOT NULL
);