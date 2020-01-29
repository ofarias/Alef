<br/>
<div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <div>
                                <p><?php echo 'Usuario: '.$_SESSION['user']->NOMBRE?></p>
                                
                            </div>
                        </div>
                        <div class="panel-body">
                            Seleccione el Año: &nbsp;
                                <select name="anio" id="anio">
                                    <option value="">Seleccione el año</option>
                                    <option value="2020"> 2020 </option>
                                    <option value="2019"> 2019 </option>
                                </select><br/><br/>
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>Ln</th>
                                            <th>Año</th>
                                            <th>Mes</th>
                                            <th>Status</th>
                                            <th>Venta <br/> IVA <br/>Total</th>
                                            <th>Refacturacion</th>
                                            <th>Notas de Credito</th>
                                            <th>Compras_Pagadas</th>
                                            <th>Gastos</th>
                                            <th>Inventario <br/> Inicial</th>
                                            <th>Inventario <br/> Final</th>
                                            <th>Gasto Financiero</th>
                                            <th>Activos</th>
                                            <th>Calcular</th>
                                            <th>Guardar</th>
                                       </tr>
                                    </thead>                                   
                                  <tbody>
                                        <?php $ln=0;
                                            foreach ($info as $key): 
                                            $ln++;
                                            $color='';  
                                        ?>
                                        <tr class="<?php echo $test?> odd gradeX " <?php echo $color ?> title="" id="ln_<?php echo $ln?>" >
                                            <td><?php echo $key->ID?></td>
                                            <td><?php echo $key->ANIO?></td>
                                            <td><?php echo $key->NOMBRE?></td>
                                            <td><?php echo $key->STATUS?></td>
                                            <td align="right">
                                                    <font color="red"><?php echo '$ '.number_format($key->FACTURAS/1.16,2)?></font> 
                                                    <br/><font color="blue"><?php echo '$ '.number_format(($key->FACTURAS/1.16) * .16,2)?></font>
                                                    <br/><font color="green"><?php echo '$ '.number_format($key->FACTURAS,2)?></font>
                                            </td>
                                            <td align="right">
                                                    <font color="red"><?php echo '$ '.number_format($key->REFACTURACIONES/1.16,2)?></font>
                                                    <br/>
                                                    <font color="blue"><?php echo '$ '.number_format(($key->REFACTURACIONES/1.16) * .16,2)?></font>
                                                    <br/>        
                                                    <font color="green"><?php echo '$ '.number_format($key->REFACTURACIONES,2)?></font>
                                            </td>
                                            <td align="right">
                                                    <font color="red"><?php echo '$ '.number_format($key->NOTAS_CREDITO/1.16,2)?></font>
                                                    <br/>
                                                    <font color="blue"><?php echo '$ '.number_format( ($key->NOTAS_CREDITO/1.16) * .16,2)?></font>
                                                    <br/>
                                                    <font color="green"><?php echo '$ '.number_format($key->NOTAS_CREDITO,2)?></font>
                                                    </td>
                                            <td align="right"><?php echo '$ '.number_format($key->COMPRAS_PAGADAS,2)?></td>
                                            <td align="right"><?php echo '$ '.number_format($key->GASTOS,2)?></td>
                                            <td align="right"><?php echo '$ '.number_format($key->INVENTARIO_INICIAL,2)?></td>
                                            <td align="right"><?php echo '$ '.number_format($key->INVENTARIO_FINAL,2)?></td>
                                            <td align="right"><?php echo '$ '.number_format($key->GASTO_FINANCIERO,2)?></td>
                                            <td align="right"><?php echo '$ '.number_format($key->ACTIVOS,2)?></td>
                                            <td><input type="button" value="Calcular" class="calcular" linea="<?php echo $key->ID?>"></td>
                                            <td><input type="button" value="Cerrar" class="cierre" linea="<?php echo $key->ID?>"></td>
                                        </tr>
                                        <?php endforeach; ?>
                                 </tbody>
                                </table>
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

    $("#anio").change(function(){
        var a = $(this).val()
        alert('Se cambia el año' + a)
        window.open('index.edo.php?action=edo_fin&anio='+ a, '_self')
    })

    $(".calcular").click(function(){
        alert('Se calcularan los valores para el cierre del estado de cuenta')
        var id = $(this).attr('linea')
        $.ajax({
            url:'index.edo.php',
            type:'post',
            dataType:'json',
            data:{calcular:1, id}, 
            success:function(data){
                alert('Se calcularon correctamente los datos')
                location.reload(true)
            },
            error:function(){
                alert('Revise la informacion')
            }
        })
     })


</script>