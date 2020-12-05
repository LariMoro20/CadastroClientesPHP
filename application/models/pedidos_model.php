<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class pedidos_model extends CI_Model {
	public function __construct()	{
		parent::__construct();
		if(isset($_POST)){ array_walk_recursive($_POST, function(&$v, $k) {$v = (utf8_decode($v));}); }
		if(isset($_GET)){ array_walk_recursive($_GET, function(&$v, $k) {$v = mysqli_real_escape_string($this->db->conn_id,utf8_decode($v));}); }
	}

	public function getPedidos($id=false){
		if($id){
			$this->db->where('Id', $id);
		}
		$Pedidos = $this->db->get('pedidos')->result();
		return $Pedidos;
	}
	

	

	public function addPedidos($POST){
		//	$valida=$this->pedidos_model->validaDados($POST);
			//if($valida['status']){
			$data_pedido = DateTime::createFromFormat('d/m/Y', $POST['data_pedido']);
			$data = array(
				'id_cliente' => utf8_encode($POST['id_cliente']),
				'status' => utf8_encode($POST['status']),
				'data_pedido' => $data_pedido->format('Y-m-d'),
				'valor' => $POST['valor'],
				'descricao_pedido' => $POST['descricao']
				);

			if($this->db->insert('pedidos', $data)){
				$Id = $this->db->insert_id();
				$retorno['msg']='Adicionado com sucesso!';
				$retorno['status']=true;
				$retorno['id']=$Id;
			}
			else{
				$retorno['msg']='Houve algum erro!';
				$retorno['status']=false;
				$retorno['id']=null;
			}
	//}else{
		//	$retorno['msg']=$valida['msg'];
		//	$retorno['status']=false;
		//	$retorno['id']=null;
		//}
		
		return json_encode($retorno);
	}
	
	public function updatePedidos($POST){
			$data_pedido = DateTime::createFromFormat('d/m/Y', $POST['data_pedido']);
			$data = array(
				'id_cliente' => utf8_encode($POST['id_cliente']),
				'status' => utf8_encode($POST['status']),
				'data_pedido' => $data_pedido->format('Y-m-d'),
				'valor' => $POST['valor'],
				'descricao_pedido' => $POST['descricao']
				);

			$this->db->where('Id', $POST['Id']);
			if($this->db->update('pedidos', $data)){
				$retorno['msg']='Sucesso!';
				$retorno['status']=true;
				$retorno['id']=$POST['Id'];
			}
			else{
				$retorno['msg']='Houve algum erro!';
				$retorno['status']=false;
				$retorno['id']=null;
			}
		
			return json_encode($retorno);

	}
	public function deletePedido($id){
		if($id){
			$id=$id['id'];
			
			$pedido=$this->pedidos_model->getPedidos($id);
			$foto=$pedido[0]->foto;
			
			$path = dirname(dirname(dirname(__FILE__)));
			$path=$path.'/'.$foto;
		
			unlink($path);
			$this->db->where('Id', $id);
        	if($this->db->delete('pedidos')){
				$retorno['msg']='Deletado com sucesso!';
				$retorno['status']=true;
			}else{
				$retorno['msg']='Erro ao deletar!';
				$retorno['status']=false;
			}
			
		}else{
			$retorno['msg']='Pedido não informado!';
			$retorno['status']=false;
		}
		return json_encode($retorno);
	}

	public function addArquivo($id, $path){
		$data = array(
			'foto' 	=> $path,
		);
		$this->db->where('Id', $id);
		if($this->db->update('pedidos', $data)){
			$retorno['status'] 	= true;
			$retorno['msg']		= 'Pedido salvo com sucesso!';
		}
		else{
			$retorno['status'] 	= false;
			$retorno['msg']		= 'Erro ao adicionar arquivo ao pedido, mas pedido salvo!';
		}
		return json_encode($retorno);

	}


	
	public function isDataEmpty($arrayOfData, $safeValues = false){
		foreach ($arrayOfData as $key => $value) {
			if($safeValues){
				if(strlen($value) < 1 && !in_array($key, $safeValues))
					return true;
			}
			else if(strlen($value) < 1)
				return true;
		}
		return false;
	}

}
	
?>