<br/>
<div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Documentos del Maestro.   
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>Ln</th>
                                            <th>CLiente <br/> Clave</th>
                                            <th>Factura <br/> Fecha </th>
                                            <th>Importe</th>
                                            <th>Saldo </th>
                                            <th>Pagos <br/> Id</th>
                                            <th>Importe NC <br/> Nota de Credito</th>
                                            <th>Año</th>
                                            
                                        </tr>
                                    </thead>                                   
                                  <tbody>
                                        <?php 
                                        $i = 0;
                                        foreach ($docs as $data): 
                                        $color  = '';
                                        $i++;
                                        if($data->SALDOFINAL > 10 ){
                                            //$color = "style = 'background-color:#ffb3b3'";
                                        }
                                        ?>
                                        <tr class="odd gradeX" <?php echo $color?> >
                                            <td><?php echo $i?></td>
                                         <!--<tr class="odd gradeX" style='background-color:yellow;' >-->
                                            <td><?php echo $data->NOMBRE;?> <br/> (<?php echo $data->CVE_CLPV?>) </td>
                                            <td><?php echo $data->CVE_DOC.'('.$data->STATUS.')';?> <br/> (<?php echo $data->FECHA_DOC?> )</td>
                                            <td><?php echo '$ '.number_format($data->IMPORTE,2)?></td>
                                            <td><?php echo '$ '.number_format($data->SALDOFINAL,2);?> </td>
                                            <td><?php echo '$ '.number_format($data->APLICADO,2);?> <br/> (<?php echo $data->ID_PAGOS?>)</td>
                                            <td><?php echo '$ '.number_format($data->IMPORTE_NC,2);?> <br/> (<?php echo $data->NC_APLICADAS?>)</td>
                                            <td><?php echo $data->ANIO?></td>
                                                                                         
                                        </tr>
                                        <?php endforeach; ?>
                                 </tbody>
                                </table>
                            </div>
                      </div>
            </div>
        </div>
</div>
<br />

