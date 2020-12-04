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
		foreach ($Pedidos as $pac) {
			$datanasc = new DateTime($pac->data_nasc);
			$pac->data_nasc= $datanasc->format('d/m/Y');
		}
		return $Pedidos;
		
		
	}
	

	

	public function addPedidos($POST){
			$valida=$this->db_model->validaDados($POST);
			if($valida['status']){
			$dataNasc = DateTime::createFromFormat('d/m/Y', $POST['data_nasc']);
			$data = array(
				'nome' => utf8_encode($POST['nome']),
				'nome_mae' => utf8_encode($POST['nome_mae']),
				'data_nasc' => $dataNasc->format('Y-m-d'),
				'CPF' => $POST['CPF'],
				'CNS' => $POST['CNS'],
				'endereco' => utf8_encode($POST['endereco']),
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
		}else{
			$retorno['msg']=$valida['msg'];
			$retorno['status']=false;
			$retorno['id']=null;
		}
		
		return json_encode($retorno);
	}
	
	public function updatePedidos($POST){
		$valida=$this->db_model->validaDados($POST);
		if($valida['status']){
			$dataNasc = DateTime::createFromFormat('d/m/Y', $POST['data_nasc']);
			$data = array(
				'nome' => utf8_encode($POST['nome']),
				'nome_mae' => utf8_encode($POST['nome_mae']),
				'data_nasc' => $dataNasc->format('Y-m-d'),
				'CPF' => $POST['CPF'],
				'CNS' => $POST['CNS'],
				'endereco' => utf8_encode($POST['endereco']),
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
		}else{
				$retorno['msg']=$valida['msg'];
				$retorno['status']=false;
				$retorno['id']=null;
			}
			return json_encode($retorno);

	}
	public function deletePaciente($id){
		if($id){
			$id=$id['id'];
			
			$paciente=$this->db_model->getPedidos($id);
			$foto=$paciente[0]->foto;
			
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
			$retorno['msg']='Paciente não informado!';
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
			$retorno['msg']		= 'Paciente salvo com sucesso!';
		}
		else{
			$retorno['status'] 	= false;
			$retorno['msg']		= 'Erro ao adicionar arquivo ao paciente, mas paciente salvo!';
		}
		return json_encode($retorno);

	}


	public function validaDados($dados){
		$retorno['status'] 	= true;
		$retorno['msg']		= 'Dados corretos!';

		if($this->db_model->validaData($dados['data_nasc'], 'd/m/Y')){
			if($this->db_model->validaCPF($dados['CPF'])){
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

	public function validaData($date, $format = 'Y-m-d H:i:s'){
		$d = DateTime::createFromFormat($format, $date);
		return $d && $d->format($format) == $date;
	}

	public function validaCPF($cpf) {
		$cpf = preg_replace( '/[^0-9]/is', '', $cpf );
		if (strlen($cpf) != 11) {
			return false;
		}
		if (preg_match('/(\d)\1{10}/', $cpf)) {
			return false;
		}
		for ($t = 9; $t < 11; $t++) {
			for ($d = 0, $c = 0; $c < $t; $c++) {
				$d += $cpf[$c] * (($t + 1) - $c);
			}
			$d = ((10 * $d) % 11) % 10;
			if ($cpf[$c] != $d) {
				return false;
			}
		}
		return true;
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