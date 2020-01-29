<div class="container">
        <!-- Marketing Icons Section -->
        <div class="row">
            <div class="col-lg-12">
                <h3 class="page-header">
                    <!--<img src="app/views/images/logob.jpg">-->
                </h3>
            </div>
            <div>
                <label> Bienvenido: <?php echo $usuario?></label>
            </div>
            <br/>
        <div class="row">
            <div class="col-lg-12">
                <h3 class="page-header">
                    <!--<img src="app/views/images/logob.jpg">-->
                </h3>
            </div>
             
            <div class="col-md-2">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4><i class="fa fa-list-alt"></i> Crear <br/>Pedido</h4>
                    </div>
                    <div class="panel-body">
                        <p>Crear Pedidos</p>
                        <center><a href="index.v.php?action=consultarCotizacion" class="btn btn-default"><img src="app/views/images/folder.png" width="80" height="80"></a></center>
                    </div>
                </div>
            </div> 
            <div class="col-md-2">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4><i class="fa fa-list-alt"></i> Liberar Pedidos</h4>
                    </div>
                    <div class="panel-body">
                        <p>Cajas y Pedidos.</p>
                        <center><a href="index.php?action=verCajasAlmacen" class="btn btn-default"><img src="app/views/images/boxes-brown-icon.png" width="80" height="80"></a></center>
                    </div>
                </div>
            </div>  
             <div class="col-md-2">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4><i class="fa fa-list-alt"></i> Ventas x <br/> Mes</h4>
                    </div>
                    <div class="panel-body">
                        <p>Ventas Mensuales</p>
                        <center><a href="index.v.php?action=cajas" class="btn btn-default"><img src="app/views/images/File-warning-icon.png" width="80" height="80"></a></center>
                    </div>
                </div>
            </div>
            <div class="col-md-2">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4>Imprimir Facturas</h4>
                    </div>
                    <div class="panel-body">
                        <p>Impresion de Facturas</p>
                        <center><a href="index.php?action=imprimeXML" class="btn btn-default"><img src="http://icons.iconarchive.com/icons/mcdo-design/smooth-leopard/64/Route-Folder-Blue-icon.png"></a></center>
                    </div>
                </div>
            </div>
            <div class="col-md-2">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4>Ventas por Cliente</h4>
                    </div>
                    <div class="panel-body">
                        <p>Reporte de Ventas</p>
                        <center><a href="index.v.php?action=repVentas" class="btn btn-default"><img src="http://icons.iconarchive.com/icons/mcdo-design/smooth-leopard/64/Route-Folder-Blue-icon.png" width="80" height="80"> </a></center>
                    </div>
                </div>
            </div>
            <div class="col-md-2">
                <div class="panel panel-default">
                    <div class="panel-heading"> 
                        <h4><i class="fa fa-list-alt"></i> Estado de Pedidos</h4>
                    </div>
                    <div class="panel-body">
                        <p>Consulta detalle</p>
                        <center><a href="index.php?action=pedimento" class="btn btn-default"><img src="http://icons.iconarchive.com/icons/martz90/hex/72/car-icon.png" width="80" height="80"></a></center>
                    </div>
                </div>
            </div>
            <?php if($letra == 'G'){?>
            <div class="col-xs-12 col-md-2">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4><i class="fa fa-list-alt"></i> Realizar Notas de Credito</h4>
                    </div>
                    <div class="panel-body">
                        <p>Notas de Credito y Refacturaciones </p>
                        <center><a href="index.php?action=buscaFacturaNC" class="btn btn-default"><img src="app/views/images/Clipboard-Paste-icon.png" width="80" height="80"></a></center>
                    </div>
                </div>
            </div>
            <div class="col-md-2">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4><i class="fa fa-list-alt"></i> Solicitudes de Margen Bajo </h4>
                    </div>
                    <div class="panel-body">
                        <p>Definir Margen Bajo</p>
                        <center><a href="index.v.php?action=verSMB" class="btn btn-default"><img src="app/views/images/users.png" width="80" height="80"></a></center>
                    </div>
                </div>
            </div>     
            <?php }?>
        </div>
    </div>
</div>