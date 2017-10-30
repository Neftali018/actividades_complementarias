<?php
	require_once('../conexion/conexion.php');
	$title = 'Institutos';
	$title_menu = 'Institutos';
	// Consulta para mostrar los datos de la tabla "Carrera"
	
	$show_form = FALSE;
	if($_POST)
	{
	  	//TODO:UPDATE ARTICLE
	  	$sql_update_details = 'UPDATE trabajador SET rfc = ?, nombre = ?, a_paterno =?, a_materno =?, clase_presupuestal =? WHERE rfc = ?';
		  $rfc = isset($_GET['rfc']) ? $_GET['rfc']: '';
		  echo $rfc;
		  $rfc_2 = isset($_POST['rfc_2']) ? $_POST['rfc_2']: '';
		  echo $rfc_2;
		   $nombre = isset($_POST['nombre']) ? $_POST['nombre']: '';
		   echo $nombre;
		    $a_paterno = isset($_POST['a_paterno']) ? $_POST['a_paterno']: '';
		   echo $a_paterno;
		    $a_materno = isset($_POST['a_materno']) ? $_POST['a_materno']: '';
		   echo $a_materno;
		    $clase_presupuestal = isset($_POST['clase_presupuestal']) ? $_POST['clase_presupuestal']: '';
		   echo $clase_presupuestal;

	  	$statement_update_details = $pdo->prepare($sql_update_details);
	  	$statement_update_details->execute(array($rfc,$nombre,$a_paterno,$a_materno,$clase_presupuestal,$rfc_2));
	  	header('Location: modificar_trabajador.php');
	}
	if(isset( $_GET['rfc'] ) )
	{
		//TODO: GET DETAILS
		$show_form = TRUE;
		$sql_update = 'SELECT * FROM trabajador WHERE rfc = ?';
		$rfc = isset( $_GET['rfc']) ? $_GET['rfc'] : 0;
		$statement_update = $pdo->prepare($sql_update);
		$statement_update->execute(array($rfc));
		$result_details = $statement_update->fetchAll();
		$rs_details = $result_details[0];
	}
	$sql_status = 'SELECT * FROM trabajador ORDER BY rfc';
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
          							<input placeholder="<?php echo $rs_details['rfc'] ?>" name="rfc_2" type="text">
        						</div>
							</div>
							<div class="row">
        						<div class="input-field col s4">
        							<!--<i class="material-icons prefix">account_circle</i>-->
          							<input placeholder="<?php echo $rs_details['nombre'] ?>" name="nombre" type="text"><input placeholder="<?php echo $rs_details['a_paterno'] ?>" name="a_paterno" type="text"><input placeholder="<?php echo $rs_details['a_materno'] ?>" name="a_materno" type="text">
        						</div>
        						</div>

        					
        				<input class="btn waves-effect waves-light" type="submit" value="Modificar" />
						</form>
						<?php } ?>
				    <h3>Trabajadores</h3>
				    <table class="striped">
					  <thead>
					    <tr>
					    	<th>RFC del trabajador</th>
				          	<th>Nombre del trabajador</th>
				            <th>Apellido paterno</th>
				            <th>Apellido materno</th>
				            <th colspan="2">Acción</th>
					    </tr>
					  </thead>
					  <tbody>
					  	<?php
				        	foreach($results_status as $rs2) {
				        ?>
					    <tr>
					    	<td><?php echo $rs2['rfc']?></td>
							<td><?php echo $rs2['nombre']?></td>
							<td><?php echo $rs2['a_paterno']?></td>
							<td><?php echo $rs2['a_materno']?></td>
							<td><a class="btn waves-effect waves-light" href="modificar_trabajador.php?rfc=<?php echo $rs2['rfc']; ?>">Ver detalles</a></td>

							<td><a class="btn waves-effect waves-light pink" onclick="delete_trabajador(<?php echo $rs2['rfc']; ?>)" href="#">ELIMINAR</a></td>
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
