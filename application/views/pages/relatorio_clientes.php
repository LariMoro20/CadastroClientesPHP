<?php 
header( 'Content-type: application/csv' );   
header( 'Content-Disposition: attachment; filename=file.csv' );   
header( 'Content-Transfer-Encoding: binary' );
header( 'Pragma: no-cache');



$headers = ['Id', 'Nome', 'Telefone', 'Bairro', 'Rua', 'Número', 'Cidade', 'Estado', 'Endereço Completo', 'Foto'];
$dados = json_decode(json_encode($cliente), true);;


$arquivo = fopen( 'php://output', 'w' );
// Criar o cabeçalho
fputcsv($arquivo , $headers);

foreach ($dados as $linha ) {
    fputcsv($arquivo, $linha);
}

fclose($arquivo);