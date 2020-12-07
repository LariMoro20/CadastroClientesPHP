<?php 
header( 'Content-type: application/csv' );   
header( 'Content-Disposition: attachment; filename=file.csv' );   
header( 'Content-Transfer-Encoding: binary' );
header( 'Pragma: no-cache');



$headers = ['Id', 'Descrição', 'Valor', 'Data do Pedido', 'Cliente', 'Endereço Completo', 'Cidade', 'Bairro', 'Estado', 'Status'];
$dados = json_decode(json_encode($pedidos), true);;


$arquivo = fopen( 'php://output', 'w' );
// Criar o cabeçalho
fputcsv($arquivo , $headers);

foreach ($dados as $linha ) {
    fputcsv($arquivo, $linha);
}

fclose($arquivo);