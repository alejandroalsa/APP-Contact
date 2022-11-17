<!----------------------------------------------------------------------------------------------------------------------------------------------------------------->
<!---- PHP ---->
<!----------------------------------------------------------------------------------------------------------------------------------------------------------------->
<?php
    // Llamamos a "db.php" para conectarnos a la Base de Datos
    require "db.php";
    
    // Definimos una variable para imprimir un mensaje en caso de error
    $error = null;
    
    // Definimos que para que se ejecuten el resto de instrucciones, el método de solicitud sea "POST"
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Comenzamos con el proceso de validación de los tres campos, en esta primera línea validamos que los tres campos estén rellenos
        if (empty($_POST["email"]) || empty($_POST["password"])) {
            $error = "Por favor rellene todos los campos.";
        // En la segunda línea validamos que el campo de Email contenga un @
        } else if (!str_contains($_POST["email"], "@")) {
            $error = "Formato de Email inválido.";
        // Después de pasar los filtros pasamos al último que es la validacion de Email para comprobar que el email introducido no esté ya registrado
        } else {
            // Con la variable "con", realizamos una consulta para comprobar el email en la Base de Datos
            $statement = $con->prepare("SELECT * FROM users WHERE email = :email LIMIT 1");
            $statement->bindParam(":email", $_POST["email"]);
            $statement->execute();
            // Declaramos una condición, en dicha condición declaramos que si el email no es igual a 0 lo que en este caso que las los emails coincidan, enviara el error.
            if ($statement->rowCount() == 0) {
                $error = "Email o Contraseña incorrectos";
            } else {
                $user = $statement->fetch(PDO::FETCH_ASSOC);

            // En este paso comprobamos que la contraseña introducida por el usuario corresponda al email introducido en el paso anterior.
                if (!password_verify($_POST["password"], $user["password"])) {
                    $error = "Email o Contraseña incorrectos";
                } else {

                    // Despues de acer todas las comprovaciones iniciamos la Sesión y redirigimos a home
                    session_start();
                    unset($user["password"]);
                    $_SESSION["user"] = $user;
                    header("Location: home.php");
                }
            }
        }
    }
?>
<!----------------------------------------------------------------------------------------------------------------------------------------------------------------->
<!---- PHP ---->
<!----------------------------------------------------------------------------------------------------------------------------------------------------------------->

<!------------------------------------------------------------------------------------------------>
<!------- Head ------>
<!------------------------------------------------------------------------------------------------>
<?php require "static/head.php" ?>
<!------------------------------------------------------------------------------------------------>
<!------- Head ------>
<!------------------------------------------------------------------------------------------------>

<!------------------------------------------------------------------------------------------------>
<!------- Barra de Navegación ------>
<!------------------------------------------------------------------------------------------------>
<?php require "static/header.php" ?>
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
                    <p class="card-header">Iniciar Sesión</p>
                    <div class="card-body">
                        <?php if ($error): ?>
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <i class="bi bi-exclamation-triangle-fill"></i>
                                <strong>¡Error!</strong> <?= $error ?>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        <?php endif ?>
                        <form method="POST" action="login.php">
                            <div class="mb-3 row">
                                <label for="email" class="col-md-4 col-form-label text-md-end">Email</label>
                                <div class="col-md-6">
                                    <input id="email" type="text" class="form-control" name="email" require autocomplete="email" autofocus>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="password" class="col-md-4 col-form-label text-md-end">Contraseña</label>
                                <div class="col-md-6">
                                    <input id="password" type="password" class="form-control" name="password" require autocomplete="password" autofocus>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">Iniciar Sesión</button>
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

<!------------------------------------------------------------------------------------------------>
<!------- Footer ------>
<?php require "static/footer.php" ?>
<!------------------------------------------------------------------------------------------------>
<!------- Footer ------>
<!------------------------------------------------------------------------------------------------>
