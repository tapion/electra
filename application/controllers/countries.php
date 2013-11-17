<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Countries extends CI_Controller {
    
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
			$objIndex = $this->home_model->consultarObjetoSimple("pai_id", "pai_nombre", "pais", "", "pai_nombre", "ASC");
            if($objIndex == false){
                $tableInicio.= "<tr><td colspan='5'><br><br><br>No hay información disponible para este ítem<br><br></td></tr>";                
            } 
			else{
				foreach ($objIndex as $arr1=>$arr2) {
					$tableInicio.= "<tr><td align='center'>".anchor("countries/edit/".intval($arr2->codigo), img(array('src' => 'multimedia/images/edit.png', 'width' => '16', 'height' => '16','title' => 'Editar Contenido', 'border' => '0')), array('title' => 'Editar'))."</td>
										<td align='center'>".$this->home_model->obtenerCampo("pais", "pai_abreviatura", "pai_id", $arr2->codigo)."</td>
										<td align='center'>".$this->home_model->obtenerCampo("pais", "pai_abreviatura2", "pai_id", $arr2->codigo)."</td>
										<td align='center'>".$this->home_model->obtenerCampo("estado", "est_nombre", "est_id", $this->home_model->obtenerCampo("pais", "est_id", "pai_id", $arr2->codigo))."</td>
										<td>".$arr2->nombre."</td>
									</tr>";
				}
			}
			$dataForm['tableData'] = $tableInicio;
			$dataForm['infoVista']= $this->basics->viewMessage($this->home_model->consultarMensaje(9));			
			$this->load->view('paises_inicio', $dataForm);
			$this->load->view('footer');
		}

		public function newItem(){
			$this->load->view('header');
			$this->load->view('menu');
			$this->form_validation->set_rules('pai_nombre', 'Nombre Pais', 'required|trim|min_length[3]');
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
				redirect('/countries/edit/'.$this->home_model->actualizarPais($_POST));
			}
			$dataForm['estadoActivo'] = array("1" => "Activo", "2" => "Inactivo");
			$this->load->view('countries_new', $dataForm);
			$this->load->view('footer');
            
		}

		public function edit($id=""){
			if($id==""){
				$id = $this->input->post("pai_id");
			}
			if(	$this->home_model->obtenerCampo("pais", "pai_nombre", "pai_id", intval($id)) == ""){
				redirect('countries/index');
			}
			$this->load->view('header');
			$this->load->view('menu');
			$this->form_validation->set_rules('pai_nombre', 'Nombre Pais', 'required|trim|min_length[3]');
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
				redirect('/countries/edit/'.$this->home_model->actualizarPais($_POST));
			}
			$dataForm['pai_nombre'] = utf8_decode($this->home_model->obtenerCampo("pais", "pai_nombre", "pai_id", $id));
			$dataForm['pai_abreviatura'] = $this->home_model->obtenerCampo("pais", "pai_abreviatura", "pai_id", $id);
			$dataForm['pai_abreviatura2'] = $this->home_model->obtenerCampo("pais", "pai_abreviatura2", "pai_id", $id);
			$dataForm['estadoActivo'] = array("1" => "Activo", "2" => "Inactivo");
			$dataForm['estadoActivoPredef'] = $this->home_model->obtenerCampo("pais", "est_id", "pai_id", $id);
			$dataForm['pai_id'] = $id;
			$this->load->view('countries_edit', $dataForm);
			$this->load->view('footer');
		}
}