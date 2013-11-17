<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Observation extends CI_Controller {
    
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
			$objIndex = $this->home_model->consultarObjetoSimple("obs_id", "obs_detalle", "observacion", "", "obs_detalle", "ASC");
            if($objIndex == false){
                $tableInicio.= "<tr><td colspan='3'><br><br><br>No hay información disponible para este ítem<br><br></td></tr>";                
            } 
			else{
				$i = 1;
				foreach ($objIndex as $arr1=>$arr2) {
					$tableInicio.= "<tr><td>".anchor("observation/edit/".intval($arr2->codigo), img(array('src' => 'multimedia/images/edit.png', 'width' => '16', 'height' => '16','title' => 'Editar Contenido', 'border' => '0')), array('title' => 'Editar'))."</td>
										<td>".$this->home_model->obtenerCampo("estado", "est_nombre", "est_id", $this->home_model->obtenerCampo("observacion", "est_id", "obs_id", $arr2->codigo))."</td>
										<td>".$arr2->nombre."</td>
									</tr>";
					$i++;
				}
			}           	
			$dataForm['tableData'] = $tableInicio;
			$dataForm['infoVista']= $this->basics->viewMessage($this->home_model->consultarMensaje(27));			
			$this->load->view('observaciones_inicio', $dataForm);
			$this->load->view('footer');
		}
		
		public function newItem(){
			$this->load->view('header');
			$this->load->view('menu');
			$this->form_validation->set_rules('obs_detalle', 'Nombre / Descripcion', 'required|trim');
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
				redirect('/observation/edit/'.$this->home_model->actualizarObservacion($_POST));
			}
			$dataForm['estadoActivo'] = array("1" => "Activo", "2" => "Inactivo");
			$this->load->view('observation_new', $dataForm);
			$this->load->view('footer');
            
		}
		
		public function edit($id=""){
			$this->load->view('header');
			$this->load->view('menu');
			if($id==""){
				$id = $this->input->post("inc_id");
			}
			if(	$this->home_model->obtenerCampo("observacion", "est_id", "obs_id", intval($id)) == ""){
				redirect('observation/index');
			}
			$this->form_validation->set_rules('obs_detalle', 'Nombre / Descripcion', 'required|trim');
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
			$dataForm['obs_id']= $id;
			$dataForm['lineaComercialActivo'] = $this->basics->cargarOpcion($this->home_model->consultarLineasComercialesVigentes());
			$dataForm['estadoActivoPredef'] = $this->home_model->obtenerCampo("observacion", "est_id", "obs_id", $id);
			$dataForm['obs_detalle'] = $this->home_model->obtenerCampo("observacion", "obs_detalle", "obs_id", $id);
			$dataForm['estadoActivo'] = array("1" => "Activo", "2" => "Inactivo");
			$this->load->view('observation_edit', $dataForm);
			$this->load->view('footer');
		}
}