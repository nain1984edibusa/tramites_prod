<?php
/* 
 * INSTITUTO NACIONAL DE PATRIMONIO CULTURAL
 * Portal de Trámites 2020
 */
session_start();
if(isset($_POST["cpt"])){
    if($_SESSION['captcha_text']==$_POST["cpt"]){
        echo "1";
    }else{
        echo "0";
    }
}
