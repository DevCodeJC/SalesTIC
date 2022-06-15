<?php 
require 'includes/funciones.php';
incluirTemplate('header');
?>  
    <main class="container-purchase"> 
        <h2 class="title-page">Confirmar compra</h2>
        <div class="purchase">
            <div class="kit">
            <picture class="kit-imagen">
                    <source srcset="img/webp/muestra1.webp" type="image/webp">
                    <img width="200" height="300" loading="lazy" src="img/muestra1.jpg" alt="anuncio">
                </picture>
                <div class="kit-description">
                    <h4>Equipo #1</h4>
                    <ul class="icon-properties">
                        <li>
                            <img loading="lazy" src="img/icons/iconWindows.svg" alt="icono windows">
                            <p class="negrita" >Windows 7 Pro</p>
                        </li>
                        <li>
                            <img loading="lazy" src="img/icons/iconProcessor.svg" alt="icono procesador">
                            <p class="negrita">Intel Core 2(duo)</p>
                        </li>
                        <li>
                            <img loading="lazy" src="img/icons/iconRAM.svg" alt="icono RAM">
                            <p class="negrita">RAM 4GB</p>
                        </li>
                        <li>
                            <img loading="lazy" src="img/icons/icondISK.svg" alt="icon disco">
                            <p class="negrita">HDD 500GB</p>
                        </li>
                    </ul> 
                    <p>Algunas observaciones o perifericos que incluye.
                    </p>
                    <p class="price">$200.000</p>
                    <a class="button-orange" href="fichas/ficha1.pdf">Ver Ficha completa>></a>
                </div><!-- Contenido anuncio -->
            </div><!-- anuncio -->
            
            <form class="formulario" action="#">
            <h4>Complete sus datos para comprar</h4>
                <fieldset>
                    <legend>Datos de la compra</legend>
                    <label for="ID">Cédula</label>
                    <input type="number" placeholder="Tu numeró de cédula" id="ID" min="1" max= "9999999999" required>
                    <label for="user">Nombre y apellido</label>
                    <input type="text" placeholder="Tu nombre y apellido" id="user" maxlength="60" required>
                    <label for="way">Forma de pago</label>
                    <select name="" id="way" required>
                        <option value="" disabled selected>--Seleccione--</option>
                        <option value="efectivo">Efectivo</option>
                        <option value="nomina">Descuento Nómina</option>
                    </select>
                </fieldset>
                <div class="terms">
                    <input type="checkbox">
                    <p>Acepto <a href="#">Términos y condiciones</a></p>
                </div>
                
                <input type="submit" value="Completar Compra" class="button-red button-pay">
            </form>
            </div>
        </div>
        

    </main>

<?php 
incluirTemplate('footer');
?>  