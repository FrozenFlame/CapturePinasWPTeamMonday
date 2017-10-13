DROP DATABASE IF EXISTS test_db;

CREATE DATABASE IF NOT EXISTS test_db;

USE test_db;

CREATE TABLE test_db (
    id INT(11)
    NOT NULL AUTO_INCREMENT,
    PRIMARY KEY(id),
    name varchar(255),
    password varchar(255),
    secrets varchar(255)
)   ENGINE=InnoDB
    COLLATE utf8_general_ci;
    

INSERT INTO test_db (id, name, password, secrets) VALUES
    (NULL,"user1","user1pass","User 1's secret data"),
    (NULL,"user2","user2pass","User 2's secret data"),
    (NULL,"user3","user3pass","User 3's secret data"),
    (NULL,"user4","user4pass","User 4's secret data"),
    (NULL,"user5","user5pass","User 5's secret data"),
    (NULL,"user6","user6pass","User 6's secret data"),
    (NULL,"user7","user7pass","User 7's secret data"),
    (NULL,"user8","user8pass","User 8's secret data"),
    (NULL,"user9","user9pass","User 9's secret data"),
    (NULL,"user10","user10pass","User 10's secret data")
;