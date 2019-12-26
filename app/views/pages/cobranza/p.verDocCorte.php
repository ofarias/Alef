<br />
<br/>
<div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                                Documentos Corte de Credito
                        </div>
                           <div class="panel-body">
                            <div class="table-responsive">                            
                                <table class="table table-striped table-bordered table-hover" id="dataTables-RutasActivas">
                                    <thead>
                                        <tr>
                                            <th>Nombre</th>
                                            <th>Centro de Credito</th>
                                            <th>Documento</th>
                                            <th>Fecha</th>
                                            <th>Importe</th>
                                            <th>Aplicaciones</th>
                                            <th>NC</th>
                                            <th>Saldo</th>
                                            <th>Vencimiento</th>
                                            <th>Observaciones</th>
                                            <th>Ver Cotizaciones <br/> Pedidos</th>
                                            <th>Actualizar</th>
                                        </tr>
                                    </thead>
                                  <tbody>
                                        <?php
                                        foreach ($docs as $data): 
                                        ?>
                                       <tr>
                                            <td><?php echo $data->NOMBRE;?></td>
                                            <td><?php echo $data->CC;?></td>
                                            <td><?php echo $data->DOCUMENTO;?></td>
                                            <td><?php echo $data->FECHAELAB;?></td>
                                            <td align="right"><?php echo '$ '.number_format($data->IMPORTE,2);?></td>
                                            <td align="right"><?php echo '$ '.number_format($data->APLICADO,2);?></td>
                                            <td align="right"><?php echo '$ '.number_format($data->IMPORTE_NC,2);?></td>
                                            <td align="right"><?php echo '$ '.number_format($data->SALDOFINAL,2);?></td>
                                            <td align="center"><?php echo $data->VENCIMIENTO;?></td>
                                            <td><?php echo $data->OBSERVACIONES;?></td>
                                            <td><a href="index.cobranza.php?action=verCajasCorte&cc=<?php echo $data->CC?>" target="_blank" onclick="window.open(this.href, this.target, 'width=1200, height=800'); return false;">Ver Documentos</a></td>
                                            <td></td>
                                        </tr> 
                                        <?php endforeach; ?>
                                 </tbody>
                                 </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
