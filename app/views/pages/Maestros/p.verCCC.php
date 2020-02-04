<br />
<div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Maestros   
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>Nombre</th>
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
                                            <td><?php echo $data->NOMBRE;?></td>
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
                      </div>
            </div>
        </div>
</div>
<br />
<br />
<div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                           CENTROS DE COMPRA <br/>   
                            <a class="btn btn-success" href="index.php?action=nuevo_cc&cvem=<?php echo urlencode($cvem)?>" class="btn btn-success"> Alta de Centro de Compras <i class="fa fa-plus"></i></a>
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>Nombre</th>
                                            <th>Contacto</th>
                                            <th>Telefono</th>
                                            <!--<th>Presupuesto</th>-->
                                            <th>Linea Credito</th>
                                            <th>Disponible</th>
                                            <th>Plazo</th>
                                            <th>Eliminar</th>
                                        </tr>
                                    </thead>                                   
                                  <tbody>
                                        <?php 
                                        foreach ($ccc as $data): 
                                        ?>
                                        <tr>
                                            <td><?php echo $data->NOMBRE;?><br/><br/><a href="index.cobranza.php?action=verAsociados&cc=<?php echo $data->CCC?>" target="popup" onclick="window.open(this.href, this.target, 'width=800, height=1000')" class="btn-sm btn-info "> Ver <?php echo $data->CLIENTES?>&nbsp; individuales</a>
                                            </td>
                                            <td><?php echo $data->COMPRADOR;?></td>
                                            <td><?php echo $data->TELEFONO;?></td>
                                            <!--<td align="right"><?php echo '$ '.number_format($data->PRESUPUESTO_MENSUAL,2);?></td>-->
                                            <td align="right"><?php echo '$ '.number_format($data->LINEA_CRED,2);?></td>
                                            <td>0.00</td>
                                            <td><?php echo $data->PLAZO== 0? 'Contado':$data->PLAZO?></td>
                                            <td title="<?php echo $data->CLIENTES > 0? 'El Centro no debe de tener clientes asociados para poder eliminarlo':''?>">
                                                <a href="index.cobranza.php?action=delCss&cvem=<?php echo  urlencode($data->CVE_MAESTRO)?>&ccc=<?php echo $data->ID?>&opcion=B" class="btn btn-danger" <?php echo ($data->CLIENTES == 0 or empty($data->CLIENTES))? '':'disabled' ?> >Eliminar</a>
                                                <a href="index.cobranza.php?action=editaCCC&cvem=<?php echo  urlencode($data->CVE_MAESTRO)?>&ccc=<?php echo $data->ID?>&opcion=E" class="btn btn-info" target="_self" >Editar</a>
                                            </td>
                                        </tr>
                                        <?php endforeach;?>
                                 </tbody>
                                </table>
                            </div>
                            <!-- /.table-responsive -->
                      </div>
            </div>
        </div>
</div>
