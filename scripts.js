$('#modal-mj').on('shown.bs.modal', function () {
    $('#modal-mj').trigger('focus')
  })

  $(document).ready(function() {
    var mes = $('#mes').val();
 
    alert("Voici mon message \n \""+ mes +"\" \n Ce message fait appel à PHP Javascript (JQuery) et Html");
 
 });