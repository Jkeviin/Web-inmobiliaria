<?php
include("funciones.php");


$config = obtenerConfiguracion();

?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TANIA - Inmobiliaria</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="estilo.css">
        <!-- Icono casa -->
        <link rel="icon" href="img/casa.png">
</head>

<body class="contenedor-contacto">
        <?php include("header.php"); ?>
    <div class="padre_info">
        <div class="container_info">
            <div class="col info">
                <div>
                    <h3> <i class="fa-solid fa-location-dot"></i> Nuestra Oficina Central</h3>
                    <p><?php echo $config['oficina_central'] ?></p>
                </div>

                <div>
                <h3><i class="fa-solid fa-phone"></i> Nuestros teléfonos</h3>
                    <p><?php echo $config['telefono1'] ?></p>
                    <p><?php echo $config['telefono2'] ?></p>
                </div>

                <div>
                    <h3><i class="fa-solid fa-envelope"></i> Correo Electrónico</h3>
                    <p><?php echo $config['email_contacto'] ?></p>
                </div>

                <div>
                    <h3><i class="fa-solid fa-clock"></i> Horarios de atención en Oficina</h3>
                    <p><?php echo $config['horarios'] ?></p>
                </div>

            </div>
            <div class="col formulario">
                <form action="">
                    <h3>Comuníquese con nosotros (INACTIVO)</h3>
                    <div>
                        <label for="nombre">Nombre</label>
                        <input type="text" placeholder="Ingrese su nombre" name="nombre" required autocomplete="off">
                    </div>
                    <div>
                        <label for="email">Dirección de Correo</label>
                        <input type="email" placeholder="Dirección de Correo" name="email" required>
                    </div>
                    <div>
                        <label for="telefono">Teléfono</label>
                        <input type="text" placeholder="Ingrese su teléfono" name="telefono">
                    </div>
                    <div>
                        <label for="mensaje">Consulta</label>
                        <textarea type="text" placeholder="Escriba su consulta" name="mensaje" required></textarea>
                    </div>
                    <input class="btnInfo" type="submit" value="Enviar Mensaje" name="enviar">
                </form>
            </div>
            <div class="col">
            <div style="width: 100%"><iframe width="100%" height="500" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.com/maps?width=100%25&amp;height=600&amp;hl=es&amp;q=Armenia,%20quindio+(Software%20Tania%20Inmobiliaria)&amp;t=p&amp;z=14&amp;ie=UTF8&amp;iwloc=B&amp;output=embed"></iframe></div>
            </div>
        </div>
    </div>
    <footer class="inferior">
            <?php include("contenido-footer.php")?>
    </footer>
</body>
</html>