<?php
	header('Content-type:application/xls');
	header('Content-Disposition: attachment; filename=usuarios.xls');

	require_once('insertar.php');
	$conn=new Conexion();
	$link = $conn->conectarse();

	$query="SELECT * FROM laravel";
	$result=mysqli_query($link, $query);
?>
<!-- GENERADOR DE EXCEL SIN TERMINAR  -->
<table border="1">
	<tr style="background-color:red;">
	<th>id</th>
		<th>usuario</th>
		<th>equipo</th>
		<th>existencia</th>
		<th>bitacora</th>
		<th>caracteristica</th>
		</tr>
	<?php
		while ($row=mysqli_fetch_assoc($result)) {
			?>
				<tr>
					<td><?php echo $row['contact.id']; ?></td>
					<td><?php echo $row['first_name']; ?></td>
					<td><?php echo $row['last_name']; ?></td>
					<td><?php echo $row['email']; ?></td>
					<td><?php echo $row['phone']; ?></td>
					<td><?php echo $row['address']; ?></td>
					
				</tr>	

			<?php
		}

	?>
</table>