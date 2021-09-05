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

ALTER TABLE `users` ADD UNIQUE(`email`);

CREATE TABLE habits (
    id int NOT NULL AUTO_INCREMENT,
    name varchar(200),
    description longtext,
    frequency longtext,
    start_date int,
    user_id int,
    PRIMARY KEY (id),
    FOREIGN KEY (user_id) REFERENCES users(id)
);

CREATE TABLE habits_completed (
    id int NOT NULL AUTO_INCREMENT,
    habit_id int,
    time_completed bigint,
    PRIMARY KEY (id),
    FOREIGN KEY (habit_id) REFERENCES habits(id) ON DELETE CASCADE
);