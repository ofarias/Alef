<br />
<div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Documentos en Cobranza  
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>Nombre <br/> Clave</th>
                                            <th>Docuemnto</th>
                                            <th>Fecha</th>
                                            <th>Importe</th>
                                            <th>Aplicaciones</th>
                                            <th>Notas de Credito <br/> Refactura</th>
                                            <th>Saldo </th>
                                            <th>Gestion</th>
                                        </tr>
                                    </thead>                                   
                                  <tbody>
                                        <?php 
                                        foreach ($docs as $data): 
                                            
                                        ?>
                                        <tr class="odd gradeX" >
                                            <td><?php echo $data->NOMBRE.'<br/>'.$data->CVE_CLPV;?></td>
                                            <td><?php echo $data->DOCUMENTO;?></td>
                                            <td><?php echo $data->FECHAELAB;?></td>
                                            <td align="right"><?php echo '$ '.number_format($data->IMPORTE,2);?></td>
                                            <td align="right"><?php echo '$ '.number_format($data->APLICADO,2)?></td>
                                            <td align="right"><?php echo '$ '.number_format($data->IMPORTE_NC,2)?><br/><font color="red"><?php echo $data->REFACT?></font></td> 
                                            <td align="right"><?php echo '$ '.number_format($data->SALDOFINAL,2)?></td> 
                                            <td>
                                                <?php if($data->STATUS != 'C'){ ?>
                                                    <?php if($data->SALDOFINAL >= 5){?>
                                                      <select class="selCierre" doc="<?php echo $data->DOCUMENTO?>" idr="<?php echo $data->IDR?>">
                                                        <option value=""> Seleccione el tipo de Cierre</option>
                                                        <option value="Corte"> Solicitar Corte de Credito</option>
                                                        <option value="Rest"> Solicitar Restriccion De Credito</option>
                                                      </select>
                                                    <?php }else{?>
                                                      <input type="button" value="cerrar" class="btncerrar" id="<?php echo $data->ID?>" tipo="<?php echo isset($data->REFACT)? 'Refactura':'Cobrado' ?>" doc="<?php echo $data->DOCUMENTO?>" idr="<?php echo $data->IDR?>" >
                                                    <?php }?>
                                                <?php }else{?>
                                                <b><font color="blue"><?php echo strtoupper($data->STATUS_DOCUMENTO)?></font></b>
                                                <?php }?>
                                            </td> 
                                        </tr>
                                        </form>
                                        <?php endforeach; ?>
                                 </tbody>
                                </table>
                            </div>
                      </div>
            </div>
        </div>
</div>

<div class="hidden" id="obs">
  <b>Documento:</b> <p id="d"></p>
  <b>Tipo:</b> <p id="t"></p> 
  Observaciones: <input type="text" name="detalle" id="obse" size="150" maxlength="150" minlength="5" value=""><br/><br/>
  Fecha Promesa de Pago: <input type="date" name="fecha" id="f">  <br/>
  <input type="button" value="Cerrar" class="btncerrar">
</div>

<script type="text/javascript" language="JavaScript" src="app/views/bower_components/jquery/dist/jquery.min.js"></script>
<script type="text/javascript">

    $(".asociar").click(function(){
        var cliente=$(this).attr("cliente")
        var cc=$(this).attr("cc")
        var cvem=$(this).attr("cvem")
        var idm=$(this).attr("idm")
        if(confirm("Asociar"+ cliente)){
            $.ajax({
                url:'index.php',
                type:'post',
                dataType:'json',
                data:{asociaCC:1, cc, cliente, cvem, idm},
                success:function(data){
                    location.reload(true)
                },
                error:function(){
                }
            })

        }else{
            return false;
        }
    });

    var origen = '';
    var t = '';
    var d = '';
    var i = '';
    var o = '';
    var f = '';

    $(".btncerrar").click(function(){
        //alert('cerrar el documento')
        origen = $(this).val()
        if(origen == 'Cerrar'){         
            o = document.getElementById('obse').value
            f = document.getElementById('f').value
            if(o == '' || f == ''){
                alert('Capture una observacion o fecha valida')
                return false
            }
        }else{
            i = $(this).attr('idr')
            d = $(this).attr('doc')
            t = $(this).attr('tipo')
            o = ''    
        }
        a = execCierre(i, d, t, o, f)
    })

    function execCierre(i, d, t, o, f){
        //alert('Documento ' + d + ', i ' + i + ' Tipo: ' + t + ', Observacion' + o + ', Fecha: '+ f)
        //return
        $.ajax({
        url:'index.cobranza.php',
        type:'post',
        dataType:'json',
        data:{cerrarDoc:1, doc:d, tipo:t, idr:i, obs:o, fecha:f},
        success:function(data){
            location.reload(true)
        },
        error:function(){
            alert('Ocurrio un error')
        }
      })  
    }

    $(".selCierre").change(function(){
      t = $(this).val()
      //alert('Cambio a ' + val)
      d = $(this).attr('doc')
      i = $(this).attr('idr')
      document.getElementById('obs').classList.remove('hidden')
      document.getElementById('d').innerHTML= d
      document.getElementById('t').innerHTML= t
    })

</script>