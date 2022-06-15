<?php 
require 'includes/funciones.php';
incluirTemplate('header');
?>  
    
    <main class="container"> 
        <h2 class="title-page">Elementos de tecnología en venta</h2>
        <div class="container container-kits">
    
            <div class="kit">
                <picture class="kit-imagen">
                    <source srcset="img/webp/muestra1.webp" type="image/webp">
                    <img width="200" height="300" loading="lazy" src="imgmin/muestra1.jpg" alt="anuncio">
                </picture>
                <div class="kit-description">
                    <h4>Portatil Lenovo E490</h4>
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
                    <p>Algunas observaciones o perifericos que incluye.</p>
                    <p class="price">$200.000</p>  
                    <a class="button-red" href="comprar.php">Comprar</a>
                </div><!-- Contenido anuncio -->
            </div><!-- anuncio -->




            <div class="kit">
                <picture class="kit-imagen">
                    <source srcset="img/webp/muestra2.webp" type="image/webp">
                    <img width="200" height="300" loading="lazy" src="img/muestra2.jpg" alt="anuncio">
                </picture>
                <div class="kit-description">
                    <h4>Equipo #2</h4>
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
                    <a class="button-red" href="comprar.php">Comprar</a>
                </div><!-- Contenido anuncio -->
            </div><!-- anuncio -->




            <div class="kit">
                <picture class="kit-imagen">
                    <source srcset="img/webp/muestra3.webp" type="image/webp">
                    <img width="200" height="300" loading="lazy" src="img/muestra3.jpg" alt="anuncio">
                </picture>
                <div class="kit-description">
                    <h4>Equipo #3</h4>
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
                    <a class="button-red" href="comprar.php">Comprar</a>
                </div><!-- Contenido anuncio -->
            </div><!-- anuncio -->





        </div><!-- Contenedor anuncios -->
    </main>

<?php 
incluirTemplate('footer');
?>  