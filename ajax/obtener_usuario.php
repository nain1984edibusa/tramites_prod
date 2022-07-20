<?php
/*incluir modelo(s)*/
//if (isset($_GET['term'])){
include_once("../config/variables.php");
include_once("../modelo/Config.class.php");
include_once("../modelo/Db.class.php");
include_once("../modelo/clsusuarios.php");
/*Listado de todas provincias*/
$listado_usuarios = new clsusuarios();
$listado_usuarios->setUsu_id($_POST["usuario"]);
$usuarios=$listado_usuarios->usu_seleccionar_byid();
$return_arr = array();
if(mysqli_num_rows($usuarios)==1){
    $row= mysqli_fetch_array($usuarios);
    $row_array['value'] = $row['pro_id'];
    $row_array['id_provincia'] = $row['pro_id'];
    $row_array['provincia'] = $row['pro_nombre'];
    $row_array['id_canton']=$row['can_id'];
    $row_array['canton'] = $row['can_nombre'];
    $row_array['id_parroquia'] = $row['par_id'];
    $row_array['parroquia'] = $row['par_nombre'];
    $row_array['id_regional'] = $row['reg_id'];
    $row_array['direccion'] = $row['usu_direccion'];
    array_push($return_arr,$row_array);
}
echo json_encode($return_arr);

