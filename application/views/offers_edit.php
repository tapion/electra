<script>
function consultaValor(){
  var codigo = $("#codigoProd").val();
  var incoterm = $("#inc_id").val();
  var moneda = $("#var_id").val();
  var url = "http://localhost:8080/index.php/offer/getPrecio/";
  var data = Array();
  var params = url+'1'+'/'+incoterm+'/'+moneda+'/'+codigo;
  if(codigo !== ''){
    $.get(params, data)
        .done(function(respuesta) {
        var resp = respuesta.split("===");
        if(resp[0] === '0'){
          //alert('Verifique los parámetros que intenta consultar');
          $("#nombreProd").val("<Verifique el Producto>");
          $("#valorProd").val("0");
          $("#subtotalProd").val("0");
        }
        else{
          $("#nombreProd").val(resp[1]);
          $("#valorProd").val(resp[0]);
          $("#cantidadProducto").val();
          $("#subtotalProd").val(resp[0]*$("#cantidadProd").val());
        }
    });
  }
  else{
    $("#nombreProd").val("<Verifique el Producto>");
    $("#valorProd").val("0");
    $("#subtotalProd").val("0");

  }
  
}

function agregaItem() {
  var url = "http://localhost:8080/index.php/offer/saveItem/";
  var data = Array();
  var codigo = $("#codigoProd").val();
  var cantidad = $("#cantidadProd").val();
  var valor = $("#valorProd").val();
  var nombre = $("#nombreProd").val();
  var offer = $("#idOf").val();
  var params = url+codigo+'/'+cantidad+'/'+valor+'/'+nombre+'/'+offer;
  if(valor !== '0'){
    $.get(params, data)
    .done(function(respuesta) {
      $('#itemsOferta').html(respuesta);
    });
  }
  else{
    alert( "Verifique los valores a insertar" );
  }
  
}

</script>
<?php 
$cantidades = array();
for($i = 0; $i <= 100; $i++){
  array_push($cantidades, $i);
}
switch ($estadoOferta){
  case '1':
    $actualizacion = "Cambiar estado a: ".form_dropdown('cambioEstado', $estadosActivos)." Observaciones: ".
    form_input(array('name' => 'comentario', 'id' => 'comentario', 'width' => '20', 'size' => '40', 'class' => 'caja'))." ".
    form_submit(array('name' => 'actualizarOferta', 'value' => 'Actualizar', 'class' => 'btn btn-primary'));
    $etapa = "I. ETAPA PREOFERTA";
    break;
  case '5':
    $actualizacion = "
      <form id='addItemOffer' method='post'>
      
      <table class='bordeGris' width='100%'>
        <tr>
          <td width='15%'><b>INCOTERM</b></td>
          <td width='35%'>".form_dropdown('inc_id', $incotermActivo, "")."</td>
          <td width='15%'><b>Divisa</b></td>
          <td width='35%'>".form_dropdown('var_id', $divisas, "")."</td>
        </tr>
        <tr>
          <td><b>Código</b></td>
          <td>".form_input(array('name' => 'codigoProd', 'id' => 'codigoProd', 'width' => '20', 'size' => '50', 'class' => 'caja', 'value'=>  "", 'onBlur' => "consultaValor()" ))."</td>
          <td><b>Descripción</b></td>
          <td>".form_input(array('name' => 'nombreProd', 'id' => 'nombreProd', 'width' => '20', 'size' => '50', 'class' => 'caja', 'value'=>  "", 'readonly' => 'true'))."</td>
        </tr>            
          <td><b>Cantidad</b></td>
          <td>".form_dropdown('cantidadProd', $cantidades,  '1', "onChange = consultaValor()")."</td>
          <td><b>V. Unitario</b></td>
          <td>".form_input(array('name' => 'valorProd', 'id' => 'valorProd', 'width' => '20', 'size' => '50', 'class' => 'caja', 'value'=>  "", 'readonly' => 'true' ))."</td>
        </tr>
        <tr>
          <td><b>V. Subtotal</b></td>
          <td>".form_input(array('name' => 'subtotalProd', 'id' => 'subtotalProd', 'width' => '20', 'size' => '500', 'class' => 'caja', 'readonly' => 'true', 'value'=>  "" ))."</td>
          <td colspan='2' align='right'>
          <button class='btn btn-small btn-success' id='agrega' type='button' onclick='agregaItem();'>
          <i class='icon-check'></i> Agregar</button> 
          </td>
        </tr>
      </table>
      </form>
      <br>
      <div id='itemsOferta'></div>
      <br>
      ";
    $actualizacion.= "<table class='bordeGris' width='100%'>
        <tr>
          <th colspan='6'>Observaciones Comerciales</th>
        </tr>
        <tr><td colspan='2'>&nbsp;</td></tr>
        <tr>
          <td width=10%><b>Incluir</b></td>
          <td width=90%><b>Descripción / Detalle</b></td>
        </tr>
        <tr><td colspan='2'>&nbsp;</td></tr>";
    foreach ($obsComercial as $key => $value) {
      $actualizacion.=" <tr>
                          <td align='center'>".form_checkbox('obsCom'.$value->codigo, 'OK', TRUE)."</td>
                          <td>".$value->nombre."</td>
                        </tr>";
    }
    $actualizacion.= "<tr><td colspan='2'>&nbsp;</td></tr></table>";
    $etapa = "II. ETAPA ACEPTADA / EN PROCESO";
    break;
  default:
    $actualizacion = "";
    $etapa = "V. ETAPA CERRADA";
    break;
}
?>

<div id="cuerpo">
  <?php echo $infoVista; ?>
  <br>
  <table width="100%">
    <tr>
      <td width="80%">
        <?php echo form_open("offer/explore/".$idOffer."/update"); ?>
        <table id='dataTable' class="bordeGris">
          <tr>
            <th colspan="6">
              Gestionar Oferta Comercial
            </th>
          </tr>
          <tr>
            <td colspan="4">&nbsp;</td>
          </tr>
          <tr>
            <td colspan="4"><strong><?php echo $etapa ?></strong></td>
          </tr>
          <tr>
            <td colspan="4">&nbsp;</td>
          </tr>
          <tr>
            <td width="25%">
              <strong>Solicitante: </strong>
            </td>
            <td width="25%">
              <?php echo $solicitante ?>
            </td>
            <td width="25%">
              <strong>Cliente: </strong>
            </td>
            <td width="25%">
              <?php echo $cliente ?>
            </td>
          </tr>
          <tr>
            <td><strong>Contacto:</strong></td>
            <td><?php echo $contacto ?></td>
            <td><strong>Ciudad:</strong></td>
            <td><?php echo $ciudad ?></td>
          </tr>
          <tr>
            <td><strong>Forma de Pago:</strong></td>
            <td><?php echo $formapago ?></td>
            <td><strong>Línea Comercial Mayoritaria:</strong></td>
            <td><?php echo $lineacomercial ?></td>
          </tr>
          <tr>
            <td><strong>Consideraciones y productos a cotizar:</strong></td>
            <td colspan="3">
              <?php echo $consideraciones ?>
            </td>
          </tr>
          <tr>
            <td><strong>Vigencia:</strong></td>
            <td><?php echo $vigencia ?></td>
            <td><strong>Plazo de Entrega:</strong></td>
            <td><?php echo $plazo ?></td>
          </tr>
          <tr>
            <td colspan="4">&nbsp;</td>
          </tr>
          <tr>
            <td colspan="4" align='right'>
              <?php echo $actualizacion; ?>
            </td>
          </tr>
          <tr>
            <td colspan="4" align="right">
              <?php echo form_hidden("idOf", $idOffer) ?>
              <?php echo form_submit(array('name'=> 'enviar', 'value'=>'Generar Oferta', 'class' => 'btn btn-primary')); ?>
            </td>
          </tr>

        </table>
        <?php echo form_close(); ?>

      </td>
      <td width="20%" valign="top">
        <table id="dataTable" class="bordeGris" width="100%">
          <tr>
            <th>
              Histórico de Actualizaciones
            </th>
          </tr>
          <tr>
            <td>
              <?php echo $trazaOferta ?>
            </td>
          </tr>
        </table>

      </td>
    </tr>
  </table>
  <br>

</div>