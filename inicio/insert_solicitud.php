<?php
	require_once('../conexion/conexion.php');
	$title = 'Agregar un nuevo registro';

	$sql1 = 'SELECT * FROM estudiante';
	$statement1 = $pdo->prepare($sql1);
	$statement1->execute();
	$results1 = $statement1->fetchAll();

	$sql2 = 'SELECT * FROM trabajador';
	$statement2 = $pdo->prepare($sql2);
	$statement2->execute();
	$results2 = $statement2->fetchAll();

	$sql3 = 'SELECT * FROM actividad_comp';

	$statement3 = $pdo->prepare($sql3);
	$statement3->execute();
	$results3 = $statement3->fetchAll();
	
	$sql4 = 'SELECT * FROM instituto';
	$statement4 = $pdo->prepare($sql4);
	$statement4->execute();
	$results4 = $statement4->fetchAll();

	if( $_POST )
	{
  		$sql_insert = 'INSERT INTO solicitud ( fecha, asunto, folio, instituto_clave, estudiante_n_control, clave_actividad, rfc ) VALUES( ?, ?, ?, ?, ?, ?, ? )';
  		$fecha = isset($_POST['fecha']) ? $_POST['fecha']: '';
  		echo $fecha;
  		$asunto = isset($_POST['asunto']) ? $_POST['asunto']: '';
  		echo $asunto;
  		$folio = isset($_POST['folio']) ? $_POST['folio']: '';
  		echo $folio;
  		$instituto_clave = isset($_POST['instituto_clave']) ? $_POST['instituto_clave']: '';
  		echo $instituto_clave;
  		$estudiante_n_control = isset($_POST['estudiante_n_control']) ? $_POST['estudiante_n_control']: '';
  		echo $estudiante_n_control;
  		$clave_actividad = isset($_POST['clave_actividad']) ? $_POST['clave_actividad']: '';
  		echo $clave_actividad;
  		$trabajador_rfc = isset($_POST['rfc']) ? $_POST['rfc']: '';
  		echo $trabajador_rfc;

  		$statement_insert = $pdo->prepare($sql_insert);
  		$statement_insert->execute(array($fecha,$asunto,$folio,$instituto_clave,$estudiante_n_control,$clave_actividad,$trabajador_rfc));
	}
	$sql_status = 'SELECT solicitud.*, estudiante.nombre_estudiante, trabajador.nombre, actividad_comp.nombre_act, instituto.nombre FROM solicitud 

	 INNER JOIN estudiante ON estudiante.n_control = solicitud.estudiante_n_control
	INNER JOIN trabajador ON trabajador.rfc = solicitud.trabajador_rfc 
	
	INNER JOIN actividad_comp ON actividad_comp.clave_act = solicitud.clave_actividad
	INNER JOIN instituto ON instituto.clave = solicitud.instituto_clave';

	$statement_status = $pdo->prepare($sql_status);
	$statement_status->execute();
	$results_status = $statement_status->fetchAll();
?>

<!DOCTYPE html>
<html lang="es">
	<head>
		<meta charset="utf-8"/>
		<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
		<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
		<title><?php echo $title?></title>
		<link rel="stylesheet" href="../css/materialize.css">
		</head>

	<body>
		<!--Import jQuery before materialize.js-->
    	<script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    	<script type="text/javascript" src="../js/materialize.min.js"></script>
    	<div class="navbar-fixed">
	        <nav class="teal lighten-1">
	            <div class="nav-wrapper">
	                <a href="#" class="brand-logo right">Solicitud</a>
	                <ul id="nav-mobile" class="left side-nav">
	                    <li><a href="index.php">Inicio</a></li>
	                </ul>
	            </div>
	        </nav>
    	</div>
		<div class="container">
			<div class="row">
				<div class="col s12">
					<h2>Crear nueva solicitud</h2>
					<hr>
				</div>
			</div>
			<div class="row">
				<form method="post" class="col s12">
					<div class="row">
						<div class="input-field col s12">
          				<input placeholder="Fecha" name="fecha" type="text">
        				</div>
					</div>
					<div class="row">
        				<div class="input-field col s4">
        				<!--<i class="material-icons prefix">account_circle</i> -->
          				<input placeholder="Asunto" name="asunto" type="text">
        				</div>
        				<div class="input-field col s4">
        					 <!--<i class="material-icons prefix">account_circle</i>-->
          				<input placeholder="Folio" name="folio" type="text">
        				</div>
        				
        			</div>
        			<div class="row">
        				<div class="input-field col s12">
                  		<select name="estudiante_n_control">
                  			<option value="" disabled selected>Elige el estudiante</option>
                  			<?php 
				        	foreach($results1 as $rs) {
				        	?>
  							<option value="<?php echo $rs['n_control']?>"><?php echo $rs['nombre_estudiante']?></option>
  							<?php 
				          	}
				        ?>
						</select>
						<label>estudiante</label>
						</div>
        			</div>
        			<div class="row">
        				<div class="input-field col s12">
                  		<select name="trabajdor_rfc">
                  			<option value="" disabled selected>Elige un trabajador</option>
                  			<?php 
				        	foreach($results2 as $rs) {
				        	?>
  							<option value="<?php echo $rs['rfc']?>"><?php echo $rs['nombre']?></option>
  							<?php 
				          	}
				        ?>
						</select>
						<label>trabajador</label>
						</div>
        			</div>
        			<div class="row">
        				<div class="input-field col s12">
                  		<select name="clave_actividad">
                  			<option value="" disabled selected>elige la actividad</option>
                  			<?php 
				        	foreach($results3 as $rs) {
				        	?>
  							<option value="<?php echo $rs['clave_act']?>"><?php echo $rs['nombre_act']?></option>
  							<?php 
				          	}
				        ?>
						</select>
						<label>actividades</label>
						</div>
        			</div>
						<div class="row">
        				<div class="input-field col s12">
                  		<select name="instituto_clave">
                  			<option value="" disabled selected>Elige un instituto</option>
                  			<?php 
				        	foreach($results4 as $rs) {
				        	?>
  							<option value="<?php echo $rs['clave']?>"><?php echo $rs['nombre']?></option>
  							<?php 
				          	}
				        ?>
						</select>
						<label>instituto</label>
						</div>
        			</div>
        			<input class="btn waves-effect waves-light yellow" type="submit" value="Agregar" />
        		</form>
      		</div>
			<div class="row">
				<div class="col s12">
				    <h3>Solicitudes</h3>
				    <table class="striped">
					  <thead>
					    <tr>
					    	<th>Fecha</th>
				          	<th>Asunto</th>
				            <th>Folio</th>
				            <th>estudiante</th>
				            <th>trabajador</th>
				            <th>actividad complementaria</th>
				             <th>instituto</th>
					    </tr>
					  </thead>
					  <tbody>
					  	<?php 
				        	foreach($results_status as $rs2) {
				        ?>
					    <tr>
					    	<td><?php echo $rs2['fecha']?></td>
							<td><?php echo $rs2['asunto']?></td>
							<td><?php echo $rs2['folio']?></td>
							<td><?php echo $rs2['nombre_estudiante']?></td>
							<td><?php echo $rs2['trabajador_rfc']?></td>
							<td><?php echo $rs2['nombre_act']?></td>
							<td><?php echo $rs2['nombre']?></td>
					    </tr>
					    <?php 
				          	}
				        ?>
					</tbody>
					</table>
				</div>
			</div>
			
			<div class="col s12">
                <footer class="page-footer teal lighten-2">
                    <div class="footer-copyright">
                        <div class="container">
                            &copy; 2017 Neftali Cabrera Torres
                        </div>
                    </div>
                </footer>
            </div>
		</div>
		<!--  Scripts-->
    	<!--Import jQuery before materialize.js-->
      	<script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
      	<script type="text/javascript" src="../js/materialize.min.js"></script>
      	<script>
      		$(document).ready(function() {
    		$('select').material_select();
  			});
      	</script>
	</body>
</html>