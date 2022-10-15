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

CREATE TABLE telefones(
    id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    ddi INT NOT NULL,
    ddd INT NOT NULL,
	telefone int NOT NULL,
    telefoneCompleto VARCHAR(20) NOT NULL
);

CREATE TABLE contatos(
	id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    idTelefoneContato INT NOT NULL,
    idTelefoneUser INT NOT NULL,
    telefoneUser VARCHAR(20) NOT NULL,
    telefoneContato VARCHAR(20) NOT NULL,
    solicitacao BOOLEAN NOT NULL
);