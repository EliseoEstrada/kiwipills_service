
#//////////////////////////INICIAR SESION//////////////////////////

SELECT id, email, password, username, name, lastname01, lastname02, phone, image
FROM users 
WHERE email = :email AND password = :password;


#//////////////////////////REGISTRARSE//////////////////////////

INSERT INTO users
    SET
    email       = :email,
    password    = :password,
    username    = :username,
    name        = :name,
    lastname01  = :lastname01,
    lastname02  = :lastname02,
    phone       = :phone,
    image       = :image;



#//////////////////////////AGREGAR MEDICAMENTO//////////////////////////
INSERT INTO medicaments
    SET
    user_id         = :user_id,   
    name            = :name,
    description     = :description,
    startDate       = STR_TO_DATE(:startDate,"%d/%m/%y"),
    startTime       = :startTime,
    duration        = :duration,
    hoursInterval   = :hoursInterval,
    monday          = :monday,
    thuesday        = :thuesday,
    wednesday       = :wednesday,
    thursday        = :thursday,
    friday          = :friday,
    saturday        = :saturday,
    sunday          = :sunday,
    image           = :image;