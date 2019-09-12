<br/>
<div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                                Catalogo de Proveedores.
                        </div>
                        <!-- /.panel-heading -->
                           <div class="panel-body">
                            <div class="table-responsive">                            
                                <table class="table table-striped table-bordered table-hover" id="dataTables-verProveedores">
                                    <thead>
                                        <tr>
                                            <!--<th>Todos: <input type="checkbox" name="marcarTodo" id="marcarTodo" /></th>-->
                                            <th>CLAVE / NOMBRE</th>
                                            <th>CERT</th>
                                            <th>DIRECCION</th>
                                            <th>ENVIO<br/>RECOLECCION</th>
                                            <th>TIPOS PAGO</th>
                                            <th>RESPONSABLE <br/>COMPRA</th>
                                            <th>FECHA <br/>CERTIFICACION</th>
                                            <th>FALLOS</th>
                                            <th>ULTIMO <br/>FALLO</th>
                                            <th>CORREOS </th>
                                            <th>Banco Deposito</th>
                                            <th>RESULTADO</th>
                                            <th>EDITAR</th>
                                        </tr>
                                    </thead>
                                  <tbody>
                                        <?php
                                        foreach ($generales as $data):
                                            if($data->ENVIO == 1){
                                                $envio = 'Si';
                                            }else{
                                                $envio = 'No';
                                            }                 
                                            if($data->RECOLECCION == 1){
                                                $rec = 'Si';
                                            }else{
                                                $rec = 'No';
                                            }
                                            if($data->TP_CHEQUE == 'Si'){
                                                $tch = ' Cheque';
                                            }else{
                                                $tch ='';
                                            }
                                            if($data->TP_EFECTIVO == 'Si'){
                                                $tef =' Efectivo';
                                            }else{
                                                $tef = '';
                                            }
                                            if($data->TP_CREDITO == 'Si'){
                                                $tcr = ' Credito';
                                            }else{
                                                $tcr = '';
                                            }
                                            if($data->TP_TRANSFERENCIA == 'Si'){
                                                $ttr = ' Transferencia';
                                            }else{
                                                $ttr = '';
                                            }

                                            $color = '';
                                            if($data->BBVA_ALTA == 9 OR empty($data->BBVA_ALTA)){
                                                $color="style='background-color: #ffe6ff'";
                                                //$color="style='background-color:brown;'";
                                            }
                                        ?>
                                       <tr class="odd gradeX" <?php echo $color;?> >
                                            <td><a href="index.cxp.php?action=''"><?php echo '('.$data->CLAVE.')'.$data->NOMBRE;?></a></td>
                                            <td><?php echo $data->CERTIFICADO?></td>
                                            <td><?php echo $data->CALLE.' '.$data->NUMEXT.' '.$data->COLONIA.' '.$data->ESTADO;?></td>
                                            <td><?php echo $envio.' / '.$rec;?></td>
                                            <td><?php echo $tch.'/'.$tef.' / '.$tcr.'/'.$ttr;?></td>
                                            <td><?php echo $data->RESP_COMPRA;?></td>
                                            <td><?php echo $data->FECHA_CERT;?></td>
                                            <td><?php echo $data->FALLOS?></td>
                                            <td><?php echo $data->FECHA_ULT_FALLO?></td>
                                            <td><?php echo $data->EMAILPRED?> <br/> <?php echo $data->EMAIL2?> <br/> <?php echo $data->EMAIL2?></td>
                                            <td><?php echo $data->BANCOSAT.'<br/>'.$data->BBVA_ALTA?></td>
                                            <td><?php echo $data->ULTIMO_STATUS?></td>
                                            <form action="index.php" method="post">
                                            <input type="hidden" name="idprov" value="<?php echo $data->CLAVE;?>"/>
                                            <td>
                                            <button name="editaProveedor" type="submit" value="enviar " class= "btn btn-warning"> 
                                            Editar Datos    
                                            </button>
                                             </td> 
                                            </form>
                                        </tr>
                                        <?php endforeach; ?>
                                 </tbody>
                                 </table>
                            <!-- /.table-responsive -->
                      </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                                Catalogo de Proveedores.
                        </div>
                        <!-- /.panel-heading -->
                           <div class="panel-body">
                            <div class="table-responsive">                            
                                <table class="table table-striped table-bordered table-hover" id="dataTables-documentosCompra">
                                    <thead>
                                        <tr>
                                            <!--<th>Todos: <input type="checkbox" name="marcarTodo" id="marcarTodo" /></th>-->
                                            <th>Ln</th>
                                            <th>Status</th>
                                            <th>PreOrden<br/>OC</th>
                                            <th>Fecha de<br/> Elaboracion</th>
                                            <th>Fecha entrega <br/> recoleccion Estimada</th>
                                            <th>Usuario</th>
                                            <th>Costo</th>
                                            <th>Descuento</th>
                                            <th>iva</th>
                                            <th>Total</th>
                                            <th>Pago</th>
                                            <th>Folio <br/>Pago</th>
                                            <th>Confirmado</th>
                                            <th>Tipo</th>
                                            <th>Status 2</th>
                                            <th>Usuario Recibe</th>
                                            <th>Banco Pago</th>
                                            <th>Fecha de Pago</th>
                                        </tr>
                                    </thead>
                                  <tbody>
                                        <?php
                                        $ln=0;
                                        foreach ($documentos as $key):
                                            $ln++;
                                            $color ='';
                                        ?>
                                        <tr class="odd gradeX" <?php echo $color;?> >
                                            <td><?php echo $ln?></td>
                                            <td><?php echo $key->STATUS?></td>
                                            <td><?php echo $key->CVE_DOC.'<br/>'.$key->OC?></td>
                                            <td><?php echo $key->FECHA_ELAB?></td>
                                            <td><?php echo $key->FECHA_ENTREGA?></td>
                                            <td><?php echo $key->USUARIO?></td>
                                            <td align="right"><?php echo '$ '.number_format($key->COSTO,2)?></td>
                                            <td align="right"><?php echo '$ '.number_format($key->DESCUENTO,2)?></td>
                                            <td align="right"><?php echo '$ '.number_format($key->TOTAL_IVA,2)?></td>
                                            <td align="right"><?php echo '$ '.number_format($key->COSTO_TOTAL,2)?></td>
                                            <td align="right"><?php echo '$ '.number_format($key->PAGO_TES,2)?></td>
                                            <td><?php echo $key->TP_TES?></td>
                                            <td><?php echo $key->CONFIRMADO?></td>
                                            <td><?php echo $key->TIPO?></td>
                                            <td><?php echo $key->STATUS_LOG?></td>
                                            <td><?php echo $key->USUARIO_RECIBE?></td>
                                            <td><?php echo $key->BANCO?></td>
                                            <td><?php echo $key->EDOCTA_FECHA?></td>
                                        </tr> 
                                        <?php endforeach; ?>
                                 </tbody>
                                 </table>
                            <!-- /.table-responsive -->
                      </div>
            </div>
        </div>
    </div>
</div>