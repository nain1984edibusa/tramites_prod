<?php
/*incluir modelo(s)*/
//if (isset($_GET['term'])){
include_once("../../config/variables.php");
include_once("../../modelo/Config.class.php");
include_once("../../modelo/Db.class.php");
include_once("../../modelo/clscanton.php");
/*Listado de todas provincias*/
$listado_cantones = new clscanton();
$listado_cantones->setPro_id($_POST['prov']);
$cantones=$listado_cantones->canton_seleccionar_bycriterio($_POST['term']);
$return_arr = array();
while($row= mysqli_fetch_array($cantones)){
    $row_array['value'] = $row['can_nombre'];
    $row_array['cod_canton']=$row['can_id'];
    $row_array['nom_canton'] = $row['can_nombre'];
    array_push($return_arr,$row_array);
}
echo json_encode($return_arr);
//}
?>