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
                                            <th></th>
                                            <th>Editar</th>
                                        </tr>
                                    </thead>                                   
                                  <tbody>
                                        <?php 
                                        foreach ($maestro as $data): 
                                        	$idm = $data->ID;
                                        ?>
                                        <tr class="odd gradeX" >
                                            <td><?php echo $data->NOMBRE;?></td>
                                            <td><?php echo $data->SUCURSALES;?></td>
                                            <td><?php echo $data->CARTERA;?></td>
                                            <td><?php echo $data->CARTERA_REVISION;?></td>
                                            <td><?php echo $data->CCS?></td>
                                            <td><?php echo $data->TOTCCS?></td>
                                            <td></td>
                                            <td>
                                            <form action="index.php" method="post">
                                                <input type="hidden" name="idm" value="<?php echo $data->ID?>" >
                                                <input type="hidden" name="cvem" value="<?php echo $data->CLAVE?>">
                                                <button name="editarMaestro" value="enviar" type="submit" class="btn btn-info"> Editar </button>
                                            </td>
                                            <td>
                                                <button type="submit" value="enviar" name="verCCC" class="btn btn-success"> CCC </button>
                                            </td>
                                             
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
<br/>
<div class="row">
    <div class="container">
<div class="form-horizontal">
<div class="panel panel-default">
	<div class="panel panel-heading">
		<h3>Edicion de Centro de Compras</h3>
	</div>
<br />
<div class="panel panel-body">
		<form action="index.cobranza.php" method="post">
		<div class="form-group">
				<label for="categoria" class="col-lg-2 control-label">Nombre : </label>
				<div class="col-lg-10">
					<input type="text" maxlength="60" name="nombre" placeholder="<?php echo $ccc->NOMBRE?>" value="" class=" form form-control" required="required" readonly>
				</div>
		</div>
		<div class="form-group">
				<label for="categoria" class="col-lg-2 control-label">Contacto : </label>
				<div class="col-lg-10">
					<input type="text" maxlength="60" name="contacto" placeholder="Persona de contacto" value="<?php echo $ccc->COMPRADOR?>" class=" form form-control" required="required">
				</div>
		</div>
		<div class="form-group">
				<label for="categoria" class="col-lg-2 control-label">Telefono : </label>
				<div class="col-lg-10">
					<input type="text" maxlength="60" name="telefono" placeholder="Telefono del Contacto" value="<?php echo $ccc->TELEFONO?>" class=" form form-control" required="required">
				</div>
		</div>
		<div class="form-group">
				<label for="categoria" class="col-lg-2 control-label">Presupuesto: </label>
				<div class="col-lg-10">
					<input type="number" step="10000" name="presup" min="0" placeholder="Presupuesto Mensual" value="<?php $ccc->PRESUPUESTO_MENSUAL?>" class=" form form-control" required="required" >
				</div>
		</div>
		<div class="form-group">
				<label for="categoria" class="col-lg-2 control-label">Linea de Credito: </label>
				<div class="col-lg-10">
					<input type="number" step="1000" name="lincred" min="0" placeholder="Linea de Credito" value="<?php echo $ccc->LINEA_CRED?>" class=" form form-control" required="required">
				</div>
		</div>
		<div class="form-group">
                        <label for="plazo" class="col-lg-2 control-label">Plazo: </label>
                            <div class="col-lg-8">
                                <select name="plazo" class="form-control" required>
                                    <option value ="<?php echo $ccc->PLAZO?>"><?php echo $ccc->PLAZO.' Días'?></option>
                                    <option value ="0"> Contado</option>
                                    <option value ="8"> 8 Días</option>
                                    <option value ="15"> 15 Días</option>
                                    <option value="30">30 Días</option>
                                    <option value="45">45 Días</option>
                                    <option value="60">60 Días</option>
                                    <option value="90">90 Días</option>
                                    <option value="120">120 Días</option>
                                    <option value="150">150 Días</option>
                                </select>
                            </div>
                    </div>
        <!--
		<div class="form-group col-lg-12 text-center">
                    <label class="col-lg-2 control-label">Días Revisión: </label>
                        <div class="checkbox-inline">
                            <label for="rev1" class="checkbox-inline"><input type="checkbox" name="rev1" value="L" >L</label>
                        </div>
                        <div class="checkbox-inline">
                            <label for="rev2" class="checkbox-inline"><input type="checkbox" name="rev2" value="MA" >MA</label>
                        </div>
                        <div class="checkbox-inline">
                            <label for="rev3" class="checkbox-inline"><input type="checkbox" name="rev3" value="MI" >MI</label>
                        </div>
                        <div class="checkbox-inline">
                            <label for="rev4" class="checkbox-inline"><input type="checkbox" name="rev4" value="J">J</label>
                        </div>
                        <div class="checkbox-inline">
                            <label for="rev5" class="checkbox-inline"><input type="checkbox" name="rev5" value="V">V</label>
                        </div>
                        <div class="checkbox-inline">
                            <label for="rev6" class="checkbox-inline"><input type="checkbox" name="rev6" value="S">S</label>
                        </div>
                        <div class="checkbox-inline">
                            <label for="rev7" class="checkbox-inline"><input type="checkbox" name="rev7" value="D">D</label>
                        </div>
                    </div>
                   
                    <div class="form-group col-lg-12 text-center">
                    <label class="col-lg-2 control-label">Día(s) de Deposito: </label>
                        <div class="checkbox-inline">
                            <label for="pag1" class="checkbox-inline"><input type="checkbox" name="pag1" value="L" >L</label>
                        </div>
                        <div class="checkbox-inline">
                            <label for="pag2" class="checkbox-inline"><input type="checkbox" name="pag2" value="MA" >MA</label>
                        </div>
                        <div class="checkbox-inline">
                            <label for="pag3" class="checkbox-inline"><input type="checkbox" name="pag3" value="MI" >MI</label>
                        </div>
                        <div class="checkbox-inline">
                            <label for="pag4" class="checkbox-inline"><input type="checkbox" name="pag4" value="J" >J</label>
                        </div>
                        <div class="checkbox-inline">
                            <label for="pag5" class="checkbox-inline"><input type="checkbox" name="pag5" value="V" >V</label>
                        </div>
                        <div class="checkbox-inline">
                            <label for="pag6" class="checkbox-inline"><input type="checkbox" name="pag6" value="S" >S</label>
                        </div>
                        <div class="checkbox-inline">
                            <label for="pag7" class="checkbox-inline"><input type="checkbox" name="pag7" value="D" >D</label>
                        </div>
                    </div>
                    <div class="form-group col-lg-12 text-center">
                    <label class="col-lg-2 control-label">Día(s) de Cobranza: </label>
                        <div class="checkbox-inline">
                            <label for="cob1" class="checkbox-inline">
                            <input type="checkbox" name="cob[]" value="L" >L</label>
                        </div>
                        <div class="checkbox-inline">
                            <label for="cob2" class="checkbox-inline">

                            <input type="checkbox" name="cob[]" value="MA"  >MA</label>
                        
                        </div>
                        <div class="checkbox-inline">
                            <label for="cob3" class="checkbox-inline">

                            <input type="checkbox" name="cob[]" value="MI"  >MI</label>
                        </div>
                        <div class="checkbox-inline">
                            <label for="cob4" class="checkbox-inline">

                            <input type="checkbox" name="cob[]" value="J" >J</label>
                        </div>
                        <div class="checkbox-inline">
                            <label for="cob5" class="checkbox-inline">
                            <input type="checkbox" name="cob[]" value="V" >V</label>
                        </div>
                        <div class="checkbox-inline">
                            <label for="cob6" class="checkbox-inline">
                            <input type="checkbox" name="cob[]" value="S" >S</label>
                        </div>
                        <div class="checkbox-inline">
                            <label for="cob7" class="checkbox-inline">
                            <input type="checkbox" name="cob[]" value="D" >D</label>
                        </div>
                    </div>
             <div class="form-group">
                        <label for="bancoDeposito" class="col-lg-2 control-label" > Banco Deposito: (Receptor)</label>
                        <div class = "col-lg-8">
                                <select name="bancoDeposito">
                                    <option value =""> Seleccione un Banco</option>
                                    <?php foreach ($banco as $key): ?>
                                        <option value=""><?php echo $ccc->BANCO?></option>
                                        <option value="<?php echo $key->BANCO?>" > <?php echo $key->BANCO?></option>
                                    <?php endforeach ?>
                                </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="metodoPago" class="col-lg-2 control-label" > Forma de Pago</label>
                        <div class = "col-lg-8">
                                <select name="metodoPago" required>
                                        <option value=""> Forma de Pago </option>
                                         <option value="Efectivo"> Efectivo </option>
                                         <option value="cheque"> Cheque </option>
                                          <option value="transferencia"> Transferencia Electronica </option>
                                           <option value="otro"> Otro </option>
                                </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="bancoOrigen" class="col-lg-2 control-label" > Banco Con que Paga el Cliente (Emisor)</label>
                        <div class = "col-lg-8">
                                <select name="bancoOrigen">
                                        <option value=""> Seleccione el Banco Con que Paga el Cliente </option>
                                        <option value="Banamex"> Banamex </option>
                                        <option value="Bancomer"> Bancomer </option>
                                        <option value="Azteca"> Banco Azteca </option>
                                        <option value="Banorte"> Banorte / Ixe </option>
                                        <option value="Inbursa"> Inbursa  </option>
                                        <option value="Bancopel"> Bancopel </option>
                                        <option value="Scotiabank"> Scotiabank </option>
                                        <option value="Santander"> Santander </option>
                                        <option value="Multiva"> Multiva </option>
                                        <option value="Otro"> Desconocido </option>
                                </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for = "referEdo" class="col-lg-2 control-label"> Referencia en estado de cuenta</label>
                        <div class="col-lg-8">
                            <input type="text" name="referEdo" placeholder="Referencia en Estado de cuenta" value="" maxlength="35">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="portalcob" class="col-lg-2 control-label">Portal Cobranza: </label>
                            <div class="col-lg-8">
                                <input type="text" class="form-control" name="portalcob" value="" placeholder="Link portal cobranza" maxlength="255"/><br>
                            </div>
                    </div>
                     <div class="form-group">
                        <label for="maps" class="col-lg-2 control-label">Maps: </label>
                            <div class="col-lg-8">
                                <input type="text" class="form-control" name="maps" value="" placeholder="Link de ubicación en google maps" maxlength="255"/><br>
                            </div>
                    </div> 
            -->      
			<div class="form-group">
    			<div class="col-lg-offset-2 col-lg-10">
    				<input type="hidden" name="cvem" value ="<?php echo $cvem?>">
    				<input type="hidden" name="cc" value="<?php echo $cc ?>">
					<button name="editCC" type="submit" value="enviar" class="btn btn-success"> Guardar <i class="fa fa-floppy-o"></i></button>
                    <a href="index.php?action=verCCC&cvem=<?php echo $cvem?>" target="_self" class="btn btn-info">Regresar</a>
				</div>
			</div>
		</form>
	</div>
</div>
</div>
    </div>
</div>
<script src="//code.jquery.com/jquery-1.10.2.js"></script>
<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
<script>

</script>