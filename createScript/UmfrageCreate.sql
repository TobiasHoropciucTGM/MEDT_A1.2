DROP DATABASE IF EXISTS MEDTA12;
CREATE DATABASE MEDTA12;
USE MEDTA12;

CREATE TABLE user (
    id INT PRIMARY KEY AUTO_INCREMENT,
    username VARCHAR(255)
);

CREATE TABLE messages (
    id INT PRIMARY KEY AUTO_INCREMENT,
    user INT,
    messageText TEXT,
    FOREIGN KEY (user) REFERENCES user(id)
);


CREATE TABLE poll(
   id INT PRIMARY KEY AUTO_INCREMENT,
   question TEXT,
   pollCreatorID int,
   FOREIGN KEY (pollCreatorID) REFERENCES user(id),
);

CREATE TABLE voteGroups (
    id INT PRIMARY KEY AUTO_INCREMENT,
    pollID INT,
    userID INT,
    FOREIGN KEY (pollID) REFERENCES poll(id),
    FOREIGN KEY (userID) REFERENCES user(id)
);

CREATE TABLE votes (
    id INT PRIMARY KEY AUTO_INCREMENT,
    pollID INT,
    userID,
    vote BOOLEAN,
    FOREIGN KEY (pollID) REFERENCES poll(id),
    FOREIGN KEY (userID) REFERENCES user(id)
);