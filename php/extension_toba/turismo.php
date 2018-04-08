<?php

class turismo {

    static protected $fabrica;

    static function cargar_fabrica() {
        if (!isset(self::$fabrica)) {
            $clase_fabrica = 'fabrica_' . __CLASS__;
            self::$fabrica = new $clase_fabrica();
        }
        return self::$fabrica;
    }

    static function es_usuario_administrador() {
        return (self::es_usuario_admin() || self::es_usuario_admin_siu());
    }

    static function es_usuario_admin() {
        $perfil_funcional = toba::manejador_sesiones()->get_perfiles_funcionales_activos();
        return ($perfil_funcional[0] == 'admin');
    }

    static function get_usuario() {
        return toba::usuario()->get_id();
    }

    static function html_boton($vinculo, $imagen = '', $texto, $extras = null, $extrastexto = null, $habilitado = true) {
        $tamanio = '2px';
        $html = '';
        if ($imagen != '') {
            $html = toba_recurso::imagen(toba_recurso::imagen_proyecto($imagen), null, null, null, null, null, "vertical-align: middle; margin:$tamanio $tamanio $tamanio $tamanio; float:left");
        }
        $html .= "<div >$texto</div>";
        $vinculo = toba::vinculador()->crear_vinculo('credito', $vinculo);
        $js = "onclick=\"window.location.href = '$vinculo';\"";
        return toba_form::button_html('', $html, $js, null, null, $texto, 'button', '', 'botonera-usuario', true, "padding:0;margin:0;$extras", $habilitado);
    }

    static function ordenar($toOrderArray, $field, $inverse = false) {
        $position = array();
        $newRow = array();
        foreach ($toOrderArray as $key => $row) {
            $position[$key] = $row[$field];
            $newRow[$key] = $row;
        }
        if ($inverse) {
            arsort($position);
        } else {
            asort($position);
        }
        $returnArray = array();
        foreach ($position as $key => $pos) {
            $returnArray[] = $newRow[$key];
        }
        return $returnArray;
    }

    static function reemplazar($string) {
        $a = array('á', 'é', 'í', 'ó', 'ú', 'ñ', 'Á', 'É', 'Í', 'Ó', 'Ú', 'Ñ', ' ');
        $b = array('a;', 'e', 'i', 'o', 'u', 'n', 'A', 'E', 'I', 'O', 'U', 'N', '_');
        return str_replace($a, $b, $string);
    }

    //Por defecto devuelve la url sino path
    static function get_path_imagenes($url = true) {
        $www = toba::proyecto()->get_www();
        if ($url) {
            return $www['url'] . '/public/fotos_libros/';
        }
        return $www['path'] . 'public/fotos_libros/';
    }

    static function get_archivo_imagen($codigo) {
        $path = self::get_path_imagenes(false);
        if ($gestor = opendir($path)) {
            while (false !== ($archivo = readdir($gestor))) {
                if ($archivo != '.' && $archivo != '..' && $archivo != '') {
                    if (ereg($codigo, $archivo)) {
                        closedir($gestor);
                        return $archivo;
                    }
                }
            }
        }
    }

    static function get_imagen($codigo, $ancho = null, $alto = null) {
        return toba_recurso::imagen(self::get_path_imagenes() . self::get_archivo_imagen($codigo), $ancho, $alto);
    }

    static function get_device() {
        $tablet_browser = 0;
        $mobile_browser = 0;
        $body_class = 'desktop';

        if (preg_match('/(tablet|ipad|playbook)|(android(?!.*(mobi|opera mini)))/i', strtolower($_SERVER['HTTP_USER_AGENT']))) {
            $tablet_browser++;
            $body_class = "tablet";
        }

        if (preg_match('/(up.browser|up.link|mmp|symbian|smartphone|midp|wap|phone|android|iemobile)/i', strtolower($_SERVER['HTTP_USER_AGENT']))) {
            $mobile_browser++;
            $body_class = "mobile";
        }

        if (isset($_SERVER['HTTP_ACCEPT']) && (strpos(strtolower($_SERVER['HTTP_ACCEPT']), 'application/vnd.wap.xhtml+xml') > 0) or ( (isset($_SERVER['HTTP_X_WAP_PROFILE']) or isset($_SERVER['HTTP_PROFILE'])))) {
            $mobile_browser++;
            $body_class = "mobile";
        }

        $mobile_ua = strtolower(substr($_SERVER['HTTP_USER_AGENT'], 0, 4));
        $mobile_agents = array(
            'w3c ', 'acs-', 'alav', 'alca', 'amoi', 'audi', 'avan', 'benq', 'bird', 'blac',
            'blaz', 'brew', 'cell', 'cldc', 'cmd-', 'dang', 'doco', 'eric', 'hipt', 'inno',
            'ipaq', 'java', 'jigs', 'kddi', 'keji', 'leno', 'lg-c', 'lg-d', 'lg-g', 'lge-',
            'maui', 'maxo', 'midp', 'mits', 'mmef', 'mobi', 'mot-', 'moto', 'mwbp', 'nec-',
            'newt', 'noki', 'palm', 'pana', 'pant', 'phil', 'play', 'port', 'prox',
            'qwap', 'sage', 'sams', 'sany', 'sch-', 'sec-', 'send', 'seri', 'sgh-', 'shar',
            'sie-', 'siem', 'smal', 'smar', 'sony', 'sph-', 'symb', 't-mo', 'teli', 'tim-',
            'tosh', 'tsm-', 'upg1', 'upsi', 'vk-v', 'voda', 'wap-', 'wapa', 'wapi', 'wapp',
            'wapr', 'webc', 'winw', 'winw', 'xda ', 'xda-');

        if (in_array($mobile_ua, $mobile_agents)) {
            $mobile_browser++;
        }

        if (strpos(strtolower($_SERVER['HTTP_USER_AGENT']), 'opera mini') > 0) {
            $mobile_browser++;
            //Check for tablets on opera mini alternative headers
            $stock_ua = strtolower(isset($_SERVER['HTTP_X_OPERAMINI_PHONE_UA']) ? $_SERVER['HTTP_X_OPERAMINI_PHONE_UA'] : (isset($_SERVER['HTTP_DEVICE_STOCK_UA']) ? $_SERVER['HTTP_DEVICE_STOCK_UA'] : ''));
            if (preg_match('/(tablet|ipad|playbook)|(android(?!.*mobile))/i', $stock_ua)) {
                $tablet_browser++;
            }
        }
        if ($tablet_browser > 0) {
            // Si es tablet has lo que necesites
            return 1;
        } else if ($mobile_browser > 0) {
            // Si es dispositivo mobil has lo que necesites
            return 2;
        } else {
            // Si es ordenador de escritorio has lo que necesites
            return 0;
        }
    }

    static function is_tablet() {
        if (self::get_device() == 1)
            return true;
    }

    static function is_mobile() {
        if (self::get_device() == 2)
            return true;
    }

}
