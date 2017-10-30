<?php
	require_once('../conexion/conexion.php');
 $titulo='Estudiantes';
    $titulo='Estudiantes';
	$sql = 'SELECT * FROM estudiante WHERE nombre_estudiante LIKE :search';
    $search_terms = isset($_GET['nombre_estudiante'])? $_GET['nombre_estudiante'] : '';
    $arr_sql_terms[':search'] = '%' . $search_terms . '%';

	$statement = $pdo->prepare($sql);
	$statement->execute($arr_sql_terms);
	$results = $statement->fetchAll();

	$sql_status = 'SELECT estudiante.*, carrera.nombre FROM estudiante INNER JOIN carrera ON carrera.clave = estudiante.carrera_clave ';
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
		<title><?php echo $titulo ?></title>
		<link rel="stylesheet" href="../css/materialize.min.css">
		</head>

	<body>
		<!--Import jQuery before materialize.js-->
    	<script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    	<script type="text/javascript" src="js/materialize.min.js"></script>
    	<div class="navbar-fixed">
        <nav class="teal lighten-2">
            <div class="nav-wrapper">
                <a href="#" class="brand-logo right">Instituto Tecnologico de Cd. Altamirano </a>
                <ul id="nav-mobile" class="left side-nav">
                    <li><a href="index.php">Inicio</a></li>
                </ul>
            </div>
        </nav>
    </div>
		<div class="container">
			<div class="row">
				<div class="col s12">
					<h2>Buscador sencillo con LIKE</h2>
					<hr>
					<form method="get">
                            <div class="row">
                                <div class="col s12">
                                    <label>Ingrese el nombre del estudiante
                                    <input type="text" name="nombre_estudiante" placeholder="ej.Jose">
                                    <input class="btn waves-effect waves-light blue" type="submit" value="BUSCAR"/>
                                    </label>
                            </div>
                    </form>
					
					
					<h3>Estudiantes</h3>
					
					<table class="striped">
				        <thead>
				          <tr>
				              <th>No Control</th>
				              <th>Nombre</th>
				              <th>Apellido Paterno</th>
				              <th>Apellido Materno</th>
				              <th>Semestre</th>
				              <th>Carrera</th>
				          </tr>
				        </thead>
				        <tbody>
				        	<?php

				        		foreach($results as $rs) 
				        			{
				        	?>
				        
				          <tr>
							<td><?php echo $rs['n_control']?></td>
							<td><?php echo $rs['nombre_estudiante']?></td>
							<td><?php echo $rs['a_paterno']?></td>
							<td><?php echo $rs['a_materno']?></td>
							<td><?php echo $rs['semestre']?></td>
							<td><?php echo $rs['carrera_clave']?></td>
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
	</body>
</html>