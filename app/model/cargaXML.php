<?php
require_once 'app/model/database.php';
require_once 'app/model/class.ctrid.php';
require_once 'app/model/verificaID.php';
require_once 'app/model/pegaso.model.reparto.php';
require_once('app/views/unit/commonts/numbertoletter.php');

class cargaXML extends database {

	function cargaCEP($cep){
		$path='C:\\xampp\\htdocs\\Facturas\\FacturasJson\\';
    	$files = array_diff(scandir($path), array('.', '..'));
    	foreach($files as $file){
		    $data = explode(".", $file);
		    $fileName = $data[0];
		    $fileExtension = $data[1];
		    if(strtoupper($fileExtension) == 'XML' and strpos($fileName, 'CEP') !== false){
		    	if(strpos($fileName, 'CEP'.$cep) !== false){
		    	    $file = $path.$fileName.'.'.$fileExtension;
		    	    $myFile = fopen($file, "r") or die("No se ha logrado abrir el archivo ($file)!");
	        	    $myXMLData = fread($myFile, filesize($file));
	        	    $xml = simplexml_load_string($myXMLData) or die("Error: No se ha logrado crear el objeto XML ($file)");
	        	    $ns = $xml->getNamespaces(true);
	        	    $xml->registerXPathNamespace('c', $ns['cfdi']);
	        	    $xml->registerXPathNamespace('t', $ns['tfd']);

	        	     foreach ($xml->xpath('//t:TimbreFiscalDigital') as $tfd) {
			               $fechaT = $tfd['FechaTimbrado']; 
			               $fechaT = str_replace("T", " ", $fechaT); 
			               $uuid = $tfd['UUID'];
			               $noNoCertificadoSAT = $tfd['NoCertificadoSAT'];
			               $RfcProvCertif=$tfd['RfcProvCertif'];
			               $SelloCFD=$tfd['SelloCFD'];
			               $SelloSAT=$tfd['SelloSAT'];
			               $versionT = $tfd['Version'];
			               $rfcprov = $tfd['RfcProvCertif'];
			        }
	        	    foreach ($xml->xpath('//cfdi:Comprobante') as $cfdiComprobante){
            		  	$version = $cfdiComprobante['version'];
					  	if($version == ''){
					  		$version = $cfdiComprobante['Version'];
					  	}
					  	if($version == '3.2'){
					    }elseif($version == '3.3'){
					      	$serie = $cfdiComprobante['Serie'];                  
	        	          	$folio = $cfdiComprobante['Folio'];
	        	          	$total = $cfdiComprobante['Total'];
	        	          	$tipo = $cfdiComprobante['TipoDeComprobante'];
						  	$moneda = $cfdiComprobante['Moneda'];
						  	$lugar = $cfdiComprobante['LugarExpedicion'];
						  	$Certificado = $cfdiComprobante['Certificado'];
						  	$Sello = $cfdiComprobante['Sello'];
						  	$noCert = $cfdiComprobante['NoCertificado'];
						  	$fecha = $cfdiComprobante['Fecha'];
						  	$fecha = str_replace("T", " ", $fecha);
						  	$subtotal = $cfdiComprobante['SubTotal'];
					  	}
					}

					foreach ($xml->xpath('//cfdi:Emisor') as $emi){
            		  	if($version == '3.2'){
					    }elseif($version == '3.3'){
					      	$rfce=$emi['Rfc'];
	        	        	$emisor=$emi['Nombre'];
	        	        	$rf = $emi['RegimenFiscal'];
	        	        }
					}

					foreach ($xml->xpath('//cfdi:Receptor') as $rec){
            		  	if($version == '3.2'){
					    }elseif($version == '3.3'){
					      	$rfcr=$rec['Rfc'];
	        	        	$recep=$rec['Nombre'];
	        	        	$UsoCFDI = $rec['UsoCFDI'];
	        	        }
					}
					if($tipo == 'P'){
						$this->query="INSERT INTO FTC_CEP_XML (UUID, VERSION, SERIE, FOLIO, FECHA, SUBTOTAL, MONEDA, TOTAL, TIPODECOMPROBANTE, LUGAREXPEDICION, VERSIONTIMBREFISCAL , FECHATIMBRADO, NOCERTIFICADOSAT, VERSIONPAGOS, SELLOCFD, SELLOSAT, RFCEMISOR, NOMBREEMISOR, RFCRECEPTOR, NOMBRERECEPTOR, USOCFDIRECEPTOR, RfcProvCertif, XMLNSPAGO10, REGIMENFISCALEMISOR ) 
			        		VALUES ('$uuid', '$version', '$serie', '$folio', '$fecha', $subtotal, '$moneda', $total , '$tipo', '$lugar', '$version', '$fechaT', '$noNoCertificadoSAT', '$versionT', '$SelloCFD', '$SelloSAT', '$rfce', '$emisor', '$rfcr', '$recep', '$UsoCFDI', '$rfcprov',  '', '$rf')";
				        $this->grabaBD();

						$this->query="INSERT INTO FTC_CEP_XML_DOCUMENTO (UUID, DOCUMENTORELACIONADO, NUMEROPAGO, FOLIO, SERIE, MONEDA, METODODEPAGO, NUMPARCIALIDAD, SALDOANT, PAGADO, SALDOINSOLUTO ) 
						  		VALUES ('$uuid', '', 1, '$folio', '$serie', '$moneda', 'PPD', 0, 0, 0, 0 )";
						$this->grabaBD();
					}
					
		    	}else{
		    	}
		    }
		}
		return array("status"=>'no',"mensaje"=>'No se encontro el Archivo', "archivo"=>'no');
	}

	function leeMetaDatos($archivo){
		$fp=fopen($archivo,'r');
		$l=0;
		$r=0;
		while(!feof($fp)) {
			$linea = fgets($fp);
			if($l > 0){
				$d=explode("~", utf8_encode($linea));
				$rfce=$d[1];
				$rfcr=$d[3];
				$rfc=$_SESSION['rfc'];
				if($rfce == $rfc or $rfcr == $rfc){
					return array("status"=>'ok', "lineas"=>$l,"mensaje"=>'Se encontro el rfc en la primer linea.',"rfce"=>$rfce, "rfcr"=>$rfcr);
				}else{
					return array("status"=>'No', "lineas"=>$l,"mensaje"=>'Al parecer el archivo no es de la empresa seleccionada',"rfce"=>$rfce, "rfcr"=>$rfcr);
				}
			}
			$l++;
		}
		fclose($fp);
	}

	function insertarMetaDatos($archivo){
		//echo $archivo;
		$usuario = $_SESSION['user']->NOMBRE;
		$fp=fopen($archivo,'r');
		$l=0;
		$r=0;
		$this->query="SELECT * FROM FTC_META_DATOS WHERE ARCHIVO='$archivo'";
		$rs=$this->EjecutaQuerySimple();
		$row=ibase_fetch_object($rs);
		if(!empty($row)){
			echo 'El Archivo <b>'.$archivo.'</b> ya fue Cargado por <b>'.$row->USUARIO.'</b> el <b>'. $row->FECHA_CARGA.'</b><br/>';
			return;
		}							
		while(!feof($fp)){
			$linea = fgets($fp);
			if($l > 0){
				$d=explode("~", utf8_encode($linea));
				//echo 'Valor de la linea '.count($d).'<br/>'; el valor de una linea normal 10 y 11 si esta cancelado
				if(count($d)>=10){
					if(strlen($d[11]) > 2){
						$fc = "'".trim($d[11])."'";
					}else{
						$fc = 'null';
					}
					$nombre_e=str_replace("'", "", $d[2]);
					$nombre_r=str_replace("'", "", $d[4]);
					$this->query="INSERT INTO FTC_META_DATOS (IDMD, UUID, RFCE, NOMBRE_EMISOR, RFCR, NOMBRE_RECEPTOR, RFCPAC, FECHA_EMISION, FECHA_CERTIFICACION, MONTO, EFECTO_COMPROBANTE, STATUS, FECHA_CANCELACION, ARCHIVO, FECHA_CARGA, USUARIO, PROCESADO, UUID_ORIGINAL) 
									VALUES (NULL, '$d[0]', '$d[1]', '$nombre_e', '$d[3]', '$nombre_r', '$d[5]', '$d[6]','$d[7]', $d[8], '$d[9]', $d[10], ".$fc.", '$archivo', current_timestamp, '$usuario', 0, (SELECT UUID FROM XML_DATA X WHERE X.UUID CONTAINING('$d[0]')))";
					$res=$this->grabaBD();
					/*
					if($res==1){
						$r+=$res;
						if(strlen($d[11]) > 2){
							$this->query="UPDATE XML_DATA SET STATUS = 'C' WHERE UPPER(UUID) = UPPER('$d[0]')";
							$r=$this->queryActualiza();
							if($r==1){
								$this->query="UPDATE FTC_META_DATOS SET PROCESADO = 1 WHERE UPPER(UUID) = UPPER('$d[0]') AND FECHA_CANCELACION IS NOT NULL";
								$this->queryActualiza();
							}
						}
					}else{
						echo '<br/>'.$this->query.'<br/>';
					}
					*/
				}elseif(count($d)>2 and count($d)<10){/// esta linea esta incompleta y es caso de estudio.
					echo '<br/>Registro en 2 lineas: '.$l.'en el archivo '.$archivo.' valor de la linea: '.count($d);
				}
			}
			$l++;
		}
		fclose($fp);
		/*
		$borrados = array();
		$this->query="SELECT * FROM FTC_META_DATOS WHERE archivo = '$archivo' and FECHA_CANCELACION IS NOT NULL";
		$res=$this->EjecutaQuerySimple();
		while ($tsArray=ibase_fetch_object($res)) {
			$borrados[] =$tsArray;
		}
		if(count($borrados) >0){
			//echo 'arma el correo';
			return array("status"=>'borrados', "data"=>$borrados);
		}
		*/
		return array("status"=>'ok', "data"=>'0');
	}

	function nomMeta(){
		$path="C:\\xampp\\htdocs\\meta\\";
		foreach($_SESSION['coi'] as $emp){
			!empty($emp['rfc'])? $empr[]=$emp['rfc']:'';
		}
		if(file_exists($path)){
			$files=array_diff(scandir($path), array('.', '..'));
			$i=0;
			foreach($files as $file){
				$i++;
		    $data = explode(".", $file);
		    $fileName=$data[0];
		    @$fileExtension = $data[1];
		    	if($fileExtension=='txt'){
		    	    $f=fopen($path.$file,'r');
		    	    $l=1;
		    	     while(!feof($f)) {
						$linea=fgets($f);
						$lin=explode('~', $linea);
						$nf=$i.'_'.$lin[1]."_".$lin[3]."_".$fileName.".txt";
						if($l == 2); //echo $lin[1]."-".$lin[3]."<br />";
						$l++;
						if($l>2)break;
					}
					fclose($f);
					rename( $path.$file, $path.$nf);	

					if(in_array($lin[1], $empr)){
					//echo '<br/> Se encontro el rfc: '.$lin[1].' en el array de empresas';
						if(file_exists($path.$lin[1])){
							copy($path.$nf, $path.$lin[1].'\\'.$nf);
							unlink($path.$nf);
						}else{
							mkdir($path.$lin[1]);
							copy($path.$nf, $path.$lin[1].'\\'.$nf);
							unlink($path.$nf);
						}
					}else{
					//echo '<br/> No se encontro el rfc: '.$lin[1].' en el array de empresas';
						if(file_exists($path.$lin[3])){
							copy($path.$nf, $path.$lin[3].'\\'.$nf);
							unlink($path.$nf);
						}else{
							mkdir($path.$lin[3]);
							copy($path.$nf, $path.$lin[3].'\\'.$nf);
							unlink($path.$nf);
						}
					}
		    	}
			}
		}
	}

	function cancelaAdm($doc){
		$this->query="UPDATE FTC_NC set status = 9 WHERE DOCUMENTO = '$doc' and status != 9 and status != 8";
		$res=$this->queryActualiza();
		//$row = ibase_fetch_object($res);
		if(!empty($res)){
			$this->query ="UPDATE FTC_FACTURAS F SET 
				F.SALDO_FINAL = F.SALDO_FINAL + (SELECT NCI.TOTAL FROM FTC_NC NCI WHERE NCI.DOCUMENTO = '$doc'), 
				F.MONTO_NC = F.MONTO_NC - (SELECT NCC.TOTAL FROM FTC_NC NCC WHERE NCC.DOCUMENTO = '$doc'),
				F.NOTAS_CREDITO = coalesce( cast( (select list(documento) from ftc_nc ncf  where ncf.NOTAS_CREDITO = f.documento AND STATUS != 9 AND STATUS != 8) as varchar(100)), '') 
				WHERE 
					F.DOCUMENTO CONTAINING( (SELECT NCD.NOTAS_CREDITO FROM FTC_NC NCD WHERE NCD.DOCUMENTO = '$doc'))";
			//echo $this->query;

			$this->EjecutaQuerySimple();
			return array("mensaje"=>'Se Cancelo la Nota de credito');
		}else{
			return array("mensaje"=>'La nota ya ha sido cancelada');
		}
		exit;
	}


}