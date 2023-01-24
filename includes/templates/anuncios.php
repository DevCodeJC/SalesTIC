<?php

//Conexion a la base de datos
require 'includes/config/database.php';
$db = conexionDB();

//Consultar
$query = "SELECT * FROM equipos WHERE disponible = 1";
$res = mysqli_query($db, $query);

if($res->num_rows == 0){ ?>
    <picture>
        <img src="/SalesTIC/img/sold.jpg" alt="No disponible">
    </picture>
    
    <?php 
    }else{?>

<div class="container container-kits">
    <?php while ($equipo = mysqli_fetch_assoc($res)): ?>
    <div class="kit">
        <picture class="kit-imagen">
            <img width="200" height="300" loading="lazy" 
            src="/SalesTIC/imagenes/<?php echo $equipo['imagen'] ?>" alt="anuncio">
        </picture>
        <div class="kit-description">
            <h4><?php echo $equipo['tipo_equipo'] ?> <?php echo $equipo['nombre_equipo'] ?></h4>
            <p class="kit-id">ID: <?php echo $equipo['id_equipo'] ?></p>
            <ul class="icon-properties">
                <li>
                    <img loading="lazy" src="/SalesTIC/img/icons/iconWindows.svg" alt="icono windows">
                    <p class="negrita" ><?php echo $equipo['so'] ?></p>
                </li>
                <li>
                    <img loading="lazy" src="/SalesTIC/img/icons/iconProcessor.svg" alt="icono procesador">
                    <p class="negrita"><?php echo $equipo['chip'] ?></p>
                </li>
                <li>
                    <img loading="lazy" src="/SalesTIC/img/icons/iconRAM.svg" alt="icono RAM">
                    <p class="negrita">RAM <?php echo $equipo['ram'] ?> GB</p>
                </li>
                <li>
                    <img loading="lazy" src="/SalesTIC/img/icons/iconDisk.svg" alt="icon disco">
                    <p class="negrita">Disco <?php echo $equipo['disco'] ?> GB</p>
                </li>
                </ul> 
                    <p class="kit-obs"><?php echo $equipo['observacion'] ?></p>
                    <p class="price">$ <?php echo $equipo['precio'] ?></p>  
                    <a class="button-red" href="comprar.php?id=<?php echo $equipo['id_equipo'] ?>">Comprar</a>
            </div><!-- Contenido anuncio -->
        </div><!-- anuncio -->
    <?php endwhile; 
    }?>    
    </div><!-- Contenedor anuncios -->
</div>

<?php
//Cerrar la conexión
mysqli_close($db);

?>