<?php
/*incluir modelo(s)*/
//if (isset($_GET['term'])){
include_once("../../config/variables.php");
include_once("../../modelo/Config.class.php");
include_once("../../modelo/Db.class.php");
include_once("../../modelo/clsparroquia.php");
/*Listado de todas provincias*/
$listado_parroquias = new clsparroquia();
$listado_parroquias->setCan_id($_POST['can']);
$parroquias=$listado_parroquias->parroquia_seleccionar_bycriterio($_POST['term']);
$return_arr = array();
while($row= mysqli_fetch_array($parroquias)){
    $row_array['value'] = $row['par_nombre'];
    $row_array['cod_parroquia']=$row['par_id'];
    $row_array['nom_parroquia'] = $row['par_nombre'];
    array_push($return_arr,$row_array);
}
echo json_encode($return_arr);
//}
?>