<?php 
require('includes/config.php'); 
require_once 'includes/Crud.php';

//if not logged in redirect to login page
if (! $user->is_logged_in()){
    header('Location: login.php'); 
    exit(); 
}

//define page title
$title = 'Prueba';

//include header template
require('layout/header.php'); 
require('layout/menu.php');

$tablaMaterias=new Crud('materias');
$datosMaterias=$tablaMaterias->get();


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <a href="#" id="show-modal">Abrir Modal</a>
    
<div class="columna">
    <?php
    foreach($datosMaterias as $dato){
        ?>
        <div class="tarjeta">
    <button type="button" id="abrirModal">Abrir Modal</button>
    <div class="modal-container" id="modal-container">
        <form action="" id="form-<?php echo $dato['idMaterias']; ?>">
            <input type="text" value="<?php echo $dato['idMaterias']; ?>">
            <input type="text" value="<?php echo $dato['materia']; ?>">
            <button type="submit" id="botonPrueba">Cerrar</button>
        </form>
        <button type="button" id="cerrarModal">Cerrar</button>
    </div></div>
        <?php
    }
    ?>
    

</div>

<script>
let abrir=document.getElementById('abrirModal');
let cerrar=document.getElementById('cerrarModal');
let modal_container=document.getElementById('modal-container');
abrir.addEventListener('click',()=>{
    modal_container.classList.add('show');
});
cerrar.addEventListener('click',()=>{
    modal_container.classList.remove('show');
});
</script>
<script>
    $(document).ready(function(){
        $("#abrirModal").click(function(){
            $(".tarjeta").each(function(index, element) {
                var target = $(this).attr("id");
            });
        });
    });
</script>
<script src="modal.js"></script>
</body>

</html>
<!-- al momento de asignar un recurso a un aula/docente, guardar esa fecha en una tabla, para ocupar esa fecha
comparandola con la fecha actual y poniendo el limite con la diferencia de ambas fechas
ver class DateInterval  -->