
<div class="container">
  <div class="row">
    <div class="col-md-12 text-center">
      <h1>Lista de pacientes</h1>
    </div>
    <div class="col-md-12 text-center margin-bt20">
      <button type="button" class="btn btn-primary " data-toggle="modal" data-target="#addModal">
        + Cadastrar Novo
      </button>
      </div>
      <div class="col-md-12">
      <table class="table" id='pactable'>
        <thead>
          <tr>
            <th scope="col">Foto</th>
            <th scope="col">Nome</th>
            <th scope="col">CPF</th>
            <th scope="col">CNS</th>
            <th scope="col">Data Nasc.</th>
            <th scope="col">Nome da mãe</th>
            <th scope="col">Endereço</th>
            <th scope="col">Remover</th>
            <th scope="col">Editar</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($pacientes as $pac) { ?>
          <tr idPac='<?=$pac->Id ?>'>
            <td class='td-img'><img class='img-pac' src='<?= BASE_URL.$pac->foto ?>' ></td>
            <td class='td-nome'><?= $pac->nome ?></td>
            <td class='td-CPF'><?= $pac->CPF ?></td>
            <td class='td-CNS'><?= $pac->CNS ?></td>
            <td class='td-data_nasc'><?= $pac->data_nasc ?></td>
            <td class='td-nome_mae'><?= $pac->nome_mae ?></td>
            <td class='td-endereco'><?= $pac->endereco ?></td>
            <td><a class='btnremovepac' idPac='<?=$pac->Id ?>' href="#."><i class="fa fa-window-close"></i></a></td>
            <td><a class='btneditpac' href="#." ><i class="fa fa-pencil-square-o"></i></a></td>
          </tr>
        <?php } ?>
        </tbody>
      </table>

      <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="addModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="addModalLabel">Adicionar Paciente</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form  id="addPaciente" class='addPaciente' action='#' method='post'  enctype='multipart/form-data' >

              <div class="modal-body">
                  <div class="row">
                    <div class="form-group col-md-6">
                      <label for="Nome">Nome Completo*</label>
                      <input type="text" autocomplete="off" class="form-control" name='nome' id="Nome" placeholder="Nome do Paciente" required>
                    </div>

                    <div class="form-group col-md-6">
                      <label for="data_nasc">Data de nascimento*</label>
                      <input type="text" autocomplete="off" name='data_nasc' class="form-control datanasc" id="data_nasc" placeholder="Data de nascimento" required>
                      <small id="cepHelp" class="form-text text-muted">Exemplo: (00/00/0000)</small>
                    </div>

                    <div class="form-group col-md-6">
                      <label for="CPF">CPF*</label>
                      <input type="text" aria-describedby="cpfHelp" onkeydown="javascript: fMasc( this, mCPF );" maxlength="14" autocomplete="off" name='CPF' class="form-control" id="CPF" placeholder="CPF" required>
                      <small id="cpfHelp" class="form-text text-muted">Exemplo: (000.000.000-00)</small>
                    </div>

                    <div class="form-group col-md-6">
                      <label for="CNS">CNS*</label>
                      <input type="text" autocomplete="off" name='CNS' class="form-control CNS" id="CNS" placeholder="CNS" required>
                      <small id="CNSHelp" class="form-text text-muted">Exemplo: (000 0000 0000 0000)</small>

                    </div>

                    <div class="form-group col-md-12">
                      <label for="nome_mae">Nome da mãe*</label>
                      <input type="text" autocomplete="off" name='nome_mae' class="form-control" id="nome_mae" placeholder="Nome da mãe" required>
                    </div>

                    <div class="form-group col-md-6">
                      <label for="data_nasc">Digite o CEP</label>
                      <input type="text"  name='cep' class="form-control cep" id="cep" placeholder="cep">
                      <small id="cepHelp" class="form-text text-muted">Somente números!</small>
                    </div>

                    <div class="form-group col-md-6">
                      <label for="endereco">Endereço Completo*</label>
                      <input type="text" autocomplete="off" required name='endereco' class="form-control" aria-describedby="enderecoHelp" id="endereco" placeholder="Endereço" required>
                      <small id="enderecoHelp" class="form-text text-muted">Exemplo: (Sua rua - bairro, Cidade - UF)</small>
                    </div>

                    <div class="form-group col-md-12 text-center"><hr>
                      <label for="foto">Foto do paciente</label>
                      <input type="file" aria-describedby="fotoHelp" autocomplete="off"  name='foto' class="form-control" id="foto" placeholder="Foto do paciente"  onchange="document.getElementById('imgspace').src = window.URL.createObjectURL(this.files[0])">
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
              <h5 class="modal-title" id="editModalLabel">Editar Paciente</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form  id="editPaciente" class='editPaciente' action='#' method='post'  enctype='multipart/form-data' >
            <input type="hidden" class="form-control" name='Id' id="IdInput">

              <div class="modal-body">
                  <div class="row">
                    <div class="form-group col-md-6">
                      <label for="Nome">Nome completo*</label>
                      <input type="text" class="form-control" name='nome' id="nomeInput" placeholder="Nome do Paciente" required>
                    </div>

                    <div class="form-group col-md-6">
                      <label for="data_nasc">Data de nascimento*</label>
                      <input type="text" name='data_nasc' class="form-control datanasc" id="data_nascInput" placeholder="Data de nascimento" required>
                    </div>

                    <div class="form-group col-md-6">
                      <label for="CPF">CPF*</label>
                      <input type="text" name='CPF' class="form-control" id="CPFInput" placeholder="CPF" required>
                      <small id="cpfHelp" class="form-text text-muted">Exemplo: (000.000.000-00)</small>
                    </div>

                    <div class="form-group col-md-6">
                      <label for="CNS">CNS*</label>
                      <input type="text" name='CNS' class="form-control CNS" id="CNSInput " placeholder="CNS" required>
                      <small id="CNSHelp" class="form-text text-muted">Exemplo: (000 0000 0000 0000)</small>

                    
                    </div>

                    <div class="form-group col-md-12">
                      <label for="nome_mae">Nome da mãe*</label>
                      <input type="text" name='nome_mae' class="form-control" id="nome_maeInput" placeholder="Nome da mãe" required>
                    </div>

                    <div class="form-group col-md-6">
                      <label for="data_nasc">Digite o CEP</label>
                      <input type="text"  autocomplete="off" name='cep2' class="form-control cep" id="cep" placeholder="cep">
                      <small id="cepHelp" class="form-text text-muted">Somente números!</small>
                    </div>

                    <div class="form-group col-md-6">
                      <label for="endereco">Endereço Completo*</label> 
                      <input type="text" required name='endereco' class="form-control" id="enderecoInput" placeholder="Endereço" required>
                      <small id="enderecoHelp" class="form-text text-muted">Exemplo: (Sua rua - bairro, Cidade - UF)</small>
                    </div>

                    <div class="form-group col-md-12 text-center"><hr>
                      <label for="foto">Foto do paciente</label>
                      <input type="hidden" name="oldFoto" id="fotoInputHiden" >
                      <input type="file" name='foto' class="form-control" id="fotoInput" placeholder="Foto do paciente"  onchange="document.getElementById('imgspace2').src = window.URL.createObjectURL(this.files[0])">
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
