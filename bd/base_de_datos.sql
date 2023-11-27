CREATE DATABASE finalsemestre;
USE finalsemestre;

CREATE TABLE Usuario(
	idUsuario INT PRIMARY KEY AUTO_INCREMENT,
    nombre VARCHAR(50) NOT NULL,
    apellido VARCHAR(50) NOT NULL,
    correo VARCHAR(100) NOT NULL,
    contrasena VARCHAR(255) NOT NULL,
    fecha_registro TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE Contacto(
	idContacto INT PRIMARY KEY AUTO_INCREMENT,
    nombre2 VARCHAR(50) NOT NULL,
    apellido2 VARCHAR(50) NOT NULL,
    correo2 VARCHAR(100) NOT NULL,
    numero VARCHAR(15) NOT NULL,
    comentario VARCHAR(300) NOT NULL,
    fecha_registro2 TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE Administrador(
	idAdministrador INT PRIMARY KEY AUTO_INCREMENT,
    correo2 VARCHAR(200) NOT NULL,
    contrasena2 VARCHAR(200) NOT NULL,
    fecha_registro TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

INSERT INTO Administrador(correo2, contrasena2) VALUES ("mark123@gmail.com", sha("admin2132"));

CREATE TABLE Tarea(
	idTarea INT PRIMARY KEY AUTO_INCREMENT,
    titulo VARCHAR(255),
    descripcion TEXT,
    images VARCHAR(255),
    precio FLOAT(10,2),
    fecha_registro TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE Tarea2(
	idTarea2 INT PRIMARY KEY AUTO_INCREMENT,
    titulo2 VARCHAR(255),
    descripcion2 TEXT,
    images2 VARCHAR(255),
    precio2 FLOAT(10,2),
    fecha_registro2 TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE Tarea3(
	idTarea3 INT PRIMARY KEY AUTO_INCREMENT,
    titulo3 VARCHAR(255),
    descripcion3 TEXT,
    images3 VARCHAR(255),
    precio3 FLOAT(10,2),
    fecha_registro3 TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE Tarea4(
	idTarea4 INT PRIMARY KEY AUTO_INCREMENT,
    titulo4 VARCHAR(255),
    descripcion4 TEXT,
    images4 VARCHAR(255),
    precio4 FLOAT(10,2),
    fecha_registro4 TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE Tarea5(
	idTarea5 INT PRIMARY KEY AUTO_INCREMENT,
    titulo5 VARCHAR(255),
    descripcion5 TEXT,
    images5 VARCHAR(255),
    precio5 FLOAT(10,2),
    fecha_registro5 TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE Tarea6(
	idTarea6 INT PRIMARY KEY AUTO_INCREMENT,
    titulo6 VARCHAR(255),
    descripcion6 TEXT,
    images6 VARCHAR(255),
    precio6 FLOAT(10,2),
    fecha_registro6 TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

SELECT * FROM Usuario;
SELECT * FROM Administrador;
SELECT * FROM Tarea;
SELECT * FROM Tarea2;
SELECT * FROM Tarea3;
SELECT * FROM Tarea4;
SELECT * FROM Tarea5;
SELECT * FROM Tarea6;