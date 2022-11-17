<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="index.php"><img class="mr-2" src="assets/static/img/favicon.png" />APP Contactos</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <!-- Definimos que si se a establecida la Sesión con un usuario muestre los enlaces de Inicio, Añadir Contacto y Cerrar Sesión -->
        <?php if (isset($_SESSION["user"])): ?>
            <li class="nav-item">
                <a class="nav-link" href="home.php">Inicio</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="add.php">Añadir Contacto</a>
            </li>

            <?php else: ?>  
            <!-- En el caso de que la primera condicion no se cumpla se mostrarar los enlaces de Registro o Inicio de Sesión -->
            <li class="nav-item">
                <a class="nav-link" href="register.php">Registro</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="login.php">Iniciar Sesión</a>
            </li>
        <?php endif ?>
      </ul>
      <form class="d-flex" role="search">
        <!-- En este caso insertaremos el nombre del usuario cuando inicie Sesión -->
        <?php if (isset($_SESSION["user"])): ?>
            <button type="button" class="boton btn btn-secondary"><?= $_SESSION["user"]["name"] ?></button>
            <a href="logaut.php"><button type="button" class="cerrar btn btn-danger">Cerrar Sesión</button></a>                      
        <?php endif ?>
      </form>
    </div>
  </div>
</nav>

<!-- Configuracion de los mensajes flash -->
<?php if (isset($_SESSION["flash"])): ?>
    <div class="container mt-4">
        <div class="alert alert-<?= $_SESSION["flash"]["estilo"]?>  alert-dismissible fade show" role="alert">
            <i class="bi bi-<?= $_SESSION["flash"]["icono"] ?>"></i>
            ¡Contacto <strong><?= $_SESSION["flash"]["nombre"] ?></strong> con número de teléfono <strong><?= $_SESSION["flash"]["telefono"] ?></strong> <span><?= $_SESSION["flash"]["texto1"]?></span> <span><?= $_SESSION["flash"]["texto2"]?></span> <span><?= $_SESSION["flash"]["texto3"]?></span>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>

        </div>
    </div>
    <?php unset($_SESSION["flash"]) ?>
<?php endif ?>
