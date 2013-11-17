<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Customer extends CI_Controller {
    
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
			$objIndex = $this->home_model->consultarObjetoSimple("cli_id", "cli_nui", "cliente", "", "cli_nombrecomercial", "ASC");
            if($objIndex == false){
                $tableInicio.= "<tr><td colspan='5'><br><br><br>No hay información disponible para este ítem<br><br></td></tr>";                
            } 
			else{
				foreach ($objIndex as $arr1=>$arr2) {
					$tableInicio.= "<tr>
										<td align='center'>".anchor("customer/edit/".intval($arr2->codigo), img(array('src' => 'multimedia/images/edit.png', 'width' => '16', 'height' => '16','title' => 'Editar Contenido', 'border' => '0')), array('title' => 'Editar'))."</td>
										<td align='center'>Estado</td>
										<td align='center'>".$this->home_model->obtenerCampo("cliente", "cli_nui", "cli_id", $arr2->codigo)."</td>
										<td align='left'>".$this->home_model->obtenerCampo("cliente", "cli_nombrecomercial", "cli_id", $arr2->codigo)."</td>
										<td align='left'>".$this->home_model->obtenerCampo("ciudad", "ciu_nombre", "ciu_id", $this->home_model->obtenerCampo("cliente", "ciu_id", "cli_id", $arr2->codigo))."</td>
										<td align='left'>".$this->home_model->obtenerCampo("cliente", "cli_direccionprincipal", "cli_id", $arr2->codigo)."</td>
									</tr>";
				}
			}
			$dataForm['tableData'] = $tableInicio;
			$dataForm['infoVista']= $this->basics->viewMessage($this->home_model->consultarMensaje(21));			
			$this->load->view('clientes_inicio', $dataForm);
			$this->load->view('footer');
		}

		public function newItem(){
			$this->load->view('header');
			$this->load->view('menu');
			$this->form_validation->set_rules('cli_nui', 'Numero de Identificacion', 'required|numeric');
			$this->form_validation->set_rules('cli_nombrecomercial', 'Nombre Comercial', 'required');
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
				redirect('/customer/edit/'.$this->home_model->actualizarCliente($this->input->post()));
			}
			$dataForm['estadoActivo'] = array("1" => "Activo", "2" => "Inactivo");
			$dataForm['ciudadActivo'] = $this->basics->cargarOpcion($this->home_model->consultarCiudades());
			$dataForm['sectorProductivoActivo'] = $this->basics->cargarOpcion($this->home_model->consultarSectorProductivo());
			$this->load->view('cliente_nuevo', $dataForm);
			$this->load->view('footer');
            
		}

		public function edit($id="", $action="", $idC=""){
			if($id==""){
				$id = $this->input->post("cli_id");
			}
			if(	$this->home_model->obtenerCampo("cliente", "tid_id", "cli_id", intval($id)) == ""){
				redirect('customer/index');
			}
			$this->load->view('header');
			$this->load->view('menu');
			$this->form_validation->set_rules('cli_nui', 'Numero de Identificacion', 'required|numeric');
			$this->form_validation->set_rules('cli_nombrecomercial', 'Nombre Comercial', 'required');
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
				if($this->input->post("enviarCont") != ''){
					redirect('/customer/edit/'.$this->home_model->agregarContactoCliente($this->input->post()));
					
				}
				else{
					if($this->input->post("actuaCont") != ''){
						redirect('/customer/edit/'.$this->home_model->actualizarContactoCliente($this->input->post()));
					}
					else{
						redirect('/customer/edit/'.$this->home_model->actualizarCliente($this->input->post()));
					}
				}
				
			}
			$objContacto = $this->home_model->consultarObjetoSimple("ccl_id", "cli_id", "contactocliente", "cli_id = '".$id."'", "ccl_id", "ASC");
            $dataForm['contactosAsociados'] = "";
            if($objContacto != false){
            	foreach ($objContacto as $arrC=>$arC) {
					$dataForm['contactosAsociados'].= "
						<table id='dataTable' class='bordeGris'>
							<tr>
								<td width='3%'>".img(array('src' => 'multimedia/images/usuario.png', 'width' => '20', 'height' => '20','title' => 'Agregar Nuevo Contacto', 'border' => '0'))."</td>
								<td width='47%'>
									".$this->home_model->obtenerCampo("contactocliente", "ccl_nombre", "ccl_id", $arC->codigo)."
								&nbsp;</td>		
								<td width='3%'>".img(array('src' => 'multimedia/images/rol.png', 'width' => '20', 'height' => '20','title' => 'Agregar Nuevo Contacto', 'border' => '0'))."</td>
								<td width='47%'>".$this->home_model->obtenerCampo("contactocliente", "ccl_cargo", "ccl_id", $arC->codigo)."&nbsp;</td>	
							</tr>
							<tr>
								<td>".img(array('src' => 'multimedia/images/phone.png', 'width' => '20', 'height' => '20','title' => 'Agregar Nuevo Contacto', 'border' => '0'))."</td>
								<td>
									".$this->home_model->obtenerCampo("contactocliente", "ccl_telefono", "ccl_id", $arC->codigo)."
								&nbsp;</td>		
								<td>".img(array('src' => 'multimedia/images/mail.png', 'width' => '20', 'height' => '20','title' => 'Agregar Nuevo Contacto', 'border' => '0'))."</td>
								<td>".$this->home_model->obtenerCampo("contactocliente", "ccl_correo", "ccl_id", $arC->codigo)."&nbsp;</td>	
							</tr>
							<tr>
								<td>".img(array('src' => 'multimedia/images/lineacomercial.png', 'width' => '20', 'height' => '20','title' => 'Agregar Nuevo Contacto', 'border' => '0'))."</td>
								<td>".$this->home_model->obtenerCampo("lineacomercial", "lcm_nombre", "lcm_id", $this->home_model->obtenerCampo("contactocliente", "lcm_id", "ccl_id", $arC->codigo))."&nbsp;</td>
								<td>".img(array('src' => 'multimedia/images/ciudad.png', 'width' => '20', 'height' => '20','title' => 'Agregar Nuevo Contacto', 'border' => '0'))."</td>
								<td>".$this->home_model->obtenerCampo("ciudad", "ciu_nombre", "ciu_id", $this->home_model->obtenerCampo("contactocliente", "ciu_id", "ccl_id", $arC->codigo))."&nbsp;</td>			
							</tr>
							<tr>
								<td>".img(array('src' => 'multimedia/images/estado.png', 'width' => '20', 'height' => '20','title' => 'Agregar Nuevo Contacto', 'border' => '0'))."</td>
								<td>".$this->home_model->obtenerCampo("estado", "est_nombre", "est_id", $this->home_model->obtenerCampo("contactocliente", "est_id", "ccl_id", $arC->codigo))."&nbsp;</td>
								<td colspan='2'>".
								anchor("customer/edit/".$id."/chgContact/".$arC->codigo, img(array('src' => 'multimedia/images/edit.png', 'width' => '16', 'height' => '16','title' => 'Editar Contacto', 'border' => '0')), array('title' => 'Editar Contacto')).
								anchor("customer/edit/".$id."/chgContact/".$arC->codigo, "Editar Contacto", array('title' => 'Editar Contacto'))
								."</td>			
							</tr>
						</table><br>";
				}
			}
			$dataForm['estadoActivo'] = array("1" => "Activo", "2" => "Inactivo");
			$dataForm['estadoActivoPredef'] = $this->home_model->obtenerCampo("cliente", "est_id", "cli_id", $id);
			$dataForm['tid_id'] = $this->home_model->obtenerCampo("cliente", "tid_id", "cli_id", $id);
			$dataForm['cli_nui'] = $this->home_model->obtenerCampo("cliente", "cli_nui", "cli_id", $id);
			$dataForm['cli_nombrecomercial'] = $this->home_model->obtenerCampo("cliente", "cli_nombrecomercial", "cli_id", $id);
			$dataForm['cli_razonsocial'] = $this->home_model->obtenerCampo("cliente", "cli_razonsocial", "cli_id", $id);
			$dataForm['cli_direccionprincipal'] = $this->home_model->obtenerCampo("cliente", "cli_direccionprincipal", "cli_id", $id);
			$dataForm['cli_direccioncorrespondencia'] = $this->home_model->obtenerCampo("cliente", "cli_direccioncorrespondencia", "cli_id", $id);
			$dataForm['cli_representantelegal'] = $this->home_model->obtenerCampo("cliente", "cli_representantelegal", "cli_id", $id);
			$dataForm['cli_paginaweb'] = $this->home_model->obtenerCampo("cliente", "cli_paginaweb", "cli_id", $id);
			$dataForm['cli_telefonoprincipal'] = $this->home_model->obtenerCampo("cliente", "cli_telefonoprincipal", "cli_id", $id);
			$dataForm['cli_telefonoauxiliar'] = $this->home_model->obtenerCampo("cliente", "cli_telefonoauxiliar", "cli_id", $id);
			$dataForm['cli_correoprincipal'] = $this->home_model->obtenerCampo("cliente", "cli_correoprincipal", "cli_id", $id);
			$dataForm['cli_correoauxiliar'] = $this->home_model->obtenerCampo("cliente", "cli_correoauxiliar", "cli_id", $id);
			$dataForm['cli_observaciones'] = $this->home_model->obtenerCampo("cliente", "cli_observaciones", "cli_id", $id);
			$dataForm['ciudadActivoPredef'] = $this->home_model->obtenerCampo("cliente", "ciu_id", "cli_id", $id);
			$dataForm['sectorProductivoActivoPredef'] = $this->home_model->obtenerCampo("cliente", "spr_id", "cli_id", $id);
			$dataForm['ciudadActivo'] = $this->basics->cargarOpcion($this->home_model->consultarCiudades());
			$dataForm['sectorProductivoActivo'] = $this->basics->cargarOpcion($this->home_model->consultarSectorProductivo());
			$dataForm['lineaComercialActivo'] = $this->basics->cargarOpcion($this->home_model->consultarLineasComercialesVigentes());
			$dataForm['cli_id'] = $id;
			if($action == "chgContact" && intval($idC) != 0){
				$dataForm['ccl_nombre'] = $this->home_model->obtenerCampo("contactocliente", "ccl_nombre", "ccl_id", $idC);
				$dataForm['ccl_cargo'] = $this->home_model->obtenerCampo("contactocliente", "ccl_cargo", "ccl_id", $idC);
				$dataForm['ccl_telefono'] = $this->home_model->obtenerCampo("contactocliente", "ccl_telefono", "ccl_id", $idC);
				$dataForm['ccl_correo'] = $this->home_model->obtenerCampo("contactocliente", "ccl_correo", "ccl_id", $idC);
				$dataForm['lcm_idPredef'] = $this->home_model->obtenerCampo("contactocliente", "lcm_id", "ccl_id", $idC);
				$dataForm['ciudadActivoPredef'] = $this->home_model->obtenerCampo("contactocliente", "ciu_id", "ccl_id", $idC);
				$dataForm['estadoActivoPredef'] = $this->home_model->obtenerCampo("contactocliente", "est_id", "ccl_id", $idC);
				$dataForm['action'] = 'actuaCont';
				$dataForm['labelBTN'] = 'Actualizar Contacto';
				$dataForm['ccl_id'] = intval($idC);
			}
			else{
				$dataForm['ccl_nombre'] = "";
				$dataForm['ccl_cargo'] = "";
				$dataForm['ccl_telefono'] = "";
				$dataForm['ccl_correo'] = "";
				$dataForm['lcm_idPredef'] = "";
				$dataForm['estadoActivoPredef'] = "";
				$dataForm['action'] = 'enviarCont';
				$dataForm['labelBTN'] = 'Agregar Contacto';
				$dataForm['ccl_id'] = "";
			}
			$this->load->view('cliente_editar', $dataForm);
			$this->load->view('footer');
            
			
			
		}
}