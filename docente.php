<?php 
// Incluimos la configuracion para la base de datos y la clase para el uso de sus funciones
require('includes/config.php'); 
require_once 'includes/Crud.php';

// Si no ha iniciado sesion, lo redirige ala ventana login
if (! $user->is_logged_in()){
    header('Location: login.php'); 
    exit(); 
}

// Definimos el titulo de la pagina
$title = 'Docente';

// Incluimos el header y el menu de navegación
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
// $update = $seleccionTablaMaterias->where("idMaterias","=",1)->update(["materia"=>"BD","idDocente"=>1,"idCarrera"=>1]);

/***************** PARA ELIMINAR DATOS DE UNA TABLA ******************/
$delete = $seleccionTablaMaterias->where("idMaterias","=",4)->delete();

/***************** Muestra los registros afectados ******************/
// echo "FILAS ACTUALIZADAS: " . $update . " ELIMINADOS: " . $delete;


?>
<div class="fila" id="fila">
    <br>
    <h4 class="tituloDocente">Clases hoy - <?php echo date('l')." ".date('d') ." de ".date('F')." del ". date('Y') ?></h4>
    <hr>
    <?php

//	Seleccionamos todas las tablas que se usaran en esta ventana
$seleccionTablaAulas =new Crud("aulas");
$seleccionTablaCarreras =new Crud("carreras");
$seleccionTablaDocentes =new Crud("docentes");
$seleccionTablaRecursos =new Crud("recursos");




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
            <h5 class="subTarjeta">Horario: <b><i><?php echo $key['horaInicio'] ?> -
                        <?php echo $key['horaFin'] ?></i></b></h5>
            
        </div>
    </div>
    <?php		
					
				}
			}
		}
	}
}
?>

</div>
<div id="modales">
<?php

?>
<!-- Formularios agregar y quitar recurso -->
<!-- Quitar recurso -->
<div class="modal-container" id="modal-container">
    <div class="modal-content">
        <form>
            <h5 class="tituloModal">¿Esta seguro de eliminar este recurso?</h5>
            <div class="botones">
                <button type="submit" id="quitarRecurso">Si</button>
                <button type="submit" id="cerrarModal">No</button>
            </div>
        </form>
    </div>
</div>
<!-- Quitar recurso - tarea realizada -->
<div class="modal-container-success" id="modal-container-success">
    <div class="modal-success" id="modal-success">
        <h5 id="respuesta"></h5>
    </div>
</div>

<!-- Agregar recurso -->
<div class="" id="contenedor-agregar-recurso">
    <div class="contenido-agregar-recurso">
        <form>
            <h5 class="tituloModal">Elija un recurso</h5>
            <h5 class="subtituloModal">Recursos disponibles:</h5>
            <div id="selec">
            <select name="" id="">
                <?php

                            //	Seleccionamos todos los recursos que no estan en uso
//	Arrays para los datos de los recursos seleccionados
$arrayNombreRecurso=array();
$arrayIdRecurso=array();
$arrayRecursoIdMateria=array();
$selectRecursos=$seleccionTablaRecursos->where("idMateria","=",0)->get();
foreach ($selectRecursos as $recursos){
	$arrayNombreRecurso[]= $recursos['recurso'];
	$arrayIdRecurso[]= $recursos['idRecurso'];
	$arrayRecursoIdMateria[]=$recursos['idMateria'];
}
							for ($i=0; $i < count($arrayIdRecurso); $i++) {
							?>
                <option value="<?php echo $arrayIdRecurso[$i]; ?>">
                    <?php  echo $arrayNombreRecurso[$i]; ?></option>
                <?php
							}
							?>
            </select></div>
                <div class="botones">
                    <button type="submit" id="agregarRecurso">Agregar</button>
                </div>
        </form>
    </div>
</div>
</div>
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
