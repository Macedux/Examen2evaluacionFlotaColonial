CREATE DATABASE colonial_fleet;
USE colonial_fleet;
CREATE TABLE naves (
    id INT AUTO_INCREMENT PRIMARY KEY, --
    nombre VARCHAR(100), --
    tipo ENUM ('Batalla', 'Carguera','Cientifica') NOT NULL, --Single Table Inheritance. Una sola tabla naves con todas las columnas de todos los tipos. La columna tipo es la clave
    estado ENUM ('Activa', 'Dañada','Destruida') NOT NULL, --
    velocidadFTL BOOLEAN,
    capacidadPasajeros INT, --
    armamento VARCHAR(100), --
    puntosCasco INT DEFAULT(100), --
    clasificacion ENUM ('Battlestar', 'Escolta','Destructor'), --El precio a pagar es que hay columnas que quedan a NULL según el tipo. 
    tipoCarga ENUM ('Armamento', 'Ciudadanos','Secreto'), --
    capacidadCarga INT NULL, --
    numLaboratorios INT NULL, --
    especialidad  VARCHAR(100) NULL,
    cylonSospechoso BOOLEAN
    ); --
CREATE TABLE usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY, --
    username VARCHAR(100) UNIQUE, --unique para que no se repita--
    password VARCHAR(255), --//un hash de bcrypt ocupa 60 caracteres mínimo--
    idioma ENUM ('Spanish', 'English'),
   rol ENUM ('admin', 'usuario') DEFAULT 'usuario',
    colorFondo VARCHAR(7) --

);
--Para comentar en sql se hace de manera segura con - - --s