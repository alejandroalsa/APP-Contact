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
        if (empty($_POST["name"]) || empty($_POST["email"]) || empty($_POST["password"])) {
            $error = "Por favor rellene todos los campos.";
        // En la segunda línea validamos que el campo de Email contenga un @
        } else if (!str_contains($_POST["email"], "@")) {
            $error = "Formato de Email inválido.";
        // Después de pasar los filtros pasamos al último que es la validacion de Email para comprobar que el email introducido no esté ya registrado
        } else {
            // Con la variable "con", realizamos una consulta para comprobar el email en la Base de Datos
            $statement = $con->prepare("SELECT * FROM users WHERE email = :email");
            $statement->bindParam(":email", $_POST["email"]);
            $statement->execute();
            // Declaramos una condición, en dicha condición declaramos que si el email es mayor que 0 lo que significaría que el email ya está registrado, enviara el error.
            if ($statement->rowCount() > 0) {
                $error = "Este email ya esta registrado";
            } else {
                //Después de validar todos los datos, preparamos la sentencia SQL para introducir los datos enviados por el usuario
                $con
                ->prepare("INSERT INTO users (name, email, password) VALUES (:name, :email, :password)")
                ->execute([
                    ":name" => $_POST["name"], 
                    ":email" => $_POST["email"], 
                    ":password" => password_hash($_POST["password"], PASSWORD_BCRYPT),
                ]);
                $statement = $con->prepare("SELECT * FROM users WHERE email = :email LIMIT 1");
                $statement->bindParam(":email", $_POST["email"]);
                $statement->execute();
                $user = $statement->fetch(PDO::FETCH_ASSOC);

                // Despues de acer todas las comprovaciones iniciamos la sesion y redirigimos a home
                session_start();
                $_SESSION["user"] = $user;
                header("Location: home.php");
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
<!------- MAIN ------>
<!------------------------------------------------------------------------------------------------>
<main>
    <div class="container col-xl-10 col-xxl-8 px-4 py-5">
		<div class="row align-items-center g-lg-5 py-5">
			<div class="col-lg-7 text-center text-lg-start">
			  <h1 class="display-4 fw-bold lh-1 mb-3">APP Contactos</h1>
			  <p class="col-lg-10 fs-5">En esta pequeña aplicacion web podras guardar tus contactos de una forma simple y segura.</p>
              <p class="col-lg-10 fs-5">Esta aplicacion web tiene como objetivo el aprendizaje de PHP</p>
		</div>
		<div class="col-md-10 mx-auto col-lg-5">
			<form method="POST" action="register.php" class="p-4 p-md-5 border-secondary rounded-3 bg-secondary">
                <?php if ($error): ?>
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <i class="bi bi-exclamation-triangle-fill"></i>
                        <strong>Error!</strong> <?= $error ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php endif ?>
				<div class="form-floating mb-3">
                <input id="name" type="text" class="form-control" name="name" require autocomplete="name" autofocus placeholder="Nombre">
				    <label for="email">Nombre</label>
				</div>
                <div class="form-floating mb-3">
                    <input id="email" type="text" class="form-control" name="email" require autocomplete="email" autofocus placeholder="Correo Electronico">
				    <label for="email">Correo Electronico</label>
				</div>
			    <div class="form-floating mb-3">
                    <input id="password" type="password" class="form-control" name="password" require autocomplete="password" autofocus placeholder="Contraseña">
				    <label for="password">Contraseña</label>
                </div>
			    <button class="w-100 btn btn-lg btn-primary" type="submit">Registrarse</button>
			    <hr class="my-4">
			    <small class="text-muted">Ya tienes una cuenta. <a href="index.php">Inicia Sesión!</a></small>
			</form>
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
