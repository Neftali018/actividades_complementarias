<?php
	require_once('../conexion/conexion.php');
	$title = 'Agregar un nuevo registro';
	$sql_departamento = 'SELECT * FROM trabajador';

	$statement = $pdo->prepare($sql_departamento);
	$statement->execute();
	$results = $statement->fetchAll();
	if( $_POST )
	{
  		$sql_insert = 'INSERT INTO departamento ( clave_departamento, nombre_departamento, trabajador_rfc ) VALUES( ?, ?, ? )';
  		$clave_departamento = isset($_POST['clave_departamento']) ? $_POST['clave_departamento']: '';
  		$nombre_departamento = isset($_POST['nombre_departamento']) ? $_POST['nombre_departamento']: '';
  		$trabajador_rfc = isset($_POST['trabajador_rfc']) ? $_POST['trabajador_rfc']: '';
  		$statement_insert = $pdo->prepare($sql_insert);
  		$statement_insert->execute(array($clave_departamento,$nombre_departamento,$trabajador_rfc));
	}
	$sql_status = 'SELECT departamento.*, trabajador.nombre FROM departamento INNER JOIN trabajador ON trabajador.rfc = departamento.trabajador_rfc';
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
                <a href="#" class="brand-logo right">Departamento</a>
                <ul id="nav-mobile" class="left side-nav">
                    <li><a href="index.php">Inicio</a></li>
                </ul>
            </div>
        </nav>
    </div>
		<div class="container">
			<div class="row">
				<div class="col s12">
					<h2>Agregar un nuevo Departamento</h2>
					<hr>
				</div>
			</div>
			<div class="row">
				<form method="post" class="col s12">
					<div class="row">
						<div class="input-field col s12">
          				<input placeholder="Clave" name="clave_departamento" type="text">
        				</div>
					</div>
					<div class="row">
        				<div class="input-field col s12">
          				<input placeholder="Nombre" name="nombre_departamento" type="text">
        				</div>
        			</div>
							<div class="row">
        				<div class="input-field col s12">
                  		<select name="trabajador_rfc">
                  			<option value="" disabled selected>Elige un Trabajador</option>
                  			<?php
				        	foreach($results as $rs) {
				        	?>
  							<option value="<?php echo $rs['rfc']?>"><?php echo $rs['nombre']?></option>
  							<?php
				          	}
				        ?>
						</select>
						<label>Trabajador</label>
						</div>
        			</div>
        			<input class="btn waves-effect waves-light" type="submit" value="Agregar" />
        		</form>
      		</div>
			<div class="row">
				<div class="col s12">
				    <h3>Departamento</h3>
				    <table class="striped">
					  <thead>
					    <tr>
					    	<th>Clave</th>
				          	<th>Nombre</th>
				            <th>Trabajador</th>
					    </tr>
					  </thead>
					  <tbody>
					  	<?php
				        	foreach($results_status as $rs) {
				        ?>
					    <tr>
					    	<td><?php echo $rs['clave_departamento']?></td>
							<td><?php echo $rs['nombre_departamento']?></td>
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
