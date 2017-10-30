<?php
	require_once('../conexion/conexion.php');
	$title = 'Instructor';
	$title_menu = 'Instructor';
	// Consulta para mostrar los datos de la tabla "trabajador"
	

	$sql_actividad_comp = 'SELECT * FROM actividad_comp';
	$statement = $pdo->prepare($sql_actividad_comp);
	$statement->execute();
	$results = $statement->fetchAll();


	$show_form = FALSE;
	if($_POST)
	{
	  	//TODO:UPDATE ARTICLE
	  	$sql_update_details = 'UPDATE instructor SET rfc_inst = ?, nombre = ?, a_paterno =?, a_materno =?, actividad_comple =? WHERE rfc_inst = ?';
		  $rfc_inst = isset($_GET['rfc_inst']) ? $_GET['rfc_inst']: '';
		  echo $rfc_inst;
		  $rfc_inst_2 = isset($_POST['rfc_inst_2']) ? $_POST['rfc_inst_2']: '';
		  echo $clave_departamento_2;
		   $nombre = isset($_POST['nombre']) ? $_POST['nombre']: '';
		   echo $nombre;
		   $a_paterno = isset($_POST['a_paterno']) ? $_POST['a_paterno']: '';
		   echo $a_paterno;
		    $a_materno = isset($_POST['a_materno']) ? $_POST['a_materno']: '';
		   echo $a_materno;
		    $actividad_comple = isset($_POST['actividad_comple']) ? $_POST['actividad_comple']: '';
		   echo $actividad_comple
		   ;
	  	$statement_update_details = $pdo->prepare($sql_update_details);
	  	$statement_update_details->execute(array($rfc_inst, $nombre, $a_paterno, $a_materno,$actividad_comple,$rfc_inst_2));
	  	header('Location: modificar_instructor.php');
	}
	if(isset( $_GET['rfc_inst'] ) )
	{
		//TODO: GET DETAILS
		$show_form = TRUE;
		$sql_update = 'SELECT * FROM instructor WHERE rfc_inst = ?';
		$rfc_inst = isset( $_GET['rfc_inst']) ? $_GET['rfc_inst'] : 0;
		$statement_update = $pdo->prepare($sql_update);
		$statement_update->execute(array($rfc_inst));
		$result_details = $statement_update->fetchAll();
		$rs_details = $result_details[0];
	}
	$sql_status = 'SELECT * FROM instructor ORDER BY rfc_inst';
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
          							<input placeholder="<?php echo $rs_details['rfc_inst'] ?>" name="rfc_inst" type="text">
        						</div>
							</div>
							<div class="row">
        						<div class="input-field col s4">
        							<!--<i class="material-icons prefix">account_circle</i>-->
          							<input placeholder="<?php echo $rs_details['nombre'] ?>" name="nombre" type="text">
        						</div>
        						</div>
        						<div class="row">
        						<div class="input-field col s4">
        							<!--<i class="material-icons prefix">account_circle</i>-->
          							<input placeholder="<?php echo $rs_details['a_paterno'] ?>" name="a_paterno" type="text">
        						</div>
        						</div>
        						<div class="row">
        						<div class="input-field col s4">
        							<!--<i class="material-icons prefix">account_circle</i>-->
          							<input placeholder="<?php echo $rs_details['a_materno'] ?>" name="a_materno" type="text">
        						</div>
        						</div>
        						<div class="row">
        						<div class="input-field col s4">
        							<!--<i class="material-icons prefix">account_circle</i>-->
          							<input placeholder="<?php echo $rs_details['actividad_comple'] ?>" name="actividad_comple" type="text">
        						</div>
        						</div>

        					
        				<input class="btn waves-effect waves-light yellow" type="submit" value="Modificar" />
						</form>
						<?php } ?>
				    <h3>Instructor</h3>
				    <table class="striped">
					  <thead>
					    <tr>
					    	<th>RFC del instructor</th>
				          	<th>Nombre del instructor</th>
				          	<th>Apelllido paterno</th>
				            <th>Apelllido materno</th>
				            <th>Actividad complementaria</th>

				            <th colspan="2">Acción</th>

					    </tr>
					  </thead>
					  <tbody>
					  	<?php
				        	foreach($results_status as $rs2) {
				        ?>
					    <tr>
					    	<td><?php echo $rs2['rfc_inst']?></td>
							<td><?php echo $rs2['nombre']?></td>
						<td><?php echo $rs2['a_paterno']?></td>
						<td><?php echo $rs2['a_materno']?></td>
						<td><?php echo $rs2['actividad_comple']?></td>

							<td><a class="btn waves-effect waves-light yellow" href="modificar_instructor.php?rfc_inst=<?php echo $rs2['rfc_inst']; ?>">Ver detalles</a></td>

							<td><a class="btn waves-effect waves-light red" onclick="delete_instructor(<?php echo $rs2['rfc_inst']; ?>)" href="#">ELIMINAR</a></td>
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
