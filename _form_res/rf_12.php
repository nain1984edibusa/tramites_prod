<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<div class="col-xs-12 col-sm-12 col-md-12">
    <div class="group-material">
        <span>Información Adicional <span class="sp-requerido">*</span></span>
        <?php 
        $infoadicional="";
        if(isset ($trespuesta)){
            $infoadicional=$trespuesta["tuc_infoadicional"];
        }
        ?>
        <textarea id="infoadicional" name="infoadicional" rows="4" class="tooltips-general material-control" placeholder="" required="" data-toggle="tooltip" data-placement="top" title="Escriba información adicional que se incluya en la respuesta"><?php echo str_replace('<br />','\n',$infoadicional); ?></textarea>
    </div>
</div>

