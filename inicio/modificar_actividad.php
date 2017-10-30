<?php
	require_once('../conexion/conexion.php');
	$title = 'Actividades';
	$title_menu = 'Actividades';
	// Consulta para mostrar los datos de la tabla "Carrera"
	
	$show_form = FALSE;
	if($_POST)
	{
	  	//TODO:UPDATE ARTICLE
	  	$sql_update_details = 'UPDATE actividad_comp SET clave_act = ?, nombre_act = ? WHERE clave_act = ?';
		  $clave_act = isset($_GET['clave_act']) ? $_GET['clave_act']: '';
		  echo $clave_act;
		  $clave_act_2 = isset($_POST['clave_act_2']) ? $_POST['clave_act_2']: '';
		  echo $clave_act_2;
		   $nombre_act = isset($_POST['nombre_act']) ? $_POST['nombre_act']: '';
		   echo $nombre_act;
	  	$statement_update_details = $pdo->prepare($sql_update_details);
	  	$statement_update_details->execute(array($clave_act, $nombre_act,$clave_act_2));
	  	header('Location: modificar_actividad.php');
	}
	if(isset( $_GET['clave_act'] ) )
	{
		//TODO: GET DETAILS
		$show_form = TRUE;
		$sql_update = 'SELECT * FROM actividad_comp WHERE clave_act = ?';
		$clave_act = isset( $_GET['clave_act']) ? $_GET['clave_act'] : 0;
		$statement_update = $pdo->prepare($sql_update);
		$statement_update->execute(array($clave_act));
		$result_details = $statement_update->fetchAll();
		$rs_details = $result_details[0];
	}
	$sql_status = 'SELECT * FROM actividad_comp ORDER BY clave_act';
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
          							<input placeholder="<?php echo $rs_details['clave_act'] ?>" name="clave_act_2" type="text">
        						</div>
							</div>
							<div class="row">
        						<div class="input-field col s4">
        							<!--<i class="material-icons prefix">account_circle</i>-->
          							<input placeholder="<?php echo $rs_details['nombre_act'] ?>" name="nombre_act" type="text">
        						</div>
        						</div>

        					
        				<input class="btn waves-effect waves-light" type="submit" value="Modificar" />
						</form>
						<?php } ?>
				    <h3>Actividades</h3>
				    <table class="striped">
					  <thead>
					    <tr>
					    	<th>Numero de actividad</th>
				          	<th>Nombre actividad</th>
				          	<th colspan="2">Acción</th>
				            
					    </tr>
					  </thead>
					  <tbody>
					  	<?php
				        	foreach($results_status as $rs2) {
				        ?>
					    <tr>
					    	<td><?php echo $rs2['clave_act']?></td>
							<td><?php echo $rs2['nombre_act']?></td>
							<td><a class="btn waves-effect waves-light" href="modificar_actividad.php?clave_act=<?php echo $rs2['clave_act']; ?>">Ver detalles</a></td>
							<td><a class="btn waves-effect waves-light yellow" onclick="delete_actividad(<?php echo $rs2['clave_act']; ?>)" href="#">ELIMINAR</a></td>
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
