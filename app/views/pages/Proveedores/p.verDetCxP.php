<br /><br />
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                Listado de Recepciones de &oacute;rdenes de compra
            </div>
            <div class="panel-body">             
                <div class="table-responsive">  
                    <table class="table table-striped table-bordered table-hover" id="dataTables-oc-pendientes">
                        <thead>
                            <tr>
                                <th>Contrarecibo</th>
                                <th>Recepcion</th>
                                <th>O.C.</th>
                                <th>Factura</th>
                                <th>Proveedor</th>
                                <th>Vencimiento</th>
                                <th>Promesa de Pago</th>
                                <th>Importe</th>
                                <th>F. Rrecepcion</th>                                
                            </tr>
                        </thead>
                        <tfoot>
                        <td></td>
                        <td></td>
                        <td colspan="5" style="text-align: right;font-weight: bold">Total</td>
                        <td><div id="totales_check"> 0.00</div></td>
                        <td>
                            <form action="index.php" method="POST" id="FORM_ACTION">
                                <input type="hidden" name="seleccion_cr" id="seleccion_cr" value="" />
                                <input type="hidden" name="items" id="items" value="" />
                                <input type="hidden" name="total" id="total" value="" />
                                <input type="hidden" name="FORM_ACTION_CR_PAGO" value="FORM_ACTION_CR_PAGO" />
                                <input type="hidden" name="r" value="close">
                                <input type="button" id="enviar" value="Realizar pago" class="btn btn-success" />
                            </form>
                        </td>
                        </tfoot>
                        <tbody>
                            <?php foreach ($exec as $data): ?>
                                    <tr class="odd gradeX">
                                        <td>
                                            <input type="checkbox" name="marcar" monto="<?php echo $data->MONTOR;?>" value="<?php echo $data->FOLIO;?>" />&nbsp;CRP<?php echo $data->FOLIO;?>&nbsp;
                                        </td>
                                        <td><?php echo $data->RECEPCION; ?></td>
                                        <td><?php echo $data->OC;?></td>
                                        <td><?php echo $data->FACTURA;?></td>
                                        <td><?php echo $data->BENEFICIARIO; ?></td>
                                        <td><?php echo $data->VENCIMIENTO?></td>
                                        <td><?php echo $data->PROMESA_PAGO; ?></td>
                                        <td align="right"><font color="blue"><b><?php echo "$ " . number_format($data->MONTOR, 2, '.', ','); ?><b/></font></td>
                                        <td><?php echo $data->FECHA_IMPRESION; ?></td>
                                    </tr>                                
                            <?php endforeach;?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<br /><br />
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                Listado de Solicitudes pendientes de registro en el Estado de cuenta.
            </div>
            <div class="panel-body">             
                <div class="table-responsive">  
                    <table class="table table-striped table-bordered table-hover" id="dataTables-oc-recepciones">
                        <thead>
                            <tr>
                                <th>Solicitud</th>
                                <th>Contrarecibo</th>
                                <th>Recepcion</th>
                                <th>O.C.</th>
                                <th>Factura</th>
                                <th>Proveedor</th>
                                <th>Fecha Pago</th>
                                <th>Status</th>
                                <th>Importe</th>
                                <th>Banco </th>
                                <th>Fecha <br/>Estado de Cuenta</th>                                
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if ($sol != null) {
                                foreach ($sol as $d):
                                    ?>
                                    <tr class="odd gradeX">
                                        <td><?php echo 'SOL-'.$d->IDSOL?></td>
                                        <td><?php echo ($d->FOLIO==0)? 'Varios':'CRP'.$d->FOLIO;?></td>
                                        <td><?php echo $d->RECEPCION; ?></td>
                                        <td><?php echo $d->OC;?></td>
                                        <td><?php echo $d->FACTURA;?></td>
                                        <td><?php echo $d->PROV; ?></td>
                                        <td><?php echo $d->FECHA_PAGO?></td>
                                        <td><?php echo $d->STATUS; ?></td>
                                        <td align="right"><font color="blue"><b><?php echo "$ " . number_format($d->MONTO, 2, '.', ','); ?><b/></font></td>
                                        <td><?php echo $d->BANCO_FINAL; ?></td>
                                        <td><?php echo $d->FECHA_EDO_CTA?></td>
                                    </tr>                                
                                    <?php
                                endforeach;
                            } else {
                                ?>                               
                                <tr class="odd gradeX">
                                    <b><td colspan="6">No hay datos</td></b>
                                </tr>
                                <?php
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript" language="javascript" src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<script>
    var total = parseFloat("0");
    var seleccionados = parseInt("0");
    $("input[type=checkbox]").on("click", function(){
        var monto = $(this).attr("monto");
        monto = monto.replace("$", "");
        monto = monto.replace(",", "");     
        monto = parseFloat(monto);        
        if(this.checked){
            total+=monto;
        } else {
            total-=monto;
        }
        //alert("Total: "+total);
        $("#totales_check").text(total);
        seleccionados = $("input:checked").length;
        $("#seleccion_cr").val(seleccionados);
        $("#total").val(total);
    });
    $("#enviar").click(function (){
        var items = $("#items");
        var folios = "";
        $("input:checked").each(function(index){
            folios+= this.value+",";
        });
        folios = folios.substr(0, folios.length-1);
        console.log("FOLIOS: "+folios);
        items.val(folios);       
        $("#FORM_ACTION").submit();
    });

</script>
