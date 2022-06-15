<?php 
require 'includes/funciones.php';
incluirTemplate('header');
?>  
    <main class="container contenido-centrado"> 
        <h2 class="title-page">Iniciar Sesión</h2>
        <form class="formulario" action="#">
            <fieldset class="espaciado-abajo">
                <legend>Email & Password</legend>
                <label for="mail">E-mail</label>
                <input type="email" placeholder="Tu correo electronico" id="mail" maxlength="60" required>
                <label for="pass">Password</label>
                <input type="password" placeholder="Tu contraseña" id="pass" maxlength="30" required>
            </fieldset>
            <input type="submit" value="Enviar" class="button-green">     
        </form>
    </main>

<?php 
incluirTemplate('footer');
?>   