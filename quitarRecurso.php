<?php
include ('./includes/config.php');
include ('./includes/Crud.php');

if (isset($_POST['idRec'])){
$idRec=$_POST['idRec'];
    $tablaRecursos=new Crud('recursos');
    $tablaRecursos->where("idRecurso","=",$idRec)->update(["idMateria"=>0]);
    echo "Se ha quitado el recurso";
}else{
    echo "Error no se pudo quitar";
}

?>