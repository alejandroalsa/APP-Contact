<!----------------------------------------------------------------------------------------------------------------------------------------------------------------->
<!---- Llamamos a "db.php" para conectarnos a la Base de Datos ---->
<!---- Definimos que para que se ejecuten el resto de instrucciones, el método de solicitud sea "POST" ---->
<!---- Declaramos que las variables de "nombre" y "numero_telefono", indicándole que serán los ID "nombre" y "numero_telefono" enviados por "POST" ---->
<!---- Declaramos un variable "statement (es una sentencia)" para indicarle la consulta SQL y después la ejecutamos. ---->
<!----------------------------------------------------------------------------------------------------------------------------------------------------------------->
<?php

    require "db.php";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $nombre = $_POST["nombre"];
            $numero_telefono = $_POST["numero_telefono"];

        $statement = $con->prepare("INSERT INTO contactos (nombre, numero_telefono) VALUES ('$nombre', '$numero_telefono')");
        $statement->execute();

        header("Location: index.php");
    }
?>
<!----------------------------------------------------------------------------------------------------------------------------------------------------------------->
<!----------------------------------------------------------------------------------------------------------------------------------------------------------------->
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
                <a class="navbar-brand font-weight-bold" href=" index.html"><img class="mr-2" src="assets/static/img/favicon.png" />ContactsApp</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation" ><span class="navbar-toggler-icon"></span>
                </button>
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
                            <p class="card-header">Añadir nuevo contacto</p>
                            <div class="card-body">

                                <form method="POST" action="add.php">
                                    <div class="mb-3 row">
                                        <label for="nombre" class="col-md-4 col-form-label text-md-end">Nombre</label>
                                        <div class="col-md-6">
                                            <input id="nombre" type="text" class="form-control" name="nombre" required autocomplete="nombre" autofocus>
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label for="numero_telefono" class="col-md-4 col-form-label text-md-end">Numero de Teléfono</label>
                                        <div class="col-md-6">
                                            <input id="numero_telefono" type="tel" class="form-control" name="numero_telefono" required autocomplete="numero_telefono" autofocus>
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
