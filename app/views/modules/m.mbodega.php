<div class="container">
        <!-- Marketing Icons Section -->
        <div class="row">
            <div class="col-lg-12">
                <h3 class="page-header">
                </h3>
            </div>
            <div>
                <p><label> Bienvenido: <?php echo $usuario?></label></p>
                <p><label><?php echo $_SESSION['empresa']['nombre'].'<br/>'.$_SESSION['rfc']?></label></p>
            </div>
            <br/>
            
            <div class="col-md-3">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4><i class="fa fa-list-alt"></i> B O D E G A </h4>
                    </div>
                    <div class="panel-body">
                        <p><b>Recibo</b></p>
                        <center><a href="index.php?action=menuB" class="btn btn-default" > <img src="app/views/images/Bodega/bodega_4.png"></a></center>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4><i class="fa fa-list-alt"> Imprimir Facturas</i></h4>
                    </div>
                    <div class="panel-body">
                        <p>Impresion de Facturas</p>
                        <center><a href="index.php?action=imprimeXML" class="btn btn-default"><img src="http://icons.iconarchive.com/icons/mcdo-design/smooth-leopard/64/Route-Folder-Blue-icon.png" width="80" height="80"></a></center>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4><i class="fa fa-list-alt"></i> Liberar Pedidos</h4>
                    </div>
                    <div class="panel-body">
                        <p>Pedidos a Produccion</p>
                        <center><a href="index.php?action=verCajasAlmacen" class="btn btn-default"><img src="app/views/images/boxes-brown-icon.png" width="80" height="80"></a></center>
                    </div>
                </div>
            </div>  
           
    </div>
</div>
    