
<?php
session_start();

include("funciones.php");

//Si el usuario no esta logeado lo enviamos al login
if (!$_SESSION['usuarioLogeado']) {
    header("Location:login.php");
}

if (isset($_POST['agregar'])) {

    //tomamos los datos que vienen del formulario
    $pais = $_POST['pais'];

    $mensaje = agregarNuevoPais($pais);

}
?>


<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="estilo.css">
    <title>SAWPI - Admin</title>
</head>

<body>
    <?php include("header.php"); ?>
    <div id="contenedor-admin">
        <?php include("contenedor-menu.php"); ?>

        <div class="contenedor-principal">
            <div id="nuevo-pais">
                <h2>Agregar Nuevo Pais</h2>
                <hr>

                <div class="box-nuevo-tipo">
                    <h3>Agregar Nuevo Pais</h3>
                    <hr>
                    <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
                        <input type="text" name="pais" placeholder="Nombre del pais">
                        <input type="submit" name="agregar" value="Agregar" class="btn-accion">
                    </form>

                    <?php if (isset($_POST['agregar'])) : ?>
                        <script>
                            alert("<?php echo $mensaje ?>");
                            window.location.href = 'index.php';
                        </script>
                    <?php endif ?>

                </div>

            </div>
        </div>
    </div>

    <script>
        $('#link-add-pais').addClass('pagina-activa');
    </script>
</body>

</html>