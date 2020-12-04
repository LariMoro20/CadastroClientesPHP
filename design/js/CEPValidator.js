$(document).ready(function() {

            function limpa_formulário_cep() {
                // Limpa valores do formulário de cep.
                $("#endereco").val("");
                $("#enderecoInput").val("");
            }
            
            //Quando o campo cep perde o foco.
            $(".cep").blur(function() {

                //Nova variável "cep" somente com dígitos.
                var cep = $(this).val().replace(/\D/g, '');

                //Verifica se campo cep possui valor informado.
                if (cep != "") {

                    //Expressão regular para validar o CEP.
                    var validacep = /^[0-9]{8}$/;

                    //Valida o formato do CEP.
                    if(validacep.test(cep)) {

                        //Preenche o campo com "..." enquanto consulta webservice.
                        $("#endereco").val("...");
                        $("#enderecoInput").val("...");
                        
                        //Consulta o webservice viacep.com.br/
                        $.getJSON("https://viacep.com.br/ws/"+ cep +"/json/?callback=?", function(dados) {

                            if (!("erro" in dados)) {
                                //Atualiza o campo com os valores da consulta.
                                let endereco='Rua '+dados.logradouro+' - Bairro '+dados.bairro+', '+dados.localidade+' - '+dados.uf;
                                $("#endereco").val(endereco);
                                $("#enderecoInput").val(endereco);
                                
                            } //end if.
                            else {
                                //CEP pesquisado não foi encontrado.
                                limpa_formulário_cep();
                                $.confirm({
                                    title: 'CEP não encontrado!',
                                    content: 'Verifique o CEP novamente!',
                                    buttons: {
                                      OK: function () {
                                     
                                      }
                                    }  
                                  });
                                
                            }
                        });
                    } //end if.
                    else {
                        //cep é inválido.
                        limpa_formulário_cep();
                        $.confirm({
                            title: 'Formato de CEP inválido!',
                            content: 'Apenas números, sem letras ou traços',
                            buttons: {
                              OK: function () {
                             
                              }
                            }  
                          });
                        
                    }
                } //end if.
                else {
                    //cep sem valor, limpa formulário.
                    limpa_formulário_cep();
                }
            });
        });
