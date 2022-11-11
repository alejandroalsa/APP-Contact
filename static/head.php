<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

<!--------------------------------->
<!------------ Bootstrap ---------->
<!--------------------------------->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootswatch/5.1.3/darkly/bootstrap.min.css" integrity="sha512-ZdxIsDOtKj2Xmr/av3D/uo1g15yxNFjkhrcfLooZV5fW0TT7aF7Z3wY1LOA16h0VgFLwteg14lWqlYUQK3to/w==" crossorigin="anonymous" referrerpolicy="no-referrer"/>
    <script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
<!--------------------------------->
<!------------ Bootstrap ---------->
<!--------------------------------->

<!--------------------------------->
<!------- Contenido Estático ------>
<!--------------------------------->
    <link rel="stylesheet" href="assets/static/css/style.css" />
    <link rel="icon" type="image/x-icon" href="assets/static/img/favicon.png">

    <!------------------------------------------------------------------------------------->
    <!-- Contenido PHP para carcar archivo JS exclusovamente en index -->
    <!------------------------------------------------------------------------------------->

        <!-- Declaramos la variable URI para que guarde la respuesta URI del enlace de la web -->
        <?php $uri = parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH) ?>

        <!-- Creamos una condición para que cuando el usuario esté en APP_Contact o APP_Contact/index.php cargue el archivo JS -->
        <?php if ($uri == "/www/APP_Contact/" || $uri == "/www/APP_Contact/index.php" ): ?>
            <script defer src="/www/APP_Contact/assets/static/js/main.js"></script>
        <?php endif?>
    <!------------------------------------------------------------------------------------->
    <!-- Contenido PHP para carcar archivo JS exclusovamente en index -->
    <!------------------------------------------------------------------------------------->

    <title>APP Contact</title>
<!--------------------------------->
<!------- Contenido Estático ------>
<!--------------------------------->    
</head>
<body>
    