<?php
$id = $_GET['id'];
$id = filter_var($id, FILTER_VALIDATE_INT);

if(!$id){header('Location: /SalesTIC/');}
//Conexion a la base de datos
require 'includes/config/database.php';
$db = conexionDB();

$errores = [];
$cedula = '';
$nombre = '';
$tel_comp = '';
$email_comp = '';
$direccion = '';
$tipo_pago = '';

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    //Impedir inyeccion SQL y daño de base de datos
    
    $cedula = mysqli_real_escape_string( $db, $_POST['cedula'] );
    $nombre = mysqli_real_escape_string( $db, $_POST['nombre'] );
    $tel_comp = mysqli_real_escape_string( $db, $_POST['tel_comp'] );
    $email_comp = mysqli_real_escape_string( $db, $_POST['email_comp'] );
    $direccion = mysqli_real_escape_string( $db, $_POST['direccion'] );
    $tipo_pago = mysqli_real_escape_string( $db, $_POST['tipo_pago'] );
    
    //Validación de datos vacios en backend
    if(!$cedula){$errores[]="Especifique número de cédula";}
    if(!$nombre){$errores[]="Especifique su nombre y apellido";}
    if(!$tel_comp){$errores[]="Especifique un número de contacto";}
    if(!$email_comp){$errores[]="Especifique un correo";}
    if(!$direccion){$errores[]="Especifique dirección de domicilio";}

    //Validacion de cedula ya registrada
    $queryid = "SELECT * FROM compradores WHERE cedula = ${cedula}";
    $resultadoid = mysqli_query($db, $queryid);
    if($resultadoid->num_rows === 1){$errores[]="El usuario ya registra una compra";}

    //Validar que el equipo este disponible
    $disp = "SELECT disponible FROM equipos WHERE id_equipo = ${id}";
    $resultadodisp = mysqli_query($db, $disp);
    $estado = mysqli_fetch_assoc($resultadodisp);
    if($estado['disponible'] == '0'){$errores[]="El equipo ya esta vendido";}

    if(empty($errores)){
        //Insertar datos del equipo
        $queryequipo = "UPDATE equipos SET fecha_venta = CURTIME(), disponible = '0'
        WHERE id_equipo = ${id}";
        $resultadoequipo = mysqli_query($db, $queryequipo);

        //Actualizar Comprador
        $queryuser = "INSERT INTO compradores (cedula, nombre, tel_comp, email_comp, direccion, tipo_pago, id_equipo) 
        VALUES ('$cedula', '$nombre', '$tel_comp', '$email_comp', '$direccion', '$tipo_pago', '$id')";
        $resultadouser = mysqli_query($db, $queryuser);
        if($resultadouser){
            header('Location: /SalesTIC?replay=1'); 
        }
    }
}
//Consultar
$query = "SELECT * FROM equipos WHERE id_equipo = ${id}";
$res = mysqli_query($db, $query);
$equipo = mysqli_fetch_assoc($res);

if($res->num_rows === 0){header('Location: /SalesTIC/');}

require 'includes/funciones.php';
incluirTemplate('header');
?>  
    <main class="container-purchase"> 
        <h2 class="title-page">Confirmar compra</h2>

        <?php foreach($errores as $error): ?>
            <div class="error">
            <?php echo $error;?>
            </div>
        <?php endforeach;?>

        <div class="purchase">
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
                    <a class="button-orange" href="/SalesTIC/fichas/<?php echo $equipo['ficha'] ?>">Ver detalles>></a>
                </div><!-- Contenido anuncio -->
            </div><!-- anuncio -->
            
            <form class="formulario" method="POST">
                <h4>Complete sus datos para comprar</h4>
                <fieldset>
                    <legend>Datos de la compra</legend>
                    <label for="cedula">Cédula</label>
                    <input type="number" name="cedula" placeholder="Número de cédula" 
                        id="cedula" min="1" max= "9999999999" required>
                    <label for="user">Nombre y apellido</label>
                    <input type="text" placeholder="Nombre completo" style="text-transform:uppercase;" 
                        name="nombre" id="user" maxlength="60" required>
                    <label for="tel_comp">Número de teléfono</label>
                    <input type="number" name="tel_comp" placeholder="Número de contacto" 
                        id="tel_comp" min="1" max= "9999999999" required>
                    <label for="email_comp">Correo electrónico</label>
                    <input type="email" placeholder="E-mail" name="email_comp" 
                        id="email_comp" maxlength="60" required>
                    <label for="direccion">Dirección</label>
                    <input type="text" placeholder="Dirección de residencia" style="text-transform:uppercase;"
                        name="direccion" id="direccion" maxlength="60" required> 
                    <label for="way">Forma de pago</label>
                    <select id="way" name="tipo_pago" required>
                        <option value="" disabled selected>--Seleccione--</option>
                        <option value="Transferencia">Transferencia</option>
                        <option value="Descuento nomina">Descuento Nómina</option>
                    </select>
                </fieldset>
                <div class="terms">
                    <input type="checkbox" required>
                    <p>Acepto <a href="/SalesTIC/img/AutorizacionDatos.pdf">Términos y condiciones</a></p>
                </div>
                
                <input type="submit" value="Completar Compra" class="button-green button-long espaciado-abajo">
                <a class="button-red" href="/SalesTIC/">Cancelar</a>
            </form>
            </div>
        </div>
        

    </main>

<?php
//Cerrar la conexión
mysqli_close($db);
incluirTemplate('footer');
?>  