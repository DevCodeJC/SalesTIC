<?php
require '../includes/funciones.php';

//Verificar la sesión
$auth = autenticado();
if(!$auth){
    header('Location: /SalesTIC/');
}

//Conexion a la base de datos
require '../includes/config/database.php';
$db = conexionDB();

//Consulta de equipos
$query = "SELECT id_equipo, tipo_equipo, nombre_equipo, serial_equipo, precio, disponible FROM equipos";
$resultado = mysqli_query($db, $query);

// echo "<pre>";
// var_dump($resultado); 
// echo "</pre>";
// exit;

$replay = $_GET['replay'] ?? null;
incluirTemplate('header');
?>  
    <main class="container"> 
        <h2 class="title-page">Publicación de Equipos</h2>
        <?php if($replay == 1) :?>
            <p class='success'>¡El Equipo se publicó correctamente!</p>
        <?php elseif($replay == 2) :?>
            <p class='success'>¡La información se modifico correctamente!</p>
        <?php elseif($replay == 3) :?>
            <p class='success'>¡El usuario se creo correctamente!</p>
        <?php elseif($replay == 4) :?>
            <p class='success'>¡Se descargo consolidado de equipos!</p>
        <?php endif; ?>
        <a class="button-green" href="/SalesTIC/admin/create.php">Crear Nueva Publicación</a>

        <!-- Listar equipos -->
        <table border="1" class="list">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Tipo</th>
                    <th>Descripción</th>
                    <th>Serial</th>
                    <th>Precio</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($equipo = mysqli_fetch_assoc($resultado)): ?>
                <tr>
                    <th><?php echo $equipo['id_equipo']; ?></th>
                    <th><?php echo $equipo['tipo_equipo']; ?></th>
                    <th><?php echo $equipo['nombre_equipo']; ?></th>
                    <th><?php echo $equipo['serial_equipo']; ?></th>
                    <th>$ <?php echo $equipo['precio']; ?></th>
                    <th><?php if($equipo['disponible']==1){echo "Disponible";}
                            else{echo "Vendido";}?></th>
                    <th class="action">
                        <a href="/SalesTIC/admin/update.php?id=<?php echo $equipo['id_equipo']; ?>" 
                        class="button-orange">Actualizar</a>
                        <!-- <a href="#" class="button-red">Eliminar</a> -->
                    </th>
                </tr>
                <?php endwhile ?>
            </tbody>
        </table>
    </main>

<?php 
//Cerrar la conexion Base de Datos
mysqli_close($db);
incluirTemplate('footer');?>  