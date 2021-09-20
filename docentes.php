<?php
require('includes/config.php');
require_once 'includes/Crud.php';

//if not logged in redirect to login page
if (!$user->is_logged_in()) {
	header('Location: login.php');
	exit();
}

//define page title
$title = 'Materias';

//include header template
require('layout/header.php');
require('layout/menu.php');

//include header template
require('layout/footer.php');
?>

<!DOCTYPE html>
<html>

<head>
	<link rel="stylesheet" href="style/custom-style.css">
</head>

<body>
	<!-- /. AGREGAR CARRERA  -->
	<p>
	<div id="contenedor">
		<div id="page-wrapper">
			<h1 class="page-header">
				AGREGAR DOCENTE <small></small>
			</h1>
			<div class="panel panel-primary">
				<div class="panel-body">
					<form method="post">
						<input type="text" name="carrera" placeholder="Ingrese el nombre del docente">
						<p><input type="submit" value="Agregar" class="btn btn-primary"></p>
					</form>
				</div>
			</div>
		</div>
		</p>
		<p>
		<div id="page-wrapper">
			<h1 class="page-header">
				AGREGAR AULA<small></small>
			</h1>
			<div class="panel panel-primary">
				<div class="panel-body">
					<form method="post">
						<input type="text" name="carrera" placeholder="Ingrese el Aula">
						<p><input type="submit" value="Agregar" class="btn btn-primary"></p>
					</form>
				</div>
			</div>
		</div>
	</div>
	</p>
	<!-- /. ELIMINAR CARRERA  -->
	<p>
	<div id="page-wrapper">
		<div id="page-inner">
			<h1 class="page-header">
				ELIMINAR DOCENTE
			</h1>
			<div class="panel-body">
				<form name="form" method="post">
					<p>Seleccione al docente</p>
					<select name="id" class="form-control" required>
						<option value selected></option>
					</select>
					<input type="submit" name="del" value="Eliminar" class="btn btn-primary">
				</form>
			</div>
		</div>
	</div>
	</p>

	<p>
	<div id="page-wrapper">
		<div id="page-inner">
			<h1 class="page-header">
				ELIMINAR AULA
			</h1>
			<div class="panel-body">
				<form name="form" method="post">
					<p>Seleccione el aula</p>
					<select name="id" class="form-control" required>
						<option value selected><h1>cualquier cosa</h1></option>
						
					</select>
					<input type="submit" name="del" value="Eliminar" class="btn btn-primary">
				</form>
			</div>
		</div>
	</div>
	</p>
</body>

</html>