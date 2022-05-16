
#//////////////////////////////////////////////////////////////
#                           PROCEDURES
#//////////////////////////////////////////////////////////////


#//////////////////////////REGISTRARSE//////////////////////////

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

END $%
DELIMITER ;


#//////////////////////////INICIAR SESION//////////////////////////

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

#//////////////////////////EDITAR PERFIL//////////////////////////

DELIMITER $%
CREATE PROCEDURE sp_editProfile (
    IN p_password VARCHAR(100),
    IN p_username VARCHAR(100),
    IN p_name VARCHAR(100),
    IN p_lastname01 VARCHAR(100),
    In p_lastname02 VARCHAR(100),
    IN p_phone VARCHAR(15),
    IN p_image longblob
)
BEGIN

    UPDATE users SET password = p_password, username = p_username, name = p_name,
    lastname01 = p_lastname01, lastname02 = p_lastname02, phone = p_phone, image = p_image;

END $%
DELIMITER ;

#//////////////////////////AGREGAR MEDICAMENTO//////////////////////////

DELIMITER $%
CREATE PROCEDURE sp_addMedicament (
    IN p_user_id INT,
    IN p_name VARCHAR(200),
    IN p_description VARCHAR(500),
    IN p_startDate VARCHAR(20),
    IN p_startTime TIME,
    IN p_duration INT,
    IN p_hoursInterval INT,
    IN p_monday BOOLEAN,
    IN p_thuesday BOOLEAN,
    IN p_wednesday BOOLEAN,
    IN p_thursday BOOLEAN,
    IN p_friday BOOLEAN,
    IN p_saturday BOOLEAN,
    IN p_sunday BOOLEAN,
    IN p_image LONGBLOB
)
BEGIN

    INSERT INTO medicaments
    SET
    user_id         = p_user_id,   
    name            = p_name,
    description     = p_description,
    startDate       = STR_TO_DATE(p_startDate,"%d/%m/%Y"),
    startTime       = p_startTime,
    duration        = p_duration,
    hoursInterval   = p_hoursInterval,
    monday          = p_monday,
    thuesday        = p_thuesday,
    wednesday       = p_wednesday,
    thursday        = p_thursday,
    friday          = p_friday,
    saturday        = p_saturday,
    sunday          = p_sunday,
    image           = p_image;

END $%
DELIMITER ;


#//////////////////////////OBTENER TODOS LOS MEDICAMENTOS POR USUARO//////////////////////////

DELIMITER $%
CREATE PROCEDURE sp_getAllMedicaments (
    IN p_user_id INT
)
BEGIN

    SELECT 
        id,
        user_id,
        name,           
        description,    
        startDate,      
        TIME_FORMAT(startTime, '%h:%i') startTime,      
        duration,       
        hoursInterval,  
        monday,         
        thuesday,       
        wednesday,      
        thursday,       
        friday,         
        saturday,       
        sunday,         
        image   
    FROM medicaments 
    WHERE user_id = p_user_id;

END $%
DELIMITER ;

DELIMITER $%

#//////////////////////////VERIFICAR QUE USUARIO NO EXISTA AL REGISTRARSE//////////////////////////

CREATE PROCEDURE sp_check_user (

    IN p_email VARCHAR(200)

)

BEGIN

    SELECT email

    FROM users

    WHERE email = p_email;


END $%
DELIMITER ;
