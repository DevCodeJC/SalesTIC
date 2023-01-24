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
$query = "SELECT `compradores`.*, `equipos`.* FROM `compradores` 
	LEFT JOIN `equipos` ON `compradores`.`id_equipo` = `equipos`.`id_equipo`;";
$resultado = mysqli_query($db, $query);

header('Content-Type: aplication/xls');
header('Content-Disposition: attachment; filename=Informe.xls;');
	?>
	<meta charset="utf-8">
	<table border="1">
	<tr>
		<th>Cedula</th>
		<th>Comprador</th>
		<th>Teléfono</th>
		<th>E-mail</th>
		<th>Dirección</th>
		<th>Pago</th>
		<th>ID equipo</th>
		<th>Tipo</th>
		<th>Marca/Modelo</th>
		<th>Serial</th>
		<th>Precio</th>
		<th>Sistema</th>
		<th>Procesador</th>
        <th>RAM</th>
        <th>Disco</th>
        <th>Fecha de compra</th>
        <th>Observaciones</th>
	</tr>
	<?php 
	while ($row = mysqli_fetch_assoc($resultado)){
	?>
	<tr>
		<td><?php echo $row['cedula']; ?></td>
		<td><?php echo $row['nombre']; ?></td>
		<td><?php echo $row['tel_comp']; ?></td>
		<td><?php echo $row['email_comp']; ?></td>
		<td><?php echo $row['direccion']; ?></td>
		<td><?php echo $row['tipo_pago']; ?></td>
		<td><?php echo $row['id_equipo']; ?></td>
		<td><?php echo $row['tipo_equipo']; ?></td>
		<td><?php echo $row['nombre_equipo']; ?></td>
		<td><?php echo $row['serial_equipo']; ?></td>
		<td><?php echo $row['precio']; ?></td>
		<td><?php echo $row['so']; ?></td>
		<td><?php echo $row['chip']; ?></td>
        <td><?php echo $row['ram']; ?></td>
        <td><?php echo $row['disco']; ?></td>
        <td><?php echo $row['fecha_venta']; ?></td>
        <td><?php echo $row['observacion']; ?></td>
	</tr>
	<?php	
	}
	?>
</table>
<?php
//Cerrar la conexión
mysqli_close($db);
?>   