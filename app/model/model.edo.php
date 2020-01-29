<?php

require_once 'app/model/database.php';
/* Clase para hacer uso de database */
class data_edo_fin extends database {

    function edo_fin($anio){
        $data=array();
        $this->query="SELECT f.*, (select first 1 nombre from periodos_2016 where numero = f.mes  ) as NOMBRE  FROM FTC_EDO_FIN f where f.anio = $anio ";
        $res = $this->EjecutaQuerySimple();
        while ($tsArray=ibase_fetch_object($res)) {
            $data[]=$tsArray;
        }
        return $data;
    }

    function calcular($id){
        $this->query="SELECT * FROM FTC_EDO_FIN WHERE ID = $id";
        $res=$this->EjecutaQuerySimple();
        $row = ibase_fetch_object($res);
            $ventas = $this->ventas($id, $mes=$row->MES, $anio=$row->ANIO);
            $refact = $this->refact($mes, $anio);
            $ncs = $this->ncs($mes, $anio);
            $compras = $this->compras($mes, $anio);
            $crdirecto = $this->crdirecto($mes, $anio);
            $gastos = $this->gastos($mes, $anio);
            $cheques = $this->cheques($mes, $anio);

        echo '<br/>Compras (FTC_POC): $ '.number_format($compras,2).'<br/>';
        echo '<br/>Compras Directas: (CR_Directo). $ '.number_format($crdirecto,2).'<br/>';
        echo '<br/>Compras con Cheque: (SOLICITUD_PAGO) $ '.number_format($cheques,2).'<br/>';
        
        echo '<br/>Total Compras: $ '.number_format($compras + $crdirecto + $cheques);
        echo '<br/>Gastos (GASTOS) $ '.number_format($gastos,2);

        $compras = $compras + $crdirecto + $cheques;
        $gastos = $gastos;
        $this->query="UPDATE FTC_EDO_FIN SET 
                                    FACTURAS = $ventas, 
                                    REFACTURACIONES =$refact, 
                                    NOTAS_CREDITO = $ncs, 
                                    COMPRAS_PAGADAS= $compras,
                                    GASTOS = $gastos
                            WHERE ID= $id";
        $this->queryActualiza();

    }

    function ventas($id_edo, $mes, $anio){
        $this->query="SELECT coalesce(sum(TOTAL),0) AS VENTAS FROM FTC_FACTURAS WHERE EXTRACT(MONTH FROM FECHA_DOC) =$mes and extract(year from fecha_doc) = $anio and serie='A' ";
        $res=$this->EjecutaQuerySimple();
        $row = ibase_fetch_object($res);
        return $row->VENTAS;
    }   

    function refact($mes, $anio){
        $this->query="SELECT coalesce(sum(TOTAL),0) AS VENTAS FROM FTC_FACTURAS WHERE EXTRACT(MONTH FROM FECHA_DOC) =$mes and extract(year from fecha_doc) = $anio and serie!='A' ";
        $res=$this->EjecutaQuerySimple();
        $row = ibase_fetch_object($res);
        return $row->VENTAS;
    }

    function ncs($mes, $anio){
        $this->query="SELECT coalesce(sum(TOTAL),0) AS NCS FROM FTC_NC WHERE EXTRACT(MONTH FROM FECHA_DOC) =$mes and extract(year from fecha_doc) = $anio and status != 9   ";
        $res=$this->EjecutaQuerySimple();
        $row = ibase_fetch_object($res);
        return $row->NCS;
    }

    function compras($mes, $anio){
        $this->query="SELECT coalesce(SUM(PAGO_TES),0) as compra 
                        FROM FTC_POC WHERE extract(month from EDOCTA_FECHA) = $mes and extract( year from EDOCTA_FECHA) = $anio and guardado = 1 and (tp_tes starting with  ('tr') or tp_tes starting with  ('e'))";
        $res=$this->EjecutaQuerySimple();
        $row = ibase_fetch_object($res);
        return $row->COMPRA;
    }

    function crdirecto($mes, $anio){
        $this->query="SELECT COALESCE(SUM(IMPORTE), 0 ) as CR 
                        FROM CR_DIRECTO WHERE EXTRACT(MONTH FROM FECHA_EDO_CTA ) = $mes and EXTRACT(YEAR FROM FECHA_EDO_CTA)= $anio and GUARDADO = 1 AND (TP_TES starting WITH 'tr' or TP_TES starting WITH 'e')";
        $res=$this->EjecutaQuerySimple();
        $row = ibase_fetch_object($res);
        return $row->CR;
    }

    function gastos($mes, $anio){
        $this->query="SELECT COALESCE(SUM(MONTO_PAGO), 0) AS GASTO 
                        FROM GASTOS G LEFT JOIN PAGO_GASTO PG ON G.ID = PG.IDGASTO WHERE (TIPO_PAGO = 'transferencia' or TIPO_PAGO = 'efectivo') and GUARDADO = 1 AND (EXTRACT(MONTH FROM FECHA_EDO_CTA) = $mes or EXTRACT(MONTH FROM FECHA_DOC)= $anio) and (EXTRACT(YEAR FROM FECHA_EDO_CTA) = $anio or EXTRACT(YEAR FROM FECHA_DOC)= $anio)";
        $res=$this->EjecutaQuerySimple();
        $row=ibase_fetch_object($res);
        return $row->GASTO;
    }

    function cheques($mes, $anio){
        $this->query="SELECT COALESCE(SUM(MONTO_FINAL), 0) AS CH 
                        FROM SOLICITUD_PAGO WHERE GUARDADO = 1 AND EXTRACT(YEAR FROM FECHA_EDO_CTA) = $anio and EXTRACT(MONTH FROM FECHA_EDO_CTA) = $mes";
        $res=$this->EjecutaQuerySimple();
        $row = ibase_fetch_object($res);
        return $row->CH;
    }

    function traeConfiguracion(){
        $data=array();
        $this->query="SELECT * FROM FTC_PARAM_COI";
        $res=$this->EjecutaQuerySimple();
        while ($tsArray=ibase_fetch_object($res)){
            $data=$tsArray;
        }
        return $data; 
    }

    function traeCuentaCliente($info, $ide){
        foreach ($info as $key) {
            if($ide == 'Emitidos'){
                $rfce=$key->CLIENTE;
            }else{
                $rfce=$key->RFCE;
            }
            $cuenta=$key->CUENTA_CONTABLE;       
        }
        $this->query="SELECT * FROM CUENTAS19 WHERE TRIM(NUM_CTA)=TRIM('$cuenta')";
        $res=$this->EjecutaQuerySimple();
        $row=ibase_fetch_object($res);
        if($row){
            $cuenta = $row->NUM_CTA;
            $nombre = $row->NOMBRE;
            return trim($rfce).':'.$nombre.'->'.$cuenta;
        }else{
            return 'Sin Cuenta Actual';
        }
    }

    function traeCuentasSAT($info){
        $data=array();
        foreach ($info as $key) {
            $rfc=$key->RFC;       
            $cveSat=$key->CLAVE_SAT;
            $uniSat=$key->UNIDAD_SAT;
            $cuenta=$key->CUENTA_CONTABLE;
            $this->query="SELECT * FROM CUENTAS19 WHERE TRIM(NUM_CTA)=TRIM('$cuenta') ";
            $res=$this->EjecutaQuerySimple();
            while($tsArray=ibase_fetch_object($res)){
                $data[]=$tsArray;
            }
        }
        return $data;
    }

   
}      
?>
