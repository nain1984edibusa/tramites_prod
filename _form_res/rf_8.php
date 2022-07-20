<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<div class="col-xs-12 col-sm-12 col-md-12">
    <div class="group-material">
        <span>Marco Legal <span class="sp-requerido">*</span></span>
        <?php 
        $marco_legal="";
        if(isset ($trespuesta)){
            $marco_legal=$trespuesta["tuc_marcolegal"];
        }
        ?>
        <textarea id="marcolegal" name="marcolegal" rows="4" class="tooltips-general material-control" placeholder="" required="" data-toggle="tooltip" data-placement="top" title="Escriba el marco legal"><?php echo str_replace('<br />','\n',$marco_legal); ?></textarea>
    </div>
</div>

