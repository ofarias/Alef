<br /><br />
<div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                                Pedidos .
                        </div>
                           <div class="panel-body">
                            <div class="table-responsive">                            
                                <table class="table table-striped table-bordered table-hover" id="dataTables-verCajasAlmacen">
                                    <thead>
                                        <tr>
                                            <th>Cajas <br/><font color="red">Cotizacion</font></th>
                                            <th>Cliente / Maestro<br/> Centro de Credito</th>
                                            <th>Clave Pedido <br/><font color="darkgreen"><b>Pedido Cliente</b></font><br/> Status Cliente </th>
                                            <th>Vendedor <br/> Valor Pedido</th>
                                            <th>Partidas <br/> Credito Dispobible </th>
                                            <th>Estado <br/> Sobregiro Autorizado</th>
                                            <th>Fecha Creacion <br/> Resultado </th>
                                            <th>Ver Cotizacion</th>
                                            <th>Liberar</th>
                                            <th>Ver Pedido <br/> Cliente</th>
                                            <th>Subir Pedido</th>
                                        </tr>
                                    </thead>
                                  <tbody>
                                        <?php
                                        foreach ($cajas as $data): 
                                            $status=$data->STATUS;
                                            $status_clie = '';
                                            if($status == 1){
                                                $status= 'Liberado';
                                            }
                                            $color= $data->URGENTE =='Si'?"style='background-color:red;'":"";
                                            if($data->STATUS_COBRANZA == 1 ){
                                                $color = "style='background-color:#A9D0F5;'";           
                                                $status_clie = 'CLIENTE SUSPENDIDO'; 
                                            }elseif ($data->STATUS_COBRANZA == 2) {
                                                $color = (($data->SALDO_MONTO_COBRANZA > $data->DBIMPTOT))? "style='background-color:#D0F5A9;'":"style='background-color:#A9D0F5;'";
                                                $status_clie = 'Suspendido con Prorroga';    
                                            }
                                            $credito = 'no';
                                            if( $data->LINEA - ($data->SALDOTOTAL + $data->DBIMPTOT) > -10){
                                              $credito = 'ok';
                                            }
                                            ?>

                                        <tr class="odd gradeX" <?php echo $color;?> >
                                           
                                            <td><?php echo empty($data->CAJA_PEGASO)? $data->IDCA:$data->CAJA_PEGASO ?><br/><font color="red"><?php echo $data->CDFOLIO?></font></td>
                                            <td><?php echo $data->CLIENTE.'<b> Maestro: </b>'.$data->MAESTRO?><br/><b><?php echo empty($data->CCRED)? '<font color="red"> Sin Centro de Credito</font>':'<font color="green"><a href="index.v.php?action=edoCliente&cl='.$data->CVE_CLIENTE.'" target="popup" onclick="window.open(this.href, this.target)" >'.$data->CCRED.'</a></font>' ?></b></td>
                                            <td><?php echo $data->PEDIDO;?> <br/> <font color="darkgreen"><b><?php echo $data->OC?></b></font><br/><?php echo ($status_clie)?></td>
                                            <td><?php echo $data->VENDEDOR;?> <br/><?php echo '$ '.number_format($data->DBIMPTOT,2)?></td>
                                            <td title="Incluye las facturas pendientes y los pedidos liberados.">

                                            <?php echo $data->NUM_PROD;?><br/><?php echo '$ '.number_format( ($data->LINEA -$data->SALDOTOTAL),2)?></td>
                                            
                                            <td><?php echo $data->STATUS;?></td>
                                            <td><?php echo $data->FECHA_VENTAS;?></td>
                                            <form action="index.php" method="post">
                                            <input type="hidden" name="idca" value="<?php echo $data->IDCA;?>"/>
                                            <input type="hidden" name="idp" value="<?php echo $data->PEDIDO;?>">
                                            <input type="hidden" name="folio" value="<?php echo $data->COTIZACION?>" />
                                            <input type="hidden" name="urgente" value="<?php echo $data->URGENTE?>" />
                                            <td>
                                                <button name="verPedido" type="submit" value="enviar" class="btn btn-success"> Ver Pedido</button>
                                            </td>
                                            <?php if($letra == 'G' or $_SESSION['user']->POLIZA_TIPO == 'G'){?>
                                            <td title="Solo se permite liberar pedidos de clientes con Centro de credito asignado y con suficiente Linea de credito.">
                                             <button name="libPedidoFTC" type="submit" value="enviar " class= "btn btn-warning"
                                                <?php echo ($data->STATUS != 0 or empty($data->NOMBRE_ARCHIVO) or empty($data->CCRED) or $credito=='no' )? "disabled='disabled'":""?>
                                                > 

                                               <?php echo ($data->STATUS != 0)? "$status":"Liberar"?> 
                                               </button>
                                             <button name="rechazarFTC" type="submit" value="enviar" class="btn btn-danger"
                                              <?php echo (($data->STATUS != 0) or empty($data->NOMBRE_ARCHIVO) or empty($data->CCRED) or $credito=='no' )? "disabled='disabled'":""?>
                                                > 
                                               <?php echo ($data->STATUS != 0)? "$status":"Rechazar"?>   
                                             </button>
                                             </td> 
                                             <?php }else{?>
                                             <td>
                                             </td>
                                             <?php }?>
                                             </form>
                                             <td>
                                                <a href="/PedidosVentas/<?php echo substr($data->NOMBRE_ARCHIVO,30, 176)?>" download="/PedidosVentas/<?php echo substr($data->NOMBRE_ARCHIVO,30, 176)?>"><?php echo substr($data->NOMBRE_ARCHIVO,30,30)?> </a>
                                             </td>
                                             <td title="Solo se permite subir archivos de Clientes con Centro de Credito">
                                                <form action="upload_pedido_ventas.php" method="post" enctype="multipart/form-data">
                                                <input type="file" name="fileToUpload" id="fileToUpload" required>
                                                <input type="hidden" name="cotizacion" value="<?php echo $data->PEDIDO?>">
                                                <input type="submit" value="Subir Pedido" name="submit" <?php echo (!empty($data->NOMBRE_ARCHIVO) or empty($data->CCRED) or $credito=='no')? 'disabled=disabled':'' ?>>
                                                </form>
                                             </td>
                                        </tr> 
                                        <?php endforeach; 
                                        ?>
                                 </tbody>
                                 </table>
                      </div>
            </div>
        </div>
    </div>
</div>
