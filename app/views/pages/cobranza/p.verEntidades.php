<br/>
<button id="nuevaEntidad" class="btn btn-info">Alta Entidad Financiera</button>
<br/>
<div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                                Entidades Financieras para elaboracion de CEP
                        </div>
                           <div class="panel-body">
                            <div class="table-responsive">                            
                                <table class="table table-striped table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>Id</th>
                                            <th>Razon Social</th>
                                            <th>Nombre Comercial</th>
                                            <th>RFC</th>
                                            <th>Fecha Alta<br/> <font color="red"> Fecha de Baja</font></th>
                                            <th>Usuario Alta<br/><font color="red"> Usuario Baja</font></th>
                                            <th>Estatus</th>
                                            <th>Cambiar</th>
                                        </tr>
                                    </thead>
                                  <tbody>
                                        <?php foreach ($info as $data): ?>
                                       <tr>
                                            <td><?php echo $data->ID;?></td>
                                            <td><?php echo $data->NOMBRE?></td>
                                            <td><?php echo $data->COMERCIAL?></td>
                                            <td><?php echo $data->RFC?></td>
                                            <td><?php echo $data->FECHA_ALTA?><br/> <font color="red"> <?php echo $data->FECHA_BAJA?></font></td>
                                            <td><?php echo $data->USUARIO_ALTA?><br/><font color="red"> <?php echo $data->USUARIO_BAJA?></font></td>
                                            <td align="center"><?php echo $data->STATUS?></td>
                                            <td>
                                                <?php if($data->STATUS == 'A'){ ?>
                                                <input type="button" value="Baja" onclick="bajaEntidad(<?php echo $data->ID?>)">
                                                <?php }?>
                                            </td>
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
<script type="text/javascript">
    $("#nuevaEntidad").click(function(){ 
           $.confirm({
            columnClass: 'col-md-8',
            title: 'Datos',
            content: 'Favor de colocar los datos de la Entidad' + 
            '<form action="index.cobranza.php" class="formName">' +
            '<div class="form-group">'+
            'Razon Social : <br/><input name="razon" type="text" placeholder="Razon Social" size="80" class="raz" maxlength="80"><br/>'+
            'RFC: <br/><input name="rfc" type="text" placeholder="Sin giuones " size="20" class="rfc" maxlength="13"> <br/>'+
            'Nombre Comercial:<br/><input name="comercial" type="text" placeholder="Nombre Comercial" size="80" class="com" maxlength="80"> <br/>'+
            '</div><br/><br/>'+
            '</form>',
                buttons: {
                formSubmit: {
                text: 'Crear',
                btnClass: 'btn-blue',
                action: function () {
                    var razon = this.$content.find('.raz').val();
                    var rfc = this.$content.find('.rfc').val();
                    var comercial = this.$content.find('.com').val();
                    if(razon==''){
                        $.alert('Debe de colocar el nombre de la razon social ...');
                        return false;
                    }else if(rfc== ''){
                        $.alert('Debe de colocar el valor de RFC ...');
                        return false;   
                    }else if(comercial== ''){
                        $.alert('Debe de colocar el nombre comercial ...');
                        return false;   
                    }else{
                        //$.alert('Se creara la entidad financiera ' + razon);
                        $.ajax({
                            url:'index.cobranza.php',
                            type:'post',
                            dataType:'json',
                            data:{creaEntidad:1, razon , rfc, comercial},
                            success:function(data){
                                location.reload(true)
                            }, 
                            error:function(data){
                                $.alert("Ocurrio un error en la creacion de la entidad, favor de revisar los datos, La razon socila no debe de ser mayor a 80 Caracteres, el RFC debe de tener una longitud de por lo menos 12 caracteres y el nombre comercial no puede ser mayor de 80 caracteres ...")
                            }
                        });
                    }
                   }
            },
            cancelar: function () {
            },
        },
        onContentReady: function () {
            // bind to events
            var jc = this;
            //alert(jc);
            this.$content.find('form').on('submit', function (e) {
                // if the user submits the form by pressing enter in the field.
                e.preventDefault();
                jc.$$formSubmit.trigger('click'); // reference the button and click it
            });
        }
    });
    })

    function bajaEntidad(ide){
        $.ajax({
            url:'index.cobranza.php',
            type: 'post',
            dataType: 'json',
            data:{bajaEntidad:1, ide},
            success:function(data){
                $.alert("Se ha dado de baja, la entidad, favor de actualizar")
            }, 
            error:function(){
                $.aler('Favor de revisar los datos')
            }
        })
    }

</script>