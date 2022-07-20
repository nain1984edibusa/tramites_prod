<?php
/*ADD*/
function obtener_dias_feriados($cferiados,$fecha_inicio,$fecha_fin,$regional){
    $cferiados->setFa_fechainicio($fecha_inicio);
    $cferiados->setFa_fechafin($fecha_fin);
    $cferiados->setFa_regional($regional);
    $n=mysqli_fetch_array($cferiados->get_count_diasferiado());
    $n=$n["total"];
    //echo $fecha_inicio.$fecha_fin."Días feriados en el periodo:".$n."</br>";
    return $n;
}
function sumar_ndias_slaborables_sferiados($cferiados,$fecha_inicio,$cant_dias,$regional){
    $fecha_fin1=sumasdiasemana($fecha_inicio,$cant_dias);
    $df=obtener_dias_feriados($cferiados,$fecha_inicio,$fecha_fin1,$regional);
    $fecha_fin=sumasdiasemana($fecha_fin1,$df);
    return $fecha_fin;
}
/*add*/