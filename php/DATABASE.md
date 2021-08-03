### SQL Commands to create the database

# THIS WILL RESET THE ENTIRE DATABASE
DROP DATABASE habits;
CREATE DATABASE habits;
USE habits;
CREATE TABLE users (
    id int NOT NULL AUTO_INCREMENT,
	first_name varchar(45),
    last_name varchar(45),
    email varchar(200),
    password varchar(200),
    PRIMARY KEY(id)
);

CREATE TABLE tokens (
    id int NOT NULL AUTO_INCREMENT,
    token longtext,
    user_id int,
    PRIMARY KEY (id),
    FOREIGN KEY (user_id) REFERENCES users(id)
);

CREATE TABLE habits (
    id int NOT NULL AUTO_INCREMENT,
    name varchar(200),
    description longtext,
    frequency longtext,
    goal int,
    user_id int,
    PRIMARY KEY (id),
    FOREIGN KEY (user_id) REFERENCES users(id)
);

CREATE TABLE habits_completed (
    id int NOT NULL AUTO_INCREMENT,
    habit_id int,
    time_completed bigint,
    PRIMARY KEY (id),
    FOREIGN KEY (habit_it) REFERENCES habits(id)
);

