<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class ContactLine extends CI_Controller {
    
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
			$objIndex = $this->home_model->consultarObjetoSimple("lnc_id", "lnc_nombre", "lineacontacto", "", "lnc_nombre", "ASC");
            if($objIndex == false){
                $tableInicio.= "<tr><td colspan='5'><br><br><br>No hay información disponible para este ítem<br><br></td></tr>";                
            } 
			else{
				foreach ($objIndex as $arr1=>$arr2) {
					$tableInicio.= "<tr><td align='center'>".anchor("contactLine/edit/".intval($arr2->codigo), img(array('src' => 'multimedia/images/edit.png', 'width' => '16', 'height' => '16','title' => 'Editar Contenido', 'border' => '0')), array('title' => 'Editar'))."</td>
										<td align='center'>".$this->home_model->obtenerCampo("lineacontacto", "lnc_abreviatura", "lnc_id", $arr2->codigo)."</td>
										<td align='center'>".$this->home_model->obtenerCampo("estado", "est_nombre", "est_id", $this->home_model->obtenerCampo("lineacontacto", "est_id", "lnc_id", $arr2->codigo))."</td>
										<td>".$arr2->nombre."</td>
									</tr>";
				}
			}
			$dataForm['tableData'] = $tableInicio;
			$dataForm['infoVista']= $this->basics->viewMessage($this->home_model->consultarMensaje(21));			
			$this->load->view('lineacontacto_inicio', $dataForm);
			$this->load->view('footer');
		}

		public function newItem(){
			$this->load->view('header');
			$this->load->view('menu');
			$this->form_validation->set_rules('lnc_nombre', 'Nombre Linea de Contacto', 'required|trim|min_length[3]');
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
				redirect('/contactLine/edit/'.$this->home_model->actualizarLineaContacto($_POST));
			}
			$dataForm['estadoActivo'] = array("1" => "Activo", "2" => "Inactivo");
			$this->load->view('contactLine_new', $dataForm);
			$this->load->view('footer');
            
		}

		public function edit($id=""){
			if($id==""){
				$id = $this->input->post("lnc_id");
			}
			if(	$this->home_model->obtenerCampo("lineacontacto", "lnc_nombre", "lnc_id", intval($id)) == ""){
				redirect('contactLine/index');
			}
			$this->load->view('header');
			$this->load->view('menu');
			$this->form_validation->set_rules('lnc_nombre', 'Nombre Linea de Contacto', 'required|trim|min_length[3]');
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
				redirect('/contactLine/edit/'.$this->home_model->actualizarLineaContacto($_POST));
			}
			$dataForm['lnc_nombre'] = utf8_decode($this->home_model->obtenerCampo("lineacontacto", "lnc_nombre", "lnc_id", $id));
			$dataForm['lnc_abreviatura'] = $this->home_model->obtenerCampo("lineacontacto", "lnc_abreviatura", "lnc_id", $id);
			$dataForm['estadoActivo'] = array("1" => "Activo", "2" => "Inactivo");
			$dataForm['estadoActivoPredef'] = $this->home_model->obtenerCampo("lineacontacto", "est_id", "lnc_id", $id);
			$dataForm['lnc_id'] = $id;
			$this->load->view('contactLine_edit', $dataForm);
			$this->load->view('footer');
		}
}