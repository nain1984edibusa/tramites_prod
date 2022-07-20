<?php
/*incluir modelo(s)*/
//if (isset($_GET['term'])){
include_once("../../config/variables.php");
include_once("../../modelo/Config.class.php");
include_once("../../modelo/Db.class.php");
include_once("../../modelo/clsprovincia.php");
/*Listado de todas provincias*/
$listado_provincias = new clsprovincia();
$provincias=$listado_provincias->provincia_seleccionar_bycriterio($_GET['term']);
$return_arr = array();
while($row= mysqli_fetch_array($provincias)){
    $row_array['value'] = $row['pro_nombre'];
    $row_array['cod_provincia']=$row['pro_id'];
    $row_array['nom_provincia'] = $row['pro_nombre'];
    $row_array['cod_regional']=$row['reg_id'];
    array_push($return_arr,$row_array);
}
echo json_encode($return_arr);
//}
?>