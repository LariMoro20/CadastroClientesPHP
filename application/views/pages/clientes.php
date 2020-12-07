
<div class="container">
  <div class="row">
    <div class="col-md-12 text-center">
      <h1>Lista de cliente</h1>
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
            <th scope="col">Foto</th>
            <th scope="col">Nome</th>
            <th scope="col">Telefone</th>
            <th scope="col">Estado</th>
            <th scope="col">Cidade</th>
            <th scope="col">Bairro</th>
            <th scope="col">Rua</th>
            <th scope="col">Numero</th>       
            
            <th scope="col">Editar</th>
            <th scope="col">CSV</th>
            <th scope="col">Remover</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($cliente as $cli) { ?>
          <tr idPac='<?=$cli->Id ?>'>
            <td class='td-img'><img class='img-pac' src='<?= BASE_URL.$cli->foto ?>' ></td>
            <td class='td-nome'><?= $cli->nome ?></td>
            <td class='td-telefone'><?= $cli->telefone ?></td>
            <td class='td-estado'><?= $cli->estado ?></td>
            <td class='td-cidade'><?= $cli->cidade ?></td>
            <td class='td-bairro'><?= $cli->bairro ?></td>
            <td class='td-rua'><?= $cli->rua ?></td>
            <td class='td-numero'><?= $cli->numero ?></td>
            <td><a class='btneditpac' href="#." ><i class="fa fa-pencil-square-o"></i></a></td>
            <td><a class='csv' href="<?= BASE_URL ?>Relatorio/relatorio_cliente/<?=$cli->Id ?>" ><i class="fa fa-table"></i></a></td>
            <td><a class='btnremovecli' idPac='<?=$cli->Id ?>' href="#."><i class="fa fa-window-close"></i></a></td>

          </tr>

        <?php } ?>
        </tbody>
      </table>

      <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="addModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="addModalLabel">Adicionar Cliente</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form  id="addCliente" class='addCliente' action='#' method='post'  enctype='multipart/form-data' >

              <div class="modal-body">
                  <div class="row">
                    <div class="form-group col-md-6">
                      <label for="Nome">Nome*</label>
                      <input type="text" aria-describedby="nomeHelp"  autocomplete="off" class="form-control" name='nome' id="Nome" placeholder="" required>
                      
                      <small id="nomeHelp" class="form-text text-muted">Nome Completo</small>
                    </div>

                    <div class="form-group col-md-6">
                      <label for="data_nasc">Telefone*</label>
                      <input type="text" autocomplete="off" aria-describedby="telefoneHelp" name='telefone' class="form-control telefone" id="telefone" placeholder="" >
                      <small id="telefoneHelp" class="form-text text-muted">Exemplo: (00) 00000-0000</small>
                    </div>


                    <div class="form-group col-md-6">
                      <label for="data_nasc">Digite o CEP (para completar campos automaticamente)</label>
                      <input type="text"  name='cep' class="form-control cep" id="cep" placeholder="cep">
                      <small id="cepHelp" class="form-text text-muted">Somente números!</small>
                    </div>
                    <div class="form-group col-md-6">
                      <label for="estado">Estado*</label>
                      <input type="text" aria-describedby="estadoHelp" name='estado' class="form-control" id="estado" placeholder="" required>
                      <small id="estadoHelp" class="form-text text-muted">Informe o estado</small>
                    </div>
                    <div class="form-group col-md-6">
                      <label for="cidade">Cidade*</label>
                      <input type="text" aria-describedby="cidadeHelp" name='cidade' class="form-control" id="cidade" placeholder="" required>
                      <small id="cidadeHelp" class="form-text text-muted">Informe a cidade</small>
                    </div>
                   
                    <div class="form-group col-md-6">
                      <label for="bairro">Bairro*</label>
                      <input type="text" aria-describedby="bairroHelp" name='bairro' class="form-control" id="bairro" placeholder="" required>
                      <small id="bairroHelp" class="form-text text-muted">Informe o bairro</small>
                    </div>
                    <div class="form-group col-md-8">
                      <label for="rua">Rua*</label>
                      <input type="text" aria-describedby="ruaHelp" name='rua' class="form-control" id="rua" placeholder="" required>
                      <small id="ruaHelp" class="form-text text-muted">Informe a rua</small>
                    </div>
                    <div class="form-group col-md-4">
                      <label for="rua">Numero*</label>
                      <input type="text" aria-describedby="numeroHelp" name='numero' class="form-control" id="numero" placeholder="" required>
                      <small id="numeroHelp" class="form-text text-muted">Informe a rua</small>
                    </div>



                    <div class="form-group col-md-12 text-center"><hr>
                      <label for="foto">Foto do cliente</label>
                      <input type="file" aria-describedby="fotoHelp" autocomplete="off"  name='foto' class="form-control" id="foto" placeholder="Foto do cliente"  onchange="document.getElementById('imgspace').src = window.URL.createObjectURL(this.files[0])">
                      <small id="fotoHelp" class="form-text text-muted">Favor escolher uma foto de rosto limpo, para fácil identificação</small>
                      <img id="imgspace"  width="200" height="200" />
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
                      <small id="estadoHelp" class="form-text text-muted">Informe o estado</small>
                    </div>
                    <div class="form-group col-md-6">
                      <label for="cidade">Cidade*</label>
                      <input type="text" aria-describedby="cidadeHelp" id="cidadeInput" name='cidade' class="form-control"  required>
                      <small id="cidadeHelp" class="form-text text-muted">Informe a cidade</small>
                    </div>
                   
                    <div class="form-group col-md-6">
                      <label for="bairro">Bairro*</label>
                      <input type="text" aria-describedby="bairroHelp" id="bairroInput" name='bairro' class="form-control" required>
                      <small id="bairroHelp" class="form-text text-muted">Informe o bairro</small>
                    </div>
                    <div class="form-group col-md-8">
                      <label for="rua">Rua*</label>
                      <input type="text" aria-describedby="ruaHelp" name='rua' class="form-control" id="ruaInput" placeholder="" required>
                      <small id="ruaHelp" class="form-text text-muted">Informe a rua</small>
                    </div>
                    <div class="form-group col-md-4">
                      <label for="rua">Numero*</label>
                      <input type="text" aria-describedby="ruaHelp"  id="numeroInput" name='numero' class="form-control"  placeholder="" required>
                      <small id="ruaHelp" class="form-text text-muted">Informe a rua</small>
                    </div>

                


                    <div class="form-group col-md-12 text-center"><hr>
                      <label for="foto">Foto do cliente</label>
                      <input type="hidden" name="oldFoto" id="fotoInputHiden" >
                      <input type="file" name='foto' class="form-control" id="fotoInput" placeholder="Foto do cliente"  onchange="document.getElementById('imgspace2').src = window.URL.createObjectURL(this.files[0])">
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
