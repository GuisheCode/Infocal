<?php 
require('includes/config.php'); 
require_once 'includes/Crud.php';

//if not logged in redirect to login page
if (! $user->is_logged_in()){
    header('Location: login.php'); 
    exit(); 
}

//define page title
$title = 'Members Page';

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
echo "<pre>";
var_dump($whereAndWhere);
echo "</pre>";

//  Recorremos todos los datos devueltos por la consulta y los guardamos en variables separadas
foreach($whereAndWhere as $index){
    $idMaterias = $index['idMaterias'];
    $materia    = $index['materia'];
    $idDocente  = $index['idDocente'];
    $idCarrera  = $index['idCarrera'];
}

/***************** PARA CONSULTAR TODOS LOS DATOS DE UNA TABLA ******************/
//  Consulta todos los datos de una tabla
$selectAll=$seleccionTablaMaterias->get();
//  Muestra el array con toda la consulta devuelta
echo "<pre>";
var_dump($selectAll);
echo "</pre>";


/***************** PARA ACTUALIZAR UNA TABLA ******************/
$update = $seleccionTablaMaterias->where("idMaterias","=",1)->update(["materia"=>"BD","idDocente"=>1,"idCarrera"=>1]);


/***************** PARA ELIMINAR DATOS DE UNA TABLA ******************/
$delete = $seleccionTablaMaterias->where("idMaterias","=",4)->delete();






echo "FILAS ACTUALIZADAS: " . $update . " ELIMINADOS: " . $delete;





?>

<div class="">		
				<h2>Mis Actividades - <?php echo htmlspecialchars($_SESSION['username'], ENT_QUOTES); ?></h2>
				<?php
				echo $_SESSION['memberID']."<br>";
				echo date('d/m/Y h:i:s a', time());
				?>
				<p><a href='logout.php'>Logout</a></p>
		</div>
	</div>
</div>

<?php 
//include header template
require('layout/footer.php'); 
?>
