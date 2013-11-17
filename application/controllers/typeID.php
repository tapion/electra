<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class TypeID extends CI_Controller {
    
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
			$objIndex = $this->home_model->consultarObjetoSimple("tid_id", "tid_nombre", "tipoidentificacion", "", "tid_id", "ASC");
            if($objIndex == false){
                $tableInicio.= "<tr><td colspan='3'><br><br><br>No hay información disponible para este ítem<br><br></td></tr>";                
            } 
			else{
				foreach ($objIndex as $arr1=>$arr2) {
					$tableInicio.= "<tr>
					<td align='center'>".anchor("typeID/edit/".intval($arr2->codigo), img(array('src' => 'multimedia/images/edit.png', 'width' => '16', 'height' => '16','title' => 'Editar Contenido', 'border' => '0')), array('title' => 'Editar'))."</td>
					<td align='center'>".$this->home_model->obtenerCampo("estado", "est_nombre", "est_id", $this->home_model->obtenerCampo("tipoidentificacion", "est_id", "tid_id",$arr2->codigo))."</td>
					<td align='center'>".$this->home_model->obtenerCampo("tipoidentificacion", "tid_simbolo", "tid_id",$arr2->codigo)."</td>
					<td>".$arr2->nombre."</td></tr>";
				}
			}
			$dataForm['tableData'] = $tableInicio;  
			$dataForm['infoVista']= $this->basics->viewMessage($this->home_model->consultarMensaje(12));	     	
			$this->load->view('tiposID_inicio', $dataForm);
			$this->load->view('footer');
		}
		
		
		public function newItem(){
			$this->load->view('header');
			$this->load->view('menu');
			$dataForm['estadoActivo'] = array("1" => "Activo", "2" => "Inactivo");
			$this->form_validation->set_rules('tid_simbolo', 'Abreviatura', 'required|trim|min_length[2]');
			$this->form_validation->set_rules('tid_nombre', 'Nombre', 'required|trim|min_length[5]');
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
				redirect('/typeID/edit/'.$this->home_model->actualizarTipoIdentificacion($_POST));
			}
			
			$this->load->view('typeID_new', $dataForm);
			$this->load->view('footer');
		}
		
		public function edit($id=""){
			$this->load->view('header');
			$this->load->view('menu');
			if($id==""){
				$id = $this->input->post("tid_id");
			}
			if(	$this->home_model->obtenerCampo("tipoidentificacion", "tid_nombre", "tid_id", intval($id)) == ""){
				redirect('typeID/index');
			}
			$this->form_validation->set_rules('tid_simbolo', 'Abreviatura', 'required|trim|min_length[2]');
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
				$this->home_model->actualizarTipoIdentificacion($_POST);
			}
			$dataForm['tid_id']= $id;		
			$dataForm['estadoActivoPredef'] = $this->home_model->obtenerCampo("tipoidentificacion", "est_id", "tid_id", $id);
			$dataForm['tid_simbolo'] = $this->home_model->obtenerCampo("tipoidentificacion", "tid_simbolo", "tid_id", $id);
			$dataForm['tid_nombre'] = $this->home_model->obtenerCampo("tipoidentificacion", "tid_nombre", "tid_id", $id);
			$dataForm['estadoActivo'] = array("1" => "Activo", "2" => "Inactivo");
			$this->load->view('typeID_edit', $dataForm);
			$this->load->view('footer');
		}
}