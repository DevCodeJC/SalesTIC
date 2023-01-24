<?php 
require 'includes/funciones.php';
incluirTemplate('header');

$replay = $_GET['replay'] ?? null;

?>  
    <main class="container"> 
        <h2 class="title-page">Elementos de tecnología en venta</h2>
        <?php if($replay == 1) :?>
            <p class='success'>Tu reserva ha sido confirmada. El equipo TIC se contactará contigo por medio del correo registrado para continuar el proceso</p>
        <?php endif; ?>
        <?php 
            include 'includes/templates/anuncios.php';
        ?>
    </main>

<?php 
incluirTemplate('footer');
?>  