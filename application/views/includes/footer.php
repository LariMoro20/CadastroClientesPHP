
        <footer class='footer clear-top '>
        <small>© 2020 by<a target="_blank" href="https://github.com/LariMoro20/"> Larissa Moro </a>All rights reserved.</small>

        </footer>
        <script src="<?= DESIGN_PATH ?>js/scripts.js"></script>
        <script src="<?= DESIGN_PATH ?>js/CEPValidator.js"></script>
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.22/b-1.6.5/fc-3.3.1/r-2.2.6/datatables.min.css"/>
        <script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.22/b-1.6.5/fc-3.3.1/r-2.2.6/datatables.min.js"></script>
        <script>



$('form#addPedido').on( 'submit', function (e) { 
                e.preventDefault();
                var formData = new FormData(this);
                $.ajax({
                    url: '<?= BASE_URL ?>pedidos/addPedido',
                    type: "POST",
                    processData: false,
                    contentType: false,
                    data: formData,
                    success: function(data) {
                        console.log(data);
                        data=JSON.parse(data);
                        if(data.status){
                            titulo='Adicionado!';
                        }else{
                            titulo='Revise os dados!'

                        }
                        if(data.msg){
                            msg=data.msg;
                        }else{
                            msg=data.error;
                        }
                        $.confirm({
                        title: titulo,
                        content: msg,
                        buttons: {
                            OK: function () {
                                if(data.status){
                                    location.reload();
                                }
                            
                            }
                        }  
                        });
                    },
                    error:function(data) {
                        $.confirm({
                        title: 'Houve um erro!',
                        content: 'Confira os dados e tente novamente',
                        buttons: {
                            OK: function () {
                            }
                        }  
                        });
                    }
                });
            });

            $('.btneditped').on( 'click', function (e) { 
                var element = $(this);
                let id=element.closest('tr').attr('idPac');
            
                let id_cliente=       element.closest('tr').find('td.td-id_cliente').attr('cli');
                let status=        element.closest('tr').find('td.td-status').text();
                let descricao=        element.closest('tr').find('td.td-descricao').text();
                let valor=        element.closest('tr').find('td.td-valor').text();
                let data_pedido=        element.closest('tr').find('td.td-data_pedido').text();

                $('#IdInput').val(id);
                $('#id_cliente option[value='+id_cliente+']').attr('selected','selected');

               
                $('#status').val(status);
                $('#descricao').val(descricao);
                $('#valor').val(valor);
                $('#data_pedido').val(data_pedido);
                $('#editModal').modal('show');
            
            })

            $('form#editPedido').on( 'submit', function (e) { 
                    e.preventDefault();
                    var formData = new FormData(this);
                    $.ajax({
                    url: '<?= BASE_URL ?>pedidos/editPedido',
                    type: "POST",
                    processData: false,
                    contentType: false,
                    data: formData,
                    success: function(data) {
                        data=JSON.parse(data);
                        if(data.status){
                            titulo='Adicionado!';
                        }else{
                            titulo='Revise os dados!'
                        }

                        
                        if(data.msg){
                            msg=data.msg;
                        }else{
                            msg=data.error;
                        }
                        $.confirm({
                        title: titulo,
                        content: msg,
                        buttons: {
                            OK: function () {
                                if(data.status){
                                    location.reload();
                                }
                            }
                        }  
                        });
                    },
                    error:function(data) {
                        $.confirm({
                        title: 'Houve um erro!',
                        content: data.msg,
                        buttons: {
                            OK: function () {
                            location.reload(); 
                            }
                        }  
                        });
                    }
                });
            });
    
            $('.btnremoveped').on( 'click', function (e) { 
                e.preventDefault();
                var element = $(this);
                let id=element.attr('idPac');
                $.confirm({
                    title: 'Remover item!',
                    content: 'Deseja realmente deletar este pedido?',
                    buttons: {
                        Sim: function () {
                        $.ajax({
                                type: "POST",
                                url: "<?= BASE_URL ?>pedidos/deletePedido",
                                data: {id:id},
                                success: function(msg){
                                element.closest('tr').remove();
                                }
                            });
                        },
                        cancelar: function () {},
                    }
                });
            });
            $('.btnremovepac').on( 'click', function (e) { 
                e.preventDefault();
                var element = $(this);
                let id=element.attr('idPac');
                $.confirm({
                    title: 'Remover item!',
                    content: 'Deseja realmente deletar este cliente?',
                    buttons: {
                        Sim: function () {
                        $.ajax({
                                type: "POST",
                                url: "<?= BASE_URL ?>pedidos/deletePedido",
                                data: {id:id},
                                success: function(msg){
                                element.closest('tr').remove();
                                }
                            });
                        },
                        cancelar: function () {},
                    }
                });
            });

        
    //=======================================================================



            $('form#addCliente').on( 'submit', function (e) { 
                e.preventDefault();
                var formData = new FormData(this);
                $.ajax({
                    url: '<?= BASE_URL ?>clientes/addCliente',
                    type: "POST",
                    processData: false,
                    contentType: false,
                    data: formData,
                    success: function(data) {
                        console.log(data);
                        data=JSON.parse(data);
                        if(data.status){
                            titulo='Adicionado!';
                        }else{
                            titulo='Revise os dados!'

                        }
                        if(data.msg){
                            msg=data.msg;
                        }else{
                            msg=data.error;
                        }
                        $.confirm({
                        title: titulo,
                        content: msg,
                        buttons: {
                            OK: function () {
                                if(data.status){
                                    location.reload();
                                }
                            
                            }
                        }  
                        });
                    },
                    error:function(data) {
                        $.confirm({
                        title: 'Houve um erro!',
                        content: 'Confira os dados e tente novamente',
                        buttons: {
                            OK: function () {
                            }
                        }  
                        });
                    }
                });
            });
    
        

            $('.btnremovecli').on( 'click', function (e) { 
                e.preventDefault();
                var element = $(this);
                let id=element.attr('idPac');
                $.confirm({
                    title: 'Remover item!',
                    content: 'Deseja realmente deletar este cliente?',
                    buttons: {
                        Sim: function () {
                        $.ajax({
                                type: "POST",
                                url: "<?= BASE_URL ?>clientes/deleteCliente",
                                data: {id:id},
                                success: function(msg){
                                element.closest('tr').remove();
                                }
                            });
                        },
                        cancelar: function () {},
                    }
                });
            });




            
            $('form#editCliente').on( 'submit', function (e) { 
                    e.preventDefault();
                    var formData = new FormData(this);
                    $.ajax({
                    url: '<?= BASE_URL ?>clientes/editCliente',
                    type: "POST",
                    processData: false,
                    contentType: false,
                    data: formData,
                    success: function(data) {
                        data=JSON.parse(data);
                        if(data.status){
                            titulo='Adicionado!';
                        }else{
                            titulo='Revise os dados!'
                        }

                        
                        if(data.msg){
                            msg=data.msg;
                        }else{
                            msg=data.error;
                        }
                        $.confirm({
                        title: titulo,
                        content: msg,
                        buttons: {
                            OK: function () {
                                if(data.status){
                                    location.reload();
                                }
                            }
                        }  
                        });
                    },
                    error:function(data) {
                        $.confirm({
                        title: 'Houve um erro!',
                        content: data.msg,
                        buttons: {
                            OK: function () {
                            location.reload(); 
                            }
                        }  
                        });
                    }
                });
            });
    
            


            $('.btneditpac').on( 'click', function (e) { 
                var element = $(this);
                let id=element.closest('tr').attr('idPac');
            
                let nome=       element.closest('tr').find('td.td-nome').text();
                let telefone=        element.closest('tr').find('td.td-telefone').text();
                let estado=        element.closest('tr').find('td.td-estado').text();
                let cidade=        element.closest('tr').find('td.td-cidade').text();
                let bairro=   element.closest('tr').find('td.td-bairro').text();
                let numero=   element.closest('tr').find('td.td-numero').text();
                let rua=   element.closest('tr').find('td.td-rua').text();
                let image=      element.closest('tr').find('td.td-img img').attr("src");
            
                $('#IdInput').val(id);
                $('#nomeInput').val(nome);
                $('#telefoneInput').val(telefone);
                //$('#cepInput').val(estado);
                $('#estadoInput').val(estado);
                $('#cidadeInput').val(cidade);
                $('#bairroInput').val(bairro);
                $('#ruaInput').val(rua);
                $('#numeroInput').val(numero);
                $('#fotoInputHiden').val(image.replace('<?= BASE_URL ?>',''));
                $('#imgspace2').attr("src",image);
                $('#editModal').modal('show');
            
            })
        </script>
        
        <script src="<?= DESIGN_PATH ?>mask/dist/jquery.mask.min.js"></script>

    </body>
</html>