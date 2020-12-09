<?php
// By Larissa Moro 
// https://github.com/LariMoro20
// PHP CodeIgniter 
defined('BASEPATH') OR exit('No direct script access allowed');

class Pedidos extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('pedidos_model');
		$this->load->model('clientes_model');
		$this->load->model('status_model');
		$this->load->library('form_validation');
	}

	public function index(){
		$data = array(
			'page_title'=> 'Pedidos',
			'pedido'=>$this->pedidos_model->getPedidos(),
			'clientes'=>$this->clientes_model->getClientes(),
			'status' => $this->status_model->getStatus(),
			);
		$this->load->view('includes/design',$data);
		$this->load->view('includes/header');
		$this->load->view('pages/pedidos');
		$this->load->view('includes/footer');
	}


	public function addPedido(){
			$this->form_validation->set_rules('id_cliente', 'Cliente', 'required|numeric|min_length[1]',FORM_OPTIONS);
			$this->form_validation->set_rules('status', 'status', 'required|min_length[1]|numeric', FORM_OPTIONS);
			$this->form_validation->set_rules('valor', 'valor', 'required|decimal|min_length[4]', FORM_OPTIONS);
			$this->form_validation->set_rules('data_pedido', 'data do pedido', 'required|min_length[10]', FORM_OPTIONS);
			$this->form_validation->set_rules('descricao', 'descricao', 'required|alpha_numeric_spaces|min_length[1]', FORM_OPTIONS);
		if ($this->form_validation->run() == FALSE){
            $errors = validation_errors();
            echo json_encode(['error'=>$errors]);
        }else{
			echo $this->pedidos_model->addPedidos($this->input->post());
		}
	}

	
	public function editPedido(){
			$this->form_validation->set_rules('id_cliente', 'Cliente', 'required|numeric|min_length[1]',FORM_OPTIONS);
			$this->form_validation->set_rules('status', 'status', 'required|min_length[1]|numeric', FORM_OPTIONS);
			$this->form_validation->set_rules('valor', 'valor', 'required|decimal|min_length[4]', FORM_OPTIONS);
			$this->form_validation->set_rules('data_pedido', 'data do pedido', 'required|min_length[10]', FORM_OPTIONS);
			$this->form_validation->set_rules('descricao', 'descricao', 'required|alpha_numeric_spaces|min_length[1]', FORM_OPTIONS);
		if ($this->form_validation->run() == FALSE){
            $errors = validation_errors();
            echo json_encode(['error'=>$errors]);
        }else{
		echo $this->pedidos_model->updatePedidos($this->input->post());
		}
	}

	public function deletePedido(){
		echo $this->pedidos_model->deletePedido($this->input->post());
	}
}
