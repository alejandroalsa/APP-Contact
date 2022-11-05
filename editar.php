<!----------------------------------------------------------------------------------------------------------------------------------------------------------------->
<!---- PHP ---->
<!----------------------------------------------------------------------------------------------------------------------------------------------------------------->
<?php
    // Llamamos a "db.php" para conectarnos a la Base de Datos
    require "db.php";

    // Definimos los id para posteriormente saber que contacto editar
    $id = $_GET["id"];

    // Ejecutamos las consultas SQL para autocompletar los campos del formulario con los datos ya definidos
    $statement = $con->prepare("SELECT * FROM contactos WHERE id = :id LIMIT 1");
    $statement->execute([":id" => $id]);

    // Pequeña medida de seguridad para que cuando un usuario introduzca un id por su cuenta devuelta un 404 y no bloque la Base de Datos
    if ($statement->rowCount() == 0) {
        http_response_code(404);
        echo("HTTP 404");
    }

    $contacto = $statement->fetch(PDO::FETCH_ASSOC);

    // Definimos una variable para imprimir un mensaje en caso de error
    $error = null;

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Definimos que no pueden estas vacíos los campos de "nombre" y "numero_telefono"
        if (empty($_POST["nombre"]) || empty($_POST["numero_telefono"])) {
            $error = "Porfavor rellena todos los campos."; 
        // Definimos que el número de teléfono no sea menor que 9   
        } else if (strlen($_POST["numero_telefono"]) < 9) {
            $error = "Numero de telefono es demasiato corto.";
        // Definimos que el número de teléfono no sea mayor que 9   
        } else if (strlen($_POST["numero_telefono"]) > 9) {
            $error = "Numero de telefono es damasiado largo.";
        }else {
            // Definimos los valores de las variables con POST
            $nombre = $_POST["nombre"];
            $numero_telefono = $_POST["numero_telefono"];
        
            // Ejecutamos las consultas SQL, en ellas definimos que por defecto los valores a enviar sean los validados.
            $statement = $con->prepare("UPDATE contactos SET nombre = :nombre, numero_telefono = :numero_telefono WHERE id = :id");
            $statement->execute([
                    ":id" => $id,
                    ":nombre" => $_POST["nombre"],
                    ":numero_telefono" => $_POST["numero_telefono"],
                ]
            );

            // Redirigimos a index
            header("Location: index.php");
        }
    }
?>
<!----------------------------------------------------------------------------------------------------------------------------------------------------------------->
<!---- PHP ---->
<!----------------------------------------------------------------------------------------------------------------------------------------------------------------->

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

<!--------------------------------->
<!------------ Bootstrap ---------->
<!--------------------------------->
    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootswatch/5.1.3/darkly/bootstrap.min.css"
        integrity="sha512-ZdxIsDOtKj2Xmr/av3D/uo1g15yxNFjkhrcfLooZV5fW0TT7aF7Z3wY1LOA16h0VgFLwteg14lWqlYUQK3to/w=="
        crossorigin="anonymous"
        referrerpolicy="no-referrer"
    />
    <script
        defer
        src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
        crossorigin="anonymous"
    ></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
<!--------------------------------->
<!------------ Bootstrap ---------->
<!--------------------------------->

<!--------------------------------->
<!------- Contenido Estático ------>
<!--------------------------------->
    <link rel="stylesheet" href="assets/static/css/style.css" />
    <link rel="icon" type="image/x-icon" href="assets/static/img/favicon.png">
    <title>APP Contact</title>
<!--------------------------------->
<!------- Contenido Estático ------>
<!--------------------------------->    
</head>
    <body>
<!------------------------------------------------------------------------------------------------>
<!------- Barra de Navegación ------>
<!------------------------------------------------------------------------------------------------>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container-fluid">
                <a class="navbar-brand font-weight-bold" href=" index.php"><img class="mr-2" src="assets/static/img/favicon.png" />APP Contactos</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation" ><span class="navbar-toggler-icon"></span></button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link" href="index.php">Inicio</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="add.php">Añadir Contacto</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
<!------------------------------------------------------------------------------------------------>
<!------- Barra de Navegación ------>
<!------------------------------------------------------------------------------------------------>

<!------------------------------------------------------------------------------------------------>
<!------- MAIN ------>
<!------------------------------------------------------------------------------------------------>
        <main>
            <div class="container pt-5">
                <div class="row justify-content-center">
                    <!----------------------------------------------------------------------->
                    <!------- Tarjeta de Añadir Contactos  ------>
                    <!----------------------------------------------------------------------->
                    <div class="col-md-8">
                        <div class="card">
                            <p class="card-header">Editar contacto</p>
                            <div class="card-body">
                                <?php if ($error): ?>
                                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        <i class="bi bi-exclamation-triangle-fill"></i>
                                        <strong>Error!</strong> <?= $error ?>
                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                    </div>
                                <?php endif?>
                                <form method="POST" action="editar.php?id=<?= $contacto["id"] ?>" >
                                    <div class="mb-3 row">
                                        <label for="nombre" class="col-md-4 col-form-label text-md-end">Nombre</label>
                                        <div class="col-md-6">
                                            <input value="<?= $contacto["nombre"]?>" id="nombre" type="text" class="form-control" name="nombre" required autocomplete="nombre" autofocus>
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label for="numero_telefono" class="col-md-4 col-form-label text-md-end">Numero de Teléfono</label>
                                        <div class="col-md-6">
                                            <input value="<?= $contacto["numero_telefono"]?>" id="numero_telefono" type="tel" class="form-control" name="numero_telefono" required autocomplete="numero_telefono" autofocus>
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <div class="col-md-6 offset-md-4">
                                            <button type="submit" class="btn btn-primary">Guardar</button>
                                        </div>
                                    </div>
                                </form>

                            </div>
                        </div>
                    </div>
                    <!----------------------------------------------------------------------->
                    <!------- Tarjeta de Añadir Contactos ------>
                    <!----------------------------------------------------------------------->
                </div>
            </div>
        </main>
<!------------------------------------------------------------------------------------------------>
<!------- MAIN ------>
<!------------------------------------------------------------------------------------------------>
    </body>
</html>
