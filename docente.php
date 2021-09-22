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
$seleccionTablaRecursos =new Crud("recursos");
$nulo= NULL;
$array=array();
$selectRecursos=$seleccionTablaRecursos->where("idMateria","=",0)->get();
foreach ($selectRecursos as $recursos){
	$array[]= $recursos['recurso'];
	
}
echo count($array);
echo $array[0];
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

	$horaInicioString = $key['horaInicio'];
	$horaInicioEntero = str_replace(":","",$horaInicioString);
	$diferenciaHoraInicio = $hora-$horaInicioEntero;

	$horaFinString = $key['horaFin'];
	$horaFinEntero=str_replace(":","",$horaFinString);
	$diferenciaHoraFin = $hora-$horaFinEntero;
	
	// if ($diferenciaInicio>=0 && $diferenciaFin<=0 && $diferenciaHoraInicio>=0 && $diferenciaHoraFin<=0){
	if ($diferenciaInicio>=0 && $diferenciaFin<=0 && $diferenciaHoraFin<=0){
		$idMaterias = $key['idMaterias'];
		$idDocente = $key['idDocente'];
		$idCarrera = $key['idCarrera'];
		$idAula = $key['idAula'];
		$selectAllAulas=$seleccionTablaAulas->where("idAula","=",$idAula)->get();
		$selectAllDocentes=$seleccionTablaDocentes->where("idDocente","=",$idDocente)->get();
		$selectAllCarreras=$seleccionTablaCarreras->where("idCarrera","=",$idCarrera)->get();
		$selectAllRecursos=$seleccionTablaRecursos->where("idMateria","=",$idMaterias)->get();
		
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
					<h5 class="subtituloTarjeta">Materia: <i><?php echo $key['materia'] ?></i></h5>
					</div>
					<h5 class="subTarjeta">Carrera: <b><i><?php echo $valoresCarreras['carrera'] ?></i></b></h5>
					<h5 class="subTarjeta">Docente: <b><i><?php echo $valoresDocentes['nombre'] ?></i></b></h5>
					<h5 class="subTarjeta">Horario: <b><i><?php echo $key['horaInicio'] ?> - <?php echo $key['horaFin'] ?></i></b></h5>
					<h5 class="subTarjeta">Recurso(s):</h5>
					<?php foreach ($selectAllRecursos as $valoresRecursos) {?> 
						<?php echo "<h5 class='subTarjeta'><b><i>- ".$valoresRecursos['recurso']."</i></b></h5>"?>
					<?php
					}
					?>
					<p hidden><?php echo $key['idMaterias'] ?></p>
					<form action="" id="formRecursos">
						<?php
						
						?>
						<select hidden name="" id="">
							<?php
							for ($i=0; $i < count($array); $i++) {
							?>
							<option value="s"><?php  
							echo $array[$i];
							?></option>
							<?php
							}
							?>
						</select>
					</form>
					<button type="button" id="actRecurso">Cambiar/Quitar Recurso</button>
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



<form action="">
<label for="recurso">
	<span>Recurso</span>
	<input type="text" id="recurso" placeholder="Recurso">
</label>
<label for="idMateria">
	<span>ID Materia</span>
	<input type="text" id="idMateria" placeholder="ID Materia">
</label>
<button type="button" id="enviar">Enviar</button>
</form>
<br>
<select name="" id="">
							<option value=""><?php echo $recursos['recurso'] ?></option>
						</select>
<div id="respuesta"></div>



<div class="">		
				<h2>Mis Actividades - <?php echo htmlspecialchars($_SESSION['username'], ENT_QUOTES); ?></h2>
				<?php
				?>
				<p><a href='logout.php'>Logout</a></p>
		</div>



	</div>
</div>
<?php 
//include header template
require('layout/footer.php'); 
?>
