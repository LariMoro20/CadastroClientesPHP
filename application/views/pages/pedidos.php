
<div class="container">
  <div class="row">
    <div class="col-md-12 text-center">
      <h1>Lista de Pedidos</h1>
    </div>
    <div class="col-md-12 text-center margin-bt20">
      <button type="button" class="btn btn-primary " data-toggle="modal" data-target="#addModal">
        + Cadastrar Novo
      </button>
      </div>
      <div class="col-md-12">
      <table class="table" id='clitable'>
        <thead>
          <tr>
            <th scope="col">CodPedido</th>
            <th scope="col">Cliente</th>
            <th scope="col">Status</th>
            <th scope="col">Valor</th>
            <th scope="col">Data</th>
            <th scope="col">Editar</th>
            <th scope="col">Excluir</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($pedido as $ped) { ?>
          <tr idPac='<?=$ped->Id ?>'>
          <td class='td-nome'><?= $ped->Id ?></td>

            <td class='td-id_cliente'><?= $ped->id_cliente ?></td>
            <td class='td-status'><?= $ped->status ?></td>
            <td class='td-valor'><?= $ped->valor ?></td>
            <td class='td-data_pedido'><?= $ped->data_pedido ?></td>
            <td><a class='btnremoveped' idPac='<?=$ped->Id ?>' href="#."><i class="fa fa-window-close"></i></a></td>
            <td><a class='btneditped' href="#." ><i class="fa fa-pencil-square-o"></i></a></td>
          </tr>
        <?php } ?>
        </tbody>
      </table>

      <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="addModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="addModalLabel">Adicionar Pedido</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form  id="addCliente" class='addCliente' action='#' method='post'  enctype='multipart/form-data' >

              <div class="modal-body">
                  <div class="row">
                    <div class="form-group col-md-6">
                      <label for="id_cliente">Cliente*</label>
                      <input type="text" aria-describedby="id_clienteHelp"  autocomplete="off" class="form-control" name='id_cliente' id="Nome" placeholder="" required>
                      
                      <small id="id_clienteHelp" class="form-text text-muted">Cliente</small>
                    </div>

                    <div class="form-group col-md-6">
                      <label for="data_nasc">Status*</label>
                      <input type="text" autocomplete="off" aria-describedby="statusHelp" name='status' class="form-control status" id="status" placeholder="" required>
                      <small id="statusHelp" class="form-text text-muted">Status</small>
                    </div>

                    <div class="form-group col-md-6">
                      <label for="data_nasc">Valor</label>
                      <input type="text"  name='valor' class="form-control valor" id="valor" placeholder="valor">
                      <small id="valorHelp" class="form-text text-muted">Valor do pedido!</small>
                    </div>
                    <div class="form-group col-md-6">
                      <label for="data_pedido">Data do pedido*</label>
                      <input type="text" aria-describedby="data_pedidoHelp" name='data_pedido' class="form-control" id="estado" placeholder="" required>
                      <small id="data_pedidoHelp" class="form-text text-muted">Data do pedido</small>
                    </div>

                    <div class="form-group col-md-12">
                      <label for="descricao">Descrição*</label>
                      <textarea type="text" aria-describedby="descricaoHelp" name='descricao' class="form-control" id="estado" placeholder="" required> </textarea>
                      <small id="descricaoHelp" class="form-text text-muted">descricao</small>
                    </div>
                    
                  </div>
                  
                  
              </div>
              <div class="modal-footer">
                      <input type="submit" class="form-control btn btn-success" id="submit" value='Enviar'>
                      <a href='#' data-dismiss="modal" class="cancelbtn btn btn-secondary">Cancelar</a>
              </div>
            </form>
          </div>
        </div>
      </div>

      <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="editModalLabel">Editar Cliente</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form  id="editCliente" class='editCliente' action='#' method='post'  enctype='multipart/form-data' >
            <input type="hidden" class="form-control" name='Id' id="IdInput">

              <div class="modal-body">
                  <div class="row">
                   
                   
                   
                    <div class="form-group col-md-6">
                      <label for="Nome">Nome completo*</label>
                      <input type="text" class="form-control" name='nome' id="nomeInput" placeholder="Nome do Cliente" required>
                    </div>



                    <div class="form-group col-md-6">
                      <label for="data_nasc">Telefone*</label>
                      <input type="text" autocomplete="off" id="telefoneInput" aria-describedby="telefoneHelp" name='telefone' class="form-control telefone" placeholder="" required>
                      <small id="telefoneHelp" class="form-text text-muted">Exemplo: (00) 00000-0000</small>
                    </div>


                    <div class="form-group col-md-6">
                      <label for="data_nasc">Digite o CEP(para completar campos automaticamente)</label>
                      <input type="text"  name='cep' id="cepInput"  class="form-control cep" id="cep" placeholder="cep">
                      <small id="cepHelp" class="form-text text-muted">Somente números!</small>
                    </div>
                    <div class="form-group col-md-6">
                      <label for="estado">Estado*</label>
                      <input type="text" aria-describedby="estadoHelp" id="estadoInput" name='estado' class="form-control" required>
                      <small id="estadoHelp" class="form-text text-muted">Informe seu estado</small>
                    </div>
                    <div class="form-group col-md-6">
                      <label for="cidade">Cidade*</label>
                      <input type="text" aria-describedby="cidadeHelp" id="cidadeInput" name='cidade' class="form-control"  required>
                      <small id="cidadeHelp" class="form-text text-muted">Informe sua cidade</small>
                    </div>
                   
                    <div class="form-group col-md-6">
                      <label for="bairro">Bairro*</label>
                      <input type="text" aria-describedby="bairroHelp" id="bairroInput" name='bairro' class="form-control" required>
                      <small id="bairroHelp" class="form-text text-muted">Informe seu bairro</small>
                    </div>
                    <div class="form-group col-md-8">
                      <label for="rua">Rua*</label>
                      <input type="text" aria-describedby="ruaHelp" name='rua' class="form-control" id="ruaInput" placeholder="" required>
                      <small id="ruaHelp" class="form-text text-muted">Informe sua rua</small>
                    </div>
                    <div class="form-group col-md-4">
                      <label for="rua">Numero*</label>
                      <input type="text" aria-describedby="ruaHelp"  id="numeroInput" name='numero' class="form-control"  placeholder="" required>
                      <small id="ruaHelp" class="form-text text-muted">Informe sua rua</small>
                    </div>

                


                    <div class="form-group col-md-12 text-center"><hr>
                      <label for="foto">Foto do pedido</label>
                      <input type="hidden" name="oldFoto" id="fotoInputHiden" >
                      <input type="file" name='foto' class="form-control" id="fotoInput" placeholder="Foto do pedido"  onchange="document.getElementById('imgspede2').src = window.URL.createObjectURL(this.files[0])">
                      <small id="fotoHelp" class="form-text text-muted">Favor escolher uma foto de rosto limpo, para fácil identificação</small>
                      <img id="imgspace2"  width="200" height="200" />
                    </div>
                    
                  </div>
                  
                  
              </div>
              <div class="modal-footer">
                      <input type="submit" class="form-control btn btn-success" id="submit" value='Enviar'>
                      <a href='#' data-dismiss="modal" class="cancelbtn btn btn-secondary">Cancelar</a>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
