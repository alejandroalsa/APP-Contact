<!--------------------------------------------------------->
<!---- Lista de Contactos PHP (Definimos el contenido) ---->
<!--------------------------------------------------------->
<?php
$contactos = [
    ["nombre" => "Alejandro", "numero_telefono" => "789123001"],
    ["nombre" => "José María", "numero_telefono" => "630912340"],
    ["nombre" => "Antonio", "numero_telefono" => "629012739"],
];
?>
<!--------------------------------------------------------->
<!---- Lista de Contactos PHP (Definimos el contenido) ---->
<!--------------------------------------------------------->

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

<!--------------------------------->
<!------------ Lista de Contactos PHP ---------->
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
                            <a class="nav-link" href="index.html">Inicio</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="add.html">Añadir Contacto</a>
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
            <div class="container pt-4 p-3">
                <div class="row">
                    <!----------------------------------------------------------------------->
                    <!------- Tarjetas de Contactos ------>
                    <!----------------------------------------------------------------------->
                    <?php foreach ($contactos as $contacto) : ?>
                        <div class="col-md-4 mb-3">
                            <div class="card text-center">
                                <div class="card-body">
                                    <h3 class="card-title text-capitalize"><?= $contacto["nombre"]?></h3>
                                    <p class="m-2"><?= $contacto["numero_telefono"]?></p>
                                    <a href="#" class="btn btn-secondary mb-2">Editar Contacto</a>
                                    <a href="#" class="btn btn-danger mb-2">Eliminar Contacto</a>
                                </div>
                            </div>
                        </div>
                    <?php endforeach ?>
                    <!----------------------------------------------------------------------->
                    <!------- Tarjetas de Contactos ------>
                    <!----------------------------------------------------------------------->
                </div>
            </div>
        </main>
<!------------------------------------------------------------------------------------------------>
<!------- MAIN ------>
<!------------------------------------------------------------------------------------------------>
    </body>
</html>
