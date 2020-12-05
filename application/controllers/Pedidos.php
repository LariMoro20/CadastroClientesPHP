<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pedidos extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('pedidos_model');
	}

	public function index(){
		$data = array(
			'page_title'=> 'Inicial',
			'pedido'=>$this->pedidos_model->getPedidos(),
			);
		$this->load->view('includes/design',$data);
		$this->load->view('includes/header');
		$this->load->view('pages/pedidos');
		$this->load->view('includes/footer');
	}

	public function addPedido(){
		if(isset($_FILES['foto']) && $_FILES['foto']['name']!=''){
			$dados= $this->pedidos_model->addPedidos($this->input->post());
			$id=json_decode($dados, true);
			$id=$id['id'];
			$imagem    = $_FILES['foto'];
			
			$path='arquivos/user_'.$id.'/';
			$isso = array(" ", "(", ")", "%","&","/");
			$aquilo   = array("_", "_", "_", "_","_","_");
			
			$nomeaqr = str_replace($isso, $aquilo, $imagem['name']);
			$imagem['name']=$nomeaqr;
			$configuracao = array(
				'upload_path'   => $path,
				'allowed_types' => 'gif|jpg|png|pdf|jpeg|txt|doc|docx|odt',
				'file_name'     => $nomeaqr,
				'max_size'      => '500000'
			); 
			if(!file_exists($path)){
				mkdir($path, 0777, true);
			}     
			$this->load->library('upload');
			$this->upload->initialize($configuracao);
			if ($this->upload->do_upload('foto'))
				echo $this->pedidos_model->addArquivo($id, $path.$nomeaqr);
		}else{
			echo $this->pedidos_model->addPedidos($this->input->post());

		
		}
	}

	public function editPedido(){
		
		$dados= $this->pedidos_model->updatePedidos($this->input->post());
		$array=json_decode($dados, true);
		$id=$array['id'];
		if($array['status']==false){
			echo $dados;
		}else{
			$imagem    = $_FILES['foto'];
			if(empty($_FILES['foto']['name'])){
				//Salvou sem alterar foto
				echo $dados;
			}else{
				//Salvou e existe foto nova
				$path='arquivos/user_'.$id.'/';
				$isso = array(" ", "(", ")", "%","&","/");
				$aquilo   = array("_", "_", "_", "_","_","_");
				
				$nomeaqr = str_replace($isso, $aquilo, $imagem['name']);
				$imagem['name']=$nomeaqr;
				$configuracao = array(
					'upload_path'   => $path,
					'allowed_types' => 'gif|jpg|png|pdf|jpeg|txt|doc|docx|odt',
					'file_name'     => $nomeaqr,
					'max_size'      => '500000'
				); 
				if(!file_exists($path)){
					mkdir($path, 0777, true);
				}     
				$this->load->library('upload');
				$this->upload->initialize($configuracao);
				if ($this->upload->do_upload('foto')){
					echo $this->pedidos_model->addArquivo($id, $path.$nomeaqr);
				}

			}
		}
	}

	public function deletePedido(){
		echo $this->pedidos_model->deletePedido($this->input->post());
	}


}
