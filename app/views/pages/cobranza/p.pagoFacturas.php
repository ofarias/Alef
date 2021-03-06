<?php 
    foreach ($facturas as $data){
        $cliente = $data->CLAVE;
    }                         
?>
<?php if(count($facturas)>0 and ($y <= 1)){?>
<br>
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default"> 
            <div class="panel-heading">
                A P L I C A C I O N.  
            </div>
  <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover">
                                <?php 
                                    foreach ($pago as $key):
                                        $folio = $key->ID;
                                        $cep = $key->CEP;
                                ?>
                                    <form action="index.php" method="post">
                                        <label> El monto del pago es de: $ <?php echo number_format($key->MONTO,2)?> </label><br>
                                        <?php if(!empty($key->CF)){?>
                                            <label><font color="brown">Cargos Financieros <?php echo $key->CF?> por un monto de:<?php echo '$ '.$key->MONTO_CF?></font></label><br/>
                                        <?php }?>                                        
                                        <input type="hidden" name="idpago" value="<?php echo $key->ID?>">   
                                        <label> El saldo actual es de: $ <?php echo number_format($key->SALDO,2)?>   ---------->    </label>   <button name='imprimirComprobante' value="enviar" type="submit" class="btn btn-info">IMPRIMIR RELACION DEL PAGO</button><br> 
                                        <label> El total de monto aplicado es: $ <?php echo number_format($total,2)?></label><br>
                                    </form>
                                <?php endforeach; ?>
                                    <br/>
                                    <?php if($cep == 0){?>
                                    <p>Tipo de Pago: Transferencia:&nbsp;&nbsp;<input type="radio" name="tipoP" value="03" checked> 
                                                     &nbsp;&nbsp;Cheque:&nbsp;&nbsp;<input type="radio" name="tipoP" value="02">
                                                     &nbsp;&nbsp;Efectivo:&nbsp;&nbsp;<input type="radio" name="tipoP" value="01"> </p>
                                    <p>Cuenta Origen: <input type="text" name="cuentaO" id="ctaO" placeholder="Cuenta Origen"></p>
                                    <p>Numero de Operacion:<input type="text" name="numOpe" id="numope" placeholder="Numero de Operacion"></p>
                                    <p>Banco Origen: <select id="bancoO">
                                            <option value="0" >Seleccione un Banco Origen</option>
                                            <?php foreach($bancos as $banco){?>
                                                <option value="<?php echo $banco->CLAVE?>"><?php echo $banco->BANCO.'-->'.$banco->RFC?></option>
                                            <?php }?>
                                        </select>
                                    </p>
                                    <?php if(!empty($c)){?>
                                        <p><font color="red">Se creará la relación 04 (Cancela y Sustituye) con el <?php echo $c->FACTURA_ORIGINAL.' UUID ('.$c->UUID.')'?></font></p>
                                    <?php }?>
                                    <p id="boton">Generar Recibo Electronico de Pago<button class="btn btn-success" onclick="generaCEP('<?php echo $folio?>','<?php echo $cliente?>','<?php echo isset($c->FACTURA_ORIGINAL)? $c->FACTURA_ORIGINAL:'' ?>' )" >REP</button></p>
                                    <label> &nbsp; &nbsp; Pago de una Financiera o Banco ? &nbsp;&nbsp;&nbsp;<input type="checkbox" name="financiera" onchange="finan()" id ="fide"></label>
                                    
                                    <div class="hide" id="fin">
                                        <select name="financiera" id="sel">
                                            <option value="SS">Seleccione una financiera</option>
                                            <?php foreach ($fin as $data):?>
                                                <option value="<?php echo $data->ID?>"><?php echo $data->COMERCIAL.'('.$data->RFC.')  '.$data->NOMBRE ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                        <input type="button" value="Nueva" onclick="window.open('index.cobranza.php?action=verEntidades', '_blank', 'width=800,height=600'); return false">
                                        <input type="button" value="Actualizar" onclick="location.reload(true)">
                                    </div>

                                <?php }else{?>
                                    <div>
                                        <label>Descargar CEP <?php echo $cep?></label>
                                        <br/>
                                        <label><a onclick="cancelaCEP('<?php echo $cep?>',1,<?php echo $idp?>)">Cancelar CEP <?php echo $cep?></a></label>
                                    </div>
                                <?php }?>
                                </table>                                
                                     
                            </div>
                        </div>
                    </div>
    </div>
</div>
<br>
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default"> 
            <div class="panel-heading">
                R e l a c i o n ---  D e  ---   F a c t u r a s  ---   P a g a d a s.
            </div>
  <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>No.Aplicacion</th>
                                            <th>Clave</th>
                                            <th>CLIENTE</th>
                                            <th>Fecha Aplicacion</th>                                           
                                            <th>Documento</th>
                                            <th>Importe</th>
                                            <th>Saldo Documento</th>
                                            <th>Monto Aplicado</th>
                                            <th>Saldo Pago</th>
                                            <th>Usuario</th>
                                            <?php if($rol == 'cxcc'){?>
                                            <th></th>
                                            <?php }else{?>
                                            <th>Contabilizar</th>
                                            <?php }?>
                                           
                                        </tr>
                                    </thead>                                   
                                  <tbody>
                                        <?php 
                                        foreach ($facturas as $data):
                                            ?>
                                        <tr>
                                            <td><?php echo $data->ID;?><br/><input type="button" name="can" value="Cancelar" class="btn-small btn-danger" onclick="cApli(<?php echo $data->ID?>, '<?php echo $data->DOCUMENTO?>', <?php echo $folio?>)"></td>
                                            <td><?php echo $data->CLAVE?></td>
                                            <td><?php echo $data->CLIENTE;?></td>
                                            <td><?php echo $data->FECHA;?></td>
                                            <td><?php echo $data->DOCUMENTO.'<font color="red"> FP:'.$data->FORMADEPAGOSAT.'</font><font color="blue">MP:'.$data->METODODEPAGO.'</font><font color="green">USO:'.$data->USO_CFDI.'</font>';?></td>
                                            <td><?php echo '$ '.number_format($data->IMPORTE,2)?></td>
                                            <td><?php echo '$ '.number_format($data->SALDO_DOC,2);?></td>
                                            <td><?php echo '$ '.number_format($data->MONTO_APLICADO,2);?></td>
                                            <td><?php echo '$ '.number_format($data->SALDO_PAGO,2)?></td>
                                            <td><?php echo $data->USUARIO?></td>
                                            <form action="index.php" method="post">
                                            <?php if($rol== 'cxcc'){?>
                                            <td>
                                            
                                            </td>
                                            <?php }else{?>
                                            <td>
                                                <button type ="submit" value="enviar" name="contVenta" <?php echo ($data->CONTABILIZADO == 'OK')? "class='btn btn-success'":"class='btn btn-info'"?> <?php echo ($data->CONTABILIZADO == 'OK')? "disabled = 'disabled'":"" ?> > <?php echo ($data->CONTABILIZADO == 'OK')? 'Contabilizado':'Contabilizar' ?> </button>
                                            </td>
                                            <?php }?>
                                                 
                                            </form>
                                        </tr>
                                        
                                        <?php endforeach; ?>
                            
                                 </tbody>
                                </table>
                            </div>
                    </div>
                    </div>
    </div>
</div>
<?php }else{?>
        <br>
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default"> 
            <div class="panel-heading">
                A P L I C A C I O N.  
            </div>
  <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover">
                                <?php 
                                    foreach ($pago as $key):
                                        $folio = $key->ID;
                                        $maestro = $key->MAESTRO;
                                ?>
                                    <label> El monto del pago es de: $ <?php echo number_format($key->MONTO,2)?> </label><br>
                                    <label> El saldo actual es de: $ <?php echo number_format($key->SALDO,2)?>  <br> 
                                    <label> El total de monto aplicado es: $ <?php echo number_format($total,2)?></label><br>
                                    <label> Identificado para el Maestro <font color="blue"><?php echo $key->MAESTRO?></font>&nbsp;&nbsp;&nbsp;<a onclick="cambiaAsoc(<?php echo $folio?>)"><font color="#b3b3ff">Cambiar Asociaciona</font></a></label>
                                    <form action="upload_comprobante_pago_v2.php" method="post" enctype="multipart/form-data" id="formulario">
                                        <input type="file" name="fileToUpload" id="fileToUpload" required accept=".pdf" >
                                        <input type="hidden" name="idp" value="<?php echo $key->ID?>">
                                        <input type="hidden" name="saldop" value="<?php echo $key->SALDO?>">
                                        <input type="hidden" name="items" value="" id="item">
                                        <input type="hidden" name="total" value="" id="montoAplicar">
                                        <input type="hidden" name="retorno" value="aplicaPagoEdoCta">
                                        <label><input type="button" name="apli" id="aplicar" class="btn btn-info" value="Aplicar"></label>
                                        <input type="hidden" name="pa" id="pago" value="<?php echo $key->SALDO?>">
                                    </form>
                                <?php endforeach; ?>
                                <br/>
                                </table>                                                        
                            </div>
                        </div>
                    </div>
    <?php if(count($facturas) > 0 ){?>
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default"> 
                    <div class="panel-heading">
                        R e l a c i o n ---  D e  ---   Aplicaciones  ---   P a g a d a s.
                    </div>
          <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>No.Aplicacion</th>
                                            <th>Clave</th>
                                            <th>CLIENTE</th>
                                            <th>Fecha Aplicacion</th>
                                            <th>Documento</th>
                                            <th>Importe</th>
                                            <th>Saldo Documento</th>
                                            <th>Monto Aplicado</th>
                                            <th>Saldo Pago</th>
                                            <th>Usuario</th>
                                            <?php if($rol == 'cxcc'){?>
                                            <th></th>
                                            <?php }else{?>
                                            <th>Contabilizar</th>
                                            <?php }?>
                                        </tr>
                                    </thead>                                   
                                  <tbody>
                                        <?php 
                                        foreach ($facturas as $data):
                                    
                                            ?>
                                        <tr>
                                            <td><?php echo $data->ID;?><br/><input type="button" name="can" value="Cancelar" class="btn-small btn-danger" onclick="cApli(<?php echo $data->ID?>, '<?php echo $data->DOCUMENTO?>', <?php echo $folio?>)"></td>
                                            <td><?php echo $data->CLAVE?></td>
                                            <td><?php echo $data->CLIENTE;?></td>
                                            <td><?php echo $data->FECHA;?></td>
                                            <td><?php echo $data->DOCUMENTO.'<font color="red"> FP:'.$data->FORMADEPAGOSAT.'</font><font color="blue">MP:'.$data->METODODEPAGO.'</font><font color="green">USO:'.$data->USO_CFDI.'</font>';?></td>
                                            <td><?php echo '$ '.number_format($data->IMPORTE,2)?></td>
                                            <td><?php echo '$ '.number_format($data->SALDO_DOC,2);?></td>
                                            <td><?php echo '$ '.number_format($data->MONTO_APLICADO,2);?></td>
                                            <td><?php echo '$ '.number_format($data->SALDO_PAGO,2)?></td>
                                            <td><?php echo $data->USUARIO?></td>
                                            <form action="index.php" method="post">
                                            <?php if($rol== 'cxcc'){?>
                                            <td>
                                            </td>
                                            <?php }else{?>
                                            <td>
                                                <button type ="submit" value="enviar" name="contVenta" <?php echo ($data->CONTABILIZADO == 'OK')? "class='btn btn-success'":"class='btn btn-info'"?> <?php echo ($data->CONTABILIZADO == 'OK')? "disabled = 'disabled'":"" ?> > <?php echo ($data->CONTABILIZADO == 'OK')? 'Contabilizado':'Contabilizar' ?> </button>
                                            </td>
                                            <?php }?> 
                                            </form>
                                        </tr>
                                        <?php endforeach; ?>
                                 </tbody>
                                </table>
                            </div>
                    </div>
                    </div>
            </div>
        </div>
    <?php }?>

<label>Buscar Factura: </label><br/>
Factura: <input type="text" name="fact"  maxlength="20" minlength="3" id="bfactura" style="text-transform:uppercase;">
<br/>
<label id="info"></label>

<br/>
<label>Por Aplicar: </label><p id="xApl">$ 0.00</p>
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default"> 
            <div class="panel-heading">
               <p><font color="grey"><b>FACTURAS CON SALDO DEL MAESTRO</font> <?php echo $maestro?>.</b></p>
               <p><b>Se muestran solo las facturas con fecha anterior al pago.</b></p>
            </div>
                    <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>Ln</th>
                                            <th>Factura</th>
                                            <th>Fecha</th>
                                            <th>CLIENTE</th>
                                            <th>Importe</th>
                                            <th>Saldo</th>
                                            <th>Aplicar</th>
                                            <th>Saldo Insoluto</th>
                                            <th></th>
                                        </tr>
                                    </thead>                                   
                                  <tbody>
                                        <?php $ln=0;
                                            foreach ($facturasP as $data):
                                                $ln++;
                                            ?>
                                        <tr>
                                            <td><?php echo $ln?></td>
                                            <td><?php echo $data->CVE_DOC;?></td>
                                            <td><?php echo $data->FECHAELAB?></td>
                                            <td><?php echo $data->CLIENTE;?></td>
                                            <td><?php echo '$ '.number_format($data->IMPORTE,2);?></td>
                                            <td><?php echo '$ '.number_format($data->SALDOFINAL,2)?></td>
                                            <td><input type="number" step="any" name="montoAplicar" class="apl" ln="<?php echo $ln?>" saldo="<?php echo $data->SALDOFINAL?>" doc="<?php echo $data->CVE_DOC?>" ></td>
                                            <td><label id="saldoInsoluto_<?php echo $ln?>"></label></td>
                                            <td><?php echo 'Ver detalle de la factura'?></td>
                                        </tr>
                                        <?php endforeach; ?>
                                 </tbody>
                                </table>
                            </div>
                    </div>
                    </div>
    </div>
</div>

<?php }?>

<script type="text/javascript" language="JavaScript" src="app/views/bower_components/jquery/dist/jquery.min.js"></script>
<script type="text/javascript">

    $("#infoPago").mouseover(function(){
        alert('Informacion del pago');
    })

    $("#bfactura").change(function(){
        var docf = this.value;
        var info = '';
        var info2 = '';
        docf = docf.toUpperCase();
        alert("Se busca la factura" + docf);
        var list=document.getElementById("info");
        $.ajax({
            url:'index.cobranza.php',
            type:'post',
            dataType:'json',
            data:{traeFactura:docf},
            success:function(data){
                info= "<font color ='blue'>" +
                      "Factura: " + data.factura + "<br/>"+
                      "Cliente: " + data.cliente + "<br/>"+
                      "Fecha: " + data.fecha + "<br/>"+
                      "Importe: " + data.importe + "<br/>"+
                      "Saldo: " + data.saldo + "<br/>"+
                      "Aplicado: " + data.aplicado + "<br/>"+
                      "Aplicacion: " + data.aplicacion + "<br/>"+
                      "Importe_nc: " + data.importe_nc + "<br/>"+
                      "Nc: " + data.nc + "<br/>"+
                      "PagoAplicado: " + data.pagoAplicado + "<br/>"+
                      "FolioBanco: " + data.folioBanco + "<br/>"+
                      "Maestro: " + data.maestro + "<br/>"+
                      "Cve_maestro: " + data.cve_maestro + "<br/>"+
                      "</font>";

                var x= '';
                var x1 = '';
                if(data.saldo <= 0){
                    factura = "'"+data.factura+"'";
                    x = '<th>Ver Aplicaciones</th>';
                    x1 = '<input type="button" value="Ver Aplicaciones" class="btn btn-info" onclick="verAplicaciones('+factura+')">'
                }
                var imp=data.importe;
                imp=String(imp).split(".")
                imp=format(imp);

                var sal=data.saldo;
                sal=String(sal).split(".")
                sal=format(sal)

                var apl=data.aplicado
                apl=String(apl).split(".")
                apl=format(apl)

                var impnc=data.importe_nc
                impnc=String(impnc).split(".")
                impnc=format(impnc)

                info2=  '<div class="row">'+
                            '<div class="col-lg-12">'+
                                '<div class="panel panel-default">'+ 
                                    '<div class="panel-heading">'+
                                        'Informacion de Factura'+
                                    '</div>'+
                        '<div class="panel-body">' +
                            '<div class="table-responsive">'+
                                '<table class="table table-striped table-bordered table-hover">'+
                                    '<thead>' +
                                        '<tr>'+
                                            '<th>Factura</th>'+
                                            '<th>Cliente</th>'+
                                            '<th>Fecha</th>'+
                                            '<th>Importe</th>'+
                                            '<th>Saldo</th>'+
                                            '<th>Aplicado</th>'+
                                            '<th>Aplicacion</th>'+
                                            '<th>Importe NC</th>'+
                                            '<th>NC</th>'+
                                            '<th>Pago Aplicado</th>'+
                                            '<th>Folio Banco</th>'+
                                            '<th>Clave <br/> Maestro</th>'+
                                            '<th>Nombre <br/> Maestro</th>'+
                                            x + 
                                        '</tr>'+
                                        '<tbody>'+
                                            '<tr>'+
                                            '<td>' + data.factura + '</td>'+
                                            '<td>' + data.cliente + '</td>'+
                                            '<td>' + data.fecha + '</td>'+
                                            '<td>' + imp + '</td>'+
                                            '<td>' + sal + '</td>'+
                                            '<td>' + apl + '</td>'+
                                            '<td>' + data.aplicacion + '</td>'+
                                            '<td>' + impnc + '</td>'+
                                            '<td>' + data.nc + '</td>'+
                                            '<td>' + data.pagoAplicado + '</td>'+
                                            '<td>' + data.folioBanco + '</td>'+
                                            '<td>' + data.cve_maestro + '</td>'+
                                            '<td>' + data.maestro + '</td>'+
                                            '<td>' + x1 + '</td>' +
                                        '</tbody>'+
                                    '</tr>'+
                                    '</thead>'+
                                '</table>'+
                            '</div>'+
                        '</div>'+
                    '</div>'+
                '</div>'+
            '</div>';         
            list.innerHTML=info2;    
            }, 
            error:function(data){
                list.innerHTML="<br/><p>No se encontro Informacion de la Factura <font color='blue'>"+ docf +"</font>, favor de revisar la informacion. </p>";
            }
        })
    })

    function verAplicaciones(docf){
        alert('Ver las aplicaciones de la factura ' + docf);
        window.open("index.cobranza.php?action=verAplicacion&docf="+docf, "popup", 'width=1220,height=600');
    }

    function cambiaAsoc(idp){
        if(confirm('Desea cambiar la asociacion a otro maestro?')){
            window.open("index.cobranza.php?action=verAsociacion&idp="+idp, "popup", 'width=820,height=420');
            return false;
        }else{
            alert('no quizo');
        }
    }

    function cApli(ida, doc, idp){
        if(confirm('Desea Cancelar la aplicacion ' + ida + ' del documento ' + doc +' ?')){
            $.ajax({
                url:'index.cobranza.php',
                type:'post',
                dataType:'json',
                data:{cancelaAplicacion:ida, doc, idp},
                success:function(data){ 
                    alert(data.mensaje);
                    location.reload();
                },
                error:function(data){
                    alert(data.mensaje);
                    location.reload();
                },
                async:true
            })
        }else{
            return false;
        }
    }


    function cancelaCEP(cep, ida, idp ){
        if(confirm('Desea Cancelar el CEP' + cep)){
            $.ajax({
                url:'index.cobranza.php',
                type:'post',
                dataType:'json',
                data:{cancelaCEP:cep, ida, idp},
                success:function(data){
                    alert(data.mensaje);
                    location.reload();
                },
                error:function(data){
                    alert(data.mensaje);
                    location.reload();
                },
                async:false
            });
        }else{
            return;
        }
    }

    $("#aplicar").click(function(){
        var form = document.getElementById('formulario');
        if(form.elements[0].value == ""){
            alert("Es necesario colocar el Comprobante de pago.");
            return;
        }
        var montoPago = parseFloat(document.getElementById('pago').value,2);
        var monto = 0;
        var a = 0;
        var reg= "";
        $(".apl").each(function(index){
            a = this.value;
            var saldoDoc= parseFloat($(this).attr('saldo'));
            if(a == ""){
                a=0;
            }else{
                a=parseFloat(this.value,2);
                reg = reg + ': Doc ' + $(this).attr("doc") + ' Saldo ' + saldoDoc + ' aplicacion ' + a ;
            }
            monto+=parseFloat(a,2);
        })
        reg = reg.substring(1);
        var saldo = montoPago - monto;
        if(monto == 0){
            alert('Favor de aplicar algo');
            return;
        }
        if(monto >(montoPago + 1)){
            alert('El monto que selecciono para la aplicacion es mayor al pago, favor de revisar la informacion');
            return;
        }else if(confirm('Se aplicaran ' + monto +  ' del saldo del pago ' + montoPago + ' quedara un saldo de ' + saldo )){
            alert('Se asigna el pago a las facturas' + reg);
            document.getElementById('item').value=reg;
            document.getElementById('montoAplicar').value=monto;
            form.submit();
            //var folios = '';
            //$("input:checked").each(function(index){
            //    folios+= this.value+",";
            //});
            //    folios = folios.substr(0, folios.length-1);
            //if(folios.length > 0){
            //    if(confirm('El Valor de la factura '))
            //        if(confirm('Desea Aplicar el pago a las facturas '+folios+' ?, por un monto de ' + monto)){
            //            $("input:checked").each(function(index){
            //                folios+= this.value+",";
            //            });
            //        folios = folios.substr(0, folios.length-1);
            //}else{
            //    return;
            //}    
            //}else{
            //    alert('Debe de seleccionar por lo menos un documento');
            //}
        }        
            
        //console.log("FOLIOS: "+folios);
        //items.val(folios);       
        //$("#FORM_ACTION").submit()
    })

    $(".apl").change(function(){
        //alert('Cambio el monto en la aplicacion');
        var montoPago = parseFloat(document.getElementById('pago').value,2);
        var monto = 0.0001;
        var a = 0.0001;
        var reg= "";
        $(".apl").each(function(index){
            a=this.value;
            lin=$(this).attr('ln');
            var saldoDoc= parseFloat($(this).attr('saldo'));
            if(a == ""){
                a=0.0001;
                document.getElementById('saldoInsoluto_'+lin).innerHTML='';
            }else{
                a=parseFloat(this.value,2);
                reg = reg + 'Doc:' + $(this).attr("doc") + ' Saldo ' + saldoDoc + ' aplicacion ' + a + ':';
                var saldoInsoluto = (parseFloat(saldoDoc) - parseFloat(a)) + .0001;
                saldoInsoluto=String(saldoInsoluto).split(".");
                //alert('Numero a formatear' + saldoInsoluto);
                var s = format(saldoInsoluto);
                document.getElementById('saldoInsoluto_'+lin).innerHTML=s;
            }
            var montoTexto = String(monto).split(".");
            //alert('Numero a formatear' + montoTexto);
            montoTexto = format(montoTexto);
            monto+=parseFloat(a,2);
            document.getElementById('xApl').innerHTML='Suma por aplicar: '+ montoTexto;
           
        })
        if(monto > (montoPago + 1)){
            alert('El monto que selecciono para la aplicacion es mayor al pago, favor de revisar la informacion' + reg );

            return;
        }
    })

    function format(numero){
            var long = numero[0].length;
            var cent = numero[1].substring(0,3);
            if(long > 6){
                var tipo = 'Millones';
                if (long == 9){
                    var mill = 3;
                }else if(long == 8){
                    var mill = 2;
                }else if(long == 7){
                    var mill = 1
                }
                var millones = numero[0].substring(0,mill);
                var miles = numero[0].substring(mill, mill + 3 );
                var unidades = numero[0].substring(mill + 3, mill +6);
                var texto = '$  '+ millones + ',' + miles + ','+ unidades +'.' + cent;
            }else if(long > 3){
                if (long == 6){
                    var mill = 3;
                }else if(long == 5){
                    var mill = 2;
                }else if(long == 4){
                    var mill = 1
                }
                var millones = numero[0].substring(0,mill);
                var miles = numero[0].substring(mill, mill + 3 );
                var unidades = numero[0].substring(mill + 3, mill +6);
                var texto = '$  '+ millones + ',' + miles +'.' + cent;
            }else if(long > 0){
                if (long == 3){
                    var mill = 3;
                }else if(long == 4){
                    var mill = 2;
                }else if(long == 1){
                    var mill = 1
                }
                var millones = numero[0].substring(0,mill);
                var miles = numero[0].substring(mill, mill + 3 );
                var unidades = numero[0].substring(mill + 3, mill +6);
                var texto = '$  '+ millones +'.' + cent;
            }else if(long == 0){
                var tipo = 'Menos de peso';
                var texto = 'Entro: ' + tipo;
            }
            return (texto);
    } 
     
    function generaCEP(folio, idCliente, cep){
        var c = document.getElementById('fide');
        var fin = document.getElementById('sel').value;
        var ctao = document.getElementById('ctaO').value; 
        var bancoo = document.getElementById('bancoO').value;
        var tipo = document.getElementsByName("tipoP");
        var numope = document.getElementById("numope").value; 
        if( ctao.length >= 10 || ctao.length== 0){
            if(ctao.length >0){
                alert("La cuenta Origen es" + ctao);
            }else{
                if(confirm("No se coloco ninguna cuenta, desea continuar?")){

                }else{
                    return;
                }
            }
        }else{
            return alert("Solo se permiten 10 o mas digitos favor de revisar los datos..." );
        }

            if(confirm("Desea Continuar con los datos capturados?")){
            
            for(var i=0;i<tipo.length;i++){
            
            if(tipo[i].checked)
                    tipoO=tipo[i].value;
            }
            
            if(c.checked && fin == 'SS' ){
                return alert('Usted debe seleccionar una financiera');
            }else if(c.checked && fin != 'SS'){
                idCliente = 'F'+fin;
            }
            if(confirm('Desea realizar el REP del pago '+ folio +' para el cliente ' + idCliente + 'Banco ' + bancoo)){
                alert('Se realiza el CEP');
                $.ajax({
                    url:'index.cobranza.php',
                    type:'POST',
                    dataType:'json',
                    data:{generaCEPPago:folio, idCliente, ctao, bancoo, tipoO, numope, cep:cep},
                    success:function(data){
                        document.getElementById("boton").innerHTML="<a href='/Facturas/FacturasJson/"+data.archivo+".pdf' download> <img border='0' src='app/views/images/pdf.jpg' width='25' height='30'></a> <a href='/Facturas/FacturasJson/"+data.archivo+".xml' download> <img border='0' src='app/views/images/xml.jpg' width='25' height='30'></a>";
                    }
                });
            }else{
                alert('No se genero el CEP');
            }
        }else{
            return("No se elaboro ningun Complemento");
        }
    }

    function finan(){
        var c = document.getElementById('fide');
        if(c.checked){
            alert('El recibo se realizara al nombrede una Financiera');
            document.getElementById("fin").classList.remove("hide");    
        }else{
            document.getElementById("fin").classList.add("hide");
        }
    }

</script>

