<style type="text/css">
<!--
table { vertical-align: top; }
tr    { vertical-align: top; }
td    { vertical-align: top; height:10px; padding: 2px; }
.superior td{ height: 13px; padding: 5pt;}
.superior th{ height: 13px; border-bottom: 1px solid grey; padding-bottom: 5pt;}
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
<page backtop='38mm' backbottom='20mm' backleft='30mm' backright='25mm' footer='page' >
  <page_footer>
    <!--[[page_cu]]/[[page_nb]]-->
  </page_footer>
    <page_header>
        <img src="../../img/encabezado_portrait.jpg">
        <h3>ESTADO DE CUENTA (Cuentas por Cobrar)</h3>
    </page_header>
    <p><strong>INFORMACIÓN DEL CLIENTE</strong></p>
<?php
$sql_cliente=mysqli_query($conb,"select * from clientes where id_cliente='$id_cliente'");
$row_cliente=mysqli_fetch_array($sql_cliente);
date_default_timezone_set('America/Guayaquil');
?>
    <table style="width: 100%">
        <tr>
            <th style="width: 15%">Nombre:</th>
            <td style="width: 45%"><?php echo $row_cliente["nombre_cliente"]?></td>
            <th style="width: 15%">CI/RUC:</th>
            <td style="width: 25%"><?php echo $row_cliente["ruc_ci"]?></td>
        </tr>
        <tr>
            <th style="width: 15%">Dirección:</th>
            <td style="width: 45%"><?php echo $row_cliente["direccion_cliente"]?></td>
            <th style="width: 15%">Teléfono:</th>
            <td style="width: 25%"><?php echo $row_cliente["telefono_cliente"]?></td>
        </tr>
        <tr>
            <th style="width: 15%">Email:</th>
            <td style="width: 45%"><?php echo $row_cliente["email_cliente"]?></td>
            <th style="width: 15%">Fecha:</th>
            <td style="width: 25%"><?php echo date("Y-m-d H:i:j"); ?></td>
        </tr>
    </table>
<?php
for($i=0; $i<count($conexiones);$i++):
?>
    <h4><?php echo $empresa[$i]; ?></h4>
    <hr>
    <h5>CRÉDITO DIRECTO</h5>
    <?php
    $sql=mysqli_query($condb, "select * from ".$bds[$i].".movimientos where ".$bds[$i].".movimientos.id_cliente='$id_cliente' and proceso='VEN' and estado_factura='0' order by id_movimiento ASC");
//echo "select * from ".$bds[$i].".movimientos where ".$bds[$i].".clientes.id_cliente='$id_cliente' and proceso='VEN' and estado_factura='0' order by id_movimiento ASC";
    if(mysqli_num_rows($sql)>0){
        ?>
        <table class="superior" cellspacing="0" style="margin-left:10%;width: 100%;font-size: 10pt;">
            <tr>
                <th style="width:20%;text-align:left;">FECHA</th>
                <th style="width:20%;text-align:left;"># FACTURA</th>
                <th style="width:20%;text-align:right;">TOTAL VENTA</th>
                <th style="width:20%;text-align:right;">ABONO</th>
                <th style="width:20%;text-align:right;">SALDO</th>
            </tr>
            <?php
            while($rowcta = mysqli_fetch_array($sql)){ ?>
                <tr>
                    <td style="width:20%;text-align:left;"><?php echo substr($rowcta["fecha_movimiento"],0,10);?></td>
                    <td style="width:20%;text-align:left;"><?php echo $rowcta["numero_factura"];?></td>
                    <td style="width:20%;text-align:right;">$ <?php echo $rowcta["total_venta"];?></td>
                    <td style="width:20%;text-align:right;">$ <?php echo $rowcta["fp_creddir_abono"];?></td>
                    <td style="width:20%;text-align:right;">$ <?php echo $rowcta["fp_creddir_saldo"];?></td>
                </tr>
                <?php 
                $total_ctasxcobrar+=floatval($rowcta["fp_creddir_saldo"]);
            }?>
                <tr><td colspan='4' style="text-align:right;"><b>TOTAL</b></td><td style="text-align:right;"><b>$ <?php echo number_format($total_ctasxcobrar,2,'.',''); ?></b></td></tr>
        </table>
    <?php
    }else{
    ?>
        <p>No existen créditos directos vigentes.</p>
    <?php
    }
    ?>
        <h5>SEPARADOS</h5>
    <?php
    $sql=mysqli_query($condb, "select * from ".$bds[$i].".movimientos where ".$bds[$i].".movimientos.id_cliente='$id_cliente' and proceso='SEP' and estado_factura='0' order by id_movimiento ASC");
    if(mysqli_num_rows($sql)>0){
        ?>
        <table class="superior" cellspacing="0" style="margin-left:10%;width: 100%;font-size: 10pt;">
            <tr><th>FECHA</th><th>TOTAL VENTA</th><th>ABONO</th><th>SALDO</th></tr>
            <?php
            while($rowcta = mysqli_fetch_array($sql)){ ?>
                <tr>
                    <td><?php echo $rowcta["fecha_movimiento"];?></td>
                    <td><?php echo $rowcta["total_venta"];?></td>
                    <td><?php echo $rowcta["fp_creddir_abono"];?></td>
                    <td><?php echo $rowcta["fp_creddir_saldo"];?></td>
                </tr>
                <?php 
                $total_separado+=floatval($rowcta["fp_creddir_saldo"]);
            }?>
                <tr><th colspan='3'>Total</th><td><?php echo number_format($total_separado,2,'.',''); ?></td></tr>
        </table>
    <?php
    }else{
    ?>
        <p>No existen separados vigentes.</p>
    <?php
    }
endfor;
$total=$total_ctasxcobrar+$total_separado;
?>
        <br>
        <br>
        <table class="tbbordes" style="margin-left:10%;width: 100%;font-size: 10pt;">
            <tr><th style="width:70%;text-align:right;">SALDO GLOBAL:</th><td style="width:30%;text-align:right;">$ <?php echo number_format($total,2,'.',''); ?></td></tr>
        </table>
</page>