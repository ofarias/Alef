<br/>
<div class="row">
    <div class="container">
    <div class="form-horizontal col-lg-12">
        <div class="panel panel-default">
            <div class="panel panel-heading">
                <h3>Editar Maestro</h3>
            </div>
            <br />
            <div class="panel panel-body">
                <?php foreach ($datosMaestro as $key):
                    $cvem = $key->CLAVE;
                 ?>
                   <input name = "idm" type="hidden" value ="<?php echo $key->ID ?>">
                    <div class="form-group">
                        <label for="cliente" class="col-lg-2 control-label">Nombre Maestro: </label>
                            <div class="col-lg-8">
                                <form action="index.php" method="post">
                                <input type="text" class="form-control" name="cliente" value="<?php echo $key->NOMBRE;?>" readonly="true"/><br>
                                <input type="hidden" name="maestro" value="<?php echo $key->ID?>">
                                <p>Cartera Revision:</p>
                                <select class="form-control" name="revision" required="required">
                                    <option value="<?php echo !empty($key->CARTERA_REVISION)? $key->CARTERA_REVISION:''?>"> <?php echo !empty($key->CARTERA_REVISION)? $key->CARTERA_REVISION:'Seleccione una Cartera' ?> </option>
                                    <option value="R1">R1</option>
                                    <option value="R2">R2</option>
                                    <option value="R3">R3</option>
                                </select>
                                <br/>
                                <p>Cartera Cobranza:</p>
                                <select class="form-control" name="cobranza" required="required">
                                    <option value="<?php echo !empty($key->CARTERA)? $key->CARTERA:''?>"> <?php echo !empty($key->CARTERA)? $key->CARTERA:'Seleccione una Cartera' ?> </option>
                                    <option value="C1">C1</option>
                                    <option value="C2">C2</option>
                                    <option value="C3">C3</option>
                                </select>
                                <br/>
                                <button class="btn btn-success form-control" value="submit" type="submit" name="editaCarterasMaestro" >Guardar</button>
                                </form>
                            </div>
                    </div>
        <?php endforeach ?>
            </div>

                </div>
        </div>
    </div>
</div>



