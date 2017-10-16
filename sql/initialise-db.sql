DROP DATABASE IF EXISTS capturepinas;

CREATE DATABASE IF NOT EXISTS capturepinas;

USE capturepinas;

CREATE TABLE users (
    id INTEGER NOT NULL AUTO_INCREMENT,
    PRIMARY KEY(id),
    username VARCHAR(20) NOT NULL UNIQUE,
    fullname VARCHAR(30) NOT NULL,
    email VARCHAR(30) NOT NULL,
    password VARCHAR(256) NOT NULL
)   ENGINE=InnoDB;

CREATE TABLE post(
    postid INTEGER NOT NULL AUTO_INCREMENT,
    userid INTEGER NOT NULL REFERENCES users,
    title VARCHAR(50) NOT NULL,
    place VARCHAR(30) NOT NULL,
    description VARCHAR(256) NOT NULL,
    likes INTEGER NOT NULL,
    dislikes INTEGER NOT NULL,
    favnum INTEGER NOT NULL,
    timestamp TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY(postid)
)   ENGINE=InnoDB;

CREATE TABLE postcomments(
    postid INTEGER NOT NULL REFERENCES post,
    commentid INTEGER NOT NULL AUTO_INCREMENT,
    userid INTEGER NOT NULL REFERENCES post,
    content VARCHAR(200) NOT NULL,
    likes INTEGER NOT NULL,
    dislikes INTEGER NOT NULL,
    timestamp TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY(commentid)
)   ENGINE=InnoDB;

CREATE TABLE postmedia(
    postid INTEGER NOT NULL REFERENCES post,
    filepath VARCHAR(100) NOT NULL
)    ENGINE=InnoDB;

CREATE TABLE userinfo(
    id INTEGER NOT NULL REFERENCES users,
    filepath VARCHAR(100) NOT NULL,
    bio VARCHAR(500) NOT NULL,
    PRIMARY KEY(id)
)    ENGINE=InnoDB;

CREATE TABLE userfav(
    id INTEGER NOT NULL REFERENCES users,
    postid INTEGER NOT NULL REFERENCES post
)    ENGINE=InnoDB;

-- CREATE TABLE postopinion(                     -- ORIGINAL VERSION, GONNA TRY SOME foreign key things 
--     postid INTEGER NOT NULL REFERENCES post,
--     userid INTEGER NOT NULL REFERENCES post,
--     opinion CHAR(1) NOT NULL
-- )    ENGINE=InnoDB;
CREATE TABLE postopinion(
    postid INTEGER NOT NULL REFERENCES post,
    userid INTEGER NOT NULL REFERENCES post,
    opinion CHAR(1) NOT NULL
)    ENGINE=InnoDB;

CREATE TABLE commentopinion(
    commentid INTEGER NOT NULL REFERENCES postcomments,
    userid INTEGER NOT NULL REFERENCES postcomments,
    opinion CHAR(1) NOT NULL
)    ENGINE=InnoDB;