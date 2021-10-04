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

//---------------
$seleccionTablaMaterias = new Crud("materias");
$seleccionTablaAulas = new Crud("aulas");
$seleccionTablaDocentes = new Crud("docentes");
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
	<link rel="stylesheet" href="style/custom-style.css">
</head>

<body>
	<!-- /. AGREGAR CARRERA  -->
	<p>
	<div id="page-wrapper">

		<h1 class="page-header">
			AGREGAR MATERIA <small></small>
		</h1>
		<div class="panel panel-primary">
			<div class="panel-body">
				<form method="post">
					<input type="text" name="nmateria" placeholder="Ingrese el nombre de la materia">
					<select name="id-carrera" class="form-control" required>
						<option value="" selected>Seleccione la Carrera*</option>
						<?php
						$seleccionTablaCarreras = new Crud("carreras");
						$value1 = $seleccionTablaCarreras->get();
						foreach ($value1 as $key) {
							$valor1 = $key['carrera'];
							$valor2 = $key['idCarrera'];
							echo '<option value="' . $valor2 . '">' . $valor1 . '</option>';
						}
						?>
					</select>
					<select name="id-docente" required>
						<option value="" selected>Seleccione al Docente*</option>
						<?php
						$value1 = $seleccionTablaDocentes->get();
						foreach ($value1 as $key) {
							$valor1 = $key['nombre'];
							$valor2 = $key['idDocente'];
							echo '<option value="' . $valor2 . '">' . $valor1 . '</option>';
						}
						?>
					</select>
					<select name="id-aula" class="form-control" required>
						<option value="" selected>Seleccione el Aula*</option>
						<?php
						$value1 = $seleccionTablaAulas->get();
						foreach ($value1 as $key) {
							$valor1 = $key['aula'];
							$valor2 = $key['idAula'];
							echo '<option value="' . $valor2 . '">' . $valor1 . '</option>';
						}
						?>
					</select>

					<p>
					<div id="contenedor">
						<div>
							<p>Indique la fecha Inicio</p>
							<input type="date" name="fechaIni">
						</div>
						<div>
							<p>Indique la fecha Fin</p>
							<input type="date" name="fechaFin">
						</div>
					</div>
					</p>
					<p>
					<div id="contenedor">
						<div>
							<p>Indique la hora Inicio</p>
							<input name="timeStart" type="time">
						</div>
						<div>
							<p>Indique la hora Fin</p>
							<input name="timeEnd" type="time">
						</div>
					</div>
					</p>
					<p><input type="submit" value="Agregar" name="add" class="btn btn-primary"></p>
					<?php
					if (isset($_POST['add'])) {
						$crud = new Crud("materias");
						$add1 = $_POST['nmateria'];
						$add2 = $_POST['id-carrera'];
						$add3 = $_POST['id-docente'];
						$add4 = $_POST['id-aula'];
						$add5 = $_POST['fechaIni'];
						$add6 = $_POST['fechaEnd'];
						$add7 = $_POST['timeStart'];
						$add8 = $_POST['timeEnd'];
						$crud->insert([
							"materia" => $add1,
							"idCarrera" => $add2,
							"idDocente" => $add3,
							"idAula" => $add4,
							"fechaInicio" => $add5,
							"fechaFin" => $add6,
							"horaInicio" => $add7,
							"horaFin" => $add8
						]);
						header("Location: materias.php");
					}
					?>
				</form>
			</div>
		</div>
	</div>
	</p>
	<!-- /. ELIMINAR MATERIA -->
	<p>
	<div id="page-wrapper">
		<div id="page-inner">
			<h1 class="page-header">
				ELIMINAR MATERIA
			</h1>
			<div class="panel-body">
				<form name="form" method="post">
					<p>Seleccione la Materia</p>
					<select name="selectMaterias" class="form-control" required>
						<option value selected>Seleccione una opcion</option>
						<?php
						$value1 = $seleccionTablaMaterias->get();
						foreach ($value1 as $key) {
							$valor1 = $key['materia'];
							$valor2 = $key['idMaterias'];
							echo '<option value="' . $valor2 . '">' . $valor1 . '</option>';
						}
						?>
					</select>
					<input type="submit" name="del" value="Eliminar" class="btn btn-primary">
					<?php
					if (isset($_POST['del'])) {
						$del = $_POST['selectMaterias'];
						$seleccionTablaMaterias->where("idMaterias", "=", $del)->delete();
						header("Location: materias.php");
					}
					?>
				</form>
			</div>
		</div>
	</div>
	</p>
</body>

</html>