$(document).ready(function() {
  $('.datacheck').mask('00/00/0000');
 $('.telefone').mask('(00)00000-0000');
  $('#clitable').DataTable({
    "language": {
      "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Portuguese.json"
  },
  "responsive": "true"
  });
});


  
   