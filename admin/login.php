<?php
session_start();
include ("funciones.php");

//obtengo la configuración de la página web
//para comprobar el usuario y la contraseña
$config = obtenerConfiguracion();


//pregunto si se presiono el boton iniciar
if (isset($_POST['iniciar'])) {
    //tomo los datos que vienen del cliente

    $usuario = $_POST['usuario'];
    $password = $_POST['password'];

    //comparo con los datos del usuario guardaso en la base de dato
    if (($usuario == $config['user']) && ($password == $config['password'])) {
        $_SESSION['usuarioLogeado'] = "Administrador";

        header("Location: index.php");
    } else {
        $mensaje = "* El nombre de usuario o la contraseña son incorrectos";
    }
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="estilo.css">
    <title>KEVIN - Login</title>
</head>

<body>
    <div id="contenedor-login">
        <div class="presentacion">
            <div class="titulo">
                <h1>KEVIN</h1>
                <p>Sistema de Administración Web Para Inmobiliaria</p>
            </div>
            <div class="contenedor-formulario">
                <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="post" class="form-login">
                    <p>Iniciar sesión como <strong>administrador</strong> </p>
                    <input type="text" placeholder="Nombre de Usuario" name="usuario" required class="input-login">
                    <input type="password" placeholder="Contraseña" name="password" required class="input-login">
                    <input type="submit" value="Iniciar Sesión" name="iniciar" class="btn">

                    <!-- Mensaje que se mostrará´cuando se haya procesado la solicitud en el servidor -->
                    <?php if (isset($_POST['iniciar'])) : ?>
                        <span class="msj-error-input"> <?php echo $mensaje ?></span>
                    <?php endif ?>
                </form>
            </div>
        </div>
    </div>
</body>

</html>