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
//Validacion de campos vacios en formulario
$errores = [];
$tipo_equipo = '';
$nombre_equipo = '';
$observacion = '';
$so = '';
$chip = '';
$ram = '';
$disco = '';
$precio = '';
$serial_equipo = '';
$imagen = '';
$ficha = '';

//Insertar valores de formulario
if($_SERVER['REQUEST_METHOD'] === 'POST'){
    //Impedir inyeccion SQL y daño de base de datos
    
    $tipo_equipo = mysqli_real_escape_string( $db, $_POST['tipo_equipo'] );
    $nombre_equipo = mysqli_real_escape_string( $db, $_POST['nombre_equipo'] );
    $observacion = mysqli_real_escape_string( $db, $_POST['observacion'] );
    $so = mysqli_real_escape_string( $db, $_POST['so'] );
    $chip = mysqli_real_escape_string( $db, $_POST['chip'] );
    $ram = mysqli_real_escape_string( $db, $_POST['ram'] );
    $disco = mysqli_real_escape_string( $db, $_POST['disco'] );
    $precio = mysqli_real_escape_string( $db, $_POST['precio'] );
    $serial_equipo = mysqli_real_escape_string( $db, $_POST['serial_equipo'] );
    $imagen = $_FILES['imagen'];
    $ficha = $_FILES['ficha'];

    //Validación de datos vacios en backend
    if(!$tipo_equipo){$errores[]="Especifique un tipo de equipo";}
    if(!$nombre_equipo){$errores[]="Especifique la Marca y Modelo";}
    if(!$observacion){$errores[]="Especifique una observacion";}
    if(!$so){$errores[]="Especifique el sistema operativo";}
    if(!$chip){$errores[]="Especifique el procesador";}
    if(!$ram){$errores[]="Especifique tamaño de memoria";}
    if(!$disco){$errores[]="Especifique tamaño de disco";}
    if(!$precio){$errores[]="Especifique el precio de venta";}
    if(!$serial_equipo){$errores[]="Especifique el serial";}

    //Validar imagen
    if(!$imagen['name']){$errores[]="Se requiere una imagen";}
    //Validar tamaño maximo de imagen 400Kb
    $maximg = 1000*1000;
    if($imagen['size']>$maximg){$errores[]="La imagen debe ser inferior a 1Mb";}
    //Validar adjunto
    if(!$ficha['name']){$errores[]="Se requiere una ficha";}
    //Validar tamaño maximo de PDF 1000Kb
    $maxpdf = 5000*1000;
    if($ficha['size']>$maxpdf){$errores[]="La ficha debe ser inferior a 5Mb";}

    if(empty($errores)){
        
        //Crear directorio de imagenes
        $imagenes = '../imagenes';
        if(!is_dir($imagenes)){mkdir($imagenes);}
        //Generar un nombre unico a la imagen a subir
        $nombreimagen = md5( uniqid(rand(), true)) . ".jpg";
        //Subir imagenes
        move_uploaded_file( $imagen['tmp_name'], $imagenes . "/". "$nombreimagen" );

        //Crear directorio de fichas
        $fichas = '../fichas';
        if(!is_dir($fichas)){mkdir($fichas);}
        //Generar un nombre unico a la ficha a subir
        $nombreficha = md5( uniqid(rand(), true) ) . '.pdf' ;
        //Subir fichas
        move_uploaded_file( $ficha['tmp_name'], $fichas . '/'. $nombreficha );
        
        $query = "INSERT INTO equipos (tipo_equipo, nombre_equipo, serial_equipo, observacion, precio, so, 
        chip, ram, disco, imagen, ficha, disponible) VALUES ('$tipo_equipo', '$nombre_equipo', '$serial_equipo', 
        '$observacion', '$precio', '$so', ' $chip', '$ram', '$disco', '$nombreimagen', '$nombreficha', '1')";
        $resultado = mysqli_query($db, $query);

        //Redireccionar a admin
        if($resultado){
            header('Location: /SalesTIC/admin?replay=1'); 
        }else{
            echo "error de carga";
        }
    }
}

incluirTemplate('header');
?>  
<main class="container contenido-centrado"> 
    <h3 class="title-page">Crear nueva publicación</h3>
        
    <?php foreach($errores as $error): ?>
        <div class="error">
        <?php echo $error;?>
        </div>
    <?php endforeach;?>

    <form class="formulario espaciado-abajo" method="POST" enctype="multipart/form-data">
        <fieldset>
            <legend>Información general</legend>
            <label for="tipo_equipo">Tipo</label>
            <select name="tipo_equipo" id="tipo_equipo" value="<?php echo $tipo_equipo;?>" required>
                <option value="" disabled selected>--Seleccione--</option>
                <option <?php echo $tipo_equipo == 'Computador' ? 'selected': '';?> 
                    value="Computador" >Computador</option>
                <option <?php echo $tipo_equipo == 'Portatil' ? 'selected': '';?> 
                    value="Portatil">Portátil</option>
                <option <?php echo $tipo_equipo == 'Tablet' ? 'selected': '';?> 
                    value="Tablet">Tablet</option>
            </select>
            <label for="nombre_equipo">Marca/modelo</label>
            <input type="text" name="nombre_equipo" id="nombre_equipo" placeholder="Ej: Lenovo E470" 
                maxlength="30" value="<?php echo $nombre_equipo?>" required>
            <label for="observacion">Observaciones</label>
            <input type="text" name="observacion" id="observacion" placeholder="Perifericos, defectos, etc" 
                    maxlength="150" value="<?php echo $observacion?>" required>
            </fieldset>
            <fieldset>
            <legend>Caracteristicas</legend>
            <div class="features">
                <label for="so">Sistema</label>
                <input type="text" id="so" name="so" placeholder="Ej: Windows 8.1 Pro" 
                    maxlength="20" value="<?php echo $so?>" required>
                <label for="chip">Procesador</label>
                <input type="text" id="chip" name="chip" placeholder="Ej: Intel Core i5" 
                    maxlength="20" value="<?php echo $chip?>" required>
                <label for="ram">RAM</label>
                <input type="number" id="ram" name="ram" placeholder="GB" min="1" max= "99" 
                    value="<?php echo $ram?>" required>
                <label for="disco">Disco</label>
                <input type="number" placeholder="GB" id="disco" name="disco" min="1" max= "9999" 
                    value="<?php echo $disco?>" required>
                <label for="precio">Precio</label>
                <input type="number" name="precio" placeholder="Valor COP" id="precio" min="1" 
                    max= "9999999" value="<?php echo $precio?>" required>
                <label for="serial_equipo">Serial</label>
                <input type="text" name="serial_equipo" placeholder="Serial" id="serial_equipo" 
                    value="<?php echo $serial_equipo?>" required>
            </div>
        </fieldset>
        <fieldset class="espaciado-abajo">
            <legend>Adjuntos</legend>
            <label for="imagen">Imagen</label>
            <input type="file" id="imagen" name="imagen" accept="image/jpeg">
            <label for="ficha">Ficha</label>
            <input type="file" id="ficha" name="ficha" accept=".pdf">
        </fieldset>
        <input type="submit" value="Publicar" class="button-long button-green espaciado-abajo">
    </form>
    <a class="button-red" href="index.php">Cancelar</a>
</main>

<?php incluirTemplate('footer');?>  