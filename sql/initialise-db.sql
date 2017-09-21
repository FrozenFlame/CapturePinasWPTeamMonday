DROP DATABASE IF EXISTS capturepinas;

CREATE DATABASE IF NOT EXISTS capturepinas;

USE capturepinas;

CREATE TABLE users (
    id INTEGER NOT NULL AUTO_INCREMENT,
    PRIMARY KEY(id),
    username VARCHAR(20) NOT NULL,
    fullname VARCHAR(30), email VARCHAR(30),
    password VARCHAR(20) NOT NULL,
    activated VARCHAR(15)
)   ENGINE=InnoDB;

CREATE TABLE post(
    postid INTEGER NOT NULL AUTO_INCREMENT,
    userid INTEGER NOT NULL REFERENCES users,
    place VARCHAR(30) NOT NULL,
    isMedia VARCHAR(5) NOT NULL,
    description VARCHAR(200),
    likes INTEGER,
    dislikes INTEGER,
    favnum INTEGER,
    timestamp VARCHAR(30),
    PRIMARY KEY(postid)
)   ENGINE=InnoDB;

CREATE TABLE postcomments(
    postid INTEGER NOT NULL REFERENCES post,
    userid INTEGER NOT NULL REFERENCES post,
    content VARCHAR(200) NOT NULL,
    likes INTEGER,
    dislikes INTEGER
)   ENGINE=InnoDB;

CREATE TABLE postmedia(
    postid INTEGER NOT NULL REFERENCES post,
    filepath VARCHAR(100) NOT NULL
)    ENGINE=InnoDB;

CREATE TABLE userinfo(
    id INTEGER NOT NULL REFERENCES users,
    filepath VARCHAR(100),
    bio VARCHAR(500),
    PRIMARY KEY(id)
)    ENGINE=InnoDB;

CREATE TABLE userfav(
    id INTEGER NOT NULL REFERENCES users,
    postid INTEGER NOT NULL REFERENCES post
)    ENGINE=InnoDB;