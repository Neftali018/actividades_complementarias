<?php
 require_once('../conexion/conexion.php');
 $clave_departamento = isset($_GET['clave_departamento']) ? $_GET['clave_departamento'] : 0 ;
 $sql = 'DELETE FROM departamento WHERE clave_departamento = ?';
 
 $statement = $pdo->prepare($sql);
 $statement->execute(array($clave_departamento));
 
 $results = $statement->fetchAll();
 header('Location: modificar_departamento.php');
 ?>


  				           