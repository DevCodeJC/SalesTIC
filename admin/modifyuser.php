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

//Validar ID
$id = $_GET['id']; 
$id = filter_var($id, FILTER_VALIDATE_INT);
if(!$id){
    header('Location: /SalesTIC/admin');
}
//Conexion a la Bade de Datos
require '../includes/config/database.php';
$db = conexionDB();

$consulta = "SELECT * FROM usuarios WHERE id_usr = ${id}";
$resultado = mysqli_query($db, $consulta);
$user = mysqli_fetch_assoc($resultado);

$errores = [];
$email = $user['email'];
$usuario = $user['nombre_usr'];
$pass = '';
$perfil = $user['perfil'];

//Insertar valores de formulario
if($_SERVER['REQUEST_METHOD'] === 'POST'){

    //Impedir inyeccion SQL y daño de base de datos
    $email = mysqli_real_escape_string( $db, $_POST['email'] );
    $usuario = mysqli_real_escape_string( $db, $_POST['usuario'] );
    $pass = mysqli_real_escape_string( $db, $_POST['pass'] );
    $perfil = mysqli_real_escape_string( $db, $_POST['perfil'] );

    //Validación de datos vacios en backend
    if(!$email){$errores[]="Especifique un correo";}
    if(!$usuario){$errores[]="Especifique nombre del usuario";}
    if(!$pass){$errores[]="Especifique una contraseña";}
    if(!$perfil){$errores[]="Especifique un perfil";}
    
    //if($resultadoval->num_rows == 1){$errores[]="El usuario ya esta registrado";}

    if(empty($errores)){
        
        //Hassear password
        $passHash = password_hash($pass, PASSWORD_BCRYPT);

        //Actualizar nuevos datos en formulario
        $query = "UPDATE usuarios SET email = '${email}', nombre_usr = '${usuario}', 
        pass = '${passHash}', perfil = ${perfil} WHERE id_usr = ${id}";

        //Agregarlo a la base de datos
        $res = mysqli_query($db, $query);

        if($res){
            header('Location: /SalesTIC/admin/users.php?replay=2');
        }
    }
}
incluirTemplate('header');
?>
<main class="container contenido-centrado">
    <h2 class="title-page">Modificar Usuario</h2>

    <?php foreach($errores as $error): ?>
        <div class="error">
            <?php echo $error; ?>
        </div>
    <?php endforeach;?>

    <form class="formulario" method="POST">
        <fieldset class="espaciado-abajo">
            <legend>Usuario</legend>
            <label for="email">E-mail</label>
            <input type="email" name="email" placeholder="Correo electronico valido" 
                id="email" maxlength="60" value="<?php echo $email ?>" required>
            <label for="usuario">Usuario</label>
            <input type="text" name="usuario" placeholder="Nombre y apellido" 
                id="usuario" maxlength="30" value="<?php echo $usuario ?>" required>
            <label for="pass">Contraseña</label>
            <input type="password" name="pass" placeholder="Contraseña" 
                id="pass" maxlength="60" value="<?php echo $pass ?>" required>
            <label for="perfil">Tipo de usuario</label>
            <select name="perfil" id="perfil" value="<?php echo $perfil;?>" required>
                <option value="" disabled selected>--Seleccione--</option>
                <option <?php echo $perfil == 1 ? 'selected': '';?> 
                    value="1" >Administrador</option>
                <option <?php echo $perfil == 2 ? 'selected': '';?>
                    value="2">Estandar</option>
            </select>
        </fieldset>
        <input type="submit" value="Enviar" class="button-green">     
    </form>
</main>

<?php
//Cerrar la conexión
mysqli_close($db);
incluirTemplate('footer');
?>   
