<?php
include_once("../config/variables.php");
$cut=$_POST["cut"];
$directorio=DIRSERVIDOR.RUTA_ARCHIVOSTRAMITES.$cut."/f".$cut.".pdf";
if(file_exists($directorio)){
    unlink(DIRSERVIDOR.RUTA_ARCHIVOSTRAMITES.$cut."/".$cut.".pdf");
    rename ($directorio, DIRSERVIDOR.RUTA_ARCHIVOSTRAMITES.$cut."/".$cut.".pdf");
    echo "SI";
}else{
    echo "NO"; 
}