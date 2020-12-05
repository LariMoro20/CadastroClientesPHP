
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
            <th scope="col">Descrição</th>
            <th scope="col">Data</th>
            <th scope="col">Editar</th>
            <th scope="col">Excluir</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($pedido as $ped) { ?>
          <tr idPac='<?=$ped->IdPed ?>'>
          <td class='td-nome'><?= $ped->IdPed ?></td>

            <td class='td-id_cliente' cli='<?= $ped->id_cliente ?>'>[<?= $ped->id_cliente ?>] <?= $ped->nome ?></td>
            <td class='td-status'><?= $ped->status ?></td>
            <td class='td-valor'><?= $ped->valor ?></td>
            <td class='td-descricao'><?= $ped->descricao_pedido ?></td>

            <td class='td-data_pedido'><?= $ped->data_pedido ?></td>
            <td><a class='btneditped' href="#." ><i class="fa fa-pencil-square-o"></i></a></td>
            <td><a class='btnremoveped' idPac='<?=$ped->IdPed ?>' href="#."><i class="fa fa-window-close"></i></a></td>

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
            <form  id="addPedido" class='addPedido' action='#' method='post'  enctype='multipart/form-data' >

              <div class="modal-body">
                  <div class="row">
                    <div class="form-group col-md-6">
                      <label for="id_cliente">Cliente*</label>
                      <select aria-describedby="id_clienteHelp" class="form-control" name='id_cliente' required>
                        <?php foreach ($clientes as $cli) { ?>
                          <option value='<?= $cli->Id ?>'><?= $cli->nome ?></option>
                        <?php } ?>
                      </select>                      
                      <small id="id_clienteHelp" class="form-text text-muted">Cliente</small>
                    </div>

                    <div class="form-group col-md-6">
                      <label for="data_nasc">Status*</label>
                      <input type="text" autocomplete="off" aria-describedby="statusHelp" name='status' class="form-control status" id="" placeholder="" required>
                      <small id="statusHelp" class="form-text text-muted">Status</small>
                    </div>

                    <div class="form-group col-md-6">
                      <label for="data_nasc">Valor</label>
                      <input type="text"  name='valor' class="form-control valor" id="" placeholder="valor">
                      <small id="valorHelp" class="form-text text-muted">Valor do pedido!</small>
                    </div>
                    <div class="form-group col-md-6">
                      <label for="data_pedido">Data do pedido*</label>
                      <input type="text" aria-describedby="data_pedidoHelp" name='data_pedido' class="form-control datacheck" required>
                      <small id="data_pedidoHelp" class="form-text text-muted">Data do pedido</small>
                    </div>

                    <div class="form-group col-md-12">
                      <label for="descricao">Descrição*</label>
                      <textarea type="text" aria-describedby="descricaoHelp" name='descricao' class="form-control" id="" placeholder="" required> </textarea>
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
              <h5 class="modal-title" id="editModalLabel">Editar Pedido</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form  id="editPedido" class='editPedido' action='#' method='post'  enctype='multipart/form-data' >
            <input type="hidden" class="form-control" name='Id' id="IdInput">

              <div class="modal-body">
                  <div class="row">
                   
                  <div class="form-group col-md-6">
                      <label for="id_cliente">Cliente*</label>
                      <select aria-describedby="id_clienteHelp" class="form-control" name='id_cliente' required>
                        <?php foreach ($clientes as $cli) { ?>
                          <option value='<?= $cli->Id ?>'><?= $cli->nome ?></option>
                        <?php } ?>
                      </select>                         
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
                      <input type="text" aria-describedby="data_pedidoHelp" name='data_pedido' class="form-control datacheck" id="data_pedido" placeholder="" required>
                      <small id="data_pedidoHelp" class="form-text text-muted">Data do pedido</small>
                    </div>

                    <div class="form-group col-md-12">
                      <label for="descricao">Descrição*</label>
                      <textarea type="text" aria-describedby="descricaoHelp" name='descricao' class="form-control" id="descricao" placeholder="" required> </textarea>
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
    </div>
  </div>
</div>
