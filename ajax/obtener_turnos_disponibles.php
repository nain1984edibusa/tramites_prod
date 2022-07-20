<?php
/*incluir modelo(s)*/
//if (isset($_GET['term'])){
include_once("../config/variables.php");
include_once("../modelo/Config.class.php");
include_once("../modelo/Db.class.php");
include_once("../modelo/clstramiteturno.php");
/*Listado de todas provincias*/
$listado_turnos = new clstramiteturno();
$turnos=$listado_turnos->obtener_tramite_turnosdisp($_POST['fecha'],$_POST['tramite']);
$return='<option value="" disabled="" selected="">Selecciona una hora</option>';
while($row= mysqli_fetch_array($turnos)){
    $return.="<option value='".$row["tt_hora_inicio"]."'>".$row["tt_hora_inicio"]." - ".$row["tt_hora_fin"]."</option>";
}
echo $return;
?>