<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
        <a class="navbar-brand font-weight-bold" href=" index.php"><img class="mr-2" src="assets/static/img/favicon.png" />APP Contactos</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation" ><span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <div class="d-flex justify-content-between w-100">
                <ul class="navbar-nav">
                    <!-- Definimos que si se a establecida la sesion con un usuario muestre los enlaces de Inicio, Añadir Contacto y Cerrar Sesion -->
                    <?php if (isset($_SESSION["user"])): ?>
                        <li class="nav-item">
                            <a class="nav-link" href="home.php">Inicio</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="add.php">Añadir Contacto</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="logaut.php">Cerrar Sesion</a>
                        </li>
                    <?php else: ?>
                        <!-- En el caso de que la primera condicion no se cumpla se mostrarar los enlaces de Registro o Inicio de Sesion -->
                        <li class="nav-item">
                            <a class="nav-link" href="register.php">Registro</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="login.php">Iniciar Sesion</a>
                        </li>
                    <?php endif ?>
                </ul>
            </div>
            <!-- En este caso insertaremos el email del usuario cuando inicie sesion -->
            <?php if (isset($_SESSION["user"])): ?>
                <div class="p-2">
                    <?= $_SESSION["user"]["email"] ?>
                </div>
            <?php endif ?>
        </div>
    </div>
</nav>
