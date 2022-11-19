# ![Frame 1](https://user-images.githubusercontent.com/67869168/202869135-ff84a2e7-382d-4f53-8919-7196fb574f26.png)

⏩⏩⏩[Ver APP](https://apps.alejandroalsa.es/APP-Contact/)⏪⏪⏪

⏩⏩⏩[Web APP](https://apps.alejandroalsa.es/APP-Contact/)⏪⏪⏪

En esta pequeña aplicación web, podrás guardar tus contactos de una forma simple y segura.

Esta aplicación web tiene como objetivo el aprendizaje de PHP.

# Índice
* **Estructura de la APP** [📌](#)
* **SQL** [📌](#)
* **Codigo** [📌](#)
* **Licencia** [📌](#)
* **Descarga** [📌](#)


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

# Codigo

* **Conexion Base de Datos**
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
Se define la direccion de la base da datos en `$host`, seleccionamos la base de datos en `$database`, por ultimo definimos el usuario `$name` 
y la contraseña para conectarnos.

Por ultimo declaramos la variable `$con`, en esta variable guardaremos los datos para realizar la conexion a la base de datos.

* **Insertar datos en la Base de Datos**
  
```php
$statement = $con->prepare("INSERT INTO contactos (id_usuario, nombre, numero_telefono) VALUES ({$_SESSION['user']['id']}, :nombre, :numero_telefono)");
$statement->bindParam(":nombre", $_POST["nombre"]);
$statement->bindParam(":numero_telefono", $_POST["numero_telefono"]);
$statement->execute();
``` 

Con la variable global `$statement` preparamos la consulta SQL en la que introduciremos los dato en la Base de Datos donde: `contactos` es la tabla, 
`ìd_usuario, nombre, numero_telefono`, son los nombres de la columnas. Validamos la sesion del usuario con `$_SESSION['user']['id']`, y despues insertamos
insertamos los datos recopilados en el post `:nombre, :numero_telefono`

* **Eliminar datos en la Base de Datos**

```php
$con->prepare("DELETE FROM contactos WHERE id = :id")->execute([":id" => $id]);
```
Es el mismo funcionamiento que el de insertar los datos la unica diferencia esque eliminaomos atraves del ID asociado al usuario, asi verificamos que 
el usuario solo borra sus contactos y nos evitamos mas codigo.

* **Modificar datos en la Base de Datos**

```php
$statement = $con->prepare("UPDATE contactos SET nombre = :nombre, numero_telefono = :numero_telefono WHERE id = :id");
$statement->execute([
  ":id" => $id,
  ":nombre" => $_POST["nombre"],
  ":numero_telefono" => $_POST["numero_telefono"],
]
```

Seguimos con el mismo odigo que en los ateriores pasos la unica diferencia es que aqui a traves de `execute` extraemos los dato a editar y los insertamos
en el formulario para que asi al usuario le resulte mas atractivo.

* **Verificaion de datos**

Es importante verificar los datos que se introducen y envian en los formularios, para evitar SQL inyection, para ello utilizaremos el siguiente codigo que
se repetira en `add.php`, `editar.php`, `eliminar.php`.

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

Definimos que para que se ejecuten el resto de instrucciones, el método de solicitud sea `POST`, despues definimos que no pueden estas vacíos los campos 
de  `ame` `y `numero_telefono` , verificamos el nuemro de telefono para que no sea `<9`y >9`, por ultimo definimos los valores de las variables con POST.

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
 Si nos fijamos en la fomra de validacion es mediante `if`, en el caso de que esto no se cumpla ejecuta esto otro, que en nuetro caso es el mensaje de 
 error `$error = "Porfavor rellena todos los campos.";`, despues insertamos el mensahe de error en el `html`.
 
 *  **Sesiones**
 
```php 
session_start();

if (!isset($_SESSION["user"])) {
  header("Location: login.php");
  return;
}
```
A la hora de identificar las sesiones lo hacemos mediante Cookies, por lo que cuando el usuario inicia sesion se creara una Cokie que es con la que 
recordaremos al usuario, depues iniciamos la sesion `session_start();` y en el caso de que un usuario indexse una URL donde este definido 
`session_start();` refigira a `login.php`

*  **Mensajes Flash**
 
 Los mensajes flash son los que se ejecutan cuando introducimos o realizamos cualquier cambio y aparece una alerta indicando que todo esra correcto, 
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

Definimos los mensajes flash alfinal del codigo PHP, para saver asi que solo se ejecutaran si todo lo demas es correcto, en este caso definimos las 
sguientes situaciones:

```
estilo => success/danger, esto definira el colo de la tarjeta
icono => check-circle-fill/exclamation-triangle-fill esto definira el icono de la tarjeta
texto1 => ha sido añadido! solo se definira en el archivo add.php
texto2 => ha sido editado! solo se definira en el archivo editar.php
texto3 => ha sido eliminado! solo se definira en el archivo eliminar.php
telefono => telefono del usuario
nombre => nombre del usuario
```

Despues solo tendremos que añadir el codigo php y html donde queramos mostrar el mensaje.

# Licencia

<a rel="license" href="http://creativecommons.org/licenses/by/4.0/"><img alt="Licencia de Creative Commons" style="border-width:0" src="https://i.creativecommons.org/l/by/4.0/88x31.png" /></a><br />Este obra está bajo una <a rel="license" href="http://creativecommons.org/licenses/by/4.0/">licencia de Creative Commons Reconocimiento 4.0 Internacional</a>.

# Descarga

```
git clone https://github.com/LLALEX-ESP/Servidor-VoIP.git
```

