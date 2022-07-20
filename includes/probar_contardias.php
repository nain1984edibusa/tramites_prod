<?php
date_default_timezone_set('America/Guayaquil');
setlocale(LC_TIME, 'es_ES');
include_once("../config/variables.php");
include_once("../modelo/Config.class.php");
include_once("../modelo/Db.class.php");
include_once("../modelo/clsferiadosanio.php");
$cferiados=new clsferiadosanio();
/*PROCESOS SIN FERIADOS*/
$fecha_prueba="2020-10-24 14:20:10";
define("CONVALIDACION",10);
define("COA",30);
echo "<b>FECHA REALIZACIÓN DEL PROCESO POR LOS USUARIOS2: </b>".$fecha_prueba."</br>";
$fecha_prueba_m=fechainicio($fecha_prueba);
echo "<b>FECHA INICIO</b>: ".$fecha_prueba_m."</br>";
$fecha_control_convalidacion=sumasdiasemana($fecha_prueba_m,CONVALIDACION);
//COUNT FERIADOS EN EL PERIODO X y Y
$cferiados->setFa_fechainicio($fecha_prueba_m);
$cferiados->setFa_fechafin($fecha_control_convalidacion);
$n=mysqli_fetch_array($cferiados->get_count_diasferiado());
$n=$n["total"];
echo "Días feriados en el periodo:".$n."</br>";
echo "<b>FECHA CONTROL CONVALIDACIÓN</b>: ".sumasdiasemana($fecha_control_convalidacion,$n)."</br>";
$fecha_control_coa=sumasdiasemana($fecha_prueba_m,COA);
//COUNT FERIADOS EN EL PERIODO X y Y
$cferiados->setFa_fechafin($fecha_control_coa);
$ndf=$cferiados->get_count_diasferiado();
$n= mysqli_fetch_array($ndf);
$n=$n["total"];
echo "Días feriados en el periodo:".$n."</br>";
echo "<b>FECHA CONTROL COA</b>: ".sumasdiasemana($fecha_control_coa,$n)."</br>";
function sumasdiasemana($fecha,$dias)
{
    $datestart= strtotime($fecha);
    $datesuma = 15 * 86400;
    $diasemana = date('N',$datestart);
    $totaldias = $diasemana+$dias;
    $findesemana = intval( $totaldias/5) *2 ;
    $diasabado = $totaldias % 5 ;
    if ($diasabado==6) $findesemana++;
    if ($diasabado==0) $findesemana=$findesemana-2;
    $total = (($dias+$findesemana) * 86400)+$datestart ;
    return $twstart=date('Y-m-d', $total);
}
function saber_dia($fechabuscar) {
    $dias = array(1=>'Lunes',2=>'Martes',3=>'Miercoles',4=>'Jueves',5=>'Viernes',6=>'Sabado',7=>'Domingo');
    return $dias[date('N', strtotime($fechabuscar))];
}
function fechainicio($fecha){
    $devolver_fecha_fs=$fecha;
    $diasem=saber_dia($fecha);
    //echo $diasem;
    if(saber_dia($fecha)=="Sabado"){
        $devolver_fecha_fs=date('Y-m-d H:i:s',strtotime($fecha. "+ 2 days"));
    }elseif(saber_dia($fecha)=="Domingo"){
        $devolver_fecha_fs=date('Y-m-d H:i:s',strtotime($fecha. "+ 1 days"));
    }
    return $devolver_fecha_fs;
}