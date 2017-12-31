CREATE DATABASE cogman;

USE cogman;
CREATE TABLE helpsession (
	id INT AUTO_INCREMENT PRIMARY KEY,
    stime DATETIME,
    room VARCHAR(5),
    topics TINYTEXT,
    courseID VARCHAR(5) REFERENCES course(id),
    incharge INT REFERENCES executive(id),
    batch VARCHAR(5)
);

CREATE TABLE user (
	reg INT PRIMARY KEY,
    fname VARCHAR(25),
    lname VARCHAR(25),
    email VARCHAR(35),
    pass CHAR(64) NOT NULL,
    cellno INT,
    batch VARCHAR(5)
);

CREATE TABLE mentor (
	id INT REFERENCES student(id),
    residence CHAR(1), # H or D
    speechRating FLOAT,
    knowledgeRating FLOAT,
    presentationRating FLOAT,
    studyMaterialRating FLOAT,
    timeManagementRating FLOAT,
    interationRating FLOAT,
    QARating FLOAT,
    PRIMARY KEY(id)
);

CREATE TABLE executive (
	id INT REFERENCES student(id),
    role VARCHAR(25),
    PRIMARY KEY(id)
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
    course INT REFERENCES course(id),
    strength TEXT,
    PRIMARY KEY(mentorID, course)
);

CREATE TABLE wants_to_study (
	stdID INT REFERENCES student(id),
    courseID INT REFERENCES course(id)
);

CREATE TABLE feedback (
	mentorID INT REFERENCES mentor(id),
    sessID INT REFERENCES helpsession(id),
    stdID INT REFERENCES mentor(id),
    speechRating FLOAT,
    knowledgeRating FLOAT,
    presentationRating FLOAT,
    studyMaterialRating FLOAT,
    timeManagementRating FLOAT,
    interationRating FLOAT,
    QARating FLOAT,
    suggestions TEXT,
    PRIMARY KEY(stdID, mentorID, sessID)
);