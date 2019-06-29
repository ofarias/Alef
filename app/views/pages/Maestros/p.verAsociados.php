<br/>
<div class="row">
    <div class="container">
        <div class="form-horizontal">
            <div class="panel panel-default">
                <div class="panel panel-heading">
                    <h3>Clientes Asociados al Centro de Costo  "<?php echo $datoscc->NOMBRE?>"</h3>
                    <h3>Del Maestro "<?php echo $datoscc->NOMBRE_MAESTRO?>"</h3>
                    <input type="hidden" value="<?php echo $datoscc->CVE_MAESTRO?>" id="maestro">
                    <input type="hidden" value="<?php echo $datoscc->ID?>" id="ccc">
                </div>
                <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                           Clientes <br/>        
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                               <table class="table table-striped table-bordered table-hover" >
                               <br/>
                                    <thead>
                                        <tr>
                                            <th>Clave</th>
                                            <th>Nombre</th>
                                            <th>RFC</th>
                                            <th>Direccion</th>
                                            <th>Direccion Entrega</th>
                                        </tr>
                                    </thead>                                   
                                  <tbody>
                                <?php if(count($asociados) > 0 ){ ?>
            
                                        <?php 
                                        foreach ($asociados as $data): 
                                        ?>
                                        <tr>
                                            <td><?php echo $data->CLAVE;?></td>
                                            <td><?php echo $data->NOMBRE;?></td>
                                            <td><?php echo $data->RFC;?></td>
                                            <td><?php echo $data->CALLE; ($data->NUMEXT)?"', '.$data->NUMEXT":'';?> </td>
                                            <td><?php echo $data->CAMPLIB7?></td>
                                            <td><a href="index.cobranza.php?action=verAsociados&cancela=1&cliente=<?php echo $data->CLAVE?>&cc=<?php echo $data->C_COMPRAS?>" class="btn btn-danger">Cancelar Asociacion </a>
                                            </td>
                                        </tr>
                                        <?php endforeach; ?>
                                <?php }?>
                                 </tbody>
                                </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<br/>
<div>
    <input type="text" name="cliente" placeholder="Buscar cliente" maxlength="100" size="110" id="cliente">
    <input type="button" onclick="buscarCliente()" value="Buscar" >
</div>

<div class="cliente hidden" id="infoClie">
    <br/>
    <p><font size="4pxs">Se encontraron los siguientes clientes:</font> </p>
    <ul id ='ul'>
    </ul>
</div>

<script type="text/javascript">
    function buscarCliente(){
        var a = document.getElementById('cliente').value
        var cvem = document.getElementById('maestro').value
            $.ajax({
                url:'index.cobranza.php',
                type:'post',
                dataType:'json',
                data:{traeCliente:a, cvem},
                success:function(data){
                    var ul = document.getElementById('ul')
                    for (var i=0 ; i <= data.length-1; i++){
                        var li = document.createElement("li")
                        const button = document.createElement('button')
                        button.type = 'button'
                        button.innerText = 'Asociar'
                        button.setAttribute('class','btn btn-success')
                        button.setAttribute('value', data[i]['CLAVE'])
                        button.setAttribute('onclick','asocia('+Number(data[i]['CLAVE'])+')')
                        li.appendChild(document.createTextNode('Clave: '+ data[i]['CLAVE'] + ' Nombre '+ data[i]['NOMBRE']+ ' RFC ' + data[i]['RFC'] + '  '));
                        li.appendChild(button);
                        ul.appendChild(li);
                    }
                    document.getElementById('infoClie').classList.remove('hidden')
                    document.getElementById('anuncio').classList.add('hidden')
                },
                error:function(data){
                    alert('No se encontraron con los datos intrudicidos, favor de intentarlo otra ves.')
                }
            })
    }

    function asocia(cl){
        //alert('Se asocia el cliente' +  cl)
        var cc= document.getElementById('ccc').value
        $.ajax({
            url:'index.cobranza.php',
            type:'post',
            dataType:'json',
            data:{asociaClCC:cl, cc},
            success:function(data){
                //alert('Se Asocio correctamente')
                location.reload(true)
            },
            error:function(data){
                alert('Sucedio un error favor de intentarlo nuevamente')
                location.reload(true)
            }
        })
    }
</script>