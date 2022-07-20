<div id="menuadm"  >
    <?php  if(!empty($_SESSION['solopanas'])){?>
     <?php  if ($_SESSION["perfil"] == 1){?>
        <div id="item"><a href="admroles.php">Roles</a></div>
        <div id="item"><a href="admtramites.php">Trámites</a></div>
        <div id="item"><a href="admfiscalizadores.php">Fiscalizadores</a></div>
        <div id="item"><a href="admadministradores.php">Administradores</a></div>
        <div id="item"><a href="admgenero.php">Género</a></div>
        <!--<div id="item"><a href="admasesorias.php">Asesorias</a></div>
        <div id="item"><a href="admtipoasesorias.php">Tipo Asesorias</a></div>  -->
        <div id="item"><a href="logout.php">Cerrar Sesión</a></div>
     <?php  
	    }
	     if ($_SESSION["perfil"] == 2){?>
        <div id="item"><a href="admbaselegal.php">Base Legal</a></div>
        <div id="item"><a href="admayuda.php">Ayuda</a></div>
        <div id="item"><a href="admtecnico.php">Técnico</a></div>	
        <div id="item"><a href="logout.php">Cerrar Sesión</a></div>
        
        <?php  
	    }
	     if ($_SESSION["perfil"] == 3){?>
        <div id="item"><a href="admbaselegal.php">Base Legal</a></div>
        <div id="item"><a href="admayuda.php">Ayuda</a></div>	
        <div id="item"><a href="admdirector.php">Director</a></div>
        <div id="item"><a href="logout.php">Cerrar Sesión</a></div>
        
     <?php }
	     if ($_SESSION["perfil"] == 4 || $_SESSION["perfil"] == 5){?>   
        <div id="item"><a href="admbaselegal.php">Reportes</a></div>
        <div id="item"><a href="admayuda.php">Ayuda</a></div>
        <div id="item"><a href="admseltramites.php">Proyecto</a></div>
        <div id="item"><a href="logout.php">Cerrar Sesión</a></div>
       <?php }?>
       <?php }
	       else{?>
        <div id="item"><a href="index.php">Inicio</a></div>   
        <div id="item"><a href="login.php">Iniciar sesión</a></div>
        <div id="item"><a href="reptipoproyecto.php">Reportes</a></div>
        <div id="item"><a href="admayuda.php">Ayuda</a></div>	
        <?php }   
	   ?>
</div>
