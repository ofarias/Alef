<br /><br />
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                Cuentas x Pagar
            </div>
            <div class="panel-body">
                <div class="table-responsive">  
                    <table class="table table-striped table-bordered table-hover" id="dataTables-oc-credito-contrarecibo">
                        <thead>
                            <tr>
                                <th>BENEFICIARIO</th>
                                <th align="center">CR<br>Pendiente</th>
                                <th>Menor <br/>Fecha</th>
                                <th>Mayor <br/>Fecha</th>
                                <th>Sin Vencer</th>
                                <th>Vencidos<br/>7 Dias</th>
                                <th>Vencidos<br/>15 Dias</th>
                                <th>Vencidos<br/>30 Dias</th>
                                <th>Vencidos<br/> + 30 dias</th>
                                <th>Deuda <br/>Contrarecibos</th>
                                <th title="Solicitudes que no estan registradas en el estado de cuenta">Solicitudes <br/>Pendientes de Pago</th>
                                <th>Total Deuda</th>
                            </tr>
                        </thead>   
                        <tbody>
                            <?php
                            foreach ($prov as $data):
                                $color= '';
                                if($data->V31 > 0){
                                    $color = "style='background-color:lightcoral;'";
                                }elseif($data->V30 > 0){
                                    $color = "style='background-color:#E1B5F7;'";
                                }elseif($data->V15 > 0 ){
                                    $color = "style='background-color:#B4D4DF'";
                                }elseif($data->V7 > 0){
                                    $color = "style='background-color:#7CFFF3'";
                                }else{
                                    $color = "style='background-color:#CDFDE4'";
                                }

                                ?>
                                <tr class="odd gradeX" <?php echo $color;?> onmousemove="this.style.fontWeight = 'bold';
                                        this.style.cursor = 'pointer'" onmouseout="this.style.fontWeight = 'normal';
                                                this.style.cursor = 'default';" 
                                    onclick="verDetCxP('<?php echo trim($data->CVE_PROV);?>');" title="De click para mas detalles">
                                    <td><?php echo $data->BENEFICIARIO.' ('.$data->CVE_PROV.')';?></td>
                                    <td align="center"><?php echo $data->CONTRARECIBOS;?></td>
                                    <td align="right"><?php echo $data->ANTIGUO;?></td>
                                    <td align="right"><?php echo $data->NUEVO?></td>
                                    <td align="center"><?php echo $data->SIN_VENCER;?></td>
                                    <td align="center"><?php echo $data->V7; ?></td>
                                    <td align="center"><?php echo $data->V15; ?></td>
                                    <td align="center"><?php echo $data->V30; ?></td>
                                    <td align="center"><?php echo $data->V31; ?></td>
                                    <td align="right"><?php echo '$ '.number_format($data->MONTO,2); ?></td>                                
                                    <td align="right" title="Solicitudes que no estan registradas en el estado de cuenta"><?php echo '$ '.number_format($data->SOLICITUDES,2); ?></td>                              
                                    <td align="right"><?php echo '$ '.number_format($data->SOLICITUDES+$data->MONTO,2); ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                    <input type="button" class="btn btn-success" value="Actualizar" id="act">
                </div>
            </div>
        </div>
    </div>
</div>
<script src="//code.jquery.com/jquery-1.10.2.js"></script>
<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.0/themes/base/jquery-ui.css">
<link rel="stylesheet" href="/resources/demos/style.css">
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.0/jquery-ui.js"></script>
<script type="text/javascript">
    
    function verDetCxP(p){
        window.open('index.cxp.php?action=verDetCxP&prov='+p, '_blank')
        $.alert('se abre nueva ventana con la información, favor de revisar en su navegador')
    }

    $('#act').click(function(){
        location.reload(true)
    })

</script>