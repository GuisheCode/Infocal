<!--===== MAIN JS =====-->
<script src="assets/main.js"></script>
<script>
    $('#enviar').click(function(){
        let recurso = document.getElementById('recurso').value;
        let idMateria = document.getElementById('idMateria').value;
        let ruta ="rec="+recurso+"&id="+idMateria;
        $.ajax({
            url:'back.php',
            type:'POST',
            data: ruta,
        })
        .done(function (res) {
            $('#respuesta').html(res)
        })
        .fail(function () {
            console.log("error");
        })
        .always(function () {
            console.log("complete")
        });
    });
</script>
<script src="modal.js"></script>

<script>
    let abrir=document.getElementById('abrirModal');
    let modal_container=document.getElementById('modal-container');
    let cerrar= document.getElementById(cerrarModal);
    let modal_success= document.getElementById('modal-container-success');
    
   function capturarIdRecurso(e)
 {
    idRecurso = e; 
    //document.getElementById("valor").value=value;
    console.log(idRecurso)
    modal_container.classList.add('show');
 }
 $('#quitarRecurso').on('click', function(e){
     e.preventDefault();
        let ruta ="idRec="+idRecurso;
        $.ajax({
            url:'quitarRecurso.php',
            type:'POST',
            data: ruta,
        })
        .done(function (res) {
            $('#respuesta').html(res);
            $("#fila").load(" #fila");
             $("#selec").load(" #selec");
            modal_container.classList.remove('show')
            modal_success.classList.add('show');
            setTimeout(function(){ 
                modal_success.classList.remove('show');
                // $("#modales").load(" #modales");
            }, 1800);
        })
        .fail(function () {
            console.log("error");
        })
        .always(function () {
            console.log("complete")
        });
        
    });
//     cerrar.addEventListener('click',()=>{
//     modal_container.classList.remove('show');
// });
$('#cerrarModal').on('click', function(e){
        e.preventDefault();
        modal_container.classList.remove('show');
    })
$('#modalContainer').on('click',function(){
    modal_container.classList.remove('show');
})
modal_container.addEventListener('click', e=> {
        if (e.target === modal_container) modal_container.classList.remove('show');; 
    });
</script>
<script>
    let abrirAgregar=document.getElementById('abrirAgregar');
    let modal_container_agregar=document.getElementById('contenedor-agregar-recurso');
    
   function capturarIdMateria(e)
 {
    idMateria = e; 
    console.log(idMateria)
    modal_container_agregar.classList.add('show');
 }


 modal_container_agregar.addEventListener('click', e=> {
        if (e.target === modal_container_agregar) modal_container_agregar.classList.remove('show');; 
    });
</script>
</body>
</html>