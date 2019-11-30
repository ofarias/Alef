<style>
<?php foreach ($maestros as $dt): 
 if( $dt->RUTAS > 0){
    echo ".panel-body".$dt->ID."{ background-color: #7abd0b;}";
  }
?>
<?php endforeach?>

</style>

<div class="row">
    <div class="col-lg-16">
         <div class="col-xs-16 col-md-6">
            <br/><br/>
            <label>&nbsp;&nbsp;Ubicar Factura o Remision :</label>&nbsp;&nbsp;<input type="text" name="idp" value="" placeholder="Colocar Documento " id="docv">&nbsp;&nbsp;<input type="button" name="buscar" value="Buscar" class="btn btn-info" id="buscar">
             <div id="resultado">
             </div>
            <div id="o">
            </div>
        </div>
        </div>
    </div>
<br/>   
<div class="row">
    <div class="col-lg-16">
        <div class="col-xs-16 col-md-6">
            <label>Buscar Factura: </label><br/>
            Factura: <input type="text" name="fact"  maxlength="20" minlength="3" id="bfactura" style="text-transform:uppercase;">
            <br/>
            <label id="info"></label>
        </div>
    </div>
</div>
<br/>
<!--
<div class="row">
    <div class="col-lg-16">
        <div class="col-xs-16 col-md-6">
            <p><button class="btn btn-success" onclick="actAcr()" type="submit">Actualizar Informacion Maestros</button></p>
            <br/>
            <label id="info"></label>
        </div>
    </div>
</div>
-->
<div>
    <label>Hoy es <?php echo $dia.' '.date('d').' de '.$mes.' del '.$anio.'.'?></label>
</div>

<div>
  <label>Genera Ruta <?php count($doctos)?></label>
 <div class="col-lg-12">
        <div class="panel panel-default" id="">
            <div class="panel-heading">
                Rutas Activas para la Cartera<?php echo ':  '.$tipoUsuario?>
            </div>
<div class="panel-body">
  <div class="table-responsive">                            
  <table class="table table-bordered" >
    <tr>
      <th align="center">Dia</th>
      <th align="center">Incio</th>  
      <th align="center">Fin</th>
      <th align="center">Valor</th>
      <th>Cobrado</th>
      <th>Corte <br/> de Credito</th>
      <th>Estado</th>
      <th>Detalle</th>
      <th>Cedulas</th>
    </tr>
    <?php foreach($rutasActivas as $ract):?>
      <tr>
        <td><?php echo $ract->NOMBRE_DIA?></td>
        <td><?php echo $ract->FECHA_INICIAL?></td>
        <td><?php echo $ract->FECHA_FINAL?></td>
        <td><?php echo '$ '.number_format($ract->VALOR,2)?></td>
        <td><?php echo '$ '.number_format($ract->COBRADOS,2)?></td>
        <td><?php echo $ract->CORTE_CREDITO?></td>
        <td><?php echo $ract->STATUS?></td>
        <td><a onclick="verRuta(<?php echo $ract->IDR?>)">Detalle</a></td>
        <td><a onclick="verCedula(<?php echo $ract->IDR?>)">Ver Cedulas</a></td>
      </tr>
      <?php endforeach;?>
  </table>
</div>
</div>
</div>
</div>
</div>

<?php
    for($i=0; $i<7; $i++){
        if($i == 0){
            $l ='Lunes';
        }elseif($i == 1){
            $l ='Martes';
        }elseif($i == 2){
            $l ='Miercoles';
        }elseif($i == 3){
            $l ='Jueves';
        }elseif($i == 4){
            $l ='Viernes';
        }elseif($i == 5){
            $l ='Sabado';
        }elseif($i == 6){
            $l ='Domingo';
        }
?>
<div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h3 class="page-header"><?php echo $l?> </h3>
            </div>
            <?php foreach ($maestros as $m):?>
            <?php if(strpos($m->DIASD, $semana[$i])!== false){?>
                <div class="col-md-3">
                  <div class="panel panel-default">
                      <div class="panel-heading">
                          <h4 title="<?php echo $m->NOMBRE?>"><?php echo substr($m->NOMBRE,0,19)?></h4>
                          <h5><?php echo 'Clave: '.$m->CLAVE?></h5>
                          <h5><?php echo 'Cartera: '.$m->CARTERA.' Revision: '.$m->CARTERA_REVISION?></h5>
                      </div>
                      <div class="panel-body<?php echo $m->ID?>">
                          
                          <p title="Ver Centros de Credito del Maestro <?php echo $m->NOMBRE?>">
                            <a href="index.cobranza.php?action=verCCs&idm=<?php echo $m->ID?>&cvem=<?php echo  urlencode($m->CLAVE)?>" target="popup" onclick="window.open(this.href, this.target, 'width=1200, height=900')">Centros de Credito Activos: <?php echo $m->CCREDITO?></a>
                          </p>
                          <P><a href="index.cobranza.php?action=CarteraxCCC&clave=<?php echo urlencode($m->CLAVE_CC)?>&tipo=v" target="popup" onclick="window.open(this.href, this.target, 'width=1200, height=800'); return false;">Deuda Vencida:</a> <font color="blue"><?php echo '$ '.number_format($m->COBRANZA,2)?></font>
                          </P>

                          <P><a href="index.cobranza.php?action=CarteraxCCC&clave=<?php echo  urlencode($m->CLAVE_CC)?>&tipo=sv" target="popup" onclick="window.open(this.href, this.target, 'width=1200, height=800'); return false;">Deuda Sin Vencer:</a> <font color="green"><?php echo '$ '.number_format($m->REVISION,2)?></font>
                          </P>
                           <P><a href="index.cobranza.php?action=CarteraxCCC&clave=<?php echo  urlencode($m->CLAVE_CC)?>&tipo=t" target="popup" onclick="window.open(this.href, this.target, 'width=1200, height=800'); return false;">Total Deuda:</a> <font color="red"><?php echo '$ '.number_format($m->REVISION + $m->COBRANZA,2)?></font></P>
                          <p><?php if($m->RUTAS > 0){?>
                            <a href="index.cobranza.php?action=verRutasCob&idm=<?php echo $m->ID?>&cvem=<?php echo  urlencode($m->CLAVE)?>&t='rutas'" target="popup" onclick="window.open(this.href, this.target, 'width=1200, height=800'); return false;"><font color="blue">Ver Rutas</font> &nbsp;&nbsp;</a></p>
                          <?php }else{?>
                            <b>Sin Rutas</b>.
                          <?php }?>
                          <!--<center><a href="index.php?action=edoCta_docs" class="btn btn-default"></a></center>-->
                      </div>
                    </div>
                </div>

            <?php }?>
            <?php endforeach ?>
    </div>
</div>
<?php };?>


<div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h3 class="page-header"> Sin dias </h3>
            </div>
<?php foreach ($maestros as $sd):?>
<?php if($sd->DIASD=='N' or empty($sd->DIASD)){?>
                <div class="col-md-3">
                  <div class="panel panel-default">
                      <div class="panel-heading">
                          <h4 title="<?php echo $sd->NOMBRE?>"><?php echo substr($sd->NOMBRE,0,19)?></h4>
                          <h5><?php echo 'Clave: '.$sd->CLAVE?></h5>
                          <h5><?php echo 'Cartera: '.$sd->CARTERA.' Revision: '.$sd->CARTERA_REVISION?></h5>
                      </div>
                      <div class="panel-body">
                          <p title="Ver Centros de Credito del Maestro <?php echo $sd->NOMBRE?>">
                            <a href="index.cobranza.php?action=verCCs&idm=<?php echo $sd->ID?>&cvem=<?php echo $sd->CLAVE?>" target="popup" onclick="window.open(this.href, this.target, 'width=1200, height=900')">Centros de Credito: <?php echo $sd->CCREDITO?></a></p>
                          <P><a href="index.cobranza.php?action=CarteraxCliente&cve_maestro=<?php echo $sd->CLAVE?>&tipo=v" target="popup" onclick="window.open(this.href, this.target, 'width=1200, height=800'); return false;">Deuda Vencida:</a> <font color="blue"><?php echo '$ '.number_format($sd->COBRANZA,2)?></font></P>
                          <P><a href="index.cobranza.php?action=CarteraxCliente&cve_maestro=<?php echo $sd->CLAVE?>&tipo=sv" target="popup" onclick="window.open(this.href, this.target, 'width=1200, height=800'); return false;">Deuda Sin Vencer:</a> <font color="green"><?php echo '$ '.number_format($sd->REVISION,2)?></font></P>
                           <P><a href="index.cobranza.php?action=CarteraxCliente&cve_maestro=<?php echo $sd->CLAVE?>&tipo=t" target="popup" onclick="window.open(this.href, this.target, 'width=1200, height=800'); return false;">Total Deuda:</a> <font color="red"><?php echo '$ '.number_format($sd->REVISION + $sd->COBRANZA,2)?></font></P>
                          
                      </div>
                    </div>
                </div>
<?php }?>
<?php endforeach;?>
    </div>
</div>


<script src="//code.jquery.com/jquery-1.10.2.js"></script>
<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.0/themes/base/jquery-ui.css">
<link rel="stylesheet" href="/resources/demos/style.css">
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.0/jquery-ui.js"></script>
<script type="text/javascript">

    function verRuta(idr){
      window.open('index.cobranza.php?action=verRutaCobranza&idr='+idr, '_blank', 'width=1200, height=800')
    }

    function verCedula(idr){
      window.open('index.cobranza.php?action=verCedulas&idr='+idr, '_blank', 'width=1200, height=800')
    }

    $("#buscar").click(function(){
            var id = document.getElementById("docv").value;
            if(id ==""){
                alert("Favor de capturar un documento.");
            }else{
                $.ajax({
                    url:'index.php',
                    type:'post',
                    dataType:'json',
                    data:{buscaDocv:id},
                    success:function(data){
                        var seg;
                        if(data.st == 'no'){
                            var s = '<font color="red"> No se encontro informacion del documento:  </font>';
                            var mensaje = id;
                        }else if(data.st == 'ok'){
                            var ventana = "'width=1800,height=1200'";
                            var s = 'Se encontro la informacion: ';
                            var mes = data.fechaCaja.substring(5,7);;
                            var anio = data.fechaCaja.substring(0,4);
                            var dia = data.fechaCaja.substring(8,10);
                            var seg ='<a href="index.php?action=seguimientoCajasDiaDetalle&anio='+ anio + '&mes='+ mes +'&dia='+ dia+'"  class="btn btn-info" target="popup" onclick="window.open(this.href, this.target,'+ ventana +' ); return false;" > Ver Seguimiento de Documentos </a>';
                            var mensaje = '<br/>Caja: ' + data.caja + '<br/> fecha del consecutivo: ' + data.fechaCaja + seg +'<br/> Status logistica: ' + data.logistica + '<br/> Status de la caja: ' + data.status;
                        }
                        var midiv = document.getElementById('resultado');
                         midiv.innerHTML = "<br/><p><font size='5pxs' color='blue'>&nbsp;&nbsp; " + s + " </font> <font size='5pxs' color='red'>"+ mensaje + "</font></p>";
                        //("status"=>'ok',"resultado"=>'ok', "idstatus"=>$status, "idprov"=>'('.$proveedor.')'.$nomprov,"ordenado"=>$ordenado,"rec_faltante"=>$faltante,  "idpalterno"=>'('.$cvealt.')'.$nomalt,"Ordenes"=>$data);
                    }
                });
            }
        });

      function actAcr(){
            if(confirm('Este proceso tardara de 1 a 2 minutos')){
                $.ajax({
                    url:'index.cobranza.php',
                    type:'post',
                    dataType:'json',
                    data:{actAcr:1},
                    success:function(data){
                        alert(data.mensaje)
                        location.reload(true)
                    },
                    error:function(){
                        alert('Ocurrio un error favor de intentar mas tarde...')
                    }
                })
            }else{
                return false;
            }
        }


</script>
    