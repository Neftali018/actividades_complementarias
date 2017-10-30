<?php
 require_once('../conexion/conexion.php');
 $clave = isset($_GET['clave']) ? $_GET['clave'] : 0 ;
 $sql = 'DELETE FROM carrera WHERE clave = ?';
 
 $statement = $pdo->prepare($sql);
 $statement->execute(array($clave));
 
 $results = $statement->fetchAll();
 header('Location: modificar_carrera.php');
 ?>


  				           
