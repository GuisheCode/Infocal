<?php
require('includes/config.php');
require_once 'includes/Crud.php';

//if not logged in redirect to login page
if (!$user->is_logged_in()) {
	header('Location: login.php');
	exit();
}

//define page title
$title = 'Carreras';

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
	<div id="page-wrapper">
		<h1 class="page-header">
			AGREGAR CARRERA <small></small>
		</h1>
		<div class="panel panel-primary">
			<div class="panel-body">
				<form method="post">
					<input type="text" name="carrera" placeholder="Ingrese el nombre de la Carrera">
					<p>Tipo de Carrera</p>
					<select name="tipo" required>
						<option value="" selected>Seleccione el Tipo</option>
						<option value="Tecnico Superior">TECNICO SUPERIOR</option>
						<option value="Tecnico Medio">TECNICO MEDIO</option>
						<option value="Carrera Corta">CORTA</option>
					</select>
					<p><input type="submit" value="Add New" class="btn btn-primary"></p>
				</form>
			</div>
		</div>
	</div>
	</p>

	<!-- /. ELIMINAR CARRERA  -->
	<p>
	<div id="page-wrapper">
		<div id="page-inner">
			<h1 class="page-header">
				ELIMINAR CARRERA
			</h1>
			<div class="panel-body">
				<form name="form" method="post">
					<p>Seleccione la Carrera</p>
					<select name="id" class="form-control" required>
						<option value selected></option>
					</select>
					<input type="submit" name="del" value="Eliminar" class="btn btn-primary">
				</form>
			</div>
		</div>
	</div>
	</p>
</body>

</html>