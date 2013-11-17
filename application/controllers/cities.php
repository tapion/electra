<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cities extends CI_Controller {
    
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
			$objIndex = $this->home_model->consultarObjetoSimple("ciu_id", "ciu_nombre", "ciudad", "", "ciu_nombre", "ASC");
            if($objIndex == false){
                $tableInicio.= "<tr><td colspan='6'><br><br><br>No hay información disponible para este ítem<br><br></td></tr>";                
            } 
			else{
				foreach ($objIndex as $arr1=>$arr2) {
					$tableInicio.= "<tr><td>".anchor("cities/edit/".intval($arr2->codigo), img(array('src' => 'multimedia/images/edit.png', 'width' => '16', 'height' => '16','title' => 'Editar Contenido', 'border' => '0')), array('title' => 'Editar'))."</td>
										<td>".$this->home_model->obtenerCampo("pais", "pai_nombre", "pai_id", $this->home_model->obtenerCampo("departamento", "pai_id", "dep_id", $this->home_model->obtenerCampo("ciudad", "dep_id", "ciu_id", $arr2->codigo)))."</td>
										<td>".$this->home_model->obtenerCampo("departamento", "dep_nombre", "dep_id", $this->home_model->obtenerCampo("ciudad", "dep_id", "ciu_id", $arr2->codigo))."</td>
										<td>".$this->home_model->obtenerCampo("ciudad", "ciu_abreviatura", "ciu_id", $arr2->codigo)."</td>
										<td>".$this->home_model->obtenerCampo("estado", "est_nombre", "est_id", $this->home_model->obtenerCampo("ciudad", "est_id", "ciu_id", $arr2->codigo))."</td>
										<td>".$arr2->nombre."</td>
									</tr>";
				}
			}           	
			$dataForm['tableData'] = $tableInicio;
			$dataForm['infoVista']= $this->basics->viewMessage($this->home_model->consultarMensaje(14));			
			$this->load->view('ciudades_inicio', $dataForm);
			$this->load->view('footer');
		}

		public function newItem(){
			$this->load->view('header');
			$this->load->view('menu');
			$this->form_validation->set_rules('ciu_nombre', 'Nombre de Ciudad', 'required|trim|min_length[3]');
			$dataForm['departamentoActivo'] = $this->basics->cargarOpcion($this->home_model->consultarDepartamentos());
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
				redirect('/cities/edit/'.$this->home_model->actualizarCiudad($_POST));
			}
			$dataForm['estadoActivo'] = array("1" => "Activo", "2" => "Inactivo");
			$this->load->view('cities_new', $dataForm);
			$this->load->view('footer');
            
		}
				

		public function edit($id=""){
			if($id==""){
				$id = $this->input->post("ciu_id");
			}
			if(	$this->home_model->obtenerCampo("ciudad", "ciu_nombre", "ciu_id", intval($id)) == ""){
				redirect('cities/index');
			}
			$this->load->view('header');
			$this->load->view('menu');
			$this->form_validation->set_rules('ciu_nombre', 'Nombre Ciudad', 'required|trim|min_length[3]');
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
				$this->home_model->actualizarCiudad($_POST);
			}
			$dataForm['ciu_nombre'] = utf8_decode($this->home_model->obtenerCampo("ciudad", "ciu_nombre", "ciu_id", $id));
			$dataForm['ciu_abreviatura'] = $this->home_model->obtenerCampo("ciudad", "ciu_abreviatura", "ciu_id", $id);
			$dataForm['departamentoActivo'] = $this->basics->cargarOpcion($this->home_model->consultarDepartamentos());
			$dataForm['departamentoActivoPredef'] = $this->home_model->obtenerCampo("ciudad", "dep_id", "ciu_id", $id);
			$dataForm['estadoActivo'] = array("1" => "Activo", "2" => "Inactivo");
			$dataForm['estadoActivoPredef'] = $this->home_model->obtenerCampo("ciudad", "est_id", "ciu_id", $id);
			$dataForm['ciu_id'] = $id;
			$this->load->view('cities_edit', $dataForm);
			$this->load->view('footer');
			
		}
}