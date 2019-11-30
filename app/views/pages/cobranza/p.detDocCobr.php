<br />
<div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Maestro   
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
                                            <th>Notas de Credito</th>
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
                                            <td><?php echo $data->DOCUMENTO;?><br/><button>Saldar</button></td>
                                            <td><?php echo $data->FECHAELAB;?></td>
                                            <td align="right"><?php echo '$ '.number_format($data->IMPORTE,2);?></td>
                                            <td align="right"><?php echo '$ '.number_format($data->APLICADO,2)?></td>
                                            <td align="right"><?php echo '$ '.number_format($data->IMPORTE_NC,2)?></td> 
                                            <td align="right"><?php echo '$ '.number_format($data->SALDOFINAL,2)?></td> 
                                            <td>
                                              <?php if($data->SALDOFINAL >= 5){?>
                                              <select class="selCierre">
                                                <option value="<?php echo $data->ID?>:s"> Seleccione el tipo de Cierre</option>
                                                <option value="<?php echo $data->ID?>:pp"> Fecha Promesa de Pago</option>
                                                <option value="<?php echo $data->ID?>:sc"> Solicitar Corte de Credito</option>
                                                <option value="<?php echo $data->ID?>:sr"> Solicitar Restriccion De Credito</option>
                                              </select>
                                            <?php }else{?>
                                              <input type="button" value="Cerrar" class="btncerrar" id="<?php echo $data->ID?>">
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

    $(".bntcerrar").click(function(){
      alert('cerrar el documento')
    })

    $(".selCierre").change(function(){
      var val = $(this).val()
      alert('Cambio a ' + val)
    })
</script>