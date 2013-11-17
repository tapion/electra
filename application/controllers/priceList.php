<?php

if (!defined('BASEPATH'))
  exit('No direct script access allowed');

class PriceList extends CI_Controller {

  public function __construct() {
    parent::__construct();
    $this->load->helper('html');
    $this->load->helper('form');
    $this->load->library('form_validation');
    $this->load->library('basics');
    $this->load->library('encrypt');
    $this->load->model('home_model');
  }

  public function index() {
    $this->load->view('header');
    $this->load->view('menu');
    $tableInicio = "";
    $objIndex = $this->home_model->consultarObjetoSimple("lpr_id", "lcm_id", "listaprecio", "", "lpr_id", "ASC");
    if ($objIndex == false) {
      $tableInicio.= "<tr><td colspan='5'><br><br><br>No hay información disponible para este ítem<br><br></td></tr>";
    } else {
      foreach ($objIndex as $arr1 => $arr2) {
        $cac = $this->home_model->obtenerCampo("listaprecio", "lpr_carcom", "lpr_id", $arr2->codigo);
        $pte = $this->home_model->obtenerCampo("listaprecio", "lpr_tasexp", "lpr_id", $arr2->codigo);
        $tpe = $this->home_model->obtenerCampo("listaprecio", "lpr_pueexp", "lpr_id", $arr2->codigo);
        $dpe = $this->home_model->obtenerCampo("listaprecio", "lpr_desexp", "lpr_id", $arr2->codigo);
        $epe = $this->home_model->obtenerCampo("listaprecio", "lpr_embexp", "lpr_id", $arr2->codigo);
        $tpi = $this->home_model->obtenerCampo("listaprecio", "lpr_traimp", "lpr_id", $arr2->codigo);
        $dpi = $this->home_model->obtenerCampo("listaprecio", "lpr_desimp", "lpr_id", $arr2->codigo);
        $cpi = $this->home_model->obtenerCampo("listaprecio", "lpr_carimp", "lpr_id", $arr2->codigo);
        $tad = $this->home_model->obtenerCampo("listaprecio", "lpr_trades", "lpr_id", $arr2->codigo);
        $seg = $this->home_model->obtenerCampo("listaprecio", "lpr_seguro", "lpr_id", $arr2->codigo);
        $pda = $this->home_model->obtenerCampo("listaprecio", "lpr_pasadu", "lpr_id", $arr2->codigo);
        $iim = $this->home_model->obtenerCampo("listaprecio", "lpr_impimp", "lpr_id", $arr2->codigo);
        $total = ($cac + $pte + $tpe + $dpe + $epe + $tpi + $dpi + $cpi + $tad + $seg + $pda + $iim);
        $tableInicio.= "
									<tr>
										<td align='center'>" . anchor("priceList/edit/" . intval($arr2->codigo), img(array('src' => 'multimedia/images/edit.png', 'width' => '16', 'height' => '16', 'title' => 'Editar Contenido', 'border' => '0')), array('title' => 'Editar')) . "</td>
										<td align='center'>" . $this->home_model->obtenerCampo("estado", "est_nombre", "est_id", $this->home_model->obtenerCampo("listaprecio", "est_id", "lpr_id", $arr2->codigo)) . "</td>
										<td align='center'>" . $this->home_model->obtenerCampo("incoterm", "inc_abreviatura", "inc_id", $this->home_model->obtenerCampo("listaprecio", "inc_id", "lpr_id", $arr2->codigo)) . "</td>
										<td align='center'>" . $this->home_model->obtenerCampo("lineacomercial", "lcm_nombre", "lcm_id", $this->home_model->obtenerCampo("listaprecio", "lcm_id", "lpr_id", $arr2->codigo)) . "</td>
										<td align='center'>" . $cac . "%</td>
                                                                                <td align='center'>" . $pte . "%</td>
                                                                                <td align='center'>" . $tpe . "%</td>
                                                                                <td align='center'>" . $dpe . "%</td>
                                                                                <td align='center'>" . $epe . "%</td>
                                                                                <td align='center'>" . $tpi . "%</td>
                                                                                <td align='center'>" . $dpi . "%</td>
                                                                                <td align='center'>" . $cpi . "%</td>
                                                                                <td align='center'>" . $tad . "%</td>
                                                                                <td align='center'>" . $seg . "%</td>
                                                                                <td align='center'>" . $pda . "%</td>
                                                                                <td align='center'>" . $iim . "%</td>
                                                                                <td align='center'><strong>" . $total . "%</strong></td>
									</tr>";
      }
    }
    $dataForm['tableData'] = $tableInicio;
    $dataForm['infoVista'] = $this->basics->viewMessage($this->home_model->consultarMensaje(21));
    $this->load->view('listaprecios_inicio', $dataForm);
    $this->load->view('footer');
  }

  public function newItem() {
    $this->load->view('header');
    $this->load->view('menu');
    $this->form_validation->set_rules('lcm_id', 'Nombre de Registro', 'required');
    if ($this->form_validation->run() == FALSE) {
      if ($this->input->post('enviar') == "") {
        $dataForm['infoVista'] = $this->basics->viewMessage($this->home_model->consultarMensaje(18));
      } else {
        $mensajes = validation_errors();
        $dataForm['infoVista'] = $this->basics->viewMessage($mensajes, "M");
      }
    } else {
      $objIndex = $this->home_model->consultarObjetoSimple("lpr_id", "lcm_id", "listaprecio", "lcm_id = '" . $this->input->post('lcm_id') . "' AND inc_id = '" . $this->input->post('inc_id') . "'", "lpr_id", "ASC");
      if ($objIndex == false) {
        $dataForm['infoVista'] = $this->basics->viewMessage($this->home_model->consultarMensaje(11));
        redirect('/priceList/edit/' . $this->home_model->actualizarListaPrecios($_POST));
      } else {
        $dataForm['infoVista'] = $this->basics->viewMessage($this->home_model->consultarMensaje(57));
      }
    }
    $dataForm['lineaComercialActivo'] = $this->basics->cargarOpcion($this->home_model->consultarLineasComercialesVigentes());
    $dataForm['incotermActivo'] = $this->basics->cargarOpcion($this->home_model->consultarIncotermsVigentes());
    $dataForm['estadoActivo'] = array("1" => "Activo", "2" => "Inactivo");
    $dataForm['porcentaje'] = array(
        "0" => "0%", "1" => "1%", "2" => "2%", "3" => "3%", "4" => "4%", "5" => "5%", "6" => "6%", "7" => "7%",
        "8" => "8%", "9" => "9%", "10" => "10%", "11" => "11%", "12" => "12%", "13" => "13%", "14" => "14%",
        "15" => "15%", "16" => "16%", "17" => "17%", "18" => "18%", "19" => "19%", "20" => "20%", "21" => "21%",
        "22" => "22%", "23" => "23%", "24" => "24%", "25" => "25%", "26" => "26%", "27" => "27%", "28" => "28%",
        "29" => "29%", "30" => "30%", "31" => "31%", "32" => "32%", "33" => "33%", "34" => "34%", "35" => "35%",
        "36" => "36%", "37" => "37%", "38" => "38%", "39" => "39%", "40" => "40%", "41" => "41%", "42" => "42%",
        "43" => "43%", "44" => "44%", "45" => "45%", "46" => "46%", "47" => "47%", "48" => "48%", "49" => "49%",
        "50" => "50%", "51" => "51%", "52" => "52%", "53" => "53%", "54" => "54%", "55" => "55%", "56" => "66%",
        "57" => "57%", "58" => "58%", "59" => "59%", "60" => "60%", "61" => "61%", "62" => "62%", "63" => "63%",
        "64" => "64%", "65" => "65%", "66" => "66%", "67" => "67%", "68" => "68%", "69" => "69%", "70" => "70%",
        "71" => "71%", "72" => "72%", "73" => "73%", "74" => "74%", "75" => "75%", "76" => "76%", "77" => "77%",
        "78" => "78%", "79" => "79%", "80" => "80%", "81" => "81%", "82" => "82%", "83" => "83%", "84" => "84%",
        "85" => "85%", "86" => "86%", "87" => "87%", "88" => "88%", "89" => "89%", "90" => "90%", "91" => "91%",
        "92" => "92%", "93" => "93%", "94" => "94%", "95" => "95%", "96" => "96%", "97" => "97%", "98" => "98%",
        "99" => "99%", "100" => "100%");
    $this->load->view('pricelist_new', $dataForm);
    $this->load->view('footer');
  }

  public function edit($id = "") {
    if ($id == "") {
      $id = $this->input->post("lpr_id");
    }
    $this->load->view('header');
    $this->load->view('menu');
    $this->form_validation->set_rules('inc_id', 'INCOTERM', 'required');
    if ($this->form_validation->run() == FALSE) {
      if ($this->input->post('enviar') == "") {
        $dataForm['infoVista'] = $this->basics->viewMessage($this->home_model->consultarMensaje(10));
      } else {
        $mensajes = validation_errors();
        $dataForm['infoVista'] = $this->basics->viewMessage($mensajes, "M");
      }
    } else {
      $dataForm['infoVista'] = $this->basics->viewMessage($this->home_model->consultarMensaje(11));
      redirect('/priceList/edit/' . $this->home_model->actualizarListaPrecios($_POST));
    }
    $dataForm['incotermActivo'] = $this->basics->cargarOpcion($this->home_model->consultarIncotermsVigentes());
    $dataForm['incotermPredef'] = $this->home_model->obtenerCampo("listaprecio", "inc_id", "lpr_id", $id);
    $dataForm['lineaComercialActivo'] = $this->basics->cargarOpcion($this->home_model->consultarLineasComercialesVigentes());
    $dataForm['lineaComercialPredef'] = $this->home_model->obtenerCampo("listaprecio", "lcm_id", "lpr_id", $id);
    $dataForm['estadoActivo'] = array("1" => "Activo", "2" => "Inactivo");
    $dataForm['estadoActivoPredef'] = $this->home_model->obtenerCampo("listaprecio", "est_id", "lpr_id", $id);
    $dataForm['lpr_id'] = $id;
    $dataForm['porcentaje'] = array(
        "0" => "0%", "1" => "1%", "2" => "2%", "3" => "3%", "4" => "4%", "5" => "5%", "6" => "6%", "7" => "7%",
        "8" => "8%", "9" => "9%", "10" => "10%", "11" => "11%", "12" => "12%", "13" => "13%", "14" => "14%",
        "15" => "15%", "16" => "16%", "17" => "17%", "18" => "18%", "19" => "19%", "20" => "20%", "21" => "21%",
        "22" => "22%", "23" => "23%", "24" => "24%", "25" => "25%", "26" => "26%", "27" => "27%", "28" => "28%",
        "29" => "29%", "30" => "30%", "31" => "31%", "32" => "32%", "33" => "33%", "34" => "34%", "35" => "35%",
        "36" => "36%", "37" => "37%", "38" => "38%", "39" => "39%", "40" => "40%", "41" => "41%", "42" => "42%",
        "43" => "43%", "44" => "44%", "45" => "45%", "46" => "46%", "47" => "47%", "48" => "48%", "49" => "49%",
        "50" => "50%", "51" => "51%", "52" => "52%", "53" => "53%", "54" => "54%", "55" => "55%", "56" => "66%",
        "57" => "57%", "58" => "58%", "59" => "59%", "60" => "60%", "61" => "61%", "62" => "62%", "63" => "63%",
        "64" => "64%", "65" => "65%", "66" => "66%", "67" => "67%", "68" => "68%", "69" => "69%", "70" => "70%",
        "71" => "71%", "72" => "72%", "73" => "73%", "74" => "74%", "75" => "75%", "76" => "76%", "77" => "77%",
        "78" => "78%", "79" => "79%", "80" => "80%", "81" => "81%", "82" => "82%", "83" => "83%", "84" => "84%",
        "85" => "85%", "86" => "86%", "87" => "87%", "88" => "88%", "89" => "89%", "90" => "90%", "91" => "91%",
        "92" => "92%", "93" => "93%", "94" => "94%", "95" => "95%", "96" => "96%", "97" => "97%", "98" => "98%",
        "99" => "99%", "100" => "100%");
    $dataForm['lpr_carcom'] = $this->home_model->obtenerCampo("listaprecio", "lpr_carcom", "lpr_id", $id);
    $dataForm['lpr_tasexp'] = $this->home_model->obtenerCampo("listaprecio", "lpr_tasexp", "lpr_id", $id);
    $dataForm['lpr_pueexp'] = $this->home_model->obtenerCampo("listaprecio", "lpr_pueexp", "lpr_id", $id);
    $dataForm['lpr_desexp'] = $this->home_model->obtenerCampo("listaprecio", "lpr_desexp", "lpr_id", $id);
    $dataForm['lpr_embexp'] = $this->home_model->obtenerCampo("listaprecio", "lpr_embexp", "lpr_id", $id);
    $dataForm['lpr_traimp'] = $this->home_model->obtenerCampo("listaprecio", "lpr_traimp", "lpr_id", $id);
    $dataForm['lpr_desimp'] = $this->home_model->obtenerCampo("listaprecio", "lpr_desimp", "lpr_id", $id);
    $dataForm['lpr_carimp'] = $this->home_model->obtenerCampo("listaprecio", "lpr_carimp", "lpr_id", $id);
    $dataForm['lpr_trades'] = $this->home_model->obtenerCampo("listaprecio", "lpr_trades", "lpr_id", $id);
    $dataForm['lpr_seguro'] = $this->home_model->obtenerCampo("listaprecio", "lpr_seguro", "lpr_id", $id);
    $dataForm['lpr_pasadu'] = $this->home_model->obtenerCampo("listaprecio", "lpr_pasadu", "lpr_id", $id);
    $dataForm['lpr_impimp'] = $this->home_model->obtenerCampo("listaprecio", "lpr_impimp", "lpr_id", $id);
    $this->load->view('pricelist_edit', $dataForm);
    $this->load->view('footer');
  }

  public function current555555($action = "") {
    $this->load->view('header');
    $this->load->view('menu');
    if ($action == "") {
      $dataForm['infoVista'] = $this->basics->viewMessage($this->home_model->consultarMensaje(30));
      $dataForm['tableData'] = "";
      $objIndex = $this->home_model->consultarObjetoSimple("lpp_id", "lpr_id", "listaprecioxproducto", "est_id = 1", "lpp_id", "ASC");
      if ($objIndex != false) {
        $i = 1;
        foreach ($objIndex as $arr1 => $arr2) {
          $prdID = $this->home_model->obtenerCampo("listaprecioxproducto", "prd_id", "lpp_id", $arr2->codigo);
          $lprID = $this->home_model->obtenerCampo("listaprecioxproducto", "lpr_id", "lpp_id", $arr2->codigo);
          $prdCodigo = $this->home_model->obtenerCampo("producto", "prd_codigo", "prd_id", $prdID);
          $prdNombre = $this->home_model->obtenerCampo("producto", "prd_titulo", "prd_id", $prdID);
          $lcmID = $this->home_model->obtenerCampo("producto", "lcm_id", "prd_id", $prdID);
          $lineaComercial = $this->home_model->obtenerCampo("lineacomercial", "lcm_nombre", "lcm_id", $lcmID);
          $listaPrecio = $this->home_model->obtenerCampo("listaprecio", "lpr_abreviatura", "lpr_id", $lprID);
          $dataForm['tableData'].="<tr>
													<td>" . $i . "</td>
													<td>" . $lineaComercial . "</td>
													<td>" . $listaPrecio . "</td>
													<td>" . $prdCodigo . "</td>
													<td>" . $prdNombre . "</td>
													<td>" . $this->basics->convertirMoneda($this->home_model->obtenerCampo("listaprecioxproducto", "lpp_precio", "lpp_id", $arr2->codigo)) . "</td>
												</tr>";
          $i++;
        }
      }
      $this->load->view('pricelist_current', $dataForm);
    } else {
      if ($action == "imports") {
        $dataForm['infoVista'] = $this->basics->viewMessage($this->home_model->consultarMensaje(31));
        $config['upload_path'] = 'uploads/prices';
        $config['allowed_types'] = 'txt';
        $config['max_size'] = '1000';
        $this->load->library('upload', $config);
        $dataForm['resultadoImportacion'] = "<tr><th colspan='3'>Resultado de la Importación</th></tr>";
        if ($_POST) {
          if (!$this->upload->do_upload()) {
            $nroError = $this->upload->display_errors();
            $nroError = str_replace(array("<p>", "</p>"), "", $nroError);
            $dataForm['infoVista'] = $this->basics->viewMessage($this->home_model->consultarMensaje($nroError));
            $dataForm['resultadoImportacion'].= "<tr><td colspan='3' align='center'><br><br>No hay resultados para mostrar... Vuelva a intentarlo<br><br><br></td></tr>";
          } else {
            $data = array('upload_data' => $this->upload->data());
            $array = $this->upload->data();
            $dataForm['infoVista'] = $this->basics->viewMessage($this->home_model->consultarMensaje(29));
            $dataForm['resultadoImportacion'].= "<tr><td colspan='3' align='center'>";
            $dataForm['resultadoImportacion'].= "<table id='dataTable'>";
            $dataForm['resultadoImportacion'].= "	<tr>
																		<td><strong>Nombre Archivo:</strong></td>
																		<td>" . $array['file_name'] . "</td>
																		<td><strong>Tamaño:</strong></td>
																		<td>" . $array['file_size'] . " MB</td>
																		<td><strong>Fecha Cargue:</strong></td>
																		<td>" . date("Y-m-d H:i:s") . "</td>
																	</tr>
																	<tr>
																		<td><strong>Usuario Cargue:</strong></td>
																		<td>" . $this->session->userdata('nombrePilaUsuario') . "</td>
																		<td><strong>Extension Archivo:</strong></td>
																		<td>TXT</td>
																		<td><strong>Tipo de Archivo:</strong></td>
																		<td>" . $array['file_type'] . "</td>
																	</tr>";
            $dataForm['resultadoImportacion'].= "	<tr><td colspan='6' align='center'> ";
            $arrayFile = file(base_url() . "uploads/prices/" . $array['file_name']);
            if (count($arrayFile) == NULL) {
              $dataForm['resultadoImportacion'].= "<br><br>El archivo resulto estar vacio...<br><br><br>";
            } else {
              $i = 1;
              $dataForm['resultadoImportacion'].= "<table id='dataTable'><tr><th width='5%'>No.</th><th width='60%'>Contenido de la Línea</th><th width='35%'>Estado</th></tr>";
              foreach ($arrayFile as $valor) {
                $estado = "Cargado Satisfactoriamente";
                $valLinea = explode(";", $valor);
                if (empty($valLinea[2])) {
                  $estado = "Descartado, La línea no es consistente";
                } else {
                  if (intval($valLinea[2]) == 0) {
                    $estado = "Descartado, El precio no es consistente";
                  } else {
                    $lprID = $this->home_model->obtenerCampo("listaprecio", "lpr_id", "lpr_abreviatura", $valLinea[0]);
                    if ($lprID == "") {
                      $estado = "Descartado, La lista de precios no Existe";
                    } else {
                      $prdID = $this->home_model->obtenerCampo("producto", "prd_id", "prd_codigo", $valLinea[1]);
                      if ($prdID == "") {
                        $estado = "Descartado, El producto no se encuentra en el sistema";
                      } else {
                        $lcm1 = $this->home_model->obtenerCampo("listaprecio", "lcm_id", "lpr_id", $lprID);
                        $lcm2 = $this->home_model->obtenerCampo("producto", "lcm_id", "prd_id", $prdID);
                        if ($lcm1 != $lcm2) {
                          $estado = "Descartado, El producto no pertenece a esa lista de precios";
                        } else {
                          $data = array(
                              'lpr_id' => $lprID,
                              'prd_id' => $prdID,
                              'lpp_precio' => $valLinea[2],
                              'est_id' => '1',
                              'lpp_id' => ''
                          );
                          $this->home_model->actualizarPrecio($data);
                        }
                      }
                    }
                  }
                }
                $dataForm['resultadoImportacion'].= "	<tr>
																				<td align='center'>" . $i . "</td>
																				<td>" . $valor . "</td>
																				<td>" . $estado . "</td>
																			</tr>";
                $i++;
              }
              $dataForm['resultadoImportacion'].= "</table>";
            }
            $dataForm['resultadoImportacion'].= "</td></tr></table>";
            $dataForm['resultadoImportacion'].= "</td></tr>";
          }
        } else {
          $dataForm['infoVista'] = $this->basics->viewMessage($this->home_model->consultarMensaje(30));
          $dataForm['resultadoImportacion'].= "<tr><td colspan='3' align='center'><br><br>Seleccione el archivo que desea cargar en el sistema...<br><br><br></td></tr>";
        }
        $this->load->view('preciosproducto_carga', $dataForm);
      }
    }
    $this->load->view('footer');
  }

}

?>