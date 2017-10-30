﻿<?php
	require_once('../conexion/conexion.php');
?>
<?php 
	$sql = 'SELECT * FROM solicitud ORDER BY folio';
	$statement = $pdo->prepare($sql);
	$statement->execute(array());
	$results = $statement->fetchAll();

		$sql_status = 'SELECT solicitud.*, estudiante.n_control FROM solicitud INNER JOIN estudiante ON solicitud.folio = estudiante.carrera_clave';
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
		<title>PHP & SQL</title>
		<link rel="stylesheet" href="../css/materialize.min.css">
		</head>

	<body>
		<!--Import jQuery before materialize.js-->
    	<script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    	<script type="text/javascript" src="js/materialize.min.js"></script>
    	<div class="navbar-fixed">
        <nav class="red accent-4">
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
					<h2>Ejecución de una sentencia SQL</h2>
					<hr>
					<h3>Datos SQL</h3>
					<pre>
						
					</pre>
						
					<h3>Solicitud</h3>
					<hr>
					<table class="striped">
				        <thead>
				          <tr>
				              <th>FECHA</th>
				              <th>ASUNTO</th>
				               <th>FOLIO</th>
				              <th>CLAVE DE INSTITUTO</th>
				               <th>NO.CONTROL ESTUDIANTE</th>
				              <th>ACTIVIDAD COMPLEMENTARIA</th>
					       <th>RFC INSTRUCTOR</th>	
				          </tr>
				        </thead>
				        <tbody>
				        	<?php 
				        		foreach($results as $rs) {
				        	?>
				          <tr>
							<td><?php echo $rs['fecha']?></td>
							<td><?php echo $rs['asunto']?></td>
							<td><?php echo $rs['folio']?></td>
							<td><?php echo $rs['instituto_clave']?></td>
							<td><?php echo $rs['estudiante_n_control']?></td>
							<td><?php echo $rs['clave_actividad']?></td>
							<th><?php echo $rs['trabajador_rfc']?></th>
				          </tr>
				          <?php 
				          	}
				          ?>
				        </tbody>
				    </table>

				    
				</div>
			</div>
			<div class="col s12">
                <footer class="page-footer red accent-4">
                    <div class="footer-copyright">
                        <div class="container">
                            &copy; 2017 NEFTALI CABRERA TORRES
                        </div>
                    </div>
                </footer>
            </div>
		</div>
	</body>
</html>