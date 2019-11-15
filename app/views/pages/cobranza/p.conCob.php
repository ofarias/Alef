<br />
<div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Contactos de Cobranza del Centro de Credito   
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                 
                                            <th>Nombre</th>
                                            <th>Departamento</th>
                                            <th>Telefono</th>
                                            <th>Correo</th>
                                            <th>Status</th>
                                            <th>Editar</th>
                                        </tr>
                                    </thead>                                   
                                  <tbody>
                                        <?php 
                                        foreach ($contactos as $c): 
                                        ?>
                                        <tr class="odd gradeX" title="Usuario Alta: <?php echo $c->USUARIO.' el '.$c->FECHA?>" >
                                            <td><?php echo $c->NOMBRE.' '.$c->SEGUNDO_N.' '.$c->APELLIDO_P.' '.$c->APELLIDO_M;?></td>
                                            <td><?php echo $c->DEPTO;?></td>
                                            <td><?php echo $c->TELEFONO;?></td>
                                            <td><?php echo $c->CORREO;?></td>
                                            <td><?php echo $c->STATUS?></td>
                                            <td><input type="button" onclick="baja(<?php echo $c->ID?>, '<?php echo $c->STATUS?>')" value="<?php echo ($c->STATUS=='B')? 'Activar':'Baja'?>"></td> 
                                        </tr>
                                        </form>
                                        <?php endforeach; ?>
                                 </tbody>
                                </table>
                            </div>
                            <!-- /.table-responsive -->
                      </div>
            </div>
        </div>
</div>
<form action="index.cobranza.php" method="post" id="formulario">
            <div class="form-group">
            <b>* Nombre :</b> <br/><input value="" name="nombre" type="text" placeholder="Nombre" size="100" required> <br/>
            <b>Segundo Nombre :</b> <br/><input value="" name="sn" type="text" placeholder="Segundo Nombre" size="40" > <br/>
            <b>* Apellido Paterno:</b> <br/><input value="" name="paterno" type="text" placeholder="Apellido Paterno " size="40" required> <br/>
            <b>Apellifo Materno:</b><br/><input value="" name="materno" type="text" placeholder="Apellido Materno" size="40" > <br/>
            <b>* Departamento</b>: <br/> <input value="" name="depto" type="text" placeholder="Departamento" size="100" required> <br/>
            <b>* Puesto</b>: <br/><input value="" name="puesto" type="text" placeholder="Puesto" size ="100"  required> <br/>
            <b>Telefono</b>: <br/> <input value="" name="tel" type="text" placeholder="Telefono" size="100" ><br/>
            <b>Correo</b>: <br/> <input value="" name="correo" type="email" placeholder="Correo" multiple  size="100" id="idc"> <br/>
            </div>
            <label>Los campor marcados con un asterisco son requeridos</label><br/>
            <input type="hidden" name="ccc" value="<?php echo $ccc?>" >
            <input type="hidden" name="cvem" value="<?php echo $cvem?>">
            <input type="hidden" name="idm" value="<?php echo $idm?>" >
            <input type="hidden" name="tipo" value="c" id="tip">
            <input type="hidden" name="agregaContacto" value="1">
            <button type="submit" value="enviar" name="agregaContacto" id="env">Agregar</button>
</form>


<script type="text/javascript" language="JavaScript" src="app/views/bower_components/jquery/dist/jquery.min.js"></script>
<script type="text/javascript">

    function baja(idcon, st){
      if(st == 'A'){
        var status = 'baja'
        var a = ' no '
        var v = 'b'
      }else if(st=='B'){
        var status = 'alta'
        var a = ''
        var v = 'a'
      }
    if(confirm('Se dara de '+ status +' el contacto, aparecera en esta lista y '+ a +' aparecera para su uso en el sistemna')){
            document.getElementById('tip').value=v;
            document.getElementById('idc').value=idcon;
            document.getElementById('env').value='agregaContacto';
            var form=document.getElementById('formulario');
            form.submit();
      }
    }

    $(".asociar").click(function(){
        var cliente=$(this).attr("cliente")
        var cc=$(this).attr("cc")
        var cvem=$(this).attr("cvem")
        var idm=$(this).attr("idm")
        if(confirm("Asociar"+ cliente)){
            $.ajax({
                url:'index.php',
                type:'post',
                dataType:'json',
                data:{asociaCC:1, cc, cliente, cvem, idm},
                success:function(data){
                    location.reload(true)
                },
                error:function(){
                }
            })

        }else{
            return false;
        }

    });

</script>