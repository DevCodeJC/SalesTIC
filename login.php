<?php 
require 'includes/funciones.php';
incluirTemplate('header');

//Conexion a la Bade de Datos
require 'includes/config/database.php';
$db = conexionDB();
$errores = [];
$email = '';
$pass = '';

//Autenticar al usuario
if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $email = mysqli_real_escape_string( $db, filter_var($_POST['email'], FILTER_VALIDATE_EMAIL));
    $pass = mysqli_real_escape_string( $db, $_POST['pass']);

    //Validando los campos
    if(!$email){$errores[] = "El e-mail es obligatorio o NO es valido";}
    if(!$pass){$errores[] = "La contraseña es obligatoria o NO es valida";}
    if(empty($errores)){
        //Revisar si existe el usuario
        $query = "SELECT * FROM usuarios WHERE email = '${email}'";
        $resultado = mysqli_query($db, $query);
        if($resultado->num_rows){
            //Revisar si la contraseña es correcta
            $usuario = mysqli_fetch_assoc($resultado);
            /*Verificar password SIN Hassear
            if($usuario['pass']==$pass){
                $auth=true;
            }else{
                $auth=false;
            }*/
            
            //Verificación con password Hasseado
            $auth = password_verify($pass, $usuario['pass']);
            if($auth){
                //El usuario esta autenticado
                session_start();
                //Datos para la sesion
                $_SESSION['correo'] = $usuario['email'];
                $_SESSION['nombre'] = $usuario['nombre_usr'];
                $_SESSION['perfil'] = $usuario['perfil'];
                $_SESSION['login'] = true;
                header('Location: /SalesTIC/admin');
            }else{
                $errores[] = "La contraseña NO es Valida";
            }
        }else{
            $errores[] = "El usuario NO existe";
        }
    }
}
?>  
    <main class="container contenido-centrado"> 
        <h2 class="title-page">Iniciar Sesión</h2>

        <?php foreach($errores as $error): ?>
            <div class="error">
                <?php echo $error; ?>
            </div>
        <?php endforeach;?>

        <form class="formulario" method="POST" action="#">
            <fieldset class="espaciado-abajo">
                <legend>Email & Password</legend>
                <label for="email">E-mail</label>
                <input type="email" name="email" placeholder="Tu correo electronico" 
                    id="email" maxlength="60" value="<?php echo $email ?>" required>
                <label for="pass">Password</label>
                <input type="password" name="pass" placeholder="Tu contraseña" 
                    id="pass" maxlength="60" value="<?php echo $pass ?>" required>
            </fieldset>
            <input type="submit" value="Enviar" class="button-green">     
        </form>
    </main>

<?php 
incluirTemplate('footer');
?>   