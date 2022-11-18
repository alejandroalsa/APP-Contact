<!----------------------------------------------------------------------------------------------------------------------------------------------------------------->
<!---- PHP ---->
<!----------------------------------------------------------------------------------------------------------------------------------------------------------------->
<?php

    // Llamamos a "db.php" para conectarnos a la Base de Datos
    require "db.php";

    // Iniciamos la Sesión
    session_start();

    // En el caso de que la Sesión no este iniciada redirigimos a login
    if (!isset($_SESSION["user"])) {
        header("Location: login.php");
        return;
    }

    // Definimos los id para posteriormente saber que contacto eliminar
    $id = $_GET["id"];

    // Ejecutamos las consultas SQL para seleccionar los id a eliminar
    $statement = $con->prepare("SELECT * FROM contactos WHERE id = :id LIMIT 1");
    $statement->execute([":id" => $id]);

    // Pequeña medida de seguridad para que cuando un usuario introduzca un id por su cuenta devuelta un 404 y no bloque la Base de Datos
    if ($statement->rowCount() == 0) {
        http_response_code(404);
        echo("HTTP 404");
        return;
    }

    // Declaramos la variable de contacto para devuelve una matriz indexada por nombre de columna como se muestra en su conjunto de resultados. 
    $contacto = $statement->fetch(PDO::FETCH_ASSOC);

    if ($contacto["id_usuario"] !== $_SESSION["user"]["id"]){
        http_response_code(403);
        echo("HTTP 403");
        return; 
    }

    // Ejecutamos las consultas SQL para eliminar al contacto con el id definido anteriormente
    $con->prepare("DELETE FROM contactos WHERE id = :id")->execute([":id" => $id]);


    // Configuracion de Mensajes flash
    $_SESSION["flash"] = ["nombre" => "{$contacto['nombre']}", "estilo" => "danger", "icono" => "exclamation-triangle-fill", "texto1" => "", "texto2" => "", "texto3" => "ha sido eliminado!", "telefono" => "{$contacto['numero_telefono']}" ];

    // Redirigimos a index
    header("Location: home.php");
    return;

?>
<!----------------------------------------------------------------------------------------------------------------------------------------------------------------->
<!---- PHP ---->
<!----------------------------------------------------------------------------------------------------------------------------------------------------------------->
