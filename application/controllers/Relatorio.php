<?php
// By Larissa Moro 
// https://github.com/LariMoro20
// PHP CodeIgniter 
defined('BASEPATH') OR exit('No direct script access allowed');

class Relatorio extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('relatorio_model');
	}

	public function index(){
		$data = array(
			'page_title'=> 'Relatório',
			'bairros'=> $this->relatorio_model->getBairros(),
			);
		$this->load->view('includes/design',$data);
		$this->load->view('includes/header');
		$this->load->view('pages/relatorio',$data);
		$this->load->view('includes/footer');
	}

	//====RELATORIOS CLIENTES=======
	public function relatorio_cliente(){
		$id = $this->uri->segment(3);
		if(is_numeric($id)){
			$data = array(
				'cliente'=>$this->relatorio_model->getClientesForCSV($id),
				);
			$this->load->view('pages/relatorio_clientes',$data);
		}
		else{
		}
	}
	public function relatorio_clientes(){
		$data = array(
			'cliente'=>$this->relatorio_model->getClientesForCSV(),
			);
		$this->load->view('pages/relatorio_clientes',$data);
	}

	//=============================
	//====RELATORIOS PEDIDOS=======
	public function relatorio_pedido(){
		$id	= $this->uri->segment(3);
		if(is_numeric($id)){
			$data = array(
				'pedidos'=>$this->relatorio_model->getPedidosForCSV($id),
				);
			$this->load->view('pages/relatorio_pedidos',$data);
		}
		else{
		}
	}
	public function relatorio_pedidos(){
		$id=false; 
		$mes=false; 
		$semana=false;
		$ano=false;
		$bairro=false;
		$periodo=$_GET['periodo'];
		$tipo = substr($_GET['periodo'], 0, 1);
		$tempo=substr($_GET['periodo'], 1, 1);
		switch ($tipo) {
			case 's':
				$semana=$tempo;
			break;
			case 'm':
				$mes=$tempo;
			break;
			case 'y':
				$ano=$tempo;
			break;
		}
		$data = array(
			'pedidos'=>$this->relatorio_model->getPedidosForCSVPeriodo($id, $mes, $semana, $ano, $bairro),
			);
		$this->load->view('pages/relatorio_pedidos',$data);
	}


	

	public function relatorio_pedidosof(){
		$id=false; 
		$mes=false; 
		$ano=false;
		$bairro=false;
		$periodo=$_GET['periodo'];
		$tipo = substr($_GET['periodo'], 1, 1);
		$tempo=substr($_GET['periodo'], 2, 1);
		switch ($tipo) {
			case 's':
			break;
			case 'm':
				$mes=$tempo;
			break;
			case 'y':
				$ano=$tempo;
			break;
		}
		$data = array(
			'pedidos'=>$this->relatorio_model->getPedidosForCSV($id, $mes, $ano, $bairro),
			);
		$this->load->view('pages/relatorio_pedidos',$data);
	}
	//=============================

}
