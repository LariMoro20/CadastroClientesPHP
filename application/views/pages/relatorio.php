
<div class="container">
  <div class="row">
    <div class="col-md-12 text-center">
      <h1>Gerar relatórios</h1>
    </div>
    <div class="col-md-4 text-center">
    <h4>Imprimir toda lista de clientes</h4>
    <a class="btn btn-success" href="<?= BASE_URL.'Relatorio/relatorio_clientes' ?>">Clientes</a>
    </div>
    <div class="col-md-4 text-center">
    <h4>Imprimir toda lista de pedidos</h4>
    <a class="btn btn-success" href="<?= BASE_URL.'Relatorio/relatorio_pedidos' ?>">Pedidos</a>
    </div>

    <div class="col-md-4 text-center">
    <h4>Imprimir lista de pedidos por tempo</h4>
    <form action='<?= BASE_URL ?>relatorio/relatorio_pedidos' method='GET'>
    <select name='periodo' id='periodo' >
      <option value='s1'>Ultima semana</option>
      <option value='m1'>Ultimo mês</option>
      <option value='m6'>Ultimos 6 meses</option>
      <option value='a1'>Ultimo ano</option>
    </select>
    <input type='submit' class="btn btn-success geracsv" value='Gerar' href="#">
    </form>
    

    </div>

  </div>
</div>
