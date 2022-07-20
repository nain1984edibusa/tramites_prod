<style type="text/css">
<!--
table { vertical-align: top; }
tr    { vertical-align: top; }
td    { vertical-align: top; height:10px; padding: 2px 2px 3px 2px;}
.superior td{ height: 13px; padding-bottom: 4px;}
.superior td{
    border-bottom: 1px solid #bdc3c7;
}

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
h3{
    color: #006699;
    text-align: center;
}
.especial{
    background: #ffffcc;
}
.especial2{
    background: #f0f0ff;
}
table.page_footer {width: 100%; border: none; background-color: white; padding: 2mm;border-collapse:collapse; border: none;}
} 
-->
</style>
<page backtop='38mm' backbottom='20mm' backleft='10mm' backright='10mm' footer='page' >
    <page_footer>
    </page_footer>
    <page_header>
        <img src="../../img/encabezado_portrait.jpg">
        <h3>DETALLE FACTURA COMPRA</h3>
    </page_header>
    <?php 
            //$sql_cliente=mysqli_query($$_SESSION['bd_comercial'],"select * from proveedores where id_proveedor='$id_proveedor'");
            //$rw_cliente=mysqli_fetch_array($sql_cliente);
    ?>
    <h4>DETALLE FACTURA</h4>
    <table class="superior" cellspacing="0" style="margin-left:10%;width: 100%;font-size: 10pt; color: #333333;">
        <tr>
            <td class="especial" colspan="4" style="text-align:left;"><span class="etiqueta"><b>Proveedor:</b>&nbsp;&nbsp;</span><span><?php echo $razonsocial;?></span></td>
        </tr>
        <tr>
            <td style="width:25%; text-align:left;"><span class="etiqueta"><b>RUC/CI:</b>&nbsp;&nbsp;</span><span><?php echo $ruc;?></span></td>
            <td style="width:20%; text-align:left;"><span class="etiqueta"><b>Fecha:</b>&nbsp;&nbsp;</span><span><?php echo substr($fecha_emision,0,10);?></span></td>
            <td class="especial2" colspan="2" style="text-align:left;"><span class="etiqueta"><b>Factura <?php echo $emif;?>:</b>&nbsp;&nbsp;</span><span><?php echo $numero_factura;?></span></td>
        </tr>
        <tr>
            <td colspan="4" style="text-align:left;"><span class="etiqueta"><b>Autorización:</b>&nbsp;&nbsp;</span><span><?php echo $autorizacion;?></span></td>
        </tr>
        <tr>
            <td style="width:25%; text-align:left;"><span class="etiqueta"><b>Tarifa 0%:</b>&nbsp;&nbsp;</span><span><?php echo "$ ".$base0;?></span></td>
            <td style="width:20%; text-align:left;"><span class="etiqueta"><b>Tarifa <?php echo $piva;?>%:</b>&nbsp;&nbsp;</span><span><?php echo "$ ".$base_imponibleiva;?></span></td>
            <td style="width:25%; text-align:left;"><span class="etiqueta"><b>Importe Iva:</b>&nbsp;&nbsp;</span><span><?php echo "$ ".$iva;?></span></td>
            <td style="width:30%; text-align:left;"><span class="etiqueta"><b>Total Factura:</b>&nbsp;&nbsp;</span><span><?php echo "$ ".$total;?></span></td>
        </tr>
    </table>
    <br>
    <h4>FORMAS DE PAGO (Declaradas en el comprobante)</h4>
    <table class="superior" cellspacing="0" style="margin-left:10%;width: 100%;font-size: 10pt; color: #333333;">
        <tr>
            <td style="width:25%; text-align:left;"><span class="etiqueta"><b>Efectivo:</b>&nbsp;&nbsp;</span><span><?php echo "$ ".$efectivo;?></span></td>
            <td style="width:20%; text-align:left;"><span class="etiqueta"><b>Tarjeta Deb.:</b>&nbsp;&nbsp;</span><span><?php echo "$ ".$tardeb;?></span></td>
            <td style="width:25%; text-align:left;"><span class="etiqueta"><b>Tarjeta Cre.:</b>&nbsp;&nbsp;</span><span><?php echo "$ ".$tarcred;?></span></td>
            <td style="width:30%; text-align:left;"><span class="etiqueta"><b>Dinero Elec:</b>&nbsp;&nbsp;</span><span><?php echo "$ ".$dielec;?></span></td>
        </tr>
        <tr>
            <td style="width:25%; text-align:left;"><span class="etiqueta"><b>Otros:</b>&nbsp;&nbsp;</span><span><?php echo "$ ".$otros;?></span></td>
            <td colspan="2" style="text-align:left;"><span class="etiqueta"><b>Compensación. Deud.:</b>&nbsp;&nbsp;</span><span><?php echo "$ ".$compensacion;?></span></td>
            <td style="width:25%; text-align:left;"><span class="etiqueta"><b>Endoso:</b>&nbsp;&nbsp;</span><span><?php echo "$ ".$endoso;?></span></td>
        </tr>
    </table>
    <br>
    <h4>DETALLE RETENCIÓN</h4>
    <?php if ($numero_retencion!=""){ ?>
    <table class="superior" cellspacing="0" style="margin-left:10%;width: 100%;font-size: 10pt; color: #333333;">
        <tr><td colspan="3"><span class="etiqueta"><b>Num Retención:</b>&nbsp;&nbsp;</span><span><?php echo $numero_retencion;?></span></td></tr>
        <tr>
            <td style="width:40%; text-align:left;"><span class="etiqueta"><b>Tipo Emisión:</b>&nbsp;&nbsp;</span><span><?php echo $emir;?></span></td>
            <td style="width:25%; text-align:left;"><span class="etiqueta"><b>%Ret IVA:</b>&nbsp;&nbsp;</span><span><?php echo $poriva." %";?></span></td>
            <td style="width:25%; text-align:left;"><span class="etiqueta"><b>Retención IVA:</b>&nbsp;&nbsp;</span><span><?php echo "$ ".$valiva;?></span></td>
        </tr>
        <tr>
            <td style="width:40%; text-align:left;"><span class="etiqueta"><b>Cód. Ret:</b>&nbsp;&nbsp;</span><span><?php echo $codigo_retret;?></span></td>
            <td style="width:25%; text-align:left;"><span class="etiqueta"><b>%Ret Renta:</b>&nbsp;&nbsp;</span><span><?php echo $porrenta." %";?></span></td>
            <td style="width:25%; text-align:left;"><span class="etiqueta"><b>Retención Renta:</b>&nbsp;&nbsp;</span><span><?php echo "$ ".$imprenta;?></span></td>
        </tr>
    </table>    
    <?php }else{ ?>
        <p>La factura no registra retención</p>
    <?php } ?>
    <br>
    <h4>DETALLE PAGOS</h4>
    <?php if($estado_factura==0){?>
    <p><B>Estado de Pago:</B> PENDIENTE</p>
    <?php }else{ ?>
    <p><B>Estado de Pago:</B> CANCELADO</p>
    <?php
    }
    ?>
    <table class="superior" cellspacing="0" style="margin-left:10%;width: 100%;font-size: 10pt; color: #333333;">
        <tr>
            <th style="width:20%; text-align:left;">Fecha</th>
            <th style="width:20%; text-align:left;">Valor Abonado</th>
            <th style="width:60%; text-align:left;">Observaciones</th>
        </tr>
    <?php 
    $sql_pagosfac=mysqli_query($$_SESSION['bd_comercial'],"select * from  pagos_ctsxpagar where movimiento='".$id_movimiento."'");
    //echo "select * from  pagos_ctasxpagar where movimiento='".$id_movimiento."'";
    $total_abonos=0;
    while($rowpago=mysqli_fetch_array($sql_pagosfac)){
    ?>
        <tr>
            <td style="width:40%; text-align:left;"><?php echo $rowpago["fecha"] ?></td>
            <td style="width:25%; text-align:left;">$ <?php echo $rowpago["valor_abonado"]; ?></td>
            <td style="width:25%; text-align:left;"><?php echo $rowpago["observaciones"];?></td>
        </tr>
    <?php 
    $total_abonos+= floatval($rowpago["valor_abonado"]);
    } 
    $pagiva=floatval($iva)-floatval($valiva);
    $pagbase=floatval($base_imponibleiva)+floatval($base0)-floatval($imprenta);
    $totalapagar=$pagiva+$pagbase;
    $resta=$totalapagar-$total_abonos;
    ?>
    </table>
    <p><B>Total Factura (- retención):</B> <?php echo number_format($totalapagar,2,'.',''); ?></p>
    <p><B>Total Abonado:</B> <?php echo number_format($total_abonos,2,'.',''); ?></p>
    <p><B>Saldo a la Fecha:</B> <?php echo number_format($resta,2,'.',''); ?></p>
    <br>
    <?php if($rowgasto["compest_borrador"]==1){ ?>
    <h4>DETALLE FACTURA</h4>
    <table class="superior" cellspacing="0" style="margin-left:10%;width: 100%;font-size: 10pt; color: #333333;">
        <tr>
            <th style="width:10%; text-align:center;">Cantidad</th>
            <th style="width:50%; text-align:left;">Producto</th>
            <th style="width:25%; text-align:right;">Precio Unitario (sin IVA)</th>
            <th style="width:15%; text-align:right;">Total</th>
        </tr>
    <?php $detallefac=mysqli_query($$_SESSION['bd_comercial'],"select detalle_movimiento.*, products.nombre_producto from detalle_movimiento INNER JOIN products ON detalle_movimiento.id_producto=products.id_producto where id_movimiento='".$id_movimiento."'");
    $total_global=0;
	while($detf=mysqli_fetch_array($detallefac)){
    ?>
        <tr>
            <td style="width:10%; text-align:center;"><?php echo $detf["cantidad"] ?></td>
            <td style="width:50%; text-align:left;"><?php echo $detf["nombre_producto"] ?></td>
            <td style="width:25%; text-align:right;"><?php echo number_format($detf["precio_venta"],4,'.','.');?></td>
            <?php $total=intval($detf["cantidad"])* $detf["precio_venta"];?>
            <td style="width:15%; text-align:right;"><?php echo number_format($total,2,'.','.');?></td>
        </tr>
    <?php 
	$total_global+=$total;
	}
     ?>
	 <tr><td colspan='3' style="text-align:right;">Total</td><td style="text-align:right;"><?php echo number_format($total_global,2,'.','');?></td></tr>
    </table>
    <?php } ?>
</page>

