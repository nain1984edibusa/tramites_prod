<style type="text/css">
<!--
table { vertical-align: top; }
tr    { vertical-align: top; }
td    { vertical-align: top; height:10px; padding: 2px 2px 3px 2px;}
.superior td{ height: 13px; padding: 4pt;}
.superior th{border-bottom: 1px solid grey; padding-bottom: 5pt;}
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
    font-size: 14pt;
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
<page backtop='20mm' backbottom='20mm' backleft='10mm' backright='10mm' footer='page' >
    <?php 
            //$sql_cliente=mysqli_query($$_SESSION['bd_comercial'],"select * from proveedores where id_proveedor='$id_proveedor'");
            //$rw_cliente=mysqli_fetch_array($sql_cliente);
    ?>
    <table class="superior" cellspacing="0" style="margin-left:10%;width: 100%;font-size: 10pt; ">
        <tr>
            <td style="width:40%;"><img src="<?php echo $_SERVER['DOCUMENT_ROOT']."/syscatleia" ?>/img/logo.jpg" style="text-align:center; width:70%;"/></td>
            <td style="width:60%;">
                <h4><?php echo NOMBRE_COMERCIAL_1; ?></h4>
                <p><b>RUC:</b> <?php echo RUC_1; ?></p>
                <p><b>RAZÓN SOCIAL:</b> <?php echo RAZON_SOCIAL_1; ?></p>
                <p><b>DIRECCIÓN MATRIZ:</b> <?php echo MATRIZ_1; ?></p>
                <p><b>DIRECCIÓN ESTABLECIMIENTO:</b> <?php echo DIRESTABLECIMIENTO_1; ?></p>
                <p><b>OBLIGADO A LLEVAR CONTABILIDAD</b> <?php echo "SI" ?></p>
            </td>
        </tr>
    </table>
    <hr/>
    <br>
    <h3>COMPROBANTE DE RETENCIÓN</h3>
    <br>
    <table class="superior" cellspacing="0" style="margin-left:10%;width: 100%;font-size: 10pt;">
        <tr>
            <td colspan="3" style="width:100%;text-align:left;"><span class="etiqueta"><b>No:</b>&nbsp;&nbsp;</span><span><?php echo ESTABLECIMIENTO_1."-".PUNTOEMISION_1."-".  formato_cadenai($numero_retencion, 9);?></span></td>
        </tr>
        <tr>
            <td colspan="3" style="width:100%;text-align:left;"><span class="etiqueta"><b>Número de Autorización:</b>&nbsp;&nbsp;</span><span><?php echo $autorizacion;?></span></td>
        </tr>
        <tr>
            <td style="width:40%;text-align:left;"><span class="etiqueta"><b>Fecha de Autorización</b>&nbsp;&nbsp;</span><span><?php echo $fechaemisionretencion; ?></span></td>
            <td style="width:30%;text-align:left;"><span class="etiqueta"><b>Ambiente:</b>&nbsp;&nbsp;</span><span>PRODUCCIÓN</span></td>
            <td style="width:30%;text-align:left;"><span class="etiqueta"><b>Emisión:</b>&nbsp;&nbsp;</span><span>NORMAL</span></td>
        </tr>
        <tr>
            <td colspan="3" style="width:100%;text-align:left;"><span class="etiqueta"><b>CLAVE DE ACCESO</b></span></td>
        </tr>
        <tr>
            <td colspan="3"><barcode dimension="1D" type="CODABAR" value="<?php echo $autorizacion;?>" label="label" style="width: 150mm; height:13mm; color: black; font-size: 3mm"></barcode></td>
        </tr>
    </table>
    <br>
    <br>
    <br>
    <table class="superior" cellspacing="0" style="margin-left:10%;width: 100%;font-size: 10pt;">
        <tr>
            <td style="width:50%;text-align:left;"><span class="etiqueta"><b>Proveedor:</b>&nbsp;&nbsp;</span><span><?php echo $razonsocial;?></span></td>
            <td style="width:30%; text-align:left;"><span class="etiqueta"><b>Identificación:</b>&nbsp;&nbsp;</span><span><?php echo $ruc;?></span></td>
            <td style="width:20%; text-align:left;"><span class="etiqueta"><b>Fecha:</b>&nbsp;&nbsp;</span><span><?php echo substr($fechaemisionretencion,0,10);?></span></td>
        </tr>
        <tr>
            <td colspan='3'><span class="etiqueta"><b>Dirección:</b>&nbsp;&nbsp;</span><span><?php echo $direccion;?></span></td>
        </tr>
    </table>
    <br>
    <br>
    <br>
    <table class="superior" cellspacing="0" style="margin-left:10%;width: 100%;font-size: 9pt;">
        <tr>
            <th style='width:12%; text-align:center'>Comprobante</th>
            <th style='width:18%; text-align:center'>Número</th>
            <th style='width:10%; text-align:center'>Fecha Emisión</th>
            <th style='width:10%; text-align:center'>Ejercicio Fiscal</th>
            <th style='width:15%; text-align:center'>Base Imponible Retención</th>
            <th style='width:13%; text-align:center'>Impuesto</th>
            <th style='width:12%; text-align:center'>Porcentaje Retención</th>
            <th style='width:10%; text-align:center'>Valor Retenido</th>
        </tr>
        <?php if(intval($porrenta)>0): ?>
        <tr>
            <td style='width:12%;'>FACTURA</td>
            <td style='width:18%;'><?php echo $numero_factura; ?></td>
            <td style='width:10%;'><?php echo $fecha_emision;?></td>
            <td style='width:10%;'><?php echo substr($fecha_emision,0,7); ?></td>
            <td style='width:15%; text-align:right'><?php echo number_format($subtotal2factura,2,'.',''); ?></td>
            <td style='width:13%; text-align:center'>Impuesto a la Renta</td>
            <td style='width:12%; text-align:center'><?php echo $porrenta;?></td>
            <td style='width:10%; text-align:right'><?php echo $imprenta; ?></td>
        </tr>
        <?php endif;?>
        <?php if(intval($poriva)>0): ?>
        <tr>
            <td style='width:12%;'>FACTURA</td>
            <td style='width:18%;'><?php echo $numero_factura; ?></td>
            <td style='width:10%;'><?php echo $fecha_emision;?></td>
            <td style='width:10%;'><?php echo substr($fecha_emision,0,7); ?></td>
            <td style='width:15%; text-align:right'><?php echo $iva; ?></td>
            <td style='width:13%; text-align:center'>IVA</td>
            <td style='width:12%; text-align:center'><?php echo $poriva;?></td>
            <td style='width:10%; text-align:right'><?php echo $valiva; ?></td>
        </tr>
        <?php endif;?>
    </table>
</page>