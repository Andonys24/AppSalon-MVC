<h1 class="nombre-pagina">Login</h1>
<p class="descripcion-pagina">Inicia Sesion con tus datos</p>

<form class="formulario" method="post" action="/">
    <div class="campo">
        <label for="email">Email</label>
        <input type="email" name="email" id="email" placeholder="Tu Email">
    </div>
    <div class="campo">
        <label for="password">Password</label>
        <input type="password" name="passsword" id="password" placeholder="Tu Password">
    </div>
    <input type="submit" class="boton" value="Iniciar Sesion">
</form>

<div class="acciones">
    <a href="/crear-cuenta">Aun no tienes una cuenta? Crear Una</a>
    <a href="/olvide">Olvidaste tu password?</a>
</div>