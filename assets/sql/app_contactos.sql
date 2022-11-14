-- <---------------------------------------------------------------------->
-- <--> Creación de la Base de Datos para la APP "APP Contactos" <--> 
-- <---------------------------------------------------------------------->

  -- Eliminamos la Base de Datos "app_contactos", si existe
    DROP DATABASE IF EXISTS app_contactos;

  -- Creamos la Base de Datos "app_contactos"
    CREATE DATABASE app_contactos;

  -- Usamos la Base de Datos "app_contactos"
    USE app_contactos;

  -- Creamos la tabla donde se almacenaran nuestros usuarios.
    CREATE TABLE users (
      id INT AUTO_INCREMENT PRIMARY KEY,
      name VARCHAR(255),
      email VARCHAR(255) UNIQUE,
      password VARCHAR(255)

);

  -- Creamos la tabla donde se almacenaran nuestros contactos.
    CREATE TABLE contactos (
      id INT AUTO_INCREMENT PRIMARY KEY,
      nombre VARCHAR(255),
      id_usuario INT NOT NULL,
      numero_telefono VARCHAR(15),

-- Añadimos la clave primaria para relacionar a los usuarios con sus contactos

      FOREIGN KEY (id_usuario) REFERENCES users(id)

);

-- <---------------------------------------------------------------------->
-- <--> Creación de la Base de Datos para la APP "APP Contactos" <--> 
-- <---------------------------------------------------------------------->
