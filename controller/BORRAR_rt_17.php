<?php
$fecha_turno=$_POST["fecha"]; 
$horario_turno=$_POST["horario"]; 
//registrar el turno del usuario
$clstut = new clstramiteusuarioturno();
$clstut->setTra_id($tramite);
$clstut->setTu_id($id_tramite);
$clstut->setTut_dia($fecha_turno);
$clstut->setTut_hora($horario_turno);
$id_ret=$clstut->tut_insertar(); //REGISTRO ESPECÍFICO DEL TIPO DE TRAMITE

