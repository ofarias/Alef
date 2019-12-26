<br /><br />
<div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                                Pedidos.
                        </div>
                           <div class="panel-body">
                            <div class="table-responsive">                            
                                <table class="table table-striped table-bordered table-hover" >
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
                                            <th>Autorizar</th>
                                            
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
                                            if($data->LINEA - ($data->SALDOTOTAL + $data->DBIMPTOT) > -10){
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
                                            <input type="hidden" name="cc" value="<?php echo $data->CCC?>" />
                                            <td>
                                                <button name="verPedido" type="submit" value="enviar" class="btn btn-success"> Ver Pedido</button>
                                            </td>

                                            <td>
                                              <?php if(empty($data->CCC)){ ?>
                                                <input type="button" name="autoriza" value="Autoriza" class="autoriza" onclick="auto(<?php echo $data->IDCA?>)"></td>
                                              <?php }else{ ?>
                                                Autorizado.
                                              <?php } ?>                                          
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

<script type="text/javascript" language="JavaScript" src="app/views/bower_components/jquery/dist/jquery.min.js"></script>
<script type="text/javascript">

  function auto(a){
    alert('Desea Autorizar esta cotizacion para la liberacion?')
    
    $.ajax({
      url:'index.cobranza.php',
      type:'post',
      dataType:'json',
      data:{autoPed:1, id:a},
      success:function(data){
        location.reload(true)
      },
      error:function(){
        alert('Ocurrio un error al autorizar, favor de volver a internar o revisar la informacion')
      }
    });

  }
</script>