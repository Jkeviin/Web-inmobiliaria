
<nav class="contenedor-header">

    <!-- Menu Deplegable icono -->
    <input type="checkbox" id="check">
    <label class="menu-icon" for="check">

        <span class="fas fa-bars activo"></span>
        <!-- Cerrar -->
        <span class="fas fa-times desactivo"></span>
    </label>
    <a href="index.php" class="logo-header">
        <h1>TANIA</h1>
        <p>Inmobiliaria</p>
    </a>

    <ul>
        <li><a href="index.php">Inicio</a></li>
        <li><a href="propiedades.php">Propiedades</a></li>
        <li><a href="contacto.php">Contacto</a></li>
        <li>
            <a class="info">
                <i class="fa-solid fa-phone"></i> <?php echo $config['telefono1'] ?>
            </a>
        </li>
        <?php if ($config['facebook'] != null) : ?>
        <li>
            <a class="info">
                    <a href="<?php echo $config['facebook'] ?>"><i class="fa-brands fa-facebook-f"></i></a>
            </a>
        </li>
        <?php endif ?>
    </ul>
    </div>
</nav>

<script>
    function desactivar() {
        var desactivo = document.querySelector('.desactivo');
        var activo = document.querySelector('.activo');
        desactivo.classList.remove('desactivo');
        activo.classList.add('desactivo');
        activo.classList.remove('activo');
        desactivo.classList.add('activo')
}
/* Evento click de las anteriores clases */
document.querySelector('.desactivo').addEventListener('click', desactivar);
document.querySelector('.activo').addEventListener('click', desactivar);
</script>

