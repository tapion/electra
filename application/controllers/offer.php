<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

class Offer extends CI_Controller {

  public function __construct() {
    parent::__construct();
    $this->load->helper('html');
    $this->load->helper('form');
    $this->load->library('form_validation');
    $this->load->library('fpdf');
    $this->load->library('pdf');
    $this->load->library('basics');
    $this->load->library('encrypt');
    $this->load->model('home_model');
  }

  public function index() {
    $attributes = array(
        'width' => '1000',
        'height' => '600',
        'screenx' => '\'+((parseInt(screen.width) - 1000)/2)+\'',
        'screeny' => '\'+((parseInt(screen.height) - 600)/2)+\'',
        'scrollbars' => 'yes',
        'status' => 'yes',
        'resizable' => 'yes',
    );
    $this->load->view('header');
    $this->load->view('menu');
    $dataForm['infoVista'] = $this->basics->viewMessage($this->home_model->consultarMensaje(61));
    $tableInicio = "";
    $permisoGlobal = array(0 => '2', 1 => '1', 2 => '3', 3 => '5');
    if (array_search($this->session->userdata('idCargo'), $permisoGlobal) != '') {
      $objIndex = $this->home_model->consultarObjetoSimple("ofc_id", "ofc_codigoserie", "ofertacomercial", "", "ofc_id", "ASC");
    } else {
      $objIndex = $this->home_model->consultarObjetoSimple("ofc_id", "ofc_codigoserie", "ofertacomercial", "usr_idregistro = '" . $this->session->userdata('idUsuario') . "'", "ofc_id", "ASC");
    }
    if ($objIndex == false) {
      $tableInicio = "";
    } else {
      foreach ($objIndex as $arr1 => $arr2) {
        $idUsrOfr = $this->home_model->obtenerCampo("ejecutivoventa", "usr_id", "evt_id", $this->home_model->obtenerCampo("ofertacomercial", "evt_id", "ofc_id", $arr2->codigo));
        if ($this->home_model->obtenerCampo("ofertacomercial", "eof_id", "ofc_id", $arr2->codigo) == '2') {
          $codigoOferta = $this->home_model->obtenerCampo("ofertacomercial", "ofc_prefijo", "ofc_id", $arr2->codigo) . str_pad($arr2->nombre, 7, "0", STR_PAD_LEFT);
          $opciones = anchor(
                          "offer/explore/" . $arr2->codigo . "/update", img(array('src' => 'multimedia/images/view.png',
                      'width' => '16',
                      'title' => 'Ver / Actualizar',
                      'border' => '0')), $attributes
                  ) . " " .
                  anchor_popup(
                          "offer/explore/" . $arr2->codigo . "/pdf", img(array('src' => 'multimedia/images/filetopdf.png',
                      'width' => '16',
                      'title' => 'Ver en PDF',
                      'border' => '0')), $attributes
          );
        } else {
          $codigoOferta = "N/A";
          $opciones = anchor(
                  "offer/explore/" . $arr2->codigo . "/update", img(array('src' => 'multimedia/images/view.png',
              'width' => '16',
              'title' => 'Ver / Actualizar',
              'border' => '0')), $attributes
          );
          
        }
        $tableInicio.= "<tr>
										<td align='center'> 
										" . $opciones . "</td>
										<td>" . $this->home_model->obtenerCampo("estadooferta", "eof_nombre", "eof_id", $this->home_model->obtenerCampo("ofertacomercial", "eof_id", "ofc_id", $arr2->codigo)) . "</td>
                                                                                <td>" . substr($this->home_model->obtenerCampo("ofertacomercial", "ofc_fecharegistro", "ofc_id", $arr2->codigo), 0, 16) . "</td>
										<td>" . $codigoOferta . "</td>
										<td>" . $this->home_model->obtenerCampo("usuario", "usr_nombres", "usr_id", $idUsrOfr) . " " . $this->home_model->obtenerCampo("usuario", "usr_apellidos", "usr_id", $idUsrOfr) . "</td>
										<td>" . $this->home_model->obtenerCampo("lineacomercial", "lcm_nombre", "lcm_id", $this->home_model->obtenerCampo("ofertacomercial", "lcm_id", "ofc_id", $arr2->codigo)) . "</td>
									</tr>";
      }
    }
    $dataForm['tableData'] = $tableInicio;
    $this->load->view('offers_inicio', $dataForm);
    $this->load->view('footer');
  }
  
  public function saveItem($codigo, $cantidad, $valor, $nombre, $ofcID){
    $this->home_model->guardaItem($codigo, $cantidad, $valor, $nombre, $ofcID);
    $obj = $this->home_model->consultarDetalleOfertaComercial($ofcID);
    $ob = "<table class='bordeGris' width='100%'>
        <tr>
          <th colspan='6'>Detalle de Productos</th>
        </tr>
        <tr><td colspan='6'>&nbsp;</td></tr>
        <tr>
          <td><b>No.</b></td>
          <td><b>Código</b></td>
          <td><b>Descripción / Detalle</b></td>
          <td><b>Cant.</b></td>
          <td><b>Val. Unitario</b></td>
          <td><b>Val. Subtotal</b></td>
        </tr>";
    $i=1;
    foreach ($obj as $val) {
      
        $ob.= "<tr>
            <td>".$i."</td>
            <td>".$val->codigoproducto."</td>
            <td>".$val->nombreproducto."</td>
            <td>".$val->cantidadproducto."</td>
            <td>".$val->valorproducto."</td>
            <td>".$val->valorsubtotal."</td>
           </tr>";
        $i++;
      
      
    }
    $ob.="</table>";
    echo $ob;
    
  }
  
  public function getPrecio($lineaComercial, $incoterm, $moneda, $codigoProducto){
    if(trim($codigoProducto) != ''){
      $valor = $this->home_model->getPrecioProd($lineaComercial, $incoterm, $moneda, $codigoProducto);
    }
    else{
      echo "0";
    }
    
    if(trim($valor) != ''){
      echo $valor."===".$this->home_model->obtenerCampo("producto", "prd_titulo", "prd_codigo", $codigoProducto);
    }
    else{
      echo "0";
    }
  }

  public function explore($nroOferta = "", $formato = "") {
    if ($formato != "") {
      switch ($formato) {
        case "update":
          $this->load->view('header');
          $this->load->view('menu');
          $dataForm['infoVista'] = $this->basics->viewMessage($this->home_model->consultarMensaje(62));
          $dataForm['solicitante'] = $this->home_model->obtenerCampo("usuario", "usr_nombres", "usr_id", $this->home_model->obtenerCampo("ejecutivoventa", "usr_id", "evt_id", $this->home_model->obtenerCampo("ofertacomercial", "evt_id", "ofc_id", $nroOferta))) . " " . $this->home_model->obtenerCampo("usuario", "usr_apellidos", "usr_id", $this->home_model->obtenerCampo("ejecutivoventa", "usr_id", "evt_id", $this->home_model->obtenerCampo("ofertacomercial", "evt_id", "ofc_id", $nroOferta)));
          $dataForm['cliente'] = $this->home_model->obtenerCampo("cliente", "cli_razonsocial", "cli_id", $this->home_model->obtenerCampo("ofertacomercial", "cli_id", "ofc_id", $nroOferta));
          $dataForm['contacto'] = $this->home_model->obtenerCampo("contactocliente", "ccl_nombre", "ccl_id", $this->home_model->obtenerCampo("ofertacomercial", "ccl_id", "ofc_id", $nroOferta)) . " - (" . $this->home_model->obtenerCampo("contactocliente", "ccl_cargo", "ccl_id", $this->home_model->obtenerCampo("ofertacomercial", "ccl_id", "ofc_id", $nroOferta)) . ")";
          $dataForm['ciudad'] = $this->home_model->obtenerCampo("ciudad", "ciu_nombre", "ciu_id", $this->home_model->obtenerCampo("ofertacomercial", "ciu_id", "ofc_id", $nroOferta)) . " (" . $this->home_model->obtenerCampo("departamento", "dep_nombre", "dep_id", $this->home_model->obtenerCampo("ciudad", "dep_id", "ciu_id", $this->home_model->obtenerCampo("ofertacomercial", "ciu_id", "ofc_id", $nroOferta))) . ", " . $this->home_model->obtenerCampo("pais", "pai_nombre", "pai_id", $this->home_model->obtenerCampo("departamento", "pai_id", "dep_id", $this->home_model->obtenerCampo("ciudad", "dep_id", "ciu_id", $this->home_model->obtenerCampo("ofertacomercial", "ciu_id", "ofc_id", $nroOferta)))) . ")";
          $dataForm['formapago'] = $this->home_model->obtenerCampo("formapago", "fpg_nombre", "fpg_id", $this->home_model->obtenerCampo("ofertacomercial", "fpg_id", "ofc_id", $nroOferta));
          $dataForm['lineacomercial'] = $this->home_model->obtenerCampo("lineacomercial", "lcm_nombre", "lcm_id", $this->home_model->obtenerCampo("ofertacomercial", "lcm_id", "ofc_id", $nroOferta));
          $dataForm['consideraciones'] = $this->home_model->obtenerCampo("ofertacomercial", "ofc_preregistro", "ofc_id", $nroOferta);
          $dataForm['vigencia'] = $this->home_model->obtenerCampo("ofertacomercial", "ofc_vigencia", "ofc_id", $nroOferta) . " " . $this->home_model->obtenerCampo("ofertacomercial", "ofc_vigenciatexto", "ofc_id", $nroOferta);
          $dataForm['plazo'] = $this->home_model->obtenerCampo("ofertacomercial", "ofc_plazoentrega", "ofc_id", $nroOferta) . " " . $this->home_model->obtenerCampo("ofertacomercial", "ofc_plazoentregatexto", "ofc_id", $nroOferta);
          $dataForm['estadosActivos'] = $this->basics->cargarOpcion($this->home_model->consultarEstadosOFC($nroOferta));
          $dataForm['incotermActivo'] = $this->basics->cargarOpcion($this->home_model->consultarIncotermsVigentes());
          $dataForm['divisas'] = $this->basics->cargarOpcion($this->home_model->consultarDivisas());
          $dataForm['idOffer'] = $nroOferta;
          $dataForm['obsComercial'] = $this->home_model->consultarObjetoSimple("obs_id", "obs_detalle", "observacion", "est_id = 1", "obs_detalle", "ASC");
          $estadoOferta = $this->home_model->obtenerCampo("ofertacomercial", "eof_id", "ofc_id", $nroOferta);
          if($estadoOferta == 1){
            $this->form_validation->set_rules('comentario', 'Observaciones', 'required');
            $this->home_model->obtenerNumeroOferta($nroOferta);
          }
          else{
            
          }
          if($this->form_validation->run() == FALSE){
            if($this->input->post('actualizarOferta') == ""){
              $dataForm['infoVista']= $this->basics->viewMessage($this->home_model->consultarMensaje(18));	
            }
            else{
              $mensajes = validation_errors(); 
              $dataForm['infoVista'] = $this->basics->viewMessage($mensajes, "M");
            }	
          }
          else{
            $this->home_model->actualizaOferta($nroOferta, $this->input->post());
            
          }
          
          $dataForm['trazaOferta'] = "";
          $objTraza = $this->home_model->consultarObjetoSimple("toc_id", "toc_fecharegistro", "trazaofertacomercial", "ofc_id = '" . $nroOferta . "'", "toc_fecharegistro", "DESC");
          if ($objTraza == false) {
            $dataForm['trazaOferta'].= "<br><br>No hay información disponible en este momento para mostrar...<br><br><br>";
          } else {
            foreach ($objTraza as $arr1 => $arr2) {
              $idU = $this->home_model->obtenerCampo("trazaofertacomercial", "usr_idregistro", "toc_id", $arr2->codigo);
              $dataForm['trazaOferta'].= "
                <br>
                <i>" . substr($arr2->nombre, 0, 16) . "</i>
                <br>
                <strong>" . $this->home_model->obtenerCampo("usuario", "usr_nombres", "usr_id", $idU) . " " . $this->home_model->obtenerCampo("usuario", "usr_apellidos", "usr_id", $idU) . "</strong>
                <br>
                " . $this->home_model->obtenerCampo("trazaofertacomercial", "toc_comentario", "toc_id", $arr2->codigo) . "
                <br>";
            }
          }
          $dataForm['estadoOferta'] = $this->home_model->obtenerCampo("ofertacomercial", "eof_id", "ofc_id", $nroOferta);
          $this->load->view('offers_edit', $dataForm);
          $this->load->view('footer');
          break;
        default;
          redirect('/?');
          break;
      }
    } else {
      redirect('/?');
    }
  }
  
  public function consultaDetalle($codigo){
    echo "hola ".$codigo;
  }
  
  public function offerPDF($idOffer){
    $sumSub = 0;
    $sumCant = 0;
    $pCodigo = $pDescripcion = $pCant = $pValor = $pSubtotal = "";
    
    $data = $this->home_model->getDetalleOferta($idOffer);
    $this->pdf->SetTitle("OFERTA COMERCIAL ".$data->numerooferta);
    $this->pdf->SetFooter(TEXT_FOOTER);
    $this->pdf->SetTextColor(3,9,61);
    $this->pdf->Open();
    $this->pdf->AddPage();
    
    $firma = $this->home_model->getFirmaFuncionario($data->codejecutivo);
    $this->pdf->fila(array(
        array("5" => "Línea Comercial:"),
        array("5" => "Fecha de Registro"),
        array("10" => "Ciudad, Departamento:"),
    ), "BI", 0);
    $this->pdf->fila(array(
        array("5" => $data->lineacomercial),
        array("5" => $data->fecharegistro),
        array("10" => $data->ciudad),
    ), "", 0);
    $this->pdf->Ln();
    $this->pdf->fila(array(
        array("10" => "Cliente:"),
        array("10" => "Nombre de Contacto:"),
    ), "BI", 0);
    $this->pdf->fila(array(
        array("10" => $data->cliente),
        array("10" => $data->contactocliente),
    ), "", 0);
    $this->pdf->Ln();
    $this->pdf->fila(array(
        array("5" => "Plazo de Entrega:"),
        array("5" => "Vigencia de la Oferta:"),
        array("10" => "Forma de Pago:"),
    ), "BI", 0);
    $this->pdf->fila(array(
        array("5" => $data->plazoentrega),
        array("5" => $data->vigencia),
        array("10" => $data->formapago),
    ), "", 0);
    $this->pdf->Ln();
    $this->pdf->fila(array(
        array("10" => "INCOTERM:"),
        array("10" => "Ejecutivo de Cuenta:"),
    ), "BI", 0);
    $this->pdf->fila(array(
        array("10" => $data->incoterm),
        array("10" => $data->ejecutivoventa),
    ), "", 0);
    
    $this->pdf->Ln();
    $this->pdf->fila(array(array("20" => "En atención a su solicitud sobre nuestros productos y soluciones tecnológicas, nos permitimos realizar la cotización de los siguientes productos que esperamos sean de su preferencia:"), ), "", 0);
    
    $this->pdf->Ln();
    
    $this->pdf->fila(array(
        array("1" => "\nNro.\n\n"),
        array("3" => "\nCódigo Item:\n\n"),
        array("9" => "\nDescripción / Detalle Item:\n\n"),
        array("1" => "\nCant\n\n"),
        array("3" => "\nValor Unitario:\n\n"),
        array("3" => "\nValor Subtotal:\n\n"),
    ), "BI");
    
    $detOf = $this->home_model->consultarDetalleOfertaComercial($idOffer);
    
    if($detOf != false){
      $i = 1;
      //print_r($detOf);
      foreach ($detOf as $value){
        $pCodigo = $pDescripcion = $pCant = $pValor = $pSubtotal = "";
        foreach ($value as $key => $valor){
          if($key == "codigoproducto"){$pCodigo = $valor;}
          if($key == "nombreproducto"){$pDescripcion = $valor;}
          if($key == "detalleproducto"){$pDescripcion.= "\n".$valor;}
          if($key == "cantidadproducto"){$pCant = $valor;}
          if($key == "valorproducto"){$pValor = $valor;}
          if($key == "valorsubtotal"){$pSubtotal = $valor;}
          
          $sumSub+= $pSubtotal;
          $sumCant+=intval($pCant);
        }
        $this->pdf->fila(array(
            array("1" => $i),
            array("3" => $pCodigo),
            array("9" => $pDescripcion),
            array("1" => $pCant),
            array("3" => "$ ".number_format(intval($pValor),2, ',', '.')),
            array("3" => "$ ".number_format(intval($pSubtotal),2, ',', '.')),
          ), "");
          $i++;
      }
    }
    
    $this->pdf->Ln();
    
    $this->pdf->fila(array(
        array("5" => "TOTAL UNIDADES:"),
        array("5" => "VALOR SUBTOTAL:"),
        array("5" => "VALOR IVA (16%):"),
        array("5" => "VALOR TOTAL:"),
      ), "BI", 0);
    
            
    $this->pdf->fila(array(
        array("5" => "\n".$sumCant."\n\n"),
        array("5" => "\n$ ".number_format($sumSub,2, ',', '.')."\n\n"),
        array("5" => "\n$ ".number_format(($sumSub*0.16),2, ',', '.')."\n\n"),
        array("5" => "\n$ ".number_format(($sumSub*1.16),2, ',', '.')."\n\n"),
      ), "B");
    $obsOf = $this->home_model->consultarObjetoSimple("ooc_id", "ooc_texto", "observacionofertacomercial", "ofc_id = '$idOffer'", "ooc_texto", "ASC");
    if ($obsOf != false) {
      $this->pdf->Ln();
      $this->pdf->fila(array(
          array("20" => "Notas / Consideraciones Importantes"),
      ), "BI", 0);

      foreach ($obsOf as $value) {
        $this->pdf->Ln();
        $this->pdf->fila(array(
            array("20" => "* " . $value->nombre),
        ), "", 0);
      }
    }
    $this->pdf->Ln();
    if(trim($data->observacion) != ""){
      $this->pdf->fila(array(
          array("20" => "Observaciones Adicionales"),
      ), "BI", 0);
      $this->pdf->fila(array(
          array("20" => "\n".$data->observacion."\n\n"),
      ), "");
    }
    $this->pdf->Ln();
    $this->pdf->fila(array(
        array("20" => "Esperamos que nuestra oferta responda a sus necesidades, les aseguramos una atención especial a su pedido, recuerde referenciar el código de oferta " . $idOffer . " para su respectivo trámite."),
    ), "", 0);
    $this->pdf->Ln();
    $this->pdf->fila(array(
        array("20" => "En espera de sus gratas noticias les saludamos atentamente,"),
    ), "", 0);
    $this->pdf->Ln();
    $this->pdf->fila(array(
        array("20" => "Cordialmente,"),
    ), "", 0);
    $this->pdf->Ln(12);
    $this->pdf->fila(array(array("20" => $firma->nombresapellidos), ), "BI", 0);
    $this->pdf->fila(array(array("20" => $firma->cargofuncionario), ), "I", 0);
    $this->pdf->fila(array(array("20" => $firma->direccion), ), "", 0);
    $this->pdf->fila(array(array("20" => $firma->telefono." - ".$firma->telefonoempresa." - ".$firma->correofuncionario), ), "", 0);
    $this->pdf->fila(array(array("20" => $firma->paginaweb), ), "", 0);
    
    
    $this->pdf->Output();
  }

  public function newItem() {
    $error = FALSE;
    $this->load->view('header');
    $this->load->view('menu');
    $dataForm['contacto'] = "";
    $dataForm['cmbVigenciaNum'] = array("1" => "1", "2" => "2", "3" => "3", "4" => "4", "5" => "5", "6" => "6",
        "7" => "7", "8" => "8", "9" => "9", "10" => "10", "11" => "11",
        "12" => "12", "13" => "13", "14" => "14", "15" => "15", "16" => "16",
        "17" => "17", "18" => "18", "19" => "19", "20" => "20", "21" => "21",
        "22" => "22", "23" => "23", "24" => "24", "25" => "25", "26" => "26",
        "27" => "27", "28" => "29", "30" => "30");
    $dataForm['cmbVigenciaTxt'] = array("Dias" => "Días", "Semanas" => "Semanas", "Meses" => "Meses");
    $dataForm['clienteActivo'] = $this->basics->cargarOpcion($this->home_model->consultarClientesVigentesSimple());
    $dataForm['contactoClienteActivo'] = $this->basics->cargarOpcion($this->home_model->consultarContactosVigentes(rand(1, 4)));
    $dataForm['contactoActivo'] = $this->basics->cargarOpcion($this->home_model->consultarContactosVigentesEstandar());
    $dataForm['ciudadActivo'] = $this->basics->cargarOpcion($this->home_model->consultarCiudades());
    $dataForm['formaPagoActivo'] = $this->basics->cargarOpcion($this->home_model->consultarFormaPagoVigente());
    $arrLinea = $this->home_model->consultarLineaMayoritaria();
    
    $this->form_validation->set_rules('ofc_preregistro', 'Preregistro', 'required|trim|min_length[3]');
    if ($this->form_validation->run() == FALSE) {
      if ($this->input->post('crearOferta') == "") {
        if (!($arrLinea)) {
          $error = TRUE;
        }
        if ($error == TRUE) {
          $dataForm['infoVista'] = $this->basics->viewMessage($this->home_model->consultarMensaje(60));
          $dataForm['lineaMayoritaria'] = $this->basics->cargarOpcion($arrLinea);
          $this->load->view('errorParametros', $dataForm);
        } else {
          $dataForm['lineaMayoritaria'] = $this->basics->cargarOpcion($arrLinea);
          $dataForm['infoVista'] = $this->basics->viewMessage($this->home_model->consultarMensaje(59));
          $this->load->view('offers_pre', $dataForm);
        }
      } else {
        $mensajes = validation_errors();
        $dataForm['infoVista'] = $this->basics->viewMessage($mensajes, "M");
        $dataForm['lineaMayoritaria'] = $this->basics->cargarOpcion($arrLinea);
        $this->load->view('offers_pre', $dataForm);
      }
    } else {
      $this->home_model->registrarPreoferta($this->input->post());
      redirect('/offer/index');
    }
    $this->load->view('footer');
  }

  function loadContact() {
    $codCli = $this->input->get('id');
    $this->home_model->consultarContactosVigentes($codCli);
  }

  public function generalVars() {
    $dataForm['infoVista'] = $this->basics->viewMessage($this->home_model->consultarMensaje(58));
    $dataForm['monedas'] = array(
        "USD" => "Dólar Americano (USD)", "COP" => "Peso Colombiano (COP)", "SFR" => "Franco Suizo (SFR)",
        "EUR" => "Euro (EUR)");
    $dataForm['monedaPredef'] = "COP";
    if ($this->session->userdata('idCargo') == "1" || $this->session->userdata('idCargo') == "2") {
      $this->load->view('header');
      $this->load->view('menu');
      $dataForm["monedaPredef"] = $this->home_model->obtenerCampo("variablesgenerales", "var_valor", "var_nombre", "monedaBase");
      $dataForm['USD'] = $this->home_model->obtenerCampo("variablesgenerales", "var_valor", "var_nombre", "USD");
      $dataForm['COP'] = $this->home_model->obtenerCampo("variablesgenerales", "var_valor", "var_nombre", "COP");
      $dataForm['SFR'] = $this->home_model->obtenerCampo("variablesgenerales", "var_valor", "var_nombre", "SFR");
      $dataForm['EUR'] = $this->home_model->obtenerCampo("variablesgenerales", "var_valor", "var_nombre", "EUR");
      $this->load->view('offers_globals', $dataForm);
      $this->load->view('footer');
    } else {
      redirect('/?');
    }
  }

}

?>