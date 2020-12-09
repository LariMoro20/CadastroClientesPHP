// By Larissa Moro 
// https://github.com/LariMoro20
// PHP CodeIgniter 
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

 $('.btneditpac').on( 'click', function (e) { 
    var element = $(this);
    let id=element.closest('tr').attr('idPac');

    let nome=       element.closest('tr').find('td.td-nome').text();
    let telefone=        element.closest('tr').find('td.td-telefone').text();
    let estado=        element.closest('tr').find('td.td-estado').text();
    let cidade=        element.closest('tr').find('td.td-cidade').text();
    
    let numero=   element.closest('tr').find('td.td-numero').text();
    let rua=   element.closest('tr').find('td.td-rua').text();
    let image=      element.closest('tr').find('td.td-img img').attr("src");


    let bairroId=       element.closest('tr').find('td.td-bairro').attr('bai');
    let bairro=        element.closest('tr').find('td.td-bairro').text();
    $('.atbai').val(bairroId);
    $('.atbai').text(bairro);
    $("#bairroInput option:first").attr('selected','selected');

    $('#IdInput').val(id);
    $('#nomeInput').val(nome);
    $('#telefoneInput').val(telefone);
    $('#estadoInput').val(estado);
    $('#cidadeInput').val(cidade);
    $('#ruaInput').val(rua);
    $('#numeroInput').val(numero);
    $('#fotoInputHiden').val(image.replace('<?= BASE_URL ?>',''));
    $('#imgspace2').attr("src",image);
    $('#editModal').modal('show');

});

$('.btneditped').on( 'click', function (e) { 
    var element = $(this);
    let id=element.closest('tr').attr('idPac');

    let id_cliente=       element.closest('tr').find('td.td-id_cliente').attr('cli');
    let nomecli=        element.closest('tr').find('td.td-id_cliente').text();


    let statusid=       element.closest('tr').find('td.td-status').attr('sta');
    let status=        element.closest('tr').find('td.td-status').text();

    let descricao=        element.closest('tr').find('td.td-descricao').text();
    let valor=        element.closest('tr').find('td.td-valor').text();
    let data_pedido=        element.closest('tr').find('td.td-data_pedido').text();

    $('#IdInput').val(id);
    //Selecionando cliente
    $('.atcli').val(id_cliente);
    $('.atcli').text(nomecli);
    $("#id_cliente option:first").attr('selected','selected');
    //========================
      //Selecionando status
    $('.atsts').val(statusid);
    $('.atsts').text(status);
    $("#status option:first").attr('selected','selected');
    //========================
    $('#descricao').val(descricao);
    $('#valor').val(valor);
    $('#data_pedido').val(data_pedido);
    $('#editModal').modal('show');

})

  
   