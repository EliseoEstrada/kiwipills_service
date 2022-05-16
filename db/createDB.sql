CREATE DATABASE IF NOT EXISTS kiwipills;

USE kiwipills;

CREATE TABLE IF NOT EXISTS users(
    id INT AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(200) NOT NULL,
    password VARCHAR(100) NOT NULL,
    username VARCHAR(100) NOT NULL,
    name VARCHAR(100),
    lastname01 VARCHAR(100),
    lastname02 VARCHAR(100),
    phone VARCHAR(15),
    image longblob
)

CREATE TABLE IF NOT EXISTS medicaments(
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    FOREIGN KEY (user_id) REFERENCES users(id),

    name VARCHAR(200),
    description VARCHAR(500),
    startDate DATE, 
    startTime TIME,
    duration INT,
    hoursInterval INT,

    monday BOOLEAN,
    thuesday BOOLEAN,
    wednesday BOOLEAN,
    thursday BOOLEAN,
    friday BOOLEAN,
    saturday BOOLEAN,
    sunday BOOLEAN,
    image longblob
)