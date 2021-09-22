<?php 
require('includes/config.php'); 
require_once 'includes/Crud.php';

//if not logged in redirect to login page
if (! $user->is_logged_in()){
    header('Location: login.php'); 
    exit(); 
}

//define page title
$title = 'Conferencias';

//include header template
require('layout/header.php'); 
require('layout/menu.php');






/***************** PARA CONSULTAR ALGUNOS DATOS DE UNA TABLA ******************/
//  SELECT * FROM tablaMaterias WHERE AND WHERE
//  Creamos objeto para utilizar con la tabla "materias"
$seleccionTablaMaterias = new Crud("conferencias");
//  Pasamos los datos a la funcion, que nos devuelve un array con los datos que pedimos
$whereAndWhere = $seleccionTablaMaterias->where("idDocente","=",2)->where("idCarrera","=",1)->get();
//  Muestra el array con su tipo de datos
// echo "<pre>";
// var_dump($whereAndWhere);
// echo "</pre>";
//  Recorremos todos los datos devueltos por la consulta y los guardamos en variables separadas
foreach($whereAndWhere as $index){
    $idMaterias = $index['idMaterias'];
    $materia    = $index['materia'];
    $idDocente  = $index['idDocente'];
    $idCarrera  = $index['idCarrera'];
}

/***************** PARA CONSULTAR TODOS LOS DATOS DE UNA TABLA ******************/
//  Consulta todos los datos de una tabla
// $selectAll=$seleccionTablaMaterias->get();
//  Muestra el array con toda la consulta devuelta
// echo "<pre>";
// var_dump($selectAll);
// echo "</pre>";

/***************** PARA ACTUALIZAR UNA TABLA ******************/
$update = $seleccionTablaMaterias->where("idMaterias","=",1)->update(["materia"=>"BD","idDocente"=>1,"idCarrera"=>1]);

/***************** PARA ELIMINAR DATOS DE UNA TABLA ******************/
$delete = $seleccionTablaMaterias->where("idMaterias","=",4)->delete();

/***************** Muestra los registros afectados ******************/
// echo "FILAS ACTUALIZADAS: " . $update . " ELIMINADOS: " . $delete;


?>
<div class="fila">
	<br>
	<h4 class="tituloDocente">Conferencias y eventos</h4>
	<hr>
<?php
$seleccionTablaAulas =new Crud("conferencias");
$selectAll=$seleccionTablaAulas->get();

//$fechaHoy=date('Ymd');
//$hora =date('Gis');
foreach ($selectAll as $key) {
	//$valorStringInicio = $key['fechaInicio'];
	//$valorEnteroInicio=str_replace("-","",$valorStringInicio);
	//$diferenciaInicio = $fechaHoy-$valorEnteroInicio;

	//$valorStringFin = $key['fechaFin'];
	//$valorEnteroFin = str_replace("-","",$valorStringFin);
	//$diferenciaFin = $fechaHoy-$valorEnteroFin;
	
	//if ($diferenciaInicio>=0 && $diferenciaFin<=0 && $diferenciaHoraInicio>=0 && $diferenciaHoraFin<=0){
		//$idMaterias = $key['idMaterias'];
		//$idDocente = $key['idDocente'];
		//$idCarrera = $key['idCarrera'];
		$idAula = $key['idconferencia'];
		$selectAllAulas=$seleccionTablaAulas->where("idconferencia","=",$idAula)->get();
		//$selectAllDocentes=$seleccionTablaDocentes->where("idDocente","=",$idDocente)->get();
		//$selectAllCarreras=$seleccionTablaCarreras->where("idCarrera","=",$idCarrera)->get();
		//$selectAllRecursos=$seleccionTablaRecursos->where("idMateria","=",$idMaterias)->get();
		//foreach ($selectAllDocentes as $valoresDocentes) {	
			//foreach ($selectAllCarreras as $valoresCarreras) {
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
					<h5 class="subTarjeta">Asistencia: <b><i><?php echo $valoresAulas['asistencia'] ?></i></b></h5>
										
				</div>
			</div>
<?php		
					
				}
			//}
		//}
	//}
}
?>
<?php 
		
?>
</div>
<div class="">		
				<h2>Mis Actividades - <?php echo htmlspecialchars($_SESSION['username'], ENT_QUOTES); ?></h2>
				<?php
				//  

				?>
				<p><a href='logout.php'>Logout</a></p>
		</div>



	</div>
</div>
<?php 
//include header template
require('layout/footer.php'); 
?>
