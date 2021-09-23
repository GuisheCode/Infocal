<!--===== MAIN JS =====-->
<script src="assets/main.js"></script>
<script>
    $('#enviar').click(function(){
        let recurso = document.getElementById('recurso').value;
        let idMateria = document.getElementById('idMateria').value;
        
        let recursosDisponibles = [<?php $array; ?>]
        let ruta ="rec="+recursosDisponibles+"&id="+idMateria;
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
    const openModalButtons = document.querySelectorAll('[data-modal-target]')
const closeModalButtons = document.querySelectorAll('[data-close-button]')
const overlay = document.getElementById('overlay')

openModalButtons.forEach(button => {
  button.addEventListener('click', () => {
    const modal = document.querySelector(button.dataset.modalTarget)
    openModal(modal)
  })
})

overlay.addEventListener('click', () => {
  const modals = document.querySelectorAll('.modal.active')
  modals.forEach(modal => {
    closeModal(modal)
  })
})

closeModalButtons.forEach(button => {
  button.addEventListener('click', () => {
    const modal = button.closest('.modal')
    closeModal(modal)
  })
})

function openModal(modal) {
  if (modal == null) return
  modal.classList.add('active')
  overlay.classList.add('active')
}

function closeModal(modal) {
  if (modal == null) return
  modal.classList.remove('active')
  overlay.classList.remove('active')
}
</script>
</body>
</html>