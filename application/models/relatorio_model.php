<?php 
// By Larissa Moro 
// https://github.com/LariMoro20
// PHP CodeIgniter 

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class relatorio_model extends CI_Model {
	public function __construct()	{
		parent::__construct();
		if(isset($_POST)){ array_walk_recursive($_POST, function(&$v, $k) {$v = (utf8_decode($v));}); }
		if(isset($_GET)){ array_walk_recursive($_GET, function(&$v, $k) {$v = mysqli_real_escape_string($this->db->conn_id,utf8_decode($v));}); }
	}
	public function getClientesForCSV($id=false){
		if($id){
			$this->db->where('Id', $id);
		}
		$this->db->select('clientes.*, bairros.bairro, bairros.Id as BaiID');
		$this->db->join('bairros', 'bairros.Id = clientes.bairro');

		$Clientes = $this->db->get('clientes')->result();
		return $Clientes;
	}

	/**/

	
	
	public function getPedidosForCSV($id=false, $mes=false, $ano=false, $bairro=false){
		if($id){
			$this->db->where('pedidos.Id', $id);
		}
		if($mes){
			$this->db->where('Mouth(data_pedido)', $mes);
		}
		if($ano){
			$this->db->where('Year(data_pedido)', $ano);
		}
		if($bairro){
			$this->db->where('clientes.bairro', $bairro);
		}
		$this->db->join('clientes', 'clientes.Id = pedidos.id_cliente');
				$this->db->join('bairros', 'bairros.Id = clientes.bairro');

		$this->db->join('status', 'status.Id = pedidos.status');
		$this->db->select('pedidos.Id as IdPed');
		$this->db->select('descricao_pedido, valor, data_pedido, clientes.nome, clientes.endereco, clientes.cidade, bairros.bairro, clientes.estado, status.status');
		$Pedidos = $this->db->get('pedidos')->result();
		foreach ($Pedidos as $ped) {
			$data_pedido = new DateTime($ped->data_pedido);
			$ped->data_pedido= $data_pedido->format('d/m/Y');
		}
		return $Pedidos;
	}

	public function getPedidosForCSVPeriodo($id=false, $qntmes=false, $semana=false, $qntano=false, $bairro=false){
		if($id){
			$this->db->where('pedidos.Id', $id);
		}
		if($semana){
			$dtInicio=date('Y-m-d',strtotime('today') );
			$dtFim=date('Y-m-d',strtotime('- '.$semana.' week'));
			$this->db->where("data_pedido BETWEEN  '$dtFim' AND '$dtInicio' ");
		}
		if($qntmes){
			$dtInicio=date('Y-m-d',strtotime('today') );
			$dtFim=date('Y-m-d',strtotime('- '.$qntmes.' month'));
			$this->db->where("data_pedido BETWEEN  '$dtFim' AND '$dtInicio' ");
		}
		if($qntano){
			$dtInicio=date('Y-m-d',strtotime('today') );
			$dtFim=date('Y-m-d',strtotime('- '.$qntmes.' year'));
			$this->db->where("data_pedido BETWEEN  '$dtFim' AND '$dtInicio' ");
		}
		if($bairro){
			$this->db->where('clientes.bairro', $bairro);
		}
		$this->db->join('clientes', 'clientes.Id = pedidos.id_cliente');
		$this->db->join('bairros', 'bairros.Id = clientes.bairro');
		$this->db->join('status', 'status.Id = pedidos.status');
		$this->db->select('pedidos.Id as IdPed');
		$this->db->select('descricao_pedido, valor, data_pedido, clientes.nome, clientes.endereco, clientes.cidade, bairros.bairro, clientes.estado, status.status');
		$Pedidos = $this->db->get('pedidos')->result();
		foreach ($Pedidos as $ped) {
			$data_pedido = new DateTime($ped->data_pedido);
			$ped->data_pedido= $data_pedido->format('d/m/Y');
		}
		return $Pedidos;
	}




	public function getBairros(){
		/*SELECT  
		FROM `pedidos` 
		inner join clientes on clientes.Id=pedidos.id_cliente 
		INNER JOIN bairros on bairros.Id=clientes.bairro 
		GROUP by clientes.bairro */
		$this->db->select('clientes.bairro, bairros.bairro, bairros.Id as bairroiId, count(pedidos.Id) as quantidade ');

		$this->db->join('clientes', 'clientes.Id = pedidos.id_cliente');
		$this->db->join('bairros', 'bairros.Id = clientes.bairro');
		$this->db->group_by('clientes.bairro');
		$bairro = $this->db->get('pedidos')->result();
		return $bairro;
	}
	
	/*
	SELECT clientes.bairro, bairros.bairro, count(clientes.Id) as quantidade 
	FROM clientes 
	INNER JOIN bairros on bairros.Id=clientes.bairro 
	GROUP by clientes.bairro 
	*/

	public function getBairrosClientes(){

		$this->db->select('clientes.bairro, bairros.bairro, count(clientes.Id) as quantidade ');

		$this->db->join('bairros', 'bairros.Id = clientes.bairro');
		$this->db->group_by('clientes.bairro');
		$bairro = $this->db->get('clientes')->result();
		return $bairro;
	}


}
	
?>