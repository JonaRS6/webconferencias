$(document).ready(function () {
  $(".sidebar-menu").tree();

  $("#registros").DataTable({
    paging: true,
    lengthChange: false,
    searching: true,
    ordering: true,
    info: true,
    autoWidth: false,
    language: {
      paginate: {
        next: 'Siguiente',
        previous: 'Anterior',
        last: 'Ultimo',
        first: 'Primero'
      },
      info: 'Mostrando _START_ a _END_ de _TOTAL_ resultados',
      emptyTable: 'No hay registros',
      infoEmpty: '0 Registros',
      search: 'Buscar'
    }
  });

   //Initialize Select2 Elements
   $('.select2').select2()

   //Date picker
   $('#datepicker').datepicker({
    autoclose: true
  })
  //Timepicker
  $('.timepicker').timepicker({
    showInputs: false
  })
});


