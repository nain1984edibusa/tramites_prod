<style type="text/css">
<!--
table { vertical-align: top; }
tr    { vertical-align: top; }
td    { vertical-align: top; height:10px; padding: 2px 2px 3px 2px; }
.superior td{ height: 13px; padding-bottom: 4px;}
.etiqueta{
    font-size: 9pt;
    font-weight: bold;
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
h3{
    color: #006699;
    text-align: center;
}
hr{
    color: #bdc3c7;
}
table.page_footer {width: 100%; border: none; background-color: white; padding: 2mm;border-collapse:collapse; border: none;}
.textoexpecifico{
    font-size: 7pt;
    color: #009999;
    float:left;
    display: block;
}
.cancelado{
    color: #669900;  
    font-weight: bold;
}
.nocancelado{
    color:#ff6600;
    font-weight: bold;
}
-->
</style>
<page backtop='38mm' backbottom='20mm' backleft='30mm' backright='25mm' footer='page' >
    <?php 
        $sql_sep=mysqli_query($$conexion,"SELECT movimientos.*,clientes.* from movimientos INNER JOIN clientes ON movimientos.id_cliente=clientes.id_cliente WHERE id_movimiento='$idmovimiento'");
        $row=  mysqli_fetch_array($sql_sep);
    ?>
  <page_footer>
    <!--[[page_cu]]/[[page_nb]]-->
  </page_footer>
    <page_header>
        <img src="../../img/encabezado_portrait.jpg">
        <h3>REPORTE ARTÍCULOS SEPARADOS</h3>
    </page_header>
    <table class="superior" cellspacing="0" style="margin-left:10%;width: 100%;font-size: 10pt; color: #333333;">
        <tr>
            <td style="width:50%; text-align:left;"><span class="etiqueta">FECHA:&nbsp;&nbsp;</span><span><?php echo $row["fecha_movimiento"];?></span></td>
            <td style="width:50%; text-align:left;"><span class="etiqueta">CLIENTE:&nbsp;&nbsp;</span><span><?php echo $row["nombre_cliente"];?></span></td>
        </tr>
    </table>
    <hr>
    <H4>DETALLE ARTÍCULOS</H4>
    <table cellspacing="0" style="width: 100%; text-align: left; font-size: 9pt; margin-top:14px;">
        <tr style="background-color:grey; color:white; font-size: 10pt">
            <th style="width: 10%;text-align: center">CANT</th>
            <th style="width: 50%;text-align: left">PRODUCTO</th>
            <th style="width: 15%;text-align: right">P UNIT</th>
            <th style="width: 15%;text-align: right">DESCUENTO</th>
            <th style="width: 10%;text-align: right">P TOTAL</th>
        </tr>
<?php 
$sql_detalle=mysqli_query($$conexion,"SELECT detalle_movimiento.*, products.nombre_producto from detalle_movimiento INNER JOIN products on detalle_movimiento.id_producto=products.id_producto WHERE id_movimiento='$idmovimiento'");
while($rowdetalle=  mysqli_fetch_array($sql_detalle)){?>
        <tr>
            <td style="width: 10%;text-align: center"><?php echo $rowdetalle["cantidad"]; ?></td>
            <td style="width: 50%;text-align: left"><?php echo $rowdetalle["nombre_producto"]; ?></td>
            <td style="width: 15%;text-align: right"><?php echo $rowdetalle["precio_venta"]; ?></td>
            <td style="width: 15%;text-align: right"><?php echo $rowdetalle["descuento"]; ?></td>
            <?php $total= intval($rowdetalle["cantidad"])*round($rowdetalle["precio_venta"],2)-floatval($rowdetalle["descuento"]);?>
            <td style="width: 10%;text-align: right"><?php echo number_format($total,2,'.',''); ?></td>
        </tr>
<?php } 
?>
        <tr>
            <th style='text-align: right' colspan="4">Subtotal IVA 0%</th><td style='text-align: right' ><?php echo $row["bimponible_iva0"]; ?></td>
        </tr>  
        <tr>
            <th style='text-align: right' colspan="4">Subtotal IVA <?php echo $row["iva"] ?>%</th><td style='text-align: right' ><?php echo $row["bimponible_ivax"]; ?></td>
        </tr>
        <tr>
            <th style='text-align: right' colspan="4">Importe IVA</th><td style='text-align: right' ><?php echo $row["importe_iva"]; ?></td>
        </tr>
        <tr>
            <th style='text-align: right' colspan="4">Total</th><td style='text-align: right' ><?php echo $row["total_venta"]; ?></td>
        </tr>
    </table>
    <br>
    <br>
    <H4>DETALLE PAGOS</H4>
    <table cellspacing="0" style="width: 100%; text-align: left; font-size: 9pt; margin-top:14px;">
        <tr style="background-color:grey; color:white; font-size: 10pt">
            <th style="width: 9%;text-align: center">FECHA</th>
            <th style="width: 13%;text-align: right">Efectivo</th>
            <th style="width: 13%;text-align: right">Dinero E</th>
            <th style="width: 13%;text-align: right">Tarjeta Cred</th>
            <th style="width: 13%;text-align: right">Tarjeta Deb</th>
            <th style="width: 13%;text-align: right">Otros</th>
            <th style="width: 13%;text-align: right">Compens</th>
            <th style="width: 13%;text-align: right">Pag. Ant(CD)</th>
        </tr>
    <?php 
    $sql_fp=mysqli_query($$conexion,"SELECT * from pagos_movimientos WHERE id_movimiento='$idmovimiento'");
    //echo "SELECT * from pagos_movimientos WHERE id_movimiento='$idmovimiento'";
    while($rowfp=mysqli_fetch_array($sql_fp)){?>
        <tr>
            <td style="width: 9%;text-align: center"><?php echo substr($rowfp["fecha_pagosmov"],0,10); ?></td>
            <td style="width: 13%;text-align: right"><?php echo $rowfp["fp_efectivo"]; ?></td>
            <td style="width: 13%;text-align: right"><?php echo $rowfp["fp_dineroe"]; ?></td>
            <td style="width: 13%;text-align: right"><?php echo $rowfp["fp_tarjetacre"]; ?></td>
            <td style="width: 13%;text-align: right"><?php echo $rowfp["fp_tarjetadeb"]; ?></td>
            <td style="width: 13%;text-align: right"><?php echo $rowfp["fp_otros"]; ?></td>
            <td style="width: 13%;text-align: right"><?php echo $rowfp["fp_compdeudas"]; ?></td>
            <td style="width: 13%;text-align: right"><?php echo $rowfp["fp_creditodirecto"]; ?></td>
        </tr>
    <?php } 
    ?>
        <tr>
            <th colspan="7" style="text-align: right">Total Abonado</th><td style="text-align: right"><?php echo number_format($row["fp_creddir_abono"],2,'.','')?></td>
        </tr>
        <tr>
            <th colspan="7" style="text-align: right">Total Saldo</th><td style="text-align: right"><?php echo number_format($row["fp_creddir_saldo"],2,'.','')?></td>
        </tr>
    </table>
</page>