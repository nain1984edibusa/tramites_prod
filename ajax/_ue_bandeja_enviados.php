<?php
/*incluir modelo(s)*/
session_start();
include_once("../config/variables.php");
include_once("../modelo/Config.class.php");
include_once("../modelo/Db.class.php");
include_once("../modelo/clstramiteusuario.php");
include_once("../includes/functions.php");
/*Listado de todos los trámites ordenados por el campo ct_orden*/
$listado_tramites_br = new clstramiteusuario();
$estados=array(VALIDACION_REQUISITOS,ANALISIS_SOLICITUD,CONTESTADO_REVISION);
//CONDICIONES DE BÚSQUEDA
$aColumns = array('ct_tramite_usuario.tu_codigo');
$sWhere = "";
$action = (isset($_REQUEST['action'])&& $_REQUEST['action'] !=NULL)?$_REQUEST['action']:'';
if($action == 'ajax'){
    if ($_GET['q'] != "" )
    {
        $q = $_GET['q'];
        $sWhere = "and (";
        for ( $i=0 ; $i<count($aColumns) ; $i++ )
        {
                $sWhere .= $aColumns[$i]." LIKE '%".$q."%' OR ";
        }
        $sWhere = substr_replace( $sWhere, "", -3 );
        $sWhere .= ')';
    }
}
/*variables_paginacion*/
$page = (isset($_REQUEST['page']) && !empty($_REQUEST['page']))?$_REQUEST['page']:1;
$offset = ($page - 1) * REG_PPAGINA;
$count_query=$listado_tramites_br->tra_contar_all_byusu_ve($_SESSION["codusuario"],$estados,$_SESSION["codperfil"],$sWhere);// total registros
$row= mysqli_fetch_array($count_query);
$numrows = $row['total'];
$total_pages = ceil($numrows/REG_PPAGINA);
$reload="/ue_bandeja_enviados.php";
// en el sql LIMIT $offset,$per_page
$tramites=$listado_tramites_br->tra_seleccionar_all_byusu_ve($_SESSION["codusuario"],$estados,$_SESSION["codperfil"],$offset,REG_PPAGINA,$sWhere);
?>
<div class="outer_div">			
    <div class="table-responsive">
        <table class="table table-hover">
            <thead <?php if ($sWhere!=""){ echo "class='tr_filtro'";} ?>>
                <tr class="info">
                    <th style="width: 5%">Cod</th>
                    <th style="width: 50%">Trámite</th>
                    <th style="width: 10%">Fecha de Ingreso</th>
                    <th style="width: 10%">Fecha aprox. Contestación</th>
                    <th style="width: 15%">Estado actual</th>
                    <th style="width: 10%;" class="text-right">Acciones</th>	
                </tr>
            </thead>
            <tbody>
                <?php if(mysqli_num_rows($tramites)!=0){?>
                    <?php while($row= mysqli_fetch_array($tramites)): 
                        $hoy=date("Y-m-d");
                        $clase="";
                        //echo $row["TU_CODIGO"]." ".strtotime($hoy)." ".strtotime(substr($row["TU_FECHA_CONTCONT"],0,10))." ".strtotime(substr($row["TU_FECHA_APROCONT"],0,10))."</br>";
                        if(strtotime($hoy)<=strtotime(substr($row["tu_fecha_contcont"],0,10))){ //SI LA FECHA DE HOY ES MENOR O IGUAL A LA DE CONTROL, ESTAMOS EN VERDE
                            $clase="";
                        }elseif((strtotime($hoy)>strtotime(substr($row["tu_fecha_contcont"],0,10)))&&(strtotime($hoy)<=strtotime(substr($row["tu_fecha_aprocont"],0,10)))){//SI LA FECHA DE HOY ES MAYOR A LA DE CONTROL PERO MENOR O IGUAL A LA DE APROX_CONTESTACION ESTAMOS EN AMARILLO
                            $clase=' class="warning"';
                        }elseif(strtotime($hoy)>strtotime(substr($row["tu_fecha_aprocont"],0,10))){//SI LA FECHA DE HOY ES MAYOR A LA DE APROX_CONTESTACION ESTAMOS EN ROJO
                            $clase=' class="danger"';
                        }
                        ?>
                        <tr <?php echo $clase; ?>>
                            <td><a href="#" onclick="obtener_auditoria(<?php echo $row["tu_id"]?>)" data-toggle="modal" data-target="#AuditoriaTramite"><span class="small"><?php echo $row["tu_codigo"]?></span></a></td>
                            <td><?php echo $row["tra_nombre"];?></td>
                            <td><?php echo $row["tu_fecha_ingreso"]?></td>
                            <td><?php echo $row["tu_fecha_aprocont"]?></td>
                            <td><span class="small"><?php echo $row["et_nombre"]?></span></td>
                            <td class="text-right">
                                <a href="./ue_visualizacion_tramite.php?idtu=<?php echo $row["tu_id"]?>" class='btn btn-default' title='Ver detalles'><i class="zmdi zmdi-eye"></i></a>
                            </td>
                        </tr>
                    <?php endwhile;
                }else{
                    echo "<tr><td colspan='6'>Ningún registro en el sistema</td></tr>";
                }
                ?>
            </tbody>
        </table>
        <?php include_once("../includes/paginador.php"); ?>
    </div>
</div>