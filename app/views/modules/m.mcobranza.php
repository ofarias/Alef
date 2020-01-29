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
                        <h4><i class="fa fa-list-alt"></i> C L I E N T E S </h4>
                    </div>
                    <div class="panel-body">
                        <p>Clientes y Maestros</p>
                        <center><a href="index.php?action=menuCM" class="btn btn-default" > <img src="app/views/images/Clientes/clientes.png" width="80" height="90"></a></center>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4><i class="fa fa-list-alt"></i> Cobranza </h4>
                    </div>
                    <div class="panel-body">
                        <p>Modulo de Cobranza</p>
                        <center><a href="index.php?action=cxc" class="btn btn-default"> <img src="app/views/images/Cobranza/Cobranza.png" width="80" height="90"></a></center>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4><i class="fa fa-list-alt"></i> XML </h4>
                    </div>
                    <div class="panel-body">
                        <p>Bodega</p>
                        <center><a href="index.php?action=menuXML" class="btn btn-default" > <img src="app/views/images/Xml/Xml.png" width="80" height="90"></a></center>
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
                        <center><a href="index.php?action=imprimeXML" class="btn btn-default"><img src="http://icons.iconarchive.com/icons/mcdo-design/smooth-leopard/64/Route-Folder-Blue-icon.png" width="80" height="90"></a></center>
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-md-3">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4><i class="fa fa-list-alt"></i>Contarrecibos</h4>
                    </div>
                    <div class="panel-body">
                        <p>Documentos con Contrarecibo</p>
                        <center><a href="index.cobranza.php?action=seguimientoCajasRecibir&tipo=7" class="btn btn-default"><img src="app/views/images/User-Files-icon.png" width="80" height="90"></a></center>
                    </div>
                </div>
            </div>

    </div>
</div>
    