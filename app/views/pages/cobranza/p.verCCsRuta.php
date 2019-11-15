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
                                            <th>Sucursales</th>
                                            <th>Cartera Revision</th>
                                            <th>Cartera Cobranza</th>
                                            <th>Centros de Compras</th>
                                            <th>Total CC</th>
                                        </tr>
                                    </thead>                                   
                                  <tbody>
                                        <?php 
                                        foreach ($maestro as $data): 
                                            $cvem = $data->CLAVE;
                                        ?>
                                        <tr class="odd gradeX" >
                                         <!--<tr class="odd gradeX" style='background-color:yellow;' >-->
                                            <td><?php echo $data->NOMBRE.'<br/>'.$data->CLAVE;?></td>
                                            <td><?php echo $data->SUCURSALES;?></td>
                                            <td><?php echo $data->CARTERA;?></td>
                                            <td><?php echo $data->CARTERA_REVISION;?></td>
                                            <td><?php echo $data->CCS?></td>
                                            <td><?php echo '$ '.number_format($data->TOTCCS,2)?></td> 
                                        </tr>
                                        </form>
                                        <?php endforeach; ?>
                                 </tbody>
                                </table>
                            </div>
                            <!-- /.table-responsive -->
                      </div>
            </div>
        </div>
</div>

<div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h3 class="page-header">
                </h3>
            </div>
            <?php foreach ($ccs as $m): ?>
              <?php if($m->RUTAS > 0 ){?>
                <div class="col-md-5">
                  <div class="panel panel-default">
                      <div class="panel-heading">
                          <h4 title="<?php echo $m->NOMBRE?>"><?php echo substr($m->NOMBRE,0,19)?></h4>
                          <h5><?php echo 'Identificador: '.$m->ID?></h5>
                          <h5><?php echo 'Dia Cobranza:'.$m->DIAS_PAGO?></h5>
                      </div>
                      <div class="panel-body">
                          <p title="Ver Centros de Credito del Maestro <?php echo $m->NOMBRE?>">
                          
                          <b>Contactos:&nbsp;&nbsp;</b>
                          <?php $ln=0;
                            foreach($contactos as $con):
                              $ln++;
                            ?>
                            <?php if($con->CCC == $m->ID){?>
                            <p><b><?php echo '&nbsp;&nbsp;&nbsp;&nbsp;'.$ln.'.-'.$con->NOMBRE.' '.$con->APELLIDO_P?></b></p>
                            <p><b><?php echo '&nbsp;&nbsp;&nbsp;&nbsp;'.' ('.$con->PUESTO.', '.$con->DEPTO.')'?></b></p>
                            <p><b><?php echo '&nbsp;&nbsp;&nbsp;&nbsp;'.substr($con->TELEFONO, 0, 12).'&nbsp;&nbsp;&nbsp;&nbsp;'.substr($con->CORREO, 0, 25) ?></b></p>
                            <?php }?>
                          <?php endforeach;?> 
                          </p>
                          <p><a href="index.cobranza.php?action=conCob&idm=<?php echo $idm?>&cvem=<?php echo $cvem?>&ccc=<?php echo $m->ID?>" target="_blank" onclick="window.open(this.href, this.target, 'width=1200,height=820'); return false;" ><font color="blue">Administrar</font></a></p>
                          <P><b>Linea de Credito:&nbsp;&nbsp;</b><font color="green"><?php echo '$ '.number_format($m->LINEA_CRED,2)?></font></P>
                           <P><a href="index.cobranza.php?action=CarteraxCliente&cve_maestro=<?php echo $m->ID?>&tipo=ccd" target="_blank" onclick="window.open(this.href, this.target, 'width=1200, height=800'); return false;"><b>Total Deuda:&nbsp;&nbsp;</b></a><font color="red"><?php echo '$ '.number_format($m->FACTURAS_FP + $m->FACTURAS,2)?></font></P>
                           <P><b>Disponible:&nbsp;&nbsp;</b><font color="red"><?php echo '$ '.number_format($m->LINEA_CRED - ($m->FACTURAS + $m->FACTURAS_FP),2)?></font></P>
                           <?php foreach($rutas as $d):?>
                            <?php if($d->CC == $m->ID){?>
                              <label>Ruta: <?php echo $d->IDR?> <a href="index.cobranza.php?action=verDocRuta&idr=<?php echo $d->IDR?>&idm=<?php echo $idm?>&cvem=<?php echo $cvem?>&cc=<?php echo $m->ID?>" target="popup" onclick="window.open(this.href, this.target, 'width=1200, height=1200'); return false;" ><font color="red">&nbsp;&nbsp;&nbsp; Ver Documentos (<?php echo $d->DOC?>)</font></a></label><br/>
                              <label>Ppto Cobranza : <?php echo '$ '.number_format($d->VALOR,2)?></label><br/>
                              <label>Cobrado: <?php echo '$ '.number_format($d->APLICADO,2)?></label><br/>
                              <label>Aplicado: <?php echo '$ '.number_format($d->APLICADO,2)?></label><br/>
                              <label>Notas Credito: <?php echo '$ '.number_format($d->NC,2)?></label><br/>
                              <label>Por Cobrar <?php echo '$ '.number_format($d->VALOR - ($d->APLICADO + $d->NC),2)?></label><br/>
                            <?php }?>
                           <?php endforeach;?>                        
                          <!--<center><a href="index.php?action=edoCta_docs" class="btn btn-default"></a></center>-->
                      </div>
                    </div>
                </div>   
                <?php }?> 
            <?php endforeach ?>
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

</script>