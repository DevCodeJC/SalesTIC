<?php
require '../includes/funciones.php';

//Verificar la sesión
$auth = autenticado();
if(!$auth){
    header('Location: /SalesTIC/');
}
if($_SESSION['perfil'] != 1){
    header('Location: /SalesTIC/');
}
//Conexion a la Bade de Datos
require '../includes/config/database.php';
$db = conexionDB();

//Consulta de validacion si ya existe el email en DB
$query = "SELECT * FROM usuarios";
$resultado = mysqli_query($db, $query);
$replay = $_GET['replay'] ?? null;

incluirTemplate('header');
?>
<main class="container"> 
    <h2 class="title-page">Usuarios</h2>
    <?php if($replay == 1) :?>
        <p class='success'>¡El usuario se creo correctamente!</p>
    <?php elseif($replay == 2) :?>
        <p class='success'>¡El usuario se modificó correctamente!</p>
    <?php endif; ?>
    <a class="button-green" href="/SalesTIC/admin/createuser.php">Crear Nuevo Usuario</a>

    <!-- Listar usuarios -->
    <table border="1" class="list">
        <thead>
            <tr>
                <th>ID</th>
                <th>Usuario</th>
                <th>Correo electronico</th>
                <th>Permisos</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($usuario = mysqli_fetch_assoc($resultado)): ?>
            <tr>
                <th><?php echo $usuario['id_usr']; ?></th>
                <th><?php echo $usuario['nombre_usr']; ?></th>
                <th><?php echo $usuario['email']; ?></th>
                <th><?php if($usuario['perfil']==1){echo "Administrador";}
                    else{echo "Estandar";}?></th>
                <th class="action">
                    <a href="/SalesTIC/admin/modifyuser.php?id=<?php echo $usuario['id_usr']; ?>" 
                    class="button-orange">Actualizar</a>
                </th>
            </tr>
            <?php endwhile ?>
        </tbody>
    </table>
</main>
<?php
//Cerrar la conexión
mysqli_close($db);
incluirTemplate('footer');
?>   
