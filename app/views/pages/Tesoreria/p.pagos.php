<br /><br />

<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                Confirmar Pagos
            </div>
            <div class="panel-body">
                <div class="table-responsive">  
                    <span>Pago de documentos</span>
                    <table class="table table-striped table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>ORDEN DE COMPRA</th>
                                <th>PROVEEDOR</th>
                                <th>FECHA ELABORACION</th>
                                <th>CUENTA PAGO</th>
                                <th>TIPO PAGO TESORERIA</th>
                                <th>PAGO REQUERIDO</th>                  
                                <th>MONTO PAGO TESORERIA</th>
                                <th>GUARDAR</th>
                            </tr>
                        </thead>   
                        <tbody>
                            <?php foreach ($exec as $data):
                                $pl='';
                                switch (trim($data->TIPOPAGOR)){
                                    case 'tr':
                                        $tpp='tr';
                                        $tppdesc='Transferencia';
                                        break;
                                    case 'ch':
                                        $tpp='ch';
                                        $tppdesc='Cheque';
                                        break;
                                    case 'cr':
                                        $tpp='cr';
                                        $tppdesc='Credito';
                                        $pl=$data->DIASCRED.' Dias';
                                        break;
                                    case 'e':
                                        $tpp='e';
                                        $tppdesc='Efectivo';
                                        break;
                                    default:
                                        $tpp='';
                                        $tppdesc='Seleccione una forma de pago!!!';
                                        break;
                                }
                                ?>
                                <tr class="odd gradeX">                                                                                      
                                    <td><a href="index.php?action=documentodet&doc=<?php echo $data->CVE_DOC ?>"><?php echo $data->CVE_DOC; ?></a></td>
                                    <td><?php echo $data->NOMBRE; ?></td>
                                    <td><?php echo $data->FECHAELAB; ?></td>
                            <form action="index.php" method="post">
                                <td>
                                    <select name="cuentabanco" required="required">
                                        <!--<option value="">--Selecciona la Cuenta Banco--</option>-->
                                        <<?php foreach ($cuentab as $ban): ?>
                                            <option value="<?php echo $ban->BANCO; ?>"><?php echo $ban->BANCO; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </td>
                                <td>
                                    <input name="docu" type="hidden" value="<?php echo $data->CVE_DOC ?>"/>
                                    <input name="nomprov" type="hidden" value="<?php echo $data->NOMBRE ?>"/>
                                    <input name="cveprov" type="hidden" value="<?php echo isset($data->CVE_CLPV)? $data->CVE_CLPV:$data->PROVEEDOR ?>"/>
                                    <input name="importe" type="hidden" value="<?php echo $data->IMPORTE ?>" />
                                    <input name="fechadoc" type="hidden" value="<?php echo $data->FECHAELAB ?>"/>
                                    <select name="tipopago" required="required"  class="fp">
                                        <option value="<?php echo $tpp?>"><?php echo $tppdesc?></option>
                                        <option value="tr">Transferencia</option>
                                        <<?php echo (substr($data->CVE_DOC, 0, 1) == 'O')? 'option value="cr">Crédito</option>':''?>
                                        <option value="e">Efectivo</option>
                                        <option value="ch">Cheque</option>
                                        <option value="sf">Saldo a Favor</option>
                                    </select>
                                    <br/><?php echo 'Pago Predeterminado Proveedor: <b>'.$tppdesc.' '.$pl.'</b>'?>
                                </td>
                                <td><?php echo "$ " . number_format($data->IMPORTE, 2, '.', ','); ?></td>
                                <td><input name="monto" type="number" step="any" required="required" max="<?php echo ($data->IMPORTE + 1) ?>" value="<?php echo number_format($data->IMPORTE,2,".","")?>" readonly /> <br/>
                                    <input type="date" name="fchp" class="hidden" id="FCHP"><label id="txt"></label><br/>
                                    <input type="text" name="nchp" class="hidden" id="NCHP" size="8"><label id="txt2"></label>
                                </td>
                                <td>
                                    <button name="formpago" type="submit" value="enviar" class="btn btn-warning">Pagar <i class="fa fa-floppy-o"></i></button></td>
                            </form>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<?php if(count($detallesaldo)>0){?>
<br /><br />
<div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                           De los saldos liberados del Proveedor
                        </div>
                           <div class="panel-body">
                            <div class="table-responsive">                            
                                <table class="table table-striped table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>Seleccionar</th>
                                            <th>Orden</th>
                                            <th>Fecha de Orden</th>
                                            <th>Partida </th>
                                            <th>Cantidad</th>
                                            <th>Producto</th>
                                            <th>Costo en Ordenes </th>
                                            <th>Total Cancelado</th>
                                            <th>IVA</th>
                                            <th>Total</th>
                                            <th>Usuario Libera</th>
                                            <th>Fecha de Liberacion</th>
                                        </tr>
                                    </thead>
                                  <tbody>
                                        <?php
                                        foreach ($detallesaldo as $data):
                                        ?>
                                       <tr>
                                           <td><input type="checkbox" name="seleccion" id="seleccion_<?php echo $data->OC.$data->PARTIDA?>"></td>
                                            <td><?php echo $data->OC;?></td>
                                            <td align="center"><?php echo $data->FECHA_OC;?></td>
                                            <td align="center"><?php echo $data->PARTIDA_OC?></td>
                                            <td align="center"><?php echo $data->CANTIDAD;?></td>
                                            <td align="center"><?php echo '('.$data->PROVEEDOR.') '.$data->NOMBRE_PROVEEDOR;?></td>
                                            <td align="right"><?php echo '$ '.number_format($data->COST,2) ;?></td>
                                            <td align="right"><?php echo '$ '.number_format($data->COST*$data->CANTIDAD,2)?></td>
                                            <td align="right"><?php echo '$ '.number_format(($data->CANTIDAD * $data->COST) * .16,2)?></td>
                                            <td align="right"><font color="red"><?php echo '$ '.number_format(($data->CANTIDAD * $data->COST)*1.16,2)?></font></td>
                                            <td><?php echo $data->USUARIO?></td>
                                            <td><?php echo $data->FECHA;?></td>
                                        </tr>
                                        <?php endforeach; ?>
                                 </tbody>
                                 </table>
                      </div>
            </div>
        </div>
    </div>
</div>
<?php }?>
<script src="//code.jquery.com/jquery-1.10.2.js"></script>
<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.0/themes/base/jquery-ui.css">
<link rel="stylesheet" href="/resources/demos/style.css">
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.0/jquery-ui.js"></script>
<script type="text/javascript">
    $(".fp").change(function(){
        var fp = $(this).val()
        var p =document.getElementById("FCHP")
        var a = document.getElementById("NCHP")
        if(fp == 'ch'){
            p.removeAttribute("class")
            a.removeAttribute("class")
            p.setAttribute("required","required")
            a.setAttribute("required","required")
            document.getElementById("txt").innerHTML="&nbsp;&nbsp;Fecha de cobro"
            document.getElementById("txt2").innerHTML="&nbsp;&nbsp;Folio Cheque"
        }else{
            p.removeAttribute("required")
            a.removeAttribute("required")
            p.setAttribute("class","hidden")
            a.setAttribute("class","hidden")
            document.getElementById("txt").innerHTML=""
            document.getElementById("txt2").innerHTML=""
        }
    })
</script>