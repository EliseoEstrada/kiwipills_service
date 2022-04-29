CREATE DATABASE IF NOT EXISTS kiwipills;

CREATE TABLE IF NOT EXISTS users(
    id INT AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(200) NOT NULL,
    password VARCHAR(100) NOT NULL,
    username VARCHAR(100) NOT NULL,
    name VARCHAR(100),
    lastname01 VARCHAR(100),
    lastname02 VARCHAR(100),
    phone VARCHAR(15)
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
    IN p_phone VARCHAR(15)
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
    phone       = p_phone;

    SELECT id, email, password, username, name, lastname01, lastname02, phone 
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

    SELECT id, email, password, username, name, lastname01, lastname02, phone 
    FROM users 
    WHERE email = p_email AND password = p_password;

END $%
DELIMITER ;


DELIMITER $%
CREATE PROCEDURE sp_check_user (
    IN p_email VARCHAR(200)
)
BEGIN

    SELECT email
    FROM users 
    WHERE email = p_email;

END $%
DELIMITER ; 