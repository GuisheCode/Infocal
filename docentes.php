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

//-----
$seleccionTablaAulas = new Crud("aulas");
$seleccionTablaDocentes = new Crud("docentes");
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
						<input type="text" name="inputDocente" placeholder="Ingrese el nombre del docente">
						<p><input type="submit" value="Agregar" name="add" class="btn btn-primary"></p>
						<?php
						if (isset($_POST['add'])) {
							$crud = new Crud("docentes");
							$add = $_POST['inputDocente'];
							$crud->insert([
								"nombre" => $add
							]);
							header("Location: docentes.php");
						}
						?>
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
						<input type="text" name="inputAula" placeholder="Ingrese el Aula">
						<p><input type="submit" value="Agregar" name="add" class="btn btn-primary"></p>
						<?php
						if (isset($_POST['add'])) {
							$crud = new Crud("aulas");
							$add = $_POST['inputAula'];
							$crud->insert([
								"aula" => $add
							]);
							header("Location: docentes.php");
						}
						?>
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
					<select name="selectDocentes" class="form-control" required>
						<option value selected>Seleccione una opcion</option>
						<?php
						$value1 = $seleccionTablaDocentes->get();
						foreach ($value1 as $key) {
							$valor1 = $key['nombre'];
							$valor2 = $key['idDocente'];
							echo '<option value="' . $valor2 . '">' . $valor1 . '</option>';
						}
						?>
					</select>
					<input type="submit" name="del" value="Eliminar" class="btn btn-primary">
					<?php
					if (isset($_POST['del'])) {
						$del = $_POST['selectDocentes'];
						$seleccionTablaDocentes->where("idDocente", "=", $del)->delete();
						header("Location: docentes.php");
					}
					?>
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
					<select name="selectAula" class="form-control" required>
						<option value selected>Seleccione una opcion</option>
						<?php
						$value1 = $seleccionTablaAulas->get();
						foreach ($value1 as $key) {
							$valor1 = $key['aula'];
							$valor2 = $key['idAula'];
							echo '<option value="' . $valor2 . '">' . $valor1 . '</option>';
						}
						?>
					</select>

					<input type="submit" name="del" value="Eliminar" class="btn btn-primary">
					<?php
					if (isset($_POST['del'])) {
						$del = $_POST['selectAula'];
						$seleccionTablaAulas->where("idAula", "=", $del)->delete();
						header("Location: docentes.php");
					}
					?>
				</form>
			</div>
		</div>
	</div>
	</p>
</body>

</html>