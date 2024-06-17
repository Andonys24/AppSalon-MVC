<h1 class="nombre-pagina">Recuperar Password</h1>
<p class="descripcion-pagina">Coloca tu nuevo Password a continuacion</p>

<?php
include_once __DIR__ . '/../templates/alertas.php';

if ($error) return; 
?>
<form class="formulario" method="post">
    <div class="campo">
        <label for="password">Password</label>
        <input type="password" id="password" name="password" placeholder="Tu nuevo Password">
    </div>
    <input type="submit" class="boton" value="Guardar nuevo password">
</form>

<div class="acciones">
    <a href="/">Ya tienes una cuenta? Iniciar Sesion</a>
    <a href="/crear-cuenta">Aun no tienes una cuenta? Crear Una</a>
</div>