<?php
require_once(dirname(__FILE__).'/../html2pdf.class.php');
ob_start();
$respuesta=$contenido_respuesta;
//INCLUIR FORMATO DEL TRAMITE
$pre_respuesta=
"<style type=text/css'>
h4{
    width:100%;
    text-align:center;
}
p{
    font-size: 10pt;
    margin: 0px;
    padding: 5px 0px;
    text-align:justify;
}
i.firma_ec{
    color:#3598D9;
    font-weight:bold;
}
.bloque_especifico{
    padding:10px;
    border: 1px solid #e3e4e5;
}
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
</style>
<page backimg='".DIRSERVIDOR."/librerias/pdf/reportes/fondo_oficio.jpg' backtop='25mm' backbottom='20mm' backleft='30mm' backright='25mm' footer='page' >
  <page_footer>
  </page_footer>
    <page_header>
    </page_header>";
$pos_respuesta="</page>";
echo $pre_respuesta.$respuesta.$pos_respuesta; //venida de otro proceso
//PROCESO DE CREACION DEL PDF
$content = ob_get_clean();
$resultado_crear=0;
try
{
    // init HTML2PDF
    $html2pdf = new HTML2PDF('P', array(210,297), 'es', true, 'UTF-8', array(0, 0, 0, 0));
    // display the full page
    $html2pdf->pdf->SetDisplayMode('fullpage');
    // convert
    $html2pdf->writeHTML($content, isset($_GET['vuehtml']));
    $html2pdf->Output(DIRSERVIDOR.$ruta_archivo, 'F'); 
    $resultado_crear=1;
}
catch(HTML2PDF_exception $e) {
    echo $e;
    exit;
}
//echo "<script>window.close();</script>";