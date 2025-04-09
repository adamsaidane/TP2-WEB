CREATE DATABASE school_db;

USE school_db;

CREATE TABLE users (
    id INT PRIMARY KEY AUTO_INCREMENT,
    username VARCHAR(50) NOT NULL UNIQUE,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    role ENUM('admin', 'user') NOT NULL DEFAULT 'user'
);

CREATE TABLE sections (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(100) NOT NULL,
    description VARCHAR(255) NOT NULL
);

CREATE TABLE students (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(100) NOT NULL,
    birthday DATE NOT NULL,
    image VARCHAR(255),
    section_id INT,
    FOREIGN KEY (section_id) REFERENCES sections(id) ON DELETE SET NULL
);


INSERT INTO users (username, email, password, role) VALUES
('admin', 'admin@gmail.com', 'admin123', 'admin'),
('user', 'user@gmail.com', 'user123', 'user');

INSERT INTO sections (name,description) VALUES
('GL','Genie Logiciel'),
('RT','Réseau et télécommunication');

INSERT INTO students (name, birthday, section_id) VALUES
('Ahmed', '2003-04-12',1),
('Yassine', '2002-11-30',1),
('Mohamed', '2004-06-25',2);