<br /><br />
<div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                           Detalle de la Ruta de Cobranza.
                        </div>
                        <!-- /.panel-heading -->
                           <div class="panel-body">
                            <div class="table-responsive">                            
                                <table class="table table-striped table-bordered table-hover" id="dataTables-RecibirLogistica">
                                    <thead>
                                        <tr>
                                            <th>Ln</th>
                                            <th>Maestro</th>
                                            <th>Cliente</th>
                                            <th>Documento</th>
                                            <th>Fecha</th>
                                            <th>Fecha <br/> Contra Recibo</th>
                                            <th>Vencimiento</th>
                                            <th>Importe</th>
                                            <th>Saldo</th>
                                            <th>Cobrados</th>
                                            <th>Llamadas</th>
                                            <th>Visitas</th>
                                            <th>Correos</th>
                                            <th>Docs <br/> Gerencia</th>
                                            <th>Docs Corte<br/>  Credito</th>
                                        </tr>
                                    </thead>
                                  <tbody>
                                        <?php
                                        $i=0;
                                        foreach ($ruta as $data):  
                                        $i++;
                                        $color='';
                                        $caja = '';

                                        if(!empty($data->CAJA)){
                                            $x = strlen($data->CAJA);
                                            $caja = substr($data->CAJA,0,($x-3));
                                        }
                                        $val = $data->DET_LLAMADAS + $data->DET_VISITAS + $data->DET_CORREOS + $data->DET_GERENCIA + $data->DET_CORTE_CREDITO;
                                        if($data->SALDOFINAL <= 5 AND $val == 0 ){
                                            $color="style='background-color:#bcccff'";
                                        }elseif($data->SALDOFINAL <= 5){
                                            $color="style='background-color:#bcffe9'";
                                        }
                                        $cliente = $data->NOMBRE.' ('.$data->CVE_CLPV.')';
                                        ?>
                                       <tr class="odd gradeX" <?php echo $color;?> id="linea_<?php echo $i?>" >
                                            <td><?php echo $i?></td>
                                            <td><a href="index.cobranza.php?action=verRuta&tipo=M&param=<?php echo $data->CVE_MAESTRO?>&cartera=<?php echo $tipoUsuario?>&idr=<?php echo $idr?>"><font size="3pxs" ><b><?php echo $data->NOMBRE_MAESTRO;?></b></font></a></td>
                                            <td><a href="index.cobranza.php?action=verRuta&tipo=C&param=<?php echo $data->CVE_CLPV?>&cartera=<?php echo $tipoUsuario?>&idr=<?php echo $tipoUsuario?>&idr=<?php echo $idr?>"><font size="2.5pxs" color="#D78F5A" ><b><?php echo $data->NOMBRE.'('.$data->CVE_CLPV.') <br/><font color="black"> Plazo: '.$data->PLAZO.'</font>';?></b></font></a></td>
                                            <td><a href="index.php?action=verComprobantesRecibo&idc=<?php echo $caja ?>" target="_blank" ><font color="red" size="3pxs"><b><?php echo $data->DOCUMENTO;?></b></font></a>
                                            </td>
                                            <td><?php echo $data->FECHAELAB;?></td>
                                            <td><?php echo $data->FECHA_INI_COB.'<br/><b>'.$data->CONTRARECIBO.'<b/>';?></td>
                                            <td align="center"><font color="red"><?php echo $data->VENCIMIENTO;?></font></td>
                                            <td align="cenhttp://localhost:8888/pegasoFTC/index.php?action=inicioter"><b><?php echo '$ '.number_format($data->IMPORTE,2);?></b></td>
                                            <td align="center"><font color="red" size="3pxs"><b><?php echo '$ '.number_format($data->SALDOFINAL,2);?></b></font></td>
                                            <td align="center"><?php echo '$ '.number_format($data->COBRADOS,2);?></td>
                                            <td align="center"><?php echo $data->LLAMADAS;?></td>
                                            <td align="center"><?php echo $data->VISITAS;?></td>
                                            <td align="center"><?php echo $data->CORREOS;?></td>
                                            <td align="center"><?php echo $data->GERENCIA;?></td>
                                            <td align="center"><?php echo $data->CORTE_CREDITO;?></td>
                                        </tr>
                                        <?php endforeach; ?>
                                 </tbody>
                                 </table>
                      </div>
            </div>    
        </div>
    </div>
</div>
<?php if(empty($tareasH)){?>
<?php }else{?>
<br /><br />
<div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                          Historico de Tareas Realizadas de los documentos seleccionados:
                        </div>
                        <!-- /.panel-heading -->
                           <div class="panel-body">
                            <div class="table-responsive">                            
                                <table class="table table-striped table-bordered table-hover" id="dataTables-RecibirLogistica">
                                    <thead>
                                        <tr>
                                            <th>Ln</th>
                                            <th>IDA</th>
                                            <th>Documento</th>
                                            <th>Fecha</th>
                                            <th>Tipo</th>
                                            <th>Usuario</th>
                                            <th>Resultado</th>
                                            <th>Estado</th>
                                        </tr>
                                    </thead>
                                  <tbody>
                                        <?php
                                        $i=0;
                                        foreach ($tareasH as $data):  
                                        $i++;
                                        $color="style='background-color:#D0EC86'";
                                        $caja = '';
                                        if(!empty($data->CAJA)){
                                            $caja = substr($data->CAJA,0,5);
                                        }
                                        ?>
                                       <tr class="odd gradeX" <?php echo $color;?> id="linea_<?php echo $i?>" >
                                            <td><?php echo $i?></td>
                                            <td><b><?php echo $data->IDA;?></b></td>
                                            <td><?php echo $data->DOCUMENTO;?></td>
                                            <td><?php echo $data->FECHAELAB;?></td>
                                            <td align="center"><font color="red"><?php echo $data->TIPO_ACTIVIDAD;?></font></td>
                                            <td align="center"><b><?php echo $data->USUARIO;?></b></td>
                                            <td align="center"><a href="index.cobranza.php?action=traeResultado&ida=<?php echo $data->IDA?>" target="_blank" onclick="window.open(this.href, this.target, 'width=1200,height=820'); return false;">Ver Resultado</a></td>
                                            <td align="center"><?php echo $data->STATUS;?></td>
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

<?php if(empty($tareasA)){?>
<?php }else{ ?>
<div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                          Tareas Pendientes en la ruta Actual de los documentos seleccionados:
                        </div>
                        <!-- /.panel-heading -->
                           <div class="panel-body">
                            <div class="table-responsive">                            
                               <table class="table table-striped table-bordered table-hover" id="dataTables-RecibirLogistica">
                                    <thead>
                                        <tr>
                                            <th>Ln</th>
                                            <th>IDA</th>
                                            <th>Documento</th>
                                            <th>Fecha</th>
                                            <th>Tipo</th>
                                            <th>Usuario</th>
                                            <th>Ejecutar</th>
                                        </tr>
                                    </thead>
                                  <tbody>
                                        <?php
                                        $i=0;
                                        foreach ($tareasA as $data):  
                                        $i++;
                                        $color="style='background-color:#CBF2FB'";
                                        $caja = '';
                                        if(!empty($data->CAJA)){
                                            $caja = substr($data->CAJA,0,5);
                                        }
                                        ?>
                                       <tr class="odd gradeX" <?php echo $color;?> id="linea_<?php echo $i?>" >
                                            <td><?php echo $i?></td>
                                            <td align="center"><b><?php echo $data->IDA;?></b></td>
                                            <td><?php echo $data->DOCUMENTO;?></td>
                                            <td align="center"><?php echo $data->FECHAELAB;?></td>
                                            <td align="center"><font color="red"><?php echo $data->TIPO_ACTIVIDAD;?></font></td>
                                            <td align="center"><b><?php echo $data->USUARIO;?></b></td>
                                            <td><a href="index.cobranza.php?action=traeResultado&ida=<?php echo $data->IDA?>" target="pop-up" onclick="window.open(this.href, this.target, 'width=1200,height=820'); return false;">Ejecutar</a></td>
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


<br /><br />
<!--
<div class="row">
                <div class="col-lg-4">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                          Realizar Nueva Tarea:
                        </div>
                      <br/>
                      <p><b>Llamar al cliente</b>&nbsp;&nbsp;&nbsp;<button id="llamadaNueva" class="btn btn-info">+</button> </p>  
                      <p><b>Envio de correo Electronico</b> &nbsp;&nbsp;&nbsp;<button id="correoNuevo" class="btn btn-info">+</button> </p>  
                      <p><b>Subir al Portal</b>&nbsp;&nbsp;&nbsp;<button id="subirPortal" class="btn btn-info">+</button>  </p>  
                      <p><b>Cita con el Cliente</b>&nbsp;&nbsp;&nbsp;<button id="visitaNueva" class="btn btn-info">+</button>  </p>  </p>  
                      <p><b>Apoyo con Ventas</b></p>  
                      <p><b>Reportar a Gerencia CxC</b></p>  
                      <p><b>Recibir Pago (Ficha de Deposito)</b></p>  
                    </div>
    </div>
</div>
-->
<form>
    <input type="hidden" name="cliente" value="<?php echo $cliente?>" id="cliente">
    <input type="hidden" name="nparam" value="<?php echo $param?>" id="param">
    <input type="hidden" name="ncartera" value="<?php echo $cartera?>" id="cartera">
    <input type="hidden" name="nidr" value="<?php echo $idr?>" id="idr">
    <input type="hidden" name="ntipo" value="<?php echo $t?>" id="tipo">

</form>
<script src="//code.jquery.com/jquery-1.10.2.js"></script>
<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.0/themes/base/jquery-ui.css">
<link rel="stylesheet" href="/resources/demos/style.css">
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.0/jquery-ui.js"></script>
<script type="text/javascript">
    
    $(document).ready(function() {
        $(".date").datepicker({dateFormat: 'dd.mm.yy'});
    })
    
    $("#llamadaNueva").click(function(){ 
        var cliente = document.getElementById('cliente').value;
        var param = document.getElementById('param').value; 
        var cartera = document.getElementById('cartera').value; 
        var idr = document.getElementById('idr').value; 
        var t = document.getElementById('tipo').value;
        var tipo2 = 'Llamada';
            $.confirm({
            columnClass: 'col-md-8',
            title: 'Llamada Nueva',
            content: 'Datos de la llamada ' + 
            '<form action="index.cobranza.php" class="formName">' +
            '<div class="form-group">'+
            'Nombre del cliente: '+cliente+ '<br/>'+
            'Telefono : <br/><input name="telefono" type="text" placeholder="Numero Telefonico " size="80" class="tel"> <br/>'+
            'Contacto Inicial: <br/> <input name="pi" type="text" placeholder="Persona  la que se le llama" size="100" class="cini"> <br/>'+
            'Contacto Final: <br/> <input name="ph" type="text" placeholder="Persona con la que se habló" size="100" class="cfin" "> <br/>'+
            'Resultado: <br/><textarea  placeholder="Resultado de la llamada" class="res" rows="4" cols="50"> </textarea><br/>' +
            '<br/><b>Programar Nueva llamada: <b/><br/><br/>' +
            'Fecha:<br/><input name="fprog" class="fp" type="date" placeholder="Fecha de llamada" size="15" class="date"> Utilizar Formato dd.mm.aaaa <br/>'+
            'Hora: <br/> <input name="hProg" class="hp" type="time" placeholder="Hora de la llamada" size="15" class="col"> <br/>'+
            '</div><br/><br/>'+
            '</form>',
                buttons: {
                formSubmit: {
                text: 'Guardar y Programar',
                btnClass: 'btn-blue',
                action: function () {
                    //var cliente = this.$content.find('.cl').val();
                    var tel = this.$content.find('.tel').val();
                    var cini = this.$content.find('.cini').val();
                    var cfin = this.$content.find('.cfin').val();
                    var res =this.$content.find('.res').val();
                    var fp = this.$content.find('.fp').val();
                    var hp = this.$content.find('.hp').val(); 
                    //var maestr = this.$content.find('mae').val(); 
                    if(tel==''){
                        $.alert('Debe de colocar el numero al que marco...');
                        return false;
                    }else if(cini== ''){
                        $.alert('Debe de colocar el nomnbre a quien llamo...');
                        return false;   
                    }else if(cfin== ''){
                        $.alert('Debe de colocar el nombre de con quien hablo...');
                        return false;   
                    }else if( res== ''){
                        $.alert('Debe de colocar el Resultado de la Llamada...');
                        return false;   
                    }else{
                        if(confirm('Se guardara la llamada con la informacion capturada.')){
                            $.ajax({
                            url:'index.cobranza.php',
                            type:'post',
                            dataType:'json',
                            data:{creaLlamada:1, tel, cini, cfin, res, fp, hp, param, cartera, idr, t, tipo2},
                            success:function(data){
                                alert('Se guardo la informacion');
                            },
                            error:function(data){
                                alert('Ocurrio un error, revise la informacion');
                            }
                            });    
                        }else{
                            return false;
                        }
                        
                    }
                   }
            },
            cancelar: function () {
            },
        },
        onContentReady: function () {
            // bind to events
            var jc = this;
            //alert(jc);
            this.$content.find('form').on('submit', function (e) {
                // if the user submits the form by pressing enter in the field.
                e.preventDefault();
                jc.$$formSubmit.trigger('click'); // reference the button and click it
            });
        }
    });
    })


  $("#correoNuevo").click(function(){ 
        var cliente = document.getElementById('cliente').value;
        var param = document.getElementById('param').value; 
        var cartera = document.getElementById('cartera').value; 
        var idr = document.getElementById('idr').value; 
        var t = document.getElementById('tipo').value;
        var tipo2 = 'Correo';
            $.confirm({
            columnClass: 'col-md-10',
            title: 'Enviar Correo Electronico',
            content: 'Datos del Correo' + 
            '<form action="index.cobranza.php" class="formName">' +
            '<div class="form-group">'+
            'Nombre del cliente: '+cliente+ '<br/>'+
            '<b>Para enviar a varios correos, favor de separar con "," coma, ejemplo: correo1@hotmail.com, correo2@gmail.com <br/>'+
            'Predeterminadamente se enviara copia al usuario de Cobranza<b/>' +
            'Correo : <br/><input name="email" type="email" multiple placeholder="Correo Electronico" size="100" class="cor"> <br/>'+
            'Mensaje: <br/> <textarea placeholder="Persona  la que se le llama" class="men" rows="4" cols="50"> </textarea><br/><br/>'+
            'Incluir Archivos XML y PDF: <input name="ph" type="checkbox" class="adj" "> <br/>'+
            '</div><br/><br/>'+
            '</form>',
                buttons: {
                formSubmit: {
                text: 'Enviar Correo',
                btnClass: 'btn-blue',
                action: function () {
                    //var cliente = this.$content.find('.cl').val();
                    var correo = this.$content.find('.cor').val();
                    var mensaje = this.$content.find('.men').val();
                    var adjuntos = this.$content.find('.adj');
                    var cfin='';
                    var fp='';
                    var hp=''; 
                    //var maestr = this.$content.find('mae').val(); 
                    if($('.adj').prop('checked')){
                        adjuntos = 1;
                    }else{
                        adjuntos = 0;

                    }
                    if(correo==''){
                        $.alert('Debe de colocar un correo electronico...');
                        return false;
                    }else if(mensaje== ''){
                        $.alert('Debe de colocar mensaje del correo...');
                        return false;   
                    }else{
                        if(confirm('Se enviara el correo electronico.')){
                            $.ajax({
                            url:'index.cobranza.php',
                            type:'post',
                            dataType:'json',
                            data:{creaLlamada:1, tel:correo, cini:adjuntos, cfin, res:mensaje, fp, hp, param, cartera, idr, t, tipo2},
                            success:function(data){
                                alert('Se guardo la informacion');
                            },
                            error:function(data){
                                alert('Ocurrio un error, revise la informacion');
                            }
                            });    
                        }else{
                            return false;
                        }
                        
                    }
                   }
            },
            cancelar: function () {
            },
        },
        onContentReady: function () {
            // bind to events
            var jc = this;
            //alert(jc);
            this.$content.find('form').on('submit', function (e) {
                // if the user submits the form by pressing enter in the field.
                e.preventDefault();
                jc.$$formSubmit.trigger('click'); // reference the button and click it
            });
        }
    });
    })

  $("#visitaNueva").click(function(){ 
        var cliente = document.getElementById('cliente').value;
        var param = document.getElementById('param').value; 
        var cartera = document.getElementById('cartera').value; 
        var idr = document.getElementById('idr').value; 
        var t = document.getElementById('tipo').value;
        var tipo2 = 'Cita';
            $.confirm({
            columnClass: 'col-md-10',
            title: 'Subir al Portal',
            content: 'Cita con el cliente' + 
            '<form action="index.cobranza.php" class="formName">' +
            '<div class="form-group">'+
            'Nombre del cliente: '+cliente+ '<br/>'+
            'Cita con : <br/><input name="contacto" type="text" placeholder="Nombre del contacto" size="100" class="con"> <br/>'+
            'Asunto: <br/> <textarea class="asu" rows="4" cols="50"></textarea><br/><br/>'+
            'Fecha de la Cita: <input name="cita" type="date" class="fec"> <br/>'+
            'Hora de la Cita: <input name="hora" type="time" class="hor"><br/>'+
            'Direccion: <input name="direccion" type="text" class="dir" size="150"><br/>'+
            '</div><br/><br/>'+
            '</form>',
                buttons: {
                formSubmit: {
                text: 'Crear Cita',
                btnClass: 'btn-blue',
                action: function () {
                    //var cliente = this.$content.find('.cl').val();
                    var contacto = this.$content.find('.con').val();
                    var asunto = this.$content.find('.asu').val();
                    var fecha = this.$content.find('.fec').val();
                    var hora=this.$content.find('.hor').val();
                    var direccion=this.$content.find('.dir').val();
                    var hp=''; 
                    var cfin = '';
                    //var maestr = this.$content.find('mae').val(); 
                    if(contacto==''){
                        $.alert('Debe de colocar el nombre del contacto...');
                        return false;
                    }else if(asunto== ''){
                        $.alert('Debe de colocar el asunto de la cita...');
                        return false;   
                    }else if(fecha== ''){
                        $.alert('Debe de colocar una fecha...');
                        return false;   
                    }else if(hora == ''){
                        $.alert('Debe de colocar una hora...');
                        return false;   
                    }else if(direccion== ''){
                        $.alert('Debe de colocar la direccion...');
                        return false;   
                    }else{
                        if(confirm('Se genera la cita.')){
                            $.ajax({
                            url:'index.cobranza.php',
                            type:'post',
                            dataType:'json',
                            data:{creaLlamada:1, tel:contacto, cini:direccion, cfin, res:asunto, fp:fecha, hp:hora, param, cartera, idr, t, tipo2},
                            success:function(data){
                                alert('Se guardo la informacion');
                            },
                            error:function(data){
                                alert('Ocurrio un error, revise la informacion');
                            }
                            });    
                        }else{
                            return false;
                        }
                        
                    }
                   }
            },
            cancelar: function () {
            },
        },
        onContentReady: function () {
            // bind to events
            var jc = this;
            //alert(jc);
            this.$content.find('form').on('submit', function (e) {
                // if the user submits the form by pressing enter in the field.
                e.preventDefault();
                jc.$$formSubmit.trigger('click'); // reference the button and click it
            });
        }
    });
    })
</script>