$('#actRecurso').click(function(){
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