<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Products extends CI_Controller {
    
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
			$objIndex = $this->home_model->consultarObjetoSimple("prd_id", "prd_titulo", "producto", "", "prd_nombre", "ASC");
            if($objIndex == false){
                $tableInicio.= "<tr><td colspan='4' align='center'><br>No hay información disponible para este ítem<br><br></td></tr>";                
            } 
			else{
				foreach ($objIndex as $arr1=>$arr2) {
					$tableInicio.= "<tr><td align='center'>".anchor("products/edit/".intval($arr2->codigo), img(array('src' => 'multimedia/images/edit.png', 'width' => '16', 'height' => '16','title' => 'Editar Contenido', 'border' => '0')), array('title' => 'Editar'))."</td>
										<td align='center'>".$this->home_model->obtenerCampo("producto", "prd_codigo", "prd_id", $arr2->codigo)."</td>
										<td align='center'>".$this->home_model->obtenerCampo("estado", "est_nombre", "est_id", $this->home_model->obtenerCampo("producto", "est_id", "prd_id", $arr2->codigo))."</td>
										<td>".$arr2->nombre."</td>
                    <td>$".number_format($this->home_model->obtenerCampo("producto", "prd_preciobase", "prd_id", $arr2->codigo), 2, ',', '') ."</td>
									</tr>";
				}
			}
			$dataForm['tableData'] = $tableInicio;
			$dataForm['infoVista']= $this->basics->viewMessage($this->home_model->consultarMensaje(24));			
			$this->load->view('productos_inicio', $dataForm);
			$this->load->view('footer');
		}

		public function edit($id=""){
			if($id==""){
				$id = $this->input->post("prd_id");
			}
			if(	$this->home_model->obtenerCampo("producto", "prd_titulo", "prd_id", intval($id)) == ""){
				redirect('products/index');
			}
			$this->load->view('header');
			$this->load->view('menu');
			$this->form_validation->set_rules('prd_titulo', 'Nombre del Producto', 'required|trim|min_length[3]');
			$this->form_validation->set_rules('prd_codigo', 'Codigo del Producto', 'required|trim|min_length[3]');
      $this->form_validation->set_rules('prd_preciobase', 'Precio Base', 'required|numeric|greather_than[0]');
			
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
				$this->home_model->actualizarProducto($_POST);
			}
			$dataForm['lineaComercial'] = $this->basics->cargarOpcion($this->home_model->consultarLineasComercialesVigentes());
			$dataForm['lineaComercialActivoPredef'] = $this->home_model->obtenerCampo("producto", "lcm_id", "prd_id", $id);
			$dataForm['estadoActivo'] = array("1" => "Activo", "2" => "Inactivo");
			$dataForm['estadoActivoPredef'] = $this->home_model->obtenerCampo("producto", "est_id", "prd_id", $id);
			$dataForm['prd_codigo'] = $this->home_model->obtenerCampo("producto", "prd_codigo", "prd_id", $id);
			$dataForm['prd_dimensiones'] = $this->home_model->obtenerCampo("producto", "prd_dimensiones", "prd_id", $id);
			$dataForm['prd_peso'] = $this->home_model->obtenerCampo("producto", "prd_peso", "prd_id", $id);
      $dataForm['prd_preciobase'] = $this->home_model->obtenerCampo("producto", "prd_preciobase", "prd_id", $id);
			$dataForm['prd_titulo'] = $this->home_model->obtenerCampo("producto", "prd_titulo", "prd_id", $id);
			$dataForm['prd_nombre'] = $this->home_model->obtenerCampo("producto", "prd_nombre", "prd_id", $id);
			$dataForm['prd_id'] = $id;
			$this->load->view('products_edit', $dataForm);
			$this->load->view('footer');
		}
		
		public function newItem(){
			$this->load->view('header');
			$this->load->view('menu');
			$this->form_validation->set_rules('prd_titulo', 'Nombre del Producto', 'required|trim|min_length[3]');
			$this->form_validation->set_rules('prd_codigo', 'Codigo del Producto', 'required|trim|min_length[3]');
      $this->form_validation->set_rules('prd_preciobase', 'Precio Base', 'required|numeric|greather_than[0]');
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
				//redirect('/products/edit/'.$this->home_model->actualizarProducto($_POST));
				redirect('/products/index/'.$this->home_model->actualizarProducto($_POST));
			}
			$dataForm['lineaComercial'] = $this->basics->cargarOpcion($this->home_model->consultarLineasComercialesVigentes());
			$dataForm['usuarioActivo'] = $this->basics->cargarOpcion($this->home_model->consultarUsuariosVigentes());
			$dataForm['estadoActivo'] = array("1" => "Activo", "2" => "Inactivo");
			$this->load->view('products_new', $dataForm);
			$this->load->view('footer');
            
		}

		public function import(){
			$this->load->view('header');
			$this->load->view('menu');
			$config['upload_path'] = 'uploads/products';
        		$config['allowed_types'] = 'txt';
        		$config['max_size']    = '1000';
   			$this->load->library('upload', $config);
			$dataForm['resultadoImportacion'] = "<tr><th colspan='3'>Resultado de la Importación</th></tr>";
			if($_POST){
				if ( ! $this->upload->do_upload()){
					$nroError = $this->upload->display_errors();
					$nroError = str_replace(array("<p>", "</p>"), "", $nroError);
					$dataForm['infoVista'] = $this->basics->viewMessage($this->home_model->consultarMensaje($nroError));
					$dataForm['resultadoImportacion'].= "<tr><td colspan='3' align='center'><br><br>No hay resultados para mostrar... Vuelva a intentarlo<br><br><br></td></tr>";
				}
				else{
					$data = array('upload_data' => $this->upload->data());
					$array = $this->upload->data();
					$dataForm['infoVista']= $this->basics->viewMessage($this->home_model->consultarMensaje(29));
					$dataForm['resultadoImportacion'].= "<tr><td colspan='3' align='center'>";
					$dataForm['resultadoImportacion'].= "<table>";
					$dataForm['resultadoImportacion'].= "	<tr>
                                                                                        <td><strong>Nombre Archivo:</strong></td>
                                                                                        <td>".$array['file_name']."</td>
                                                                                        <td><strong>Tamaño:</strong></td>
                                                                                        <td>".$array['file_size']."</td>
                                                                                        <td><strong>Fecha Cargue:</strong></td>
                                                                                        <td>".date("Y-m-d H:i:s")."</td>
                                                                                </tr>
                                                                                <tr>
                                                                                        <td><strong>Usuario Cargue:</strong></td>
                                                                                        <td>".$this->session->userdata('nombrePilaUsuario')."</td>
                                                                                        <td><strong>Extension Archivo:</strong></td>
                                                                                        <td>TXT</td>
                                                                                        <td><strong>Tipo de Archivo:</strong></td>
                                                                                        <td>".$array['file_type']."</td>
                                                                                </tr>";
                                        
					$dataForm['resultadoImportacion'].= "	<tr><td colspan='6' align='center'> ";
					$arrayFile = file(base_url()."uploads/products/".$array['file_name']);
					if(count($arrayFile) == NULL){
						$dataForm['resultadoImportacion'].= "<br><br>El archivo resulto estar vacio...<br><br><br>";			
					}		
					else{
						$i = 1;
						$dataForm['resultadoImportacion'].= "<table><tr><th width='5%'>No.</th><th width='60%'>Contenido de la Línea</th><th width='35%'>Estado</th></tr>";
						foreach ($arrayFile as $valor) {
							$estado = "Cargado Satisfactoriamente";
							$valLinea = explode(";", $valor);
                                                        $lcmID = $this->home_model->obtenerCampo("lineacomercial", "lcm_id", "lcm_abreviatura", $valLinea[0]);
                                                        if($lcmID == ""){
                                                                $estado = "Descartado, El prefijo de Línea Comercial no Existe";	
                                                        }
                                                        else{
                                                            if($this->home_model->obtenerCampo("producto", "prd_id", "prd_codigo", $valLinea[1], "lcm_id = '".$lcmID."'")){
								$estado = "Descartado, El producto ya se encuentra en el sistema";		
                                                            }
                                                            else{
                                                                $estDisp = array('A', 'I');
                                                                if (in_array($valLinea[2], $estDisp)) {
                                                                    if(floatval($valLinea[3]) <= 0){
                                                                        $estado = "Descartado, El valor del producto es inferior a $0";
                                                                    }
                                                                    else{
                                                                        if(trim($valLinea[4]) == ""){
                                                                            $estado = "Descartado, El producto debe contener un nombre válido";
                                                                        }
                                                                        else{
                                                                            /*if(empty($valLinea[5])){
                                                                                $estado = "Descartado, La línea no es consistente";
                                                                            }
                                                                            else{
                                                                                
                                                                            }*/
                                                                            $status = 2;
                                                                            if(strtoupper(trim($valLinea[2])) == "A"){
                                                                                    $status = 1;	
                                                                            }
                                                                            $data = array(
                                                                                    'est_id' => $status,
                                                                                    'prd_dimensiones' => "",
                                                                                    'lcm_id' => $lcmID,
                                                                                    'prd_idpadre' => 0,
                                                                                    'prd_peso' => "",
                                                                                    'prd_foto' => "",
                                                                                    'prd_preciobase' => "".floatval(str_replace(",",".",$valLinea[3]))."",
                                                                                    'prd_nombre' => utf8_encode(trim($valLinea[5])),
                                                                                    'prd_titulo' => utf8_encode(trim($valLinea[4])),
                                                                                    'prd_codigo' => utf8_encode(trim($valLinea[1]))
                                                                            );
                                                                            $this->home_model->actualizarProductoMasivo($data);
                                                                        }
                                                                    }
                                                                }
                                                                else{
                                                                    $estado = "Descartado, El estado no fue encontrado";
                                                                }
                                                            }
                                                        }
                                                        $dataForm['resultadoImportacion'].= "	<tr>
                                                                                                    <td align='center'>".$i."</td>
                                                                                                    <td>".$valor."</td>
                                                                                                    <td>".$estado."</td>
                                                                                                </tr>";	
							$i++;																		
						}
						$dataForm['resultadoImportacion'].= "</table>";
					}													
					$dataForm['resultadoImportacion'].= "</td></tr></table>";
					$dataForm['resultadoImportacion'].= "</td></tr>";
					
				}
				
			}
			else{
				$dataForm['infoVista']= $this->basics->viewMessage($this->home_model->consultarMensaje(28));
				$dataForm['resultadoImportacion'].= "<tr><td colspan='3' align='center'><br><br>Seleccione el archivo que desea cargar en el sistema...<br><br><br></td></tr>";
				
			}
			$this->load->view('productos_carga', $dataForm);
			$this->load->view('footer');
		}

}		

?>