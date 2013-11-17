<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Incoterms extends CI_Controller {
    
        public function __construct()
        {
			parent::__construct();
			$this->load->helper('html');
			$this->load->helper('form');
			$this->load->library('form_validation');
			$this->load->library('basics');
			$this->load->library('encrypt');
			$this->load->model('home_model');
        }
		
		public function index(){
			$this->load->view('header');
			$this->load->view('menu');
			$tableInicio = "";
			$objIndex = $this->home_model->consultarObjetoSimple("inc_id", "inc_nombre", "incoterm", "", "inc_nombre", "ASC");
            if($objIndex == false){
                $tableInicio.= "<tr><td colspan='3'><br><br><br>No hay información disponible para este ítem<br><br></td></tr>";                
            } 
			else{
				$i = 1;
				foreach ($objIndex as $arr1=>$arr2) {
					$tableInicio.= "<tr><td>".anchor("incoterms/edit/".intval($arr2->codigo), img(array('src' => 'multimedia/images/edit.png', 'width' => '16', 'height' => '16','title' => 'Editar Contenido', 'border' => '0')), array('title' => 'Editar'))."</td>
										<td>".$this->home_model->obtenerCampo("incoterm", "inc_abreviatura", "inc_id", $arr2->codigo)."</td>
										<td>".$this->home_model->obtenerCampo("estado", "est_nombre", "est_id", $this->home_model->obtenerCampo("incoterm", "est_id", "inc_id", $arr2->codigo))."</td>
										<td>".$arr2->nombre."</td>
									</tr>";
					$i++;
				}
			}           	
			$dataForm['tableData'] = $tableInicio;
			$dataForm['infoVista']= $this->basics->viewMessage($this->home_model->consultarMensaje(15));			
			$this->load->view('incoterms_inicio', $dataForm);
			$this->load->view('footer');
		}
		
		public function newItem(){
			$this->load->view('header');
			$this->load->view('menu');
			$this->form_validation->set_rules('inc_abreviatura', 'Abreviatura', 'required|trim|exact_length[3]');
            if($this->form_validation->run() == FALSE){
	            if($this->input->post('enviar') == ""){
					$dataForm['infoVista']= $this->basics->viewMessage($this->home_model->consultarMensaje(18));	
				}
				else{
					$mensajes = validation_errors(); 
					$dataForm['infoVista'] = $this->basics->viewMessage($mensajes, "M");
				}	
            }
			else{
				$dataForm['infoVista']= $this->basics->viewMessage($this->home_model->consultarMensaje(11));
				redirect('/incoterms/edit/'.$this->home_model->actualizarIncoterm($_POST));
			}
			$dataForm['estadoActivo'] = array("1" => "Activo", "2" => "Inactivo");
			$this->load->view('incoterms_new', $dataForm);
			$this->load->view('footer');
            
		}
		
		public function edit($id=""){
			$this->load->view('header');
			$this->load->view('menu');
			if($id==""){
				$id = $this->input->post("inc_id");
			}
			if(	$this->home_model->obtenerCampo("incoterm", "inc_nombre", "inc_id", intval($id)) == ""){
				redirect('incoterms/index');
			}
			$this->form_validation->set_rules('inc_abreviatura', 'Abreviatura', 'required|trim|exact_length[3]');
            if($this->form_validation->run() == FALSE){
	            if($this->input->post('enviar') == ""){
					$dataForm['infoVista']= $this->basics->viewMessage($this->home_model->consultarMensaje(10));	
				}
				else{
					$mensajes = validation_errors(); 
					$dataForm['infoVista'] = $this->basics->viewMessage($mensajes, "M");
				}	
            }
			else{
				$dataForm['infoVista']= $this->basics->viewMessage($this->home_model->consultarMensaje(11));
				$this->home_model->actualizarIncoterm($_POST);
			}
			$dataForm['inc_id']= $id;		
			$dataForm['estadoActivoPredef'] = $this->home_model->obtenerCampo("incoterm", "est_id", "inc_id", $id);
			$dataForm['inc_nombre'] = $this->home_model->obtenerCampo("incoterm", "inc_nombre", "inc_id", $id);
			$dataForm['inc_abreviatura'] = $this->home_model->obtenerCampo("incoterm", "inc_abreviatura", "inc_id", $id);
			$dataForm['estadoActivo'] = array("1" => "Activo", "2" => "Inactivo");
			$this->load->view('incoterms_edit', $dataForm);
			$this->load->view('footer');
		}
}