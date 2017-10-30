<?php
	require_once('../conexion/conexion.php');
	$title = 'Carreras';
	$title_menu = 'Carreras';
	// Consulta para mostrar los datos de la tabla "Carrera"
	
	$show_form = FALSE;
	if($_POST)
	{
	  	//TODO:UPDATE ARTICLE
	  	$sql_update_details = 'UPDATE carrera SET clave = ?, nombre = ? WHERE clave = ?';
		  $clave = isset($_GET['clave']) ? $_GET['clave']: '';
		  echo $clave;
		  $clave_2 = isset($_POST['clave_2']) ? $_POST['clave_2']: '';
		  echo $clave_2;
		   $nombre = isset($_POST['nombre']) ? $_POST['nombre']: '';
		   echo $nombre;
	  	$statement_update_details = $pdo->prepare($sql_update_details);
	  	$statement_update_details->execute(array($clave, $nombre,$clave_2));
	  	header('Location: modificar_carrera.php');
	}
	if(isset( $_GET['clave'] ) )
	{
		//TODO: GET DETAILS
		$show_form = TRUE;
		$sql_update = 'SELECT * FROM carrera WHERE clave = ?';
		$clave = isset( $_GET['clave']) ? $_GET['clave'] : 0;
		$statement_update = $pdo->prepare($sql_update);
		$statement_update->execute(array($clave));
		$result_details = $statement_update->fetchAll();
		$rs_details = $result_details[0];
	}
	$sql_status = 'SELECT * FROM carrera ORDER BY clave';
	$statement_status = $pdo->prepare($sql_status);
	$statement_status->execute();
	$results_status = $statement_status->fetchAll();
?>
<?php
	include('../extend/header.php');
?>

		<div class="container">
			<div class="row">
				<div class="col s12">
					<h2>Proyecto de actividades complementarias</h2>
					<hr>
					<?php
						if( $show_form )
						{
						?>
						<form method="post">
							<div class="row">
								<div class="input-field col s12">
          							<input placeholder="<?php echo $rs_details['clave'] ?>" name="clave_2" type="text">
        						</div>
							</div>
							<div class="row">
        						<div class="input-field col s4">
        							<!--<i class="material-icons prefix">account_circle</i>-->
          							<input placeholder="<?php echo $rs_details['nombre'] ?>" name="nombre" type="text">
        						</div>
        						</div>


        					
        				<input class="btn waves-effect waves-light" type="submit" value="Modificar" />
						</form>
						<?php } ?>
				    <h3>Carreras</h3>
				    <table class="striped">
					  <thead>
					    <tr>
					    	<th>clave de carrera</th>
				          	<th>Nombre carrera</th>
				             <th colspan="2">Acción</th>
					    </tr>
					  </thead>
					  <tbody>
					  	<?php
				        	foreach($results_status as $rs2) {
				        ?>
					    <tr>
					    	<td><?php echo $rs2['clave']?></td>
							<td><?php echo $rs2['nombre']?></td>
						
							<td><a class="btn waves-effect waves-light" href="modificar_carrera.php?clave=<?php echo $rs2['clave']; ?>">Ver detalles</a></td>

							 <td><a class="btn waves-effect waves-light pink" onclick="delete_carrera(<?php echo $rs2['clave']; ?>)" href="#">ELIMINAR</a></td>
							 
					    </tr>
					    <?php
				          	}
				        ?>
					</tbody>
					</table>
				</div>
			</div>
			<?php
				include('../extend/footer.php');
			?>
