<div class="container">
        <!-- Marketing Icons Section -->
        <div class="row">
            <div class="col-lg-12">
                <h3 class="page-header">
                    <!--<img src="app/views/images/logob.jpg">-->
                </h3>
            </div>

            <form action="index.php" method="post">
            <p>Documento:<input type="text" name="docf"></p>
            <p>Caja: <input type="text" name="caja"></p>
            <button name="generaJson" value="Enviar" type="submit">Facturar</button>
            </form>
            
            
        <div class="col-md-4">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4>Cuentas Impuestos</h4>
                </div>
                <div class="panel-body">
                    <p>Configuracion</p>
                    <center><a href="index.coi.php?action=cuentasImp" class="btn btn-default">Cuentas Impuestos</a></center>
                </div>
            </div>
        </div>    
        <div class="col-md-4">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4>Trabajar XML</h4>
                </div>
                <div class="panel-body">
                    <p>Ver XML sin Procesar</p>
                    <center>Recibidos &nbsp;&nbsp;<input type="number" name="anio" placeholder="PERIODO" id="per" onchange="ejecuta('R',this.value)"></center>
                    <br/>
                    <center>Emitidos&nbsp;&nbsp;&nbsp;<input type="number" name="anio" placeholder="PERIODO" class="per" onchange="ejecuta('E',this.value)" id="peri"></center>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4>Carga de XML</h4>
                </div>
                <div class="panel-body">
                    <p>Carga de XML</p>
                    <center><a href="index.php?action=facturaUploadFile&tipo=F" class="btn btn-default"><img src="http://icons.iconarchive.com/icons/mcdo-design/smooth-leopard/64/Route-Folder-Blue-icon.png"></a></center>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4>Meta Datos</h4>
                </div>
                <div class="panel-body">
                    <center><b>Ver XML sin Procesar</b></center>
                    <center><a href="index.xml.php?action=cargaMetaDatos">Carga de Metadatos</a></center>
                    <center><a href="index.xml.php?action=verMetaDatos">Ver Metadatos</a></center>
                </div>
            </div>
        </div>
        <!--
        <div class="col-md-4">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4><i class="fa fa-list-alt">Carga de XML Cancelados</i></h4>
                </div>
                <div class="panel-body">
                    <p>Carga de XML</p>
                    <center><a href="index.php?action=facturaUploadFile&tipo=C" class="btn btn-default"><img src="http://icons.iconarchive.com/icons/mcdo-design/smooth-leopard/64/Route-Folder-Blue-icon.png"></a></center>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4><i class="fa fa-list-alt">Calcular Impuestos</i></h4>
                </div>
                <div class="panel-body">
                    <p>Calcular impuestos de XML</p>
                    <center><a href="index.php?action=calcularImpuestos" class="btn btn-default"><img src="http://icons.iconarchive.com/icons/mcdo-design/smooth-leopard/64/Route-Folder-Blue-icon.png"></a></center>
                </div>
            </div>
        </div>
         <div class="col-md-4">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4><i class="fa fa-list-alt">Descargas XML</i></h4>
                </div>
                <div class="panel-body">
                    <p>Descargas de XML</p>
                    <center><a href="index_xml.php?action=''" class="btn btn-default"><img src="http://icons.iconarchive.com/icons/mcdo-design/smooth-leopard/64/Route-Folder-Blue-icon.png"></a></center>
                </div>
            </div>
        </div>
         <div class="col-md-4">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4><i class="fa fa-list-alt"> Ver Pagos CEP</i></h4>
                </div>
                <div class="panel-body">
                    <p>Ver Pagos</p>
                    <center><a href="index.v.php?action=verPagos" class="btn btn-default"><img src="http://icons.iconarchive.com/icons/mcdo-design/smooth-leopard/64/Route-Folder-Blue-icon.png"></a></center>
                </div>
            </div>
        </div>
         -->
        </div>
    </div>
<form action="index.php" method="post" id="migrar">
    <input type="hidden" name="docf" id="doc" value="<?php echo $docf?>">
    <input type="hidden" name="refacturarFecha" value="">
    <input type="hidden" name="opcion" value="3">
    <input type="hidden" name="nfecha" value="">
    <input type="hidden" name="obs" placeholder="Observaciones" value="X" id="obs" size="250">
</form>
    <script type="text/javascript">
        
        function ejecuta(tipo, anio){
            //alert("Selecciono el anio "+ anio + " tipo "+ tipo)
            document.getElementById("per").value=''
            document.getElementById("peri").value=''
            window.open("index.php?action=mXMLSP&tipo="+tipo+"&anio="+anio, "self");
            return false;

        }
    </script>