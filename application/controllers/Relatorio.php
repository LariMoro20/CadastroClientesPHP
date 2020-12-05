<?php
// By Larissa Moro 
// https://github.com/LariMoro20
// PHP CodeIgniter 
defined('BASEPATH') OR exit('No direct script access allowed');

class Relatorio extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('clientes_model');
		$this->load->model('pedidos_model');
		$this->load->model('relatorio_model');

		$this->load->library('form_validation');
	}

	public function index(){
		$data = array(
			'page_title'=> 'Relatório',
			'cliente'=>$this->clientes_model->getClientes(),
			);
		$this->load->view('includes/design',$data);
		$this->load->view('includes/header');
		$this->load->view('pages/clientes');
		$this->load->view('includes/footer');
	}

	public function addCliente(){
		$this->form_validation->set_rules('nome', 'Nome', 'required|alpha_numeric_spaces|min_length[3]',FORM_OPTIONS);
        $this->form_validation->set_rules('telefone', 'Telefone', 'required', FORM_OPTIONS);
        $this->form_validation->set_rules('cep', 'cep', 'required|alpha_numeric', FORM_OPTIONS);
        $this->form_validation->set_rules('estado', 'estado', 'required|min_length[2]|max_length[2]', FORM_OPTIONS);
        $this->form_validation->set_rules('cidade', 'cidade', 'required|alpha_numeric_spaces|min_length[3]', FORM_OPTIONS);
        $this->form_validation->set_rules('bairro', 'bairro', 'required|alpha|min_length[3]', FORM_OPTIONS);
		$this->form_validation->set_rules('numero', 'numero', 'required|numeric|min_length[1]', FORM_OPTIONS);
		$this->form_validation->set_rules('rua', 'rua', 'required|alpha|min_length[3]', FORM_OPTIONS);
		if ($this->form_validation->run() == FALSE){
            $errors = validation_errors();
            echo json_encode(['error'=>$errors]);
        }else{
			if(isset($_FILES['foto']) && $_FILES['foto']['name']!=''){
				$dados= $this->clientes_model->addClientes($this->input->post());
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
					echo $this->clientes_model->addArquivo($id, $path.$nomeaqr);
			}else{
				echo $this->clientes_model->addClientes($this->input->post());
			}
        }
	}

	public function editCliente(){
		$this->form_validation->set_rules('nome', 'Nome', 'required|alpha_numeric_spaces|min_length[3]',FORM_OPTIONS);
        $this->form_validation->set_rules('telefone', 'Telefone', 'required', FORM_OPTIONS);
        //$this->form_validation->set_rules('cep', 'cep', 'required|alpha_numeric', FORM_OPTIONS);
        $this->form_validation->set_rules('estado', 'estado', 'required|min_length[2]|max_length[2]', FORM_OPTIONS);
        $this->form_validation->set_rules('cidade', 'cidade', 'required|min_length[3]', FORM_OPTIONS);
        $this->form_validation->set_rules('bairro', 'bairro', 'required|min_length[3]', FORM_OPTIONS);
		$this->form_validation->set_rules('numero', 'numero', 'required|numeric|min_length[1]', FORM_OPTIONS);
		$this->form_validation->set_rules('rua', 'rua', 'required|alpha|min_length[3]', FORM_OPTIONS);
		if ($this->form_validation->run() == FALSE){
            $errors = validation_errors();
            echo json_encode(['error'=>$errors]);
        }else{
		$dados= $this->clientes_model->updateClientes($this->input->post());
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
						echo $this->clientes_model->addArquivo($id, $path.$nomeaqr);
					}

				}
			}
		}
	}
	public function deleteCliente(){
		echo $this->clientes_model->deleteCliente($this->input->post());
	}
}
