<?php
date_default_timezone_set('America/Guayaquil');
$fechaemision=date("d/m/Y");
$secuencia=14;
function invertir_cadena($cadena){
    $cadena_invertida="";
    for($x=strlen($cadena)-1;$x>=0;$x--){
        $cadena_invertida.=$cadena[$x];
    }
    return $cadena_invertida;
}
function calcular_codigo11($cadena){
    $digito_calculado = -1;
    $pivote = 2;
    $longitudCadena = strlen($cadena);
    $cantidadTotal = 0;
    $b = 1;
    for ($i = 0; $i < $longitudCadena; $i++) {
        if ($pivote == 8) {
            $pivote = 2;
        }
        $temporal = intval($cadena[$i]);
        $b++;
        $temporal *= $pivote;
        $pivote++;
        $cantidadTotal += $temporal;
    }
    $digito_calculado = 11 - $cantidadTotal % 11;
    if($digito_calculado==11) $digito_calculado=0;
    if($digito_calculado==10) $digito_calculado=1;
    return $digito_calculado;
}
function generar_clave_acceso($secuencia){
    $codigo=date('dm').substr(formato_cadena($secuencia,9),-4,4);
    $codigoaut=date('dmY')."01".RUC_1."1".ESTABLECIMIENTO_1.PUNTOEMISION_1.formato_cadena($secuencia,9).$codigo."1";
    $codigoinvertido=invertir_cadena($codigoaut);
    $digito_calculado = calcular_codigo11($codigoinvertido);
    if ($digito_calculado > -1) {
        return $codigoaut.$digito_calculado;
    }
}
function formato_cadena($cadena,$longitud){
    if(strlen($cadena)<$longitud){
        $faltan=$longitud-strlen($cadena);
        for($i=0;$i<$faltan;$i++){
            $cadena="0".$cadena;
        }
    }
    return $cadena;
}
header('Content-Type: text/xml');
header('Content-Disposition: attachment; filename="xml.xml"');
echo "<?xml version=\"1.0\" encoding=\"UTF-8\" ?>";
?>
<factura version="2.1.0" id="comprobante">
    <infoTributaria>
        <ambiente>1</ambiente>
        <tipoEmision>1</tipoEmision>
        <razonSocial><?php echo RAZON_SOCIAL_1; ?></razonSocial>
        <nombreComercial><?php echo NOMBRE_COMERCIAL_1; ?></nombreComercial>
        <ruc><?php echo RUC_1; ?></ruc>
        <claveAcceso><?php echo generar_clave_acceso($secuencia);?></claveAcceso>
        <codDoc>01</codDoc>
        <estab><?php echo ESTABLECIMIENTO_1;?></estab>
        <ptoEmi><?php echo PUNTOEMISION_1;?></ptoEmi>
        <secuencial><?php echo formato_cadena($secuencia,9);?></secuencial>
        <dirMatriz><?php echo MATRIZ_1; ?></dirMatriz>
    </infoTributaria>
    <infoFactura>
        <fechaEmision><?php echo $fechaemision?></fechaEmision>
        <dirEstablecimiento><?php echo DIRESTABLECIMIENTO_1;?></dirEstablecimiento>
        <obligadoContabilidad>SI</obligadoContabilidad>
        <tipoIdentificacionComprador>04</tipoIdentificacionComprador>
        <razonSocialComprador>PRUEBAS SERVICIO DE RENTAS INTERNAS</razonSocialComprador>
        <identificacionComprador>1713328506001</identificacionComprador>
        <direccionComprador>Salinas y Santiago</direccionComprador>
        <totalSinImpuestos>60.00</totalSinImpuestos>
        <totalDescuento>0.00</totalDescuento>
        <totalConImpuestos>
            <totalImpuesto>
                <codigo>2</codigo>
                <codigoPorcentaje>2</codigoPorcentaje>
                <baseImponible>60.00</baseImponible>
                <!--<tarifa>12</tarifa>-->
                <valor>7.20</valor>
            </totalImpuesto>
        </totalConImpuestos>
        <propina>0.00</propina>
        <importeTotal>67.20</importeTotal>
        <moneda>DOLAR</moneda>
        <pagos>
            <pago>
                <formaPago>01</formaPago>
                <total>67.20</total>
                <plazo>0</plazo>
                <unidadTiempo>DÍAS</unidadTiempo>
            </pago>
        </pagos>
    </infoFactura>
    <detalles>
        <detalle>
            <codigoPrincipal>015430</codigoPrincipal>
            <descripcion>SECULO 101420114 LAME REAL CHAMPAGNE #37</descripcion>
            <cantidad>1.0</cantidad>
            <precioUnitario>60.00000</precioUnitario>
            <descuento>0.0</descuento>
            <precioTotalSinImpuesto>60.00</precioTotalSinImpuesto>
            <impuestos>
                <impuesto>
                    <codigo>2</codigo>
                    <codigoPorcentaje>2</codigoPorcentaje>
                    <tarifa>12</tarifa>
                    <baseImponible>60.00</baseImponible>
                    <valor>7.20</valor>
                </impuesto>
            </impuestos>
        </detalle>
    </detalles>
</factura>