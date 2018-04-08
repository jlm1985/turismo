<?php
require_once('turismo.php');
//require_once('fabrica_credito.php');

class contexto_ejecucion implements toba_interface_contexto_ejecucion {

    function conf__inicial() {
        //credito::cargar_fabrica();
    }

    function conf__final() {
        
    }

}
?>