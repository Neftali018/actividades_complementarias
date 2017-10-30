<?php
	require_once('../conexion/conexion.php');
?>
<?php 
$sql_status = 'SELECT estudiante.*, carrera.nombre FROM estudiante INNER JOIN carrera ON carrera.clave = estudiante.carrera_clave';
	$statement_status = $pdo->prepare($sql_status);
	$statement_status->execute();
	$results_status = $statement_status->fetchAll();

	$sql = 'SELECT * FROM estudiante ORDER BY semestre';
	$statement = $pdo->prepare($sql);
	$statement->execute(array());
	$results = $statement->fetchAll();

	

	
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
                <a href="#" class="brand-logo right">Estudiantes</a>
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
						
					<h3>Estudiantes</h3>
					<hr>
					<table class="striped">
				        <thead>
				          <tr>
				              <th>No control</th>
						 <th>Nombre</th>
				              <th>apellido Paterno</th>
				              <th>Apellido Materno</th>   
				              <th>Semestre</th>
				              <th>Carrera</th>
				          </tr>
				        </thead>
				        <tbody>
				        	<?php 
				        		foreach($results_status as $rs) {
				        	?>
				          <tr>
							<td><?php echo $rs['n_control']?></td>
							<td><?php echo $rs['nombre_estudiante']?></td>
							<td><?php echo $rs['a_paterno']?></td>
							<td><?php echo $rs['a_materno']?></td>
							<td><?php echo $rs['semestre']?></td>
							<td><?php echo $rs['nombre']?></td>
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