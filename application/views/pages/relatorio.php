
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
      <option value='y1'>Ultimo ano</option>
    </select>
    <input type='submit' class="btn btn-success geracsv" value='Gerar' href="#">
    </form>
    

    </div>

    <div class="col-md-4 text-center">

    <canvas id="myChart" width="400" height="400"></canvas>
    </div>
  </div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.min.js" integrity="sha512-d9xgZrVZpmmQlfonhQUvTR7lMPtO7NkZMkA0ABN3PHCbKA5nqylQ/yWlFAyY6hYgdF1Qh6nYiuADWwKB4C2WSw==" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.bundle.js" integrity="sha512-zO8oeHCxetPn1Hd9PdDleg5Tw1bAaP0YmNvPY8CwcRyUk7d7/+nyElmFrB6f7vg4f7Fv4sui1mcep8RIEShczg==" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.bundle.min.js" integrity="sha512-SuxO9djzjML6b9w9/I07IWnLnQhgyYVSpHZx0JV97kGBfTIsUYlWflyuW4ypnvhBrslz1yJ3R+S14fdCWmSmSA==" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.css" integrity="sha512-C7hOmCgGzihKXzyPU/z4nv97W0d9bv4ALuuEbSf6hm93myico9qa0hv4dODThvCsqQUmKmLcJmlpRmCaApr83g==" crossorigin="anonymous" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js" integrity="sha512-hZf9Qhp3rlDJBvAKvmiG+goaaKRZA6LKUO35oK6EsM0/kjPK32Yw7URqrq3Q+Nvbbt8Usss+IekL7CRn83dYmw==" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.min.css" integrity="sha512-/zs32ZEJh+/EO2N1b0PEdoA10JkdC3zJ8L5FTiQu82LR9S/rOQNfQN7U59U9BC12swNeRAz3HSzIL2vpp4fv3w==" crossorigin="anonymous" />
        <script>
var ctx = document.getElementById('myChart').getContext('2d');
var myChart = new Chart(ctx, {
    type: 'pie',
    data: {

        labels: [
          <?php foreach ($bairros as $b) { ?>
            '<?= $b->bairro ?>', 
          <?php } ?>
          
          'Etc'],
        datasets: [{
           
            data: [12, 19, 3, 5, 2, 3],
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(255, 159, 64, 0.2)'
            ],
        
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero: true
                }
            }]
        }
    }
});
</script>