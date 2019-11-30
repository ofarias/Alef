<div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h3 class="page-header">Cedulas de Cobranza </h3>
            </div>
             <?php foreach($c as $ced):?>
                <div class="col-md-3">
                  <div class="panel panel-default">
                      <div class="panel-heading">
                          <h4 title="<?php echo $ced->NOMBRE?>"><?php echo substr($ced->NOMBRE,0,19)?></h4>
                          <h5><?php echo 'Clave: '.$ced->CC?></h5>
                          <!--<h5><?php echo 'Cartera: '.$ced->CARTERA.' Revision: '.$ced->CARTERA_REVISION?></h5>-->
                      </div>
                      <div class="panel-body<?php echo $ced->ID?>">
                          <p title="Centros de Credito?>">
                            <a href="index.cobranza.php?action=detDocCobr&idr=<?php echo $idr?>&cc=<?php echo $ced->CC?>" 
                                target="popup" 
                                onclick="window.open(this.href, this.target, 'width=1200, height=900')"
                                >Por Cobrar: <?php echo $ced->XCOBRAR?>    
                            </a>
                          </p>
                          <P><a href="index.cobranza.php?action=CarteraxCCC&clave=<?php echo urlencode($ced->CC)?>&tipo=v" target="popup" onclick="window.open(this.href, this.target, 'width=1200, height=800'); return false;">Cobrado:</a> <font color="blue"><?php echo '$ '.number_format($ced->COBRADO,2)?></font>
                          </P>

                          <P><a href="index.cobranza.php?action=CarteraxCCC&clave=<?php echo  urlencode($ced->CC)?>&tipo=sv" target="popup" onclick="window.open(this.href, this.target, 'width=1200, height=800'); return false;">Vencido:</a> <font color="green"><?php echo '$ '.number_format($ced->XCOBRAR - $ced->COBRADO,2)?></font>
                          </P>
                          <p>
                            <button class="btn-sm btn-info cerrar" cc="<?php echo $ced->CC?>" idr="<?php echo $idr?>" ven="<?php echo $ced->XCOBRAR - $ced->COBRADO?>">Cerrar Ruta</button>
                          </p>
                          
                      </div>
                    </div>
                </div>
            <?php endforeach;?>
        </div>
</div>

<script src="//code.jquery.com/jquery-1.10.2.js"></script>
<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.0/themes/base/jquery-ui.css">
<link rel="stylesheet" href="/resources/demos/style.css">
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.0/jquery-ui.js"></script>
<script type="text/javascript">
    $(".cerrar").click(function(){
      var cc = $(this).attr('cc')
      var idr = $(this).attr('idr') 
      var ven = parseFloat($(this).attr('ven'))
      if(ven == 0){
        alert('Desea Cerrar la ruta' + idr + ' del Centro' + cc)
      }else{
        $.ajax({
          url:'index.cobranza.php',
          type:'post',
          dataType:'json',
          data:{auditRuta:1, cc, idr},
          success:function(data){
            if(data.docs == 0){

            }else{
              alert('Existen ' +  docsV + ' de ' + docsC + ', para cerrar la ruta debe de cerrar los documentos individualmente...')
            }
          },  
          error:function(){
            alert('Upsss encontramos una inconsistencia en los datos, favor de actualizar y revisar la informacion')
          }
        })
      }
    })
</script>
            