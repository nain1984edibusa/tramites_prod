<style type="text/css">
<!--
table { vertical-align: top; }
tr    { vertical-align: top; }
td,th    { vertical-align: top; height:10px; padding: 5pt;}
.superior td{ height: 13px; padding: 3pt;border-bottom: 1px dashed grey;}
.superior th{ height: 13px; border-bottom: 1px solid grey; padding: 3pt;}
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
        <h3>REPORTE DE INVENTARIO</h3>
    </page_header>
<?php
$tr=""; $where="";
switch ($tipo_reporte){
    case "prod_sin_stock": 
        $tr="Productos sin Stock";
        $where=" where (stock-cant_ordendev) = 0 and status_producto=1 ";
        break;
    case "prod_bajo_stock": 
        $tr="Productos con bajo Stock";
        $where=" where (stock-cant_ordendev) < cant_min and status_producto=1 ";
        break;
    case "prod_normal_stock": 
        $tr="Productos con Stock normal";
        $where=" where (stock-cant_ordendev) >= cant_min and (stock-cant_ordendev) <= cant_max and status_producto=1 ";
        break;
    case "prod_sobre_stock": 
        $tr="Productos con Stock excesivo";
         $where=" where (stock-cant_ordendev) > cant_max and status_producto=1 ";
        break;
    case "all": 
        $tr="Todos los productos";
        $where=" where status_producto=1 ";
        break;
}
?>
    <table style="width: 100%">
        <tr>
            <th style="width: 25%">Tipo de reporte:</th>
            <td style="width: 75%"><?php echo $tr?></td>
        </tr>
    </table>
    <table class="superior" cellspacing="0" style="margin-left:10%;width: 100%;font-size: 10pt;">
        <tr>
            <th style="width: 5%">COD PROD</th>
            <th style="width: 35%">NOMBRE</th>
            <th style="width: 5%">CANT MÍN</th>
            <th style="width: 5%">CANT MÁX</th>
            <th style="width: 5%">STOCK</th>
            <th style="width: 5%;text-align:right">COSTO PROM</th>
            <th style="width: 5%;text-align:right">COSTO INV</th>
            <th style="width: 5%;text-align:right">IVA</th>
            <th style="width: 5%;text-align:right">PRECIO</th>
            <th style="width: 5%;text-align:right">RANGO</th>
            <th style="width: 20%">OBSERVACIONES</th>
        </tr>
<?php 
$sql=mysqli_query($$_SESSION['bd_comercial'],"select products.*, precios_productos.* from products LEFT JOIN precios_productos ON products.id_producto=precios_productos.producto ".$where." order by nombre_producto ASC");
//rellenar con contenido
$costototal=0;
$canttotal=0;
function verif_val($valor){
    if($valor==""){
        return "0.00";
    }else
    {
        return number_format($valor,2,'.','');
    }
}
while($producto=  mysqli_fetch_array($sql))
{
    $cant_ordendev=$producto["cant_ordendev"];
    $od="";
    if(intval($cant_ordendev)){
        $stock=intval($producto["stock"])-intval($cant_ordendev);
        $od=intval($producto["stock"])."-".intval($cant_ordendev)." ORDEN(ES) DE DEVOLUCION PENDIENTES";
    }else{
        $stock=intval($producto["stock"]);
    }
    $canttotal+=$stock;
    $sql_kardex=mysqli_query($$_SESSION['bd_comercial'],"select existencias_costo,existencias_total from kardex where id_producto='".$producto["id_producto"]."' ORDER BY id_kardex DESC LIMIT 0,1");
    $r=mysqli_fetch_array($sql_kardex);
    //$objPHPExcel->getActiveSheet()->SetCellValue("F$fila", $producto["costo_producto"]);
    $costoinv=floatval($r["existencias_costo"])*$stock;
    $costototal+=$costoinv;
?>
        <tr>
            <td style="width: 5%"><?php echo $producto["codigo_adc"]?></td>
            <td style="width: 35%"><?php echo $producto["nombre_producto"]?></td>
            <td style="width: 5%;"><?php echo $producto["cant_min"] ?></td>
            <td style="width: 5%;"><?php echo $producto["cant_max"] ?></td>
            <td style="width: 5%;"><?php echo $stock ?></td>
            <td style="width: 5%;text-align:right"><?php echo $r["existencias_costo"] ?></td>
            <td style="width: 5%;text-align:right"><?php echo number_format($costoinv,4,'.','') ?></td>
            <td style="width: 5%;text-align:right"><?php echo $producto["IVA"] ?></td>
            <td style="width: 5%;text-align:right"><?php echo $producto["precio_pproducto"] ?></td>
            <td style="width: 5%;text-align:right"><?php echo $producto["cantmin_pproducto"]."-".$producto["cantmax_pproducto"] ?></td>
            <td style="width: 20%;"><?php echo $od; ?></td>
        </tr>
<?php 
}
?>
        <tr>
            <td colspan="4" style="text-align:right"><b>TOTAL STOCK</b></td>
            <td><?php echo $canttotal; ?></td>
            <td>COSTO INV</td>
            <td><?php echo number_format($costototal,4,'.','')?></td>
        </tr>
    </table>
</page>