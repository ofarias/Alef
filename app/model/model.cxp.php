<?php

require_once 'app/model/database.php';
class pegasoCxP extends database {

	function proveedor($prov){
		$this->query="SELECT P.*, P.NOM_BANCO||P.CUENTA AS BANCOSAT FROM PROV01 P WHERE P.CLAVE = '$prov'";
		$rs=$this->EjecutaQuerySimple();
		while ($tsArray=ibase_fetch_object($rs)){
			$data[]=$tsArray;
		}
		return $data;
	}	

	function edoCtaProv($prov){
		$data=array();
		$this->query="SELECT * FROM FTC_POC WHERE CVE_PROV = '$prov'";
		$res=$this->EjecutaQuerySimple();
		while ($tsArray=ibase_fetch_object($res)) {
			$data[]=$tsArray;
		}
		return $data;
	}

	function verCxP(){
		$data=array();
		$this->query="SELECT B.BENEFICIARIO, B.CVE_PROV, count(case when (status_pago is null) then A.FOLIO end) as contrarecibos, min(A.FECHA_IMPRESION) as Antiguo, max(B.PROMESA_PAGO) nuevo, min(A.TIPO) as Total_Ordenes, count(B.OC), count(B.FACTURA),
						SUM(CASE WHEN (status_pago is null) THEN B.MONTOR ELSE 0 END) monto,
                        SUM(B.v0) AS SIN_VENCER,
                        SUM(B.V7) AS V7,
                        SUM(B.V15) AS V15,
                        SUM(B.V30) AS V30,
                        SUM(B.V31) AS V31, 
                        sum(CASE WHEN (SOLICITUDES > 0) THEN B.MONTO_REAL ELSE 0 END) AS SOLICITUDES, 
                        
                        (SELECT COALESCE(SUM(MONTO),0) FROM P_CHEQUES CH LEFT JOIN FTC_POC PR ON PR.OC = CH.DOCUMENTO WHERE CH.CVE_PROV = B.CVE_PROV AND (PR.GUARDADO = 0 OR PR.GUARDADO IS NULL)) AS CHEQUES
                        
                        FROM OC_CREDITO_CONTRARECIBO A 
                        INNER JOIN OC_PAGOS_CREDITO_RECIBO B ON A.IDENTIFICADOR = cast(B.RECEPCION as varchar(10))
                        where A.STATUS = 'IM' AND 
                        (B.STATUS_PAGO is null or B.SOLICITUDES >0)
                        group by B.BENEFICIARIO, B.CVE_PROV
                        ORDER BY B.BENEFICIARIO ASC";
        $res=$this->EjecutaQuerySimple();
		while ($tsArray=ibase_fetch_object($res)) {
			$data[]=$tsArray;
		}
		return $data;
	}

    function verCxpChP($prov){
            $data=array();
            $pr='';
            foreach ($prov as $p){
                $pr.= ", '".trim($p->CVE_PROV)."'";
            }
            $pr=substr($pr,1);
            $this->query="SELECT CH.BENEFICIARIO, CH.CVE_PROV, SUM(CH.MONTO) AS MONTO, COUNT(CH.ID) AS CHQS FROM P_CHEQUES CH LEFT JOIN FTC_POC O ON O.OC = CH.DOCUMENTO LEFT JOIN PROV01 P ON P.CLAVE = CH.CVE_PROV WHERE (O.GUARDADO = 0 OR GUARDADO IS NULL) AND trim(CH.CVE_PROV) NOT IN ($pr) GROUP BY CH.BENEFICIARIO, CH.CVE_PROV";
            $res=$this->EjecutaQuerySimple();
            while ($tsArray=ibase_fetch_object($res)) {
                $data[]=$tsArray;
            }
        return $data; 
    }

	function verDetCxP($prov){
		$data=array();
		$this->query="SELECT A.FOLIO, A.FECHA_IMPRESION, B.PROMESA_PAGO, A.TIPO, A.IDENTIFICADOR, A.USUARIO, B.RECEPCION, B.OC, B.FACTURA, B.MONTOR, B.BENEFICIARIO, B.VENCIMIENTO,	B.V0, B.V7, B.V15, B.V30, B.V31  
                          FROM OC_CREDITO_CONTRARECIBO A 
                          INNER JOIN OC_PAGOS_CREDITO_RECIBO B ON A.IDENTIFICADOR = cast(B.RECEPCION as varchar(10))
                          where A.STATUS = 'IM' AND 
                          B.STATUS_PAGO is null
                          and trim(B.CVE_PROV) = Trim('$prov') 
                          --and FECHA_IMPRESION > '01.06.2017'
                          ORDER BY B.BENEFICIARIO ASC";
        $res=$this->EjecutaQuerySimple();
        while ($tsArray=ibase_fetch_object($res)){
        	$data[]=$tsArray;
        }
        return $data;
	}

	function verSolPen($prov){
		$data=array();
        $this->query="SELECT S.*, cast( (select list(ID) from OC_PAGOS_CREDITO_RECIBO o where o.id_solicitud = S.IDSOL) AS varchar(100))  as OC,
    CAST((select list('CRP'||FOLIO) from oc_credito_contrarecibo cr where identificador in (select o.recepcion from OC_PAGOS_CREDITO_RECIBO o where o.id_solicitud = S.IDSOL) ) AS VARCHAR(100)) as crs, 
    	cast( (select list(factura) from OC_PAGOS_CREDITO_RECIBO o where o.id_solicitud = S.IDSOL) AS varchar(100))  as factura,
    	cast( (select list(recepcion) from OC_PAGOS_CREDITO_RECIBO o where o.id_solicitud = S.IDSOL) AS varchar(100))  as RECEPCION,
    	(SELECT NOMBRE FROM PROV01 P WHERE trim(P.CLAVE) = TRIM('$prov')) AS PROV
    FROM SOLICITUD_PAGO S WHERE trim(S.PROVEEDOR) = trim('$prov') and (S.guardado = 0 or S.guardado is null)";
        $res=$this->EjecutaQuerySimple();
        while ($tsArray=ibase_fetch_object($res)){
        	$data[]=$tsArray;
        }
        return $data;
	}

    function verChPost($prov){
        $data=array();
        $this->query="SELECT CH.*, PR.*, (SELECT max(ID_RECEPCION) FROM FTC_DETALLE_RECEPCIONES DR WHERE DR.ORDEN = CH.documento GROUP BY ID_RECEPCION) AS RECEPCIONES FROM P_CHEQUES CH LEFT JOIN FTC_POC PR ON PR.OC = CH.DOCUMENTO WHERE trim(CH.CVE_PROV)='$prov' AND (PR.GUARDADO = 0 OR PR.GUARDADO IS NULL)";
        $res=$this->EjecutaQuerySimple();
        while ($tsArray=ibase_fetch_object($res)) {
            $data[]=$tsArray;
        }
        return $data;
    }
}
?>