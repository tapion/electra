<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class CommercialLine extends CI_Controller {
    
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
			$objIndex = $this->home_model->consultarObjetoSimple("lcm_id", "lcm_nombre", "lineacomercial", "", "lcm_nombre", "ASC");
            if($objIndex == false){
                $tableInicio.= "<tr><td colspan='5'><br><br><br>No hay información disponible para este ítem<br><br></td></tr>";                
            } 
			else{
				foreach ($objIndex as $arr1=>$arr2) {
					$tableInicio.= "<tr><td align='center'>".anchor("commercialLine/edit/".intval($arr2->codigo), img(array('src' => 'multimedia/images/edit.png', 'width' => '16', 'height' => '16','title' => 'Editar Contenido', 'border' => '0')), array('title' => 'Editar'))."</td>
										<td align='center'>".$this->home_model->obtenerCampo("lineacomercial", "lcm_abreviatura", "lcm_id", $arr2->codigo)."</td>
										<td align='center'>".$this->home_model->obtenerCampo("estado", "est_nombre", "est_id", $this->home_model->obtenerCampo("lineacomercial", "est_id", "lcm_id", $arr2->codigo))."</td>
										<td>".$arr2->nombre."</td>
									</tr>";
				}
			}
			$dataForm['tableData'] = $tableInicio;
			$dataForm['infoVista']= $this->basics->viewMessage($this->home_model->consultarMensaje(20));			
			$this->load->view('lineacomercial_inicio', $dataForm);
			$this->load->view('footer');
		}

		public function newItem(){
			$this->load->view('header');
			$this->load->view('menu');
			$this->form_validation->set_rules('lcm_abreviatura', 'Abreviatura Linea Comercial', 'required|trim|min_length[3]');
			$this->form_validation->set_rules('lcm_nombre', 'Nombre Linea Comercial', 'required|trim|min_length[3]');
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
				redirect('/commercialLine/edit/'.$this->home_model->actualizarLineaComercial($_POST));
			}
			$dataForm['estadoActivo'] = array("1" => "Activo", "2" => "Inactivo");
			$this->load->view('commercialLine_new', $dataForm);
			$this->load->view('footer');
            
		}

		public function edit($id=""){
			if($id==""){
				$id = $this->input->post("lcm_id");
			}
			if(	$this->home_model->obtenerCampo("lineacomercial", "lcm_nombre", "lcm_id", intval($id)) == ""){
				redirect('commercialLine/index');
			}
			$this->load->view('header');
			$this->load->view('menu');
			$this->form_validation->set_rules('lcm_nombre', 'Nombre Linea Comercial', 'required|trim|min_length[2]');
			$this->form_validation->set_rules('lcm_abreviatura', 'Abreviatura Linea Comercial', 'required|trim|min_length[2]');
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
				redirect('/commercialLine/edit/'.$this->home_model->actualizarLineaComercial($_POST));
			}
			$dataForm['estadoActivo'] = array("1" => "Activo", "2" => "Inactivo");
			$dataForm['lcm_nombre'] = utf8_decode($this->home_model->obtenerCampo("lineacomercial", "lcm_nombre", "lcm_id", $id));
			$dataForm['lcm_abreviatura'] = $this->home_model->obtenerCampo("lineacomercial", "lcm_abreviatura", "lcm_id", $id);
			$dataForm['lcm_descripcion'] = utf8_decode($this->home_model->obtenerCampo("lineacomercial", "lcm_descripcion", "lcm_id", $id));
			$dataForm['lcm_historia'] = utf8_decode($this->home_model->obtenerCampo("lineacomercial", "lcm_historia", "lcm_id", $id));
			$dataForm['lcm_productos'] = utf8_decode($this->home_model->obtenerCampo("lineacomercial", "lcm_productos", "lcm_id", $id));
			$dataForm['lcm_campos'] = utf8_decode($this->home_model->obtenerCampo("lineacomercial", "lcm_campos", "lcm_id", $id));
			
			$dataForm['estadoActivoPredef'] = $this->home_model->obtenerCampo("lineacomercial", "est_id", "lcm_id", $id);
			$dataForm['lcm_id'] = $id;
			$this->load->view('commercialLine_edit', $dataForm);
			$this->load->view('footer');
		}
}