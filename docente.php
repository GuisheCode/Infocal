<?php 
require('includes/config.php'); 
require_once 'includes/Crud.php';

//if not logged in redirect to login page
if (! $user->is_logged_in()){
    header('Location: login.php'); 
    exit(); 
}

//define page title
$title = 'Docentes';

//include header template
require('layout/header.php'); 
require('layout/menu.php');






/***************** PARA CONSULTAR ALGUNOS DATOS DE UNA TABLA ******************/
//  SELECT * FROM tablaMaterias WHERE AND WHERE
//  Creamos objeto para utilizar con la tabla "materias"
$seleccionTablaMaterias = new Crud("materias");
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
	<h4 class="tituloDocente">Mis clases hoy</h4>
	<hr>
<?php
$seleccionTablaAulas =new Crud("aulas");
$seleccionTablaCarreras =new Crud("carreras");
$seleccionTablaDocentes =new Crud("docentes");
$selectAll=$seleccionTablaMaterias->get();

$fechaHoy=date('Ymd');
$hora =date('Gis');
foreach ($selectAll as $key) {
	$valorStringInicio = $key['fechaInicio'];
	$valorEnteroInicio=str_replace("-","",$valorStringInicio);
	$diferenciaInicio = $fechaHoy-$valorEnteroInicio;

	$valorStringFin = $key['fechaFin'];
	$valorEnteroFin = str_replace("-","",$valorStringFin);
	$diferenciaFin = $fechaHoy-$valorEnteroFin;
	$valorHoraStringInicio = $key['horaInicio'];
	$valorHoraEnteroInicio=str_replace(":","",$valorHoraStringInicio);
	$diferenciaHoraInicio = $hora-$valorHoraEnteroInicio;

	$valorHoraStringFin = $key['horaFin'];
	$valorHoraEnteroFin=str_replace(":","",$valorHoraStringFin);
	$diferenciaHoraFin = $hora-$valorHoraEnteroFin;
	
	if ($diferenciaInicio>=0 && $diferenciaFin<=0 && $diferenciaHoraInicio>=0 && $diferenciaHoraFin<=0){
		$idMaterias = $key['idMaterias'];
		$idDocente = $key['idDocente'];
		$idCarrera = $key['idCarrera'];
		$idAula = $key['idAula'];
		$selectAllAulas=$seleccionTablaAulas->where("idAula","=",$idAula)->get();
		$selectAllDocentes=$seleccionTablaDocentes->where("idDocente","=",$idDocente)->get();
		$selectAllCarreras=$seleccionTablaCarreras->where("idCarrera","=",$idCarrera)->get();
		foreach ($selectAllDocentes as $valoresDocentes) {	
			foreach ($selectAllCarreras as $valoresCarreras) {
				foreach ($selectAllAulas as $valoresAulas) {
		?>
			<div class="columna">
				<div class="card">
				<div class="dentro">
					<br>
					<i class="fas fa-users iconoTarjeta"></i>
					<h4 class="tituloTarjeta">Aula: <b><?php echo $valoresAulas['aula'] ?></b></h4>
					<h5 class="subTarjeta">Materia: <?php echo $key['materia'] ?></h5>
					<br><br>
					<h5 class="subTarjeta">Carrera: <?php echo $valoresCarreras['carrera'] ?></h5>
					<h5 class="subTarjeta">Docente: <?php echo $valoresDocentes['nombre'] ?></h5>
					</div>
				</div>
			</div>
<?php		
				}
			}
		}
	}
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
