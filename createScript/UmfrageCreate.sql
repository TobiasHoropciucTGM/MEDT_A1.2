DROP DATABASE IF EXISTS medta12;
CREATE DATABASE medta12;
USE medta12;

CREATE TABLE users (
    id INT PRIMARY KEY AUTO_INCREMENT,
    usersname VARCHAR(255),
    email Text,
    password TEXT
);

CREATE TABLE messages (
    id INT PRIMARY KEY AUTO_INCREMENT,
    users INT,
    messageText TEXT,
    FOREIGN KEY (users) REFERENCES users(id)
);


CREATE TABLE poll(
   id INT PRIMARY KEY AUTO_INCREMENT,
   pollTitle TEXT,
   pollCreatorID int,
   public BOOLEAN,
   FOREIGN KEY (pollCreatorID) REFERENCES users(id)
);

CREATE TABLE questions (
    id INT PRIMARY KEY AUTO_INCREMENT,
    question TEXT,
    pollID int,
    FOREIGN KEY (pollID) REFERENCES poll(id)
);

CREATE TABLE votes (
    id INT PRIMARY KEY AUTO_INCREMENT,
    questionID INT,
    usersID INT,
    vote BOOLEAN,
    anonym BOOLEAN,
    FOREIGN KEY (questionID) REFERENCES questions(id),
    FOREIGN KEY (usersID) REFERENCES users(id)
);