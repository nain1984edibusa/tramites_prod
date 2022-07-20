<style type="text/css">
<!--
table { vertical-align: top; }
tr    { vertical-align: top; }
td,th    { vertical-align: top; height:10px; padding: 5pt;}
.superior td{ height: 13px; padding: 5pt;border-bottom: 1px dashed grey;}
.superior th{ height: 13px; border-bottom: 1px solid grey; padding: 5pt;}
.etiqueta{
    font-size: 10pt;
}
.txt_invisible{
    color:white;
}
.border-top{
	border-top: solid 1px #bdc3c7;
	
}
.border-left{
	border-left: solid 1px #bdc3c7;
}
.border-right{
	border-right: solid 1px #bdc3c7;
}
.border-bottom{
	border-bottom: solid 1px #bdc3c7;
}
p.formas_pago{
    width:100%; 
    margin:-7px 0px 0px 45px; 
    font-size:8pt;
}
p{
    font-size: 10pt;
    margin: 0px;
    padding: 5px 0px;
}
h3{
    color: #006699;
    text-align: center;
}
h4{
    font-size: 13pt;
    margin: 20px 0px 0px 0px;
}
h5{
    font-size: 11pt;
    color: #0099cc;
}
hr{
    color: #bdc3c7;
    padding: 0px;
    margin: 0px;
    border: 1px dashed #bdc3c7;
}
.especial{
    background: #ffffcc;
}
.especial2{
    background: #f0f0ff;
}
.tbbordes{
    border:3px solid #bdc3c7;
    padding: 10px;
}
table.page_footer {width: 100%; border: none; background-color: white; padding: 2mm;border-collapse:collapse; border: none;}
} 
-->
</style>
<?php
/*$total_ctasxcobrar=0;
$total_separado=0;
$conexiones=array("con1","con2","con3");
$bds=array("smart_syscatleia_comercial","smart_syscatleia_comercial2","smart_syscatleia_comercial3");
$ips=array(IP_COMERCIAL_1,IP_COMERCIAL_2,IP_COMERCIAL_3);
$empresa=array(RAZON_SOCIAL_1,RAZON_SOCIAL_2,RAZON_SOCIAL_3);*/
?>
<page backtop='38mm' backbottom='20mm' backleft='10mm' backright='10mm' footer='page' >
  <page_footer>
    <!--[[page_cu]]/[[page_nb]]-->
  </page_footer>
    <page_header>
        <img src="../../img/encabezado_portrait.jpg">
        <h3>REPORTE CUENTAS POR PAGAR</h3>
    </page_header>
    <table style="width: 100%">
        <tr>
            <th style="width: 25%">Fecha de corte:</th>
            <td style="width: 25%"><?php echo date("Y-m-d");?></td>
            <th style="width: 25%"></th>
            <td style="width: 25%"></td>
        </tr>
    </table>
<?php
$total_ctasxpagar=0;
switch($tipodetalle){
    case "xcliente":
?>
    <table class="superior" cellspacing="0" style="margin-left:10%;width: 100%;font-size: 10pt;">
        <tr>
            <th style="width: 40%">PROVEEDOR</th>
            <th style="width: 20%">RUC/CI</th>
            <th style="width: 10%;text-align:right">TOTAL Fact</th>
            <th style="width: 10%;text-align:right">TOTAL x Pagar (-Ret)</th>
            <th style="width: 10%;text-align:right">TOTAL Abonado</th>
            <th style="width: 10%;text-align:right">SALDO</th>
        </tr>
<?php
        $sql_porcliente=mysqli_query($$_SESSION['bd_comercial'],"select sum(bimponible_iva0) as bimponible_iva0,sum(bimponible_ivax) as bimponible_ivax,sum(movimientos.total_venta) as total, sum(importe_iva) as importe_iva, sum(retencion_fuente) as retencion_fuente, sum(retencion_iva) as retencion_iva, movimientos.id_movimiento, proveedores.* from movimientos INNER JOIN proveedores ON movimientos.id_proveedor=proveedores.id_proveedor where (proceso='COM' or proceso='GAS' or proceso='CXP') and estado_factura='0' group by movimientos.id_proveedor");
        while($row_cliente=  mysqli_fetch_array($sql_porcliente))
        {
            $base0=floatval($row_cliente["bimponible_iva0"]);
            $basex=floatval($row_cliente["bimponible_ivax"]);
            $base=$base0+$basex-floatval($row_cliente["retencion_fuente"]);
            $ret_iva=floatval($row_cliente["importe_iva"])-floatval($row_cliente["retencion_iva"]);
            $base_sinretencion=$base+$ret_iva;
            $id_proveedor=$row_cliente["id_proveedor"];
            $total_facturas=$row_cliente["total"];
            $sql_deuda=mysqli_query($$_SESSION['bd_comercial'],"select sum(valor_abonado)as abonado from pagos_ctsxpagar WHERE saldo!='0.00' and movimiento IN (select id_movimiento from movimientos WHERE (proceso='COM' or proceso='GAS' or proceso='CXP') and estado_factura='0' and id_proveedor='$id_proveedor')");
            $row_deuda=  mysqli_fetch_array($sql_deuda);
            $adeudado=floatval($base_sinretencion)-floatval($row_deuda["abonado"]);
?>
        <tr>
            <td style="width: 40%"><?php echo $row_cliente["nombre_proveedor"]; ?></td>
            <td style="width: 20%"><?php echo $row_cliente["ruc_ci"];?></td>
            <td style="width: 10%;text-align:right"><?php echo number_format($total_facturas,2,'.','');?></td>
            <td style="width: 10%;text-align:right"><?php echo number_format($base_sinretencion,2,'.','');?></td>
            <td style="width: 10%;text-align:right"><?php echo number_format($row_deuda["abonado"],2,'.','');?></td>
            <td style="width: 10%;text-align:right"><?php echo number_format($adeudado,2,'.','');?></td>
        </tr>
<?php
            $total_ctasxpagar+=floatval($adeudado);
        }
?>
        <tr><td colspan="5" style="text-align:right"><b>Total</b></td><td style="text-align:right"><b>$ <?php echo number_format($total_ctasxpagar,2,'.',''); ?></b></td></tr>
    </table>
<?php
        break;
    case "xfactura":
?>
    <table class="superior" cellspacing="0" style="margin-left:10%;width: 100%;font-size: 9pt;"> 
        <tr>
            <th style="width: 10%">FECHA</th>
            <th style="width: 20%">PROVEEDOR</th>
            <th style="width: 15%">RUC/CI</th>
            <th style="width: 15%; text-align:center"># FACTURA</th>
            <th style="width: 10%; text-align:right">TOTAL Fac</th>
            <th style="width: 10%; text-align:right">TOTAL x Pagar (-Ret)</th>
            <th style="width: 10%; text-align:right">TOTAL Abonado</th>
            <th style="width: 10%; text-align:right">SALDO</th>
        </tr>
<?php
        $sql_porcliente=mysqli_query($$_SESSION['bd_comercial'],"select movimientos.total_venta as total, movimientos.*, proveedores.* from movimientos INNER JOIN proveedores ON movimientos.id_proveedor=proveedores.id_proveedor where (proceso='COM' or proceso='GAS' or proceso='CXP') and estado_factura='0'");
        while($row_cliente=  mysqli_fetch_array($sql_porcliente))
        {
            $base0=floatval($row_cliente["bimponible_iva0"]);
            $basex=floatval($row_cliente["bimponible_ivax"]);
            $base=$base0+$basex-floatval($row_cliente["retencion_fuente"]);
            $ret_iva=floatval($row_cliente["importe_iva"])-floatval($row_cliente["retencion_iva"]);
            $base_sinretencion=$base+$ret_iva;
            $id_movimiento=$row_cliente["id_movimiento"];
            $sql_deuda=mysqli_query($$_SESSION['bd_comercial'],"select sum(valor_abonado)as abonado from pagos_ctsxpagar WHERE movimiento='$id_movimiento'");
            $total_facturas=$row_cliente["total"];
            $row_deuda=  mysqli_fetch_array($sql_deuda);
            $adeudado=floatval($base_sinretencion)-floatval($row_deuda["abonado"]);
            $total_ctasxpagar+=$adeudado;
?>
        <tr>
            <td style="width: 10%"><?php echo substr($row_cliente["fecha_movimiento"],0,10);?></td>
            <td style="width: 20%"><?php echo $row_cliente["nombre_proveedor"]; ?></td>
            <td style="width: 15%"><?php echo $row_cliente["ruc_ci"]; ?></td>
            <td style="width: 15%; text-align:center"><?php echo $row_cliente["numero_factura"]?></td>
            <td style="width: 10%; text-align:right"><?php echo number_format($total_facturas,2,'.','');?></td>
            <td style="width: 10%; text-align:right"><?php echo number_format($base_sinretencion,2,'.','');?></td>
            <td style="width: 10%; text-align:right"><?php echo number_format($row_deuda["abonado"],2,'.','');?></td>
            <td style="width: 10%; text-align:right"><?php echo number_format($adeudado,2,'.','');?></td>
        </tr>
<?php
        }
?>
        <tr><td colspan="7" style="text-align:right"><b>Total</b></td><td style="text-align:right"><b>$ <?php echo number_format($total_ctasxpagar,2,'.',''); ?></b></td></tr>
        </table>
<?php
}
 ?>
</page>