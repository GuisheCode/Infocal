<?php
require('includes/config.php');
require_once 'includes/Crud.php';

//if not logged in redirect to login page
if (!$user->is_logged_in()) {
	header('Location: login.php');
	exit();
}

//define page title
$title = 'Administracion de Eventos y Conferencias';

//include header template
require('layout/header.php');
require('layout/menu.php');

//include header template
require('layout/footer.php');

//---------------
$seleccionTablaMaterias = new Crud("conferencias");

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
			AGREGAR EVENTO <small></small>
		</h1>
		<div class="panel panel-primary">
			<div class="panel-body">
				<form method="post">
					<input type="text" name="nombre" placeholder="Ingrese el nombre del evento">

                    <input type="text" name="descripcion" placeholder="Ingrese la descripción">

                    <input type="text" name="docente" placeholder="Ingrese el docente encargado o la organización">
					


					<p>
					<div id="contenedor">
						<div>
							<p>Indique la fecha Inicio</p>
							<input type="date" name="fechaini">
						</div>
						<div>
							<p>Indique la fecha Fin</p>
							<input type="date" name="fechafin">
						</div>
					</div>
					</p>
					<p>
					<div id="contenedor">
						<div>
							<p>Indique la hora Inicio</p>
							<input name="horaini" type="time">
						</div>
						<div>
							<p>Indique la hora Fin</p>
							<input name="horafin" type="time">
						</div>
					</div>
					</p>
					<p><input type="submit" value="Agregar" name="add" class="btn btn-primary"></p>
					<?php
					if (isset($_POST['add'])) {
						$crud = new Crud("conferencias");
						$add1 = $_POST['nombre'];
						$add2 = $_POST['descripcion'];
						$add3 = $_POST['docente'];
						$add4 = $_POST['fechaini'];
						$add5 = $_POST['fechafin'];
						$add6 = $_POST['horaini'];
						$add7 = $_POST['horafin'];
						$crud->insert([
							"nombre" => $add1,
							"descripcion" => $add2,
							"docente" => $add3,
							"fechaini" => $add4,
							"fechafin" => $add5,
							"horaini" => $add6,
							"horafin" => $add7
						]);
						header("Location: adm-conferencias.php");
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
				ELIMINAR EVENTO
			</h1>
			<div class="panel-body">
				<form name="form" method="post">
					<p>Seleccione el Evento</p>
					<select name="selectMaterias" class="form-control" required>
						<option value selected>Seleccione una opcion</option>
						<?php
						$value1 = $seleccionTablaMaterias->get();
						foreach ($value1 as $key) {
							$valor1 = $key['nombre'];
							$valor2 = $key['idconferencia'];
							echo '<option value="' . $valor2 . '">' . $valor1 . '</option>';
						}
						?>
					</select>
					<input type="submit" name="del" value="Eliminar" class="btn btn-primary">
					<?php 
					if(isset($_POST['del']))
					{
						$del = $_POST['selectMaterias'];
						$seleccionTablaMaterias->where("idconferencia","=",$del)->delete();
						header("Location: adm-conferencias.php");
					}
					?>
				</form>
			</div>
		</div>
	</div>
	<div>
	<div class="fila">
	<br>
	<h4 class="tituloDocente">Editar conferencias y eventos</h4>
	<hr>
<?php
$seleccionTablaAulas =new Crud("conferencias");
$selectAll=$seleccionTablaAulas->get();

foreach ($selectAll as $key) {

		$idAula = $key['idconferencia'];
		$selectAllAulas=$seleccionTablaAulas->where("idconferencia","=",$idAula)->get();

				foreach ($selectAllAulas as $valoresAulas) {
					
		?>
			<div class="columna">
				<div class="card">
				<div class="dentro">
					<br>
					<i class="fas fa-chalkboard-teacher iconoTarjeta"></i>
					<h4 class="tituloTarjeta"><b><?php echo $valoresAulas['nombre'] ?></b></h4>
					<h5 class="subtituloTarjeta">Docente: <i><?php echo $valoresAulas['docente'] ?></i></h5>
					</div>
					<h5 class="subTarjeta">Fecha Inicio: <b><i><?php echo $valoresAulas['fechaini'] ?></i></b></h5>
					<h5 class="subTarjeta">Fecha Final: <b><i><?php echo $valoresAulas['fechafin'] ?></i></b></h5>
					<h5 class="subTarjeta">Descripción: <b><i><?php echo $valoresAulas['descripcion'] ?></i></b></h5>
					<h3 class="subTarjeta">Horario: <b><i><?php echo $valoresAulas['horaini'] ?> - <b><i><?php echo $valoresAulas['horafin'] ?></i></b></h3>
					<div class="px-1">
						<a href="#" class="btn-warning">Editar <i class="fas fa-pencil-alt"></i></a>
					</div>	
				</div>
			</div>
<?php		
					
				}

}
?>


</div>
	</div>
	</p>
</body>

</html>