<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Landpage extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('db_model');
	}

	public function index(){
		$data = array(
			'page_title'=> 'Inicial',
			'pacientes'=>$this->db_model->getPacientes(),
			);
		$this->load->view('includes/design',$data);
		$this->load->view('includes/header');
		$this->load->view('pages/landpage');
		$this->load->view('includes/footer');
	}

	public function addPaciente(){
		if(isset($_FILES['foto']) && $_FILES['foto']['name']!=''){
			$dados= $this->db_model->addPacientes($this->input->post());
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
				echo $this->db_model->addArquivo($id, $path.$nomeaqr);
		}else{
			echo $this->db_model->addPacientes($this->input->post());

		
		}
	}

	public function editPaciente(){
		
		$dados= $this->db_model->updatePacientes($this->input->post());
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
					echo $this->db_model->addArquivo($id, $path.$nomeaqr);
				}

			}
		}
	}

	public function deletePaciente(){
		echo $this->db_model->deletePaciente($this->input->post());
	}


}
