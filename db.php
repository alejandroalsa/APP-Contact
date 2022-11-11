<!------------------------------------------------------------------------------->
<!-- En este archivo establecemos la conexión con la Base de Datos -->
<!------------------------------------------------------------------------------->
<?php

// Definimos la dirección de la Base de Datos
$host = "localhost";

// Seleccionamos la Base de Datos que usaremos
$database = "app_contactos";

// Definimos el usuario para conectarnos y su contraseña
$user = "root";
$password = "";

// Utilizamos un librería (PDO) para conectarnos a la Base de Datos
try {
    $con = new PDO("mysql:host=$host;dbname=$database", $user, $password);
    // foreach ($con->query("SHOW DATABASES") as $row) {
    //     print_r($row);
    // }
    // die();
} catch (PDOException $e) {
    die("PDO Connection Error: " .$e->getMessage());
}
// ----------------------------------------------------------------------- //
// En este archivo establecemos la conexión con la Base de Datos //
// ----------------------------------------------------------------------- //
