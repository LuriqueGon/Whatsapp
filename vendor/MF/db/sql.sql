CREATE DATABASE whatsapp;
use whatsapp;

CREATE TABLE users (
	id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    email VARCHAR(250) NOT NULL,
    senha VARCHAR(32) NOT NULL
);

CREATE TABLE users_implements(
    id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    email VARCHAR(250) NOT NULL,
    nome VARCHAR(100) NOT NULL,
    telefone INT NOT NULL,
    img VARCHAR(250),
    
    FOREIGN KEY(email) REFERENCES users(email)
);