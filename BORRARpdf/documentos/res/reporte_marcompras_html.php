<style type="text/css">
<!--
table { vertical-align: top; }
tr    { vertical-align: top; }
td,th    { vertical-align: top; height:10px; padding: 5pt;}
.superior td{ height: 10px; padding: 5pt;border-bottom: 1px dashed grey;}
.superior th{ height: 10px; border-bottom: 1px solid grey; padding: 5pt;}
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
        <h3>REPORTE DE COMPRAS POR MARCA</h3>
    </page_header>
    <table class="superior" cellspacing="0" style="margin-left:10%;width: 100%;font-size: 10pt;">
        <tr>
            <th style="width: 5%">FECHA</th>
            <th style="width: 10%;text-align:center;">FACTURA #</th>
            <th style="width: 20%">NOMBRE</th>
            <th style="width: 5%;text-align:right">BASE 0%</th>
            <th style="width: 5%;text-align:right">BASE <?php echo TAX?>%</th>
            <th style="width: 5%;text-align:right">IVA <?php echo TAX?>%</th>
            <th style="width: 5%;text-align:right">TOTAL FACTURA</th>
            <th style="width: 5%;text-align:left">CODIGO PROD</th>
            <th style="width: 30%;text-align:left">PRODUCTO</th>
            <th style="width: 10%;text-align:left">CANTIDAD</th>
        </tr>
<?php 
$sql=mysqli_query($$_SESSION['bd_comercial'],"select movimientos.*,proveedores.ruc_ci,proveedores.nombre_proveedor, detalle_movimiento.cantidad,products.codigo_adc,products.nombre_producto,categorias.nombre_categoria from movimientos INNER JOIN proveedores ON movimientos.id_proveedor=proveedores.id_proveedor INNER JOIN detalle_movimiento ON movimientos.id_movimiento=detalle_movimiento.id_movimiento INNER JOIN products ON products.id_producto=detalle_movimiento.id_producto INNER JOIN categorias ON products.id_categoria=categorias.id_categoria WHERE DATE(fecha_movimiento)>='".$fecha_desde."' and DATE(fecha_movimiento)<='".$fecha_hasta."' and proceso='COM' and factura='SI' and categorias.id_categoria='$id_categoria' order by fecha_movimiento,numero_factura ASC");
function verif_val($valor){
    if($valor==""){
        return "0.00";
    }else
    {
        return number_format($valor,2,'.','');
    }
}
while($factura=  mysqli_fetch_array($sql))
{
?>
        <tr>
        <td style="width: 5%"><?php echo substr($factura["fecha_movimiento"],0,10)?></td>
        <td style="width: 10%;text-align:center;"><?php echo $factura["numero_factura"]?></td>
        <td style="width: 20%;"><?php echo $factura["nombre_proveedor"]; ?></td>
        <td style="width: 5%;text-align:right;"><?php echo verif_val($factura["bimponible_iva0"]); ?></td>
        <td style="width: 5%;text-align:right"><?php echo verif_val($factura["bimponible_ivax"]); ?></td>
        <td style="width: 5%;text-align:right"><?php echo verif_val($factura["importe_iva"]); ?></td>
        <td style="width: 5%;text-align:right"><?php echo verif_val($factura["total_venta"]); ?></td>
        <td style="width: 5%;text-align:left"><?php echo $factura["codigo_adc"] ?></td>
        <td style="width: 30%;text-align:left"><?php echo $factura["nombre_producto"]; ?></td>
        <td style="width: 10%;text-align:left"><?php echo $factura["cantidad"]; ?></td>
        </tr>
<?php
}
?>
    </table>
</page>