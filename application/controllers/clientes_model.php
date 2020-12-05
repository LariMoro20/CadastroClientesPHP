<?php 
// By Larissa Moro 
// https://github.com/LariMoro20
// PHP CodeIgniter 

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class clientes_model extends CI_Model {
	public function __construct()	{
		parent::__construct();
		if(isset($_POST)){ array_walk_recursive($_POST, function(&$v, $k) {$v = (utf8_decode($v));}); }
		if(isset($_GET)){ array_walk_recursive($_GET, function(&$v, $k) {$v = mysqli_real_escape_string($this->db->conn_id,utf8_decode($v));}); }
	}

	public function getClientes($id=false){
		if($id){
			$this->db->where('Id', $id);
		}
		$Clientes = $this->db->get('clientes')->result();
		return $Clientes;
	}
	


	

	public function addClientes($POST){
			$data = array(
				'nome' => utf8_encode($POST['nome']),
				'telefone' => utf8_encode($POST['telefone']),
				'bairro' => utf8_encode($POST['bairro']),
				'rua' => utf8_encode($POST['rua']),
				'numero' => utf8_encode($POST['numero']),
				'cidade' => utf8_encode($POST['cidade']),
				'estado' => utf8_encode($POST['estado']),
				'endereco' => utf8_encode(@$POST['endereco']),
				);

			if($this->db->insert('clientes', $data)){
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
	
		return json_encode($retorno);
	}
	
	public function updateClientes($POST){
			$data = array(
				'nome' => utf8_encode($POST['nome']),
				'telefone' => utf8_encode($POST['telefone']),
				'bairro' => utf8_encode($POST['bairro']),
				'rua' => utf8_encode($POST['rua']),
				'numero' => utf8_encode($POST['numero']),
				'cidade' => utf8_encode($POST['cidade']),
				'estado' => utf8_encode($POST['estado']),
				'endereco' => utf8_encode(@$POST['endereco']),
				);
			$this->db->where('Id', $POST['Id']);
			if($this->db->update('clientes', $data)){
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
	public function deleteCliente($id){
		if($id){
			$id=$id['id'];
			
			$cliente=$this->clientes_model->getClientes($id);
			$foto=$cliente[0]->foto;
			
			$path = dirname(dirname(dirname(__FILE__)));
			$path=$path.'/'.$foto;
		
			unlink($path);
			$this->db->where('Id', $id);
        	if($this->db->delete('clientes')){
				$retorno['msg']='Deletado com sucesso!';
				$retorno['status']=true;
			}else{
				$retorno['msg']='Erro ao deletar!';
				$retorno['status']=false;
			}
			
		}else{
			$retorno['msg']='Cliente não informado!';
			$retorno['status']=false;
		}
		return json_encode($retorno);
	}

	public function addArquivo($id, $path){
		$data = array(
			'foto' 	=> $path,
		);
		$this->db->where('Id', $id);
		if($this->db->update('clientes', $data)){
			$retorno['status'] 	= true;
			$retorno['msg']		= 'Cliente salvo com sucesso!';
		}
		else{
			$retorno['status'] 	= false;
			$retorno['msg']		= 'Erro ao adicionar arquivo ao cliente, mas cliente salvo!';
		}
		return json_encode($retorno);

	}


	public function validaDados($dados){
		$retorno['status'] 	= true;
		$retorno['msg']		= 'Dados corretos!';

		if($this->clientes_model->validaData($dados['data_nasc'], 'd/m/Y')){
			if($this->clientes_model->validaCPF($dados['CPF'])){
			}else{
				$retorno['status'] 	= false;
				$retorno['msg']		= 'CPF incorreto!';
			}
		}else{
			$retorno['status'] 	= false;
			$retorno['msg']		= 'Data incorreta!';
		}
		return $retorno;
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