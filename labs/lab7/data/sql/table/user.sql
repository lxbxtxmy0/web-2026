CREATE TABLE user
(
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    first_name VARCHAR(50) NOT NULL,
    last_name VARCHAR(50) NOT NULL,
    avatar_source VARCHAR(255) NOT NULL,
    bio TEXT NULL
);

CREATE TABLE user_credentials_registry
(
    user_id INT NOT NULL PRIMARY KEY ,
    email VARCHAR(50) NOT NULL,
    password VARCHAR(50) NOT NULL,
    CONSTRAINT users_id_fk
    FOREIGN KEY (user_id)
    REFERENCES users (id) ON DELETE CASCADE
);
