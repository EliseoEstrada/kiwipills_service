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

CREATE TABLE IF NOT EXISTS medicines(
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(200),
    description VARCHAR(500),
    startDate DATE, 
    startTime TIME,
    duration INT,
    hoursInterval INT,

    monday BIT,
    thuesday BIT,
    wednesday BIT,
    thursday BIT,
    friday BIT,
    saturday BIT,
    sunday BIT,
    image longblob
)


#//////////////////////////////////////////////////////////////
#                           PROCEDURES
#//////////////////////////////////////////////////////////////


DELIMITER $%
CREATE PROCEDURE sp_signup (
    IN p_email VARCHAR(200),
    IN p_password VARCHAR(100),
    IN p_username VARCHAR(100),
    IN p_name VARCHAR(100),
    IN p_lastname01 VARCHAR(100),
    IN p_lastname02 VARCHAR(100),
    IN p_phone VARCHAR(15),
    IN p_image LONGBLOB
)
BEGIN

    INSERT INTO users
    SET
    email       = p_email,
    password    = p_password,
    username    = p_username,
    name        = p_name,
    lastname01  = p_lastname01,
    lastname02  = p_lastname02,
    phone       = p_phone,
    image       = p_image;

    SELECT id, email, password, username, name, lastname01, lastname02, phone, image
    FROM users 
    WHERE id= LAST_INSERT_ID();

END $%
DELIMITER ;


DELIMITER $%
CREATE PROCEDURE sp_login (
    IN p_email VARCHAR(200),
    IN p_password VARCHAR(100)
)
BEGIN

    SELECT id, email, password, username, name, lastname01, lastname02, phone, image
    FROM users 
    WHERE email = p_email AND password = p_password;

END $%
DELIMITER ;


DELIMITER $%
CREATE PROCEDURE sp_addMedicine (
    IN p_name VARCHAR(200),
    IN p_description VARCHAR(500),
    IN p_startDate DATE,
    IN p_duration INT,
    IN p_daysInterval INT,
    IN p_hoursInterval INT,
    IN p_startTime TIME
)
BEGIN

    INSERT INTO medicines
    SET
    name            = p_name,
    description     = p_description,
    startDate       = p_startDate,
    duration        = p_duration,
    daysInterval    = p_daysInterval,
    hoursInterval   = p_hoursInterval,
    startTime       = p_startTime;

END $%
DELIMITER ;


#call sp_addMedicine('name', 'description', '2008-7-04', 1, 2, 3, '08:30');
#http://localhost/kiwipills/medicine/add&name=e&description=desc&startDate=2008-7-04&duration=1&daysInterval=2&hoursInterval=3&startTime=8:30