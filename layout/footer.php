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
    
   function capturar(e)
 {
    value = e; 
    //document.getElementById("valor").value=value;
    console.log(value)
    modal_container.classList.add('show');
 }
 $('#quitarRecurso').on('click', function(e){
     e.preventDefault();
        let valor =value;
        let ruta ="idRec="+valor;
        $.ajax({
            url:'quitarRecurso.php',
            type:'POST',
            data: ruta,
        })
        .done(function (res) {
            $('#respuesta').html(res)
            modal_container.classList.remove('show');
        })
        .fail(function () {
            console.log("error");
        })
        .always(function () {
            console.log("complete")
        });
        $("#fila").load(" #fila");
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
</body>
</html>