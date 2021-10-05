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

//--------
$seleccionTablaCarreras = new Crud("carreras");
$seleccionTablaJefecarrera = new Crud("jefecarrera");

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
					<input type="text" name="inputCarrera" placeholder="Ingrese el nombre de la Carrera">
					<p>Tipo de Carrera</p>
					<select name="tipo" required>
						<option value="" selected>Seleccione el Tipo</option>
						<option value="Tecnico Superior">TECNICO SUPERIOR</option>
						<option value="Tecnico Medio">TECNICO MEDIO</option>
						<option value="Carrera Corta">CORTA</option>
					</select>

					<p>Seleccione al Encargad@ de la Carrera</p>
					<select name="jefeCarrera" required>
						<option value="" selected>Seleccione una opcion*</option>
						<?php
						$value1 = $seleccionTablaJefecarrera->get();
						foreach ($value1 as $key) {
							$valor1 = $key['nombre'];
							$valor2 = $key['idJefeCarrera'];
							echo '<option value="' . $valor2 . '">' . $valor1 . '</option>';
						}
						?>
					</select>
					<p><input type="submit" value="Agregar" name="add" class="btn btn-primary"></p>
					<?php
					if (isset($_POST['add'])) {
						$crud = new Crud("carreras");
						$add1 = $_POST['inputCarrera'];
						$add2 = $_POST['tipo'];
						$add3 = $_POST['jefeCarrera'];
						$crud->insert([
							"carrera" => $add1,
							"tipo" => $add2,
							"idJefeCarrera" => $add3
						]);
						header("Location: carreras.php");
					}
					?>
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
					<select name="selectCarreras" class="form-control" required>
						<option value selected>Seleccione una opcion</option>
						<?php
						$value1 = $seleccionTablaCarreras->get();
						foreach ($value1 as $key) {
							$valor1 = $key['carrera'];
							$valor2 = $key['idCarrera'];
							echo '<option value="' . $valor2 . '">' . $valor1 . '</option>';
						}
						?>
					</select>
					<input type="submit" name="del" value="Eliminar" class="btn btn-primary">
					<?php
					if (isset($_POST['del'])) {
						$del = $_POST['selectCarreras'];
						$seleccionTablaCarreras->where("idCarrera", "=", $del)->delete();
						header("Location: carreras.php");
					}
					?>
				</form>
			</div>
		</div>
	</div>
	</p>
</body>

</html>