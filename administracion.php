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
$title = 'Administración';

// Incluimos el header y el menu de navegación
require('layout/header.php'); 
require('layout/menu.php');


?>
<div class="fila">
    <br>
    <h4 class="tituloDocente">Todas las clases de hoy</h4>
    <hr>
    <?php
$seleccionTablaAulas =new Crud("aulas");
$seleccionTablaCarreras =new Crud("carreras");
$seleccionTablaDocentes =new Crud("docentes");
$seleccionTablaRecursos =new Crud("recursos");
$nulo= NULL;
$array=array();
$arrayKeys=array();
$arrayIdRecurso=array();
$selectRecursos=$seleccionTablaRecursos->where("idMateria","=",0)->get();
foreach ($selectRecursos as $recursos){
	$array[]= $recursos['recurso'];
	$arrayKeys[]= $recursos['idRecurso'];
	$arrayIdRecurso[]=$recursos['idMateria'];
}
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
            <h5 class="subTarjeta">Recurso(s):</h5>
			<div class="recursos">
            <?php foreach ($selectAllRecursos as $valoresRecursos) {?>
            <?php echo "<p class='subTarjeta1'><b><i>- ".$valoresRecursos['recurso']."</i></b></p> <button type='button' onclick='capturar(".$valoresRecursos['idRecurso'].")'>Quitar</button>"?>
            <?php
					}
					?></div>
            <button type="button" onclick="capturar(<?php echo $key['idMaterias']; ?>)">Agregar/quitar Recurso</button>
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