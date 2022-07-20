<?php
include_once("../config/variables.php");
include_once("../modelo/Config.class.php");
include_once("../modelo/Db.class.php");
include_once("../modelo/clsauditoria.php");
$auditoria= new clsauditoria();
$id_tu=$_POST["idtu"];
$auditoria->setTu_id($id_tu);
$turnos=$auditoria->auditoria_seleccionar_bytu();
$return="<div class='row small'><div class='col-md-2 col-sm-2 col-xs-2'><strong>Fecha</strong></div>"
        . "<div class='col-md-5 col-sm-5 col-xs-5'><strong>Proceso</strong></div>"
        . "<div class='col-md-2 col-sm-2 col-xs-2'><strong>Usuario</strong></div>"
        . "<div class='col-md-3 col-sm-3 col-xs-3'><strong>Observaciones</strong></div></div>";
while($row= mysqli_fetch_array($turnos)){
    $return.="<div class='row small'>"
            . "<div class='col-md-2 col-sm-2 col-xs-2'>".$row["aud_fechahora_proceso"]."</div>";
    $return.="<div class='col-md-5 col-sm-5 col-xs-5'>".$row["aud_proceso"]." DEL ".$row["aud_objeto"]."</div>";
    $return.="<div class='col-md-2 col-sm-2 col-xs-2'>".$row["usu_apellido"]." ".$row["usu_nombre"]."</div>"
            ."<div class='col-md-3 col-sm-3 col-xs-3'>".$row["aud_descripcion"]."</div>"
            . "</div>";
    //$return.="<tr><td>".$row["aud_fechahora_proceso"]."</td><td>".$row["aud_proceso"]." DEL ".$row["aud_objeto"]."</td><td>".$row["usu_apellido"]." ".$row["usu_nombre"]."</td></tr>";
}
echo $return;

