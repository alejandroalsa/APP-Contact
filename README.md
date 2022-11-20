# ![Frame 1](https://user-images.githubusercontent.com/67869168/202869135-ff84a2e7-382d-4f53-8919-7196fb574f26.png)

⏩⏩⏩ [Ver APP](https://apps.alejandroalsa.es/APP-Contact/) ⏪⏪⏪

⏩⏩⏩ [Web APP](https://apps.alejandroalsa.es/APP-Contact/) ⏪⏪⏪

En esta pequeña aplicación web, podrás guardar tus contactos de una forma simple y segura.

Esta aplicación web tiene como objetivo el aprendizaje de PHP.

# Índice
* **Estructura de la APP** [📌](#estructura-de-la-app)
* **SQL** [📌](#sql)
* **Código** [📌](#código)
* **Licencia** [📌](#licencia)
* **Descarga** [📌](#descarga)


# Estructura de la APP

``` 
|---assets
|   |
|   |---sql
|   |   |
|   |   |---app_contactos.sql
|   |   |
|   |---static
|   |   | 
|   |   |---css
|   |   |   |
|   |   |   |---style.css
|   |   |   |
|   |   |---img
|   |   |   |
|   |   |   |---favicon.png
|   |
|---static
|   |
|   |---footer.php
|   |
|   |---head.php
|   |
|   |---header.php
|
|---add.php
|
|---db.php
|
|---editar.php
|
|---eliminar.php
|
|---home.php
|
|---index.php
|
|---logaut.php
|
|---login.php
|
|---register.php
``` 


# SQL

```sql
DROP DATABASE IF EXISTS app_contactos;
CREATE DATABASE app_contactos;
USE app_contactos;

CREATE TABLE users (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(255),
  email VARCHAR(255) UNIQUE,
  password VARCHAR(255)
);

CREATE TABLE contactos (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nombre VARCHAR(255),
  id_usuario INT NOT NULL,
  numero_telefono VARCHAR(15)
  FOREIGN KEY (id_usuario) REFERENCES users(id)
);
```

# Código

* **Conexión Base de Datos**
```php
$host = "localhost";
$database = "app_contactos";
$name = "root";
$password = "";
try {
  $con = new PDO("mysql:host=$host;dbname=$database", $name, $password);
} catch (PDOException $e) {
  die("PDO Connection Error: " .$e->getMessage());
}
```  
Se define la dirección de la base da datos en `$host`, seleccionamos la base de datos en `$database`, por último definimos el usuario `$name` 
y la contraseña para conectarnos.

Por último declaramos la variable `$con`, en esta variable guardaremos los datos para realizar la conexión a la base de datos.

* **Insertar datos en la Base de Datos**
  
```php
$statement = $con->prepare("INSERT INTO contactos (id_usuario, nombre, numero_telefono) VALUES ({$_SESSION['user']['id']}, :nombre, :numero_telefono)");
$statement->bindParam(":nombre", $_POST["nombre"]);
$statement->bindParam(":numero_telefono", $_POST["numero_telefono"]);
$statement->execute();
``` 

Con la variable global `$statement` preparamos la consulta SQL en la que introduciremos los dato en la Base de Datos donde: `contactos` es la tabla, 
`ìd_usuario, nombre, numero_telefono`, son los nombres de las columnas. Validamos la sesión del usuario con `$_SESSION['user']['id']`, después insertamos los datos recopilados en el post `:nombre, :numero_telefono`

* **Eliminar datos en la Base de Datos**

```php
$con->prepare("DELETE FROM contactos WHERE id = :id")->execute([":id" => $id]);
```
Es el mismo funcionamiento que el de insertar los datos, la única diferencia es que eliminamos a través del ID asociado al usuario, así verificamos que el usuario solo borra sus contactos y nos evitamos más código.

* **Modificar datos en la Base de Datos**

```php
$statement = $con->prepare("UPDATE contactos SET nombre = :nombre, numero_telefono = :numero_telefono WHERE id = :id");
$statement->execute([
  ":id" => $id,
  ":nombre" => $_POST["nombre"],
  ":numero_telefono" => $_POST["numero_telefono"],
]
```

Seguimos con el mismo código que en los anteriores pasos, la única diferencia es que aquí a través de ejecute extraemos los dato a editar y los insertamos en el formulario para que así al usuario le resulte más atractivo.

* **Verificación de datos**

Es importante verificar los datos que se introducen y envían en los formularios, para evitar SQL inyección, para ello utilizaremos el siguiente código que se repetirá en `add.php`, `editar.php`, `eliminar.php`.

```php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (empty($_POST["nombre"]) || empty($_POST["numero_telefono"])) {
    $error = "Porfavor rellena todos los campos."; 
  } else if (strlen($_POST["numero_telefono"]) < 9) {
    $error = "Numero de telefono es demasiato corto.";
  } else if (strlen($_POST["numero_telefono"]) > 9) {
    $error = "Numero de telefono es damasiado largo.";
  }else {
    $name = $_POST["nombre"];
    $numero_telefono = $_POST["numero_telefono"];
``` 
Definimos que para que se ejecuten el resto de instrucciones, el método de solicitud sea `POST`, después definimos que no pueden estás vacíos los campos de `name` y `numero_telefono`, verificamos el número de teléfono para que no sea `<9` y ` >9`, por último definimos los valores de las variables con `POST`.

* **Mensajes de errores para formularios**

```php 
$error = null;

<?php if ($error): ?>
  <div class="alert alert-danger alert-dismissible fade show" role="alert">
    <i class="bi bi-exclamation-triangle-fill"></i>
    <strong>¡Error!</strong> <?= $error ?>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>
<?php endif ?>
```
Si nos fijamos en la forma de validación es mediante `if`, en el caso de que esto no se cumpla ejecuta esto otro, que en nuestro caso es el mensaje de error `$error = "Por favor rellena todos los campos.";`, después insertamos el mensaje de error en el html.
 
 *  **Sesiones**
 
```php 
session_start();

if (!isset($_SESSION["user"])) {
  header("Location: login.php");
  return;
}
```
A la hora de identificar las sesiones lo hacemos mediante Cookies, por lo que cuando el usuario inicia sesión se creara una Cookie que es con la que recordaremos al usuario, después iniciamos la sesión `session_start();` y en el caso de que un usuario indexe una URL donde este definido `session_start();` redijera a `login.php`.

*  **Mensajes Flash**
 
 Los mensajes flash son los que se ejecutan cuando introducimos o realizamos cualquier cambio y aparece una alerta indicando que todo esta correcto, 
 algo a ido mal, etc.
 
 ```php
$_SESSION["flash"] = ["nombre" => "{$_POST['nombre']}", "estilo" => "success", "icono" => "check-circle-fill", "texto1" => "ha sido añadido!", "texto2" => "", "texto3" => "", "telefono" => "{$_POST['numero_telefono']}" ];

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
```

Definimos los mensajes flash al final del código PHP, para saber así que solo se ejecutaran si todo lo demás es correcto, en este caso definimos las siguientes situaciones:

```
estilo => success/danger, esto definira el colo de la tarjeta
icono => check-circle-fill/exclamation-triangle-fill esto definira el icono de la tarjeta
texto1 => ha sido añadido! solo se definira en el archivo add.php
texto2 => ha sido editado! solo se definira en el archivo editar.php
texto3 => ha sido eliminado! solo se definira en el archivo eliminar.php
telefono => telefono del usuario
nombre => nombre del usuario
```

Después solo tendremos que añadir el código php y html donde queramos mostrar el mensaje.

# Licencia

<a rel="license" href="http://creativecommons.org/licenses/by/4.0/"><img alt="Licencia de Creative Commons" style="border-width:0" src="https://i.creativecommons.org/l/by/4.0/88x31.png" /></a><br />Este obra está bajo una <a rel="license" href="http://creativecommons.org/licenses/by/4.0/">licencia de Creative Commons Reconocimiento 4.0 Internacional</a>.

# Descarga

```
git clone https://github.com/LLALEX-ESP/Servidor-VoIP.git
```
