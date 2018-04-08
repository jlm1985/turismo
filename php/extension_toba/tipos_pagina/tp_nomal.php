<?php

class tp_normal extends toba_tp_normal {

    protected $alto_cabecera = "40px";

    function barra_superior() {
        $info = toba::solicitud()->get_datos_item();
        $barra = 'barra-superior-tit';
        echo "<div class='barra-superior $barra'>\n";
        $this->info_version();
        echo "<div class='item-barra'>";
        if (trim($info['item_descripcion']) != '') {
            $desc = toba_parser_ayuda::parsear(trim($info['item_descripcion']));
            $ayuda = toba_recurso::ayuda(null, $desc, 'item-barra-ayuda', 0);
            echo "<div $ayuda>";
            echo toba_recurso::imagen_toba("ayuda_grande.gif", true);
            echo "</div>";
        }
        $imagen = '';
        //Si tiene imagen la imprimo, fijandome si viene del proyecto o es de toba!!
        if (isset($info['item_imagen'])) {
            if ($info['item_imagen_recurso_origen'] == 'proyecto') {
                $imagen = toba_recurso::imagen_proyecto($info['item_imagen'], true);
            } else {
                $imagen = toba_recurso::imagen_toba($info['item_imagen'], true);
            }
        }
        echo "<div class='item-barra-tit'>$imagen  " . $this->titulo_item() . "<br>&nbsp;</div>";        
        echo "</div>\n\n";
    }

    protected function info_usuario() {

        echo '<div class="enc-usuario">';
        $url = toba::vinculador()->crear_vinculo(null, 14000007, null, array('menu' => 1));
        echo "<span class='enc-usuario-nom'>";
        echo "<a href='$url' class='enc-usuario-id' title='Permite cambiar la password'>";
        echo toba_recurso::imagen_proyecto('worker.png', true);
        echo "</a>";
        echo texto_plano(toba::usuario()->get_nombre());
        echo "</span>";
        echo '</div>';
    }

    protected function titulo_item() {
        if (!isset($this->titulo)) {
            $info['basica'] = toba::solicitud()->get_datos_item();
            $item = new toba_item_info($info);
            $item->cargar_rama();

            //Se recorre la rama
            $camino = "<span class='ruta'>" . $item->get_nombre() . '</span>';
            while ($item->get_padre() != null) {
                $item = $item->get_padre();
                if (!$item->es_raiz()) {
                    $camino = '<span style="font-weight:normal;"> ' . $item->get_nombre() . ' > </span>' . $camino;
                }
            }
            $this->titulo = $camino;
        }
        return $this->titulo;
    }

    protected function cabecera_aplicacion() {
        if (toba::proyecto()->get_parametro('requiere_validacion')) {
            //--- Salir
            $js = toba_editor::modo_prueba() ? 'window.close()' : 'salir()';
            echo '<a href="#" class="enc-salir" title="Cerrar la sesión" onclick="javascript:' . $js . '">';
            echo toba_recurso::imagen_proyecto('finalizar_sesion.gif', true);
            echo '</a>';

            //--- Usuario
            $this->info_usuario();
        }

        //--- Proyecto
        if (toba::proyecto()->es_multiproyecto()) {
            $this->cambio_proyecto();
        }
        //--- Logo
        echo "<div id='enc-logo' style='height:{$this->alto_cabecera}'>";
        $this->mostrar_logo();
        echo "</div>\n";
    }

    protected function estilos_css() {
        parent::estilos_css();
    }

}

?>