<style type="text/css">
<!--
table { vertical-align: top; }
tr    { vertical-align: top; }
td,th    { vertical-align: top; height:10px; padding: 2px 2px 3px 2px;}
.superior td{ height: 13px; padding: 2pt;}
.superior th{border-bottom: 1px solid grey; padding: 2pt; }
.superior tr.rowt td{border-bottom: 1px solid grey;}
hr{
    border: 1px solid #bdc3c7;
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
    font-size: 12pt;
}
.especial{
    background: #ffffcc;
}
.especial2{
    background: #f0f0ff;
}
table.page_footer {width: 100%; border: none; background-color: white; padding: 2mm;border-collapse:collapse; border: none;}
} 
span.especialtxt{ color:black;}
-->
</style>
<?php
//VER QUE DATOS MANDO EN EL ENCABEZADO
$nc="";
$ruc="";
$rs="";
switch($_SESSION['bd_comercial']){
    case "con1":$nc=NOMBRE_COMERCIAL_1;$ruc=RUC_1;$rs=RAZON_SOCIAL_1; break;
    case "con2":$nc=NOMBRE_COMERCIAL_2;$ruc=RUC_2;$rs=RAZON_SOCIAL_2; break;
    case "con3":$nc=NOMBRE_COMERCIAL_3;$ruc=RUC_3;$rs=RAZON_SOCIAL_3; break;
}
?>
<page backtop='20mm' backbottom='20mm' backleft='20mm' backright='20mm' footer='page' >
    <?php 
        $sql_dev=mysqli_query($$_SESSION['bd_comercial'],"select movimientos.*, proveedores.nombre_proveedor, proveedores.ruc_ci FROM movimientos INNER JOIN proveedores ON movimientos.id_proveedor=proveedores.id_proveedor  where id_movimiento='$id_movimiento'");
        $rsql_dev= mysqli_fetch_array($sql_dev);
    ?>
    <table class="superior" cellspacing="0" style="margin-left:10%;width: 100%;font-size: 10pt; ">
        <tr>
            <td style="width:30%;"><img src="<?php echo $_SERVER['DOCUMENT_ROOT']."/syscatleia" ?>/img/logo.jpg" style="text-align:center; width:70%;"/></td>
            <td style="width:70%;">
                <h4><?php echo $nc; ?></h4>
                <p><b>RUC:</b> <?php echo $ruc; ?></p>
                <p><b>RAZÓN SOCIAL:</b> <?php echo $rs; ?></p>
            </td>
        </tr>
    </table>
    <hr/>
    <br>
    <h3>ORDEN DE DEVOLUCIÓN No. <span class="especialtxt"><?php echo $rsql_dev["modifica"]?></span></h3>
    <br>
    <table class="superior" cellspacing="0" style="margin-left:10%;width: 100%;font-size: 8pt;">
        <tr>
            <td style="width:20%;text-align:left;"><b>Fecha:</b></td><td><?php echo substr($rsql_dev["fecha_movimiento"],0,10); ?></td>
        </tr>
        <tr>
            <td style="width:20%;text-align:left;"><b>Proveedor:</b></td><td><?php echo $rsql_dev["nombre_proveedor"]; ?></td>
        </tr>
        <tr>
            <td style="width:20%;text-align:left;"><b>Factura No:</b></td><td><?php echo $rsql_dev["numero_factura"]; ?></td>
        </tr>
    </table>
    <br>
    <h4>DETALLE PRODUCTOS</h4>
    <br>
    <table class="superior" cellspacing="0" style="margin-left:10%;width: 100%;font-size: 8pt;">
        <tr class="headt">
            <th style="width:10%; text-align:center">CANT</th>
            <th style="width:10%; text-align:left">COD</th>
            <th style="width:30%; text-align:left">DESCRIPCION</th>
            <th style="width:10%; text-align:right">PUNIT</th>
            <th style="width:10%;text-align:right">PTOTAL</th>
            <th style="width:30%;text-align:left">OBSERVACIONES</th>
        </tr>
    <?php $sql_detalle=mysqli_query($$_SESSION['bd_comercial'],"SELECT detalle_movimiento.*, products.* from detalle_movimiento INNER JOIN products ON detalle_movimiento.id_producto=products.id_producto WHERE id_movimiento='$id_movimiento'");
    $sum_b_imponible=0;
    $sum_b_cero=0;
    $iva=0;
    $subtotal=0;
    $canttotal=0;
    while($row=mysqli_fetch_array($sql_detalle)){
    ?>
        <tr class="rowt">
            <td style="width:10%;text-align:center"><?php echo $row["cantidad"] ?></td>
            <td style="width:10%;text-align:left"><?php echo $row["codigo_adc"] ?></td>
            <td style="width:30%;text-align:left"><?php echo $row["nombre_producto"] ?></td>
            <td style="width:10%;text-align:right"><?php echo $row["precio_venta"] ?></td>
            <td style="width:10%;text-align:right"><?php echo round($row["cantidad"]*$row["precio_venta"],2); ?></td>
            <td style="width:30%;text-align:left"><?php echo $row["observaciones"]; ?></td>
        </tr>
    <?php 
        $canttotal+=intval($row["cantidad"]);
        $subtotalt=round($row["cantidad"]*$row["precio_venta"],2);
        $subtotal+=$subtotalt;
        if($row["IVA"]=="SI"){
            $iva=$row["iva"];
            $sum_b_imponible+=$subtotalt;
        }else{
            $sum_b_cero+=$subtotalt;
        }
    } 
        $importeiva=round($sum_b_imponible*$iva/100,2);
        $total=$sum_b_imponible+$sum_b_cero+$importeiva;
    ?>
        <tr class="rowt"><th style="text-align:right" colspan="4">Subtotal</th><td style="text-align:right" ><?php echo number_format($subtotal,2,'.',''); ?></td></tr>
        <tr class="rowt"><th style="text-align:right" colspan="4">Subtotal IVA 0%</th><td style="text-align:right" ><?php echo number_format($sum_b_cero,2,'.',''); ?></td></tr>
        <tr class="rowt"><th style="text-align:right" colspan="4">Subtotal IVA <?php echo $iva?>%</th><td style="text-align:right" ><?php echo number_format($sum_b_imponible,2,'.',''); ?></td></tr>
        <tr class="rowt"><th style="text-align:right" colspan="4">Importe IVA</th><td style="text-align:right" ><?php echo number_format($importeiva,2,'.',''); ?></td></tr>
        <tr class="rowt"><th style="text-align:right" colspan="4">Total</th><td style="text-align:right" ><?php echo number_format($total,2,'.',''); ?></td></tr>
    </table>
    <br/>
    <p style="font-size:8pt;"><b>TOTAL ITEMS (PARES) ENVIADOS:</b> <?PHP echo $canttotal;?> </p>
    <br/>
    <br/>
    <br/>
    <br/>
    <br/>
    <br/>
    <br/>
    <br/>
    <br/>
    <p style="font-size:8pt">FIRMA DE RESPONSABILIDAD</p>
    
</page>