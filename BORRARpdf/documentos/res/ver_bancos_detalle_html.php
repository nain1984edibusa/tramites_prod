<style type="text/css">
<!--
table { vertical-align: top; }
tr    { vertical-align: top; }
td,th   { vertical-align: top; height:10px; padding: 3pt; }
.superior td, .superior th{ height: 10px; padding:3pt;}
.etiqueta{
    font-size: 9pt;
    font-weight: bold;
}
.txt_invisible{
    color:white;
}
.encabezado th{ border-bottom: 1px solid grey;}
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
.text-right{
    text-align: right;
}
-->
</style>
<page backtop='38mm' backbottom='20mm' backleft='30mm' backright='25mm' footer='page' >  
  <page_footer>
    <!--[[page_cu]]/[[page_nb]]-->
  </page_footer>
    <page_header>
        <img src="../../img/encabezado_landscape.jpg">
        <h3>REPORTE SALDOS BANCO</h3>
    </page_header>
    <p><b>Fecha y Hora: </b><?php echo date('Y-m-d H:i:j'); ?></p>
    <p>Lista(s) de cheques (ctas por pagar) registrados no efectivizados.</p>
    <H4>ACUMULADO CHEQUES CON COBRO AL <?php echo sumar_dias_fecha(2); ?></H4>
    <table class="superior" cellspacing="0" style="margin-left:10%;width: 100%;font-size: 10pt; color: #333333;">
        <tr class="encabezado">
            <th>Fecha Cancelación</th>
            <th>Proveedor</th>
            <th># Factura</th>
            <th class="text-right">Valor Cheque</th>
            <th>Observaciones</th>
        </tr>
    <?php 
    $total=0;
    $query_alertas = mysqli_query($$conexion,"SELECT pagos_ctsxpagar.*, proveedores.nombre_proveedor, movimientos.numero_factura FROM pagos_ctsxpagar INNER JOIN movimientos ON pagos_ctsxpagar.movimiento=movimientos.id_movimiento INNER JOIN proveedores ON movimientos.id_proveedor=proveedores.id_proveedor WHERE ejecutado='0' and pagos_ctsxpagar.tipo_pago='CHEQUE' and DATE_ADD(fecha_cancelacion, INTERVAL -2 DAY)='".date('Y-m-d')."'");
    if(mysqli_num_rows($query_alertas)>0){
        while($cta_alerta= mysqli_fetch_array($query_alertas)){
    ?>
        <tr>
            <td><?php echo $cta_alerta["fecha_cancelacion"]; ?></td>
            <td><?php echo $cta_alerta["nombre_proveedor"]; ?></td>
            <td><?php echo $cta_alerta["numero_factura"]; ?></td>
            <td class="text-right"><?php echo $cta_alerta["valor_abonado"]; ?></td>
            <td><?php echo $cta_alerta["observaciones"]; ?></td>
        </tr>
    <?php
        $total+= floatval($cta_alerta["valor_abonado"]);
        }
    }else{
    ?>
        <tr><td colspan="5">No existen datos registrados.</td></tr>
    <?php
    }
    ?>
        <tr>
            <th colspan="3" class="text-right">Total</th>
            <th class="text-right"><?php echo number_format($total,2,'.','') ?></th>
            <th></th>
        </tr>
    </table>
    <br>
    <br>
    <H4>ACUMULADO CHEQUES NO EFECTIVIZADOS</H4>
    <table class="superior" cellspacing="0" style="margin-left:10%;width: 100%;font-size: 10pt; color: #333333;">
        <tr class="encabezado">
            <th>Fecha Cancelación</th>
            <th>Proveedor</th>
            <th># Factura</th>
            <th class="text-right">Valor Cheque</th>
            <th>Observaciones</th>
        </tr>
    <?php
    $total=0;
    $query_alertas = mysqli_query($$conexion,"SELECT pagos_ctsxpagar.*, proveedores.nombre_proveedor, movimientos.numero_factura FROM pagos_ctsxpagar INNER JOIN movimientos ON pagos_ctsxpagar.movimiento=movimientos.id_movimiento INNER JOIN proveedores ON movimientos.id_proveedor=proveedores.id_proveedor WHERE ejecutado='0' and pagos_ctsxpagar.tipo_pago='CHEQUE'");
    if(mysqli_num_rows($query_alertas)>0){
        while($cta_alerta= mysqli_fetch_array($query_alertas)){
    ?>
        <tr>
            <td><?php echo $cta_alerta["fecha_cancelacion"]; ?></td>
            <td><?php echo $cta_alerta["nombre_proveedor"]; ?></td>
            <td><?php echo $cta_alerta["numero_factura"]; ?></td>
            <td class="text-right"><?php echo $cta_alerta["valor_abonado"]; ?></td>
            <td><?php echo $cta_alerta["observaciones"]; ?></td>
        </tr>
    <?php
        $total+= floatval($cta_alerta["valor_abonado"]);
        }
    }else{
    ?>
        <tr><td colspan="5">No existen datos registrados.</td></tr>
    <?php
    }
    ?>  
        <tr>
            <th colspan="3" class="text-right">Total</th>
            <th class="text-right"><?php echo number_format($total,2,'.','') ?></th>
            <th></th>
        </tr>
    </table>
</page>