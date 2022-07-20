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
$total_ctasxcobrar=0;
$total_separado=0;
$conexiones=array("con1","con2","con3");
$bds=array("smart_syscatleia_comercial","smart_syscatleia_comercial2","smart_syscatleia_comercial3");
$ips=array(IP_COMERCIAL_1,IP_COMERCIAL_2,IP_COMERCIAL_3);
$empresa=array(RAZON_SOCIAL_1,RAZON_SOCIAL_2,RAZON_SOCIAL_3);
?>
<page backtop='38mm' backbottom='20mm' backleft='10mm' backright='10mm' footer='page' >
  <page_footer>
    <!--[[page_cu]]/[[page_nb]]-->
  </page_footer>
    <page_header>
        <img src="../../img/encabezado_portrait.jpg">
        <h3>REPORTE CUENTAS POR COBRAR</h3>
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
$total_ctasxcobrar=0;
switch($tipodetalle){
    case "xcliente":
?>
    <table class="superior" cellspacing="0" style="margin-left:10%;width: 100%;font-size: 10pt;">
        <tr>
            <th style="width: 50%">CLIENTE</th>
            <th style="width: 25%">RUC/CI</th>
            <th style="width: 25%;text-align:right">VALOR ADEUDADO</th>
        </tr>
<?php
        $sql_porcliente=mysqli_query($$_SESSION['bd_comercial'],"select sum(movimientos.fp_creddir_saldo) as saldo, clientes.nombre_cliente, clientes.ruc_ci from movimientos INNER JOIN clientes ON movimientos.id_cliente=clientes.id_cliente where proceso='VEN' and estado_factura='0' group by movimientos.id_cliente");
        while($row_cliente=  mysqli_fetch_array($sql_porcliente))
        {
?>
        <tr>
            <td style="width: 50%"><?php echo $row_cliente["nombre_cliente"]; ?></td>
            <td style="width: 25%"><?php echo $row_cliente["ruc_ci"];?></td>
            <td style="width: 25%;text-align:right"><?php echo number_format($row_cliente["saldo"],2,'.','');?></td>
        </tr>
<?php
            $total_ctasxcobrar+=floatval($row_cliente["saldo"]);
        }
?>
        <tr><td colspan="2" style="text-align:right"><b>Total</b></td><td style="text-align:right"><b>$ <?php echo number_format($total_ctasxcobrar,2,'.',''); ?></b></td></tr>
    </table>
<?php
        break;
    case "xfactura":
?>
    <table class="superior" cellspacing="0" style="margin-left:10%;width: 100%;font-size: 9pt;"> 
        <tr>
            <th style="width: 10%">FECHA</th>
            <th style="width: 35%">CLIENTE</th>
            <th style="width: 15%">RUC/CI</th>
            <th style="width: 10%; text-align:center"># FACTURA</th>
            <th style="width: 10%; text-align:right">TOTAL VENTA</th>
            <th style="width: 10%; text-align:right">ABONO</th>
            <th style="width: 10%; text-align:right">SALDO</th>
        </tr>
<?php
        $sql_porcliente=mysqli_query($$_SESSION['bd_comercial'],"select movimientos.*, clientes.nombre_cliente, clientes.ruc_ci from movimientos INNER JOIN clientes ON movimientos.id_cliente=clientes.id_cliente where proceso='VEN' and estado_factura='0' group by id_cliente");
        while($row_cliente=  mysqli_fetch_array($sql_porcliente))
        {
?>
        <tr>
            <td style="width: 10%"><?php echo substr($row_cliente["fecha_movimiento"],0,10);?></td>
            <td style="width: 35%"><?php echo $row_cliente["nombre_cliente"]; ?></td>
            <td style="width: 15%"><?php echo $row_cliente["ruc_ci"]; ?></td>
            <td style="width: 10%; text-align:center"><?php echo $row_cliente["numero_factura"]?></td>
            <td style="width: 10%; text-align:right"><?php echo number_format($row_cliente["total_venta"],2,'.','');?></td>
            <td style="width: 10%; text-align:right"><?php echo number_format($row_cliente["fp_creddir_abono"],2,'.','');?></td>
            <td style="width: 10%; text-align:right"><?php echo number_format($row_cliente["fp_creddir_saldo"],2,'.','');?></td>
        </tr>
<?php
            $total_ctasxcobrar+=floatval($row_cliente["fp_creddir_saldo"]);
        }
?>
        <tr><td colspan="6" style="text-align:right"><b>Total</b></td><td style="text-align:right"><b>$ <?php echo number_format($total_ctasxcobrar,2,'.',''); ?></b></td></tr>
        </table>
<?php
}
 ?>
</page>