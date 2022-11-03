-- <---------------------------------------------------------------------->
-- <--> Creación de la Base de Datos para la APP "APP Contactos" <--> 
-- <---------------------------------------------------------------------->

  -- Eliminamos la Base de Datos "app_contactos", si existe
    DROP DATABASE IF EXISTS app_contactos;

  -- Creamos la Base de Datos "app_contactos"
    CREATE DATABASE app_contactos;

  -- Usamos la Base de Datos "app_contactos"
    USE app_contactos;

  -- Creamos la tabla donde se almacenaran nuestros contactos.
    CREATE TABLE contactos (
      id INT AUTO_INCREMENT PRIMARY KEY,
      nombre VARCHAR(255),
      numero_telefono VARCHAR(15)
    );

  -- Insertamos un contacto para ver que todo funciona correctamente
    INSERT INTO contactos (nombre, numero_telefono) VALUES ("Alejandro", "123456789");

-- <---------------------------------------------------------------------->
-- <--> Creación de la Base de Datos para la APP "APP Contactos" <--> 
-- <---------------------------------------------------------------------->
