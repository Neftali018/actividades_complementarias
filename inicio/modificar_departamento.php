<?php
	require_once('../conexion/conexion.php');
	$title = 'Departamentos';
	$title_menu = 'Departamentos';
	// Consulta para mostrar los datos de la tabla "trabajador"
	

	$sql_trabajador = 'SELECT * FROM trabajador';
	$statement = $pdo->prepare($sql_trabajador);
	$statement->execute();
	$results = $statement->fetchAll();


	$show_form = FALSE;
	if($_POST)
	{
	  	//TODO:UPDATE ARTICLE
	  	$sql_update_details = 'UPDATE departamento SET clave_departamento = ?, nombre_departamento = ?, trabajador_rfc =? WHERE clave_departamento = ?';
		  $clave_departamento = isset($_GET['clave_departamento']) ? $_GET['clave_departamento']: '';
		  
		  $clave_departamento_2 = isset($_POST['clave_departamento_2']) ? $_POST['clave_departamento_2']: '';
		 
		   $nombre_departamento = isset($_POST['nombre_departamento']) ? $_POST['nombre_departamento']: '';
		   
		   $trabajador_rfc = isset($_POST['trabajador_rfc']) ? $_POST['trabajador_rfc']: '';
		   
	  	$statement_update_details = $pdo->prepare($sql_update_details);
	  	$statement_update_details->execute(array($clave_departamento_2, $nombre_departamento, $trabajador_rfc, $clave_departamento));
	  	header('Location: modificar_departamento.php');
	}
	if(isset( $_GET['clave_departamento'] ) )
	{
		//TODO: GET DETAILS
		$show_form = TRUE;
		$sql_update = 'SELECT * FROM departamento WHERE clave_departamento = ?';
		$clave_departamento = isset( $_GET['clave_departamento']) ? $_GET['clave_departamento'] : 0;
		$statement_update = $pdo->prepare($sql_update);
		$statement_update->execute(array($clave_departamento));
		$result_details = $statement_update->fetchAll();
		$rs_details = $result_details[0];
	}
	$sql_status = 'SELECT * FROM departamento ORDER BY clave_departamento';
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
          							<input placeholder="<?php echo $rs_details['clave_departamento'] ?>" name="clave_departamento_2" type="text">
        						</div>
							</div>
							<div class="row">
        						<div class="input-field col s4">
        							<!--<i class="material-icons prefix">account_circle</i>-->
          							<input placeholder="<?php echo $rs_details['nombre_departamento'] ?>" name="nombre_departamento" type="text">
        						</div>
        						</div>
        						<div class="row">
        						<div class="input-field col s4">
        							<!--<i class="material-icons prefix">account_circle</i>-->
          							<input placeholder="<?php echo $rs_details['trabajador_rfc'] ?>" name="trabajador_rfc" type="text">
        						</div>
        						</div>

        					
        				<input class="btn waves-effect waves-light" type="submit" value="Modificar" />
						</form>
						<?php } ?>
				    <h3>Departamentos</h3>
				    <table class="striped">
					  <thead>
					    <tr>
					    	<th>clave del departamento</th>
				          	<th>Nombre del departamento</th>
				          	<th>RFC del trabajador</th>
				  
				          	 <th colspan="2">Acción</th>
				          	
				            
					    </tr>
					  </thead>
					  <tbody>
					  	<?php
				        	foreach($results_status as $rs2) {
				        ?>
					    <tr>
					    	<td><?php echo $rs2['clave_departamento']?></td>
							<td><?php echo $rs2['nombre_departamento']?></td>
						<td><?php echo $rs2['trabajador_rfc']?></td>
							<td><a class="btn waves-effect waves-light" href="modificar_departamento.php?clave_departamento=<?php echo $rs2['clave_departamento']; ?>">Ver detalles</a></td>

							<td><a class="btn waves-effect waves-light pink" onclick="delete_departamento(<?php echo $rs2['clave_departamento']; ?>)" href="#">ELIMINAR</a></td>
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
