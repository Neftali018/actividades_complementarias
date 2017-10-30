<?php
	require_once('../conexion/conexion.php');
	$title = 'Agregar un nuevo registro';

	if( $_POST )
	{
  		$sql_insert = 'INSERT INTO trabajador ( rfc, nombre, a_paterno, a_materno ) VALUES( ?, ?, ?, ?)';
  		$rfc = isset($_POST['rfc']) ? $_POST['rfc']: '';
  		echo $rfc;
  		$nombre = isset($_POST['nombre']) ? $_POST['nombre']: '';
  		echo $nombre;
  		$a_paterno = isset($_POST['a_paterno']) ? $_POST['a_paterno']: '';
  		echo $a_paterno;
  		$a_materno = isset($_POST['a_materno']) ? $_POST['a_materno']: '';
  		echo $a_materno;

  		$statement_insert = $pdo->prepare($sql_insert);
  		$statement_insert->execute(array($rfc,$nombre,$a_paterno,$a_materno));
	}
	$sql_status = 'SELECT * FROM trabajador ORDER BY rfc';
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
    	<script type="text/javascript" src="js/materialize.min.js"></script>
    	<div class="navbar-fixed">
        <nav class="teal lighten-2">
            <div class="nav-wrapper">
                <a href="#" class="brand-logo right">Trabajador</a>
                <ul id="nav-mobile" class="left side-nav">
                    <li><a href="index.php">Inicio</a></li>
                </ul>
            </div>
        </nav>
    </div>
		<div class="container">
			<div class="row">
				<div class="col s12">
					<h2>Agregar un nuevo Trabajador</h2>
					<hr>
				</div>
			</div>
			<div class="row">
				<form method="post" class="col s12">
					<div class="row">
						<div class="input-field col s12">
          				<input placeholder="Rfc" name="rfc" type="text">
        				</div>
					</div>
					<div class="row">
        				<div class="input-field col s4">
          				<input placeholder="Nombre" name="nombre" type="text">
        				</div>
        				<div class="input-field col s4">
          				<input placeholder="Apellido Paterno" name="a_paterno" type="text">
        				</div>
        				<div class="input-field col s4">
          				<input placeholder="Apellido Materno" name="a_materno" type="text">
						</div>
        			</div>
        			<input class="btn waves-effect waves-light" type="submit" value="Agregar" />
        		</form>
      		</div>
			<div class="row">
				<div class="col s12">
				    <h3>Trabajador</h3>
				    <table class="striped">
					  <thead>
					    <tr>
					    	<th>Rfc</th>
				          	<th>Nombre</th>
				            <th>Apellido Paterno</th>
				            <th>Apellido Materno</th>
					    </tr>
					  </thead>
					  <tbody>
					  	<?php
				        	foreach($results_status as $rs) {
				        ?>
					    <tr>
					    	<td><?php echo $rs['rfc']?></td>
							<td><?php echo $rs['nombre']?></td>
							<td><?php echo $rs['a_paterno']?></td>
							<td><?php echo $rs['a_materno']?></td>
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
                            &copy; 2017 NEFTALI CABRERA TORRES	
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
