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
.especialsup td{
    border-top:1px solid grey
}
-->
</style>
<page backtop='38mm' backbottom='20mm' backleft='30mm' backright='25mm' footer='page' >
    <?php 
       $sql_sep=mysqli_query($$conexion,"SELECT movimientos.*,proveedores.* from movimientos INNER JOIN proveedores ON movimientos.id_proveedor=proveedores.id_proveedor WHERE id_movimiento='$idmovimiento'");
       $row=  mysqli_fetch_array($sql_sep);
       $base0=floatval($row["bimponible_iva0"]);
        $basex=floatval($row["bimponible_ivax"]);
        $base=$base0+$basex-floatval($row["retencion_fuente"]);
        $ret_iva=floatval($row["importe_iva"])-floatval($row["retencion_iva"]);
        $base_sinretencion=$base+$ret_iva;
    ?>
  <page_footer>
    <!--[[page_cu]]/[[page_nb]]-->
  </page_footer>
    <page_header>
        <img src="../../img/encabezado_portrait.jpg">
        <h3>REPORTE CTAS POR PAGAR</h3>
    </page_header>
    <table class="superior" cellspacing="0" style="margin-left:10%;width: 100%;font-size: 10pt; color: #333333;">
        <tr>
            <td style="width:50%; text-align:left;"><span class="etiqueta">FECHA:&nbsp;&nbsp;</span><span><?php echo $row["fecha_movimiento"];?></span></td>
            <td style="width:50%; text-align:left;"><span class="etiqueta">PROVEEDOR:&nbsp;&nbsp;</span><span><?php echo $row["nombre_proveedor"];?></span></td>
        </tr>
    </table>
    <table class="superior" cellspacing="0" style="margin-left:10%;width: 100%;font-size: 10pt; color: #333333;">
        <tr>
            <td style="width:25%; text-align:left;"><span class="etiqueta">NUMERO DE FACTURA:&nbsp;&nbsp;</span></td><td><?php echo $row["numero_factura"];?></td>
            <td style="width:25%; text-align:left;"><span class="etiqueta">TOTAL FACTURA:&nbsp;&nbsp;</span></td><td style="text-align: right"><?php echo $row["total_venta"]; ?></td>
        </tr>
        <tr>
            <td style="width:25%; text-align:left;"><span class="etiqueta">RETENCIONES:&nbsp;&nbsp;</span></td><td><?php echo "RET IVA:".$row["retencion_iva"]."<br> RET FUENTE:".$row["retencion_fuente"];?></td>
            <td style="width:25%; text-align:left;"><span class="etiqueta">A PAGAR:&nbsp;&nbsp;</span></td><td style="text-align: right"><?php echo number_format($base_sinretencion,2,'.',''); ?></td>
        </tr>
    </table>
    <hr>
    <br>
    <br>
    <H4>DETALLE PAGOS</H4>
    <table cellspacing="0" style="width: 100%; text-align: left; font-size: 9pt; margin-top:14px;">
        <tr style="background-color:grey; color:white; font-size: 10pt">
            <th style="width: 15%;text-align: center">FECHA</th>
            <th style="width: 20%;text-align: right">Valor</th>
            <th style="width: 35%;text-align: right">Observaciones</th>
            <th style="width: 30%;text-align: center">Cobrado</th>
        </tr>
    <?php 
    $sql_fp=mysqli_query($$conexion,"SELECT * from pagos_ctsxpagar WHERE movimiento='$idmovimiento'");
    //echo "SELECT * from pagos_movimientos WHERE id_movimiento='$idmovimiento'";
    $abonado=0;
    $cobrado=0;
    $xcobrar=0;
    $saldo=$row["total_venta"];
    while($rowfp=mysqli_fetch_array($sql_fp)){
    $texto_cobrado="";
    if($rowfp["ejecutado"]==1){
        $texto_cobrado="SI"; 
        $cobrado+= floatval($rowfp["valor_abonado"]);
    }else{
        $texto_cobrado="NO"; 
        $xcobrar+= floatval($rowfp["valor_abonado"]);
    }
    ?>
        <tr>
            <td style="width: 15%;text-align: center"><?php echo $rowfp["fecha"]; ?></td>
            <td style="width: 20%;text-align: right"><?php echo $rowfp["valor_abonado"]; ?></td>
            <td style="width: 35%;text-align: right"><?php echo $rowfp["observaciones"]; ?></td>
            <td style="width: 30%;text-align: center"><?php echo $texto_cobrado; ?></td>
        </tr>
    <?php 
    $abonado+=floatval($rowfp["valor_abonado"]);
    //RETENCION FUENTE + RETENCION IVA
        $saldo=$base_sinretencion-floatval($abonado);
    }
    ?>
        <tr class="especialsup">
            <td style="text-align: right">Total Cobrado</td><td style="text-align: right"><?php echo number_format($cobrado,2,'.','') ?></td><td></td>
        </tr>
        <tr>
            <td style="text-align: right">Total Por Cobrar</td><td style="text-align: right"><?php echo number_format($xcobrar,2,'.','') ?></td><td></td>
        </tr>
        <tr>
            <th style="text-align: right">Total Abonado</th><th style="text-align: right"><?php echo number_format($abonado,2,'.','') ?></th><td></td>
        </tr>
        <tr>
            <th style="text-align: right">Total Saldo</th><th style="text-align: right"><?php echo number_format($saldo,2,'.','') ?></th><td></td>
        </tr>
    </table>
</page>