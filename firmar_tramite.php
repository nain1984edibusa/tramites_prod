<?php
$archivo_firmar="./upload/img20200925_12290730.pdf";
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
session_start();
include_once './includes/ws_firmaEc.php';
?>
<script type="text/javascript">
    window.open("firmaec://<?php print $sistema ?>/firmar?token=<?php print $token ?><?php print $certificadoDigital ?><?php print $estampado ?><?php print $pre ?>");
    </script>
<a href="firmaec://<?php print $sistema ?>/firmar?token=<?php print $token ?><?php print $certificadoDigital ?><?php print $estampado ?><?php print $pre ?>" ><button type="button" class="btn btn-primary" ><i class="fas fa-key"></i> &nbsp;&nbsp; Firmar Respuesta</button></a>