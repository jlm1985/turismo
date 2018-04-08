<?php

class tp_login extends toba_tp_logon {

    function pre_contenido() {
        echo "<div class='login-titulo'>" . toba_recurso::imagen_proyecto("tecnibook.png", true);        
        echo "</div>";
        echo "\n<div align='center' class='cuerpo'>\n";
    }

    function post_contenido() {
        echo "</div>";
        echo "<div class='login-pie'>";
        echo "<div></div>";
        echo "</div>";
    }

}

?>