CREATE DATABASE IF NOT EXISTS abdou_gueye_db;

USE abdou_gueye_db;

CREATE TABLE IF NOT EXISTS trabajadores (
    id_trabajador INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    nombre VARCHAR(50) NOT NULL,
    apellidos VARCHAR(100) NOT NULL,
    edad INT(100) NOT NULL,
    observaciones MEDIUMTEXT NOT NULL
);